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

        // 用户名查询、每页显示条数（拼接）
        $permission = Permission::get();

        $res = $this->arr2tree($permission);





        return view('admin/permission/index',compact('res'));

    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission = Permission::get();


        $res = $this->arr2tree($permission);



        return view('admin/permission/create',compact('res'));


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

//        dd($data);
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
        $permission->pid = $data['pid'];
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


    private  function arr2tree($tree, $rootId = 0,$level=1) {
        $return = array();
        foreach($tree as $leaf) {
            if($leaf['pid'] == $rootId) {
                $leaf["level"] = $level;
                foreach($tree as $subleaf) {
                    if($subleaf['pid'] == $leaf['permission_id']) {
                        $leaf['children'] = $this->arr2tree($tree, $leaf['permission_id'],$level+1);
                        break;
                    }
                }
                $return[] = $leaf;
            }
        }
        return $return;
    }

}
