<?php
    include './config.php';
    include './adminfunctions.php';

    if(checkUsrLogin() == 1)
    {
        header('Location: ./');
        exit();
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login - <?php echo $siteowner; ?></title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="images/favicon.png"/>
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,300' rel='stylesheet' type='text/css'/>
    
    <!-- Styling -->
    <link rel="stylesheet" href="addons/bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" href="addons/toastr/toastr.min.css"/>
    <link rel="stylesheet" href="addons/fontawesome/css/font-awesome.css"/>
    <link rel="stylesheet" href="addons/ionicons/css/ionicons.css"/>
    <link rel="stylesheet" href="addons/noUiSlider/nouislider.min.css"/>

    <link rel="stylesheet" href="styles/style.css"/>
    <link rel="stylesheet" href="styles/theme-white-orange.css" class="theme" />

    <!-- End of Styling -->
</head>
<body>
    <!-- Main content-->
    <div class="content" id="login-page">
      <div class="container-fluid">
        <div class="panel" id="login-panel">
            <div class="panel-heading">
                <i class="fa fa-unlock-alt vcentered"></i>
                <div class="vcentered">
                    <h3> <?php echo $siteowner; ?></h3>
                    <h5> Enter password to continue:</h5>
                </div>
            </div>
            <div class="panel-body">
                <form id="loginform" class="row" action="validate.php" method="post">

                  <div class="form-wrapper col-sm-12">
                      <label for="Password">Password</label>
                      <div class="form-group">
                        <input type="password" class="form-control" name="Password" id="Password" placeholder="">
                      </div>
                  </div>
                </form>

                <a class="btn btn-lg btn-info btn-block" onclick="submitForm();">Login</a>
                <a class="text-center btn-block no-margin-bottom" class="login-add-text"> Forgot password then contact site manager! </a>
            </div>
        </div>
      </div>
    </div>
    <!-- End of Main content-->

    <div class="scripts">

        <!-- Addons -->
        <script src="addons/jquery/jquery.min.js"></script>
        <script src="addons/jquery-ui/jquery-ui.min.js"></script>
        <script src="addons/bootstrap/js/bootstrap.min.js"></script>
        <script src="addons/toastr/toastr.min.js"></script>

        <!-- Dauphin scripts -->
        <script src="addons/dauphin.js"></script>

    </div>
    
</body>

</html>
<script type="text/javascript">
  function submitForm()
  {
      document.getElementById("loginform").submit();
  }
</script>