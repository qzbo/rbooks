<?php

namespace App\Http\Controllers\Admin;

use App\Model\Permission;
use App\Model\Role;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $num = $request->input('pages')?$request->input('pages'): 5;

        $input = $request->input('role_name')?$request->input('role_name'):'';
        // 用户名查询、每页显示条数（拼接）
        $res = Role::where('role_name','like','%'.$input.'%')->paginate($num);


        return view('admin/role/index',compact('res','num','input'));



    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //



    return view('admin/role/create');


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //


        $data = $request->except('_token');

        $names = $data['role_name'];
        $name = Role::where('role_name',$names)->first();
        if($name){

            return back()->with('errors','用户组名称已存在请重新输入');
        }


        $rule=[
            'role_name'=>'required',
            'role_description'=>'required'
          ];
        $msg = [
            'role_name.required'=>'用户组名称必须输入',
            'role_description.required'=>'用户组描述必须输入',

        ];

        //进行手工表单验证
        $validator = Validator::make($data,$rule,$msg);
        //如果验证失败
        if ($validator->fails()) {
            return redirect('admin/role/create')
                ->withErrors($validator)
                ->withInput();
        }


        $role = new Role();
        $role->role_name = $data['role_name'];
        $role->role_description = $data['role_description'];
        $role->role_ctime = time();
        $res = $role->users()->save();

        if ($res){

            return redirect('admin/role');
        }else {

            return back()->with('errors','添加失败');
        }




    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        $res = Role::where('role_id',$id)->first();
//        $res = Role::find('role_id',$id);

//    dd($res);
        return view('admin/role/edit',compact('res'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $data = $request->except('_token');



        $rule=[
            'role_name'=>'required',
            'role_description'=>'required'
        ];
        $msg = [
            'role_name.required'=>'用户组名称必须输入',
            'role_description.required'=>'用户组描述必须输入',

        ];

        //进行手工表单验证
        $validator = Validator::make($data,$rule,$msg);
        //如果验证失败
        if ($validator->fails()) {
            return redirect('admin/role/create')
                ->withErrors($validator)
                ->withInput();
        }


        $role = Role::where('role_id',$id)->first();
        $role->role_name = $data['role_name'];
        $role->role_description = $data['role_description'];
        $res = $role->update();

        if ($res){

            return redirect('admin/role');
        }else {

            return back()->with('errors','添加失败');
        }









    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //查询要删除的记录的模型
        $role = Role::where('role_id',$id)->first();

        if ($id == 1){
            $data=[
                'status'=>1,
                'msg'=>'超级管理员不能删除'
            ];
            return  $data;
        }
        //执行删除操作
        $res = $role->delete();
        //根据返回的结果处理成功和失败
        if($res){
            $data=[
                'status'=>0,
                'msg'=>'删除成功'
            ];
        }else{
            $data=[
                'status'=>1,
                'msg'=>'删除失败'
            ];
        }

        return  $data;
    }

    // 添加后台用户时验证用户名与邮箱是否已用
    public function role_check(Request $request)
    {
        $input = $request -> except('_token');
        $val = $input['val'];

        $res = Role::where('role_name',$val)->first();
        if ($res) {

                $data = [
                    'status'=>0,
                    'msg'=>'此用户已经存在，请重新输入'
                ];
//
        } else {
            $data = ['status'=>1];
        }

        return $data;
    }




//    授权页面
    public function auth(Request $request,$id)
    {


//  获取用户记录
        $roles = Role::where('role_id',$id)->first();
//  获取所有角色
        $permissions = Permission::get();
//  获取用户已经拥有的权限
        $own_permissions= DB::table('permission_role')->where('role_id','=',$id)->lists('permission_id');

        return view('admin/role/auth',compact('roles','permissions','own_permissions'));


    }



    public function doauth(Request $request){


//    $input = $request->except('_token');

        $role_id = $request->input('role_id');

        $permissions = $request->input('permission_id');

//    删除当前的用户的所有权限

        DB::table('permission_role')->where('role_id',$role_id)->delete();


        foreach ($permissions as $permissions ){

            DB::table('permission_role')->insert(['role_id'=>$role_id,'permission_id'=>$permissions]);




        }

        return redirect('admin/role');



    }


}
