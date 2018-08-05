<?php define('IN_APP', true); ?>
<?php include_once 'includes/header1.php' ?>
<?php
include_once 'core/init.php';

if(Session::exists('username'))
{
    Redirect::to('dashboard.php');
}

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
             echo '<div class="row">';
            foreach ($validate->errors() as $error) {
                echo '<div class="col s12 m6"><div class="card-panel red lighten-2">'.$error . "</div></div>";
            }
            echo '</div>';
        }
    }
}

?>
<body class="signup">
    <div class="container">
        <div class="right-corner row">
            <a href="index.php"><h4 class="my-text">ECLIENT</h4></a>
            <form action="" method="POST">
                <div class="row">
                    <div class="input-field col s12 m6">
                        <input id="first_name" name="first_name" type="text" class="validate" value="<?php echo escape(Input::get('first_name')); ?>">
                        <label for="first_name">First Name *</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <input id="last_name" name="last_name" type="text" class="validate" value="<?php echo escape(Input::get('last_name')); ?>">
                        <label for="last_name">Last Name *</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m6">
                        <input id="username" name="username" type="text" class="validate" value="<?php echo escape(Input::get('username')); ?>">
                        <label for="username">Username *</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <input id="phone" name="phoneno" type="text" class="validate" value="<?php echo escape(Input::get('phone')); ?>">
                        <label for="phone">Phone *</label>
                    </div>
                </div>
                <div class="row">
                <div class="input-field col m6 s12">
                        <input id="company_email_address" name="company_email_address" type="email" class="validate" value="<?php echo escape(Input::get('company_email_address')); ?>">
                        <label for="company_email_address">Email address *</label>
                    </div>
                    <div class="input-field col m6 s12">
                        <input id="company_website" name="company_website" type="text" class="validate" value="<?php echo escape(Input::get('company_website')); ?>">
                        <label for="company_website">Company website *</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m6">
                        <input id="company_full_name" name="company_full_name" type="text" class="validate" value="<?php echo escape(Input::get('company_full_name')); ?>">
                        <label for="company_full_name">Company name *</label>
                        </div>
                        <div class="input-field col s12 m6">
                        <input id="company_registration_number" name="company_registration_number" type="number" class="validate" value="<?php echo escape(Input::get('company_registration_number')); ?>">
                        <label for="company_registration_number">Company Pan number *</label>
                        </div>
                </div>
                <div class="row">
                <div class="input-field col m6 s12">
                        <input id="company_country" name="company_country" type="text" class="validate" value="<?php echo escape(Input::get('company_country')); ?>">
                        <label for="company_country">Company Country *</label>
                    </div>
                    <div class="input-field col m6 s12">
                        <input id="company_address" name="company_address" type="text" class="validate" value="<?php echo escape(Input::get('company_address')); ?>">
                        <label for="company_address">Company Address *</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m12">
                        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                        <button class="btn waves-effect waves-light" type="submit" name="register">Register my company</button>
                        or <a href="login.php">Login here.</a>
                    </div>
                </div>
            </form>
        </div>
    </div>


<?php include_once 'includes/footer1.php' ?>