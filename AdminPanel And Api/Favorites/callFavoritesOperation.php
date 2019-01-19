<?php

require_once 'FavoritesOperation.php';
if (isset($_GET['operation'])) {
    if (isset($_GET['key'])) {
        if (isset($_GET['email'])) {
            if (isset($_GET['houseID'])) {
                $operation = $_GET['operation'];
                $email = $_GET['email'];
                $houseID = $_GET['houseID'];
                $key = $_GET['key'];
                if ($operation == '0') {
                    $Customer = new Customer($email, $houseID, $key);
                    echo $Customer->addToFavorites();
                } else if ($operation == '1') {
                    $Customer = new Customer($email, $houseID, $key);
                   echo $Customer->removeFromFavorites();
                } else if ($operation == '2') {
                    $Customer = new Customer($email, $houseID, $key);
                   echo $Customer->isFavorite();
                } else {
                    echo json_encode(array("Invalid operation"), JSON_FORCE_OBJECT);
                }
            } else {
                echo json_encode(array("HouseID doesn't exist"), JSON_FORCE_OBJECT);
            }
        } else {
            echo json_encode(array("Email doesn't exist"), JSON_FORCE_OBJECT);
        }
    } else {
        echo json_encode(array("Key doesn't exist"), JSON_FORCE_OBJECT);
    }
} else {
    echo json_encode(array("Operation doesn't exist"), JSON_FORCE_OBJECT);
}

