<?php
if (isset($_REQUEST['var'])) {


    $_SESSION['message'] = $_REQUEST['var'];
}
?>
<!DOCTYPE html>
<head>

    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Σύνδεση</title>


    <!-- Custom styles for this template -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="Footer.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
    <script src="https://use.fontawesome.com/33070007c5.js"></script>
    
    <script src="https://apis.google.com/js/client:platform.js?onload=renderButton" async defer></script>
<meta name="google-signin-client_id" content="395356856797-2o7rbpaplhr7honq84lm71e5sh6brnb8.apps.googleusercontent.com">
    
    <style>
        
        #login{
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
    </style>

    <script>
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
                    encode: true
                            //server done
                }).done(function (data) {
                    console.log(data);
                    $("#loginModalWrapper").empty().append("&nbspΠαρακαλώ περιμένετε<img  class='d-block img-fluid' src='loading.gif' style='width:50px;height:50px;'>");
                    $.ajax({
                        type: "POST",
                        url: "index.php",
                        data: {email: data.email, name: data.name},
                        success: function () {
                            $(location).attr("href", "index.php");
                        }
                    });
                    //if not
                })

                        // using the fail promise callback
                        .fail(function (data) {
                            var message = JSON.parse(data.responseText);
                            //console.log(message.message);

                            $("#loginModalWrapper").empty().append("&nbsp<span style='font-size:16px;color:#ff5a5f' class='glyphicon glyphicon-info-sign'></span> " + message.message);
                            //$(location).attr("href", "Login.php?var=" + message + "");
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

    <div class="container" >
        <div class="row">
            <div class="col-lg-5">
                <label style="background-color: #ff5a5f;color:white;padding: 3px 11px 3px 11px;font-weight: normal;font-size: 17px">Είσοδος</label>        
                <hr style=" margin-top: -6px;border: 0px solid #ff5a5f;border-top-width: 1px;">
                <form name="login-form" id="login-form" class="form-horizontal" method="POST">
                    <div class="form-group">
                        <div class=" col-sm-12 col-md-12">
                            <label for="email" class="control-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class=" col-sm-12 col-md-12">
                            <label for="password" class="control-label">Κωδικός</label>
                            <input type="password" class="form-control" id="password" required  name="password">
                        </div>

                    </div>
                    <div class="col-sm-12">
                        <button type="submit" id="login_btn" name="login_btn" class="btn" style="background-color: #ff5a5f;color:white">Login</button>
                        <label id="loginModalWrapper">

                        </label>
                    </div>

                </form>
            </div>

            <div class="col-lg-2"></div>

            <div class="col-lg-5">
                <label style="background-color: #ff5a5f;color:white;padding: 3px 11px 3px 11px;font-weight: normal;font-size: 17px">Εναλακτικά</label>        
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
                
                
                

            </div>    

        </div>

    </div>
    <br>
    <?php
        include ("Footer.html");
        ?> 


</body>

