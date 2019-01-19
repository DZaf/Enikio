<?php
session_start();
include("db.php");

if (!isset($_SESSION['Loged'])) {
    header("location: index.php");
}


$mysqlconnection = mysqli_connect($db_host, $db_user, $db_password, $db_name);
mysqli_set_charset($mysqlconnection, "utf8");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['state'])) {
        if ($_POST['state'] == 'Delete_Customer') {
            $sql = "Select Delete_Customer( '" . $_POST['name'] . "' );";
            $result = mysqli_query($mysqlconnection, $sql);
        } else if ($_POST['state'] == 'Delete_House') {
            $sql = "Select Delete_House( " . $_POST['id'] . " );";
            $result = mysqli_query($mysqlconnection, $sql);
        } else if ($_POST['state'] == 'Delete_Mail') {
            $sql = "Select Delete_Mailvirification( '" . $_POST['mail'] . "');";
            $result = mysqli_query($mysqlconnection, $sql);
        } else if ($_POST['state'] == 'Delete_Phone') {
            $sql = "Select Delete_Phones( " . $_POST['HouseID'] . "," . $_POST['phone'] . ");";
            $result = mysqli_query($mysqlconnection, $sql);
        } else if ($_POST['state'] == 'Delete_Photo') {
            $sql = "Select Delete_Photo( " . $_POST['HouseID'] . ",'" . $_POST['path'] . "');";
            $result = mysqli_query($mysqlconnection, $sql);
        } else if ($_POST['state'] == 'Delete_Favorite') {
            $sql = "Select Delete_Favorite( '" . $_POST['email'] . "'," . $_POST['HouseID'] . ");";
            $result = mysqli_query($mysqlconnection, $sql);
        }
    }
}


$sql = "Select * from customer";
$result = mysqli_query($mysqlconnection, $sql);
$req_num_rows = mysqli_num_rows($result);
$json = mysqli_fetch_all($result, MYSQLI_ASSOC);

$sql1 = "Select * from house";
$result1 = mysqli_query($mysqlconnection, $sql1);
$req_num_rows1 = mysqli_num_rows($result1);
$json1 = mysqli_fetch_all($result1, MYSQLI_ASSOC);

$sql2 = "Select * from favorite";
$result2 = mysqli_query($mysqlconnection, $sql2);
$req_num_rows2 = mysqli_num_rows($result2);
$json2 = mysqli_fetch_all($result2, MYSQLI_ASSOC);

$sql3 = "Select * from phones";
$result3 = mysqli_query($mysqlconnection, $sql3);
$req_num_rows3 = mysqli_num_rows($result3);
$json3 = mysqli_fetch_all($result3, MYSQLI_ASSOC);

$sql4 = "Select * from mailverification";
$result4 = mysqli_query($mysqlconnection, $sql4);
$req_num_rows4 = mysqli_num_rows($result4);
$json4 = mysqli_fetch_all($result4, MYSQLI_ASSOC);

$sql5 = "Select * from photos";
$result5 = mysqli_query($mysqlconnection, $sql5);
$req_num_rows5 = mysqli_num_rows($result5);
$json5 = mysqli_fetch_all($result5, MYSQLI_ASSOC);

$sql6 = "Select * from City";
$result6 = mysqli_query($mysqlconnection, $sql6);
$req_num_rows6 = mysqli_num_rows($result6);
$json6 = mysqli_fetch_all($result6, MYSQLI_ASSOC);

$sql7 = "SELECT * FROM Admins;";
$result7 = mysqli_query($mysqlconnection, $sql7);
$req_num_rows7 = mysqli_num_rows($result7);
$json7 = mysqli_fetch_all($result7, MYSQLI_ASSOC);


