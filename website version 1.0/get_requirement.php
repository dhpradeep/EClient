<?php
if (!defined('IN_APP')) {
    //it means it can direct call by url.
    Redirect::to('dashboard.php');
}

if(Input::get('add_requirement'))
{
    $validate = new Validate();
    $validation = $validate->check($_POST, array(
        'module_title' => array(
            'name' => 'module_title',
            'required' => true,
            'min' => 2,
            'max' => 100
        ),
        'module_subtitle' => array(
            'name' => 'module_subtitle',
            'required' => true,
            'min' => 2,
            'max' => 200
        ),
        'module_desc' => array(
            'name' => 'module_desc',
            'required' => true,
            'min' => 2,
            'max' => 1000
        ),
        'assign_to' => array(
            'name' => 'email',
            'required' => true,
            'min' => 2,
            'max' => 40
        )
    ));
    if ($validate->passed()){ 
        $user = new User();
        try {  
            $mailer = new Mailer();
            //send mail to client with their module description.
            $projectID = Session::get('current_project');
            $module_title = Input::get('module_title');
            $assign_to = Input::get('assign_to');
            $res = $mailer->sendModuleMail($projectID,$module_title,$assign_to); 
            if($res)
            {
                $user->create('project_module',array(
                    'pID' => Session::get('current_project'),
                    'module_title' => Input::get('module_title'), 
                    'module_sub_title' => Input::get('module_subtitle'),
                    'module_desc' => Input::get('module_desc'),
                    'assign_to' => Input::get('assign_to'), 
                    'preset' => 'to_do'
                ));
            }
        }catch(Exception $e) {
            echo 'Error on assigning module.';
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

$project_module = new Data();
$project_module = $project_module->getdata('project_module',array('pID','=', Session::get('current_project')));
$project_module = $project_module->_results;
$x = 1;
?>

<div class="col-sm-3">
    <div class="tab-pane fade show active" id="nav-requirement" role="tabpanel" aria-labelledby="nav-requirement-tab">
        <div class="nav flex-column nav-tabs" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="nav-link disabled" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home"
                aria-selected="true">Project Details:</a>
            <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home"
                aria-selected="true">Add modules</a>
             <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile"
                aria-selected="false">View modules</a>
        </div>
    </div>
</div>  
<div class="col-sm-9">
    <div class="tab-content" id="v-pills-tabContent">
        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
            <div class="card">
                <div class="card-header">
                    <span>Write your requirement here.</span>
                </div>
                <div class="card-body">
                    <table id="requirement_table" class="table table-hover">
                        <tbody>
                        <form action="" method="post">
                                <div class="card-body card-block">
                                    <div class="has-success form-group">
                                        <label for="module_title" class=" form-control-label">Module Title</label>
                                        <input type="text" id="module_title" name="module_title" class="form-control-success form-control">
                                    </div>
                                    <div class="has-success form-group">
                                        <label for="module_subtitle" class=" form-control-label">Module subtitle</label>
                                        <input type="text" id="module_subtitle" name="module_subtitle" class="form-control-success form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="module_desc">Module Description</label>
                                        <textarea name="module_desc" class="form-control" id="module_desc" rows="3"></textarea>
                                    </div>
                                    <div class="form-group has-success">
                                        <label for="assign_to" class="form-control-label">Assign to</label>
                                        <select name="assign_to" class="custom-select mb-2 mr-sm-2 mb-sm-0" id="assign_to">
                                            <?php foreach($project_handler as $value): ?>
                                            <option value="<?php echo $value->username; ?>"><?php echo $value->username; ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <input class="btn btn-success" type="submit" name="add_requirement" value="Assign module">
                                </div>
                        </form>
                        </tbody> 
                    </table>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
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
                            <th scope="col">Module Desc</th>
                            <th scope="col">Assign to</th>
                            <th scope="col">Details</th>
                        </thead>
                        <tbody>
                            <?php foreach($project_module as $module): ?>
                            <tr>
                            <td><?php echo $x; ?></td>
                            <td><?php echo $module->module_title; ?></td>
                            <td><?php echo $module->module_sub_title; ?></td>
                            <td><?php echo $module->assign_to; ?></td>
                            <td>
                                <a href="individual_module.php?id=<?php echo $module->ID ?>">
                                    <button type="button" class="btn btn-sm btn-success">Details</button>
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
    </div>
</div>
        </div>
    </div>
</div>

<script>
$('#add_requirement').on('click', function(){
    //$('#requirement > tbody:last-child').append("<tr><div class='form-group col-lg-8'><input placeholder='title' type='text' class='form-control' /></div><div class='form-group col-lg-8'><input placeholder='description' type='text' class='form-control' /></div></tr>')";
    $('table#requirement_table > tbody:last-child').append('h1h2');
});

function myFunction() {
    $('#requirement_table > tbody:last-child').append('<tr>...</tr><tr>...</tr>');
}
</script>