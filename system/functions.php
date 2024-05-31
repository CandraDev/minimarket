<?php
// connect to database
$conn = mysqli_connect("localhost", "root", "", "minimarket");

function query($query){
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

function deleteProduct($id){
    global $conn;
    $query = "DELETE FROM products WHERE `products`.`id` = $id";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function addProduct($data){
    global $conn;
    $prdName = htmlspecialchars($data['prd-nama']);
    $prdPrice = htmlspecialchars($data['prd-harga']);
    $prdCategory = htmlspecialchars($data['prd-kategori']);
    $prdDetails = htmlspecialchars($data['prd-details']);

    $thumb = upload();
    if( !$thumb ){
        return false;
    }

    $query = "INSERT INTO products 
        VALUES
        ('', '$prdName', $prdPrice, '$prdCategory', '$thumb', '$prdDetails')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}


function updateProduct($data){
    global $conn;
    $id = $data['id'];
    $prdName = htmlspecialchars($data['prd-nama']);
    $prdPrice = htmlspecialchars($data['prd-harga']);
    $prdCategory = htmlspecialchars($data['prd-kategori']);
    $prdDetails = htmlspecialchars($data['prd-details']);
    $oldThumb = htmlspecialchars($data['thumb']);
    
    if($_FILES['prd-thumb']['error'] === 4){
        $thumb = $oldThumb;
    } else {
        $thumb = upload();
    }

    $query = "UPDATE `products` SET 
                `prd-nama` = '$prdName', 
                `prd-harga` = '$prdPrice',
                `prd-kategori` = '$prdCategory',
                `prd-thumb` = '$thumb',
                `prd-details` = '$prdDetails'
                WHERE id = '$id'
            ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function upload() {

    // [filename] => Array
    // (
    //     [name] => MyFile.jpg
    //     [type] => image/jpeg
    //     [tmp_name] => /tmp/php/php6hst32
    //     [error] => UPLOAD_ERR_OK
    //     [size] => 98174
    // )
    
    $fileName = $_FILES['prd-thumb']['name'];
    $fileSize = $_FILES['prd-thumb']['size'];
    $error = $_FILES['prd-thumb']['error'];
    $tmpName = $_FILES['prd-thumb']['tmp_name'];
    
    if( $error === 4 ){
        echo "<script>
            alert('Choose a file first!');
            </script>";
    }
    $validExtension = ['jpg', 'jpeg', 'png'];
    $fileExtension = strtolower(end(explode(".", $fileName)));
    if(!in_array($fileExtension, $validExtension)){
        echo "<script>
        alert('Choosen file is not a picture!');
        </script>";
        return false;
    }
    if($fileSize > 1000000){
        echo "<script>
        alert('Choosen file is too big!');
        </script>";
        return false;
    }
    $newFileName = uniqid() . "." . $fileExtension;
    move_uploaded_file($tmpName, '../../img/' . $newFileName);
    return $newFileName;
}

function searchProducts($keyword) {
    global $conn;

    $query = "SELECT * FROM `products` WHERE `prd-nama` LIKE '%$keyword%'
                OR `prd-kategori` LIKE '%$keyword%'";
        
    return query($query);
}

function orderProduct($data){
    global $conn;

    $username = $data['username'];
    $prdName = $data['prd-nama'];
    $prdPrice = $data['prd-harga'];
    $prdQty = $data['ord-qty'];
    $ordAddress = $data['ord-address'];
    $prdPrice *= $prdQty;

    $query = "INSERT INTO `orders` 
        VALUES
        ('', '$prdName', $prdQty, '$username', '$ordAddress', $prdPrice, 'UNPAID')";
    
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function payProduct($data){
    global $conn;

    $id = $data['id'];

    $query = "UPDATE `orders` SET
                `ord-status` = 'PAID'
                WHERE `ord-id` = $id
            ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}


function userRegist($data){
    global $conn;
    $username = strtolower(stripslashes($data['username']));
    $password = mysqli_real_escape_string($conn, $data['password']);
    $password2 = mysqli_real_escape_string($conn, $data['password2']);
    $email = strtolower(stripslashes($data['email']));

    $result = mysqli_query($conn, "SELECT `username` FROM `users` WHERE `username` = '$username'");

    if(mysqli_fetch_assoc($result)){
        echo "
            <script>
                alert('Username already exist');
            </script>
        ";
        return false;
    }
    
    if ($password !== $password2) {
        echo "<script>
            alert('Confirmation password is invalid!');
        </script>";
        return false;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);
    mysqli_query($conn, "INSERT INTO users VALUES ('', '$username', '$password', '$email')");

    return mysqli_affected_rows($conn);
}

function checkAdminLogin($url){
    if(!isset($_SESSION["adm-login"])){
        header("Location: $url");
        exit;
    } 
}

function checkUserLogin($url){
    if(!isset($_SESSION["user-login"])){
        header("Location: $url");
        exit;
    } 
}

function checkCookie(){
    global $conn;

    if(!isset($_COOKIE['id']) || !isset($_COOKIE['key'])){
        return false;
    }
    $id = $_COOKIE['id'];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE id = $id");
    $row = mysqli_fetch_assoc($result);
    
    if ($_COOKIE['key'] === hash("sha256", $row["username"])){
        $_SESSION["user-login"] = true;
    }  else {
        unset($_SESSION["user-login"]);
        header("Location: ../index.php");
    }
}


function userLogin($data){
    global $conn;

    $username = strtolower($data["username"]);
    $password = $data["password"];


    $result = mysqli_query($conn, "SELECT * FROM users where username = '$username'");

    if(!$result) {
        return false;
    }

    $row = mysqli_fetch_assoc($result);

    if(mysqli_num_rows($result) === 1){
        if(password_verify($password, $row["password"])){
            if(isset($data["remember"])){
                setcookie("key", hash("sha256", $username), time() + 60 * 60 * 24, "/");
                setcookie("id", $row["id"], time() + 60 * 60 * 24, "/");
            }
            $_SESSION["user-login"] = true;
            $_SESSION["username"] = $username;
        }
        
        checkCookie();
        return true;
    } else {
        return false;
    }
}

function adminLogin($data){
    global $conn;

    $username = strtolower($data["adm-name"]);
    $password = $data["adm-pass"];


    $result = mysqli_query($conn, "SELECT * FROM `admins` WHERE `adm-name` = '$username' ");

    if(!$result) {
        return false;
    }

    $row = mysqli_fetch_assoc($result);

    if(mysqli_num_rows($result) === 1){
        if(password_verify($password, $row["adm-pass"])){
            $_SESSION["adm-login"] = true;
            return true;
        } else {
            return false;
        }
    }  else {
        return false;
    }
}
?>