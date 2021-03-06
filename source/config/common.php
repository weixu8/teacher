<?php
!defined('IN_APP') && exit('ILLEGAL EXECUTION'); // in fact, even if this is exucted by user, would it show anything?
/**
 * @file    common
 * @author  ryan <cumt.xiaochi@gmail.com>
 * @created Jun 30, 2012 10:38:22 AM
 */

define('PRD', 0);
define('DEBUG', 1);

if (isset($_SERVER['HTTP_APPNAME'])) { // on sae
    define('ON_SAE', TRUE);
    define('UP_DOMAIN', 'xxx');
} else {
    define('ON_SAE', FALSE);
}

define('ROOT', '/');

define('DEFAULT_LOGIN_REDIRECT_URL', ROOT); // 登录后的默认导向页面

$config['urls'] = array(
    '/' => 'index',
    '/register' => 'register',
    '/login' => 'login',
    '/logout' => 'logout',
    '/search' => 'search',
    '/teacher/add' => 'add_teacher',
    '/teacher/(.+)/change_photo' => 'photo',
    '/teacher/(.+)/edit' => 'edit_teacher',
    '/teacher/(.+)/comment/(.+)/add' => 'comment_add',
    '/teacher/(.+)/comment/(.+)' => 'comment',
    '/teacher/(.+)' => 'teacher',
    '/teacher/' => 'teachers',
    '/comment/(.+)/discuss' => 'discuss_comment',
    '/comment/(.+)/(.+)' => 'comment_action',
    '/course/add' => 'add_course',
    '/course/(.+)' => 'course',
    '/attitude/(.+)' => 'attitude',
    '/my' => 'my',
    '/user/(.+)' => 'user');

// pages need login
$config['login_page'] = array();

$config['admin_page'] = array();

$config['db'] = array(
    'host' => 'localhost',
    'dbname' => 'xcteacher',
    'username' => 'root',
    'password' => 'root'
);

if (PRD) {
    $config['db'] = array(
        'host' => 'localhost',
        'dbname' => 'cpjewenmond',
        'username' => 'jeweng_dbu',
        'password' => 'rty2fADYYL7r8mZK'
    );
}

if (ON_SAE) {
    // 会覆盖之前的配置
    $config['db'] = array(
        'master' => array('host' => SAE_MYSQL_HOST_M),
        'slave'  => array('host' => SAE_MYSQL_HOST_S),
        'port'   => SAE_MYSQL_PORT,
        'dbname' => SAE_MYSQL_DB,
        'username' => SAE_MYSQL_USER,
        'password' => SAE_MYSQL_PASS
    );
}

if (ON_SAE || PRD) {
    include 'server.php';
} else {
    define('JS_VER',  time());
    define('CSS_VER', time());
}

// 数据库名
define('cart_product', 'cart_product');
define('customer_address', 'customer_address');

include 'content.php';
