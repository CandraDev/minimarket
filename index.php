<?php
// connect to database
require 'functions.php';
session_start();

checkLogin();


$movies = query("SELECT * FROM `products`");

// if searchbutton clicked...
if(isset($_POST['search'])){
    $movies = searchMov($_POST["keywords"]); 
}

    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href="https://getbootstrap.com/docs/4.0/examples/sticky-footer/sticky-footer.css" rel="stylesheet">
        <title>My Movies List</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
        <style>
            nav {
                background: url(assets/ui/bg_header.jpg);
            }
        </style>
    </head>
    <body>
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-warning">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="index.php"><img src="assets/ui/logo.webp" style="width: 7rem;"></a>
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
                <a href="logout.php" class="btn btn-light btn-outline-secondary me-2"><i class="bi bi-box-arrow-left"></i></a>
                <input name="keywords" class="form-control me-2" type="text" placeholder="Mau beli apa hari ini?" aria-label="Search">
                <button name="search" class="btn btn-primary" type="submit">Search</button>
            </form>
            </div>
        </div>
    </nav>
    <main class="container-fluid mt-5 bg-light pt-5 pb-5">
                <div class="row row-cols-12 mx-auto">
                <?php $i = 1; foreach($movies as $mov) :?>
                    <div class="col-md-2 g-8">
                        <div class="card mb-3 mx-auto shadow-sm" style="max-width: 540px;">
                            <div class="row-12">
                                <div class="col-sm-12 d-flex justify-content-center align-items-center ">
                                <img src="img/<?=$mov['thumb'];?>" class="img-thumbnail rounded"  alt="...">
                                </div>
                                <div class="col-12">
                                    <div class="card-body" >
                                        <div style="height: 2rem;"><span style="font-size :0.8rem;" class="fw-bold d-block"><?=$mov['name'];?></span></div>
                                        <span class="card-text mt-2 mb-3 d-block">  Rp. <?=$mov['price'];?></span>
                                        <!-- <p class="card-text"><small class="text-muted"><?=$mov['runtime'];?></small></p> -->
                                        <div class="row">
                                            <div class="col-12 mx-auto">
                                                <a href="#" class="btn btn-sm btn-body text-primary border-primary w-100"><i class="bi bi-cart"></i> Beli Sekarang</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach;?>
                </div>
        </div>
    </main>
    <footer class="footer bg-warning text-light text-center p-1">
            <div class="container">
                <h1 class="h3">Made with PHP</h1>
            </div>
    </footer>
</body>
</html>