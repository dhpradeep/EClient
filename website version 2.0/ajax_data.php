<?php
define('IN_APP', true);

include_once 'core/init.php';

if(Input::get('user_name') && Input::get('user_role'))
{
    $user = new User();
    try { 
        $user->create('project_handler',array(
            'project_id' => Session::get('current_project'), 
            'role' => Input::get('user_role'),
            'username' => Input::get('user_name')
        ));

        $user->create('notice', array(
            'to_whom' => Input::get('user_name'),
            'data' => 'You are in a project '. Session::get('current_project'),
            'link' => 'http://localhost/eclient/00.final%20site/requirement.php?id='.Session::get('current_project'),
            'active' => 'unread' 
        ));
    } catch(Exception $e) {
        echo '<br>';
    }
}

if(Input::get('project_handler'))
{
    $user = new User();
    try { 
        $user->update('project',array(
            'project_main_handler' => Input::get('project_handler')
        ), Session::get('current_project'));
        
        $user->create('notice', array(
            'to_whom' => Input::get('project_handler'),
            'data' => 'You are a project '. Session::get('current_project') . ' main handler',
            'link' => 'http://localhost/eclient/00.final%20site/requirement.php?id='.Session::get('current_project'),
            'active' => 'unread' 
        ));
    } catch(Exception $e) {
        echo '<br>';
    }
}

if(Input::get('username_data'))
{
    $data = new Data();
    try { 
        $query = "UPDATE notice SET active=? WHERE to_whom=?";
        $params = array('read',Session::get('username'));
        $data->getmultipledata($query,$params);

    } catch(Exception $e) {
        echo '<br>';
    }
}

if(Input::get('user_id'))
{
    $datas = new Data();
    $datas = $datas->getdata('project_handler',array('project_id', '=', Input::get('user_id')));
    $datas = $datas->_results;
    $myarr = [];
    foreach($datas as $value){
       $myarr[] =  $value;
    }
    if($myarr)
    {
        echo json_encode($myarr);
    }else{
        return null;
    }
}

if(Input::get('delete_id'))
{
    $user = new User();
    $user->delete('project_handler',Input::get('delete_id'));
}  

if(Input::get('project_id'))
{
    $datas = new Data();
    $datas = $datas->getdata('project_handler',array('project_id', '=', Input::get('project_id')));
    $datas = $datas->_results;
    $myarr = [];
    foreach($datas as $value){
       $myarr[] =  $value;
    }
    if($myarr)
    {
        echo json_encode($myarr);
    }else{
        return null;
    }
}

if(Input::get('project_module_id') && Input::get('preset'))
{
    $user = new User();
    try { 
        $user->update('project_module',array(
            'preset' => Input::get('preset')
        ), Input::get('project_module_id')); 

        // $data = new Data();
        // $query = "SELECT username FROM users WHERE role=? AND related_project=?";
        // $param = array('client',Session::get('current_project'));
        // $data = $data->getmultipledata($query,$param);
        // $data = $data->_results;

        // foreach($data as $d)
        // {
        //     $user->create('notice', array(
        //         'to_whom' => $d->username,
        //         'data' => Input::get('project_module_id'). ' module preset has change to '.Input::get('preset'),
        //         'link' => 'http://localhost/eclient/00.final%20site/dashboard.php',
        //         'active' => 'unread' 
        //     ));
        // }
    } catch(Exception $e) {
        echo '<br>';
    }
}

if(Input::get('userId'))
{
    $datas = new Data();
    $datas = $datas->getdata('users',array('ID', '=', Input::get('userId')));
    $datas = $datas->_results;
    $myarr = [];
    foreach($datas as $value){
       $myarr[] =  $value;
    }
    if($myarr)
    {
        echo json_encode($myarr);
    }else{
        return null;
    }
}

if(Input::get('my_id') && Input::get('receiver_id'))
{ 
    get_all_message(Input::get('my_id'),Input::get('receiver_id'),Input::get('receiver_id'),Input::get('my_id'));
}

if(Input::get('session_id'))
{
    if(Input::get('session_id') != "no_id")
    {
        Session::put("chat_with_id",Input::get('session_id'));
    }
    //echo Session::get('chat_with_id');
    get_all_message(Session::get('user_id'),Session::get('chat_with_id'),Session::get('chat_with_id'),Session::get('user_id'));
}

