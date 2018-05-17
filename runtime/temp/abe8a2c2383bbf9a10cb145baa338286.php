<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:72:"F:\WWW\tp5\public/../application/admin\view\Carouselimg\carouselimg.html";i:1519806767;s:50:"F:\WWW\tp5\application\admin\view\base\header.html";i:1519801436;s:63:"F:\WWW\tp5\application\admin\view\base\headernavigationBar.html";i:1519792091;s:57:"F:\WWW\tp5\application\admin\view\base\navigationBar.html";i:1519800459;s:50:"F:\WWW\tp5\application\admin\view\base\footer.html";i:1519783424;}*/ ?>
<!DOCTYPE html>
<html lang="cn">
<head>
    <!--连接jQuery文件-->
    <script type="text/javascript" src="js/jquery-3.2.1.js"></script>
    <link rel="stylesheet" href="layui/css/layui.css"/>
    <script src="layui/layui.js" merge="true" type="text/javascript"></script>
    <script>
        layui.use('form', function(){
            var form = layui.form;
            //监听提交
            form.on('submit(formDemo)', function(data){
                //$("#content").val(layedit.getContent(index));
                //layer.msg(JSON.stringify(data.field));
            });
        });
        /* 预先加载 */
        layui.use('element', function(){
            var element = layui.element;
        });

        /* 图片上传 */
        layui.use('upload', function(){
            var upload = layui.upload;
            var jq = layui.jquery;
            //多图片上传
            upload.render({
                url: '<?php echo (isset($uolodImgs) && ($uolodImgs !== '')?$uolodImgs:''); ?>'
                ,elem:'#test2'
                ,ext: 'jpg|png|gif'
                ,size:1024 //1mb
                ,area: ['500', '500px']
                ,before: function(input){
                    loading = layer.load(2, {
                        shade: [0.2,'#000']
                    });
                }
                ,done: function(res){
                    layer.close(loading);
                    jq('input[name=img]').val(res.path);
                    //alert(res.path);
                    if(res.error!='full'){
                        /* 添加到预览 */
                        var img =$("<img src='"+res.data.src+"' height='20%' width='20%' alt=''/>");
                        var nbsp = $("<span>               </span>");
                        $("#demo2").append(img);
                        $("#demo2").append(nbsp);
                        img.src = ""+res.data.src;
                    }else{
                        layer.msg(res.alert);
                    }
                    //layer.msg(res.msg, {icon: 1, time: 1000});//弹窗信息
                }
            });

            /* 富文本编辑框 */

            layui.use('layedit', function(){
                var layedit = layui.layedit
                    ,$ = layui.jquery;

                /* 设置图片上传 */
                layedit.set({
                    uploadImage: {
                        url: '<?php echo (isset($textImg) && ($textImg !== '')?$textImg:''); ?>' //接口url
                        ,type: 'post' //默认post
                    }
                });

                layedit.build('demo'); //建立编辑器


                //构建一个默认的编辑器
                var index = layedit.build('LAY_demo1');

                //编辑器外部操作
                var active = {
                    content: function(){
                        alert(layedit.getContent(index)); //获取编辑器内容
                    }
                    ,text: function(){
                        alert(layedit.getText(index)); //获取编辑器纯文本内容
                    }
                    ,selection: function(){
                        alert(layedit.getSelection(index));
                    }
                };

                $('.site-demo-layedit').on('click', function(){
                    var type = $(this).data('type');
                    active[type] ? active[type].call(this) : '';
                });

                //自定义工具栏
                layedit.build('LAY_demo2', {
                    tool: ['face', 'link', 'unlink', '|', 'left', 'center', 'right']
                    ,height: 100
                })
            });
        });

        layui.use('layer', function(){ //独立版的layer无需执行这一句
        var $ = layui.jquery, layer = layui.layer;
        });//独立版的layer无需执行这一句

    </script>
    <script>
        /* 弹出窗口（提示信息和必应的） */
        layui.use('layer', function(){ //独立版的layer无需执行这一句
            var $ = layui.jquery, layer = layui.layer; //独立版的layer无需执行这一句
            //触发事件
            var active = {
                setTop: function(){
                    var that = this;
                    //多窗口模式，层叠置顶
                    layer.open({
                        type: 2 //此处以iframe举例
                        ,title: '必应一下'
                        ,area: ['700px', '500px']
                        ,shade: 0
                        ,maxmin: true
                        ,offset: [ //为了演示，随机坐标
                            Math.random()*($(window).height()-300)
                            ,Math.random()*($(window).width()-390)
                        ]
                        ,content: 'https://cn.bing.com/'
                        ,btn: ['再开必应', '全部关闭'] //只是为了演示
                        ,yes: function(){
                            $(that).click();
                        }
                        ,btn2: function(){
                            layer.closeAll();
                        }

                        ,zIndex: layer.zIndex //重点1
                        ,success: function(layero){
                            layer.setTop(layero); //重点2
                        }
                    });
                }
                ,offset: function(othis){
                    var type = othis.data('type')
                            ,text = othis.text();
                    layer.open({
                        type: 1
                        ,offset: type //具体配置参考：http://www.layui.com/doc/modules/layer.html#offset
                        ,id: 'layerDemo'+type //防止重复弹出
                        ,content: '<div style="padding: 20px 100px;">'+ text +'</div>'
                        ,btn: '关闭'
                        ,btnAlign: 'c' //按钮居中
                        ,shade: 0 //不显示遮罩
                        ,yes: function(){
                            layer.closeAll("");
                        }
                    });
                }
            };

            /* 用于显示必应的 */
            $('#biying').on('click', function(){
                var othis = $(this), method = othis.data('method');
                active[method] ? active[method].call(this, othis) : '';
            });

            /* 用于显示提示信息的,$alertFlag=0才可以弹出,默认不允许弹出 */
            var $alertFlag = <?php echo (isset($alertFlag) && ($alertFlag !== '')?$alertFlag:'1'); ?>;
            if($alertFlag==0){
                var othis = $("#show"), method = othis.data('method');
                active[method] ? active[method].call(this, othis) : '';
                $alertFlag++;
            }

        });
    </script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><!--引入网站头部-->
