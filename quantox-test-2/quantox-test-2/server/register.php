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
    if(isset($_GET["email"]) && isset($_GET["name"]) && isset($_GET["password"]) && isset($_GET["password_confirmation"])){
        $email = $_GET["email"];
        $name = $_GET["name"];
        $password = $_GET["password"];
        $password_confirmation = $_GET["password_confirmation"];

        if($email == null && $name == null && $password == null && $password_confirmation == null){
            $response = json_encode([
                "success"=>false,
                "message" => "All inputs are required."
            ]);
            echo $response;
        }else{
            if($password != $password_confirmation){
                $response = json_encode([
                    "success"=>false,
                    "message" => "Passwords do not match."
                ]);
                echo $response;
            }else{
                $sql = "SELECT * FROM users WHERE email = "."'".$email."'";
                $result = $conn->query($sql);
                $result->fetch_assoc();

                $row_count = 0;

                foreach ($result as $r){
                    $row_count++;
                }

                if($row_count == 0){
                    $sql = "INSERT INTO ".$table." (email, password, name) VALUES ("."'".$email."','".$password."','".$name."'".")";

                    if ($conn->query($sql) === TRUE) {
                        $response = json_encode([
                            "success"=>true,
                            "message" => "New user created successfully."
                        ]);
                        echo $response;
                    } else {
                        $response = json_encode([
                            "success"=>false,
                            "message" => "Error: " . $sql . "<br>" . $conn->error
                        ]);
                        echo $response;
                    }
                }else{
                    $response = json_encode([
                        "success"=>false,
                        "message" => "Email taken."
                    ]);
                    echo $response;
                }
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


