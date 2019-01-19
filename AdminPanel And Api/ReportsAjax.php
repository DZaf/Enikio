<?php
session_start();
if (!isset($_SESSION['Loged'])) {
    header("location: index.php");

}
include("db.php");
$mysqlconnection = mysqli_connect($db_host, $db_user, $db_password, $db_name);


if (isset($_POST['id'])) {
    echo $_SESSION['id'] = $_POST['id'];
}
if ($_SESSION['id'] == 'All') {

    $sql = "CALL Display_Reports();";
    $result = mysqli_query($mysqlconnection, $sql);
    $req_num_rows = mysqli_num_rows($result);
    $json = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else if ($_SESSION['id'] == 'Opened') {
    $sql = "CALL Display_Opened_Reports();";
    $result = mysqli_query($mysqlconnection, $sql);
    $req_num_rows = mysqli_num_rows($result);
    $json = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else if ($_SESSION['id'] == 'Closed') {
    $sql = "CALL Display_Closed_Reports();";
    $result = mysqli_query($mysqlconnection, $sql);
    $req_num_rows = mysqli_num_rows($result);
    $json = mysqli_fetch_all($result, MYSQLI_ASSOC);
}





for ($i = 0; $i < $req_num_rows; $i++) {
                           print"<tr><th scope='row'>" . (int) ($i + 1) . "
                           </th><td>" . $json[$i]['ID'] . "</td>
                                <td>" . $json[$i]['email'] . "</td>
                                <td>" . $json[$i]['houseID'] . "</td>
                                <td>" . $json[$i]['reason'] . "</td>
                                <td>" . $json[$i]['comment'] . "</td>
                                <td>" . $json[$i]['reportDate'] . "</td>
                                <td>" . $json[$i]['status'] . "</td>
                                <td> <a target='_blank' href='https://enoikioalpha.000webhostapp.com/HouseView.php?var=" . $json[$i]['houseID'] . "'> click here </a></td>";
                                    
if($_SESSION['Loged']!='Moderator')
{
                          print "<td><button type='submit'id='" . $json[$i]['ID'] ."' name='" . $json[$i]['email'] ."' class='btn btn-primary Blame_Customer'>Blame Customer </button></td>  
                                <td><button type='submit' id='" . $json[$i]['ID'] ."' name='" . $json[$i]['houseID'] ."'  class='btn btn-info Blame_Owner'>Blame Owner</button></td>
                                <td><button type='submit' id='" . $json[$i]['ID'] ." 'class='btn btn-warning Ignore'>Ignore</button></td>";
}}




print "<script>  $(document).ready(function () {
                $('.Blame_Customer').click(function () {
                if (confirm('Are you sure you want to Blame the Customer?')) {
                    $.ajax({
                        url: 'Reports.php',
                        method: 'POST',
                        data: {ID: $(this).attr('id'),email: $(this).attr('name'),state:'Blame_Customer'},
                    });
                    }
                });
            }); 
            

 $(document).ready(function () {
                $('.Blame_Owner').click(function () {
                if (confirm('Are you sure you want to Blame the Owner?')) {
                    $.ajax({
                        url: 'Reports.php',
                        method: 'POST',
                        data: {ID: $(this).attr('id'),Houseid: $(this).attr('name'),state:'Blame_Owner'},
                    });
                    }
                });
            });



$(document).ready(function () {
                $('.Ignore').click(function () {
                if (confirm('Are you sure you want to Ignore this Report?')) {
                    $.ajax({
                        url: 'Reports.php',
                        method: 'POST',
                        data: {ID: $(this).attr('id'),state:'Ignore'},
                            
                    });
                    }
                });
            });

</script> ";


?>