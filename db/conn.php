<?php

$username = "aknox07";

$pw = "20kDtPLVvpPlSQvy";

$host = "aknox07.lampt.eeecs.qub.ac.uk";

$db = "aknox07";

$conn = new mysqli($host, $username, $pw, $db);

if(!$conn) {
    echo $conn->error;
    die();
} else {
    
}
?>