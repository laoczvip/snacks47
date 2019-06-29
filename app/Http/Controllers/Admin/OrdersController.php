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
        $type = $request->input('type');
        if ($type == 1) {
            $order = Order::where('onum','like','%'.$value.'%')->orderBy('created_at','desc')->paginate(8);
        }else if($type == 2) {
            $order = Order::where('otype','0')->where('onum','like','%'.$value.'%')->orderBy('created_at','desc')->paginate(8);
        }else if($type == 3) {
            $order = Order::where('otype','1')->where('onum','like','%'.$value.'%')->orderBy('created_at','desc')->paginate(8);
        }else if($type == 4) {
            $order = Order::where('otype','3')->where('onum','like','%'.$value.'%')->orderBy('created_at','desc')->paginate(8);
        }

        foreach($order as $k=>$v){
        }
        return view('admin.orders.index',[
            'order'=>$order,
            'params'=>$request->all(),
            'value'=>$value,
            ]);
    }
    /**
     * [订单详情页]
     * @param [type] $id [接收订单的ID查询订单详情]
     */
    public function Details($id,$aid)
    {
        $order = OrderDetails::where('oid',$id)->get();
        $address = Address::find($aid);
        $aorder = Order::find($id);
        $time  = $aorder->created_at;
        $dtype = $aorder->otype;

        foreach($order as $k=>$v){
            $lam = $v->lam;
        }
        return view('admin.orders.details',[
            'order'=>$order,
            'dtype'=>$dtype,
            'aorder'=>$aorder,
            'time'=>$time,
            'lam'=>$lam,
            'address'=>$address,
            ]);

    }
    /**
     * [后台发货按钮]
     * @param [type] $id [订单ID]
     */
    public function DeliverGoods($id)
    {
        $order = Order::find($id);
        $order->otype = '1';
        $res = $order->save();
        $res2 = DB::table('order_details')->where('oid',$id)->update(['dtype' => '1']);

        if ($res && $res2) {
            return 1;
        }else{
            return 2;
        }
    }
}
