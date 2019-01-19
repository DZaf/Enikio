<?php
session_start();
unset($_SESSION['jsonData']);
if (isset($_POST["email"])) {
    //create session var
    $email = $_POST["email"];
    $name = $_POST["name"];
    $_SESSION["email"] = $email;
    $_SESSION["name"] = $name;
    //add-delete to Favorites, isFavorite
} else {
//print last 6 houses
    $json = file_get_contents('https://enikioadmin.000webhostapp.com/House/Home_Page.php?var=6&key=c245eb9221f65bb871a4a9fe253dfbe0c6d3d74d');
    $object = json_decode($json, true);

//echo json_encode($object, JSON_PRETTY_PRINT);
    $num_rows = count($object);
    $isFavorite = -1;

    $json = file_get_contents('https://enikioadmin.000webhostapp.com/Test/HouseOperations.php?key=c2290a04219c2f1e211a9fb3559e5fd810890109&operation=4');
    $state = json_decode($json, true);
    $state_num_rows = count($state);

    $json = file_get_contents('https://enikioadmin.000webhostapp.com/Test/HouseOperations.php?key=c2290a04219c2f1e211a9fb3559e5fd810890109&operation=5&state=Σάμου');
    $city = json_decode($json, true);
    $city_num_rows = count($city);
    ?>
    <!DOCTYPE html>
    <html lang="en">

        <head>

            <meta charset="utf-8">
            <meta name="description" content="">
            <meta name="author" content="">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Σπίτι μου σπιτάκι μου</title>

            <!-- Bootstrap core CSS -->
            <link href="vendor/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
            <link href="GeneralCSS.css" rel="stylesheet">

            <!-- Custom styles for this template -->
            <script src="https://use.fontawesome.com/33070007c5.js"></script>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

            <meta name="google-signin-client_id" content="395356856797-2o7rbpaplhr7honq84lm71e5sh6brnb8.apps.googleusercontent.com">

            <style>

                #home{
                    color: #222222;   
                }

                @-moz-document url-prefix() {
                    select.form-control {
                        padding-right: 25px;
                        background-image: url("data:image/svg+xml,\
                            <svg version='1.1' xmlns='http://www.w3.org/2000/svg' width='14px'\
                            height='14px' viewBox='0 0 1200 1000' fill='rgb(51,51,51)'>\
                            <path d='M1100 411l-198 -199l-353 353l-353 -353l-197 199l551 551z'/>\
                            </svg>");
                        background-repeat: no-repeat;
                        background-position: calc(100% - 7px) 50%;
                        -moz-appearance: none;
                        appearance: none;

                    }
                }


                button::-moz-focus-inner {
                    border: 0;
                }               

                .switch-field {
                    font-family: "Lucida Grande", Tahoma, Verdana, sans-serif;
                    padding: 0px;
                    overflow: hidden;
                }

                .switch-title {
                    margin-bottom: 6px;
                }

                .switch-field input {
                    position: absolute !important;
                    clip: rect(0, 0, 0, 0);
                    height: 1px;
                    width: 1px;
                    border: 0;
                    overflow: hidden;

                }


                .switch-field label {
                    display: inline-block;
                    width: 120px;
                    background-color: #333333;
                    color:white;
                    font-size: 18px;
                    font-weight: normal;
                    text-align: center;
                    text-shadow: none;
                    padding: 6px 14px;
                    opacity: 0.7;
                    -webkit-transition: all 0.1s ease-in-out;
                    -moz-transition:    all 0.1s ease-in-out;
                    -ms-transition:     all 0.1s ease-in-out;
                    -o-transition:      all 0.1s ease-in-out;
                    transition:         all 0.1s ease-in-out;
                }

                .switch-field label:hover {
                    cursor: pointer;
                }

                #enoikio:checked + label {
                    background-color: #ff5a5f;
                    -webkit-box-shadow: none;
                    box-shadow: none;
                    color:white;
                    opacity: 1;
                }
                #polisi:checked + label {
                    background-color: #ff5a5f;
                    -webkit-box-shadow: none;
                    box-shadow: none;
                    color:white;
                    opacity: 1;
                }
            </style>

        </head>

        <body>

            <!-- Navigation -->
            <?php include 'navBar.php'; ?>

            <!-- Page Content -->
            <div class="container- container-foto">
                <div class="container-fluid">
                    <div class="row">


                        <!-- /.col-lg-3 -->

                        <div class="col-lg-12 col-md-12">
                            <br><br><br><br><br><br><br><br><br><br><br><br>

                            <center><form id="quickSearch" name="quickSearch" action="" method="post" class="form-inline">

                                    <div class="form-group">
                                        <div class="switch-field">
                                            <input type="radio" id="enoikio"  name="eidosAggelias" value="false" checked/>
                                            <label for="enoikio">Ενοικίαση</label>
                                            <input type="radio" id="polisi" name="eidosAggelias" value="true" />
                                            <label for="polisi">Πώληση</label>
                                        </div>
                                        <select name="nomos" id="nomos" class="form-control" style="opacity: 0.9">
                                            <option selected="selected"><?php echo $state[0]['state'] ?></option>
                                            <?php for ($i = 1; $i < $state_num_rows; $i++) { ?>
                                                <option><?php echo $state[$i]['state'] ?></option>
                                            <?php } ?>
                                        </select>
                                        <select name="poli" id="perioxi" class="form-control" style="opacity: 0.9">
                                            <option selected="selected"><?php echo $city[0]['cityName'] ?></option>
                                            <?php for ($i = 1; $i < $city_num_rows; $i++) { ?>
                                                <option><?php echo $city[$i]['cityName'] ?></option>
                                            <?php } ?>
                                        </select>
                                        <input class="form-control" type="number" min="0" name="timiapo" placeholder="&euro; από" style="opacity: 0.9;">
                                        <input class="form-control" type="number" min="0" name="timiews" placeholder="&euro; έως" style="opacity: 0.9;">
                                        <input class="form-control" type="number" min="0" name="tmapo" placeholder="τ.μ. από" style="opacity: 0.9;">
                                        <input class="form-control" type="number" min="0" name="tmews" placeholder="τ.μ. έως" style="opacity: 0.9;">
                                        <br><button id="qiuckSearchSubmit" type="submit" class="btn" style="background-color: #ff5a5f;color:white">Αναζήτηση</button>
                                    </div>
                                </form></center>


                            <!-- /.row -->
                            <br><br><br><br><br><br><br><br><br><br>

                        </div>
                        <!-- /.col-lg-9 -->

                    </div>
                    <!-- /.row -->

                </div>
                <!-- /.container -->
            </div>





            <div class="container-fluid" style="background-color:whitesmoke"> 
                <div class="container">
                    <br>
                    <center><h3 style="font-size:30px;color:#555">Δημοφιλείς αγγελίες</h3></center>
                    <br>
                    <label style="background-color: #ff5a5f;color:white;padding: 3px 11px 3px 11px;font-weight: normal;font-size: 16px">Last Adds</label>         
                    <hr style=" margin-top: -6px;border: 0px solid #ff5a5f;border-top-width: 1px;">
                    <div class="row">


                        <!-- /.col-lg-3 -->

                        <div class="col-lg-12">

                            <div class="row" >

                                <?php for ($i = 0; $i < $num_rows; $i++) { ?>
                                    <div class="col-lg-4 col-md-4 mb-4 col-sm-6">

                                        <?php
                                        if (isset($_SESSION['email'])) {
                                            $url = "https://enikioadmin.000webhostapp.com/Favorites/callFavoritesOperation.php?operation=2&email=" . $_SESSION['email'] . "&houseID=" . $object[$i]['houseID'] . "&key=c245eb9221f65bb871a4a9fe253dfbe0c6d3d74d";
                                            $json = file_get_contents($url);
                                            $isFavorite = json_decode($json, true);
                                            if ($isFavorite[0]['isFavorite'] == 400) {
                                                $isFavorite = 4;
                                            } else if ($isFavorite[0]['isFavorite'] == 200) {
                                                $isFavorite = 2;
                                            }
                                        }
//                                    $photoDir = "https://enikioadmin.000webhostapp.com/Test/photos/". $object[$i]['customerMail']. "/" . $object[$i]['houseID'] . "/";
//                                    $photo = scandir($photoDir);
                                        ?>


                                        <div class="card h-100" id="<?php echo $object[$i]['houseID'] ?>" name="<?php echo $_SESSION['email'] ?>">
                                            <a href="HouseView.php?var=<?php echo $object[$i]['houseID'] ?>"><img class="card-img-top" src="2.jpg" alt="" style=";height:200px"></a>

                                            <div class="card-body" style="background-color: #333333">
                                                <div class="card-title" style="padding-top:5px;">
                                                    <h4 id="spans" style="color: #ff5a5f;display: inline;"><?php echo $object[$i]['perioxi']; ?></h4>
                                                    <?php if ($isFavorite == 4) { ?>
                                                        <button class="report" href="#reportModal" data-toggle="modal" rel="tooltip" title="Αναφορά αγγελίας" style="border: none;background-color: transparent;display: inline;float:right"><span style="font-size: 24px;color:goldenrod" class="glyphicon glyphicon-alert"></span></button>                

                                                        <button class="favorite" rel="tooltip" title="Προσθήκη στα αγαπημένα" name="favorite" style="border: none;background-color: transparent;display: inline;float:right"><i id="spanFavorite" style="font-size: 24px;color:#ff5a5f" class="fa fa-heart-o"></i></button>
                                                    <?php }if ($isFavorite == 2) { ?>
                                                        <button class="report" href="#reportModal" data-toggle="modal" rel="tooltip" title="Αναφορά αγγελίας" style="border: none;background-color: transparent;display: inline;float:right"><span style="font-size: 24px;color:goldenrod" class="glyphicon glyphicon-alert"></span></button>                

                                                        <button class="favorite" rel="tooltip" title="Αγαπημένο" name="favorite" style="border: none;background-color: transparent;display: inline;float:right"><i id="spanFavorite" style="font-size: 24px;color:#ff5a5f" class="fa fa-heart"></i></button>
                                                    <?php }if ($isFavorite == -1) { ?>
                                                        <button class="report" href="#loginModal" data-toggle="modal" rel="tooltip" title="Αναφορά αγγελίας" style="border: none;background-color: transparent;display: inline;float:right"><span style="font-size: 24px;color:goldenrod" class="glyphicon glyphicon-alert"></span></button>                

                                                        <button href="#loginModal" data-toggle="modal" rel="tooltip" title="Προσθήκη στα αγαπημένα" class="favorite" name="favorite" style="border: none;background-color: transparent;display: inline;float:right"><i id="spanFavorite" style="font-size: 24px;color:#ff5a5f" class="disabled fa fa-heart-o"></i></button>
                                                    <?php } ?>


                                                </div>
                                                <h5 style="color:white"><?php echo $object[$i]['tm']; ?> τ.μ. \ <?php echo $object[$i]['Timi']; ?> &euro;</h5>
                                                <p style="color:white" class="card-text"><b>Τύπος:</b> <?php echo $object[$i]['tupos']; ?><b> Επιπλομένο:</b>  <?php echo $object[$i]['epiplomeno']; ?><br><b>Τηλέφωνο:</b><a style="text-decoration: none;color:#ff5a5f" href="tel:6971796591"> <?php echo $object[$i]['phoneNumber']; ?></a>  </p>
                                            </div>

                                        </div><br>
                                    </div> <?php } ?>



                            </div>
                            <hr>
                            <!-- /.row -->

                        </div>
                        <!-- /.col-lg-9 -->

                    </div>
                    <!-- /.row -->

                </div>
                <!-- /.container -->
            </div>





            <button href="#contactModal" data-toggle="modal" id="contactBtn" title="contact"><span class="glyphicon glyphicon-envelope" style="font-size: 25px;font-weight: bold"></span></button>
            <button onclick="topFunction()" id="topBtn" title="Go to top"><span class="glyphicon glyphicon-menu-up" style="font-size: 25px;font-weight: bold"></span></button>


            <?php
            include ("Footer.html");
            include("Modals.html");
            ?> 


        </body>

        <script src="https://apis.google.com/js/client:platform.js?onload=renderButton" async defer></script>
        <script src="fav_report.js"></script>
        <script src="fb-google_login.js"></script>
        <script>
                    $(document).ready(function () {
                        $('[data-toggle="tooltip"]').tooltip();
                        $('[rel="tooltip"]').tooltip();
                    }
                    );
        </script>
        <script>
            $(document).ready(function () {
                $("#quickSearch").submit(function (event) {
                    var formData = $(this).serialize();
                    $.ajax({
                        type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
                        url: 'https://enikioadmin.000webhostapp.com/Test/HouseOperations.php?key=c2290a04219c2f1e211a9fb3559e5fd810890109&operation=7', // the url where we want to POST
                        data: formData, // our data object
                        dataType: 'json', // what type of data do we expect back from the server
                        encode: true
                                //server done
                    }).done(function (data) {
                        //alert("done");
                        console.log(JSON.stringify(data));
                        $.ajax({
                            type: "POST",
                            url: "Search.php",
                            data: JSON.stringify(data),
                            success: function () {
                                //alert(JSON.stringify(data));
                                $(location).attr("href", "Search.php");
                            }
                        });
                        //if not
                    })

                            // using the fail promise callback
                            .fail(function (data) {
                                var message = JSON.parse(data.responseText);

                                console.log(JSON.stringify(message));
                                $.ajax({
                                    type: "POST",
                                    url: "Search.php",
                                    data: JSON.stringify(message),
                                    success: function () {
                                        //alert(JSON.stringify(data));
                                        $(location).attr("href", "Search.php");
                                    }
                                });
                            });
                    event.preventDefault();
                });
            });
            //......................LOGIN(100% WORKING)................
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
                        console.log(data);
                        $("#loginModalWrapper").empty().append("Παρακαλώ περιμένετε<img class='d-block img-fluid' src='loading.gif' style='width:50px;height:50px;'>");
                        $.ajax({
                            type: "POST",
                            url: "index.php",
                            data: {email: data.email, name: data.name},
                            success: function () {
                                $(location).attr("href", "index.php");
                            }
                        });
                    })

                            // using the fail promise callback
                            .fail(function (data) {

                                var message = JSON.parse(data.responseText);
                                console.log(message.message);
                                $("#loginModalWrapper").empty().append("<br><span style='font-size:16px;color:#ff5a5f' class='glyphicon glyphicon-info-sign'></span> " + message.message);
                                //$(location).attr("href", "Login.php?var=" + message + "");
                            });

                    event.preventDefault();

                });
            });

            //......................REPORT(WORKING)................
            $(document).ready(function () {
                $(".report").click(function (event) {

                    var id = $(this).parent('div').parent('div').parent('div').attr('id');
                    var email = $(this).parent('div').parent('div').parent('div').attr('name');
                    var urldata = "key=c2290a04219c2f1e211a9fb3559e5fd810890109&operation=2&houseID=" + id + "&email=" + email + "&";


                    $('#report-form').submit(function (event) {

                        // get the form data
                        var formData = $('#report-form').serialize();
                        //alert(urldata);
                        var dataToSend = urldata.concat(formData);
                        // process the form
                        $.ajax({
                            type: 'GET', // define the type of HTTP verb we want to use (POST for our form)
                            url: 'https://enikioadmin.000webhostapp.com/Customers/CustomerOperations.php', // the url where we want to POST
                            data: dataToSend, // our data object
                            dataType: 'json', // what type of data do we expect back from the server
                            encode: true,
                            success: function (data) {


                            }
                            //server done
                        }).done(function (data) {
                            console.log(data);
                            var message = data.message;
                            $("#report-form").parent('div').empty().append("<br><span style='font-size:16px;color:#ff5a5f' class='glyphicon glyphicon-info-sign'></span> " + message);
                            //$('#contact-form').empty().append("<span style='font-size:16px;color:#ff5a5f' class='glyphicon glyphicon-info-sign'></span> " + message);

                        })

                                // using the fail promise callback
                                .fail(function (data) {

                                    console.log(data);
                                    var message = data.message;
                                    $("#reportModalWrapper").empty().append(message);

                                    //$(location).attr("href", "Login.php?var=" + message + "");
                                });

                        event.preventDefault();
                    });
                });
            });
            //.............................................CONTACT(50% WORKING)....................................................
            $(document).ready(function () {
                $('#contact-form').submit(function (event) {

                    // get the form data
                    var formData = $(this).serialize();
                    // process the form
                    $.ajax({
                        type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
                        url: 'sendMail.php', // the url where we want to POST
                        data: formData, // our data object
                        dataType: 'json', // what type of data do we expect back from the server
                        encode: true,
                        success: function (data) {


                        }
                        //server done
                    }).done(function (data) {
                        var message = data.message;
                        // $("#contactModalWrapper").parent('div').empty().fadeOut(400);
                        $('#contact-form').empty().append("<br><p style='font-size:16px'>" + message + "</p>");
                    })

                            // using the fail promise callback
                            .fail(function (data) {

                                var message = data.message;
                                $("#contactModalWrapper").empty().append("<br> " + message);

                                //$(location).attr("href", "Login.php?var=" + message + "");
                            });


                    event.preventDefault();
                });
            });
        </script>
    <?php } ?>
</html>
