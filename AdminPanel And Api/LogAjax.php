<?php
session_start();
if (!isset($_SESSION['Loged'])) {
    header("location: index.php");

}
include("db.php");
$mysqlconnection = mysqli_connect($db_host, $db_user, $db_password, $db_name);


$sql = "Select * from log ORDER BY dates DESC, logId DESC";
$result = mysqli_query($mysqlconnection, $sql);
$req_num_rows = mysqli_num_rows($result);
$json = mysqli_fetch_all($result, MYSQLI_ASSOC);





for ($i = 0; $i < $req_num_rows; $i++) {
    print"<tr><th scope='row'>" . $i . "
                                <td>" . $json[$i]['logId'] . "</td>
                                <td>" . $json[$i]['actions'] . "</td>
                                <td>" . $json[$i]['comments'] . "</td>
                                <td>" . $json[$i]['dates'] . "</td>";

         
}

?>