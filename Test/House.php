<?php

class House {

    private $mysqlconnection;
    public $Privilege = "";
    public $Error = [];
    public $hasApiKey = false;
    public $Email;
    public $HouseID;
    public $NumberOfHouses;
    public $Nomos = "";
    public $Search = array();

    function __construct($Key) {
        //include db.php once if something is going wrong with the file it'll make a fatal error
        //https://stackoverflow.com/questions/3546160/include-include-once-require-or-require-once
        require_once "../db.php";

        //conection with the database
        $this->mysqlconnection = mysqli_connect($db_host, $db_user, $db_password, $db_name);
        mysqli_set_charset($this->mysqlconnection, "utf8");

        $key = $this->test_input($Key);

        //check if the given API KEY exists
        $sql1 = "select * from API_Config;";
        $result1 = mysqli_query($this->mysqlconnection, $sql1);
        $req_num_rows1 = mysqli_num_rows($result1);
        $json1 = mysqli_fetch_all($result1, MYSQLI_ASSOC);

        for ($i = 0; $i < $req_num_rows1; $i++) {
            if ($json1[$i]['Code'] == $key) {
                $sql = "Update API_Config Set TimesUsed= TimesUsed+1 where ID=" . $json1[$i]['ID'] . ";";
                mysqli_query($this->mysqlconnection, $sql);
                $this->hasApiKey = true;
                $this->Privilege = $json1[$i]['Privilege'];
            }
        }
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

    //insert and check email
    public function Set_Email($email) {
        $this->Email = $this->test_input($email);
        // check if e-mail address is well-formed
        if (!filter_var($this->Email, FILTER_VALIDATE_EMAIL)) {
            array_push($this->Error, " Invalid email format, email mast have the format of something@something.something ");
            return false;
        }//check the lenght
        if (strlen($email) > 40) {
            array_push($this->Error, "Email can have 40 characters max");
            return false;
        }
        $sql = "Select exists(Select email from customer where email='$this->Email') as result;";
        $query = mysqli_query($this->mysqlconnection, $sql);
        $result = mysqli_fetch_array($query);
        if ($result['result'] == "0") {
            array_push($this->Error, "The email doesn't exist in the database");
            return false;
        }
        return true;
    }

    //insert and check houseid
    public function Set_HouseID($houseID) {
        $this->HouseID = $this->test_input($houseID);
        //Checks if all of the characters in the provided string, text, are numerical.
        //http://php.net/ctype_digit
        if (!ctype_digit($this->HouseID)) {
            array_push($this->Error, "Invalid HouseID format, only numbers required");
            return false;
        }

        $sql = "Select exists(Select HouseID from house where HouseID=$houseID) as result;";
        $query = mysqli_query($this->mysqlconnection, $sql);
        $result = mysqli_fetch_array($query);
        if ($result['result'] == "0") {
            array_push($this->Error, "The houseid doesn't exist in the database");
            return false;
        }
        return true;
    }

    public function isBoolean($data) {
        if ($data == "true" || $data == "false") {
            return true;
        }
        return false;
    }

    public function isNumber($data) {
        if (ctype_digit($data)) {
            return true;
        }
        return false;
    }

    public function isNomos($data) {
        $sql = "Select exists(Select state from City where state='" . $data . "') as result;";
        $query = mysqli_query($this->mysqlconnection, $sql);
        $result = mysqli_fetch_array($query);
        if ($result['result'] == "1") {
            $this->Nomos = $data;
            return true;
        }
        return false;
    }

    public function isCity($data) {
        if ($this->Nomos != "") {
            $sql = "Select exists(Select * from City where state='" . $this->Nomos . "' and cityName='" . $data . "') as result;";
            $query = mysqli_query($this->mysqlconnection, $sql);
            $result = mysqli_fetch_array($query);
            if ($result['result'] == "1") {
                return true;
            }
        }
        return false;
    }

    public function hasRightLength($maxlength, $value) {
        if (strlen($value) > $maxlength) {
            return false;
        }
        return true;
    }

    public function isDate($date) {
        if (preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])-(0[1-9]|1[0-2])-[0-9]{4}$/", $date)) {
            return true;
        }
        return false;
    }

    public function isRightType($type) {
        if ($type == "Δυάρι" || $type == "Studio" || $type == "Μεζονέτα" || $type == "Μονοκατοικία") {
            return true;
        } else
            false;
    }

    public function isHeatType($heatType) {
        if ($heatType == "Πετρέλαιο" || $heatType == "Φυσικό αέριο" || $heatType == "Ρεύμα" || $heatType == "Πέλετ" || $heatType == "Σόμπα" || $heatType == "Θερμοσυσσορευτής") {
            return true;
        } else
            false;
    }

    public function isHeating($heatType) {
        if ($heatType == "Αυτόνομη" || $heatType == "Κεντρική" || $heatType == "Άλλο" || $heatType == "Όχι") {
            return true;
        } else
            false;
    }

    public function Set_NumberOfHouses($NumberOfHouses) {
        $this->NumberOfHouses = $this->test_input($NumberOfHouses);
        //Checks if all of the characters in the provided string, text, are numerical.
        //http://php.net/ctype_digit
        if (!ctype_digit($this->NumberOfHouses)) {
            array_push($this->Error, "Invalid Number of Houses format, only numbers required");
            return false;
        }
        return true;
    }
    
      public function add($something)
      {
          array_push($this->Search,$something);
      }

    public function MyHouses() {
        $sql = "CALL My_Houses('$this->Email')";
        $result = mysqli_query($this->mysqlconnection, $sql);
        $req_num_rows = mysqli_num_rows($result);
        $json = mysqli_fetch_all($result, MYSQLI_ASSOC);

        array_push($json, array("success" => true));

        //makes the json into a write way to parse after calling the page
        return json_encode($json, JSON_FORCE_OBJECT);
    }

    public function MyFavorites() {
        $sql = "CALL  Display_All_Favorites('$this->Email');";
        $result = mysqli_query($this->mysqlconnection, $sql);
        $req_num_rows = mysqli_num_rows($result);
        $json = mysqli_fetch_all($result, MYSQLI_ASSOC);

        array_push($json, array("success" => true));

        //makes the json into a write way to parse after calling the page
        return json_encode($json, JSON_FORCE_OBJECT);
    }

    public function HouseView() {
        $sql = "Select new_view($this->HouseID);";
        $result = mysqli_query($this->mysqlconnection, $sql);
        
        $sql = "CALL  Display_House($this->HouseID);";
        $result = mysqli_query($this->mysqlconnection, $sql);
        $req_num_rows = mysqli_num_rows($result);
        $json = mysqli_fetch_all($result, MYSQLI_ASSOC);

        array_push($json, array("success" => true));

        //makes the json into a write way to parse after calling the page
        return json_encode($json, JSON_FORCE_OBJECT);
    }

    public function HouseMap() {

        $sql = "CALL Display_Location();";
        $result = mysqli_query($this->mysqlconnection, $sql);
        $req_num_rows = mysqli_num_rows($result);
        $json = mysqli_fetch_all($result, MYSQLI_ASSOC);

        array_push($json, array("success" => true));

        //makes the json into a write way to parse after calling the page
        json_encode($json, JSON_FORCE_OBJECT);
    }

    public function HomePage($NumberOfHouses) {
        $sql = "CALL Display_Home_Page($NumberOfHouses)";
        $result = mysqli_query($this->mysqlconnection, $sql);
        $req_num_rows = mysqli_num_rows($result);
        $json = mysqli_fetch_all($result, MYSQLI_ASSOC);

        array_push($json, array("success" => true));

        return json_encode($json, JSON_FORCE_OBJECT);
    }

    public function InsertHouse($nomos, $poli, $perioxi, $tm, $timi, $orofos, $dieuthinsi, $geografikoPlatos, $geografikoMikos, $epiplomeno, $ac, $tzaki, $kipos, $pisina, $anelkistiras, $apothiki, $beranta, $iliakosThermosifonas, $parking, $thea, $noikiasmeno, $imerominiaKataskebis, $perigrafi, $tupos, $eidosThermansis, $mesoThermansis, $arithmosDomatiwn) {

        if ($this->isNomos($nomos)) {
            if ($this->hasRightLength(45, $nomos)) {
                if ($this->isCity($poli)) {
                    if ($this->hasRightLength(45, $poli)) {
                        if ($this->isNumber($tm) || $tm == "-") {
                            if ($this->isNumber($timi) || $timi == "null") {
                                if ($this->isNumber($orofos) || $orofos == "-") {
                                    if ($this->hasRightLength(45, $dieuthinsi) || $dieuthinsi == " ") {
                                        if (true || $geografikoPlatos == "null") {
                                            if (true || $geografikoMikos == "null") {
                                                if ($this->isBoolean($epiplomeno) || $epiplomeno == "-") {
                                                    if ($this->isBoolean($ac) || $ac == "-") {
                                                        if ($this->isBoolean($tzaki) || $tzaki == "-") {
                                                            if ($this->isBoolean($kipos) || $kipos == "-") {
                                                                if ($this->isBoolean($pisina) || $pisina == "-") {
                                                                    if ($this->isBoolean($anelkistiras) || $anelkistiras == "-") {
                                                                        if ($this->isBoolean($apothiki) || $apothiki == "-") {
                                                                            if ($this->isBoolean($beranta) || $beranta == "-") {
                                                                                if ($this->isBoolean($iliakosThermosifonas) || $iliakosThermosifonas == "-") {
                                                                                    if ($this->isBoolean($parking) || $parking == "-") {
                                                                                        if ($this->isBoolean($thea) || $thea == "-") {
                                                                                            if ($this->isBoolean($noikiasmeno) || $noikiasmeno == "-") {
                                                                                                if ($this->isDate($imerominiaKataskebis) || $imerominiaKataskebis == "-") {
                                                                                                    if ($this->isRightType($tupos) || $tupos == "-") {
                                                                                                        if ($this->isHeatType($eidosThermansis) || $eidosThermansis == " ") {
                                                                                                            if ($this->isHeating($mesoThermansis) || $mesoThermansis == " ") {
                                                                                                                if ($this->isNumber($arithmosDomatiwn) || $arithmosDomatiwn == "0") {

                                                                                                                    $tm = mysqli_real_escape_string($this->mysqlconnection, $this->test_input($tm));
                                                                                                                    $timi = mysqli_real_escape_string($this->mysqlconnection, $this->test_input($timi));
                                                                                                                    $imerominiaKataskebis = mysqli_real_escape_string($this->mysqlconnection, $this->test_input($imerominiaKataskebis));
                                                                                                                    $orofos = mysqli_real_escape_string($this->mysqlconnection, $this->test_input($orofos));
                                                                                                                    $iliakosThermosifonas = mysqli_real_escape_string($this->mysqlconnection, $this->test_input($iliakosThermosifonas));
                                                                                                                    $beranta = mysqli_real_escape_string($this->mysqlconnection, $this->test_input($beranta));
                                                                                                                    $apothiki = mysqli_real_escape_string($this->mysqlconnection, $this->test_input($apothiki));
                                                                                                                    $parking = mysqli_real_escape_string($this->mysqlconnection, $this->test_input($parking));
                                                                                                                    $pisina = mysqli_real_escape_string($this->mysqlconnection, $this->test_input($pisina));
                                                                                                                    $noikiasmeno = mysqli_real_escape_string($this->mysqlconnection, $this->test_input($noikiasmeno));
                                                                                                                    $thea = mysqli_real_escape_string($this->mysqlconnection, $this->test_input($thea));
                                                                                                                    $tzaki = mysqli_real_escape_string($this->mysqlconnection, $this->test_input($tzaki));
                                                                                                                    $ac = mysqli_real_escape_string($this->mysqlconnection, $this->test_input($ac));
                                                                                                                    $epiplomeno = mysqli_real_escape_string($this->mysqlconnection, $this->test_input($epiplomeno));
                                                                                                                    $anelkistiras = mysqli_real_escape_string($this->mysqlconnection, $this->test_input($anelkistiras));
                                                                                                                    $kipos = mysqli_real_escape_string($this->mysqlconnection, $this->test_input($kipos));
                                                                                                                    $perigrafi = mysqli_real_escape_string($this->mysqlconnection, $this->test_input($perigrafi));
                                                                                                                    $tupos = mysqli_real_escape_string($this->mysqlconnection, $this->test_input($tupos));
                                                                                                                    $mesoThermansis = mysqli_real_escape_string($this->mysqlconnection, $this->test_input($mesoThermansis));
                                                                                                                    $eidosThermansis = mysqli_real_escape_string($this->mysqlconnection, $this->test_input($eidosThermansis));
                                                                                                                    $arithmosDomatiwn = mysqli_real_escape_string($this->mysqlconnection, $this->test_input($arithmosDomatiwn));
                                                                                                                    $geografikoMikos = mysqli_real_escape_string($this->mysqlconnection, $this->test_input($geografikoMikos));
                                                                                                                    $geografikoPlatos = mysqli_real_escape_string($this->mysqlconnection, $this->test_input($geografikoPlatos));



                                                                                                                    $sql = "Select New_House('$this->Email','$nomos','$poli','$perioxi',$tm,$timi,'$orofos','$dieuthinsi',$geografikoPlatos,$geografikoMikos,"
                                                                                                                            . "'$epiplomeno','$ac','$tzaki','$kipos','$pisina','$anelkistiras','$apothiki','$beranta','$iliakosThermosifonas',"
                                                                                                                            . "'$parking','$thea','$noikiasmeno','$imerominiaKataskebis','$perigrafi','$tupos',"
                                                                                                                            . "'$eidosThermansis','$mesoThermansis',$arithmosDomatiwn)as result;";
                                                                                                                    $query = mysqli_query($this->mysqlconnection, $sql);
                                                                                                                    $result = mysqli_fetch_array($query);

                                                                                                                    if ($result["result"] == "1") {

                                                                                                                        $sql = "Select * from photos where path='$this->Email'";
                                                                                                                        $result = mysqli_query($this->mysqlconnection, $sql);
                                                                                                                        $req_num_rows = mysqli_num_rows($result);
                                                                                                                        $json = mysqli_fetch_all($result, MYSQLI_ASSOC);

                                                                                                                        $sql = "Delete from photos where houseId=" . $json[0]['houseId'] . ";";
                                                                                                                        $result = mysqli_query($this->mysqlconnection, $sql);




                                                                                                                        return $json[0]['houseId'];
                                                                                                                    } else {
                                                                                                                        array_push($this->Error, "Something went wrong with the insert");
                                                                                                                    }
                                                                                                                } else {
                                                                                                                    array_push($this->Error, "Number of rooms value has to be numeric");
                                                                                                                }
                                                                                                            } else {
                                                                                                                array_push($this->Error, "Invalid Heating media, this type doesn't exist");
                                                                                                            }
                                                                                                        } else {
                                                                                                            array_push($this->Error, "Invalid Heat type, this type doesn't exist");
                                                                                                        }
                                                                                                    } else {
                                                                                                        array_push($this->Error, "Invalid type, this type doesn't exist");
                                                                                                    }
                                                                                                } else {
                                                                                                    array_push($this->Error, "Date doesn't have the right form, date format DD-MM-YYYY");
                                                                                                }
                                                                                            } else {
                                                                                                array_push($this->Error, "Rented value has to true or false");
                                                                                            }
                                                                                        } else {
                                                                                            array_push($this->Error, "View's value has to true or false");
                                                                                        }
                                                                                    } else {
                                                                                        array_push($this->Error, "Parkings's value has to true or false");
                                                                                    }
                                                                                } else {
                                                                                    array_push($this->Error, "Solar Water Heater's value has to true or false");
                                                                                }
                                                                            } else {
                                                                                array_push($this->Error, "Porche's value has to true or false");
                                                                            }
                                                                        } else {
                                                                            array_push($this->Error, "Warehouse's value has to true or false");
                                                                        }
                                                                    } else {
                                                                        array_push($this->Error, "Elevator's value has to true or false");
                                                                    }
                                                                } else {
                                                                    array_push($this->Error, "Pool's value has to true or false");
                                                                }
                                                            } else {
                                                                array_push($this->Error, "Garden's value has to true or false");
                                                            }
                                                        } else {
                                                            array_push($this->Error, "Fireplace's value has to true or false");
                                                        }
                                                    } else {
                                                        array_push($this->Error, "A/C's value  has to true or false");
                                                    }
                                                } else {
                                                    array_push($this->Error, "Furnished value has to true or false");
                                                }
                                            } else {
                                                array_push($this->Error, "Longitude's value has to be numeric");
                                            }
                                        } else {
                                            array_push($this->Error, "Latitude's value has to be numeric");
                                        }
                                    } else {
                                        array_push($this->Error, "Street has to be shorter that 45 characters");
                                    }
                                } else {
                                    array_push($this->Error, "Floor has to be numeric");
                                }
                            } else {
                                array_push($this->Error, "Price has to be numeric");
                            }
                        } else {
                            array_push($this->Error, "Square meters have to be numeric");
                        }
                    } else {
                        array_push($this->Error, "City has to be shorter that 45 characters");
                    }
                } else {
                    array_push($this->Error, "City doesn't exist to the database or doesn't belong to this State");
                }
            } else {
                array_push($this->Error, "State has to be shorter that 45 characters");
            }
        } else {
            array_push($this->Error, "Nomos doesn't exist please to the database insert a right value");
        }
        return 2;
    }

    public function State() {
        $sql = "Select distinct(state) from City;";
        $result = mysqli_query($this->mysqlconnection, $sql);
        $req_num_rows = mysqli_num_rows($result);
        $json = mysqli_fetch_all($result, MYSQLI_ASSOC);

        echo json_encode($json, JSON_FORCE_OBJECT);
    }

    public function City($state) {
        $sql = "Select cityName from City where state='$state';";
        $result = mysqli_query($this->mysqlconnection, $sql);
        $req_num_rows = mysqli_num_rows($result);
        $json = mysqli_fetch_all($result, MYSQLI_ASSOC);

        echo json_encode($json, JSON_FORCE_OBJECT);
    }

    public function newPhone($phone) {

        if ($this->isNumber($phone)) {
            $sql = "Select New_Phone($this->HouseID,$phone)as result;";
            $query = mysqli_query($this->mysqlconnection, $sql);
            $result = mysqli_fetch_array($query);

            if ($result["result"] == "1") {
                return true;
            }
        }
        return false;
    }

    public function Search() {
        $sql = "SELECT houseID,Views,perioxi,tm,Timi,tupos,epiplomeno,phoneNumber,Reports FROM house,customer where email=customerMail and noikiasmeno='false'";
        if (!empty($this->Search[0])) {
                       
            for ($i = 0; $i < count($this->Search); $i++) {
                $sql .= " and ".$this->Search[$i];
            }
        }

        $sql .= " ORDER BY Views DESC,imerominiaAnaneosis DESC ;";
        
        $result = mysqli_query($this->mysqlconnection, $sql);
        $req_num_rows = mysqli_num_rows($result);
        $json = mysqli_fetch_all($result, MYSQLI_ASSOC);

        if($req_num_rows>0)
        {
            array_push($json, array("success" => true, "message" =>"$req_num_rows results found","results"=>$req_num_rows));
            return json_encode($json, JSON_FORCE_OBJECT);
        }
        else
        {
             return 0;
        }
        
    }

}
