<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="Description" CONTENT="Free angular bootstrap admin dashboard template. World first blur panel dashboard.">
  <meta name="keywords" content="admin,dashboard,template,angular,bootstrap,blur,panel,html,css,javascript">
  <title>Sistema de gestion de proyectos</title>
  
  <link rel="stylesheet" href="vendor/sign-in/vendor.css">
  <link rel="stylesheet" href="vendor/sign-in/auth.css">
</head>
<body>
<main class="auth-main">
  <div class="auth-block">
    <h1>Sistema de Gestión de Proyectos</h1>

    <form class="form-horizontal">
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Email</label>

        <div class="col-sm-10">
          <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
        </div>
      </div>
      <div class="form-group">
        <label for="inputPassword3" class="col-sm-2 control-label">Password</label>

        <div class="col-sm-10">
          <input type="password" class="form-control" id="inputPassword3" placeholder="Password">
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-default btn-auth">Sign in</button>
          <a href class="forgot-pass">Forgot password?</a>
        </div>
      </div>
    </form>

    <div class="auth-sep"><span><span>or Sign in with one click</span></span></div>

    <div class="al-share-auth">
      <ul class="al-share clearfix">
        <li><i class="socicon socicon-facebook" title="Share on Facebook"></i></li>
        <li><i class="socicon socicon-twitter" title="Share on Twitter"></i></li>
        <li><i class="socicon socicon-google" title="Share on Google Plus"></i></li>
      </ul>
    </div>
  </div>
</main>
</body>
</html>