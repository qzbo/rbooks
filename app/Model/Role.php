<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class Role extends Model
{

//    设置表名
    protected $table = 'roles';
//    设置表主键
    public  $primaryKey='role_id';

    public $timestamps = false;

    public function users()
    {

        return $this -> belongsToMany('App\User','user_role','role_id','user_id');


    }

    public function permissions()
    {

        return $this -> belongsToMany('App\Model\Permission','permission_role','role_id','permission_id');


    }




}
