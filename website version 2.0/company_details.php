<?php define('IN_APP', true); ?>
<?php include_once 'includes/header.php' ?>
<?php
if(!Session::exists('username'))
{
    Redirect::to('index.php'); 
}
if(Session::get('role') != 'admin'){
    echo "<center><button class='btn btn-lg btn-success'><i class='fa fa-arrow-left'></i> <a class='text-white' href='dashboard.php'>Back to home</a></button><center>";
    exit();
}

$data = new Data();
$datas = $data->getdata('company_temp',array('ID', '=', Input::get('id')));
$data = $datas->_results;

if(Input::get("type"))
{
    if(Input::get("type") === 'accepted')
    {
        $data = new Data();
        $datas = $data->getdata('company',array('ID', '=', Input::get('id')));
        $data = $datas->_results;

        $company_project = new Data();
        $company_project = $company_project->getdata('project',array('company_id', '=', Input::get('id')));
        $company_project = $company_project->_results;
        $x = 1;
        
    }
    else if(Input::get("type") === 'pending')
    {
    $data = new Data();
    $datas = $data->getdata('company_temp',array('ID', '=', Input::get('id')));
    $data = $datas->_results;
    }
}


?>
        <div class="content mt-3">
            <!--pradeep coding of company detail-->
                <div class="card-body">
                        <!-- Credit Card -->
                        <div id="pay-invoice">
                            <div class="card-body">
                                <div class="card-title">
                                    <h3 class="text-center">Company Details</h3>
                                </div>
                                <hr>
                                
                                <form action="" method="post" novalidate="novalidate">
                                    <?php foreach($data as $value): ?>
                                    <div class="form-group col-sm-4">
                                            <label for="client-name" class="control-label mb-1">Manager Name</label>
                                            <input value="<?php echo $value->fName . " " . $value->lName; ?>" disabled type="text" class="form-control">
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="company-full-name" class="control-label mb-1">Company Name</label>
                                        <input value="<?php echo $value->company_full_name; ?>" disabled type="text" class="form-control">
                                    </div>
                                    <?php if(Input::get("type") === 'pending'): ?>
                                    <div class="form-group col-sm-4">
                                        <label for="username" class="control-label mb-1">Username</label>
                                        <input value="<?php echo $value->username; ?>" disabled type="text" class="form-control">
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="phone" class="control-label mb-1">Phone</label>
                                        <input value="<?php echo $value->phone; ?>" disabled type="text" class="form-control">
                                    </div>
                                    <?php endif ?>
                                    <div class="form-group col-sm-4">
                                        <label for="company-full-name" class="control-label mb-1">Company Registration Number</label>
                                        <input value="<?php echo $value->company_registration_number; ?>" disabled type="text" class="form-control">
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="company-full-name" class="control-label mb-1">Company Email Address</label>
                                        <input value="<?php echo $value->company_email_address; ?>" disabled type="text" class="form-control">
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="company-full-name" class="control-label mb-1">Company Website <a style="color:blue;" target="_blank" href="<?php echo $value->company_website; ?>"><i class="fa fa-link"></i></a></label>
                                        <input value="<?php echo $value->company_website; ?>" disabled type="text" class="form-control">
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="company-full-name" class="control-label mb-1">Company Address</label>
                                        <input value="<?php echo $value->company_address; ?>" disabled type="text" class="form-control">
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="company-full-name" class="control-label mb-1">Company Country</label>
                                        <input value="<?php echo $value->company_country; ?>" disabled type="text" class="form-control">
                                    </div>
                                    <?php  if(Input::get("type") === 'pending'): ?>
                                    <div class="form-group col-sm-12">
                                            <button type="button"onclick="approve(<?php echo $value->ID;  ?>)" class="btn btn-sm btn-primary">Approved</button>
                                            <button   type="button" onclick="reject(<?php echo $value->ID;  ?>)" class="btn btn-sm btn-danger">Reject</button>
                                    </div>   
                                    <?php endif ?> 
                                    </div>
                                <?php endforeach ?>  
                                </form>
                            </div>
                        </div>

                </div>    

                <?php if(Input::get("type") === 'accepted'): ?>
                <div class="card-body">
                        <!-- Credit Card -->
                        <div id="pay-invoice">
                            <div class="card-body">
                                <div class="card-title">
                                    <h3 class="text-center">Company current Projects</h3>
                                </div>
                                <hr> 
                                <table class="table table-hover">
                                    <thead class="">
                                        <th scope="col">#</th>
                                        <th scope="col">Project Name</th>
                                        <th scope="col">Project Start date</th>
                                        <th scope="col">Project End date</th>
                                    </thead>
                                    <tbody>
                                
                                    <?php foreach($company_project as $value): ?>
                                            <tr>
                                                <th scope="row"><?php echo $x; ?></th>
                                                <td><?php echo $value->project_name; ?></td>
                                                <td><?php echo $value->project_start_date; ?></td>
                                                <td><?php echo $value->project_end_date; ?></td>
                                            </tr>
                                    <?php $x++; ?>
                                    <?php endforeach ?>
                                
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <?php endif ?>

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
    </script>

</body>
</html>
