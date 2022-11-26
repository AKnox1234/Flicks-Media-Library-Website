<?php

session_start();

if (
  !isset($_SESSION["flicks_admin"]) &&
  !isset($_SESSION["flicks_subscriber"])
) {
  header("Location: ../signin.php");
}

if (isset($_GET['id'])) {
    $showid = $_GET['id'];
} else {
    $showid = $_POST['usersearchid'];
}
$endpoint = "http://aknox07.lampt.eeecs.qub.ac.uk/flicks/admin/api.php?id=$showid";
$result = file_get_contents($endpoint);
$data = json_decode($result, true);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../css/view.css" rel="stylesheet" />

    <style>
        body {
            padding-top: 3rem;
            padding-bottom: 3rem;
            color: #5a5a5a;
            background-color: rgb(15, 15, 15);
        }

        .image {
            display: block;
            width: 100%;
            height: auto;
        }

        .overlay {
            position: absolute;
            bottom: 0;
            -. left: 0;
            right: 0;
            background-color: #008CBA;
            overflow: hidden;
            width: 100%;
            height: 0;
            transition: .5s ease;
        }

        #innercard:hover .overlay {
            height: 40%;
        }
    </style>



</head>

<body>
    <header>
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="main.php">flicks</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="main.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="films.php">Films</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="series.php">Series</a>
                        </li>
                    </ul>
                </div>
                <form class="d-flex" method="POST" action="search_result.php">
                    <input class="form-control me-2" type="search" placeholder="Title... " name="search_value" aria-label="Search" required>
                    <button class="btn btn-outline-light" type="submit">Search</button>
                </form>
            </div>
            </div>
        </nav>
    </header>
    <!-- Page Content-->
    <div class="container align-centre">
        <div class="row">
            <div class="col-lg-12">
                <div class="card mt-4 bg-dark text-light">
                    <div class="card-body">
                        <div class='row'>
                            <div class='col-4'>
                                <img src=<?php echo $data[0][
                                  "img_url"
                              ]; ?> height="300" width="300">
                                <div class='row'>
                                    <div class='col-4'>
                                        <p class="card-text">
                                            <?php echo $data[0]["release_year"]; ?>
                                            <!-- year -->
                                    </div>
                                    <div class='col-4'>
                                        <p class="card-text">
                                            <?php echo $data[0]["rating_id"]; ?>

                                            <!--Rating -->
                                    </div>
                                    <div class='col-4'>
                                        <p class="card-text">
                                            <?php echo $data[0]["duration"]; ?>
                                    </div>
                                </div>
                            </div>

                            <div class='col-8'>
                                <h3 class="card-title"> <?php echo $data[0][
                                  "title"
                              ]; ?></h3>
                                <p class="card-text"><?php echo $data[0][
                                  "description"
                              ]; ?></p>
                                <p class="card-text"><b>Director : </b><?php echo $data[0][
                                  "director"
                              ]; ?></p>
                                <p class="card-text"><b>Cast : </b><?php echo $data[0][
                                  "cast"
                              ]; ?></p>
                                <p class="card-text"><b>Listed in : </b><?php echo $data[0][
                                  "genre"
                              ]; ?></p>

                                <div class='row'>
                                    <div class='col-8'>
                                        <div class='btn-group'>
                                            <input class="btn btn-sm btn-outline-light bg-dark" value="Back" onclick="history.back()">

                                            <?php
                             $id = $data[0]["show_id"];

                             if (isset($_SESSION['flicks_subscriber'])) {
                                 echo "<a class='btn btn-sm btn-outline-light bg-dark' 
                             href='http://aknox07.lampt.eeecs.qub.ac.uk/flicks/admin/api.php?addtolist=$id'>Add to my list</a>

                             <a class='btn btn-sm btn-outline-light bg-dark' href=''>Watch</a>";
                             }

                             if (isset($_SESSION['flicks_admin'])) {
                                 echo "<a class='btn btn-sm btn-outline-light bg-dark' 
                              href='http://aknox07.lampt.eeecs.qub.ac.uk/flicks/admin/api.php?deleterow=$id'>Delete</a>";

                                 echo "<a class='btn btn-sm btn-outline-light bg-dark' 
                              href='../admin/admin_update.php?id=$id'>Edit</a>";
                             }
                             ?>
                                        </div>
                                    </div>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>

                <?php
                    $endpoint =
                        "http://aknox07.lampt.eeecs.qub.ac.uk/flicks/admin/api.php?all";
                    $res = file_get_contents($endpoint);
                    $reccomendeddata = json_decode($res, true);
                    ?>



                <div class="card card-outline-secondary my-4 bg-dark text-light ">
                    <div class="card-header">
                        <h1>You may also like</h1>
                    </div>
                    <div class="card-body">
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-1">

                            <?php
                        $x = 1;
                        $limit = 10;
                        while ($x < $limit) {
                          $y = rand(0, 3000);
                            $description = $reccomendeddata[$y]["description"];
                            $description = substr($description, 0, 120);
                            $x++;
                            echo "
                              <div class='col py-2'>
                                <div id='innercard' class='card shadow-sm'>
                                  <img src={$reccomendeddata[$y]["img_url"]} height='300'>
                                    <div class='overlay bg-dark text-light'>
                                      <p class='card-text'>$description...</p>
                                        <div class='d-flex justify-content-between align-items-center'>
                                          <div class='btn-group'>
                                            <a class='btn btn-sm btn-outline-light bg-dark' href='view.php?id={$reccomendeddata[$y]["show_id"]}'>View</a>
                                          </div>
                                          <small class='text-muted'>{$reccomendeddata[$y]["duration"]}</small>
                                       </div>
                                    </div>
                                </div>
                             </div>";
                        }
                        ?>
                        </div>
                    </div>
                </div>
            </div>




        </div>
    </div>
    <!-- Footer-->
    <footer class="container py-5">
            <p class="float-end"><a href="#">Back to top</a></p>
            <p>&copy; 2017–2021 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
        </footer>
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
</body>

</html>