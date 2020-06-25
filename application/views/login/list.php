
<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title ?></title>
  <link rel="stylesheet" href="https://use.fontawasome.com/releases/v5.6.3/css/all.css">
  <style type="text/css">
    body {
        margin: 0;
        padding: 0;
        background: url(<?php echo base_url()?>assets/upload/image/123.jpg);
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        font-family: sans-serif;
    }

    .login{
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background: rgba(0,0,0, 0.5);
      padding: 20px;
      width: 270px;
      box-shadow: 0 0 10px 5px black;
      text-align: center;
      color: white;
    }

    .login2{
      text-align: left;
    }
  
    
    </style>
</head>

    
  
  <!-- /.login-logo -->
  <div class="login">
    <div class="card-body login-card-body">
    <a href="<?php echo base_url() ?>"><b><?php echo $title ?></b></a>
      <p class="login-box-msg">Masukkan username dan password</p>

<?php 
//notif eerror 
echo validation_errors('<div class="alert alert-success">','</div>');

//notif gagal login
if($this->session->flashdata('warning')) {
  echo '<div class="alert alert-warning">';
  echo $this->session->flashdata('warning');
  echo '</div>';
}

//notif logout
if($this->session->flashdata('sukses')) {
  echo '<div class="alert alert-success">';
  echo $this->session->flashdata('warning');
  echo '</div>';
}


  //form open login
  echo form_open(base_url('login'));
  
?>
        <div class="input-group mb-3">
          <input type="text" name="username" class="form-control" placeholder="Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <br>
        </br>
        <div class="login2">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>

              
              <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
          </div>
         
          <!-- /.col -->
        </div>
     
<?php echo form_close(); ?>
      

    </div>
    <!-- /.login-card-body -->
  </div>
</div>

</body>
</html>
