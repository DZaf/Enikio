<?php
session_start();
unset($_SESSION['jsonData']);
if (isset($_SESSION['email'])) {

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
            <title>Νέα αγγελία</title>
            <script src="https://use.fontawesome.com/33070007c5.js"></script>

            <!-- Bootstrap core CSS -->
            <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
            <link href="topScroll.css" rel="stylesheet">
            <link href="Footer.css" rel="stylesheet">
            <!-- Custom styles for this template -->

            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
            <style>

                #myHouses{
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

                .container-foto
                {
                    background-image: url("2.jpg");
                    background-repeat: no-repeat;
                    background-attachment: fixed;
                    background-position: top;
                    background-position-y: -10px;
                }
                body{
                    font-family: 'Poppins', sans-serif;

                }
                label{
                    font-weight: normal;
                    font-size:15px;
                }
                @media (max-width: 768px) {
                    #map{
                        width: 100%;
                    }
                }
                @media (min-width: 768px) {
                    #map{
                        width: 80%;
                    }

                }
            </style>
            <script>
                $(document).ready(function ()
                {

                    var max_fields = 4; //maximum input boxes allowed
                    var wrapper = $("#wrapper"); //Fields wrapper
                    var add_button = $("#add"); //Add button ID

                    var x = 1; //initlal text box count
                    $("#addPhone").click(function (e) { //on add input button click
                        e.preventDefault();
                        if (x < max_fields) { //max input box allowed
                            x++; //text box increment
                            $("#wrapper").append('<div><br><label>Τηλέφωνο ' + x + '</label><input min="0" maxlength="10" class="form-control" type="number" name="phones[]" required><a href="#" class="remove_field">Remove</a></div>'); //add input box
                        }
                    });
                    //JQUERY function gia tin diagrafi tou extra input
                    $("#wrapper").on("click", ".remove_field", function (e) { //user click on remove text
                        e.preventDefault();
                        $(this).parent('div').remove();
                        x--;
                    })
                });
                //----------Form submit-----------------
                $(document).ready(function ()
                {
                    $('#newEntry').submit(function (event) {

                        // get the form data
                        //var formData =  new FormData($('#newEntry'));       //$(this).serialize();
                        var formData = new FormData(this);
                        // process the form
                        $.ajax({
                            type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
                            url: 'https://enikioadmin.000webhostapp.com/Test/HouseOperations.php?key=c2290a04219c2f1e211a9fb3559e5fd810890109&operation=3', // the url where we want to POST
                            data: formData, // our data object
                            //dataType: 'json',
                            processData: false,
                            cache: false,
                            contentType: false, // what type of data do we expect back from the server
                            encode: true
                                    //server done
                        }).done(function (data) {
                            //var message = JSON.parse(data.responseText);
                            console.log(data);
                            //$(location).attr("href", "MyHouses.php");
                            //if not
                        })

                                // using the fail promise callback
                                .fail(function (data) {
                                    //var message = JSON.parse(data.responseText);
                                    console.log(data);

                                    //$("#loginModalWrapper").empty().append("&nbsp<span style='font-size:16px;color:#ff5a5f' class='glyphicon glyphicon-info-sign'></span> " + message.message);
                                    //$(location).attr("href", "Login.php?var=" + message + "");
                                });

                        event.preventDefault();

                    });
                });


            </script>

        </head>

        <body>

            <!-- Navigation -->
            <?php include 'navBar.php';?>
            <Br><br><Br><br>




            <div class="container">
                <ol class="breadcrumb" style="background-color: #ff5a5f;margin-top:10px;">
                    <li><a href="index.php" style="color:white">Home</a></li>
                    <li><a href="#" style="color:white">My houses</a></li>
                    <li class="active" style="color:whitesmoke">New entry</li>
                </ol>
                <br>
                <div style="background-color:whitesmoke;padding:10px 60px 10px 60px">
                    <h3 style="text-align: center;color: #555;font-size:30px">Προσθέστε μία νέα αγγελία</h3><br>
                    <form name="newEntry" method="POST" id="newEntry" action="" class="form-horizontal" enctype="multipart/form-data">
                        <div class="row">

                            <div class="col-md-12 col-sm-12">
                                <label style="background-color: #ff5a5f;color:white;padding: 3px 11px 3px 11px;font-weight: normal;font-size: 17px">Νέα εγγραφή</label>        
                                <hr style=" margin-top: -6px;border: 0px solid #ff5a5f;border-top-width: 1px;">
                                <div class="col-md-4 col-sm-4">

                                    <label for='nomos'>Νομός</label><label data-toggle="tooltip" title="Το πεδίο είναι υποχρεωτικό"><font color="#ff5a5f" >*</font></label>                        

                                    <select name="nomos" id="nomos" class="form-control">
                                        <option selected="selected"><?php echo $state[0]['state'] ?></option>
                                        <?php for ($i = 1; $i < $state_num_rows; $i++) { ?>
                                            <option><?php echo $state[$i]['state'] ?></option>
                                        <?php } ?>
                                    </select> 
                                    <br>
                                    <label for='poli'>Πόλη / Χωριό</label><label data-toggle="tooltip" title="Το πεδίο είναι υποχρεωτικό"><font color="#ff5a5f" >*</font></label>                        

                                    <select name="poli" id="perioxi" class="form-control">
                                        <option selected="selected"><?php echo $city[0]['cityName'] ?></option>
                                        <?php for ($i = 1; $i < $city_num_rows; $i++) { ?>
                                            <option><?php echo $city[$i]['cityName'] ?></option>
                                        <?php } ?>
                                    </select> 
                                    <br>
                                    <label for='perioxi'>Περιοχή</label><label data-toggle="tooltip" title="Το πεδίο είναι υποχρεωτικό"><font color="#ff5a5f" >*</font></label>                        

                                    <input name="perioxi" id="perioxi" class="form-control" type="text" autocomplete="on" placeholder="Η περιοχή που βρίσκεται το ακίνητο">
                                    <br>

                                    <label for='dieuthinsi'>Διεύθυνση</label><label data-toggle="tooltip" title="Το πεδίο είναι υποχρεωτικό"><font color="#ff5a5f" >*</font></label>            
                                    <input class="form-control" id="dieuthinsi" type="text" name="dieuthinsi" autocomplete="on" placeholder="Εισάγετε την διεύθυνση του σπιτιού" required maxlength="39">                       
                                    <br>
                                    <label for='tetragonika'>Τετραγωνικά</label><label data-toggle="tooltip" title="Το πεδίο είναι υποχρεωτικό"><font color="#ff5a5f" >*</font></label>          
                                    <input class="form-control" id="tm" type="number"  name="tm" autocomplete="on" placeholder="Εισάγετε τα τετραγωνικά του σπιτιού" maxlength="4" required >    
                                    <br>
                                    <label for='timi'>Τιμή</label>                                                              
                                    <input class="form-control" type="number" name="timi" id="timi" autocomplete="on" maxlength="4" placeholder="Εισάγετε την τιμή του ενοικίου" min="0">                                  
                                    <br>
                                    <label for='tipos'>Τύπος Σπιτιού</label>                          
                                    <select class="form-control" id="tupos"  name="tupos">    
                                        <option  value="Studio" selected="selected" >Studio</option>
                                        <option  value="Γκαρσονιέρα">Γκαρσονιέρα</option>
                                        <option  value="Τριάρι">Τριάρι</option>
                                        <option  value="Μεζονέτα">Μεζονέτα</option>
                                    </select>

                                    <br>

                                    <label for='epiplomeno'>Επιπλομένο</label>                          
                                    <select class="form-control" id="epiplomeno"  name="epiplomeno">    
                                        <option value="true"  selected="selected" >Ναι</option>
                                        <option value="false" >Οχι</option></select> 
                                    <br>
                                    <label for='ipnodomatia'>Αριθμός υπνοδωματίων</label>          
                                    <input class="form-control" id="ipnodomatia" type="number"  name="ipnodomatia" autocomplete="on" placeholder="Εισάγετε αριθμό υπνοδωματίων" maxlength="2" min="0" max="10"  >    


                                    <br>
                                    <label for='fotos'>Εισαγωγή Φωτογραφιών</label>    
                                    <input name="upload[]" type="file" multiple="multiple" />          
                                    <br>


                                </div>

                                <div class="col-md-4 col-sm-4">

                                    <label for='parking'>Επιτρέπονται τα κατοικίδια</label>                          
                                    <select class="form-control" name="pets" >    
                                        <option value="true"  selected="selected" >Ναι</option>
                                        <option value="false">Οχι</option>
                                    </select>
                                    <br>
                                    <label for='parking'>Θέση Parking</label>                          
                                    <select class="form-control" name="parking" >    
                                        <option value="true"  selected="selected" >Ναι</option>
                                        <option value="false">Οχι</option>
                                    </select>
                                    <br>
                                    <label for='iliakos'>Ηλιακός Θερμοσίφωνας</label>                          
                                    <select class="form-control" name="iliakos" >    
                                        <option value="true"  selected="selected" >Ναι</option>
                                        <option value="false" >Οχι</option>
                                    </select>
                                    <br>


                                    <label for='ac'>Air Condition</label>                          
                                    <select class="form-control" name="ac" >    
                                        <option value="true"  selected="selected" >Ναι</option>
                                        <option value="false">Οχι</option>
                                    </select>
                                    <br>

                                    <label for='kipos'>Κήπος</label>                          
                                    <select class="form-control" name="kipos" >    
                                        <option value="true"  selected="selected" >Ναι</option>
                                        <option value="false">Οχι</option>
                                    </select>
                                    <br>

                                    <label for='tzaki'>Τζάκι</label>                          
                                    <select class="form-control" name="tzaki" >    
                                        <option value="true"  selected="selected" >Ναι</option>
                                        <option value="false">Οχι</option>
                                    </select>
                                    <br>

                                    <label for='apothiki'>Αποθήκη</label>                          
                                    <select class="form-control" name="apothiki" >    
                                        <option value="true"  selected="selected" >Ναι</option>
                                        <option value="false">Οχι</option>
                                    </select>
                                    <br>


                                    <label for='perigrafi'>Περιγραφή</label>     
                                    <textarea class="form-control" id="perirafi" name="perigrafi" rows="4"  placeholder="Εισάγετε μία περιγραφή" maxlength="299" ></textarea>

                                </div>

                                <div class="col-md-4 col-sm-4">
                                    <label for='orofos'>Όροφος</label>                          
                                    <select class="form-control" name="orofos" > 
                                        <option  value="-1">Υπόγειο</option>
                                        <option  value="0" selected="selected">Ισόγειο</option>
                                        <option  value="0.5" >Ισόγειο</option>
                                        <option value="1">Πρώτος</option>
                                        <option value="2">Δεύτερος</option>
                                        <option value="3">Τρίτος</option>
                                        <option value="4">Τέταρτος</option>
                                        <option value="5">Πέμπτος</option>
                                        <option value="6">Έκτος</option>
                                    </select>
                                    <br>

                                    <label for='thermansi'>Θέρμανση</label>                          
                                    <select class="form-control" name="mesoThermansis" >    
                                        <option  value="Όχι" selected="selected" >Όχι</option>
                                        <option value="Αυτόνομη">Αυτόνομη</option>
                                        <option value="Κεντρική">Κεντρική</option>
                                        <option value="Άλλο">Άλλο</option>
                                    </select>
                                    <br>

                                    <label for='eidosthermansis'>Είδος Θέρμανσης</label>                          
                                    <select class="form-control" name="eidosΤhermansis" >    
                                        <option  value="Αδιάφορο" selected="selected" >Αδιάφορο</option>
                                        <option value="Πετρέλαιο">Πετρέλαιο</option>
                                        <option value="Φυσικό αέριο">Φυσικό αέριο</option>
                                        <option value="Ρεύμα">Ρεύμα</option>
                                        <option value="Πέλετ">Πέλετ</option>
                                        <option value="Σόμπα">Σόμπα</option>
                                        <option value="Θερμοσυσσορευτής">Θερμοσυσσορευτής</option>
                                    </select>
                                    <br>
                                    <label for='anelkistiras'>Ανελκυστήρας</label>                          
                                    <select class="form-control" name="anelkistiras" >    
                                        <option value="true"  selected="selected" >Ναι</option>
                                        <option value="false">Οχι</option>
                                    </select>
                                    <br>
                                    <label for='veranta'>Βεράντα</label>                          
                                    <select class="form-control" name="beranta" >    
                                        <option  value="true" selected="selected" >Ναι</option>
                                        <option value="false">Οχι</option>
                                    </select>
                                    <br>
                                    <label for='thea'>Θέα</label>                          
                                    <select class="form-control" name="thea" >    
                                        <option value="true"  selected="selected" >Ναι</option>
                                        <option value="false">Οχι</option>
                                    </select>
                                    <br>
                                    <label for='pisina'>Πισίνα</label>                          
                                    <select class="form-control" id="pisina"  name="pisina">    
                                        <option value="true"  selected="selected" >Ναι</option>
                                        <option value="false" >Οχι</option>
                                    </select> <br>
                                    <label for='imerominiaKataskeuis'>Ημερομηνία κατασκευής</label> 
                                    <input type="text" class="form-control" name="date" />
                                    <br>
                                    <label for='timi'>Τηλέφωνο 1</label><label data-toggle="tooltip" title="Το πεδίο είναι υποχρεωτικό"><font color="#ff5a5f" >*</font></label>         
                                    <input class="form-control" id="phones[]" min="0" maxlength="10" type="number" name="phones[]" autocomplete="on" placeholder="Τηλέφωνο" required maxlength="10">
                                    <br>
                                    <button id='addPhone' type='button' class="btn btn-info">add phone</button>
                                    <div id='wrapper'>

                                    </div>
                                    <input value="<?php echo $_SESSION['email'] ?>" name="email" class="form-control" type="hidden">
                                </div>

                            </div>
                        </div>


                        <div class="row">
                            <h3 style="text-align: center;color: #555;font-size:24px">Τοποθετείστε το σημείο του σπιτιού στον χάρτη</h3>

                            <div class="col-md-2 col-sm-2"></div>
                            <div class="col-md-10 col-sm-10">
                                <br/><br/>                
                                <div  id="map" style="height:300px;"></div>

                                <script>
                                    function myMap() {
                                        var mapCanvas = document.getElementById("map");
                                        var mapOptions = {
                                            center: {lat: 37.7910139, lng: 26.7042893},
                                            zoom: 15,
                                        };
                                        var map = new google.maps.Map(mapCanvas, mapOptions);
                                        google.maps.event.addListener(map, 'click', function (event) {
                                            placeMarker(map, event.latLng);
                                        });
                                    }

                                    function placeMarker(map, location) {
                                        if (marker && marker.setMap) {
                                            marker.setMap(null);
                                        }
                                        var marker = new google.maps.Marker({
                                            position: location,
                                            map: map
                                        });
                                        var infowindow = new google.maps.InfoWindow({
                                            content: 'Latitude: ' + location.lat() + '<br>Longitude: ' + location.lng()

                                        });
                                        infowindow.open(map, marker);
                                        //PERNAME TO LAT KAI TO LONG APO TON MARKER STA INPOUT LAT KAI LONG
                                        document.getElementById('lat').value = location.lat();
                                        document.getElementById('long').value = location.lng();
                                    }
                                </script>
                            </div>
                        </div>  
                        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC51WUh2Zqxg2X2dH6NfeKxdijLal8I0QQ&callback=myMap"></script>
                        <br>
                        <center><button type="submit" name="submit_btn" class="btn" style="background-color: #ff5a5f;color:white">Καταχώριση</button>

                        </center>

                        <input value=0 class="form-control" id="lat" type="hidden" name="lat" >                      
                        <input value=0 class="form-control" id="long" type="hidden" name="long" >             
                    </form>
                </div>
            </div>

            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


            <script>
                                    $(document).ready(function () {
                                        $('[data-toggle="tooltip"]').tooltip();
                                    }
                                    );
            </script>


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



            <br>
            <?php
            include ("Footer.html");
            ?> 


        </body>
        <?php
    } else {
        header("location: Login.php");
    }
    ?>