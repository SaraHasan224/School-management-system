<?php //$include_path = './'; ?>
<?php include('include/meta_tags.php'); ?>
<!DOCTYPE html>
<html>

<?php include('include/head.php'); ?>
</head>

<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#">
        <img src="<?php echo base_url('assets/dist/images/Admin.png'); ?>" alt="" class="img-fluid" style="width:50%;">
    </a>
  </div>
  <div id="SubmitMessage"></div> <!-- When Message Got From DataBase -->
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="#" method="post" id="login-form">
        <div class="input-group mb-3">
          <input type="text" id="Email" class="form-control" placeholder="UserName">
          <div id="EmailValidation"></div>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span> 
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" id="Password" class="form-control" placeholder="Password">
          <div id="PasswordValidation"></div>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            <!-- <a href="<?php //echo BASE_URL; ?>index.php" class="btn btn-warning btn-block">Sign In</a> -->
          </div>
          <!-- /.col -->
        </div>
      </form>

      <!-- <div class="social-auth-links text-center mb-3">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div> -->
      <!-- /.social-auth-links -->

      <!-- <p class="mt-2 mb-1">
        <a href="#"><span class="fas fa-lock"></span> I forgot my password</a>
      </p> -->
      <!-- <p class="mb-0">
        <a href="<?php //echo BASE_URL; ?>register.php" class="text-center"><span class="fas fa-user"></span> Register a new membership</a>
      </p> -->
    </div>
    <!-- /.login-card-body -->
    
  </div>
  <a href="<?php echo base_url('welcome'); ?>" style="color:Blue; margin-left:46%;" class="text-center">Back</a>
</div>
<!-- /.login-box -->


<!-- loaderModal -->
<div class="modal" id="loaderModal" aria-modal="true">
  <div class="modal-dialog modal-dialog-centered justify-content-center">
    <div class="spinner-border text-light" role="status">
      <span class="sr-only">Loading...</span>
    </div>        
  </div>
</div>
<?php include('include/footer-scripts.php'); ?>

<!-- <script>
  $(function(){
    $('#signin').on('click', function(){
      $('#loaderModal').modal('show');
      // $('#loaderModal').modal('hide');
    });
  });  
</script> -->

<script>
      $('#login-form').submit(function (e) { /******** Call A Function When Login Form Submitted ********* */
        e.preventDefault(); /***********Prevent Page to not load *********** */
        var Email = $("#Email").val(); /*********** Get Email Value *********** */
        var Password = $("#Password").val(); /*******Get Phone Number Value ******* */
        if(Email == ""){ /******** if Email is empty ********* */
          $("#EmailValidation").empty(); /*******make Email validation div empty ****** */
          $("#EmailValidation").addClass("cxm-err animated fadeInDown"); /**********add class to Email validation div*********** */
          $("#EmailValidation").append("Email Required"); /*********Add Text to Email validation********* */
        }else if(Password == ""){ /***********else if Password is empty********** */
          $("#PasswordValidation").empty(); /********Password validation div empty******* */
          $("#PasswordValidation").addClass("cxm-err animated fadeInDown"); /*******Password validation add class********* */
          $("#PasswordValidation").append("Password Required"); /********* Password validation add text********** */
        }else{ /*********else validations passed********* */
          var form_data = new FormData(); /*********** Initialize form data ************ */
          form_data.append("Email", Email); /********Add Email to form ******* */
          form_data.append("Password", Password);  /*******add Password to form******* */
          $.ajax({ /********start of an ajax ******** */
            url:"<?php echo base_url('Login/SignInAdmin'); ?>", /*******url to send ******* */
            method:"POST", /********method post******** */
            dataType: 'JSON', /********data type json******* */
            data: form_data, /*********send form here ******** */
            contentType: false, /*******content type false******** */
            cache: false, /*********cache false ********* */
            processData: false, /******* Process data false******* */
            beforeSend: function() { /********before send function start******** */
              $('#loaderModal').modal('show'); /********* load model before login********* */
            },/********end of before send function********* */
            success:function(data) /*******start of success function******** */
            { /********start of success function********* */
              if (data.status == true) { /********if status is true********* */
                setTimeout(function(){ // wait for 2 secs(2)
                  location.reload(true); /******** reload location ******* */
                }, 1000); /******* set 2 secounds ******** */
                $('#loaderModal').modal('hide'); /********* hide loading model ********* */
              }else{ /*******else result is false******** */
                $('#loaderModal').modal('hide'); /********* hide loading model ********** */
                $("#SubmitMessage").empty(); /*******empty message div******* */
                $("#SubmitMessage").addClass("alert alert-danger mb-4"); /*******add class to alert messages******** */
                $("#SubmitMessage").append(data.message); /********add text in alert message******** */
              } /********enf of result check status******** */
            } /*******end of success function******* */
        });/*******end of ajax ******* */
        } /********end of input empty check******** */
      }); /*********end of submit form********* */
    </script>
</body>
</html>
