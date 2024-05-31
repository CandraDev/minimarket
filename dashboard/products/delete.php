<?php
 require '../../system/functions.php';
 session_start();
 checkAdminLogin("../index.php");


$id = $_GET['id'];

if(deleteProduct($id) > 0){
    echo "
    <script>
        alert('Product has successfully deleted!');
        document.location.href = '../index.php';
    </script>
    ";
} else {
    echo "
    <script>
        alert('Data has failed to be deteled!');
        document.location.href = '../index.php';
    </script>
    ";
}

?>