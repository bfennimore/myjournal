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
