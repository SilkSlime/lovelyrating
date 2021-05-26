<?php
$dbconn = pg_connect("host=ec2-54-78-36-245.eu-west-1.compute.amazonaws.com port=5432 dbname=damcbovdvkucji user=nwuwhicdfqfxys password=d297f268ecbb669c7af029b742c96d2421097ec0efdb871761d443b44dbae886");
$dbconn = pg_connect(getenv("DATABASE_URL"));

$id = $_GET["id"];
$type = $_GET["type"];

$query = "SELECT * FROM students WHERE id=$id;";
$result = pg_query($query);
while ($student = pg_fetch_assoc($result)) {
    $name = $student["name"];
    $surname = $student["surname"];
    $rating = $student["rating"]+$type;
    $id = $student["id"];
    echo "$surname $name $rating";

    $query = "UPDATE students SET rating=$rating WHERE id=$id;";
    pg_query($query);
}
pg_close($dbconn);
?>