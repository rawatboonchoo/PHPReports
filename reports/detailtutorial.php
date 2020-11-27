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
include_once './application/config/db-config.php';
include_once './modulePHP/change_month.php';
$db                   = new DBController();
$mysqli               = $db->connect();

$plan_id              = $_GET["processplan"];
$sort                 = $_GET["q"];

// query plan
$sql                  = "SELECT * FROM plan 
                        where plan_id ='".$plan_id."'
                        ";
$result               = $mysqli->query($sql); // ทำการ query คำสั่ง sql 
$view                 = $result->fetch_object();
$plan_month           = $view->plan_month;

// query description
if($sort == 'all' || $sort == '' || $sort == '0'){
  $sql_plan           = "SELECT * FROM 
                        description a, department b, categorys c, jobtype d
                        WHERE a.dep_id    = b.dep_id 
                        AND a.cat_id      = c.cat_id
                        AND a.type_id     = d.type_id                        
                        AND a.plan_id     ='".$plan_id."'
                        ORDER BY a.cat_id ASC
                        ";
}else{
  $sql_plan           = "SELECT * FROM 
                        description a, department b, categorys c, jobtype d
                        WHERE a.dep_id    = b.dep_id 
                        AND a.cat_id      = c.cat_id
                        AND a.type_id     = d.type_id
                        AND a.plan_id     ='".$plan_id."'
                        AND a.cat_id      = '".$sort."'
                        ORDER BY a.cat_id ASC
                        ";

}

$result_plan          = $mysqli->query($sql_plan); // ทำการ query คำสั่ง sql 
$total                = $result_plan->num_rows;



