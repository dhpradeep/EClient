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
    $user->delete(Input::get('delete_id'));
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