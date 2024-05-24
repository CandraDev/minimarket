<?php

    require 'functions.php';
    session_start();
    checkLogin();

    if(isset($_POST["submit"])){

        if( addMov($_POST) > 0 ) {
            echo "
                <script>
                    alert('Movie has successfully added!');
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
    <title>My Movies List - Add Movie</title>
</head>
<body>
    <h1>Add a Movie</h1>
    <form action="" method="post" enctype="multipart/form-data">
            <ul>
                <li>
                    <label for="title">Title: </label>
                    <input required type="text" name="title" required>
                </li>
                <li>
                    <label for="year">Year: </label>
                    <input required type="number" name="year" required>
                </li>
                <li>
                    <label for="genre">Genre: </label>
                    <input required type="text" name="genre" required>
                </li>
                <li>
                    <label for="runtime">Runtime: </label>
                    <input required type="text" name="runtime" required>
                </li>
                <li>
                    <label for="poster">Poster: </label>
                    <input required type="file" name="poster" required>
                </li>
                <li>
                    <button type="submit" name="submit">Add Movie</button>
                </li>
            </ul>
    </form>
</body>
</html>