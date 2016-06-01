<?php
include "configs/settings.php";
if ($_POST["j_entry"]) {
        echo "Got it!";
} else {
        echo "I do not got it.";
}
$logentry = addslashes($_POST["j_entry"]);
$date_entry = date("Y-m-d G:i:s");
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "INSERT INTO journal (date_added, entry) VALUES('$date_entry','$logentry')";
if ($conn->query($sql) === TRUE) {
    echo "<html><body>New record created successfully<br><br><a href='upload.html'>Go make more</a><br>";
    echo "<a href='home.php'>Go to homepage instead</a></body></html>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>
