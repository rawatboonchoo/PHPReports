<?php session_start();?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Login</title>

  <!-- Custom fonts for this template-->
  <link href="./assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="./assets/css/sb-admin-2.min.css" rel="stylesheet">


</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">เข้าสู่ระบบ</h1>
                  </div>
                  <form class="user" name="frmMain" id="frmMain" method="post">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" id="txtShortname" name="txtShortname" placeholder="ชื่อส่วนงาน">
                    </div>
                    <div class="form-group">
                        <div id="result"></div> 
                   	</div>
                    <button type="button" id="btnLogin" class="btn btn-primary btn-user btn-block">
                      Login
                    </button>

                  </form>

                  <hr>

                  <div class="text-center">
                    <a class="small" href="./register.php">ขอรับไอดีเข้าใช้งานระบบ</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="./assets/vendor/jquery/jquery.min.js"></script>
  <script src="./assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="./assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="./assets/js/sb-admin-2.min.js"></script>
  <script type="text/javascript">
		$(document).ready(function() {
      $("#btnLogin").click(function(){
        
        var formData = new FormData(this.form);
        console.log(formData);
        $.ajax({
            url: './application/model/login-model.php',
            type: 'POST',
            data: formData,       
            contentType: false,       
            cache: false,             
            processData:false, 
            success:function(response) {
                $("#result").html(response);
                var str = $("#result").text();
                var n = str.search("จ");
                if(n == 5){location.href = "./index.php";}
                                
            }
        });      
      });
		});
</script>

</body>

</html>
