<?php
 require 'system/functions.php';
 session_start();
 checkUserLogin("index.php");

 if(isset($_GET['id'])){
    $prdID = $_GET['id']; $prd = query("SELECT * FROM `products` WHERE id = $prdID")[0];
 } else {
    header("Location: index.php"); 
    exit;
 }


 if(isset($_POST["submit"])){

    if( addProduct($_POST) > 0 ) {
        echo "
            <script>
                alert('Product has successfully added!');
                document.location.href = 'index.php';
            </script>
            ";
    } else {
        echo "
            <script>
                alert('Data has failed to be added!');
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
            <a class="navbar-brand fw-bold" href="index.php"><img src="../../assets/ui/logo.webp" style="width: 7rem;"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
                aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav  me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../index.php">Dashboard</a>
                    </li>
                </ul>
                
                <div class="navbar-nav">
                    <a href="../logout.php" title="Logout"
                        class="btn btn-light btn-outline-secondary me-2 shadow-sm">
                        <i class="bi bi-box-arrow-left"></i>
                    </a>
                </div>
            </div>
        </div>
    </nav>
    <main class="container-fluid mt-5 p-5 bg-light pt-5 pb-5">
    <form action="" method="post" enctype="multipart/form-data">
            <h1 class="text-center m-5">Update Product</h1>
            <div class="row m-5">
                <div class="col">
                    <div class="row">
                        <label for="poster">Thumbnail: </label>
                            <br> <img src="../../img/<?=$prd['prd-thumb']?>" value="" alt="" class="w-50 mb-5"> <br>
                    </div>
                </div>
                <input type="hidden" name="id" value="<?=$prd['id'];?>">
                <input type="hidden" name="oldPoster" value="<?=$prd['prd-thumb'];?>">
                <div class="col">
                        <label for="prd-nama">Nama Produk: </label>
                        <input type="text" name="prd-nama" class="form-control"  required value="<?=$prd['prd-nama'];?>" >
                        <label for="prd-harga">Harga: </label>
                        <input type="number" min="0" name="prd-harga" class="form-control" required value="<?=$prd['prd-harga'];?>" >
                </div>
                <div class="col">
                        <label for="prd-kategori">Kategori Produk: </label>
                        <select name="prd-kategori" class="form-select" value="<?=$prd['prd-kategori']?>" >
                            <?php $category = query("SELECT * FROM categories"); foreach($category as $cat): ?>
                                <option value="<?=$cat["cat-name"]?>"><?=$cat["cat-name"]?></option>
                            <?php endforeach;?>
                        </select>
                        <label for="prd-details">Detail Produk: </label>
                        <input type="text" name="prd-details" class="form-control" required >
                </div>
                <div class="row mt-5">
                <button type="submit" class="btn btn-success" name="submit">Add Product</button>
                </div>
            </div>

        </form>
    </main>

    <footer class="footer bg-warning text-light text-center p-1">
        <div class="container">
            <h1 class="h3">Made with PHP</h1>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>