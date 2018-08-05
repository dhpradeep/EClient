<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!defined('IN_APP')) {
    header('Location: ../dashboard.php');
} 

$GLOBALS['config'] = array(
    'mysql' => array(
        'host' => '127.0.0.1',
        'username' => 'root',
        'password' => '',
        'db' => 'eclient'
    ),
    'remember' => array(
        'cookie_name' => 'hash',
        'cookie_expiry' => 604800 #1 week cookie time
    ),
    'sessions' => array(
        'session_name' => 'user',
        'token_name' => 'token'
    )
);

# spl => standard php library
spl_autoload_register(function($class) {
    require_once 'classes/' . $class . '.php';
});

require_once 'functions/sanitize.php';

if(Cookie::exists(Config::get('remember/cookie_name')) && !Session::exists(Config::get('sessions/session_name'))) {
    $hash = Cookie::get(Config::get('remember/cookie_name'));
    $hashCheck = DB::getInstance()->get('users_session', array('hash', '=', $hash));

    if($hashCheck->count()) {
        $user = new User($hashCheck->first()->user_id);
        $user->login();
    }
}