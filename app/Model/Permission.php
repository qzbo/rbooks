<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    //
//    设置表名
    protected $table = 'permission';
//    设置表主键
//    public  $primaryKey='role_id';

    public $timestamps = false;

    public function role()
    {

        return $this -> belongsToMany('App\Model','premission_role','role_id','permission_id');


    }

}
