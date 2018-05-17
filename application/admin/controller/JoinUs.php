<?php
    /**
     * 负责【加入我们】的后台
     * User: 贺东泽X黑白大彩电
     * Date: 2018/3/2
     * Time: 14:07
     */
    namespace app\admin\controller;
    use think\Controller;
    use app\admin\module;
    use think\Session;
    class JoinUs extends Controller
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

        /* 新增招聘信息的页面 */
        public function addJoinUsPage(){
            $this->assign([
                "form"=>"addJoinUs"
            ]);
            return $this->fetch("joinus/addJoinUs");
        }

        /* 新增招聘信息的处理方法 */
        public function addJoinUs(){
            $session = new Session();
            $sql = new module\joinus();
            $Position = input("Position");
            $Department = input("Department");
            $Nature = input("Nature");
            $Number = input("Number");
            $Link = input("Link");
            $Salary = input("Salary");
            $buffer = $sql->addJoinUs($Position, $Department, $Nature, $Number, $Link, $Salary);
            $session->set("alertFlag",0);
            if($buffer){
                $session->set("alert","添加成功");
            }else{
                $session->set("alert","添加失败");
            }
            $login = new Login();
            return $login->adminIndex();
        }

        /* 管理招聘信息的页面 */
        public function setJoinUsPage(){
            return $this->fetch("joinus/setJoinUs");
        }

        /* 数据表格提供招聘信息 */
        public function joniUsDataTable(){
            $page = input("page");//获取当前页
            $listLen = input("limit");//获取每页显示的数据量
            $sql = new module\joinus();
            $form = 0;
            /* 如果当前页不是第一页那么计算form的值 */
            if($page>1){
                $form = ($page-1)*$listLen;
            }

            $array = [
                "code"=>0 //0表示成功，其它失败
                ,"msg"=> $page."页" //提示信息 //一般上传失败后返回
                ,'count'=> count($sql->getAllJoinUs()) //总数据量
                ,"data"=>  $sql->limit($form,$form+$listLen)->select()//本页要显示的数据
            ];
            return json($array);
        }

        /* 修改招聘信息的页面 */
        public function modifyJoinUsPage(){
            $sql = new module\joinus();
            $this->assign([
                "form"=>"setJoinUs",
                "joinus"=>$sql->getJoinUsById(input("id"))
            ]);
            return $this->fetch("joinus/addJoinUs");
        }

        /* 修改招聘信息的方法 */
        public function setJoinUs(){
            $session = new Session();
            $sql = new module\joinus();
            $Id = input("id");
            $Position = input("Position");
            $Department = input("Department");
            $Nature = input("Nature");
            $Number = input("Number");
            $Link = input("Link");
            $Salary = input("Salary");
            $buffer = $sql->setJoinUs($Id,$Position, $Department, $Nature, $Number, $Link, $Salary);
            $session->set("alertFlag",0);
            if($buffer>0){
                $session->set("alert","修改成功");
            }else{
                $session->set("alert","修改失败");
            }
            $login = new Login();
            return $login->adminIndex();
        }

        /* 删除招聘信息的方法 */
        public function deleteJoinUs(){
            $sql = new module\joinus();
            if($sql->deleteJoinUs(input("id"))>0){
                return 1;//成功
            }else{
                return -1;//失败
            }
        }
    }
?>