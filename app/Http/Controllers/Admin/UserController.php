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
     * @param Request $request [ 所有的用户 ]
     */
    public function Index(Request $request)
    {
        // 接收搜索参数
        $value = $request->input('value');
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
     *
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /**
     * 执行添加用户
     * @param StoreUsers $request [ 新的数据 ]
     */
    public function Store(StoreUsers $request)
    {
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
     * @param [ int ] $id [ 需要修改的ID ]
     */
    public function Edit($id)
    {
        $user = Users::find($id);
        // 加载修改页面
        return view('admin.user.edit',['user'=>$user]);
    }


    /**
     * 执行修改用户信息
     * @param Request $request [ 需要更新的字段 ]
     * @param [ int ]  $id      [ 需要修改的ID ]
     */
    public function Update(Request $request, $id)
    {
        DB::beginTransaction();
        // 获取头像

        if ($request->hasFile('ufile')) {
            // 如果用户用的是默认头像则不删除
            if ($request->input('file') == '/DefaultAvatar/1.jpg') {
                $file = $request->file('ufile')->store(date('Ymd'));
            }else{
                // 如果用户上传头像,删除原头像
                Storage::delete($request->input('file'));
                $file = $request->file('ufile')->store(date('Ymd'));
            }
        }else{
            $file = $request->input('file');
        }

        // 更新数据库信息
        $user = Users::find($id);
        $data = $request->all();
        $user->number = $data['number'];
        $user->name = $data['name'];
        $res1 = $user->save();

        // 更新用户详情表
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
     *
    */

    /**
     *  软删除列表
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
    * 恢复已被软删除用户
    * @param [ int ] $id [ 需要恢复的用户ID ]
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
     *
     * @param  [type] $id [description]
     * @return [type]     [description]
     */

    /**
     * 永久删除用户
     * @param [type] $id [description]
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
