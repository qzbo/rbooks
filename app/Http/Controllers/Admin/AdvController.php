<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Adv;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;


class AdvController extends Controller
{

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $num = $request->input('pagea')?$request->input('pagea'): 5;
        $isvi = $request->input('vi')?$request->input('vi'): '';
        
        $input = $request->input('name')?$request->input('name'):'';
        // 用户名查询、每页显示条数（拼接）
       $res = Adv::where('name','like','%'.$input.'%')->where('isvi','like','%'.$isvi.'%')->orderby('id','desc')->paginate($num);
        $sta = ['保密','启用','禁用'];

        $isvia = ['保密','图片','视频'];

        return view('admin/adv/index',compact('res','sta','isvia','num','input','isvi'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('admin/adv/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

   //接收表单数据
        $input = $request->except('_token');

        if (!$request -> hasFile('imgs')) {
             return back()->with('errors', '请选择图片')->withInput();
         }
        
        
       $rule=[
            'name'=>'required',
            'imgs'=>'required',
            'urla'=>'required',
            'urla'=>['regex:/^((ht|f)tps?):\/\/[\w\-]+(\.[\w\-]+)+([\w\-\.,@?^=%&:\/~\+#]*[\w\-\@?^=%&\/~\+#])?$/']
        ];
        $msg = [
            'name.required'=>'标题名称必须输入',
            'imgs.required'=>'请选择图片',
            'urla.required'=>'url必须输入',
            'urla.regex'=>'url格式不正确'
        ];

        //进行手工表单验证
            $validator = Validator::make($input,$rule,$msg);
        //如果验证失败
            if ($validator->fails()) {
                return redirect('admin/adv/create')
                    ->withErrors($validator)
                    ->withInput();
            }   
             

            $file = $input['imgs'];

            $entension = $file->getClientOriginalExtension();//上传文件的后缀名

            
              //   // $file_type = $file->getClientMimeType();
                // dd($file);
            // dd($entension);
            if ($entension != 'jpeg' && $entension != 'jpg' && $entension != 'png') {
                # code...
                  return back()->with('errors', '请输入jpeg|jpg|png格式的图片')->withInput();

            }
            $newName = date('YmdHis') . mt_rand(1000, 9999) . '.' . $entension;
            $time = date('Ymd',time());
            //本地服务器保存图片
            $path = $file->move(public_path().'/uploads/images'."/$time/",$newName);


            $adv = new Adv();                                                                                                                                    
            $adv -> name = $input['name'];
            $adv -> url = $input['urla'];
            $adv -> status = $input['status'];
            $adv-> ctime = time();
            $adv-> image = '/uploads/images'."/$time/".$newName;
            $adv -> isvi = 1;


            $res = $adv -> save();
       

        if ($res) {
            return redirect('admin/adv');
        } else {
            return back()->with('errors','添加板块失败');
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
        $res = Adv::find($id);

        // dd($res);

        return view('admin/adv/edit',compact('res'));
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

          //接收表单数据
        $input = $request->except('_token','_method');
      
         $rule=[
            'name'=>'required',
            // 'imgs'=>'required',
            'urla'=>'required',
            'urla'=>['regex:/^((ht|f)tps?):\/\/[\w\-]+(\.[\w\-]+)+([\w\-\.,@?^=%&:\/~\+#]*[\w\-\@?^=%&\/~\+#])?$/']
        ];
        $msg = [
            'name.required'=>'标题名称必须输入',
            // 'imgs.required'=>'请选择图片',
            'urla.required'=>'url必须输入',
            'urla.regex'=>'url格式不正确'
        ];

        //进行手工表单验证
            $validator = Validator::make($input,$rule,$msg);
        //如果验证失败
            if ($validator->fails()) {
                return redirect('admin/adv/'.$id.'/edit')
                    ->withErrors($validator)
                    ->withInput();
            }   

          $adv = Adv::find($id);   

        //检查是否上传了新图片,未上传的话不执行图片修改
        if (!$request -> hasFile('imgs')) {
            //    
            $adv ->image =  $adv ->image;
            
        } else{ 
            
           $file = $input['imgs'];

            $entension = $file->getClientOriginalExtension();//上传文件的后缀名
            // dd($entension);

            if ($entension != 'jpeg' && $entension != 'jpg' && $entension != 'png') {
                # code...
                  return back()->with('errors', '请输入jpeg|jpg|png格式的图片')->withInput();

            }
            $newName = date('YmdHis') . mt_rand(1000, 9999) . '.' . $entension;
            $time = date('Ymd',time());
            //本地服务器保存图片
            $path = $file->move(public_path().'/uploads/images'."/$time/",$newName);
            $adv-> image = '/uploads/images'."/$time/".$newName;

        }
                                                                                                                               
            $adv -> name = $input['name'];
            $adv -> url = $input['urla'];
            $adv -> status = $input['status'];
            $adv-> ctime = time();
          
            $adv -> isvi = 1;


            $res = $adv -> update();
       

        if ($res) {
    
            return redirect('admin/adv');
        } else {
    
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
        //查询要删除的记录的模型
        $adv = Adv::find($id);

    
        //执行删除操作
        $res = $adv->delete();
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

      // 修改禁用
    public function disable($id)
    {
        
        $re = Adv::where('id',$id)->update(['status'=>'2']); 
       
         if($re){
          $data=[
              'status'=>0,
              'msg'=>'修改成功'
          ];
        }else{
            $data=[
                'status'=>1,
                'msg'=>'修改失败'
            ];
        }
          return  $data;



    }
    // 修改为启用

     public function  Enable($id)
    {
        
        $re = Adv::where('id',$id)->update(['status'=>'1']); 
       
         if($re){
          $data=[
              'status'=>0,
              'msg'=>'修改成功'
          ];
        }else{
            $data=[
                'status'=>1,
                'msg'=>'修改失败'
            ];
        }
          
          return  $data;


        
    }






}
