<?php
    /**
     * 负责【关于我们】的后台
     * User: 贺东泽X黑白大彩电
     * Date: 2018/3/1
     * Time: 16:34
     */
    namespace app\admin\controller;
    use think\Controller;
    use app\admin\module;
    use think\Session;
    class AboutAs extends Controller{
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

        /* 设置【关于我们】信息页面 */
        public function setAboutAsPage(){
            $sql = new module\aboutas();
            $aboutas = $sql->getAboutAs();
            $session = new Session();
            $session->delete("aboutas");
            $session->delete("setaboutas");
            $session->set("setaboutas",$aboutas->ImgUrl);//将现役的url保存到session里面
            $this->assign([
                'form'=>"setAboutAs",
                'aboutas'=>$aboutas,
                'img'=>"src='static/aboutas/".$aboutas->ImgUrl."'"
            ]);
            return $this->fetch("aboutas/setAboutAs");
        }

        /* 设置【关于我们】信息的处理方法 */
        public function setAboutAs(){
            $session = new Session();
            $session->set("alertFlag",0);
            $sql = new module\aboutas();
            if($sql->setAboutAs($session->get("aboutas"),input("content"))>0){
                $session->set("alert","修改成功");
            }else{
                $session->set("alert","修改失败");
            }
            $login = new Login();
            return $login->adminIndex();
        }

        /* 获取关于我们图片 */
        public function getAboutAsImg(){
            $file = request()->file("file");
            $info = $file->move(ROOT_PATH . 'public' . DS . 'static' . DS . 'aboutas');//下载到pulic/static/aboutas目录
            if($info){
                $session = new Session();
                /* 删除已经存上传在服务器待命的图片 */
                if($session->get("aboutas")!=null){
                    unlink(ROOT_PATH."public\\static\\aboutas\\".$session->get("aboutas"));
                    $session->delete("aboutas");
                }
                $session->set("aboutas",$info->getSaveName());
                $array = [
                    "code"=>0 //0表示成功，其它失败
                    ,"msg"=> $session->get("aboutas") //提示信息 //一般上传失败后返回
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