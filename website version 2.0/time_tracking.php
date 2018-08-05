<?php

if (!defined('IN_APP')) {
    //it means it can direct call by url.
    header('Location: dashboard.php');
    exit();
}

if (session_status() == PHP_SESSION_NONE) {
    session_start();
    include_once 'core/init.php';
}
if(!Session::exists('username'))
{
    Redirect::to('index.php');
}
if(Session::get('role')!= 'company')
{
    Redirect::to('dashboard.php');
} 

$project_module = new Data();
$project_module = $project_module->getdata('project_module',array('pID','=', Session::get('current_project')));
$project_module = $project_module->_results;
$x = 1;

?> 
<div class="col-sm-12"> 
    <div class="tab-content" id="v-pills-tabContent">
        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
            <div class="card">
                
                <div class="card-header">
                    <strong>Track Indivisual module</strong>
                </div>

                <div class="card-body">
                    <table id="requirement_table" class="table table-hover table-xl">
                        <thead>
                            <th scope="col">#</th>
                            <th scope="col">Module name</th>
                            <th scope="col">Module desc</th>
                            <th scope="col">Preset</th>
                            <th scope="col">Total Time</th>
                        </thead>
                        <tbody>
                            <?php foreach($project_module as $module): ?>
                            <tr>
                            <td><?php echo $x; ?></td>
                            <td><?php echo $module->module_title; ?></td>
                            <td><?php echo $module->module_sub_title; ?></td>
                            <td>
                                <select class="custom-select mb-2 mr-sm-2 mb-sm-0" onchange="preset_change(this)">
                                    <?php if($module->preset != ''): ?>
                                        <?php if($module->preset == 'to_do'): ?>
                                            <option title="Planned but not started" name="<?php echo $module->ID ; ?>" value="to_do" selected>To do</option>
                                            <option title="Actively being working on" name="<?php echo $module->ID ; ?>" value="progress" >In progress</option>
                                            <option title="Items are completed" name="<?php echo $module->ID ; ?>" value="done">Done</option>
                                        <?php elseif($module->preset == 'progress'): ?>
                                            <option title="Planned but not started" name="<?php echo $module->ID ; ?>" value="to_do" >To do</option>
                                            <option title="Actively being working on" name="<?php echo $module->ID ; ?>" value="progress" selected>In progress</option>
                                            <option title="Items are completed" name="<?php echo $module->ID ; ?>" value="done">Done</option>
                                        <?php elseif($module->preset == 'done'): ?>
                                            <option title="Planned but not started" name="<?php echo $module->ID ; ?>" value="to_do">To do</option>
                                            <option title="Actively being working on" name="<?php echo $module->ID ; ?>" value="progress" >In progress</option>
                                            <option title="Items are completed" name="<?php echo $module->ID ; ?>" value="done" selected>Done</option>
                                        <?php endif ?>
                                    <?php else: ?>
                                        <option title="Planned but not started" name="<?php echo $module->ID ; ?>" value="to_do" selected>choose</option>
                                        <option title="Actively being working on" name="<?php echo $module->ID ; ?>" value="progress">choose 1</option>
                                        <option title="Items are completed" name="<?php echo $module->ID ; ?>" value="done">choose 2</option>
                                    <?php endif ?>
                                </select>
                            </td>
                            <td>
                                <span id="time_<?php echo $x; ?>">20:00 min</span>&nbsp;&nbsp;
                            </td>
                            </tr>
                            <?php $x++; ?>
                            <?php endforeach ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
   function preset_change(select) {
    var selectedOption = select.options[select.selectedIndex];
    var value = selectedOption.getAttribute('value');
    var name = selectedOption.getAttribute('name');
    change_preset(value,name);
   }
   function change_preset(name,value)
   {                
    $.post("ajax_data.php",{
        project_module_id: value,
        preset: name 
    } ,function (data) {
        //console.log(data) 
    }).fail(function(){
        console.log("error");
    });
   }
</script>
