<?php
include("db.php");
 $mysqlconnection = mysqli_connect($db_host, $db_user, $db_password, $db_name);
 
if(isset($_REQUEST['mail']) && isset($_REQUEST['link']))
{
    $email=$_REQUEST['mail'];
    $Link=$_REQUEST['link'];
    
    $sql = "Select Mail_Verify('$email', '$Link') as log;";
    $query = mysqli_query($mysqlconnection, $sql);
    $result = mysqli_fetch_array($query);
    if($result["log"]=='1' || $result["log"]=='2' )
    {
         $_SESSION['Loged'] = 'yes';
        header("location: Home.php");
    }
}



?>