<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>เพิ่มส่วนงาน</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">เพิ่มส่วนงาน</h1>
              </div>
              <form class="user" name="frmMain" id="frmMain" method="post">
              <div class="alert alert-warning alert-dismissible" id="success" style="display:none;">
                            <span id="suc"></span>
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                </div>
                <div class="form-group row">
                
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" id="txtShortname" placeholder="ชื่อย่อส่วนงาน">
                  </div>
                  <!-- <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" id="exampleLastName" placeholder="Last Name">
                  </div> -->
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" id="txtFullname" placeholder="ชื่อเต็มส่วนงาน">
                </div>
                <div class="form-group row">
                  <!-- <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                  </div>
                  <div class="col-sm-6">
                    <input type="password" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Repeat Password">
                  </div> -->
                </div>
                <div class="alert alert-warning alert-dismissible" id="success_user" style="display:none;">
                            <span id="suc_user"></span>
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                </div>
                <button type="button" id="btnSend" class="btn btn-primary btn-user btn-block">
                  สมัครสมาชิกส่วนงาน
                </button>
                <hr>
                <!-- <a href="index.html" class="btn btn-google btn-user btn-block">
                  <i class="fab fa-google fa-fw"></i> Register with Google
                </a>
                <a href="index.html" class="btn btn-facebook btn-user btn-block">
                  <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                </a> -->
              </form>
              <!-- <hr>
              <div class="text-center">
                <a class="small" href="forgot-password.html">Forgot Password?</a>
              </div> -->
              <div class="text-center">
                <a class="small" href="login.php">เข้าสู่ระบบ</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>
  <script type="text/javascript">
		$(document).ready(function() {
			$("#btnSend").click(function() {
          $("#success").hide();
          $("#success_user").hide();
          var txtShortname = $('#txtShortname').val();
          var txtFullname = $('#txtFullname').val();
          var txtStatus = "user";
          if(txtShortname!="" && txtFullname!=""){
            $.ajax({
              type: "POST",
              url: "./control/Backend_register.php",
              data: {
                txtShortname: txtShortname,
                txtFullname:txtFullname,
                txtStatus:txtStatus
              },
              cache: false,
              success: function(result) {
							if(result.status == 200) // Success
							{
                $("#success_user").show();
                $('#suc_user').html(result.message);
 	
							}
							else // Err
							{
                $("#success").show();
                $('#suc').html(result.message); 
							}
					   }
            });
          }else{
            $("#success").show();
            $('#suc').html("กรุณากรอกข้อมูลให้ครบถ้วน"); 
            
          }

			});

		});
</script>

</body>

</html>
