<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

return [
    'test'=>'index/index/test',
    'testPage'=>'index/index/testPage',
    'index'=>'index/index/index',
    'Game'=>'index/index/Game',
    'news'=>'index/index/news',
    'newsPage'=>'index/index/newsPage',
    'aboutAsPage'=>'index/index/aboutAsPage',
    'joinUs'=>'index/index/joinUs',
    /***************************************/
    'admin'=>'admin/Login/LoginPage',
    'Login'=>'admin/Login/Login',
    'adminIndex'=>'admin/Login/adminIndex',
    'logout'=>'admin/Login/logout',
    /**************************************/
    'SetWebPage'=>'admin/SetWeb/SetWebPage',
    'getQRCode'=>'admin/SetWeb/getQRCode',
    'SetWeb'=>'admin/SetWeb/SetWeb',
    'getLogo'=>'admin/SetWeb/getLogo',
    /**************************************/
    'addCarouselimgPage'=>'admin/Carouselimg/addCarouselimgPage',
    'setCarouselimg'=>'admin/Carouselimg/setCarouselimg',
    'getCurrent'=>'admin/Carouselimg/getCurrent',
    'pageData'=>'admin/Carouselimg/pageData',
    'getCarouselimg'=>'admin/Carouselimg/getCarouselimg',
    'setCarouselimgPage'=>'admin/Carouselimg/setCarouselimgPage',
    'modifyCarouselimgPage'=>'admin/Carouselimg/modifyCarouselimgPage',
    'modifyCarouselimg'=>'admin/Carouselimg/modifyCarouselimg',
    'deleteCarouselimg'=>'admin/Carouselimg/deleteCarouselimg',
    /**************************************/
    'addGamePage'=>'admin/Game/addGamePage',
    'addGame'=>'admin/Game/addGame',
    'getGameImg'=>'admin/Game/getGameImg',
    'setGamePage'=>'admin/Game/setGamePage',
    'dataTable'=>'admin/Game/dataTable',
    'deleteGame'=>'admin/Game/deleteGame',
    'modifyGamePage'=>'admin/Game/modifyGamePage',
    'modifyGame'=>'admin/Game/modifyGame',
    /*************************************/
    'addNewsPage'=>'admin/News/addNewsPage',
    'addNews'=>'admin/News/addNews',
    'setNewsPage'=>'admin/News/setNewsPage',
    'setNews'=>'admin/News/setNews',
    'getNewsImg'=>'admin/News/getNewsImg',
    'getTextImg'=>'admin/News/getNewsImg',
    'newsDataTable'=>'admin/News/newsDataTable',
    'modifyNewsPage'=>'admin/News/modifyNewsPage',
    'deleteNews'=>'admin/News/deleteNews',
    /************************************/
    'setAboutAsPage'=>'admin/AboutAs/setAboutAsPage',
    'setAboutAs'=>'admin/AboutAs/setAboutAs',
    'getAboutAsImg'=>'admin/AboutAs/getAboutAsImg',
    /************************************/
    'addJoinUsPage'=>'admin/JoinUs/addJoinUsPage',
    'addJoinUs'=>'admin/JoinUs/addJoinUs',
    'setJoinUsPage'=>'admin/JoinUs/setJoinUsPage',
    'setJoinUs'=>'admin/JoinUs/setJoinUs',
    'joniUsDataTable'=>'admin/JoinUs/joniUsDataTable',
    'deleteJoinUs'=>'admin/JoinUs/deleteJoinUs',
    'modifyJoinUsPage'=>'admin/JoinUs/modifyJoinUsPage',
    /************************************/
    '__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],
];
