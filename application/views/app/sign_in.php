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
  
  <link rel="stylesheet" href="/assets/css/sign-in/vendor.css">
  <link rel="stylesheet" href="/assets/css/sign-in/auth.css">
  <link rel="stylesheet" href="/vendor/components-font-awesome/css/font-awesome.css">
</head>
<body>
<main class="auth-main">
  <div class="auth-block">
    <h1>SISGEPRO</h1>

    <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>index.php/login">
      <div class="row">
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Username</label>
          <div class="col-sm-offset-1 col-sm-9">
            <input type="text" class="form-control" name="Username" id="inputEmail3" placeholder="Username">
          </div>
        </div>
        <div class="form-group">
          <label for="inputPassword3" class="col-sm-2 control-label">Contraseña</label>
          <div class="col-sm-offset-1 col-sm-9">
            <input type="password" class="form-control" name="Password" id="inputPassword3" placeholder="Contraseña">
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-1 col-sm-10">
            <button type="submit" class="btn btn-default btn-auth">Ingresar</button>
            <a href="<?php echo base_url(); ?>index.php/forgot_password" class="forgot-pass">Olvidaste la contraseña?</a>
          </div>
        </div>
        <br/>
        <div style="color: red; text-align: center; position: relative; top: 50%; -ms-transform: translateY(-50%); -webkit-transform: translateY(-50%); transform: translateY(-50%);"><?php echo $message;?></div>
      </div>
    </form>
    <div class="auth-sep"><span><span>o Logueate con un click</span></span></div>
    <div class="al-share-auth">
      <ul class="al-share clearfix">
        <li><i class="fa fa-facebook" title="Share on Facebook"></i></li>
        <li><i class="fa fa-twitter" title="Share on Twitter"></i></li>
        <li><i class="fa fa-google" title="Share on Google Plus"></i></li>
      </ul>
    </div>
  </div>
</main>
</body>
</html>