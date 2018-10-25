<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Chapters extends Model
{
    //设置表名
    protected $table = 'chapters';
    public $timestamps = false;


   public function books()
    {
        return $this->belongsTo('App\Model\Books','book_id','id');
    }
}
