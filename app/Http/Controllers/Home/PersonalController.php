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
use App\Http\Controllers\Home\ShopcartController;
use DB;
use Hash;


class PersonalController extends Controller
{

    /**
     * [ 友情链接 ]
     */
    public function Friendly()
    {
        return $friendly = DB::table('friendly')->where('lstatus',1)->get();
    }


    /**
     * [ 加载个人中心页面 ]
     * @return  [ HTML页面 ]
     */
    public function Index(Request $request)
    {

        if (!session('type')) {
            return redirect("/login");
        };

        $friendly = self::Friendly();

        $user = Users::find(session('home_user')->id);
        $count = ShopcartController::CountCar();

        $good = GoodsSku::get();

        $collect = $user->collect;
        $friendly = self::Friendly();

        $kouwei = $request->input('a',0);
        $_SESSION ['flavor'] = $kouwei;

        $weds = weds::find(1);
        return view('home.personal.center',[
            'weds'=>$weds,
            'friendly'=>$friendly,
            'count'=>$count,
            'user'=>$user,
            'good'=>$good,
            'collect'=>$collect,
            ]);
    }

    /**
     * [ 用户头像赋值 ]
     *@return [type] [ 用户头像 ]
     */
    public function User_Ufile()
    {
        $list = [];
        $user = DB::table('user_info')->get();
        foreach($user as $v){
            $list[$v->uid] = $v->ufile;
        }
        return $list;
    }

    /**
     *[ 用户名字赋值 ]
     *@return [type] [ 用户名称 ]
     */
    public function User_Name()
    {
        $list = [];
        $user = DB::table('users')->get();
        foreach($user as $v){
            $list[$v->id] = $v->name;
        }
        return $list;
    }

    /**
     * [ 获取商品口味 ]
     */
    public function Order_details()
    {
        //商品属性
        $goods = DB::table('order_details')->get();
        $list = [];
        foreach($goods as $v){
            $list[$v->gid] = $v->flavor;
        }

        return $list;
    }

    /**
     * [ 加载购买页面 ]
     * @return [ 视图  ] [ HTML页面 ]
     */
    public function IntroDuction(Request $request)
    {


        $weds = weds::find(1);
        error_reporting(0);
        $friendly = self::Friendly();

        $user = Users::find(session('home_user')->id);

        $count = ShopcartController::CountCar();
        // 用户头像
        $User_Ufile = PersonalController::User_Ufile();

        // 用户名称
        $User_Name = PersonalController::User_Name();

        // 商品口味
        $Order_details = PersonalController::Order_details();

        // 获取商品收藏
        $asd = $user->collect;

        // 分配变量,用于判断用户是否已经收藏该商品
        foreach ($asd as $key => $v) {
            $collect[] = $v->gid;
        }

         // 商品id
        $gid = $request->input('ids',0);
        $gids = $request->input('gids',0);
        // 接收商品详情id
        $id = $request->input('id',0);
        // 活动类id
        $sid = $request->input('sid',0);

        if($id != 0){
            $comment_gid = $id;
        } else {
            $comment_gid = 0;
        }

        // 读取相关商品评论
        $comment = DB::table('comment')->where('gid',$comment_gid)->get();
        $haoping = 0;
        $zhongping = 0;
        $chaping = 0;
        $haopingdu = 0;
        foreach($comment as $v){
            if($v->rank==1){
                // 好评数
                $haoping = count($v->rank);
            } else if($v->rank==2){
                // 中评数
                $zhongping = count($v->rank);
            } else if($v->rank==3){
                 // 差评数
                $chaping = count($v->rank);
            }

        }
        // 好评度
        $haopingdu = ($haoping+$zhongping+$chaping)/3;
        $haopingdu = $haopingdu * 100 ;
        $haopingdu = round($haopingdu,1);
        // 判断条件：是否为活动商品
        if ($sid != 0) {
            $shaky_one = DB::table('shaky')->where('id',$sid)->first();
            $date = date('Y-m-d H:i:s',time());
            $ctime = $shaky_one->ctime;
            $jtime = $shaky_one->jtime;

            if ($ctime > $date) {
                echo json_encode('活动未开启');

            }else if($ctime<$date&&$jtime<$date){
                echo json_encode('活动已结束');
            }
        }

        if ($gid != 0) {
        //所属类Id
        $goods_sku = DB::table('goods_sku')->where('gid',$gid)->first();

        $cid = $goods_sku->cid;
        $shaky_sku = false;
        $goods_all = DB::table('goods_sku')->where('cid',$cid)->paginate(10);
        //商品属性
        $flavour = DB::table('flavour')->get();
        $list = [];

        foreach($flavour as $k=> $val){
            $list[ $val->touch][] = $val->fname;
        }


        return view('home.personal.introduction',[
                'goods_sku'=>$goods_sku,
                'goods_all'=>$goods_all,
                'weds'=>$weds,
                'friendly'=>$friendly,
                'count'=>$count,
                'collect'=>$collect,
                'list'=>$list,
                'shaky_sku'=>$shaky_sku,
                'comment'=>$comment,
                'User_Ufile'=>$User_Ufile,
                'User_Name'=>$User_Name,
                'haoping'=>$haoping,
                'zhongping'=>$zhongping,
                'chaping'=>$chaping,
                'haopingdu'=>$haopingdu,
                'Order_details'=>$Order_details,
                ]);
        }
        if ($gids != 0) {
         //所属类Id

        $goods_sku = DB::table('goods_sku')->where('gid',$gids)->first();
        $shaky_sku = DB::table('shaky_sku')->where('gid',$gids)->first();
        //商品属性
        $flavour = DB::table('flavour')->get();
        $list = [];
        foreach($flavour as $k=> $val){
            $list[ $val->touch][] = $val->fname;
        }

        $cid = $goods_sku->cid;

        $goods_all = DB::table('goods_sku')->where('cid',$cid)->get();
         return view('home.personal.introduction',[
                'goods_sku'=>$goods_sku,
                'goods_all'=>$goods_all,
                'weds'=>$weds,
                'friendly'=>$friendly,
                'count'=>$count,
                'collect'=>$collect,
                'list'=>$list,
                'shaky_sku'=>$shaky_sku,
                'comment'=>$comment,
                'User_Name'=>$User_Name,
                'haoping'=>$haoping,
                'zhongping'=>$zhongping,
                'chaping'=>$chaping,
                'haopingdu'=>$haopingdu,
                'Order_details'=>$Order_details,
                ]);
        }
    }

