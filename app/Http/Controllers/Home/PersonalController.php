<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Requests\StoreUsers;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;
use App\Models\Users;
use App\Models\Usersinfo;
use App\Models\Address;
use App\Models\Weds;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Collect;
use App\Models\GoodsSku;
use DB;
use Hash;


class PersonalController extends Controller
{

    public function Friendly()
    {
        return $friendly = DB::table('friendly')->where('lstatus',1)->get();
    }


    /**
     * 加载个人中心页面
     * @return [type] [HTML页面]
     */
    public function Index(Request $request)
    {
        session_start();
        $friendly = self::Friendly();

        $kouwei = $request->input('a',0);
        $_SESSION ['flavor'] = $kouwei;
        $weds = weds::find(1);
        return view('home.personal.center',[
            'weds'=>$weds,
            'friendly'=>$friendly,
            ]);
    }


    /**
     * 加载购买页面
     * @return [type] [HTML页面]
     */
    public function IntroDuction(Request $request)
    {error_reporting(0);
        $friendly = self::Friendly();

        $user = Users::find(session('home_user')->id);

        $asd = $user->collect;
        foreach ($asd as $key => $v) {
            $collect[] = $v->gid;
        }
        $weds = weds::find(1);
        //商品id
        $gid = $request->input('id',0);
        //所属类Id
        $cid = $request->input('cid',0);
        $goods_sku = DB::table('goods_sku')->where('gid',$gid)->first();


        $goods_all = DB::table('goods_sku')->where('cid',$cid)->get();

        return view('home.personal.introduction',[
                'goods_sku'=>$goods_sku,
                'goods_all'=>$goods_all,
                'weds'=>$weds,
                'friendly'=>$friendly,
                'collect'=>$collect,
                ]);
    }
        /**
     * 加载搜索商品页面
     * @return [type] [HTML页面]
     */
    public function Search(Request $request)
    {
        $friendly = self::Friendly();

        $weds = weds::find(1);
        //商品id
        $id = $request->input('id',0);
        //所属类Id
        $goods_all = DB::table('goods_sku')->where('cid',$id)->paginate(4);
        $goods_count= DB::table('goods_sku')->where('cid',$id)->get();
        $num = count($goods_count);

        return view('home.personal.search',[
                'num'=>$num,
                'id'=>$id,
                'goods_all'=>$goods_all,
                'weds'=>$weds,
                'friendly'=>$friendly,
                ]);
    }
    /**
     * 加载收货地址页面
     * @return [type] [HTML页面]
     */
    public function Addres()
    {
        $friendly = self::Friendly();

        $weds = weds::find(1);
        $id = session('home_user')->id;
        $user = Address::where('uid',$id)->get();
        $address = json_decode($user,true);
        return view('home.personal.addres',[
            'address'=>$address,
            'weds'=>$weds,
            'friendly'=>$friendly,
            ]);
    }

    /**
     * 添加收货地址
     * @param Request $request [description]
     */
    public function ImplementAddres(Request $request)
    {
        $data = $request->all();
        $address = $data['s1'].'市'.$data['s2'].'省'.$data['s3'];
        $detailed = $data['address'];
        $addres = new Address;
        $addres->uid = session('home_user')->id;
        $addres->address = $address;
        $addres->detailed = $detailed;
        $addres->consignee = $data['consignee'];
        $addres->atel = $data['atel'];
        $addres->default = 0;
        $res = $addres->save();
        if ($res) {
            return redirect("/center/addres");
        }
    }


    /**
     * 删除收货地址
     * @param [type] $id [description]
     */
    public function DeleteAddress($id)
    {
        $res = DB::table('address')->where('id',$id)->delete();
        if ($res) {
            return 1;
        }else{
            return 2;
        }
    }

    /**
     * 加载修改地址页面
     * @param [type] $id [description]
     */
    public function UpdateAddress($id)
    {
        $friendly = self::Friendly();

        $weds = weds::find(1);
        $addres = Address::where('id',$id)->first();

        return view('home.personal.updateaddress',[
            'addres'=>$addres,
            'weds'=>$weds,
            'friendly'=>$friendly,
            ]);
    }

    /**
     * 执行修改地址
     * @param Request $request [description]
     */
    public function ImplementUpdateAddress(Request $request)
    {
        $data = $request->all();
        $address = $data['s1'].'市'.$data['s2'].'省'.$data['s3'];
        $flight = Address::find($data['id']);
        $flight->address = $address;
        $flight->consignee = $data['consignee'];
        $flight->atel = $data['atel'];
        $flight->detailed = $data['detailed'];
        $res = $flight->save();
        if ($res) {
            return redirect("/center/addres");
        }
    }

