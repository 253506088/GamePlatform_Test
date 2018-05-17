<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:60:"F:\WWW\tp5\public/../application/admin\view\index\admin.html";i:1519977647;s:50:"F:\WWW\tp5\application\admin\view\base\header.html";i:1519980069;s:63:"F:\WWW\tp5\application\admin\view\base\headernavigationBar.html";i:1519792091;s:57:"F:\WWW\tp5\application\admin\view\base\navigationBar.html";i:1519975026;s:50:"F:\WWW\tp5\application\admin\view\base\footer.html";i:1519783424;}*/ ?>
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
                        ,field:"img"
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
                        ,area: ['1200px', '700px']
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
    <title>后台主页</title>
</head>
<script>
    /* 一打开首页就显示必应 */
    var num = 0;
    if(num==0){
        var othis = $("#biying"), method = othis.data('method');
        active[method] ? active[method].call(this, othis) : '';
        num++;
    }
</script>
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
                    <!--<dd><a href="">用户管理</a></dd>-->
                </dl>
            </li>
            <li class="layui-nav-item">
                <a href="javascript:;">轮播图设置</a>
                <dl class="layui-nav-child">
                    <dd><a href="addCarouselimgPage">新增轮播图</a></dd>
                    <dd><a href="setCarouselimgPage">轮播图管理</a></dd>
                </dl>
            </li>
            <li class="layui-nav-item">
                <a href="javascript:;">游戏中心设置</a>
                <dl class="layui-nav-child">
                    <dd><a href="addGamePage">新增游戏</a></dd>
                    <dd><a href="setGamePage">管理游戏</a></dd>
                </dl>
            </li>
            <li class="layui-nav-item">
                <a href="javascript:;">新闻中心设置</a>
                <dl class="layui-nav-child">
                    <dd><a href="addNewsPage">新增新闻</a></dd>
                    <dd><a href="setNewsPage">管理新闻</a></dd>
                </dl>
            </li>
            <li class="layui-nav-item">
                <a href="javascript:;">关于我们</a>
                <dl class="layui-nav-child">
                    <dd><a href="setAboutAsPage">管理信息</a></dd>
                </dl>
            </li>
            <li class="layui-nav-item">
                <a href="javascript:;">加入我们</a>
                <dl class="layui-nav-child">
                    <dd><a href="addJoinUsPage">新增招聘信息</a></dd>
                    <dd><a href="setJoinUsPage">管理招聘信息</a></dd>
                </dl>
            </li>
            <!--<li class="layui-nav-item"><a href="adminIndex">后台首页</a></li>-->
            <!--<li class="layui-nav-item"><a href="index">前台首页</a></li>-->
        </ul>
    </div>
</div> <!—引入navigationBar.html-->

        <div class="layui-body">
            <!-- 内容主体区域 -->
            <div class="site-demo-button" id="layerDemo" style="margin-bottom: 0;">
                <blockquote class="layui-elem-quote">尊敬的会员欢迎回来</blockquote>
                <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
                    <legend>系统环境说明</legend>
                </fieldset>
                <ul class="layui-timeline">
                    <li class="layui-timeline-item">
                        <i class="layui-icon layui-timeline-axis"></i>
                        <div class="layui-timeline-content layui-text">
                            <div class="layui-timeline-title">ThinkPHP5.0框架</div>
                        </div>
                    </li>
                    <li class="layui-timeline-item">
                        <i class="layui-icon layui-timeline-axis"></i>
                        <div class="layui-timeline-content layui-text">
                            <div class="layui-timeline-title">PHP5.4.45+Apache</div>
                        </div>
                    </li>
                    <li class="layui-timeline-item">
                        <i class="layui-icon layui-timeline-axis"></i>
                        <div class="layui-timeline-content layui-text">
                            <div class="layui-timeline-title">MySQL</div>
                        </div>
                    </li>
                    <li class="layui-timeline-item">
                        <i class="layui-icon layui-timeline-axis"></i>
                        <div class="layui-timeline-content layui-text">
                            <div class="layui-timeline-title">上传附件限制2Mb</div>
                        </div>
                    </li>
                    <li class="layui-timeline-item">
                        <i class="layui-icon layui-anim layui-anim-rotate layui-anim-loop layui-timeline-axis"></i>
                        <div class="layui-timeline-content layui-text">
                            <div class="layui-timeline-title">龙猫后台</div>
                        </div>
                    </li>
                </ul>
                <!--<button data-method="setTop" id="biying" class="layui-btn">内置必应</button>-->
                <button data-method="offset" data-type="auto" id="show" class="layui-btn layui-btn-normal" style="display: none;"><?php echo (isset($alert) && ($alert !== '')?$alert:'欢迎回来'); ?></button>
            </div>
        </div>

        <div class="layui-footer">
            <h4>深圳市龙猫版权所有</h4> <!—headernavigationBa.html-->
        </div>
    </div>
</body>
</html>