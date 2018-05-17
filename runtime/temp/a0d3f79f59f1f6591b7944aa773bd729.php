<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:60:"F:\WWW\tp5\public/../application/index\view\index\index.html";i:1519963220;s:57:"F:\WWW\tp5\application\index\view\base\navigationBar.html";i:1519975431;s:55:"F:\WWW\tp5\application\index\view\base\carouselimg.html";i:1519871800;s:50:"F:\WWW\tp5\application\index\view\base\footer.html";i:1519892102;}*/ ?>
<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<title><?php echo (isset($web['indexName']) && ($web['indexName'] !== '')?$web['indexName']:'首页'); ?></title>
		<link rel="stylesheet" type="text/css" href="css/style.css" />
	</head>

	<body>
		<!--网站顶部导航条-->
		<!--网站顶部导航条-->
<div class="top">
    <div class="wrap">
        <div class="logo fl">
            <img src="static/logo/<?php echo $web['logo']; ?>" />
        </div>
        <div class="nav fl">
            <ul>
                <li <?php echo (isset($on1) && ($on1 !== '')?$on1:''); ?>>
                    <a href="index"><?php echo (isset($web['indexName']) && ($web['indexName'] !== '')?$web['indexName']:'首页'); ?></a>
                </li>
                <li <?php echo (isset($on2) && ($on2 !== '')?$on2:''); ?>>
                    <a href="Game"><?php echo (isset($web['gameName']) && ($web['gameName'] !== '')?$web['gameName']:'游戏中心'); ?></a>
                </li>
                <li <?php echo (isset($on3) && ($on3 !== '')?$on3:''); ?>>
                    <a href="news"><?php echo (isset($web['newsName']) && ($web['newsName'] !== '')?$web['newsName']:'新闻中心'); ?></a>
                </li>
                <li <?php echo (isset($on4) && ($on4 !== '')?$on4:''); ?>>
                    <a href="aboutAsPage"><?php echo (isset($web['aboutAsName']) && ($web['aboutAsName'] !== '')?$web['aboutAsName']:'关于我们'); ?></a>
                </li>
                <li <?php echo (isset($on5) && ($on5 !== '')?$on5:''); ?>>
                    <a href="joinUs"><?php echo (isset($web['joinUsName']) && ($web['joinUsName'] !== '')?$web['joinUsName']:'加入我们'); ?></a>
                </li>
            </ul>
        </div>
        <div class="share fl">
            <div class="share_fenlei weixin fl">
                <img src="img/weixin.png" />
                <div class="erweima">
                    <img src="static/QRCode/<?php echo (isset($web['weiXinUrl']) && ($web['weiXinUrl'] !== '')?$web['weiXinUrl']:''); ?>" />
                </div>
            </div>
            <div class="share_fenlei fl">
                <a href="<?php echo (isset($web['weiBoLink']) && ($web['weiBoLink'] !== '')?$web['weiBoLink']:''); ?>"><img src="img/weibo.png" /></a>
            </div>
        </div>
    </div>
</div> <!—引入navigationBar.html-->
		<!--网站banner,class="banner"里的轮播图的轮播和<span>标签的个数有关，保证有几个<li>标签就有几个<span>-->
		<!--每一页的轮播图-->
<div class="banner">
    <ul>
        <?php if(is_array($carouselimgList) || $carouselimgList instanceof \think\Collection || $carouselimgList instanceof \think\Paginator): $i = 0; $__LIST__ = $carouselimgList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;switch($key): case "0": ?>
            <li class="on">
                <a href="<?php echo $vo['Link']; ?>"><img src="static/carouselimg/<?php echo $vo['Url']; ?>" alt="" /></a>
            </li>
            <?php break; default: ?>
            <li>
                <a href="<?php echo $vo['Link']; ?>"><img src="static/carouselimg/<?php echo $vo['Url']; ?>" alt="" /></a>
            </li>
            <?php endswitch; endforeach; endif; else: echo "" ;endif; ?>
    </ul>
    <div class="banner-dot">
        <div class="dot">
            <?php if(is_array($carouselimgList) || $carouselimgList instanceof \think\Collection || $carouselimgList instanceof \think\Paginator): $i = 0; $__LIST__ = $carouselimgList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;switch($key): case "0": ?>
                        <span class="on"></span>
                    <?php break; default: ?>
                        <span></span>
                <?php endswitch; endforeach; endif; else: echo "" ;endif; ?>
        </div>
    </div>
</div> <!—carouselimg.html-->
		<!--网站内容-->
		<div class="zhuti_content">
			<div class="wrap">
				<div class="index_con">
					<div class="index_con_lf fl">
						<div class="pro_lb">
							<ul class="banner-img">
								<!--这里的轮播只是单纯的和<li>标签的个数有关系-->
								<?php if(is_array($gameList) || $gameList instanceof \think\Collection || $gameList instanceof \think\Paginator): $i = 0; $__LIST__ = $gameList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
									<li>
										<a href="<?php echo $vo['Link']; ?>"><img src="static/carouselimg/<?php echo $vo['Url']; ?>"></a>
									</li>
								<?php endforeach; endif; else: echo "" ;endif; ?>
							</ul>
							<ul class="banner-circle"></ul>
						</div>
					</div>
					<div class="index_con_rt fl">
						<div class="index_con_rt_top">
							<a href="news">
								<p>更多</p><span></span></a>
						</div>
						<ul>
							<?php if(is_array($newsList) || $newsList instanceof \think\Collection || $newsList instanceof \think\Paginator): $i = 0; $__LIST__ = $newsList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
								<li>
									<a href="newsPane?id=<?php echo $vo['Id']; ?>">
										<p><?php echo $vo['Name']; ?></p>
										<span><?php echo $vo['Time']; ?></span>
									</a>
								</li>
							<?php endforeach; endif; else: echo "" ;endif; ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<!--网站底部-->
		<!--网站底部-->
