<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Models\Weds;
use App\Http\Controllers\Controller;
use App\Models\Address;
use DB;
class PurchaseController extends Controller
{
    public function Index($id)
    {
        $gid = $id;
        $weds = weds::find(1);
        $id = session('home_user')->id;
        $user = Address::where('uid',$id)->get();
        $goods_sku = DB::table('goods_sku')->where('id',$gid)->first();
        $address = json_decode($user,true);
        return view('home.purchase.index',[
            'weds'=>$weds,
            'address'=>$address,
            'goods_sku'=>$goods_sku]
            );
    }

    public function ExecutePurchase(Request $request)
    {
        // 用户的地址id
        $aid =  $request->input('id');
    }

    public function jia(Request $request)
    {
        dump($request->all());
    }

    public function right(Request $request)
    {

    }
}
