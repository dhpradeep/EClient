<?php include_once 'includes/header1.php' ?>
<?php
if(isset($_GET['room']))
{
    $room =  $_GET['room'];
    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
        $conn = new Database();
        $conn->delete($id);
    }
?>
    <iframe
        src="https://tokbox.com/embed/embed/ot-embed.js?embedId=d5083a92-1f1d-4f49-ab72-9726ec2203ba&room=<?php echo $room; ?>&iframe=true"
        width="100%"
        height="600px"
        class= "update"
        allow="microphone; camera"
      ></iframe>
<?php }else{ 
    header('Location:dashboard.php');
}
?>

