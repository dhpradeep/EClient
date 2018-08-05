<?php define('IN_APP', true); ?>
<?php include_once 'includes/config.php' ?>
<?php
include_once 'core/init.php';

if(Session::exists('username'))
{
    Redirect::to('dashboard.php');
}
$error = [];
if(Input::exists())
{
    if(Token::check(Input::get('token'))) { 
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'email' => array(
                'name' => 'email',
                'required' => true,
                'min' => 6,
                'max' => 50,
            )
        ));

        if ($validate->passed()) { 
            $data = new Data();
            try {
                $data = $data->getdata('users',array('email','=',Input::get('email')));
                if($data->count() == 1)
                {
                    $mailer = new Mailer();
                    $res = $mailer->sendForgetmail(Input::get('email'));
                    if($res)
                    {
                        header('Location: index.php');
                    }

                }else{
                    array_push($error,"Email not found in database");
                }
            }catch(Exception $e)
            {
                echo "Error";
            }
        }else {
            foreach ($validate->errors() as $err) {
                array_push($error, $err);
            }    
        }
    }
}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>EClient | Forget password</title>
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
                <div class="row">
                 <?php foreach ($error as $e): ?>
                            <div class="col col-lg-6">
                    <?php echo "<p class='bg-danger text-white' style='height:auto;line-height:30px;margin-bottom:3px;'>".$e."</p>"; ?>
                </div>
                <?php endforeach ?>
                </div>
                <div class="login-form">
                    <form method="post" action="">
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input id="email" name="email" type="email" class="form-control" placeholder="Email" value="<?php echo escape(Input::get('email')); ?>">
                        </div>
                        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                        <button type="submit" name="forget" class="btn btn-success btn-flat m-b-15">Submit</button>
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
