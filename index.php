<?php
    error_reporting(E_ALL);
    include './config.php';
    include './adminfunctions.php';

    if(checkUsrLogin() != 1)
    {
        //header('Location: login.php');
        //exit();
    }

    if(!isset($_GET['fl']))
    {
        $file = 'main.php';
    }
    else
    {
        if(file_exists($_GET['fl'].'.php'))
        {
            $file = $_GET['fl'].'.php';      
        }
        else
        {
            $file = 'notfound.php';
        }
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title><?php echo $siteowner; ?> - Admin Dashboard</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, height=device-height">
    <link rel="shortcut icon" href="images/favicon.png"/>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,300' rel='stylesheet' type='text/css'/>
    
    <!-- Styling -->
    <link rel="stylesheet" href="addons/bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" href="addons/toastr/toastr.min.css"/>
    <link rel="stylesheet" href="addons/fontawesome/css/font-awesome.css"/>
    <link rel="stylesheet" href="addons/ionicons/css/ionicons.css"/>
    <link rel="stylesheet" href="addons/noUiSlider/nouislider.min.css"/>

    <link rel="stylesheet" href="styles/style.css"/>
    <link rel="stylesheet" href="styles/theme-white-orange.css" class="theme"/>

    <!-- End of Styling -->
</head>
<body class="hold-transition">

    <?php
        include 'topnav.php';
    ?>

    <?php
        include 'leftmenu.php';
    ?>

    <?php
        include $file;
    ?>

    <div class="scripts">

        <!-- Addons -->
        <script src="addons/jquery/jquery.min.js"></script>
        <script src="addons/jquery-ui/jquery-ui.min.js"></script>
        <script src="addons/bootstrap/js/bootstrap.min.js"></script>
        <script src="addons/fullcalendar/lib/moment.min.js"></script>
        <script src="addons/pacejs/pace.min.js"></script>

        <!-- Dauphin scripts -->
        <script src="addons/dauphin.js"></script>

        <!-- Current page scripts -->
        <div class="current-scripts">

            <!-- Current page addons -->
            <link rel="stylesheet" href="addons/morrisjs/morris.css"/>
            <script src="addons/morrisjs/raphael-min.js"></script>
            <script src="addons/morrisjs/morris.min.js"></script>

            <link rel="stylesheet" href="addons/fullcalendar/fullcalendar.css"/>
            <script src="addons/fullcalendar/lib/moment.min.js"></script>
            <script src="addons/fullcalendar/fullcalendar.min.js"></script>

            <?php
              if($file == 'main.php')
              {
                  include 'chartscript.php';
              }
            ?>
        </div>


    </div>

</body>

</html>