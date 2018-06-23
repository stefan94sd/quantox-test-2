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
    if(isset($_GET["email"]) && isset($_GET["password"])){
        $email = $_GET["email"];
        $password = $_GET["password"];

        if($email == null && $password == null){
            $response = json_encode([
                "success"=>false,
                "message" => "All inputs are required."
            ]);
            echo $response;
        }else{
            $sql = "SELECT * FROM users WHERE email = "."'".$email."' and password = "."'".$password."'";
            $result = $conn->query($sql);
            $res = $result->fetch_assoc();

            $row_count = 0;

            foreach ($result as $r){
                $row_count++;
            }

            if($row_count == 0){
                $response = json_encode([
                    "success"=>false,
                    "message" => "Wrong username or password.",
                    "res" => $res
                ]);
                echo $response;
            }else{
                $name = $res["name"];
                $id = $res["id"];
                $email = $res["email"];

                session_start();

                $_SESSION['id'] = $id;
                $_SESSION['email'] = $email;
                $_SESSION['name'] = $name;

                $response = json_encode([
                    "success"=>true,
                    "message" => "Welcome ".$_SESSION['name']."."
                ]);
                echo $response;
            }
        }
    }else{
        $response = json_encode([
            "success"=>false,
            "message" => "All inputs are required."
        ]);
        echo $response;
    }
    $conn->close();
}
?>
