<?php define('IN_APP', true); ?>
<?php include_once "includes/header.php" ?>
<?php
if(!Session::exists('username'))
{
    Redirect::to('index.php'); 
}
if (Input::exists()) {
    if(Input::get('update')) {
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
            'email' => array(
                'name' => 'email',
                'required' => true,
                'min' => 2,
                'max' => 40
            ),
            'phone' => array(
                'name' => 'phone', 
                'min' => 10,
                'max' => 10
            ),
        ));
        if ($validate->passed()) { 
            $user = new User();
            try { 
                $user->update('users',array(
                    'fName' => Input::get('first_name'), 
                    'lName' => Input::get('last_name'),
                    'email' => Input::get('email'),
                    'phone' => Input::get('phone')
                ));

            } catch(Exception $e) {
                echo '<br>';
            }
        } else{
            echo '<div class="row">';
            foreach ($validate->errors() as $error) {
            ?>
                <div class="col col-lg-4"><div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
                </div></div>
            <?php
            }
            echo '</div>';
        }
    }
    if(Input::get('change_pass'))
    {
            $validate = new Validate(); 
            $validation = $validate->check($_POST, array(
                'current_password' => array(
                    'name' => 'current_password',
                    'required' => true,
                    'min' => 2,
                    'max' => 50
                ),
                'new_password' => array(
                    'name' => 'new_password',
                    'required' => true,
                    'min' => 2,
                    'max' => 50
                ),
                'confirm_password' => array(
                    'name' => 'confirm_password',
                    'required' => true,
                    'min' => 2,
                    'max' => 40,
                    'matches' => 'new_password'
                )
            ));
            if($validate->passed()) {
                if(Hash::make(Input::get('current_password'),'$#@!abcd!@#$1234') !== Session::get('current_user_password')) {
                    echo '<div class="row">';
                    echo '<div class="col col-lg-4"><div class="alert alert-danger" role="alert">';
                    echo 'Your current password is wrong.';
                    echo '</div></div></div>';
                } else {  
                    $user = new User();
                    $user->update('users',array(
                        'password' => Input::get('new_password'),
                    ), Session::get('user_id'));
                    Session::put('current_user_password',Hash::make(Input::get('new_password'),'$#@!abcd!@#$1234'));
                }
            } else  {
                echo '<div class="row">';
                foreach ($validate->errors() as $error) {
                ?>
                    <div class="col col-lg-4"><div class="alert alert-danger" role="alert">
                    <?php echo $error; ?>
                    </div></div>
                <?php
                }
                echo '</div>';
            }
    }
}

$data = new Data();
$datas = $data->getdata('users',array('ID', '=', Session::get('user_id')));
$data = $datas->_results;
?>
<div class="content mt-3">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4>Update profile</h4>
                </div>
                <div class="card-body">
                    <div class="default-tab">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home"
                                    aria-selected="true">Profile</a>
                                <a class="nav-item nav-link" id="nav-pass-tab" data-toggle="tab" href="#nav-pass" role="tab" aria-controls="nav-pass" aria-selected="false">Change password</a>
                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile"
                                    aria-selected="false">Social links</a>
                            </div>
                        </nav>

                        <div class="tab-content pl-3 pt-2" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <?php foreach($data as $value): ?>
                            <form action="" method="post" class="form-horizontal">
                                <div class="card-body card-block">
                                <div class="col col-lg-12">
                                    <div class="has-success form-group">
                                        <label for="inputSuccess2i" class=" form-control-label">First name</label>
                                        <input type="text" name="first_name" class="form-control-success form-control" value=<?php echo $value->fName; ?> >
                                    </div>
                                    <div class="has-success form-group">
                                        <label for="inputSuccess2i" class=" form-control-label">Last name</label>
                                        <input type="text" name="last_name" class="form-control-success form-control" value=<?php echo $value->lName; ?>>
                                    </div>
                                    <div class="has-success form-group">
                                        <label for="inputSuccess2i" class=" form-control-label">Phone</label>
                                        <input type="text" name="phone" class="form-control-success form-control" value=<?php echo $value->phone; ?>>
                                    </div>
                                    <div class="has-success form-group">
                                        <label for="inputSuccess2i" class=" form-control-label">Email</label>
                                        <input type="text" name="email" class="form-control-success form-control" value=<?php echo $value->email; ?>>
                                    </div>
                                    <input class="btn btn-success" type="submit" name="update" value="Update">
                                </div>
                                </div>
                            </form>
                             <?php endforeach ?>
                            </div>

                            <div class="tab-pane fade" id="nav-pass" role="tabpanel" aria-labelledby="nav-pass-tab">
                            <form action="" method="post">
                                <div class="card-body card-block">
                                    <div class="has-success form-group">
                                        <label for="inputSuccess2i" class=" form-control-label">Current password</label>
                                        <input name="current_password" type="password" class="form-control-success form-control">
                                    </div>
                                    <div class="has-success form-group">
                                        <label for="inputSuccess2i" class=" form-control-label">New Password</label>
                                        <input name="new_password" type="password" class="form-control-success form-control">
                                    </div>
                                    <div class="has-success form-group">
                                        <label for="inputSuccess2i" class=" form-control-label">Confirm password</label>
                                        <input name="confirm_password" type="password" class="form-control-success form-control">
                                    </div>
                                    <input class="btn btn-success" type="submit" name="change_pass" value="Update">
                                </div>
                            </form>
                            </div>
                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <div class="card-body card-block">
                                    <div class="row form-group">
                                        <div class="col col-md-12">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-facebook"></i>
                                                </div>
                                                <input type="text" id="input1-group1" name="input1-group1" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-12">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-google"></i>
                                                </div>
                                                <input type="text" id="input1-group1" name="input1-group1" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-12">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-twitter"></i>
                                                </div>
                                                <input type="text" id="input1-group1" name="input1-group1" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <input class="btn btn-success" type="submit" value="Update">
                                    <input class="btn btn-danger" type="submit" value="Cancel">
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="assets/js/vendor/jquery-2.1.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
<script src="assets/js/plugins.js"></script>
<script src="assets/js/main.js"></script>

<script src="assets/js/lib/chart-js/Chart.bundle.js"></script>
<script src="assets/js/dashboard.js"></script>
<script src="assets/js/widgets.js"></script>
</script>
</body>
</html>