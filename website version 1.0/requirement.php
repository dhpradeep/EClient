<?php
define('IN_APP', true);

session_start();
if($_SESSION['role'] != 'company')
{
    header('Location: dashboard.php');
}
?>
<?php include_once "includes/header.php" ?>
<?php
if(Session::get('role') != 'company'){
    echo "<center><a class='text-white' href='dashboard.php'><button class='btn btn-lg btn-success'><i class='fa fa-arrow-left'></i> Back to home</button></a><center>";
    exit();
}


if (Input::get('add_client')) 
{
    $validate = new Validate();
    $validation = $validate->check($_POST, array(
        'fName' => array(
            'name' => 'fName',
            'required' => true,
            'min' => 2,
            'max' => 50
        ),
        'lName' => array(
            'name' => 'lName',
            'required' => true,
            'min' => 2,
            'max' => 50
        ),
        'username' => array(
            'name' => 'username',
            'required' => true,
            'min' => 2,
            'max' => 20,
            'unique' => 'users'
        ),
        'email' => array(
            'name' => 'email',
            'required' => true,
            'min' => 2,
            'max' => 40
        ),
        'password' => array(
            'name' => 'password',
            'required' => true,
            'min' => 2,
            'max' => 20
        ), 
    ));

    if ($validate->passed()){ 
        $user = new User(); 
        $related_company = Session::get('current_company');
        $related_project = Input::get("id");

        try {  
            $user->create('users',array(
                'fName' => Input::get('fName'), 
                'lName' => Input::get('lName'),
                'username' => Input::get('username'),
                'email' => Input::get('email'),
                'password' => Input::get('password'),
                'role' => 'client',
                'related_company' => $related_company,
                'related_project' => $related_project
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
 
if(Session::get('current_company'))
{
    $client = new Data();
    $client = $client->getdata('users',array('related_project', '=', Input::get("id")));
    $client = $client->_results;
    $x = 1;

    $company_member = new Data(); 
    $query = "SELECT username FROM users WHERE role=? AND related_company=?";
    $params = array('company',Session::get('current_company'));
    $company_member = $company_member->getmultipledata($query,$params);
    $company_member = $company_member->_results;
}
  
if(Input::get('id'))
{
    $data = new Data();
    $query = "SELECT * FROM project WHERE ID=? AND company_id=?";
    $params = array(Input::get('id'),Session::get('current_company'));
    $check_project = $data->getmultipledata($query, $params);        

    if($check_project->count() != 1){
        echo "<center><button class='btn btn-lg btn-success'><i class='fa fa-arrow-left'></i> <a class='text-white' href='dashboard.php'>Back to home</a></button><center>";
        exit();
    }
    Session::put('current_project', Input::get('id'));


    $project_handler = new Data(); 
    $project_handler = $project_handler->getdata('project_handler',array('project_id', '=', Session::get('current_project')));
    $project_handler = $project_handler->_results;

    $current_project = new Data();
    $current_project = $current_project->getdata('project',array('ID','=', Session::get('current_project')));
    $current_project = $current_project->_results;

}else{
    echo "<center><button class='btn btn-lg btn-success'><i class='fa fa-arrow-left'></i> <a class='text-white' href='dashboard.php'>Back to home</a></button><center>";
    exit();
}
?>

    <script src="assets/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/main.js"></script>

    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/lib/peitychart/jquery.peity.min.js"></script>
    <script src="assets/js/lib/peitychart/peitychart.init.js"></script>


    <script src="assets/js/lib/chart-js/Chart.bundle.js"></script>
    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/widgets.js"></script>

    <script src="assets/js/jquery-1.10.2.min.js"></script>
    <script src="assets/js/jquery.minicolors.min.js"></script>
 
<div class="content mt-3">

    <!-- add custom data here -->
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="custom-tab">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-resource-tab" data-toggle="tab" href="#nav-resource" role="tab" aria-controls="nav-resource"
                                aria-selected="false">Project details</a>
                            <a class="nav-item nav-link" id="nav-requirement-tab" data-toggle="tab" href="#nav-requirement" role="tab" aria-controls="nav-requirement"
                                aria-selected="true">Client Requirement</a>
                            <a class="nav-item nav-link" id="nav-design-tab" data-toggle="tab" href="#nav-design" role="tab" aria-controls="nav-design"
                                aria-selected="false">System Design</a>
                            <a class="nav-item nav-link" id="nav-activity-tab" data-toggle="tab" href="#nav-activity" role="tab" aria-controls="nav-activity"
                                aria-selected="false">Time Tracking</a>
                            <a class="nav-item nav-link" id="nav-setting-tab" data-toggle="tab" href="#nav-setting" role="tab" aria-controls="nav-setting"
                                aria-selected="false">Setting</a>
                        </div>
                    </nav>

                    <div class="tab-content pl-3 pt-2" id="nav-tabContent">

                        <div class="tab-pane fade show active" id="nav-resource" role="tabpanel" aria-labelledby="nav-resource-tab">
                             <div class="col col-lg-12">
                                 <div class="card">
                                    <div class="card-header">
                                        <div class="card-title"><strong>Project Information:</strong></div>
                                    </div>
                                     <div class="card-body card-block">
                                        <?php foreach($current_project as $project): ?>
                                            <div class="row">
                                            <div class="form-group col-lg-4">
                                                <label for="projectName" class="form-control-label">Project Name</label>
                                                <input disabled value="<?php echo $project->project_name; ?>" id="projectName" type='text' class="form-control" />
                                            </div>
                                            <div class="form-group col-lg-4">
                                                <label for="dateTime" class="form-control-label">Project start date</label>
                                                <input disabled value="<?php echo $project->project_start_date; ?>" id="dateTime" name="dateTime" type='date' class="form-control" />
                                            </div>
                                            <div class="form-group col-lg-4">
                                                <label for="dateTime1" class="form-control-label">Project End date</label>
                                                <input disabled value="<?php echo $project->project_end_date; ?>" id="dateTime1" type='date' class="form-control" />
                                            </div>
                                            <div class="form-group col-lg-4">
                                                <label for="main_handler" class="form-control-label">Project Main handler</label>
                                                <input disabled value="<?php echo $project->project_main_handler; ?>" id="main_handler" type='text' class="form-control" />
                                            </div>
                                            <div class="form-group col-lg-4">
                                                <label for="select_admin" class="form-control-label">Choose Project admin</label>
                                                <select class="custom-select mb-2 mr-sm-2 mb-sm-0" id="select_admin">
                                                        <option selected>Choose</option>
                                                        <?php foreach($project_handler as $value): ?>
                                                            <option value="<?php echo $value->username; ?>"><?php echo $value->username; ?></option>
                                                        <?php endforeach ?>
                                                </select>
                                            </div>
                                            </div>
                                        <?php endforeach ?>
                                     </div>
                                 </div>
                                 <div class="card">
                                    <div class="card-header">
                                        <div class="card-title"><strong>Engaged developers</strong></div>
                                    </div>
                                   
                                     <div class="card-body card-block">
                                        <div class="col col-lg-6">                                    
                                                    <select class="col col-lg-8 custom-select mb-2 mr-sm-2 mb-sm-0" id="choose_option">
                                                        <!-- <option selected>Choose...</option>     -->
                                                        <?php foreach($company_member as $value): ?>
                                                            <option value="<?php echo $value->username; ?>"><?php echo $value->username; ?></option>
                                                        <?php endforeach ?>
                                                    </select><br><br>
                                                    <input placeholder="project role" class="col col-lg-8 form-control" type="text" name="user_role" id="user_role" /><br>
                                                <button onclick="add_developer()" type="submit" class="btn btn-primary">Add</button> 
                                         </div>  

                                         <script>

                                        $('#select_admin').on('change', function(){
                                            project_handler(this.value);
                                        });
                                        
                                        function project_handler(username)
                                        {
                                            $.post("ajax_data.php",{
                                                project_handler: username 
                                                },function (data) {
                                                    //console.log(data);
                                                }).fail(function(){
                                                    console.log("error");
                                                });
                                            alert("Project admin change to "+ username);
                                            location.reload();
                                        } 

                                         function add_developer(){
                                            var option_val = document.getElementById('choose_option').value;
                                            var user_role = document.getElementById('user_role').value;
                                            
                                            if(user_role == '')
                                            {
                                                alert("Please type role.");
                                            }else{
                                                $.post("ajax_data.php",{
                                                    user_name: option_val,
                                                    user_role: user_role
                                                    },function (data) {
                                                        //console.log(data);
                                                    }).fail(function(){
                                                        console.log("error");
                                                    });
                                                    load_table()
                                                }
                                            }

                                        var datass = document.getElementById('datass');
                                        
                                        function delete_id(id)
                                        {
                                            $.post("ajax_data.php",{
                                                    delete_id: id
                                                } ,function (data) {
                                                    console.log(data)
                                                }).fail(function(){
                                                    console.log("error");
                                            });
                                            load_table();
                                        }

                                        function load_table()
                                        { 
                                        $('#myTable > tbody').empty();
                                         $.post("ajax_data.php",{
                                                    user_id: <?php echo Session::get('current_project') ?>
                                                } ,function (data) {
                                                    data = $.parseJSON(data);
                                                    $.each(data, function(i, item) {
                                                       //console.log(item);
                                                       $('#myTable > tbody:last-child').append("<tr><td>"+item.username+"</td><td>"+item.role+"</td><td><a onclick=delete_id('"+item.id+"')><button type='button' class='btn btn-sm btn-danger'>Remove</button></a></td></tr>");
                                                    });
                                                }).fail(function(){
                                                    console.log("error");
                                            });
                                        }
                                        
                                         </script>
                                        <div class="col col-lg-6">
                                            <table id="myTable" class="table table-hover">
                                            <thead class="thead-dark">
                                                <tr>
                                                <th scope="col">Username</th>
                                                <th scope="col">Role</th>
                                                <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- later on data came here from ajax -->
                                            </tbody>
                                            </table>
                                        </div>
                                     </div>
                                 </div>
                             </div>
                        </div> 

                        <div class="tab-pane fade" id="nav-requirement" role="tabpanel" aria-labelledby="nav-requirement-tab">
                            <?php include_once 'get_requirement.php' ?>
                        </div>

                        <div class="tab-pane fade" id="nav-design" role="tabpanel" aria-labelledby="nav-design-tab">
                            <?php include_once 'get_design.php' ?>
                        </div>

                        <div class="tab-pane fade" id="nav-activity" role="tabpanel" aria-labelledby="nav-activity-tab">
                            <?php include_once 'time_tracking.php' ?>
                        </div>

                        <div class="tab-pane fade" id="nav-setting" role="tabpanel" aria-labelledby="nav-setting-tab">
                            <div class="col col-lg-6" style="border: 1px solid #ccc;">
                                <h4>Add client</h4>
                                <form action="" method="POST">
                                    <div class="form-group col-lg-6">
                                        <label for="fName">First name</label>
                                        <input type="text" class="form-control" name="fName" id="fName">
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label for="lName">Last name</label>
                                        <input type="text" class="form-control" name="lName" id="lName">
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label for="username">User name</label>
                                        <input type="text" class="form-control" name="username" id="username">
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" name="email" id="email">
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label for="passoword">Password</label>
                                        <input type="password" class="form-control" name="password" id="password">
                                    </div>

                                    <div class="form-group col-lg-12">
                                    <input class="btn btn-success" type="submit" name="add_client" value="Add client">
                                        <!-- <button type="submit" name="add_client" class="btn btn-success">Add client</button> -->
                                    </div><br><br>
                                </form>
                            </div>

                            <div class="col col-lg-6">
                                 <div class="card">
                                    <div class="card-body">
                                        <table class="table table-hover">
                                            <thead class="thead-dark">
                                                <tr>
                                                <th scope="col">Name</th>
                                                <th scope="col">Username</th>
                                                <th scope="col">Email</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach($client as $value): ?>
                                            <tr>
                                                <td><?php echo $value->fName . " " . $value->lName; ?></td>
                                                <td><?php echo $value->username; ?></td>
                                                <td><?php echo $value->email; ?></td>
                                            </tr> 
                                            <?php endforeach ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="col col-lg-12" style="margin-top:20px;"><hr>
                                <div class="col col-lg-6">
                                    <button type="button" class="btn btn-danger">Delete Project</button>
                                </div>
                                <div class="col col-lg-6">
                                        It means, If you can delete project then this project never be recover. There is no any other options to recover. So think again before delete.
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


        </div>

    </div>
    <!-- .animated -->
</div>
<!-- .content -->
</div>
</div>
</body>
</html>