<title>设置轮播图</title>
</head>

<body id="body">
<div class="layui-layout layui-layout-admin">
    <div class="layui-header">
        <!-- 头部区域（可配合layui已有的水平导航） -->
        <div class="layui-logo">龙猫后台</div>
<ul class="layui-nav layui-layout-left">
    <li class="layui-nav-item"><a data-method="setTop" id="biying" >打开必应</a></li>
    <li class="layui-nav-item"><a href="adminIndex">后台首页</a></li>
    <li class="layui-nav-item"><a href="index">前台首页</a></li>
    <li class="layui-nav-item">
        <!--<a href="javascript:;">其它系统</a>-->
        <!--<dl class="layui-nav-child">-->
            <!--<dd><a href="">邮件管理</a></dd>-->
            <!--<dd><a href="">消息管理</a></dd>-->
            <!--<dd><a href="">授权管理</a></dd>-->
        <!--</dl>-->
    </li>
</ul>
<ul class="layui-nav layui-layout-right">
    <li class="layui-nav-item">
        <a href="javascript:;">
            <img src="img/avtar.png" class="layui-nav-img">
            超级管理员
        </a>
        <!--<dl class="layui-nav-child">-->
            <!--<dd><a href="">基本资料</a></dd>-->
            <!--<dd><a href="">安全设置</a></dd>-->
        <!--</dl>-->
    </li>
    <li class="layui-nav-item"><a href="logout">退出登录</a></li>
</ul>
 <!—headernavigationBa.html-->
    </div>

    <!-- 左靠边导航栏 -->
    <!--左导航栏-->
