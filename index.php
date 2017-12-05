<?php
/**
* @author Jannis Viol
* @version 1.0
* @date 5.12.2017
* @purpose Main page with the chart
**/
    require_once "php/functions.php";
    require_once "php/formhandler.php";
?>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Webanalyzer</title>

    <link rel="shortcut icon" type="image/x-icon" href="img\icon48.png">


    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/logo-nav.css" rel="stylesheet">

    <script src="js/Chart.bundle.min.js"></script>

  </head>

  <body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="index.php">
          <img src="img/logo.png" height="70" alt="Webanalyzer">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">Statistics</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="blacklist.php">Blacklist</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <div class="container">
      <h1 class="mt-5">Statistics</h1>
      <div id="statistic-1">
          <h3>Overview of all visited websites</h3>
          <label for="counter">How many pages should be displayed?</label>
          <input id="counter" class="form-control" type="number" min="5" value="10"></input>
          <canvas id="statistic-1-canvas"></canvas>
      </div>
    </div>
    <!-- /.container -->

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/statistics.js"></script>
  </body>

</html>
