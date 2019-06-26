<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Order;
use App\Models\OrderDetails;
use DB;
class OrdersController extends Controller
{
    /**
     * [订单页]
     */
    public function Index()
    {
        $order = Order::orderBy('created_at', 'desc')->get();
        foreach ($order as $key => $v) {

        }
        return view('admin.orders.index',['order'=>$order]);
    }
    /**
     * [订单详情页]
     * @param [type] $id [description]
     */
    public function Details($id)
    {
        $order = OrderDetails::where('oid',$id)->get();
        foreach ($order as $key => $v) {
            dump($v->usergood);
        }
        return view('admin.orders.details',['order'=>$order]);

    }
}
