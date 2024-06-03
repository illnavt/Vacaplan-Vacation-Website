<?php
// include("koneksi.php");
include("kode.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="">
    <link rel="shortcut icon" href="images/logo.png">

</head>

<style>
    body {
        background-image: url('images/gunung_bg.jpg');
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
    }

    .header {
        position: absolute;
        top: calc(50% - 35px);
        left: calc(50% - 255px);
        z-index: 2;
    }

    .header a {
        text-decoration: none;
        color: inherit;
    }

    .header div {
        float: left;
        color: #fff;
        font-family: 'Exo', sans-serif;
        font-size: 35px;
        font-weight: 200;
    }

    .header div span {
        color: #5379fa !important;
    }

    .login a {
        font-size: 15px;
        padding-left: 2.5em;
    }

    .login {
        position: absolute;
        top: calc(50% - 75px);
        left: calc(50% - 50px);
        height: 150px;
        width: 350px;
        padding: 10px;
        z-index: 2;
    }


    .login input[type=text] {
        width: 250px;
        height: 30px;
        background: transparent;
        border: 1px solid rgba(255, 255, 255, 0.6);
        border-radius: 2px;
        color: #fff;
        font-family: 'Exo', sans-serif;
        font-size: 16px;
        font-weight: 400;
        padding: 4px;
    }

    .login input[type=email] {
        width: 250px;
        height: 30px;
        background: transparent;
        border: 1px solid rgba(255, 255, 255, 0.6);
        border-radius: 2px;
        color: #fff;
        font-family: 'Exo', sans-serif;
        font-size: 16px;
        font-weight: 400;
        padding: 4px;
        margin-bottom: 0.625em;
    }

    .login input[type=password] {
        width: 250px;
        height: 30px;
        background: transparent;
        border: 1px solid rgba(255, 255, 255, 0.6);
        border-radius: 2px;
        color: #fff;
        font-family: 'Exo', sans-serif;
        font-size: 16px;
        font-weight: 400;
        padding: 4px;
        margin-top: 10px;
    }

    .login input[type=submit] {
        width: 260px;
        height: 35px;
        background: #fff;
        border: 1px solid #fff;
        cursor: pointer;
        border-radius: 2px;
        color: #a18d6c;
        font-family: 'Exo', sans-serif;
        font-size: 16px;
        font-weight: 400;
        padding: 6px;
        margin-top: 10px;
        /* margin-bottom: 9px; */
    }

    .login input[type=submit]:hover {
        opacity: 0.8;
    }

    .login input[type=submit]:active {
        opacity: 0.6;
    }

    .login input[type=text]:focus {
        outline: none;
        border: 1px solid rgba(255, 255, 255, 0.9);
    }

    .login input[type=password]:focus {
        outline: none;
        border: 1px solid rgba(255, 255, 255, 0.9);
    }

    .login input[type=submit]:focus {
        outline: none;
    }

    ::-webkit-input-placeholder {
        color: rgba(255, 255, 255, 0.6);
    }

    ::-moz-input-placeholder {
        color: rgba(255, 255, 255, 0.6);
    }
</style>

<body style="background-image: url('images/gunung_bg.jpg');">
    <div class="header">
        <div><a class="" href="index.php">Vaca<span>Plan</span></a></div>
    </div>
    <br>
    <div class="login">
        <?php if (!empty($err)): ?>
            <div class="eror-msg">
                <?php echo $err; ?>
            </div>
        <?php endif; ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="text" placeholder="username" name="username"><br>
            <input type="password" placeholder="password" name="password"><br>
            <input type="submit" value="Login" name="Login">
            <input type="submit" value="Login Admin" name="admin">
            <!-- <input type="submit" value="SignUp" name="SignUp"> -->
        </form>
        <a style="color: white; margin-left: 37px;" href="register.php">Create An Account</a>
    </div>
</body>

</html>