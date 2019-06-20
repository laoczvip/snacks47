<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUsers;
use App\Models\Users;
use App\Models\Usersinfo;
use Illuminate\Support\Facades\Storage;
use Hash;
use DB;


class UserController extends Controller
{
    /**
     * 加载用户列表页面
     *
     * @return \Illuminate\Http\Response
     */
    public function Index(Request $request)
    {
        // 接收搜索参数
        $value = $request->input('value');
        $type = $request->input('type');
        $users = Users::where('number','like','%'.$value.'%')->paginate(5);
        return view('admin.user.index',[
                    'users'=>$users,
                    'params'=>$request->all(),
            ]);
    }

    /**
     * 加载添加用户页面
     *
     * @return \Illuminate\Http\Response
     */
    public function Create()
    {
        return view('admin.user.create');
    }

    /**
     * 执行添加用户
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function Store(StoreUsers $request)
    {
        /*$this->validate($request, [
                'number' => 'required|regex:/^[a-zA-Z0-9]{4,16}$/',
                'ufile' => 'required',
                'email' => 'required',
                'pass' => 'required|regex:/^[\w]{6,18}/',
                'upass' => 'required|same:pass',
                'tel' => 'required|regex:/^1{1}[3-9]{1}[\d]{9}$/',
            ],[
                'number.required'=>'请输入用户名',
                'number.regex'=>'用户名格式错误',
                'email.required'=>'请输入邮箱',
                'upass.required'=>'请输入确认密码',
                'upass.same'=>'两次密码不一致',
                'tel.required'=>'请输入电话',
                'tel.regex'=>'手机号格式错误',
                'pass.regex'=>'密码格式错误',
                'pass.required'=>'请输入密码',
                'ufile.required'=>'请选择头像',
            ]);
        */
        DB::beginTransaction();

        //上传头像
        if ($request->hasFile('ufile')) {
            //创建文件上传对象
            $file_path = $request->file('ufile')->store(date('Ymd'));
        }else{
            $file_path = "";
        }
        
        $data = $request->all();
        $user = new Users;
        $user->number = $data['number'];
        $user->name = $data['number'];
        $user->type = $data['type'];
        $user->password = Hash::make($data['upass']);
        $user->token = str_random(30);
        $user->status = 1;
        $res1  = $user->save();
        if ($res1) {
            // 获取uid
            $uid = $user->id;
        }

        // 压入用户详情表
        $usersinfo = new Usersinfo;

        $usersinfo->uid = $uid;
        $usersinfo->ufile = $file_path;
        $usersinfo->tel = $data['tel'];
        $usersinfo->email = $data['email'];
        $res2 = $usersinfo->save();
        if ($res1 && $res2) {
            DB::commit();
            return redirect('admin/users')->with('success','添加成功');
        }else{
            DB::rollBack();
            return back()->with('error','添加失败');
        }
    }


    /**
     * 修改用户
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function Edit($id)
    {
        $user = Users::find($id);
        // 加载修改页面
        return view('admin.user.edit',['user'=>$user]);
    }

    /**
     * 修改用户信息
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function Update(Request $request, $id)
    {
        DB::beginTransaction();
        // 获取头像

        if ($request->hasFile('ufile')) {
            if ($request->input('file') == '/DefaultAvatar/1.jpg') {
                $file = $request->file('ufile')->store(date('Ymd'));
            }else{

                Storage::delete($request->input('file'));
                $file = $request->file('ufile')->store(date('Ymd'));
            }
        }else{
            $file = $request->input('file');
        }


        $user = Users::find($id);
        $data = $request->all();
        $user->number = $data['number'];
        $user->name = $data['name'];
        $res1 = $user->save();

        $userinfo = usersinfo::where('uid',$id)->first();
        $userinfo->email = $data['email'];
        $userinfo->ufile = $file;
        $userinfo->tel = $data['tel'];
        $res2 = $userinfo->save();
        if ($res1 && $res2) {
            DB::commit();
            return redirect('admin/users')->with('success','修改成功');
        }else{
            DB::rollBack();
            return back()->with('error','修改失败');
        }
    }

    /**
     * 用户删除
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function Destroy($id)
    {
        echo 'destroy';
    }

    /**
     * 软删除
    */
     public function SoftDeletion()
    {
        // 获取软删除
        $del_users = Users::onlyTrashed()->paginate(5);
        $del_usersinfo = Usersinfo::onlyTrashed()->paginate(5);
        return view('admin.user.soft',[
            'del_users'=>$del_users,
            'del_usersinfo'=>$del_usersinfo,

            ]);
    }

    /**
     * 软删除回复用户
     * @param  [type] $id [description]
     * @return [type]     [description]
    */
    public function Huifu($id)
    {
        $res1 = Users::withTrashed()->where('id',$id)->restore();
        $res2 = Usersinfo::withTrashed()->where('uid',$id)->restore();
        if ($res1 && $res2) {
            return '1';
        }else{
            return '0';
        }
    }

    /**
     * 删除用户
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function Del($id)
    {
        DB::beginTransaction();
        $res1 = Users::destroy($id);
        $res2 = Usersinfo::where('uid',$id)->delete();
        if ($res1 && $res2) {
            DB::commit();
            return "1";
        }else{
            DB::rollBack();
            return "2";
        }
    }


    /**
     * 永久删除
     * @return [type] [description]
     */
    public function Permanent($id)
    {
        $res1 = DB::table('user_info')->where('uid',$id)->delete();
        $res2 = DB::table('users')->where('id',$id)->delete();

        if ($res1 && $res2) {
            DB::commit();
            return "1";
        }else{
            DB::rollBack();
            return "2";
        }

    }
}
