<?php define('IN_APP', true); ?>
<?php include_once 'includes/config.php' ?>
<?php
include_once 'core/init.php';

if(Session::exists('username'))
{
    Redirect::to('dashboard.php');
}
$error = [];
if (Input::exists()) {  
    if(Token::check(Input::get('token'))) { 
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'first_name' => array(
                'name' => 'first_name',
                'required' => true,
                'min' => 2,
                'max' => 50
            ),
            'last_name' => array(
                'name' => 'last_name',
                'required' => true,
                'min' => 2,
                'max' => 50
            ),
            'username' => array(
                'name' => 'username',
                'required' => true,
                'min' => 5,
                'max' => 15,
                'unique' => 'users' 
            ),
            'phoneno' => array(
                'name' => 'phoneno',
                'required' => true,
                'min' => 10,
                'max' => 10
            ),
            'company_full_name' => array(
                'name' => 'company_full_name',
                'required' => true,
                'min' => 2,
                'max' => 20
            ),
            'company_registration_number' => array(
                'name' => 'company_registration_number',
                'required' => true,
                'min' => 9,
                'max' => 9,
                'unique' => 'company'
            ),
            'company_email_address' => array(
                'name' => 'company_email_address',
                'required' => true,
                'min' => 2,
                'max' => 30,
                'unique' => 'company'
            ),
            'company_website' => array(
                'name' => 'company_website',
                'required' => true
            ),
            'company_country' => array(
                'name' => 'company_country',
                'required' => true
            ),
            'company_address' => array(
                'name' => 'company_address',
                'required' => true
            ),
        ));

        if ($validate->passed()) { 
            $user = new User();
            try {
                $user->create('company_temp',array(
                    'fName' => Input::get('first_name'), 
                    'lName' => Input::get('last_name'),
                    'username' => Input::get('username'),
                    'phone' => Input::get('phoneno'),
                    'company_full_name' => Input::get('company_full_name'),
                    'company_registration_number' => Input::get('company_registration_number'),
                    'company_email_address' => Input::get('company_email_address'),
                    'company_website' => Input::get('company_website'),
                    'company_country' => Input::get('company_country'),
                    'company_address' => Input::get('company_address')
                ));

                $fName = Input::get('first_name');
                $lName = Input::get('last_name');
                $cName = Input::get('company_full_name');
                $cEmail = Input::get('company_email_address');
                $username = Input::get('username');

                $mailer = new Mailer();
                $mailer->sendPendingEmail($fName,$lName,$cName,$cEmail,$username); 
                
                Redirect::to('index.php');

            } catch(Exception $e) {
                echo $error, '<br>';
            }
         } else {
            foreach ($validate->errors() as $err) {
                array_push($error, $err);
           }
        }
    }
}


?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>EClient | Registration</title>
    <meta name="description" content="EClient">
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
                        <div class="form-group col-lg-6">
                            <label for="first_name">First Name*</label>
                            <input id="first_name" name="first_name" type="text" class="form-control" placeholder="First Name" value="<?php echo escape(Input::get('first_name')); ?>">
                        </div> 
                        <div class="form-group col-lg-6">
                            <label for="last_name">Last Name*</label>
                            <input id="last_name" name="last_name" type="text" class="form-control" placeholder="Last Name" value="<?php echo escape(Input::get('last_name')); ?>">
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="username">Username*</label>
                            <input autocomplete="off" id="username" name="username" type="text" class="form-control" placeholder="Username" value="<?php echo escape(Input::get('username')); ?>">
                        </div> 
                        <div class="form-group col-lg-6">
                            <label for="phoneno">Phone*</label>
                            <input id="phoneno" name="phoneno" type="text" class="form-control" placeholder="Phone no" value="<?php echo escape(Input::get('phoneno')); ?>">
                        </div>
                        <div class="form-group">
                            <label for="company_email_address">Email*</label>
                            <input id="company_email_address" name="company_email_address" type="email" class="form-control" placeholder="Email" value="<?php echo escape(Input::get('company_email_address')); ?>">
                        </div>
                        <div class="form-group">
                            <label for="company_website">Company Website*</label>
                            <input id="company_website" name="company_website" type="text" class="form-control" placeholder="Company website" value="<?php echo escape(Input::get('company_website')); ?>">
                        </div>
                        <div class="form-group">
                            <label for="company_full_name">Company Name*</label>
                            <input id="company_full_name" name="company_full_name" type="text" class="form-control" placeholder="Company full name" value="<?php echo escape(Input::get('company_full_name')); ?>">
                        </div>
                        <div class="form-group">
                            <label for="company_registration_number">Company registration No.*</label>
                            <input id="company_registration_number" name="company_registration_number" type="text" class="form-control" placeholder="Registration No." value="<?php echo escape(Input::get('company_registration_number')); ?>">
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="company_country">Company country*</label>
                            <input id="company_country" name="company_country" type="text" class="form-control" placeholder="Company country" value="<?php echo escape(Input::get('company_country')); ?>">
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="company_address">Company Address*</label>
                            <input id="company_address" name="company_address" type="text" class="form-control" placeholder="Company Address" value="<?php echo escape(Input::get('company_address')); ?>">
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox"> Agree the terms and policy
                            </label>
                        </div>
                        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                        <button type="submit" name="register" class="btn btn-success btn-flat m-b-30 m-t-30">Register my country</button>
                        <div class="register-link m-t-15 text-center">
                            <p>Already have account ? <a href="login.php"> Sign in</a></p>
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
