<?php
/**
 * Created by PhpStorm.
 * User: purelightme
 * Date: 2018/9/25
 * Time: 23:03
 */

namespace App\Admin\Extensions\Editors;


use Encore\Admin\Form\Field;

class UEditor extends Field
{
    // 定义视图
    protected $view = 'admin.uEditor';

    // css资源
    protected static $css = [];

    // js资源
    protected static $js = [
        'vendor/ueditor/ueditor.config.js',
        'vendor/ueditor/ueditor.all.js',
        'vendor/ueditor/lang/zh-cn/zh-cn.js'
    ];

    public function render()
    {
        $this->script = <<<EOF
UE.delEditor('{$this->id}');  
             var  ue = UE.getEditor('{$this->id}');
EOF;
        return parent::render();
    }
}