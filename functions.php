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
    $query = "DELETE FROM movies WHERE `movies`.`id` = $id";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function addMov($data){
    global $conn;
    $title = htmlspecialchars($data['title']);
    $year = htmlspecialchars($data['year']);
    $genre = htmlspecialchars($data['genre']);
    $runtime = htmlspecialchars($data['runtime']);

    $poster = upload();
    if( !$poster ){
        return false;
    }

    $query = "INSERT INTO movies 
        VALUES
        ('', '$title', $year, '$genre', '$runtime', '$poster')";

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

    $query = "UPDATE movies SET 
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
    $query = "SELECT * FROM movies WHERE title LIKE '%$keyword%'
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

function checkLogin(){
    if(isset($_COOKIE["key"])){
        checkCookie($_COOKIE["key"], $_COOKIE["id"]);
    }

    if(!isset($_SESSION["login"])){
        header("Location: login.php");
        exit;
    } 
}

function checkCookie($key, $id){
    global $conn;

    $result = mysqli_query($conn, "SELECT * FROM users WHERE id = $id");
    $row = mysqli_fetch_assoc($result);


    if($key === hash("sha256", $row["username"])){
        $_SESSION["login"] = true;
    } 
    else {
        unset($_SESSION["login"]);
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
                setcookie("key", hash("sha256", $username), time() + 60 * 60 * 24);
                setcookie("id", $row["id"], time() + 60 * 60 * 24);
            }
            $_SESSION["login"] = true;
        }
        
        checkLogin();
        return true;
    }
}
?>