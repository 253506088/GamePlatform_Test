<?php
    /**
     * 负责打印前台所以页面的类
     * User: 贺东泽
     * Date: 2018/3/01
     * Time: 10：25
     */
    namespace app\index\controller;
    use app\admin\module;
    use think\Controller;

    class Index extends Controller
    {
        use \traits\controller\Error;

        /* 测试页面 */
        function testPage(){
            return $this->fetch();
        }

        /* 测试方法 */
        function test(){
            return md5("admin");
        }

        /* 打印前台首页 */
        public function index()
        {
            $carouselimg = new module\carouselimg();
            $carouselimgList = $carouselimg->getCarouselImgByPageId("index");//获取首页的滚动图列表
            $webinfo = new module\webinfo();
            $news = new module\news();
            $this->assign([
                'on1' =>"class='on'",//当前页为首页
                'web' =>$webinfo->getWebInfo(),
                'carouselimgList'=>$carouselimg->getCarouselImgByPageId("index"),//获取首页的滚动图列表
                'gameList'=>$carouselimg->getCarouselImgByPageId("game"),//获取首页游戏区的滚动图列表
                'newsList'=>$news->getIndexNews(),//获取首页显示的新闻列表
            ]);
            return $this->fetch("index/index");
        }

        /* 打印前台游戏页面 */
        public function Game(){
            $carouselimg = new module\carouselimg();
            $webinfo = new module\webinfo();
            $game = new module\game();
            /* 第一个参数是每一页显示的数据量，第二个参数是总数据量，分多少页会自动算 */
            $buffers = $game->paginate(9,count($game->getAllGame()));
            $gameList = array();
            $this->assign([
                'on2' =>"class='on'",//当前页为游戏页
                'web' =>$webinfo->getWebInfo(),
                'list' =>$buffers,//分页的数据
                'page' =>input("page"),//当前页
            ]);
            return $this->fetch("index/youxizhongxin");
        }

        /* 打印前台新闻页 */
        public function news(){
            $carouselimg = new module\carouselimg();
            $webinfo = new module\webinfo();
            $news = new module\news();
            /* 第一个参数是每一页显示的数据量，第二个参数是总数据量，分多少页会自动算 */
            $buffers = $news->paginate(5,count($news->getAllNews()));
            $this->assign([
                'on3' =>"class='on'",//当前页为新闻页
                'web' =>$webinfo->getWebInfo(),
                'list' =>$buffers,//分页的数据
                'page' =>input("page"),//当前页
                'carouselimgList'=>$carouselimg->getCarouselImgByPageId("news"),//获取新闻页的滚动图列表
            ]);
            return $this->fetch("index/xinwenzhongxin");
        }

        /* 打印新闻的详细页面 */
        public function newsPage(){
            $carouselimg = new module\carouselimg();
            $webinfo = new module\webinfo();
            $news = new module\news();
            $new = $news->getNewsById(input("id"));
            $upNews = null;
            $downNews = null;
            $upBuffer = null;
            $downBuffer = null;
            $buffers = $news->getAllNews();
            /* 找出本新闻的上一篇和下一篇,第一篇没有上一篇，最后一篇没有下一篇 */
            for($i=0;$i<count($buffers);$i++){
                if($i==0){
                    if($new->Id==$buffers[$i]->Id){
                        $upNews = "<a href='javascript:;'>没有了</a>";
                        $downNews = "<a href='newsPage?id=".$buffers[$i+1]->Id."'>下一篇</a>";
                        break;
                    }else{
                        $upBuffer = "<a href='newsPage?id=".$buffers[$i]->Id."'>上一篇</a>";
                    }
                }else if($i!=(count($buffers)-1)){
                    if($new->Id==$buffers[$i]->Id){
                        $upNews = $upBuffer;
                        $downNews = "<a href='newsPage?id=".$buffers[$i+1]->Id."'>下一篇</a>";
                        break;
                    }else{
                        $upBuffer = "<a href='newsPage?id=".$buffers[$i]->Id."'>上一篇</a>";
                    }
                }else{
                    if($new->Id==$buffers[$i]->Id){
                        $upNews = $upBuffer;
                        $downNews = "<a href='javascript:;'>没有了</a>";
                        break;
                    }else{
                        $upBuffer = "<a href='newsPage?id=".$buffers[$i]->Id."'>上一篇</a>";
                    }
                }
            }

            $this->assign([
                'on3' =>"class='on'",
                'web' =>$webinfo->getWebInfo(),
                'carouselimgList'=>$carouselimg->getCarouselImgByPageId("news"),//获取新闻页的滚动图列表
                'new' =>$new,//新闻内容
                'downId' =>$downNews,//下一篇id
                'upId' =>$upNews,//上一篇id
            ]);
            return $this->fetch("index/xinwenxiangqing");
        }

        /* 打印关于我们页面 */
        public function aboutAsPage(){
            $carouselimg = new module\carouselimg();
            $webinfo = new module\webinfo();
            $aboutas = new module\aboutas();
            $this->assign([
                'on4' =>"class='on'",//当前页为关于我们
                'web' =>$webinfo->getWebInfo(),
                'carouselimgList'=>$carouselimg->getCarouselImgByPageId("aboutAs"),//获取首页的滚动图列表
                'gameList'=>$carouselimg->getCarouselImgByPageId("game"),//获取首页游戏区的滚动图列表
                'aboutas'=>$aboutas->getAboutAs(),
            ]);
            return $this->fetch("index/guanyuwomen");
        }

        /* 打印加入我们页面 */
        public function joinUs(){
            $carouselimg = new module\carouselimg();
            $joinus = new module\joinus();
            $webinfo = new module\webinfo();
            $this->assign([
                'on5' =>"class='on'",//当前页为加入我们
                'web' =>$webinfo->getWebInfo(),
                'carouselimgList'=>$carouselimg->getCarouselImgByPageId("joinUs"),//获取加入我们的滚动图列表
                'gameList'=>$carouselimg->getCarouselImgByPageId("game"),//获取首页游戏区的滚动图列表
                /* 分页，第一个参数是一个页面显示的数据量，第二个是总数量。会自动返回本页显示的数据集合 */
                'list'=>$joinus->paginate(8,count($joinus->getAllJoinUs())),
            ]);
            return $this->fetch("index/jiaruwomen");
        }
    }
?>
