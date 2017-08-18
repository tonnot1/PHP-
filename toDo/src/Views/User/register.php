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

    <title>Signin Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="Assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="Assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<div class="container">

    <form class="form-signin" action="?action=Connexion/doRegister" method="post">
        <h2 class="form-signin-heading " style="text-align: center">Please register</h2>

        <?php \TODO\Services\Toolbox::getFlash(); ?>
        <label for="login" class="sr-only">Login</label>
        <input type="text" name="login" id="login" class="form-control" placeholder="Login" >

        <label for="password" class="sr-only">Password</label>
        <input type="password" name="password" id="password" class="form-control" placeholder="Password" >

        <label for="prenom" class="sr-only">Prénom</label>
        <input type="text" name="prenom" id="prenom" class="form-control" placeholder="Prénom" >

        <label for="nom" class="sr-only">Nom</label>
        <input type="text" name="nom" id="nom" class="form-control" placeholder="Nom" >

        <label for="email" class="sr-only">Email</label>
        <input type="email" name="email" id="email" class="form-control" placeholder="Email" >

        <div class="checkbox">
            <label>
                <input type="checkbox" value="remember-me"> Remember me
            </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    </form>

</div> <!-- /container -->


<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="Assets/js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>