$sql8 = "SELECT * FROM API_Config;";
$result8 = mysqli_query($mysqlconnection, $sql8);
$req_num_rows8 = mysqli_num_rows($result8);
$json8 = mysqli_fetch_all($result8, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<Html>
    <head>
        <meta charset="utf-8">
        <title>Enikio Admin </title>
        <meta name="description" content="Enikio Admin">
        <!-- Latest compiled and minified CSS -->
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <style>.back-to-top {
                cursor: pointer;
                position: fixed;
                bottom: 20px;
                right: 20px;
                display:none;
            }</style>

        <script>$(document).ready(function () {
                $(window).scroll(function () {
                    if ($(this).scrollTop() > 50) {
                        $('#back-to-top').fadeIn();
                    } else {
                        $('#back-to-top').fadeOut();
                    }
                });
                // scroll body to 0px on click
                $('#back-to-top').click(function () {
                    $('#back-to-top').tooltip('hide');
                    $('body,html').animate({
                        scrollTop: 0
                    }, 800);
                    return false;
                });

                $('#back-to-top').tooltip('show');

            });</script>
        <script>
            $(document).ready(function () {
                $('.Delete_Customer').click(function () {
                    if (confirm('Are you sure you want to Delete this customer?')) {
                        $.ajax({
                            url: 'Home.php',
                            method: 'POST',
                            data: {name: $(this).attr('name'), state: 'Delete_Customer'},
                            success: function (data)
                            {
                                location.reload();
                            }
                        });
                    }
                });
            });


            $(document).ready(function () {
                $('.Delete_House').click(function () {
                    if (confirm('Are you sure you want to Delete this House?')) {
                        $.ajax({
                            url: 'Home.php',
                            method: 'POST',
                            data: {id: $(this).attr('name'), state: 'Delete_House'},
                            success: function (data)
                            {
                                location.reload();
                            }
                        });
                    }
                });
            });

            $(document).ready(function () {
                $('.Delete_Mail').click(function () {
                    if (confirm('Are you sure you want to Delete this Mail Verification?')) {
                        $.ajax({
                            url: 'Home.php',
                            method: 'POST',
                            data: {mail: $(this).attr('name'), state: 'Delete_Mail'},
                            success: function (data)
                            {
                                location.reload();
                            }
                        });
                    }
                });
            });
            $(document).ready(function () {
                $('.Delete_Phone').click(function () {
                    if (confirm('Are you sure you want to Delete this Phone?')) {
                        $.ajax({
                            url: 'Home.php',
                            method: 'POST',
                            data: {HouseID: $(this).attr('id'), phone: $(this).attr('name'), state: 'Delete_Phone'},
                            success: function (data)
                            {
                                location.reload();
                            }
                        });
                    }
                });
            });

            $(document).ready(function () {
                $('.Delete_Photo').click(function () {
                    if (confirm('Are you sure you want to Delete this Photo?')) {
                        $.ajax({
                            url: 'Home.php',
                            method: 'POST',
                            data: {HouseID: $(this).attr('id'), path: $(this).attr('name'), state: 'Delete_Photo'},
                            success: function (data)
                            {
                                location.reload();
                            }
                        });
                    }
                });
            });

            $(document).ready(function () {
                $('.Delete_Favorite').click(function () {
                    if (confirm('Are you sure you want to Delete this Favorite?')) {
                        $.ajax({
                            url: 'Home.php',
                            method: 'POST',
                            data: {email: $(this).attr('id'), HouseID: $(this).attr('name'), state: 'Delete_Favorite'},
                            success: function (data)
                            {
                                location.reload();
                            }
                        });
                    }
                });
            });



        </script> 
         <script> function copyToClipboard(elementId) {


                var aux = document.createElement("input");
                aux.setAttribute("value", document.getElementById(elementId).innerHTML);
                document.body.appendChild(aux);
                aux.select();
                document.execCommand("copy");

                document.body.removeChild(aux);

            }</script>



    </head>
    <body>
        <!-- Second navbar for categories -->
        <nav class="navbar navbar-default">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Enikio Admin Panel</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="active"><a href="Home.php">Home</a></li>
                        <li><a href="API.php">API</a></li>
                        <li><a href="Commands.php">Commands</a></li>
                        <li><a href="Reports.php">Reports</a></li>
                        <li><a href="Log.php">Log File</a></li>
                        <li><a href="Logout.php">Logout</a></li>
                        <li>
                            <a class="btn btn-default btn-outline btn-circle collapsed"  data-toggle="collapse" href="#nav-collapse1" aria-expanded="false" aria-controls="nav-collapse1">Categories</a>
                        </li>
                    </ul>
                    <ul class="collapse nav navbar-nav nav-collapse" id="nav-collapse1">
                        <li><a href="#page1">Customers</a></li>
                        <li><a href="#page2">House</a></li>
                        <li><a href="#page3">Mail Verification Page</a></li>
                        <li><a href="#page4">Phones</a></li>
                        <li><a href="#page5">Photos</a></li>
                        <li><a href="#page6">Favorite</a></li>
                        <li><a href="#page7">Cities</a></li>
                        <?php
                        if ($_SESSION['Loged'] == 'Super_Admin') {
                            ?>
                            <li><a href="#page8">Admins</a></li>
                            <li><a href="#page9">API Keys</a></li>
                        <?php } ?>
                    </ul>

                </div><!-- /.navbar-collapse -->
            </div><!-- /.container -->
        </nav><!-- /.navbar -->
        <div id="page1" class="container-fluid" style="background-color: whitesmoke" >
            <div class="container">
                <div class="col-sm-8"><H3  > Customers </H3> </div><div class="col-sm-4" dir="rtl"> <br> <a   class="btn btn-primary" href="#page2"> <span class="glyphicon glyphicon-arrow-down"></span> Next Table  <span class="glyphicon glyphicon-arrow-down"></span> </a></div>
                 <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <?php if (($_SESSION['Loged'] == 'Super_Admin')) {
                                ?>
                                <th>Password</th>
                            <?php } ?>
                            <th>House Count</th>
                            <th>Phone Number</th>
                            <th>Reports Taken</th>
                            <th>Register Date</th>
                            <?php
                            if ($_SESSION['Loged'] == 'Super_Admin') {
                                ?>
                                <th>Delete</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i = 0; $i < $req_num_rows; $i++) { ?>
                            <tr>
                                <th scope="row"> <?php echo $i + 1 ?></th>
                                <td><?php echo $json[$i]['firstName'] ?></td>
                                <td><?php echo $json[$i]['lastName'] ?></td>
                                <td><?php echo $json[$i]['email'] ?></td>
                                <?php if (($_SESSION['Loged'] == 'Super_Admin')) {
                                    ?>
                                    <td><?php
                                        echo $json[$i]['password'];
                                    }
                                    ?></td>

                                <td><?php echo $json[$i]['houseCount'] ?></td>
                                <td><?php echo $json[$i]['phoneNumber'] ?></td>
                                <td><?php echo $json[$i]['reportsTaken'] ?></td>
                                <td><?php echo $json[$i]['registerDate'] ?></td>
                                <?php
                                if ($_SESSION['Loged'] == 'Super_Admin') {
                                    ?>
                                    <td><button type='submit' name='<?php echo $json[$i]['email'] ?>' class='btn btn-danger Delete_Customer' >Delete</button></td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>



            </div>  
            <!-- / . container-fluid -->
        </div>
        <!-- / . container -->
        <div id="page2" class="container-fluid" >
            <div class="container">
                <div class="col-sm-8"><H3 > House </H3> </DIV><div class="col-sm-4" dir="rtl"> <br> <a   class="btn btn-primary" href="#page3"> <span class="glyphicon glyphicon-arrow-down"></span> Next Table  <span class="glyphicon glyphicon-arrow-down"></span> </a></div>
                <table class="table table-sm table-responsive">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>House ID</th>
                            <th>Email</th>
                            <th>Νομός</th>
                            <th>Πόλη</th>
                            <th>Περιοχή</th>
                            <th>ΤΜ</th>
                            <th>Τιμή</th>
                            <th>Όροφος</th>
                            <th>Διεύθυνση</th>
                            <th>Γεωγραφικό Πλάτος</th>
                            <th>Γεωγραφικό Μήκος</th>
                            <th>Επιπλομένο</th>
                            <th>A/C</th>
                            <th>Τζάκι</th>
                            <th>Κύπος</th>
                            <th>Πισίνα</th>
                            <th>Ανελκυστήρας</th>
                            <th>Αποθήκη</th>
                            <th>Βεράντα</th>
                            <th>Ηλιακός</th>
                            <th>Parking</th>
                            <th>Θέα</th>
                            <th>Νοικιασμένο</th>
                            <th>Ημ.Κατασκευής</th>
                            <th>Ημ.Ανανέωσης</th>
                            <th>Περιγραφή</th>
                            <th>Τύπος</th>
                            <th>Είδος θέρμανσης</th>
                            <th>Μέσο θέρμανσης</th>
                            <th>Αριθμός Δοματίων</th>
                            <th>Reports</th>
                            <?php
                            if ($_SESSION['Loged'] == 'Super_Admin') {
                                ?>
                                <th>Delete</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i = 0; $i < $req_num_rows1; $i++) { ?>
                            <tr>
                                <th scope="row"> <?php echo $i + 1 ?></th>
                                <td><?php echo $json1[$i]['houseID'] ?></td>
                                <td><?php echo $json1[$i]['customerMail'] ?></td>
                                <td><?php echo $json1[$i]['nomos'] ?></td>
                                <td><?php echo $json1[$i]['poli'] ?></td>
                                <td><?php echo $json1[$i]['perioxi'] ?></td>
                                <td><?php echo $json1[$i]['tm'] ?></td>
                                <td><?php echo $json1[$i]['Timi'] ?></td>
                                <td><?php echo $json1[$i]['orofos'] ?></td>
                                <td><?php echo $json1[$i]['dieuthinsi'] ?></td>
                                <td><?php echo $json1[$i]['geografikoPlatos'] ?></td>
                                <td><?php echo $json1[$i]['geografikoMikos'] ?></td>
                                <td><?php echo $json1[$i]['epiplomeno'] ?></td>
                                <td><?php echo $json1[$i]['ac'] ?></td>
                                <td><?php echo $json1[$i]['tzaki'] ?></td>
                                <td><?php echo $json1[$i]['kipos'] ?></td>
                                <td><?php echo $json1[$i]['pisina'] ?></td>
                                <td><?php echo $json1[$i]['anelkistiras'] ?></td>
                                <td><?php echo $json1[$i]['apothiki'] ?></td>
                                <td><?php echo $json1[$i]['beranta'] ?></td>
                                <td><?php echo $json1[$i]['IliakosThermosifwnas'] ?></td>
                                <td><?php echo $json1[$i]['parking'] ?></td>
                                <td><?php echo $json1[$i]['thea'] ?></td>
                                <td><?php echo $json1[$i]['noikiasmeno'] ?></td>
                                <td><?php echo $json1[$i]['imerominiaKataskebis'] ?></td>
                                <td><?php echo $json1[$i]['imerominiaAnaneosis'] ?></td>
                                <td><?php echo $json1[$i]['perigrafi'] ?></td>
                                <td><?php echo $json1[$i]['tupos'] ?></td>
                                <td><?php echo $json1[$i]['eidosThermansis'] ?></td>
                                <td><?php echo $json1[$i]['mesoThermansis'] ?></td>
                                <td><?php echo $json1[$i]['arithmosDomatiwn'] ?></td>
                                <td><?php echo $json1[$i]['Reports'] ?></td>
                                <?php
                                if ($_SESSION['Loged'] == 'Super_Admin') {
                                    ?>
                                    <td><button type='submit' name='<?php echo $json1[$i]['houseID'] ?>' class='btn btn-danger Delete_House' >Delete</button></td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>



            </div>  
            <!-- / . container-fluid -->
        </div>
        <!-- / . container -->



        <div id="page3" class="container-fluid" style="background-color: whitesmoke" >
            <div class="container">
                <div class="col-sm-8"><H3 > Mail Verification </H3> </DIV><div class="col-sm-4" dir="rtl"> <br> <a   class="btn btn-primary" href="#page4"> <span class="glyphicon glyphicon-arrow-down"></span> Next Table  <span class="glyphicon glyphicon-arrow-down"></span> </a></div>
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Email</th>
                            <th>Link</th>
                            <?php
                            if ($_SESSION['Loged'] == 'Super_Admin') {
                                ?>
                                <th>Delete</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i = 0; $i < $req_num_rows4; $i++) { ?>
                            <tr>
                                <th scope="row"> <?php echo $i + 1 ?></th>
                                <td><?php echo $json4[$i]['email'] ?></td>
                                <td><?php echo $json4[$i]['link'] ?></td>
                                <?php
                                if ($_SESSION['Loged'] == 'Super_Admin') {
                                    ?>
                                    <td><button type='submit' name='<?php echo $json4[$i]['email'] ?>' class='btn btn-danger Delete_Mail' >Delete</button></td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>



            </div>  
            <!-- / . container-fluid -->
        </div>
        <!-- / . container -->


        <div id="page4" class="container-fluid"  >
            <div class="container">
                <div class="col-sm-8"><H3 > Phones </H3></DIV> <div class="col-sm-4" dir="rtl"> <br> <a   class="btn btn-primary" href="#page5"> <span class="glyphicon glyphicon-arrow-down"></span> Next Table  <span class="glyphicon glyphicon-arrow-down"></span> </a></div>
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>House ID</th>
                            <th>phone</th>
                            <?php
                            if ($_SESSION['Loged'] == 'Super_Admin') {
                                ?>
                                <th>Delete</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i = 0; $i < $req_num_rows3; $i++) { ?>
                            <tr>
                                <th scope="row"> <?php echo $i + 1 ?></th>
                                <td><?php echo $json3[$i]['houseID'] ?></td>
                                <td><?php echo $json3[$i]['phone'] ?></td>
                                <?php
                                if ($_SESSION['Loged'] == 'Super_Admin') {
                                    ?>
                                    <td><button type='submit' id='<?php echo $json3[$i]['houseID'] ?>' name='<?php echo $json3[$i]['phone'] ?>' class='btn btn-danger Delete_Phone' >Delete</button></td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>



            </div>  
            <!-- / . container-fluid -->
        </div>
        <!-- / . container -->

        <div id="page5" class="container-fluid" style="background-color: whitesmoke"  > 
            <div class="container">
                <div class="col-sm-8"><H3 > Photos </H3></DIV><div class="col-sm-4" dir="rtl"> <br> <a   class="btn btn-primary" href="#page6"> <span class="glyphicon glyphicon-arrow-down"></span> Next Table  <span class="glyphicon glyphicon-arrow-down"></span> </a></div>
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>House ID</th>
                            <th>Path</th>
                            <?php
                            if ($_SESSION['Loged'] == 'Super_Admin') {
                                ?>
                                <th>Delete</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i = 0; $i < $req_num_rows5; $i++) { ?>
                            <tr>
                                <th scope="row"> <?php echo $i + 1 ?></th>
                                <td><?php echo $json5[$i]['houseId'] ?></td>
                                <td><?php echo $json5[$i]['path'] ?></td>
                                <?php
                                if ($_SESSION['Loged'] == 'Super_Admin') {
                                    ?>
                                    <td><button type='submit' id='<?php echo $json5[$i]['houseID'] ?>' name='<?php echo $json5[$i]['path'] ?>' class='btn btn-danger Delete_Photo' >Delete</button></td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>



            </div>  
            <!-- / . container-fluid -->
        </div>
        <!-- / . container -->


        <div  id="page6" class="container-fluid"  >
            <div class="container">
                <div class="col-sm-8"><H3 > Favorite </H3></DIV> <div class="col-sm-4" dir="rtl"> <br> <a   class="btn btn-primary" href="#page7"> <span class="glyphicon glyphicon-arrow-down"></span> Next Table  <span class="glyphicon glyphicon-arrow-down"></span> </a></div>
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Email</th>
                            <th>House ID</th>
                            <?php
                            if ($_SESSION['Loged'] == 'Super_Admin') {
                                ?>
                                <th>Delete</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i = 0; $i < $req_num_rows2; $i++) { ?>
                            <tr>
                                <th scope="row"> <?php echo $i + 1 ?></th>
                                <td><?php echo $json2[$i]['email'] ?></td>
                                <td><?php echo $json2[$i]['houseID'] ?></td>
                                <?php
                                if ($_SESSION['Loged'] == 'Super_Admin') {
                                    ?>
                                    <td><button type='submit' id='<?php echo $json2[$i]['email'] ?>' name='<?php echo $json2[$i]['houseID'] ?>' class='btn btn-danger Delete_Favorite' >Delete</button></td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>



            </div>  
            <!-- / . container-fluid -->
        </div>
        <!-- / . container -->

        <div id="page7" class="container-fluid" style="background-color: whitesmoke"  >
            <div class="container">
                <div class="col-sm-8"><H3 > Cities </H3></DIV> <div class="col-sm-4" dir="rtl"> <br> <a   class="btn btn-primary" href="#page8"> <span class="glyphicon glyphicon-arrow-down"></span> Next Table  <span class="glyphicon glyphicon-arrow-down"></span> </a></div>
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>State</th>
                            <th>City</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i = 0; $i < $req_num_rows6; $i++) { ?>
                            <tr>
                                <th scope="row"> <?php echo $i + 1 ?></th>
                                <td><?php echo $json6[$i]['state'] ?></td>
                                <td><?php echo $json6[$i]['cityName'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>



            </div>  
            <!-- / . container-fluid -->
        </div>
        <!-- / . container -->

        <?php
        if (($_SESSION['Loged'] == 'Super_Admin')) {
            ?>


            <div id="page8" class="container">
                <div class="col-sm-8"><H3 > Admins </H3></DIV> <div class="col-sm-4" dir="rtl"> <br> <a   class="btn btn-primary" href="#page9"> <span class="glyphicon glyphicon-arrow-down"></span> Next Table  <span class="glyphicon glyphicon-arrow-down"></span> </a></div>
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Surname</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Privilege</th>
                            <th>Register Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i = 0; $i < $req_num_rows7; $i++) { ?>
                            <tr>
                                <th scope="row"> <?php echo $i + 1 ?></th>
                                <td><?php echo $json7[$i]['Name'] ?></td>
                                <td><?php echo $json7[$i]['Surname'] ?></td>
                                <td><?php echo $json7[$i]['Email'] ?></td>
                                <td><?php echo $json7[$i]['Password'] ?></td>
                                <td><?php echo $json7[$i]['Privilege'] ?></td>
                                <td><?php echo $json7[$i]['RegisterDate'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>



            </div>  
            <!-- / . container-fluid -->
        </div>
        <!-- / . container -->


    <?php }
    ?>

    <?php
    if (($_SESSION['Loged'] == 'Super_Admin')) {
        ?>
        <div id="page9" class="container-fluid" style="background-color: whitesmoke" >
            <div class="container">
                <H3 > API Keys </H3> 
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ID</th>
                            <th>User</th>
                            <th>Key</th>
                            <th>TimesUsed</th>
                            <th>Time Created</th>
                            <th>Privilege</th>
                            <th>Copy Key</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i = 0; $i < $req_num_rows8; $i++) { ?>
                            <tr>
                                <th scope="row"> <?php echo $i + 1 ?></th>
                                <td><?php echo $json8[$i]['ID'] ?></td>
                                <td><?php echo $json8[$i]['Reason'] ?></td>
                                <td id="<?php echo $json8[$i]['ID'] ?>"><?php echo $json8[$i]['Code'] ?></td>
                                <td><?php echo $json8[$i]['TimesUsed'] ?></td>
                                <td><?php echo $json8[$i]['TimeCreated'] ?></td>
                                <td><?php echo $json8[$i]['Privilege'] ?></td>
                                <td><button class="btn btn-default" onclick="copyToClipboard('<?php echo $json8[$i]['ID'] ?>')"><span class="glyphicon glyphicon-copy"></span> Copy Key</button></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>



            </div>  
            <!-- / . container-fluid -->
        </div>
        <!-- / . container -->

        <


    <?php }
    ?>

    <a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button" title="Click to return on the top page" data-toggle="tooltip" data-placement="left"><span class="glyphicon glyphicon-chevron-up"></span></a>

</body>
</html>