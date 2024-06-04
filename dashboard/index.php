<?php
 require '../system/functions.php';
 session_start();
 $adminMenu->checkAdminLogin("login.php");

$products = $database->query("SELECT * FROM `products`");

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Klik Indomaret</title>
    <link rel="shortcut icon" href="../assets/ui/Untitled.ico" type="image/x-icon">
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
        
        <style>
            nav{
                background: url(../assets/ui/bg_header.jpg);
                height: 50px;
            }
            .sidebar-heading{
                background: url(../assets/ui/bg_header.jpg);
            }
            .bg-1{
                background: url(../assets/ui/bg_header.jpg);
            }
        </style>
    </head>
    <body class="bg-light">
        <div class="d-flex " id="wrapper">
            <!-- Sidebar-->
            <div class="bg-white border-end" id="sidebar-wrapper">
                <div class="sidebar-heading border-bottom bg-warning text-white" style="height: 50px;"></div>
                <div class=" list-group list-group-flush">
                    <a class="list-group-item list-group-item-action list-group-item-light p-4" href="index.php"><h5><i class="bi bi-speedometer"></i> Dashboard</h5></a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-4 mt-3" href="admins.php"><h5><i class="bi bi-person-bounding-box"></i> Manage Admin</h5></a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-4 mt-3" href="users.php"><h5><i class="bi bi-people-fill"></i> Manage Users</h5></a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-4 mt-3" href="orders.php"><h5><i class="bi bi-bar-chart-fill"></i> Manage Orders</h5></a>
                </div>
            </div>
            <!-- Page content wrapper-->
            <div id="page-content-wrapper">
     <!-- Navbar -->
     <nav class="sb-topnav navbar navbar-expand navbar-dark bg-warning shadow-sm">
        <!-- Navbar Brand-->
        <button class="btn text-white mx-2" id="sidebarToggle"><h3><i class="bi bi-justify"></i></h3></button>
          <span class="navbar-brand">
            <img src="../assets/ui/logo.webp" style="width: 10rem;">
          </span>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <!-- <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="bi bi-search"></i></button>
            </div>
        </form> -->
        <!-- Navbar-->
        <div class="tab position-absolute top-25 end-0">
            <a href="../system/logout.php" title="Logout"
                        class="btn btn-light btn-outline-secondary me-2 shadow-sm">
                        <i class="bi bi-box-arrow-left"></i>
                    </a>
        <a href="#" title="profile" class="btn btn-light btn-outline-primary me-2 shadow-sm ">
            <i class="bi bi-person-circle"></i>
        </a>
        </div>
        
    </nav>
<!-- End Navbar -->
                <!-- Page content-->
                <div class="container-fluid">
                    <h1 class="mt-4">Dashboard</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                    <div class="card mx-5 ms-5 mt-5">
                        <div class="card-header text-center text-white bg-1">
                          <strong>Products</strong>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-hover text-center">
                                <thead>
                                  <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Produk</th>
                                    <th scope="col">Harga Produk</th>
                                    <th scope="col">Kategori Produk</th>
                                    <th scope="col">Aksi</th>
                                  </tr>
                                </thead>
                                <tbody>
                               <?php foreach($products as $prd) :?>
                                  <tr>
                                    <th scope="row"><?=$prd['id']?></th>
                                    <td><?=$prd['prd-nama']?></td>
                                    <td><?=$prd['prd-harga']?></td>
                                    <td><?=$prd['prd-kategori']?></td>
                                    <td><a href="products/update.php?id=<?=$prd['id']?>">Update</a> | <a href="products/delete.php?id=<?=$prd['id']?>">Hapus</a></td>
                                  </tr>
                                <?php endforeach; ?>
                                </tbody>
                              </table>  
                        </div>
                        <div class="add ms-3 mb-5"><a href="products/add.php">Tambah Produk</a></div>
                      </div>
                </div> 
            </div>
        </div>

        <footer class="footer bg-body text-center">
        <!-- Grid container -->
        <div class="container p-4 pb-0">
            <img src="../assets/ui/logo.webp" alt="" height="50px" class="mb-3">
            <!-- Section: Social media -->
            <section class="mb-4">
                <!-- Facebook -->
                <a data-mdb-ripple-init class="btn text-white btn-floating m-1" style="background-color: #3b5998;"
                    href="#!" role="button"><i class="bi bi-facebook"></i></a>

                <!-- Google -->
                <a data-mdb-ripple-init class="btn text-white btn-floating m-1" style="background-color: #dd4b39;"
                    href="#!" role="button"><i class="bi bi-google"></i></a>

                <!-- Instagram -->
                <a data-mdb-ripple-init class="btn text-white btn-floating m-1" style="background-color: #ac2bac;"
                    href="#!" role="button"><i class="bi bi-instagram"></i></a>

                <!-- Whatsapp -->
                <a data-mdb-ripple-init class="btn text-white btn-floating m-1" style="background-color: lime;"
                    href="#!" role="button"><i class="bi bi-whatsapp"></i></a>
            </section>
            <!-- Section: Social media -->
        </div>
        <!-- Grid container -->

        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);">
            © 2024 Copyright:
            <a class="text-body" href="index.html">Klik Indomaret</a>
        </div>
        <!-- Copyright -->
    </footer>
        
        
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <!-- <script src="js/scripts.js"></script> -->
    </body>
</html>
