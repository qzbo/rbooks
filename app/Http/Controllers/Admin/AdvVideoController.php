<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Model\Adv;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;



class AdvVideoController extends Controller
{
    //

    public function advvidadd()
    {
        

        return view('admin/adv/add');


    }
    public function doadvvidadd(Request $request)
    {
//接收表单数据
        $input = $request->except('_token');

        if (!$request -> hasFile('video')) {
             return back()->with('errors', '请选择文件')->withInput();
         }
        
        
       $rule=[
            'name'=>'required',
            'video'=>'required',
            'urla'=>'required',
            'urla'=>['regex:/^((ht|f)tps?):\/\/[\w\-]+(\.[\w\-]+)+([\w\-\.,@?^=%&:\/~\+#]*[\w\-\@?^=%&\/~\+#])?$/']
        ];
        $msg = [
            'name.required'=>'标题名称必须输入',
            'video.required'=>'请选择视频',
            'urla.required'=>'url必须输入',
            'urla.regex'=>'url格式不正确'
        ];

        //进行手工表单验证
            $validator = Validator::make($input,$rule,$msg);
        //如果验证失败
            if ($validator->fails()) {
                return redirect('admin/advvid/doadd')
                    ->withErrors($validator)
                    ->withInput();
            }   
             

            $file = $input['video'];

            $entension = $file->getClientOriginalExtension();//上传文件的后缀名
            $file_type = $file->getClientMimeType();
            $filesize = $file->getClientSize();

            $file_size = $filesize / (1024 *1024) ;

            // dd($entension);
            if ($entension != 'mp4' && $entension != 'mov' && $entension != 'avi') {
                # code...
                  return back()->with('errors', '请输入mp4|mov|avi格式的视频')->withInput();

            }

            $newName = date('YmdHis') . mt_rand(1000, 9999) . '.' . $entension;
            $time = date('Ymd',time());
            //本地服务器保存视频
            $path = $file->move(public_path().'/uploads/videos'."/$time/",$newName);


            $adv = new Adv();                                                                                                                                    
            $adv -> name = $input['name'];
            $adv -> url = $input['urla'];
            $adv -> status = $input['status'];
            $adv-> ctime = time();
            $adv-> video = '/uploads/videos'."/$time/".$newName;
            $adv -> isvi = 2;


            $res = $adv -> save();
       

        if ($res) {
            return redirect('admin/adv');
        } else {
            return back()->with('errors','添加板块失败');
        }

    }
    public function update($id)
    {
    	# code...
    	$res = Adv::find($id);



    	return view('admin/adv/update',compact('res'));
    }

    public function doupdate(Request $request ,$id)
    {

    	dd(123);

    	# code...
    	    //接收表单数据
        $input = $request->except('_token','_method');
      
         $rule=[
            'name'=>'required',
            // 'video'=>'required',
            'urla'=>'required',
            'urla'=>['regex:/^((ht|f)tps?):\/\/[\w\-]+(\.[\w\-]+)+([\w\-\.,@?^=%&:\/~\+#]*[\w\-\@?^=%&\/~\+#])?$/']
        ];
        $msg = [
            'name.required'=>'标题名称必须输入',
            // 'video.required'=>'请选择图片',
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
        if (!$request -> hasFile('video')) {
            //    
            $adv ->image =  $adv ->image;
            
        } else{ 
            
           $file = $input['video'];

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


}
