<?php

include "../db/conn.php";

session_start();

header('Content-Type: application/json');

$dataset = [];

// Returns all of the flicks library
if (isset($_GET['all'])) {
    $sql = "SELECT * FROM flicks_library";
    $result = mysqli_query($conn, $sql);

    //stage 2 convert each row in the csv to be an indexed array
    while ($row = mysqli_fetch_assoc($result)) {

        $id = $row['show_id'];
        $show_type = $row['show_type'];
        $title = $row['title'];
        $director = $row['director'];
        $cast = $row['cast'];
        $dateadded = $row['date_added'];
        $release_year = $row['release_year'];
        $rating = $row['rating_id'];
        $duration = $row['duration'];
        $genre = $row['genre'];
        $description = $row['description'];
        $imgurl = $row['img_url'];


        $line = [
            'show_id' => $id,
            'show_type' => $show_type,
            'title' => $title,
            'director' => $director,
            'cast' => $cast,
            'date_added' => $dateadded,
            'release_year' => $release_year,
            'rating_id' => $rating,
            'duration' => $duration,
            'genre' => $genre,
            'description' => $description,
            'img_url' => $imgurl,
        ];
        array_push($dataset, $line);
    }

    echo json_encode($dataset);
}

// Returns all of the movies within the flicks library
if (isset($_GET['allmovies'])) {
    $sql = "SELECT * FROM flicks_library WHERE show_type = 'Movie'";
    $result = mysqli_query($conn, $sql);

    //stage 2 convert each row in the csv to be an indexed array
    while ($row = mysqli_fetch_assoc($result)) {

        $id = $row['show_id'];
        $show_type = $row['show_type'];
        $title = $row['title'];
        $director = $row['director'];
        $cast = $row['cast'];
        $dateadded = $row['date_added'];
        $release_year = $row['release_year'];
        $rating = $row['rating_id'];
        $duration = $row['duration'];
        $genre = $row['genre'];
        $description = $row['description'];
        $imgurl = $row['img_url'];

        $line = [
            'show_id' => $id,
            'show_type' => $show_type,
            'title' => $title,
            'director' => $director,
            'cast' => $cast,
            'date_added' => $dateadded,
            'release_year' => $release_year,
            'rating_id' => $rating,
            'duration' => $duration,
            'genre' => $genre,
            'description' => $description,
            'img_url' => $imgurl,
        ];
        array_push($dataset, $line);
    }

    echo json_encode($dataset);
}

// Returns all of the TV Shows within the flicks library
if (isset($_GET['allshows'])) {
    $sql = "SELECT * FROM flicks_library WHERE show_type = 'TV Show'";
    $result = mysqli_query($conn, $sql);

    //stage 2 convert each row in the csv to be an indexed array
    while ($row = mysqli_fetch_assoc($result)) {

        $id = $row['show_id'];
        $show_type = $row['show_type'];
        $title = $row['title'];
        $director = $row['director'];
        $cast = $row['cast'];
        $dateadded = $row['date_added'];
        $release_year = $row['release_year'];
        $rating = $row['rating_id'];
        $duration = $row['duration'];
        $genre = $row['genre'];
        $description = $row['description'];
        $imgurl = $row['img_url'];

        $line = [
            'show_id' => $id,
            'show_type' => $show_type,
            'title' => $title,
            'director' => $director,
            'cast' => $cast,
            'date_added' => $dateadded,
            'release_year' => $release_year,
            'rating_id' => $rating,
            'duration' => $duration,
            'genre' => $genre,
            'description' => $description,
            'img_url' => $imgurl,
        ];
        array_push($dataset, $line);
    }

    echo json_encode($dataset);
}