    /**
     * [ 加载搜索商品页面 ]
     * @param Request $request [ 搜索内容 ]
     */
    public function Search(Request $request)
    {
        // 接收搜索框信息
        $title =$request->input('title','');
        // 接收销量
        $buys = $request->input('buy',0);
       // 接收价格
        $prices = $request->input('price',0);
        // 接收评价
        $assess = $request->input('assess',0);


        $friendly = self::Friendly();

        $weds = weds::find(1);
        //商品id
        $id = $request->input('id',0);

        if ($title!='') {
            //名称搜索
            $goods_all = DB::table('goods_sku')->where('title','like','%'.$title.'%')->paginate(20);
        } else if($id!=0){
            // 类搜索
            $goods_all = DB::table('goods_sku')->where('cid',$id)->paginate(20);
        } else if($buys!=0){
            $goods_all = DB::table('goods_sku')->orderBy('buy','desc')->paginate(20);

        } else {
            //搜索所有
            $goods_all = DB::table('goods_sku')->paginate(20);
        }
        if($prices != 0){

            $goods_all = DB::table('goods_sku')->orderBy('price','asc')->paginate(20);
        }
        if($assess != 0){

            $goods_all = DB::table('goods_sku')->orderBy('assess','desc')->paginate(20);
        }
        //所属类Id
        if($id !=0 ){
            $goods_count= DB::table('goods_sku')->where('cid',$id)->get();
        } else{
             $goods_count= DB::table('goods_sku')->where('title','like','%'.$title.'%')->get();
        }
        $count = ShopcartController::CountCar();

        // 购物车数量
        $num = count($goods_count);

        return view('home.personal.search',[
                'num'=>$num,
                'id'=>$id,
                'goods_all'=>$goods_all,
                'weds'=>$weds,
                'friendly'=>$friendly,
                'count'=>$count,
                'title'=>$title,
                ]);
    }

