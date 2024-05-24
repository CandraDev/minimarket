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

function deleteMov($id){
    global $conn;
    $query = "DELETE FROM products WHERE `movies`.`id` = $id";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function addMov($data){
    global $conn;
    $prdName = htmlspecialchars($data['prd-nama']);
    $prdPrice = htmlspecialchars($data['prd-harga']);
    $genre = htmlspecialchars($data['prd-kategori']);

    $thumb = upload();
    if( !$thumb ){
        return false;
    }

    $query = "INSERT INTO products 
        VALUES
        ('', '$prdName', $prdPrice, '$genre', '$thumb')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}


function updateMov($data){
    global $conn;
    $id = $data['id'];
    $title = htmlspecialchars($data['title']);
    $year = htmlspecialchars($data['year']);
    $genre = htmlspecialchars($data['genre']);
    $runtime = htmlspecialchars($data['runtime']);
    $oldPoster = htmlspecialchars($data['oldPoster']);
    
    if($_FILES['poster']['error'] === 4){
        $poster = $oldPoster;
    } else {
        $poster = upload();
    }

    $query = "UPDATE products SET 
                title = '$title', 
                year = $year,
                genre = '$genre',
                runtime = '$runtime',
                poster = '$poster'
                WHERE id = $id
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
    
    $fileName = $_FILES['poster']['name'];
    $fileSize = $_FILES['poster']['size'];
    $error = $_FILES['poster']['error'];
    $tmpName = $_FILES['poster']['tmp_name'];
    
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
    move_uploaded_file($tmpName, 'img/' . $newFileName);
    return $newFileName;
}

function searchMov($keyword) {
    $query = "SELECT * FROM products WHERE title LIKE '%$keyword%'
                OR year LIKE '%$keyword%' 
                OR genre LIKE '%$keyword%'";
        
    return query($query);
}


function userRegist($data){
    global $conn;
    $username = strtolower(stripslashes($data['username']));
    $password = mysqli_real_escape_string($conn, $data['password']);
    $password2 = mysqli_real_escape_string($conn, $data['password2']);

    $result = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");

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
    mysqli_query($conn, "INSERT INTO users VALUES ('', '$username', '$password')");

    return mysqli_affected_rows($conn);
}

function checkAdminLogin(){
    if(!isset($_SESSION["adm-login"])){
        header("Location: login.php");
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

    $row = mysqli_fetch_assoc($result);

    if(mysqli_num_rows($result) === 1){
        if(password_verify($password, $row["password"])){
            if(isset($data["remember"])){
                setcookie("key", hash("sha256", $username), time() + 60 * 60 * 24, "/");
                setcookie("id", $row["id"], time() + 60 * 60 * 24, "/");
            }
            $_SESSION["user-login"] = true;
        }
        
        checkCookie();
        return true;
    }
}
?>