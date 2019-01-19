        <?php

        class House {

            private $mysqlconnection;

            function __construct() {
                //include db.php once if something is going wrong with the file it'll make a fatal error
                //https://stackoverflow.com/questions/3546160/include-include-once-require-or-require-once
                require_once "../db.php";

                //conection with the database
                $this->mysqlconnection = mysqli_connect($db_host, $db_user, $db_password, $db_name);
                mysqli_set_charset($this->mysqlconnection, "utf8");
            }

                //Function that checks input for injections
                public function test_input($data) {
                    //This function returns a string with whitespace stripped from the beginning and end of str
                    //http://php.net/manual/en/function.trim.php
                    $data = trim($data, "\t\n\r\0\x0B");
                    //The stripslashes() function removes backslashes added by the addslashes() function.
                    //https://www.w3schools.com/PhP/func_string_stripslashes.asp
                    $data = stripslashes($data);
                    //The htmlspecialchars() function converts some predefined characters to HTML entities.
                    //https://www.w3schools.com/PhP/func_string_htmlspecialchars.asp
                    $data = htmlspecialchars($data);
                    return $data;
                }

                function MyHouses(){
                    if (isset($_GET['email'])) {
                    $email="";
                    $emailErr=array();
                    //Validate Email
                    
                        $email = $this->test_input($_GET["email"]);
                        // check if e-mail address is well-formed
                        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            array_push($emailErr, " Invalid email format ");
                        }//check the lenght
                        if (strlen($email) > 40) {
                            array_push($emailErr, " Email can have 40 characters max");
                        }
                        if(empty($emailErr))
                        {
                       
                        $sql = "Select exists(Select email from customer where email='$email' ) as result;";
                        $query = mysqli_query( $this->mysqlconnection , $sql);
                        $result = mysqli_fetch_array($query);
                        if($result['result']==1)
                        {
                        $hasApiKey=false;
                        
                        $keyErr = array();
                    
                        //Validate key
                        if (empty($_GET['key'])) {
                            array_push($keyErr, "You Have to enter your API key");
                            echo json_encode($keyErr, JSON_FORCE_OBJECT);
                        } else {
                            $key = $this->test_input($_GET['key']);
                    
                            //check if the given API KEY exists
                            $sql1 = "select * from API_Config;";
                            $result1 = mysqli_query( $this->mysqlconnection , $sql1);
                            $req_num_rows1 = mysqli_num_rows($result1);
                            $json1 = mysqli_fetch_all($result1, MYSQLI_ASSOC);
                    
                            for ($i = 0; $i < $req_num_rows1; $i++) {
                    
                                if ($json1[$i]['Code'] == $key) {
                    
                                    $sql = "Update API_Config Set TimesUsed= TimesUsed+1 where ID=" . $json1[$i]['ID'] . ";";
                                    mysqli_query($this->mysqlconnection, $sql);
                                    $hasApiKey = true;
                                }
                            }
                    
                            
                            
                            //if the API KEY doesnt exist
                            if (!$hasApiKey) {
                                array_push($keyErr, "You don't have an API key, you can ask for one from the main page");
                                echo json_encode($keyErr, JSON_FORCE_OBJECT);
                            }
                            else
                            {
                                $sql = "CALL My_Houses('$email')";
                            $result = mysqli_query( $this->mysqlconnection , $sql);
                            $req_num_rows = mysqli_num_rows($result);
                            $json = mysqli_fetch_all($result, MYSQLI_ASSOC);
                            
                            //makes the json into a write way to parse after calling the page
                            $json = json_encode($json, JSON_FORCE_OBJECT);
                            echo $json;
                            }
                        }
                        }
                        else
                        {
                                        echo json_encode(array( "Invalid mail"), JSON_FORCE_OBJECT);
                        }
                    }
                    else
                    {
                        echo json_encode($emailErr, JSON_FORCE_OBJECT);
                    }
                    
                }
                else
                {
                    $error = array("Email is required");
                    echo json_encode($error, JSON_FORCE_OBJECT);
                }
            }        

            function MyFavorites()
            {
                if (isset($_GET['email'])) {
                    $keyErr = array();
                    $hasApiKey =false;
                //Validate key
                    if (empty($_GET['key'])) {
                        array_push($keyErr, "You Have to enter your API key");
                        echo json_encode($keyErr, JSON_FORCE_OBJECT);
                    } else {
                        $key = $this->test_input($_GET['key']);
                
                        //check if the given API KEY exists
                        $sql1 = "select * from API_Config;";
                        $result1 = mysqli_query($this->mysqlconnection, $sql1);
                        $req_num_rows1 = mysqli_num_rows($result1);
                        $json1 = mysqli_fetch_all($result1, MYSQLI_ASSOC);
                
                        for ($i = 0; $i < $req_num_rows1; $i++) {
                
                            if ($json1[$i]['Code'] == $key) {
                                if ($json1[$i]['Privilege'] != 'Low') {
                                $sql = "Update API_Config Set TimesUsed= TimesUsed+1 where ID=" . $json1[$i]['ID'] . ";";
                                mysqli_query($this->mysqlconnection, $sql);
                                $hasApiKey = true;
                                } else {
                                    array_push($keyErr, "You don't have the right privilege");
                                }
                            }
                        }
                
                $check = "Select exists(Select email from customer where email='$email' ) as result";
                $checkResult = mysqli_query($this->mysqlconnection, $check);
                        $result = mysqli_fetch_array($checkResult);
                
                    
                }
                if($result['result'] ==1)
                {
                    
                       //if the API KEY doesnt exist
                       if (!$hasApiKey) {
                           array_push($keyErr, "You don't have an API key, you can ask for one from the main page");
                           echo json_encode($keyErr, JSON_FORCE_OBJECT);
                       }
                       else
                       {
                           $sql = "CALL  Display_All_Favorites( '$email' );";
                       $result = mysqli_query($this->mysqlconnection, $sql);
                       $req_num_rows = mysqli_num_rows($result);
                       $json = mysqli_fetch_all($result, MYSQLI_ASSOC);
                       
                       //makes the json into a write way to parse after calling the page
                       $json = json_encode($json, JSON_FORCE_OBJECT);
                       echo $json;
                       }
                }
                

            }
            else{
                echo json_encode(array("email not found"), JSON_FORCE_OBJECT);;
            }
        }

        function HouseView(){
           
            
            if (isset($_GET['houseID'])) {
                $HouseID = $_GET['houseID'];
                $keyErr = array();
                $hasApiKey =false;
            //Validate key
                if (empty($_GET['key'])) {
                    array_push($keyErr, "You Have to enter your API key");
                    echo json_encode($keyErr, JSON_FORCE_OBJECT);
                } else {
                    $key = $this->test_input($_GET['key']);
            
                    //check if the given API KEY exists
                    $sql1 = "select * from API_Config;";
                    $result1 = mysqli_query($this->mysqlconnection, $sql1);
                    $req_num_rows1 = mysqli_num_rows($result1);
                    $json1 = mysqli_fetch_all($result1, MYSQLI_ASSOC);
            
                    for ($i = 0; $i < $req_num_rows1; $i++) {
            
                        if ($json1[$i]['Code'] == $key) {
            
                            $sql = "Update API_Config Set TimesUsed= TimesUsed+1 where ID=" . $json1[$i]['ID'] . ";";
                            mysqli_query($this->mysqlconnection, $sql);
                            $hasApiKey = true;
                        }
                    }
                }
            
            $check = "Select exists(select houseID from house where houseID=$HouseID) as result";
            $checkResult = mysqli_query($this->mysqlconnection, $check);
                    $result = mysqli_fetch_array($checkResult);

                if($result['result'] ==1)
                {
                    
                       //if the API KEY doesnt exist
                       if (!$hasApiKey) {
                           array_push($keyErr, "You don't have an API key, you can ask for one from the main page");
                           echo json_encode($keyErr, JSON_FORCE_OBJECT);
                       }
                       else
                       {
                        $sql = "CALL  Display_House( $HouseID );";
                        $result = mysqli_query($this->mysqlconnection, $sql);
                        $req_num_rows = mysqli_num_rows($result);
                        $json = mysqli_fetch_all($result, MYSQLI_ASSOC);
                       
                       //makes the json into a write way to parse after calling the page
                       $json = json_encode($json, JSON_FORCE_OBJECT);
                       echo $json;
                       }
                }
            }
            else{
                echo json_encode(array("houseID not found"), JSON_FORCE_OBJECT);;
            }
            
        }


        function HouseMap()
        {
            
            $keyErr=array();
            //Validate key
            if (empty($_GET['key'])) {
                array_push($keyErr, "You Have to enter your API key");
                echo json_encode($keyErr, JSON_FORCE_OBJECT);
            } else {
                 
                $hasApiKey=false;
                $key = $this->test_input($_GET['key']);
                
            
                //check if the given API KEY exists
                $sql1 = "select * from API_Config;";
                $result1 = mysqli_query($this->mysqlconnection, $sql1);
                $req_num_rows1 = mysqli_num_rows($result1);
                $json1 = mysqli_fetch_all($result1, MYSQLI_ASSOC);
            
                for ($i = 0; $i < $req_num_rows1; $i++) {
            
                    if ($json1[$i]['Code'] == $key) {
            
                        $sql = "Update API_Config Set TimesUsed= TimesUsed+1 where ID=" . $json1[$i]['ID'] . ";";
                        mysqli_query($this->mysqlconnection, $sql);
                        $hasApiKey = true;
                    }
                }
            
            
            
                //if the API KEY doesnt exist
                if (!$hasApiKey) {
                    array_push($keyErr, "You don't have an API key, you can ask for one from the main page");
                    echo json_encode($keyErr, JSON_FORCE_OBJECT);
                } else {
                    $sql = "CALL Display_Location();";
                    $result = mysqli_query($this->mysqlconnection, $sql);
                    $req_num_rows = mysqli_num_rows($result);
                    $json = mysqli_fetch_all($result, MYSQLI_ASSOC);
            
                    //makes the json into a write way to parse after calling the page
                    $json = json_encode($json, JSON_FORCE_OBJECT);
                    echo $json;
                }
            }
                
        }

        function HomePage()
        {
            if (isset($_GET['var'])) {
                $numberOfHouses = $_GET['var'];
                $keyErr = array();
                
                    //Validate key
                    if (empty($_GET['key'])) {
                        array_push($keyErr, "You Have to enter your API key");
                        echo json_encode($keyErr, JSON_FORCE_OBJECT);
                    } else {
                        $key = $this->test_input($_GET['key']);
                
                        //check if the given API KEY exists
                        $sql1 = "select * from API_Config;";
                        $result1 = mysqli_query($this->mysqlconnection, $sql1);
                        $req_num_rows1 = mysqli_num_rows($result1);
                        $json1 = mysqli_fetch_all($result1, MYSQLI_ASSOC);
                
                        for ($i = 0; $i < $req_num_rows1; $i++) {
                
                            if ($json1[$i]['Code'] == $key) {
                
                                $sql = "Update API_Config Set TimesUsed= TimesUsed+1 where ID=" . $json1[$i]['ID'] . ";";
                                mysqli_query($this->mysqlconnection, $sql);
                                $hasApiKey = true;
                            }
                        }
                
                        
                        $sql = "CALL Display_Home_Page($numberOfHouses)";
                        $result = mysqli_query($this->mysqlconnection, $sql);
                        $req_num_rows = mysqli_num_rows($result);
                        $json = mysqli_fetch_all($result, MYSQLI_ASSOC);
                        
                        //makes the json into a write way to parse after calling the page
                        $json = json_encode($json, JSON_FORCE_OBJECT);
                        echo $json;
                        //if the API KEY doesnt exist
                        if (!$hasApiKey) {
                            array_push($keyErr, "You don't have an API key, you can ask for one from the main page");
                            echo json_encode($keyErr, JSON_FORCE_OBJECT);
                        }
                    }
                }//end of if isset get[var]
                else
            {
                $error = array("Number of houses is required");
                echo json_encode($error, JSON_FORCE_OBJECT);
            }
                
        }

        function InsertHouse()
        {
            
             $emailErr = $keyErr = $errorLog = array();
          
            $email = $key = $nomos = $poli = $perioxi  = $dieuthinsi =
            $imerominiaKataskevis = $orofos  = $IlikakosTheromosifwnas = $beranta = $apothiki = $parking =
            $pisina = $noikiasmeno = $thea = $tzaki = $ac = $epiplomeno = $anelkistiras = $kipos = $perigrafi = 
            $tupos = $mesoThermansis = $eidosThermansis = "";  //strings

            $tm = $Timi = $arithmosDomatiwn = 0; //int
            $geografikoPlatos = $geografikoMikos = 0.0; //double
            $hasApiKey = false;

            //Validate key
            if (empty($_GET['key'])) {
                array_push($keyErr, "You Have to enter your API key");
            } else {
                $key = $this->test_input($_GET['key']);

                //check if the given API KEY exists
                $sql1 = "select * from API_Config;";
                $result1 = mysqli_query($this->mysqlconnection, $sql1);
                $req_num_rows1 = mysqli_num_rows($result1);
                $json1 = mysqli_fetch_all($result1, MYSQLI_ASSOC);

                for ($i = 0; $i < $req_num_rows1; $i++) {

                if ($json1[$i]['Code'] == $key) {
                    if ($json1[$i]['Privilege'] != 'Low') {
                        $sql = "Update API_Config Set TimesUsed= TimesUsed+1 where ID=" . $json1[$i]['ID'] . ";";
                        mysqli_query($this->mysqlconnection, $sql);
                        $hasApiKey = true;
                } else {
                    array_push($keyErr, "You don't have the right privilege");
                }
            }
        }
        //if the API KEY doesnt exist
        if (!$hasApiKey) {
            array_push($keyErr, "You don't have an API key, you can ask for one from the main page");
            }
        }


        //Validate Email
        if (empty($_POST["email"])) {
            array_push($emailErr, " Email is required");
        } else {
            $email = $this->test_input($_POST["email"]);
            // check if e-mail address is well-formed
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                array_push($emailErr, " Invalid email format ");
            }//check the lenght
            if (strlen($email) > 40) {
                array_push($emailErr, " Email can have 40 characters max");
            }
        }

        //Strings
        if(isset($_POST["nomos"])){
            $nomos  = $this->test_input($_POST["nomos"]);
        }else{ array_push($errorLog, " Nomos is missing"); }

        if(isset($_POST["poli"])){
            $poli   = $this->test_input($_POST["poli"]);
        }else{ array_push($errorLog, " poli is missing"); }

        if(isset($_POST["perioxi"])){
            $perioxi = $this->test_input($_POST["perioxi"]);
        }else{ array_push($errorLog, " perioxi is missing"); }

        if(isset($_POST["dieuthinsi"])){
        $dieuthinsi = $this->test_input($_POST["dieuthinsi"]);
        }else{ array_push($errorLog, " dieuthinsi is missing"); }

        $imerominiaKataskevis = $this->test_input($_POST["imerominiaKataskevis"]);
        $orofos  = $this->test_input($_POST["orofos"]);
        $IlikakosTheromosifwnas = $this->test_input($_POST["IlikakosTheromosifwnas"]);      
        $beranta = $this->test_input($_POST["beranta"]);
        $apothiki = $this->test_input($_POST["apothiki"]);
        $parking = $this->test_input($_POST["parking"]);
        
        
        $pisina = $this->test_input($_POST["pisina"]);
        $noikiasmeno = $this->test_input($_POST["noikiasmeno"]);
        $thea = $this->test_input($_POST["thea"]);
        $tzaki = $this->test_input($_POST["tzaki"]);
        $ac = $this->test_input($_POST["ac"]);
        $epiplomeno = $this->test_input($_POST["epiplomeno"]);
        $anelkistiras = $this->test_input($_POST["anelkistiras"]);
        $kipos = $this->test_input($_POST["kipos"]);
        $perigrafi = $this->test_input($_POST["perigrafi"]);
        
        $tupos = $this->test_input($_POST["tupos"]);
        $mesoThermansis = $this->test_input($_POST["mesoThermansis"]);
        $eidosThermansis = $this->test_input($_POST["eidosThermansis"]);

        //Integers
        if(isset($_POST["tm"])){
            $tm = $this->test_input($_POST["tm"]);
        }else{ array_push($errorLog, " tm is missing"); }
        if(isset($_POST["Timi"])){
            $Timi = $this->test_input($_POST["Timi"]);
        }else{ array_push($errorLog, " Timi is missing"); }

        $arithmosDomatiwn = $this->test_input($_POST["arithmosDomatiwn"]);

        //Double
        $geografikoMikos = $this->test_input($_POST["geografikoMikos"]);
        $geografikoPlatos = $this->test_input($_POST["geografikoPlatos"]);


        //if the api key is corect and all the parameters are valid
        if ($hasApiKey && empty($emailErr) && empty($keyErr) && empty($errorLog)) {
            $sql = "Select New_House(
            '$email','$nomos','$poli','$perioxi',$tm,$Timi,'$orofos', 
            '$dieuthinsi',$geografikoPlatos,$geografikoMikos,'$epiplomeno','$ac','$tzaki',
            '$kipos','$pisina','$anelkistiras','$apothiki','$beranta','$IlikakosTheromosifwnas',
            '$parking','$thea','$noikiasmeno','$imerominiaKataskevis','$perigrafi','$tupos',
            '$eidosThermansis','$mesoThermansis',$arithmosDomatiwn)as result;";
            $query = mysqli_query($this->mysqlconnection, $sql);
            $result = mysqli_fetch_array($query);


            //Invalid mail, mail doesn;t exist
            if ($result['result'] == '0') {
                if (empty($emailErr)) {
                    array_push($emailErr, "Invalid mail " . $email);
                }
                if ($keyErr == '') {
                    $keyErr = "Ok";
                }
                
                $ErrorJson = array('success' => false, 'status' => 422, 'email' => $emailErr, 'API key' => $keyErr, 'message' => "Error");
                //You are now Loged in
                } else if ($result['result'] == '1') {
                if (empty($emailErr)) {
                    array_push($emailErr, $email);
                }
                if ($keyErr == '') {
                    $keyErr = "Ok";
                }
               

                $ErrorJson = array('success' => true, 'status' => 202, 'email' => $email, 'API key' => 'Ok', 'message' => 'Success');
        }
        echo json_encode($ErrorJson, JSON_FORCE_OBJECT);
        }
    }


    function UpdateHouse()
    {
        
        $emailErr = $keyErr = $errorLog = array();
      
        $email = $key = $nomos = $poli = $perioxi  = $dieuthinsi =
        $imerominiaKataskevis = $orofos  = $IlikakosTheromosifwnas = $beranta = $apothiki = $parking =
        $pisina = $noikiasmeno = $thea = $tzaki = $ac = $epiplomeno = $anelkistiras = $kipos = $perigrafi = 
        $tupos = $mesoThermansis = $eidosThermansis = "";  //strings

        $houseID = $tm = $Timi = $arithmosDomatiwn = 0; //int
        $geografikoPlatos = $geografikoMikos = 0.0; //double
        $hasApiKey = false;

        //Validate key
        if (empty($_GET['key'])) {
            array_push($keyErr, "You Have to enter your API key");
        } else {
            $key = $this->test_input($_GET['key']);

            //check if the given API KEY exists
            $sql1 = "select * from API_Config;";
            $result1 = mysqli_query($this->mysqlconnection, $sql1);
            $req_num_rows1 = mysqli_num_rows($result1);
            $json1 = mysqli_fetch_all($result1, MYSQLI_ASSOC);

            for ($i = 0; $i < $req_num_rows1; $i++) {

            if ($json1[$i]['Code'] == $key) {
                if ($json1[$i]['Privilege'] != 'Low') {
                    $sql = "Update API_Config Set TimesUsed= TimesUsed+1 where ID=" . $json1[$i]['ID'] . ";";
                    mysqli_query($this->mysqlconnection, $sql);
                    $hasApiKey = true;
            } else {
                array_push($keyErr, "You don't have the right privilege");
            }
        }
    }
    //if the API KEY doesnt exist
    if (!$hasApiKey) {
        array_push($keyErr, "You don't have an API key, you can ask for one from the main page");
        }
    }

    if (empty($_GET["houseID"])) {
        array_push($errorLog, " HouseID is required");
    } else {
        $houseID = $this->test_input($_GET["houseID"]);
        //check if the given houseID exists
        $sql = "Select exists(Select houseID from house where houseID = " . $houseID . ")  as result;";
        $result = mysqli_query($this->mysqlconnection, $sql);
        $req_num_rows = mysqli_num_rows($result);
        $json = mysqli_fetch_array($result, MYSQLI_ASSOC);

        if($json["result"] == 0)
        {
            array_push($errorLog, " Woah! No such house as houseID : " . $houseID ." !");
        }
    }
    


    //Validate Email
    if (empty($_POST["email"])) {
        array_push($emailErr, " Email is required");
    } else {
        $email = $this->test_input($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($emailErr, " Invalid email format ");
        }//check the lenght
        if (strlen($email) > 40) {
            array_push($emailErr, " Email can have 40 characters max");
        }
    }
   

    //Strings
    if(isset($_POST["nomos"])){
        $nomos  = $this->test_input($_POST["nomos"]);
    }else{ array_push($errorLog, " Nomos is missing"); }

    if(isset($_POST["poli"])){
        $poli   = $this->test_input($_POST["poli"]);
    }else{ array_push($errorLog, " poli is missing"); }

    if(isset($_POST["perioxi"])){
        $perioxi = $this->test_input($_POST["perioxi"]);
    }else{ array_push($errorLog, " perioxi is missing"); }

    if(isset($_POST["dieuthinsi"])){
    $dieuthinsi = $this->test_input($_POST["dieuthinsi"]);
    }else{ array_push($errorLog, " dieuthinsi is missing"); }

    $imerominiaKataskevis = $this->test_input($_POST["imerominiaKataskevis"]);
    $orofos  = $this->test_input($_POST["orofos"]);
    $IlikakosTheromosifwnas = $this->test_input($_POST["IlikakosTheromosifwnas"]);      
    $beranta = $this->test_input($_POST["beranta"]);
    $apothiki = $this->test_input($_POST["apothiki"]);
    $parking = $this->test_input($_POST["parking"]);
    
    
    $pisina = $this->test_input($_POST["pisina"]);
    $noikiasmeno = $this->test_input($_POST["noikiasmeno"]);
    $thea = $this->test_input($_POST["thea"]);
    $tzaki = $this->test_input($_POST["tzaki"]);
    $ac = $this->test_input($_POST["ac"]);
    $epiplomeno = $this->test_input($_POST["epiplomeno"]);
    $anelkistiras = $this->test_input($_POST["anelkistiras"]);
    $kipos = $this->test_input($_POST["kipos"]);
    $perigrafi = $this->test_input($_POST["perigrafi"]);
    
    $tupos = $this->test_input($_POST["tupos"]);
    $mesoThermansis = $this->test_input($_POST["mesoThermansis"]);
    $eidosThermansis = $this->test_input($_POST["eidosThermansis"]);

    //Integers
    if(isset($_POST["tm"])){
        $tm = $this->test_input($_POST["tm"]);
    }else{ array_push($errorLog, " tm is missing"); }
    if(isset($_POST["Timi"])){
        $Timi = $this->test_input($_POST["Timi"]);
    }else{ array_push($errorLog, " Timi is missing"); }

    $arithmosDomatiwn = $this->test_input($_POST["arithmosDomatiwn"]);

    //Double
    $geografikoMikos = $this->test_input($_POST["geografikoMikos"]);
    $geografikoPlatos = $this->test_input($_POST["geografikoPlatos"]);


    //if the api key is corect and all the parameters are valid
    if ($hasApiKey && empty($emailErr) && empty($keyErr) && empty($errorLog)) {
        //Update House set  
        echo $sql = "Select Update_House($houseID,
        '$email','$nomos','$poli','$perioxi',$tm,$Timi,'$orofos', 
        '$dieuthinsi',$geografikoPlatos,$geografikoMikos,'$epiplomeno','$ac','$tzaki',
        '$kipos','$pisina','$anelkistiras','$apothiki','$beranta','$IlikakosTheromosifwnas',
        '$parking','$thea','$noikiasmeno','$imerominiaKataskevis','$perigrafi','$tupos',
        '$eidosThermansis','$mesoThermansis',$arithmosDomatiwn)as result;";
        $query = mysqli_query($this->mysqlconnection, $sql);
        $result = mysqli_fetch_array($query);


        //Invalid mail, mail doesn;t exist
        if ($result['result'] == '0') {
            if (empty($emailErr)) {
                array_push($emailErr, "Invalid mail " . $email);
            }
            if ($keyErr == '') {
                $keyErr = "Ok";
            }
            
            $ErrorJson = array('success' => false, 'status' => 422, 'email' => $emailErr, 'API key' => $keyErr, 'message' => "Error");
            //You are now Loged in
            } else if ($result['result'] == '1') {
            if (empty($emailErr)) {
                array_push($emailErr, $email);
            }
            if ($keyErr == '') {
                $keyErr = "Ok";
            }
           

            $ErrorJson = array('success' => true, 'status' => 202, 'email' => $email, 'API key' => 'Ok', 'message' => 'Success');
    }
    echo json_encode($ErrorJson, JSON_FORCE_OBJECT);
    }
}


