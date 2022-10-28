

$(".more-comment").click(function(){
               var $this=$(this);
                pid=$this.data("pid");
                  window.alert(pid);
//          put inttial  ajax code for loadcomment.php page 
                    postId=new FormData();
              postId.append("pid",pid);
              postId.append("comment-btn","comment");

                         $.ajax({
                              method: 'post',
                              url :"database/loadComments.php",
                              cache:false,
                               data:postId,
                              contentType : false,
                              processData : false,
                              success : function(loadData){
                                $("#pop-up-div").html(loadData);
                              }
                          });
         $("#pop-up-div").css("display","block");
         });
    
     $(".more-like").click(function(){
                   var $this=$(this);
                pid=$this.data("pid");
               $("#"+pid).css("color","blue");
                 postId=new FormData();
                  postId.append("pid",pid);
                  postId.append("me","<?php echo $_SESSION['id']?>");
                  postId.append("like-btn","like");

                         $.ajax({
                              method: 'post',
                              url :"database/like.php",
                              cache:false,
                               data:postId,
                              contentType : false,
                              processData : false,
                              success : function(loadData){
                                 if(loadData=="yes")
                                 {
                                      $("#"+pid).css("color","");// remove icon color
//                                     get total like after deletion
                                     postId=new FormData();
                                      postId.append("pid",pid);
                                      postId.append("totalLikes","totalLikes");

                                     $.ajax({
                                          method: 'post',
                                          url :"database/like.php",
                                          cache:false,
                                           data:postId,
                                          contentType : false,
                                          processData : false,
                                          success : function(loadData){
                                            $("#like"+pid).html(loadData);
                                          }});

                                                                          
                                 }
                                else{
                                     
                                       $("#"+pid).css("color","blue");
                                //           get total like after insertion of like
                                        postId=new FormData();
                                        postId.append("pid",pid);
                                      postId.append("totalLikes","totalLikes");

                                         $.ajax({
                                              method: 'post',
                                              url :"database/like.php",
                                              cache:false,
                                               data:postId,
                                              contentType : false,
                                              processData : false,
                                              success : function(loadData){
                                                 $("#like"+pid).html(loadData);
                                              }});
                                  }
                              }
                          });
         
     });

