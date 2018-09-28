<?php

namespace App\Http\Controllers;

use App\Models\Search;
use App\Tools\Upload\Upload;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
//        $article = new Search();
//        $article->title = '背影';
//        $article->author = '朱自清';
//        $article->content = '原来，翻过栅栏，买橘子，就在此地，不要走动';
//        $article->save();
        return Search::search('中国')->get();
    }
}
