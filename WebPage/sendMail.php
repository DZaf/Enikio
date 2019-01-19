<?php

//Send mail verification
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $message = $_POST['message'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $name = $_POST['first_name'];
//    header("location: index.php");
$to = "zogasgiorgos@windowslive.com";

$txt = "<!DOCTYPE html>
                                <html>
                                    <head>
                                    </head>
                                    <body>

                                        <p>$message MPLA </p>
                                            <p>$name MPLA1</p>
                                                <p>$email MPLA2</p>

                                    </body>
                                </html>";
$headers = "MIME-Version: 1.0" . "\r\n";
$headers = "Content-type:text/html;charset=UTF-8" . "\r\n";

mail($to, $subject, $txt, $headers);
http_response_code(200);
$ErrorJson = array('success' => true, 'message' => 'Ευχαριστούμε που επικοινωνήσατε μαζί μας, θα σας απαντήσουμε άμεσα');
echo json_encode($ErrorJson, JSON_FORCE_OBJECT);
}else {
    http_response_code(400);
    $ErrorJson = array('success' => false, 'message' => 'Post didnt happened');
    echo json_encode($ErrorJson, JSON_FORCE_OBJECT);
}
