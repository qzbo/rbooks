<?php

namespace App\Http\Controllers\Home;

use App\Model\Books;
use App\Model\Chapters;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    //
    public function index(){

        $res = Books::get();



        return view('home/books/index',compact('res'));

    }

    public function listbooks(Request $request){

        $book_id = $request->id;
        $books_res = Books::find($book_id);

        $books_chapters = Chapters::where('book_id',$book_id)->get(['id','book_id','Chapter']);

        return view('home/books/detail',compact('books_res','books_chapters'));

    }

    public function mainbooks(Request $request){

        $chapters_id = $request->id;
        $chapters_res = Chapters::find($chapters_id);
        $res = Books::find($chapters_res->book_id);


        return view('home/books/main',compact('chapters_res','res'));


    }
    public function rec(){
        $rec = Books::where('isrecommend',1)->get();



        foreach ($rec as $k=>$v){


            $arrname []= $v['booksname'];
        }
       $name = json_encode($arrname);

        return view('home/books/recommend',compact('rec','name'));


    }

    public function sea(){


        return view('home/books/search');
    }

    public function search(Request $request){

        $booksname = $request->bookname;




    }

}
