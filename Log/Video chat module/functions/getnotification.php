<?php
include_once '../classes/config.php';

if(isset($_POST['user_id']))
{
    $id =  $_POST['user_id'];
    $conn = new Database();
    $result = $conn->getNotification($id);
    echo $result;
}
?>