<?php
    require_once "php/functions.php";
    require_once "php/formhandler.php";
?>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Logo Nav - Start Bootstrap Template</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/logo-nav.css" rel="stylesheet">

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
            <li class="nav-item">
              <a class="nav-link" href="index.php">Statistics</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="#">Blacklist</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <div class="container">
      <h1 class="mt-5">Blacklist</h1>
      <form id="blacklist" class="form" method="post">
        <?php
          createUrlList();
        ?>
        <label>Write down a URL you want to add to the blacklist.</label>
        <div id="inputs"><p><input class="form-control" type="text" pattern="[A-Za-z0-9\-*]+\.[a-z]{2,3}$" name="url0" id="url0" /></p></div>
        <p><input type="button" name="addInput" id="addInput" class="btn btn-info" value="Add another URL" /></p>
        <p><input type="submit" id="submit" class="btn btn-success" value="Submit" /></p>
      </form>
    </div>
    <!-- /.container -->

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/generateInput.js"></script>
  </body>

</html>
