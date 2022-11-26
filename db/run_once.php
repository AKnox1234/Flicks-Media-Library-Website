<?php

include("conn.php");

$file = "netflix_titles.csv";

if(file_exists($file)) {

    $filepath = fopen($file, "r");
}

while( ($line = fgetcsv($filepath)) !== FALSE ) {
   
    $show_type = mysqli_real_escape_string($conn, $line[0]);
    $title = mysqli_real_escape_string($conn, $line[1]);
    $director = mysqli_real_escape_string($conn, $line[2]);
    $cast = mysqli_real_escape_string($conn, $line[3]);
    $date_added = mysqli_real_escape_string($conn, $line[5]);
    $year_added = ($conn, $line[6]);
    $duration = mysqli_real_escape_string($conn, $line[8]);
    $genre = mysqli_real_escape_string($conn, $line[9]);
    $description = mysqli_real_escape_string($conn, $line[10]);

    $rating = rand(1,8);

    $insert = "INSERT INTO flicks_library (show_type, title, director, cast, date_added, release_year, rating, duration, genre, description)
    VALUES('{$show_type}','{$title}','{$director}','{$cast}','{$date_added}','{$year_added}','{$rating}','{$duration}','{$genre}','{$description}');";

    $result = $conn->query($insert);

}

if(!$result) {
    echo $conn->error;
    die();
}

?>


