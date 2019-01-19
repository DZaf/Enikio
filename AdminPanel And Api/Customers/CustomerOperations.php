<?php

require_once 'Customer.php';

//if Api key exist
if (isset($_GET['key'])) {
    //if Api operation exist
    $Customer = new Customer($_GET['key']);
    //if the API KEY  exist to the database
    if ($Customer->status()) {
        //if operation value exists
        if (isset($_GET['operation'])) {
            $operation = $_GET['operation'];
            //if operation has an acceptable value
            if ($operation == "0") {
                //if email exist
                if (isset($_POST['email'])) {
                    $Customer->Set_email($_POST['email'],false);
                    //if name exists
                    if (isset($_POST['name'])) {
                        $Customer->Set_name($_POST['name']);
                        //if surname exists
                        if (isset($_POST['surname'])) {
                            $Customer->Set_surname($_POST['surname']);
                            //if password exists
                            if (isset($_POST['password'])) {
                                $Customer->Set_password($_POST['password']);
                                //if phone exists
                                if (isset($_POST['phone'])) {
                                    $Customer->Set_phone($_POST['phone']);
                                } else {
                                    $Customer->Set_phone("1996");
                                }
                                //if there was no error with the variables
                                if (empty($Customer->error)) {
                                    http_response_code(200);
                                    $asnwer = $Customer->register(false);
                                    if ($asnwer == "1") {
                                        http_response_code(400);
                                        echo json_encode(array('success' => false, 'message' => "There was an error with the Data Base"), JSON_FORCE_OBJECT);
                                    } else if ($asnwer == "2") {
                                        http_response_code(400);
                                        echo json_encode(array('success' => false, 'message' => "The email you are trying to use is already in use "), JSON_FORCE_OBJECT);
                                    } else {
                                        http_response_code(200);
                                        echo $asnwer;
                                    }
                                } else {
                                    http_response_code(400);
                                    echo json_encode(array("succses" => false, "message" => $Customer->error), JSON_FORCE_OBJECT);
                                }
                            } else {
                                //if password doesn't exist
                                http_response_code(400);
                                echo json_encode(array("succses" => false, "message" => "You have to enter the password"), JSON_FORCE_OBJECT);
                            }
                        } else {
                            //if surname doesn't exist
                            http_response_code(400);
                            echo json_encode(array("succses" => false, "message" => "You have to enter the surname"), JSON_FORCE_OBJECT);
                        }
                    } else {
                        //if name doesn't exist
                        http_response_code(400);
                        echo json_encode(array("succses" => false, "message" => "You have to enter the name"), JSON_FORCE_OBJECT);
                    }
                } else {
                    //if email doesn't exist
                    http_response_code(400);
                    echo json_encode(array("succses" => false, "message" => "You have to enter the email"), JSON_FORCE_OBJECT);
                }
            } else if ($operation == "1") {
                $check = true;
                //if email exist
                if (isset($_POST['email'])) {
                    $Customer->Set_email($_POST['email'],false);
                    //if password exists
                    if (isset($_POST['password'])) {
                        $Customer->Set_password($_POST['password']);
                        if (empty($Customer->error)) {
                            if (isset($_GET['login'])) {
                                $login = $_GET['login'];
                                if ($login != "true" && $login != "false") {
                                    http_response_code(400);
                                    echo json_encode(array('success' => false, 'message' => "login doesn't have the right value"), JSON_FORCE_OBJECT);
                                } else {
                                    if (isset($_POST['name'])) {
                                        $Customer->Set_name($_POST['name']);
                                        if (isset($_POST['surname'])) {
                                            $Customer->Set_surname($_POST['surname']);
                                            if (isset($_POST['phone'])) {
                                                $Customer->Set_phone($_POST['phone']);
                                            } else {
                                                $Customer->Set_phone("1996");
                                            }
                                        } else {
                                            //if surname doesn't exist
                                            http_response_code(400);
                                            echo json_encode(array("succses" => false, "message" => "You have to enter the surname"), JSON_FORCE_OBJECT);
                                            $check = false;
                                        }
                                    } else {
                                        //if email doesn't exist
                                        http_response_code(400);
                                        echo json_encode(array("succses" => false, "message" => "You have to enter the name"), JSON_FORCE_OBJECT);
                                        $check = false;
                                    }
                                }
                            } else {
                                $login = false;
                            }
                            if ($check) {
                                $answer = $Customer->login($login);

                                if ($answer == "1") {
                                    http_response_code(400);
                                    echo json_encode(array('success' => false, 'message' => "Invalid mail, mail doesn't exist"), JSON_FORCE_OBJECT);
                                } else if ($answer == "2") {
                                    http_response_code(400);
                                    echo json_encode(array('success' => false, 'message' => "Invalid password"), JSON_FORCE_OBJECT);
                                } else if ($answer == "3") {
                                    http_response_code(400);
                                    echo json_encode(array('success' => false, 'message' => "You have to verify your email"), JSON_FORCE_OBJECT);
                                } else if ($answer == "4") {
                                    http_response_code(400);
                                    echo json_encode(array('success' => false, 'message' => "There was an error with the Data Base"), JSON_FORCE_OBJECT);
                                } else if ($answer == "5") {
                                    http_response_code(400);
                                    echo json_encode(array('success' => false, 'message' => "The email you are trying to use is already in use "), JSON_FORCE_OBJECT);
                                } else {
                                    http_response_code(200);
                                    echo $answer;
                                }
                            }
                        } else {
                            http_response_code(400);
                            echo json_encode(array("succses" => false, "message" => $Customer->error), JSON_FORCE_OBJECT);
                        }
                    } else {
                        //if password doesn't exist
                        http_response_code(400);
                        echo json_encode(array("succses" => false, "message" => "You have to enter the password"), JSON_FORCE_OBJECT);
                    }
                } else {
                    //if email doesn't exist
                    http_response_code(400);
                    echo json_encode(array("succses" => false, "message" => "You have to enter the email"), JSON_FORCE_OBJECT);
                }
            } else if ($operation == "2") {
                //if email exist
                if (isset($_GET['email'])) {
                    $Customer->Set_email($_GET['email'],true);
                    //if HouseID exists
                    if (isset($_GET['houseID'])) {
                        $houseID = $Customer->test_input($_GET['houseID']);
                        //check if the House ID exists in the database
                        if ($Customer->isHouseID($houseID)) {
                            //if reason exists
                            if (isset($_GET['reason'])) {
                                $reason = $Customer->test_input($_GET['reason']);
                                if (isset($_GET['comment'])) {
                                    if (empty($Customer->error)) {
                                        $comment = $Customer->test_input($_GET['comment']);
                                        $answer = $Customer->Report($houseID, $reason, $comment);
                                        if ($answer == "1") {
                                            http_response_code(400);
                                            echo json_encode(array('success' => false, 'message' => "Invalid Mail"), JSON_FORCE_OBJECT);
                                        } else if ($answer == "2") {
                                            http_response_code(400);
                                            echo json_encode(array('success' => false, 'message' => "Report already exists."), JSON_FORCE_OBJECT);
                                        } else if ($answer == "3") {
                                            http_response_code(400);
                                            echo json_encode(array('success' => false, 'message' => "Owner can't report his/her own house"), JSON_FORCE_OBJECT);
                                        } else {
                                            http_response_code(200);
                                            echo $answer;
                                        }
                                    } else {
                                        http_response_code(400);
                                        echo json_encode(array("succses" => false, "message" => $Customer->error), JSON_FORCE_OBJECT);
                                    }
                                } else {
                                    if (empty($Customer->error)) {
                                        http_response_code(200);
                                        $answer = $Customer->Report($houseID, $reason, "");
                                        if ($answer == "2") {
                                            http_response_code(400);
                                            echo json_encode(array('success' => false, 'message' => "Report already exists."), JSON_FORCE_OBJECT);
                                        } else if ($answer == "3") {
                                            http_response_code(400);
                                            echo json_encode(array('success' => false, 'message' => "Owner can't report his/her own house"), JSON_FORCE_OBJECT);
                                        } else if ($answer == "1") {
                                            http_response_code(400);
                                            echo json_encode(array('success' => false, 'message' => "Invalid Mail"), JSON_FORCE_OBJECT);
                                        } else {
                                            http_response_code(200);
                                            echo $answer;
                                        }
                                    } else {
                                        http_response_code(400);
                                        echo json_encode(array("succses" => false, "message" => $Customer->error), JSON_FORCE_OBJECT);
                                    }
                                }
                            } else {
                                //if reason doesn't exist
                                http_response_code(400);
                                echo json_encode(array("succses" => false, "message" => "You have to enter the reason"), JSON_FORCE_OBJECT);
                            }
                        } else {
                            //if houseID doesn't exist in the Database
                            http_response_code(400);
                            echo json_encode(array("succses" => false, "message" => "The HouseID you are trying to report doesn't exist"), JSON_FORCE_OBJECT);
                        }
                    } else {
                        //if houseID doesn't exist
                        http_response_code(400);
                        echo json_encode(array("succses" => false, "message" => "You have to enter the houseID"), JSON_FORCE_OBJECT);
                    }
                } else {
                    //if email doesn't exist
                    http_response_code(400);
                    echo json_encode(array("succses" => false, "message" => "You have to enter the email"), JSON_FORCE_OBJECT);
                }
            } else if ($operation == "3") {
                if (isset($_GET['email'])) {
                    $Customer->Set_email($_POST['email'],true);
                    if (empty($Customer->error)) {
                        http_response_code(200);
                        echo json_encode($Customer->My_Profile(), JSON_FORCE_OBJECT);
                    } else {
                        http_response_code(400);
                        echo json_encode(array("succses" => false, "message" => $Customer->error), JSON_FORCE_OBJECT);
                    }
                } else {
                    //if email doesn't exist
                    http_response_code(400);
                    echo json_encode(array("succses" => false, "message" => "You have to enter the email"), JSON_FORCE_OBJECT);
                }
            } else {
                //if operation has an acceptable value
                http_response_code(400);
                echo json_encode(array("succses" => false, "message" => "No such operation"), JSON_FORCE_OBJECT);
            }
        } else {
            //if operation doesn't exist
            http_response_code(400);
            echo json_encode(array("succses" => false, "message" => "You need to enter the operation you want to do"), JSON_FORCE_OBJECT);
        }
    } else {
        //if the API KEY doesn't exist to the database
        http_response_code(400);
        echo json_encode(array("succses" => false, "message" => "You don't have an API key, you can ask for one from the main page"), JSON_FORCE_OBJECT);
    }
} else {
    //if Api key doesn't exist
    http_response_code(400);
    echo json_encode(array("succses" => false, "message" => "You need to enter your API_KEY"), JSON_FORCE_OBJECT);
}
