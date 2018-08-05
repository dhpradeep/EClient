<?php define('IN_APP', true); ?>
<?php include_once 'includes/config.php' ?>
<?php include_once 'core/init.php' ?>
<?php
if(!Input::get('token'))
{
    Redirect::to('index.php');
}
$data = new Data();
$data = $data->getdata('temp_token',array('token','=',Input::get('token')));
if($data->count() != 1)
{
    Redirect::to('index.php');
}
$data = $data->_results;
foreach($data as $d)
{
    $email = $d->email;
    $to_time = $d->insert_time;
} 
$diff = (strtotime(date("Y-m-d H:i:s")) - strtotime($to_time));
$minutes = round(((($diff % 604800) % 86400) % 3600) / 60);
//echo $minutes;
if($minutes > 30)
{
    Redirect::to('index.php');
}
$error = [];
if(Input::exists())
{
    $validate = new Validate();
    $validation = $validate->check($_POST, array(
        'new_password' => array(
            'name' => 'new_password',
            'required' => true,
            'min' => 8,
            'max' => 40
        ),
        'confirm_password' => array(
            'name' => 'confirm_password',
            'required' => true,
            'min' => 8,
            'max' => 40,
            'matches' => 'new_password'
        )
    ));
    if($validate->passed()){
        $data = new Data();
        $query = "UPDATE users SET password=? WHERE email=?";
        $param = array(Input::get('new_password'),$email);
        $data = $data->getmultipledata($query,$param);
        
        $query1 = "DELETE FROM temp_token WHERE token=?";
        $param1 = array(Input::get('token'));
        $da = new Data();
        $da = $da->getmultipledata($query1,$param1);
    }else{
        foreach ($validate->errors() as $err) {
            array_push($error, $err);
        } 
    }
}
?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>EClient | password recovery</title>
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
                            <label for="new_password">New Password</label>
                            <input id="new_password" name="new_password" type="password" class="form-control" placeholder="New password">
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Confirm Password</label>
                            <input id="confirm_password" name="confirm_password" type="password" class="form-control" placeholder="New password">
                        </div>
                        <button type="submit" name="change_password" class="btn btn-success btn-flat m-b-15">Change password</button>
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
