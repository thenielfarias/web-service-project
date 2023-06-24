<?php
require 'vendor/econea/nusoap/src/nusoap.php';
function GetUserByName($name) {
    $con = mysqli_connect("localhost","root","","UserDB");
    if(mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: ". mysqli_connect_error();
        die();
    }
    
    $result = mysqli_query($con,"Select * from users where Name like '%$name%'");
    $retStr = "";
    
    if(mysqli_num_rows($result)>0) {
        while($row=mysqli_fetch_array($result)) {
            $response[] = $row;
        }
        
        return json_encode($response);
    }
    else{
        return "no data";
    }
}


$server = new nusoap_server();
$server->configureWSDL("Soap PHP Demo","urn:soapdemo");

$server->register(
        "GetUserByName",
        array("name"=>"xsd:string"),
        array("return"=>"xsd:string"));

$server->service(file_get_contents("php://input"));
