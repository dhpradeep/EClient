<?php define('IN_APP', true); ?>
<?php include_once('includes/header1.php'); ?>
<?php
include_once 'core/init.php';
 
if(Session::exists('username'))
{
    Redirect::to('dashboard.php');
}
$error = "";
if(isset($_POST['login']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    if($username == "" || $password == "")
    { 
        $error = "Username or password required";
    }
    else{
        $conn = new Database();
        $user = $conn->login($username,$password);
        if($user)
        {
            
            if(!empty($_POST["remember"]))
            {
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
}
?>
    <div class="container">
        <div class="row">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="row">
                    <div class="col s6 m6">
                    <?php if($error != "") { ?>
                            <div class="card-panel red lighten-2">
                        <?php  echo $error; ?>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m6">
                        <i class="material-icons prefix">account_circle</i>
                        <input id="username" name="username" value="<?php if(isset($_COOKIE["username"])) { echo $_COOKIE["username"]; } ?>" type="text" class="validate" autocomplete="off">
                        <label for="username">Username</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m6">
                        <i class="material-icons prefix">security</i>
                        <input id="password" name="password" value="<?php if(isset($_COOKIE["password"])) { echo $_COOKIE["password"]; } ?>" type="password" class="validate">
                        <label for="password">Password</label>
                        <span class="helper-text">(click show password button visible password)</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col s8 m4">
                        <div class="switch">
                        <label>Remember Me
                            <input type="checkbox" name="remember" value="remember" />
                            <span class="lever"></span>
                        </label>
                        </div>
                    </div>

                    <div class="col s4 m4">
                        <div class="switch">
                            <label>Show password
                                <input id="showpass" type="checkbox" onchange="document.getElementById('password').type = this.checked ? 'text' : 'password'">
                                <span class="lever"></span>
                            </label>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col s4 m4 offset-s4">
                        <a href="#">Forget password ?</a>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s4 m4">
                        <!-- <input type="hidden" name="token1" value="<?php # echo Token::generate(); ?>"> -->
                        <button class="btn waves-effect waves-light" type="submit" name="login">Login</button>
                    </div>
                    <div class="signUp col s6 m2">
                        <a href="register.php">Register account</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

<?php include_once('includes/footer.php'); ?>
