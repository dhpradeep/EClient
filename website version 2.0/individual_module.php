<?php define('IN_APP', true); ?>
<?php 
session_start();
if($_SESSION['role'] != 'company')
{
    header('Location: dashboard.php');
    exit();
}
?>
<?php include_once 'includes/header.php' ?>
 
<script src="assets/js/vendor/jquery-2.1.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
<script src="assets/js/plugins.js"></script>
<script src="assets/js/main.js"></script>
<script src="assets/js/jquery-1.10.2.min.js"></script>

<?php 
if(!Input::get('id'))
{

    $projects = new Data();
    $query1 = "SELECT ID,project_name FROM project";
    $projects = $projects->getmultipledata($query1);
    $projects = $projects->_results;

    $data = new Data();
    $query = "SELECT * FROM project_module WHERE assign_to=?";
    $params = array(Session::get('username'));
    $project_module1 = $data->getmultipledata($query, $params);
    $project_module1 = $project_module1->_results;
?>
<?php foreach($projects as $project): ?>
    <?php 
        $data = new Data();
        $query = "SELECT * FROM project_module WHERE assign_to=? AND pID=?";
        $params = array(Session::get('username'),$project->ID);
        $project_module = $data->getmultipledata($query, $params); ?>
    <?php if($project_module->count() > 0): ?>
        <?php $project_module = $project_module->_results; ?>
        <div class="col col-lg-12">
            <div class="card">
                <div class="card-header">
                    <strong><?php echo $project->project_name ?></strong>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Module title</th>
                                <th>Module sub title</th>
                                <th>Module Desc</th>
                                <th>Preset</th>
                                <th>Details</th>
                            </tr>
                        </thead> 
                        <tbody>
                        <?php foreach($project_module as $module): ?>
                        <tr>
                            <td><?php echo $module->module_title; ?></td>
                            <td><?php echo $module->module_sub_title; ?></td>
                            <td><?php echo $module->module_desc; ?></td>
                            <td><?php echo $module->preset; ?></td>
                            <td>
                                <a href="individual_module.php?id=<?php echo $module->ID ?>">
                                    <button type="button" class="btn btn-sm btn-success">Details</button>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php endif ?>
<?php endforeach ?>

<?php
}else{
    $data = new Data();
    
    $query = "SELECT * FROM project_module INNER JOIN project on project_module.pID = project.ID WHERE project_module.ID=? AND project.company_id = ?";
    $params = array(Input::get('id'),Session::get('current_company'));
    
    $project_module = $data->getmultipledata($query, $params);

    if($project_module->count() != 1)
    {
        echo "<center><button class='btn btn-lg btn-success'><i class='fa fa-arrow-left'></i> <a class='text-white' href='dashboard.php'>Back to home</a></button><center>";
        exit();
    }
    $project_module = $project_module->_results;

    if(Input::get('submit_files'))
    {
    $validate = new Validate();
    $validation = $validate->check($_POST, array(
        'submission_title' => array(
            'name' => 'submission_title',
            'required' => true,
            'min' => 2,
            'max' => 255
        ),
        'submission_remarks' => array(
            'name' => 'submission_remarks',
            'min' => 2,
            'max' => 500
        ),
        'submission_file' => array(
            'name' => 'submission_file',
            'required' => true,
            'min' => 2,
            'max' => 255
        )
    ));
    if ($validate->passed()){ 
        $user = new User();
        try {  
            $user->create('module_by',array(
                'pID' => Session::get('current_project'),
                'mID' => Input::get('id'),
                'uID' => Session::get('user_id'), 
                'title' => Input::get('submission_title'),
                'remarks' => Input::get('submission_remarks'),
                'link' => Input::get('submission_file')
            ));

        } catch(Exception $e) {
            echo 'Error<br>';
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

    $submission_data = new Data();
    $query1 = "SELECT * FROM module_by WHERE mID=? AND uID=?";
    $params1 = array(Input::get('id'),Session::get('user_id'));
    $submission_data = $submission_data->getmultipledata($query1, $params1);
    $submission_data = $submission_data->_results;
?>
<div class="col col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong>Module data</strong>
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Assign to</th>
                        <th>Module title</th>
                        <th>Module sub title</th>
                        <th>Module Desc</th>
                        <th>Preset</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($project_module as $module): ?>
                <tr>
                    <td><?php echo $module->assign_to; ?></td>
                    <td><?php echo $module->module_title; ?></td>
                    <td><?php echo $module->module_sub_title; ?></td>
                    <td><?php echo $module->module_desc; ?></td>
                    <td><?php echo $module->preset; ?></td>
                </tr>
            <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="col col-lg-5">
    <div class="card">
        <div class="card-header">
            <strong>Task Submission</strong>
        </div>
        <div class="card-body">
            <table id="requirement_table" class="table table-hover">
                <tbody>
                <form action="" method="post">
                    <div class="card-body card-block">
                        <div class="has-success form-group">
                            <label for="submission_title" class=" form-control-label">Title</label>
                            <input autocomplete="off" type="text" id="submission_title" name="submission_title" class="form-control-success form-control">
                        </div>
                        <div class="form-group">
                            <label for="submission_remarks">Remarks</label>
                            <textarea name="submission_remarks" class="form-control" id="submission_remarks" rows="2"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="submission_file" class=" form-control-label">File link</label>
                            <input autocomplete="off" type="text" id="submission_file" name="submission_file" class="form-control-success form-control">
                        </div>
                        <!-- <div class="custom-file">
                            <input type="file" class="custom-file-input" id="validatedCustomFile" required>
                            <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                        </div> -->
                        <input class="btn btn-success" type="submit" name="submit_files" value="Submit files">
                    </div>
                </form>
                </tbody>
             </table>
        </div>
    </div>
</div>

<div class="col col-lg-7">
    <div class="card">
        <div class="card-header">
            <strong>Submitted datas</strong>
        </div>
        <div class="card-body">
            <table id="requirement_table" class="table table-hover">
                <thead>
                    <th>Title</th>
                    <th>Link</th>
                    <th>Remarks</th >
                </thead>
                <tbody>
                <?php foreach($submission_data as $submission): ?>
                <tr>
                    <td><?php echo $submission->title; ?></td>
                    <td><a target="_blank" href="<?php echo $submission->link; ?>"><?php echo $submission->link; ?></a></td>
                    <td><?php echo $submission->remarks; ?></td>
                </tr>
                <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="col col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong>Time tracking</strong>
        </div>
        <div class="card-body">
            <label id="start_time">Start time</label><br>
            <button onclick="mytimer(this)" type="button" class="start btn btn-success btn-circle">
                <i class="fa fa-play"></i>
            </button>
            <label id="timer_label" style="padding-left:5em;">10:00:00</label>
        </div>
    </div>
</div>
<script>
function mytimer(val)
{
    if($("#start_time").text() == "Start time") {
            $("#start_time").text("Stop time");
            $('.start').removeClass('btn-success');
            $('.start').addClass('btn-danger');
            $('.start').html('<i class="fa fa-stop"></i>')
            timer();
        }
        else {
            $("#start_time").text("Start time");
            $('.start').removeClass('btn-danger');
            $('.start').addClass('btn-success');
            $('.start').html('<i class="fa fa-play"></i>')
        }
}
</script>

<?php } ?>