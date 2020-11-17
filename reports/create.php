<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>ศทผ.</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <script src="http://cdn.ckeditor.com/4.12.1/full/ckeditor.js"></script>
 
    <!-- Bootstrap CSS DatePick-->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css">
 <!-- jquery-->
 <script src="http://code.jquery.com/jquery-latest.min.js"></script>



</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <!-- include menu -->
    <?php include("./template/menu.php");?>
    <!-- end Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <!-- include topbar -->
        <?php include("./template/topbar.php");?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Monthly Report</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
          </div>


          <!-- Table report -->
          <div class="row">
            <div class="col-xl-12 col-lg-8">
              <!-- Card Report -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Create :</h6>
                </div>
                <div class="card-body">
                    <form action="" name="frmMain" id="frmMain" method="post">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                            <label for="">ศูนย์</label>
                            <input type="hidden" name="txtPlanid"  id="txtPlanid" value="2249">
                            <input type="hidden" name="txtUserid" id="txtUserid" value="1">
                            <input type="text" class="form-control" id="txtPartname" name="txtPartname" placeholder="ศูนย์">
                            </div>
                            <div class="form-group col-md-3">
                            <label for="">วันเริ่มต้น</label>
                            <input id="txtReportstart" class="form-control" name="txtReportstart" data-date-format="mm/dd/yyyy">                                      
                            </div>

                            <div class="form-group col-md-3">
                            <label for="">วันสินสุด</label>
                            <input id="txtReportend" class="form-control" name="txtReportend" data-date-format="mm/dd/yyyy">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">การดำเนินงาน</label>
                            <textarea  class="form-control" id="txtOperation" name="txtOperation" placeholder=""></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">การดำเนินงาน</label>
                            <textarea class="form-control" id="txtNote" name="txtNote" placeholder="node..."></textarea>
                        </div>
                        <div class="form-group">
                            <div class="alert alert-success alert-dismissible" id="success" style="display:none;">
                            <span id="suc"></span>
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            </div>
                            <div class="alert alert-danger alert-dismissible" id="error" style="display:none;">
                            <span id="error"></span>
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            </div>
                        </div>

                        <button type="button" name="btnSend" id="btnSend" class="btn btn-primary">Create</button>
                    </form>
                
                
                </div>
              </div>  
            </div>
          </div>
          <!-- End Table report -->
          
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <!-- include footbar -->
      <?php include("./template/footbar.php");?>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
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

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
    <script>
            CKEDITOR.replace('txtOperation');
    </script>
    <script>
        $('#txtReportstart').datepicker({
            format: 'yyyy-mm-dd'
            }).on('hide', function(event) {
            event.preventDefault();
            event.stopPropagation();
            });
        $('#txtReportend').datepicker({
            format: 'yyyy-mm-dd'
            }).on('hide', function(event) {
            event.preventDefault();
            event.stopPropagation();
            });
</script>
<script type="text/javascript">
		$(document).ready(function() {

			$("#btnSend").click(function() {

                for ( instance in CKEDITOR.instances )
                    {
                        CKEDITOR.instances[instance].updateElement();
                    }
            
                 var data = $('#frmMain').serialize();			
					$.ajax({
					   type: "POST",
					   url: "./control/Backend_savereport.php",
					   //data: $("#frmMain").serialize(),
                       data:data,
					   success: function(result) {
							if(result.status == 200) // Success
							{
								//alert(result.message); 
                                //$("#butsave").removeAttr("disabled");
                                //$('#frmMain').find('input:text').val(''); // ค่าว่างให้กับ Input
                                $("#success").show();
                                $('#suc').html(result.message); 	
							}
							else // Err
							{
								//alert(result.message);
                                $("#error").show();
                                $('#error').html(result.message); 
							}
					   }
					 });

			});
	
		});
</script>

</body>

</html>

<?php
//$mysqli->close();
?>