function SearchHouse()
{
      $keyErr = $errorLog = array();
    
    $key = $nomos = $poli = $perioxi  = $dieuthinsi =
    $orofos  = $IlikakosTheromosifwnas = $beranta = $apothiki = $parking =
    $pisina = $noikiasmeno = $thea = $tzaki = $ac = $epiplomeno = $anelkistiras = $kipos =
    $tupos = $mesoThermansis = $eidosThermansis = "";  //strings

    $cm2From = $cm2To = $priceFrom = $priceTo = $arithmosDomatiwn = 0; //int
    $hasApiKey = false;

      //Validate key
      if (empty($_GET['key'])) {
          array_push($keyErr, "You Have to enter your API key");
      } else {
          $key = $this->test_input($_GET['key']);

          //check if the given API KEY exists
          $sql1 = "select * from API_Config;";
          $result1 = mysqli_query($this->mysqlconnection, $sql1);
          $req_num_rows1 = mysqli_num_rows($result1);
          $json1 = mysqli_fetch_all($result1, MYSQLI_ASSOC);

          for ($i = 0; $i < $req_num_rows1; $i++) {

          if ($json1[$i]['Code'] == $key) {
              if ($json1[$i]['Privilege'] != 'Low') {
                  $sql = "Update API_Config Set TimesUsed= TimesUsed+1 where ID=" . $json1[$i]['ID'] . ";";
                  mysqli_query($this->mysqlconnection, $sql);
                  $hasApiKey = true;
          } else {
              array_push($keyErr, "You don't have the right privilege");
          }
      }
  }
  //if the API KEY doesnt exist
  if (!$hasApiKey) {
      array_push($keyErr, "You don't have an API key, you can ask for one from the main page");
      }
  }

  //Strings

$nomos  = $this->test_input($_POST["nomos"]);
$poli   = $this->test_input($_POST["poli"]);
$perioxi = $this->test_input($_POST["perioxi"]);
$dieuthinsi = $this->test_input($_POST["dieuthinsi"]);
//$imerominiaKataskevis = $this->test_input($_POST["imerominiaKataskevis"]);
$orofos  = $this->test_input($_POST["orofos"]);
$IlikakosTheromosifwnas = $this->test_input($_POST["IlikakosTheromosifwnas"]);      
$beranta = $this->test_input($_POST["beranta"]);
$apothiki = $this->test_input($_POST["apothiki"]);
$parking = $this->test_input($_POST["parking"]);


$pisina = $this->test_input($_POST["pisina"]);
$noikiasmeno = $this->test_input($_POST["noikiasmeno"]);
$thea = $this->test_input($_POST["thea"]);
$tzaki = $this->test_input($_POST["tzaki"]);
$ac = $this->test_input($_POST["ac"]);
$epiplomeno = $this->test_input($_POST["epiplomeno"]);
$anelkistiras = $this->test_input($_POST["anelkistiras"]);
$kipos = $this->test_input($_POST["kipos"]);


$tupos = $this->test_input($_POST["tupos"]);
$mesoThermansis = $this->test_input($_POST["mesoThermansis"]);
$eidosThermansis = $this->test_input($_POST["eidosThermansis"]);

//Integers
$cm2From = $this->test_input($_POST["cm2From"]);
$cm2To = $this->test_input($_POST["cm2To"]);
$priceFrom = $this->test_input($_POST["priceFrom"]);
$priceTo = $this->test_input($_POST["priceTo"]);


$arithmosDomatiwn = $this->test_input($_POST["arithmosDomatiwn"]);

      //if the api key is corect and all the parameters are valid
      if ($hasApiKey && empty($emailErr) && empty($keyErr) && empty($errorLog)) {
        //Update House set  
         $sql = "CALL Search_House(
         $priceFrom, $priceTo, $cm2From, $cm2To,'$nomos','$poli','$perioxi','$orofos', 
        '$dieuthinsi','$epiplomeno','$ac','$tzaki',
        '$kipos','$pisina','$anelkistiras','$apothiki','$beranta','$IlikakosTheromosifwnas',
        '$parking','$thea','$noikiasmeno','$tupos',
        '$eidosThermansis','$mesoThermansis',$arithmosDomatiwn);";
 
            
    
        $result = mysqli_query($this->mysqlconnection, $sql);
        $req_num_rows = mysqli_num_rows($result);
        $json = mysqli_fetch_all($result, MYSQLI_ASSOC);
        
        //makes the json into a write way to parse after calling the page
        $json = json_encode($json, JSON_FORCE_OBJECT);
        echo $json;
    }
    echo json_encode($ErrorJson, JSON_FORCE_OBJECT);
    }

}


              