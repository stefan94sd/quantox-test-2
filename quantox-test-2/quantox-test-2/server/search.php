<?php
include ("constants.php");
$servername = SERVERNAME;
$username = USERNAME;
$password = PASSWORD;
$database = DATABASE;
$table = TABLE;

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    echo "Connection failed: " . $conn->connect_error;
}else{
    if(isset($_GET["search"])){
        $search = $_GET["search"];

            //$sql = "SELECT * FROM users WHERE LOWER(CONCAT(name, email)) like LOWER('%".$search."%')";
            $sql = "SELECT * FROM users WHERE email = "."'".$search."'";
            $result = $conn->query($sql);
            $res = $result->fetch_assoc();
            $resProccessed = array();

            $row_count = 1;

            foreach ($result as $r){
                $resProccessed[$row_count]["name"] = $res["name"];
                $resProccessed[$row_count]["email"] = $res["email"];
                $row_count++;
            }
            $response = json_encode([
                "result" => $resProccessed
            ]);
    }else{
        $response = json_encode([
            "success"=>false,
            "message" => "Input required."
        ]);
        echo $response;
    }
    $conn->close();
}
?>