<div class="layui-side layui-bg-black">
    <div class="layui-side-scroll">
        <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
        <ul class="layui-nav layui-nav-tree" lay-filter="test">
            <!-- 侧边导航: <ul class="layui-nav layui-nav-tree layui-nav-side"> -->
            <li class="layui-nav-item">
                <a href="javascript:;">系统管理</a>
                <dl class="layui-nav-child ">
                    <dd><a href="SetWebPage">网站设置</a></dd>
                    <dd><a href="">用户管理</a></dd>
                </dl>
            </li>
            <li class="layui-nav-item">
                <a href="javascript:;">首页设置</a>
                <dl class="layui-nav-child">
                    <dd><a href="setCarouselimgPage?id=index">首页轮播图</a></dd>
                    <dd><a href="setCarouselimgPage?id=game">游戏信息轮播图</a></dd>
                </dl>
            </li>
            <li class="layui-nav-item">
                <a href="javascript:;">游戏中心设置</a>
                <dl class="layui-nav-child">
                    <dd><a href="">新增游戏</a></dd>
                    <dd><a href="">管理游戏</a></dd>
                </dl>
            </li>
            <li class="layui-nav-item">
                <a href="javascript:;">新闻中心设置</a>
                <dl class="layui-nav-child">
                    <dd><a href="setCarouselimgPage?id=news">新闻中心轮播图</a></dd>
                    <dd><a href="">新增新闻</a></dd>
                    <dd><a href="">管理新闻</a></dd>
                </dl>
            </li>
            <li class="layui-nav-item">
                <a href="javascript:;">关于我们</a>
                <dl class="layui-nav-child">
                    <dd><a href="setCarouselimgPage?id=aboutAs">关于我们轮播图</a></dd>
                    <dd><a href="">管理信息</a></dd>
                </dl>
            </li>
            <li class="layui-nav-item">
                <a href="javascript:;">加入我们</a>
                <dl class="layui-nav-child">
                    <dd><a href="setCarouselimgPage?id=joinUs">加入我们轮播图</a></dd>
                    <dd><a href="">新增招聘信息</a></dd>
                    <dd><a href="">管理招聘信息</a></dd>
                </dl>
            </li>
            <!--<li class="layui-nav-item"><a href="adminIndex">后台首页</a></li>-->
            <!--<li class="layui-nav-item"><a href="index">前台首页</a></li>-->
        </ul>
    </div>
</div> <!—引入navigationBar.html-->

    <div class="layui-body">
        <!-- 内容主体区域 -->
        <blockquote class="layui-elem-quote">管理轮播图</blockquote>
        <div class="site-demo-button" id="layerDemo" style="margin-bottom: 0;">
            <form action="SetWeb" enctype="multipart/form-data" method="post" id="form1" class="layui-form">
                <div class="layui-form-item " pane="">
                    <label class="layui-form-label">设置轮播</label>
                    <div class="layui-input-block" id="current">
                        <input type="radio" name="rad" value="index" title="首页">
                        <input type="radio" name="rad" value="game" title="首页游戏">
                        <input type="radio" name="rad" value="news" title="新闻">
                        <input type="radio" name="rad" value="aboutAs" title="关于我们">
                        <input type="radio" name="rad" value="joinUs" title="加入我们">
                    </div>
                </div>



                <div class="demoTable">
                    搜索ID：
                    <div class="layui-inline">
                        <input class="layui-input" name="id" id="demoReload" autocomplete="off">
                    </div>
                    <button class="layui-btn" data-type="reload">搜索</button>
                </div>

                <table class="layui-hide" id="LAY_table_user" lay-filter="user"></table>


                <script src="//res.layui.com/layui/dist/layui.js" charset="utf-8"></script>
                <!-- 注意：如果你直接复制所有代码到本地，上述js路径需要改成你本地的 -->
                <script>
                    layui.use('table', function(){
                        var table = layui.table;

                        //方法级渲染
                        table.render({
                            elem: '#LAY_table_user'
                            ,url: 'pageData'
                            ,cols: [[
                                {field:'sign', title: '签名'}
                                ,{field:'sign', title: '签名'}
                                ,{fixed: 'right', width:178, align:'center', toolbar: '#barDemo'}
                            ]]
                            ,id: 'testReload'
                            ,page: true
                            ,height: "full 200"
                        });

                        var $ = layui.$, active = {
                            reload: function(){
                                var demoReload = $('#demoReload');

                                //执行重载
                                table.reload('testReload', {
                                    page: {
                                        curr: 1 //重新从第 1 页开始
                                    }
                                    ,where: {
                                        key: {
                                            id: demoReload.val()
                                        }
                                    }
                                });
                            }
                        };

                        $('.demoTable .layui-btn').on('click', function(){
                            var type = $(this).data('type');
                            active[type] ? active[type].call(this) : '';
                        });
                    });
                </script>

                <script type="text/html" id="barDemo">
                    <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detail">查看</a>
                    <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
                    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
                </script>

                <script src="//res.layui.com/layui/dist/layui.js" charset="utf-8"></script>
                <!-- 注意：如果你直接复制所有代码到本地，上述js路径需要改成你本地的 -->
                <script>
                    layui.use('table', function(){
                        var table = layui.table;
                        //监听单元格事件
                        table.on('tool(demoEvent)', function(obj){
                            var data = obj.data;
                            if(obj.event === 'setSign'){
                                layer.prompt({
                                    formType: 2
                                    ,title: '修改 ID 为 ['+ data.id +'] 的用户签名'
                                    ,value: data.sign
                                }, function(value, index){
                                    layer.close(index);

                                    //这里一般是发送修改的Ajax请求

                                    //同步更新表格和缓存对应的值
                                    obj.update({
                                        sign: value
                                    });
                                });
                            }
                        });
                    });
                </script>

                <!--id-->
                <input type="hidden" name="id" value="<?php echo (isset($carouselimg['Id']) && ($carouselimg['Id'] !== '')?$carouselimg['Id']:''); ?>">

                <!--提交按钮-->
                <!--<div class="layui-form-item">-->
                    <!--<div class="layui-input-block">-->
                        <!--<button class="layui-btn" lay-submit lay-filter="formDemo">提交</button>-->
                        <!--<button type="reset" class="layui-btn layui-btn-primary">重置</button>-->
                    <!--</div>-->
                <!--</div>-->
            </form>
        </div>
    </div>

    <div class="layui-footer">
        <h4>深圳市龙猫版权所有</h4> <!—headernavigationBa.html-->
    </div>
