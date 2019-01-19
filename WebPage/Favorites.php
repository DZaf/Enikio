<?php
session_start();
unset($_SESSION['jsonData']);
if (isset($_SESSION['email'])){
$url = "https://enikioadmin.000webhostapp.com/Test/HouseOperations.php?operation=1&email=".$_SESSION["email"]."&key=c245eb9221f65bb871a4a9fe253dfbe0c6d3d74d";
$json = file_get_contents($url);
$object = json_decode($json, true);
$num_rows = count($object);
$isFavorite = -1;
?>
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Αγαπημένα</title>

        <!-- Bootstrap core CSS -->
        <link href="vendor/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="topScroll.css" rel="stylesheet">
        <link href="Footer.css" rel="stylesheet">
        <script src="https://use.fontawesome.com/33070007c5.js"></script>
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <style>
            
            #favorites{
             color: #222222;   
            }
            
            .container-foto
            {
                background-image: url("2.jpg");
                background-repeat: no-repeat;
                background-attachment: fixed;
                background-position: top;
            }



            body {
                font-family: 'Poppins', sans-serif;
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

        </style>
        <script src="fav_report.js"></script>
    </head>
    <body>

        <!-- Navigation -->
        <?php include 'navBar.php';?>



        <!-- side navbar -->



        <br><br><br><br>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-1 col-sm-0 col-md-1">
                </div>
                <div class="col-lg-10 col-sm-12">

                        <!-- /.col-lg-3 -->

                        <div class="col-lg-12 ">
                            <ol class="breadcrumb" style="background-color: #ff5a5f;margin-top:10px;">
                                <li><a href="index.php" style="color:white">Home</a></li>
                                <li class="active" style="color:whitesmoke">Search</li>
                            </ol>

                            <div style="background-color:whitesmoke;padding:10px 60px 10px 60px">
                            <h3 style="text-align: center;color: #555;font-size:30px">Οι αγαπημένες μου αγγελίες</h3><br>
                            <label style="background-color: #ff5a5f;color:white;padding: 3px 11px 3px 11px;font-weight: normal;font-size: 16px">Favorites <small>(<?php echo ($num_rows -1)?>)</small></label>         
                            <hr style=" margin-top: -6px;border: 0px solid #ff5a5f;border-top-width: 1px;">
                            <div class="row" >


                                <?php for ($i = 0; $i < $num_rows -1; $i++) { ?>
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
                                    
                                    ?>


                                    <div class="card h-100" id="<?php echo $object[$i]['houseID'] ?>" name="<?php echo $_SESSION['email'] ?>">
                                        <a href="HouseView.php?var=<?php echo $object[$i]['houseID'] ?>"><img class="card-img-top" src="2.jpg" alt=""></a>

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
                    </div>


                </div>
                <div class="col-lg-1 col-sm-0 col-md-1">
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
        ?> 

    </body>
<?php }else{
     header("location: Login.php");
}
?>