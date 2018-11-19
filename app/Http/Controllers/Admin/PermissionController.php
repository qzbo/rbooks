<?php

namespace App\Http\Controllers\Admin;

use App\Model\Permission;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $num = $request->input('pages')?$request->input('pages'): 5;

        $input = $request->input('permission_name')?$request->input('permission_name'):'';
        // 用户名查询、每页显示条数（拼接）
        $res = Permission::where('permission_name','like','%'.$input.'%')->paginate($num);


        return view('admin/permission/index',compact('res','num','input'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('admin/permission/create');


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
//dd($request->all());

        $data = $request->except('_token');

        $names = $data['permission_name'];
        $name = Permission::where('permission_name',$names)->first();
        if($name){

            return back()->with('errors','权限名称已存在请重新输入');
        }


        $rule=[
            'permission_name'=>'required',
            'permission_url'=>'required',
//            'permission_url'=>'regex:/^\D@\D$/',
            'permission_description'=>'required'
        ];
        $msg = [
            'permission_name.required'=>'权限名称必须输入',
            'permission_url.required'=>'方法名称必须输入',
            'permission_description.required'=>'权限描述必须输入',
//            'permission_url.regex'=>'方法码格式不正确',

        ];

        //进行手工表单验证
        $validator = Validator::make($data,$rule,$msg);
        //如果验证失败
        if ($validator->fails()) {
            return redirect('admin/permission/create')
                ->withErrors($validator)
                ->withInput();
        }


        $permission = new Permission();
        $permission->permission_name = $data['permission_name'];
        $permission->permission_url = "App\Http\Controllers\Admin\\".$data['permission_url'];
        $permission->permission_description = $data['permission_description'];
        $permission->permission_ctime = time();
        $res = $permission->save();

        if ($res){

            return redirect('admin/permission');
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
    $res = Permission::where('permission_id',$id)->first();


        return view('admin/permission/edit',compact('res'));
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
        //接收要修改的记录的内容和id
        $data = $request->input('permission_name');
        $data = $request->input('permission_url');
        $data = $request->input('permission_description');



        $data = $request->except('_token','_method');


        $rule=[
            'permission_name'=>'required',
            'permission_url'=>'required',
//            'permission_url'=>'regex:/^\D@\D$/',
            'permission_description'=>'required'
        ];
        $msg = [
            'permission_name.required'=>'权限名称必须输入',
            'permission_url.required'=>'方法名称必须输入',
            'permission_description.required'=>'权限描述必须输入',
//            'permission_url.regex'=>'方法码格式不正确',

        ];

        //进行手工表单验证
        $validator = Validator::make($data,$rule,$msg);
        //如果验证失败
        if ($validator->fails()) {
            return redirect('admin/permission/create')
                ->withErrors($validator)
                ->withInput();
        }




//        $per = Permission::where('permission_id',$id)->first();
//        $per = DB::table('permission')->where('permission_id',$id)->first();
//
//
//        $per->permission_name = $permission_name;
//        $per->permission_url = $permission_url;
//        $per->permission_description = $permission_description;

//        $res = $per->update();


       $res = DB::table('permission')
            ->where('permission_id',$id)
            ->update($data);

        if ($res){

            return redirect('admin/permission');
        }else {

            return back()->with('errors','修改失败');
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
        //
    }
}
