<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- jQuery library -->


<!-- jQuery UI library -->

<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">


</head>
<body>

<input type="text" class="form-control" id="txtTypework" name="txtTypework" placeholder="">
<span class="result-data"></span>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script>
    $(document).ready(function () {
        //autocomplate jobtype
        // $("#txtTypework").autocomplete({
        //     source: "./modulePHP/auto_jobtype.php",
        //     select: function( event, ui ) {
        //         event.preventDefault();
        //         $("#txtTypework").val(ui.item.type_work);
        //     }
        // });


        $("#txtTypework").autocomplete({
        source: function(request,response){
            $.getJSON("./modulePHP/auto_jobtype.php",function(data){
                if(data!=null){
                    response($.map(data, function(item){
                        return {
                            label:item.type_work,
                            value: item.type_work,
                            //id: item.type_id
                        };
                    }));
                }
            });
        },
        // select: function(event,ui){
        //     $("span.result-data").html(ui.item.label);
        // }
        });
            
    });
</script>
</body>
</html>