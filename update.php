<?php

    require 'functions.php';
    session_start();
    checkLogin();


    $id = $_GET['id'];

    $mov = query("SELECT * FROM `movies` WHERE id = $id")[0];

    if(isset($_POST["submit"])){
        if( updateMov($_POST) > 0 ) {
            echo "
                <script>
                    alert('Movie has successfully updated!');
                    document.location.href = 'index.php';
                </script>
                ";
        } else {
            echo "
                <script>
                    alert('Data has failed to be updated!');
                    document.location.href = 'index.php';
                </script>
                ";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>My Movies List - Update Movie</title>
</head>
<body>
<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-danger">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">My Movies List</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Link
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
                </li>
                <li class="nav-item">
                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Link</a>
                </li>
            </ul>
            <form action="" method="post" class="d-flex">
                <input name="keywords" class="form-control me-2" type="text" placeholder="Search" aria-label="Search">
                <button name="search" class="btn btn-outline-light" type="submit">Search</button>
            </form>
            </div>
        </div>
    </nav>
    <main class="container-fluid  bg-dark pt-5 pb-5">
        <form action="" method="post" enctype="multipart/form-data">
            <h1 class="text-center text-white m-5">Update Movie</h1>
            <div class="row m-5">
                <div class="col">
                    <div class="row">
                        <label for="poster">Poster: </label>
                            <br> <img src="img/<?=$mov['poster'];?>" alt="" class="w-50 mb-5"> <br>
                            <input class="btn" type="file" name="poster" required>
                    </div>
                </div>
                <input type="hidden" name="id" value="<?=$mov['id'];?>">
                <input type="hidden" name="oldPoster" value="<?=$mov['poster'];?>">
                <div class="col">
                        <label for="title">Title: </label>
                        <input type="text" name="title" class="form-control"  required value="<?=$mov["title"];?>">
                        <label for="year">Year: </label>
                        <input type="number" name="year" class="form-control" required value="<?=$mov["year"];?>">
                </div>
                <div class="col">
                        <label for="genre">Genre: </label>
                        <input type="text" name="genre" class="form-control" required value="<?=$mov["genre"];?>">
                        <label for="runtime">Runtime: </label>
                        <input type="text" name="runtime" class="form-control" required value="<?=$mov["runtime"];?>">
                </div>
                <div class="row mt-5">
                <button type="submit" class="btn btn-success" name="submit">Update Movie</button>
                </div>
            </div>

        </form>
    </main>
    <section class="container-fluid  bg-dark" style="padding-bottom: 10rem;">
            
    </section>
    <footer class="container-fluid bg-danger text-light text-center p-1">
            <h1 class="h3">Made with PHP</h1>
    </footer>
</body>
</html>