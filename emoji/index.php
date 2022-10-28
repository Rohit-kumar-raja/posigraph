<html>
<head>
    <meta charset="utf-8"/>

    
    <link href="dist/emojionearea.css" rel="stylesheet">
   >
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="dist/emojionearea.min.js"></script>

<!--<link rel="stylesheet" href="path/to/assets/css/emojione.css"/>-->

    
    </head>

    
    <body>
    
    <div>
    
        <textarea id="emoji"></textarea>
        <p id="disp">nmn</p>    
        <input type="button" id="btn-a">
    </div>
    
    </body>

    <script>
      $("#emoji").emojioneArea({
            pickerPosition:"bottom",

            
        });
    $("#btn-a").click(function(){
        $v=$("#emoji").val();
        $("#disp").html($v);
    
    });
    
    </script>
</html>

