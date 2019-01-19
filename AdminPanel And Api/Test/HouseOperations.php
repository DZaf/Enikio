<?php

require_once 'House.php';
//if Api key exist
if (isset($_GET["key"])) {
    $house = new House($_GET["key"]);
    //if Api key is good
    if ($house->hasApiKey) {
        //if operation exist
        if (isset($_GET["operation"])) {
            $operation = $house->test_input($_GET["operation"]);
            //if operation has a correct value
            if ($operation == "0") {
                //if email exist
                if (isset($_GET["email"])) {
                    //if email exists in the database and has right form
                    if ($house->Set_Email($_GET["email"])) {
                        http_response_code(200);
                        echo $house->MyHouses();
                    } else {
                        http_response_code(400);
                        //if email doesn't exist in the database and or doesn't have right form
                        echo json_encode(array("succses" => false, "message" => $house->Error), JSON_FORCE_OBJECT);
                    }
                } else {
                    //if email doesn't have email
                    http_response_code(400);
                    echo json_encode(array("succses" => false, "message" => "You need to enter the email"), JSON_FORCE_OBJECT);
                }
            } else if ($operation == "1") {
                //if email exists
                if (isset($_GET["email"])) {
                    //if email exists in the database and has right form
                    if ($house->Set_Email($_GET["email"])) {
                        http_response_code(200);
                        echo $house->MyFavorites();
                    } else {
                        //if email doesn't exist in the database and or doesn't have right form
                        http_response_code(400);
                        echo json_encode(array("succses" => false, "message" => $house->Error), JSON_FORCE_OBJECT);
                    }
                } else {
                    //if email doesn't have email
                    http_response_code(400);
                    echo json_encode(array("succses" => false, "message" => "You need to enter the email"), JSON_FORCE_OBJECT);
                }
            } else if ($operation == "2") {
                //if house id exists
                if (isset($_GET["houseID"])) {
                    if ($house->Set_HouseID($_GET["houseID"])) {
                        http_response_code(200);
                        echo $house->HouseView();
                    } else {
                        //if houseID doesn't exist in the database and or doesn't have right form
                        http_response_code(400);
                        echo json_encode(array("succses" => false, "message" => $house->Error), JSON_FORCE_OBJECT);
                    }
                } else {
                    //if houseID doesn't exist
                    http_response_code(400);
                    echo json_encode(array("succses" => false, "message" => "You need to enter the houseID"), JSON_FORCE_OBJECT);
                }
            } else if ($operation == "3") {
                //if email exists
                if (isset($_POST['email'])) {
                    //if email exists in the database and has right form
                    if ($house->Set_Email($_POST["email"])) {
                        //if State exist
                        if (isset($_POST['nomos'])) {
                            $nomos = $house->test_input($_POST['nomos']);
                            //if City exists
                            if (isset($_POST['poli'])) {
                                $poli = $house->test_input($_POST['poli']);
                                //if tupos exist
                                if (isset($_POST['tupos'])) {
                                    $tupos = $house->test_input($_POST['tupos']);
                                    //if perioxi exists
                                    if (isset($_POST['perioxi'])) {
                                        $perioxi = $house->test_input($_POST['perioxi']);
                                        //if tm exists
                                        if (isset($_POST['tm'])) {
                                            $tm = $house->test_input($_POST['tm']);
                                            //if timi exists
                                            if (isset($_POST['timi'])) {
                                                $timi = $house->test_input($_POST['timi']);
                                                if ($timi == "") {
                                                    $timi = "null";
                                                }
                                            } else {
                                                $timi = "null";
                                            }
                                            //if orofos exists
                                            if (isset($_POST['orofos'])) {
                                                $orofos = $house->test_input($_POST['orofos']);
                                            } else {
                                                //if orofos doesn't exist
                                                $orofos = "-";
                                            }

                                            //if geografikoPlatos exists
                                            if (isset($_POST['lat'])) {
                                                $geografikoPlatos = $house->test_input($_POST['lat']);
                                            } else {
                                                //if geografikoPlatos doesn't exist
                                                $geografikoPlatos = "null";
                                            }

                                            //if geografikoMikos exists
                                            if (isset($_POST['long'])) {
                                                $geografikoMikos = $house->test_input($_POST['long']);
                                            } else {
                                                //if geografikoMikos doesn't exist
                                                $geografikoMikos = "null";
                                            }

                                            //if epiplomeno exists
                                            if (isset($_POST['epiplomeno'])) {
                                                $epiplomeno = $house->test_input($_POST['epiplomeno']);
                                            } else {
                                                //if epiplomeno doesn't exist
                                                $epiplomeno = "false";
                                            }

                                            //if ac exists
                                            if (isset($_POST['ac'])) {
                                                $ac = $house->test_input($_POST['ac']);
                                            } else {
                                                //if ac doesn't exist
                                                $ac = "false";
                                            }

                                            //if tzaki exists
                                            if (isset($_POST['tzaki'])) {
                                                $tzaki = $house->test_input($_POST['tzaki']);
                                            } else {
                                                //if tzaki doesn't exist
                                                $tzaki = "false";
                                            }

                                            //if kipos exists
                                            if (isset($_POST['kipos'])) {
                                                $kipos = $house->test_input($_POST['kipos']);
                                            } else {
                                                //if kipos doesn't exist
                                                $kipos = "false";
                                            }

                                            //if pisina exists
                                            if (isset($_POST['pisina'])) {
                                                $pisina = $house->test_input($_POST['pisina']);
                                            } else {
                                                //if pisina doesn't exist
                                                $pisina = "false";
                                            }

                                            //if anelkistiras exists
                                            if (isset($_POST['anelkistiras'])) {
                                                $anelkistiras = $house->test_input($_POST['anelkistiras']);
                                            } else {
                                                //if anelkistiras doesn't exist
                                                $anelkistiras = "false";
                                            }

                                            //if apothiki exists
                                            if (isset($_POST['apothiki'])) {
                                                $apothiki = $house->test_input($_POST['apothiki']);
                                            } else {
                                                //if apothiki doesn't exist
                                                $apothiki = "false";
                                            }

                                            //if beranta exists
                                            if (isset($_POST['beranta'])) {
                                                $beranta = $house->test_input($_POST['beranta']);
                                            } else {
                                                //if beranta doesn't exist
                                                $beranta = "false";
                                            }

                                            //if iliakosThermosifonas exists
                                            if (isset($_POST['iliakos'])) {
                                                $iliakosThermosifonas = $house->test_input($_POST['iliakos']);
                                            } else {
                                                //if iliakosThermosifonas doesn't exist
                                                $iliakosThermosifonas = "false";
                                            }

                                            //if parking exists
                                            if (isset($_POST['parking'])) {
                                                $parking = $house->test_input($_POST['parking']);
                                            } else {
                                                //if parking doesn't exist
                                                $parking = "false";
                                            }

                                            //if thea exists
                                            if (isset($_POST['thea'])) {
                                                $thea = $house->test_input($_POST['thea']);
                                            } else {
                                                //if thea doesn't exist
                                                $thea = "false";
                                            }

                                            //if noikiasmeno exists
                                            if (isset($_POST['noikiasmeno'])) {
                                                $noikiasmeno = $house->test_input($_POST['noikiasmeno']);
                                            } else {
                                                //if noikiasmeno doesn't exist
                                                $noikiasmeno = "false";
                                            }

                                            //if imerominiaKataskebis exists
                                            if (isset($_POST['imerominiaKataskebis'])) {
                                                $imerominiaKataskebis = $house->test_input($_POST['imerominiaKataskebis']);
                                            } else {
                                                //if imerominiaKataskebis doesn't exist
                                                $imerominiaKataskebis = "-";
                                            }

                                            //if perigrafi exists
                                            if (isset($_POST['perigrafi'])) {
                                                $perigrafi = $house->test_input($_POST['perigrafi']);
                                            } else {
                                                //if perigrafi doesn't exist
                                                $perigrafi = " ";
                                            }

                                            //if eidosThermansis exists
                                            if (isset($_POST['eidosThermansis'])) {
                                                $eidosThermansis = $house->test_input($_POST['eidosThermansis']);
                                            } else {
                                                //if eidosThermansis doesn't exist
                                                $eidosThermansis = " ";
                                            }

                                            //if mesoThermansis exists
                                            if (isset($_POST['mesoThermansis'])) {
                                                $mesoThermansis = $house->test_input($_POST['mesoThermansis']);
                                            } else {
                                                //if mesoThermansis doesn't exist
                                                $mesoThermansis = " ";
                                            }

                                            //if arithmosDomatiwn exists
                                            if (isset($_POST['arithmosDomatiwn'])) {
                                                $arithmosDomatiwn = $house->test_input($_POST['upnodomatia']);
                                            } else {
                                                //if arithmosDomatiwn doesn't exist
                                                $arithmosDomatiwn = "0";
                                            }

                                            //if dieuthinsi exists
                                            if (isset($_POST['dieuthinsi'])) {
                                                $dieuthinsi = $house->test_input($_POST['dieuthinsi']);
                                            } else {
                                                //if mesoThermansis doesn't exist
                                                $dieuthinsi = " ";
                                            }

                                            $answer = $house->InsertHouse($nomos, $poli, $perioxi, $tm, $timi, $orofos, $dieuthinsi, $geografikoPlatos, $geografikoMikos, $epiplomeno, $ac, $tzaki, $kipos, $pisina, $anelkistiras, $apothiki, $beranta, $iliakosThermosifonas, $parking, $thea, $noikiasmeno, $imerominiaKataskebis, $perigrafi, $tupos, $eidosThermansis, $mesoThermansis, $arithmosDomatiwn);
                                            if ($answer == 2) {
                                                //if answer is 2 (error)
                                                http_response_code(400);
                                                echo json_encode(array("succses" => false, "message" => $house->Error), JSON_FORCE_OBJECT);
                                            } else {
                                                //if answer is good
                                                $HouseID = $answer;
                                                if ($house->Set_HouseID($HouseID)) {


                                                    if (isset($_FILES['upload'])) {
                                                        if (!file_exists("photos/$house->Email")) {
                                                            mkdir("photos/$house->Email", 0777, true);
                                                        }
                                                        mkdir("photos/$house->Email/$HouseID", 0777, true);




                                                        $total = count($_FILES['upload']['name']);

                                                        for ($i = 0; $i < $total; $i++) {
                                                            //Get the temp file path
                                                            $tmpFilePath = $_FILES['upload']['tmp_name'][$i];

                                                            //Make sure we have a filepath
                                                            if ($tmpFilePath != "") {
                                                                //Setup our new file path
                                                                $newFilePath = "./photos/$house->Email/$HouseID/" . $_FILES['upload']['name'][$i];
                                                            }
                                                        }


                                                        //Upload the file into the temp dir
                                                        if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                                                            $files[] = $tmpFilePath;
                                                            //Handle other code here
                                                        }
                                                    }


                                                    $success = true;
                                                    if (isset($_POST['phones'])) {
                                                        for ($i = 0; $i < count($_POST['phones']); $i++) {
                                                            $phone = $_POST['phones'][$i];
                                                            if (!$house->newPhone($phone)) {
                                                                $success = false;
                                                                http_response_code(400);
                                                                echo json_encode(array("succses" => false, "message" => "Something went wrong with the phone $phone"), JSON_FORCE_OBJECT);
                                                                break;
                                                            }
                                                        }
                                                    }

                                                    if ($success == true) {
                                                        http_response_code(200);
                                                        echo json_encode(array('success' => true, 'message' => 'Your House is now inserted', 'houseID' => $HouseID), JSON_FORCE_OBJECT);
                                                    }
                                                } else {
                                                    http_response_code(400);
                                                    echo json_encode(array("succses" => false, "message" => "There was an error with thr insert"), JSON_FORCE_OBJECT);
                                                }
                                            }
                                        } else {
                                            //if tm doesn't exist
                                            http_response_code(400);
                                            echo json_encode(array("succses" => false, "message" => "tm is required"), JSON_FORCE_OBJECT);
                                        }
                                    } else {
                                        //if perioxi doesn't exist
                                        http_response_code(400);
                                        echo json_encode(array("succses" => false, "message" => "perioxi is required"), JSON_FORCE_OBJECT);
                                    }
                                } else {
                                    //if tupos doesn't exist
                                    http_response_code(400);
                                    echo json_encode(array("succses" => false, "message" => "tupos is required"), JSON_FORCE_OBJECT);
                                }
                            } else {
                                //if poli doesn't exist
                                http_response_code(400);
                                echo json_encode(array("succses" => false, "message" => "poli is required"), JSON_FORCE_OBJECT);
                            }
                        } else {
                            //if nomos doesn't exist
                            http_response_code(400);
                            echo json_encode(array("succses" => false, "message" => "nomos is required"), JSON_FORCE_OBJECT);
                        }
                    } else {
                        //if email doesn't exist in the database and or doesn't have right form
                        http_response_code(400);
                        echo json_encode(array("succses" => false, "message" => $house->Error), JSON_FORCE_OBJECT);
                    }
                } else {
                    http_response_code(400);
                    echo json_encode(array("succses" => false, "message" => "You need to enter the email"), JSON_FORCE_OBJECT);
                }
            } else if ($operation == "4") {
                http_response_code(200);
                echo $house->State();
            } else if ($operation == "5") {
                if (isset($_GET['state'])) {
                    $state = $house->test_input($_GET['state']);
                    http_response_code(200);
                    echo $house->City($state);
                } else {
                    http_response_code(400);
                    echo json_encode(array("succses" => false, "message" => "state is required"), JSON_FORCE_OBJECT);
                }
            } else if ($operation == "6") {
                if (isset($_GET['number'])) {
                    $var = $house->test_input($_GET['number']);
                    if ($house->isNumber($var)) {
                        http_response_code(200);
                        echo $house->HomePage($var);
                    } else {
                        http_response_code(400);
                        echo json_encode(array("succses" => false, "message" => "number has to be numeric"), JSON_FORCE_OBJECT);
                    }
                } else {
                    http_response_code(400);
                    echo json_encode(array("succses" => false, "message" => "number is required"), JSON_FORCE_OBJECT);
                }
            } else if ($operation == "7") {
                $ok = true;

                //if nomos exists
                if (isset($_POST['nomos'])) {
                    $nomos = $house->test_input($_POST['nomos']);
                    if ($nomos != '') {
                        if ($house->isNomos($nomos)) {
                            $house->add(" nomos='$nomos' ");
                        } else {
                            http_response_code(400);
                            echo json_encode(array("succses" => false, "message" => "nomos doesn't have the right value"), JSON_FORCE_OBJECT);
                            $ok = false;
                        }
                    }
                }

                if ($ok) {
                    if (isset($_POST['poli'])) {
                        $poli = $house->test_input($_POST['poli']);
                        if ($poli != '') {
                            if ($house->isCity($poli)) {
                                $house->add(" poli='$poli' ");
                            } else {
                                http_response_code(400);
                                echo json_encode(array("succses" => false, "message" => "city value is not right or it doesn't belong to the current state"), JSON_FORCE_OBJECT);
                                $ok = false;
                            }
                        }
                    }
                }
                if ($ok) {
                    if (isset($_POST['tupos'])) {
                        $tupos = $house->test_input($_POST['tupos']);
                        if ($tupos != '') {
                            if ($house->isRightType($tupos)) {
                                array_push($house->Search, " tupos='" . $tupos . "' ");
                            } else {
                                http_response_code(400);
                                echo json_encode(array("succses" => false, "message" => "city value is not right or it doesn't belong to the current state"), JSON_FORCE_OBJECT);
                                $ok = false;
                            }
                        }
                    }
                }
                if ($ok) {
                    if (isset($_POST['tmapo'])) {
                        $tmapo = $house->test_input($_POST['tmapo']);
                        if ($tmapo != '') {
                            if ($house->isNumber($tmapo)) {
                                array_push($house->Search, " tm>=" . $tmapo . " ");
                            } else {
                                http_response_code(400);
                                echo json_encode(array("succses" => false, "message" => "tmapo has to be Numeric"), JSON_FORCE_OBJECT);
                                $ok = false;
                            }
                        }
                    }
                }
                if ($ok) {
                    if (isset($_POST['tmews'])) {
                        $tmews = $house->test_input($_POST['tmews']);
                        if ($tmews != '') {
                            if ($house->isNumber($tmews)) {
                                if($tmapo<=$tmews)
                                {
                                array_push($house->Search, " tm<=" . $tmews . " ");
                                }
                                else if($tmapo=='')
                                {
                                 array_push($house->Search, " tm<=" . $timiews . " ");   
                                }
                                else
                                {
                                     http_response_code(400);
                                echo json_encode(array("succses" => false, "message" => "tmews has to be bigger than timiews"), JSON_FORCE_OBJECT);
                                $ok = false; 
                                }
                            } else {
                                http_response_code(400);
                                echo json_encode(array("succses" => false, "message" => "tmews has to be Numeric"), JSON_FORCE_OBJECT);
                                $ok = false;
                            }
                        }
                    }
                }
                if ($ok) {
                    if (isset($_POST['timiapo'])) {
                        $timiapo = $house->test_input($_POST['timiapo']);
                        if ($timiapo != '') {
                            if ($house->isNumber($timiapo)) {
                                array_push($house->Search, " timi>=" . $timiapo . " ");
                            } else {
                                http_response_code(400);
                                echo json_encode(array("succses" => false, "message" => "timiapo has to be Numeric"), JSON_FORCE_OBJECT);
                                $ok = false;
                            }
                        }
                    }
                }
                if ($ok) {
                    if (isset($_POST['timiews'])) {
                        $timiews = $house->test_input($_POST['timiews']);
                        if ($timiews != '') {
                            if ($house->isNumber($timiews)) {
                                if($timiapo<=$timiews)
                                {
                                array_push($house->Search, " timi<=" . $timiews . " ");
                                }
                                else if($timiapo=='')
                                {
                                 array_push($house->Search, " timi<=" . $timiews . " ");   
                                }
                                else
                                {
                                   http_response_code(400);
                                echo json_encode(array("succses" => false, "message" => "timiews has to be bigger than timiews"), JSON_FORCE_OBJECT);
                                $ok = false; 
                                }
                            } else {
                                http_response_code(400);
                                echo json_encode(array("succses" => false, "message" => "timiews has to be Numeric"), JSON_FORCE_OBJECT);
                                $ok = false;
                            }
                        }
                    }
                }
                if ($ok) {
                    if (isset($_POST['orofos'])) {
                        $orofos = $house->test_input($_POST['orofos']);
                        if ($orofos != '') {
                            if ($house->isNumber($orofos)) {
                                array_push($house->Search, " orofos=" . $orofos . " ");
                            } else {
                                http_response_code(400);
                                echo json_encode(array("succses" => false, "message" => "timiews has to be Numeric"), JSON_FORCE_OBJECT);
                                $ok = false;
                            }
                        }
                    }
                }
                if ($ok) {
                    if (isset($_POST['epiplomeno'])) {
                        $epiplomeno = $house->test_input($_POST['epiplomeno']);
                        if ($epiplomeno != '') {
                            if ($house->isBoolean($epiplomeno)) {
                                array_push($house->Search, " epiplomeno ='" . $epiplomeno . "' ");
                            }
                        }
                    }
                }
                if ($ok) {
                    if (isset($_POST['ac'])) {
                        $ac = $house->test_input($_POST['ac']);
                        if ($ac != '') {
                            if ($house->isBoolean($ac)) {
                                array_push($house->Search, " ac='" . $ac . "' ");
                            } else {
                                http_response_code(400);
                                echo json_encode(array("succses" => false, "message" => "ac has to be Boolean"), JSON_FORCE_OBJECT);
                                $ok = false;
                            }
                        }
                    }
                }
                if ($ok) {
                    if (isset($_POST['tzaki'])) {
                        $tzaki = $house->test_input($_POST['tzaki']);
                        if ($tzaki != '') {
                            if ($house->isBoolean($tzaki)) {
                                array_push($house->Search, " tzaki='" . $tzaki . "' ");
                            } else {
                                http_response_code(400);
                                echo json_encode(array("succses" => false, "message" => "tzaki has to be Boolean"), JSON_FORCE_OBJECT);
                                $ok = false;
                            }
                        }
                    }
                }
                if ($ok) {
                    if (isset($_POST['kipos'])) {
                        $kipos = $house->test_input($_POST['kipos']);
                        if ($kipos != '') {
                            if ($house->isBoolean($kipos)) {
                                array_push($house->Search, " kipos=" . $kipos . " ");
                            } else {
                                http_response_code(400);
                                echo json_encode(array("succses" => false, "message" => "kipos has to be Boolean"), JSON_FORCE_OBJECT);
                                $ok = false;
                            }
                        }
                    }
                }
                if ($ok) {
                    if (isset($_POST['pisina'])) {
                        $pisina = $house->test_input($_POST['pisina']);
                        if ($pisina != '') {
                            if ($house->isBoolean($pisina)) {
                                array_push($house->Search, " pisina=" . $pisina . " ");
                            } else {
                                http_response_code(400);
                                echo json_encode(array("succses" => false, "message" => "pisina has to be Boolean"), JSON_FORCE_OBJECT);
                                $ok = false;
                            }
                        }
                    }
                }
                if ($ok) {
                    if (isset($_POST['anelkistiras'])) {
                        $anelkistiras = $house->test_input($_POST['anelkistiras']);
                        if ($anelkistiras != '') {
                            if ($house->isBoolean($anelkistiras)) {
                                array_push($house->Search, " anelkistiras=" . $anelkistiras . " ");
                            } else {
                                http_response_code(400);
                                echo json_encode(array("succses" => false, "message" => "anelkistiras has to be Boolean"), JSON_FORCE_OBJECT);
                                $ok = false;
                            }
                        }
                    }
                }
                if ($ok) {
                    if (isset($_POST['apothiki'])) {
                        $apothiki = $house->test_input($_POST['apothiki']);
                        if ($apothiki != '') {
                            if ($house->isBoolean($apothiki)) {
                                array_push($house->Search, " apothiki=" . $apothiki . " ");
                            } else {
                                http_response_code(400);
                                echo json_encode(array("succses" => false, "message" => "apothiki has to be Boolean"), JSON_FORCE_OBJECT);
                                $ok = false;
                            }
                        }
                    }
                }
                if ($ok) {
                    if (isset($_POST['beranta'])) {
                        $beranta = $house->test_input($_POST['beranta']);
                        if ($beranta != '') {
                            if ($house->isBoolean($beranta)) {
                                array_push($house->Search, " beranta=" . $beranta . " ");
                            } else {
                                http_response_code(400);
                                echo json_encode(array("succses" => false, "message" => "beranta has to be Boolean"), JSON_FORCE_OBJECT);
                                $ok = false;
                            }
                        }
                    }
                }
                if ($ok) {
                    if (isset($_POST['iliakos'])) {
                        $iliakos = $house->test_input($_POST['iliakos']);
                        if ($iliakos != '') {
                            if ($house->isBoolean($iliakos)) {
                                array_push($house->Search, " IliakosThermosifwnas=" . $iliakos . " ");
                            } else {
                                http_response_code(400);
                                echo json_encode(array("succses" => false, "message" => "iliakos has to be Boolean"), JSON_FORCE_OBJECT);
                                $ok = false;
                            }
                        }
                    }
                }
                if ($ok) {
                    if (isset($_POST['parking'])) {
                        $parking = $house->test_input($_POST['parking']);
                        if ($parking != '') {
                            if ($house->isBoolean($parking)) {
                                array_push($house->Search, " parking=" . $parking . " ");
                            } else {
                                http_response_code(400);
                                echo json_encode(array("succses" => false, "message" => "parking has to be Boolean"), JSON_FORCE_OBJECT);
                                $ok = false;
                            }
                        }
                    }
                }
                if ($ok) {
                    if (isset($_POST['thea'])) {
                        $thea = $house->test_input($_POST['thea']);
                        if ($thea != '') {
                            if ($house->isBoolean($thea)) {
                                array_push($house->Search, " thea=" . $thea . " ");
                            } else {
                                http_response_code(400);
                                echo json_encode(array("succses" => false, "message" => "thea has to be Boolean"), JSON_FORCE_OBJECT);
                                $ok = false;
                            }
                        }
                    }
                }
                if ($ok) {
                    if (isset($_POST['eidosThermansis'])) {
                        $eidosThermansis = $house->test_input($_POST['eidosThermansis']);
                        if ($eidosThermansis != '') {
                            if ($house->isHeatType($eidosThermansis)) {
                                array_push($house->Search, " eidosThermansis=" . $eidosThermansis . " ");
                            } else {
                                http_response_code(400);
                                echo json_encode(array("succses" => false, "message" => "eidosThermansis doesn't have the right value"), JSON_FORCE_OBJECT);
                                $ok = false;
                            }
                        }
                    }
                }
                if ($ok) {
                    if (isset($_POST['mesoThermansis'])) {
                        $mesoThermansis = $house->test_input($_POST['mesoThermansis']);
                        if ($mesoThermansis != '') {
                            if ($house->isHeating($mesoThermansis)) {
                                array_push($house->Search, " eidosThermansis=" . $mesoThermansis . " ");
                            } else {
                                http_response_code(400);
                                echo json_encode(array("succses" => false, "message" => "mesoThermansis doesn't have the right value"), JSON_FORCE_OBJECT);
                                $ok = false;
                            }
                        }
                    }
                }
                if ($ok) {
                    if (isset($_POST['arithmosDomatiwn'])) {
                        $arithmosDomatiwn = $house->test_input($_POST['arithmosDomatiwn']);
                        if ($arithmosDomatiwn != '') {
                            if ($house->isNumber($arithmosDomatiwn)) {
                                array_push($house->Search, " arithmosDomatiwn=" . $arithmosDomatiwn . " ");
                            } else {
                                http_response_code(400);
                                echo json_encode(array("succses" => false, "message" => "arithmosDomatiwn has to be numeric"), JSON_FORCE_OBJECT);
                                $ok = false;
                            }
                        }
                    }
                }

                if ($ok) {
                     
                    $answer = $house->Search();
                    if($answer=="0")
                    {
                        http_response_code(400);
                         echo json_encode(array(array("succses" => false, "message" => "No results found")), JSON_FORCE_OBJECT);
                    }
                    else
                    {
                        http_response_code(200);
                        echo $answer;
                    }
                   
                }
            } else {
                http_response_code(400);
                //if operation doesn't have a correct value
                echo json_encode(array("succses" => false, "message" => "Wrong operation value"), JSON_FORCE_OBJECT);
            }
        } else {
            http_response_code(400);
            //if operation doest exist
            echo json_encode(array("succses" => false, "message" => "You need to enter the operation "), JSON_FORCE_OBJECT);
        }
    } else {
        http_response_code(400);
        //if Api key is not good
        echo json_encode(array("succses" => false, "message" => "Your API key is wrong or doesn't exist ask the Admins for more information"), JSON_FORCE_OBJECT);
    }
} else {
    http_response_code(400);
    //if Api key doesn't exist
    echo json_encode(array("succses" => false, "message" => "You need to enter your API_KEY"), JSON_FORCE_OBJECT);
}