    /**
     * 设置默认地址
     * @param Request $request
     * @param [type]  $id      [需要设为默认的ID]
     */
    public function DefaultAddress(Request $request,$id)
    {

        $diz = DB::table('address')->where('default', '1')->first();

        $data = Address::find($diz->id);
        $data->default = 0;
        $res1 = $data->save();

        $flight = Address::find($id);
        $flight->default = 1;
        $res2 = $flight->save();

        if ($res1 && $res2) {
            return 1;
        }else{
            return 2;
        }

    }


    /**
     * 加载个人信息页面
     * @return [type] [HTML页面]
     */
    public function Information()
    {
        $friendly = self::Friendly();

        $weds = weds::find(1);
        return view('home.personal.information',[
            'weds'=>$weds,
            'friendly'=>$friendly,
            ]);
    }

    /**
     * 执行个人信息修改
     * @param Request $request [跳转页面]
     */
    public function ImplementInformation(Request $request)
    {
        $res = $request->all();

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

        $id = session('home_user')->id;
        $user = Users::find($id);
        $data = $request->all();
        $user->email = $data['email'];
        $user->name = $data['name'];
        $res1 = $user->save();

        $userinfo = usersinfo::where('uid',$id)->first();
        $userinfo->email = $data['email'];
        $userinfo->ufile = $file;
        $userinfo->tel = $data['tel'];


        $res2 = $userinfo->save();
        if ($res1 && $res2) {
            DB::commit();
            $user_data = Users::where('id', $id)->first();
            session(['home_user'=>$user_data]);
            return redirect("/center/information");
        }else{
            DB::rollBack();
            return redirect("/center/information");
        }
    }


    /**
     * 加载修改密码页面
     * @return [type] [description]
     */
    public function Password()
    {
        $friendly = self::Friendly();

        $weds = weds::find(1);
        return view('home.personal.password',[
            'weds'=>$weds,
            'friendly'=>$friendly,
            ]);
    }

    /**
     * 执行修改密码
     * @param Request $request [description]
     */
    public function ImplementPassword(Request $request)
    {
        $data = $request->all();
        $upass = $data['upass'];
        $user = Users::find(session('home_user')->id);
        if (empty($data['password'])) {
            return 2;
            die;
        }

        if(strlen($data['password'])<6){
            //检测用户密码的长度是否小于6
            return 3;
            exit;
        }

        if (!Hash::check($upass,$user->password)) {
            return 1;
            exit;
        }
        $user->password = Hash::make($upass);
        $res = $user->save();
        if ($res) {
            return 4;
        }
    }




    /**
     * 加载收藏页面
     * @return [type] [description]
     */
    public function Collection()
    {
        $user = Users::find(session('home_user')->id);
        $good = GoodsSku::get();
        $collect = $user->collect;
        $friendly = self::Friendly();
        $weds = weds::find(1);
        return view('home.personal.collection',[
            'weds'=>$weds,
            'friendly'=>$friendly,
            'collect'=>$collect,
            'good'=>$good,
            ]);
    }

    /**
     * 加载订单管理
     * @return [type] [description]
     */
    public function Order()
    {
        $friendly = self::Friendly();
        $weds = weds::find(1);
        $uid = session('home_user')->id;
        $order = Order::where('uid',$uid)->orderBy('created_at', 'desc')->paginate(99);
        $goods = GoodsSku::get();
        return view('home.personal.order',[
            'weds'=>$weds,
            'order'=>$order,
            'goods'=>$goods,
            'friendly'=>$friendly,
            ]);
    }

    /**
     * 评价管理
     * @return [type] [description]
     */
    public function Comment()
    {
        $friendly = self::Friendly();
        $weds = weds::find(1);
        return view('home.personal.comment',[
            'weds'=>$weds,
            'friendly'=>$friendly,
            ]);
    }

    /**
     *
     */
    /**
     * [用户订单详情页面]
     * @param [type] $id [订单ID]
     */
    public function Commoditydetails($id)
    {
        $friendly = self::Friendly();
        $weds = weds::find(1);
        $order = Order::find($id);
        $aid = $order->orderdetails->aid;
        // 收货地址
        $address = Address::find($aid);
        $goods = GoodsSku::get();
        return view('home.personal.commoditydetails',[
            'weds'=>$weds,
            'order'=>$order,
            'goods'=>$goods,
            'friendly'=>$friendly,
            'address'=>$address,
            ]);
    }
    /**
     * [用户确定收货]
     * @param [type] $id [订单ID]
     */
    public function ConfirmReceipt($id)
    {
        $order = OrderDetails::find($id);
        $order->dtype = 3;
        $res = $order->save();
        if ($res) {
            return 1;
        }else{
            return 2;
        }
    }

    /**
     * [用户删除订单]
     * @param [int] $id [订单ID]
     */
    public function DeleteOrders($id)
    {
        $res1 = DB::table('order')->where('id',$id)->delete();
        $res2 = DB::table('order_details')->where('oid',$id)->delete();
        if ($res1 && $res2) {
            return 1;
        }else{
            return 2;
        }
    }

}
