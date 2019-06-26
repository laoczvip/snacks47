<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Models\Weds;
use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Order;
use App\Models\OrderDetails;
use DB;

class PurchaseController extends Controller
{
    public function Index(Request $request,$id)
    {
        session_start();
        $flavor = $_SESSION['flavor'];
        $gid = $id;
        $weds = weds::find(1);
        $id = session('home_user')->id;
        $user = Address::where('uid',$id)->get();
        $goods_sku = DB::table('goods_sku')->where('id',$gid)->first();
        $address = json_decode($user,true);
        return view('home.purchase.index',[
            'weds'=>$weds,
            'address'=>$address,
            'goods_sku'=>$goods_sku,
            'flavor'=>$flavor,
            ]);
    }

    /**
     * 付款成功,执行添加数据库
     * @param Request $request [description]
     */
    public function ExecutePurchase(Request $request)
    {
        DB::beginTransaction();
        // 用户的地址id
        $data = $request->all();
        $uid = session('home_user')->id;
        // 生成订单号
        $onum = date('YmdHis') . str_pad(mt_rand(1, 99999999), 5, '0', STR_PAD_LEFT);
        $order = new Order;
        $order->uid = $uid;
        $order->onum = $onum;
        $res1  = $order->save();
        if ($res1) {
            // 获取uid
            $oid = $order->id;
        }
        $orderdetails = new OrderDetails;
        $orderdetails->onum = $onum;
        $orderdetails->oid = $oid;
        $orderdetails->gid = $data['gid'];
        $orderdetails->number = $data['num'];
        $orderdetails->aid = $data['address'];
        $orderdetails->price = $data['price'];
        $orderdetails->lam = $data['lam'];
        $orderdetails->flavor = $data['flavor'];

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
     * 付款成功页面
     * @param Request $request [description]
     */
    public function Fukuancg(Request $request)
    {
        $address = DB::table('address')->find(session('aid'));
        $weds = weds::find(1);
        return view('home.purchase.fukuancg',[
            'weds'=>$weds,
            'address'=>$address,
            ]);
    }


}
