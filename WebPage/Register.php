<?php
if (isset($_REQUEST['var'])) {

    if ($_REQUEST['var'] == 0)
        $_SESSION['message'] = "Προέκυψε κάποιο σφάλμα";
}
?>
<!DOCTYPE html>
<head>

    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Εγγραφή</title>


    <!-- Custom styles for this template -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="Footer.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://apis.google.com/js/client:platform.js?onload=renderButton" async defer></script>
    <script src="https://use.fontawesome.com/33070007c5.js"></script>

    <meta name="google-signin-client_id" content="395356856797-2o7rbpaplhr7honq84lm71e5sh6brnb8.apps.googleusercontent.com">

    <style>

        #register{
            color: #222222;   
        }

        body{
            font-family: 'Poppins', sans-serif;
        }
        .container-foto
        {
            background-image: url("2.jpg");
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: top;
        }
        label{
            font-weight: normal;
            font-size:15px;
        }

        .profile{
            border: 3px solid #B7B7B7;
            padding: 10px;
            margin-top: 10px;
            width: 350px;
            background-color: #F7F7F7;
            height: 160px;
        }
        .profile p{margin: 0px 0px 10px 0px;}
        .head{margin-bottom: 10px;}
        .head a{float: right;}
        .profile img{width: 100px;float: left;margin: 0px 10px 10px 0px;}
        .proDetails{float: left;}
    </style>
    <script>
        function checkForm()
        {
            var pass1 = document.getElementById('passwordregister');
            var message = document.getElementById('messageValidate');
            reWeak = /^([a-z]+)|([A-Z]+)/;
            reStrong = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
            if (reStrong.test(pass1.value)) {
                message.innerHTML = "Strong password";
                message.style.color = "#007a1c";
                pass1.style.borderColor = "#82f94f";

            } else if (reWeak.test(pass1.value)) {
                message.innerHTML = "Weak password";
                message.style.color = "#ffb84d";
                pass1.style.borderColor = "#ffb84d";
            }


        }

        function checkPass()
        {
            var pass1 = document.getElementById('passwordregister');
            var pass2 = document.getElementById('confpass');
            var message = document.getElementById('confirmMessage');

            if (pass1.value == pass2.value) {
                message.innerHTML = "Οι κωδικοί ταιριάζουν!"
                message.style.color = "#007a1c";
                pass2.style.borderColor = "#82f94f";
            } else {
                message.innerHTML = "Οι κωδικοί δεν ταιριάζουν!"
                message.style.color = "#ef5353";
                pass2.style.borderColor = "#ef5353";
            }
        }

        $(document).ready(function () {
            $('#register-form').submit(function (event) {

                // get the form data
                var formData = $(this).serialize();
                //alert(formData);
                // process the form
                $.ajax({
                    type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
                    url: 'https://enikioadmin.000webhostapp.com/Customers/CustomerOperations.php?operation=0&key=c245eb9221f65bb871a4a9fe253dfbe0c6d3d74d', // the url where we want to POST
                    data: formData, // our data object
                    dataType: 'json', // what type of data do we expect back from the server
                    encode: true
                            //server done
                }).done(function (data) {
                    $(location).attr("href", "Login.php");
                })

                        // using the fail promise callback
                        .fail(function (data) {
                            console.log(data);
                            var message = JSON.parse(data.responseText);
                            console.log(message.message);

                            $("#loginModalWrapper").empty().append("&nbsp<span style='font-size:16px;color:#ff5a5f' class='glyphicon glyphicon-info-sign'></span> " + message.message);
                            //$(location).attr("href", "Register.php?var=" + message + "");
                        });

                event.preventDefault();

            });
        });


    </script>

    <script src="fb-google_login.js"></script>

