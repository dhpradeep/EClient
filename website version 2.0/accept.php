<?php
define("IN_APP",true);

include_once 'core/init.php';
include_once 'includes/config.php';

if(!Session::exists('username'))
{
    Redirect::to('index.php');
}
if(Session::get('role') != 'admin')
{
    Redirect::to('dashboard.php');
}

 if(Input::get('approved_id'))
 {
    $mailer = new Mailer();
    $mailer->company_approved(Input::get('approved_id'));
    $db = new Database();   
    $db->updateallcompany(Input::get('approved_id'));
}   

if(Input::get('reject_id'))
{
   $db = new Database();
   $db->rejectcompany(Input::get('reject_id'));
}   
if(Input::get('delete_id'))
{
   $db = new Database();
   $db->deletecompany(Input::get('delete_id')); 
}  
?> 