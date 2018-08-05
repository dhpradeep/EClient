<?php 
define('IN_APP', true);

include_once 'includes/header.php' ?>
<?php
$data = new Data(); 
if(Session::exists('current_company'))
{ 
    if(!Session::exists('current_client')) 
    {
        $query = "SELECT * FROM users WHERE role=? AND related_company=?";
        $values = array(Session::get('role'),Session::get('current_company'));
        $datas = $data->getmultipledata($query,$values);
        //$datas = $data->getdata('users',array('related_company', '=', Session::get('current_company')));
    }else{
        $datas = $data->getdata('users',array('related_project', '=', Session::get('current_client')));
    }
}else{
    $datas = $data->getdata('users',array('role', '=', Session::get('role'))); 
}
$data = $datas->_results;

$x = 1; 

//mail to his/her email for sending his username and passsword.

#mail("dhpradeep25@gmail.com","My subject","This is testing email service.");

?>

        <div class="card-body pull-right">
            <a href="add_members.php">
                <button class="btn btn-success btn-sm">Add members</button>
            </a>
        </div>

        <div class="content mt-3">
        <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Members lists</strong>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                          <thead class="thead-dark">
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Name</th>
                              <th scope="col">Username</th>
                              <th scope="col">Email</th>
                              <th scope="col">Phone</th>
                              <th scope="col">Status</th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php foreach($data as $value): ?>
                            <tr>
                              <th scope="row"><?php echo $x; ?></th>
                              <td><?php echo $value->fName . " " . $value->lName; ?></td>
                              <td><?php echo $value->username; ?></td>
                              <td><?php echo $value->email; ?></td>
                              <td><?php echo $value->phone; ?></td>
                              <td><?php echo $value->user_account_status; ?></td>
                            </tr>
                            <?php $x++; ?>
                            <?php endforeach ?>
                          </tbody>
                        </table>

                    </div>
                </div>
            </div>
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
   
</body>
</html>
