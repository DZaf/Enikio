<nav class="navbar navbar-default navbar-fixed-top" style="opacity: 0.9;background-color:whitesmoke;padding: 10px">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php" style="color:#222222;font-size: 18px;">Σ<i class="fa fa-home"></i>ίτι μου Σ<i class="fa fa-home"></i>ιτάκι μου</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">

                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="index.php" id="home" style="font-size: 18px" >Αρχική</a></li>
                        
                        <li><a href="Search.php" id="search" style="font-size: 18px">Αναζήτηση</a></li>
                        
                        <?php if (!isset($_SESSION['email'])) { ?>
                            <li><a href="Login.php" id="login" style="font-size: 18px">Είσοδος</a></li>
                            <li><a href="Register.php" id="register" style="font-size: 18px">Εγγραφή</a></li>
                        <?php } else { ?>
                            <li><a href="Favorites.php" id="favorites" style="font-size: 18px">Αγαπημένα</a></li>
                            <li><a href="Logout.php" style="font-size: 18px">Έξοδος</a></li>
                            <li class="dropdown">
                            <a href="../navbar/" id="myHouses" style="font-size: 18px" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"><i style="color:#555" class="fa fa-user-circle-o"></i> <?php echo $_SESSION['name']?> <span class="caret"></span></a>
                            <ul class="dropdown-menu" id="drop">
                                <li><a href="kostasTEST.php" id="profile">Προφίλ</a></li>
                                <li><a href="NewEntry.php">Νέα αγγελία</a></li>
                                <li><a href="MyHouses.php">Οι αγγελίες μου</a></li>
                                
                            </ul>
                        </li>
                            <?php } ?>

                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </nav>
