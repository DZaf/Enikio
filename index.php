<?php
session_start();
include("db.php");
if (isset($_SESSION['Loged'])) {
    header("location: Home.php");
}
if (isset($_POST['login'])) {

    $mysqlconnection = mysqli_connect($db_host, $db_user, $db_password, $db_name);

    $email = mysqli_real_escape_string($mysqlconnection, $_POST['Username']);
    $password = mysqli_real_escape_string($mysqlconnection, $_POST['Password']);


    $sql = "Select Admin_Login('$email','".sha1($password)."') as log;";
    $query = mysqli_query($mysqlconnection, $sql);
    $result = mysqli_fetch_array($query);
    if ($result["log"] == '1') {
        
        $sql = "Select * from Admins where Email ='$email';";
        $result = mysqli_query($mysqlconnection, $sql);
        $req_num_rows = mysqli_num_rows($result);
        $json = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $_SESSION['Loged'] = $json[0]['Privilege'];
        header("location: Home.php");
    } else if ($result["log"] == '3') {

        $sql1 = "Select * from mailverification where email='" . $email . "'";
        $result1 = mysqli_query($mysqlconnection, $sql1);
        $req_num_rows = mysqli_num_rows($result1);
        $json = mysqli_fetch_all($result1, MYSQLI_ASSOC);


        $to = "" . $email . "";
        $subject = "Mail Verifivcation";
        $txt = "<!DOCTYPE html>
<html>
<head>
</head>
<body>

<p>Press <b><a href='https://enikioadmin.000webhostapp.com/MailVerification.php?mail=$email&link=" . $json[0]['link'] . "' >here</a></b> in order to verify your mail</p>

</body>
</html>";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers = "From: EnikioAdmin@gmail.com". "\r\n";

        mail($to, $subject, $txt, $headers);
    }
}
?>

<Html>
    <head>
        <meta charset="utf-8">
        <title>Enikio Admin </title>
        <meta name="description" content="Enikio Admin">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <style>
            /* Set height of the grid so .sidenav can be 100% (adjust if needed) */
            .row.content {height: 100%;}

            /* Set gray background color and 100% height */
            .sidenav {
                background-color: #f1f1f1;
                height: 100%;
            }

            /* Set black background color, white text and some padding */
            footer {
                background-color: #555;
                color: white;
                padding: 15px;
            }

            /* On small screens, set height to 'auto' for sidenav and grid */

            .sidenav {
                height: 100%;
                padding: 15px;
            }
            .row.content {height: 100%;} 

            .formContent
            {
                background-color:#f1f1f1;

                padding-right: 70px;
                padding-left: 70px;
                padding-top: 50px;
                padding-bottom: 50px;
                border-radius: 5%;

            }
        </style>
    </HEAD>
    <BODY>
        <div class="container" >
            <center><h3>Login</h3></center>
            <div class="formContent" >
                <form name="Login" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="Post">
                    <input type="text" style="width:100%;" class="form-control" name="Username" placeholder="Email"><Br><Br>
                    <input type="password" style="width:100%;" class="form-control" name="Password" placeholder="Password">
                    <Br>
                    <button type="submit" name="login" class="btn btn-primary">Login</button>
                    <label >
                        &nbsp<?php
                        if (isset($_SESSION['message'])) {
                            echo $_SESSION['message'];
                        }
                        ?>
                    </label>
                </form>
            </div>
        </div>
    </BODY>
</Html>