// query categorys
$sql_cat              = "SELECT * FROM categorys";
$result_cat           = $mysqli->query($sql_cat);
$result_sort          = $mysqli->query($sql_cat);
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

  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
  <!-- Custom styles for this template-->
  <link href="./assets/css/sb-admin-2.min.css" rel="stylesheet">
  <script src="http://cdn.ckeditor.com/4.12.1/full/ckeditor.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css">


 
 <style>
 /* ขีดเส้น table */
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
.ui-menu{
  font-size: 14px;
  /* background-color: #ffffff;
  border: 1px solid #ccc; */
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
            
            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
             <!-- check login -->
             <?php if($dep_id != ''){?>
                  <!-- <button  data-toggle="modal" data-target="#modelCreateReport" class="m-0 btn btn-sm btn-success"> <i class="far fa-edit"></i> เพิ่มรายงาน</button> -->
                  <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#modelCreateReport" id="btnGenerateReport"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
            <?}else{?>
                  <!-- <button id="login" class="m-0 btn btn-sm btn-success"> <i class="far fa-edit"></i> เพิ่มรายงาน</button> -->
                  <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" id="login" data-toggle="tooltip" data-placement="top" title="กรูณาเข้าสู่ระบบก่อนทำการ Generate Report"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
            <?}?>
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
                              <select class="form-control" id="txtSort" name="txtSort" onchange="sortVal(this);">
                                <!-- <option value="0">ทั้งหมด</option> -->
                                <?php 
                                $lockLoop = 0;
                                while($sort_view=$result_sort->fetch_object()){
                                  if($lockLoop == 0){
                                  ?>
                                  <option value="0">ทั้งหมด</option>
                                  <?
                                  }

                                if($sort_view->cat_id == $sort){
                                ?>
                                    <option value="<?=$sort_view->cat_id?>" selected><?=$sort_view->cat_name?></option>
                                  <?}else{?>
                                    <option value="<?=$sort_view->cat_id?>"><?=$sort_view->cat_name?></option>
                                <?}
                                $lockLoop ++;
                              }?>
                              
                              </select>
                          </div>


                </div>
                <div class="card-body">
                  <table class="table table-borderless" style="font-size: 14px;">
                    <thead>
                      <tr>
                        <th style="width: 28%">ประเภทงาน</th>
                        <th>การดำเนินงาน</th>
                        <th style="width: 15%">หมายเหตุ</th>
                      </tr>
                    </thead>
                    <tbody id="result_report">
                      <tr>
                        <td>
                        งานประจำ
                        
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                      
                      </tr>
                      <?php 
                      $_catChRow1 = 1;
                      $_catCountRow1 = 1;
                      $_catChRow2 = 2;
                      $_catCountRow2 = 1;
                      $_catChRow3 = 3;
                      $_catCountRow3 = 1;
                      $_catChRow4 = 4;
                      $_catCountRow4 = 1;
                      $_catChRow5 = 5;
                      $_catCountRow5 = 1;
                      
                      while($view_cat1=$result_plan->fetch_object())
                      {
                        if($view_cat1->cat_id == 1){
                          if($_catChRow1 == 1){
                        ?> 
                        <tr>
                        <td>
                          <b><?=$_catChRow1?>. <?=$view_cat1->cat_name?></b>
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
                            <?=$view_cat1->cat_id.".".$_catCountRow1." ".$view_cat1->type_work?>
                            <? if($view_cat1->dep_id == $dep_id){?>
                            <!-- edit -->
                            <a 
                              data-toggle           = "modal" 
                              data-target           = "#modelCreateReport">
                              <i 
                                data-toggle           = "tooltip" 
                                data-placement        = "top" 
                                style                 = "cursor: pointer;" 
                                class                 = "fas fa-edit fa-sm fa-fw mr-2 text-primary edit" 
                                data-des_id           = "<?=$view_cat1->des_id?>"
                                data-plan_id          = "<?=$view_cat1->plan_id?>"
                                data-cat_id           = "<?=$view_cat1->cat_id?>"
                                data-cat_name         = "<?=$view_cat1->cat_name?>"
                                data-type_id          = "<?=$view_cat1->type_id?>" 
                                data-type_work        = "<?=$view_cat1->type_work?>"
                                data-att_id           = "<?=$view_cat1->att_id?>"                                       
                                data-des_detail       = "<?=$view_cat1->des_detail?>"                      
                                data-des_report_start = "<?=$view_cat1->des_report_start?>"
                                data-des_report_end   = "<?=$view_cat1->des_report_end?>"
                                data-des_note         = "<?=$view_cat1->des_note?>"                                
                                title                 = "แก็ไขข้อมูล คลิก!">
                              </i>
                            </a>
                            <!-- delete -->
                            <a 
                              data-toggle           = "modal" 
                              data-target           = "#modelDeleteReport">
                              <i 
                                data-toggle           = "tooltip" 
                                data-placement        = "top" 
                                style                 = "cursor: pointer;" 
                                class                 = "fas fa-trash fa-sm fa-fw mr-2 text-primary delete"
                                data-des_id           = "<?=$view_cat1->des_id?>"
                                data-plan_id          = "<?=$view_cat1->plan_id?>"
                                data-att_id           = "<?=$view_cat1->att_id?>" 
                                data-att_name         = "<?=getNameFile($view_cat1->att_id,$mysqli);?>" 
                                title                 = "ต้องการลบ คลิก!">
                              </i>
                            </a>
                          <? }?>
                          </p>
                          <?php if($view_cat1->dep_area != ''){?>
                          <p style="padding-left:25px;">
                            <?=$view_cat1->dep_area?>
                          </p>
                          <?}
                            if($view_cat1->des_report_start != '0000-00-00')
                            {
                          ?>
                          
                          <p style="padding-left:25px;">
                            วันเริ่มต้น : <?=formatDate($view_cat1->des_report_start)?>
                          </p>
                          <p  style="padding-left:25px;">
                            วันสิ้นสุด : <?=formatDate($view_cat1->des_report_end)?>
                          </p>
                          <?}?>                        
                          
                        </td>
                        <td>
                          <?=$view_cat1->des_detail?>
                        </td>
                        <td>
                          <?=$view_cat1->des_note?>
                          <? if($view_cat1->att_id != 0) {?>
                            <p>
                            
                            <a
                              data-toggle           = "modal" 
                              data-target           = "#downloadModal">                            
                              <i  
                                data-toggle         = "tooltip" 
                                data-placement      = "top"                           
                                class               = "fas fa-download fa-sm fa-fw mr-2 text-primary download"                
                                aria-hidden         = "true"
                                style               = "cursor:pointer" 
                                data-file           = "<?=getNameFile($view_cat1->att_id,$mysqli);?>"
                                title               = "<?=getNameFile($view_cat1->att_id,$mysqli);?>"
                                >
                              </i> 
                              <?//=getNameFile($view_cat1->att_id,$mysqli);?>                                
                            </a>
                            
                            </p>
                            <p>
                            
                            </p>
                          <?}?>
                        </td>
                      </tr>
                      <?php 
                      $_catCountRow1 ++;  
                      $_catChRow1  ++;                 
                      }
                      if($view_cat1->cat_id == 2){
                        if($_catChRow2 == 2){
                      ?>
                      <!-- start ปัญหาการใช้งานอุปกรณ์ -->
                      <tr>
                        <td>
                        <b><?=$_catChRow2?>. <?=$view_cat1->cat_name?></b>
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
                            <?=$view_cat1->cat_id.".".$_catCountRow2." ".$view_cat1->type_work?>
                            <? if($view_cat1->dep_id == $dep_id){?>
                            <!-- edit -->
                            <a data-toggle="modal" data-target="#">
                            <i data-toggle="tooltip" data-placement="top" style="cursor: pointer;" class="fas fa-edit fa-sm fa-fw mr-2 text-success edit" 
                            data-des_id="<?=$view_cat1->des_id?>"
                            data-plan_id="<?=$view_cat1->plan_id?>"    
                            data-des_detail="<?=$view_cat1->des_detail?>" "                        
                            data-des_report_start="<?=$view_cat1->des_report_start?>"
                            data-des_report_end="<?=$view_cat1->des_report_end?>"
                            data-des_note="<?=$view_cat1->des_note?>"
                            data-type_work="<?=$view_cat1->type_work?>"
                            title="Update | <?=$dep_shortname?>"></i>
                            </a>
                            <!-- delete -->
                            <a data-toggle="modal" data-target="#">
                            <i data-toggle="tooltip" data-placement="top" style="cursor: pointer;" class="fas fa-trash fa-sm fa-fw text-danger delete"
                            data-des_id="<?=$view_cat1->des_id?>" 
                            title="Delete"
                            ></i>
                            </a>
                          <? }?>
                          </p>
                          <?php if($view_cat1->dep_area != ''){?>
                          <p style="padding-left:25px;">
                            <?=$view_cat1->dep_area?>
                          </p>
                          <?}
                            if($view_cat1->des_report_start != '0000-00-00')
                            {
                          ?>
                          
                          <p style="padding-left:25px;">
                            วันเริ่มต้น : <?=formatDate($view_cat1->des_report_start)?>
                          </p>
                          <p  style="padding-left:25px;">
                            วันสิ้นสุด : <?=formatDate($view_cat1->des_report_end)?>
                          </p>
                          <?}?>                       
                          
                        </td>
                        <td>
                          <?=$view_cat1->des_detail?>
                        </td>
                        <td>
                          <?=$view_cat1->des_note?>
                        </td>
                      </tr>
                      <!-- end ปัญหาการใช้งานอุปกรณ์ -->
                      <?
                        $_catChRow2 ++;
                        $_catCountRow2 ++;                             
                      }
                        //end ปัญหาการใช้งานอุปกรณ์
                        if($view_cat1->cat_id == 3){
                          if($_catChRow3 == 3){
                      ?>
                  
                      <!-- start รายงานรักษาความปลอดภัย -->
                      <tr>
                        <td>
                        <b><?=$_catChRow3?>. <?=$view_cat1->cat_name?></b>
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
                            <?=$view_cat1->cat_id.".".$_catCountRow3." ".$view_cat1->type_work?>
                            <? if($view_cat1->dep_id == $dep_id){?>
                            <!-- edit -->
                            <a data-toggle="modal" data-target="#">
                            <i data-toggle="tooltip" data-placement="top" style="cursor: pointer;" class="fas fa-edit fa-sm fa-fw mr-2 text-success edit" 
                            data-des_id="<?=$view_cat1->des_id?>"
                            data-plan_id="<?=$view_cat1->plan_id?>"    
                            data-des_detail="<?=$view_cat1->des_detail?>" "                        
                            data-des_report_start="<?=$view_cat1->des_report_start?>"
                            data-des_report_end="<?=$view_cat1->des_report_end?>"
                            data-des_note="<?=$view_cat1->des_note?>"
                            data-type_work="<?=$view_cat1->type_work?>"
                            title="Update | <?=$dep_shortname?>"></i>
                            </a>
                            <!-- delete -->
                            <a href="">
                            <i data-toggle="tooltip" data-placement="top" style="cursor: pointer;" class="fas fa-trash fa-sm fa-fw text-danger delete" 
                            title="Delete"
                            ></i>
                            </a>
                          <? }?>
                          </p>
                          <?php if($view_cat1->dep_area != ''){?>
                          <p style="padding-left:25px;">
                            <?=$view_cat1->dep_area?>
                          </p>
                          <?}
                          if($view_cat1->des_report_start != '0000-00-00')
                          {
                          ?>
                        
                        <p style="padding-left:25px;">
                          วันเริ่มต้น : <?=formatDate($view_cat1->des_report_start)?>
                        </p>
                        <p  style="padding-left:25px;">
                          วันสิ้นสุด : <?=formatDate($view_cat1->des_report_end)?>
                        </p>
                        <?}?>                      
                          
                        </td>
                        <td>
                          <?=$view_cat1->des_detail?>
                        </td>
                        <td>
                          <?=$view_cat1->des_note?>
                        </td>
                      </tr>                    
                      
                      <?
                        $_catChRow3 ++;
                        $_catCountRow3 ++;                             
                      }
                      //end รายงานรักษษความปลอดภัย 
                      if($view_cat1->cat_id == 4){
                        if($_catChRow4 == 4){
                      ?>


                      <!-- start รายงานการเข้าออก -->
                      <tr>
                        <td>
                        <b><?=$_catChRow4?>. <?=$view_cat1->cat_name?></b>
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
                            <?=$view_cat1->cat_id.".".$_catCountRow4." ".$view_cat1->type_work?>
                            <? if($view_cat1->dep_id == $dep_id){?>
                            <!-- edit -->
                            <a data-toggle="modal" data-target="#">
                            <i data-toggle="tooltip" data-placement="top" style="cursor: pointer;" class="fas fa-edit fa-sm fa-fw mr-2 text-success edit" 
                            data-des_id="<?=$view_cat1->des_id?>"
                            data-plan_id="<?=$view_cat1->plan_id?>"    
                            data-des_detail="<?=$view_cat1->des_detail?>" "                        
                            data-des_report_start="<?=$view_cat1->des_report_start?>"
                            data-des_report_end="<?=$view_cat1->des_report_end?>"
                            data-des_note="<?=$view_cat1->des_note?>"
                            data-type_work="<?=$view_cat1->type_work?>"
                            title="Update | <?=$dep_shortname?>"></i>
                            </a>
                            <!-- delete -->
                            <a href="">
                            <i data-toggle="tooltip" data-placement="top" style="cursor: pointer;" class="fas fa-trash fa-sm fa-fw text-danger delete" 
                            title="Delete"
                            ></i>
                            </a>
                          <? }?>
                          </p>
                          <?php if($view_cat1->dep_area != ''){?>
                          <p style="padding-left:25px;">
                            <?=$view_cat1->dep_area?>
                          </p>
                          <?}
                            if($view_cat1->des_report_start != '0000-00-00')
                            {
                          ?>
                          
                          <p style="padding-left:25px;">
                            วันเริ่มต้น : <?=formatDate($view_cat1->des_report_start)?>
                          </p>
                          <p  style="padding-left:25px;">
                            วันสิ้นสุด : <?=formatDate($view_cat1->des_report_end)?>
                          </p>
                          <?}?>
                        
                          
                        </td>
                        <td>
                          <?=$view_cat1->des_detail?>
                        </td>
                        <td>
                          <?=$view_cat1->des_note?>
                        </td>
                      </tr>                    
                      
                      <?
                        $_catChRow4 ++;
                        $_catCountRow4 ++;                             
                      }
                      //end รายงานการเข้าออก 
                      if($view_cat1->cat_id == 5){
                        if($_catChRow5 == 5){
                      ?>

                      <!-- start ให้บริการศุนย์คอมพิวเตอร์ -->
                      <tr>
                        <td>
                        <b>
                        <?=$_catChRow5?>. <?=$view_cat1->cat_name?>
                        <? if($view_cat1->dep_id == $dep_id){?>
                            <!-- edit -->
                            <a data-toggle="modal" data-target="#">
                            <i data-toggle="tooltip" data-placement="top" style="cursor: pointer;" class="fas fa-edit fa-sm fa-fw mr-2 text-success edit" 
                            data-des_id="<?=$view_cat1->des_id?>"
                            data-plan_id="<?=$view_cat1->plan_id?>"    
                            data-des_detail="<?=$view_cat1->des_detail?>" "                        
                            data-des_report_start="<?=$view_cat1->des_report_start?>"
                            data-des_report_end="<?=$view_cat1->des_report_end?>"
                            data-des_note="<?=$view_cat1->des_note?>"
                            data-type_work="<?=$view_cat1->type_work?>"
                            title="Update | <?=$dep_shortname?>"></i>
                            </a>
                            <!-- delete -->
                            <a href="">
                            <i data-toggle="tooltip" data-placement="top" style="cursor: pointer;" class="fas fa-trash fa-sm fa-fw text-danger delete"
                            data-des_id="<?=$view_cat1->des_id?>"
                            title="Delete"
                            ></i>
                            </a>
                          <? }?>
                        </b>
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>                      
                      </tr>
                        <?}?>
                        <tr>
                        <td>
                          <!-- <p>
                            <?//=$view_cat1->cat_id.".".$_catCountRow5." ".$view_cat1->type_work?>
                          </p> -->
                          <?php if($view_cat1->dep_area != ''){?>
                          <p style="padding-left:25px;">
                            <?=$view_cat1->dep_area?>
                          </p>
                          <?}
                            if($view_cat1->des_report_start != '0000-00-00')
                            {
                          ?>
                          
                          <p style="padding-left:25px;">
                            วันเริ่มต้น : <?=formatDate($view_cat1->des_report_start)?>
                          </p>
                          <p  style="padding-left:25px;">
                            วันสิ้นสุด : <?=formatDate($view_cat1->des_report_end)?>
                          </p>
                          <?}?>
                        
                          
                        </td>
                        <td>
                          <?=$view_cat1->des_detail?>
                        </td>
                        <td>
                          <?=$view_cat1->des_note?>
                        </td>
                      </tr>                    
                      
                      <?
                        $_catChRow5 ++;
                        $_catCountRow5 ++;                             
                      }
                      //end รายงานการเข้าออก 
                      ?>
                  
                  <?
                  }
                  ?>
                      
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

  <!-- Download Modal-->
  <div class="modal fade" id="downloadModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
      <div class="modal-content">
        <!-- <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">ออกจากระบบ</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div> -->
        <div class="modal-body">
        <img src="./assets/img/Infinity-1.4s-35px.gif" id="imgLoaing" style="width:35px;height:35px;display:none" alt="">
        <span id="filename"></span>
        <div id="box" style="background:#4e73df;height:5px;width:10px;margin:6px;display:none"></div>
        </div>
        <!-- <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">ยกเลิก</button>
          <a class="btn btn-primary" href="./logout.php">ยืนยัน</a>
        </div> -->
      </div>
    </div>
  </div>
  <!-- ำend model -->

    <!-- delete Modal-->
    <div class="modal fade" id="modelDeleteReport" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">คุณยืนยันที่จะลบข้อมูล ใช่ หรือ ไม่</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="card-body">
              <table class="table table-borderless" style="font-size: 14px;">
                <thead>
                  <tr>
                    <th style="width: 30%">ประเภทงาน</th>
                    <th>การดำเนินงาน</th>
                    <th>หมายเหตุ</th>
                  </tr>
                </thead>
                <tbody id="result_delete">
                  
                </tbody>
              </table>
              <input type="hidden" name="txtDes_id_delete" id="txtDes_id_delete">
              <div id="resultReport_delete">
                                  
              </div>
            </div>
          </div>                 
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">ยกเลิก</button>
          <button name="btnDeleteReport" id="btnDeleteReport" class="btn btn-primary">ยืนยัน</button>
        </div>
      </div>
    </div>
  </div>
  <!-- ำend model -->


  <!-- Create Report Modal-->
  <div class="modal fade bd-example-modal-lg ui-front" id="modelCreateReport" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <div class="form-group col-md-4">
                              <label for="">ประเภทงาน</label>
                              <select class="form-control" id="txtCat_id" name="txtCat_id" onchange="getval(this);">
                                <option value="0">-- select --</option>
                                <?php while($cat_view=$result_cat->fetch_object()){?>
                                <option value="<?=$cat_view->cat_id?>"><?=$cat_view->cat_name?></option>
                                <?}?>
                              </select>
                            </div>
                            <div class="form-group col-md-4">
                              <label for="">หัวข้อรายงาน <a href="#" data-toggle="tooltip" data-placement="top" title="เพิ่มข้อมูล"><i class="fas fa-plus fa-xs"></i></a></label>                                                          
                              <input type="text" class="form-control" autocomplete="off" id="txtType_work" name="txtType_work" placeholder="" disabled data-toggle="tooltip" data-placement="top" title="สามากด Spacbar เพื่อโหลดข้อมูล">
                              <!--  -->
                              <input type="hidden" id="txtDes_id" name="txtDes_id">
                              <input type="hidden" id="txtType_id" name="txtType_id" placeholder="" disabled>
                            </div>
                            <div class="form-group col-md-2">
                              <label for="">วันเริ่มต้น</label>
                              <input class="form-control" id="txtDes_report_start" name= "txtDes_report_start" data-date-format="mm/dd/yyyy" disabled>                                      
                            </div>
                            <div class="form-group col-md-2">
                              <label for="">วันสินสุด</label>
                              <input class="form-control" id="txtDes_report_end" name="txtDes_report_end" data-date-format="mm/dd/yyyy" disabled>
                            </div>


                            <div class="form-group col-md-5" style="display: none">
                              <label for="">ศูนย์</label>                         
                    
                              <input type="text" class="form-control" id="txtPartname" value="<?=$dep_fullname?>" placeholder="ศูนย์" disabled>
                            </div>  
                            <div class="form-group col-md-2" style="display: none">
                              <label for="">รหัสส่วนงาน</label>
                              <input type="text" class="form-control" id="txtDep_id" name="txtDep_id" value="<?=$dep_id?>" disabled>
                            </div>
                            <div class="form-group col-md-3" style="display: none">
                              <label for="">รหัสรายงาน</label>
                              <input type="text" class="form-control" id="txtPlan_id" name="txtPlan_id" value="<?=$plan_id?>" disabled>
                            </div>                           
                        </div>                        
                        <div class="form-group">
                            <label for="">การดำเนินงาน</label>
                            <textarea  class="form-control" id="txtDes_detail" name="txtDes_detail" placeholder=""></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">หมายเหตุ</label>
                            <textarea class="form-control" id="txtDes_note" name="txtDes_note" placeholder=""></textarea>
                        </div>
                        <div class="form-group" id="attfile" style="display:none">                          
                          <input type="hidden" name="txtAtt_id" id="txtAtt_id">                          
                        <label for="">เอกสารแนบ</label>
                        <div class="alert alert-primary alert-dismissible" >                                  
                            <span id="resultFile"></span>
                            <a class="close closeatt" style="cursor: pointer;" data-toggle="tooltip" data-placement= "top" title="ลบเอกสารแนบ">×</a>
                        </div>
 
                        </div>
                        <div class="form-row file">
                          <form method="post" id="fileUplaod" autocomplete="off" enctype="multipart/form-data">
                            <label for="exampleFormControlFile1">เอกสารแนบ</label>
                            <input type="hidden" name="fileDep_id" id="fileDep_id" value="<?=$dep_id?>" class="form-control">
                            <input type="hidden" name="filePlan_id" id="filePlan_id" value="<?=$plan_id?>" class="form-control">
                            <input type="file" name="file" id="file" class="form-control-file" id="exampleFormControlFile1">                 
                          </form>
                        </div>
                        
                        <div class="form-group" id="resultReport">

                        </div>

                    </form>
        </div>
        <div class="modal-footer">
          <label class="mr-auto badge badge-success" id="dateCreate"></label>
          <button class="btn btn-secondary" type="button" data-dismiss="modal">ยกเลิก</button>
          <button type="button" name="btnUpdateReport" id="btnUpdateReport" class="btn btn-primary">แก้ไขข้อมูล</button>
          <button type="button" name="btnAddReport" id="btnAddReport" class="btn btn-primary">เพิ่มข้อมูล</button>
        </div>
      </div>
    </div>
  </div>
  <!-- endCreate Report Modal-->

  <!-- <script src="http://code.jquery.com/jquery-1.7.1.min.js"></script> -->
  <script src     ="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src     ="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src     ="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"
        integrity ="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous">
  </script>
  <!-- Bootstrap core JavaScript-->
  <!-- <script src="./assets/vendor/jquery/jquery.min.js"></script> -->
  <script src="./assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="./assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="./assets/js/sb-admin-2.min.js"></script>
  
  

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
      $('#txtType_work').removeAttr("disabled");
      // $('#txtDes_note').removeAttr("disabled");
      if(sel.value == 4){
       // $("#txtDes_report_start").attr("disabled", true);
       // $("#txtDes_report_end").attr("disabled", true);
      }
    }else{
      $("#txtDes_report_start").attr("disabled", true);
      $("#txtDes_report_end").attr("disabled", true);
      $("#txtType_work").attr("disabled", true);
      
    }
}

//function sort
function sortVal(params){
  console.log(params.value);
  var params1           = $('#txtPlanID').val();
  var pathname          = window.location.pathname; // /PHPReports/reports/detailtutorial.php
  var url               = window.location.href;     // Returns full URL (https://example.com/path/example.html)
  var origin            = window.location.origin;   // Returns base URL (https://example.com)
  var sortReload        = origin + pathname + "?processplan=" + params1 + "&q=" + params.value;
  location.href         = sortReload; 
  

}
//function clear file
function clearAtt(){
    $('#txtAtt_id').val("");
    $('.file').show();
    $('#attfile').hide();
    $('#resultFile').html("");
    $("#file").val(null);
}

$(document).ready(function(){
  $("#btnUpdateReport" ).hide();
  $('[data-toggle="tooltip"]').tooltip() // tooltip enable
  var d                       = new Date();
  var txtDes_create_dtms      = d.getFullYear() + "-" +
                                ("0"+(d.getMonth()+1)).slice(-2) + "-" +
                                ("0" + d.getDate()).slice(-2) + " " +  
                                ("0" + d.getHours()).slice(-2) + ":" + 
                                ("0" + d.getMinutes()).slice(-2) + ":" + 
                                ("0" + d.getMilliseconds()).slice(-2);  
  $('#dateCreate').html(txtDes_create_dtms);


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
    var txtType_id            = $('#txtType_id').val();
    var txtDep_id             = $('#txtDep_id').val();
    var txtAtt_id             = $('#txtAtt_id').val();
    var txtDes_detail         = $('#txtDes_detail').val();
    var txtDes_report_start   = $('#txtDes_report_start').val();
    var txtDes_report_end     = $('#txtDes_report_end').val();
    var txtDes_note           = $('#txtDes_note').val();
    var txtDes_count          = 0;
    var txtDes_create_dtm     = $('#dateCreate').text();
    
    $.ajax({
      type                    : "POST",
      url                     : "./application/model/report-model.php",
      data                    : {
        txtStatus             : 'Create', //check status create edit delete
        txtPlan_id            : txtPlan_id,
        txtCat_id             : txtCat_id,
        txtType_id            : txtType_id,
        txtDep_id             : txtDep_id,
        txtAtt_id             : txtAtt_id,
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

    //update
  $("#btnUpdateReport").click(function(event) {
    for ( instance in CKEDITOR.instances )
        {
            CKEDITOR.instances[instance].updateElement();
        }
    var txtDes_id             = $('#txtDes_id').val();
    var txtPlan_id            = $('#txtPlan_id').val();
    var txtCat_id             = $('#txtCat_id').val();
    var txtType_id            = $('#txtType_id').val();
    var txtType_work          = $('#txtType_work').val();
    var txtDep_id             = $('#txtDep_id').val();
    var txtAtt_id             = $('#txtAtt_id').val();
    var txtDes_detail         = $('#txtDes_detail').val();
    var txtDes_report_start   = $('#txtDes_report_start').val();
    var txtDes_report_end     = $('#txtDes_report_end').val();
    var txtDes_note           = $('#txtDes_note').val();
    var txtDes_count          = 0;
    var txtDes_last_update_dtm= $('#dateCreate').text();
      
    $.ajax({
      type                    : "POST",
      url                     : "./application/model/report-model.php",
      data                    : {
        txtStatus             : 'Update', //check status create edit delete
        txtDes_id             : txtDes_id,
        //txtPlan_id            : txtPlan_id,
        txtCat_id             : txtCat_id,
        txtType_id            : txtType_id,
        //txtDep_id             : txtDep_id,
        txtAtt_id             : txtAtt_id,
        txtDes_detail         : txtDes_detail,
        txtDes_report_start   : txtDes_report_start,
        txtDes_report_end     : txtDes_report_end,
        txtDes_note           : txtDes_note,
        //txtDes_count          : txtDes_count,
        txtDes_last_update_dtm: txtDes_last_update_dtm
                              },
      cache                   : false,
      success: function (response) {
        $("#resultReport").html(response);
        var str   = $("#resultReport").text();
        var n     = str.search("จ");
        if(n == 19){location.reload();event.preventDefault()}
        
      }
    });
  });

  //delete
  $("#btnDeleteReport").click(function(event) {
    var txtDes_id             = $('#txtDes_id_delete').val();   
    $.ajax({
      type                    : "POST",
      url                     : "./application/model/report-model.php",
      data                    : {
        txtStatus             : 'Delete', //check status create edit delete
        txtDes_id             : txtDes_id
                              },
      cache                   : false,
      success: function (response) {
        $("#resultReport_delete").html(response);
        var str   = $("#resultReport_delete").text();
        var n     = str.search("จ");
        if(n == 19){
          location.reload();
          event.preventDefault()
          }
        
      }
    });
  });


  //file
  $("#file").change(function() {            
            $.ajax({
            url               : './attach/upload.php',
            type              : 'POST',
            data              : new FormData(this.form),
            contentType       : false,       
            cache             : false,             
            processData       : false, 
            success           : function(response) {
              if (response.status == 200) {   
                $('#attfile').show(1000);           
                $.ajax({
                      url      : "./attach/viewFile.php",
                      type     : "POST",
                      cache    : false,
                      success  : function(data){                        
                        $('#resultFile').html(data.att_name); 
                        $('#txtAtt_id').val(data.att_id);
                        $('.file').hide(1000);
                      }
                  });
                
              } else{
              }
                                       
            }
        }); 
    });
    //close file
    $(".closeatt").click(function(){
      console.log($('#txtAtt_id').val());
      $('.file').show(1000);
      $('#attfile').hide(1000);
      $('#resultFile').html("");
      $("#file").val(null);
      
    });
  
  //delete
  $('.delete').click(function(){
    var des_id                = $(this).attr("data-des_id");
    var plan_id               = $(this).attr("data-plan_id");
    var att_id                = $(this).attr("data-att_id");
    var att_name              = $(this).attr("data-att_name");
    var 
    $('#txtDes_id_delete')    . val(des_id);

    $.ajax({
      url                     : "./modulePHP/loaddata_delete.php",
      type                    : "POST",
      cache                   : false,
      data                    : {
        des_id                : des_id,
        plan_id               : plan_id
                                },
      success                 : function(result){
        $('#result_delete')     .html(result); 
      }
    });

  });

  //edit
  $('.edit').click(function(){
    clearAtt();

    $("#btnUpdateReport").show();
    $("#btnAddReport").hide();
    $('#txtDes_report_start') .removeAttr("disabled");
    $('#txtDes_report_end')   .removeAttr("disabled");
    $('#txtType_work')        .removeAttr("disabled");

    var des_id                = $(this).attr("data-des_id");
    var plan_id               = $(this).attr("data-plan_id");
    var cat_id                = $(this).attr("data-cat_id");
    var cat_name              = $(this).attr("data-cat_name");
    var type_id               = $(this).attr("data-type_id");
    var type_work             = $(this).attr("data-type_work");
    var att_id                = $(this).attr("data-att_id");
    var des_detail            = $(this).attr("data-des_detail");
    var des_report_start      = $(this).attr("data-des_report_start");
    var des_report_end        = $(this).attr("data-des_report_end");    
    var des_note              = $(this).attr("data-des_note");
    $('#txtDes_id')           .val(des_id);
    $('#txtCat_id option')    .removeAttr('selected')
                              .filter('[value='+cat_id+']')
                              .attr('selected', true)
    $('#labelPlanID')         .html("[แก้ไข]เลขที่รายงาน : " + plan_id);
    $('#txtType_work')        .val(type_work);
    $('#txtType_id')          .val(type_id);
    $('#txtDes_report_start') .val(des_report_start);
    $('#txtDes_report_end')   .val(des_report_end);
    $('#txtDes_note')         .val(des_note);    
    CKEDITOR.instances['txtDes_detail'].setData(des_detail);

    //attach
    if (att_id != 0){
      $('#attfile').show(1000);           
      $.ajax({
            url      : "./attach/viewFileEdit.php",
            type     : "POST",
            data     :{
              att_id : att_id 
            },
            cache    : false,
            success  : function(data){                        
              $('#resultFile').html(data.att_name); 
              $('#txtAtt_id').val(data.att_id);
              $('.file').hide(1000);
            }
        });
    }
  });


  $('#btnGenerateReport').click(function(){
    //get parameter url
    //https://www.sitepoint.com/get-url-parameters-with-javascript/
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const plan_id = urlParams.get('processplan')
    clearAtt();
    $('#txtCat_id option')    .removeAttr('selected');
    $('#labelPlanID')         .html("เลขที่รายงาน : " + plan_id);
    $('#txtType_work')        .val("");
    $('#txtType_id')          .val("");
    $('#txtDes_report_start') .val("");
    $('#txtDes_report_end')   .val("");
    $('#txtDes_note')         .val("");    
    CKEDITOR.instances['txtDes_detail'].setData("");
    $("#txtDes_report_start") .attr("disabled", true);
    $("#txtDes_report_end")   .attr("disabled", true);
    $("#txtType_work")        .attr("disabled", true);
  });

  //autocomplate jobtype
  $("#txtType_work").autocomplete({
      source: function(request,response){
          $.getJSON("./modulePHP/auto_jobtype.php",function(data){
              if(data!=null){
                  response($.map(data, function(item){
                      return {
                          //label:item.type_work,
                          value     : item.type_work,
                          id        : item.type_id
                      };
                  }));
              }
          });
      },
      select: function(event,ui){
          $("#txtType_id").val("");
          $("#txtType_id").val(ui.item.id);
      }
    });

  // $("a download").live('click',function(e){
  //   var data_file = $(this).attr('data-file');
  //   alert(data_file);
  // });

    //download
  $('.download').click(function(evt){
    evt.preventDefault();
    var file_name        = $(this).attr('data-file');
    var path             = './attach/file/';
    $("#box").show();
    $("#imgLoaing").hide();
    $("#box").animate({width: "80%"},{
    easing: showImg(file_name),//เริ่มต้น
    duration: 5000,
    complete: function() {
      location.href       = path + file_name;
      $("#box")             .hide(1000);
      $(".download")        .show(1000);
      $("#imgLoaing")       .hide(1000);
      $("#filename")        .hide(1000);
      $('#downloadModal')   .modal('toggle',1000);
      
    }
    });

    function showImg(filename){
      $("#imgLoaing")   .show();
      $("#filename")    .show(1000);
      $("#filename")    .html(filename);
      $(".download")    .hide();
    }
   
  });

});


//end document
function loadView(params){
  var txtPlanID = params;
  $.ajax({
		url           : "./control/Backend_viewreport.php",
		type          : "POST",
		cache         : false,
    data          : {txtPlanID: txtPlanID},
		success       : function(result){
			            alert(result);
			            $('#result_report').html(result); 
		}
	});

}
</script>

</body>

</html>

<?php

function getNameFile($att_id,$mysqli){
$sql                  = "SELECT * FROM attach 
                        where att_id ='".$att_id."'
                        ";
$result_att           = $mysqli->query($sql); // ทำการ query คำสั่ง sql 
$view_att             = $result_att->fetch_object();
$att_name             = $view_att->att_name;
return $att_name;

}
$mysqli->close();
?>