<div class="foot">
    <div class="wrap">

        <p class="p_foot_one">公司地址：<?php echo (isset($web['address']) && ($web['address'] !== '')?$web['address']:'深圳市南山区科兴科学院A2-11XX'); ?> 联系方式：<?php echo (isset($web['contactInfo']) && ($web['contactInfo'] !== '')?$web['contactInfo']:'0755-00000000'); ?></p>
        <p><?php echo (isset($web['copyright']) && ($web['copyright'] !== '')?$web['copyright']:'CopyRight © 2017 All Right Reserved 深圳市龙猫版权所有'); ?></p>
        <div class="foot_three">
            <ul>
                <li>
                    <a href="javascript:;">抵制不良游戏</a>
                </li>
                <li>
                    <a href="javascript:;">拒绝盗版游戏</a>
                </li>
                <li>
                    <a href="javascript:;">注意自我保护</a>
                </li>
                <li>
                    <a href="javascript:;">谨防受骗上当</a>
                </li>
                <li>
                    <a href="javascript:;">适度游戏益脑</a>
                </li>
                <li>
                    <a href="javascript:;">沉迷游戏伤身</a>
                </li>
                <li>
                    <a href="javascript:;">合理安排时间</a>
                </li>
                <li>
                    <a href="javascript:;">享受健康生活</a>
                </li>
            </ul>
        </div>
        <p><?php echo (isset($web['recordNum']) && ($web['recordNum'] !== '')?$web['recordNum']:'深圳市龙猫游戏设备17064573号'); ?></p>
    </div>
</div> <!—footer.html-->
	</body>

</html>
<script type="text/javascript" src="js/jquery.js"></script>
<!--banner js-->
<script type="text/javascript">
	var n = 0;
	var $page = $(".dot span");
	var $li = $(".banner ul li")
	var count = $(".dot").find('span').length;

	$page.click(function() {
		n = $(this).index();
		slide();
	})
	$(".banner").hover(function() {
		clearInterval(timer);
	}, function() {
		autoPlay();
	})
	$page.hover(function() {
		$(this).addClass("on").siblings().removeClass("on");
	})
	autoPlay();

	function autoPlay() {
		timer = setInterval(function() {
			n++;
			n %= count;
			slide();
		}, 3000)
	}

	function slide() {
		$page.eq(n).addClass("on").siblings().removeClass("on");
		$li.eq(n).fadeIn().siblings().hide();
	}
</script>
<script type="text/javascript">
	$(function() {
		showScroll();

		function showScroll() {
			$(window).scroll(function() {
				var scrollValue = $(window).scrollTop();
				scrollValue > 100 ? $('.top').fadeOut() : $('.top').fadeIn();
			});
		}
	})
</script>
<!--轮播js-->
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript">
	$(function() {
		var $banner = $('.pro_lb');
		var $banner_ul = $('.banner-img');
		var $btn = $('.banner-btn');
		var $btn_a = $btn.find('a')
		var v_width = $banner.width();
		var page = 1;
		var timer = null;
		var btnClass = null;
		var page_count = $banner_ul.find('li').length; //把这个值赋给小圆点的个数
		var banner_cir = "<li class='selected' href='javascript:;'><a></a></li>";
		for(var i = 1; i < page_count; i++) {
			//动态添加小圆点
			banner_cir += "<li><a href='javascript:;'></a></li>";
		}

		$('.banner-circle').append(banner_cir);
		var cirLeft = $('.banner-circle').width() * (-0.5);
		$('.banner-circle').css({
			'marginLeft': cirLeft
		});
		$banner_ul.width(page_count * v_width);

		function move(obj, classname) {
			//手动及自动播放
			if(!$banner_ul.is(':animated')) {
				if(classname == 'prevBtn') {
					if(page == 1) {
						$banner_ul.animate({
							left: -v_width * (page_count - 1)
						});
						page = page_count;
						cirMove();
					} else {
						$banner_ul.animate({
							left: '+=' + v_width
						}, "slow");
						page--;
						cirMove();
					}
				} else {
					if(page == page_count) {
						$banner_ul.animate({
							left: 0
						});
						page = 1;
						cirMove();
					} else {
						$banner_ul.animate({
							left: '-=' + v_width
						}, "slow");
						page++;
						cirMove();
					}
				}
			}
		}

		function cirMove() {
			//检测page的值，使当前的page与selected的小圆点一致
			$('.banner-circle li').eq(page - 1).addClass('selected')
				.siblings().removeClass('selected');
		}
		$banner.mouseover(function() {
			$btn.css({
				'display': 'block'
			});
			clearInterval(timer);
		}).mouseout(function() {
			$btn.css({
				'display': 'block'
			});
			clearInterval(timer);
			timer = setInterval(move, 3000);
		}).trigger("mouseout"); //激活自动播放
		$btn_a.mouseover(function() {
			//实现透明渐变，阻止冒泡
			$(this).animate({
				opacity: 0.6
			}, 'fast');
			$btn.css({
				'display': 'block'
			});
			return false;
		}).mouseleave(function() {
			$(this).animate({
				opacity: 0.3
			}, 'fast');
			$btn.css({
				'display': 'block'
			});
			return false;
		}).click(function() {
			//手动点击清除计时器
			btnClass = this.className;
			clearInterval(timer);
			timer = setInterval(move, 3000);
			move($(this), this.className);
		});
		$('.banner-circle li').live('click', function() {
			var index = $('.banner-circle li').index(this);
			$banner_ul.animate({
				left: -v_width * index
			}, 'slow');
			page = index + 1;
			cirMove();
		});
	});
</script>