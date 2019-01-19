<?php
session_start();
//unset($_SESSION['jsonData']);
if (isset($_POST["email"])) {
    //create session var
    $email = $_POST["email"];
    $_SESSION["email"] = $email;
    //add-delete to Favorites, isFavorite
}
if (isset($_GET["var"])) {
    $isFavorite = -1;
    $HouseID = $_GET["var"];
    $url = 'https://enikioadmin.000webhostapp.com/House/House_View.php?houseID=' . $HouseID . '&key=c245eb9221f65bb871a4a9fe253dfbe0c6d3d74d';
    $json = file_get_contents($url);
    $object = json_decode($json, true);
    $url400 = "";
    $url200 = "";
    if (isset($_SESSION['email'])) {
        $url = "https://enikioadmin.000webhostapp.com/Favorites/callFavoritesOperation.php?operation=2&email=" . $_SESSION['email'] . "&houseID=" . $HouseID . "&key=c245eb9221f65bb871a4a9fe253dfbe0c6d3d74d";
        $json = file_get_contents($url);
        $isFavorite = json_decode($json, true);
        if ($isFavorite[0]['isFavorite'] == 400) {
            $isFavorite = 4;
        } else if ($isFavorite[0]['isFavorite'] == 200) {
            $isFavorite = 2;
        }
        $url400 = "https://enikioadmin.000webhostapp.com/Favorites/callFavoritesOperation.php?operation=0&email=" . $_SESSION['email'] . "&houseID=" . $HouseID . "&key=c245eb9221f65bb871a4a9fe253dfbe0c6d3d74d";
        $url200 = "https://enikioadmin.000webhostapp.com/Favorites/callFavoritesOperation.php?operation=1&email=" . $_SESSION['email'] . "&houseID=" . $HouseID . "&key=c245eb9221f65bb871a4a9fe253dfbe0c6d3d74d";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Shop Homepage - Start Bootstrap Template</title>

        <!-- Bootstrap core CSS -->

        <link href='/path/to/font-awesome.css' rel='stylesheet'/>
        <script src="https://use.fontawesome.com/33070007c5.js"></script>
        <link href="topScroll.css" rel="stylesheet">
        <link href="slideShow.css" rel="stylesheet">
        <link href="Footer.css" rel="stylesheet">


        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://apis.google.com/js/client:platform.js?onload=renderButton" async defer></script>

        <meta name="google-signin-client_id" content="395356856797-2o7rbpaplhr7honq84lm71e5sh6brnb8.apps.googleusercontent.com">
        <style>

            #search{
                color: #222222;   
            }

            .disabled{

            }


            button::-moz-focus-inner {
                border: 0;
            }


            body{
                font-family: 'Poppins', sans-serif;
            }
            #house_view{

                width:100%;
                background:whitesmoke;
                padding: 10px 10px 10px 10px;

            }
            label{
                font-weight: normal;
                font-size:15px;
            }
            p{
                float:right;
                display: inline;

            }
           label + i{
                float:right;
                display: inline;

            }


            @media (max-width: 768px) {
                .report-modal-content{
                    width: 100%;
                }
                .login-modal-content{
                    width: 100%;
                }
                .contact-modal-content{
                    width: 100%;
                }
            }
            @media (min-width: 768px) {
                .report-modal-content{
                    width: 70%;
                }
                .login-modal-content{
                    width: 50%;
                }
                .contact-modal-content{
                    width: 50%;
                }

            }
        </style>
        <script>

            $(document).ready(function () {
                $(".true").css("color", "#ff5a5f");
                $(".true").attr("class", "fa fa-check");
                $(".false").css("color", "grey");
                $(".false").attr("class", "fa fa-minus");
            });



            $(document).ready(function () {



<?php if ($isFavorite == 4) { ?>

                    $("#spanFavorite").attr('class', 'fa fa-heart-o');
                    $("#favorite").attr('title', 'Προσθήκη στα αγαπημένα');
<?php } else if ($isFavorite == 2) { ?>
                    $("#spanFavorite").attr('class', 'fa fa-heart');
                    $("#favorite").attr('title', 'Αγαπημένο');
<?php } else if ($isFavorite == -1) {
    ?>
                    $("#spanFavorite").attr('class', 'disabled fa fa-heart-o');
                    $("#favorite").attr('title', 'Προσθήκη στα αγαπημένα');
                    $("#favorite").attr('href', '#loginModal');
<?php } ?>
                $("#favorite").click(function () {
                    if ($("#spanFavorite").hasClass("disabled fa fa-heart-o")) {
                    } else {
                        if ($("#spanFavorite").hasClass("fa fa-heart-o")) {
                            $.get("<?php echo $url400; ?>", function (data, status) {
                                if (data[21][0] == 2) {
                                    $("#spanFavorite").attr('class', 'fa fa-heart');
                                    $("#favorite").attr('title', 'Αγαπημένο');
                                }
                            });
                        } else if ($("#spanFavorite").hasClass("fa fa-heart")) {
                            $.get("<?php echo $url200; ?>", function (data, status) {
                                if (data[24][0] == 2) {
                                    $("#spanFavorite").attr('class', 'fa fa-heart-o');
                                    $("#favorite").attr('title', 'Προσθήκη στα αγαπημένα');
                                }
                            });
                        }
                    }
                });
            });

            $(document).ready(function () {
                $('#login-form').submit(function (event) {

                    // get the form data
                    var formData = $(this).serialize();
                    // process the form
                    $.ajax({
                        type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
                        url: 'https://enikioadmin.000webhostapp.com/Customers/CustomerOperations.php?operation=1&key=c245eb9221f65bb871a4a9fe253dfbe0c6d3d74d', // the url where we want to POST
                        data: formData, // our data object
                        dataType: 'json', // what type of data do we expect back from the server
                        encode: true,
                        success: function (data) {

                        }
                        //server done
                    }).done(function (data) {
                        $("#loginModalWrapper").empty().append("<img class='d-block img-fluid' src='loading.gif' style='width:50px;height:50px;background-color:whitesmoke'>");
                        $.ajax({
                            type: "POST",
                            url: "HouseView.php",
                            data: {email: data.email},
                            success: function () {
                                $(location).attr("href", "HouseView.php?var=<?php echo $_GET['var'] ?>");
                            }
                        });
                    })

                            // using the fail promise callback
                            .fail(function (data) {

                                var message = JSON.parse(data.responseText);
                                $("#loginModalWrapper").empty().append("<br><span style='font-size:16px;color:#ff5a5f' class='glyphicon glyphicon-info-sign'></span> " + message.message);
                                //$(location).attr("href", "Login.php?var=" + message + "");
                            });


                    event.preventDefault();

                });
            });







            $(document).ready(function () {
                $('#report-form').submit(function (event) {

                    // get the form data
                    var formData = $(this).serialize();
<?php if (isset($_SESSION['email'])) { ?>
                        var urldata = "key=c2290a04219c2f1e211a9fb3559e5fd810890109&operation=2&houseID=<?php echo $object[0]['houseID'] ?>&email=<?php echo $_SESSION['email'] ?>&";
<?php } ?>
                    var dataToSend = urldata.concat(formData);
                    // process the form
                    $.ajax({
                        type: 'GET', // define the type of HTTP verb we want to use (POST for our form)
                        url: 'https://enikioadmin.000webhostapp.com/Customers/CustomerOperations.php', // the url where we want to POST
                        data: dataToSend, // our data object
                        dataType: 'json', // what type of data do we expect back from the server
                        encode: true,
                        success: function (data) {
                            //salert(data);
                            //if POST done correctly
                            if (data.success) {
                                //console.log(data);
                                var message = data.message;
                                $("#report-form").parent('div').empty().append("<br><span style='font-size:16px;color:#ff5a5f' class='glyphicon glyphicon-info-sign'></span> " + message);
                                //$('#contact-form').empty().append("<span style='font-size:16px;color:#ff5a5f' class='glyphicon glyphicon-info-sign'></span> " + message);

                            }
                            //if not
                            if (!data.success) {
                                console.log(data);
                                var message = data.message;
                                $("#reportModalWrapper").empty().append(message);

                                //$(location).attr("href", "Login.php?var=" + message + "");
                            }

                        }
                        //server done
                    });

                    event.preventDefault();
                });
            });

        </script>
        <script src="fb-google_login.js"></script>
    </head>

    <body>

        <!-- Navigation -->
        <?php include 'navBar.php';?>
        <Br><br><Br><br>



        <div class="container-fluid">

            <div class="row" >
                <div class="col-md-2 col-lg-2 col-sm-2 col-xs-0"></div>

                <div class="col-md-8 col-lg-8 col-sm-8 col-xs-12" >
                    <ol class="breadcrumb" style="background-color: #ff5a5f;">
                        <li><a href="index.php" style="color:white">Home</a></li>
                        <li><a href="Search.php" style="color:white">Search</a></li>
                        <li style="color:whitesmoke">#<?php echo $object[0]['houseID'] ?></li>
                    </ol>
                    <Br><br>
                    <div id="house_view">
                        <h5 style="text-align: left;color: #555;font-size:18px;margin-left: 10px;font-weight:bold"><?php echo $object[0]['tupos'] ?> προς ενοικίαση <?php echo $object[0]['poli'] .", ". $object[0]['nomos'] ?></h5>
                        <h5 style="text-align: left;color: #ff5a5f;font-size:16px;margin-left: 10px;"><i class="fa fa-home"> <?php echo $object[0]['tupos'] ?></i> &nbsp;&nbsp;<i class="fa fa-euro"> <?php echo $object[0]['Timi'] ?></i> &nbsp;&nbsp;<i class="fa fa-clone"> <?php echo $object[0]['tm'] ?> τ.μ.</i> &nbsp;&nbsp;<i class="fa fa-bed"> <?php ?> 2</i></h5>
                        <div class="row" style="padding:10px;">
                            
                            <div class="col-md-7 col-lg-7">
                                
                                <div id="myCarousel" class="carousel slide" data-ride="carousel" >
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                        <li data-target="#myCarousel" data-slide-to="1"></li>

                                    </ol>

                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">

                                        <div class="item active">
                                            <a class="imgclick" data-toggle="modal" data-target=".bs-example-modal-lg"><img  class="d-block img-fluid" src="2.jpg" alt="Los Angeles" style="width:480px;height:280px;"></a>

                                        </div>

                                        <div class="item">
                                            <a class="imgclick" data-toggle="modal" data-slide-to="1" data-target=".bs-example-modal-lg"><img class="d-block img-fluid" src="3.jpg" alt="Chicago" style="width:480px;height:280px;"></a>

                                        </div>

                                    </div>

                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                                        <span class="glyphicon glyphicon-chevron-left"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="right carousel-control" href="#myCarousel" data-slide="next">
                                        <span class="glyphicon glyphicon-chevron-right"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                                <br>
                                <center>

                                    <button id='favorite' rel='tooltip' type="button" data-toggle="modal" href='' data-placement="bottom" title="" style="border: none;background-color: whitesmoke"><i  id="spanFavorite" style="font-size: 28px;color:#ff5a5f" class="fa"></i></button>
                                    &nbsp
                                    <?php if ($isFavorite == -1) { ?>
                                        <button type="button" data-toggle="modal" rel="tooltip" data-placement="bottom" title="Αναφορά αγγελίας" href="#loginModal" id="report" style="border: none;background-color: whitesmoke"><span  style="font-size: 28px;color:goldenrod" class="glyphicon glyphicon-alert"></span></button>
                                    <?php } else { ?>
                                        <button type="button" data-toggle="modal" rel="tooltip" data-placement="bottom" title="Αναφορά αγγελίας" href="#reportModal" id="report" style="border: none;background-color: whitesmoke"><span  style="font-size: 28px;color:goldenrod" class="glyphicon glyphicon-alert"></span></button>
                                    <?php } ?>
                                </center>
                            </div>
                            <div class="col-md-5 col-lg-5">
                                <h4 style="text-align:center;">Βασικά χαρακτηριστικά</h4>
                                <br>
                                <label>Περιοχή </label> <p><?php echo $object[0]['perioxi'] ?></p>
                                <hr style="margin-top:4px;">
                                <label>Τιμή </label> <p><?php echo $object[0]['Timi'] ?> &euro;</p>
                                <hr style="margin-top:4px;">
                                <label>Διεύθυνση </label> <p><?php echo $object[0]['dieuthinsi'] ?></p>
                                <hr style="margin-top:4px;">
                                <label>Εμβαδό </label> <p><?php echo $object[0]['tm'] ?> τ.μ.</p>
                                <hr style="margin-top:4px;">
                                <label>Τύπος </label> <p><?php echo $object[0]['tupos'] ?></p>
                                <hr style="margin-top:4px;">
                                    <label>Θέρμανση </label> <p><?php echo $object[0]['mesoThermansis'] ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <hr>
                            <div class="col-md-12 col-lg-12">
                                <h4 style="text-align:center;">Λοιπά χαρακτηριστικά</h4>
                                <br>
                                <div class="col-md-6 col-lg-6">
                                    <label>Είδος Θέρμανσης </label> <p><?php echo $object[0]['eidosThermansis'] ?></p>
                                    <hr style="margin-top:4px;">
                                    <label>Επιπλομένο </label> <i class="<?php echo $object[0]['epiplomeno'] ?>"></i>
                                    <hr style="margin-top:4px;">
                                    <label>Ηλιακός Θερμοσίφωνας </label> <i class="<?php echo $object[0]['IliakosThermosifwnas'] ?>"></i>
                                    <hr style="margin-top:4px;">
                                    <label>Air Condition </label> <i class="<?php echo $object[0]['ac'] ?>"></i>
                                    <hr style="margin-top:4px;">
                                    <label>Θέα </label> <i class="<?php echo $object[0]['thea'] ?>"></i>
                                    <hr style="margin-top:4px;">
                                    <label>Επιτρέπονται κατοικίδια </label> <i class="<?php echo $object[0]['pets'] ?>"></i>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <label>Όροφος </label> <p><?php echo $object[0]['orofos'] ?>ος</p>
                                    <hr style="margin-top:4px;">
                                    
                                    <label>Αποθήκη </label> <i class="<?php echo $object[0]['apothiki'] ?>"></i>
                                    <hr style="margin-top:4px;">
                                    <label>Βεράντα </label> <i class="<?php echo $object[0]['beranta'] ?>"></i>
                                    <hr style="margin-top:4px;">
                                    <label>Θέση Parking </label> <i class="<?php echo $object[0]['parking'] ?>"></i>
                                    <hr style="margin-top:4px;">
                                    <label>Πισίνα </label> <i class="<?php echo $object[0]['pisina'] ?>"></i>
                                    <hr style="margin-top:4px;">
                                    <label>Τηλέφωνο </label> <p><a style="text-decoration: none;color:grey" href="tel:6971796591"> <?php echo $object[0]['phoneNumber'] ?></a></p>
                                </div>

                            </div>

                            <div class="col-md-12 col-lg-12">
                                <hr>
                                <h4 style="text-align:center;">Τοποθεσία στο χάρτη</h4>
                                <div id="map" style="width:100%;height:300px;"></div>
                                <script>
            function initMap() {
                var uluru = {lat: <?php echo $object[0]['geografikoPlatos'] ?>, lng: <?php echo $object[0]['geografikoMikos'] ?>};
                var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 16,
                    center: uluru
                });
                var marker = new google.maps.Marker({
                    position: uluru,
                    map: map
                });
            }
                                </script>
                                <script async defer
                                        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC51WUh2Zqxg2X2dH6NfeKxdijLal8I0QQ&callback=initMap">
                                </script>

                            </div>

                        </div>

                    </div>
                    <br>

                </div>


            </div>

            <div class="col-md-2 col-lg-2 col-sm-2 col-xs-0"></div>

        </div>






        <button href="#contactModal" data-toggle="modal" id="contactBtn" title="contact"><span class="glyphicon glyphicon-envelope" style="font-size: 25px;font-weight: bold"></span></button>      
        <button onclick="topFunction()" id="topBtn" title="Go to top"><span class="glyphicon glyphicon-menu-up" style="font-size: 25px;font-weight: bold"></span></button>

        <script>
            // When the user scrolls down 20px from the top of the document, show the button
            window.onscroll = function () {
                scrollFunction()
            };
            function scrollFunction() {
                if (document.body.scrollTop > 400 || document.documentElement.scrollTop > 400) {
                    document.getElementById("topBtn").style.display = "block";
                    document.getElementById("contactBtn").style.display = "block";
                } else {
                    document.getElementById("topBtn").style.display = "none";
                    document.getElementById("contactBtn").style.display = "none";
                }
            }

            // When the user clicks on the button, scroll to the top of the document
            function topFunction() {
                document.body.scrollTop = 0;
                document.documentElement.scrollTop = 0;
            }

        </script>





        <script>
            $(document).ready(function () {
                $('[data-toggle="tooltip"]').tooltip();
                $('[rel="tooltip"]').tooltip();
            }
            );
        </script>
        <!-- Footer -->
        <?php
        include ("Footer.html");
        include("Modals.html");
        ?> 





        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div id="carousel-example-generic" class="carousel slide" data-interval="false">



                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" style=" width:100%; height: 500px !important;">
                            <div class="item active">
                                <img class="img-responsive " src="2.jpg" alt="..." >

                            </div>
                            <div class="item">
                                <img class="img-responsive" src="3.jpg" alt="..." >

                            </div>

                        </div>

                        <!-- Controls -->
                        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </a>
                        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right"></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </body>

</html>
