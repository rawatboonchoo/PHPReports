<?php 
session_start();
if(isset($_SESSION['dep_id']) && !empty($_SESSION['dep_id'])) {
  $dep_id             =  $_SESSION['dep_id'];
  $dep_shortname      =  $_SESSION['dep_shortname'];
  $dep_fullname       =  $_SESSION['dep_fullname'];
  $dep_status         =  $_SESSION['dep_status'];
}else{
//header("Location:login.php");
}
include_once './application/config/condb.php';
include_once './modulePHP/change_month.php';
$plan_id = $_GET["processplan"];

// query plan
$sql="SELECT * FROM plan where plan_id='".$plan_id."'";
$result = $mysqli->query($sql); // ทำการ query คำสั่ง sql 
//$total=$result->num_rows;  // นับจำนวนถวที่แสดง ทั้งหมด
$view=$result->fetch_object();
$plan_month = $view->plan_month;

// query description
$sql_plan="SELECT * FROM description a, department b WHERE a.dep_id = b.dep_id and a.plan_id ='".$plan_id."'";
$result_plan = $mysqli->query($sql_plan); // ทำการ query คำสั่ง sql 
$total=$result_plan->num_rows;
 


$sql_plan1="SELECT * FROM description a, department b WHERE a.dep_id = b.dep_id and a.plan_id ='".$plan_id."'";
$result_plan1 = $mysqli->query($sql_plan1); // ทำการ query คำสั่ง sql 





// query categorys
$sql_cat="SELECT * FROM categorys";
$result_cat = $mysqli->query($sql_cat);
//while($cat_view=$result_cat->fetch_object())
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
 <style>
 .table {
  border: 1px solid black;
}

.table thead th {
  border-top: 1px solid #000!important;
  border-bottom: 1px solid #000!important;
  border-left: 1px solid #000;
  border-right: 1px solid #000;
}

.table td {
  border-left: 1px solid #000;
  border-right: 1px solid #000;
  border-top: none!important;
}
</style>

</head>

