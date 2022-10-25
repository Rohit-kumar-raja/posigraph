<?php
 session_start();
 if(!isset($_SESSION['email']))
 {
     header("location:index.php");
  }
else
{

    include_once("database/connection.php");
    include_once("database/getPost-mam.php");
    include("database/getMyImagePost.php");
    include("database/getMsgNotif.php");
    
    $query="select * from user where userId=".$_SESSION['id'];
    $result=mysqli_query($conn,$query);
    $user=mysqli_fetch_array($result);
    
    $query="select * from user_details where userId='".$_SESSION['id']."'";
    $result=mysqli_query($conn,$query);
    $userDetail=mysqli_fetch_array($result);

    include "posi_header.php";
    ?>

<style>
#pop-up-div {
    width:94%;
    margin:0 auto;
    background: #fff;
    display: none;
    position: fixed;
    height: 100vh;
    overflow: hidden;
    top: 60%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 1;
    border-radius: 10px;
    /* box-shadow: 2px 2px 6px 5px #000000; */

}

#comment-like-div {
    background-color: white;
    height: 58vh;
    overflow-x: hidden;
    overflow-y: scroll;
    padding: 10px;
    box-sizing: border-box;
}

#comment-text {
    border: 2px solid #57707d;
    width: 60%;
    padding-top: 13px;
    padding-left: 10px;
    box-sizing: border-box;
    margin-right: 5px;
    margin-bottom: 10px;
    /* border: none; */
    border-radius: 5px;
}


</style>
<!--// html code-->

<?php include "feed.php" ?>
<!-- post start -->

<?php // include "dash-testing.php";?>


<div class="container-fluid" >
    <div class="row">
        

    <div id='pop-up-div' class="col-sm-10 col-xs-11 "><br>
    </div>
                   
        <div class="col-md-12">
            <!-- <div class="w3-row-padding ">
                    <div class="w3-col m12">
                        <div class="w3-card w3-round w3-white">
                            <div class="w3-container w3-padding"> -->
            <!-- <h6 class="h4"> Welcome <?php //echo $_SESSION['name']?></h6> -->
            <!-- <div class="">                
            </div> -->
            <!-- </div>
                        </div>
                    </div>
                </div> -->
        </div>

        
        <div class="col-md-12">
            <!--End Middle Column post area-->
            
            <?php         
        if(isset($_GET['pn']))  //when pagination started
        {    $pn=$_GET['pn'];
                if($pn=="" || $pn=="1")
            {
                getPost(0,10) ;// for 
            }
            else
            {
                $from=($pn*10)-10;
                 getPost($from,10) ;
            }
        }
        else
        getPost(0,10); // for the very first time when pagination is not started                    
        ?>
        </div>
        <!--   pagination div-->
        <div class="w3-col m7" style="float:right;margin-right:30px;padding:10px 20px;" id="pagination">
            <?php include("database/pagination.php");?>
        </div>
        <!--      end of pagination-->
        <!-- End Grid -->
    </div>
    <!-- End Page Container -->
</div>
<br>
</div>
</div>
</div>
<!-- //post end -->









<script>
$(".comment-btn").click(function() {

    //             prepare  a jaxa call and load all like and comment of id (pid) and appen/write it comment div of pup-up-div and add pid data as data-pid for inert-comment btn and like btn of pup-up div
    var $this = $(this);
    pid = $this.data("pid");
    // window.alert(pid);
    postId = new FormData();
    postId.append("pid", pid);
    postId.append("comment-btn", "comment");

    $.ajax({
        method: 'post',
        url: "database/loadComments.php",
        cache: false,
        data: postId,
        contentType: false,
        processData: false,
        success: function(loadData) {
            $("#pop-up-div").html(loadData);
        }
    });
    $("#pop-up-div").css("display", "block");

    //             first wirte in pop div then show it
});



$("#close-popUp").click(function() {
    $("#pop-up-div").css("display", "none");

});