function get_all_message($a,$b,$c,$d)
{
    $datas = new Data();
    $query = "SELECT * FROM message WHERE (message_sender_ID=? AND message_receiver_ID=?) OR (message_sender_ID=? AND message_receiver_ID=?)";
    $params = array($a,$b,$c,$d);
    $datas = $datas->getmultipledata($query,$params);
    $datas = $datas->_results;
    $myarr = [];
    foreach($datas as $value){
       $myarr[] =  $value;
    }
    if($myarr)
    {
        echo json_encode($myarr);
    }else{
        return null;
    }
}

if(Input::get('to_id') && Input::get('by_id') && Input::get('message_body'))
{
    $user = new User();
    try { 
        $user->create('message',array(
            'message_body' => Input::get('message_body'),
            'message_sender_ID' => Input::get('by_id'), 
            'message_receiver_ID' => Input::get('to_id'),
        ));

    } catch(Exception $e) {
        echo '<br>';
    }

    echo "success";
}

if(Input::get('delete_project_id')){
    $delete_id = Session::get('current_project');
    $data = new Data();
    try{ 
        //also delete from other locations. 
        // module by table
        $data->deletedata('module_by',array('pID','=',Session::get('current_project')));
        // project handler table
        $data->deletedata('project_handler',array('project_id','=',Session::get('current_project')));
        // project module table
        $data->deletedata('project_module',array('pID','=',Session::get('current_project')));
        // users => related_project = > Current project session 
        $data->deletedata('users',array('related_project','=',Session::get('current_project')));
        // project table
        $data->deletedata('project',array('ID','=',Session::get('current_project')));
    }catch(Exception $e)
    {
        echo "error";
    }
} 

if(Input::get('done_project_id')){
    $done_id = Input::get('done_project_id');
    $this_project = Session::get('current_project');

    if($done_id == $this_project)
    {
        $query = "INSERT INTO project_log SELECT * FROM project WHERE ID=?";
        $param = array($done_id);
        $data = new Data();
        $data->getmultipledata($query,$param);

        $query = "DELETE FROM project WHERE ID=?";
        $param = array($done_id);
        $data1 = new Data();
        $data1->getmultipledata($query,$param);
    }
    
    // $data = new Data();
    // //get client username and delete from users
    // $query = "SELECT ID,fName,lName FROM users WHERE related_project=?";
    // $param = array($this_project);
    // $data = $data->getmultipledata($query,$param);
    // $data = $data->_results;
    // foreach($data as $client)
    // {
    //     $fName = $client->fName;
    //     $lName = $client->lName;
    //     $id = $client->ID;

    //     // insert into new table

    //     $user = new User();
    //     $user->delete1('users',$id);
    // }

    
}

if(Input::get('rollback_id'))
{
    $data = new Data();
    $query = "UPDATE project SET progress=? WHERE ID=?";
    $param = array('progress',Input::get('rollback_id'));
    $data = $data->getmultipledata($query,$param);
}

if(Input::get('doneProject_id'))
{
    $data = new Data();
    $query = "UPDATE project SET progress=? WHERE company_id=? AND ID=?";
    $param = array('done',Session::get('current_company'),Input::get('doneProject_id'));
    $data = $data->getmultipledata($query,$param);

    //get all client related to this project
    $client = new Data();
    $query = "SELECT username FROM users WHERE related_project=?";
    $param = array(Input::get('doneProject_id'));
    $client = $client->getmultipledata($query,$param);
    $client = $client->_results;
    foreach($client as $c)
    {
        //update notice
        $user = new User();
        $user->create('notice', array(
            'to_whom' => $c->username,
            'data' => 'You project are set as done. Please contact to company employee.',
            'link' => 'http://localhost/eclient/00.final%20site/dashboard.php',
            'active' => 'unread'
        ));
    }

     //get all employee related to this project
     $employee = new Data();
     $query = "SELECT username FROM project_handler WHERE project_id=?";
     $param = array(Input::get('doneProject_id'));
     $employee = $employee->getmultipledata($query,$param);
     $employee = $employee->_results;
     foreach($employee as $e)
     {
         //update notice
         $user = new User();
         $user->create('notice', array(
             'to_whom' => $e->username,
             'data' => 'Project is said to be done where you are envolved.',
             'link' => 'http://localhost/eclient/00.final%20site/requirement.php?id='.Input::get('doneProject_id'),
             'active' => 'unread'
         ));
     }

     //send mails here...
}


