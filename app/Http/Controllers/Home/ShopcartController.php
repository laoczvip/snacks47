<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Address;
use DB;
use App\Models\Weds;

class ShopcartController extends Controller
{
    /**
     * [ 加载购物车页面 ]
     */
    public function Index()
    {
        // 判断购物车里是否已经有商品
        if (!empty($_SESSION['car'])) {
            $data = $_SESSION['car'];
        }else{
            $data = [];
        }

        // 总价格
        $pricecount = self::PriceCount();
        $count = self::CountCar();
        $friendly = DB::table('friendly')->where('lstatus',1)->get();
        $weds = weds::find(1);
        return view('home.shopcar.index',[
            'weds'=>$weds,
            'friendly'=>$friendly,
            'data'=>$data,
            'pricecount'=>$pricecount,
            'count'=>$count,
            ]);
    }

    /**
     * [ 添加购物车 ]
     * @param Request $request [ 获取商品ID查询 ]
     * @param [ int ]  $id      [ 商品ID ]
     */
    public function ShopcartAdd(Request $request,$id)
    {
        if (empty($_SESSION['car'][$id])) {
            $data = DB::table('goods_sku')->select('id','title','showcase','price')->where('id',$id)->first();
            $flavor = $_SESSION ['flavor'];
            $data->num = 1;
            $data->flavor = $flavor;
            $data->xiaoji = ($data->price * $data->num);
            $_SESSION['car'][$id] = $data;
        }else{
            // 当前数量
            $_SESSION['car'][$id]->num = $_SESSION['car'][$id]->num + 1;
            $_SESSION['car'][$id]->xiaoji = ($_SESSION['car'][$id]->num * $_SESSION['car'][$id]->price);
        }
    }


    /**
     * [ 统计总数量 ]
     */
    public static function CountCar()
    {
        if (empty($_SESSION['car'])) {
            $count = 0;
        }else{
            $count = 0;
            foreach ($_SESSION['car'] as $key => $value) {
                $count += $value->num;
            }
        }

        return $count;
    }

    /**
     * [ 统计总价格 ]
     */
    public function PriceCount()
    {
        if (empty($_SESSION['car'])) {
            $pricecount = 0;
        }else{
            $pricecount = 0;
            foreach ($_SESSION['car'] as $key => $value) {
                $pricecount += $value->xiaoji;
            }
        }

        return $pricecount;
    }


    /**
     * [ 购物车添加数量 ]
     */
    public function AddNum(Request $request)
    {
        $id = $request->input('id');
        if (empty($_SESSION['car'])) {
            return back();
        }else{
            $n = $_SESSION['car'][$id]->num+1;
            $price = $_SESSION['car'][$id]->price;
            $_SESSION['car'][$id]->num  =$n;
            $_SESSION['car'][$id]->xiaoji  = ($n * $price);
            return back();
        }
    }

    /**
     * [ 购物车减少数量 ]
     */
    public function DescNum(Request $request)
    {
        $id = $request->input('id');
        if (empty($_SESSION['car'])) {
            return back();
        }else{
            if ($_SESSION['car'][$id]->num <= 1) {
                return back();
                die;
            }
            $n = $_SESSION['car'][$id]->num-1;
            $price = $_SESSION['car'][$id]->price;
            $_SESSION['car'][$id]->num  =$n;
            $_SESSION['car'][$id]->xiaoji  = ($n * $price);
            return back();
        }
    }

    /**
     * [ 购物车删除商品 ]
     * @param Request $request [ 获取购物车的ID ]
     */
    public function Delete(Request $request)
    {
        $id = $request->input('id');
        if (empty($_SESSION['car'][$id])) {
            return back();
        }else{
            unset($_SESSION['car'][$id]);
            return back();
        }
    }

    /**
     * [ 购物车结算页 ]
     */
    public function Payment()
    {
        if (!empty($_SESSION['car'])) {
            $data = $_SESSION['car'];
        }else{
            $data = [];
        }

        $flavor = $_SESSION['flavor'];
        $id = session('home_user')->id;
        $user = Address::where('uid',$id)->get();
        $pricecount = self::PriceCount();
        $address = json_decode($user,true);
        $pricecount = self::PriceCount();
        $friendly = DB::table('friendly')->where('lstatus',1)->get();
        $weds = weds::find(1);
        $count = self::CountCar();
        return view('home.shopcar.payment',[
            'count'=>$count,
            'pricecount'=>$pricecount,
            'weds'=>$weds,
            'friendly'=>$friendly,
            'address'=>$address,
            'data'=>$data,
            'pricecount'=>$pricecount,
            ]);
    }

    /**
     * [ 执行付款 ]
     * @param Request $request [ 获取订单信息 ]
     */
    public function AddDatabase(Request $request)
    {
        error_reporting(0);
        $aid = $request->input('address');
        $lam = $request->input('lam');
        $money = self::PriceCount();
        $onum = date('Ymd').str_pad(mt_rand(1, 99999999),5,'0',STR_PAD_LEFT);
        $created_at = date('Y-m-d H:i:s',time());
        $data['uid'] = session('home_user')->id;
        $data['onum'] = $onum ;
        $data['aid'] = $aid ;
        $data['money'] = $money;
        $data['created_at'] = $created_at;
        $oid = DB::table('order')->insertGetId($data);
        if ($_SESSION['car']) {
            $order = $_SESSION['car'];

            // 循环出所有购物车中的商品,逐条加入到数据库
            foreach ($order as $k => $v) {
                $temp['gid'] = $v->id;
                $temp['number'] = $v->num;
                $temp['oid'] = $v->num;
                $temp['flavor'] = $v->flavor;
                $temp['price'] = $v->xiaoji;
                $temp['onum'] = $onum;
                $temp['oid'] = $oid;
                $temp['lam'] = $lam;
                DB::table('order_details')->insert($temp);
                $asd  = DB::update("update  salesvolume  set  menuy=menuy+$money  where id=1");

                $_SESSION['car'] = null;
            }
        }
        $address = Address::find($aid);
        $weds = weds::find(1);

        $count = self::CountCar();
        $friendly = DB::table('friendly')->where('lstatus',1)->get();
        return view('home.shopcar.successfulpayment',[
            'friendly'=>$friendly,
            'money'=>$money,
            'weds'=>$weds,
            'count'=>$count,
            'address'=>$address,
            ]);
    }
}
