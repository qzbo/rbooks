<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    //设置表名
    protected $table = 'books';
    public $timestamps = false;

    public function booksdetail()
    {

        return $this -> hasMany('App\Model\Chapters','book_id','id');
        

    }


}

