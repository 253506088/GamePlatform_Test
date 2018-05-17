<?php
    /**
     * 负责设置网站信息的类
     * 2018年2月28日10:15:17
     * 贺东泽X黑白大彩电
     * */
    namespace app\admin\controller;
    use think\Controller;
    use think\Session;
    use app\admin\module;
    class SetWeb extends Controller{
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

        /* 设置网站信息的页面 */
        function SetWebPage(){
            $sql = new module\webinfo();
            $webinfo = $sql->getWebInfo();
            $session = new Session();
            $session->delete("QRCode");
            $session->set("QRCode",$webinfo->weiXinUrl);//将现役的二维码url保存到session
            $img = "";
            $logo = "";
            if($webinfo->weiXinUrl!=""){
                $img = "src=static/QRCode/".$webinfo->weiXinUrl;
            }
            if($webinfo->logo!=""){
                $logo = "src=static/logo/".$webinfo->logo;
            }
            $this->assign([
                'web'=>$webinfo,
                'img'=>$img,
                'logo'=>$logo
            ]);
            return $this->fetch("SetWeb/SetWebPage");
        }

        /* 设置网站信息 */
        function SetWeb(){
            $session = new Session();
            $sql = new module\webinfo();
            $flag = $sql->setWebInfo(
                input("id"), input("indexName"), input("gameName"), input("newsName"),
                input("aboutAsName"), input("joinUsName"), $session->get("QRCode"), input("weiBoLink"),
                input("address"), input("contactInfo"), input("copyright"), input("recordNum"),$session->get("logo")
            );
            $session->set("alertFlag",0);
            if($flag){
                $session->set("alert","保存成功");
            }else{
                $session->set("alert","保存失败");
            }
            $login = new Login();
            return $login->adminIndex();
        }

        /* 用于接收logo */
        function getLogo(){
            $file = request()->file("file");
            $info = $file->move(ROOT_PATH . 'public' . DS . 'static' . DS . 'logo');//下载到pulic/static/logo目录
            if($info){
                $session = new Session();
                /* 删除已经存上传在服务器待命的二维码 */
                if($session->get("getLogo")!=null){
                    unlink(ROOT_PATH."public\\static\\logo\\".$session->get("logo"));
                    $session->delete("logo");
                }
                $session->set("logo",$info->getSaveName());
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

        /* 用于接收二维码图片 */
        function getQRCode(){
            $file = request()->file("file");
            $info = $file->move(ROOT_PATH . 'public' . DS . 'static' . DS . 'QRCode');//下载到pulic/static/QRCode目录
            if($info){
                $session = new Session();
                /* 删除已经存上传在服务器待命的二维码 */
                if($session->get("QRCode")!=null){
                    unlink(ROOT_PATH."public\\static\\QRCode\\".$session->get("QRCode"));
                    $session->delete("QRCode");
                }
                $session->set("QRCode",$info->getSaveName());
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