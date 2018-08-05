<?php include_once 'config.php' ?>
<?php include_once 'generate.php'; ?>

<?php

session_start();

if(!empty($_POST['id']))
{
    $to_id = $_POST['id'];
    $username = $_SESSION['username']; 
    $by_id = $_SESSION['user_id'];
    $conn = new Database();
    $gen= new Generate(7);
    $roomNo = $gen->RandomString(7);
    $conn->setNotification($to_id,$by_id,$username,$roomNo);
    echo $roomNo;
}else{
    echo "";
}

?>