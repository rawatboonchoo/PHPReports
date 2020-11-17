<?php session_start();?>
<?php
if(isset($_SESSION['dep_id']) && !empty($_SESSION['dep_id'])) {
  $dep_id             =  $_SESSION['dep_id'];
  $dep_shortname      =  $_SESSION['dep_shortname'];
  $dep_fullname       =  $_SESSION['dep_fullname'];
  $dep_status         =  $_SESSION['dep_status'];
}else{
//header("Location:login.php");
//สามารถเข้าดูได้ทุกคน
}
include_once './application/config/condb.php';
$strSql="SELECT * FROM plan ORDER BY id DESC";
$result = $mysqli->query($strSql);                      
?>
  
   

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>ศทผ <?php if($dep_fullname != ""){?> | <?=$dep_fullname;}else{}?></title>

  <!-- Custom fonts for this template-->
  <link href="./assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="./assets/css/sb-admin-2.min.css" rel="stylesheet">

  <script src="http://cdn.ckeditor.com/4.12.1/full/ckeditor.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css">
 <!-- jquery-->
 <script src="http://code.jquery.com/jquery-latest.min.js"></script>

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <!-- include menu -->
    <?php include("./templates/menu.php");?>
    <!-- end Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <!-- include topbar -->
        <?php include("./templates/topbar.php");?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Monthly Report</h1>
            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
          </div>

          <!-- Table report -->
          <div class="row">
            <table class="table table-borderless">
              <thead>
                <tr>
                  <th scope="col"></th>
                  <th scope="col">รายงาน/ปี</th>
                  <th scope="col">รายงาน/เดือน</th>
                  <th scope="col">สถานะ</th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
              <?php while($lv=$result->fetch_object()){?>
                <tr>                  
                  <th scope="row"></th>
                  <td><?=$lv->plan_year?></td>
                  <td><?=$lv->plan_month?></td>
                  <td>
              <span class="badge <?php if($lv->plan_status == 'ดำเนินการสำเร็จ'){?>badge-success<?}else{?> badge-primary <?}?> text-wrap" style="width: 7rem;">
                    <?=$lv->plan_status?>
                    </span>
                  </td>
                  <td><a href="./detail.php?processplan=<?=$lv->plan_id?>" class="btn btn-sm btn-primary btn-icon-split" data-toggle="tooltip" data-placement="top" title="รายงานประจำเดือน : <?=$lv->plan_month."|".$lv->plan_year?>">
                    <span class="icon text-white-50">
                      <i class="fas fa-flag view"></i>
                    </span>
                    <span class="text">ดูรายงาน</span>
                  </a></td>
                </tr>
              <?php }?>
              </tbody>
            </table>
          </div>
          <!-- End Table report -->

          
          
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
      <!-- Footer -->
      <!-- include footbar -->
      <?php include("./templates/footbar.php");?>
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
          <h5 class="modal-title" id="exampleModalLabel">ออกจากระบบ</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">คุณยืนยันที่จะออกจากระบบ ใช่ หรือ ไม่</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">ยกเลิก</button>
          <a class="btn btn-primary" href="./control/Backend_logout.php">ยืนยัน</a>
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

  <!-- Page level plugins -->
  <script src="./assets/vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="./assets/js/demo/chart-area-demo.js"></script>
  <script src="./assets/js/demo/chart-pie-demo.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
      <!-- Bootstrap CSS DatePick-->

<script>
 $(document).ready(function(){
   $('[data-toggle="tooltip"]').tooltip() // tooltip enable

 });
</script>

</body>

</html>

<?php

function formatDate($param) {
  $year   =substr("$param",0,4);
  $month  =substr("$param",5,2);
  $day    =substr("$param",8,2);
  $_day   =sprintf("%01d", $day);
  $_year = getYear($year);
  $_month = getMonth($month);
  $dateformat = $_day." ".$_month." ".$_year;
  return $dateformat;
}
function getYear($param){
  $result = $param + 543;
  return $result;
}
function getMonth($param){
  $monthTH = [null,'มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'];
  return $monthTH[$param];
}

$mysqli->close();
?>
