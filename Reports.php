<?php
session_start();
include("db.php");

if (!isset($_SESSION['Loged'])) {
    header("location: index.php");

}
if(!isset($_SESSION['id']))
{
    $_SESSION['id'] = 'All';
}

$mysqlconnection = mysqli_connect($db_host, $db_user, $db_password, $db_name);


if(isset($_POST['state'])){
if ($_POST['state'] == 'Blame_Customer') {  
    $sql = "Select Blame_Report_Email(  '".$_POST['email']."' ,".$_POST['ID'].");";
    $result = mysqli_query($mysqlconnection, $sql);
}
else if ($_POST['state'] == 'Blame_Owner') {  
    $sql = "Select Blame_Report_House(  ".$_POST['Houseid']." ,".$_POST['ID'].");";
    $result = mysqli_query($mysqlconnection, $sql);
}
else if ($_POST['state'] == 'Ignore') {  
    $sql = "Select Ignore_Report( ".$_POST['ID'].");";
    $result = mysqli_query($mysqlconnection, $sql);
}

}




?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Enikio Reports </title>
        <meta name="description" content="Enikio Admin">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script>
            $(document).ready(function () {
                $("#load").load("ReportsAjax.php");
                $.ajaxSetup({
                    cache: false
                });
                setInterval(function () {
                    $("#load").load("ReportsAjax.php");
                }, 1000);
            });
            $(document).ready(function () {
                $(".StatusList").click(function () {
                    $("li.active").removeClass("active");
                    $(this).parent().addClass("active");
                    $.ajax({
                        url: "ReportsAjax.php",
                        method: "POST",
                        data: {id: $(this).attr('name')}, //STO ID THA MPEI TO ID TIS PTIXIAKIS
                    });
                });
            });
            
      
            
            
        </script>



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
                        <li><a href="Commands.php">Commands</a></li>
                        <li class="active"><a href="Reports.php">Reports</a></li>
                        <li><a href="Log.php">Log File</a></li>
                        <li><a href="Logout.php">Logout</a></li>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container -->
        </nav><!-- /.navbar -->

        <div class="container-fluid" >
            <div class="container">
                <H3> Reports </H3>
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Status<span class="caret"></span></button>
                    <ul class="dropdown-menu">

                        <li class='active' ><a href='#' class='StatusList' name='All'>All</a></li>


                        <li class=''><a href='#' class='StatusList' name='Opened' >Opened</a></li>

                        <li class=''> <a href='#' class='StatusList' name='Closed' >Closed</a></li>

                    </ul>
                </div>
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ID</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Reason</th>
                            <th>Comment</th>
                            <th>Report Date</th>
                            <th>Status</th>
                            <th>Link</th>
                            <?php
                            if($_SESSION['Loged']!='Moderator')
{?>
                            <th>Blame Customer</th>
                            <th>Blame Owner</th>
                            <th>Ignore</th>
<?php }?>
                        </tr>
                    </thead>
                    <tbody id="load">
                    </tbody>
                    

                </table>
            </div> 
        </div>



    </body>

</html>