
<?php
return array(
  //'配置项'=>'配置值'
  // 'APP_GROUP_LIST' => 'Index,Admin', 
  // 'DEFAULT_GROUP' => 'Index', 
  // 'APP_GROUP_MODE' => '1', 
  // 'APP_GROUP_PATH' => 'Modules', 
  // 模板文件后缀名
   'TMPL_TEMPLATE_SUFFIX' => '.html',
  // 'TMPL_ENGINE_TYPE'=>'Smarty',
  // 'TMPL_ENGINE_CONFIG'=>array(
  //   'caching'=>TRUE,
  //   'template_dir'=>TMPL_PATH,
  //   'compile_dir'=>TEMP_PATH,
  //   'cache_dir'=>CACHE_PATH,
  //   'left_delimiter'=>'{',
  //   'right_delimiter'=>'}',
  //   ),
  'URL_CASE_INSENSITIVE' =>true,
  'TMPL_PARSE_STRING' => array(
    '__PUBLIC__'=>__ROOT__.'/'.APP_NAME.'/Admin/'.'Public'
    ),
  'DB_TYPE'   => 'mysql', // 数据库类型
        'DB_HOST'   => 'localhost', // 服务器地址
        'DB_NAME'   => 'think', // 数据库名
        'DB_USER'   => 'root', // 用户名
        'DB_PWD'    => '135799', // 密码
        'DB_PORT'   => 3306, // 端口
        'DB_PREFIX' => 'sw_', // 数据库表前缀 
        'DB_PORT' => '3306',
        'DB_FIELDS_CACHE'=>false,
        'DB_CHARSET'=>'utf8'
);
?>