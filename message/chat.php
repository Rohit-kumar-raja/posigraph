<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posigraph </title>
    <link rel="icon" type="image/x-icon" href="https://posigraph.com/posi_favicon.png">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
      
      <style>
      
            body{
             background:#e5e5e5; 
             font-family: sans-serif;
            }

            .msg_box{
             position:fixed;
             bottom:-5px;
             width:250px;
             background:white;
             border-radius:5px 5px 0px 0px;
            }

            .msg_head{ 
             background:black;
             color:white;
             padding:8px;
             font-weight:bold;
             cursor:pointer;
             border-radius:5px 5px 0px 0px;
            }

            .msg_body{
             background:white;
             height:200px;
             font-size:12px;
             padding:15px;
             overflow:auto;
             overflow-x: hidden;
            }
            .msg_input{
             width:100%;
             height: 55px;
             border: 1px solid white;
             border-top:1px solid #DDDDDD;
             -webkit-box-sizing: border-box; 
             -moz-box-sizing: border-box;   
             box-sizing: border-box;  
            }

            .close{
             float:right;
             cursor:pointer;
            }
            .minimize{
             float:right;
             cursor:pointer;
             padding-right:5px;

            }

            .msg-left{
             position:relative;
             background:#e2e2e2;
             padding:5px;
             min-height:10px;
             margin-bottom:5px;
             margin-right:10px;
             border-radius:5px;
             word-break: break-all;
            }

            .msg-right{
             background:#d4e7fa;
             padding:5px;
             min-height:15px;
             margin-bottom:5px;
             position:relative;
             margin-left:10px;
             border-radius:5px;
             word-break: break-all;
            }
            /**** Slider Layout Popup *********/

             #chat-sidebar {
                 width: 250px;
                 position: fixed;
                 height: 100%;
                 right: 0px;
                 top: 0px;
                 padding-top: 10px;
                 padding-bottom: 10px;
                 border: 1px solid #b2b2b2;
            }
             #sidebar-user-box {
                 padding: 4px;
                 margin-bottom: 4px;
                 font-size: 15px;
                 font-family: Calibri;
                 font-weight:bold;
                 cursor:pointer;
            }
             #sidebar-user-box:hover {
                 background-color:#999999 ;
            }
             #sidebar-user-box:after {
                 content: ".";
                 display: block;
                 height: 0;
                 clear: both;
                 visibility: hidden;
            }
             img{
                 width:35px;
                 height:35px;
                 border-radius:50%;
                 float:left;
            }
             #slider-username{
                 float:left;
                 line-height:30px;
                 margin-left:5px;
            }
      
      </style>                  
 
  </head>

<body>

        <div id="chat-sidebar" style="background-color:#acafb0">        

        <div id="sidebar-user-box" class="106" >
        <img src="../dp/user.png" />
        <span id="slider-username">Ajit </span>
        </div> 

        <div id="sidebar-user-box" class="107" >
        <img src="../dp/user.png" />
        <span id="slider-username">Sachin </span>
        </div> 

        <div id="sidebar-user-box" class="108" >
        <img src="../dp/user.png" />
        <span id="slider-username">Misti </span>
        </div> 
       
        </div> 

</body>
    
         <script>
      
                  $(document).ready(function(){

              var arr = []; // List of users 

             $(document).on('click', '.msg_head', function() { 
              var chatbox = $(this).parents().attr("rel") ;
              $('[rel="'+chatbox+'"] .msg_wrap').slideToggle('slow');
              return false;
             });


             $(document).on('click', '.close', function() { 
              var chatbox = $(this).parents().parents().attr("rel") ;
              $('[rel="'+chatbox+'"]').hide();
              arr.splice($.inArray(chatbox, arr), 1);
              displayChatBox();
              return false;
             });

             $(document).on('click', '#sidebar-user-box', function() {

              var userID = $(this).attr("class");
              var username = $(this).children().text() ;

              if ($.inArray(userID, arr) != -1)
              {
                  arr.splice($.inArray(userID, arr), 1);
                 }

              arr.unshift(userID);
              chatPopup =  '<div class="msg_box" style="right:270px" rel="'+ userID+'">'+
                 '<div class="msg_head">'+username +
                 '<div class="close">x</div> </div>'+
                 '<div class="msg_wrap"> <div class="msg_body"> <div class="msg_push"></div> </div>'+
                 '<div class="msg_footer"><textarea class="msg_input" rows="4"></textarea></div>  </div>  </div>' ;     

                 $("body").append(  chatPopup  );
              displayChatBox();
             });


             $(document).on('keypress', 'textarea' , function(e) {       
                    if (e.keyCode == 13 ) {   
                        var msg = $(this).val();  
               $(this).val('');
               if(msg.trim().length != 0){    
               var chatbox = $(this).parents().parents().parents().attr("rel") ;
               $('<div class="msg-right">'+msg+'</div>').insertBefore('[rel="'+chatbox+'"] .msg_push');
               $('.msg_body').scrollTop($('.msg_body')[0].scrollHeight);
               }
                    }
                });



             function displayChatBox(){ 
                 i = 270 ; // start position
              j = 260;  //next position

              $.each( arr, function( index, value ) {  
                 if(index < 4){
                      $('[rel="'+value+'"]').css("right",i);
                $('[rel="'+value+'"]').show();
                   i = i+j;    
                 }
                 else{
                $('[rel="'+value+'"]').hide();
                 }
                    });  
             }  

            });

      
      </script>
</html>
