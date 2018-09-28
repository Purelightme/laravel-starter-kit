<?php

namespace App\Http\Controllers\Demo;

use App\Tools\Upload\UploadTool;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UploadController extends Controller
{
    /**
     * @param Request $request
     * @throws \App\Exceptions\UploadException
     */
    public function single(Request $request)
    {
        $upload = new UploadTool();
        $upload->setType(['image']);
        var_dump($upload->uploadSingleFile($request->file('img'),'demo/img'));
    }

    /**
     * @param Request $request
     * @throws \App\Exceptions\UploadException
     */
    public function multi(Request $request)
    {
        $upload = new UploadTool();
        $upload->setType(['image']);
        var_dump($upload->uploadMultiFiles($request->file('imgs'),'demo/img'));
    }
}
