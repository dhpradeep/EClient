<?php define('IN_APP', true); ?>
<?php include_once "includes/header.php" ?>
<?php
if(!Session::exists('username'))
{
    Redirect::to('index.php'); 
}  

$data = new Data(); 
if(Session::exists('current_company'))
{
    if(!Session::exists('current_client'))
    {
        $query = "SELECT * FROM users WHERE related_company=? AND NOT ID=?";
        $params = array(Session::get('current_company'),Session::get('user_id'));
        $datas = $data->getmultipledata($query,$params);
        //$datas = $data->getdata('users',array('related_company', '=', Session::get('current_company')));
    }else{
        //selete company members who has engeged on this project
        // for example:
        // select company_members from users where role=company and related_company = current_company and 
        // users.username in project_hander.username and project_handler.project_id = current_client
        $query = "SELECT users.ID,users.user_account_status,users.fName,users.lName,users.username,users.phone FROM users INNER JOIN project_handler ON users.username = project_handler.username WHERE project_handler.project_id = ?";
        $datas = $data->getmultipledata($query, array(Session::get('current_client')));
    }

}else{
    $query1 = "SELECT * FROM users WHERE role=? AND NOT ID=?";
    $params1 = array(Session::get('role'),Session::get('user_id'));
    $datas = $data->getmultipledata($query1,$params1);
    //$datas = $data->getdata('users',array('role', '=', Session::get('role'))); 
}
$data = $datas->_results;

$admin = new Data(); 
if(Session::get('role') == 'admin')
{
    $admins = $admin->getdata('users',array('role', '=', 'company'));
    $user = "company";

}else if(Session::get('role') == 'company'){

    $admins = $admin->getdata('users',array('role', '=', 'admin')); 
    $user = "admin";

}else if(Session::get('role') == 'client'){
    $admins = $admin->getdata('users',array('related_project', '=', Session::get('current_client')));  
    $user = "client";
}
$admin = $admins->_results;

