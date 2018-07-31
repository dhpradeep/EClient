<?php
if (!defined('IN_APP')) {
   header('Location: index.php');
}
?>
<?php include_once 'core/init.php' ?>   
<?php
if(!Session::exists('username'))
{
    Redirect::to('index.php');
}
?>
<!doctype html>

<html class="no-js" lang="">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>EClient | A perfect management tool</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="assets/css/normalize.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/css/jasny-bootstrap.min.css">
    <!-- <link rel="stylesheet" href="assets/css/bootstrap-select.less"> -->
    <link rel="stylesheet" href="assets/scss/style.css">
    <link href="assets/css/lib/vector-map/jqvmap.min.css" rel="stylesheet">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" type="text/css" media="all" href="assets/css/jquery.minicolors.css">
    <link rel="stylesheet" type="text/css" media="all" href="assets/css/button_design.css">
    

    <style>
    .shaking {
    /* Start the shake animation and make the animation last for 0.5 seconds */
    animation: shake 1s; 
    /* When the animation is finished, start again */
    animation-iteration-count: infinite; 
    }
    @keyframes shake {
        0% { transform: translate(1px, 1px) rotate(0deg); }
        10% { transform: translate(-1px, -2px) rotate(-1deg); }
        20% { transform: translate(-3px, 0px) rotate(1deg); }
        30% { transform: translate(3px, 2px) rotate(0deg); }
        40% { transform: translate(1px, -1px) rotate(1deg); }
        50% { transform: translate(-1px, 2px) rotate(-1deg); }
        60% { transform: translate(-3px, 1px) rotate(0deg); }
        70% { transform: translate(3px, 1px) rotate(-1deg); }
        80% { transform: translate(-1px, -1px) rotate(1deg); }
        90% { transform: translate(1px, 2px) rotate(0deg); }
        100% { transform: translate(1px, -2px) rotate(-1deg); }
    }
    @keyframes shake {
        0% { transform: translate(0px, 1px) rotate(0deg); }
       
        30% { transform: translate(0px, 3px) rotate(0deg); }
        40% { transform: translate(1px, 0px) rotate(0deg); }
        
        70% { transform: translate(0px, 3px) rotate(0deg); }
        80% { transform: translate(0px, -1px) rotate(0deg); }
       
        100% { transform: translate(0px, 1px) rotate(0  deg); }
    }

    /* width */
.card-body::-webkit-scrollbar {
    width: 8px;
}

/* Track */
.card-body::-webkit-scrollbar-track {
    box-shadow: inset 0 0 5px grey; 
    border-radius: 10px;
}
 
/* Handle */
.card-body::-webkit-scrollbar-thumb {
    background: #ccc; 
    border-radius: 10px;
}

/* Handle on hover */
.card-body::-webkit-scrollbar-thumb:hover {
    background: gray; 
}

.btn-circle {
    width: 30px;
    height: 30px;
    padding: 6px 0px;
    border-radius: 15px;
    text-align: center;
    font-size: 12px;
    line-height: 1.42857;
}
.online{
    height: 10px;
    width: 10px;
    background: #0bba28;
    border-radius: 50px;
    position: relative;
    top: 10px;
}
    </style>

</head>

<body onload="load_table()">


    <!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">

<div class="navbar-header">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false"
        aria-label="Toggle navigation">
        <i class="fa fa-bars"></i>
    </button>
    <a class="navbar-brand" href="dashboard.php"><?php if(Session::exists('current_company_name')){echo Session::get('current_company_name');}else{echo "<img src='images/logo.gif' alt='logo'/>";} ?> &nbsp; <sub><small><?php if(Session::exists('role')) echo Session::get('role')//$_SESSION['role']; ?></small></sub>
        <!--<img src="images/logo.png" alt="Logo">-->
    </a>
    <a class="navbar-brand hidden" href="dashboard.php">
        E
    </a>
</div>

<div id="main-menu" class="main-menu collapse navbar-collapse">
    <ul class="nav navbar-nav">
        <li class="active">
            <a href="dashboard.php">
                <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
        </li>
        <h3 class="menu-title">All Items</h3>
        <!-- /.menu-title -->
        <?php if(Session::get('role') == 'company'): ?>
        <?php
                $project = new Data();
                $project = $project->getdata('project',array('company_id', '=', Session::get('current_company')));
                $project = $project->_results;
        ?>
        <li class="menu-item-has-children dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="menu-icon fa fa-laptop"></i>Projects</a>
            <ul class="sub-menu children dropdown-menu">
                <?php foreach($project as $value): ?>
                    <li>
                        <i class="fa fa-laptop"></i>
                        <a href="requirement.php?id=<?php echo $value->ID; ?>"><?php echo $value->project_name; ?></a>
                    </li>
                <?php endforeach ?>
            </ul>
        </li>
        <?php endif ?>
        <li>
            <a href="communication.php">
                <i class="menu-icon ti-email"></i>Communication </a>
        </li>
        <?php if(Session::get('role') == 'company'): ?>
        <li>
            <a href="individual_module.php">
                <i class="menu-icon ti-bag"></i>Open modules </a>
        </li>
        <?php endif ?>
        <li class="menu-item-has-children dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="menu-icon fa fa-user"></i>Members</a>
            <ul class="sub-menu children dropdown-menu">
                <li>
                    <i class="fa fa-plus"></i>
                    <a href="add_members.php">Add members</a>
                </li>
                <li>
                    <i class="fa fa-eye"></i>
                    <a href="view_members.php">View members</a>
                </li>
            </ul>
        </li>
        <?php if (Session::get('role') == 'client'): ?>
        <li>
            <a href="#">
                <i class="menu-icon ti-plus"></i>Add requirement </a>
        </li>
        <?php endif ?>
        <?php if(Session::get('role') == 'company'): ?>
        <li>
            <a href="#">
                <i class="menu-icon ti-settings"></i>Settings </a>
        </li>
        <?php endif ?>
    </ul>
