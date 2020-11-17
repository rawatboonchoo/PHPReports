<?php 
include("../condb/condb.php");
$plan_id = $_POST["txtPlanID"];
echo $plan_id;
$sql_plan="SELECT * FROM plan where plan_id=$plan_id";
$result_plan = $mysqli->query($sql_plan); // ทำการ query คำสั่ง sql 
//$total=$result_plan->num_rows;
//while($plan_view=$result_plan->fetch_object())        
if($result_plan->num_rows > 0){                 
?>

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
                      while($plan_view=$result_plan->fetch_object()){?> 
                      <tr>
                        <td>
                          <p>
                            <?=$b.".".$i." ".$plan_view->user_part_name?><?php $iduser=$plan_view->user_id; if($id == $iduser){?>
                            <a type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modelCreateReport">
                            <i data-toggle="tooltip" data-placement="top" style="cursor: pointer;" class="fas fa-edit fa-sm fa-fw mr-2 text-gray-400 edit" 
                            data-id="<?=$plan_view->id?>"
                            data-plan_id="<?=$plan_view->plan_id?>"    
                            data-operation="<?=$plan_view->operation?>" "                        
                            data-report_start="<?=$plan_view->report_start?>"
                            data-report_end="<?=$plan_view->report_end?>"
                            data-note="<?=$plan_view->note?>"
                            data-user_part_name="<?=$plan_view->user_part_name?>"
                            title="แก้ไข | <?=$user_part?>"></i>
                            </a>
                            <?php }?>
                          </p>
                          
                          <p style="padding-left:25px;">
                            วันเริ่มต้น : <?=formatDate($plan_view->report_start)?>
                          </p>
                          <p  style="padding-left:25px;">
                            วันสิ้นสุด : <?=formatDate($plan_view->report_end)?>
                          </p>
                        
                          
                        </td>
                        <td>
                          <?=$plan_view->operation?>
                        </td>
                        <td>
                          <?=$plan_view->note?>
                        </td>
                      </tr>
                      <?php 
                      $i ++;
                    
                        }?>
                      <tr>
                        <td>
                        งานประจำ
                        <p>
                        </p>
                        2. ปัญหาการใช้งานอุปกรณ์
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                      
                      </tr>
                    <?php } else {?>
                        <tr>
                        <td colspan='3'>No Result found !</td>
                        </tr>
                    <?php }?>

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

mysqli_close($mysqli);
?>