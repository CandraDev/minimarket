<?php
require 'functions.php';
checkLogin();


$id = $_GET['id'];

if(deleteMov($id) > 0){
    echo "
    <script>
        alert('Movie has successfully deleted!');
        document.location.href = 'index.php';
    </script>
    ";
} else {
    echo "
    <script>
        alert('Data has failed to be deteled!');
        document.location.href = 'index.php';
    </script>
    ";
}

?>