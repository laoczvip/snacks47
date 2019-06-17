<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cates;
class CatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //显示商品分类列表
        
        $cates = Cates::where('pid',0)->paginate();
        return view('admin.cates.index',['cates'=>$cates,]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {   
        $pid = $request->input('id',0);

        if($pid){
            $cates = Cates::find($pid);
        } else {
            $cates['pid'] = null;
        }

       

        

        //显示商品添加类
        return view('admin.cates.create',['cates'=>$cates,]);
    }
    /**
     * Show the form for creating a new insert.
     *
     * @return cates add
     */
    public function insert(Request $request)
    {
        //商品添加类
        $data = $request->all('title');
        $pid = $request->input('pid',0);

        if($pid == 0){
            $data['pid'] = 0;
          
        } else {
            $path = Cates::find($pid);
            $data['pid'] = $pid;
           
        }
        $data['path'] = $path->path.$path->id.',';
        $data['status'] = 1;
        $data['add_time'] = date('Y-m-d H:i:s');
          $res = Cates::insert($data);
        if($res){
            return redirect("/admin/cates/create?id=$pid")->with('success','添加成功');
        } else {
            return back()->with('error','添加失败');
        }

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
     * 显示子类
     */
    public function show(Request $request)
    {
        $pid = $request->input('id',0);

        $cate = Cates::where('pid',$pid)->paginate(5);

        return view('admin.cates.show',['cate'=>$cate]);
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      
    }
        /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $cate = Cates::where('pid',$id)->first();
        
        if(empty($cate)){
             $cates =Cates::destroy($id);
               if($cates){
                    return redirect('admin.cates.index').with('success','删除成功');
               } else{
                    return back()->with('error','删除失败');
               }
        } else {
            return back()->with('error','该类含有子类');
        }
      
        
    }
}