</div>
</nav>
    </aside>

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left">
                        <i class="fa fa fa-tasks"></i>
                    </a>
                    <div class="header-left">
                        <button class="search-trigger">
                            <i class="fa fa-search"></i>
                        </button>
                        <div class="form-inline">
                            <form class="search-form">
                                <input class="form-control mr-sm-2" type="text" placeholder="Search ..." aria-label="Search">
                                <button class="search-close" type="submit">
                                    <i class="fa fa-close"></i>
                                </button>
                            </form>
                        </div>

                        <div class="dropdown for-notification">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="notification" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <i class="fa fa-bell"></i>
                                <!-- <span class="count bg-danger">5</span> -->
                            </button>
                            <!-- <div class="dropdown-menu" aria-labelledby="notification">
                                <p class="red">You have 3 Notification</p>
                                <a class="dropdown-item media bg-flat-color-1" href="#">
                                    <i class="fa fa-check"></i>
                                    <p>Server #1 overloaded.</p>
                                </a>
                                <a class="dropdown-item media bg-flat-color-4" href="#">
                                    <i class="fa fa-info"></i>
                                    <p>Server #2 overloaded.</p>
                                </a>
                                <a class="dropdown-item media bg-flat-color-5" href="#">
                                    <i class="fa fa-warning"></i>
                                    <p>Server #3 overloaded.</p>
                                </a>
                            </div> -->
                        </div>

                        <div class="dropdown for-message">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="message" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <i class="ti-email"></i>
                                <!-- <span class="count bg-primary">9</span> -->
                            </button>
                            <!-- <div class="dropdown-menu" aria-labelledby="message">
                                <p class="red">You have 4 Mails</p>
                                <a class="dropdown-item media bg-flat-color-1" href="#">
                                    <span class="photo media-left">
                                        <img alt="avatar" src="images/avatar/1.jpg">
                                    </span>
                                    <span class="message media-body">
                                        <span class="name float-left">Jonathan Smith</span>
                                        <span class="time float-right">Just now</span>
                                        <p>Hello, this is an example msg</p>
                                    </span>
                                </a>
                                <a class="dropdown-item media bg-flat-color-4" href="#">
                                    <span class="photo media-left">
                                        <img alt="avatar" src="images/avatar/2.jpg">
                                    </span>
                                    <span class="message media-body">
                                        <span class="name float-left">Jack Sanders</span>
                                        <span class="time float-right">5 minutes ago</span>
                                        <p>Lorem ipsum dolor sit amet, consectetur</p>
                                    </span>
                                </a>
                                <a class="dropdown-item media bg-flat-color-5" href="#">
                                    <span class="photo media-left">
                                        <img alt="avatar" src="images/avatar/3.jpg">
                                    </span>
                                    <span class="message media-body">
                                        <span class="name float-left">Cheryl Wheeler</span>
                                        <span class="time float-right">10 minutes ago</span>
                                        <p>Hello, this is an example msg</p>
                                    </span>
                                </a>
                                <a class="dropdown-item media bg-flat-color-3" href="#">
                                    <span class="photo media-left">
                                        <img alt="avatar" src="images/avatar/4.jpg">
                                    </span>
                                    <span class="message media-body">
                                        <span class="name float-left">Rachel Santos</span>
                                        <span class="time float-right">15 minutes ago</span>
                                        <p>Lorem ipsum dolor sit amet, consectetur</p>
                                    </span>
                                </a>
                            </div> -->
                        </div>
                    </div>
                </div>

                <div class="col-sm-5">
                    <div class="user-area dropdown float-right">
                    <span style="line-height: 40px;">welcome <b><?php echo $_SESSION['username']; ?></b></span>&nbsp;&nbsp;&nbsp;
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="images/admin1.jpg" alt="User Avatar">  
                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="profile.php">
                                <i class="fa fa- user"></i>My Profile</a>

                            <!-- <a class="nav-link" href="#">
                                <i class="fa fa- user"></i>Notifications
                                <span class="count">13</span>
                            </a> -->

                            <a class="nav-link" href="logout.php">
                                <i class="fa fa-power -off"></i>Logout</a>
                        </div>
                    </div>

                </div>
            </div>
        </header>
        <?php
            $path = basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']);
            $file = basename(basename($path), '.php'); 
        ?>
        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Dashboard</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                        <?php if($file == 'dashboard'){ ?>
                            <li class="active">Dashboard</li>
                        <?php }else{ ?>
                            <li><a href="dashboard.php">Dashboard</a></li>
                            <li class="active"><?php echo ucfirst(implode(" ", explode("_", $file))); ?></li>
                        <?php } ?>
                        </ol>
                    </div>
                </div>
            </div>
        </div>