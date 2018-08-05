<?php define('IN_APP', true); ?>
<?php include_once 'includes/header.php' ?>
<?php

$project = new Data();
$query = "SELECT * FROM project WHERE company_id=? AND progress=?";
$param = array(Session::get('current_company'),'done');
$project = $project->getmultipledata($query,$param);
$project = $project->_results;
$x = 1;

$done_project = new Data();
$query = "SELECT * FROM project_log WHERE company_id=?";
$param = array(Session::get('current_company'));
$done_project = $done_project->getmultipledata($query,$param);
$done_project = $done_project->_results;
$y = 1;

?>
<div class="col col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong>Pending project</strong>
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                <th scope="col">#</th>
                    <th scope="col">Project Name</th>
                    <th scope="col">Project Leader</th>
                    <th scope="col">Progress</th>
                    <th scope="col"></th>
                </thead>
                <tbody>
                <?php foreach($project as $value): ?>
                    <tr>
                        <th scope="row"><?php echo $x; ?></th>
                        <td><?php echo $value->project_name; ?></td>
                        <td><?php echo $value->project_main_handler; ?></td>
                    <?php
                        $module_names = new Data();
                        $module_names = $module_names->getdata('project_module',array('pID', '=',$value->ID));
                        $module_names = $module_names->_results;
                        $done = $progress = $count = $submission = 0;
                        //loop to every single project module to find out how much project has complete
                        foreach($module_names as $name){
                            $progress = ($name->preset == 'progress' ? $progress +=1 : $progress += 0);
                            $done = ($name->preset == 'done' ? $done +=1 : $done += 0);
                            $count += 1;   
                        }
                        $submission = ($count != 0 ? (50*$progress + 100*$done)/$count : 0);
                    ?>
                        <td><?php echo (int)$submission; ?>% complete</td>
                        <td>
                            <a href="requirement.php?id=<?php echo $value->ID; ?>">
                                <button type="button" class="btn btn-sm btn-success">Details</button>
                            </a>
                            <a onclick="rollBack('<?php echo $value->ID; ?>')">
                                <button type="button" class="btn btn-sm btn-dark">Roll back</button>
                            </a>  
                        </td>
                    </tr>
                <?php $x++; ?>
                <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="col col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong>Completed project</strong>
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                <th scope="col">#</th>
                    <th scope="col">Project Name</th>
                    <th scope="col">Project Leader</th>
                    <th scope="col">Project start date</th>
                    <th scope="col">Project end date</th>
                </thead>
                <tbody>
                <?php foreach($done_project as $value): ?>
                    <tr>
                        <th scope="row"><?php echo $y; ?></th>
                        <td><?php echo $value->project_name; ?></td>>
                        <td><?php echo $value->project_main_handler; ?></td>
                        <td><?php echo $value->project_start_date; ?></td>
                        <td><?php echo $value->project_end_date; ?></td>
                    </tr>
                <?php $y++; ?>
                <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div> 
</div>


<script src="assets/js/vendor/jquery-2.1.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
<script src="assets/js/plugins.js"></script>
<script src="assets/js/main.js"></script>

<script>
function rollBack(id)
{
    $.post("ajax_data.php",{
        rollback_id: id
    } ,function (data) {
        console.log(data)
        //location.reload(); 
        window.location.href = "dashboard.php";
    }).fail(function(){
        console.log("error");
    });
}
</script>