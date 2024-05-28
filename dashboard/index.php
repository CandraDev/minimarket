<?php
 require '../system/functions.php';
 session_start();
 checkAdminLogin("login.php");
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
        background: url(../assets/ui/bg_header.jpg);
    }
    </style>

</head>

<body>
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-warning shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="index.php"><img src="../assets/ui/logo.webp" style="width: 7rem;"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
                aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav  me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Dashboard</a>
                    </li>
                </ul>
                <div class="navbar-nav">
                    <a href="logout.php" title="Logout" class="btn btn-light btn-outline-secondary me-2 shadow-sm">
                        <i class="bi bi-box-arrow-left"></i>
                    </a>
                </div>
            </div>
        </div>
    </nav>
    <main class="container-fluid mt-5 p-5 bg-light pt-5 pb-5">
        <div class="row mx-auto">
            <h1 class="mb-5 mt-5"><i class="bi bi-gear-wide-connected me-4"></i>Admin Tools</h1>
            <div class="col-md-2 g-8 mx-auto">
                <div class="card mb-3 mx-auto shadow-sm" style="max-width: 540px;">
                    <div class="row-12">
                        <div class="col-lg-12 d-flex justify-content-center align-items-center p-3 ">
                            <svg xmlns="http://www.w3.org/2000/svg" width="200" height="160" fill="currentColor"
                                class="bi bi-cart" viewBox="0 0 16 16">
                                <path
                                    d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
                            </svg>
                        </div>
                        <div class="col-12">
                            <div class="card-body">
                                <div class="d-block justify-content"></div>
                                <div class="row">
                                    <div class="col-12 mx-auto">
                                        <a href="products" class="btn btn-sm btn-primary w-100"></i> Manage Products
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2 g-8 mx-auto">
                <div class="card mb-3 mx-auto shadow-sm" style="max-width: 540px;">
                    <div class="row-12">
                        <div class="col-lg-12 d-flex justify-content-center align-items-center p-3 ">
                            <svg xmlns="http://www.w3.org/2000/svg" width="200" height="160" fill="currentColor"
                                class="bi bi-people" viewBox="0 0 16 16">
                                <path
                                    d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002-.014.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5 3-5 4q0 1 1 1h4.216A2.24 2.24 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.5 5.5 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4" />
                            </svg>
                        </div>
                        <div class="col-12">
                            <div class="card-body">
                                <div class="d-block justify-content"></div>
                                <div class="row">
                                    <div class="col-12 mx-auto">
                                        <a href="users" class="btn btn-sm btn-primary w-100"> Manage Users
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2 g-8 mx-auto">
                <div class="card mb-3 mx-auto shadow-sm" style="max-width: 540px;">
                    <div class="row-12">
                        <div class="col-lg-12 d-flex justify-content-center align-items-center p-3 ">
                            <svg xmlns="http://www.w3.org/2000/svg" width="200" height="160" fill="currentColor"
                                class="bi bi-shield-lock-fill" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M8 0c-.69 0-1.843.265-2.928.56-1.11.3-2.229.655-2.887.87a1.54 1.54 0 0 0-1.044 1.262c-.596 4.477.787 7.795 2.465 9.99a11.8 11.8 0 0 0 2.517 2.453c.386.273.744.482 1.048.625.28.132.581.24.829.24s.548-.108.829-.24a7 7 0 0 0 1.048-.625 11.8 11.8 0 0 0 2.517-2.453c1.678-2.195 3.061-5.513 2.465-9.99a1.54 1.54 0 0 0-1.044-1.263 63 63 0 0 0-2.887-.87C9.843.266 8.69 0 8 0m0 5a1.5 1.5 0 0 1 .5 2.915l.385 1.99a.5.5 0 0 1-.491.595h-.788a.5.5 0 0 1-.49-.595l.384-1.99A1.5 1.5 0 0 1 8 5" />
                            </svg>
                        </div>
                        <div class="col-12">
                            <div class="card-body">
                                <div class="d-block justify-content"></div>
                                <div class="row">
                                    <div class="col-12 mx-auto">
                                        <a href="admins" class="btn btn-sm btn-primary w-100"> Manage Admins
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2 g-8 mx-auto">
                <div class="card mb-3 mx-auto shadow-sm" style="max-width: 540px;">
                    <div class="row-12">
                        <div class="col-lg-12 d-flex justify-content-center align-items-center p-3 ">
                            <svg xmlns="http://www.w3.org/2000/svg" width="200" height="160" fill="currentColor"
                                class="bi bi-cash-coin" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8m5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0" />
                                <path
                                    d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195z" />
                                <path
                                    d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083q.088-.517.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1z" />
                                <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 6 6 0 0 1 3.13-1.567" />
                            </svg>
                        </div>
                        <div class="col-12">
                            <div class="card-body">
                                <div class="d-block justify-content"></div>
                                <div class="row">
                                    <div class="col-12 mx-auto">
                                        <a class="btn btn-sm btn-primary w-100"> Manage Order
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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