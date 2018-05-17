<?php
    /**
     * 负责新闻的后台
     * User: 贺东泽X黑白大彩电
     * Date: 2018/3/1
     * Time: 16:34
     */
    namespace app\admin\controller;
    use think\Controller;
    use app\admin\module;
    use think\Session;
    class News extends Controller{
        protected $beforeActionList = [
            'befor' => '',//为空代表befor是当前类里全部方法的前置操作
        ];

        function befor()
        {
            /* 用于检测是否是正常访问 */
            $session = new Session();
            if ($session->get("userName") == null || $session->get("passWord") == null) {
                exit();//遇到非法访问直接停止
            }
        }

        /* 新增新闻的页面 */
        public function addNewsPage(){
            $session = new Session();
            $session->delete("news");
            $this->assign([
                "form"=>"addNews",//表单
            ]);
            return $this->fetch("news/addNews");
        }

        /* 新增新闻的处理方法 */
        public function addNews(){
            $session = new Session();
            $session->set("alertFlag",0);
            if($session->get("news")==null){
                $session->set("alert","请上传图片后再提交");
            }else{
                $sql = new module\news();
                if($sql->addNews(input("Name"),input("content"),$session->get("news"))){
                    $session->set("alert","保存成功");
                }else{
                    $session->set("alert","保存失败");
                }
            }
            $login = new Login();
            return $login->adminIndex();
        }

        /* 管理新闻的页面 */
        public function setNewsPage(){
            return $this->fetch("news/setNews");
        }

        /* 为数据表格提供数据的方法 */
        public function newsDataTable(){
//            dump(1);
            $page = input("page");//获取当前页
            $listLen = input("limit");//获取每页显示的数据量
            $sql = new module\news();
            $form = 0;
            /* 如果当前页不是第一页那么计算form的值 */
            if($page>1){
                $form = ($page-1)*$listLen;
            }
            $buffers = $sql->limit($form,$form+$listLen)->select();
            $dataList = array();
            foreach($buffers as $buffer){
                $img = "<img src='static/news/".$buffer->ImgUrl."'>";
                $buffer->Img = $img;
                $dataList[count($dataList)] = $buffer;
            }
            $array = [
                "code"=>0 //0表示成功，其它失败
                ,"msg"=> $page."页" //提示信息 //一般上传失败后返回
                ,'count'=> count($sql->getAllNews()) //总数据量
                ,"data"=>  $dataList//本页要显示的数据
            ];
            return json($array);
        }

        /* 修改新闻的页面 */
        public function modifyNewsPage(){
            $sql = new module\news();
            $session = new Session();
            $session->delete("news");
            $session->delete("oldNews");
            $news = $sql->getNewsById(input("id"));
            $session->set("oldNews",$news->ImgUrl);//将现役的封面存入session
            $this->assign([
                "form"=>"setNews",//表单
                "news"=>$news,
                "img"=>"src='static/news/".$news->ImgUrl."'"
            ]);
            return $this->fetch("news/addNews");
        }

        /* 修改新闻的处理方法 */
        public function setNews(){
            $session = new Session();
            $session->set("alertFlag",0);
            $ImgUrl = "";
            /* 如果用户没有重新提交封面那么取出现役的封面 */
            if($session->get("news")==null){
                $ImgUrl = $session->get("oldNews");
                $session->delete("oldNews");
            }else{
                $ImgUrl = $session->get("news");
                $session->delete("news");
//                unlink(ROOT_PATH."public\\static\\news\\".$session->get("setGame"));
            }
            $sql = new module\news();
            if($sql->setNews(input("id"),input("Name"),input("content"),$ImgUrl)){
                $session->set("alert","修改成功");
            }else{
                $session->set("alert","修改失败");
            }
            $login = new Login();
            return $login->adminIndex();
        }

        public function deleteNews(){
            $sql = new module\news();
            if($sql->deleteNewsById(input("id"))>0){
                return 1;//删除成功
            }else{
                return -1;//删除失败
            }
        }

        /* 获取新闻封面 */
        public function getNewsImg(){
            $file = request()->file("file");
            $info = $file->move(ROOT_PATH . 'public' . DS . 'static' . DS . 'news');//下载到pulic/static/news目录
            if($info){
                $session = new Session();
                /* 删除已经存上传在服务器待命的图片 */
                if($session->get("news")!=null){
                    unlink(ROOT_PATH."public\\static\\news\\".$session->get("news"));
                    $session->delete("news");
                }
                $session->set("news",$info->getSaveName());
                $array = [
                    "code"=>0 //0表示成功，其它失败
                    ,"msg"=> "上传成功" //提示信息 //一般上传失败后返回
                    ,"data"=> [
                        "src"=> $info->getSaveName()
                        ,"title"=> "图片名称" //可选
                    ]
                ];
                return json($array);
            }else{
                $array = [
                    "code"=>1 //0表示成功，其它失败
                    ,"msg"=> "上传失败" //提示信息 //一般上传失败后返回
                    ,"data"=> [
                        "src"=> null
                        ,"title"=> "图片名称" //可选
                    ]
                ];
                return json($array);
            }
        }
    }
?>