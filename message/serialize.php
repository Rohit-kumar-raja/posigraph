<html>
<head>
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
    </head>

    <body>
    <center>
   1 <input type="checkbox" value="1" name="l[]"><br>
   2 <input type="checkbox" value="2" name="l[]"><br>
    
    3<input type="checkbox" value="3" name="l[]"><br>
    4<input type="checkbox" value="4" name="l[]"><br>
        
    5<input type="checkbox" value="5" name="l[]">
        
      <br><button id="btn"> check</button>  
    </center>
    </body>
    <script>
    
    $("#btn").click(function(){
        $.ajax({
            
                url:"serialAjaxa.php",
                method:"POST",
                data:$("input").serialize(),
                    success : function(result){
                              window.alert(result); 
                    }
        })
        
        
    });
    
    </script>
</html>