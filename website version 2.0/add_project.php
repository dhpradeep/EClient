<?php 
define('IN_APP', true);

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if($_SESSION['role'] != 'company')
{
    header('Location: dashboard.php');
}
include_once 'includes/header.php';

if (Input::exists()) {
    $validate = new Validate();
    $validation = $validate->check($_POST, array(
        'project_name' => array(
            'name' => 'project_name',
            'required' => true,
            'min' => 2,
            'max' => 50
        ),
        'dateTime' => array(
            'name' => 'dateTime',
            'required' => true,
        ),
        'dateTime1' => array(
            'name' => 'dateTime1',
            'required' => true,
        ),
    ));

    if ($validate->passed()) { 
        $user = new User();
        try { 
            $user->create('project',array( 
                'project_name' => Input::get('project_name'),
                'company_id' => Session::get('current_company'),
                'project_start_date' => Input::get('dateTime'),
                'project_end_date' => Input::get('dateTime1')
            ));
             
            //Redirect::to('view_members.php');
            echo '<script>location.href=dashboard.php;</script>';

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

<div class="row">
    <div class="col col-lg-2"></div>
    <div class="col col-lg-6">
        <div class="card">
            <div class="card-header"><strong>Add</strong> Project</div>
                <div class="card-body card-block">
                    <form action="" method="post">
                        <div class="form-group col-lg-12">
                            <label for="project_name" class="form-control-label">Enter project Name</label>
                            <input value="<?php echo escape(Input::get('project_name')); ?>" id="project_name" name="project_name" type='text' class="form-control" autocomplete="off" />
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="dateTime" class="form-control-label">Project Start date</label>
                            <input value="<?php echo escape(Input::get('dateTime')); ?>" name="dateTime" id="dateTime" type='date' class="form-control" />
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="dateTime1" class="form-control-label">Project End date</label>
                            <input value="<?php echo escape(Input::get('dateTime1')); ?>" name="dateTime1" id="dateTime1" type='date' class="form-control" />
                        </div>
                        <div class="form-group col-lg-4">
                            <input type='submit' class="form-control btn btn-success" />
                        </div>
                    </form>
                </div>
           </div>
    </div>
</div>

<script src="assets/js/vendor/jquery-2.1.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
<script src="assets/js/plugins.js"></script>
<script src="assets/js/main.js"></script>
