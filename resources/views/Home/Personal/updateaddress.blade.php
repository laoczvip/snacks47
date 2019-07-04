<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">
        <title>地址管理</title>
        <link href="/h/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css">
        <link href="/h/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css">
        <link href="/h/css/personal.css" rel="stylesheet" type="text/css">
        <link href="/h/css/addstyle.css" rel="stylesheet" type="text/css">
        <script src="/h/AmazeUI-2.4.2/assets/js/jquery.min.js" type="text/javascript"></script>
        <script src="/h/AmazeUI-2.4.2/assets/js/amazeui.js"></script>
        <link rel="icon" href="/uploads/{{ $weds->icon }}"/>
        <script language="javascript" >
             // JS省市县三级联动

              function CLASS_LIANDONG(array)
              {
               //数组，联动的数据源
               this.array=array;
               this.indexName='';
               this.obj='';
               //设置子SELECT
             // 参数：当前onchange的SELECT id，要设置的SELECT id
                  this.subSelectChange=function(selectName1,selectName2)
               {
               //try
               //{
                var obj1=document.all[selectName1];
                var obj2=document.all[selectName2];
                var objName=this.toString();
                var me=this;

                obj1.onchange=function()
                {

                 me.optionChange(this.options[this.selectedIndex].value,obj2.id)
                }
               }
               //设置第一个SELECT
             // 参数：indexName指选中项,selectName指select的id
               this.firstSelectChange=function(indexName,selectName)
               {
               this.obj=document.all[selectName];
               this.indexName=indexName;
               this.optionChange(this.indexName,this.obj.id)
               }

              // indexName指选中项,selectName指select的id
               this.optionChange=function (indexName,selectName)
               {

                var obj1=document.all[selectName];

                if(selectName=="s2"){
                        document.all["s3"].length=0;
                        document.all["s3"].options[0]=new Option("请选择",'');
                    }

                var me=this;
                obj1.length=0;
                obj1.options[0]=new Option("请选择",'');
                for(var i=0;i<this.array.length;i++)
                {

                 if(this.array[i][1]==indexName)
                 {
                 //alert(this.array[i][1]+" "+indexName);
                  obj1.options[obj1.length]=new Option(this.array[i][2],this.array[i][0]);
                 }
                }
               }

              }
        </script>
    </head>

    <body>
        <!--头 -->
        @include('home.public.hmtop')
        <div class="nav-table">
                <div class="long-title"><span class="all-goods">全部分类</span></div>
                 <div class="nav-cont">
                      <ul>
                            <li class="index"><a href="/index.php">首页</a></li>
                      </ul>
                </div>
            </div>
        <b class="line"></b>

        <div class="center">
            <div class="col-main">
                <div class="main-wrap">

                    <div class="user-address">
                        <!--标题 -->
                        <div class="am-cf am-padding">
                            <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">地址管理</strong> / <small>Address&nbsp;list</small></div>
                        </div>
                        <hr/>
                        <div class="clear"></div>
                        <a class="new-abtn-type" data-am-modal="{target: '#doc-modal-1', closeViaDimmer: 0}">添加新地址</a>
                        <!--例子-->
                        <div class="am-modal am-modal-no-btn" id="doc-modal-1">

                            <div class="add-dress">

                                <!--标题 -->
                                <div class="am-cf am-padding">
                                    <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">修改地址</strong> / <small>Update&nbsp;address</small></div>
                                </div>
                                <hr/>

                                <div class="am-u-md-12 am-u-lg-8" style="margin-top: 20px;">
                                    <form class="am-form am-form-horizontal" action="/center/ImplementUpdateAddress" method="post">
                                         {{ csrf_field() }}
                                        <div class="am-form-group">
                                            <label for="user-name" class="am-form-label">收货人</label>
                                            <div class="am-form-content">
                                                <input type="text" id="user-name" name="consignee" value="{{ $addres->consignee }}" placeholder="收货人">
                                            </div>
                                        </div>
                                        <input type="hidden" name="id" value="{{ $addres->id }}">
                                        <div class="am-form-group">
                                            <label for="user-phone" class="am-form-label">手机号码</label>
                                            <div class="am-form-content">
                                                <input id="user-phone" name="atel" value="{{ $addres->atel }}" placeholder="手机号必填" type="text">
                                            </div>
                                        </div>
                                        <script type="text/javascript" src="/area.js"></script>
                                        <div class="am-form-group">
                                            <div class="am-form-content address" style="margin-left: -3px;">
                                                <label for="user-address" class="am-form-label" >所在地</label>
                                                 <select  id="s1" name="s1"  >
                                                    <option  selected></option>
                                                </select>

                                                <select  id="s2" name="s2"  >
                                                    <option selected></option>
                                                </select>

                                                <select  id="s3" name="s3">
                                                    <option selected></option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="am-form-group">
                                            <label for="user-intro" class="am-form-label">详细地址</label>
                                            <div class="am-form-content">
                                                <textarea class=""  style="resize:none;width: 571px;height: 73px;" rows="3" id="user-intro" name="detailed"  value="{{ $addres->address }}" placeholder="输入详细地址">{{ $addres->detailed }}</textarea>
                                                还可以输入<small id="word">100</small>字
                                            </div>
                                        </div>

                                        <div class="am-form-group">
                                            <div class="am-u-sm-9 am-u-sm-push-3">
                                                <input type="submit"  onclick="update()" class="am-btn am-btn-danger" value="保存">
                                                <a href="/center/addres"  class="am-close am-btn am-btn-danger" data-am-modal-close>取消</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>

                        </div>

                    </div>

                    <script type="text/javascript">
                        $(document).ready(function() {
                            $(".new-option-r").click(function() {
                                $(this).parent('.user-addresslist').addClass("defaultAddr").siblings().removeClass("defaultAddr");
                            });

                            var $ww = $(window).width();
                            if($ww>640) {
                                $("#doc-modal-1").removeClass("am-modal am-modal-no-btn")
                            }

                        })
                    </script>

                    <script>
                        // 地址输入框字数统计
                         $(function(){
                                $("#user-intro").keyup(function(){
                                    var len = $(this).val().length;
                                    if(len > 99){
                                        $(this).val($(this).val().substring(0,100));

                                        $("#word").text(0);

                                    }
                                    var num = 100 - len;
                                    if(num<0){
                                        $("#word").text(0);
                                        layer.msg('超出了我的范围了噢', {icon: 6});
                                    }else{
                                        $("#word").text(num);

                                    }
                                });
                        })


                            // 信息验证
                            function update(){
                                    let phome = $('#user-phone').val();
                                    let user = $('#user-name').val();
                                    let intro = $('#user-intro').val();
                                    let edit = $('#s3').val();

                                    let reg = /^1[34578]\d{9}$/;

                                    if(user == null || user == "" || user == undefined){
                                        layer.msg('请输入收货人', function(){

                                        } );
                                        event.preventDefault();

                                    }else if(phome == null || phome == "" || phome == undefined){
                                        layer.msg('请输入联系电话', function(){

                                        } );
                                        event.preventDefault();

                                    }else if(!reg.test(phome)){
                                        layer.msg('请输入正确的手机号码', function(){

                                        } );
                                        event.preventDefault();

                                    }else if( edit == null || edit == "" || edit == undefined ){
                                        layer.msg('请输选择城市', function(){

                                        } );
                                        event.preventDefault();

                                    }else if(intro == null || intro == "" || intro == undefined){
                                        layer.msg('请输入详细地址', function(){

                                        } );
                                       event.preventDefault();
                                    }
                            }


                    </script>

                    <div class="clear"></div>

                </div>
                <!--底部-->
        @include('home.public.footer')
            </div>
        @include('home.public.list')
        </div>
    </body>

    <!-- JS省市县三级联动 开始 -->
    <script language="javascript">
            //数据源
            var array=new Array();
            array[0]=new Array("北京","根目录","北京");//数据格式 id，父级id，名称
            array[1]=new Array("安徽","根目录","安徽");
            array[2]=new Array("福建","根目录","福建");
            array[3]=new Array("甘肃","根目录","甘肃");
            array[4]=new Array("广东","根目录","广东");
            array[5]=new Array("广西","根目录","广西");
            array[6]=new Array("贵州","根目录","贵州");
            array[7]=new Array("海南","根目录","海南");
            array[8]=new Array("河北","根目录","河北");
            array[9]=new Array("河南","根目录","河南");
            array[10]=new Array("黑龙江","根目录","黑龙江");
            array[11]=new Array("湖北","根目录","湖北");
            array[12]=new Array("湖南","根目录","湖南");
            array[13]=new Array("吉林","根目录","吉林");
            array[14]=new Array("江苏","根目录","江苏");
            array[15]=new Array("江西","根目录","江西");
            array[16]=new Array("辽宁","根目录","辽宁");
            array[17]=new Array("内蒙古","根目录","内蒙古");
            array[18]=new Array("宁夏","根目录","宁夏");
            array[19]=new Array("山东","根目录","山东");
            array[20]=new Array("山西","根目录","山西");
            array[21]=new Array("陕西","根目录","陕西");
            array[22]=new Array("上海","根目录","上海");
            array[23]=new Array("四川","根目录","四川");
            array[24]=new Array("天津","根目录","天津");
            array[25]=new Array("西藏","根目录","西藏");
            array[26]=new Array("新疆","根目录","新疆");
            array[27]=new Array("云南","根目录","云南");
            array[28]=new Array("浙江","根目录","浙江");
            array[29]=new Array("重庆","根目录","重庆");

            array[30]=new Array("北京市","北京","北京市")
            array[31]=new Array("北京市","北京市","北京市");
            array[32]=new Array("密云县","北京市","密云县");
            array[33]=new Array("延庆县","北京市","延庆县");

            array[34]=new Array("安庆","安徽","安庆");
            array[35]=new Array("蚌埠","安徽","蚌埠");
            array[36]=new Array("巢湖","安徽","巢湖");
            array[37]=new Array("池州","安徽","池州");
            array[38]=new Array("滁州","安徽","滁州");
            array[39]=new Array("阜阳","安徽","阜阳");
            array[40]=new Array("合肥","安徽","合肥");
            array[41]=new Array("淮北","安徽","淮北");
            array[42]=new Array("淮南","安徽","淮南");
            array[43]=new Array("黄山","安徽","黄山");
            array[44]=new Array("六安","安徽","六安");
            array[45]=new Array("马鞍山","安徽","马鞍山");
            array[46]=new Array("宿州","安徽","宿州");
            array[47]=new Array("铜陵","安徽","铜陵");
            array[48]=new Array("芜湖","安徽","芜湖");
            array[49]=new Array("宣城","安徽","宣城");
            array[50]=new Array("亳州","安徽","亳州");

            array[51]=new Array("安庆市","安庆","安庆市");
            array[52]=new Array("怀宁县","安庆","怀宁县");
            array[53]=new Array("潜山县","安庆","潜山县");
            array[54]=new Array("宿松县","安庆","宿松县");
            array[55]=new Array("太湖县","安庆","太湖县");
            array[56]=new Array("桐城市","安庆","桐城市");
            array[57]=new Array("望江县","安庆","望江县");
            array[58]=new Array("岳西县","安庆","岳西县");
            array[59]=new Array("枞阳县 ","安庆","枞阳县");

            array[60]=new Array("蚌埠市","蚌埠","蚌埠市");
            array[61]=new Array("固镇县","蚌埠","固镇县");
            array[62]=new Array("怀远县","蚌埠","怀远县");
            array[63]=new Array("五河县","蚌埠","五河县");

            array[64]=new Array("巢湖市","巢湖","巢湖市");
            array[65]=new Array("含山县","巢湖","含山县");
            array[66]=new Array("和县","巢湖","和县");
            array[67]=new Array("庐江县","巢湖","庐江县");
            array[68]=new Array("无为县","巢湖","无为县");

            array[69]=new Array("池州市","池州","池州市");
            array[70]=new Array("东至县","池州","东至县");
            array[71]=new Array("青阳县","池州","青阳县");
            array[72]=new Array("石台县","池州","石台县");

            array[73]=new Array("滁州市","滁州","滁州市");
            array[74]=new Array("定远县","滁州","定远县");
            array[75]=new Array("凤阳县","滁州","凤阳县");
            array[76]=new Array("来安县","滁州","来安县");
            array[77]=new Array("明光市","滁州","明光市");
            array[78]=new Array("全椒县","滁州","全椒县");
            array[79]=new Array("天长市","滁州","天长市");

            array[80]=new Array("阜南县","阜阳","阜南县");
            array[81]=new Array("阜阳市","阜阳","阜阳市");
            array[82]=new Array("界首市","阜阳","界首市");
            array[83]=new Array("临泉县","阜阳","临泉县");
            array[84]=new Array("太和县","阜阳","太和县");
            array[85]=new Array("颖上县","阜阳","颖上县");

            array[86]=new Array("长丰县","合肥","长丰县");
            array[87]=new Array("肥东县","合肥","肥东县");
            array[88]=new Array("肥西县","合肥","肥西县");

            array[89]=new Array("淮北市","淮北","淮北市");
            array[90]=new Array("濉溪县","淮北","濉溪县");

            array[91]=new Array("凤台县","淮南","凤台县");
            array[92]=new Array("淮南市","淮南","淮南市");

            array[93]=new Array("黄山市","黄山","黄山市");
            array[94]=new Array("祁门县","黄山","祁门县");
            array[95]=new Array("休宁县","黄山","休宁县");
            array[96]=new Array("歙县","黄山","歙县");
            array[97]=new Array("黟县","黄山","黟县");

            array[98]=new Array("霍邱县","六安","霍邱县");
            array[99]=new Array("霍山县","六安","霍山县");
            array[100]=new Array("金寨县","六安","金寨县");
            array[101]=new Array("六安市","六安","六安市");
            array[102]=new Array("寿县","六安","寿县");
            array[103]=new Array("舒城县","六安","舒城县");

            array[104]=new Array("当涂县","马鞍山","当涂县");
            array[105]=new Array("马鞍山市","马鞍山","马鞍山市");

            array[106]=new Array("灵璧县","宿州","灵璧县");
            array[107]=new Array("宿州市","宿州","宿州市");
            array[108]=new Array("萧县","宿州","萧县");
            array[109]=new Array("泗县","宿州","泗县");
            array[110]=new Array("砀山县","宿州","砀山县");

            array[111]=new Array("铜陵市","铜陵","铜陵市");
            array[112]=new Array("铜陵县","铜陵","铜陵县");

            array[113]=new Array("繁昌县","芜湖","繁昌县");
            array[114]=new Array("南陵县","芜湖","南陵县");
            array[115]=new Array("芜湖市","芜湖","芜湖市");
            array[116]=new Array("芜湖县","芜湖","芜湖县");

            array[117]=new Array("广德县","宣城","广德县");
            array[118]=new Array("绩溪县","宣城","绩溪县");
            array[119]=new Array("郎溪县","宣城","郎溪县");
            array[120]=new Array("宁国市","宣城","宁国市");
            array[121]=new Array("宣城市","宣城","宣城市");
            array[122]=new Array("泾县","宣城","泾县");
            array[123]=new Array("旌德县","宣城","旌德县");

            array[124]=new Array("利辛县","亳州","利辛县");
            array[125]=new Array("蒙城县","亳州","蒙城县");
            array[126]=new Array("涡阳县","亳州","涡阳县");
            array[127]=new Array("亳州市","亳州","亳州市");

            array[128]=new Array("福州","福建","福州");
            array[129]=new Array("龙岩","福建","龙岩");
            array[130]=new Array("南平","福建","南平");
            array[131]=new Array("宁德","福建","宁德");
            array[132]=new Array("莆田","福建","莆田");
            array[133]=new Array("泉州","福建","泉州");
            array[134]=new Array("三明","福建","三明");
            array[135]=new Array("厦门","福建","厦门");
            array[136]=new Array("漳州","福建","漳州");

            array[137]=new Array("长乐市","福州","长乐市");
            array[138]=new Array("福清市","福州","福清市");
            array[139]=new Array("福州市","福州","福州市");
            array[140]=new Array("连江县","福州","连江县");
            array[141]=new Array("罗源县","福州","罗源县");
            array[142]=new Array("闽侯县","福州","闽侯县");
            array[143]=new Array("闽清县","福州","闽清县");
            array[144]=new Array("平潭县","福州","平潭县");
            array[145]=new Array("永泰县","福州","永泰县");

            array[146]=new Array("长汀县","龙岩","长汀县");
            array[147]=new Array("连城县","龙岩","连城县");
            array[148]=new Array("龙岩市","龙岩","龙岩市");
            array[149]=new Array("上杭县","龙岩","上杭县");
            array[150]=new Array("武平县","龙岩","武平县");
            array[151]=new Array("永定县","龙岩","永定县");
            array[152]=new Array("漳平市","龙岩","漳平市");

            array[153]=new Array("光泽县","南平","光泽县");
            array[154]=new Array("建阳市","南平","建阳市");
            array[155]=new Array("建瓯市","南平","建瓯市");
            array[156]=new Array("南平市","南平","南平市");
            array[157]=new Array("浦城县","南平","浦城县");
            array[158]=new Array("邵武市","南平","邵武市");
            array[159]=new Array("顺昌县","南平","顺昌县");
            array[160]=new Array("松溪县","南平","松溪县");
            array[161]=new Array("武夷山市","南平","武夷山市");
            array[162]=new Array("政和县","南平","政和县");

            array[163]=new Array("福安市","宁德","福安市");
            array[164]=new Array("福鼎市","宁德","福鼎市");
            array[165]=new Array("古田县","宁德","古田县");
            array[166]=new Array("宁德市","宁德","宁德市");
            array[167]=new Array("屏南县","宁德","屏南县");
            array[168]=new Array("寿宁县","宁德","寿宁县");
            array[169]=new Array("霞浦县","宁德","霞浦县");
            array[170]=new Array("周宁县","宁德","周宁县");
            array[171]=new Array("柘荣县","宁德","柘荣县");

            array[172]=new Array("莆田市","莆田","莆田市");
            array[173]=new Array("仙游县","莆田","仙游县");

            array[174]=new Array("安溪县","泉州","安溪县");
            array[175]=new Array("德化县","泉州","德化县");
            array[176]=new Array("惠安县","泉州","惠安县");
            array[177]=new Array("金门县","泉州","金门县");
            array[178]=new Array("晋江市","泉州","晋江市");
            array[179]=new Array("南安市","泉州","南安市");
            array[180]=new Array("泉州市","泉州","泉州市");
            array[181]=new Array("石狮市","泉州","石狮市");
            array[182]=new Array("永春县","泉州","永春县");

            array[183]=new Array("大田县","三明","大田县");
            array[184]=new Array("建宁县","三明","建宁县");
            array[185]=new Array("将乐县","三明","将乐县");
            array[186]=new Array("明溪县","三明","明溪县");
            array[187]=new Array("宁化县","三明","宁化县");
            array[188]=new Array("清流县","三明","清流县");
            array[189]=new Array("三明市","三明","三明市");
            array[190]=new Array("沙县","三明","沙县");
            array[191]=new Array("泰宁县","三明","泰宁县");
            array[192]=new Array("永安市","三明","永安市");
            array[193]=new Array("尤溪县","三明","尤溪县");

            array[194]=new Array("厦门市","厦门","厦门市");

            array[195]=new Array("长泰县","漳州","长泰县");
            array[196]=new Array("东山县","漳州","东山县");
            array[197]=new Array("华安县","漳州","华安县");
            array[198]=new Array("龙海市","漳州","龙海市");
            array[199]=new Array("南靖县","漳州","南靖县");
            array[200]=new Array("平和县","漳州","平和县");
            array[201]=new Array("云霄县","漳州","云霄县");
            array[202]=new Array("漳浦县","漳州","漳浦县");
            array[203]=new Array("漳州市","漳州","漳州市");
            array[204]=new Array("诏安县","漳州","诏安县");

            array[205]=new Array("白银","甘肃","白银");
            array[206]=new Array("定西","甘肃","定西");
            array[207]=new Array("甘南藏族自治州","甘肃","甘南藏族自治州");
            array[208]=new Array("嘉峪关","甘肃","嘉峪关");
            array[209]=new Array("金昌","甘肃","金昌");
            array[210]=new Array("酒泉","甘肃","酒泉");
            array[211]=new Array("兰州","甘肃","兰州");
            array[212]=new Array("临夏回族自治州","甘肃","临夏回族自治州");
            array[213]=new Array("陇南","甘肃","陇南");
            array[214]=new Array("平凉","甘肃","平凉");
            array[215]=new Array("庆阳","甘肃","庆阳");
            array[216]=new Array("天水","甘肃","天水");
            array[217]=new Array("武威","甘肃","武威");
            array[218]=new Array("张掖","甘肃","张掖");

            array[219]=new Array("白银市","白银","白银市");
            array[220]=new Array("会宁县","白银","会宁县");
            array[221]=new Array("景泰县","白银","景泰县");
            array[222]=new Array("靖远县","白银","靖远县");

            array[223]=new Array("定西县","定西","定西县");
            array[224]=new Array("临洮县","定西","临洮县");
            array[225]=new Array("陇西县","定西","陇西县");
            array[226]=new Array("通渭县","定西","通渭县");
            array[227]=new Array("渭源县","定西","渭源县");
            array[228]=new Array("漳县","定西","漳县");
            array[229]=new Array("岷县","定西","岷县");

            array[230]=new Array("迭部县","甘南藏族自治州","迭部县");
            array[231]=new Array("合作市","甘南藏族自治州","合作市");
            array[232]=new Array("临潭县","甘南藏族自治州","临潭县");
            array[233]=new Array("碌曲县","甘南藏族自治州","碌曲县");
            array[234]=new Array("玛曲县","甘南藏族自治州","玛曲县");
            array[235]=new Array("夏河县","甘南藏族自治州","夏河县");
            array[236]=new Array("舟曲县","甘南藏族自治州","舟曲县");
            array[237]=new Array("卓尼县","甘南藏族自治州","卓尼县");

            array[238]=new Array("嘉峪关市","嘉峪关","嘉峪关市");

            array[239]=new Array("金昌市","金昌","金昌市");
            array[240]=new Array("永昌县","金昌","永昌县");

            array[241]=new Array("阿克塞哈萨克族自治县","酒泉","阿克塞哈萨克族自治县");
            array[242]=new Array("安西县","酒泉","安西县");
            array[243]=new Array("敦煌市","酒泉","敦煌市");
            array[244]=new Array("金塔县","酒泉","金塔县");
            array[245]=new Array("酒泉市","酒泉","酒泉市");
            array[246]=new Array("肃北蒙古族自治县","酒泉","肃北蒙古族自治县");
            array[247]=new Array("玉门市","酒泉","玉门市");

            array[248]=new Array("皋兰县","兰州","皋兰县");
            array[249]=new Array("兰州市","兰州","兰州市");
            array[250]=new Array("永登县","兰州","永登县");
            array[251]=new Array("榆中县","兰州","榆中县");

            array[252]=new Array("东乡族自治县","临夏回族自治州","东乡族自治县");
            array[253]=new Array("广河县","临夏回族自治州","广河县");
            array[254]=new Array("和政县","临夏回族自治州","和政县");
            array[255]=new Array("积石山保安族东乡族撒拉族自治县","临夏回族自治州","积石山保安族东乡族撒拉族自治县");
            array[256]=new Array("康乐县","临夏回族自治州","康乐县");
            array[257]=new Array("临夏市","临夏回族自治州","临夏市");
            array[258]=new Array("临夏县","临夏回族自治州","临夏县");
            array[259]=new Array("永靖县","临夏回族自治州","永靖县");

            array[260]=new Array("成县","陇南","成县");
            array[261]=new Array("徽县","陇南","徽县");
            array[262]=new Array("康县","陇南","康县");
            array[263]=new Array("礼县","陇南","礼县");
            array[264]=new Array("两当县","陇南","两当县");
            array[265]=new Array("文县","陇南","文县");
            array[266]=new Array("武都县","陇南","武都县");
            array[267]=new Array("西和县","陇南","西和县");
            array[268]=new Array("宕昌县","陇南","宕昌县");

            array[269]=new Array("崇信县","平凉","崇信县");
            array[270]=new Array("华亭县","平凉","华亭县");
            array[271]=new Array("静宁县","平凉","静宁县");
            array[272]=new Array("灵台县","平凉","灵台县");
            array[273]=new Array("平凉市","平凉","平凉市");
            array[274]=new Array("庄浪县","平凉","庄浪县");
            array[275]=new Array("泾川县","平凉","泾川县");

            array[276]=new Array("合水县","庆阳","合水县");
            array[277]=new Array("华池县","庆阳","华池县");
            array[278]=new Array("环县","庆阳","环县");
            array[279]=new Array("宁县","庆阳","宁县");
            array[280]=new Array("庆城县","庆阳","庆城县");
            array[281]=new Array("庆阳市","庆阳","庆阳市");
            array[282]=new Array("镇原县","庆阳","镇原县");
            array[283]=new Array("正宁县","庆阳","正宁县");

            array[284]=new Array("甘谷县","天水","甘谷县");
            array[285]=new Array("秦安县","天水","秦安县");
            array[286]=new Array("清水县","天水","清水县");
            array[287]=new Array("天水市","天水","天水市");
            array[288]=new Array("武山县","天水","武山县");
            array[289]=new Array("张家川回族自治县","天水","张家川回族自治县");

            array[290]=new Array("古浪县","武威","古浪县");
            array[291]=new Array("民勤县","武威","民勤县");
            array[292]=new Array("天祝藏族自治县","武威","天祝藏族自治县");
            array[293]=new Array("武威市","武威","武威市");

            array[294]=new Array("高台县","张掖","高台县");
            array[295]=new Array("临泽县","张掖","临泽县");
            array[296]=new Array("民乐县","张掖","民乐县");
            array[297]=new Array("山丹县","张掖","山丹县");
            array[298]=new Array("肃南裕固族自治县","张掖","肃南裕固族自治县");
            array[299]=new Array("张掖市","张掖","张掖市");

            array[300]=new Array("潮州","广东","潮州");
            array[301]=new Array("东莞","广东","东莞");
            array[302]=new Array("佛山","广东","佛山");
            array[303]=new Array("广州","广东","广州");
            array[304]=new Array("河源","广东","河源");
            array[305]=new Array("惠州","广东","惠州");
            array[306]=new Array("江门","广东","江门");
            array[307]=new Array("揭阳","广东","揭阳");
            array[308]=new Array("茂名","广东","茂名");
            array[309]=new Array("梅州","广东","梅州");
            array[310]=new Array("清远","广东","清远");
            array[311]=new Array("汕头","广东","汕头");
            array[312]=new Array("汕尾","广东","汕尾");
            array[313]=new Array("韶关","广东","韶关");
            array[314]=new Array("深圳","广东","深圳");
            array[315]=new Array("阳江","广东","阳江");
            array[316]=new Array("云浮","广东","云浮");
            array[317]=new Array("湛江","广东","湛江");
            array[318]=new Array("肇庆","广东","肇庆");
            array[319]=new Array("中山","广东","中山");
            array[320]=new Array("珠海","广东","珠海");

            array[321]=new Array("潮安县","潮州","潮安县");
            array[322]=new Array("潮州市","潮州","潮州市");
            array[323]=new Array("饶平县","潮州","饶平县");

            array[324]=new Array("东莞市","东莞","东莞市");

            array[325]=new Array("佛山市","佛山","佛山市");

            array[326]=new Array("从化市","广州","从化市");
            array[327]=new Array("广州市","广州","广州市");
            array[328]=new Array("增城市","广州","增城市");

            array[329]=new Array("东源县","河源","东源县");
            array[330]=new Array("和平县","河源","和平县");
            array[331]=new Array("河源市","河源","河源市");
            array[332]=new Array("连平县","河源","连平县");
            array[333]=new Array("龙川县","河源","龙川县");
            array[334]=new Array("紫金县","河源","紫金县");

            array[335]=new Array("博罗县","惠州","博罗县");
            array[336]=new Array("惠东县","惠州","惠东县");
            array[337]=new Array("惠阳市","惠州","惠阳市");
            array[338]=new Array("惠州市","惠州","惠州市");
            array[339]=new Array("龙门县","惠州","龙门县");

            array[340]=new Array("恩平市","江门","恩平市");
            array[341]=new Array("鹤山市","江门","鹤山市");
            array[342]=new Array("江门市","江门","江门市");
            array[343]=new Array("开平市","江门","开平市");
            array[344]=new Array("台山市","江门","台山市");

            array[345]=new Array("惠来县","揭阳","惠来县");
            array[346]=new Array("揭东县","揭阳","揭东县");
            array[347]=new Array("揭西县","揭阳","揭西县");
            array[348]=new Array("揭阳市","揭阳","揭阳市");
            array[349]=new Array("普宁市","揭阳","普宁市");

            array[350]=new Array("电白县","茂名","电白县");
            array[351]=new Array("高州市","茂名","高州市");
            array[352]=new Array("化州市","茂名","化州市");
            array[353]=new Array("茂名市","茂名","茂名市");
            array[354]=new Array("信宜市","茂名","信宜市");

            array[355]=new Array("大埔县","梅州","大埔县");
            array[356]=new Array("丰顺县","梅州","丰顺县");
            array[357]=new Array("蕉岭县","梅州","蕉岭县");
            array[358]=new Array("梅县","梅州","梅县");
            array[359]=new Array("梅州市","梅州","梅州市");
            array[360]=new Array("平远县","梅州","平远县");
            array[361]=new Array("五华县","梅州","五华县");
            array[362]=new Array("兴宁市","梅州","兴宁市");

            array[363]=new Array("佛冈县","清远","佛冈县");
            array[364]=new Array("连南瑶族自治县","清远","连南瑶族自治县");
            array[365]=new Array("连山壮族瑶族自治县","清远","连山壮族瑶族自治县");
            array[366]=new Array("连州市","清远","连州市");
            array[367]=new Array("清新县","清远","清新县");
            array[368]=new Array("清远市","清远","清远市");
            array[369]=new Array("阳山县","清远","阳山县");
            array[370]=new Array("英德市","清远","英德市");

            array[371]=new Array("潮阳市","汕头","潮阳市");
            array[372]=new Array("澄海市","汕头","澄海市");
            array[373]=new Array("南澳县","汕头","南澳县");
            array[374]=new Array("汕头市","汕头","汕头市");

            array[375]=new Array("海丰县","汕尾","海丰县");
            array[376]=new Array("陆丰市","汕尾","陆丰市");
            array[377]=new Array("陆河县","汕尾","陆河县");
            array[378]=new Array("汕尾市","汕尾","汕尾市");

            array[379]=new Array("乐昌市","韶关","乐昌市");
            array[380]=new Array("南雄市","韶关","南雄市");
            array[381]=new Array("曲江县","韶关","曲江县");
            array[382]=new Array("仁化县","韶关","仁化县");
            array[383]=new Array("乳源瑶族自治县","韶关","乳源瑶族自治县");
            array[384]=new Array("韶关市","韶关","韶关市");
            array[385]=new Array("始兴县","韶关","始兴县");
            array[386]=new Array("翁源县","韶关","翁源县");
            array[387]=new Array("新丰县","韶关","新丰县");

            array[388]=new Array("深圳市","深圳","深圳市");

            array[389]=new Array("阳春市","阳江","阳春市");
            array[390]=new Array("阳东县","阳江","阳东县");
            array[391]=new Array("阳江市","阳江","阳江市");
            array[392]=new Array("阳西县","阳江","阳西县");

            array[393]=new Array("罗定市","云浮","罗定市");
            array[394]=new Array("新兴县","云浮","新兴县");
            array[395]=new Array("郁南县","云浮","郁南县");
            array[396]=new Array("云安县","云浮","云安县");
            array[397]=new Array("云浮市","云浮","云浮市");

            array[398]=new Array("雷州市","湛江","雷州市");
            array[399]=new Array("廉江市","湛江","廉江市");
            array[400]=new Array("遂溪县","湛江","遂溪县");
            array[401]=new Array("吴川市","湛江","吴川市");
            array[402]=new Array("徐闻县","湛江","徐闻县");
            array[403]=new Array("湛江市","湛江","湛江市");

            array[404]=new Array("德庆县","肇庆","德庆县");
            array[405]=new Array("封开县","肇庆","封开县");
            array[406]=new Array("高要市","肇庆","高要市");
            array[407]=new Array("广宁县","肇庆","广宁县");
            array[408]=new Array("怀集县","肇庆","怀集县");
            array[409]=new Array("四会市","肇庆","四会市");
            array[410]=new Array("肇庆市","肇庆","肇庆市");

            array[411]=new Array("中山市","中山","中山市");

            array[412]=new Array("珠海市","珠海","珠海市");

            array[413]=new Array("百色","广西","百色");
            array[414]=new Array("北海","广西","北海");
            array[415]=new Array("崇左","广西","崇左");
            array[416]=new Array("防城港","广西","防城港");
            array[417]=new Array("桂林","广西","桂林");
            array[418]=new Array("贵港","广西","贵港");
            array[419]=new Array("河池","广西","河池");
            array[420]=new Array("贺州","广西","贺州");
            array[421]=new Array("来宾","广西","来宾");
            array[422]=new Array("柳州","广西","柳州");
            array[423]=new Array("南宁","广西","南宁");
            array[424]=new Array("钦州","广西","钦州");
            array[425]=new Array("梧州","广西","梧州");
            array[426]=new Array("玉林","广西","玉林");

          array[427]=new Array("百色市","百色","百色市");
            array[428]=new Array("德保县","百色","德保县");
            array[429]=new Array("靖西县","百色","靖西县");
            array[430]=new Array("乐业县","百色","乐业县");
            array[431]=new Array("凌云县","百色","凌云县");
            array[432]=new Array("隆林各族自治县","百色","隆林各族自治县");
            array[433]=new Array("那坡县","百色","那坡县");
            array[434]=new Array("平果县","百色","平果县");
            array[435]=new Array("田东县","百色","田东县");
            array[436]=new Array("田林县","百色","田林县");
            array[437]=new Array("田阳县","百色","田阳县");
            array[438]=new Array("西林县","百色","西林县");

            array[439]=new Array("北海市","北海","北海市");
            array[440]=new Array("合浦县","北海","合浦县");

            array[441]=new Array("崇左市","崇左","崇左市");
            array[442]=new Array("大新县","崇左","大新县");
            array[443]=new Array("扶绥县","崇左","扶绥县");
            array[444]=new Array("龙州县","崇左","龙州县");
            array[445]=new Array("宁明县","崇左","宁明县");
            array[446]=new Array("凭祥市","崇左","凭祥市");
            array[447]=new Array("天等县","崇左","天等县");

            array[448]=new Array("东兴市","防城港","东兴市");
            array[449]=new Array("防城港市","防城港","防城港市");
            array[450]=new Array("上思县","防城港","上思县");

            array[451]=new Array("恭城瑶族自治县","桂林","恭城瑶族自治县");
            array[452]=new Array("灌阳县","桂林","灌阳县");
            array[453]=new Array("桂林市","桂林","桂林市");
            array[454]=new Array("荔浦县","桂林","荔浦县");
            array[455]=new Array("临桂县","桂林","临桂县");
            array[456]=new Array("灵川县","桂林","灵川县");
            array[457]=new Array("龙胜各族自治县","桂林","龙胜各族自治县");
            array[458]=new Array("平乐县","桂林","平乐县");
            array[459]=new Array("全州县","桂林","全州县");
            array[460]=new Array("兴安县","桂林","兴安县");
            array[461]=new Array("阳朔县","桂林","阳朔县");
            array[462]=new Array("永福县","桂林","永福县");
            array[463]=new Array("资源县","桂林","资源县");

            array[464]=new Array("桂平市","贵港","桂平市");
            array[465]=new Array("贵港市","贵港","贵港市");
            array[466]=new Array("平南县","贵港","平南县");

            array[467]=new Array("巴马瑶族自治县","河池","巴马瑶族自治县");
            array[468]=new Array("大化瑶族自治县","河池","大化瑶族自治县");
            array[469]=new Array("东兰县","河池","东兰县");
            array[470]=new Array("都安瑶族自治县","河池","都安瑶族自治县");
            array[471]=new Array("凤山县","河池","凤山县");
            array[472]=new Array("河池市","河池","河池市");
            array[473]=new Array("环江毛南族自治县","河池","环江毛南族自治县");
            array[474]=new Array("罗城仡佬族自治县","河池","罗城仡佬族自治县");
            array[475]=new Array("南丹县","河池","南丹县");
            array[476]=new Array("天峨县","河池","天峨县");
            array[477]=new Array("宜州市","河池","宜州市");

            array[478]=new Array("富川瑶族自治县","贺州","富川瑶族自治县");
            array[479]=new Array("贺州市","贺州","贺州市");
            array[480]=new Array("昭平县","贺州","昭平县");
            array[481]=new Array("钟山县","贺州","钟山县");

            array[482]=new Array("合山市","来宾","合山市");
            array[483]=new Array("金秀瑶族自治县","来宾","金秀瑶族自治县");
            array[484]=new Array("来宾市","来宾","来宾市");
            array[485]=new Array("武宣县","来宾","武宣县");
            array[486]=new Array("象州县","来宾","象州县");
            array[487]=new Array("忻城县","来宾","忻城县");

            array[488]=new Array("柳城县","柳州","柳城县");
            array[489]=new Array("柳江县","柳州","柳江县");
            array[490]=new Array("柳州市","柳州","柳州市");
            array[491]=new Array("鹿寨县","柳州","鹿寨县");
            array[492]=new Array("融安县","柳州","融安县");
            array[493]=new Array("融水苗族自治县","柳州","融水苗族自治县");
            array[494]=new Array("三江侗族自治县","柳州","三江侗族自治县");

            array[495]=new Array("宾阳县","南宁","宾阳县");
            array[496]=new Array("横县","南宁","横县");
            array[497]=new Array("隆安县","南宁","隆安县");
            array[498]=new Array("马山县","南宁","马山县");
            array[499]=new Array("南宁市","南宁","南宁市");
            array[500]=new Array("上林县","南宁","上林县");
            array[501]=new Array("武鸣县","南宁","武鸣县");
            array[502]=new Array("邕宁县","南宁","邕宁县");

            array[503]=new Array("灵山县","钦州","灵山县");
            array[504]=new Array("浦北县","钦州","浦北县");
            array[505]=new Array("钦州市","钦州","钦州市");

            array[506]=new Array("苍梧县","梧州","苍梧县");
            array[507]=new Array("蒙山县","梧州","蒙山县");
            array[508]=new Array("藤县","梧州","藤县");
            array[509]=new Array("梧州市","梧州","梧州市");
            array[510]=new Array("岑溪市","梧州","岑溪市");

            array[511]=new Array("北流市","玉林","北流市");
            array[512]=new Array("博白县","玉林","博白县");
            array[513]=new Array("陆川县","玉林","陆川县");
            array[514]=new Array("容县","玉林","容县");
            array[515]=new Array("兴业县","玉林","兴业县");
            array[516]=new Array("玉林市","玉林","玉林市");

            array[517]=new Array("安顺","贵州","安顺");
            array[518]=new Array("毕节","贵州","毕节");
            array[519]=new Array("贵阳","贵州","贵阳");
            array[520]=new Array("六盘水","贵州","六盘水");
            array[521]=new Array("黔东南苗族侗族自治州","贵州","黔东南苗族侗族自治州");
            array[522]=new Array("黔南布依族苗族自治州","贵州","黔南布依族苗族自治州");
            array[523]=new Array("黔西南布依族苗族自治州","贵州","黔西南布依族苗族自治州");
            array[524]=new Array("铜仁","贵州","铜仁");
            array[525]=new Array("遵义","贵州","遵义");

            array[526]=new Array("安顺市","安顺","安顺市");
            array[527]=new Array("关岭布依族苗族自治县","安顺","关岭布依族苗族自治县");
            array[528]=new Array("平坝县","安顺","平坝县");
            array[529]=new Array("普定县","安顺","普定县");
            array[530]=new Array("镇宁布依族苗族自治县","安顺","镇宁布依族苗族自治县");
            array[531]=new Array("紫云苗族布依族自治县","安顺","紫云苗族布依族自治县");

            array[532]=new Array("毕节市","毕节","毕节市");
            array[533]=new Array("大方县","毕节","大方县");
            array[534]=new Array("赫章县","毕节","赫章县");
            array[535]=new Array("金沙县","毕节","金沙县");
            array[536]=new Array("纳雍县","毕节","纳雍县");
            array[537]=new Array("黔西县","毕节","黔西县");
            array[538]=new Array("威宁彝族回族苗族自治县","毕节","威宁彝族回族苗族自治县");
            array[539]=new Array("织金县","毕节","织金县");

            array[540]=new Array("贵阳市","贵阳","贵阳市");
            array[541]=new Array("开阳县","贵阳","开阳县");
            array[542]=new Array("清镇市","贵阳","清镇市");
            array[543]=new Array("息烽县","贵阳","息烽县");
            array[544]=new Array("修文县","贵阳","修文县");

            array[545]=new Array("六盘水市","六盘水","六盘水市");
            array[546]=new Array("六枝特区","六盘水","六枝特区");
            array[547]=new Array("盘县","六盘水","盘县");
            array[548]=new Array("水城县","六盘水","水城县");

            array[549]=new Array("从江县","黔东南苗族侗族自治州","从江县");
            array[550]=new Array("丹寨县","黔东南苗族侗族自治州","丹寨县");
            array[551]=new Array("黄平县","黔东南苗族侗族自治州","黄平县");
            array[552]=new Array("剑河县","黔东南苗族侗族自治州","剑河县");
            array[553]=new Array("锦屏县","黔东南苗族侗族自治州","锦屏县");
            array[554]=new Array("凯里市","黔东南苗族侗族自治州","凯里市");
            array[555]=new Array("雷山县","黔东南苗族侗族自治州","雷山县");
            array[556]=new Array("黎平县","黔东南苗族侗族自治州","黎平县");
            array[557]=new Array("麻江县","黔东南苗族侗族自治州","麻江县");
            array[558]=new Array("三穗县","黔东南苗族侗族自治州","三穗县");
            array[559]=new Array("施秉县","黔东南苗族侗族自治州","施秉县");
            array[560]=new Array("台江县","黔东南苗族侗族自治州","台江县");
            array[561]=new Array("天柱县","黔东南苗族侗族自治州","天柱县");
            array[562]=new Array("镇远县","黔东南苗族侗族自治州","镇远县");
            array[563]=new Array("岑巩县","黔东南苗族侗族自治州","岑巩县");
            array[564]=new Array("榕江县","黔东南苗族侗族自治州","榕江县");

            array[565]=new Array("长顺县","黔南布依族苗族自治州","长顺县");
            array[566]=new Array("都匀市","黔南布依族苗族自治州","都匀市");
            array[567]=new Array("独山县","黔南布依族苗族自治州","独山县");
            array[568]=new Array("福泉市","黔南布依族苗族自治州","福泉市");
            array[569]=new Array("贵定县","黔南布依族苗族自治州","贵定县");
            array[570]=new Array("惠水县","黔南布依族苗族自治州","惠水县");
            array[571]=new Array("荔波县","黔南布依族苗族自治州","荔波县");
            array[572]=new Array("龙里县","黔南布依族苗族自治州","龙里县");
            array[573]=new Array("罗甸县","黔南布依族苗族自治州","罗甸县");
            array[574]=new Array("平塘县","黔南布依族苗族自治州","平塘县");
            array[575]=new Array("三都水族自治县","黔南布依族苗族自治州","三都水族自治县");
            array[576]=new Array("瓮安县","黔南布依族苗族自治州","瓮安县");

            array[577]=new Array("安龙县","黔西南布依族苗族自治州","安龙县");
            array[578]=new Array("册亨县","黔西南布依族苗族自治州","册亨县");
            array[579]=new Array("普安县","黔西南布依族苗族自治州","普安县");
            array[580]=new Array("晴隆县","黔西南布依族苗族自治州","晴隆县");
            array[581]=new Array("望谟县","黔西南布依族苗族自治州","望谟县");
            array[582]=new Array("兴仁县","黔西南布依族苗族自治州","兴仁县");
            array[583]=new Array("兴义市","黔西南布依族苗族自治州","兴义市");
            array[584]=new Array("贞丰县","黔西南布依族苗族自治州","贞丰县");

            array[585]=new Array("德江县","铜仁","德江县");
            array[586]=new Array("江口县","铜仁","江口县");
            array[587]=new Array("石阡县","铜仁","石阡县");
            array[588]=new Array("思南县","铜仁","思南县");
            array[589]=new Array("松桃苗族自治县","铜仁","松桃苗族自治县");
            array[590]=new Array("铜仁市","铜仁","铜仁市");
            array[591]=new Array("万山特区","铜仁","万山特区");
            array[592]=new Array("沿河土家族自治县","铜仁","沿河土家族自治县");
            array[593]=new Array("印江土家族苗族自治县","铜仁","印江土家族苗族自治县");
            array[594]=new Array("玉屏侗族自治县","铜仁","玉屏侗族自治县");

            array[595]=new Array("赤水市","遵义","赤水市");
            array[596]=new Array("道真仡佬族苗族自治县","遵义","道真仡佬族苗族自治县");
            array[597]=new Array("凤冈县","遵义","凤冈县");
            array[598]=new Array("仁怀市","遵义","仁怀市");
            array[599]=new Array("绥阳县","遵义","绥阳县");
            array[600]=new Array("桐梓县","遵义","桐梓县");
            array[601]=new Array("务川仡佬族苗族自治县","遵义","务川仡佬族苗族自治县");
            array[602]=new Array("习水县","遵义","习水县");
            array[603]=new Array("余庆县","遵义","余庆县");
            array[604]=new Array("正安县","遵义","正安县");
            array[605]=new Array("遵义市","遵义","遵义市");
            array[606]=new Array("遵义县","遵义","遵义县");
            array[607]=new Array("湄潭县","遵义","湄潭县");

            array[608]=new Array("白沙黎族自治县","海南","白沙黎族自治县");
            array[609]=new Array("保亭黎族苗族自治县","海南","保亭黎族苗族自治县");
            array[610]=new Array("昌江黎族自治县","海南","昌江黎族自治县");
            array[611]=new Array("澄迈县","海南","澄迈县");
            array[612]=new Array("定安县","海南","定安县");
            array[613]=new Array("东方","海南","东方");
            array[614]=new Array("海口","海南","海口");
            array[615]=new Array("乐东黎族自治县","海南","乐东黎族自治县");
            array[616]=new Array("临高县","海南","临高县");
            array[617]=new Array("陵水黎族自治县","海南","陵水黎族自治县");
            array[618]=new Array("琼海","海南","琼海");
            array[619]=new Array("琼中黎族苗族自治县","海南","琼中黎族苗族自治县");
            array[620]=new Array("三亚","海南","三亚");
            array[621]=new Array("屯昌县","海南","屯昌县");
            array[622]=new Array("万宁","海南","万宁");
            array[623]=new Array("文昌","海南","文昌");
            array[624]=new Array("五指山","海南","五指山");
            array[625]=new Array("儋州","海南","儋州");

            array[626]=new Array("白沙黎族自治县","白沙黎族自治县","白沙黎族自治县");

            array[627]=new Array("保亭黎族苗族自治县","保亭黎族苗族自治县","保亭黎族苗族自治县");

            array[628]=new Array("昌江黎族自治县","昌江黎族自治县","昌江黎族自治县");

            array[629]=new Array("澄迈县","澄迈县","澄迈县");

            array[630]=new Array("定安县","定安县","定安县");

            array[631]=new Array("东方市","东方","东方市");

            array[632]=new Array("海口市","海口","海口市");

            array[633]=new Array("乐东黎族自治县","乐东黎族自治县","乐东黎族自治县");

            array[634]=new Array("临高县","临高县","临高县");

            array[635]=new Array("陵水黎族自治县","陵水黎族自治县","陵水黎族自治县");

            array[636]=new Array("琼海市","琼海","琼海市");

            array[637]=new Array("琼中黎族苗族自治县","琼中黎族苗族自治县","琼中黎族苗族自治县");

            array[638]=new Array("三亚市","三亚","三亚市");

            array[639]=new Array("屯昌县","屯昌县","屯昌县");

            array[640]=new Array("万宁市","万宁","万宁市");

            array[641]=new Array("文昌市","文昌","文昌市");

            array[642]=new Array("五指山市","五指山","五指山市");

            array[643]=new Array("儋州市","儋州","儋州市");

            array[644]=new Array("保定","河北","保定");
            array[645]=new Array("沧州","河北","沧州");
            array[646]=new Array("承德","河北","承德");
            array[647]=new Array("邯郸","河北","邯郸");
            array[648]=new Array("衡水","河北","衡水");
            array[649]=new Array("廊坊","河北","廊坊");
            array[650]=new Array("秦皇岛","河北","秦皇岛");
            array[651]=new Array("石家庄","河北","石家庄");
            array[652]=new Array("唐山","河北","唐山");
            array[653]=new Array("邢台","河北","邢台");
            array[654]=new Array("张家口","河北","张家口");

            array[655]=new Array("安国市","保定","安国市");
            array[656]=new Array("安新县","保定","安新县");
            array[657]=new Array("保定市","保定","保定市");
            array[658]=new Array("博野县","保定","博野县");
            array[659]=new Array("定兴县","保定","定兴县");
            array[660]=new Array("定州市","保定","定州市");
            array[661]=new Array("阜平县","保定","阜平县");
            array[662]=new Array("高碑店市","保定","高碑店市");
            array[663]=new Array("高阳县","保定","高阳县");
            array[664]=new Array("满城县","保定","满城县");
            array[665]=new Array("清苑县","保定","清苑县");
            array[666]=new Array("曲阳县","保定","曲阳县");
            array[667]=new Array("容城县","保定","容城县");
            array[668]=new Array("顺平县","保定","顺平县");
            array[669]=new Array("唐县","保定","唐县");
            array[670]=new Array("望都县","保定","望都县");
            array[671]=new Array("雄县","保定","雄县");
            array[672]=new Array("徐水县","保定","徐水县");
            array[673]=new Array("易县","保定","易县");
            array[674]=new Array("涞水县","保定","涞水县");
            array[675]=new Array("涞源县","保定","涞源县");
            array[676]=new Array("涿州市","保定","涿州市");
            array[677]=new Array("蠡县","保定","蠡县");

            array[678]=new Array("泊头市","沧州","泊头市");
            array[679]=new Array("沧县","沧州","沧县");
            array[680]=new Array("沧州市","沧州","沧州市");
            array[681]=new Array("东光县","沧州","东光县");
            array[682]=new Array("海兴县","沧州","海兴县");
            array[683]=new Array("河间市","沧州","河间市");
            array[684]=new Array("黄骅市","沧州","黄骅市");
            array[685]=new Array("孟村回族自治县","沧州","孟村回族自治县");
            array[686]=new Array("南皮县","沧州","南皮县");
            array[687]=new Array("青县","沧州","青县");
            array[688]=new Array("任丘市","沧州","任丘市");
            array[689]=new Array("肃宁县","沧州","肃宁县");
            array[690]=new Array("吴桥县","沧州","吴桥县");
            array[691]=new Array("献县","沧州","献县");
            array[692]=new Array("盐山县","沧州","盐山县");

            array[693]=new Array("承德市","承德","承德市");
            array[694]=new Array("承德县","承德","承德县");
            array[695]=new Array("丰宁满族自治县","承德","丰宁满族自治县");
            array[696]=new Array("宽城满族自治县","承德","宽城满族自治县");
            array[697]=new Array("隆化县","承德","隆化县");
            array[698]=new Array("滦平县","承德","滦平县");
            array[699]=new Array("平泉县","承德","平泉县");
            array[700]=new Array("围场满族蒙古族自治县","承德","围场满族蒙古族自治县");
            array[701]=new Array("兴隆县","承德","兴隆县");

            array[702]=new Array("成安县","邯郸","成安县");
            array[703]=new Array("磁县","邯郸","磁县");
            array[704]=new Array("大名县","邯郸","大名县");
            array[705]=new Array("肥乡县","邯郸","肥乡县");
            array[706]=new Array("馆陶县","邯郸","馆陶县");
            array[707]=new Array("广平县","邯郸","广平县");
            array[708]=new Array("邯郸市","邯郸","邯郸市");
            array[709]=new Array("邯郸县","邯郸","邯郸县");
            array[710]=new Array("鸡泽县","邯郸","鸡泽县");
            array[711]=new Array("临漳县","邯郸","临漳县");
            array[712]=new Array("邱县","邯郸","邱县");
            array[713]=new Array("曲周县","邯郸","曲周县");
            array[714]=new Array("涉县","邯郸","涉县");
            array[715]=new Array("魏县","邯郸","魏县");
            array[716]=new Array("武安市","邯郸","武安市");
            array[717]=new Array("永年县","邯郸","永年县");

            array[718]=new Array("安平县","衡水","安平县");
            array[719]=new Array("阜城县","衡水","阜城县");
            array[720]=new Array("故城县","衡水","故城县");
            array[721]=new Array("衡水市","衡水","衡水市");
            array[722]=new Array("冀州市","衡水","冀州市");
            array[723]=new Array("景县","衡水","景县");
            array[724]=new Array("饶阳县","衡水","饶阳县");
            array[725]=new Array("深州市","衡水","深州市");
            array[726]=new Array("武强县","衡水","武强县");
            array[727]=new Array("武邑县","衡水","武邑县");
            array[728]=new Array("枣强县","衡水","枣强县");

            array[729]=new Array("霸州市","廊坊","霸州市");
            array[730]=new Array("大厂回族自治县","廊坊","大厂回族自治县");
            array[731]=new Array("大城县","廊坊","大城县");
            array[732]=new Array("固安县","廊坊","固安县");
            array[733]=new Array("廊坊市","廊坊","廊坊市");
            array[734]=new Array("三河市","廊坊","三河市");
            array[735]=new Array("文安县","廊坊","文安县");
            array[736]=new Array("香河县","廊坊","香河县");
            array[737]=new Array("永清县","廊坊","永清县");

            array[738]=new Array("昌黎县","秦皇岛","昌黎县");
            array[739]=new Array("抚宁县","秦皇岛","抚宁县");
            array[740]=new Array("卢龙县","秦皇岛","卢龙县");
            array[741]=new Array("秦皇岛市","秦皇岛","秦皇岛市");
            array[742]=new Array("青龙满族自治县","秦皇岛","青龙满族自治县");

            array[743]=new Array("高邑县","石家庄","高邑县");
            array[744]=new Array("晋州市","石家庄","晋州市");
            array[745]=new Array("井陉县","石家庄","井陉县");
            array[746]=new Array("灵寿县","石家庄","灵寿县");
            array[747]=new Array("鹿泉市","石家庄","鹿泉市");
            array[748]=new Array("平山县","石家庄","平山县");
            array[749]=new Array("深泽县","石家庄","深泽县");
            array[750]=new Array("石家庄市","石家庄","石家庄市");
            array[751]=new Array("无极县","石家庄","无极县");
            array[752]=new Array("辛集市","石家庄","辛集市");
            array[753]=new Array("新乐市","石家庄","新乐市");
            array[754]=new Array("行唐县","石家庄","行唐县");
            array[755]=new Array("元氏县","石家庄","元氏县");
            array[756]=new Array("赞皇县","石家庄","赞皇县");
            array[757]=new Array("赵县","石家庄","赵县");
            array[758]=new Array("正定县","石家庄","正定县");
            array[759]=new Array("藁城市","石家庄","藁城市");
            array[760]=new Array("栾城县","石家庄","栾城县");

            array[761]=new Array("乐亭县","唐山","乐亭县");
            array[762]=new Array("滦南县","唐山","滦南县");
            array[763]=new Array("滦县","唐山","滦县");
            array[764]=new Array("迁安市","唐山","迁安市");
            array[765]=new Array("迁西县","唐山","迁西县");
            array[766]=new Array("唐海县","唐山","唐海县");
            array[767]=new Array("唐山市","唐山","唐山市");
            array[768]=new Array("玉田县","唐山","玉田县");
            array[769]=new Array("遵化市","唐山","遵化市");

            array[770]=new Array("柏乡县","邢台","柏乡县");
            array[771]=new Array("广宗县","邢台","广宗县");
            array[772]=new Array("巨鹿县","邢台","巨鹿县");
            array[773]=new Array("临城县","邢台","临城县");
            array[774]=new Array("临西县","邢台","临西县");
            array[775]=new Array("隆尧县","邢台","隆尧县");
            array[776]=new Array("南宫市","邢台","南宫市");
            array[777]=new Array("南和县","邢台","南和县");
            array[778]=new Array("内丘县","邢台","内丘县");
            array[779]=new Array("宁晋县","邢台","宁晋县");
            array[780]=new Array("平乡县","邢台","平乡县");
            array[781]=new Array("清河县","邢台","清河县");
            array[782]=new Array("任县","邢台","任县");
            array[783]=new Array("沙河市","邢台","沙河市");
            array[784]=new Array("威县","邢台","威县");
            array[785]=new Array("新河县","邢台","新河县");
            array[786]=new Array("邢台市","邢台","邢台市");
            array[787]=new Array("邢台县","邢台","邢台县");

            array[788]=new Array("赤城县","张家口","赤城县");
            array[789]=new Array("崇礼县","张家口","崇礼县");
            array[790]=new Array("沽源县","张家口","沽源县");
            array[791]=new Array("怀安县","张家口","怀安县");
            array[792]=new Array("怀来县","张家口","怀来县");
            array[793]=new Array("康保县","张家口","康保县");
            array[794]=new Array("尚义县","张家口","尚义县");
            array[795]=new Array("万全县","张家口","万全县");
            array[796]=new Array("蔚县","张家口","蔚县");
            array[797]=new Array("宣化县","张家口","宣化县");
            array[798]=new Array("阳原县","张家口","阳原县");
            array[799]=new Array("张北县","张家口","张北县");
            array[800]=new Array("张家口市","张家口","张家口市");
            array[801]=new Array("涿鹿县","张家口","涿鹿县");

            array[802]=new Array("安阳","河南","安阳");
            array[803]=new Array("鹤壁","河南","鹤壁");
            array[804]=new Array("济源","河南","济源");
            array[805]=new Array("焦作","河南","焦作");
            array[806]=new Array("开封","河南","开封");
            array[807]=new Array("洛阳","河南","洛阳");
            array[808]=new Array("南阳","河南","南阳");
            array[809]=new Array("平顶山","河南","平顶山");
            array[810]=new Array("三门峡","河南","三门峡");
            array[811]=new Array("商丘","河南","商丘");
            array[812]=new Array("新乡","河南","新乡");
            array[813]=new Array("信阳","河南","信阳");
            array[814]=new Array("许昌","河南","许昌");
            array[815]=new Array("郑州","河南","郑州");
            array[816]=new Array("周口","河南","周口");
            array[817]=new Array("驻马店","河南","驻马店");
            array[818]=new Array("漯河","河南","漯河");
            array[819]=new Array("濮阳","河南","濮阳");

            array[820]=new Array("安阳市","安阳","安阳市");
            array[821]=new Array("安阳县","安阳","安阳县");
            array[822]=new Array("滑县","安阳","滑县");
            array[823]=new Array("林州市","安阳","林州市");
            array[824]=new Array("内黄县","安阳","内黄县");
            array[825]=new Array("汤阴县","安阳","汤阴县");

            array[826]=new Array("鹤壁市","鹤壁","鹤壁市");
            array[827]=new Array("浚县","鹤壁","浚县");
            array[828]=new Array("淇县","鹤壁","淇县");

            array[829]=new Array("济源市","济源","济源市");

            array[830]=new Array("博爱县","焦作","博爱县");
            array[831]=new Array("焦作市","焦作","焦作市");
            array[832]=new Array("孟州市","焦作","孟州市");
            array[833]=new Array("沁阳市","焦作","沁阳市");
            array[834]=new Array("温县","焦作","温县");
            array[835]=new Array("武陟县","焦作","武陟县");
            array[836]=new Array("修武县","焦作","修武县");
            array[837]=new Array("开封市","开封","开封市");
            array[838]=new Array("开封县","开封","开封县");
            array[839]=new Array("兰考县","开封","兰考县");
            array[840]=new Array("通许县","开封","通许县");
            array[841]=new Array("尉氏县","开封","尉氏县");
            array[842]=new Array("杞县","开封","杞县");
            array[843]=new Array("洛宁县","洛阳","洛宁县");
            array[844]=new Array("洛阳市","洛阳","洛阳市");
            array[845]=new Array("孟津县","洛阳","孟津县");
            array[846]=new Array("汝阳县","洛阳","汝阳县");
            array[847]=new Array("新安县","洛阳","新安县");
            array[848]=new Array("伊川县","洛阳","伊川县");
            array[849]=new Array("宜阳县","洛阳","宜阳县");
            array[850]=new Array("偃师市","洛阳","偃师市");
            array[851]=new Array("嵩县","洛阳","嵩县");
            array[852]=new Array("栾川县","洛阳","栾川县");
            array[853]=new Array("邓州市","南阳","邓州市");
            array[854]=new Array("方城县","南阳","方城县");
            array[855]=new Array("南阳市","南阳","南阳市");
            array[856]=new Array("南召县","南阳","南召县");
            array[857]=new Array("内乡县","南阳","内乡县");
            array[858]=new Array("社旗县","南阳","社旗县");
            array[859]=new Array("唐河县","南阳","唐河县");
            array[860]=new Array("桐柏县","南阳","桐柏县");
            array[861]=new Array("西峡县","南阳","西峡县");
            array[862]=new Array("新野县","南阳","新野县");
            array[863]=new Array("镇平县","南阳","镇平县");
            array[864]=new Array("淅川县","南阳","淅川县");

            array[865]=new Array("宝丰县","平顶山","宝丰县");
            array[866]=new Array("鲁山县","平顶山","鲁山县");
            array[867]=new Array("平顶山市","平顶山","平顶山市");
            array[868]=new Array("汝州市","平顶山","汝州市");
            array[869]=new Array("舞钢市","平顶山","舞钢市");
            array[870]=new Array("叶县","平顶山","叶县");
            array[871]=new Array("郏县","平顶山","郏县");
            array[872]=new Array("灵宝市","三门峡","灵宝市");
            array[873]=new Array("卢氏县","三门峡","卢氏县");
            array[874]=new Array("三门峡市","三门峡","三门峡市");
            array[875]=new Array("陕县","三门峡","陕县");
            array[876]=new Array("义马市","三门峡","义马市");
            array[877]=new Array("渑池县","三门峡","渑池县");
            array[878]=new Array("民权县","商丘","民权县");
            array[879]=new Array("宁陵县","商丘","宁陵县");
            array[880]=new Array("商丘市","商丘","商丘市");
            array[881]=new Array("夏邑县","商丘","夏邑县");
            array[882]=new Array("永城市","商丘","永城市");
            array[883]=new Array("虞城县","商丘","虞城县");
            array[884]=new Array("柘城县","商丘","柘城县");
            array[885]=new Array("睢县","商丘","睢县");

            array[886]=new Array("长垣县","新乡","长垣县");
            array[887]=new Array("封丘县","新乡","封丘县");
            array[888]=new Array("辉县市","新乡","辉县市");
            array[889]=new Array("获嘉县","新乡","获嘉县");
            array[890]=new Array("卫辉市","新乡","卫辉市");
            array[891]=new Array("新乡市","新乡","新乡市");
            array[892]=new Array("新乡县","新乡","新乡县");
            array[893]=new Array("延津县","新乡","延津县");
            array[894]=new Array("原阳县","新乡","原阳县");
            array[895]=new Array("固始县","信阳","固始县");
            array[896]=new Array("光山县","信阳","光山县");
            array[897]=new Array("淮滨县","信阳","淮滨县");
            array[898]=new Array("罗山县","信阳","罗山县");
            array[899]=new Array("商城县","信阳","商城县");
            array[900]=new Array("息县","信阳","息县");
            array[901]=new Array("新县","信阳","新县");
            array[902]=new Array("信阳市","信阳","信阳市");
            array[903]=new Array("潢川县","信阳","潢川县");
            array[904]=new Array("长葛市","许昌","长葛市");
            array[905]=new Array("襄城县","许昌","襄城县");
            array[906]=new Array("许昌市","许昌","许昌市");
            array[907]=new Array("许昌县","许昌","许昌县");
            array[908]=new Array("禹州市","许昌","禹州市");
            array[909]=new Array("鄢陵县","许昌","鄢陵县");
            array[910]=new Array("登封市","郑州","登封市");
            array[911]=new Array("巩义市","郑州","巩义市");
            array[912]=new Array("新密市","郑州","新密市");
            array[913]=new Array("新郑市","郑州","新郑市");
            array[914]=new Array("郑州市","郑州","郑州市");
            array[915]=new Array("中牟县","郑州","中牟县");
            array[916]=new Array("荥阳市","郑州","荥阳市");

            array[917]=new Array("郸城县","周口","郸城县");
            array[918]=new Array("扶沟县","周口","扶沟县");
            array[919]=new Array("淮阳县","周口","淮阳县");
            array[920]=new Array("鹿邑县","周口","鹿邑县");
            array[921]=new Array("商水县","周口","商水县");
            array[922]=new Array("沈丘县","周口","沈丘县");
            array[923]=new Array("太康县","周口","太康县");
            array[924]=new Array("西华县","周口","西华县");
            array[925]=new Array("项城市","周口","项城市");
            array[926]=new Array("周口市","周口","周口市");
            array[927]=new Array("泌阳县","驻马店","泌阳县");
            array[928]=new Array("平舆县","驻马店","平舆县");
            array[929]=new Array("确山县","驻马店","确山县");
            array[930]=new Array("汝南县","驻马店","汝南县");
            array[931]=new Array("上蔡县","驻马店","上蔡县");
            array[932]=new Array("遂平县","驻马店","遂平县");
            array[933]=new Array("西平县","驻马店","西平县");
            array[934]=new Array("新蔡县","驻马店","新蔡县");
            array[935]=new Array("正阳县","驻马店","正阳县");
            array[936]=new Array("驻马店市","驻马店","驻马店市");
            array[937]=new Array("临颍县","漯河","临颍县");
            array[938]=new Array("舞阳县","漯河","舞阳县");
            array[939]=new Array("郾城县","漯河","郾城县");
            array[940]=new Array("漯河市","漯河","漯河市");
            array[941]=new Array("范县","濮阳","范县");
            array[942]=new Array("南乐县","濮阳","南乐县");
            array[943]=new Array("清丰县","濮阳","清丰县");
            array[944]=new Array("台前县","濮阳","台前县");
            array[945]=new Array("濮阳市","濮阳","濮阳市");
            array[946]=new Array("濮阳县","濮阳","濮阳县");

            array[947]=new Array("大庆","黑龙江","大庆");
            array[948]=new Array("大兴安岭","黑龙江","大兴安岭");
            array[949]=new Array("哈尔滨","黑龙江","哈尔滨");
            array[950]=new Array("鹤岗","黑龙江","鹤岗");
            array[951]=new Array("黑河","黑龙江","黑河");
            array[952]=new Array("鸡西","黑龙江","鸡西");
            array[953]=new Array("佳木斯","黑龙江","佳木斯");
            array[954]=new Array("牡丹江","黑龙江","牡丹江");
            array[955]=new Array("七台河","黑龙江","七台河");
            array[956]=new Array("齐齐哈尔","黑龙江","齐齐哈尔");
            array[957]=new Array("双鸭山","黑龙江","双鸭山");
            array[958]=new Array("绥化","黑龙江","绥化");
            array[959]=new Array("伊春","黑龙江","伊春");

            array[960]=new Array("大庆市","大庆","大庆市");
            array[961]=new Array("杜尔伯特蒙古族自治县","大庆","杜尔伯特蒙古族自治县");
            array[962]=new Array("林甸县","大庆","林甸县");
            array[963]=new Array("肇源县","大庆","肇源县");
            array[964]=new Array("肇州县","大庆","肇州县");
            array[965]=new Array("呼玛县","大兴安岭","呼玛县");
            array[966]=new Array("漠河县","大兴安岭","漠河县");
            array[967]=new Array("塔河县","大兴安岭","塔河县");
            array[968]=new Array("阿城市","哈尔滨","阿城市");
            array[969]=new Array("巴彦县","哈尔滨","巴彦县");
            array[970]=new Array("宾县","哈尔滨","宾县");
            array[971]=new Array("方正县","哈尔滨","方正县");
            array[972]=new Array("哈尔滨市","哈尔滨","哈尔滨市");
            array[973]=new Array("呼兰县","哈尔滨","呼兰县");
            array[974]=new Array("木兰县","哈尔滨","木兰县");
            array[975]=new Array("尚志市","哈尔滨","尚志市");
            array[976]=new Array("双城市","哈尔滨","双城市");
            array[977]=new Array("通河县","哈尔滨","通河县");
            array[978]=new Array("五常市","哈尔滨","五常市");
            array[979]=new Array("延寿县","哈尔滨","延寿县");
            array[980]=new Array("依兰县","哈尔滨","依兰县");
            array[981]=new Array("鹤岗市","鹤岗","鹤岗市");
            array[982]=new Array("萝北县","鹤岗","萝北县");
            array[983]=new Array("绥滨县","鹤岗","绥滨县");
            array[984]=new Array("北安市","黑河","北安市");
            array[985]=new Array("黑河市","黑河","黑河市");
            array[986]=new Array("嫩江县","黑河","嫩江县");
            array[987]=new Array("孙吴县","黑河","孙吴县");
            array[988]=new Array("五大连池市","黑河","五大连池市");
            array[989]=new Array("逊克县","黑河","逊克县");

            array[990]=new Array("虎林市","鸡西","虎林市");
            array[991]=new Array("鸡东县","鸡西","鸡东县");
            array[992]=new Array("鸡西市","鸡西","鸡西市");
            array[993]=new Array("密山市","鸡西","密山市");
            array[994]=new Array("抚远县","佳木斯","抚远县");
            array[995]=new Array("富锦市","佳木斯","富锦市");
            array[996]=new Array("佳木斯市","佳木斯","佳木斯市");
            array[997]=new Array("汤原县","佳木斯","汤原县");
            array[998]=new Array("同江市","佳木斯","同江市");
            array[999]=new Array("桦川县","佳木斯","桦川县");
            array[1000]=new Array("桦南县","佳木斯","桦南县");
            array[1001]=new Array("东宁县","牡丹江","东宁县");
            array[1002]=new Array("海林市","牡丹江","海林市");
            array[1003]=new Array("林口县","牡丹江","林口县");
            array[1004]=new Array("牡丹江市","牡丹江","牡丹江市");
            array[1005]=new Array("穆棱市","牡丹江","穆棱市");
            array[1006]=new Array("宁安市","牡丹江","宁安市");
            array[1007]=new Array("绥芬河市","牡丹江","绥芬河市");
            array[1008]=new Array("勃利县","七台河","勃利县");
            array[1009]=new Array("七台河市","七台河","七台河市");
            array[1010]=new Array("拜泉县","齐齐哈尔","拜泉县");
            array[1011]=new Array("富裕县","齐齐哈尔","富裕县");
            array[1012]=new Array("甘南县","齐齐哈尔","甘南县");
            array[1013]=new Array("克东县","齐齐哈尔","克东县");
            array[1014]=new Array("克山县","齐齐哈尔","克山县");
            array[1015]=new Array("龙江县","齐齐哈尔","龙江县");
            array[1016]=new Array("齐齐哈尔市","齐齐哈尔","齐齐哈尔市");
            array[1017]=new Array("泰来县","齐齐哈尔","泰来县");
            array[1018]=new Array("依安县","齐齐哈尔","依安县");
            array[1019]=new Array("讷河市","齐齐哈尔","讷河市");
            array[1020]=new Array("宝清县","双鸭山","宝清县");
            array[1021]=new Array("集贤县","双鸭山","集贤县");
            array[1022]=new Array("饶河县","双鸭山","饶河县");
            array[1023]=new Array("双鸭山市","双鸭山","双鸭山市");
            array[1024]=new Array("友谊县","双鸭山","友谊县");
            array[1025]=new Array("安达市","绥化","安达市");
            array[1026]=new Array("海伦市","绥化","海伦市");
            array[1027]=new Array("兰西县","绥化","兰西县");
            array[1028]=new Array("明水县","绥化","明水县");
            array[1029]=new Array("青冈县","绥化","青冈县");
            array[1030]=new Array("庆安县","绥化","庆安县");
            array[1031]=new Array("绥化市","绥化","绥化市");
            array[1032]=new Array("绥棱县","绥化","绥棱县");
            array[1033]=new Array("望奎县","绥化","望奎县");
            array[1034]=new Array("肇东市","绥化","肇东市");
            array[1035]=new Array("嘉荫县","伊春","嘉荫县");
            array[1036]=new Array("铁力市","伊春","铁力市");
            array[1037]=new Array("伊春市","伊春","伊春市");

            array[1038]=new Array("鄂州","湖北","鄂州");
            array[1039]=new Array("恩施土家族苗族自治州","湖北","恩施土家族苗族自治州");
            array[1040]=new Array("黄冈","湖北","黄冈");
            array[1041]=new Array("黄石","湖北","黄石");
            array[1042]=new Array("荆门","湖北","荆门");
            array[1043]=new Array("荆州","湖北","荆州");
            array[1044]=new Array("潜江","湖北","潜江");
            array[1045]=new Array("神农架林区","湖北","神农架林区");
            array[1046]=new Array("十堰","湖北","十堰");
            array[1047]=new Array("随州","湖北","随州");
            array[1048]=new Array("天门","湖北","天门");
            array[1049]=new Array("武汉","湖北","武汉");
            array[1050]=new Array("仙桃","湖北","仙桃");
            array[1051]=new Array("咸宁","湖北","咸宁");
            array[1052]=new Array("襄樊","湖北","襄樊");
            array[1053]=new Array("孝感","湖北","孝感");
            array[1054]=new Array("宜昌","湖北","宜昌");

            array[1055]=new Array("鄂州市","鄂州","鄂州市");
            array[1056]=new Array("巴东县","恩施土家族苗族自治州","巴东县");
            array[1057]=new Array("恩施市","恩施土家族苗族自治州","恩施市");
            array[1058]=new Array("鹤峰县","恩施土家族苗族自治州","鹤峰县");
            array[1059]=new Array("建始县","恩施土家族苗族自治州","建始县");
            array[1060]=new Array("来凤县","恩施土家族苗族自治州","来凤县");
            array[1061]=new Array("利川市","恩施土家族苗族自治州","利川市");
            array[1062]=new Array("咸丰县","恩施土家族苗族自治州","咸丰县");
            array[1063]=new Array("宣恩县","恩施土家族苗族自治州","宣恩县");
            array[1064]=new Array("红安县","黄冈","红安县");
            array[1065]=new Array("黄冈市","黄冈","黄冈市");
            array[1066]=new Array("黄梅县","黄冈","黄梅县");
            array[1067]=new Array("罗田县","黄冈","罗田县");
            array[1068]=new Array("麻城市","黄冈","麻城市");
            array[1069]=new Array("团风县","黄冈","团风县");
            array[1070]=new Array("武穴市","黄冈","武穴市");
            array[1071]=new Array("英山县","黄冈","英山县");
            array[1072]=new Array("蕲春县","黄冈","蕲春县");
            array[1073]=new Array("浠水县","黄冈","浠水县");
            array[1074]=new Array("大冶市","黄石","大冶市");
            array[1075]=new Array("黄石市","黄石","黄石市");
            array[1076]=new Array("阳新县","黄石","阳新县");
            array[1077]=new Array("荆门市","荆门","荆门市");
            array[1078]=new Array("京山县","荆门","京山县");
            array[1079]=new Array("沙洋县","荆门","沙洋县");
            array[1080]=new Array("钟祥市","荆门","钟祥市");
            array[1081]=new Array("公安县","荆州","公安县");
            array[1082]=new Array("洪湖市","荆州","洪湖市");
            array[1083]=new Array("监利县","荆州","监利县");
            array[1084]=new Array("江陵县","荆州","江陵县");
            array[1085]=new Array("荆州市","荆州","荆州市");
            array[1086]=new Array("石首市","荆州","石首市");
            array[1087]=new Array("松滋市","荆州","松滋市");
            array[1088]=new Array("潜江市","潜江","潜江市");
            array[1089]=new Array("神农架林区","神农架林区","神农架林区");
            array[1090]=new Array("丹江口市","十堰","丹江口市");
            array[1091]=new Array("房县","十堰","房县");
            array[1092]=new Array("十堰市","十堰","十堰市");
            array[1093]=new Array("郧西县","十堰","郧西县");
            array[1094]=new Array("郧县","十堰","郧县");
            array[1095]=new Array("竹山县","十堰","竹山县");
            array[1096]=new Array("竹溪县","十堰","竹溪县");

            array[1097]=new Array("广水市","随州","广水市");
            array[1098]=new Array("随州市","随州","随州市");
            array[1099]=new Array("天门市","天门","天门市");
            array[1100]=new Array("武汉市","武汉","武汉市");
            array[1101]=new Array("仙桃市","仙桃","仙桃市");
            array[1102]=new Array("赤壁市","咸宁","赤壁市");
            array[1103]=new Array("崇阳县","咸宁","崇阳县");
            array[1104]=new Array("嘉鱼县","咸宁","嘉鱼县");
            array[1105]=new Array("通城县","咸宁","通城县");
            array[1106]=new Array("通山县","咸宁","通山县");
            array[1107]=new Array("咸宁市","咸宁","咸宁市");
            array[1108]=new Array("保康县","襄樊","保康县");
            array[1109]=new Array("谷城县","襄樊","谷城县");
            array[1110]=new Array("老河口市","襄樊","老河口市");
            array[1111]=new Array("南漳县","襄樊","南漳县");
            array[1112]=new Array("襄樊市","襄樊","襄樊市");
            array[1113]=new Array("宜城市","襄樊","宜城市");
            array[1114]=new Array("枣阳市","襄樊","枣阳市");
            array[1115]=new Array("安陆市","孝感","安陆市");
            array[1116]=new Array("大悟县","孝感","大悟县");
            array[1117]=new Array("汉川市","孝感","汉川市");
            array[1118]=new Array("孝昌县","孝感","孝昌县");
            array[1119]=new Array("孝感市","孝感","孝感市");
            array[1120]=new Array("应城市","孝感","应城市");
            array[1121]=new Array("云梦县","孝感","云梦县");
            array[1122]=new Array("长阳土家族自治县","宜昌","长阳土家族自治县");
            array[1123]=new Array("当阳市","宜昌","当阳市");
            array[1124]=new Array("五峰土家族自治县","宜昌","五峰土家族自治县");
            array[1125]=new Array("兴山县","宜昌","兴山县");
            array[1126]=new Array("宜昌市","宜昌","宜昌市");
            array[1127]=new Array("宜都市","宜昌","宜都市");
            array[1128]=new Array("远安县","宜昌","远安县");
            array[1129]=new Array("枝江市","宜昌","枝江市");
            array[1130]=new Array("秭归县","宜昌","秭归县");

            array[1131]=new Array("常德","湖南","常德");
            array[1132]=new Array("长沙","湖南","长沙");
            array[1133]=new Array("郴州","湖南","郴州");
            array[1134]=new Array("衡阳","湖南","衡阳");
            array[1135]=new Array("怀化","湖南","怀化");
            array[1136]=new Array("娄底","湖南","娄底");
            array[1137]=new Array("邵阳","湖南","邵阳");
            array[1138]=new Array("湘潭","湖南","湘潭");
            array[1139]=new Array("湘西土家族苗族自治州","湖南","湘西土家族苗族自治州");
            array[1140]=new Array("益阳","湖南","益阳");
            array[1141]=new Array("永州","湖南","永州");
            array[1142]=new Array("岳阳","湖南","岳阳");
            array[1143]=new Array("张家界","湖南","张家界");
            array[1144]=new Array("株洲","湖南","株洲");

            array[1145]=new Array("安乡县","常德","安乡县");
            array[1146]=new Array("常德市","常德","常德市");
            array[1147]=new Array("汉寿县","常德","汉寿县");
            array[1148]=new Array("津市市","常德","津市市");
            array[1149]=new Array("临澧县","常德","临澧县");
            array[1150]=new Array("石门县","常德","石门县");
            array[1151]=new Array("桃源县","常德","桃源县");
            array[1152]=new Array("澧县","常德","澧县");
            array[1153]=new Array("长沙市","长沙","长沙市");
            array[1154]=new Array("长沙县","长沙","长沙县");
            array[1155]=new Array("宁乡县","长沙","宁乡县");
            array[1156]=new Array("望城县","长沙","望城县");
            array[1157]=new Array("浏阳市","长沙","浏阳市");
            array[1158]=new Array("安仁县","郴州","安仁县");
            array[1159]=new Array("郴州市","郴州","郴州市");
            array[1160]=new Array("桂东县","郴州","桂东县");
            array[1161]=new Array("桂阳县","郴州","桂阳县");
            array[1162]=new Array("嘉禾县","郴州","嘉禾县");
            array[1163]=new Array("临武县","郴州","临武县");
            array[1164]=new Array("汝城县","郴州","汝城县");
            array[1165]=new Array("宜章县","郴州","宜章县");
            array[1166]=new Array("永兴县","郴州","永兴县");
            array[1167]=new Array("资兴市","郴州","资兴市");
            array[1168]=new Array("常宁市","衡阳","常宁市");
            array[1169]=new Array("衡东县","衡阳","衡东县");
            array[1170]=new Array("衡南县","衡阳","衡南县");
            array[1171]=new Array("衡山县","衡阳","衡山县");
            array[1172]=new Array("衡阳市","衡阳","衡阳市");
            array[1173]=new Array("衡阳县","衡阳","衡阳县");
            array[1174]=new Array("祁东县","衡阳","祁东县");
            array[1175]=new Array("耒阳市","衡阳","耒阳市");
            array[1176]=new Array("辰溪县","怀化","辰溪县");
            array[1177]=new Array("洪江市","怀化","洪江市");
            array[1178]=new Array("怀化市","怀化","怀化市");
            array[1179]=new Array("会同县","怀化","会同县");
            array[1180]=new Array("靖州苗族侗族自治县","怀化","靖州苗族侗族自治县");
            array[1181]=new Array("麻阳苗族自治县","怀化","麻阳苗族自治县");
            array[1182]=new Array("通道侗族自治县","怀化","通道侗族自治县");
            array[1183]=new Array("新晃侗族自治县","怀化","新晃侗族自治县");
            array[1184]=new Array("中方县","怀化","中方县");
            array[1185]=new Array("芷江侗族自治县","怀化","芷江侗族自治县");
            array[1186]=new Array("沅陵县","怀化","沅陵县");
            array[1187]=new Array("溆浦县","怀化","溆浦县");
            array[1188]=new Array("冷水江市","娄底","冷水江市");
            array[1189]=new Array("涟源市","娄底","涟源市");
            array[1190]=new Array("娄底市","娄底","娄底市");
            array[1191]=new Array("双峰县","娄底","双峰县");
            array[1192]=new Array("新化县","娄底","新化县");

            array[1193]=new Array("城步苗族自治县","邵阳","城步苗族自治县");
            array[1194]=new Array("洞口县","邵阳","洞口县");
            array[1195]=new Array("隆回县","邵阳","隆回县");
            array[1196]=new Array("邵东县","邵阳","邵东县");
            array[1197]=new Array("邵阳市","邵阳","邵阳市");
            array[1198]=new Array("邵阳县","邵阳","邵阳县");
            array[1199]=new Array("绥宁县","邵阳","绥宁县");
            array[1200]=new Array("武冈市","邵阳","武冈市");
            array[1201]=new Array("新宁县","邵阳","新宁县");
            array[1202]=new Array("新邵县","邵阳","新邵县");
            array[1203]=new Array("韶山市","湘潭","韶山市");
            array[1204]=new Array("湘潭市","湘潭","湘潭市");
            array[1205]=new Array("湘潭县","湘潭","湘潭县");
            array[1206]=new Array("湘乡市","湘潭","湘乡市");
            array[1207]=new Array("保靖县","湘西土家族苗族自治州","保靖县");
            array[1208]=new Array("凤凰县","湘西土家族苗族自治州","凤凰县");
            array[1209]=new Array("古丈县","湘西土家族苗族自治州","古丈县");
            array[1210]=new Array("花垣县","湘西土家族苗族自治州","花垣县");
            array[1211]=new Array("吉首市","湘西土家族苗族自治州","吉首市");
            array[1212]=new Array("龙山县","湘西土家族苗族自治州","龙山县");
            array[1213]=new Array("永顺县","湘西土家族苗族自治州","永顺县");
            array[1214]=new Array("泸溪县","湘西土家族苗族自治州","泸溪县");
            array[1215]=new Array("安化县","益阳","安化县");
            array[1216]=new Array("南县","益阳","南县");
            array[1217]=new Array("桃江县","益阳","桃江县");
            array[1218]=new Array("益阳市","益阳","益阳市");
            array[1219]=new Array("沅江市","益阳","沅江市");
            array[1220]=new Array("道县","永州","道县");
            array[1221]=new Array("东安县","永州","东安县");
            array[1222]=new Array("江华瑶族自治县","永州","江华瑶族自治县");
            array[1223]=new Array("江永县","永州","江永县");
            array[1224]=new Array("蓝山县","永州","蓝山县");
            array[1225]=new Array("宁远县","永州","宁远县");
            array[1226]=new Array("祁阳县","永州","祁阳县");
            array[1227]=new Array("双牌县","永州","双牌县");
            array[1228]=new Array("新田县","永州","新田县");
            array[1229]=new Array("永州市","永州","永州市");
            array[1230]=new Array("华容县","岳阳","华容县");
            array[1231]=new Array("临湘市","岳阳","临湘市");
            array[1232]=new Array("平江县","岳阳","平江县");
            array[1233]=new Array("湘阴县","岳阳","湘阴县");
            array[1234]=new Array("岳阳市","岳阳","岳阳市");
            array[1235]=new Array("岳阳县","岳阳","岳阳县");
            array[1236]=new Array("汨罗市","岳阳","汨罗市");
            array[1237]=new Array("慈利县","张家界","慈利县");
            array[1238]=new Array("桑植县","张家界","桑植县");
            array[1239]=new Array("张家界市","张家界","张家界市");
            array[1240]=new Array("茶陵县","株洲","茶陵县");
            array[1241]=new Array("炎陵县","株洲","炎陵县");
            array[1242]=new Array("株洲市","株洲","株洲市");
            array[1243]=new Array("株洲县","株洲","株洲县");
            array[1244]=new Array("攸县","株洲","攸县");
            array[1245]=new Array("醴陵市","株洲","醴陵市");

            array[1246]=new Array("白城","吉林","白城");
            array[1247]=new Array("白山","吉林","白山");
            array[1248]=new Array("长春","吉林","长春");
            array[1249]=new Array("吉林","吉林","吉林");
            array[1250]=new Array("辽源","吉林","辽源");
            array[1251]=new Array("四平","吉林","四平");
            array[1252]=new Array("松原","吉林","松原");
            array[1253]=new Array("通化","吉林","通化");
            array[1254]=new Array("延边朝鲜族自治州","吉林","延边朝鲜族自治州");


            array[1255]=new Array("白城市","白城","白城市");
            array[1256]=new Array("大安市","白城","大安市");
            array[1257]=new Array("通榆县","白城","通榆县");
            array[1258]=new Array("镇赉县","白城","镇赉县");
            array[1259]=new Array("洮南市","白城","洮南市");
            array[1260]=new Array("白山市","白山","白山市");
            array[1261]=new Array("长白朝鲜族自治县","白山","长白朝鲜族自治县");
            array[1262]=new Array("抚松县","白山","抚松县");
            array[1263]=new Array("江源县","白山","江源县");
            array[1264]=new Array("靖宇县","白山","靖宇县");
            array[1265]=new Array("临江市","白山","临江市");
            array[1266]=new Array("长春市","长春","长春市");
            array[1267]=new Array("德惠市","长春","德惠市");
            array[1268]=new Array("九台市","长春","九台市");
            array[1269]=new Array("农安县","长春","农安县");
            array[1270]=new Array("榆树市","长春","榆树市");
            array[1271]=new Array("吉林市","吉林","吉林市");
            array[1272]=new Array("磐石市","吉林","磐石市");
            array[1273]=new Array("舒兰市","吉林","舒兰市");
            array[1274]=new Array("永吉县","吉林","永吉县");
            array[1275]=new Array("桦甸市","吉林","桦甸市");
            array[1276]=new Array("蛟河市","吉林","蛟河市");
            array[1277]=new Array("东丰县","辽源","东丰县");
            array[1278]=new Array("东辽县","辽源","东辽县");
            array[1279]=new Array("辽源市","辽源","辽源市");
            array[1280]=new Array("公主岭市","四平","公主岭市");
            array[1281]=new Array("梨树县","四平","梨树县");
            array[1282]=new Array("双辽市","四平","双辽市");
            array[1283]=new Array("四平市","四平","四平市");
            array[1284]=new Array("伊通满族自治县","四平","伊通满族自治县");
            array[1285]=new Array("长岭县","松原","长岭县");
            array[1286]=new Array("扶余县","松原","扶余县");
            array[1287]=new Array("乾安县","松原","乾安县");
            array[1288]=new Array("前郭尔罗斯蒙古族自治县","松原","前郭尔罗斯蒙古族自治县");
            array[1289]=new Array("松原市","松原","松原市");
            array[1290]=new Array("辉南县","通化","辉南县");
            array[1291]=new Array("集安市","通化","集安市");
            array[1292]=new Array("柳河县","通化","柳河县");
            array[1293]=new Array("梅河口市","通化","梅河口市");
            array[1294]=new Array("通化市","通化","通化市");
            array[1295]=new Array("通化县","通化","通化县");
            array[1296]=new Array("安图县","延边朝鲜族自治州","安图县");
            array[1297]=new Array("敦化市","延边朝鲜族自治州","敦化市");
            array[1298]=new Array("和龙市","延边朝鲜族自治州","和龙市");
            array[1299]=new Array("龙井市","延边朝鲜族自治州","龙井市");
            array[1300]=new Array("图们市","延边朝鲜族自治州","图们市");
            array[1301]=new Array("汪清县","延边朝鲜族自治州","汪清县");
            array[1302]=new Array("延吉市","延边朝鲜族自治州","延吉市");
            array[1303]=new Array("珲春市","延边朝鲜族自治州","珲春市");

            array[1304]=new Array("常州","江苏","常州");
            array[1305]=new Array("淮安","江苏","淮安");
            array[1306]=new Array("连云港","江苏","连云港");
            array[1307]=new Array("南京","江苏","南京");
            array[1308]=new Array("南通","江苏","南通");
            array[1309]=new Array("苏州","江苏","苏州");
            array[1310]=new Array("宿迁","江苏","宿迁");
            array[1311]=new Array("泰州","江苏","泰州");
            array[1312]=new Array("无锡","江苏","无锡");
            array[1313]=new Array("徐州","江苏","徐州");
            array[1314]=new Array("盐城","江苏","盐城");
            array[1315]=new Array("扬州","江苏","扬州");
            array[1316]=new Array("镇江","江苏","镇江");

            array[1317]=new Array("常州市","常州","常州市");
            array[1318]=new Array("金坛市","常州","金坛市");
            array[1319]=new Array("溧阳市","常州","溧阳市");
            array[1320]=new Array("洪泽县","淮安","洪泽县");
            array[1321]=new Array("淮安市","淮安","淮安市");
            array[1322]=new Array("金湖县","淮安","金湖县");
            array[1323]=new Array("涟水县","淮安","涟水县");
            array[1324]=new Array("盱眙县","淮安","盱眙县");
            array[1325]=new Array("东海县","连云港","东海县");
            array[1326]=new Array("赣榆县","连云港","赣榆县");
            array[1327]=new Array("灌南县","连云港","灌南县");
            array[1328]=new Array("灌云县","连云港","灌云县");
            array[1329]=new Array("连云港市","连云港","连云港市");
            array[1330]=new Array("高淳县","南京","高淳县");
            array[1331]=new Array("南京市","南京","南京市");
            array[1332]=new Array("溧水县","南京","溧水县");
            array[1333]=new Array("海安县","南通","海安县");
            array[1334]=new Array("海门市","南通","海门市");
            array[1335]=new Array("南通市","南通","南通市");
            array[1336]=new Array("启东市","南通","启东市");
            array[1337]=new Array("如东县","南通","如东县");
            array[1338]=new Array("如皋市","南通","如皋市");
            array[1339]=new Array("通州市","南通","通州市");
            array[1340]=new Array("常熟市","苏州","常熟市");
            array[1341]=new Array("昆山市","苏州","昆山市");
            array[1342]=new Array("苏州市","苏州","苏州市");
            array[1343]=new Array("太仓市","苏州","太仓市");
            array[1344]=new Array("吴江市","苏州","吴江市");
            array[1345]=new Array("张家港市","苏州","张家港市");
            array[1346]=new Array("宿迁市","宿迁","宿迁市");
            array[1347]=new Array("宿豫县","宿迁","宿豫县");
            array[1348]=new Array("沭阳县","宿迁","沭阳县");
            array[1349]=new Array("泗洪县","宿迁","泗洪县");
            array[1350]=new Array("泗阳县","宿迁","泗阳县");
            array[1351]=new Array("姜堰市","泰州","姜堰市");
            array[1352]=new Array("靖江市","泰州","靖江市");
            array[1353]=new Array("泰兴市","泰州","泰兴市");
            array[1354]=new Array("泰州市","泰州","泰州市");
            array[1355]=new Array("兴化市","泰州","兴化市");
            array[1356]=new Array("江阴市","无锡","江阴市");
            array[1357]=new Array("无锡市","无锡","无锡市");
            array[1358]=new Array("宜兴市","无锡","宜兴市");
            array[1359]=new Array("丰县","徐州","丰县");
            array[1360]=new Array("沛县","徐州","沛县");
            array[1361]=new Array("铜山县","徐州","铜山县");
            array[1362]=new Array("新沂市","徐州","新沂市");
            array[1363]=new Array("徐州市","徐州","徐州市");
            array[1364]=new Array("邳州市","徐州","邳州市");
            array[1365]=new Array("睢宁县","徐州","睢宁县");
            array[1366]=new Array("滨海县","盐城","滨海县");
            array[1367]=new Array("大丰市","盐城","大丰市");
            array[1368]=new Array("东台市","盐城","东台市");
            array[1369]=new Array("阜宁县","盐城","阜宁县");
            array[1370]=new Array("建湖县","盐城","建湖县");
            array[1371]=new Array("射阳县","盐城","射阳县");
            array[1372]=new Array("响水县","盐城","响水县");
            array[1373]=new Array("盐城市","盐城","盐城市");
            array[1374]=new Array("盐都县","盐城","盐都县");
            array[1375]=new Array("宝应县","扬州","宝应县");
            array[1376]=new Array("高邮市","扬州","高邮市");
            array[1377]=new Array("江都市","扬州","江都市");
            array[1378]=new Array("扬州市","扬州","扬州市");
            array[1379]=new Array("仪征市","扬州","仪征市");
            array[1380]=new Array("丹阳市","镇江","丹阳市");
            array[1381]=new Array("句容市","镇江","句容市");
            array[1382]=new Array("扬中市","镇江","扬中市");
            array[1383]=new Array("镇江市","镇江","镇江市");


            array[1384]=new Array("抚州","江西","抚州");
            array[1385]=new Array("赣州","江西","赣州");
            array[1386]=new Array("吉安","江西","吉安");
            array[1387]=new Array("景德镇","江西","景德镇");
            array[1388]=new Array("九江","江西","九江");
            array[1389]=new Array("南昌","江西","南昌");
            array[1390]=new Array("萍乡","江西","萍乡");
            array[1391]=new Array("上饶","江西","上饶");
            array[1392]=new Array("新余","江西","新余");
            array[1393]=new Array("宜春","江西","宜春");
            array[1394]=new Array("鹰潭","江西","鹰潭");


            array[1395]=new Array("崇仁县","抚州","崇仁县");
            array[1396]=new Array("东乡县","抚州","东乡县");
            array[1397]=new Array("抚州市","抚州","抚州市");
            array[1398]=new Array("广昌县","抚州","广昌县");
            array[1399]=new Array("金溪县","抚州","金溪县");
            array[1400]=new Array("乐安县","抚州","乐安县");
            array[1401]=new Array("黎川县","抚州","黎川县");
            array[1402]=new Array("南城县","抚州","南城县");
            array[1403]=new Array("南丰县","抚州","南丰县");
            array[1404]=new Array("宜黄县","抚州","宜黄县");
            array[1405]=new Array("资溪县","抚州","资溪县");
            array[1406]=new Array("安远县","赣州","安远县");
            array[1407]=new Array("崇义县","赣州","崇义县");
            array[1408]=new Array("大余县","赣州","大余县");
            array[1409]=new Array("定南县","赣州","定南县");
            array[1410]=new Array("赣县","赣州","赣县");
            array[1411]=new Array("赣州市","赣州","赣州市");
            array[1412]=new Array("会昌县","赣州","会昌县");
            array[1413]=new Array("龙南县","赣州","龙南县");
            array[1414]=new Array("南康市","赣州","南康市");
            array[1415]=new Array("宁都县","赣州","宁都县");
            array[1416]=new Array("全南县","赣州","全南县");
            array[1417]=new Array("瑞金市","赣州","瑞金市");
            array[1418]=new Array("上犹县","赣州","上犹县");
            array[1419]=new Array("石城县","赣州","石城县");
            array[1420]=new Array("信丰县","赣州","信丰县");
            array[1421]=new Array("兴国县","赣州","兴国县");
            array[1422]=new Array("寻乌县","赣州","寻乌县");
            array[1423]=new Array("于都县","赣州","于都县");
            array[1424]=new Array("安福县","吉安","安福县");
            array[1425]=new Array("吉安市","吉安","吉安市");
            array[1426]=new Array("吉安县","吉安","吉安县");
            array[1427]=new Array("吉水县","吉安","吉水县");
            array[1428]=new Array("井冈山市","吉安","井冈山市");
            array[1429]=new Array("遂川县","吉安","遂川县");
            array[1430]=new Array("泰和县","吉安","泰和县");
            array[1431]=new Array("万安县","吉安","万安县");
            array[1432]=new Array("峡江县","吉安","峡江县");
            array[1433]=new Array("新干县","吉安","新干县");
            array[1434]=new Array("永丰县","吉安","永丰县");
            array[1435]=new Array("永新县","吉安","永新县");
            array[1436]=new Array("浮梁县","景德镇","浮梁县");
            array[1437]=new Array("景德镇市","景德镇","景德镇市");
            array[1438]=new Array("乐平市","景德镇","乐平市");
            array[1439]=new Array("德安县","九江","德安县");
            array[1440]=new Array("都昌县","九江","都昌县");
            array[1441]=new Array("湖口县","九江","湖口县");
            array[1442]=new Array("九江市","九江","九江市");
            array[1443]=new Array("九江县","九江","九江县");
            array[1444]=new Array("彭泽县","九江","彭泽县");
            array[1445]=new Array("瑞昌市","九江","瑞昌市");
            array[1446]=new Array("武宁县","九江","武宁县");
            array[1447]=new Array("星子县","九江","星子县");
            array[1448]=new Array("修水县","九江","修水县");
            array[1449]=new Array("永修县","九江","永修县");
            array[1450]=new Array("安义县","南昌","安义县");
            array[1451]=new Array("进贤县","南昌","进贤县");
            array[1452]=new Array("南昌市","南昌","南昌市");
            array[1453]=new Array("南昌县","南昌","南昌县");
            array[1454]=new Array("新建县","南昌","新建县");
            array[1455]=new Array("莲花县","萍乡","莲花县");
            array[1456]=new Array("芦溪县","萍乡","芦溪县");
            array[1457]=new Array("萍乡市","萍乡","萍乡市");
            array[1458]=new Array("上栗县","萍乡","上栗县");
            array[1459]=new Array("波阳县","上饶","波阳县");
            array[1460]=new Array("德兴市","上饶","德兴市");
            array[1461]=new Array("广丰县","上饶","广丰县");
            array[1462]=new Array("横峰县","上饶","横峰县");
            array[1463]=new Array("铅山县","上饶","铅山县");
            array[1464]=new Array("上饶市","上饶","上饶市");
            array[1465]=new Array("上饶县","上饶","上饶县");
            array[1466]=new Array("万年县","上饶","万年县");
            array[1467]=new Array("余干县","上饶","余干县");
            array[1468]=new Array("玉山县","上饶","玉山县");
            array[1469]=new Array("弋阳县","上饶","弋阳县");
            array[1470]=new Array("婺源县","上饶","婺源县");
            array[1471]=new Array("分宜县","新余","分宜县");
            array[1472]=new Array("新余市","新余","新余市");
            array[1473]=new Array("丰城市","宜春","丰城市");
            array[1474]=new Array("奉新县","宜春","奉新县");
            array[1475]=new Array("高安市","宜春","高安市");
            array[1476]=new Array("靖安县","宜春","靖安县");
            array[1477]=new Array("上高县","宜春","上高县");
            array[1478]=new Array("铜鼓县","宜春","铜鼓县");
            array[1479]=new Array("万载县","宜春","万载县");
            array[1480]=new Array("宜春市","宜春","宜春市");
            array[1481]=new Array("宜丰县","宜春","宜丰县");
            array[1482]=new Array("樟树市","宜春","樟树市");
            array[1483]=new Array("贵溪市","鹰潭","贵溪市");
            array[1484]=new Array("鹰潭市","鹰潭","鹰潭市");
            array[1485]=new Array("余江县","鹰潭","余江县");

            array[1486]=new Array("鞍山","辽宁","鞍山");
            array[1487]=new Array("本溪","辽宁","本溪");
            array[1488]=new Array("朝阳","辽宁","朝阳");
            array[1489]=new Array("大连","辽宁","大连");
            array[1490]=new Array("丹东","辽宁","丹东");
            array[1491]=new Array("抚顺","辽宁","抚顺");
            array[1492]=new Array("阜新","辽宁","阜新");
            array[1493]=new Array("葫芦岛","辽宁","葫芦岛");
            array[1494]=new Array("锦州","辽宁","锦州");
            array[1495]=new Array("辽阳","辽宁","辽阳");
            array[1496]=new Array("盘锦","辽宁","盘锦");
            array[1497]=new Array("沈阳","辽宁","沈阳");
            array[1498]=new Array("铁岭","辽宁","铁岭");
            array[1499]=new Array("营口","辽宁","营口");

            array[1500]=new Array("鞍山市","鞍山","鞍山市");
            array[1501]=new Array("海城市","鞍山","海城市");
            array[1502]=new Array("台安县","鞍山","台安县");
            array[1503]=new Array("岫岩满族自治县","鞍山","岫岩满族自治县");
            array[1504]=new Array("本溪满族自治县","本溪","本溪满族自治县");
            array[1505]=new Array("本溪市","本溪","本溪市");
            array[1506]=new Array("桓仁满族自治县","本溪","桓仁满族自治县");
            array[1507]=new Array("北票市","朝阳","北票市");
            array[1508]=new Array("朝阳市","朝阳","朝阳市");
            array[1509]=new Array("朝阳县","朝阳","朝阳县");
            array[1510]=new Array("建平县","朝阳","建平县");
            array[1511]=new Array("喀喇沁左翼蒙古族自治县","朝阳","喀喇沁左翼蒙古族自治县");
            array[1512]=new Array("凌源市","朝阳","凌源市");
            array[1513]=new Array("长海县","大连","长海县");
            array[1514]=new Array("大连市","大连","大连市");
            array[1515]=new Array("普兰店市","大连","普兰店市");
            array[1516]=new Array("瓦房店市","大连","瓦房店市");
            array[1517]=new Array("庄河市","大连","庄河市");
            array[1518]=new Array("丹东市","丹东","丹东市");
            array[1519]=new Array("东港市","丹东","东港市");
            array[1520]=new Array("凤城市","丹东","凤城市");
            array[1521]=new Array("宽甸满族自治县","丹东","宽甸满族自治县");
            array[1522]=new Array("抚顺市","抚顺","抚顺市");
            array[1523]=new Array("抚顺县","抚顺","抚顺县");
            array[1524]=new Array("清原满族自治县","抚顺","清原满族自治县");
            array[1525]=new Array("新宾满族自治县","抚顺","新宾满族自治县");
            array[1526]=new Array("阜新蒙古族自治县","阜新","阜新蒙古族自治县");
            array[1527]=new Array("阜新市","阜新","阜新市");
            array[1528]=new Array("彰武县","阜新","彰武县");
            array[1529]=new Array("葫芦岛市","葫芦岛","葫芦岛市");
            array[1530]=new Array("建昌县","葫芦岛","建昌县");
            array[1531]=new Array("绥中县","葫芦岛","绥中县");
            array[1532]=new Array("兴城市","葫芦岛","兴城市");
            array[1533]=new Array("北宁市","锦州","北宁市");
            array[1534]=new Array("黑山县","锦州","黑山县");
            array[1535]=new Array("锦州市","锦州","锦州市");
            array[1536]=new Array("凌海市","锦州","凌海市");
            array[1537]=new Array("义县","锦州","义县");
            array[1538]=new Array("灯塔市","辽阳","灯塔市");
            array[1539]=new Array("辽阳市","辽阳","辽阳市");
            array[1540]=new Array("辽阳县","辽阳","辽阳县");
            array[1541]=new Array("大洼县","盘锦","大洼县");
            array[1542]=new Array("盘锦市","盘锦","盘锦市");
            array[1543]=new Array("盘山县","盘锦","盘山县");
            array[1544]=new Array("法库县","沈阳","法库县");
            array[1545]=new Array("康平县","沈阳","康平县");
            array[1546]=new Array("辽中县","沈阳","辽中县");
            array[1547]=new Array("沈阳市","沈阳","沈阳市");
            array[1548]=new Array("新民市","沈阳","新民市");
            array[1549]=new Array("昌图县","铁岭","昌图县");
            array[1550]=new Array("调兵山市","铁岭","调兵山市");
            array[1551]=new Array("开原市","铁岭","开原市");
            array[1552]=new Array("铁岭市","铁岭","铁岭市");
            array[1553]=new Array("铁岭县","铁岭","铁岭县");
            array[1554]=new Array("西丰县","铁岭","西丰县");
            array[1555]=new Array("大石桥市","营口","大石桥市");
            array[1556]=new Array("盖州市","营口","盖州市");
            array[1557]=new Array("营口市","营口","营口市");

            array[1558]=new Array("阿拉善盟","内蒙古","阿拉善盟");
            array[1559]=new Array("巴彦淖尔盟","内蒙古","巴彦淖尔盟");
            array[1560]=new Array("包头","内蒙古","包头");
            array[1561]=new Array("赤峰","内蒙古","赤峰");
            array[1562]=new Array("鄂尔多斯","内蒙古","鄂尔多斯");
            array[1563]=new Array("呼和浩特","内蒙古","呼和浩特");
            array[1564]=new Array("呼伦贝尔","内蒙古","呼伦贝尔");
            array[1565]=new Array("通辽","内蒙古","通辽");
            array[1566]=new Array("乌海","内蒙古","乌海");
            array[1567]=new Array("乌兰察布盟","内蒙古","乌兰察布盟");
            array[1568]=new Array("锡林郭勒盟","内蒙古","锡林郭勒盟");
            array[1569]=new Array("兴安盟","内蒙古","兴安盟");

            array[1570]=new Array("阿拉善右旗","阿拉善盟","阿拉善右旗");
            array[1571]=new Array("阿拉善左旗","阿拉善盟","阿拉善左旗");
            array[1572]=new Array("额济纳旗","阿拉善盟","额济纳旗");
            array[1573]=new Array("杭锦后旗","巴彦淖尔盟","杭锦后旗");
            array[1574]=new Array("临河市","巴彦淖尔盟","临河市");
            array[1575]=new Array("乌拉特后旗","巴彦淖尔盟","乌拉特后旗");
            array[1576]=new Array("乌拉特前旗","巴彦淖尔盟","乌拉特前旗");
            array[1577]=new Array("乌拉特中旗","巴彦淖尔盟","乌拉特中旗");
            array[1578]=new Array("五原县","巴彦淖尔盟","五原县");
            array[1579]=new Array("磴口县","巴彦淖尔盟","磴口县");
            array[1580]=new Array("包头市","包头","包头市");
            array[1581]=new Array("达尔罕茂明安联合旗","包头","达尔罕茂明安联合旗");
            array[1582]=new Array("固阳县","包头","固阳县");
            array[1583]=new Array("土默特右旗","包头","土默特右旗");
            array[1584]=new Array("阿鲁科尔沁旗","赤峰","阿鲁科尔沁旗");
            array[1585]=new Array("敖汉旗","赤峰","敖汉旗");
            array[1586]=new Array("巴林右旗","赤峰","巴林右旗");
            array[1587]=new Array("巴林左旗","赤峰","巴林左旗");
            array[1588]=new Array("赤峰市","赤峰","赤峰市");
            array[1589]=new Array("喀喇沁旗","赤峰","喀喇沁旗");
            array[1590]=new Array("克什克腾旗","赤峰","克什克腾旗");
            array[1591]=new Array("林西县","赤峰","林西县");
            array[1592]=new Array("宁城县","赤峰","宁城县");
            array[1593]=new Array("翁牛特旗","赤峰","翁牛特旗");
            array[1594]=new Array("达拉特旗","鄂尔多斯","达拉特旗");
            array[1595]=new Array("鄂尔多斯市","鄂尔多斯","鄂尔多斯市");
            array[1596]=new Array("鄂托克旗","鄂尔多斯","鄂托克旗");
            array[1597]=new Array("鄂托克前旗","鄂尔多斯","鄂托克前旗");
            array[1598]=new Array("杭锦旗","鄂尔多斯","杭锦旗");
            array[1599]=new Array("乌审旗","鄂尔多斯","乌审旗");
            array[1600]=new Array("伊金霍洛旗","鄂尔多斯","伊金霍洛旗");
            array[1601]=new Array("准格尔旗","鄂尔多斯","准格尔旗");
            array[1602]=new Array("和林格尔县","呼和浩特","和林格尔县");
            array[1603]=new Array("呼和浩特市","呼和浩特","呼和浩特市");
            array[1604]=new Array("清水河县","呼和浩特","清水河县");
            array[1605]=new Array("土默特左旗","呼和浩特","土默特左旗");
            array[1606]=new Array("托克托县","呼和浩特","托克托县");
            array[1607]=new Array("武川县","呼和浩特","武川县");
            array[1608]=new Array("阿荣旗","呼伦贝尔","阿荣旗");
            array[1609]=new Array("陈巴尔虎旗","呼伦贝尔","陈巴尔虎旗");
            array[1610]=new Array("额尔古纳市","呼伦贝尔","额尔古纳市");
            array[1611]=new Array("鄂伦春自治旗","呼伦贝尔","鄂伦春自治旗");
            array[1612]=new Array("鄂温克族自治旗","呼伦贝尔","鄂温克族自治旗");
            array[1613]=new Array("根河市","呼伦贝尔","根河市");
            array[1614]=new Array("呼伦贝尔市","呼伦贝尔","呼伦贝尔市");
            array[1615]=new Array("满洲里市","呼伦贝尔","满洲里市");
            array[1616]=new Array("莫力达瓦达斡尔族自治旗","呼伦贝尔","莫力达瓦达斡尔族自治旗");
            array[1617]=new Array("新巴尔虎右旗","呼伦贝尔","新巴尔虎右旗");
            array[1618]=new Array("新巴尔虎左旗","呼伦贝尔","新巴尔虎左旗");
            array[1619]=new Array("牙克石市","呼伦贝尔","牙克石市");
            array[1620]=new Array("扎兰屯市","呼伦贝尔","扎兰屯市");
            array[1621]=new Array("霍林郭勒市","通辽","霍林郭勒市");
            array[1622]=new Array("开鲁县","通辽","开鲁县");
            array[1623]=new Array("科尔沁左翼后旗","通辽","科尔沁左翼后旗");
            array[1624]=new Array("科尔沁左翼中旗","通辽","科尔沁左翼中旗");
            array[1625]=new Array("库伦旗","通辽","库伦旗");
            array[1626]=new Array("奈曼旗","通辽","奈曼旗");
            array[1627]=new Array("通辽市","通辽","通辽市");
            array[1628]=new Array("扎鲁特旗","通辽","扎鲁特旗");
            array[1629]=new Array("乌海市","乌海","乌海市");
            array[1630]=new Array("察哈尔右翼后旗","乌兰察布盟","察哈尔右翼后旗");
            array[1631]=new Array("察哈尔右翼前旗","乌兰察布盟","察哈尔右翼前旗");
            array[1632]=new Array("察哈尔右翼中旗","乌兰察布盟","察哈尔右翼中旗");
            array[1633]=new Array("丰镇市","乌兰察布盟","丰镇市");
            array[1634]=new Array("化德县","乌兰察布盟","化德县");
            array[1635]=new Array("集宁市","乌兰察布盟","集宁市");
            array[1636]=new Array("凉城县","乌兰察布盟","凉城县");
            array[1637]=new Array("商都县","乌兰察布盟","商都县");
            array[1638]=new Array("四子王旗","乌兰察布盟","四子王旗");
            array[1639]=new Array("兴和县","乌兰察布盟","兴和县");
            array[1640]=new Array("卓资县","乌兰察布盟","卓资县");
            array[1641]=new Array("阿巴嘎旗","锡林郭勒盟","阿巴嘎旗");
            array[1642]=new Array("东乌珠穆沁旗","锡林郭勒盟","东乌珠穆沁旗");
            array[1643]=new Array("多伦县","锡林郭勒盟","多伦县");
            array[1644]=new Array("二连浩特市","锡林郭勒盟","二连浩特市");
            array[1645]=new Array("苏尼特右旗","锡林郭勒盟","苏尼特右旗");
            array[1646]=new Array("苏尼特左旗","锡林郭勒盟","苏尼特左旗");
            array[1647]=new Array("太仆寺旗","锡林郭勒盟","太仆寺旗");
            array[1648]=new Array("西乌珠穆沁旗","锡林郭勒盟","西乌珠穆沁旗");
            array[1649]=new Array("锡林浩特市","锡林郭勒盟","锡林浩特市");
            array[1650]=new Array("镶黄旗","锡林郭勒盟","镶黄旗");
            array[1651]=new Array("正蓝旗","锡林郭勒盟","正蓝旗");
            array[1652]=new Array("正镶白旗","锡林郭勒盟","正镶白旗");
            array[1653]=new Array("阿尔山市","兴安盟","阿尔山市");
            array[1654]=new Array("科尔沁右翼前旗","兴安盟","科尔沁右翼前旗");
            array[1655]=new Array("科尔沁右翼中旗","兴安盟","科尔沁右翼中旗");
            array[1656]=new Array("突泉县","兴安盟","突泉县");
            array[1657]=new Array("乌兰浩特市","兴安盟","乌兰浩特市");
            array[1658]=new Array("扎赉特旗","兴安盟","扎赉特旗");

            array[1659]=new Array("固原","宁夏","固原");
            array[1660]=new Array("石嘴山","宁夏","石嘴山");
            array[1661]=new Array("吴忠","宁夏","吴忠");
            array[1662]=new Array("银川","宁夏","银川");

            array[1663]=new Array("固原市","固原","固原市");
            array[1664]=new Array("海原县","固原","海原县");
            array[1665]=new Array("隆德县","固原","隆德县");
            array[1666]=new Array("彭阳县","固原","彭阳县");
            array[1667]=new Array("西吉县","固原","西吉县");
            array[1668]=new Array("泾源县","固原","泾源县");
            array[1669]=new Array("惠农县","石嘴山","惠农县");
            array[1670]=new Array("平罗县","石嘴山","平罗县");
            array[1671]=new Array("石嘴山市","石嘴山","石嘴山市");
            array[1672]=new Array("陶乐县","石嘴山","陶乐县");
            array[1673]=new Array("青铜峡市","吴忠","青铜峡市");
            array[1674]=new Array("同心县","吴忠","同心县");
            array[1675]=new Array("吴忠市","吴忠","吴忠市");
            array[1676]=new Array("盐池县","吴忠","盐池县");
            array[1677]=new Array("中宁县","吴忠","中宁县");
            array[1678]=new Array("中卫县","吴忠","中卫县");
            array[1679]=new Array("贺兰县","银川","贺兰县");
            array[1680]=new Array("灵武市","银川","灵武市");
            array[1681]=new Array("银川市","银川","银川市");
            array[1682]=new Array("永宁县","银川","永宁县");


            array[1683]=new Array("果洛藏族自治州","青海","果洛藏族自治州");
            array[1684]=new Array("海北藏族自治州","青海","海北藏族自治州");
            array[1685]=new Array("海东","青海","海东");
            array[1686]=new Array("海南藏族自治州","青海","海南藏族自治州");
            array[1687]=new Array("海西蒙古族藏族自治州","青海","海西蒙古族藏族自治州");
            array[1688]=new Array("黄南藏族自治州","青海","黄南藏族自治州");
            array[1689]=new Array("西宁","青海","西宁");
            array[1690]=new Array("玉树藏族自治州","青海","玉树藏族自治州");

            array[1691]=new Array("班玛县","果洛藏族自治州","班玛县");
            array[1692]=new Array("达日县","果洛藏族自治州","达日县");
            array[1693]=new Array("甘德县","果洛藏族自治州","甘德县");
            array[1694]=new Array("久治县","果洛藏族自治州","久治县");
            array[1695]=new Array("玛多县","果洛藏族自治州","玛多县");
            array[1696]=new Array("玛沁县","果洛藏族自治州","玛沁县");
            array[1697]=new Array("刚察县","海北藏族自治州","刚察县");
            array[1698]=new Array("海晏县","海北藏族自治州","海晏县");
            array[1699]=new Array("门源回族自治县","海北藏族自治州","门源回族自治县");
            array[1700]=new Array("祁连县","海北藏族自治州","祁连县");
            array[1701]=new Array("互助土族自治县","海东","互助土族自治县");
            array[1702]=new Array("化隆回族自治县","海东","化隆回族自治县");
            array[1703]=new Array("乐都县","海东","乐都县");
            array[1704]=new Array("民和回族土族自治县","海东","民和回族土族自治县");
            array[1705]=new Array("平安县","海东","平安县");
            array[1706]=new Array("循化撒拉族自治县","海东","循化撒拉族自治县");
            array[1707]=new Array("共和县","海南藏族自治州","共和县");
            array[1708]=new Array("贵德县","海南藏族自治州","贵德县");
            array[1709]=new Array("贵南县","海南藏族自治州","贵南县");
            array[1710]=new Array("同德县","海南藏族自治州","同德县");
            array[1711]=new Array("兴海县","海南藏族自治州","兴海县");
            array[1712]=new Array("德令哈市","海西蒙古族藏族自治州","德令哈市");
            array[1713]=new Array("都兰县","海西蒙古族藏族自治州","都兰县");
            array[1714]=new Array("格尔木市","海西蒙古族藏族自治州","格尔木市");
            array[1715]=new Array("天峻县","海西蒙古族藏族自治州","天峻县");
            array[1716]=new Array("乌兰县","海西蒙古族藏族自治州","乌兰县");
            array[1717]=new Array("河南蒙古族自治县","黄南藏族自治州","河南蒙古族自治县");
            array[1718]=new Array("尖扎县","黄南藏族自治州","尖扎县");
            array[1719]=new Array("同仁县","黄南藏族自治州","同仁县");
            array[1720]=new Array("泽库县","黄南藏族自治州","泽库县");
            array[1721]=new Array("大通回族土族自治县","西宁","大通回族土族自治县");
            array[1722]=new Array("西宁市","西宁","西宁市");
            array[1723]=new Array("湟源县","西宁","湟源县");
            array[1724]=new Array("湟中县","西宁","湟中县");
            array[1725]=new Array("称多县","玉树藏族自治州","称多县");
            array[1726]=new Array("囊谦县","玉树藏族自治州","囊谦县");
            array[1727]=new Array("曲麻莱县","玉树藏族自治州","曲麻莱县");
            array[1728]=new Array("玉树县","玉树藏族自治州","玉树县");
            array[1729]=new Array("杂多县","玉树藏族自治州","杂多县");
            array[1730]=new Array("治多县","玉树藏族自治州","治多县");

            array[1731]=new Array("青海","根目录","青海");

            array[1732]=new Array("滨州","山东","滨州");
            array[1733]=new Array("德州","山东","德州");
            array[1734]=new Array("东营","山东","东营");
            array[1735]=new Array("菏泽","山东","菏泽");
            array[1736]=new Array("济南","山东","济南");
            array[1737]=new Array("济宁","山东","济宁");
            array[1738]=new Array("莱芜","山东","莱芜");
            array[1739]=new Array("聊城","山东","聊城");
            array[1740]=new Array("临沂","山东","临沂");
            array[1741]=new Array("青岛","山东","青岛");
            array[1742]=new Array("日照","山东","日照");
            array[1743]=new Array("泰安","山东","泰安");
            array[1744]=new Array("威海","山东","威海");
            array[1745]=new Array("潍坊","山东","潍坊");
            array[1746]=new Array("烟台","山东","烟台");
            array[1747]=new Array("枣庄","山东","枣庄");
            array[1748]=new Array("淄博","山东","淄博");

            array[1749]=new Array("滨州市","滨州","滨州市");
            array[1750]=new Array("博兴县","滨州","博兴县");
            array[1751]=new Array("惠民县","滨州","惠民县");
            array[1752]=new Array("无棣县","滨州","无棣县");
            array[1753]=new Array("阳信县","滨州","阳信县");
            array[1754]=new Array("沾化县","滨州","沾化县");
            array[1755]=new Array("邹平县","滨州","邹平县");
            array[1756]=new Array("德州市","德州","德州市");
            array[1757]=new Array("乐陵市","德州","乐陵市");
            array[1758]=new Array("临邑县","德州","临邑县");
            array[1759]=new Array("陵县","德州","陵县");
            array[1760]=new Array("宁津县","德州","宁津县");
            array[1761]=new Array("平原县","德州","平原县");
            array[1762]=new Array("齐河县","德州","齐河县");
            array[1763]=new Array("庆云县","德州","庆云县");
            array[1764]=new Array("武城县","德州","武城县");
            array[1765]=new Array("夏津县","德州","夏津县");
            array[1766]=new Array("禹城市","德州","禹城市");
            array[1767]=new Array("东营市","东营","东营市");
            array[1768]=new Array("广饶县","东营","广饶县");
            array[1769]=new Array("垦利县","东营","垦利县");
            array[1770]=new Array("利津县","东营","利津县");
            array[1771]=new Array("曹县","菏泽","曹县");
            array[1772]=new Array("成武县","菏泽","成武县");
            array[1773]=new Array("单县","菏泽","单县");
            array[1774]=new Array("定陶县","菏泽","定陶县");
            array[1775]=new Array("东明县","菏泽","东明县");
            array[1776]=new Array("菏泽市","菏泽","菏泽市");
            array[1777]=new Array("巨野县","菏泽","巨野县");
            array[1778]=new Array("郓城县","菏泽","郓城县");
            array[1779]=new Array("鄄城县","菏泽","鄄城县");
            array[1780]=new Array("济南市","济南","济南市");
            array[1781]=new Array("济阳县","济南","济阳县");
            array[1782]=new Array("平阴县","济南","平阴县");
            array[1783]=new Array("商河县","济南","商河县");
            array[1784]=new Array("章丘市","济南","章丘市");
            array[1785]=new Array("济宁市","济宁","济宁市");
            array[1786]=new Array("嘉祥县","济宁","嘉祥县");
            array[1787]=new Array("金乡县","济宁","金乡县");
            array[1788]=new Array("梁山县","济宁","梁山县");
            array[1789]=new Array("曲阜市","济宁","曲阜市");
            array[1790]=new Array("微山县","济宁","微山县");
            array[1791]=new Array("鱼台县","济宁","鱼台县");
            array[1792]=new Array("邹城市","济宁","邹城市");
            array[1793]=new Array("兖州市","济宁","兖州市");
            array[1794]=new Array("汶上县","济宁","汶上县");
            array[1795]=new Array("泗水县","济宁","泗水县");
            array[1796]=new Array("莱芜市","莱芜","莱芜市");
            array[1797]=new Array("东阿县","聊城","东阿县");
            array[1798]=new Array("高唐县","聊城","高唐县");
            array[1799]=new Array("冠县","聊城","冠县");
            array[1800]=new Array("聊城市","聊城","聊城市");
            array[1801]=new Array("临清市","聊城","临清市");
            array[1802]=new Array("阳谷县","聊城","阳谷县");
            array[1803]=new Array("茌平县","聊城","茌平县");
            array[1804]=new Array("莘县","聊城","莘县");
            array[1805]=new Array("苍山县","临沂","苍山县");
            array[1806]=new Array("费县","临沂","费县");
            array[1807]=new Array("临沂市","临沂","临沂市");
            array[1808]=new Array("临沭县","临沂","临沭县");
            array[1809]=new Array("蒙阴县","临沂","蒙阴县");
            array[1810]=new Array("平邑县","临沂","平邑县");
            array[1811]=new Array("沂南县","临沂","沂南县");
            array[1812]=new Array("沂水县","临沂","沂水县");
            array[1813]=new Array("郯城县","临沂","郯城县");
            array[1814]=new Array("莒南县","临沂","莒南县");
            array[1815]=new Array("即墨市","青岛","即墨市");
            array[1816]=new Array("胶南市","青岛","胶南市");
            array[1817]=new Array("胶州市","青岛","胶州市");
            array[1818]=new Array("莱西市","青岛","莱西市");
            array[1819]=new Array("平度市","青岛","平度市");
            array[1820]=new Array("青岛市","青岛","青岛市");
            array[1821]=new Array("日照市","日照","日照市");
            array[1822]=new Array("五莲县","日照","五莲县");
            array[1823]=new Array("莒县","日照","莒县");
            array[1824]=new Array("东平县","泰安","东平县");
            array[1825]=new Array("肥城市","泰安","肥城市");
            array[1826]=new Array("宁阳县","泰安","宁阳县");
            array[1827]=new Array("泰安市","泰安","泰安市");
            array[1828]=new Array("新泰市","泰安","新泰市");
            array[1829]=new Array("荣成市","威海","荣成市");
            array[1830]=new Array("乳山市","威海","乳山市");
            array[1831]=new Array("威海市","威海","威海市");
            array[1832]=new Array("文登市","威海","文登市");
            array[1833]=new Array("安丘市","潍坊","安丘市");
            array[1834]=new Array("昌乐县","潍坊","昌乐县");
            array[1835]=new Array("昌邑市","潍坊","昌邑市");
            array[1836]=new Array("高密市","潍坊","高密市");
            array[1837]=new Array("临朐县","潍坊","临朐县");
            array[1838]=new Array("青州市","潍坊","青州市");
            array[1839]=new Array("寿光市","潍坊","寿光市");
            array[1840]=new Array("潍坊市","潍坊","潍坊市");
            array[1841]=new Array("诸城市","潍坊","诸城市");
            array[1842]=new Array("长岛县","烟台","长岛县");
            array[1843]=new Array("海阳市","烟台","海阳市");
            array[1844]=new Array("莱阳市","烟台","莱阳市");
            array[1845]=new Array("莱州市","烟台","莱州市");
            array[1846]=new Array("龙口市","烟台","龙口市");
            array[1847]=new Array("蓬莱市","烟台","蓬莱市");
            array[1848]=new Array("栖霞市","烟台","栖霞市");
            array[1849]=new Array("烟台市","烟台","烟台市");
            array[1850]=new Array("招远市","烟台","招远市");
            array[1851]=new Array("枣庄市","枣庄","枣庄市");
            array[1852]=new Array("滕州市","枣庄","滕州市");
            array[1853]=new Array("高青县","淄博","高青县");
            array[1854]=new Array("桓台县","淄博","桓台县");
            array[1855]=new Array("沂源县","淄博","沂源县");
            array[1856]=new Array("淄博市","淄博","淄博市");


            array[1857]=new Array("长治","山西","长治");
            array[1858]=new Array("大同","山西","大同");
            array[1859]=new Array("晋城","山西","晋城");
            array[1860]=new Array("晋中","山西","晋中");
            array[1861]=new Array("临汾","山西","临汾");
            array[1862]=new Array("吕梁","山西","吕梁");
            array[1863]=new Array("朔州","山西","朔州");
            array[1864]=new Array("太原","山西","太原");
            array[1865]=new Array("忻州","山西","忻州");
            array[1866]=new Array("阳泉","山西","阳泉");
            array[1867]=new Array("运城","山西","运城");

            array[1868]=new Array("长治市","长治","长治市");
            array[1869]=new Array("长治县","长治","长治县");
            array[1870]=new Array("长子县","长治","长子县");
            array[1871]=new Array("壶关县","长治","壶关县");
            array[1872]=new Array("黎城县","长治","黎城县");
            array[1873]=new Array("潞城市","长治","潞城市");
            array[1874]=new Array("平顺县","长治","平顺县");
            array[1875]=new Array("沁县","长治","沁县");
            array[1876]=new Array("沁源县","长治","沁源县");
            array[1877]=new Array("屯留县","长治","屯留县");
            array[1878]=new Array("武乡县","长治","武乡县");
            array[1879]=new Array("襄垣县","长治","襄垣县");
            array[1880]=new Array("大同市","大同","大同市");
            array[1881]=new Array("大同县","大同","大同县");
            array[1882]=new Array("广灵县","大同","广灵县");
            array[1883]=new Array("浑源县","大同","浑源县");
            array[1884]=new Array("灵丘县","大同","灵丘县");
            array[1885]=new Array("天镇县","大同","天镇县");
            array[1886]=new Array("阳高县","大同","阳高县");
            array[1887]=new Array("左云县","大同","左云县");
            array[1888]=new Array("高平市","晋城","高平市");
            array[1889]=new Array("晋城市","晋城","晋城市");
            array[1890]=new Array("陵川县","晋城","陵川县");
            array[1891]=new Array("沁水县","晋城","沁水县");
            array[1892]=new Array("阳城县","晋城","阳城县");
            array[1893]=new Array("泽州县","晋城","泽州县");
            array[1894]=new Array("和顺县","晋中","和顺县");
            array[1895]=new Array("介休市","晋中","介休市");
            array[1896]=new Array("晋中市","晋中","晋中市");
            array[1897]=new Array("灵石县","晋中","灵石县");
            array[1898]=new Array("平遥县","晋中","平遥县");
            array[1899]=new Array("祁县","晋中","祁县");
            array[1900]=new Array("寿阳县","晋中","寿阳县");
            array[1901]=new Array("太谷县","晋中","太谷县");
            array[1902]=new Array("昔阳县","晋中","昔阳县");
            array[1903]=new Array("榆社县","晋中","榆社县");
            array[1904]=new Array("左权县","晋中","左权县");
            array[1905]=new Array("安泽县","临汾","安泽县");
            array[1906]=new Array("大宁县","临汾","大宁县");
            array[1907]=new Array("汾西县","临汾","汾西县");
            array[1908]=new Array("浮山县","临汾","浮山县");
            array[1909]=new Array("古县","临汾","古县");
            array[1910]=new Array("洪洞县","临汾","洪洞县");
            array[1911]=new Array("侯马市","临汾","侯马市");
            array[1912]=new Array("霍州市","临汾","霍州市");
            array[1913]=new Array("吉县","临汾","吉县");
            array[1914]=new Array("临汾市","临汾","临汾市");
            array[1915]=new Array("蒲县","临汾","蒲县");
            array[1916]=new Array("曲沃县","临汾","曲沃县");
            array[1917]=new Array("襄汾县","临汾","襄汾县");
            array[1918]=new Array("乡宁县","临汾","乡宁县");
            array[1919]=new Array("翼城县","临汾","翼城县");
            array[1920]=new Array("永和县","临汾","永和县");
            array[1921]=new Array("隰县","临汾","隰县");
            array[1922]=new Array("方山县","吕梁","方山县");
            array[1923]=new Array("汾阳市","吕梁","汾阳市");
            array[1924]=new Array("交城县","吕梁","交城县");
            array[1925]=new Array("交口县","吕梁","交口县");
            array[1926]=new Array("离石市","吕梁","离石市");
            array[1927]=new Array("临县","吕梁","临县");
            array[1928]=new Array("柳林县","吕梁","柳林县");
            array[1929]=new Array("石楼县","吕梁","石楼县");
            array[1930]=new Array("文水县","吕梁","文水县");
            array[1931]=new Array("孝义市","吕梁","孝义市");
            array[1932]=new Array("兴县","吕梁","兴县");
            array[1933]=new Array("中阳县","吕梁","中阳县");
            array[1934]=new Array("岚县","吕梁","岚县");
            array[1935]=new Array("怀仁县","朔州","怀仁县");
            array[1936]=new Array("山阴县","朔州","山阴县");
            array[1937]=new Array("朔州市","朔州","朔州市");
            array[1938]=new Array("应县","朔州","应县");
            array[1939]=new Array("右玉县","朔州","右玉县");
            array[1940]=new Array("古交市","太原","古交市");
            array[1941]=new Array("娄烦县","太原","娄烦县");
            array[1942]=new Array("清徐县","太原","清徐县");
            array[1943]=new Array("太原市","太原","太原市");
            array[1944]=new Array("阳曲县","太原","阳曲县");
            array[1945]=new Array("保德县","忻州","保德县");
            array[1946]=new Array("代县","忻州","代县");
            array[1947]=new Array("定襄县","忻州","定襄县");
            array[1948]=new Array("繁峙县","忻州","繁峙县");
            array[1949]=new Array("河曲县","忻州","河曲县");
            array[1950]=new Array("静乐县","忻州","静乐县");
            array[1951]=new Array("宁武县","忻州","宁武县");
            array[1952]=new Array("偏关县","忻州","偏关县");
            array[1953]=new Array("神池县","忻州","神池县");
            array[1954]=new Array("五台县","忻州","五台县");
            array[1955]=new Array("五寨县","忻州","五寨县");
            array[1956]=new Array("忻州市","忻州","忻州市");
            array[1957]=new Array("原平市","忻州","原平市");
            array[1958]=new Array("岢岚县","忻州","岢岚县");
            array[1959]=new Array("平定县","阳泉","平定县");
            array[1960]=new Array("阳泉市","阳泉","阳泉市");
            array[1961]=new Array("盂县","阳泉","盂县");
            array[1962]=new Array("河津市","运城","河津市");
            array[1963]=new Array("临猗县","运城","临猗县");
            array[1964]=new Array("平陆县","运城","平陆县");
            array[1965]=new Array("万荣县","运城","万荣县");
            array[1966]=new Array("闻喜县","运城","闻喜县");
            array[1967]=new Array("夏县","运城","夏县");
            array[1968]=new Array("新绛县","运城","新绛县");
            array[1969]=new Array("永济市","运城","永济市");
            array[1970]=new Array("垣曲县","运城","垣曲县");
            array[1971]=new Array("运城市","运城","运城市");
            array[1972]=new Array("芮城县","运城","芮城县");
            array[1973]=new Array("绛县","运城","绛县");
            array[1974]=new Array("稷山县","运城","稷山县");


            array[1975]=new Array("安康","陕西","安康");
            array[1976]=new Array("宝鸡","陕西","宝鸡");
            array[1977]=new Array("汉中","陕西","汉中");
            array[1978]=new Array("商洛","陕西","商洛");
            array[1979]=new Array("铜川","陕西","铜川");
            array[1980]=new Array("渭南","陕西","渭南");
            array[1981]=new Array("西安","陕西","西安");
            array[1982]=new Array("咸阳","陕西","咸阳");
            array[1983]=new Array("延安","陕西","延安");
            array[1984]=new Array("榆林","陕西","榆林");


            array[1985]=new Array("安康市","安康","安康市");
            array[1986]=new Array("白河县","安康","白河县");
            array[1987]=new Array("汉阴县","安康","汉阴县");
            array[1988]=new Array("宁陕县","安康","宁陕县");
            array[1989]=new Array("平利县","安康","平利县");
            array[1990]=new Array("石泉县","安康","石泉县");
            array[1991]=new Array("旬阳县","安康","旬阳县");
            array[1992]=new Array("镇坪县","安康","镇坪县");
            array[1993]=new Array("紫阳县","安康","紫阳县");
            array[1994]=new Array("岚皋县","安康","岚皋县");
            array[1995]=new Array("宝鸡市","宝鸡","宝鸡市");
            array[1996]=new Array("宝鸡县","宝鸡","宝鸡县");
            array[1997]=new Array("凤县","宝鸡","凤县");
            array[1998]=new Array("凤翔县","宝鸡","凤翔县");
            array[1999]=new Array("扶风县","宝鸡","扶风县");
            array[2000]=new Array("陇县","宝鸡","陇县");
            array[2001]=new Array("眉县","宝鸡","眉县");
            array[2002]=new Array("千阳县","宝鸡","千阳县");
            array[2003]=new Array("太白县","宝鸡","太白县");
            array[2004]=new Array("岐山县","宝鸡","岐山县");
            array[2005]=new Array("麟游县","宝鸡","麟游县");
            array[2006]=new Array("城固县","汉中","城固县");
            array[2007]=new Array("佛坪县","汉中","佛坪县");
            array[2008]=new Array("汉中市","汉中","汉中市");
            array[2009]=new Array("留坝县","汉中","留坝县");
            array[2010]=new Array("略阳县","汉中","略阳县");
            array[2011]=new Array("勉县","汉中","勉县");
            array[2012]=new Array("南郑县","汉中","南郑县");
            array[2013]=new Array("宁强县","汉中","宁强县");
            array[2014]=new Array("西乡县","汉中","西乡县");
            array[2015]=new Array("洋县","汉中","洋县");
            array[2016]=new Array("镇巴县","汉中","镇巴县");
            array[2017]=new Array("丹凤县","商洛","丹凤县");
            array[2018]=new Array("洛南县","商洛","洛南县");
            array[2019]=new Array("山阳县","商洛","山阳县");
            array[2020]=new Array("商洛市","商洛","商洛市");
            array[2021]=new Array("商南县","商洛","商南县");
            array[2022]=new Array("镇安县","商洛","镇安县");
            array[2023]=new Array("柞水县","商洛","柞水县");
            array[2024]=new Array("铜川市","铜川","铜川市");
            array[2025]=new Array("宜君县","铜川","宜君县");
            array[2026]=new Array("白水县","渭南","白水县");
            array[2027]=new Array("澄城县","渭南","澄城县");
            array[2028]=new Array("大荔县","渭南","大荔县");
            array[2029]=new Array("富平县","渭南","富平县");
            array[2030]=new Array("韩城市","渭南","韩城市");
            array[2031]=new Array("合阳县","渭南","合阳县");
            array[2032]=new Array("华县","渭南","华县");
            array[2033]=new Array("华阴市","渭南","华阴市");
            array[2034]=new Array("蒲城县","渭南","蒲城县");
            array[2035]=new Array("渭南市","渭南","渭南市");
            array[2036]=new Array("潼关县","渭南","潼关县");
            array[2037]=new Array("高陵县","西安","高陵县");
            array[2038]=new Array("户县","西安","户县");
            array[2039]=new Array("蓝田县","西安","蓝田县");
            array[2040]=new Array("西安市","西安","西安市");
            array[2041]=new Array("周至县","西安","周至县");
            array[2042]=new Array("彬县","咸阳","彬县");
            array[2043]=new Array("长武县","咸阳","长武县");
            array[2044]=new Array("淳化县","咸阳","淳化县");
            array[2045]=new Array("礼泉县","咸阳","礼泉县");
            array[2046]=new Array("乾县","咸阳","乾县");
            array[2047]=new Array("三原县","咸阳","三原县");
            array[2048]=new Array("武功县","咸阳","武功县");
            array[2049]=new Array("咸阳市","咸阳","咸阳市");
            array[2050]=new Array("兴平市","咸阳","兴平市");
            array[2051]=new Array("旬邑县","咸阳","旬邑县");
            array[2052]=new Array("永寿县","咸阳","永寿县");
            array[2053]=new Array("泾阳县","咸阳","泾阳县");
            array[2054]=new Array("安塞县","延安","安塞县");
            array[2055]=new Array("富县","延安","富县");
            array[2056]=new Array("甘泉县","延安","甘泉县");
            array[2057]=new Array("黄陵县","延安","黄陵县");
            array[2058]=new Array("黄龙县","延安","黄龙县");
            array[2059]=new Array("洛川县","延安","洛川县");
            array[2060]=new Array("吴旗县","延安","吴旗县");
            array[2061]=new Array("延安市","延安","延安市");
            array[2062]=new Array("延长县","延安","延长县");
            array[2063]=new Array("延川县","延安","延川县");
            array[2064]=new Array("宜川县","延安","宜川县");
            array[2065]=new Array("志丹县","延安","志丹县");
            array[2066]=new Array("子长县","延安","子长县");
            array[2067]=new Array("定边县","榆林","定边县");
            array[2068]=new Array("府谷县","榆林","府谷县");
            array[2069]=new Array("横山县","榆林","横山县");
            array[2070]=new Array("佳县","榆林","佳县");
            array[2071]=new Array("靖边县","榆林","靖边县");
            array[2072]=new Array("米脂县","榆林","米脂县");
            array[2073]=new Array("清涧县","榆林","清涧县");
            array[2074]=new Array("神木县","榆林","神木县");
            array[2075]=new Array("绥德县","榆林","绥德县");
            array[2076]=new Array("吴堡县","榆林","吴堡县");
            array[2077]=new Array("榆林市","榆林","榆林市");
            array[2078]=new Array("子洲县","榆林","子洲县");

            array[2079]=new Array("上海市","上海","上海市");
            array[2080]=new Array("崇明县","上海市","崇明县");
            array[2081]=new Array("上海市","上海市","上海市");

            array[2082]=new Array("阿坝藏族羌族自治州","四川","阿坝藏族羌族自治州");
            array[2083]=new Array("巴中","四川","巴中");
            array[2084]=new Array("成都","四川","成都");
            array[2085]=new Array("达州","四川","达州");
            array[2086]=new Array("德阳","四川","德阳");
            array[2087]=new Array("甘孜藏族自治州","四川","甘孜藏族自治州");
            array[2088]=new Array("广安","四川","广安");
            array[2089]=new Array("广元","四川","广元");
            array[2090]=new Array("乐山","四川","乐山");
            array[2091]=new Array("凉山彝族自治州","四川","凉山彝族自治州");
            array[2092]=new Array("眉山","四川","眉山");
            array[2093]=new Array("绵阳","四川","绵阳");
            array[2094]=new Array("南充","四川","南充");
            array[2095]=new Array("内江","四川","内江");
            array[2096]=new Array("攀枝花","四川","攀枝花");
            array[2097]=new Array("遂宁","四川","遂宁");
            array[2098]=new Array("雅安","四川","雅安");
            array[2099]=new Array("宜宾","四川","宜宾");
            array[2100]=new Array("资阳","四川","资阳");
            array[2101]=new Array("自贡","四川","自贡");
            array[2102]=new Array("泸州","四川","泸州");


            array[2103]=new Array("阿坝县","阿坝藏族羌族自治州","阿坝县");
            array[2104]=new Array("黑水县","阿坝藏族羌族自治州","黑水县");
            array[2105]=new Array("红原县","阿坝藏族羌族自治州","红原县");
            array[2106]=new Array("金川县","阿坝藏族羌族自治州","金川县");
            array[2107]=new Array("九寨沟县","阿坝藏族羌族自治州","九寨沟县");
            array[2108]=new Array("理县","阿坝藏族羌族自治州","理县");
            array[2109]=new Array("马尔康县","阿坝藏族羌族自治州","马尔康县");
            array[2110]=new Array("茂县","阿坝藏族羌族自治州","茂县");
            array[2111]=new Array("壤塘县","阿坝藏族羌族自治州","壤塘县");
            array[2112]=new Array("若尔盖县","阿坝藏族羌族自治州","若尔盖县");
            array[2113]=new Array("松潘县","阿坝藏族羌族自治州","松潘县");
            array[2114]=new Array("小金县","阿坝藏族羌族自治州","小金县");
            array[2115]=new Array("汶川县","阿坝藏族羌族自治州","汶川县");
            array[2116]=new Array("巴中市","巴中","巴中市");
            array[2117]=new Array("南江县","巴中","南江县");
            array[2118]=new Array("平昌县","巴中","平昌县");
            array[2119]=new Array("通江县","巴中","通江县");
            array[2120]=new Array("成都市","成都","成都市");
            array[2121]=new Array("崇州市","成都","崇州市");
            array[2122]=new Array("大邑县","成都","大邑县");
            array[2123]=new Array("都江堰市","成都","都江堰市");
            array[2124]=new Array("金堂县","成都","金堂县");
            array[2125]=new Array("彭州市","成都","彭州市");
            array[2126]=new Array("蒲江县","成都","蒲江县");
            array[2127]=new Array("双流县","成都","双流县");
            array[2128]=new Array("新津县","成都","新津县");
            array[2129]=new Array("邛崃市","成都","邛崃市");
            array[2130]=new Array("郫县","成都","郫县");
            array[2131]=new Array("达县","达州","达县");
            array[2132]=new Array("达州市","达州","达州市");
            array[2133]=new Array("大竹县","达州","大竹县");
            array[2134]=new Array("开江县","达州","开江县");
            array[2135]=new Array("渠县","达州","渠县");
            array[2136]=new Array("万源市","达州","万源市");
            array[2137]=new Array("宣汉县","达州","宣汉县");
            array[2138]=new Array("德阳市","德阳","德阳市");
            array[2139]=new Array("广汉市","德阳","广汉市");
            array[2140]=new Array("罗江县","德阳","罗江县");
            array[2141]=new Array("绵竹市","德阳","绵竹市");
            array[2142]=new Array("什邡市","德阳","什邡市");
            array[2143]=new Array("中江县","德阳","中江县");
            array[2144]=new Array("巴塘县","甘孜藏族自治州","巴塘县");
            array[2145]=new Array("白玉县","甘孜藏族自治州","白玉县");
            array[2146]=new Array("丹巴县","甘孜藏族自治州","丹巴县");
            array[2147]=new Array("稻城县","甘孜藏族自治州","稻城县");
            array[2148]=new Array("道孚县","甘孜藏族自治州","道孚县");
            array[2149]=new Array("德格县","甘孜藏族自治州","德格县");
            array[2150]=new Array("得荣县","甘孜藏族自治州","得荣县");
            array[2151]=new Array("甘孜县","甘孜藏族自治州","甘孜县");
            array[2152]=new Array("九龙县","甘孜藏族自治州","九龙县");
            array[2153]=new Array("康定县","甘孜藏族自治州","康定县");
            array[2154]=new Array("理塘县","甘孜藏族自治州","理塘县");
            array[2155]=new Array("炉霍县","甘孜藏族自治州","炉霍县");
            array[2156]=new Array("色达县","甘孜藏族自治州","色达县");
            array[2157]=new Array("石渠县","甘孜藏族自治州","石渠县");
            array[2158]=new Array("乡城县","甘孜藏族自治州","乡城县");
            array[2159]=new Array("新龙县","甘孜藏族自治州","新龙县");
            array[2160]=new Array("雅江县","甘孜藏族自治州","雅江县");
            array[2161]=new Array("泸定县","甘孜藏族自治州","泸定县");
            array[2162]=new Array("广安市","广安","广安市");
            array[2163]=new Array("华蓥市","广安","华蓥市");
            array[2164]=new Array("邻水县","广安","邻水县");
            array[2165]=new Array("武胜县","广安","武胜县");
            array[2166]=new Array("岳池县","广安","岳池县");
            array[2167]=new Array("苍溪县","广元","苍溪县");
            array[2168]=new Array("广元市","广元","广元市");
            array[2169]=new Array("剑阁县","广元","剑阁县");
            array[2170]=new Array("青川县","广元","青川县");
            array[2171]=new Array("旺苍县","广元","旺苍县");
            array[2172]=new Array("峨边彝族自治县","乐山","峨边彝族自治县");
            array[2173]=new Array("峨眉山市","乐山","峨眉山市");
            array[2174]=new Array("夹江县","乐山","夹江县");
            array[2175]=new Array("井研县","乐山","井研县");
            array[2176]=new Array("乐山市","乐山","乐山市");
            array[2177]=new Array("马边彝族自治县","乐山","马边彝族自治县");
            array[2178]=new Array("沐川县","乐山","沐川县");
            array[2179]=new Array("犍为县","乐山","犍为县");
            array[2180]=new Array("布拖县","凉山彝族自治州","布拖县");
            array[2181]=new Array("德昌县","凉山彝族自治州","德昌县");
            array[2182]=new Array("甘洛县","凉山彝族自治州","甘洛县");
            array[2183]=new Array("会东县","凉山彝族自治州","会东县");
            array[2184]=new Array("会理县","凉山彝族自治州","会理县");
            array[2185]=new Array("金阳县","凉山彝族自治州","金阳县");
            array[2186]=new Array("雷波县","凉山彝族自治州","雷波县");
            array[2187]=new Array("美姑县","凉山彝族自治州","美姑县");
            array[2188]=new Array("冕宁县","凉山彝族自治州","冕宁县");
            array[2189]=new Array("木里藏族自治县","凉山彝族自治州","木里藏族自治县");
            array[2190]=new Array("宁南县","凉山彝族自治州","宁南县");
            array[2191]=new Array("普格县","凉山彝族自治州","普格县");
            array[2192]=new Array("西昌市","凉山彝族自治州","西昌市");
            array[2193]=new Array("喜德县","凉山彝族自治州","喜德县");
            array[2194]=new Array("盐源县","凉山彝族自治州","盐源县");
            array[2195]=new Array("越西县","凉山彝族自治州","越西县");
            array[2196]=new Array("昭觉县","凉山彝族自治州","昭觉县");
            array[2197]=new Array("丹棱县","眉山","丹棱县");
            array[2198]=new Array("洪雅县","眉山","洪雅县");
            array[2199]=new Array("眉山市","眉山","眉山市");
            array[2200]=new Array("彭山县","眉山","彭山县");
            array[2201]=new Array("青神县","眉山","青神县");
            array[2202]=new Array("仁寿县","眉山","仁寿县");
            array[2203]=new Array("安县","绵阳","安县");
            array[2204]=new Array("北川县","绵阳","北川县");
            array[2205]=new Array("江油市","绵阳","江油市");
            array[2206]=new Array("绵阳市","绵阳","绵阳市");
            array[2207]=new Array("平武县","绵阳","平武县");
            array[2208]=new Array("三台县","绵阳","三台县");
            array[2209]=new Array("盐亭县","绵阳","盐亭县");
            array[2210]=new Array("梓潼县","绵阳","梓潼县");
            array[2211]=new Array("南部县","南充","南部县");
            array[2212]=new Array("南充市","南充","南充市");
            array[2213]=new Array("蓬安县","南充","蓬安县");
            array[2214]=new Array("西充县","南充","西充县");
            array[2215]=new Array("仪陇县","南充","仪陇县");
            array[2216]=new Array("营山县","南充","营山县");
            array[2217]=new Array("阆中市","南充","阆中市");
            array[2218]=new Array("隆昌县","内江","隆昌县");
            array[2219]=new Array("内江市","内江","内江市");
            array[2220]=new Array("威远县","内江","威远县");
            array[2221]=new Array("资中县","内江","资中县");
            array[2222]=new Array("米易县","攀枝花","米易县");
            array[2223]=new Array("攀枝花市","攀枝花","攀枝花市");
            array[2224]=new Array("盐边县","攀枝花","盐边县");
            array[2225]=new Array("大英县","遂宁","大英县");
            array[2226]=new Array("蓬溪县","遂宁","蓬溪县");
            array[2227]=new Array("射洪县","遂宁","射洪县");
            array[2228]=new Array("遂宁市","遂宁","遂宁市");
            array[2229]=new Array("宝兴县","雅安","宝兴县");
            array[2230]=new Array("汉源县","雅安","汉源县");
            array[2231]=new Array("芦山县","雅安","芦山县");
            array[2232]=new Array("名山县","雅安","名山县");
            array[2233]=new Array("石棉县","雅安","石棉县");
            array[2234]=new Array("天全县","雅安","天全县");
            array[2235]=new Array("雅安市","雅安","雅安市");
            array[2236]=new Array("荥经县","雅安","荥经县");
            array[2237]=new Array("长宁县","宜宾","长宁县");
            array[2238]=new Array("高县","宜宾","高县");
            array[2239]=new Array("江安县","宜宾","江安县");
            array[2240]=new Array("南溪县","宜宾","南溪县");
            array[2241]=new Array("屏山县","宜宾","屏山县");
            array[2242]=new Array("兴文县","宜宾","兴文县");
            array[2243]=new Array("宜宾市","宜宾","宜宾市");
            array[2244]=new Array("宜宾县","宜宾","宜宾县");
            array[2245]=new Array("珙县","宜宾","珙县");
            array[2246]=new Array("筠连县","宜宾","筠连县");
            array[2247]=new Array("安岳县","资阳","安岳县");
            array[2248]=new Array("简阳市","资阳","简阳市");
            array[2249]=new Array("乐至县","资阳","乐至县");
            array[2250]=new Array("资阳市","资阳","资阳市");
            array[2251]=new Array("富顺县","自贡","富顺县");
            array[2252]=new Array("荣县","自贡","荣县");
            array[2253]=new Array("自贡市","自贡","自贡市");
            array[2254]=new Array("古蔺县","泸州","古蔺县");
            array[2255]=new Array("合江县","泸州","合江县");
            array[2256]=new Array("叙永县","泸州","叙永县");
            array[2257]=new Array("泸县","泸州","泸县");
            array[2258]=new Array("泸州市","泸州","泸州市");

            array[2259]=new Array("天津市","天津","天津市");
            array[2260]=new Array("蓟县","天津市","蓟县");
            array[2261]=new Array("静海县","天津市","静海县");
            array[2262]=new Array("宁河县","天津市","宁河县");
            array[2263]=new Array("天津市","天津市","天津市");


            array[2264]=new Array("阿里","西藏","阿里");
            array[2265]=new Array("昌都","西藏","昌都");
            array[2266]=new Array("拉萨","西藏","拉萨");
            array[2267]=new Array("林芝","西藏","林芝");
            array[2268]=new Array("那曲","西藏","那曲");
            array[2269]=new Array("日喀则","西藏","日喀则");
            array[2270]=new Array("山南","西藏","山南");


            array[2271]=new Array("措勤县","阿里","措勤县");
            array[2272]=new Array("噶尔县","阿里","噶尔县");
            array[2273]=new Array("改则县","阿里","改则县");
            array[2274]=new Array("革吉县","阿里","革吉县");
            array[2275]=new Array("普兰县","阿里","普兰县");
            array[2276]=new Array("日土县","阿里","日土县");
            array[2277]=new Array("札达县","阿里","札达县");
            array[2278]=new Array("八宿县","昌都","八宿县");
            array[2279]=new Array("边坝县","昌都","边坝县");
            array[2280]=new Array("察雅县","昌都","察雅县");
            array[2281]=new Array("昌都县","昌都","昌都县");
            array[2282]=new Array("丁青县","昌都","丁青县");
            array[2283]=new Array("贡觉县","昌都","贡觉县");
            array[2284]=new Array("江达县","昌都","江达县");
            array[2285]=new Array("类乌齐县","昌都","类乌齐县");
            array[2286]=new Array("洛隆县","昌都","洛隆县");
            array[2287]=new Array("芒康县","昌都","芒康县");
            array[2288]=new Array("左贡县","昌都","左贡县");
            array[2289]=new Array("达孜县","拉萨","达孜县");
            array[2290]=new Array("当雄县","拉萨","当雄县");
            array[2291]=new Array("堆龙德庆县","拉萨","堆龙德庆县");
            array[2292]=new Array("拉萨市","拉萨","拉萨市");
            array[2293]=new Array("林周县","拉萨","林周县");
            array[2294]=new Array("墨竹工卡县","拉萨","墨竹工卡县");
            array[2295]=new Array("尼木县","拉萨","尼木县");
            array[2296]=new Array("曲水县","拉萨","曲水县");
            array[2297]=new Array("波密县","林芝","波密县");
            array[2298]=new Array("察隅县","林芝","察隅县");
            array[2299]=new Array("工布江达县","林芝","工布江达县");
            array[2300]=new Array("朗县","林芝","朗县");
            array[2301]=new Array("林芝县","林芝","林芝县");
            array[2302]=new Array("米林县","林芝","米林县");
            array[2303]=new Array("墨脱县","林芝","墨脱县");
            array[2304]=new Array("安多县","那曲","安多县");
            array[2305]=new Array("巴青县","那曲","巴青县");
            array[2306]=new Array("班戈县","那曲","班戈县");
            array[2307]=new Array("比如县","那曲","比如县");
            array[2308]=new Array("嘉黎县","那曲","嘉黎县");
            array[2309]=new Array("那曲县","那曲","那曲县");
            array[2310]=new Array("尼玛县","那曲","尼玛县");
            array[2311]=new Array("聂荣县","那曲","聂荣县");
            array[2312]=new Array("申扎县","那曲","申扎县");
            array[2313]=new Array("索县","那曲","索县");
            array[2314]=new Array("昂仁县","日喀则","昂仁县");
            array[2315]=new Array("白朗县","日喀则","白朗县");
            array[2316]=new Array("定结县","日喀则","定结县");
            array[2317]=new Array("定日县","日喀则","定日县");
            array[2318]=new Array("岗巴县","日喀则","岗巴县");
            array[2319]=new Array("吉隆县","日喀则","吉隆县");
            array[2320]=new Array("江孜县","日喀则","江孜县");
            array[2321]=new Array("康马县","日喀则","康马县");
            array[2322]=new Array("拉孜县","日喀则","拉孜县");
            array[2323]=new Array("南木林县","日喀则","南木林县");
            array[2324]=new Array("聂拉木县","日喀则","聂拉木县");
            array[2325]=new Array("仁布县","日喀则","仁布县");
            array[2326]=new Array("日喀则市","日喀则","日喀则市");
            array[2327]=new Array("萨嘎县","日喀则","萨嘎县");
            array[2328]=new Array("萨迦县","日喀则","萨迦县");
            array[2329]=new Array("谢通门县","日喀则","谢通门县");
            array[2330]=new Array("亚东县","日喀则","亚东县");
            array[2331]=new Array("仲巴县","日喀则","仲巴县");
            array[2332]=new Array("措美县","山南","措美县");
            array[2333]=new Array("错那县","山南","错那县");
            array[2334]=new Array("贡嘎县","山南","贡嘎县");
            array[2335]=new Array("加查县","山南","加查县");
            array[2336]=new Array("浪卡子县","山南","浪卡子县");
            array[2337]=new Array("隆子县","山南","隆子县");
            array[2338]=new Array("洛扎县","山南","洛扎县");
            array[2339]=new Array("乃东县","山南","乃东县");
            array[2340]=new Array("琼结县","山南","琼结县");
            array[2341]=new Array("曲松县","山南","曲松县");
            array[2342]=new Array("桑日县","山南","桑日县");
            array[2343]=new Array("扎囊县","山南","扎囊县");


            array[2344]=new Array("阿克苏","新疆","阿克苏");
            array[2345]=new Array("阿拉尔","新疆","阿拉尔");
            array[2346]=new Array("巴音郭楞蒙古自治州","新疆","巴音郭楞蒙古自治州");
            array[2347]=new Array("博尔塔拉蒙古自治州","新疆","博尔塔拉蒙古自治州");
            array[2348]=new Array("昌吉回族自治州","新疆","昌吉回族自治州");
            array[2349]=new Array("哈密","新疆","哈密");
            array[2350]=new Array("和田","新疆","和田");
            array[2351]=new Array("喀什","新疆","喀什");
            array[2352]=new Array("克拉玛依","新疆","克拉玛依");
            array[2353]=new Array("克孜勒苏柯尔克孜自治州","新疆","克孜勒苏柯尔克孜自治州");
            array[2354]=new Array("石河子","新疆","石河子");
            array[2355]=new Array("图木舒克","新疆","图木舒克");
            array[2356]=new Array("吐鲁番","新疆","吐鲁番");
            array[2357]=new Array("乌鲁木齐","新疆","乌鲁木齐");
            array[2358]=new Array("五家渠","新疆","五家渠");
            array[2359]=new Array("伊犁哈萨克自治州","新疆","伊犁哈萨克自治州");


            array[2360]=new Array("阿克苏市","阿克苏","阿克苏市");
            array[2361]=new Array("阿瓦提县","阿克苏","阿瓦提县");
            array[2362]=new Array("拜城县","阿克苏","拜城县");
            array[2363]=new Array("柯坪县","阿克苏","柯坪县");
            array[2364]=new Array("库车县","阿克苏","库车县");
            array[2365]=new Array("沙雅县","阿克苏","沙雅县");
            array[2366]=new Array("温宿县","阿克苏","温宿县");
            array[2367]=new Array("乌什县","阿克苏","乌什县");
            array[2368]=new Array("新和县","阿克苏","新和县");
            array[2369]=new Array("阿拉尔市","阿拉尔","阿拉尔市");
            array[2370]=new Array("博湖县","巴音郭楞蒙古自治州","博湖县");
            array[2371]=new Array("和静县","巴音郭楞蒙古自治州","和静县");
            array[2372]=new Array("和硕县","巴音郭楞蒙古自治州","和硕县");
            array[2373]=new Array("库尔勒市","巴音郭楞蒙古自治州","库尔勒市");
            array[2374]=new Array("轮台县","巴音郭楞蒙古自治州","轮台县");
            array[2375]=new Array("且末县","巴音郭楞蒙古自治州","且末县");
            array[2376]=new Array("若羌县","巴音郭楞蒙古自治州","若羌县");
            array[2377]=new Array("尉犁县","巴音郭楞蒙古自治州","尉犁县");
            array[2378]=new Array("焉耆回族自治县","巴音郭楞蒙古自治州","焉耆回族自治县");
            array[2379]=new Array("博乐市","博尔塔拉蒙古自治州","博乐市");
            array[2380]=new Array("精河县","博尔塔拉蒙古自治州","精河县");
            array[2381]=new Array("温泉县","博尔塔拉蒙古自治州","温泉县");
            array[2382]=new Array("昌吉市","昌吉回族自治州","昌吉市");
            array[2383]=new Array("阜康市","昌吉回族自治州","阜康市");
            array[2384]=new Array("呼图壁县","昌吉回族自治州","呼图壁县");
            array[2385]=new Array("吉木萨尔县","昌吉回族自治州","吉木萨尔县");
            array[2386]=new Array("玛纳斯县","昌吉回族自治州","玛纳斯县");
            array[2387]=new Array("米泉市","昌吉回族自治州","米泉市");
            array[2388]=new Array("木垒哈萨克自治县","昌吉回族自治州","木垒哈萨克自治县");
            array[2389]=new Array("奇台县","昌吉回族自治州","奇台县");
            array[2390]=new Array("巴里坤哈萨克自治县","哈密","巴里坤哈萨克自治县");
            array[2391]=new Array("哈密市","哈密","哈密市");
            array[2392]=new Array("伊吾县","哈密","伊吾县");
            array[2393]=new Array("策勒县","和田","策勒县");
            array[2394]=new Array("和田市","和田","和田市");
            array[2395]=new Array("和田县","和田","和田县");
            array[2396]=new Array("洛浦县","和田","洛浦县");
            array[2397]=new Array("民丰县","和田","民丰县");
            array[2398]=new Array("墨玉县","和田","墨玉县");
            array[2399]=new Array("皮山县","和田","皮山县");
            array[2400]=new Array("于田县","和田","于田县");
            array[2401]=new Array("巴楚县","喀什","巴楚县");
            array[2402]=new Array("喀什市","喀什","喀什市");
            array[2403]=new Array("麦盖提县","喀什","麦盖提县");
            array[2404]=new Array("莎车县","喀什","莎车县");
            array[2405]=new Array("疏附县","喀什","疏附县");
            array[2406]=new Array("疏勒县","喀什","疏勒县");
            array[2407]=new Array("塔什库尔干塔吉克自治县","喀什","塔什库尔干塔吉克自治县");
            array[2408]=new Array("叶城县","喀什","叶城县");
            array[2409]=new Array("英吉沙县","喀什","英吉沙县");
            array[2410]=new Array("岳普湖县","喀什","岳普湖县");
            array[2411]=new Array("泽普县","喀什","泽普县");
            array[2412]=new Array("伽师县","喀什","伽师县");
            array[2413]=new Array("克拉玛依市","克拉玛依","克拉玛依市");
            array[2414]=new Array("阿合奇县","克孜勒苏柯尔克孜自治州","阿合奇县");
            array[2415]=new Array("阿克陶县","克孜勒苏柯尔克孜自治州","阿克陶县");
            array[2416]=new Array("阿图什市","克孜勒苏柯尔克孜自治州","阿图什市");
            array[2417]=new Array("乌恰县","克孜勒苏柯尔克孜自治州","乌恰县");
            array[2418]=new Array("石河子市","石河子","石河子市");
            array[2419]=new Array("图木舒克市","图木舒克","图木舒克市");
            array[2420]=new Array("吐鲁番市","吐鲁番","吐鲁番市");
            array[2421]=new Array("托克逊县","吐鲁番","托克逊县");
            array[2422]=new Array("鄯善县","吐鲁番","鄯善县");
            array[2423]=new Array("乌鲁木齐市","乌鲁木齐","乌鲁木齐市");
            array[2424]=new Array("乌鲁木齐县","乌鲁木齐","乌鲁木齐县");
            array[2425]=new Array("五家渠市","五家渠","五家渠市");
            array[2426]=new Array("阿勒泰市","伊犁哈萨克自治州","阿勒泰市");
            array[2427]=new Array("布尔津县","伊犁哈萨克自治州","布尔津县");
            array[2428]=new Array("察布查尔锡伯自治县","伊犁哈萨克自治州","察布查尔锡伯自治县");
            array[2429]=new Array("额敏县","伊犁哈萨克自治州","额敏县");
            array[2430]=new Array("福海县","伊犁哈萨克自治州","福海县");
            array[2431]=new Array("富蕴县","伊犁哈萨克自治州","富蕴县");
            array[2432]=new Array("巩留县","伊犁哈萨克自治州","巩留县");
            array[2433]=new Array("哈巴河县","伊犁哈萨克自治州","哈巴河县");
            array[2434]=new Array("和布克赛尔蒙古自治县","伊犁哈萨克自治州","和布克赛尔蒙古自治县");
            array[2435]=new Array("霍城县","伊犁哈萨克自治州","霍城县");
            array[2436]=new Array("吉木乃县","伊犁哈萨克自治州","吉木乃县");
            array[2437]=new Array("奎屯市","伊犁哈萨克自治州","奎屯市");
            array[2438]=new Array("尼勒克县","伊犁哈萨克自治州","尼勒克县");
            array[2439]=new Array("青河县","伊犁哈萨克自治州","青河县");
            array[2440]=new Array("沙湾县","伊犁哈萨克自治州","沙湾县");
            array[2441]=new Array("塔城市","伊犁哈萨克自治州","塔城市");
            array[2442]=new Array("特克斯县","伊犁哈萨克自治州","特克斯县");
            array[2443]=new Array("托里县","伊犁哈萨克自治州","托里县");
            array[2444]=new Array("乌苏市","伊犁哈萨克自治州","乌苏市");
            array[2445]=new Array("新源县","伊犁哈萨克自治州","新源县");
            array[2446]=new Array("伊宁市","伊犁哈萨克自治州","伊宁市");
            array[2447]=new Array("伊宁县","伊犁哈萨克自治州","伊宁县");
            array[2448]=new Array("裕民县","伊犁哈萨克自治州","裕民县");
            array[2449]=new Array("昭苏县","伊犁哈萨克自治州","昭苏县");

            array[2450]=new Array("保山","云南","保山");
            array[2451]=new Array("楚雄彝族自治州","云南","楚雄彝族自治州");
            array[2452]=new Array("大理白族自治州","云南","大理白族自治州");
            array[2453]=new Array("德宏傣族景颇族自治州","云南","德宏傣族景颇族自治州");
            array[2454]=new Array("迪庆藏族自治州","云南","迪庆藏族自治州");
            array[2455]=new Array("红河哈尼族彝族自治州","云南","红河哈尼族彝族自治州");
            array[2456]=new Array("昆明","云南","昆明");
            array[2457]=new Array("丽江","云南","丽江");
            array[2458]=new Array("临沧","云南","临沧");
            array[2459]=new Array("怒江僳僳族自治州","云南","怒江僳僳族自治州");
            array[2460]=new Array("曲靖","云南","曲靖");
            array[2461]=new Array("思茅","云南","思茅");
            array[2462]=new Array("文山壮族苗族自治州","云南","文山壮族苗族自治州");
            array[2463]=new Array("西双版纳傣族自治州","云南","西双版纳傣族自治州");
            array[2464]=new Array("玉溪","云南","玉溪");
            array[2465]=new Array("昭通","云南","昭通");


            array[2466]=new Array("保山市","保山","保山市");
            array[2467]=new Array("昌宁县","保山","昌宁县");
            array[2468]=new Array("龙陵县","保山","龙陵县");
            array[2469]=new Array("施甸县","保山","施甸县");
            array[2470]=new Array("腾冲县","保山","腾冲县");
            array[2471]=new Array("楚雄市","楚雄彝族自治州","楚雄市");
            array[2472]=new Array("大姚县","楚雄彝族自治州","大姚县");
            array[2473]=new Array("禄丰县","楚雄彝族自治州","禄丰县");
            array[2474]=new Array("牟定县","楚雄彝族自治州","牟定县");
            array[2475]=new Array("南华县","楚雄彝族自治州","南华县");
            array[2476]=new Array("双柏县","楚雄彝族自治州","双柏县");
            array[2477]=new Array("武定县","楚雄彝族自治州","武定县");
            array[2478]=new Array("姚安县","楚雄彝族自治州","姚安县");
            array[2479]=new Array("永仁县","楚雄彝族自治州","永仁县");
            array[2480]=new Array("元谋县","楚雄彝族自治州","元谋县");
            array[2481]=new Array("宾川县","大理白族自治州","宾川县");
            array[2482]=new Array("大理市","大理白族自治州","大理市");
            array[2483]=new Array("洱源县","大理白族自治州","洱源县");
            array[2484]=new Array("鹤庆县","大理白族自治州","鹤庆县");
            array[2485]=new Array("剑川县","大理白族自治州","剑川县");
            array[2486]=new Array("弥渡县","大理白族自治州","弥渡县");
            array[2487]=new Array("南涧彝族自治县","大理白族自治州","南涧彝族自治县");
            array[2488]=new Array("巍山彝族回族自治县","大理白族自治州","巍山彝族回族自治县");
            array[2489]=new Array("祥云县","大理白族自治州","祥云县");
            array[2490]=new Array("漾濞彝族自治县","大理白族自治州","漾濞彝族自治县");
            array[2491]=new Array("永平县","大理白族自治州","永平县");
            array[2492]=new Array("云龙县","大理白族自治州","云龙县");
            array[2493]=new Array("梁河县","德宏傣族景颇族自治州","梁河县");
            array[2494]=new Array("陇川县","德宏傣族景颇族自治州","陇川县");
            array[2495]=new Array("潞西市","德宏傣族景颇族自治州","潞西市");
            array[2496]=new Array("瑞丽市","德宏傣族景颇族自治州","瑞丽市");
            array[2497]=new Array("盈江县","德宏傣族景颇族自治州","盈江县");
            array[2498]=new Array("德钦县","迪庆藏族自治州","德钦县");
            array[2499]=new Array("维西僳僳族自治县","迪庆藏族自治州","维西僳僳族自治县");
            array[2500]=new Array("香格里拉县","迪庆藏族自治州","香格里拉县");
            array[2501]=new Array("个旧市","红河哈尼族彝族自治州","个旧市");
            array[2502]=new Array("河口瑶族自治县","红河哈尼族彝族自治州","河口瑶族自治县");
            array[2503]=new Array("红河县","红河哈尼族彝族自治州","红河县");
            array[2504]=new Array("建水县","红河哈尼族彝族自治州","建水县");
            array[2505]=new Array("金平苗族瑶族傣族自治县","红河哈尼族彝族自治州","金平苗族瑶族傣族自治县");
            array[2506]=new Array("开远市","红河哈尼族彝族自治州","开远市");
            array[2507]=new Array("绿春县","红河哈尼族彝族自治州","绿春县");
            array[2508]=new Array("蒙自县","红河哈尼族彝族自治州","蒙自县");
            array[2509]=new Array("弥勒县","红河哈尼族彝族自治州","弥勒县");
            array[2510]=new Array("屏边苗族自治县","红河哈尼族彝族自治州","屏边苗族自治县");
            array[2511]=new Array("石屏县","红河哈尼族彝族自治州","石屏县");
            array[2512]=new Array("元阳县","红河哈尼族彝族自治州","元阳县");
            array[2513]=new Array("泸西县","红河哈尼族彝族自治州","泸西县");
            array[2514]=new Array("安宁市","昆明","安宁市");
            array[2515]=new Array("呈贡县","昆明","呈贡县");
            array[2516]=new Array("富民县","昆明","富民县");
            array[2517]=new Array("晋宁县","昆明","晋宁县");
            array[2518]=new Array("昆明市","昆明","昆明市");
            array[2519]=new Array("禄劝彝族苗族自治县","昆明","禄劝彝族苗族自治县");
            array[2520]=new Array("石林彝族自治县","昆明","石林彝族自治县");
            array[2521]=new Array("寻甸回族自治县","昆明","寻甸回族自治县");
            array[2522]=new Array("宜良县","昆明","宜良县");
            array[2523]=new Array("嵩明县","昆明","嵩明县");
            array[2524]=new Array("华坪县","丽江","华坪县");
            array[2525]=new Array("丽江市","丽江","丽江市");
            array[2526]=new Array("宁蒗彝族自治县","丽江","宁蒗彝族自治县");
            array[2527]=new Array("永胜县","丽江","永胜县");
            array[2528]=new Array("玉龙纳西族自治县","丽江","玉龙纳西族自治县");
            array[2529]=new Array("沧源佤族自治县","临沧","沧源佤族自治县");
            array[2530]=new Array("凤庆县","临沧","凤庆县");
            array[2531]=new Array("耿马傣族佤族治县","临沧","耿马傣族佤族治县");
            array[2532]=new Array("临沧县","临沧","临沧县");
            array[2533]=new Array("双江拉祜族佤族布朗族傣族自治县","临沧","双江拉祜族佤族布朗族傣族自治县");
            array[2534]=new Array("永德县","临沧","永德县");
            array[2535]=new Array("云县","临沧","云县");
            array[2536]=new Array("镇康县","临沧","镇康县");
            array[2537]=new Array("福贡县","怒江僳僳族自治州","福贡县");
            array[2538]=new Array("贡山独龙族怒族自治县","怒江僳僳族自治州","贡山独龙族怒族自治县");
            array[2539]=new Array("兰坪白族普米族自治县","怒江僳僳族自治州","兰坪白族普米族自治县");
            array[2540]=new Array("泸水县","怒江僳僳族自治州","泸水县");
            array[2541]=new Array("富源县","曲靖","富源县");
            array[2542]=new Array("会泽县","曲靖","会泽县");
            array[2543]=new Array("陆良县","曲靖","陆良县");
            array[2544]=new Array("罗平县","曲靖","罗平县");
            array[2545]=new Array("马龙县","曲靖","马龙县");
            array[2546]=new Array("曲靖市","曲靖","曲靖市");
            array[2547]=new Array("师宗县","曲靖","师宗县");
            array[2548]=new Array("宣威市","曲靖","宣威市");
            array[2549]=new Array("沾益县","曲靖","沾益县");
            array[2550]=new Array("江城哈尼族彝族自治县","思茅","江城哈尼族彝族自治县");
            array[2551]=new Array("景东彝族自治县","思茅","景东彝族自治县");
            array[2552]=new Array("景谷彝族傣族自治县","思茅","景谷彝族傣族自治县");
            array[2553]=new Array("澜沧拉祜族自治县","思茅","澜沧拉祜族自治县");
            array[2554]=new Array("孟连傣族拉祜族佤族自治县","思茅","孟连傣族拉祜族佤族自治县");
            array[2555]=new Array("墨江哈尼族自治县","思茅","墨江哈尼族自治县");
            array[2556]=new Array("普洱哈尼族彝族自治县","思茅","普洱哈尼族彝族自治县");
            array[2557]=new Array("思茅市","思茅","思茅市");
            array[2558]=new Array("西盟佤族自治县","思茅","西盟佤族自治县");
            array[2559]=new Array("镇沅彝族哈尼族拉祜族自治县","思茅","镇沅彝族哈尼族拉祜族自治县");
            array[2560]=new Array("富宁县","文山壮族苗族自治州","富宁县");
            array[2561]=new Array("广南县","文山壮族苗族自治州","广南县");
            array[2562]=new Array("麻栗坡县","文山壮族苗族自治州","麻栗坡县");
            array[2563]=new Array("马关县","文山壮族苗族自治州","马关县");
            array[2564]=new Array("丘北县","文山壮族苗族自治州","丘北县");
            array[2565]=new Array("文山县","文山壮族苗族自治州","文山县");
            array[2566]=new Array("西畴县","文山壮族苗族自治州","西畴县");
            array[2567]=new Array("砚山县","文山壮族苗族自治州","砚山县");
            array[2568]=new Array("景洪市","西双版纳傣族自治州","景洪市");
            array[2569]=new Array("勐海县","西双版纳傣族自治州","勐海县");
            array[2570]=new Array("勐腊县","西双版纳傣族自治州","勐腊县");
            array[2571]=new Array("澄江县","玉溪","澄江县");
            array[2572]=new Array("峨山彝族自治县","玉溪","峨山彝族自治县");
            array[2573]=new Array("华宁县","玉溪","华宁县");
            array[2574]=new Array("江川县","玉溪","江川县");
            array[2575]=new Array("通海县","玉溪","通海县");
            array[2576]=new Array("新平彝族傣族自治县","玉溪","新平彝族傣族自治县");
            array[2577]=new Array("易门县","玉溪","易门县");
            array[2578]=new Array("玉溪市","玉溪","玉溪市");
            array[2579]=new Array("元江哈尼族彝族傣族自治县","玉溪","元江哈尼族彝族傣族自治县");
            array[2580]=new Array("大关县","昭通","大关县");
            array[2581]=new Array("鲁甸县","昭通","鲁甸县");
            array[2582]=new Array("巧家县","昭通","巧家县");
            array[2583]=new Array("水富县","昭通","水富县");
            array[2584]=new Array("绥江县","昭通","绥江县");
            array[2585]=new Array("威信县","昭通","威信县");
            array[2586]=new Array("盐津县","昭通","盐津县");
            array[2587]=new Array("彝良县","昭通","彝良县");
            array[2588]=new Array("永善县","昭通","永善县");
            array[2589]=new Array("昭通市","昭通","昭通市");
            array[2590]=new Array("镇雄县","昭通","镇雄县");


            array[2591]=new Array("杭州","浙江","杭州");
            array[2592]=new Array("湖州","浙江","湖州");
            array[2593]=new Array("嘉兴","浙江","嘉兴");
            array[2594]=new Array("金华","浙江","金华");
            array[2595]=new Array("丽水","浙江","丽水");
            array[2596]=new Array("宁波","浙江","宁波");
            array[2597]=new Array("绍兴","浙江","绍兴");
            array[2598]=new Array("台州","浙江","台州");
            array[2599]=new Array("温州","浙江","温州");
            array[2600]=new Array("舟山","浙江","舟山");
            array[2601]=new Array("衢州","浙江","衢州");


            array[2602]=new Array("淳安县","杭州","淳安县");
            array[2603]=new Array("富阳市","杭州","富阳市");
            array[2604]=new Array("杭州市","杭州","杭州市");
            array[2605]=new Array("建德市","杭州","建德市");
            array[2606]=new Array("临安市","杭州","临安市");
            array[2607]=new Array("桐庐县","杭州","桐庐县");
            array[2608]=new Array("安吉县","湖州","安吉县");
            array[2609]=new Array("长兴县","湖州","长兴县");
            array[2610]=new Array("德清县","湖州","德清县");
            array[2611]=new Array("湖州市","湖州","湖州市");
            array[2612]=new Array("海宁市","嘉兴","海宁市");
            array[2613]=new Array("海盐县","嘉兴","海盐县");
            array[2614]=new Array("嘉善县","嘉兴","嘉善县");
            array[2615]=new Array("嘉兴市","嘉兴","嘉兴市");
            array[2616]=new Array("平湖市","嘉兴","平湖市");
            array[2617]=new Array("桐乡市","嘉兴","桐乡市");
            array[2618]=new Array("东阳市","金华","东阳市");
            array[2619]=new Array("金华市","金华","金华市");
            array[2620]=new Array("兰溪市","金华","兰溪市");
            array[2621]=new Array("磐安县","金华","磐安县");
            array[2622]=new Array("浦江县","金华","浦江县");
            array[2623]=new Array("武义县","金华","武义县");
            array[2624]=new Array("义乌市","金华","义乌市");
            array[2625]=new Array("永康市","金华","永康市");
            array[2626]=new Array("景宁畲族自治县","丽水","景宁畲族自治县");
            array[2627]=new Array("丽水市","丽水","丽水市");
            array[2628]=new Array("龙泉市","丽水","龙泉市");
            array[2629]=new Array("青田县","丽水","青田县");
            array[2630]=new Array("庆元县","丽水","庆元县");
            array[2631]=new Array("松阳县","丽水","松阳县");
            array[2632]=new Array("遂昌县","丽水","遂昌县");
            array[2633]=new Array("云和县","丽水","云和县");
            array[2634]=new Array("缙云县","丽水","缙云县");
            array[2635]=new Array("慈溪市","宁波","慈溪市");
            array[2636]=new Array("奉化市","宁波","奉化市");
            array[2637]=new Array("宁波市","宁波","宁波市");
            array[2638]=new Array("宁海县","宁波","宁海县");
            array[2639]=new Array("象山县","宁波","象山县");
            array[2640]=new Array("余姚市","宁波","余姚市");
            array[2641]=new Array("上虞市","绍兴","上虞市");
            array[2642]=new Array("绍兴市","绍兴","绍兴市");
            array[2643]=new Array("绍兴县","绍兴","绍兴县");
            array[2644]=new Array("新昌县","绍兴","新昌县");
            array[2645]=new Array("诸暨市","绍兴","诸暨市");
            array[2646]=new Array("嵊州市","绍兴","嵊州市");
            array[2647]=new Array("临海市","台州","临海市");
            array[2648]=new Array("三门县","台州","三门县");
            array[2649]=new Array("台州市","台州","台州市");
            array[2650]=new Array("天台县","台州","天台县");
            array[2651]=new Array("温岭市","台州","温岭市");
            array[2652]=new Array("仙居县","台州","仙居县");
            array[2653]=new Array("玉环县","台州","玉环县");
            array[2654]=new Array("苍南县","温州","苍南县");
            array[2655]=new Array("洞头县","温州","洞头县");
            array[2656]=new Array("乐清市","温州","乐清市");
            array[2657]=new Array("平阳县","温州","平阳县");
            array[2658]=new Array("瑞安市","温州","瑞安市");
            array[2659]=new Array("泰顺县","温州","泰顺县");
            array[2660]=new Array("温州市","温州","温州市");
            array[2661]=new Array("文成县","温州","文成县");
            array[2662]=new Array("永嘉县","温州","永嘉县");
            array[2663]=new Array("舟山市","舟山","舟山市");
            array[2664]=new Array("岱山县","舟山","岱山县");
            array[2665]=new Array("嵊泗县","舟山","嵊泗县");
            array[2666]=new Array("常山县","衢州","常山县");
            array[2667]=new Array("江山市","衢州","江山市");
            array[2668]=new Array("开化县","衢州","开化县");
            array[2669]=new Array("龙游县","衢州","龙游县");
            array[2670]=new Array("衢州市","衢州","衢州市");


            array[2671]=new Array("重庆市","重庆","重庆市");
            array[2672]=new Array("城口县","重庆市","城口县");
            array[2673]=new Array("大足县","重庆市","大足县");
            array[2674]=new Array("垫江县","重庆市","垫江县");
            array[2675]=new Array("丰都县","重庆市","丰都县");
            array[2676]=new Array("奉节县","重庆市","奉节县");
            array[2677]=new Array("合川市","重庆市","合川市");
            array[2678]=new Array("江津市","重庆市","江津市");
            array[2679]=new Array("开县","重庆市","开县");
            array[2680]=new Array("梁平县","重庆市","梁平县");
            array[2681]=new Array("南川市","重庆市","南川市");
            array[2682]=new Array("彭水苗族土家族自治县","重庆市","彭水苗族土家族自治县");
            array[2683]=new Array("荣昌县","重庆市","荣昌县");
            array[2684]=new Array("石柱土家族自治县","重庆市","石柱土家族自治县");
            array[2685]=new Array("铜梁县","重庆市","铜梁县");
            array[2686]=new Array("巫山县","重庆市","巫山县");
            array[2687]=new Array("巫溪县","重庆市","巫溪县");
            array[2688]=new Array("武隆县","重庆市","武隆县");
            array[2689]=new Array("秀山土家族苗族自治县","重庆市","秀山土家族苗族自治县");
            array[2690]=new Array("永川市","重庆市","永川市");
            array[2691]=new Array("酉阳土家族苗族自治县","重庆市","酉阳土家族苗族自治县");
            array[2692]=new Array("云阳县","重庆市","云阳县");
            array[2693]=new Array("忠县","重庆市","忠县");
            array[2694]=new Array("重庆市","重庆市","重庆市");
            array[2695]=new Array("潼南县","重庆市","潼南县");
            array[2696]=new Array("璧山县","重庆市","璧山县");
            array[2697]=new Array("綦江县","重庆市","綦江县");



          //--------------------------------------------
          //这是调用代码
          var liandong=new CLASS_LIANDONG(array) //设置数据源
          liandong.firstSelectChange("根目录","s1"); //设置第一个选择框
          liandong.subSelectChange("s1","s2"); //设置子级选择框
          liandong.subSelectChange("s2","s3");
    </script>
    <!-- JS省市县三级联动 结束 -->

</html>