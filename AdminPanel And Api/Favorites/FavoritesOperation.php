<?php

class Customer {

    private $mysqlconnection;
    private $email = "";
    private $HouseID;
    private $error = array();

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

    function __construct($email, $houseID, $key) {
        //include db.php once if something is going wrong with the file it'll make a fatal error
        //https://stackoverflow.com/questions/3546160/include-include-once-require-or-require-once
        require_once '../db.php';

        //conection with the database
        $this->mysqlconnection = mysqli_connect($db_host, $db_user, $db_password, $db_name);
        mysqli_set_charset($this->mysqlconnection, "utf8");

        //Validate key
//        if (empty($_GET['key'])) {
//            array_push($keyErr, "You Have to enter your API key");
//        } 
        $key = $this->test_input($key);

        //check if the given API KEY exists
        $sql1 = "select * from API_Config;";
        $result1 = mysqli_query($this->mysqlconnection, $sql1);
        $req_num_rows1 = mysqli_num_rows($result1);
        $json1 = mysqli_fetch_all($result1, MYSQLI_ASSOC);
        $hasApiKey = false;
        for ($i = 0; $i < $req_num_rows1; $i++) {

            if ($json1[$i]['Code'] == $key) {
                if ($json1[$i]['Privilege'] != 'Low') {
                    $sql = "Update API_Config Set TimesUsed= TimesUsed+1 where ID=" . $json1[$i]['ID'] . ";";
                    mysqli_query($this->mysqlconnection, $sql);
                    $hasApiKey = true;
                } else {
                    array_push($this->error, "You don't have the right privilege");
                }
            }
        }
        //if the API KEY doesnt exist
        if (!$hasApiKey) {
            array_push($this->error, "You don't have an API key, you can ask for one from the main page");
        }

        $HouseID = $this->test_input($houseID);

        $email = $this->test_input($email);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($this->error, " Invalid email format ");
        }
        //check the lenght
        if (strlen($email) > 40) {
            array_push($this->error, " Email can have 40 characters max");
        }
        if (!ctype_digit($HouseID)) {
            array_push($this->error, "Invalid phone format, only numbers required");
        }
        if (empty($this->error)) {
            $this->HouseID = $houseID;
            $this->email = $email;
            //check if house exists
            $checkHouseID = "Select exists(select houseID from house where houseID=$this->HouseID) as HouseResult";
            $checkHouseIDResult = mysqli_query($this->mysqlconnection, $checkHouseID);
            $HouseResult = mysqli_fetch_array($checkHouseIDResult);
            if ($HouseResult['HouseResult'] == 0) {
                array_push($this->error, "HouseID doesn't exists");
            }
            //check if customer exists

            $checkCustomer = "Select exists(Select email from customer where email='$this->email' ) as CustomerResult;";
            $checkCustomerResult = mysqli_query($this->mysqlconnection, $checkCustomer);
            $CustomerResult = mysqli_fetch_array($checkCustomerResult);
            if ($CustomerResult['CustomerResult'] == 0) {
                array_push($this->error, "Customer doesn't exists");
            }
        }
    }

    public function addToFavorites() {
        
        $alreadyExistsFavorite = "Select exists(Select * from favorite where email='$this->email' and houseID=$this->HouseID ) as AlreadyFavoriteResult;";
        $checkalreadyExistsResult = mysqli_query($this->mysqlconnection, $alreadyExistsFavorite);
        $AlreadyFavoriteResult = mysqli_fetch_array($checkalreadyExistsResult);
        if ($AlreadyFavoriteResult['AlreadyFavoriteResult'] == 1) {
            array_push($this->error, "Already favorite");
        }
        if (empty($this->error)) {
            $sql = "Select New_Favorite('$this->email',$this->HouseID) as newFavorite";
            $result = mysqli_query($this->mysqlconnection, $sql);
            $req_num_rows = mysqli_num_rows($result);
            $json = mysqli_fetch_array($result, MYSQLI_ASSOC);
            
            if($json["newFavorite"]==1)
            {
                return json_encode(array(array("newFavorite" => "200")), JSON_FORCE_OBJECT);
            }
            else
            {
                return json_encode(array(array("newFavorite" => "400")), JSON_FORCE_OBJECT);
            }

        } else {
            return json_encode($this->error, JSON_FORCE_OBJECT);
        }
    }

    public function isFavorite() {
        if (empty($this->error)) {
            $sql = "Select is_Favorite('$this->email',$this->HouseID) as isFavorite";
            $result = mysqli_query($this->mysqlconnection, $sql);
            $req_num_rows = mysqli_num_rows($result);
            $json = mysqli_fetch_array($result, MYSQLI_ASSOC);
            
             if($json["isFavorite"]==1)
            {
                return json_encode(array(array("isFavorite" => "200")), JSON_FORCE_OBJECT);
            }
            else
            {
                return json_encode(array(array("isFavorite" => "400")), JSON_FORCE_OBJECT);
            }
            //makes the json into a write way to parse after calling the page
            $json = json_encode($json, JSON_FORCE_OBJECT);
            return $json;
        } else {
            return json_encode($this->error, JSON_FORCE_OBJECT);
        }
    }

    public function removeFromFavorites() {
        if (empty($this->error)) {
            $sql = "Select Delete_Favorite('$this->email',$this->HouseID) as deleteFavorite";
            $result = mysqli_query($this->mysqlconnection, $sql);
            $req_num_rows = mysqli_num_rows($result);
            $json = mysqli_fetch_array($result, MYSQLI_ASSOC);
            
             if($json["deleteFavorite"]==1)
            {
                return json_encode(array(array("deleteFavorite" => "200")), JSON_FORCE_OBJECT);
            }
            else
            {
                return json_encode(array(array("deleteFavorite" => "400")), JSON_FORCE_OBJECT);
            }
            //makes the json into a write way to parse after calling the page
            $json = json_encode($json, JSON_FORCE_OBJECT);
            return $json;
        } else {
            return json_encode($this->error, JSON_FORCE_OBJECT);
        }
    }

}
