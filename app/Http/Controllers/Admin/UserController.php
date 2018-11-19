<?php

namespace App\Http\Controllers\Admin;

use App\Model\Role;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * 后台用户管理
     * @author qzb
     * @return \Illuminate\Http\Response
     */
    // 用户展示页面
    public function index(Request $request)
    {
       // dd(session('user'));

        $num = $request->input('pagea')?$request->input('pagea'): 3;
        
        $input = $request->input('user')?$request->input('user'):'';
        // 用户名查询、每页显示条数（拼接）
        $user = User::where('username','like','%'.$input.'%')->paginate($num);

        $sex = ['女','男'];

        return view('admin/user/index',compact('user','sex','input','num'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // 展示后台添加用户的页面
    public function create()
    {
        //


        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //执行添加后台用户
    public function store(Request $request)
    {
        //1.接受前台用户传过来的数据
        $input = $request->except('_token');

        //2.对提交过来的数据进行表单验证，用户名必须输入而且在4-18位之间，密码必须输入而且在4-18位之间
        // Validator::make('要进行表单验证的数据','验证规则','设置提示信息')
        $rule=[
            'username'=>'required|between:4,18',
            'password'=>'required|between:4,18',
            'repassword'=>'required|same:password',
            'age'=>'regex:/\d+/',
            'phone'=>'regex:/1[3578]\d{9}/',
            'email'=>['regex:/^\w+\@[a-zA-Z0-9]+\.(com|cn|cc|net|co|top)$/']
        ];
        $msg = [
            'username.required'=>'用户名必须输入',
            'username.between'=>'用户名必须在4-18位之间',
            'password.required'=>'密码必须输入',
            'password.between'=>'密码必须在4-18位之间',
            'repassword.required'=>'确认密码必须输入',
            'repassword.same'=>'两次密码输入不一致',
            'age.regex'=>'年龄格式不正确',
            'phone.regex'=>'手机号码格式不正确',
            'email.regex'=>'邮箱地址格式不正确'

        ];

        //进行手工表单验证
        $validator = Validator::make($input,$rule,$msg);
        //如果验证失败
        if($validator->fails()) {
            return redirect('admin/user/create')
                ->withErrors($validator)
                ->withInput();

        }
        //3.执行数据库添加操作（向admins表添加一条记录）
        $user = new User();


        $user->username = $input['username'];

        $res = User::where('username',$user->username)->first();

        // dd($res);
        if($res){
            return redirect('admin/user/create')->with('用户添加失败,用户名不能相同');
        }

        $user->password = Hash::make($input['password']);

        // $user->nickname = $input['nickname'];
        $user->sex = $input['sex'];
        $user->age = $input['age'];
        $user->phone = $input['phone'];
        $user->email = $input['email'];

        $re = $user->save();

        //4.判断执行是否成功
        if ($re) {
            return redirect('admin/user');
        }else {
            return redirect('admin/user/create')->with('msg','用户添加失败');
        }

        //5.如果成功，跳转到列表页；如果失败，跳转到添加页继续添加
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         //后台的个人信息

        $user = User::find($id);

        return view('admin/user/info',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //获取要修改的那条记录
        $user = User::find($id);


    
        return view('admin/user/edit',compact('user'));
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

        //接收要修改的记录的内容和id
        $input_name = $request->input('username');
        $input_pwd = $request->input('password');
        $input_sex = $request->input('sex');
        $input_age = $request->input('age');
        $input_phone = $request->input('phone');
        $input_email = $request->input('email');

        $user = User::find($id);
  
        $user->username = $input_name;

        if($input_pwd == ""){

            $user->password = $user->password;

        }else {
            $user->password = Hash::make($input_pwd);

        }


        $user->sex = $input_sex;
        $user->age = $input_age;
        $user->phone = $input_phone;
        $user->email = $input_email;

        $re = $user->update();

        //4.判断执行是否成功
        if ($re) {
            return redirect('admin/user');
        }else {
            return redirect('admin/user/edit')->with('msg','用户信息修改失败');
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
        $user = User::find($id);

    
        //执行删除操作
        $res = $user->delete();
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
     public function checkuser(Request $request)
    {
        $input = $request -> except('_token');
        $type = $input['type'];
        $val = $input['val'];

        $res = User::where($type,$val)->first();
        if ($res) {
            if ($type == 'username') {
                $data = [
                    'status'=>0,
                    'msg'=>'此用户已经存在，请重新输入'
                ];
            } else {
                $data = [
                    'status'=>0,
                    'msg'=>'此邮箱已经存在，请重新输入'
                ];
            }
        } else {
            $data = ['status'=>1];
        }

        return $data;
    }

    public function repass()
    {

        //获取要修改密码的页面
        return view('admin/user/password');
    }

    public function dorepass(Request $request,$id)
    {
        //1.获取用户传过来的新密码
        $input = $request->all();
//        dd($input);

        //2.对提交过来的数据进行表单验证，用户名必须输入而且在4-18位之间，密码必须输入而且在4-18位之间
//        Validator::make('要进行表单验证的数据','验证规则','设置提示信息')
        $rule=[
            'password_o'=>'required|between:4,18',
            'password_n'=>'required|between:4,18',
            'repassword_n'=>'required|same:password_n'
        ];
        $msg = [
            'password_o.required'=>'原始密码必须输入',
            'password_o.between'=>'原始密码必须在4-18位之间',
            'password_n.required'=>'新密码必须输入',
            'password_n.between'=>'新密码必须在4-18位之间',
            'repassword_n.required'=>'确认密码必须输入',
            'repassword_n.between'=>'确认密码必须在4-18位之间'

        ];

        //进行手工表单验证
        $validator = Validator::make($input,$rule,$msg);
        //如果验证失败
        if($validator->fails()){
            return redirect('admin/repass')
                ->withErrors($validator)
                ->withInput();

        }
        //执行修改密码操作
        //判断原密码是否正确
        $user = User::find($id);

        if(!Hash::check($input['password_o'],$user->password) ){
            return redirect('admin/repass')->with('errors','原密码错误')->withInput();
        }
        //修改密码
        $user->password = Hash::make($input['password_n']);
        $re = $user->save();
        if($re){
            return redirect('admin/user')->with('msg','密码修改成功');
        }else{
            return redirect('admin/repass')->with('msg','密码修改失败');
        }
    }
    public function  auth(Request $request,$id)
    {
//  获取用户记录
    $users = User::find($id);
//  获取所有角色
    $roles = Role::get();
//  获取用户已经拥有的权限
    $own_roles= DB::table('user_role')->where('user_id','=',$id)->lists('role_id');

       return view('admin/user/auth',compact('users','roles','own_roles'));


    }

    public function doauth(Request $request){


//    $input = $request->except('_token');

    $user_id = $request->input('user_id');

    $roles = $request->input('role_id');

//    删除当前的用户的所有权限

        DB::table('user_role')->where('user_id',$user_id)->delete();


    foreach ($roles as $roles ){

        DB::table('user_role')->insert(['user_id'=>$user_id,'role_id'=>$roles]);




      }

        return redirect('admin/user');



    }



}
