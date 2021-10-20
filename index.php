<?php 
$_GET['on']='';
if (isset($_SESSION['mainuser'])) {
    header('location: http://localhost/work/post/post.php?on='.$_SESSION['mainuser']);
}
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
        <form action="php/php.login.php" method="post">
            <input type="email" name="user" required placeholder="Email..." >
            <input type="password" name="pass" required placeholder="Password..." >
            <button type="submit" name="login" >LOGIN</button>
        </form>
    </div>
</div>
<!-- ========================= main ======================= -->
<div class="mainbody">
    <div class="formcontainer">
        <div class="details">
            <h1>WELCOME</h1>
            <p>new user? sign for free</p>
        </div>
        <div class="register">
            <form action="php/php.signup.php" method="post">
                <input  name="nuser" type="email" required placeholder="Email" >
                <input  name="npass1" type="password" required placeholder="Create Password" >
                <input  name="npass2" type="password" required placeholder="Confirm Password" >
                <button name="signup" type="submit">SIGNUP</button>
            </form>
        </div>
    </div>
</div>
<!-- ======================= footer ======================= -->
<?php 
include 'footer.php';
?>
</body>
</html>