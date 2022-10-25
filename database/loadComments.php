<?php
if(isset($_POST['comment-btn']))
{
  $pid=$_POST['pid'];
}
?>

<div id="dynamic">
    <br>
    <h4>Votes & Comments</h4>
    <hr style="background: #dcdcdc;">
    <span class="w3-right w3-opacity"><button id="close-popUp" style="
    border: none;
    position: absolute;
    top: 23px;
    right: 2%;
    background: white;font-size: 16px;
    color: #d1d1d1;
"><i class="fa fa-times"></i></button></span>


    <div id="comment-like-div" style="background:#fff; box-shadow:0px 0px 100px 5px white;">
    </div>

    <button type="button" data-pid='<?php echo $pid ?>'
        class="all-likes w3-button w3-theme-d1 w3-margin-bottom btn" style="color: #8d8d8d!important;
    background-color: #f1f1f1!important;
    border-radius: 20px;font-size: 14px;">
        <!-- <i class="fa fa-thumbs-up"></i>  -->
        All Votes</button>
    <button type="button" data-pid='<?php echo $pid ?>'
        class="all-comments w3-button w3-theme-d1 w3-margin-bottom btn" style="color: #8d8d8d!important;
    background-color: #f1f1f1!important;
    border-radius: 20px;font-size: 14px;">
        <!-- <i class="fa fa-comment"></i>  -->
        All Comments</button>

    <div>
        <input type="text" name="comment-text" id="comment-text" placeholder="Write Your Comment Here" style="border:1px solid #57707d26!important;border-radius: 20px!important;">
        <button type="button" data-pid='<?php echo $pid ?>'
            class=" insert-comment w3-button w3-theme-d2 w3-margin-bottom btn" style="
    color: #5076ff!important;
    font-weight: 500;
">
            <!-- <i class="fa fa-comment"></i>  -->
            <!-- <i class="fa fa-sign-in"></i> -->
            &nbsp; Send
        </button>
    </div>


    <hr class="w3-clear">

    <!-- <div id="comment-like-div" style="background:#fff; box-shadow:0px 0px 100px 5px white">
    </div> -->
</div>

<script>
$(document).ready(function() {
    //        when pop up div is loaded then load all comment  for first time
    var pid = "<?php echo $pid ?>";
    postId = new FormData();
    postId.append("pid", pid);

    $.ajax({
        method: 'post',
        url: "database/postFunctions.php",
        cache: false,
        data: postId,
        contentType: false,
        processData: false,
        success: function(loadData) { // here uptp latest appended data
            $("#comment-like-div").html(loadData);
        }
    });
});


$(".insert-comment").click(function() {
    //        insert comemnt into comment database and load after insertion
    $comment_text = $("#comment-text").val();
    var $this = $(this);
    pid = $this.data("pid");
    if ($comment_text != "") {

        $("#comment-text").val("");
        postId = new FormData();
        postId.append("pid", pid);
        postId.append("comment", $comment_text);
        postId.append("btn", "insert");
        $.ajax({
            method: 'post',
            url: "database/postFunctions.php",
            cache: false,
            data: postId,
            contentType: false,
            processData: false,
            success: function(loadData) { // here uptp latest appended data
                $("#comment-like-div").html(loadData);
            }
        });
    } else
        window.alert("write your comment");
    //       (/ database) is bcoz 1st time output is going to home page which is outside of database          then next time it would be located from home pahe not from this dir 
});


$(".all-likes").click(function() {
    //       load all like from likes atble using ajax
    var $this = $(this);
    pid = $this.data("pid");
    postId = new FormData();
    postId.append("pid", pid);
    postId.append("btn", "like");
    $.ajax({
        method: 'post',
        url: "database/postFunctions.php",
        cache: false,
        data: postId,
        contentType: false,
        processData: false,
        success: function(loadData) { // here uptp latest appended data
            $("#comment-like-div").html(loadData);
        }
    });
});


$(".all-comments").click(function() {
    // load all like from likes atble using ajax
    var $this = $(this);
    pid = $this.data("pid");
    postId = new FormData();
    postId.append("pid", pid);
    postId.append("btn", "allComments");
    $.ajax({
        method: 'post',
        url: "database/postFunctions.php",
        cache: false,
        data: postId,
        contentType: false,
        processData: false,
        success: function(loadData) { // here uptp latest appended data
            $("#comment-like-div").html(loadData);
        }
    });
});


$("#close-popUp").click(function() {
    $("#pop-up-div").css("display", "none");

});
</script>