<body id="page-top">
<input type="hidden" id="txtPlanID" type="text" value="<?=$plan_id?>" placeholder="Text input">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <!-- include menu -->
    <?php include_once "./templates/menu.php";?>
    <!-- end Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <!-- include topbar -->
        <?php include_once "./templates/topbar.php";?>
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
            <div class="col-xl-12 col-lg-12">
              <!-- Card Report -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                            <div style="float: left;">
                              <h6 class="m-0 font-weight-bold text-primary">Report : <?=$plan_month;?></h6>
                            </div>
                            <div style="float: right;">
                              <?php if($dep_id != ''){?>
                              <button  data-toggle="modal" data-target="#modelCreateReport" class="m-0 btn btn-sm btn-success"> <i class="far fa-edit"></i> เพิ่มรายงาน</button>
                              <?}else{?>
                                <button id="login" class="m-0 btn btn-sm btn-success"> <i class="far fa-edit"></i> เพิ่มรายงาน</button>
                              <?}?>
                            </div>
                  
                  
                </div>
                <div class="card-body">
                  <table class="table table-borderless" style="font-size: 14px;">
                    <thead>
                      <tr>
                        <th style="width: 30%">ประเภทงาน</th>
                        <th>การดำเนินงาน</th>
                        <th>หมายเหตุ</th>
                      </tr>
                    </thead>
                    <tbody id="result_report">
                      <tr>
                        <td>
                        งานประจำ
                        <p>
                        </p>
                        1. รายงานการประมวลผล
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                      
                      </tr>
                      <?php 
                      $i=1;
                      $b=1;
                      $_catCh = 2;
                      $_catCount = 1;
                      while($view_cat1=$result_plan->fetch_object())
                      {
                        if($view_cat1->cat_id == 1){
                        ?> 
                      <tr>
                        <td>
                          <p>
                            <?=$view_cat1->cat_id.".".$i." ".$view_cat1->dep_fullname?>
                          </p>
                          <?php if($view_cat1->dep_area != ''){?>
                          <p style="padding-left:25px;">
                            <?=$view_cat1->dep_area?>
                          </p>
                          <?}?>
                          
                          <p style="padding-left:25px;">
                            วันเริ่มต้น : <?=formatDate($view_cat1->des_report_start)?>
                          </p>
                          <p  style="padding-left:25px;">
                            วันสิ้นสุด : <?=formatDate($view_cat1->des_report_end)?>
                          </p>
                        
                          
                        </td>
                        <td>
                          <?=$view_cat1->des_detail?>
                        </td>
                        <td>
                          <?=$view_cat1->des_note?>
                        </td>
                      </tr>
                      <?php 
                      $i ++;  
                        //}                  
                      }
                      if($view_cat1->cat_id == 2){
                        if($_catCh == 2){
                      ?>
                      <!-- start ปัญหาการใช้งานอุปกรณ์ -->
                      <tr>
                        <td>
                        2. ปัญหาการใช้งานอุปกรณ์
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>                      
                      </tr>
                        <?}?>
                      
                      <tr>
                        <td>
                          <p>
                            <?=$view_cat1->cat_id.".".$_catCount." ".$view_cat1->dep_fullname?>
                          </p>
                          <?php if($view_cat1->dep_area != ''){?>
                          <p style="padding-left:25px;">
                            <?=$view_cat1->dep_area?>
                          </p>
                          <?}?>
                          
                          <p style="padding-left:25px;">
                            วันเริ่มต้น : <?=formatDate($view_cat1->des_report_start)?>
                          </p>
                          <p  style="padding-left:25px;">
                            วันสิ้นสุด : <?=formatDate($view_cat1->des_report_end)?>
                          </p>
                        
                          
                        </td>
                        <td>
                          <?=$view_cat1->des_detail?>
                        </td>
                        <td>
                          <?=$view_cat1->des_note?>
                        </td>
                      </tr>
                      <!-- end ปัญหาการใช้งานอุปกรณ์ -->

                      <!-- start รายงานรักษษความปลอดภัย -->
                      <!-- <tr>
                        <td>                        
                        3. รายงานรักษษความปลอดภัย
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>                      
                      </tr>
                      <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr> -->
                      <!-- end รายงานรักษษความปลอดภัย -->
                    <?php 
                    $_catCh ++;
                    $_catCount ++;                             
                  }
                  //end ปัญหาการใช้งานอุปกรณ์
                  
                  
                  }?>
                      
                    </tbody>
                  </table>
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
      <?php include_once "./templates/footbar.php";?>
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
          <a class="btn btn-primary" href="./logout.php">ยืนยัน</a>
        </div>
      </div>
    </div>
  </div>
  <!-- ำend model -->


    <!-- Create Report Modal-->
    <div class="modal fade bd-example-modal-lg" id="modelCreateReport" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="labelPlanID">เลขที่รายงาน : <?=$plan_id?></h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
              <form action="" name="frmCreate" id="frmCreate" method="post" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="form-group col-md-5">
                              <label for="">หัวข้อรายงาน</label>
                              <select class="form-control" id="txtCat_id" name="txtCat_id" onchange="getval(this);">
                                <option value="0">-- select --</option>
                                <?php while($cat_view=$result_cat->fetch_object()){?>
                                <option value="<?=$cat_view->cat_id?>"><?=$cat_view->cat_name?></option>
                                <?}?>
                              </select>
                            </div>
                            <div class="form-group col-md-2" style="display: none">
                              <label for="">รหัสส่วนงาน</label>
                              <input type="text" class="form-control" id="txtDep_id" name="txtDep_id" value="<?=$dep_id?>" disabled>
                            </div>
                            <div class="form-group col-md-3">
                              <label for="">รหัสรายงาน</label>
                              <input type="text" class="form-control" id="txtPlan_id" name="txtPlan_id" value="<?=$plan_id?>" disabled>
                            </div>                           
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-5">
                            <label for="">ศูนย์</label>                            
                            <!-- <input type="hidden" name="txtUserid" id="txtUserid" > -->
                            <input type="text" class="form-control" id="txtPartname" value="<?=$dep_fullname?>" placeholder="ศูนย์" disabled>
                            </div>                        
                            <div class="form-group col-md-3">
                            <label for="">วันเริ่มต้น</label>
                            <input class="form-control" id="txtDes_report_start" name= "txtDes_report_start" data-date-format="mm/dd/yyyy" disabled>                                      
                            </div>
                            <div class="form-group col-md-3">
                            <label for="">วันสินสุด</label>
                            <input class="form-control" id="txtDes_report_end" name="txtDes_report_end" data-date-format="mm/dd/yyyy" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">การดำเนินงาน</label>
                            <textarea  class="form-control" id="txtDes_detail" name="txtDes_detail" placeholder=""></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">หมายเหตุ</label>
                            <textarea class="form-control" id="txtDes_note" name="txtDes_note" placeholder="node..."></textarea>
                        </div>
                        <!-- <div class="form-group">
                            <label for="">เอกสารแนบ</label>
                            <div style="position:relative;">
                              <a class='btn btn-primary' href='javascript:;'>
                                เลือกไฟล์เอกสาร ...
                                <input type="file" id="txtDesattach" class="btn btn-primary" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="file_source" size="40"  onchange='getfile();'>
                              </a>
                              &nbsp;
                              <span class='badge badge-primary' id="upload-file-info" style="padding-left:15px;padding-right:15px;"></span>
                            </div>
                            
                        </div> -->
                        <div class="form-group" id="resultReport">
                            <!-- <div class="alert alert-success alert-dismissible" id="success" style="display:none;">
                            <span id="suc"></span>
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            </div>
                            <div class="alert alert-danger alert-dismissible" id="error" style="display:none;">
                            <span id="error"></span>
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            </div> -->
                        </div>
                        <!-- <div class="form-group">
                            <div class="alert alert-success alert-dismissible" id="success" style="display:none;">
                            <span id="suc"></span>
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            </div>
                            <div class="alert alert-danger alert-dismissible" id="error" style="display:none;">
                            <span id="err"></span>
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            </div>
                        </div>                         -->
                    </form>
        </div>
        <div class="modal-footer">
          <label class="mr-auto badge badge-success" id="dateCreate"></label>
          <button class="btn btn-secondary" type="button" data-dismiss="modal">ยกเลิก</button>
          <button type="button" name="btnAddReport" id="btnAddReport" class="btn btn-primary">เพิ่มข้อมูล</button>
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
$('#txtDes_report_start').datepicker({
            format: 'yyyy-mm-dd'
            }).on('hide', function(event) {
            event.preventDefault();
            event.stopPropagation();
            });
