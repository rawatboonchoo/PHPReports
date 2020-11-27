<?php include("test.php");?>
<!doctype html>
<html lang="en">
  <head>
    <title> PHP File Upload Using Ajax And jQuery | </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">   
    </head>
  <body>
  <ul>
  <li><?=$data['status'];?></li>
  <li><?=$data['message'];?></li>
  </ul>
        
      <div class="container mt-5">
      	<h4 class="text-center"> File Upload in PHP Using jQuery and Ajax </h4>
          <form method="post" id="myForm" autocomplete="off" enctype="multipart/form-data">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-10 col-sm-12 col-12 m-auto shadow p-4">
                    <label for="file">Image </label>
                    <div class="form-group">
                        <label for="">ชื่อผู้โพส</label>
                            <input type="text" name="txtname" id="txtname" class="form-control">
                        </div>    
                        <div class="form-group">
                            <input type="file" name="file" id="file" class="form-control">
                        </div>

                        <div class="form-group">
                            <button type="button" id="uploadBtn" class="btn btn-success"> Upload </button>
                        </div>   
                        
                        <div class="form-group">
                            <div id="result"></div> 
                   		</div>
                </div>
            </div>
          </form>
      </div>     
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"
        integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous">
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"
        integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous">
</script>
<script>
$(document).ready(function(){
    $("#file").change(function() {
                //alert('changed!');
            //var form = $('form')[0]; // You need to use standard javascript object here
            //console.log(form);
            $.ajax({
            url: './upload.php',
            type: 'POST',
            data: new FormData(this.form),
            contentType: false,       
            cache: false,             
            processData:false, 

            success:function(response) {
                    $("#result").html(response);                    
            }
        }); 
    });
    $("#uploadBtn").click(function(){
        var formData = new FormData(this.form);
       
        $.ajax({
            url: './upload.php',
            type: 'POST',
            data: formData,
            contentType: false,       
            cache: false,             
            processData:false, 

            success:function(response) {
                    $("#result").html(response);                    
            }
        });      
    });
});     
</script>
</body>
</html>