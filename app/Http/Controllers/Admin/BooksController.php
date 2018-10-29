<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Books;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Input;


// use App\Models\Chapters;
use DB;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *  书籍信息管理
     * @author qzb
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        // 页面展示数据条数
        $num = $request->input('pages')?$request->input('pages'): 5;
        // 页面书名搜索
        $input = $request->input('books')?$request->input('books'):'';
        // 页面作者姓名搜索
        $author = $request->input('author')?$request->input('author'):'';
        // 获取数据
        $res = BOOKS::where('booksname','like','%'.$input.'%')->where('author','like','%'.$author.'%')->paginate($num);
        // 是否是会员书籍
        $isvip = ['','免费','VIP'];
        // 是否推荐
        $isrecommend=['不推荐','推荐'];

    	return view('admin/books/index',compact('res','isvip','isrecommend','input','num'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $books = BOOKS::find($id);


        return view('admin/books/edit',compact('books'));
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
    
        // $books = BOOKS::find($id);

      //接收传来的数据并修改

        //接收表单数据
        $input = $request->except('_token','bimg','_method');

        $rule=[
            'booksname'=>'required',
            'author'=>'required'
        ];
        $msg = [
            'booksname.required'=>'书籍名称名必须输入',
            'author.required'=>'作者姓名必须输入'
        ];

        //进行手工表单验证
        $validator = Validator::make($input,$rule,$msg);
        //如果验证失败
        if ($validator->fails()) {
            return redirect('admin/books/'.$id.'/edit')
                ->withErrors($validator)
                ->withInput();
        }



        $books = Books::find($id);

        $books -> booksname = $input['booksname'];
        $books -> author = $input['author'];

        //检查是否上传了新图片,未上传的话不执行图片修改
        if ($request -> hasFile('bimg')) {
            //    
            $books -> bimg = $input['bimg'];
            
        }

        $books -> publishing = $input['publishing'];
        $books -> synopsis = $input['synopsis'];
        $books -> Publishing_attributes = $input['Publishing_attributes'];
        $books -> isvip = $input['isvip'];
        $books -> isrecommend = $input['isrecommend'];

        $res = $books -> save();

        if ($res) {
            return redirect('admin/books');
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
        // 开启事物
        DB::beginTransaction();

        try { 
        //查询要删除的记录的模型
        $books = BOOKS::find($id);
        //执行删除操作
        $resb = $books->delete();
        //执行删除操作
        $resc = $books->booksdetail()->delete();

        if($resb && $resc){
            // 提交
            DB::commit();
           $data=[
                'status'=>0,
                'msg'=>'删除成功'
            ];
            }
        } catch (\Exception $e) {
            // 回滚
            DB::rollBack();
            $data=[
                    'status'=>1,
                    'msg'=>'删除失败'
                ];
        }


        //   //查询要删除的记录的模型
        // $books = BOOKS::find($id);

        // $resb = $books->delete();
        // //执行删除操作
        // $resc = $books->booksdetail()->delete();

      


        // //根据返回的结果处理成功和失败
        // if($resb && $resc){
        //     　DB::commit(); 
        //     $data=[
        //         'status'=>0,
        //         'msg'=>'删除成功'
        //     ];
        // }else{
        //     DB::rollback(); 
        //     $data=[
        //         'status'=>1,
        //         'msg'=>'删除失败'
        //     ];
        // }

        return  $data;


    }

    // 修改VIP状态 改为是VIP
    public function vip($id)
    {
        
        $re = BOOKS::where('id',$id)->update(['isvip'=>'2']); 
       
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
    // 修改VIP状态 改为不是VIP

     public function fvip($id)
    {
        
        $re = BOOKS::where('id',$id)->update(['isvip'=>'1']); 
       
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
        // 修改推荐状态 为推荐

     public function recommend($id)
    {
        
        $re = BOOKS::where('id',$id)->update(['isrecommend'=>'1']); 
       
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
// 修改推荐状态 为不推荐

     public function frecommend($id)
    {
        
        $re = BOOKS::where('id',$id)->update(['isrecommend'=>'0']); 
       
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
