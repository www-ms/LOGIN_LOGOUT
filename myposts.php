<?php 
$echo2 = $_GET['on'];
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
    <div class="nav">
            <a href="http://localhost/work/post/post.php"><button>POSTS</button></a>
            <a href="http://localhost/work/post/php/php.logout.php"><button class="logout" >LOGOUT</button></a>
    </div>
</div>
<!-- ======================== main ======================= -->
<div class="postbody">
    <form class="allposts" action="php/php.done.php" method="post" enctype="multipart/form-data">
            <h4>say something</h4>
            <input type="text" name="text">
            <input type="file" name="file">
            <button type="submit" name="upload">POST</button>
    </form>
</div>
<!-- ======================= footer ======================= -->
<?php 
include 'footer.php';
?>
</body>
</html>