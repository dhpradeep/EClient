<?php
define('IN_APP', true);

include_once 'includes/config.php';

session_start();
$conn = new Database();
if(isset($_SESSION['user_id']))
{
$conn->make_offline($_SESSION['user_id']);
}
session_unset();
session_destroy();
header('Location: index.php');
?>