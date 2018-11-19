<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    //
//    设置表名
    protected $table = 'permission';
//    设置表主键
    public  $primaryKey='permission_id';

    public $timestamps = false;

    public function roles()
    {

       return $this -> belongsToMany('App\Model\Role','permission_role','permission_id','role_id');


    }

}
