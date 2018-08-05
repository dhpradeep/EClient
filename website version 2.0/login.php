<?php define('IN_APP', true); ?>
<?php  include_once('includes/config.php'); ?>
<?php
include_once 'core/init.php';
if(Session::exists('username'))
{
    Redirect::to('dashboard.php');
}
$error = "";
if(Input::exists()) 
{ 
if(Token::check(Input::get('token'))) {
    $username = Input::get('username');
    $password = Input::get('password');
    if($username == "" || $password == "") { 
        $error = "Username or password is required";
    } else {
        $conn = new Database();
        $user = $conn->login($username,$password);
        if($user) {
            if(!empty($_POST["remember"])) {
            setcookie ("username",$_POST["username"],time()+ 3600 /*(10 * 365 * 24 * 60 * 60)*/);
		    setcookie ("password",$_POST["password"],time()+ 3600); //3600 is 1 hour
            }else{
                if(isset($_COOKIE["username"])) {
                    setcookie ("username","");
                }
                if(isset($_COOKIE["password"])) {
                    setcookie ("password","");
                }
            }
            $company = $conn->getcompany($user['related_company']); 
            $client = $conn->getClient($user['related_project']); 
 
            if($company){
                $_SESSION['current_company'] = $company['ID'];
                $_SESSION['current_company_name'] = $company['company_full_name'];

                if($client){
                    $_SESSION['current_client'] = $client['ID'];
                    $_SESSION['client_project_name'] = $client['project_name'];
                }
            }
            $_SESSION['username'] =  $user['username'];
            $_SESSION['current_user_password'] = Hash::make($user['password'],'$#@!abcd!@#$1234');
            $_SESSION['user_id'] = $user['ID'];
            $_SESSION['role'] = $user['role'];

            $change_status = $conn->change_status($user['ID']);
            header('Location: dashboard.php');
        }else{
            $error = "Username or password is wrong";
        }
    }
}}
?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>EClient | Login page</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="assets/css/normalize.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/scss/style.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
</head>
<body class="bg-dark">
    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <a href="index.php">
                        <h3 class="text-white">EClient</h3>
                    </a>
                </div> 
                <div class="col">
                    <?php if($error != "") { ?>
                    <div class="col bg-danger text-white">
                    <?php  echo "<center><h5 style='height: 50px;line-height: 50px;'>".$error."</h5></center>"; ?>
                </div>
                <?php } ?>

                <div class="login-form">
                    <form method="post" action="">
                        <div class="form-group">
                            <label>Username</label>
                            <input name="username" value="<?php if(isset($_COOKIE["username"])) { echo $_COOKIE["username"]; } ?>" autocomplete="off" type="text" class="form-control" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input name="password" value="<?php if(isset($_COOKIE["password"])) { echo $_COOKIE["password"]; } ?>" autocomplete="off" type="password" class="form-control" placeholder="Password">
                        </div>
                        <div class="checkbox">
                            <label>
                                <input name="remember" type="checkbox"> Remember Me
                            </label>
                            <label class="pull-right">
                                <a href="forget.php">Forgotten Password?</a>
                            </label>
                        </div>
                        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                        <button name="login" type="submit" class="btn btn-success btn-flat m-b-10 m-t-30">Sign in</button>
                        <div class="register-link m-t-15 text-center">
                            <p>Don't have company ? <a href="register.php"> register here</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="assets/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/main.js"></script>


</body>
</html>
