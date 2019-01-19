<?php
session_start();
if (!isset($_SESSION['Loged'])) {
    header("location: index.php");
}

include("db.php");
$mysqlconnection = mysqli_connect($db_host, $db_user, $db_password, $db_name);

if (isset($_POST['Archive'])) {
//    echo "LALALALAL";
    $file = 'Log/Log.txt';


    $sql = "Select * from log ORDER BY dates DESC, logId DESC";
    $result = mysqli_query($mysqlconnection, $sql);
    $req_num_rows = mysqli_num_rows($result);
    $json = mysqli_fetch_all($result, MYSQLI_ASSOC);

    for ($i = 0; $i < $req_num_rows; $i++) {
        $log_row = "ID: " . $json[$i]['logId'] . " ACTION:" . $json[$i]['actions'] . " COMMENT: " . $json[$i]['comments'] . " DATE: " . $json[$i]['dates'] . " \n";
        file_put_contents($file, $log_row, FILE_APPEND | LOCK_EX);
        $sql1 = "Delete from log where logId= " . $json[$i]['logId'] . "";
        $result1 = mysqli_query($mysqlconnection, $sql1);
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Enikio Log Table </title>
        <meta name="description" content="Enikio Admin">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $("#load").load("LogAjax.php");

                $.ajaxSetup({
                    cache: false
                });
                setInterval(function () {
                    $("#load").load("LogAjax.php");
                }, 1000);
            });
        </script>
    </head>
    <body >
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
                        <li><a href="Reports.php">Reports</a></li>
                        <li class="active"><a href="Log.php">Log File</a></li>
                        <li><a href="Logout.php">Logout</a></li>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container -->
        </nav><!-- /.navbar -->



        <div class='container-fluid' ><div class='container'>
                <h3>Dictionary</h3>
                <br><b>FCorrect:</b> A function worked correctly
                <br><b>FWrong:</b> A function worked but user made a mistake
                <br><b>FError:</b> A function didn't work correctly
                <br><b>Insert:</b> Something inserted on some table 
                <br><b>Update:</b> Something updated on some table
                <br><b>Delete:</b> Something Deleted on Some table
                <p></p>
                <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
                    <button class="btn btn-primary"  name="Archive" id="Archive" type="submit" > Add to Archive</button>
                </form>
                <H3> Log </H3>
                <table id='tableID' class='table table-responsive'>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>LogID</th>
                            <th>Action</th>
                            <th>Comments</th>
                            <th>Date of log</th>
                        </tr>
                    </thead>


                    <tbody id="load">
                    </tbody>
                </table>
            </div>
        </div>



    </body>

</html>