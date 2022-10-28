<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.1/emojionearea.min.css">
    
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.1/emojionearea.min.js"></script>
    

    
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

