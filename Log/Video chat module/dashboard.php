<?php include_once 'functions/header.php'; ?>

<?php
session_start();
if(!isset($_SESSION['username']))
{
    header('Location: login.php');
}

$notid = $_SESSION['user_id'];
$conn = new Database();
$results = $conn->getUser($notid);

?>
<div class="container-fluid">
        <!-- Dropdown Structure -->
            <ul id="dropdown1" class="dropdown-content">
            <li><a href="#!">Profile</a></li>
            <li><a href="logout.php">Logout</a></li>
            </ul>
            <nav>
                <div class="nav-wrapper">
                <a href="#" class="brand-logo">EClient</a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a class="dropdown-trigger" href="#!" data-target="dropdown1">Welcome, <?php echo $_SESSION['username']; ?><i class="material-icons right">arrow_drop_down</i></a></li>
                </ul>
                </div>
            </nav>
    <div class="row">
        <div class="col s6 m3 z-depth-1 hoverable" style="margin-top:20px;">
            <p><b>Notifications:</b>
            <p id="notification" ></p>
            </p>
        </div>
        <div class="col s6 m3">
            <table class="highlight">
                <thead><tr><th>Users</th><th></th></tr></thead>
                <tbody>
                <?php for($i=0; $i<count($results); $i++){ ?>
                <?php echo "<tr><td>".$results[$i]['username']."</td>"; ?>
                    <td>
                    <input type="hidden" name="id" />
                    <button onclick= "submitForm(this)" class="btn waves-effect waves-light" type="submit" name="<?php echo $results[$i]['id'] ?>">call him
                    <i class="material-icons right">call</i>
                    </button>
                    </td></tr>
                <?php }  ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>

function submitForm(val)
{
    var id = val.name;
    var params = "id="+id;
	var xhr = new XMLHttpRequest();
	xhr.open('POST','functions/setnotification.php',true);
	xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
	xhr.onload = function(){
        if(this.status == 200){
            var data = this.responseText;
            if(data === " ")
            {
                alert("Error on calling..");
                return;
            }else{
                popitup(data);
            }
        }
	}
	xhr.send(params);
}

$(document).ready(function(){
    $(".dropdown-trigger").dropdown();
});

$noti = document.getElementById('notification');
var datas;
var ran = true
setInterval(function() {
    $.post("functions/getnotification.php",{user_id: <?php echo $_SESSION['user_id']; ?>} ,function (data) {
        window.datas = JSON.parse(data);
        if(ran)
        {
            M.toast({html: datas[0].data});
            ran = false;
        }
        $noti.innerHTML = `<table class='highlight'>
        <tbody><tr><td>`+ datas[0].data +`</td><td>
        <form onsubmit="receive('calling.php')" id="call" method="POST" action='<?php echo $_SERVER["PHP_SELF"]; ?>'>
        <button class='btn waves-effect waves-light' type='submit' name='test'>receive call<i class='material-icons right'>call</i></button>
        </form>
        </td></tr></tbody></table>`;

    }).fail(function(){
      console.log("error");
    });  
}, 1000);



function popitup(data) {
        var url = 'calling.php'
		newwindow=window.open(url+"?room="+data,'name','height=600,width=1300');
		if (window.focus) {newwindow.focus()}
		return false;
    }
    
function receive(url) {
		newwindow1=window.open(url+"?room="+datas[0].room+"&id="+datas[0].id,'name','height=600,width=1300');
		if (window.focus) {newwindow1.focus()}
		return false;
	}
</script>

<?php include_once 'functions/footer.php'; ?>