// Returns the shows of which are related to the specific user - Does this through session ID
if (isset($_GET['mylist'])) {

    $subscriberid = $_GET['mylist'];

    $sql = "SELECT flicks_library.description, flicks_library.img_url, flicks_library.duration, flicks_library.show_id ,flicks_my_list.subscriber_id
            FROM flicks_library
            INNER JOIN 
            flicks_my_list
            ON
            flicks_library.show_id = flicks_my_list.show_id";
            

    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {

        $id = $row['show_id'];
        $duration = $row['duration'];
        $description = $row['description'];
        $imgurl = $row['img_url'];
        $subid = $row['subscriber_id'];


        if($subid == $subscriberid) {
        $line = [
            'show_id' => $id,
            'duration' => $duration,
            'description' => $description,
            'img_url' => $imgurl,
        ];

        array_push($dataset, $line);
    }
   
}
echo json_encode($dataset);

}

// Returns all contents of the flicks library of the same genre as the parameter
if (isset($_GET['genre'])) {
    $gen = $_GET['genre'];
    $sql = "SELECT * FROM flicks_library";
    $result = mysqli_query($conn, $sql);

    $dataset = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['show_id'];
        $show_type = $row['show_type'];
        $title = $row['title'];
        $director = $row['director'];
        $cast = $row['cast'];
        $dateadded = $row['date_added'];
        $release_year = $row['release_year'];
        $rating = $row['rating_id'];
        $duration = $row['duration'];
        $genre = $row['genre'];
        $description = $row['description'];
        $imgurl = $row['img_url'];

        if (strpos($genre, $gen) !== false) {
            $line = [
                'show_id' => $id,
                'show_type' => $show_type,
                'title' => $title,
                'director' => $director,
                'cast' => $cast,
                'date_added' => $dateadded,
                'release_year' => $release_year,
                'rating_id' => $rating,
                'duration' => $duration,
                'genre' => $genre,
                'description' => $description,
                'img_url' => $imgurl,
            ];
            array_push($dataset, $line);
        }
    }

    echo json_encode($dataset);
}

// Returns all movies of the same genre as the parameter
if (isset($_GET['moviegenre'])) {
    $gen = $_GET['moviegenre'];
    $sql = "SELECT * FROM flicks_library WHERE show_type = 'Movie'";
    $result = mysqli_query($conn, $sql);

    $dataset = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['show_id'];
        $show_type = $row['show_type'];
        $title = $row['title'];
        $director = $row['director'];
        $cast = $row['cast'];
        $dateadded = $row['date_added'];
        $release_year = $row['release_year'];
        $rating = $row['rating_id'];
        $duration = $row['duration'];
        $genre = $row['genre'];
        $description = $row['description'];
        $imgurl = $row['img_url'];

        //echo "<p> Rank: {$rating}, Name: {$name}, Country: {$country} - url: {$url}</p>";
        //echo json_encode($url.$name.$rating.$country);

        if (strpos($genre, $gen) !== false) {
            $line = [
                'show_id' => $id,
                'show_type' => $show_type,
                'title' => $title,
                'director' => $director,
                'cast' => $cast,
                'date_added' => $dateadded,
                'release_year' => $release_year,
                'rating_id' => $rating,
                'duration' => $duration,
                'genre' => $genre,
                'description' => $description,
                'img_url' => $imgurl,
            ];
            array_push($dataset, $line);
        }
    }

    echo json_encode($dataset);
}

// Returns all tv shows with the same genre as the parameter
if (isset($_GET['tvshowgenre'])) {
    $gen = $_GET['tvshowgenre'];
    $sql = "SELECT * FROM flicks_library WHERE show_type = 'TV Show'";
    $result = mysqli_query($conn, $sql);

    $dataset = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['show_id'];
        $show_type = $row['show_type'];
        $title = $row['title'];
        $director = $row['director'];
        $cast = $row['cast'];
        $dateadded = $row['date_added'];
        $release_year = $row['release_year'];
        $rating = $row['rating_id'];
        $duration = $row['duration'];
        $genre = $row['genre'];
        $description = $row['description'];
        $imgurl = $row['img_url'];

        
        if (strpos($genre, $gen) !== false) {
            $line = [
                'show_id' => $id,
                'show_type' => $show_type,
                'title' => $title,
                'director' => $director,
                'cast' => $cast,
                'date_added' => $dateadded,
                'release_year' => $release_year,
                'rating_id' => $rating,
                'duration' => $duration,
                'genre' => $genre,
                'description' => $description,
                'img_url' => $imgurl,
            ];
            array_push($dataset, $line);
        }
    }

    echo json_encode($dataset);
}

