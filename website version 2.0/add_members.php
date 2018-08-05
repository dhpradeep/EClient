<?php
define('IN_APP', true); 

include_once 'includes/header.php' ?>
<?php
if (Input::exists()) {
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
                'max' => 20,
                'unique' => 'users'
            ),
            'email' => array(
                'name' => 'email',
                'required' => true,
                'min' => 7,
                'max' => 40
            ),
            'password' => array(
                'name' => 'password',
                'required' => true,
                'min' => 8,
                'max' => 30
            ),
        ));

        if ($validate->passed()) { 
            $user = new User();

            if(Session::exists('current_company'))
            {
                $related_company = Session::get('current_company');
                if(Session::exists('current_client'))
                {
                    $related_project = Session::get('current_client');
                }else{
                    $related_project = "0";
                }
            }else{
                $related_company = '0';
            }
            try { 
                $user->create('users',array(
                    'fName' => Input::get('first_name'), 
                    'lName' => Input::get('last_name'),
                    'username' => Input::get('username'),
                    'email' => Input::get('email'),
                    'password' => Input::get('password'),
                    'role' => Session::get('role'),
                    'related_company' => $related_company,
                    'related_project' => $related_project
                ));
                
                //Redirect::to('view_members.php');
                echo '<script>location.href=view_members.php;</script>';

            } catch(Exception $e) {
                echo '<br>';
            }
         } else {
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
?> 

  <div class="content mt-3">
                <form action="" method="post" class="form-horizontal">
                <div class="col-lg-12">
                    <div class="card">
                      <div class="card-header"><strong>Add</strong> members</div>
                      <div class="card-body">
                        <div class="form-group col col-md-6">
                            <label for="company" class=" form-control-label">First Name</label>
                            <input type="text" name="first_name" class="form-control" value="<?php echo escape(Input::get('first_name')); ?>">
                        </div>
                        <div class="form-group col col-md-6">
                            <label for="vat" class=" form-control-label">Last Name</label>
                            <input type="text" name="last_name" class="form-control" value="<?php echo escape(Input::get('last_name')); ?>">
                        </div>
                        <div class="form-group col col-md-6">
                            <label for="company" class=" form-control-label">Username</label>
                            <input type="text" name="username" class="form-control" value="<?php echo escape(Input::get('username')); ?>">
                        </div>
                        <div class="form-group col col-md-6">
                            <label for="vat" class=" form-control-label">Email</label>
                            <input type="email" name="email" class="form-control" value="<?php echo escape(Input::get('email')); ?>">
                        </div>
                        <div class="form-group col col-md-6">
                            <label for="vat" class=" form-control-label">Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        </div>
                        <div class="col col-md-2">
                        <input class="btn btn-success" type="submit" name="submit" value="Add member">
                        </div>
                        <br>
                      </div>
                    </div>
                  </div>                 
                </div>
            </div>
            </form>
        </div>    
  </div>

<script src="assets/js/vendor/jquery-2.1.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
<script src="assets/js/plugins.js"></script>
<script src="assets/js/main.js"></script>

<script src="assets/js/vendor/jquery-2.1.4.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/lib/peitychart/jquery.peity.min.js"></script>
<script src="assets/js/lib/peitychart/peitychart.init.js"></script>


<script src="assets/js/lib/chart-js/Chart.bundle.js"></script>
<script src="assets/js/dashboard.js"></script>
<script src="assets/js/widgets.js"></script>