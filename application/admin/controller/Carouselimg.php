<?php
    /**
     * 用于进行轮播图的后台操作类
     * User: 贺东泽
     * Date: 2018/2/28
     * Time: 14:27
     */
    namespace app\admin\controller;
    use think\Controller;
    use app\admin\module;
    use think\Session;
    class Carouselimg extends Controller{
        protected  $beforeActionList=[
            'befor'    =>'',//为空代表befor是当前类里全部方法的前置操作
        ];
        function befor(){
            /* 用于检测是否是正常访问 */
            $session = new Session();
            if($session->get("userName")==null || $session->get("passWord")==null){
                exit();//遇到非法访问直接停止
            }
        }

        /* 设置轮播图的页面 */
        function addCarouselimgPage(){
            $sql = new module\carouselimgpage();
            $session = new Session();
            $session->delete("carouselimg");//清除
            $this->assign([
                "form"=>"setCarouselimg",
                "pageNameList"=>$sql->getAll()
            ]);
            return $this->fetch("Carouselimg/addcarouselimg");
        }

        /* 管理轮播图的页面 */
        function setCarouselimgPage(){
            return $this->fetch("Carouselimg/setcarouselimg");
        }

        /* 为管理轮播图的页面提供数据 */
        function pageData(){
            $sql = new module\carouselimg();
            $page = input("page");//获取当前页
            $listLen = input("limit");//获取每页显示的数据量
            $form = 0;
            /* 如果不是第一页，重新设置$form的值 */
            if($page>1){
                $form = ($page-1)*$listLen;
            }
            $buffers = $sql->limit($form,$listLen)->select();
            $list = array();
            foreach($buffers as $buffer){
                $img = "<img src='static/carouselimg/".$buffer->Url."'>";
                $buffer->Img = $img;
                $list[count($list)] = $buffer;
            }

            $array = [
                "code"=>0 //0表示成功，其它失败
                ,"msg"=> $page."页" //提示信息 //一般上传失败后返回
                ,'count'=> count($sql->getAllCarouselImg()) //总数据量
                ,"data"=>  $list//本页要显示的数据
            ];
            return json($array);
        }


        /* 设置轮播图的处理方法 */
        function setCarouselimg(){
            $sql = new module\carouselimg();
            $session = new Session();
            $session->set("alertFlag",0);
            /* 如果为空则不允许提交 */
            if($session->get("carouselimg")==null){
                $session->set("alert","请上传轮播图后再提交");
            }else{
                /* 获取数据 */
                $Url = $session->get("carouselimg");
                $session->delete("carouselimg");
                $Link = input("Link");
                $PageId = $this->request->param("PageId");
                $page = new module\carouselimgpage();
                $buffer = $page->getPageById($PageId);
                $PageName = $buffer->pageName;

                /* 开始保存 */
                if($sql->addCarouselImg($PageId,$PageName,$Url,$Link)>0){
                    $session->set("alert","保存成功");
                }else{
                    $session->set("alert","保存失败");
                }
            }
            $login = new Login();
            return $login->adminIndex();
        }

        /* 修改轮播图的页面 */
        function modifyCarouselimgPage(){
            /* 获取资源 */
            $pageSql = new module\carouselimgpage();
            $session = new Session();
            $buffers = $pageSql->getAll();
            $pageList = array();
            $carouselimgSql = new module\carouselimg();
            $carouselimg = $carouselimgSql->getCarouselImgById(input("id"));
            $session->delete("carouselimg");//清除
            $session->set("carouselimg",$carouselimg->Url);//将现役的url保存到session里

            /* 将轮播图对象的页面id排在第一 */
            foreach ($buffers as $buffer){
                if($carouselimg->PageId == $buffer->pageId){
                    $pageList[count($pageList)] = $buffer;
                    break;
                }
            }
            /* 添加上后续的 */
            foreach ($buffers as $buffer){
                if($carouselimg->PageId != $buffer->pageId){
                    $pageList[count($pageList)] = $buffer;
                }
            }

            $this->assign([
                "form"=>"modifyCarouselimg",
                "pageNameList"=>$pageList,
                "carouselimg"=>$carouselimg,
                "img"=>"src='static\\carouselimg\\".$carouselimg->Url."''"
            ]);
            return $this->fetch("Carouselimg/addcarouselimg");
        }

        /* 修改轮播图的方法 */
        function modifyCarouselimg(){
            $sql = new module\carouselimg();
            $session = new Session();
            $session->set("alertFlag",0);
            /* 如果为空则不允许提交 */
            if($session->get("carouselimg")==null){
                $session->set("alert","请上传轮播图后再提交");
            }else{
                /* 获取数据 */
                $Url = $session->get("carouselimg");
                $session->delete("carouselimg");
                $Link = input("Link");
                $Id = input("id");
                $PageId = $this->request->param("PageId");
                $page = new module\carouselimgpage();
                $buffer = $page->getPageById($PageId);
                $PageName = $buffer->pageName;
                /* 开始保存 */
                if($sql->modifyCarouselimg($Id,$PageId,$PageName,$Url,$Link)>0){
                    $session->set("alert","修改成功");
                }else{
                    $session->set("alert","修改失败");
                }
            }
            $login = new Login();
            return $login->adminIndex();
        }

        /* 用于删除轮播图的方法 */
        function deleteCarouselimg(){
            $sql = new module\carouselimg();
            $buffer = $sql->getCarouselImgById(input("id"));
            unlink(ROOT_PATH."public\\static\\carouselimg\\".$buffer->Url);//删除掉服务器上的图片
            if($sql->deleteCarouselImgById(input("id"))>0){
                return 1;
            }else{
                return -1;
            }
        }

        /* 用于接收轮播图片 */
        function getCarouselimg(){
            $file = request()->file("file");
            $info = $file->move(ROOT_PATH . 'public' . DS . 'static' . DS . 'carouselimg');//下载到pulic/static/carouselimg目录
            if($info){
                $session = new Session();
                /* 删除已经存上传在服务器待命的二维码 */
                if($session->get("carouselimg")!=null){
//                    unlink(ROOT_PATH."public\\static\\carouselimg\\".$session->get("carouselimg"));
                    $session->delete("carouselimg");
                }
                $session->set("carouselimg",$info->getSaveName());
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