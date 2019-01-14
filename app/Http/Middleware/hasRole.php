<?php

namespace App\Http\Middleware;

use App\Model\Role;
use App\User;
use Closure;

class hasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

//    获取当前控制器方法名称


       $route =  \Route::current()->getActionName();
//        获取当前用户ID
       $user_id = session('user')->id;


//        获取当前用户权限
            //获取当前用户角色
        $roles = User::find($user_id)->roles;
        $arr = array();

        foreach ($roles as $k=>$role){

            $pers = $role->permissions;
//   //根据角色获取权限规则
            foreach ($pers as $n => $per){
                    $arr[] = $per->permission_url;
            }

        }
        $newarr = array_unique($arr);
//    dd($newarr);
//        dd($route);

        if(in_array($route,$newarr)){
                return $next($request);


        }else {
            return redirect('admin/nopermission');
        }


//        return $next($request);

    }
}
