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
     * [ �������� ]
     */
    public function Friendly()
    {
        return $friendly = DB::table('friendly')->where('lstatus',1)->get();
    }


    /**
     * [ ���ظ�������ҳ�� ]
     * @return [type] [ HTMLҳ�� ]
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
     *�û�ͷ��ֵ
     *@return [type] [�û�ͷ��] 
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
     *�û����ָ�ֵ
     *@return [type] [�û�ͷ��] 
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
     * Display a listing of the resource.
     * ��ȡ��Ʒ��ζ
     * @return \Illuminate\Http\Response
     */
    public function Order_details()
    {
        //��Ʒ����
        $goods = DB::table('order_details')->get();
        $list = [];
        foreach($goods as $v){
            $list[$v->gid] = $v->flavor;
        }
        
        return $list;
    }
    
    /**
     * [ ���ع���ҳ�� ]
     * @return [ ��ͼ ] [ HTMLҳ�� ]
     */
    public function IntroDuction(Request $request)
    {


        $weds = weds::find(1);
        error_reporting(0);
        $friendly = self::Friendly();

        $user = Users::find(session('home_user')->id);

        $count = ShopcartController::CountCar();
        // �û�ͷ��
        $User_Ufile = PersonalController::User_Ufile();

        // �û�����
        $User_Name = PersonalController::User_Name();

        // ��Ʒ��ζ
        $Order_details = PersonalController::Order_details();
        
        // ��ȡ��Ʒ�ղ�
        $asd = $user->collect;

        // �������,�����ж��û��Ƿ��Ѿ��ղظ���Ʒ
        foreach ($asd as $key => $v) {
            $collect[] = $v->gid;
        }

         // ��Ʒid
        $gid = $request->input('ids',0);
        $gids = $request->input('gids',0);
        // ������Ʒ����id
        $id = $request->input('id',0);
        // ���id
        $sid = $request->input('sid',0);

        if($id != 0){
            $comment_gid = $id;
        } else {
            $comment_gid = 0;
        }
        // dd($comment_gid);
        // ��ȡ�����Ʒ����
        $comment = DB::table('comment')->where('gid',$comment_gid)->get();
        $haoping = 0;
        $zhongping = 0;
        $chaping = 0;
        $haopingdu = 0;
        foreach($comment as $v){
            if($v->rank==1){
                // ������
                $haoping = count($v->rank);
            } else if($v->rank==2){
                // ������
                $zhongping = count($v->rank);
            } else if($v->rank==3){
                 // ������
                $chaping = count($v->rank);
            }
           
        }
        // ������
        $haopingdu = ($haoping+$zhongping+$chaping)/3;
        $haopingdu = $haopingdu * 100 ;
        $haopingdu = round($haopingdu,1);
        // �ж��������Ƿ�Ϊ���Ʒ
        if ($sid != 0) {
            $shaky_one = DB::table('shaky')->where('id',$sid)->first();
            $date = date('Y-m-d H:i:s',time());
            $ctime = $shaky_one->ctime;
            $jtime = $shaky_one->jtime;

            if ($ctime > $date) {
                echo json_encode('�δ����');

            }else if($ctime<$date&&$jtime<$date){
                echo json_encode('��ѽ���');
            }
        }

        if ($gid != 0) {
        //������Id
        $goods_sku = DB::table('goods_sku')->where('gid',$gid)->first();

        $cid = $goods_sku->cid;
        $shaky_sku = false;
        $goods_all = DB::table('goods_sku')->where('cid',$cid)->paginate(10);
        //��Ʒ����
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
         //������Id

        $goods_sku = DB::table('goods_sku')->where('gid',$gids)->first();
        $shaky_sku = DB::table('shaky_sku')->where('gid',$gids)->first();
        //��Ʒ����
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
     * [ ����������Ʒҳ�� ]
     * @param Request $request [ �������� ]
     */
    public function Search(Request $request)
    {
        // ������������Ϣ
        $title =$request->input('title','');
        // ��������
        $buys = $request->input('buy',0);
       // ���ռ۸�
        $prices = $request->input('price',0);
        // ��������
        $assess = $request->input('assess',0);


        $friendly = self::Friendly();

        $weds = weds::find(1);
        //��Ʒid
        $id = $request->input('id',0);
        if ($title!='') {
            //��������
            $goods_all = DB::table('goods_sku')->where('title','like','%'.$title.'%')->paginate(20);
        } else if($id!=0){
            // ������
            $goods_all = DB::table('goods_sku')->where('cid',$id)->paginate(20);
        } else if($buys!=0){
            $goods_all = DB::table('goods_sku')->orderBy('buy','desc')->paginate(20);

        } else {
            //��������
            $goods_all = DB::table('goods_sku')->paginate(20);
        }
        if($prices != 0){

            $goods_all = DB::table('goods_sku')->orderBy('price','asc')->paginate(20);
        }
        if($assess != 0){

            $goods_all = DB::table('goods_sku')->orderBy('assess','desc')->paginate(20);
        }
        //������Id
        if($id !=0 ){
            $goods_count= DB::table('goods_sku')->where('cid',$id)->get();
        } else{
             $goods_count= DB::table('goods_sku')->where('title','like','%'.$title.'%')->get();
        }
        $count = ShopcartController::CountCar();

        // ���ﳵ����
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
     * [ �����ջ���ַҳ�� ]
     * @return [ ��ͼ ] [ HTMLҳ�� ]
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
     * [ ����ջ���ַ ]
     * @param Request $request [ �����û����µ�ַ ]
     */
    public function ImplementAddres(Request $request)
    {


        $data = $request->all();
        // �ϲ���ַ
        $address = $data['s1'].'��'.$data['s2'].'ʡ'.$data['s3'];
        $detailed = $data['address'];

        // �������
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
     * [ ɾ���ջ���ַ ]
     * @param [ int ] $id [ ��ַ��ID ]
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
     * [ �����޸ĵ�ַҳ�� ]
     * @param  $id [��ַID]
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
     * [ ִ���޸ĵ�ַ ]
     * @param Request $request [ ��Ҫ�޸ĵ����� ]
     */
    public function ImplementUpdateAddress(Request $request)
    {


        $data = $request->all();
        $address = $data['s1'].'��'.$data['s2'].'ʡ'.$data['s3'];
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
     * [ ����Ĭ�ϵ�ַ ]
     * @param Request $request
     * @param [int]  $id      [ ��Ҫ��ΪĬ�ϵ�ID ]
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
     * [ ���ظ�����Ϣҳ�� ]
     * @return [type] [HTMLҳ��]
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
     * [ ִ�и�����Ϣ�޸� ]
     * @param Request $request [��תҳ��]
     */
    public function ImplementInformation(Request $request)
    {
        $res = $request->all();
        DB::beginTransaction();


        // �����û���ͷ��
        if ($request->hasFile('ufile')) {
                // ɾ��ԭͼ
            if ($request->input('file') == '/DefaultAvatar/1.jpg') {
                $file = $request->file('ufile')->store(date('Ymd'));
            }else{
                $file = strstr($_FILES['ufile']['name'],'.');


                $allow = ['.png','.jpeg','.gif','.jpg'];

                if (!in_array($file,$allow)) {
                    return back()->with('error','���ϴ�ͼƬ�ļ�!');
                }
                if($_FILES['ufile']['error'] == 1){
                    return back()->with('error','ͼƬ���ܴ���2M');
                }


                Storage::delete($request->input('file'));
                $file = $request->file('ufile')->store(date('Ymd'));
            }
        }else{
            $file = $request->input('file');
        }

        // ѹ������
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
            return back()->with('success','�޸ĳɹ�');
        }else{
            DB::rollBack();
            return back()->with('error','�޸�ʧ��!���Ժ�����');
        }
    }



    /**
     * [ �����޸�����ҳ�� ]
     * @return [ HTML ] [ ��ͼ ]
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
     * [ ִ���޸����� ]
     * @param Request $request [ �����û��������� ]
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
            //����û�����ĳ����Ƿ�С��6
            return 3;
            exit;
        }

        // �������
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
     * [ �����ղ�ҳ�� ]
     * @return [ HTMl ] [ �ղ�ҳ�� ]
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
     * [ ���ض������� ]
     * @return [ HTML object ] [ ��ͼ,�������� ]
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
     * ���۹���
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
     * [ �û���������ҳ�� ]
     * @param [int] $id  [ ����ID ]
     * @param [int] $aid [ ��ַID ]
     */
    public function Commoditydetails($id,$aid)
    {
        if (!session('type')) {
            return redirect("/login");
        };

        $count = ShopcartController::CountCar();

        $friendly = self::Friendly();

        $weds = weds::find(1);
        // �ջ���ַ

        $address = Address::find($aid);

        $order = OrderDetails::where('oid',$id)->get();

        // ֱ�ӷ������
        foreach ($order as $key => $v) {
            // ����״̬
            $dtype = $v->dtype;
            // �޸�ʱ��
            $updated_at = $v->updated_at;
            // ����
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
     * [ �û�ȷ���ջ� ]
     * @param [ int ] $id [����ID]
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
        // �޸�״̬Ϊ3 ( ���ջ� )
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
     * [ �û�ɾ������ ]
     * @param [ int ] $id [ ����ID ]
     */
    public function DeleteOrders($id)
    {
        // ɾ������
        $res1 = DB::table('order')->where('id',$id)->delete();
        $res2 = DB::table('order_details')->where('oid',$id)->delete();
        if ($res1 && $res2) {
            return 1;
        }else{
            return 2;
        }
    }

}
