<?php
// connect to database

class Database {
    public $hostname = "localhost";
    public $username = "root";
    public $password = "";
    public $database = "minimarket";
    public $conn;

    public function __construct() {
        $this->conn = mysqli_connect($this->hostname, $this->username, $this->password, $this->database);
        if (!$this->conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }

    public function query($query){
        $result = mysqli_query($this->conn, $query);
        $rows = [];
        while($row = mysqli_fetch_assoc($result)){
            $rows[] = $row;
        }
        return $rows;
    }
}

$database = new Database();

class productMenu extends Database {
    function searchProducts($keyword) {
    
        $query = "SELECT * FROM `products` WHERE `prd-nama` LIKE '%$keyword%'
                    OR `prd-kategori` LIKE '%$keyword%'";
            
        return $this->query($query);
    }

    function deleteProduct($id){
        $query = "DELETE FROM products WHERE `products`.`id` = $id";
        mysqli_query($this->conn, $query);
        return mysqli_affected_rows($this->conn);
    }
    
    function addProduct($data){
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
    
        mysqli_query($this->conn, $query);
    
        return mysqli_affected_rows($this->conn);
    }
    
    function updateProduct($data){
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

        mysqli_query($this->conn, $query);

        return mysqli_affected_rows($this->conn);
    }

    function orderProduct($data){
        $username = $data['username'];
        $prdName = $data['prd-nama'];
        $prdPrice = $data['prd-harga'];
        $prdQty = $data['ord-qty'];
        $ordAddress = $data['ord-address'];
        $prdPrice *= $prdQty;
    
        $query = "INSERT INTO `orders` 
            VALUES
            ('', '$prdName', $prdQty, '$username', '$ordAddress', $prdPrice, 'UNPAID')";
        
        mysqli_query($this->conn, $query);
    
        return mysqli_affected_rows($this->conn);
    }

    function payProduct($data){
    
        $id = $data['id'];
    
        $query = "UPDATE `orders` SET
                    `ord-status` = 'PAID'
                    WHERE `ord-id` = $id
                ";
    
        mysqli_query($this->conn, $query);
    
        return mysqli_affected_rows($this->conn);
    }
    
}

$productMenu = new productMenu();


function upload() {
    
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


class userMenu extends Database {
    function userRegist($data){
        $username = strtolower(stripslashes($data['username']));
        $password = mysqli_real_escape_string($this->conn, $data['password']);
        $password2 = mysqli_real_escape_string($this->conn, $data['password2']);
        $email = strtolower(stripslashes($data['email']));
    
        $result = mysqli_query($this->conn, "SELECT `username` FROM `users` WHERE `username` = '$username'");
    
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
        mysqli_query($this->conn, "INSERT INTO users VALUES ('', '$username', '$password', '$email')");
    
        return mysqli_affected_rows($this->conn);
    }
    
    function checkUserLogin($url){
        if(!isset($_SESSION["user-login"])){
            header("Location: $url");
            exit;
        } 
    }

    function userLogin($data){
    
        $username = strtolower($data["username"]);
        $password = $data["password"];
    
    
        $result = mysqli_query($this->conn, "SELECT * FROM users WHERE username = '$username'");
    
        if(!$result) {
            return false;
        }
    
        $row = mysqli_fetch_assoc($result);
    
        if(mysqli_num_rows($result) === 1){
            if(password_verify($password, $row["password"])){
                $_SESSION["user-login"] = true;
                $_SESSION["username"] = $username;
                if(isset($data["remember"])){
                    setcookie("key", hash("sha256", $username), time() + 60 * 60 * 24, "/");
                    setcookie("id", $row["id"], time() + 60 * 60 * 24, "/");
                    setcookie("username", $username, time() + 60 * 60 * 24, "/");
                }
            }
            
            checkCookie();
            return true;
        } else {
            return false;
        }
    }
}

$userMenu = new userMenu();

class adminMenu extends Database {
    function adminLogin($data){
    
        $username = strtolower($data["adm-name"]);
        $password = $data["adm-pass"];
    
    
        $result = mysqli_query($this->conn, "SELECT * FROM `admins` WHERE `adm-name` = '$username' ");
    
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
    function checkAdminLogin($url){
        if(!isset($_SESSION["adm-login"])){
            header("Location: $url");
            exit;
        } 
    }
}

$adminMenu = new adminMenu();





function checkCookie(){
    global $database;

    if(!isset($_COOKIE['id']) || !isset($_COOKIE['key'])){
        return false;
    }
    $id = $_COOKIE['id'];

    $result = mysqli_query($database->conn, "SELECT * FROM users WHERE id = $id");
    $row = mysqli_fetch_assoc($result);
    
    if ($_COOKIE['key'] === hash("sha256", $row["username"])){
        $_SESSION["user-login"] = true;
        $_SERVER['username'] = $_COOKIE['username'];
    }  else {
        unset($_SESSION["user-login"]);
        header("Location: ../index.php");
    }
}




?>