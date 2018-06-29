<?php include_once 'functions/header.php' ?>
<?php
session_start();
if(isset($_SESSION['user']))
{
    header('Location: dashboard.php');
}else{}


$error = "";
if(isset($_POST['register']))
{
    $fname = $_POST['first_name'];
    $lname = $_POST['last_name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    if($fname == "" || $lname == "" || $username == "" || $email == "" || $password == "" || $cpassword == "")
    {
        $error =  "Please fill out all data.";
    }else if($password != $cpassword){
        $error = "Password and Confirm password is not same.";
    }else{
        $conn = new Database();
        $conn->insert($fname,$lname,$username,$email,$password);
        header('Location: login.php');
    }
}

?>
<body class="signup">
    <div class="container">
        <div class="right-corner row">
            <h4 class="my-text">ECLIENT</h4>
            <form action="" method="POST">
                <div class="row">
                    <div class="col s12 m6">
                        <?php if($error != "") { ?>
                            <div class="card-panel red lighten-2">
                          <?php  echo $error; ?>
                          </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m6">
                        <input id="first_name" name="first_name" type="text" class="validate">
                        <label for="first_name">First Name</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <input id="last_name" name="last_name" type="text" class="validate">
                        <label for="last_name">Last Name</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m6">
                        <input id="username" name="username" type="text" class="validate">
                        <label for="username">Username</label>
                        <span class="helper-text" data-error="wrong" data-success="right">you can use letter, number and periods</span>
                    </div>
                    <div class="input-field col m6 s12">
                        <input id="email" name="email" type="email" class="validate">
                        <label for="email">Email</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col m6 s12">
                        <input id="password" name="password" type="password" class="validate">
                        <label for="password">Password</label>
                        <span class="helper-text" data-error="wrong" data-success="right">Use 8 or more characters with a mix of letters, numbers & symbols</span>
                    </div>
                    <div class="input-field col m6 s12">
                        <input id="cpassword" name="cpassword" type="password" class="validate">
                        <label for="cpassword">Confirm Password</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m12">
                        <button class="btn waves-effect waves-light" type="submit" name="register">Proceed</button>
                        or <a href="login.php">Login here.</a>
                    </div>
                </div>
            </form>
        </div>
    </div>


<?php include_once 'functions/footer.php' ?>