// echo '<pre>';
// print_r($_SESSION);
// echo '</pre>';
?>

        <div class="col col-lg-3"></div>
        <div class="col col-lg-6 text-right bg-gray shaking" id="notification1">
        
        </div>

        <div class="content mt-3">

            <div class="row">
            <!-- add custom data here -->
            <div class="col-lg-7">
                <div class="card">
                    <div class="card-header">
                        <?php if(Session::get('role') == 'company'): ?>
                        <strong class="card-title">Company and Client Users</strong>
                        <?php elseif(Session::get('role') == 'client'): ?>
                        <strong class="card-title">Company Users</strong>
                        <?php else: ?>
                        <strong class="card-title">Admin Users</strong>
                       <?php endif ?>
                    </div>
                    <div class="card-body" style="height:240px;overflow-y: scroll;">
                        <table id="table1" class="table table-hover">
                            <thead> 
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Chat</th>
                                </tr>
                            </thead> 
                            <tbody> 
                            <?php foreach($data as $value): ?>
                                <tr name="<?php echo $value->username ?>">
                                    <?php if((Session::get('user_id') != $value->ID) && $value->user_account_status == 'active'): ?>
                                    <th scope="row"><div class="online"></div></th>
                                    <?php else: ?>
                                    <th scope="row"><div class="offline"></div></th>
                                    <?php endif ?>
                                    <td><?php echo $value->fName . " " . $value->lName; ?></td>
                                    <td><?php echo $value->username; ?></td>
                                    <td><?php echo $value->phone; ?></td>
                                        <td>
                                        <button class="btn btn-success btn-sm" onclick="chat_with_him(this)" name="<?php echo $value->ID ?>">
                                            <i class="fa fa-comments"></i>
                                        </button>
                                        <?php if((Session::get('user_id') != $value->ID) && $value->user_account_status == 'active'): ?>
                                        <button class="btn btn-success btn-sm" onclick="submitForm(this)" name="<?php echo $value->ID ?>">
                                            <i class="fa fa-video-camera"></i>
                                        </button>
                                        <?php endif ?>
                                        </td>
                                </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="card" id="chat_box" style="visibility: hidden;">
                    <div class="card-header" style="background:#0bba28;color:white;">
                        <div class="col-lg-11"><strong id="c1_username" class="card-title">User name</strong></div> 
                        <span class="col-xs-offset-1">
                            <!-- <small>
                                <a href="#" class="text-success">
                                <i class="fa fa-phone fa-2x"></i></a>
                            </small>&nbsp;
                            <small id="c1_video_call">
                                <a href="#" class="text-success">
                                <i class="fa fa-video-camera fa-2x"></i></a>
                            </small>
                        </span> -->
                        <small>
                            <button id="chat_box_close" class="btn btn-sm btn-danger text-right text-white"><i class="fa fa-close"></i></a>
                        </small>
                    </div>
                    <div id="c1_chat_message" class="card-body" style="height: 180px;overflow-y: scroll;margin-bottom:5px;">
                        
                    </div>
                    <div class="input-group" style="margin-top: 10px;">
                        <input id="written_message" type="text" placeholder="Message here" class="form-control">
                        <div class="input-group-btn">
                            <button id="send_message" onclick="send_message(this)" class="btn btn-primary">Send</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div class="col-lg-7">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title"><?php echo $user; ?> Users</strong>
                    </div>
                    <div class="card-body" style="height:240px;overflow-y: scroll;">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody> 
                            <?php foreach($admin as $value): ?>
                                <tr>
                                    <?php if((Session::get('user_id') != $value->ID) && $value->user_account_status == 'active'): ?>
                                    <th scope="row"><div class="online"></div></th>
                                    <?php else: ?>
                                    <th scope="row"><div class="offline"></div></th>
                                    <?php endif ?>
                                    <td><?php echo $value->fName . " " . $value->lName; ?></td>
                                    <td><?php echo $value->username; ?></td>
                                    <td><?php echo $value->phone; ?></td>
                                        <td>
                                            <button id="chat_with_him1" class="btn btn-success btn-sm" onclick="chat_with_him(this)" name="<?php echo $value->ID ?>">
                                                <i class="fa fa-comments"></i>
                                            </button>
                                        <?php if($value->user_account_status == 'active' && $value->ID != Session::get('user_id')): ?>
                                            <button class="btn btn-success btn-sm" onclick="submitform(this)" name="<?php echo $value->ID ?>">
                                                <i class="fa fa-video-camera"></i>
                                            </button>
                                        <?php endif ?>
                                        </td>    
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
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
    <!-- <script src="assets/js/main.js"></script> -->
    <script src="assets/js/jasny-bootstrap.min.js"></script>
    <script src="assets/js/lib/chart-js/Chart.bundle.js"></script>
    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/widgets.js"></script>

    <script src="assets/js/materialize.min.js"></script>
 
    <script>
        var noti = document.getElementById('notification1');
        var datas; 
        setInterval(function() {
            var params = "user_id_="+<?php echo $_SESSION['user_id']; ?>;
            var xhr = new XMLHttpRequest();
            xhr.open('POST','includes/getnotification.php',true);
            xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
            xhr.onload = function(){
                if(this.status == 200){
                    var data1 = this.responseText;
                    if(data1){
                        window.datas = JSON.parse(data1);
                        noti.innerHTML = `<table class='table table-hover'>
                            <tbody><tr><td>`+ datas[0].data +`&nbsp;</td><td>
                            <form onsubmit="receive('calling.php')" id="call" method="POST" action=''>
                            <button class='btn btn-success' type='submit' name='test'>receive call  <i class='fa fa-phone'></i></button>
                            <button class='btn btn-danger btn-small'>X</i></button>
                            </form>
                            </td></tr></tbody></table>`;
                        }
                    }
            }
            xhr.send(params);
    }, 1000);

        function submitForm(val){
            var id = val.name;
            var params = "id="+id;
            var xhr = new XMLHttpRequest();
            xhr.open('POST','includes/setnotification.php',true);
            xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
            xhr.onload = function(){
                if(this.status == 200){
                    var data = this.responseText;
                    if(data === " ")
                    {
                        alert("Error on calling..");
                        return;
                    }else{
                        popitup(data);
                    }
                }
            }
            xhr.send(params);
    }

    function popitup(data) {
        var url = 'calling.php'
		newwindow=window.open(url+"?room="+data,'name','height=600,width=1300');
		if (window.focus) {newwindow.focus()}
		return false;
    }

    function receive(url) {
		newwindow1=window.open(url+"?room="+datas[0].room+"&id="+datas[0].ID,'name','height=600,width=1300');
		if (window.focus) {newwindow1.focus()}
		return false;
    }

    setInterval(function() {
        if ($("#chat_box").css("visibility") === "visible") {
           //get_chat("<?php // echo Session::get('user_id'); ?>",receiver_id);
           update_session();
        }
    }, 1000);

    $('#chat_box_close').on('click', function(){
        $("#chat_box").css("visibility", "hidden");
    });

    function chat_with_him(user)
    {
        $('#chat_box').css('visibility', 'visible');
        $('#send_message').attr('name', user.name);
        
        $.post("ajax_data.php",{
            userId: user.name
        } ,function (data) {
            data = $.parseJSON(data);
            $.each(data, function(i, item) {
                $('#c1_username').html(item.fName + " " +item.lName);
                update_session(item.ID);
                //get_chat("<?php // echo Session::get('user_id'); ?>",item.ID);
               });
            }).fail(function(){
                console.log("error");
        });
    } 

    var data_temp ="";

    function update_session(session_id = "no_id")
    {
        $.post("ajax_data.php",{
            session_id: session_id
        } ,function (data) {
            if(data){
                if(data_temp != data){
                    $("#c1_chat_message").scrollTop(1020022);
                    $('#c1_chat_message').empty();
                    data_temp = data
                    data = $.parseJSON(data);
                    $.each(data, function(i, item) {
                        if(item.message_sender_ID == <?php echo Session::get('user_id'); ?>)
                        {
                            //my message
                            $('#c1_chat_message').append("<div class='col-lg-12'><p class='text-grey' style='float: right;'>"+item.message_body+"</p></div>");
                        }else{
                            //his message
                            $('#c1_chat_message').append("<div class='col-lg-12'><p class='text-grey'>"+item.message_body+"</p></div>");
                        }
                        console.log(item); 
                    });
                }
            }else{
                // no data
                $('#c1_chat_message').empty();
                data_temp = "";
            }
            }).fail(function(){
                console.log("error");
        });
    }
    
    function get_chat(my_id,receiver_id)
    {
        $('#c1_chat_message').empty();
        $.post("ajax_data.php",{
            my_id: my_id,
            receiver_id:receiver_id
        } ,function (data) {
            if(data){
                data = $.parseJSON(data);
                
                $.each(data, function(i, item) {
                    if(item.message_sender_ID == <?php echo Session::get('user_id'); ?>)
                    {
                        //my message
                        $('#c1_chat_message').append("<div class='col-lg-12'><p class='text-grey' style='float: right;'>"+item.message_body+"</p></div>");
                    }else{
                        //his message
                        $('#c1_chat_message').append("<div class='col-lg-12'><p class='text-grey'>"+item.message_body+"</p></div>");
                    }
                    console.log(item); 
                });
            }
                }).fail(function(){
                    console.log("error");
            });

            $("#c1_chat_message").scrollTop(1020022);
    } 

    function send_message(user){
        $('#written_message').empty(); 
        if($('#written_message').val() == '')
        {
            alert("Please type something first!");
        }
        else{
            // post message to database
            var message = $('#written_message').val();
            $.post("ajax_data.php",{
                message_body: message,
                to_id: user.name,
                by_id: <?php echo Session::get('user_id'); ?>
            } ,function (data) {
                    $('#c1_chat_message').append("<div class='col-lg-12'><p class='text-grey' style='float: right;'>"+message+"</p></div>");
            });   
        }
    }
    </script>
</body>
</html>