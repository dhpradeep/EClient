<?php
define('IN_APP', true);
define('IN_APP2', true);

include_once "includes/header.php";

if(Session::get('role') == 'company')
{
    $project = new Data();
    $project = $project->getdata('project',array('company_id', '=', Session::get('current_company')));
    $project = $project->_results;
    $x = 1;

    // $developers = new Data();
    // $developers = $developers->getdata('project_handler',array('company_id', '=', Session::get('current_company')));
    // $developers = $developers->_results;
    // $y = 1;  
?>
 
<div class="content mt-3">

    <div class="card-body pull-right">
        <a href="add_project.php">
            <button class="btn btn-success btn-sm">Add project</button>
        </a>
    </div>

    <!-- this is col -->
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">

                <!-- another table -->
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Current Project Lists</strong>
                        </div>
                        <div class="card-body">
                            <div class="col-sm-12">
                                    <table id="developer" class="table table-hover">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Project Name</th>
                                                    <th scope="col">Project Leader</th>
                                                    <th scope="col">Progress</th>
                                                    <th scope="col"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach($project as $value): ?>
                                                <tr name="<?php echo $value->ID ?>">
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

                <!-- circle here -->
                <!-- <div class="col-lg-4">
                    <p class="data-attributes">
                        <span data-peity='{ "fill": ["#13DAFE", "red"],    "innerRadius": 20, "radius": 40 }'>4/7</span>
                    </p>
                </div> -->

                <!-- another table -->
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Engaged developer</strong>
                        </div>
                        <div class="card-body">
                            <div class="col-sm-10">
                                    <table id="engaged_developer" class="table table-hover">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Username</th>
                                                    <th scope="col">Role</th>
                                                    <th scope="col"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                    </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- modules table -->
                <div class="col col-lg-4"></div>
                <!-- <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Modules</strong>
                        </div>
                        <div class="card-body" style="height:240px;overflow-y: scroll;">
                            <table id="individual_module" class="table table-sm table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">First</th>
                                        <th scope="col">Last</th>
                                        <th scope="col">Handle</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> -->

                <div class="col-xl-3 col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="stat-widget-one">
                                <div class="stat-icon dib">
                                    <i class="ti-layout-grid2 text-warning border-warning"></i>
                                </div>
                                <div class="stat-content dib">
                                    <div class="stat-text">Total Projects</div>
                                    <div class="stat-digit"><?php echo $x-1; ?></div>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="stat-widget-one">
                                <div class="stat-icon dib">
                                    <i class="ti-layout-grid2 text-warning border-warning"></i>
                                </div>
                                <div class="stat-content dib">
                                    <div class="stat-text">Active Projects</div>
                                    <div class="stat-digit">770</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="stat-widget-one">
                                <div class="stat-icon dib">
                                    <i class="ti-layout-grid2 text-warning border-warning"></i>
                                </div>
                                <div class="stat-content dib">
                                    <div class="stat-text">Total client</div>
                                    <div class="stat-digit">770</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="stat-widget-one">
                                <div class="stat-icon dib">
                                    <i class="ti-layout-grid2 text-warning border-warning"></i>
                                </div>
                                <div class="stat-content dib">
                                    <div class="stat-text">Total employe</div>
                                    <div class="stat-digit">770</div>
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
<!-- .content -->
</div>
<!-- /#right-panel -->

<!-- Right Panel -->

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
<script src="assets/js/lib/vector-map/jquery.vmap.js"></script>
<script src="assets/js/lib/vector-map/jquery.vmap.min.js"></script>
<script src="assets/js/lib/vector-map/jquery.vmap.sampledata.js"></script>
<script src="assets/js/lib/vector-map/country/jquery.vmap.world.js"></script>
<script>
    (function ($) {
        "use strict";

        jQuery('#vmap').vectorMap({
            map: 'world_en',
            backgroundColor: null,
            color: '#ffffff',
            hoverOpacity: 0.7,
            selectedColor: '#1de9b6',
            enableZoom: true,
            showTooltip: true,
            values: sample_data,
            scaleColors: ['#1de9b6', '#03a9f5'],
            normalizeFunction: 'polynomial'
        });
    })(jQuery);
</script>
<script>
    $("#developer > tbody > tr").click(function(){
        //alert($(this).attr('name'));
        $('#engaged_developer > tbody').empty();
        load_table($(this).attr('name'));
    });
    function load_table(id)
    { 
        $.post("ajax_data.php",{
            project_id: id
        } ,function (data) {
            data = $.parseJSON(data);
            $.each(data, function(i, item){
                console.log(item);
                $('#engaged_developer > tbody:last-child').append("<tr name="+item.username+"><th>"+eval(parseInt(i) + 1)+"</th><td>"+item.username+"</td><td>"+item.role+"</td><td><a href='view_profile.php?username="+item.username+"')><button type='button' class='btn btn-sm btn-success'>Details</button></a></td></tr>");
            }); 
        }).fail(function(){
            console.log("error");
        });
    }

    $("#engaged_developer > tbody > tr").click(function(){
        //alert("something");
        $('#individual_module > tbody').empty();
        load_module($(this).attr('name'));
    });
    function load_module(id)
    {
        $.post("ajax_data.php",{
            project_id: id
        } ,function (data) {
            data = $.parseJSON(data);
            $.each(data, function(i, item){
                //console.log(item);
                $('#individual_module > tbody:last-child').append("<tr><th>"+eval(parseInt(i) + 1)+"</th><td>"+item.username+"</td><td>"+item.role+"</td><td><a href='view_profile.php?username="+item.username+"')><button type='button' class='btn btn-sm btn-success'>Details</button></a></td></tr>");
            }); 
        }).fail(function(){
            console.log("error");
        });
    }
</script>
</body>
</html>


<?php }else if(Session::get('role') == 'admin'){ ?>
<?php
$company_temp = new Data();
$company_temp = $company_temp->getdata('company_temp',array('1', '=', '1'));
$total_company_pending = $company_temp->count();
$company_temp = $company_temp->_results;
$x = 1; 

$company = new Data(); 
$companys = $company->getdata('company',array('1', '=', '1'));
$total_company_accpted = $companys->count();
$company = $companys->_results;
$y = 1;

$company_rejected = new Data(); 
$company_rejected = $company_rejected->getdata('company_rejected',array('1', '=', '1'));
$total_company_rejected =  $company_rejected->count();
$company_rejected = $company_rejected->_results;

?>

        <div class="content mt-3">

            <!-- another table -->
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Pending Company lists</strong>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                          <thead class="thead-dark">
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Name</th>
                              <th scope="col">Status</th>
                              <th scope="col">Action</th>
                              <th scope="col"></th>
                              <th scope="col"></th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php foreach($company_temp as $value): ?>
                            <tr>
                              <th scope="row"><?php echo $x; ?></th>
                              <td><?php echo $value->company_full_name; ?></td>
                              <td>Pending</td>
                              <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button onclick="approve(<?php echo $value->ID;  ?>)" type="button" class="btn btn-sm btn-primary">Approved</button>
                                    <button onclick="reject(<?php echo $value->ID;  ?>)" type="button" class="btn btn-sm btn-danger">Reject</button>
                                </div>
                              </td> 
                              <td>
                                <a href="company_details.php?id=<?php echo $value->ID; ?>&type=pending">
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

             <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">All Company lists</strong>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                          <thead class="thead-dark">
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Name</th>
                              <th scope="col">Status</th>
                              <th scope="col"></th>
                              <th scope="col"></th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php foreach($company as $value): ?>
                            <tr>
                              <th scope="row"><?php echo $y; ?></th>
                              <td><?php echo $value->company_full_name; ?></td>
                              <td>Accepted</td>
                              <td>
                                <a href="company_details.php?id=<?php echo $value->ID; ?>&type=accepted">
                                    <button type="button" class="btn btn-sm btn-success">Details</button>
                                </a>
                                    <button onclick="deletedata(<?php echo $value->ID;  ?>)" type="button" class="btn btn-sm btn-danger">Delete company</button>
                              </td>
                            </tr>
                            <?php $y++; ?>
                            <?php endforeach ?>
                          </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6"> 
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-one">
                            <div class="stat-icon dib"><i class="ti-layout-grid2 text-warning border-warning"></i></div>
                            <div class="stat-content dib">
                                <div class="stat-text">Total Company</div>
                                <div class="stat-digit"><?php echo $total_company_accpted ?></div> <!-- count company -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <div class="col-xl-3 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-one">
                        <div class="stat-icon dib"><i class="ti-layout-grid2 text-warning border-warning"></i></div>
                        <div class="stat-content dib">
                            <div class="stat-text">Request pending</div>
                            <div class="stat-digit"><?php echo $total_company_pending; ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-one">
                        <div class="stat-icon dib"><i class="ti-layout-grid2 text-warning border-warning"></i></div>
                        <div class="stat-content dib">
                            <div class="stat-text">Reject company</div>
                            <div class="stat-digit"><?php echo $total_company_rejected; ?></div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
        </div><!-- .content -->



        </div> <!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->

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
    <script> 
    function approve(id)
    {
        $.ajax({
            url: "accept.php?approved_id="+id,
            success: function(data){
                location.href= 'dashboard.php';
                //console.log(data);
            }
        });
    }
    function reject(id)
    {   
            $.ajax({
            url: "accept.php?reject_id="+id,
            success: function(data){
                location.href= 'dashboard.php';
            }
        });
    }
    function deletedata(id)
    {    
        $.ajax({
        url: "accept.php?delete_id="+id,
        success: function(data){
            location.href= 'dashboard.php';
            }
        });
    } 
    </script> 
</body>
</html>
  
<?php }if(Session::get('role') == 'client'){ ?>

 <!-- client dashboard -->
 <?php 

$developer_list = new Data();
$developer_list = $developer_list->getdata('project_handler',array('project_id', '=', Session::get('current_client')));
$developer_list = $developer_list->_results;
$x = 1;

$query = "SELECT project_main_handler FROM project WHERE ID=?";
$params = array(Session::get('current_client'));
$main_handler = new Data();
$main_handler = $main_handler->getmultipledata($query,$params);
$main_handler = $main_handler->_results;

$project_module = new Data();
$project_module = $project_module->getdata('project_module',array('pID','=', Session::get('current_client')));
$project_module = $project_module->_results; 
$y = 1;
?> 

<div class="content mt-3">
    <div class="row">
        <div class="col col-lg-12">
            <h4><?php echo Session::get('client_project_name'); ?> project</h4> 
        </div><br><br><br>
        <div class="col-lg-10">
            <div class="card" >
                <div class="card-header">
                    <strong class="card-title" >Engaged developer</strong>
                </div> 
                <div class="card-body" id="module">
                    <table class="table table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Username</th>
                                <th scope="col">Role</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($developer_list as $value): ?>
                            <tr> 
                                <th scope="row"><?php echo $x; ?></th>
                                <?php foreach($main_handler as $handler): ?>
                                <?php if($value->username ==$handler->project_main_handler){ ?>
                                <td><?php echo $value->username; ?> <sup>Admin</sup></td>
                                <?php }else{ ?>
                                <td><?php echo $value->username; ?></td>
                                <?php } ?>
                                <?php endforeach ?>
                                <td><?php echo $value->role; ?></td>
                                <td>
                                <a href="view_profile.php?username=<?php echo $value->username; ?>">
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
    </div><!-- /#right-panel -->
<div class="row">
<div class="col-lg-10">
            <div class="card" >
                <div class="card-header">
                    <strong class="card-title" >Project Module</strong>
                </div>
                <div class="card-body" id="module">
                    <table class="table table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Module name</th>
                                <th scope="col">Details</th>
                                <th scope="col">Preset</th>
                                <th scope="col">Assign to</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($project_module as $module): ?>
                            <tr> 
                                <td><?php echo $y; ?></td>
                                <td><?php echo $module->module_title; ?></td>
                                <td><?php echo $module->module_sub_title; ?></td>
                                <td><?php echo $module->preset; ?></td>
                                <td><?php echo $module->assign_to; ?></td>
                                <td>
                                <a href="view_profile.php?username=<?php echo $module->assign_to; ?>">
                                    <button type="button" class="btn btn-sm btn-success">Details</button>
                                </a>
                                </td>
                            </tr>
                        <?php $y++; ?>
                        <?php endforeach ?>
                    </tbody>
            </table>
        </div>
    </div>
</div>
</div>
    <!-- Right Panel -->

    <script src="assets/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/main.js"></script>


    <script src="assets/js/lib/chart-js/Chart.bundle.js"></script>
    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/widgets.js"></script>
</body>
</html>

<?php } ?>