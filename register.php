<?php
require 'functions.php';


if(isset($_POST['register'])){
    if(userRegist($_POST) > 0) {
        echo "<script>
            alert('New user has been registered!');
        </script>";
    } else {
        echo mysqli_error($conn);
    }
}
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <title>My Movies List - Register</title>
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
        <div class="container pt-5 text-light">
        <div class="mb-3">
            <h1 class="text-center">Registration User</h1>
        </div>
        <form action="" method="post" class="m-5">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="username" name="username" class="form-control" id="username" aria-describedby="emailHelp" autocomplete="off">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password">
            </div>
            <div class="mb-3">
                <label for="password2" class="form-label">Confirm Password</label>
                <input type="password" name="password2" class="form-control" id="password2">
            </div>
            <button type="submit" name="register" class="form-control btn btn-primary">Sign Up</button>
        </form>
        </div>
    </main>
    <section class="container-fluid  bg-dark" style="padding-bottom: 10rem;">
            
    </section>
    <footer class="container-fluid bg-danger text-light text-center p-1">
            <h1 class="h3">Made with PHP</h1>
    </footer>
</body>
</html>