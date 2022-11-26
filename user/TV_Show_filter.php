<?php

session_start();

if (
  !isset($_SESSION["flicks_admin"]) &&
  !isset($_SESSION["flicks_subscriber"])
) {
  header("Location: ../signin.php");
}

if (isset($_GET['gen'])) {
    $chosengenre = $_GET['gen'];
    $endpoint = "http://aknox07.lampt.eeecs.qub.ac.uk/flicks/admin/api.php?tvshowgenre=$chosengenre";
    $result = file_get_contents($endpoint);
    $data = json_decode($result, true);
} 

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Series - flicks</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/carousel/">
    <link href="../css/browsing.css" rel="stylesheet">

    <style>
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

        .card:hover .overlay {
            height: 40%;
        }

        .text {
            color: white;
            font-size: 20px;
            position: absolute;
            top: 50%;
            left: 50%;
            -webkit-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            text-align: center;
        }

        /*styling the controls of basic carousel */
        .carousel-control-prev {
            /*size */
            height: 50px;
            width: 50px;
            /*color */
            background: #1b1b1b none repeat scroll 0 0;
            opacity: 0.5;
            /*shape border*/
            border: 0 none;
            border-radius: 50%;
            /*zero for square */
            /*symbol */
            color: #fff;
            line-height: 70px;
            /*vertical position */
            top: 50%;
        }

        .carousel-control-next {
            /*size */
            height: 50px;
            width: 50px;
            /*color */
            background: #1b1b1b none repeat scroll 0 0;
            opacity: 0.5;
            /*shape border*/
            border: 0 none;
            border-radius: 50%;
            /*zero for square */
            /*symbol */
            color: #fff;
            line-height: 70px;
            /*vertical position */
            top: 50%;
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
                        <?php if (isset($_SESSION['flicks_subscriber'])) {
                          echo "
                            <li class='nav-item'>
                              <a class='nav-link' href='mylist.php'>My list</a>
                            </li>";
                          } 
                        ?>

                        <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                            <ul class="navbar-nav">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <?php echo $chosengenre?>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                                      <li><a class="dropdown-item" href="TV_Show_filter.php?gen=Action">Action</a></li>
                                      <li><a class="dropdown-item" href="TV_Show_filter.php?gen=Anime">Anime</a></li>
                                      <li><a class="dropdown-item" href="TV_Show_filter.php?gen=British">British</a></li>
                                      <li><a class="dropdown-item" href="TV_Show_filter.php?gen=Comedies">Comedies</a></li>
                                      <li><a class="dropdown-item" href="TV_Show_filter.php?gen=Crime">Crime</a></li>
                                      <li><a class="dropdown-item" href="TV_Show_filter.php?gen=Docuseries">Docuseries</a></li>
                                      <li><a class="dropdown-item" href="TV_Show_filter.php?gen=Dramas">Dramas</a></li>
                                      <li><a class="dropdown-item" href="TV_Show_filter.php?gen=Horror">Horror</a></li>
                                      <li><a class="dropdown-item" href="TV_Show_filter.php?gen=Kids">Kids</a></li>
                                      <li><a class="dropdown-item" href="TV_Show_filter.php?gen=Reality">Reality</a></li>
                                      <li><a class="dropdown-item" href="TV_Show_filter.php?gen=Romantic">Romance</a></li>
                                      <li><a class="dropdown-item" href="TV_Show_filter.php?gen=Sci-Fi">Sci-Fi</a></li>
                                      <li><a class="dropdown-item" href="TV_Show_filter.php?gen=Stand-Up">Stand-Up</a></li>
                                      <li><a class="dropdown-item" href="TV_Show_filter.php?gen=Thriller">Thriller</a></li>
                                    </ul>
                                </li>
                            </ul>
                            <?php if (isset($_SESSION['flicks_admin'])) {
                                echo "
                                 <li class='nav-item'>
                                  <a class='nav-link' href='../admin/admin_insert.php'>Insert</a>
                                </li>
                                <li class='nav-item'>
                                  <a class='nav-link' href='../admin/admin_search.php'>Manage</a>
                                </li>";
                                } 
                            ?>
                    </ul>
                </div>
                <form class="d-flex" method="POST" action="search_result.php">
                    <input class="form-control me-2" type="search" placeholder="Title... " name="search_value" aria-label="Search" required>
                    <button class="btn btn-outline-light" type="submit">Search</button>
                </form>

                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="signout.php">Sign out</a>
                    </li>
            </div>
          </div>
        </nav>
    </header>

    <main>
        <div class="mainContainer">
            <section class="text-center container">
                <div class="row py-lg-5">
                    <div class="col-lg-6 col-md-8 mx-auto">
                        <h1 class="text-light"><?php echo $chosengenre?></h1>

                    </div>
                </div>
            </section>
        </div>

        <div class="films  rgb(15, 15, 15)">
            <div class="container-fluid">

                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-5 g-1">

                    <?php foreach ($data as $row) : ?>
                    <?php
                      $description = $row["description"];
                      $description = substr($description, 0, 120);
                    ?>

                    <div class="col py-2">

                        <div class="card shadow-sm">

                            <img src=<?php echo $row["img_url"]?> height="300">

                            <div class="overlay bg-dark text-light">
                                <p class="card-text"><?php echo $description?>...</p>
                                  <div class="d-flex justify-content-between align-items-center">
                                    <div class='btn-group'>
                                      <a class="btn btn-sm btn-outline-light bg-dark" href="view.php?id=<?php echo $row["show_id"]?>">View</a>
                                    </div>
                                    
                                    <small class="text-muted"><?php echo $row["duration"]?></small>
                                  </div>
                              </div>
                        </div>
                    </div>

                    <?php endforeach?>

                </div>
            </div>
        </div>



        <footer class="container">
            <p class="float-end"><a href="#">Back to top</a></p>
            <p>&copy; 2017–2021 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
        </footer>
    </main>


    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>


</body>

</html>