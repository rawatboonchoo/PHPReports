<?php
include_once '../application/config/db-config.php';
include_once './change_month.php';
$db             =           new DBController();
$conn           =           $db->connect();
$des_id         =           $_POST['des_id'];
$plan_id        =           $_POST['plan_id'];
$sql            =           "SELECT * FROM 
                            description a, department b, categorys c, jobtype d
                            WHERE a.dep_id  = b.dep_id 
                            AND a.cat_id    = c.cat_id
                            AND a.type_id   = d.type_id
                            AND a.plan_id   = '".$plan_id."'
                            AND a.des_id    = '".$des_id."'
                            ORDER BY a.cat_id ASC
                            ";
$result         =           $conn->query($sql);



if($result->num_rows > 0){
    while($row = $result->fetch_object()){
    ?>
        <tr>
            <td>
                <b>
                    <?=$row->cat_name?>
                </b>                
            </td>
            <td></td>
            <td></td>                      
        </tr>
        <tr>
            <td>
                <p>
                    <?=$row->type_work?>
                </p>
                <?if($row->dep_area != ''){?>
                <p style="padding-left:25px;">
                    <?=$row->dep_area?>
                </p>
                <?
                }
                    if($row->des_report_start != '0000-00-00')
                {
                ?>
                <p style="padding-left:25px;">
                    วันเริ่มต้น : <?=formatDate($row->des_report_start)?>
                </p>
                <p  style="padding-left:25px;">
                    วันสิ้นสุด : <?=formatDate($row->des_report_end)?>
                </p>
                <?
                }
                ?> 
            </td>
            <td>
                <?=$row->des_detail?>
            </td>
            <td>
                <?=$row->des_note?>
            </td>
        </tr>
    <?                  
    }
}



?>