$(".like-btn").click(function() {

    var $this = $(this);
    pid = $this.data("pid");
    $("#" + pid).css("color", "blue");
    postId = new FormData();
    postId.append("pid", pid);
    postId.append("me", "<?php echo $_SESSION['id']?>");
    postId.append("name", "<?php echo $_SESSION['name']?>");
    postId.append("like-btn", "like");

    $.ajax({
        method: 'post',
        url: "database/like.php",
        cache: false,
        data: postId,
        contentType: false,
        processData: false,
        success: function(loadData) {
            if (loadData == "yes") {
                $("#" + pid).css("color", ""); // remove icon color
                //                                     get total like after deletion
                postId = new FormData();
                postId.append("pid", pid);
                postId.append("totalLikes", "totalLikes");

                $.ajax({
                    method: 'post',
                    url: "database/like.php",
                    cache: false,
                    data: postId,
                    contentType: false,
                    processData: false,
                    success: function(loadData) {
                        $("#like" + pid).html(loadData);
                    }
                });


            } else {

                $("#" + pid).css("color", "blue");
                //           get total like after insertion of like
                postId = new FormData();
                postId.append("pid", pid);
                postId.append("totalLikes", "totalLikes");

                $.ajax({
                    method: 'post',
                    url: "database/like.php",
                    cache: false,
                    data: postId,
                    contentType: false,
                    processData: false,
                    success: function(loadData) {
                        $("#like" + pid).html(loadData);
                    }
                });
            }
        }
    });
});

//dislike
$(".dislike-btn").click(function() {
var $this = $(this);
pid = $this.data("pid");
$("#dislike1" + pid).css("color", "orange");
postId = new FormData();
postId.append("pid", pid);
postId.append("me", "<?php echo $_SESSION['id']?>");
postId.append("name", "<?php echo $_SESSION['name']?>");
postId.append("dislike-btn", "dislike");

$.ajax({
    method: 'post',
    url: "database/dislike.php",
    cache: false,
    data: postId,
    contentType: false,
    processData: false,
    success: function(loadData) {
        if (loadData == "yes") {
            $("#" + pid).css("color", ""); // remove icon color
            //                                     get total like after deletion
            postId = new FormData();
            postId.append("pid", pid);
            postId.append("totaldisLikes", "totaldisLikes");

            $.ajax({
                method: 'post',
                url: "database/dislike.php",
                cache: false,
                data: postId,
                contentType: false,
                processData: false,
                success: function(loadData) {
                    $("#dislike" + pid).html(loadData);
                }
            });


        } else {

            $("#dislike1" + pid).css("color", "orange");
            //           get total like after insertion of like
            postId = new FormData();
            postId.append("pid", pid);
            postId.append("totaldisLikes", "totalLikes");

            $.ajax({
                method: 'post',
                url: "database/dislike.php",
                cache: false,
                data: postId,
                contentType: false,
                processData: false,
                success: function(loadData) {
                    $("#dislike" + pid).html(loadData);
                }
            });
        }
    }
});
});

// battle like player1
$(".p1batlike").click(function() {

var $this = $(this);
pid = $this.data("pid");
$("#" + pid).css("color", "blue");
postId = new FormData();
postId.append("pid", pid);
postId.append("me", "<?php echo $_SESSION['id']?>");
postId.append("name", "<?php echo $_SESSION['name']?>");
postId.append("p1batlike", "like");

$.ajax({
    method: 'post',
    url: "database/p1like.php",
    cache: false,
    data: postId,
    contentType: false,
    processData: false,
    success: function(loadData) {
        if (loadData == "yes") {
            $("#" + pid).css("color", ""); // remove icon color
            //                                     get total like after deletion
            postId = new FormData();
            postId.append("pid", pid);
            postId.append("totalp1Likes", "totalp1Likes");

            $.ajax({
                method: 'post',
                url: "database/p1like.php",
                cache: false,
                data: postId,
                contentType: false,
                processData: false,
                success: function(loadData) {
                    $("#p1batlike" + pid).html(loadData);
                }
            });


        } else {

            $("#" + pid).css("color", "blue");
            //           get total like after insertion of like
            postId = new FormData();
            postId.append("pid", pid);
            postId.append("totalp1Likes", "totalp1Likes");

            $.ajax({
                method: 'post',
                url: "database/p1like.php",
                cache: false,
                data: postId,
                contentType: false,
                processData: false,
                success: function(loadData) {
                    $("#p1batlike" + pid).html(loadData);
                }
            });
        }
    }
});
});


