<?php
require 'functions.php';
session_start();

if(isset($_POST['login'])){
    if(userLogin($_POST) > 0){
        header("Location: index.php");
        exit;
    } else {
        $error = true;
    }
}
?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href="https://getbootstrap.com/docs/4.0/examples/sticky-footer/sticky-footer.css" rel="stylesheet">
        <title>My Movies List - Login</title>
    </head>
    <body>
    <nav class="navbar fixed-top shadow-sm navbar-expand-lg navbar-dark bg-warning">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="index.php">MinaMaret</a>
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
    <main class="container-fluid bg-light d-flex align-items-center justify-content-center position-absolute h-100">
        <div class="container shadow p-4 bg-body" style="border-radius: 2rem;">
            <div class="row text-dark">
                <div class="col-md-9 mx-auto mb-3">
                    <h1 class="h3 fw-bold text-center">User Login</h1>
                </div>
                <form action="" method="post" class="">
                    <div class="col-md-9 mx-auto mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="username" name="username" class="form-control" id="username" aria-describedby="emailHelp" autocomplete="off">
                    </div>
                    <div class="col-md-9 mx-auto mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="password">
                    </div>
                    <div class="col-md-9 mx-auto mb-3">
                        <input type="checkbox" name="remember" class="form-check-input" id="remember-me">
                        <label class="form-check-label" for="remember-me">Remember me</label>
                    </div>
                    <div class="col-md-9 mx-auto mb-5">
                        <p>Don't have one? <a href="register.php">register here.</a></p>
                        <?php if(isset($error)): ?>
                            <p class="text-danger fst-italic">Incorrect username or password!</p>
                        <?php endif; ?> 
                    </div>
                    <div class="col-md-9 mx-auto">
                        <button type="submit" name="login" class="form-control btn btn-primary btn-block">Log In</button>

                </form>
            </div>
        </div>
    </main>
    <footer class="footer shadow-sm bg-warning text-light text-center p-1">
            <div class="container">
                <h1 class="h3">Made with PHP</h1>
            </div>
    </footer>
</body>
</html>