// Returns all information on a single row within the library using unique show id's
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM flicks_library";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        $movid = $row['show_id'];
        $show_type = $row['show_type'];
        $title = $row['title'];
        $director = $row['director'];
        $cast = $row['cast'];
        $dateadded = $row['date_added'];
        $release_year = $row['release_year'];
        $rating = $row['rating_id'];
        $duration = $row['duration'];
        $genre = $row['genre'];
        $description = $row['description'];
        $imgurl = $row['img_url'];

        if ($movid == $id) {
            $line = [
                'show_id' => $id,
                'show_type' => $show_type,
                'title' => $title,
                'director' => $director,
                'cast' => $cast,
                'date_added' => $dateadded,
                'release_year' => $release_year,
                'rating_id' => $rating,
                'duration' => $duration,
                'genre' => $genre,
                'description' => $description,
                'img_url' => $imgurl,
            ];
            array_push($dataset, $line);
        }
    }

    echo json_encode($dataset);
}

// Inserts a show into the flicks library
if (isset($_GET['insertshow'])) {

$show_type = $_POST['show_type'];
$title=  $_POST['title'];
$director = $_POST['director'];
$cast= $_POST['cast'];
$date= $_POST['dateadded'];
$year= $_POST['releaseyear'];
$rating= $_POST['rating'];
$genre1= $_POST['genre1'];
$genre2= $_POST['genre2'];
$genre3= $_POST['genre3'];
$description=  $_POST['description'];
$image=  $_POST['image'];



$insertquery = "INSERT INTO 
				flicks_library(show_type, title, director, cast,date_added, release_year, rating_id, description, img_url, duration, genre)
				VALUES
				('$show_type', '$title','$director','$cast','$date','$year','$rating', '$description', '$image','','$genre1, $genre2, $genre3')";

$result = $conn->query($insertquery);

if($result) {
    header("Location: admin_insert.php");
}else{
  echo "not registered";
}

}

// Inserts a user into the subscriber table
if (isset($_GET['insertsubscriber'])) {

$newuserfirstname =  $_POST['firstname'];
$newusersurname = $_POST['surname'];
$newuseremail = $_POST['useremail'];
$newuserpassword = $_POST['userpassword'];



$insertquery = "INSERT INTO 
				flicks_subscriber_accounts(first_name,surname,email_address,password, user_type_id)
				VALUES
				('$newuserfirstname','$newusersurname','$newuseremail',MD5('$newuserpassword'), '1')";

$result = $conn->query($insertquery);

if($result) {
    header("Location: ../signin.php");
}else{
  echo "not registered";
}

}

// Updates a users password when they input the correct email
if (isset($_GET['updatepassword'])) {

    //get the form data from the dailyadd.php
$useremail =  $_POST['useremail'];
$usernewpassword = $_POST['newpassword'];


$updatequery = "UPDATE flicks_subscriber_accounts SET password=MD5('$usernewpassword') WHERE email_address = '$useremail'";

$result = $conn->query($updatequery);

if($result) {
    header("Location: ../signin.php");
}else{
  echo "not registered";
}

}


