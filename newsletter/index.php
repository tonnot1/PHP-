<?php
//Vue pour formulaire d'inscrip
session_start();
//print_r($_SESSION);

require_once "Kernel/fonctions.php";


$action = isset($_GET['action']) ? $_GET['action'] : false;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Starter Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="Assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="Assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="Assets/css/starter-template.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]<script src="../../assets/js/ie8-responsive-file-warning.js"></script>![endif]-->
    <!-- <script src="../../assets/js/ie-emulation-modes-warning.js"></script> -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">newsletter.com</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<div class="container">

    <div class="starter-template">
        <h1>Inscris-toi p'tit con !</h1>
        <p class="lead">Un p'tit formulaire pour avoir des newsletters.</p>
    </div> <!-- /.starter-template-->
    <?php getFlash()  ?>
    <?php if($action != 'success')  :?>
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">

                <form action="Controller/register.php" method="post">
                    <div class="form-group">
                        <label for="email">Votre email</label>
                        <input type="text" name="email" id="email" class="form-control">

                    </div><!--form-group-->
                    <div class="form-group">
                        <label for="password">Votre password</label>
                        <input type="password" name="password" id="password" class="form-control">

                    </div><!--form-group-->

                    <div class="form-group">
                        <label for="login">Votre login</label>
                        <input type="text" name="login" id="login" class="form-control">

                    </div><!--form-group-->

                    <div class="form-group">
                        <label for="prenom">Votre prenom</label>
                        <input type="text" name="prenom" id="prenom" class="form-control">

                    </div><!--form-group-->
                    <input type="submit" class="btn btn-primary btn-sm pull-right">

                </form>
            </div><!--   col-lg-8 etc-->
        </div> <!-- /row-->


    <?php endif ?>



</div><!-- /.container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
<script src="Assets/js/bootstrap.min.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="Assets/js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>