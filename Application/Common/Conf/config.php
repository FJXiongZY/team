<?php
return array(
	'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  'localhost', // 服务器地址
    'DB_NAME'               =>  'team',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  '',          // 密码
    'DB_PORT'               =>  '',        // 端口
    'DB_PREFIX'             =>  '',    // 数据库表前缀

    //配置静态页面的后缀
    'HTML_FILE_SUFFIX' => '.html',

    //Session配置
    'SESSION_TYPE'            => 'db',            //数据库存储session
    'SESSION_TABLE'            => 'starmoon_session',    //存session的表
    'SESSION_EXPIRE'        => 600,                //session过期时间
);