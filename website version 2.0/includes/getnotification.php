<?php
include_once 'config.php';

if(isset($_POST['user_id_']))
{
    $id =  $_POST['user_id_'];
    $conn = new Database();
    $result = $conn->getNotification($id);
    echo $result;
}
?>