<?php
/**
 * Created by PhpStorm.
 * User: purelightme
 * Date: 2018/9/25
 * Time: 23:13
 */

namespace App\Admin\Extensions\Exporters;


use Encore\Admin\Grid\Exporters\AbstractExporter;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class CommonExporter extends AbstractExporter
{
    private $file_name;

    private $formatter;

    public function __construct($file_name,$formatter = null)
    {
        parent::__construct();
        $this->file_name = !empty($file_name) ? $file_name : date("Y-m-d") .'-'. Str::random(6);
        $this->formatter = $formatter;
    }

    public function export()
    {
        Excel::create($this->file_name, function($excel){
            $model_name = get_class($this->grid->model()->eloquent());
            $excel->sheet($this->file_name, function($sheet) use ($model_name) {
                $name = [];
                $label = [];
                foreach ($this->grid->columns() as $k => $v) {
                    $name[] = $v->getName();
                    $label[] = $v->getLabel();
                }
                $data =$this->getData();
                $rows = [];
                foreach ($data as $k => $v) {
                    $rows[] = array_dot($v);
                }
                $rows = collect($rows)->map(function($item) use ($name) {
                    return array_only($item, $name);
                });
                $rows = $this->sort_arr($rows, $name, $model_name);
                if ($this->formatter != null){
                    $rows = call_user_func($this->formatter,$rows);
                }
                $sheet->row(1, $label);
                $sheet->rows($rows);
                ob_end_clean();
            });
        })->export('xls');
    }

    /**
     * Remove indexed array.
     *
     * @param array $row
     *
     * @return array
     */
    protected function sanitize(array $row)
    {
        return collect($row)->reject(function ($val) {
            return is_array($val) && !Arr::isAssoc($val);
        })->toArray();
    }

    /**
     * 重新排序
     * @param $arr
     * @param $keys
     * @param $model_name
     * @return array
     */
    public function sort_arr($arr, $keys, $model_name)
    {
        $new_arr = [];
        foreach ($arr as $k => $v) {
            foreach ($v as $kk => $vv) {
                if (stripos($kk, '.')) {
                    list($l1, $l2) = explode('.', $kk);
                    if(method_exists($l1,'_gird_'.$l2)) {
                        $v[$kk] = call_user_func_array([ucwords($l1), '_gird_'.$l2], [$vv]);
                    }
                } else {
                    if(method_exists($model_name,'_gird_'.$kk)) {
                        $v[$kk] = call_user_func_array([$model_name, '_gird_'.$kk], [$vv]);
                    }
                }
            }
            foreach ($keys as $kk => $vv) {
                $new_arr[$k][$vv] = $v[$vv];
            }
        }
        return $new_arr;
    }
}