<?php

class Customer {

    private $mysqlconnection;
    private $Email = "";
    private $Name = "";
    private $Surname = "";
    private $Password = "";
    private $PhoneNumber = "";
    private $Privilege = "";
    private $status = "";
    public $error = [];

    //best way todo multiple constructors
    //https://stackoverflow.com/questions/1699796/best-way-to-do-multiple-constructors-in-php
    function __construct($key) {
        //include db.php once if something is going wrong with the file it'll make a fatal error
        //https://stackoverflow.com/questions/3546160/include-include-once-require-or-require-once
        require_once '../db.php';

        //conection with the database
        $this->mysqlconnection = mysqli_connect($db_host, $db_user, $db_password, $db_name);
        mysqli_set_charset($this->mysqlconnection, "utf8");

        //check if the given API KEY exists
        $sql1 = "select * from API_Config;";
        $result1 = mysqli_query($this->mysqlconnection, $sql1);
        $req_num_rows1 = mysqli_num_rows($result1);
        $json1 = mysqli_fetch_all($result1, MYSQLI_ASSOC);

        for ($i = 0; $i < $req_num_rows1; $i++) {
            if ($json1[$i]['Code'] == $key) {
                $this->Privilege = $json1[$i]['Privilege'];
                $sql = "Update API_Config Set TimesUsed= TimesUsed+1 where ID=" . $json1[$i]['ID'] . ";";
                mysqli_query($this->mysqlconnection, $sql);
                $this->status = "Ok";
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

    //check if the api key exists on the database or not
    public function status() {
        //if the API KEY exists
        if ($this->status == "Ok") {
            return true;
        } else {
            //if the API KEY doesnt exist
            return false;
        }
    }

    //insert and check the email
    public function Set_email($email,$check) {
        //filter the email
        $email = $this->test_input($email);
        //check if email has the right format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($this->error, "Invalid email format, email mast have the format of something@something.something");
        } else {
            //check if email is shorter than 40 characters
            if (strlen($email) > 40) {
                array_push($this->error, "Email can have 40 characters max");
            } else {
                if($check)
                {
                $sql = "Select exists(select * from customer where email='$email') as result;";
                $query = mysqli_query($this->mysqlconnection, $sql);
                $result = mysqli_fetch_array($query);
                if ($result[0] == "1") {

                    //insert variable into class variable
                    $this->Email = $email;
                    return "Ok";
                } else {
                    array_push($this->error, "Email does not exist");
                }
                }
                 $this->Email = $email;
                return "Ok";
            }
        }
    }

    //insert and check the name
    public function Set_name($name) {
        //filter the name
        $name = $this->test_input($name);
        //check if name has the right format
        if (!preg_match("/[^[:punct:]*|[\d]*]*/", $name)) {
            array_push($this->error, "Invalid name format, name must not have numbers or special characters");
        } else {
            //check name's the's length
            if (strlen($name) > 40) {
                array_push($this->error, "Name can have 40 characters max");
            } else {
                $this->Name = $name;
            }
        }
    }

    //insert and check the surname
    public function Set_surname($surname) {
        //filter the surname
        $surname = $this->test_input($surname);
        //check if surname's format is valid
        if (!preg_match("/[^[:punct:]*|[\d]*]*/", $surname)) {
            array_push($this->error, "Invalid surname format, name must not have numbers or special characters");
        } else {
            //check surname's length
            if (strlen($surname) > 40) {
                array_push($this->error, "Surname can have 40 characters max");
            } else {
                $this->Surname = $surname;
            }
        }
    }

    //insert and check the password
    public function Set_password($password) {
        //filter the password
        $password = $this->test_input($password);
        //check password's length
        if (strlen($password) > 200) {
            array_push($this->error, "Password can have 200 characters max");
        } else {
            $this->Password = sha1($password);
        }
    }

    //insert and check the phone
    public function Set_phone($phone) {
        //filter the phone number
        $phone = $this->test_input($phone);
        //Checks if all of the characters in the provided string, text, are numerical.
        //http://php.net/ctype_digit
        if (!ctype_digit($phone) && $phone != '') {
            array_push($this->error, "Invalid phone format, only numbers required");
        } else {
            if ($phone == '1996' || $phone == '') {
                $this->PhoneNumber = "0";
            } else {
                $this->PhoneNumber = $phone;
            }
        }
    }

    //insert and check the HouseID
    public function isHouseID($houseID) {
        $sql = "Select exists(Select HouseID from house where HouseID=$houseID) as result;";
        $query = mysqli_query($this->mysqlconnection, $sql);
        $result = mysqli_fetch_array($query);
        if ($result['result'] == "0") {
            return false;
        } else {
            return true;
        }
    }

    public function register($login) {
        //safe way to insert into database
        //https://www.w3schools.com/php/func_mysqli_real_escape_string.asp
        $safeName = mysqli_real_escape_string($this->mysqlconnection, $this->Name);
        $safeSurname = mysqli_real_escape_string($this->mysqlconnection, $this->Surname);
        $safePassword = mysqli_real_escape_string($this->mysqlconnection, $this->Password);
        $safeEmail = mysqli_real_escape_string($this->mysqlconnection, $this->Email);
        $safePhone = mysqli_real_escape_string($this->mysqlconnection, $this->PhoneNumber);


        $sql = "Select Register ('$safeName','$safeSurname','$safePassword','$safeEmail',$safePhone) as result;";
        $query = mysqli_query($this->mysqlconnection, $sql);
        $result = mysqli_fetch_array($query);

        if ($result['result'] == '0') {
            $ErrorJson = array('success' => false, 'message' => "There was an error with the Data Base");
            return 1;
        } else if ($result['result'] == '1') {
            //get the link for the mail verification
            $sql1 = "SELECT * FROM mailverification where email='$safeEmail';";
            $result1 = mysqli_query($this->mysqlconnection, $sql1);
            $req_num_rows1 = mysqli_num_rows($result1);
            if ($req_num_rows1 == 1) {
                $json1 = mysqli_fetch_all($result1, MYSQLI_ASSOC);
                if (!$login) {
                    $this->send_mail($json1[0]['link']);
                }
            }
            $ErrorJson = array('success' => true, 'message' => 'check your email');
        } else if ($result['result'] == '2') {

            $ErrorJson = array('success' => false, 'message' => "The email you are trying to use is already in use ");
            return 2;
        }
        return json_encode($ErrorJson, JSON_FORCE_OBJECT);
    }

    public function My_Profile() {
        $safeEmail = mysqli_real_escape_string($this->mysqlconnection, $this->Email);

        $sql = "Select email,firstName,lastName,houseCount,phoneNumber,reportsTaken,registerDate from customer where email='$safeEmail';";
        $result = mysqli_query($this->mysqlconnection, $sql);
        $req_num_rows = mysqli_num_rows($result);
        $json = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $json;
    }

    public function send_mail($link) {
        //<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
        //Send mail verification
        $to = "" . $this->Email . "";
        $subject = "Mail Verifivcation";
        $txt = "<!DOCTYPE html>
<html>
<head>
<script src='https://use.fontawesome.com/33070007c5.js'></script>

<title>Verification Email</title>
<style>
.div2 {
    width: 500px;
    padding: 5px;
    border: 5px solid gray;
    margin: 0;
}
</style>
</head>
<body>

<center>
<div class='div2'>
<center><img src='https://enoikioalpha.000webhostapp.com/2.jpg' width='500' height='50'>
<br>

<a style='color:#222222;font-size: 18px;'>Σ<i class='fa fa-home'></i>ίτι μου Σ<i class='fa fa-home'></i>ιτάκι μου</a>
<br>

<h4 style='color:#222222;font-size: 18px;'><b>Ε-mail Επιβεβαίωσης</b><h4>

<p style='color:#222222;font-size: 15px;'>Αγαπητέ χρήστη καλός ήρθες στην σελίδα μας,
	για την καλύτερη λειτουργία του λογαριασμόυ σας
	θα πρέπει να κάνετε μια επιβεβαίωση του email σας 
	στον παρακάτω σύνδεσμο.<p>
	
<div id='searchContent' style='background-color:#333333;padding:5px 5px 5px 5px'>
                    <h4 style='color:whitesmoke'>Μετά την ολοκληρωμένη εγγραφή σου θα μπορείς</h4>
                    <hr>
                    <p style='color:whitesmoke'><i style='color:#ff5a5f' class='fa fa-circle'></i> Να αποθηκεύεις τις αγαπημένες σου αγγελίες</p>
                    <p style='color:whitesmoke'><i style='color:#ff5a5f' class='fa fa-circle'></i> Να αναφέρεις κάποιο πρόβλημα που αφορά μία αγγελία</p>
                    <p style='color:whitesmoke'><i style='color:#ff5a5f' class='fa fa-circle'></i> Να ανεβάσεις μία δική σου αγγελία</p>
                    <p style='color:whitesmoke'><i style='color:#ff5a5f' class='fa fa-circle'></i> Να κάνεις διαφήμηση του μεσιτικού σου γραφείου</p>
 </div>
	
<p>Για την ενεργοποίηση του λογαριασμόυ σας πατήστε <b><a href='https://enikioadmin.000webhostapp.com/MailVerification.php?mail=$this->Email&link=" . $link . "' >εδώ.</a></b></p>
<p> Εαν ο παραπάνω σύνδεσμος δεν λειτουτγεί πατήστε εδώ ή κάντε το αντιγραφή και επικόλληση στον browser που χρησιμοποιείται <a href='https://enikioadmin.000webhostapp.com/MailVerification.php?mail=$this->Email&link=" . $link . "' >https://enikioadmin.000webhostapp.com/MailVerification.php?mail=$this->Email&link=" . $link . "</a></p>
</center>
</div>
</center>

</body>
</html>";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        mail($to, $subject, $txt, $headers);
    }

    public function login($login) {
        //safe way to insert into database
        //https://www.w3schools.com/php/func_mysqli_real_escape_string.asp
        $safePassword = mysqli_real_escape_string($this->mysqlconnection, $this->Password);
        $safeEmail = mysqli_real_escape_string($this->mysqlconnection, $this->Email);

        //if someone wants to log in with facebook or google
        if ($login) {
            $asnwer = $this->register($login);
//            if ($asnwer == "1") {
//                $ErrorJson = array('success' => false, 'message' => 'There was an error with the Data Base');
//
//            } else if ($asnwer == "2") {
//                $ErrorJson = array('success' => false, 'message' => 'The email you are trying to use is already in use ');
//                return 5;
//            }
            $sql = "Delete from mailverification where email='$safeEmail';";
            $query = mysqli_query($this->mysqlconnection, $sql);
        }

        $sql = "Select Login('$safeEmail','$safePassword') as result;";
        $query = mysqli_query($this->mysqlconnection, $sql);
        $result = mysqli_fetch_array($query);
        //Invalid mail, mail doesn't exist
        if ($result['result'] == '0') {
            return 1;
            //You are now Loged in
        } else if ($result['result'] == '1') {

            $sql = "Select * from customer where email='$safeEmail';";
            $result = mysqli_query($this->mysqlconnection, $sql);
            $req_num_rows = mysqli_num_rows($result);
            $json = mysqli_fetch_all($result, MYSQLI_ASSOC);

            $ErrorJson = array('success' => true, 'message' => 'You are now Loged in', "email" => $safeEmail, "name" => $json[0]['firstName'], "surname" => $json[0]['lastName']);
            return json_encode($ErrorJson, JSON_FORCE_OBJECT);
            //Invalid password
        } else if ($result['result'] == '2') {
            return 2;
            //You have to verify your email
        } else if ($result['result'] == '3') {
            return 3;
        }
    }

    function Report($houseID, $reason, $comment) {


        //safe way to insert into database
        //https://www.w3schools.com/php/func_mysqli_real_escape_string.asp  

        $sql = "Select New_Report('$this->Email',$houseID,'$reason','$comment') as result;";
        $query = mysqli_query($this->mysqlconnection, $sql);
        $result = mysqli_fetch_array($query);
        //Invalid mail, mail doesn;t exist
        if ($result['result'] == '0') {
            return 1;
            //You are now Loged in
        } else if ($result['result'] == '1') {
            $ErrorJson = array('success' => true, 'message' => 'Report succesfully submbitted');

            //Invalid password
        } else if ($result['result'] == '2') {
            return 2;
            //You have to verify your email
        } else if ($result['result'] == '3') {
            return 3;
        }


        return json_encode($ErrorJson, JSON_FORCE_OBJECT);
    }

}
