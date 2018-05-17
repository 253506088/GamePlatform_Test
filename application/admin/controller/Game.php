<?php
    /**
     * 用于进行游戏页面的后台操作类
     * User: 贺东泽
     * Date: 2018/3/1
     * Time: 10：25
     */
    namespace app\admin\controller;
    use think\Controller;
    use app\admin\module;
    use think\Session;
    class Game extends Controller
    {
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

        /* 新增游戏的页面 */
        function addGamePage(){
            $session = new Session();
            /* 删除已经上传在服务器里待命的图片和url */
            if($session->get("game")!=null){
//                unlink(ROOT_PATH."public\\static\\game\\".$session->get("game"));
                $session->delete("game");
            }
            $this->assign([
                "form" =>"addGame",
            ]);
            return $this->fetch("game/addGame");
        }

        /* 新增游戏的处理方法 */
        function addGame(){
            $sql = new module\game();
            $session = new Session();
            $session->set("alertFlag",0);
            /* 如果为空则不允许提交 */
            if($session->get("game")==null){
                $session->set("alert","请上传图片后再提交");
            }else{
                /* 获取数据 */
                $Name = input("Name");
                $Describe = input("Describe");
                $Url = $session->get("game");
                $session->delete("game");
                $Link = input("Link");

                /* 开始保存 */
                if($sql->addGame($Name,$Describe,$Link,$Url)){
                    $session->set("alert","保存成功");
                }else{
                    $session->set("alert","保存失败");
                }
            }
            $login = new Login();
            return $login->adminIndex();
        }

        /* 管理游戏信息的页面 */
        function setGamePage(){
            return $this->fetch("game/setGame");
        }

        /* 为数据表提供数据的方法 */
        function dataTable(){
            $page = input("page");//获取当前页
            $listLen = input("limit");//获取每页显示的数据量
            $sql = new module\game();
            $form = 0;
            /* 如果当前页不是第一页那么计算form的值 */
            if($page>1){
                $form = ($page-1)*$listLen;
            }
            $buffers = $sql->limit($form,$form+$listLen)->select();
            $dataList = array();
            foreach($buffers as $buffer){
                $img = "<img src='static/game/".$buffer->Url."'>";
                $buffer->Img = $img;
                $dataList[count($dataList)] = $buffer;
            }
            $array = [
                "code"=>0 //0表示成功，其它失败
                ,"msg"=> $page."页" //提示信息 //一般上传失败后返回
                ,'count'=> count($sql->getAllGame()) //总数据量
                ,"data"=>  $dataList//本页要显示的数据
            ];
            return json($array);
        }

        /* 删除游戏信息的方法 */
        function deleteGame(){
            $sql = new module\game();
            if($sql->deleteGameById(input("id"))>0){
                return 1;//成功为1
            }else{
                return -1;//失败为-1
            }
        }

        /* 修改游戏信息的页面 */
        function modifyGamePage(){
            $session = new Session();
            $sql = new module\game();
            /* 删除已经上传在服务器里待命的图片和url */
            if($session->get("game")!=null){
//                unlink(ROOT_PATH."public\\static\\game\\".$session->get("game"));
                $session->delete("game");
            }
            $session->delete("setGame");
            $game = $sql->getGameById(input("id"));
            $session->set("setGame",$game->Url);//将现役信息图片url保存到session里
            $this->assign([
                "form" =>"modifyGame",
                "game"=>$game,
                "img"=>"src='static/game/".$game->Url."'"
            ]);
            return $this->fetch("game/addGame");
        }

        /* 修改游戏信息的方法 */
        function modifyGame(){
            $sql = new module\game();
            $session = new Session();
            $session->set("alertFlag",0);
            $Url = "";
            if($session->get("game")==null){
                /* 如果为空说明图片没有修改，则取出现役图片url */
                $Url = $session->get("setGame");
                $session->delete("setGame");
            }else{
                /* 不为空说明有修改 */
                $Url = $session->get("game");
                $session->delete("game");
//                unlink(ROOT_PATH."public\\static\\game\\".$session->get("setGame"));
            }
            $session->delete("setGame");
            /* 获取数据 */
            $Id = input("id");
            $Name = input("Name");
            $Describe = input("Describe");
            $Link = input("Link");

            /* 开始保存 */
            if($sql->setGame($Id,$Name,$Describe,$Link,$Url)>0){
                $session->set("alert","修改成功");
            }else{
                $session->set("alert","修改失败");
            }

            $login = new Login();
            return $login->adminIndex();
        }

        /* 用于接信息的图片 */
        function getGameImg(){
            $file = request()->file("file");
            $info = $file->move(ROOT_PATH . 'public' . DS . 'static' . DS . 'game');//下载到pulic/static/game目录
            if($info){
                $session = new Session();
                /* 删除已经存上传在服务器待命的图片 */
                if($session->get("game")!=null){
                    unlink(ROOT_PATH."public\\static\\game\\".$session->get("game"));
                    $session->delete("game");
                }
                $session->set("game",$info->getSaveName());
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