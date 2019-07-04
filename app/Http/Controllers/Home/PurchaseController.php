<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Models\Weds;
use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Http\Controllers\Home\ShopcartController;
use DB;

class PurchaseController extends Controller
{
    /**
     * [ 获取友情链接 ]
     */
    public function Friendly()
    {
        return $friendly = DB::table('friendly')->where('lstatus',1)->get();
    }

    /**
     * [ 加载下单页 ]
     * @param Request $request  [ 接收商品id 口味 ]
     * @param [ object ]  $id      [ 用户的收货地址 ]
     */
    public function Index(Request $request,$id)
    {
        $friendly = self::Friendly();

        $count = ShopcartController::CountCar();


        $flavor = $_SESSION['flavor'];
        $gid = $id;

        $weds = weds::find(1);
        $id = session('home_user')->id;
        $user = Address::where('uid',$id)->get();
        $goods_sku = DB::table('goods_sku')->where('gid',$gid)->first();
        $shaky_sku = DB::table('shaky_sku')->where('gid',$gid)->first();

        $address = json_decode($user,true);
        return view('home.purchase.index',[
            'weds'=>$weds,
            'address'=>$address,
            'goods_sku'=>$goods_sku,
            'friendly'=>$friendly,
            'flavor'=>$flavor,
            'count'=>$count,
            'shaky_sku'=>$shaky_sku,
            ]);
    }

    /**
     * [ 付款成功,执行添加数据库 ]
     * @param Request $request [ 接收用户购买的商品 ]
     */
    public function ExecutePurchase(Request $request)
    {
        DB::beginTransaction();
        // 用户的地址id
        $data = $request->all();
        if (empty($data['address'])) {
            return back();
        }
        $uid = session('home_user')->id;
        // 生成订单号
        $onum = date('Ymd').str_pad(mt_rand(1, 99999999),5,'0',STR_PAD_LEFT);

        // 添加数据库
        $order = new Order;
        $order->uid = $uid;
        $order->onum = $onum;
        $order->aid = $data['address'];
        $order->money = $data['price'];
        $res1  = $order->save();
        if ($res1) {
            // 获取uid
            $oid = $order->id;
        }
        $orderdetails = new OrderDetails;
        $orderdetails->onum = $onum;
        $orderdetails->oid = $oid;
        $orderdetails->gid = $data['gid'];
        $orderdetails->number = $data['num']+1;
        $orderdetails->price = $data['price'];
        $orderdetails->lam = $data['lam'];
        $orderdetails->flavor = $data['flavor'];

        // 把总价格的金钱
        DB::update("update salesvolume set menuy=menuy+".$data['price']."where id=1");
        DB::update("update goods_sku set buy=buy+1 where id=".$data['gid']);
        $res2  = $orderdetails->save();
        if ($res1 && $res2) {
            DB::commit();
            session(['aid'=>$data['address']]);
            session(['price'=>$data['price']]);
            return redirect('/ok');
        }else{
            DB::rollBack();
            return back();
        }


    }

    /**
     * [ 付款成功页面 ]
     * @param Request $request [ 用户下单的地址ID ]
     */

    public function Fukuancg(Request $request)
    {
        $count = ShopcartController::CountCar();

        $friendly = self::Friendly();
        $address = DB::table('address')->find(session('aid'));
        $weds = weds::find(1);
        return view('home.purchase.fukuancg',[
            'weds'=>$weds,
            'friendly'=>$friendly,
            'address'=>$address,
            'count'=>$count,
            ]);
    }

    /**
     * [ 添加新的收货地址 ]
     * @param Request $request [ 接收新的数据 ]
     */
    public function Addres(Request $request)
    {
        $data = $request->all();
        // 拼接用户的收货地址
        $address = $data['s1'].'市'.$data['s2'].'省'.$data['s3'];
        $detailed = $data['address'];
        // 添加到数据库
        $addres = new Address;
        $addres->uid = session('home_user')->id;
        $addres->address = $address;
        $addres->detailed = $detailed;
        $addres->consignee = $data['consignee'];
        $addres->atel = $data['atel'];
        $addres->default = 0;
        $res = $addres->save();
        if ($res) {
            return back();
        }
    }


}
