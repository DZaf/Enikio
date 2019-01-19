<?php
session_start();
unset($_SESSION['jsonData']);
if (isset($_SESSION["email"])) {
    

$json = file_get_contents("https://enikioadmin.000webhostapp.com/Customers/CustomerOperations.php?key=c2290a04219c2f1e211a9fb3559e5fd810890109&operation=3&email=" . $_SESSION['email'] );
$object = json_decode($json, true);
//echo json_encode($object, JSON_PRETTY_PRINT);
$num_rows = count($object);
    ?>
<!DOCTYPE html>
<head>

    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Προφίλ</title>


    <!-- Custom styles for this template -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="Footer.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/33070007c5.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://apis.google.com/js/client:platform.js?onload=renderButton" async defer></script>
    <!--<script src="jquery.min.js"></script>-->

    <meta name="google-signin-client_id" content="262423662224-ucndqhmpm5v2itdkr4b3msob3ravn083.apps.googleusercontent.com">


    <style>

        #profile{
            color: #222222;   
        }

        .user-row {
            margin-bottom: 14px;
        }

        .user-row:last-child {
            margin-bottom: 0;
        }

        .dropdown-user {
            margin: 13px 0;
            padding: 5px;
            height: 100%;

        }

        .dropdown-user:hover {
            cursor: pointer;
        }

        .table-user-information > tbody > tr {
            border-top: 1px solid rgb(235, 55, 81);
        }

        .table-user-information > tbody > tr:first-child {
            border-top: 0;
        }


        .table-user-information > tbody > tr > td {
            border-top: 0;
        }
        .toppad
        {margin-top:20px;
        }

        .panel-info > .panel-heading {
            color: #ff5a5f;
            background-color: #ff5a5f;
            border-color: #EB3751;
        }
        .control-label .text-info { display:inline-block; }
    </style>


    <script>
        $(document).ready(function () {
            $('#edit').click(function () {
                var text = $('.text-info').text();
                var input = $('<input id="attribute" value="' + text + '" />');
                $('.text-info').text('').append(input);
                input.select();

                input.blur(function () {
                    var text = $('#attribute').val();
                    $('#attribute').parent().text(text);
                    $('#attribute').remove();
                });
            });
        });
    </script>


</head>
<body>


    <!--Navigation -->
    <?php include 'navBar.php'; ?>
    <Br><br><Br><br>

    <div class="container" >
        <div class="row">
            <div class="col-lg-1 col-sm-0"></div>

            <div class="col-lg-11 col-sm-12">
                <ol class="breadcrumb" style="background-color: #ff5a5f;margin-top:10px;">
                            <li><a href="index.php" style="color:white">Home</a></li>
                            <li class="active" style="color:whitesmoke"><?php echo $object[0]['firstName']?></li>
                        </ol>
                <div style="padding:0px 400px 0px 0px">
                    <div class="panel panel-info" >
                        <div class="panel-heading">
                            <h3 class="panel-title" style="font-size:20px;color:#fff"><b>Διαχείρηση Λογαριασμού</b></h3>
                        </div>
                        <div class="panel-body" style="background-color:whitesmoke;">
                            <div class="row">
                                <div class="col-md-3 col-lg-3 " align="center">
                                    <img alt="User Pic" src="Image_from_Skype.png" class="img-circle img-responsive">
                                    <br>
                                    <button data-original-title="Contact User" data-toggle="tooltip" type="button" style="border: none;background-color: whitesmoke"><i style="font-size:30px;color:slategray" class="fa fa-envelope"></i></button>
                                    <button href="#" id="edit" data-original-title="Edit my profile" data-toggle="tooltip" type="button" style="border: none;background-color: whitesmoke"><i style="font-size:30px;color:goldenrod" class="fa fa-pencil"></i></button>
                                </div>
                                <div class=" col-md-9 col-lg-9 "> 
                                    <table  id="form" class="table table-user-information" >
                                        <tbody>
                                            <tr>
                                                <td><p><b>Όνομα</b></p></td>
                                                <td>
                                                    <label style="font-weight: normal" for="name" class="control-label"><p style="color:#333333" class="text-info"><?php echo $object[0]['firstName']?></p></label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><p><b>Επίθετο</b></p></td>
                                                <td><?php echo $object[0]['lastName']?></td>
                                            </tr>
                                            <tr>
                                                <td><p><b>Ημερομηνία εγγραφής</b></p></td>
                                                <td><?php echo $object[0]['registerDate']?></td>
                                            </tr>

                                            <tr>
                                            <tr>
                                                <td><p><b>Ιδιότητα</b></p></td>
                                                <td>Mεσίτης</td>
                                            </tr>
                                            <tr>
                                                <td><p><b>Email</b></p></td>
                                                <td><a href="mailto:example@gmail.com"><?php echo $object[0]['email']?></a></td>
                                            </tr>
                                            <tr>
                                                <td><p><b>Τηλέφωνο</b></p></td>
                                                <td><?php echo $object[0]['phoneNumber']?></td>
                                            </tr>
                                            <tr>
                                                <td><p><b>Ανεβασμένες αγγελίες</b></p></td>
                                                <td><?php echo $object[0]['houseCount']?></td>
                                            </tr>
                                            <tr>
                                                <td><p><b>Αναφορές</b></p></td>
                                                <td><?php echo $object[0]['houseCount']?></td>
                                            </tr>


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="col-lg-1 col-sm-0"></div>  


        </div>
    </div>
    <br>
<?php include 'Footer.html'; }?>


</body>

