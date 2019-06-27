<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Order;
use App\Models\GoodsSku;
use App\Models\OrderDetails;
use DB;
class OrdersController extends Controller
{
    /**
     * [订单页]
     * @param Request $request [接收搜索内容]
     */
    public function Index(Request $request)
    {
        $value = $request->input('onum');
        $order = Order::where('onum','like','%'.$value.'%')->paginate(5);


        /*foreach ($order as $k => $v) {
            $diz = $v->address;
            foreach ($diz as $kk => $value) {
                dump($v->orderdetails->flavor);
            }
        }*/


        return view('admin.orders.index',['order'=>$order]);
    }
    /**
     * [订单详情页]
     * @param [type] $id [接收订单的ID查询订单详情]
     */
    public function Details($id)
    {
        $order = OrderDetails::where('oid',$id)->first();
        $gid = $order->gid;
        $aid = $order->aid;
        $goods = GoodsSku::find($gid);
        $address = Address::find($aid);
        return view('admin.orders.details',[
            'order'=>$order,
            'goods'=>$goods,
            'address'=>$address,
            ]);

    }
    /**
     * [后台发货按钮]
     * @param [type] $id [订单ID]
     */
    public function DeliverGoods($id)
    {
        $order = DB::table('order_details')->where('id',$id)->update(['dtype' => 1]);
        if ($order) {
            return 1;
        }else{
            return 2;
        }
    }
}
