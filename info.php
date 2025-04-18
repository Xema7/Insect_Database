<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="info.css">
</head>
<body>
<nav>
        <div class="logo">
            <a href="home_page.php">Insect DB</a>
        </div>
        <ul class="list">
            <li>
                <a href="home_page.php">Home</a>
            </li>
            <li>
                <a href="category.php">Category</a>
            </li>
            <li>
                <a href="add.php" name="add_insect">Add New Insect</a>
            </li>
        </ul>
        <form method="GET" action="search.php" class="searchform">
            <input type="text" name="searchbox" placeholder="Search" required>
            <button type="submit" name="search">Search</button>
        </form>
    </nav>
<div class="main">
    

<?php 
    include("connection.php");
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $cn = $_GET['cn'];

$sql = "SELECT * FROM insectmaster WHERE id = '$id'";
$result = mysqli_query($conn, $sql);
    if($result && mysqli_num_rows( $result) === 1){
        $row = mysqli_fetch_assoc($result);
        
        echo "<div class='info-div'>
              <img class='img' src = '$row[photo]' ><br>
              <div class='content'>
              <h1 class='name'>$row[scientificName]</h1><br>
              <p class ='sn' >Name: $row[name]</p><br>
              <p class ='cat' >Category: $cn</p><br>
              <p class = 'desc' >Description: $row[description]</p>
              </div>
              </div>";
    }else{
        echo "No Data";
    }

    }
    


?>
</div>
<footer>
            <p>&copy; 2025 Insect DB. All rights reserved.</p>
        </footer>
</body>
</html>