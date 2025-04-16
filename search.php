<?php
    include("connection.php");
?>

<!-- ---------------------------------------------------------------------------------------------------------- -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Specific Insert Data</title>
    <link rel="stylesheet" href="search.css">
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
            <input type="text" name="searchbox" required>
            <button type="submit" name="search">Search</button>
        </form>
    </nav>


<!-- ---------------------------------------------------------------------------------------------------------- -->

<?php

    if(isset($_GET['searchbox'])){
        $searchbox = $_GET['searchbox'];

    
    
    $sql2 = "SELECT catmaster.cname AS cname FROM catmaster JOIN trans ON catmaster.cid = trans.cid 
            JOIN insectmaster ON trans.insid = insectmaster.id WHERE scientificName LIKE '%$searchbox' OR name LIKE '%$searchbox'";
    $result2 = mysqli_query($conn,$sql2);
    $row2 = mysqli_fetch_assoc($result2);
    if(mysqli_num_rows($result2) > 0){
            $cn = $row2['cname'];
}

    $sql = "SELECT * FROM insectmaster WHERE scientificName = '$searchbox' OR name = '$searchbox'";
    $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows( $result) > 0){
            echo "<div class='info-div'>";

            while($row = mysqli_fetch_assoc($result)){
                echo "<img class='img' src = '$row[photo]' ><br>
                    <div class='content'>
                     <h1 class='name'>$row[scientificName]</h1><br>
                      <p class ='sn' >Short Name: $row[name]</p><br>
                      <p class ='cat' >Category: $cn</p><br>
                      
                      <p class = 'desc' >Description: $row[description]</p>
                      </div>";
            }
        }else{
            echo "No Data";
        }
        echo "</div>";
    }

?>

<!-- ---------------------------------------------------------------------------------------------------------- -->

<footer>
            <p>&copy; 2025 Insect DB. All rights reserved.</p>
        </footer>
</body>
</html>