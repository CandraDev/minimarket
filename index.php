<?php
// connect to database
require 'system/functions.php';
session_start();

checkCookie();

// if searchbutton clicked...
if(isset($_POST['search'])){
    $products = searchMov($_POST["keywords"]); 
}

    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://getbootstrap.com/docs/4.0/examples/sticky-footer/sticky-footer.css" rel="stylesheet">
    <title>My Movies List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
    nav {
        background: url(assets/ui/bg_header.jpg);
    }
    </style>

</head>

<body>
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-warning shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="index.php"><img src="assets/ui/logo.webp" style="width: 7rem;"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
                aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav  me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarScrollingDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-basket"></i> Kategori
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                            <li><a class="dropdown-item" href="#"><i class="bi bi-egg-fried"></i> Makanan</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-cup-straw"></i> Minuman</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-prescription2"></i> Kesehatan</a></li>
                        </ul>
                    </li>
                </ul>
                <div class="navbar-nav me-auto my-2 my-lg-0 ">
                    <form action="" method="post" class="d-flex mx-auto">
                        <input name="keywords" class="form-control me-2 shadow-sm" style="width: 50vw;" type="text" placeholder="Mau beli apa hari ini?"
                            aria-label="Search">
                        <button name="search" title="Cari" class="btn btn-light shadow-sm" type="submit"><i class="bi bi-search" style="color:#ffbf00;"></i></button>
                    </form>
                </div>
                <div class="navbar-nav">
                    <?php if(isset($_SESSION["user-login"])) {?>
                        <a href="system/logout.php" title="Logout" class="btn btn-light btn-outline-secondary me-2 shadow-sm">
                            <i class="bi bi-box-arrow-left"></i>
                        </a>
                        <a href="#" title="profile" class="btn btn-light btn-outline-primary me-2 shadow-sm">
                            <i class="bi bi-person-circle"></i>
                        </a>
                        <?php } else { ?>
                        <a href="#" class="btn btn-light btn-outline-primary me-2 shadow-sm" data-bs-toggle="modal"
                            data-bs-target="#userLogin">
                            Masuk
                        </a>
                        <a href="#" class="btn btn-light btn-outline-primary me-2 shadow-sm">
                            Daftar
                        </a>
                    <?php } ?>  
                </div>
            </div>
        </div>
    </nav>
    <main class="container-fluid mt-5 p-5 bg-light pt-5 pb-5">
            <div class="row mx-auto">
                <h1 class="mb-4 mt-5"><i class="bi bi-egg-fried me-4"></i>Makanan</h1>
                <?php $products = query("SELECT * FROM `products` WHERE `prd-kategori` = 'Makanan'"); foreach($products as $prd) :?>
                <div class="col-md-2 g-8">
                    <div class="card mb-3 mx-auto shadow-sm" style="max-width: 540px;">
                        <div class="row-12">
                            <div class="col-lg-12 d-flex justify-content-center align-items-center ">
                                <img src="img/<?=$prd['prd-thumb'];?>" class="img-thumbnail rounded" alt="...">
                            </div>
                            <div class="col-12">
                                <div class="card-body">
                                    <div style="height: 2rem;"><span style="font-size :0.8rem;"
                                            class="fw-bold d-block"><?=$prd['prd-nama'];?></span></div>
                                    <span class="card-text mt-2 mb-3 d-block"> Rp. <?=number_format($prd['prd-harga']);?></span>
                                    <!-- <p class="card-text"><small class="text-muted"><?=$prd['runtime'];?></small></p> -->
                                    <div class="row">
                                        <div class="col-12 mx-auto">
                                            <button type="button" class="btn btn-sm btn-primary w-100"
                                                data-bs-toggle="modal"
                                                data-bs-target="#<?php if(isset($_SESSION['user-login'])) {echo'userBuy';}else{echo'userLogin';} ?>">
                                                <i class="bi bi-cart"></i> Beli Sekarang 
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach;?>
                <a href="catalogue.php?<?="kategori='makanan-bebas-ini-mah'"?>">Cek Selengkapnya</a>
            </div>
            <div class="row mx-auto">
                <h1 class="mb-4 mt-5">Minuman</h1>
                <?php $products = query("SELECT * FROM `products` WHERE `prd-kategori` = 'Makanan'"); foreach($products as $prd) :?>
                <div class="col-md-2 g-8">
                    <div class="card mb-3 mx-auto shadow-sm" style="max-width: 540px;">
                        <div class="row-12">
                            <div class="col-lg-12 d-flex justify-content-center align-items-center ">
                                <img src="img/<?=$prd['prd-thumb'];?>" class="img-thumbnail rounded" alt="...">
                            </div>
                            <div class="col-12">
                                <div class="card-body">
                                    <div style="height: 2rem;"><span style="font-size :0.8rem;"
                                            class="fw-bold d-block"><?=$prd['prd-nama'];?></span></div>
                                    <span class="card-text mt-2 mb-3 d-block"> Rp. <?=$prd['prd-harga'];?></span>
                                    <!-- <p class="card-text"><small class="text-muted"><?=$prd['runtime'];?></small></p> -->
                                    <div class="row">
                                        <div class="col-12 mx-auto">
                                            <button type="button" class="btn btn-sm btn-primary w-100"
                                                data-bs-toggle="modal"
                                                data-bs-target="#<?php if(isset($_SESSION['user-login'])) {echo'userBuy';}else{echo'userLogin';} ?>">
                                                <i class="bi bi-cart"></i> Beli Sekarang
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach;?>
                <a href="catalogue.php?<?="e"?>">Cek Selengkapnya</a>
            </div>
            <div class="row mx-auto">
                <h1 class="mb-4 mt-5">Kesehatan</h1>
                <?php $products = query("SELECT * FROM `products` WHERE `prd-kategori` = 'Makanan'"); foreach($products as $prd) :?>
                <div class="col-md-2 g-8">
                    <div class="card mb-3 mx-auto shadow-sm" style="max-width: 540px;">
                        <div class="row-12">
                            <div class="col-lg-12 d-flex justify-content-center align-items-center ">
                                <img src="img/<?=$prd['prd-thumb'];?>" class="img-thumbnail rounded" alt="...">
                            </div>
                            <div class="col-12">
                                <div class="card-body">
                                    <div style="height: 2rem;"><span style="font-size :0.8rem;"
                                            class="fw-bold d-block"><?=$prd['prd-nama'];?></span></div>
                                    <span class="card-text mt-2 mb-3 d-block"> Rp. <?=$prd['prd-harga'];?></span>
                                    <!-- <p class="card-text"><small class="text-muted"><?=$prd['runtime'];?></small></p> -->
                                    <div class="row">
                                        <div class="col-12 mx-auto">
                                            <button type="button" class="btn btn-sm btn-primary w-100"
                                                data-bs-toggle="modal"
                                                data-bs-target="#<?php if(isset($_SESSION['user-login'])) {echo'userBuy';}else{echo'userLogin';} ?>">
                                                <i class="bi bi-cart"></i> Beli Sekarang
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach;?>
                <a href="catalogue.php?<?="e"?>">Cek Selengkapnya</a>
            </div>
    </main>

    <footer class="footer bg-warning text-light text-center p-1">
        <div class="container">
            <h1 class="h3">Made with PHP</h1>
        </div>
    </footer>

    <div class="modal fade" id="userLogin" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content pt-5 pb-5">
                <div class="row text-dark">
                    <div class="col-md-9 mx-auto mb-3">
                        <h1 class="h3 fw-bold text-center">User Login</h1>
                    </div>

                    <form action="system/verifyuser.php" method="post" class="">
                        <div class="col-md-9 mx-auto mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="username" name="username" class="form-control" id="username"
                                aria-describedby="emailHelp" autocomplete="off">
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
                            <button type="login-submit" name="login"
                                class="form-control btn btn-primary btn-block">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>




    <div class="modal fade" id="userBuy" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-5">
                <div class="row text-dark">
                    <div class="col-md-9 mx-auto mb-3">
                        <h1 class="h3 fw-bold text-center">Beli Sekarang</h1>
                    </div>

                    <form action="" method="post">
                        <div class="col-md-9 mx-auto mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="username" name="username" class="form-control" id="username"
                                aria-describedby="emailHelp" autocomplete="off">
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
                            <button type="buy-submit" name="login"
                                class="form-control btn btn-primary btn-block">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>