// Accordion
function myFunction(id) {
    var x = document.getElementById(id);
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
        x.previousElementSibling.className += " w3-theme-d1";
    } else {
        x.className = x.className.replace("w3-show", "");
        x.previousElementSibling.className =
            x.previousElementSibling.className.replace(" w3-theme-d1", "");
    }
}

// Used to toggle the menu on smaller screens when clicking on the menu button
function openNav() {
    var x = document.getElementById("navDemo");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else {
        x.className = x.className.replace(" w3-show", "");
    }
}


//    my deign

//    later after click on post btn check two thing  textarea and file choosen then run ajax..
//       create formData() fetch inputed value from input field object or use submit btn for complete form form submission at once.  

$("#cstmbtn").click(function() {
    const filebtn = document.getElementById("file");
    filebtn.click();
    filebtn.addEventListener("change", function() {

        if (filebtn.value) {
            var checkFile = $("#file");
            var data = checkFile[0].files;
            $("#fileName").css("font-size", "15px");
            $("#fileName").css("color", "darkGreen");
            $("#fileName").html(data[0].name);
        }
    });
});



$("#postbtn").click(function() {
    var checkFile = $("#file");
    var Length = checkFile[0].files.length;
    var data = checkFile[0].files;
    var check;
    if (Length > 0) {
        ext = data[0].name.substring(data[0].name.lastIndexOf(".") + 1);
        check = validatePost(ext, data[0].size);
        if (check == true) {
            var post = new FormData();
            post.append("file", data[0]);
            post.append("id", <?php echo $_SESSION['id']?>);
            <?php  $d=rand(1,1000000000000); ?>
            //                             if img is selected yhen test content
            var con = $("#content").val();
            if (con.length > 0) {
                post.append("text", con);
                $.ajax({
                    method: 'post',
                    url: "database/insertPost.php",
                    cache: false,
                    data: post,
                    contentType: false,
                    processData: false,
                    success: function(result) {
                        window.open('home.php', '_self');
                    }
                });
            } else {
                //                                          send only img
                post.append("text", "");
                $.ajax({
                    method: 'post',
                    url: "database/insertPost.php",
                    cache: false,
                    data: post,
                    contentType: false,
                    processData: false,
                    success: function(result) {
                        window.open('home.php', '_self');
                    }
                });
            }


        } else
            window.alert("invalid");


    } else {

        var con = $("#content").val();
        if (con.length > 0) {
            //                                   window.alert("only content");
            var post = new FormData();
            post.append("file", data[0]);
            post.append("id", <?php echo $_SESSION['id']?>);
            post.append("text", con);
            $.ajax({
                method: 'post',
                url: "database/insertPost.php",
                cache: false,
                data: post,
                contentType: false,
                processData: false,
                success: function(result) {
                    window.open('home.php', '_self');
                }
            });
        }
    }
});

function validatePost(ext, size) {
    extension = new Array("png", "jpg", "jpeg", "gif", "bmp", "mp4", "3gp", "mvk", "mov");
    flag = 0, error = "";
    maxSize = 5242880; // 5mb

    for (i = 0; i < extension.length; i++) {
        if (ext == extension[i]) {
            if (size <= maxSize) {
                flag = 0;
            } else {
                flag = 1;
                error = "file size is large ! please select upto 5MB";
            }
            break;
        } else {
            flag = 1;
            error = "file is not supported";
        }
    }

    if (flag != 0)
        return false;
    else
        return true;

}
</script>


<script>
$("#srch").click(function() {

    v = $("#srch_input").val();
    if (v == "")
        window.alert("please enter name or email")
    else
        window.open('search.php?a=' + v, '_self')

});
</script>

<!-- // post end -->

<!--Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>

 <!-- jQuery library -->
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>



    <script src="./slick/slick.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript">
        $(document).on('ready', function() {

            $(".center").slick({
                dots: true,
                infinite: true,
                centerMode: true,
                slidesToShow: 3,
                slidesToScroll: 3,

            });


        });
    </script>
</body>

</html>
<?php
    
}
?>