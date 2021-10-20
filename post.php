<?php 
require 'php/php.conn.php';
require_once 'php/php.login.php';
if (!isset($_SESSION['mainuser'])) {
    header('location: http://localhost/work/post');
}
if (isset($_GET['on'])) {
    $echo2 = $_GET['on'];
}else {
    $echo2 = "MAIN PAGE";
}

$query6 = "select * from posts order by posts.time desc";
$data = mysqli_query($conn,$query6);
$mainuser = $_SESSION['mainuser'];
function currentlike($conn,$mainuser,$pid){
    $querycurrent = "select * from likes where uid='{$mainuser}' and pid='{$pid}' and likes=1";
    if (0<mysqli_num_rows(mysqli_query($conn,$querycurrent))) {
        return 'done';
    }else {
        return '';
    }
}
function currentdlike($conn,$mainuser,$pid){
    $querycurrent = "select * from likes where uid='{$mainuser}' and pid='{$pid}' and likes=-1";
    if (0<mysqli_num_rows(mysqli_query($conn,$querycurrent))) {
        return 'done';
    }else {
        return '';
    }
}
function likes($conn,$pid1){
    $queryforcountlike1 = "select * from likes where pid ='{$pid1}' and likes = 1";
    return mysqli_num_rows(mysqli_query($conn, $queryforcountlike1));
}
function dislikes($conn,$pid2){
    $queryforcountlike2 = "select * from likes where pid ='{$pid2}' and likes = -1";
    return mysqli_num_rows(mysqli_query($conn, $queryforcountlike2));
}
function deletebtn($mainuser,$uid,$pid){
    return ($mainuser == $uid)?
    '<div class="opt" style="margin-left:10px; cursor: pointer" data-pid="'.$pid.'">X</div>':'';
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css.css">
    <script src="jquery36.js"></script>
</head>
<body>
<!-- ======================== header ====================== -->
<div class="header">
    <div class="logo">
        <h1>POSTiT</h1>
    </div>
    <div style="color: white;font-size:20px"><?php echo $_SESSION['mainuser'] ?></div>
    <div class="nav">
        <a href="http://localhost/work/post/myposts.php"><button>MY POSTS</button></a>
        <a href="http://localhost/work/post/php/php.logout.php"><button class="logout" >LOGOUT</button></a>
    </div>
</div>
<!-- ======================== main ======================= -->
<div class="postbody">
    <?php 
    while ($row = mysqli_fetch_assoc($data)) {      
    ?>
    <div class="allposts" id="<?php echo $_SESSION['mainuser'] ?>">
        <div class="person">
            <div class="name"><?php echo $row['email'] ?></div>
            <div class="time" style="display: flex">
                <?php echo $row['time'] ?>
                <?php echo deletebtn($_SESSION['mainuser'],$row['email'], $row['id']); ?>
            </div>
        </div>
        <div class="context">
            <p><?php echo $row['text'] ?></p>
        </div>
        <div class="posting">
            <img src="uploaded/<?php echo $row['img'] ?>" alt="">
        </div>
        <div class="panel">
            <div class="likes <?php echo currentlike($conn, $mainuser, $row['id']); ?>" style="cursor:pointer" data-pid="<?php echo $row['id']  ?>" data-uid="<?php echo $_SESSION['mainuser'] ?>">
                <img src="ico/up.png" alt="">
                <span class="sl"> <?php echo likes($conn, $row['id']); ?> </span>
            </div>
            <div class="dislikes <?php echo currentdlike($conn, $mainuser, $row['id']); ?>" style="cursor:pointer" data-pid="<?php echo $row['id'] ?>" data-uid="<?php echo $_SESSION['mainuser'] ?>">
                <img src="ico/down.png" alt="">
                <span class="sd"><?php echo dislikes($conn, $row['id']); ?></span>
            </div>
        </div>
    </div>
    <?php } ?>
</div>
<!-- ======================= footer ======================= -->
<?php 
include 'footer.php';

?>
</body>
</html>
<script>
$(document).ready(function () {
// =====================================================

// =====================================================
$('.likes').click(function () { 
    $pid = $(this).data('pid');
    $uid = $(this).data('uid');
    $this = $(this);
    var thisis = $('div[data-pid='+$pid+']');

    $.ajax({
        type: "POST",
        url: "php/php.got.php",
        data: {pid:$pid, uid:$uid, ld:1},
        dataType: "JSON",
        success: function (data) {
            thisis.children('.sl').html(data[0]);
            thisis.children('.sd').html(data[1]);
            if (data[2] == 1) {
                $this.addClass('done');
            }else {
                $this.removeClass('done');
            }
        }
    });
});

$('.dislikes').click(function () { 
    $pid = $(this).data('pid');
    $uid = $(this).data('uid');
    $this = $(this);
    var thisis = $('div[data-pid='+$pid+']');

    $.ajax({
        type: "POST",
        url: "php/php.got.php",
        data: {pid:$pid, uid:$uid, ld:-1},
        dataType: "JSON",
        success: function (data) {
            thisis.children('.sd').html(data[1]);
            thisis.children('.sl').html(data[0]);
            thisis.removeClass('done');
            if (data[2] == -1) {
                $this.addClass('done');
            }else {
                $this.removeClass('done');
            }
        }
    });
});
$('.opt').click(function () { 
    $pid = $(this).attr('data-pid');
    alert($pid);
    $.ajax({
        type: 'POST',
        url: 'php/php.delete.php',
        data: {pid:$pid},
        success: function (data) { 
            location.reload();
        }
    })
})
// =====================================================
});
</script>