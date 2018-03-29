<?php

require '../../dbcon.php';

$query = "SELECT * FROM chat ORDER BY sl ASC";
//execute query
if ($conn->query($query)) {
    //If the query was successful
    $res = $conn->query($query);

    while ($row = $res->fetch_assoc()) {
        $username = $row["username"];
        $text = $row["text"];
        $time = date('G:i', strtotime($row["time"]));
//outputs date as # #Hour#:#Minute#        
        echo "<p>$time | $username: $text</p>\n";
    }
} else {
    //If the query was NOT successful
    echo "An error occured";
    echo $conn->errno;
}

$conn->close();
?>
