<?php
session_start();
//Receive the RAW post data.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //get data from quickSearch post
    $mail = file_get_contents('php://input');
    //store them
    $_SESSION["jsonData"] = $mail;
}
else{
//$num_rows = 0;
if (isset($_SESSION["jsonData"])) {
    // decode data and parse in $data variable
    $data = json_decode($_SESSION["jsonData"], true);
    //count how many houses returned
    $num_rows = count($data);
    $message = $data[$num_rows-1]['message'];
    //unset($_SESSION["jsonData"]);
}

$json = file_get_contents('https://enikioadmin.000webhostapp.com/Test/HouseOperations.php?key=c2290a04219c2f1e211a9fb3559e5fd810890109&operation=4');
$state = json_decode($json, true);
$state_num_rows = count($state);

$json = file_get_contents('https://enikioadmin.000webhostapp.com/Test/HouseOperations.php?key=c2290a04219c2f1e211a9fb3559e5fd810890109&operation=5&state=Σάμου');
$city = json_decode($json, true);
$city_num_rows = count($city);
$isFavorite = -1;
?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Αναζήτηση</title>
        <script src="https://use.fontawesome.com/33070007c5.js"></script>

        <!-- Bootstrap core CSS -->
        <link href="vendor/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="topScroll.css" rel="stylesheet">
        <link href="Footer.css" rel="stylesheet">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <style>

            #search{
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

            @media (max-width: 768px) {
                .login-modal-content{
                    width: 100%;
                }
                .report-modal-content{
                    width: 100%;
                }
                .contact-modal-content{
                    width: 100%;
                }

            }

            @media (min-width: 768px) {
                .login-modal-content{
                    width: 50%;
                }
                .report-modal-content{
                    width: 70%;
                }
                .contact-modal-content{
                    width: 50%;
                }
            }

            select {
                float: right;
                background-color: whitesmoke;
                color:#333333;
                border: none;

            }
            select::-moz-focus-inner {
                border: 0;
            }
            .styled-select select {
                appearance:none;
                -moz-appearance:none; /* Firefox */
                -webkit-appearance:none; /* Safari and Chrome */
            }
            .container-foto
            {
                background-image: url("2.jpg");
                background-repeat: no-repeat;
                background-attachment: fixed;
                background-position: top;
            }

            .wrapper {
             
                display: -webkit-flex;
                align-items: stretch;
                margin-top: 11px;
                    
            }

            #sidebar {
                min-width: 250px;
                max-width: 250px;
                min-height: 100vh;
                background: whitesmoke;
                color: black;
                transition: all 0.3s;
            }

            #sidebar.active {
                margin-left: -270px;
            }

            a[data-toggle="collapse"] {
                position: relative;
            }

            a[aria-expanded="false"]::before, a[aria-expanded="true"]::before {
                content: '\e259';
                display: block;
                position: absolute;
                right: 20px;
                font-family: 'Glyphicons Halflings';
                font-size: 0.6em;
            }

            a[aria-expanded="true"]::before {
                content: '\e260';
            }

            @media (max-width: 992px) {
                #sidebar {
                    margin-left: -250px;
                }
                #sidebar.active {
                    margin-left: 0px;
                }
            }

            @media (max-width: 776px) {
                #searchContent{
                    padding:10px 14px 10px 14px;
                }
            }
            @media (min-width: 776px) {
                #searchContent{
                    padding:10px 50px 10px 50px;
                }
            }
            @media (min-width: 992px) {
                #sidebarCollapse {
                    visibility: hidden;
                }
                #sidebar {
                    margin-left: 0px;
                }
                #sidebar.active {
                    margin-left: 0px;
                }


            }


            body {
                font-family: 'Poppins', sans-serif;
            }

            #sidebar .sidebar-header {
                padding: 10px;
                background: lightgrey;
            }



            .switch {
                position: relative;
                display: inline-block;
                width: 35px;
                height: 8px;
                margin: 0px 5px 0px 0px;

            }

            .switch input {
                display:none;
            }

            .slider {
                position: absolute;
                cursor: pointer;
                top: -1px;
                left: 0;
                right: 0;
                bottom: 0;
                background-color:#ccc;
                -webkit-transition: .4s;
                transition: .4s;
                margin: 4px 0px 0px 0px;
            }

            .slider:before {
                position: absolute;
                content: "";
                height: 18px;
                width: 18px;
                left: 0px;
                bottom: 0px;
                background-color: white;
                -webkit-transition: .4s;
                transition: .4s;
                margin: 0px 0px 0px 0px;
            }

            input:checked + .slider {
                background-color: #EB3751;
            }

            input:focus + .slider {
            }

            input:checked + .slider:before {
                -webkit-transform: translateX(18px);
                -ms-transform: translateX(18px);
                transform: translateX(18px);
            }

            /* Rounded sliders */
            .slider.round {
                border-radius: 34px;
            }

            .slider.round:before {
                border-radius: 50%;
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
                float: left;
            }

            .switch-field label {
                display: inline-block;
                width: 67px;
                background-color: white;
                color: rgba(0, 0, 0, 0.6);
                font-size: 14px;
                font-weight: normal;
                text-align: center;
                text-shadow: none;
                padding: 6px 14px;
                border: 1px solid rgba(0, 0, 0, 0.2);

                -webkit-transition: all 0.1s ease-in-out;
                -moz-transition:    all 0.1s ease-in-out;
                -ms-transition:     all 0.1s ease-in-out;
                -o-transition:      all 0.1s ease-in-out;
                transition:         all 0.1s ease-in-out;
            }

            .switch-field label:hover {
                cursor: pointer;
            }

            .switch-field input:checked + label {
                background-color: #ff5a5f;
                -webkit-box-shadow: none;
                box-shadow: none;
                color:white;
            }

            #switch_3_center:checked + label{
                background-color: lightgrey;
                -webkit-box-shadow: none;
                box-shadow: none;
                color:white;

            }
            #switch_3_left:checked + label{
                background-color: #ff5a5f;
                -webkit-box-shadow: none;
                box-shadow: none;
                color:white;

            }
            #switch_3_right:checked + label{
                background-color: #4ed84e;
                -webkit-box-shadow: none;
                box-shadow: none;
                color:white;

            }



            .switch-field label:first-of-type {
                border-radius: 4px 0 0 4px;
            }

            .switch-field label:last-of-type {
                border-radius: 0 4px 4px 0;
            }




        </style>
        <script>
            $(document).ready(function () {

                $('#sidebarCollapse').on('click', function () {
                    $('#sidebar').toggleClass('active');
                });

            });

            $(document).ready(function () {
                $("#Search-form").submit(function (event) {
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
                                //console.log(data);
                                //console.log(data);
                                //var message = JSON.parse(data.responseText);
                                //console.log(message.message);

                                //$("#loginModalWrapper").empty().append("&nbsp<span style='font-size:16px;color:#ff5a5f' class='glyphicon glyphicon-info-sign'></span> " + message.message);
                                //$(location).attr("href", "Login.php?var=" + message + "");
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
                            data: {email: data.email, name:data.name},
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
                                    var message = JSON.parse(data.responseText);
                                console.log(message.message);
                                    $("#reportModalWrapper").empty().append(message);

                                    //$(location).attr("href", "Login.php?var=" + message + "");
                                });

                        event.preventDefault();
                    });
                });
            });

        </script>
        <script src="fav_report.js"></script>
        <script src="fb-google_login.js"></script>
    </head>
    <body>

        <!-- Navigation -->
        <?php include 'navBar.php';?>

        <br><br><br>

        <!-- side navbar -->
        <div class="wrapper">

            <nav id="sidebar">
                <!-- Sidebar Header -->
                <div class="sidebar-header">
                    <h4 style="text-align: center;">Φίλτρα</h4>
                </div>

                <form id="Search-form" style="padding-left: 30px;margin:10px 0 0 0;" class="form-horizontal" method="POST" action="">
                    <div class="form-group">
                        <label>Νομός</label><br>
                        <select name="nomos" id="nomos" class="form-control" style="width:80%;float:left">
                            <option selected="selected"><?php echo $state[0]['state'] ?></option>
                            <?php for ($i = 1; $i < $state_num_rows; $i++) { ?>
                                <option><?php echo $state[$i]['state'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Πόλη</label><br>
                        <select name="poli" id="perioxi" class="form-control" style="width:80%;float:left">
                            <option selected="selected"><?php echo $city[0]['cityName'] ?></option>
                            <?php for ($i = 1; $i < $city_num_rows; $i++) { ?>
                                <option><?php echo $city[$i]['cityName'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Τιμή</label><br>
                        <div class="input-group">
                            <input name="timiapo" style="width: 40%" type="number" class="form-control" placeholder="από"/>

                            <input name="timieos" style="width: 40%" type="number" class="form-control" placeholder="έως"/>    
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Τετραγωνικά</label><br>
                        <div class="input-group">
                            <input name="tmapo" style="width: 40%" type="number" class="form-control" placeholder="από"/>

                            <input name="tmeos" style="width: 40%" type="number" class="form-control" placeholder="έως"/>    
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Επιπλωμένο</label>
                        <div class="switch-field">
                            <input type="radio" id="switch_3_left" name="switch_3" value="yes"/>
                            <label for="switch_3_left"><i class="fa fa-times"></i></label>
                            <input type="radio" id="switch_3_center" name="switch_3" value="maybe" checked/>
                            <label for="switch_3_center"><i class="fa fa-minus"></i></label>
                            <input type="radio" id="switch_3_right" name="switch_3" value="no" />
                            <label for="switch_3_right"><i class="fa fa-check"></i></label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Θέρμανση</label>
                        <div class="checkbox">
                            <label class="switch"><input name="mesoThermansis" value="Αυτόνομη" type="radio"><span class="slider round"></span></label> Αυτόνομη
                        </div>
                        <div class="checkbox">
                            <label class="switch"><input name="mesoThermansis" value="Κεντρική" type="radio"><span class="slider round"></span></label> Κεντρική
                        </div>
                        <div class="checkbox">
                            <label class="switch"><input name="mesoThermansis" value="Άλλο" type="radio"><span class="slider round"></span></label> Άλλο
                        </div>
                    </div>
                    <div class="form-group">        
                        <label>Είδος Θέρμανσης</label>
                        <div class="checkbox">
                            <label class="switch"><input name="eidosThermansis" value="Πετρέλαιο" type="radio"><span class="slider round"></span></label> Πετρέλαιο
                        </div>
                        <div class="checkbox">
                            <label class="switch"><input name="eidosThermansis" value="Φυσικό αέριο" type="radio"><span class="slider round"></span></label> Φυσικό αέριο
                        </div>
                        <div class="checkbox">
                            <label class="switch"><input name="eidosThermansis" value="Ρεύμα'" type="radio"><span class="slider round"></span></label> Ρεύμα
                        </div>
                        <div class="checkbox">
                            <label class="switch"><input name="eidosThermansis" value="Πέλετ" type="radio"><span class="slider round"></span></label> Πέλετ
                        </div>
                        <div class="checkbox">
                            <label class="switch"><input name="eidosThermansis" value="Σόμπα" type="radio"><span class="slider round"></span></label> Σόμπα
                        </div>
                        <div class="checkbox">
                            <label class="switch"><input name="eidosThermansis" value="Θερμοσυσσορευτής" type="radio"><span class="slider round"></span></label> Θερμοσυσσορευτής
                        </div>
                    </div>
                    <div class="form-group">        
                        <label>Λοιπά Χαρακτηριστικά</label>
                        <div class="checkbox">
                            <label class="switch"><input name="iliakos" value="true" type="checkbox"><span class="slider round"></span></label> Ηλιακός Θερμοσίφωνας
                        </div>
                        <div class="checkbox">
                            <label class="switch"><input name="ac" value="true" type="checkbox"><span class="slider round"></span></label> Air Condition 
                        </div>
                        <div class="checkbox">
                            <label class="switch"><input name="apothiki" value="true" type="checkbox"><span class="slider round"></span></label> Αποθήκη 
                        </div>
                        <div class="checkbox">
                            <label class="switch"><input name="anelkistiras" value="true" type="checkbox"><span class="slider round"></span></label> Ανελκυστήρας
                        </div>
                        <div class="checkbox">
                            <label class="switch"><input name="beranta" value="true" type="checkbox"><span class="slider round"></span></label> Βεράντα
                        </div>
                        <div class="checkbox">
                            <label class="switch"><input name="kipos" value="true" type="checkbox"><span class="slider round"></span></label> Κήπος 
                        </div>
                        <div class="checkbox">
                            <label class="switch"><input name="tzaki" value="true" type="checkbox"><span class="slider round"></span></label> Τζάκι 
                        </div>
                        <div class="checkbox">
                            <label class="switch"><input name="thea" value="true" type="checkbox"><span class="slider round"></span></label> Θέα 
                        </div>
                    </div>
                    <div class="form-group">        
                        <button type="submit" name="login_btn" class="btn" style="background-color: #ff5a5f;color:white">Search</button>
                    </div>
                </form>

            </nav>

            <div class="container">
                <div class="row">
                    <div class="col-lg-0 col-sm-0 col-md-2">
                    </div>
                    <div class="col-lg-11 col-sm-12 ">




                        <!-- /.col-lg-3 -->

                        <ol class="breadcrumb" style="background-color: #ff5a5f;margin-top:19px;">
                            <li><a href="index.php" style="color:white">Home</a></li>
                            <li class="active" style="color:whitesmoke">Search</li>
                        </ol>

                        <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
                            <span class="glyphicon glyphicon-align-left"></span>
                        </button>
                        <?php if (isset($_SESSION["jsonData"])) { ?>
                            <div id="searchContent" style="background-color:whitesmoke;">
                                <h3 style="font-size:30px;text-align: center;color:#555;"><?php echo $message ?></h3><br>

                                <label style="background-color: #ff5a5f;color:white;padding: 3px 11px 3px 11px;font-weight: normal;font-size: 16px;">Last Adds <small>(<?php echo ($num_rows-1); ?>)</small></label>         
                                <select class="form-control" style="width:17%;background-color: whitesmoke;margin-top:-7px;">
                                    <option selected="selected">Δημοτικότητα</option>
                                    <option>Αύξουσα τιμή</option>
                                    <option>Νεότερo</option>
                                </select>
                                <hr style=" margin-top: -6px;border: 0px solid #ff5a5f;border-top-width: 1px;">
                                <div class="row" >


                                    <?php for ($i = 0; $i < $num_rows-1; $i++) { ?>
                                        <div class="col-lg-4 col-md-4 mb-4 col-sm-6">

                                            <?php
                                            if (isset($_SESSION['email'])) {
                                                $url = "https://enikioadmin.000webhostapp.com/Favorites/callFavoritesOperation.php?operation=2&email=" . $_SESSION['email'] . "&houseID=" . $data[$i]['houseID'] . "&key=c245eb9221f65bb871a4a9fe253dfbe0c6d3d74d";
                                                $json = file_get_contents($url);
                                                $isFavorite = json_decode($json, true);
                                                if ($isFavorite[0]['isFavorite'] == 400) {
                                                    $isFavorite = 4;
                                                } else if ($isFavorite[0]['isFavorite'] == 200) {
                                                    $isFavorite = 2;
                                                }
                                            }
                                            //$photo = "https://enikioadmin.000webhostapp.com/Test/photos/". $data[$i]['customerMail']. "/" . $data[$i]['houseID'] . "/1.jpg";
                                            ?>


                                            <div class="card h-100" id="<?php echo $data[$i]['houseID'] ?>" name="<?php echo $_SESSION['email'] ?>">
                                                <a href="HouseView.php?var=<?php echo $data[$i]['houseID'] ?>"><img class="card-img-top" src="2.jpg" alt=""></a>

                                                <div class="card-body" style="background-color: #333333">
                                                    <div class="card-title" style="padding-top:5px;">
                                                        <h4 id="spans" style="color: #ff5a5f;display: inline;"><?php echo $data[$i]['perioxi']; ?></h4>
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
                                                    <h5 style="color:white"><?php echo $data[$i]['tm']; ?> τ.μ. \ <?php echo $data[$i]['Timi']; ?> &euro;</h5>
                                                    <p style="color:white" class="card-text"><b>Τύπος:</b> <?php echo $data[$i]['tupos']; ?><b> Επιπλομένο:</b>  <?php echo $data[$i]['epiplomeno']; ?><br><b>Τηλέφωνο:</b><a style="text-decoration: none;color:#ff5a5f" href="tel:6971796591"> <?php echo $data[$i]['phoneNumber']; ?></a>  </p>
                                                </div>

                                            </div><br>
                                        </div> <?php } ?>




                                </div>
                                <center><ul class="pagination">

                                        <li><a style='color:#EB3751;' href='My_Houses.php?page='>1</a></li> 

                                        <li><a href='' style='color:grey;'>2</a></li>
                                        <li><a href='' style='color:grey;'>3</a></li> 
                                    </ul></center>
                                <hr>
                                <!-- /.row -->


                                <!-- /.row -->
                            </div>
                            <!-- /.container -->
                        <?php } ?>



                    </div>

                </div>
            </div>

        </div>





        <button onclick="" id="contactBtn" title="contact"><span class="glyphicon glyphicon-envelope" style="font-size: 25px;font-weight: bold"></span></button>
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
        <?php
        include ("Footer.html");
        include("Modals.html");
}
        ?> 

    </body>