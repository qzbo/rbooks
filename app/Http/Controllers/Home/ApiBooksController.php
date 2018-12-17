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

         return $this->jy($res);



    }
    //获取当前图书下的所有目录
    public function apimulu(Request $request){

        $id = $request->id;

        $res = Chapters::where('book_id',$id)->get(['id','book_id','Chapter']);


        return $this->jy($res);


    }
//    获取图书下的章节和内容
    public function apicatalog(Request $request,$id){



        $res = Chapters::where('book_id',$id)->get();



        return $this->jy($res);

    }
//获取章节下的内容
    public function apiconcen(Request $request,$id){


        $res = Chapters::find($id);

        return $this->jy($res);

    }
//获取广告
    public function apiadv(Request $request){
//        接受type类型的值
        $type = $request->type;



         $res = Adv::where('isvi',$type)->get();


        return $this->jy($res);

    }
//获取推荐书籍

    public function apirecommend(Request $request) {

        //获取推荐字段为1的图书
        $res = Books::where('isrecommend','1')->get();

        return $this->jy($res);



    }
//转换数据为json格式
    public  function jy($res){


        if($res){

            $data=[
                'status'=>0,
                'msg'=>'获取成功',
                'data'=>$res
            ];

            return json_encode($data);
        }else {
            $data=[
                'status'=>1,
                'msg'=>'获取数据失败',
                'data'=>''
            ];

            return json_encode($data);

        }



    }


}
