<?php

    class FileController {
        
        // --------------- [ Constructor ] --------------------------
        public function __construct($conn) {
             $this->conn = $conn;        
        }

        // --------------- [ Upload Function ] -----------------------
        public function uploadFile($file,$txtPlan_id,$txtDep_id) {
            $source_path                =           $file['tmp_name'];

            $file_name                  =           $file['name'];
            
            $file_extension             =           pathinfo($file_name, PATHINFO_EXTENSION);

            //$target_file_name           =           time()."-".time().".".$file_extension;

            $target_file_name           =           $file_name;

            $target_directory           =           "./file/".$target_file_name;
            

            $file_type                  =           $file['type'];

            $dep_id                     =           $txtDep_id;

            $plan_id                    =           $txtPlan_id;

            $data                       =           array();

            

            // ------------ [ File Validation ] --------------------------           
            //https://formvalidation.io/guide/validators/file/    
            if(
                $file_type !=   "image/gif"                    && 
                $file_type !=   "image/jpg"                    && 
                $file_type !=   "image/png"                    && 
                $file_type !=   "image/jpeg"                   && 
                $file_type !=   "image/png"                    &&
                $file_type !=   "application/msword"           && //doc
                $file_type !=   "application/pdf"              && //pdf
                $file_type !=   "application/vnd.ms-excel"     && //xls
                $file_type !=   "text/plain" //txt
                ) {
                $data['status']         =           "FAILED";
                $data['message']        =           "Invalid file type. (File type only jpg, jpeg, gif, png, msword, pdf, msexcel, and text allowed)";
                return $data;
            }

            if($file['size']  > 20480000) {
                $data['status']         =           "FAILED";
                $data['message']        =           "File size is larger than 2 MB";
                return $data;
            }

            // ------------------ [ File upload ] ---------------

            if(move_uploaded_file($source_path, $target_directory)) {

                // ---------------[ Insert into database ] -----------------
                $sql            =           "INSERT INTO attach (
                                                dep_id,
                                                plan_id,
                                                att_name) 
                                            VALUES (
                                                '".$dep_id."',
                                                '".$plan_id."',
                                                '".$target_file_name."'
                                                 )";
                $result         =           $this->conn->query($sql);
                
                if($result) {
                    $data['status']     =           "SUCCESS";
                    $data['message']    =           "File uploaded successfully.";
                    $data['files']      =           $target_file_name;
                }
            }
            return $data;
        }
    }
?>