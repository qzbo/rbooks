<?php

namespace App\Http\Controllers\Home;

use App\Model\Adv;
use App\Model\Books;
use App\Model\Chapters;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ApiBooksController extends Controller
{
    //

//    获取所有图书
    public function apibook(Request $request) {


        $res = Books::get();

        return json_encode($res);



    }

//    获取图书下的章节和内容
    public function apicatalog(Request $request,$id){



        $res = Chapters::where('book_id',$id)->get();



        return json_encode($res);

    }
//获取章节下的内容
    public function apiconcen(Request $request,$id){


        $res = Chapters::find($id);

        return json_encode($res);

    }
//获取广告
    public function apiadv(Request $request){
        $type = $request->type;



         $res = Adv::where('isvi',$type)->get();


          return json_encode($res);

    }




}
