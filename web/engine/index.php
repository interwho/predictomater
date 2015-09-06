<?php
// Retrieve scores from API Interpreters
$currentPrice = shell_exec(escapeshellcmd('/home/predict/api/raw/currentPrice.py'));
$currentTrend = shell_exec(escapeshellcmd('/home/predict/api/interpreted/currentTrend.py'));
$seasonalImpact = shell_exec(escapeshellcmd('/home/predict/api/interpreted/seasonalImpact.py'));
$inventoryWell = shell_exec(escapeshellcmd('/home/predict/api/interpreted/apiInventory.py'));
$econActivity = shell_exec(escapeshellcmd('/home/predict/api/interpreted/economicIndicators.py'));
$unemploymentClaims = shell_exec(escapeshellcmd('/home/predict/api/interpreted/unemploymentIndicators.py'));
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Predictomater | Login</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">
      <script type="text/javascript">
          function recalculate() {
              var v1 = parseFloat(document.getElementById("s1").innerHTML) * parseFloat(document.getElementById("w1").value);
              var v2 = parseFloat(document.getElementById("s2").innerHTML) * parseFloat(document.getElementById("w2").value);
              var v3 = parseFloat(document.getElementById("s3").innerHTML) * parseFloat(document.getElementById("w3").value);
              var v4 = parseFloat(document.getElementById("s4").innerHTML) * parseFloat(document.getElementById("w4").value);
              var v5 = parseFloat(document.getElementById("s5").innerHTML) * parseFloat(document.getElementById("w5").value);

              var score = (v1 + v2 + v3 + v4 + v5)/5;

              if(score > 65) {
                  document.getElementById("recommendation").innerHTML = "LONG";
                  document.getElementById("recommendation").style.color = "green";
              } else {
                  if(score > 35) {
                      document.getElementById("recommendation").innerHTML = "NEUTRAL";
                      document.getElementById("recommendation").style.color = "#ffff00";
                  } else {
                      document.getElementById("recommendation").innerHTML = "SHORT";
                      document.getElementById("recommendation").style.color = "red";
                  }
              }

              document.getElementById("score").innerHTML = score.toString();
              return true;
          }
      </script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <!-- Main Header -->
      <header class="main-header">

        <!-- Logo -->
        <a href="#" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>P</b>O<b>M</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg">Predictomater</span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <!-- Sidebar user panel (optional) -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="dist/img/avatar.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p>Welcome!</p>
              <!-- Status -->
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            WTI Crude Oil Futures
            <small>Relational Analysis</small>
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">

            <h2>$<?php echo $currentPrice; ?> <small>per barrel</small></h2>
            <h2>Overall Recommendation: <b><span style="color: #ffff00;" id="recommendation">NEUTRAL</span></b> <small>(Score: <span id="score">50</span>)</small></h2>
            
            <style type="text/css">
                .tftable {font-size:12px;color:#333333;width:100%;border-width: 1px;border-color: #729ea5;border-collapse: collapse;}
                .tftable th {font-size:12px;background-color:#acc8cc;border-width: 1px;padding: 8px;border-style: solid;border-color: #729ea5;text-align:left;}
                .tftable tr {background-color:#ffffff;}
                .tftable td {font-size:12px;border-width: 1px;padding: 8px;border-style: solid;border-color: #729ea5;}
                .tftable tr:hover {background-color:#ffff99;}
            </style>

            <table class="tftable" border="1">
                <tr><th>Rating Factor</th><th>Score</th><th>Weight</th></tr>
                <tr><td>Current Trend w/Volatility</td><td><span id="s1"><?php echo $currentTrend; ?></span></td><td><input id="w1" value="1.00" onchange="recalculate();"></td></tr>
                <tr><td>Seasonal Impact</td><td><span id="s2"><?php echo $seasonalImpact; ?></span></td><td><input id="w2" value="1.00" onchange="recalculate();"></td></tr>
                <tr><td>Inventories &amp; Well Counts</td><td><span id="s3"><?php echo $inventoryWell; ?></span></td><td><input id="w3" value="1.00" onchange="recalculate();"></td></tr>
                <tr><td>New Economic Activity</td><td><span id="s4"><?php echo $econActivity; ?></span></td><td><input id="w4" value="1.00" onchange="recalculate();"></td></tr>
                <tr><td>Unemployment Claims</td><td><span id="s5"><?php echo $unemploymentClaims; ?></span></td><td><input id="w5" value="1.00" onchange="recalculate();"></td></tr>
            </table>

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
      <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
          Lets make money.
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2015 <a href="#">Predictomater</a>.</strong> All rights reserved.
      </footer>


      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>

    <script type="text/javascript"> recalculate(); </script>
  </body>
</html>