    /**
     * [ 加载收货地址页面 ]
     * @return [ 视图 ] [ HTML页面 ]
     */
    public function Addres()
    {
        if (!session('type')) {
            return redirect("/login");
        };

        $friendly = self::Friendly();
        $count = ShopcartController::CountCar();
        $weds = weds::find(1);
        $id = session('home_user')->id;
        $user = Address::where('uid',$id)->orderBy('default', 'desc')->get();
        $address = json_decode($user,true);
        return view('home.personal.addres',[
            'address'=>$address,
            'weds'=>$weds,
            'friendly'=>$friendly,
            'count'=>$count,
            ]);
    }

    /**
     * [ 添加收货地址 ]
     * @param Request $request [ 接收用户的新地址 ]
     */
    public function ImplementAddres(Request $request)
    {


        $data = $request->all();
        // 合并地址
        $address = $data['s1'].'ÊÐ'.$data['市'].'省'.$data['s3'];
        $detailed = $data['address'];

        // 添加数据
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
     * [  删除收货地址     ]
     * @param [ int ] $id [ 地址的ID ]
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
     * [ 加载修改地址页面 ]
     * @param  $id [ 地址ID ]
     */
    public function UpdateAddress($id)
    {
        if (!session('type')) {
            return redirect("/login");
        };

        $friendly = self::Friendly();
        $count = ShopcartController::CountCar();
        $weds = weds::find(1);
        $addres = Address::where('id',$id)->first();

        return view('home.personal.updateaddress',[
            'addres'=>$addres,
            'weds'=>$weds,
            'friendly'=>$friendly,
            'count'=>$count,
            ]);
    }

    /**
     * [ 执行修改地址 ]
     * @param Request $request [ 需要修改的数据 ]
     */
    public function ImplementUpdateAddress(Request $request)
    {


        $data = $request->all();
        $address = $data['s1'].'省'.$data['s2'].'市'.$data['s3'];
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
     * [ 用户设置默认地址 ]
     * @param Request $request
     * @param [int]  $id      [ 用户地址的ID ]
     */
    public function DefaultAddress(Request $request,$id)
    {

        if (!session('type')) {
            return redirect("/login");
        };

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
     * [ 加载个人信息页面 ]
     * @return [ 视图 ] [ HTML页面 ]
     */
    public function Information()
    {
        if (!session('type')) {
            return redirect("/login");
        };

        $friendly = self::Friendly();
        $count = ShopcartController::CountCar();
        $weds = weds::find(1);
        return view('home.personal.information',[
            'weds'=>$weds,
            'friendly'=>$friendly,
            'count'=>$count,
            ]);
    }

    /**
     * [ 执行个人信息修改 ]
     * @param Request $request [ 需要更新的信息 ]
     */
    public function ImplementInformation(Request $request)
    {
        $res = $request->all();
        DB::beginTransaction();


        // 假如用户换头像
        if ($request->hasFile('ufile')) {
                // 删掉原图
            if ($request->input('file') == '/DefaultAvatar/1.jpg') {
                $file = $request->file('ufile')->store(date('Ymd'));
            }else{
                $file = strstr($_FILES['ufile']['name'],'.');


                $allow = ['.png','.jpeg','.gif','.jpg'];

                if (!in_array($file,$allow)) {
                    return back()->with('error','请上传图片文件!');
                }
                if($_FILES['ufile']['error'] == 1){
                    return back()->with('error','文件不能大于2M');
                }


                Storage::delete($request->input('file'));
                $file = $request->file('ufile')->store(date('Ymd'));
            }
        }else{
            $file = $request->input('file');
        }

        // 执行修改信息
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
            return back()->with('success','修改成功');
        }else{
            DB::rollBack();
            return back()->with('error','修改失败,请稍后重试!!');
        }
    }



    /**
     * [ 加载修改密码页面 ]
     * @return [ HTML ] [ 视图 ]
     */
    public function Password()
    {
        if (!session('type')) {
            return redirect("/login");
        };

        $friendly = self::Friendly();
        $count = ShopcartController::CountCar();
        $weds = weds::find(1);
        return view('home.personal.password',[
            'weds'=>$weds,
            'friendly'=>$friendly,
            'count'=>$count,
            ]);
    }

    /**
     * [ 执行修改密码 ]
     * @param Request $request [ 接收用户的新密码 ]
     */

    public function ImplementPassword(Request $request)
    {
        if (!session('type')) {
            return redirect("/login");
        };

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

        // 密码加密
        if (!Hash::check($upass,$user->password)) {
            return 1;
            exit;
        }
        // 更新数据库信息
        $user->password = Hash::make($upass);
        $res = $user->save();
        if ($res) {
            return 4;
        }
    }




    /**
     * [ 加载收藏页面 ]
     * @return [ HTMl ] [ 收藏页 ]
     */
    public function Collection()
    {
        if (!session('type')) {
            return redirect("/login");
        };

        $user = Users::find(session('home_user')->id);

        $count = ShopcartController::CountCar();

        $good = GoodsSku::get();

        $collect = $user->collect;

        $friendly = self::Friendly();
        $weds = weds::find(1);
        return view('home.personal.collection',[
            'weds'=>$weds,
            'friendly'=>$friendly,
            'collect'=>$collect,
            'good'=>$good,
            'count'=>$count,
            ]);
    }

    /**
     * [ 加载订单管理 ]
     * @return [ HTML object ] [ 视图,订单数据 ]
     */

    public function Order()
    {
        if (!session('type')) {
            return redirect("/login");
        };

        $friendly = self::Friendly();
        $count = ShopcartController::CountCar();
        $weds = weds::find(1);
        $uid = session('home_user')->id;
        $order = Order::where('uid',$uid)->orderBy('created_at', 'desc')->paginate(99);
        $users = DB::table('comment')->where('uid',$uid)->get();
        $orders = Order::where('uid',$uid)->get();
        $list = [];
        foreach($users as $v){
            $list[$v->orderId]=$v->uid;
        }

        if($list==null){
            $list= [0];
        }

        $goods = GoodsSku::get();

        return view('home.personal.order',[
            'weds'=>$weds,
            'order'=>$order,
            'goods'=>$goods,
            'count'=>$count,
            'friendly'=>$friendly,
            'orders'=>$orders,
            'list'=>$list,
            ]);
    }

    /**
     * 评论页面
     * @return [type] [description]
     */
    public function Comment()
    {
        if (!session('type')) {
            return redirect("/login");
        };

        $count = ShopcartController::CountCar();
        $friendly = self::Friendly();
        $weds = weds::find(1);
        return view('home.personal.comment',[
            'weds'=>$weds,
            'friendly'=>$friendly,
            'count'=>$count,
            ]);
    }


    /**
     * [ 用户订单详情页面 ]
     * @param [int] $id  [ 订单ID ]
     * @param [int] $aid [ 地址ID ]
     */
    public function Commoditydetails($id,$aid)
    {
        if (!session('type')) {
            return redirect("/login");
        };

        $count = ShopcartController::CountCar();

        $friendly = self::Friendly();

        $weds = weds::find(1);

        // 获取用户的收货地址
        $address = Address::find($aid);

        $order = OrderDetails::where('oid',$id)->get();

        // 直接分配变量
        foreach ($order as $key => $v) {
            // 订单状态
            $dtype = $v->dtype;
            // 修改时间
            $updated_at = $v->updated_at;
            // 数量
            $onum = $v->onum;
        }

        return view('home.personal.commoditydetails',[
            'weds'=>$weds,
            'order'=>$order,
            'friendly'=>$friendly,
            'address'=>$address,
            'dtype'=>$dtype,
            'count'=>$count,
            'onum'=>$onum,
            'id'=>$id,
            'updated_at'=>$updated_at,
            ]);
    }
    /**
     * [ 用户确定收货 ]
     * @param [ int ] $id [ 订单ID ]
     */
    public function ConfirmReceipt($id)
    {
        if (!session('type')) {
            return redirect("/login");
        };

        $friendly = self::Friendly();
        $weds = weds::find(1);
        $order = Order::find($id);
        $order->otype = '3';
        $res = $order->save();
        // 修改状态为3 ( 已收货 )
        $res2 = DB::table('order_details')->where('oid',$id)->update(['dtype' => '3']);
        if ($res && $res2) {
            return  1;
        }else{
            return 2;
        }
        return view('home.personal.comment',[
            'weds'=>$weds,
            'friendly'=>$friendly,
            ]);
    }



    /**
     * [ 用户删除订单 ]
     * @param [ int ] $id [ 订单ID ]
     */
    public function DeleteOrders($id)
    {
        // 删除数据
        $res1 = DB::table('order')->where('id',$id)->delete();
        $res2 = DB::table('order_details')->where('oid',$id)->delete();
        if ($res1 && $res2) {
            return 1;
        }else{
            return 2;
        }
    }

}
