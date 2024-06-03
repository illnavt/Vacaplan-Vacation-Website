<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="shortcut icon" href="images/logo.png">
</head>

<style>
    body {
        background-image: url('images/pesawat_2.jpg');
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
    }
</style>

<body>
    <div class="body"></div>
    <div class="grad"></div>
    <div class="header">
        <div><a href="index.php">Vaca<span>Plan</span></a></div>
    </div>
    <br>
    <div class="login">
        <?php
        include "koneksi.php";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST['email'];
            $user = $_POST['name'];
            $fname = $_POST['fullname'];
            $pass = md5($_POST['Password']); // Hash the password using MD5

            // Check if email or username already exists
            $sql = "SELECT * FROM user WHERE email='$email' OR name='$user'";
            $result = $koneksi->query($sql);

            if ($result->num_rows > 0) {
                echo "<p style='color:red; margin-left: 20px;'>Error: Email or Username already exists.</p>";
            } else {
                // Insert data into database
                $sql = "INSERT INTO user (email, name,fullname, password) VALUES ('$email', '$user', '$fname', '$pass')";

                if ($koneksi->query($sql) === TRUE) {
                    echo "<p style='color:green; margin-left: 20px;'>Registration successful!</p>";
                } else {
                    echo "Error: " . $sql . "<br>" . $koneksi->error;
                }
            }
        }
        ?>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="email" placeholder="email" name="email" autocomplete="off" required><br>
            <input type="text" placeholder="username" name="name" autocomplete="off" required><br>
            <input style="margin-top: 12px;" type="text" placeholder="fullname" name="fullname" autocomplete="off" required><br>
            <input type="password" placeholder="password" name="Password" required><br>
            <input type="submit" value="SignUp" name="register"><br>
        </form>
        <a style="color: white;" href="login.php">Already Have An Account?</a>
    </div>

</body>

</html>