$('#txtDes_report_end').datepicker({
            format: 'yyyy-mm-dd'
            }).on('hide', function(event) {
            event.preventDefault();
            event.stopPropagation();
            });
CKEDITOR.replace('txtDes_detail');


function getfile(){
  $("#upload-file-info").html($("#txtfile1").val());
}

function getval(sel)
{
    if(sel.value != 0){
      $('#txtDes_report_start').removeAttr("disabled");
      $('#txtDes_report_end').removeAttr("disabled");
      // $('#txtDes_detail').removeAttr("disabled");
      // $('#txtDes_note').removeAttr("disabled");
      if(sel.value == 4){
        $("#txtDes_report_start").attr("disabled", true);
        $("#txtDes_report_end").attr("disabled", true);
      }
    }else{
      $("#txtDes_report_start").attr("disabled", true);
      $("#txtDes_report_end").attr("disabled", true);
      // $("#txtDes_note").attr("disabled", true);
      
    }
}

$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip() // tooltip enable
  var d                     = new Date();
  var txtDes_create_dtm     = d.getFullYear() + "-" +
                              ("0"+(d.getMonth()+1)).slice(-2) + "-" +
                              ("0" + d.getDate()).slice(-2) + " " +  
                              ("0" + d.getHours()).slice(-2) + ":" + 
                              ("0" + d.getMinutes()).slice(-2) + ":" + 
                              ("0" + d.getMilliseconds()).slice(-2);  
  $('#dateCreate').html(txtDes_create_dtm);


  //login
  $('#login').click(function(e){
    alert("กรุณาทำการเข้าสู่ระบบก่อนทำการเพิ่มรายงานประจำเดือน");
    window.location.href    = './logout.php';
  });

  //Add Report
  $('#btnAddReport').click(function(e){

    for ( instance in CKEDITOR.instances )
        {
            CKEDITOR.instances[instance].updateElement();
        }
    var txtPlan_id            = $('#txtPlan_id').val();
    var txtCat_id             = $('#txtCat_id').val();
    var txtDep_id             = $('#txtDep_id').val();
    var txtDes_detail         = $('#txtDes_detail').val();
    var txtDes_report_start   = $('#txtDes_report_start').val();
    var txtDes_report_end     = $('#txtDes_report_end').val();
    var txtDes_note           = $('#txtDes_note').val();
    var txtDes_count          = 0;
    // var d                     = new Date();
    // var txtDes_create_dtm     = d.getFullYear() + "-" +
    //                           ("0"+(d.getMonth()+1)).slice(-2) + "-" +
    //                           ("0" + d.getDate()).slice(-2) + " " +  
    //                           ("0" + d.getHours()).slice(-2) + ":" + 
    //                           ("0" + d.getMinutes()).slice(-2) + ":" + 
    //                           ("0" + d.getMilliseconds()).slice(-2);
    $.ajax({
      type                    : "POST",
      url                     : "./application/model/report-model.php",
      data                    : {
        txtPlan_id            : txtPlan_id,
        txtCat_id             : txtCat_id,
        txtDep_id             : txtDep_id,
        txtDes_detail         : txtDes_detail,
        txtDes_report_start   : txtDes_report_start,
        txtDes_report_end     : txtDes_report_end,
        txtDes_note           : txtDes_note,
        txtDes_count          : txtDes_count,
        txtDes_create_dtm     : txtDes_create_dtm
                              },
      cache                   : false,
      success: function (response) {
        //console.log(response);
        $("#resultReport").html(response);
        var str   = $("#resultReport").text();
        var n     = str.search("จ");
        if(n == 19){location.reload();}
        
      }
    });
  });


  $('.edit').click(function(){
    var id = $(this).attr("data-id");
    var plan_id = $(this).attr("data-plan_id");
    var user_part_name = $(this).attr("data-user_part_name");
    var report_start = $(this).attr("data-report_start");
    var report_end = $(this).attr("data-report_end");
    var operation = $(this).attr("data-operation");
    var note = $(this).attr("data-note");
    $('#labelPlanID').html("เลขที่รายงาน : " + plan_id + "|" + id);
    $('#txtPartname').val(user_part_name);
    $('#txtReportstart').val(report_start);
    $('#txtReportend').val(report_end);
    $('#txtNote').val(note);
    $('#txtID').val(id);
    CKEDITOR.instances['txtDesdetail'].setData(operation);
  });




  //update
  $("#btnUpdate").click(function(event) {

        for ( instance in CKEDITOR.instances )
        {
            CKEDITOR.instances[instance].updateElement();
        }

        //var data = $('#frmMain').serialize();	
        var id = $('#txtID').val();
        if (id != ""){
          $.ajax({
            type: "POST",
            url: "./control/Backend_update.php",
            data: $("#frmMain").serialize(),
            //data:data,
            success: function(result) {
            if(result.status == 200) // Success
            {
                //alert(result.message);
                $('#frmMain').find('input:text').val(''); // ค่าว่างให้กับ Input
                $("#success").show();
                $('#suc').html(result.message); 	
                $('#modelCreateReport').modal('toggle');
                //var plan_id = $('#txtPlanID').val();
                //loadView(plan_id);
                location.reload();
                event.preventDefault(); //สกอบาร์กลับมาที่เดิม
            }
            else // Err
            {
                //alert(result.message);
                $("#error").show();
                $('#err').html(result.message); 
            }
            }
            });
        }else{
          alert("ID Not value")
        }	
        

    });

});
function loadView(params){
  var txtPlanID = params;
  $.ajax({
		url: "./control/Backend_viewreport.php",
		type: "POST",
		cache: false,
    data: {txtPlanID: txtPlanID},
		success: function(result){
			alert(result);
			$('#result_report').html(result); 
		}
	});

}
</script>

</body>

</html>

<?php
$mysqli->close();
?>
