/*
SQLyog Ultimate v12.4.1 (64 bit)
MySQL - 5.5.53 : Database - myweb
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`myweb` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `myweb`;

/*Table structure for table `aboutas` */

DROP TABLE IF EXISTS `aboutas`;

CREATE TABLE `aboutas` (
  `Id` varchar(150) NOT NULL COMMENT '象征性的添加一个主键',
  `ImgUrl` varchar(150) DEFAULT NULL COMMENT '关于我们的图片url',
  `Content` text COMMENT '关于我们的信息内容',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='【关于我们】的信息表';

/*Data for the table `aboutas` */

insert  into `aboutas`(`Id`,`ImgUrl`,`Content`) values 
('aboutas','20180302\\accd33088cec0e599cff03923679bd60.jpg','<p>明天就去学校了明天就去学校了明天就去学校了明天就去学校了明天就去学校了明天就去学校了明天就去学校了明天就去学校了明天就去学校了明天就去学校了明天就去学校了明天就去学校了明天就去学校了明天就去学校了明天就去学校了明天就去学校了明天就去学校了明天就去学校了明天就去学校了明天就去学校了明天就去学校了明天就去学校了明天就去学校了明天就去学校了明天就去学校了明天就去学校了明天就去学校了明天就去学校了明天就去学校了明天就去学校了明天就去学校了明天就去学校了明天就去学校了明天就去学校了明天就去学校了明天就去学校了明天就去学校了明天就去学校了明天就去学校了明天就去学校了明天就去学校了明天就去学校了明天就去学校了明天就去学校了明天就去学校了明天就去学校了明天就去学校了明天就去学校了明天就去学校了明天就去学校了明天就去学校了明天就去学校了明天就去学校了明天就去学校了明天就去学校了明天就去学校了</p><!--服务器端获取富文本框的编辑内容通过本标签的name就能获取，即name=\"content\"的标签--><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p><!--服务器端获取富文本框的编辑内容通过本标签的name就能获取，即name=\"content\"的标签--><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p><!--服务器端获取富文本框的编辑内容通过本标签的name就能获取，即name=\"content\"的标签--><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p><!--服务器端获取富文本框的编辑内容通过本标签的name就能获取，即name=\"content\"的标签-->');

/*Table structure for table `carouselimg` */

DROP TABLE IF EXISTS `carouselimg`;

CREATE TABLE `carouselimg` (
  `Id` int(11) NOT NULL AUTO_INCREMENT COMMENT '轮播图id',
  `PageId` varchar(50) DEFAULT NULL COMMENT '哪个页面的轮播图',
  `Url` varchar(150) DEFAULT NULL COMMENT '图片url',
  `PageName` varchar(150) DEFAULT NULL COMMENT '页面名称',
  `Link` varchar(150) DEFAULT NULL COMMENT '点击图片后跳转到的链接',
  PRIMARY KEY (`Id`),
  KEY `pageid` (`PageId`),
  CONSTRAINT `pageid` FOREIGN KEY (`PageId`) REFERENCES `carouselimgpage` (`pageId`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='轮播图的数据表';

/*Data for the table `carouselimg` */

insert  into `carouselimg`(`Id`,`PageId`,`Url`,`PageName`,`Link`) values 
(1,'aboutAs','20180302\\d02057a6075732b8a0ca61b37b96e3d9.jpg','关于我们','https://www.baidu.com/'),
(2,'aboutAs','20180302\\ba5a8d2530f1f6621f3cf5a5cc6b69aa.jpg','关于我们','https://www.baidu.com/'),
(3,'game','20180302\\3b7ac947156ef1d5e4f2251065ffd3d5.jpg','游戏页','https://www.baidu.com/'),
(4,'game','20180302\\e5a4b07bb5a33400cfd6218ba18d12ea.jpg','游戏页','https://www.baidu.com/'),
(5,'index','20180302\\691beec86ed74763e07a0f48f3c1f21f.jpg','首页','https://www.baidu.com/'),
(6,'index','20180302\\9c5fe37929771d510d3e2b27573b63ac.jpg','首页','https://www.baidu.com/'),
(7,'joinUs','20180302\\298fcece50f36d6fe398267531629b18.jpg','加入我们','https://www.baidu.com/'),
(8,'joinUs','20180302\\a2dd632cfd39294d397d182f9716aac2.jpg','加入我们','https://www.baidu.com/'),
(9,'news','20180302\\b4a70ebda47eae6713d3e44efeda1f36.jpg','新闻页','https://www.baidu.com/'),
(10,'news','20180302\\e4038d17ba053d0740a036aa56d57dcc.jpg','新闻页','https://www.baidu.com/');

/*Table structure for table `carouselimgpage` */

DROP TABLE IF EXISTS `carouselimgpage`;

CREATE TABLE `carouselimgpage` (
  `pageId` varchar(50) NOT NULL COMMENT '需要设置轮播图的页面id',
  `pageName` varchar(150) NOT NULL COMMENT '需要设置轮播图的页面名称',
  PRIMARY KEY (`pageId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='保存需要设置轮播图的页面id和名称';

/*Data for the table `carouselimgpage` */

insert  into `carouselimgpage`(`pageId`,`pageName`) values 
('aboutAs','关于我们'),
('game','游戏页'),
('index','首页'),
('joinUs','加入我们'),
('news','新闻页');

/*Table structure for table `game` */

DROP TABLE IF EXISTS `game`;

CREATE TABLE `game` (
  `Id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `Name` varchar(150) DEFAULT NULL COMMENT '名称',
  `Describe` text COMMENT '描述',
  `Link` varchar(150) DEFAULT NULL COMMENT '点击后跳转的链接',
  `Url` varchar(150) DEFAULT NULL COMMENT '图片的url',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `game` */

/*Table structure for table `joinus` */

DROP TABLE IF EXISTS `joinus`;

CREATE TABLE `joinus` (
  `Id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `Position` varchar(150) DEFAULT NULL COMMENT '职位名称',
  `Department` varbinary(150) DEFAULT NULL COMMENT '所属部门',
  `Nature` varchar(150) DEFAULT NULL COMMENT '工作性质',
  `Number` varchar(150) DEFAULT NULL COMMENT '需要数量',
  `Time` varchar(150) DEFAULT NULL COMMENT '发布日期',
  `Link` varchar(150) DEFAULT NULL COMMENT '跳转链接',
  `Salary` varchar(150) DEFAULT NULL COMMENT '工资',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

/*Data for the table `joinus` */

insert  into `joinus`(`Id`,`Position`,`Department`,`Nature`,`Number`,`Time`,`Link`,`Salary`) values 
(2,'数据库架构师','秃头组','维护/设计数据库架构','3人','2018-03-02','https://www.baidu.com/','工资面议'),
(3,'数据库架构师','秃头组','维护/设计数据库架构','3人','2018-03-02','https://www.baidu.com/','工资面议'),
(4,'数据库架构师','秃头组','维护/设计数据库架构','3人','2018-03-02','https://www.baidu.com/','工资面议'),
(5,'数据库架构师','秃头组','维护/设计数据库架构','3人','2018-03-02','https://www.baidu.com/','工资面议'),
(6,'数据库架构师','秃头组','维护/设计数据库架构','3人','2018-03-02','https://www.baidu.com/','工资面议'),
(7,'数据库架构师','秃头组','维护/设计数据库架构','3人','2018-03-02','https://www.baidu.com/','工资面议'),
(8,'数据库架构师','秃头组','维护/设计数据库架构','3人','2018-03-02','https://www.baidu.com/','工资面议'),
(9,'数据库架构师','秃头组','维护/设计数据库架构','3人','2018-03-02','https://www.baidu.com/','工资面议'),
(10,'数据库架构师','秃头组','维护/设计数据库架构','3人','2018-03-02','https://www.baidu.com/','工资面议'),
(11,'数据库架构师','秃头组','维护/设计数据库架构','3人','2018-03-02','https://www.baidu.com/','工资面议'),
(12,'数据库架构师','秃头组','维护/设计数据库架构','3人','2018-03-02','https://www.baidu.com/','工资面议'),
(13,'数据库架构师','秃头组','维护/设计数据库架构','3人','2018-03-02','https://www.baidu.com/','工资面议'),
(14,'数据库架构师','秃头组','维护/设计数据库架构','3人','2018-03-02','https://www.baidu.com/','工资面议'),
(15,'数据库架构师','秃头组','维护/设计数据库架构','3人','2018-03-02','https://www.baidu.com/','工资面议'),
(16,'数据库架构师','秃头组','维护/设计数据库架构','3人','2018-03-02','https://www.baidu.com/','工资面议'),
(17,'数据库架构师','秃头组','维护/设计数据库架构','3人','2018-03-02','https://www.baidu.com/','工资面议'),
(18,'数据库架构师','秃头组','维护/设计数据库架构','3人','2018-03-02','https://www.baidu.com/','工资面议'),
(19,'数据库架构师','秃头组','维护/设计数据库架构','3人','2018-03-02','https://www.baidu.com/','工资面议'),
(20,'数据库架构师','秃头组','维护/设计数据库架构','3人','2018-03-02','https://www.baidu.com/','工资面议'),
(21,'数据库架构师','秃头组','维护/设计数据库架构','3人','2018-03-02','https://www.baidu.com/','工资面议'),
(22,'数据库架构师','秃头组','维护/设计数据库架构','3人','2018-03-02','https://www.baidu.com/','工资面议'),
(23,'数据库架构师','秃头组','维护/设计数据库架构','3人','2018-03-02','https://www.baidu.com/','工资面议'),
(24,'数据库架构师','秃头组','维护/设计数据库架构','3人','2018-03-02','https://www.baidu.com/','工资面议'),
(25,'数据库架构师','秃头组','维护/设计数据库架构','3人','2018-03-02','https://www.baidu.com/','工资面议'),
(26,'数据库架构师','秃头组','维护/设计数据库架构','3人','2018-03-02','https://www.baidu.com/','工资面议'),
(27,'数据库架构师','秃头组','维护/设计数据库架构','3人','2018-03-02','https://www.baidu.com/','工资面议'),
(28,'数据库架构师','秃头组','维护/设计数据库架构','3人','2018-03-02','https://www.baidu.com/','工资面议'),
(29,'数据库架构师','秃头组','维护/设计数据库架构','3人','2018-03-02','https://www.baidu.com/','工资面议'),
(30,'数据库架构师','秃头组','维护/设计数据库架构','3人','2018-03-02','https://www.baidu.com/','工资面议'),
(31,'数据库架构师','秃头组','维护/设计数据库架构','3人','2018-03-02','https://www.baidu.com/','工资面议');

/*Table structure for table `news` */

DROP TABLE IF EXISTS `news`;

CREATE TABLE `news` (
  `Id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `Name` varchar(150) DEFAULT NULL COMMENT '新闻名称',
  `Content` text COMMENT '新闻内容',
  `ImgUrl` varchar(150) DEFAULT NULL COMMENT '新闻封面图片',
  `Time` varchar(100) DEFAULT NULL COMMENT '新闻提交时间',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `news` */

insert  into `news`(`Id`,`Name`,`Content`,`ImgUrl`,`Time`) values 
(2,'请选输入本条新闻的名称','<span style=\"font-family: &quot;Helvetica Neue&quot;, Helvetica, &quot;PingFang SC&quot;, 微软雅黑, Tahoma, Arial, sans-serif; font-size: 20px;\">请选输入本条新闻的名称</span><span style=\"font-family: &quot;Helvetica Neue&quot;, Helvetica, &quot;PingFang SC&quot;, 微软雅黑, Tahoma, Arial, sans-serif; font-size: 20px;\">请选输入本条新闻的名称</span><span style=\"font-family: &quot;Helvetica Neue&quot;, Helvetica, &quot;PingFang SC&quot;, 微软雅黑, Tahoma, Arial, sans-serif; font-size: 20px;\">请选输入本条新闻的名称</span><span style=\"font-family: &quot;Helvetica Neue&quot;, Helvetica, &quot;PingFang SC&quot;, 微软雅黑, Tahoma, Arial, sans-serif; font-size: 20px;\">请选输入本条新闻的名称</span><span style=\"font-family: &quot;Helvetica Neue&quot;, Helvetica, &quot;PingFang SC&quot;, 微软雅黑, Tahoma, Arial, sans-serif; font-size: 20px;\">请选输入本条新闻的名称</span><span style=\"font-family: &quot;Helvetica Neue&quot;, Helvetica, &quot;PingFang SC&quot;, 微软雅黑, Tahoma, Arial, sans-serif; font-size: 20px;\">请选输入本条新闻的名称</span><span style=\"font-family: &quot;Helvetica Neue&quot;, Helvetica, &quot;PingFang SC&quot;, 微软雅黑, Tahoma, Arial, sans-serif; font-size: 20px;\">请选输入本条新闻的名称</span><span style=\"font-family: &quot;Helvetica Neue&quot;, Helvetica, &quot;PingFang SC&quot;, 微软雅黑, Tahoma, Arial, sans-serif; font-size: 20px;\">请选输入本条新闻的名称</span><span style=\"font-family: &quot;Helvetica Neue&quot;, Helvetica, &quot;PingFang SC&quot;, 微软雅黑, Tahoma, Arial, sans-serif; font-size: 20px;\">请选输入本条新闻的名称</span><span style=\"font-family: &quot;Helvetica Neue&quot;, Helvetica, &quot;PingFang SC&quot;, 微软雅黑, Tahoma, Arial, sans-serif; font-size: 20px;\">请选输入本条新闻的名称</span><span style=\"font-family: &quot;Helvetica Neue&quot;, Helvetica, &quot;PingFang SC&quot;, 微软雅黑, Tahoma, Arial, sans-serif; font-size: 20px;\">请选输入本条新闻的名称</span><span style=\"font-family: &quot;Helvetica Neue&quot;, Helvetica, &quot;PingFang SC&quot;, 微软雅黑, Tahoma, Arial, sans-serif; font-size: 20px;\">请选输入本条新闻的名称</span><span style=\"font-family: &quot;Helvetica Neue&quot;, Helvetica, &quot;PingFang SC&quot;, 微软雅黑, Tahoma, Arial, sans-serif; font-size: 20px;\">请选输入本条新闻的名称</span><span style=\"font-family: &quot;Helvetica Neue&quot;, Helvetica, &quot;PingFang SC&quot;, 微软雅黑, Tahoma, Arial, sans-serif; font-size: 20px;\">请选输入本条新闻的名称</span><span style=\"font-family: &quot;Helvetica Neue&quot;, Helvetica, &quot;PingFang SC&quot;, 微软雅黑, Tahoma, Arial, sans-serif; font-size: 20px;\">请选输入本条新闻的名称</span>','20180302\\966be9c3fb8dcda10ef359ba97423493.jpg','2018-03-02'),
(3,'emmm中午不知道吃什么','真的是不知道吃什么啊！！！！真的是不知道吃什么啊！！！！真的是不知道吃什么啊！！！！真的是不知道吃什么啊！！！！真的是不知道吃什么啊！！！！真的是不知道吃什么啊！！！！真的是不知道吃什么啊！！！！真的是不知道吃什么啊！！！！真的是不知道吃什么啊！！！！真的是不知道吃什么啊！！！！真的是不知道吃什么啊！！！！真的是不知道吃什么啊！！！！真的是不知道吃什么啊！！！！真的是不知道吃什么啊！！！！真的是不知道吃什么啊！！！！','20180302\\f3a3c1fa62f16c9c3b8ef9c591ef1c26.jpg','2018-03-02'),
(4,'今天中午吃什么？','今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？','20180302\\87e547cd4345d781d32ec1eb17e3a49e.jpg','2018-03-02'),
(5,'今天中午吃什么？','<span style=\"font-family: 隶书, SimLi;\">今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？</span>','20180302\\8e29b32ee5b91b1207b1ef76262513fe.jpg','2018-03-02'),
(6,'今天中午吃什么？','今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？','20180302\\f2bd582d01c1964cc4cf7b319bfaf0e0.jpg','2018-03-02'),
(7,'今天中午吃什么？','今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？今天中午吃什么？','20180302\\e9068df62eeb0b39d01dc0a062a718fd.jpg','2018-03-02');

/*Table structure for table `rootuser` */

DROP TABLE IF EXISTS `rootuser`;

CREATE TABLE `rootuser` (
  `userName` varchar(60) NOT NULL COMMENT '管理员账号',
  `passWord` varchar(100) NOT NULL COMMENT '管理员密码MD5',
  PRIMARY KEY (`userName`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='后台管理员表';

/*Data for the table `rootuser` */

insert  into `rootuser`(`userName`,`passWord`) values 
('253506088','c77d80624830dcecb136b3a747b9593b'),
('admin','21232f297a57a5a743894a0e4a801fc3');

/*Table structure for table `webinfo` */

DROP TABLE IF EXISTS `webinfo`;

CREATE TABLE `webinfo` (
  `Id` int(11) NOT NULL AUTO_INCREMENT COMMENT '充当主键的id',
  `indexName` varchar(120) DEFAULT NULL COMMENT '首页名称',
  `gameName` varchar(120) DEFAULT NULL COMMENT '游戏中心名称',
  `newsName` varchar(120) DEFAULT NULL COMMENT '新闻中心名称',
  `aboutAsName` varchar(120) DEFAULT NULL COMMENT '关于我们名称',
  `joinUsName` varchar(120) DEFAULT NULL COMMENT '加入我们名称',
  `weiXinUrl` varchar(120) DEFAULT NULL COMMENT '微信二维码url',
  `weiBoLink` varchar(120) DEFAULT NULL COMMENT '微博链接',
  `address` varchar(120) DEFAULT NULL COMMENT '公司地址',
  `contactInfo` varchar(120) DEFAULT NULL COMMENT '联系方式',
  `copyright` varchar(120) DEFAULT NULL COMMENT '版权信息',
  `recordNum` varchar(120) DEFAULT NULL COMMENT '备案号',
  `logo` varchar(120) DEFAULT NULL COMMENT '网页logourl',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='保存网站信息的表';

/*Data for the table `webinfo` */

insert  into `webinfo`(`Id`,`indexName`,`gameName`,`newsName`,`aboutAsName`,`joinUsName`,`weiXinUrl`,`weiBoLink`,`address`,`contactInfo`,`copyright`,`recordNum`,`logo`) values 
(1,'首页','游戏中心','新闻中心','关于我们','加入我们','20180301\\99ce186df7469ecb94695f2e2d516774.jpg','https://www.baidu.com/','深圳市南山区科兴科学院A2-11XX','0755-00000000','CopyRight © 2017 All Right Reserved 深圳市龙猫版权所有','深圳市龙猫游戏设备17064573号','20180301\\f30c2fa4265d73210493d93783543b2a.png');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
