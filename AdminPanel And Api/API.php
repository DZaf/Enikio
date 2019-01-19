<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Enoikio API</title>
        <meta name="description" content="Enikio Admin">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script> function copyToClipboard(elementId) {


                var aux = document.createElement("input");
                aux.setAttribute("value", document.getElementById(elementId).innerHTML);
                document.body.appendChild(aux);
                aux.select();
                document.execCommand("copy");

                document.body.removeChild(aux);

            }</script>

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
                    <a class="navbar-brand" href="Home.php">Enikio Admin Panel</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <?php if (isset($_SESSION['Loged'])) { ?>
                            <li><a href="Home.php">Home</a></li>
                        <?php } ?>
                        <li class="active" ><a href="API.php">API</a></li>
                        <?php if (isset($_SESSION['Loged'])) { ?>
                            <li><a href="Commands.php">Commands</a></li>
                            <li><a href="Reports.php">Reports</a></li>
                            <li><a href="Log.php">Log File</a></li>
                            <li><a href="Logout.php">Logout</a></li>
                        <?php } ?>
                        <li>
                            <a class="btn btn-default btn-outline btn-circle collapsed"  data-toggle="collapse" href="#nav-collapse1" aria-expanded="false" aria-controls="nav-collapse1">Categories</a>
                        </li>
                    </ul>
                    <ul class="collapse nav navbar-nav nav-collapse" id="nav-collapse1">
                        <li><a href="#page1">Register</a></li>
                        <li><a href="#page2">Login</a></li>
                        <li><a href="#page3">Home Page</a></li>
                        <li><a href="#page4">House View</a></li>
                        <li><a href="#page5">My Houses</a></li>
                        <li><a href="#page6">My Favorites</a></li>
                        <li><a href="#page7">House Location</a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container -->
        </nav><!-- /.navbar -->
        <div class="container-fluid" style="background-color: whitesmoke" >
            <h3 id="page1">Register</h3>
            <p>This function inserts a User into the database</p>
            <h4>Link:</h4><p id="message"> https://enikioadmin.000webhostapp.com/Customers/CustomerOperations.php?key=API_KEY&operation=0</p>

            <button class="btn btn-default" onclick="copyToClipboard('message')"><span class="glyphicon glyphicon-copy"></span> Copy Link</button>
            <h4>Privilege Required: </h4>
            <ul style="list-style-type:none">
                <li>Medium</li>
                <li>High</li>
            </ul>
            <h4>Type of request:</h4>
            <ul style="list-style-type:none">
                <li>POST</li>
            </ul>
            <h4>Parameteres:</h4>
            <ul style="list-style-type:none">
                <li><b>name :</b> must be shorter than 40 characters and must not have numbers</li>
                <li><b>surname :</b> must be shorter than 40 characters and must not have numbers</li>
                <li><b>password :</b> must be shorter than 220 characters</li>
                <li><b>email :</b> must be shorter than 40 characters and have the form of something@something.com</li>
                <li><b>phone :</b> must be only numbers</li>
            </ul>
            <h4>Returns:</h4>
            <h5>Error messages: </h5>
            <ul style="list-style-type:none">
                <li> You have to enter the password </li>
                <li> You have to enter the surname </li>
                <li> You have to enter the name </li>
                <li> You have to enter the email </li>
                <li> You have to enter the password </li>
                <li> You have to enter the email </li>
                <li> Invalid email format, email mast have the format of something@something.something </li>
                <li> Email can have 40 characters max </li>
                <li> Invalid name format, name must not have numbers or special characters</li>
                <li> Name can have 40 characters max </li>
                <li> Invalid surname format, name must not have numbers or special characters </li>
                <li> Surname can have 40 characters max </li>
                <li> Password can have 200 characters max </li>
                <li> Invalid phone format, only numbers required </li>
                <li> The email you are trying to use is already in use  </li>

            </ul>
            <h5>Success messages: </h5>
            <ul style="list-style-type:none">
                <li>
                    check your email
                </li>

            </ul>
            <h5>Json: </h5>
            <ul style="list-style-type:none">
                <li>
                    {
                    <ul style="list-style-type:none">
                        <li>"success" : true / false</li>
                        <li>"message" : message that specifies the error or the success</li>
                    </ul>
                    }
                </li>

            </ul>
            <?php if (isset($_SESSION['Loged'])) { ?>
                <a target="_blank" href="https://paste.ofcode.org/38JAdYPGPXgA4fcaLrzTsyM"> Customer Class Source code</a>
                <p></p>
                <a target="_blank" href="https://paste.ofcode.org/myYNqUP3xyRjkDeEtrTpU6"> Customer Operations Source code</a>
            <?php } ?>
            <br>
            <p></p>
        </div>

        <div class="container-fluid" >
            <h3 id="page2">Login</h3>
            <p>This function Checks if the user exists in the database (based on his/her mail and password)</p>
            <h4>Link:</h4><p id="message1"> https://enikioadmin.000webhostapp.com/Customers/CustomerOperations.php?key=API_KEY&operation=0</p>

            <button class="btn btn-default" onclick="copyToClipboard('message1')"><span class="glyphicon glyphicon-copy"></span> Copy Link</button>
            <h4>Privilege Required: </h4>
            <ul style="list-style-type:none">
                <li>Medium</li>
                <li>High</li>
                <li>Low</li>
            </ul>
            <h4>Type of request:</h4>
            <ul style="list-style-type:none">
                <li>POST</li>
            </ul>
            <h4>Parameteres:</h4>
            <ul style="list-style-type:none">
                <li> You have to enter the password </li>
                <li> You have to enter the email </li>
                <li> Invalid email format, email mast have the format of something@something.something </li>
                <li> Email can have 40 characters max </li>
                <li> Password can have 200 characters max </li>
                <li> Invalid mail, mail doesn't exist </li>
                <li> Invalid password </li>
                <li> You have to verify your email </li>
            </ul>
            <h5>Success messages: </h5>
            <ul style="list-style-type:none">
                <li>
                    You are now Loged in
                </li>

            </ul>
            <h5>Json: </h5>
            <ul style="list-style-type:none">
                <li>
                    {
                    <ul style="list-style-type:none">
                        <li>"success" : true / false</li>
                        <li>"message" : message that specifies the error or the success</li>
                    </ul>
                    }
                </li>

            </ul>

            <?php if (isset($_SESSION['Loged'])) { ?>
                <a target="_blank" href="https://paste.ofcode.org/38JAdYPGPXgA4fcaLrzTsyM"> Customer Class Source code</a>
                <p></p>
                <a target="_blank" href="https://paste.ofcode.org/myYNqUP3xyRjkDeEtrTpU6"> Customer Operations Source code</a>
            <?php } ?>
            <br>
            <p></p>
        </div>

        <div class="container-fluid" style="background-color: whitesmoke" >
            <h3 id="page3">Home Page</h3>
            <p>This function returns the first NUMBER_OF_HOUSES that inserted or updated on the database </p>
            <h4>Link:</h4><p id="message2"> https://enikioadmin.000webhostapp.com/House/Home_Page.php?var=NUMBER_OF_HOUSES&key=API_KEY</p>

            <button class="btn btn-default" onclick="copyToClipboard('message2')"><span class="glyphicon glyphicon-copy"></span> Copy Link</button>
            <h4>Privilege Required: </h4>
            <ul style="list-style-type:none">
                <li>Medium</li>
                <li>High</li>
                <li>Low</li>
            </ul>
            <h4>Type of request:</h4>
            <ul style="list-style-type:none">
                <li>GET</li>
            </ul>
            <h4>Parameteres:</h4>
            <ul style="list-style-type:none">
                <li>-</li>
            </ul>
            <h4>Returns:</h4>
            <h5>Error messages: </h5>
            <ul style="list-style-type:none">
                <li><b>key </b><ol type="1">
                        <li>You Have to enter your API key</li>
                        <li>You don't have an API key, you can ask for one from the main page</li>
                    </ol></li>
            </ul>
            <h5>Success messages: </h5>
            <ul style="list-style-type:none">
                <li>
                    The values of the houses
                </li>

            </ul>
            <h5>Json: </h5>
            <ul style="list-style-type:none">
                <li>
                    { "number of row" : {
                    <ul style="list-style-type:none">
                        <li>"houseID" : "value of houseID"</li>
                        <li>"perioxi" : "value of perioxi"</li>
                        <li>"tm" : "value of tm"</li>
                        <li>"Timi" : "value of Timi"</li>
                        <li>"tupos" : "value of tupos"</li>
                        <li>"epiplomeno" : "value of epiplomeno"</li>
                        <li>"phoneNumber" : "value of phoneNumber"</li>
                        <li>"Reports" : "value Reports done to the house"</li>
                    </ul>
                    }
                </li>
                <li>or </li>
                <li>{ "number of row" : { error message } }</li>

            </ul>
            <?php if (isset($_SESSION['Loged'])) { ?>
                <a target="_blank" href="https://paste.ofcode.org/tbqvGLgiyBfj4JCt6V4Vyh"> view source code</a>
            <?php } ?>
            <br>
            <p></p>
        </div>   
        <div class="container-fluid" >
            <h3 id="page4">House View</h3>
            <p>Displays all the information about the house with the ID given to the var parameter </p>
            <h4>Link:</h4><p id="message3"> https://enikioadmin.000webhostapp.com/House/House_View.php?var=HouseID&key=API_KEY</p>

            <button class="btn btn-default" onclick="copyToClipboard('message3')"><span class="glyphicon glyphicon-copy"></span> Copy Link</button>
            <h4>Privilege Required: </h4>
            <ul style="list-style-type:none">
                <li>Medium</li>
                <li>High</li>
                <li>Low</li>
            </ul>
            <h4>Type of request:</h4>
            <ul style="list-style-type:none">
                <li>GET</li>
            </ul>
            <h4>Parameteres:</h4>
            <ul style="list-style-type:none">
                <li>-</li>
            </ul>
            <h4>Returns:</h4>
            <h5>Error messages: </h5>
            <ul style="list-style-type:none">
                <li><b>key </b><ol type="1">
                        <li>You Have to enter your API key</li>
                        <li>You don't have an API key, you can ask for one from the main page</li>
                    </ol></li>
                <li>
                    <b> house</b>
                    <ol type="1">
                        <li>houseID not found</li>
                    </ol></li>
                </li>
            </ul>
            <h5>Success messages: </h5>
            <ul style="list-style-type:none">
                <li>
                    All the values of the house with id=HouseID
                </li>

            </ul>
            <h5>Json: </h5>
            <ul style="list-style-type:none">
                <li>
                    { "number of row" : {
                    <ul style="list-style-type:none">
                        <li>"houseID" : "value of houseID"</li>
                        <li>"customerMail" : "value of customerMail"</li>
                        <li>"nomos" : "value of nomos"</li>
                        <li>"poli" : "value of poli"</li>
                        <li>"perioxi" : "value of perioxi"</li>
                        <li>"tm" : "value of tm"</li>
                        <li>"Timi" : "value of Timi"</li>
                        <li>"orofos" : "value of orofos"</li>
                        <li>"dieuthinsi" : "value of dieuthinsi"</li>
                        <li>"geografikoPlatos" : "value of geografikoPlatos"</li>
                        <li>"geografikoMikos" : "value of geografikoMikos"</li>
                        <li>"epiplomeno" : "value of epiplomeno"</li>
                        <li>"ac" : "value of ac"</li>
                        <li>"tzaki" : "value of tzaki"</li>
                        <li>"kipos" : "value of kipos"</li>
                        <li>"pisina" : "value of pisina"</li>
                        <li>"anelkistiras" : "value of anelkistiras"</li>
                        <li>"IliakosThermosifwnas" : "value of IliakosThermosifwnas"</li>
                        <li>"parking" : "value of parking"</li>
                        <li>"thea" : "value of thea"</li>
                        <li>"noikiasmeno" : "value of noikiasmeno"</li>
                        <li>"imerominiaKataskebis" : "value of imerominiaKataskebis"</li>
                        <li>"imerominiaAnaneosis" : "value of imerominiaAnaneosis"</li>
                        <li>"perigrafi" : "value of perigrafi"</li>
                        <li>"tupos" : "value of tupos"</li>
                        <li>"eidosThermansis" : "value of eidosThermansis"</li>
                        <li>"mesoThermansis" : "value of mesoThermansis"</li>
                        <li>"arithmosDomatiwn" : "value of arithmosDomatiwn"</li>
                        <li>"Reports" : "value of Reports"</li>
                        <li>"phoneNumber" : "value of phoneNumber"</li>         
                    </ul>
                    }
                </li>
                <li>or </li>
                <li>{ "number of row" : { error message } }</li>

            </ul>
            <?php if (isset($_SESSION['Loged'])) { ?>
                <a target="_blank" href="https://paste.ofcode.org/EzxXNgm3khqBtwYFvnbrfU"> view source code</a>
            <?php } ?>
            <br>
            <p></p>
        </div>

        <div class="container-fluid" style="background-color: whitesmoke" >
            <h3 id="page5">My Houses</h3>
            <p>Displays all the Houses created by the Customer with the email given to the email parameter </p>
            <h4>Link:</h4><p id="message4"> https://enikioadmin.000webhostapp.com/Test/HouseOperations.php?key=API_KEY&operation=0&email=EMAIL</p>

            <button class="btn btn-default" onclick="copyToClipboard('message4')"><span class="glyphicon glyphicon-copy"></span> Copy Link</button>
            <h4>Privilege Required: </h4>
            <ul style="list-style-type:none">
                <li>Medium</li>
                <li>High</li>
                <li>Low</li>
            </ul>
            <h4>Type of request:</h4>
            <ul style="list-style-type:none">
                <li>GET</li>
            </ul>
            <h4>Parameteres:</h4>
            <ul style="list-style-type:none">
                <li>-</li>
            </ul>
            <h4>Returns:</h4>
            <h5>Error messages: </h5>
            <ul style="list-style-type:none">
                <li>Invalid email format, email mast have the format of something@something.something</li>
                <li> Email can have 40 characters max </li>
                <li> The email doesn't exist in the database </li>
                <li> You need to enter the email </li>
                <li> Wrong operation value </li>
                <li> You need to enter the operation  </li>
                <li> Your API key is wrong or doesn't exist ask the Admins for more information </li>
                <li> You need to enter your API_KEY </li>

            </ul>
            <h5>Success messages: </h5>
            <ul style="list-style-type:none">
                <li>
                    succsess = true
                </li>

            </ul>
            <h5>Json: </h5>
            <ul style="list-style-type:none">
                <li>
                    { "number of row <b style="color:red;font-size:16px;">-1</b>" : {
                    <ul style="list-style-type:none">
                        <li>"houseID" : "value of houseID"</li>
                        <li>"perioxi" : "value of perioxi"</li>
                        <li>"tm" : "value of tm"</li>
                        <li>"Timi" : "value of Timi"</li>
                        <li>"tupos" : "value of tupos"</li>
                        <li>"epiplomeno" : "value of epiplomeno"</li>
                        <li>"phoneNumber" : "value of phoneNumber"</li>
                        <li>"Reports" : "value of Reports"</li>

                    </ul>
                    }

                </li>
                <li><b>or</b> </li>
                <li>{ "number of row" :</li>
                <ul style="list-style-type:none">
                    <li>{ </li>
                    <li> "success = true" </li> 
                    <li>}  </li>
                </ul> 
                <li>}  </li>
                <li><b>or</b></li>
                <li>{  </li>
                <li> "success=fasle" </li> 
                <li> "message" = error</li>
                <li>}  </li>

            </ul>
            <?php if (isset($_SESSION['Loged'])) { ?>
                <a target="_blank" href="https://paste.ofcode.org/s57GCcB78r6rURNyQnCgUM"> House Class Source code</a>
                <p></p>
                <a target="_blank" href="https://paste.ofcode.org/sTAvS6tJhveAV6xCivmEDY"> House Operations Source code</a>
            <?php } ?>
            <br>
            <p></p>
        </div>


        <div class="container-fluid" >
            <h3 id="page7">My Favorites</h3>
            <p>Displays all the Favorite Houses of the Customer with the email given to the email parameter </p>
            <h4>Link:</h4><p id="message6"> https://enikioadmin.000webhostapp.com/House/My_Favorites.php?email=Email_OF_Customer&key=API_KEY</p>

            <button class="btn btn-default" onclick="copyToClipboard('message6')"><span class="glyphicon glyphicon-copy"></span> Copy Link</button>
            <h4>Privilege Required: </h4>
            <ul style="list-style-type:none">
                <li>Medium</li>
                <li>High</li>
                <li>Low</li>
            </ul>
            <h4>Type of request:</h4>
            <ul style="list-style-type:none">
                <li>GET</li>
            </ul>
            <h4>Parameteres:</h4>
            <ul style="list-style-type:none">
                <li>-</li>
            </ul>
            <h4>Returns:</h4>
            <h5>Error messages: </h5>
            <ul style="list-style-type:none">
                <li><b>key </b><ol type="1">
                        <li>You Have to enter your API key</li>
                        <li>You don't have an API key, you can ask for one from the main page</li>
                    </ol></li>
                <li>
                    <b> email</b>
                    <ol type="1">
                        <li>Email is required</li>
                        <li>email not found</li>
                    </ol></li>
                </li>
            </ul>
            <h5>Success messages: </h5>
            <ul style="list-style-type:none">
                <li>
                    All the favorite of the Customer with the email given to the email parameter
                </li>

            </ul>
            <h5>Json: </h5>
            <ul style="list-style-type:none">
                <li>
                    { "number of row" : {
                    <ul style="list-style-type:none">
                        <li>"houseID" : "value of houseID"</li>
                        <li>"perioxi" : "value of perioxi"</li>
                        <li>"tm" : "value of tm"</li>
                        <li>"Timi" : "value of Timi"</li>
                        <li>"tupos" : "value of tupos"</li>
                        <li>"epiplomeno" : "value of epiplomeno"</li>
                        <li>"phoneNumber" : "value of phoneNumber"</li>
                        <li>"Reports" : "value of Reports"</li>

                    </ul>
                    }
                </li>
                <li>or </li>
                <li>{ "number of row" : { error message } }</li>

            </ul>
            <?php if (isset($_SESSION['Loged'])) { ?>
                <a target="_blank" href="https://paste.ofcode.org/325GFaiP3iP69BmnTzzhP4C"> view source code</a>
            <?php } ?>
            <br>
            <p></p>
        </div>

        <div class="container-fluid" style="background-color: whitesmoke">
            <h3 id="page6">House Locations</h3>
            <p>Displays all the location of the houses to rent </p>
            <h4>Link:</h4><p id="message5"> https://enikioadmin.000webhostapp.com/House/My_Favorites.php?email=Email_OF_Customer&key=API_KEY</p>

            <button class="btn btn-default" onclick="copyToClipboard('message5')"><span class="glyphicon glyphicon-copy"></span> Copy Link</button>
            <h4>Privilege Required: </h4>
            <ul style="list-style-type:none">
                <li>Medium</li>
                <li>High</li>
                <li>Low</li>
            </ul>
            <h4>Type of request:</h4>
            <ul style="list-style-type:none">
                <li>GET</li>
            </ul>
            <h4>Parameteres:</h4>
            <ul style="list-style-type:none">
                <li>-</li>
            </ul>
            <h4>Returns:</h4>
            <h5>Error messages: </h5>
            <ul style="list-style-type:none">
                <li><b>key </b><ol type="1">
                        <li>You Have to enter your API key</li>
                        <li>You don't have an API key, you can ask for one from the main page</li>
                    </ol></li>


            </ul>
            <h5>Success messages: </h5>
            <ul style="list-style-type:none">
                <li>
                    Displays all the location of the houses to rent
                </li>

            </ul>
            <h5>Json: </h5>
            <ul style="list-style-type:none">
                <li>
                    { "number of row" : {
                    <ul style="list-style-type:none">
                        <li>"houseID" : "value of houseID"</li>
                        <li>"tm" : "value of tm"</li>
                        <li>"Timi" : "value of Timi"</li>
                        <li>"tupos" : "value of tupos"</li>
                        <li>"geografikoPlatos" : "value of geografikoPlatos"</li>
                        <li>"geografikoMikos" : "value of geografikoMikos"</li>
                        <li>"Reports" : "value of Reports"</li>

                    </ul>
                    }
                </li>
                <li>or </li>
                <li>{ "number of row" : { error message } }</li>

            </ul>
            <?php if (isset($_SESSION['Loged'])) { ?>
                <a target="_blank" href="https://paste.ofcode.org/X2KRU6CZysXAZZxXv4J3mh"> view source code</a>
            <?php } ?>
            <br>
            <p></p>
        </div>


        <br><br>
        <a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button" title="Click to return on the top page" data-toggle="tooltip" data-placement="left"><span class="glyphicon glyphicon-chevron-up"></span></a>

    </body>
</html>