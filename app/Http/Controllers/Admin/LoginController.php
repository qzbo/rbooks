<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;

require_once app_path().'/Http/Org/code/Code.class.php';
use App\Http\Org\code\Code;


use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use DB;

class LoginController extends Controller
{
    /**
     *返回一个登录页面
     * 登录、登出
     * @author qzb
     * @return 登录视图
     */
    public function login()
    {
        return view('admin.login');
    }
    
    // 验证码生成
    public function captcha($tmp)
    {
        $phrase = new PhraseBuilder;
        // 设置验证码位数
        $code = $phrase->build(4);
        // 生成验证码图片的Builder对象，配置相应属性
        $builder = new CaptchaBuilder($code, $phrase);
        // 设置背景颜色
        $builder->setBackgroundColor(220, 210, 230);
        $builder->setMaxAngle(25);
        $builder->setMaxBehindLines(0);
        $builder->setMaxFrontLines(0);
        // 可以设置图片宽高及字体
        $builder->build($width = 110, $height = 42, $font = null);
        // 获取验证码的内容
        $phrase = $builder->getPhrase();
        // 把内容存入session
        \Session::flash('code', $phrase);
        // 生成图片
        header("Cache-Control: no-cache, must-revalidate");
        header("Content-Type:image/jpeg");
        $builder->output();
    }

    //后台登录处理页
    public function dologin(Request $request)
    {
        //1.接手前台用户提交过来的数据
        $input = $request->except('_token');
        //2.对提交过来的数据进行表单验证，用户名必须输入而且在4-18位之间，密码必须输入而且在4-18位之间
//        Validator::make('要进行表单验证的数据','验证规则','设置提示信息')
        $rule=[
            'username'=>'required|between:4,18',
            'password'=>'required|between:4,18',
        ];
        $msg = [
            'username.required'=>'用户名必须输入',
            'username.between'=>'用户名必须在4-18位之间',
            'password.required'=>'密码必须输入',
            'password.between'=>'密码必须在4-18位之间'

        ];

        //进行手工表单验证
        $validator = Validator::make($input,$rule,$msg);
        //如果验证失败
        if($validator->fails()){
            return redirect('admin/login')
                ->withErrors($validator)
                ->withInput();

        }
        //3.0 验证码是否正确
        if($input['code'] != session('code')){
            return redirect('admin/login')->with('errors','验证码错误')->withInput();
        }
        //3.进行逻辑验证
        $user = User::where('username',$input['username'])->first();

        if (!$user){
            return redirect('admin/login')->with('errors','用户不存在')->withInput();
        }
        //3.2 密码是否正确
        if( !Hash::check($input['password'],$user->password)){
            return redirect('admin/login')->with('errors','密码不正确')->withInput();
        }

        //4.将登录用户的状态值保存到session中
        session(['user'=>$user]);
        //5.进入后台首页
        return redirect('/admin/user');
    }
//    public function index(){
//       return view('admin/user/index');
//
//    }

    public function loginOut()
    {
        Session::forget('user');

        if(Session::has('user')){
            $data=[
                'status'=>1,
                'msg'=>'退出登录失败'
            ];
        }else{
            $data=[
                'status'=>0,
                'msg'=>'退出登录成功'
            ];
        }

        return  $data;
    }
}