// Checks that a user has input valid log in credentials
if (isset($_GET['signin'])) {

    $email = $_POST["useremail"];
$password = $_POST["userpassword"];

$signin = "SELECT * FROM flicks_subscriber_accounts WHERE email_address= '$email' AND password =MD5('$password')";

$result = $conn->query($signin);

if(!$result) {
    echo $conn->error;
}

$numberofrows = $result->num_rows;

if($numberofrows > 0) {

    $singlerow=$result->fetch_assoc();

    if($singlerow['user_type_id'] == 1) {

   $_SESSION['flicks_subscriber'] = $singlerow['id'];
    header("Location: ../user/main.php");
    
    }

    if($singlerow['user_type_id'] == 2) {

        $_SESSION['flicks_admin'] = $singlerow['id'];
        header("Location: ../user/main.php");

    }
  
} else{

header("Location: ../signin.php");

}

}

// Deletes a show and all of its data from the flicks library
if (isset($_GET['deleterow'])) {

    $id = $_GET['deleterow'];

    $sql = "DELETE FROM flicks_my_list WHERE show_id = $id";
    $sql2 = "DELETE FROM flicks_library WHERE show_id = $id";

    $result = $conn->query($sql);
    $result2 = $conn->query($sql2);

    if(!$result) {
        echo $conn->error;
    } 

    if(!$result2) {
        echo $conn->error;
    } 

    header("location: admin_search.php");
}

// Adds a show to a users unique list
if (isset($_GET['addtolist'])) {

    $showid = $_GET['addtolist'];
    $subscriberid = $_SESSION['flicks_subscriber'];

    $sqlcheck = "SELECT * FROM flicks_my_list WHERE show_id = $showid AND subscriber_id = $subscriberid";

    $res = $conn->query($sqlcheck);

    $numberofrows = $res->num_rows;

    if($numberofrows > 0) {

        header("location: ../user/main.php");
    }else{

    $sql = "INSERT INTO flicks_my_list(subscriber_id, show_id)
    VALUES('$subscriberid','$showid')";

    $result = $conn->query($sql);

    if(!$result) {
        echo $conn->error;
    } 

    header("location: ../user/mylist.php");
}
  
}


// Updates the data on a specific show within the flicks library
if (isset($_GET['updateshow'])) {

    $id = $_GET['updateshow'];
    $duration = $_POST['duration'];
    $showtype = $_POST['show_type']; 
    $title=  $_POST['title'];
    $director = $_POST['director'];
    $cast= $_POST['cast'];
    $date= $_POST['dateadded'];
    $year= $_POST['releaseyear'];
    $rating= $_POST['rating_id'];
    $genre= $_POST['genre'];
    $description=  $_POST['description'];
    $image=  $_POST['image'];
    
    $updatequery = "UPDATE flicks_library SET show_type = '$showtype', director= '$director', title = '$title', cast = '$cast', date_added = '$date', release_year = '$year', rating_id='$rating', 
    duration = '$duration',genre = '$genre', description = '$description', img_url = '$image' WHERE show_id = $id";
    
    $result = $conn->query($updatequery);
    
    if($result) {
        header("Location: ../admin/admin_search.php");
    }else{
      echo "not registered";
    }

}

// Searches for shows related to the users entry within the search bar - has to be the title
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $sql = "SELECT * FROM flicks_library WHERE title LIKE '%$search'";
    $result = mysqli_query($conn, $sql);

    $dataset = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['show_id'];
        $show_type = $row['show_type'];
        $title = $row['title'];
        $director = $row['director'];
        $cast = $row['cast'];
        $dateadded = $row['date_added'];
        $release_year = $row['release_year'];
        $rating = $row['rating_id'];
        $duration = $row['duration'];
        $genre = $row['genre'];
        $description = $row['description'];
        $imgurl = $row['img_url'];

            $line = [
                'show_id' => $id,
                'show_type' => $show_type,
                'title' => $title,
                'director' => $director,
                'cast' => $cast,
                'date_added' => $dateadded,
                'release_year' => $release_year,
                'rating_id' => $rating,
                'duration' => $duration,
                'genre' => $genre,
                'description' => $description,
                'img_url' => $imgurl,
            ];
            array_push($dataset, $line);
        
    }
    echo json_encode($dataset);
}




?>