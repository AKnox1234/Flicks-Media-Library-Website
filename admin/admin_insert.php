<?php

session_start();

if(!isset($_SESSION["flicks_admin"]) && !isset($_SESSION["flicks_subscriber"])) {
    header("Location: ../signin.php");
}

if(!isset($_SESSION["flicks_admin"]) && isset($_SESSION["flicks_subscriber"])) {
    header("Location: ../user/main.php");
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Insert - flicks</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/carousel/">
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>

    <link href="../css/index.css" rel="stylesheet">

</head>

<body>

    <header>
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="../user/main.php">flicks</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </nav>
    </header>

    <main>

        <div class="container py-5">

            <form class="row col-8 g-3" method="POST" action="http://aknox07.lampt.eeecs.qub.ac.uk/flicks/admin/api.php?insertshow">
                <div class="col-md-2">
                    <label for="inputMediaType" class="form-label">Show Type</label>
                    <select class="form-select" aria-label="Default select example" name="show_type" required>
                        <option disabled selected value>---Select---</option>
                        <option>Movie</option>
                        <option>TV Show</option>
                    </select>
                </div>
                <div class="col-md-10">
                    <label for="inputTitle" class="form-label">Title</label>
                    <input type="text" class="form-control" id="inputTitle" name="title" required>
                </div>

                <div class="col-12">
                    <label for="inputDescription" class="form-label">Description</label>
                    <input type="text" class="form-control" id="inputDescription" name="description" required>
                </div>
                <div class="col-3">
                    <label for="inputDirector" class="form-label">Director</label>
                    <input type="text" class="form-control" id="inputDirector" name="director" required>
                </div>
                <div class="col-md-9">
                    <label for="inputCast" class="form-label">Cast</label>
                    <input type="text" class="form-control" id="inputCast" name="cast" required>
                </div>
                <div class="col-md-4">
                    <label for="inputGenre1" class="form-label">Genre(1)</label>
                    <select id="inputGenre1" class="form-select" name="genre1" required>
                        <option disabled selected value>--------------Select--------------</option>
                        <option>Action</option>
                        <option>Anime</option>
                        <option>Comedies</option>
                        <option>Documentaries</option>
                        <option>Dramas</option>
                        <option>Fantasy</option>
                        <option>Romantic</option>
                        <option>Kids and Family</option>
                        <option>Sci-Fi</option>
                        <option>Sports</option>
                        <option>Stand Up Comedy</option>
                        <option>Thriller</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="inputGenre2" class="form-label">Genre(2)</label>
                    <select id="inputGenre2" class="form-select" name="genre2">
                        <option disabled selected value>--------------Select--------------</option>
                        <option>Action</option>
                        <option>Anime</option>
                        <option>Comedies</option>
                        <option>Documentaries</option>
                        <option>Dramas</option>
                        <option>Fantasy</option>
                        <option>Romantic</option>
                        <option>Kids and Family</option>
                        <option>Sci-Fi</option>
                        <option>Sports</option>
                        <option>Stand-Up Comedy</option>
                        <option>Thriller</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="inputGenre3" class="form-label">Genre(3)</label>
                    <select id="inputGenre3" class="form-select" name="genre3">
                        <option disabled selected value>--------------Select--------------</option>
                        <option>Action</option>
                        <option>Anime</option>
                        <option>Comedies</option>
                        <option>Documentaries</option>
                        <option>Dramas</option>
                        <option>Fantasy</option>
                        <option>Romantic</option>
                        <option>Kids and Family</option>
                        <option>Sci-Fi</option>
                        <option>Sports</option>
                        <option>Stand-Up Comedy</option>
                        <option>Thriller</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="inputReleaseYear" class="form-label">Release Year</label>
                    <input type="text" class="form-control" id="inputReleaseYear" name="releaseyear" required>
                </div>
                <div class="col-md-3">
                    <label for="inputDateAdded" class="form-label">Date Added</label>
                    <input type="text" class="form-control" id="inputDateAdded" placeholder="eg. May 6, 2018" name="dateadded" required>
                </div>
                <div class="col-md-2">
                    <label for="inputRating" class="form-label">Rating</label>
                    <select class="form-select" aria-label="Default select example" name="rating" required>
                        <option disabled selected>---Select---</option>
                        <option value="1">TV-PG</option>
                        <option value="2">PG-13</option>
                        <option value="3">R</option>
                        <option value="4">TV-MA</option>
                        <option value="5">TV-G</option>
                        <option value="6">TV-14</option>
                        <option value="7">NR</option>
                        <option value="8">TV-Y</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="inputDuration" class="form-label">Duration</label>
                    <input type="text" class="form-control" id="inputDuration" name="duration" required>
                </div>
                <div class="col-md-12">
                    <label for="inputImage" class="form-label">Image URL</label>
                    <input type="text" class="form-control" id="inputImage" name="image" required>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-sm btn-outline-light bg-dark">Submit</button>
                    <a class="btn btn-sm btn-outline-light bg-dark" href="../user/main.php">Cancel</a>
                </div>
            </form>

            <footer class="container py-5">
                <p class="float-end"><a href="#">Back to top</a></p>
                <p>&copy; 2017–2021 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
            </footer>
    </main>

    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>


</body>

</html>