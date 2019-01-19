<?php
session_start();
if (!isset($_SESSION['Loged'])) {
    header("location: index.php");

}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Enoikio Commands</title>
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
                    <a class="navbar-brand" href="#">Enikio Admin Panel</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="Home.php">Home</a></li>
                        <li><a href="API.php">API</a></li>
                        <li class="active" ><a href="Commands.php">Commands</a></li>
                        <li><a href="Reports.php">Reports</a></li>
                        <li><a href="Log.php">Log File</a></li>
                        <li><a href="Logout.php">Logout</a></li>
                        <li>
                            <a class="btn btn-default btn-outline btn-circle collapsed"  data-toggle="collapse" href="#nav-collapse1" aria-expanded="false" aria-controls="nav-collapse1">Categories</a>
                        </li>
                    </ul>
                    <ul class="collapse nav navbar-nav nav-collapse" id="nav-collapse1">
                        <li><a href="#page1">Register</a></li>
                        <li><a href="#page2">Login</a></li>
                        <li><a href="#page3">New Favorite</a></li>
                        <li><a href="#page4">New City</a></li>
                        <li><a href="#page5">New Phone</a></li>
                        <li><a href="#page6">New Photo</a></li>
                        <li><a href="#page7">New Report</a></li>
                        <li><a href="#page8">New House</a></li>
                        <li><a href="#page9">Mail Verify</a></li>
                        <li><a href="#page10">is Favorite</a></li>
                        <li><a href="#page11">Display House</a></li>
                        <li><a href="#page12">Display Home Page</a></li>
                        <li><a href="#page13">All Favorite</a></li>
                        <li><a href="#page14">Display All Favorites</a></li>
                        <li><a href="#page15">Display Location</a></li>
                        <li><a href="#page16">My Houses</a></li>
                        <li><a href="#page17">Delete House</a></li>
                        <li><a href="#page18">Delete Customer</a></li>
                        <li><a href="#page19">Delete Favorite</a></li>
                        <li><a href="#page20">Delete Log</a></li>
                        <li><a href="#page21">Delete MailVerification</a></li>
                        <li><a href="#page22">Delete Phone</a></li>
                        <li><a href="#page23">Delete Photo</a></li>
                        <li><a href="#page24">Ignore Report</a></li>
                        <li><a href="#page25">Blame Mail Report</a></li>
                        <li><a href="#page26">Blame House Report</a></li>
                        <li><a href="#page27">Display Closed Reports</a></li>
                        <li><a href="#page28">Display Opened Reports</a></li>
                        <li><a href="#page29">Display Reports</a></li>
                        <li><a href="#page30">Display Reports For Customer</a></li>
                        <li><a href="#page31">Update House</a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container -->
        </nav><!-- /.navbar -->

        <div class="container-fluid" style="background-color: whitesmoke" >
            <h3 id="page1">Function Register</h3>
            <b>Syntax:</b><p id="message" >Select Register(' firstname ',' surname ',' password ',' mail ', phone_number );</p>
            <b>Example:</b> <p>Select Register('Dimitris','Papadopoulos','123','dimpapa@gmail.com',23456789);</p>
            <b>RETURNS:</b><br> 	
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;0 if Error<br>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;1 if Correct<br>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;2 if Email already exists
            <br><button class="btn btn-default" onclick="copyToClipboard('message')"><span class="glyphicon glyphicon-copy"></span>  Copy Register</button>
            <p></p>
            <br>
        </div>
        <div class="container-fluid" >
            <h3 id="page2">Function Login</h3>
            <b>Syntax:</b> <p id="messages">Select Login(' mail ',' password ');</p>
            <b>Example:</b> <p>Select Login('dimpapa@gmail.com','123');</p>
            <b>RETURNS: </b> <br> 
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;0 if Email doesn't exist<br>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;1 if Correct<br>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;2 if Wrong password<br>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;3 if Not verified yet
            <br><button class="btn btn-default" onclick="copyToClipboard('messages')"><span class="glyphicon glyphicon-copy"></span> Copy Login</button>
            <p></p>
            <br>
        </div>
        <div class="container-fluid" style="background-color: whitesmoke" >
            <h3 id="page3">Function New_Favorite</h3>
            <b>Syntax:</b> <p id="message1">Select New_Favorite(' mail ', HouseID );</p>
            <b>Example:</b> <p>Select New_Favorite('dimpapa@gmail.com',1);</p>
            <b>RETURNS:</b><br>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;0 if Error<br>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;1 if Correct<br>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;2 if Email doesnt exist
            <br><button class="btn btn-default" onclick="copyToClipboard('message1')"><span class="glyphicon glyphicon-copy"></span> Copy New_Favorite</button>
            <p></p>
            <br>
        </div>
        <div class="container-fluid"  >
            <h3 id="page4">Function New_City</h3>
            <b>Syntax:</b>  <p id="message2">Select New_City(' State ', ' City's_Name ');</p>
            <b>Example:</b>  <p>Select New_City('Samos','Karlovasi');</p>
            <b>RETURNS:</b> <br>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;0 if Samos Karlovasi exists<br>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;1 if Correct
            <br><button class="btn btn-default" onclick="copyToClipboard('message2')"><span class="glyphicon glyphicon-copy"></span> Copy New_City</button>
            <p></p>
            <br>
        </div>
        <div class="container-fluid" style="background-color: whitesmoke" >
            <h3 id="page5">Function New_Phone</h3>
            <b>Syntax:</b> <p id="message3">Select New_Phone(HouseID , Phone_Number);</p>
            <b>Example:</b> <p>Select New_Phone(1 ,345678);</p>
            <b>RETURNS:</b> <br>	
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;0 if Error<br>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;1 if Correct<br>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;2 if Phone exists
            <br><button class="btn btn-default" onclick="copyToClipboard('message3')"><span class="glyphicon glyphicon-copy"></span> Copy New_Phone</button>
            <p></p>
            <br>
        </div>
        <div class="container-fluid" >
            <h3 id="page6">Function New_Photo</h3>
            <b>Syntax:</b> <p id="message4">Select New_Photos(HouseID ,' Photo_Path ');</p>
            <b>Example:</b> <p>Select New_Photos(1 ,'/images/1/saloni.jpg');</p>
            <b>RETURNS:</b> <br>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;0 if Error<br>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;1 if Correct<br>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;2 if Phone exists
            <br><button class="btn btn-default" onclick="copyToClipboard('message4')"><span class="glyphicon glyphicon-copy"></span> Copy New_Photo</button>
            <br>
        </div>
        <div class="container-fluid" style="background-color: whitesmoke" >
            <h3 id="page7">Function New_Report</h3>
            <b>Syntax:</b> <p id="message5">Select New_Report(' Email ', HouseID ,' Reason ', 'Comment' );</p>
            <b>Example:</b> <p>Select New_Report('dimpapa@gmail.com' ,1,'Wrong Price','The price is 2 euros');</p>
            <b>RETURNS:</b> <br>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;0 if Error<br>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;1 if Correct<br>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;2 if Report already exists<br>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;3 if the house belongs to the person who does the report
            <br><button class="btn btn-default" onclick="copyToClipboard('message5')"><span class="glyphicon glyphicon-copy"></span> Copy New_Report</button>
            <p></p>
            <br>
        </div>
        <div class="container-fluid" >
            <h3 id="page8">Function New_House</h3>
            <b>Syntax:</b> <p id="message5">Select New_House(' Email ',' Nomos ',' Poli ',' Perioxi ',TetragwnikaMetra, Timi ,' Orofos ',' Dieuthinsi ',GeografikoPlatos,GeografikoMikos,' Epiplomeno ',' A/C ',' Tzaki ',' Kipos ',' Pisina ',' Anelkistiras ',' Apothiki ',' Beranta ',' IliakosThermosifwnas ',' Parking',' Thea ',' Noikiasmeno ',' ImerominiaKataskebis ',' Perigrafi ',' Tupos ',' EidosThermansis ',' MesoThermansis ',ArithmosDomatiwn);</p>
            <b>Example:</b> <p>Select New_House('dimpapa@gmail.com' ,'Samos','Karlovasi','Neo Karlovasi', 60,250,'1','likourgou logothetou',37.784351,26.705256,'NAI','OXI','OXI','OXI','OXI','NAI','NAI','OXI','OXI','OXI','OXI','OXI','27/08/1821','ευηλιο ευαερο','Δυαρι','πετρελεο','καλοριφερ',3);</p>
            <b>RETURNS:</b> <br>	
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;0 if Error<br>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;1 if Correct
            <br><button class="btn btn-default" onclick="copyToClipboard('message6')"><span class="glyphicon glyphicon-copy"></span> Copy New_House</button>
            <p></p>
            <br>
        </div>
        <div class="container-fluid" style="background-color: whitesmoke" >
            <h3 id="page9">Function Mail_Verify</h3>
            <b>Syntax:</b> <p id="message7">Select Mail_Verify(' Email ', ' link ');</p>
            <b>Example:</b> <p>Select Mail_Verify('dimpapa@gmail.com', '7c3228656129daf717802c34223ebd8577de3ef1');</p>
            <b>RETURNS:</b> <br>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;0 if Error<br>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;1 if Correct<br>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;2 if he is already verified
            <br><button class="btn btn-default" onclick="copyToClipboard('message7')"><span class="glyphicon glyphicon-copy"></span> Copy Mail_Verify</button>
            <p></p>
            <br>
        </div>
        <div class="container-fluid" >
            <h3 id="page10">Function is_Favorite</h3>
            <b>Syntax:</b> <p id="message8">Select is_Favorite(' Email ', HouseID);</p>
            <b>Example:</b> <p>Select is_Favorite('dimpapa@gmail.com', 3);</p>
            <b>RETURNS:</b> <br>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;0 if Error<br>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;1 if house is Favorite<br>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;2 if house isn't Favorite
            <br><button class="btn btn-default" onclick="copyToClipboard('message8')"><span class="glyphicon glyphicon-copy"></span> Copy is_Favorite</button>
            <p></p>
            <br>
        </div>
        <div class="container-fluid" style="background-color: whitesmoke" >
            <h3 id="page11">Procedure Display_House</h3>
            <b>Syntax:</b> <p id="message9">CALL Display_House( HouseID );</p>
            <b>Example:</b> <p>CALL Display_House( 4 );</p>
            <b>RETURNS:</b> <br>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;One row with the data of the house which ID=3 if house doesnt exist it returns 0 rows<br>
            <b>Data returned:</b>
            <p> &emsp;&emsp;&emsp;&emsp;&emsp;&emsp; (houseID ,customerMail ,nomos ,poli ,perioxi ,tm ,Timi ,orofos ,dieuthinsi ,geografikoPlatos ,geografikoMikos ,epiplomeno ,ac ,tzaki ,kipos ,pisina ,anelkistiras ,apothiki ,beranta ,IliakosThermosifwnas ,parking ,thea ,noikiasmeno ,imerominiaKataskebis ,imerominiaAnaneosis ,perigrafi ,tupos ,eidosThermansis ,mesoThermansis ,arithmosDomatiwn ,Report,phoneNumber)</p> <br>
            <br><button class="btn btn-default" onclick="copyToClipboard('message9')"><span class="glyphicon glyphicon-copy"></span> Copy Display_House</button>
            <p></p>
            <br>
        </div>
        <div class="container-fluid" >
            <h3 id="page12">Procedure Display_Home_Page</h3>
            <b>Syntax:</b> <p id="message10">CALL Display_Home_Page( TheNumberOfHousesYouWant );</p>
            <b>Example:</b> <p>CALL Display_Home_Page( 8 );</p>
            <b>RETURNS:</b> <br>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;The example returns the 8 most recent inserted houses (not rented)<br>
            <b>Data returned:</b> <br>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;(houseID , perioxi , tm ,  Timi , tupos , epiplomeno, noikiasmeno,phoneNumber,Report) <br>
            <br><button class="btn btn-default" onclick="copyToClipboard('message10')"><span class="glyphicon glyphicon-copy"></span> Copy Display_Home_Page</button>
            <p></p>
            <br>
        </div>
        <div class="container-fluid" style="background-color: whitesmoke" >
            <h3 id="page13">Procedure All_Favorite</h3>
            <b>Syntax:</b> <p id="message11">CALL All_Favorite(' Email ');</p>
            <b>Example:</b> <p>CALL All_Favorite('dimpapa@gmail.com');</p>
            <b>RETURNS:</b> <br>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Returns a list of HouseID which the given email has as favorite<br>
            <b>Data returned:</b> <br>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;(houseID) <br>
            <br><button class="btn btn-default" onclick="copyToClipboard('message11')"><span class="glyphicon glyphicon-copy"></span> Copy All_Favorite</button>
            <p></p>
            <br>
        </div>     
        <div class="container-fluid" >
            <h3 id="page14">Procedure Display_All_Favorites</h3>
            <b>Syntax:</b> <p id="message12">CALL Display_All_Favorites(' Email ');</p>
            <b>Example:</b> <p>CALL Display_All_Favorites('dimpapa@gmail.com');</p>
            <b>RETURNS:</b> <br>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;All the data of the houses that the customer with the given mail has as favorite<br>
            <b>Data returned:</b> <br>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;(houseID , perioxi , tm ,  Timi , tupos , epiplomeno, noikiasmeno,Report)  <br>
            <br><button class="btn btn-default" onclick="copyToClipboard('message12')"><span class="glyphicon glyphicon-copy"></span> Copy Display_All_Favorites</button>
            <p></p>
            <br>
        </div> 
        <div class="container-fluid" style="background-color: whitesmoke">
            <h3 id="page15">Procedure Display_Location</h3>
            <b>Syntax:</b> <p id="message13">CALL Display_Location();</p>
            <b>Example:</b> <p>CALL Display_Location();</p>
            <b>RETURNS:</b> <br>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Returns a list of all houses that are not rented<br>
            <b>Data returned:</b> <br>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;(houseID , tm , Timi ,  tupos , geografikoPlatos , geografikoMikos ,Report)  <br>
            <br><button class="btn btn-default" onclick="copyToClipboard('message13')"><span class="glyphicon glyphicon-copy"></span> Copy Display_Location</button>
            <p></p>
            <br>
        </div>  
        <div class="container-fluid" >
            <h3 id="page16">Procedure My_Houses</h3>
            <b>Syntax:</b> <p id="message50">CALL My_Houses(' Email ');</p>
            <b>Example:</b> <p>CALL My_Houses('dimpapa@gmail.com');</p>
            <b>RETURNS:</b> <br>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Returns a list of all houses that customer with the given mail created the houses<br>
            <b>Data returned:</b> <br>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;(houseID , tm , Timi ,  tupos , geografikoPlatos , geografikoMikos , noikiasmeno,Report)<br>
            <br><button class="btn btn-default" onclick="copyToClipboard('message50')"><span class="glyphicon glyphicon-copy"></span> Copy Display_Location</button>
            <p></p>
            <br>
        </div> 
        <div class="container-fluid" style="background-color: whitesmoke" >
            <h3 id="page17">Function Delete_House</h3>
            <b>Syntax:</b><p id="message14" >Select Delete_House( HouseID );</p>
            <b>Example:</b> <p>Select Delete_House( 4 );</p>
            <b>RETURNS:</b><br> 	
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;0 if House doesn't exists<br>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;1 if House Deleted<br>
            <br><button class="btn btn-default" onclick="copyToClipboard('message14')"><span class="glyphicon glyphicon-copy"></span> Copy Delete House</button>
            <p></p>
            <br>
        </div>
        <div class="container-fluid">
            <h3 id="page18">Function Delete_Customer</h3>
            <b>Syntax:</b><p id="message15" >Select Delete_Customer( 'Email' );</p>
            <b>Example:</b> <p>Select Delete_Customer( 'dimitrispapa@gmail.com' );</p>
            <b>RETURNS:</b><br> 	
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;0 if Customer doesn't exists<br>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;1 if Customer Deleted<br>
            <br><button class="btn btn-default" onclick="copyToClipboard('message15')"><span class="glyphicon glyphicon-copy"></span> Copy Delete Customer</button>
            <p></p>
            <br>
        </div>
        <div class="container-fluid" style="background-color: whitesmoke" >
            <h3 id="page19">Function Delete_Favorite</h3>
            <b>Syntax:</b><p id="message16" >Select Delete_Favorite( 'Email' ,HouseID );</p>
            <b>Example:</b> <p>Select Delete_Favorite( 'dimitrispapa@gmail.com',4 );</p>
            <b>RETURNS:</b><br> 	
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;0 if Favorite doesn't exists<br>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;1 if Favorite Deleted<br>
            <br><button class="btn btn-default" onclick="copyToClipboard('message16')"><span class="glyphicon glyphicon-copy"></span> Copy Delete Favorite</button>
            <p></p>
            <br>
        </div>
        <div class="container-fluid">
            <h3 id="page20">Function Delete_Log</h3>
            <b>Syntax:</b><p id="message17" >Select Delete_Log( LogID );</p>
            <b>Example:</b> <p>Select Delete_Log( 80 );</p>
            <b>RETURNS:</b><br> 	
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;0 if Log doesn't exists<br>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;1 if Log Deleted<br>
            <br><button class="btn btn-default" onclick="copyToClipboard('message17')"><span class="glyphicon glyphicon-copy"></span> Copy Delete Log</button>
            <p></p>
            <br>
        </div>
        <div class="container-fluid" style="background-color: whitesmoke" >
            <h3 id="page21">Function Delete_Mailvirification</h3>
            <b>Syntax:</b><p id="message18" >Select Delete_Mailvirification( 'Email');</p>
            <b>Example:</b> <p>Select Delete_Mailvirification( 'dimitrispapa@gmail.com');</p>
            <b>RETURNS:</b><br> 	
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;0 if Mailvirification doesn't exists<br>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;1 if Mailvirification Deleted<br>
            <br><button class="btn btn-default" onclick="copyToClipboard('message18')"><span class="glyphicon glyphicon-copy"></span> Copy Delete Mailvirification</button>
            <p></p>
            <br>
        </div>
        <div class="container-fluid">
            <h3 id="page22">Function Delete_Phones</h3>
            <b>Syntax:</b><p id="message20" >Select Delete_Phones( HouseID,Phone);</p>
            <b>Example:</b> <p>Select Delete_Phones( 4, 23410101010);</p>
            <b>RETURNS:</b><br> 	
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;0 if Phone doesn't exists<br>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;1 if Phone Deleted<br>
            <br><button class="btn btn-default" onclick="copyToClipboard('message20')"><span class="glyphicon glyphicon-copy"></span> Copy Delete Phones</button>
            <p></p>
            <br>
        </div>
        <div class="container-fluid" style="background-color: whitesmoke" >
            <h3 id="page23">Function Delete_Photo</h3>
            <b>Syntax:</b><p id="message21" >Select Delete_Photo( HouseID,'Path');</p>
            <b>Example:</b> <p>Select Delete_Photo( 4, '/photos/4/kouzina.jpg');</p>
            <b>RETURNS:</b><br> 	
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;0 if Photo doesn't exists<br>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;1 if Photo Deleted<br>
            <br><button class="btn btn-default" onclick="copyToClipboard('message21')"><span class="glyphicon glyphicon-copy"></span> Copy Delete Photos</button>
            <p></p>
            <br>
        </div>
        <div class="container-fluid" >
            <h3 id="page24">Function Ignore_Report</h3>
            <b>Syntax:</b><p id="message22" >Select Ignore_Report(  'Email' ,HouseID);</p>
            <b>Example:</b> <p>Select Ignore_Report( 'dimitrispapa@gmail.com',4 );</p>
            <b>RETURNS:</b><br> 	
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;0 if Report doesn't exists<br>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;1 if Reports status Updated to 'Ignored'<br>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;2 if Report isn't open<br>
            <br><button class="btn btn-default" onclick="copyToClipboard('message22')"><span class="glyphicon glyphicon-copy"></span> Copy Ignore Report</button>
            <p></p>
            <br>
        </div>
        <div class="container-fluid" style="background-color: whitesmoke" >
            <h3 id="page25">Function Blame_Report_Email</h3>
            <b>Syntax:</b><p id="message23" >Select Blame_Report_Email(  'Email' ,HouseID);</p>
            <b>Example:</b> <p>Select Blame_Report_Email( 'dimitrispapa@gmail.com',4 );</p>
            <b>RETURNS:</b><br> 	
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;0 if Report doesn't exists<br>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;1 if Reports status Updated to 'Blaim Mail'<br>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;2 if Report isn't open<br>
            <br><button class="btn btn-default" onclick="copyToClipboard('message23')"><span class="glyphicon glyphicon-copy"></span> Copy Blame Report Email</button>
            <p></p>
            <br>
        </div>
        <div class="container-fluid" >
            <h3 id="page26">Function Blame_Report_House</h3>
            <b>Syntax:</b><p id="message24" >Select Blame_Report_House(  'Email' ,HouseID);</p>
            <b>Example:</b> <p>Select Blame_Report_House( 'dimitrispapa@gmail.com',4 );</p>
            <b>RETURNS:</b><br> 	
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;0 if Report doesn't exists<br>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;1 if Report status Updated to 'Blaim House'<br>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;2 if Report isn't open<br>
            <br><button class="btn btn-default" onclick="copyToClipboard('message24')"><span class="glyphicon glyphicon-copy"></span> Copy Blame Report House</button>
            <p></p>
            <br>
        </div>
        <div class="container-fluid" style="background-color: whitesmoke">
            <h3 id="page27">Procedure Display_Closed_Reports</h3>
            <b>Syntax:</b><p id="message25" >CALL Display_Closed_Reports();</p>
            <b>Example:</b> <p>CALL Display_Closed_Reports();</p>
            <b>RETURNS:</b><br> 	
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Returns a list of all reports that are not open<br>
            <b>Data returned:</b> <br>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;(email , houseID , reason ,  comment , reportDate , status)<br>
            <br><button class="btn btn-default" onclick="copyToClipboard('message25')"><span class="glyphicon glyphicon-copy"></span> Copy Display Closed Reports</button>
            <p></p>
            <br>
        </div>
        <div class="container-fluid">
            <h3 id="page28">Procedure Display_Opened_Reports</h3>
            <b>Syntax:</b><p id="message26" >CALL Display_Opened_Reports();</p>
            <b>Example:</b> <p>CALL Display_Opened_Reports();</p>
            <b>RETURNS:</b><br> 	
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Returns a list of all reports that are open<br>
            <b>Data returned:</b> <br>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;(email , houseID , reason ,  comment , reportDate , status)<br>
            <br><button class="btn btn-default" onclick="copyToClipboard('message26')"><span class="glyphicon glyphicon-copy"></span> Copy Display Opened Reports</button>
            <p></p>
            <br>
        </div>
        <div class="container-fluid" style="background-color: whitesmoke">
            <h3 id="page29">Procedure Display_Reports</h3>
            <b>Syntax:</b><p id="message27" >CALL Display_Reports();</p>
            <b>Example:</b> <p>CALL Display_Reports();</p>
            <b>RETURNS:</b><br> 	
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Returns a list of all reports <br>
            <b>Data returned:</b> <br>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;(email , houseID , reason ,  comment , reportDate , status)<br>
            <br><button class="btn btn-default" onclick="copyToClipboard('message27')"><span class="glyphicon glyphicon-copy"></span> Copy Display Reports</button>
            <p></p>
            <br>
        </div>
        <div class="container-fluid">
            <h3 id="page30">Procedure Display_Reports_For_Customer</h3>
            <b>Syntax:</b><p id="message28" >CALL Display_Reports_For_Customer('Email','All'/'open'/'Blame Report House');</p>
            <b>Example:</b> <p>CALL Display_Reports_For_Customer('dimitrispapa@gmail.com','All');</p>
            <b>RETURNS:</b><br> 	
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Returns a list of all reports or reports that are 'open' or 'Blame Report House' FOR the certain customer<br>
            <b>Data returned:</b> <br>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;(email , houseID , reason ,  comment , reportDate , status)<br>
            <br><button class="btn btn-default" onclick="copyToClipboard('message28')"><span class="glyphicon glyphicon-copy"></span> Copy Display Reports For Customer</button>
            <p></p>
            <br>
        </div>
        <div class="container-fluid">
            <h3 id="page31">Function Update_House</h3>
            <b>Syntax:</b><p id="message29" >Select Update_House($houseID,
                '$email','$nomos','$poli','$perioxi',$tm,$Timi,'$orofos', 
                '$dieuthinsi',$geografikoPlatos,$geografikoMikos,'$epiplomeno','$ac','$tzaki',
                '$kipos','$pisina','$anelkistiras','$apothiki','$beranta','$IlikakosTheromosifwnas',
                '$parking','$thea','$noikiasmeno','$imerominiaKataskevis','$perigrafi','$tupos',
                '$eidosThermansis','$mesoThermansis',$arithmosDomatiwn)as result;</p>
            <b>Example:</b> <p>Select Update_House(11, 'a@a.a','neasamos','samos','peroxi',111,111,'o', 'dieuthinsi',131.32001,134.20134,'epiplomeno','ac','tzaki', 'kipos','pisina','anelkistiras','apothiki','beranta','iliakos', 'parking','thea','noikiasmeno','1932914','perigrafi','tupos', 'eidosThermansis','mesoThermansis',4);</p>
            <b>RETURNS:</b> <br>	
            <!-- &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;0 if Error<br> -->
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;1 if Correct
            <br>
            <br><button class="btn btn-default" onclick="copyToClipboard('message29')"><span class="glyphicon glyphicon-copy"></span> Copy Update_House</button>
            <p></p>
            <br>
        </div>


        <br><br>
        <a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button" title="Click to return on the top page" data-toggle="tooltip" data-placement="left"><span class="glyphicon glyphicon-chevron-up"></span></a>

    </body>
</html>