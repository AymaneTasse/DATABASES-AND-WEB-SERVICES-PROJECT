<?php
$server = 'localhost';
$username = 'ssulehri';
$mysql_password = 'gHiyGj';
$database = 'Group-29';

$mysqli = new mysqli($server, $username, $mysql_password, $database);

if ($mysqli->connect_error) {
    die("MySQL Connection failed: " . $mysqli->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user information from the form
    $UserID = isset($_POST["UserID"]) ? $_POST["UserID"] : null;
    $Username = isset($_POST["Username"]) ? $_POST["Username"] : null;
    $Email = isset($_POST["Email"]) ? $_POST["Email"] : null;
    $Password = isset($_POST["Password"]) ? $_POST["Password"] : null;
    $Age = isset($_POST["Age"]) ? $_POST["Age"] : null;
    $Name = isset($_POST["Name"]) ? $_POST["Name"] : null;

    // Check if required fields are not empty
    if (!empty($UserID) && !empty($Username) && !empty($Email) && !empty($Password) && !empty($Age) && !empty($Name)) {
        // Construct the SQL query to insert user information
        $userQuery = "INSERT INTO Users (UserID, Username, Email, Password, Age, Name) VALUES (?, ?, ?, ?, ?, ?)";

        $userStmt = $mysqli->prepare($userQuery);

        if ($userStmt === false) {
            echo "User Preparation Error: " . $mysqli->error;
        } else {
            $userStmt->bind_param("ississ", $UserID, $Username, $Email, $Password, $Age, $Name);

            if ($userStmt->execute()) {
                echo "Successful Insertion!";
            } else {
                echo "User Insertion Error: " . $userStmt->error;
            }

            $userStmt->close();
        }
    } else {
        echo "User Insertion Error: Required fields cannot be empty.";
    }
}

$mysqli->close();
?>

<!DOCTYPE html>
<html>
    <body>
        <a href="maintenance.html"> Go Back to Maintenance Page </a>
    </body>
</html>
