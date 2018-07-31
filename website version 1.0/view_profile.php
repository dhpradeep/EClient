<?php
define('IN_APP', true);

include_once 'core/init.php';
include_once 'includes/header.php';

if(Input::get('username'))
{
    $user_details = new Data();
    $user_details = $user_details->getdata('users',array('username', '=', Input::get('username')));
    $user_details = $user_details->_results;
    $x = 1;
}else{
    echo "<center><a class='text-white' href='dashboard.php'><button class='btn btn-lg btn-success'><i class='fa fa-arrow-left'></i> Back to home</button></a><center>";
    exit();
}
?>

<div class="content mt-3">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">User Details</strong>
            </div>
            <div class="card-body">
            <?php if(Input::get('username')): ?>
                <table class="table table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Field Name</th>
                            <th scope="col">Data</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($user_details as $value): ?>
                        <tr>
                            <td>Full name:</td>
                            <td><?php echo $value->fName . ' ' . $value->lName; ?></td>
                        </tr>
                        <tr>
                            <td>Username:</td>
                            <td><?php echo $value->username; ?></td>
                        </tr>
                        <tr>
                            <td>Email:</td>
                            <td><?php echo $value->email; ?></td>
                        </tr>
                        <tr>
                            <td>Phone:</td>
                            <td><?php echo $value->phone; ?></td>
                        </tr>
                    <?php $x++; ?>
                    <?php endforeach ?>
                    </tbody>
                </table>
            <?php endif ?>
            </div>
        </div>
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