<?php
include "../configs/settings.php";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "select * from journal ORDER by date_added DESC";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<html><body>";
    echo "<head><style>";
    echo "table {border-collapse:collapse; table-layout:fixed; width:310px;}";
    echo "table td {border:solid 1px; word-wrap:break-word;}";
    echo "</style></head>";
    echo "<a href='upload.html'>Add stuff here</a><br>";
    echo '<table border=1 style="width:100%">';
    echo "<tr><th style='width: 80px;'>Date Added</th><th>Entry info</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["date_added"]. "</td><td><pre>" . $row["entry"]. "</pre></td></tr>";
    }
} else {
    echo "0 results";
}
echo "</table>";
$conn->close();
?>
root@ooby1:/var/www/html/myjournal/webroot# cat update2.php 
<?php
include "../configs/settings.php";
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