</head>
<body>


    <!--Navigation -->
    <?php include 'navBar.php';?>
    <Br><br><Br><br><Br><br>

    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-5">

                <label style="background-color: #ff5a5f;color:white;padding: 3px 11px 3px 11px;font-weight: normal;font-size: 17px">Εγγραφή</label>        
                <hr style=" margin-top: -6px;border: 0px solid #ff5a5f;border-top-width: 1px;">
                <form name="register-form" id="register-form" class="form-horizontal" method="POST">
                    <div class="form-group">
                        <div class=" col-sm-12 col-md-12">
                            <label for="name" class="control-label">Όνομα</label><label data-toggle="tooltip" title="Το πεδίο είναι υποχρεωτικό"><font color="#ff5a5f" >*</font></label> 
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12 col-md-12">
                            <label for="surname" class="control-label">Επίθετο</label><label data-toggle="tooltip" title="Το πεδίο είναι υποχρεωτικό"><font color="#ff5a5f" >*</font></label> 
                            <input type="text" class="form-control" id="surname" name="surname" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12 col-md-12">
                            <label for="emailregister" class="control-label">Email</label><label data-toggle="tooltip" title="Το πεδίο είναι υποχρεωτικό"><font color="#ff5a5f" >*</font></label> 
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class=" col-sm-12 col-md-12">
                            <label for="passwordregister" class="control-label">Κωδικός</label><label data-toggle="tooltip" title="Το πεδίο είναι υποχρεωτικό"><font color="#ff5a5f" >*</font></label> 
                            <input type="password" class="form-control" id="password" required  name="password" onkeyup="checkForm()">
                            <span id="messageValidate" class="confirmMessage"></span>
                        </div>

                    </div>
                    <div class="form-group">
                        <div class=" col-sm-12 col-md-12">
                            <label for="confpass" class="control-label">Επιβεβαίωση κωδικού</label><label data-toggle="tooltip" title="Το πεδίο είναι υποχρεωτικό"><font color="#ff5a5f" >*</font></label> 
                            <input type="password" class="form-control" id="confpass" required name="confpass" onkeyup="checkPass();
                                    return false;">
                            <span id="confirmMessage" class="confirmMessage"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class=" col-sm-12 col-md-12">
                            <label for="confpass" class="control-label">Αριθμός τηλεφώνου</label>
                            <input type="number" class="form-control" id="phone" name="phone" >
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <button type="submit" id="register_btn" class="btn" name="register_btn" style="background-color: #ff5a5f;color:white">Register</button>
                        <label id="loginModalWrapper">

                        </label>

                    </div>


                </form>

            </div>

            <div class="col-lg-2 col-md-2"></div>

            <div class="col-lg-5 col-md-5">
                <label style="background-color: #ff5a5f;color:white;padding: 3px 11px 3px 11px;font-weight: normal;font-size: 17px">Εναλλακτικά </label>         
                <hr style=" margin-top: -6px;border: 0px solid #ff5a5f;border-top-width: 1px;">
                <script>(function (d, s, id) {
                        var js, fjs = d.getElementsByTagName(s)[0];
                        if (d.getElementById(id))
                            return;
                        js = d.createElement(s);
                        js.id = id;
                        js.src = "//connect.facebook.net/el_GR/sdk.js#xfbml=1&version=v2.10&appId=474463712937237";
                        fjs.parentNode.insertBefore(js, fjs);
                    }(document, 'script', 'facebook-jssdk'));</script>


                <div id="fb-root"></div>
<!--                <script>(function (d, s, id) {
                        var js, fjs = d.getElementsByTagName(s)[0];
                        if (d.getElementById(id))
                            return;
                        js = d.createElement(s);
                        js.id = id;
                        js.src = "//connect.facebook.net/el_GR/sdk.js#xfbml=1&version=v2.10&appId=474463712937237";
                        fjs.parentNode.insertBefore(js, fjs);
                    }(document, 'script', 'facebook-jssdk'));</script>-->

                <div id="gSignIn"></div>
                <!-- HTML for displaying user details -->
                <div class="userContent"></div><br>
                <div class="fb-login-button" data-max-rows="1" data-size="large" data-button-type="continue_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="false" scope="public_profile,email"
                     onlogin="checkLoginState();"></div>
                <label id="fbloginModalWrapper">

                </label>

                <br><br>
                <div id="searchContent" style="background-color:#333333;padding:20px 18px 20px 18px">
                    <h3 style="color:whitesmoke">Μετά την εγγραφή σου θα μπορείς</h3>
                    <hr>
                    <p style="color:whitesmoke"><i style="color:#ff5a5f" class="fa fa-circle"></i> Να αποθηκεύεις τις αγαπημένες σου αγγελίες</p>
                    <p style="color:whitesmoke"><i style="color:#ff5a5f" class="fa fa-circle"></i> Να αναφέρεις κάποιο πρόβλημα που αφορά μία αγγελία</p>
                    <p style="color:whitesmoke"><i style="color:#ff5a5f" class="fa fa-circle"></i> Να ανεβάσεις μία δική σου αγγελία</p>
                    <p style="color:whitesmoke"><i style="color:#ff5a5f" class="fa fa-circle"></i> Να κάνεις διαφήμηση του μεσιτικού σου γραφείου</p>
                </div>
            </div>    

        </div>

    </div>
    <br>

    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        }
        );
    </script>
    <?php
    include ("Footer.html");
    ?> 


</body>