</div>
</body>
<script>
    var current = "<?php echo (isset($current) && ($current !== '')?$current:'index'); ?>";//用于记录上一次单选框选择的是什么,默认值是首页
//    $("input[name='rad']").each(function(){
//        if($(this).val() == current){
//            $(this).attr( "checked","checked");
//        }
//    });
    /* 监听单选框的变化，如果变化了那么上传给服务器用户选择的选项 */
    $('#current').click(function(event){
        var buffer = $("input[name='rad']:checked").val();//获取当前单选框的内容
        if(buffer!=current){
            current = buffer;
            var xmlhttp;
            if (window.XMLHttpRequest)
            {
                //  IE7+, Firefox, Chrome, Opera, Safari 浏览器执行代码
                xmlhttp=new XMLHttpRequest();
            }
            else
            {
                // IE6, IE5 浏览器执行代码
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
                if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    table.reload("listReload", {
                        where: { //设定异步数据接口的额外参数，任意设
                            url:'pageData'
                        }
                        ,page: {
                            curr: 1 //重新从第 1 页开始
                        }
                    });
                }
            }
            xmlhttp.open("POST","getCurrent",true);
            xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            xmlhttp.send("current="+current);
        }else{
            alert(1);
        }
    });

    layui.use('upload', function(){
        var $ = layui.jquery
                ,upload = layui.upload;

        //普通图片上传
        var uploadInst = upload.render({
            elem: '#test1'
            ,url: 'getQRCode'
            ,accept: 'images'
            ,exts:'jpg|png|gif|bmp|jpeg'
            ,size:2*1024 //2mb
            ,before: function(obj){
                //预读本地文件示例，不支持ie8
                obj.preview(function(index, file, result){
                    $('#demo1').attr('src', result); //图片链接（base64）
                });
            }
            ,done: function(res){
                //如果上传失败
                if(res.code > 0){
                    return layer.msg('上传失败');
                }
                //上传成功
            }
            ,error: function(){
                //演示失败状态，并实现重传
                var demoText = $('#demoText');
                demoText.html('<a class="layui-btn layui-btn-mini demo-reload">重试</a>');
                demoText.find('.demo-reload').on('click', function(){
                    uploadInst.upload();
                });
            }
        });
    });
</script>
</html>