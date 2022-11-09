<?php

$hostName = "localhost";
$userName = "vvvgfhhfax";
$password = "u2kQqngUe4";
$dbName = "vvvgfhhfax";
$conn= new mysqli($hostName,$userName,$password,$dbName);

 
 
 if($conn){
    return $conn;
    Create_tbl($conn);
 }else{
    echo "not connected";
 }
 
 function Create_tbl($conn){
    $exists = $conn->query("SELECT EXISTS(
        SELECT * FROM information_schema.tables 
        WHERE table_schema = 'stripe_form' 
        AND table_name = 'tbl_payment');");
    if ($conn->query($exists) === FALSE) {
        $sql ="CREATE TABLE `tbl_payment` ( 
                                 `transation_id` VARCHAR(200) NULL,
                                 `owner_ID` INT(20) NOT NULL AUTO_INCREMENT,
                                 `name_of_business` VARCHAR(200) NULL,
                                 `abn` VARCHAR(50) NOT NULL, 
                                 `street_address` VARCHAR(200) NULL, 
                                 `subrub` VARCHAR(50) NOT NULL, 
                                 `state` VARCHAR(50) NOT NULL, 
                                 `postcode` INT(10) NOT NULL, 
                                 `type_of_business` VARCHAR(100) NULL, 
                                 `bussiness_email` VARCHAR(100) NULL, 
                                 `phone` INT(15) NOT NULL, 
                                 `website_address` VARCHAR(200) NULL, 
                                 `online_booking_url` VARCHAR(150) NULL, 
                                 `amount` INT NOT NULL, PRIMARY KEY (`owner_ID`));";
        return $sql;
        if ($conn->query($sql) === TRUE) {
            echo "Table employees created successfully";
        }else{
            echo "Error creating table: " . $conn->error;
        }
                                 
    }else{

        echo "Table Already Exist ";
    }

}

$conn->close();

