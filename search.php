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
        <form method="GET" class="searchform">
            <input type="text" name="searchbox" placeholder="Search" required>
            <button type="submit" name="search">Search</button>
        </form>
    </nav>
    <div class="main">


<!-- ---------------------------------------------------------------------------------------------------------- -->

<?php
    if(isset($_GET['searchbox'])){
        $searchbox = $_GET['searchbox'];
    
    
    $sql2 = "SELECT catmaster.cname AS cname FROM catmaster JOIN trans ON catmaster.cid = trans.cid 
            JOIN insectmaster ON trans.insid = insectmaster.id WHERE scientificName LIKE '%$searchbox%' OR name LIKE '%$searchbox%'";
    $result2 = mysqli_query($conn,$sql2);
    $row2 = mysqli_fetch_assoc($result2);
    if(mysqli_num_rows($result2) > 0){
            $cn = $row2['cname'];
}

    $sql = "SELECT * FROM insectmaster WHERE scientificName LIKE '%$searchbox%' OR name LIKE '%$searchbox%'";
    $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_assoc($result);
            $insId = $row['id']; 
            header("location:info.php?id=$insId&&cn=$cn");
        }else{
            header("Location: list.php?searchbox=$searchbox");
        }

    }

?>

<!-- ---------------------------------------------------------------------------------------------------------- -->
</div>
        <footer>
            <p>&copy; 2025 Insect DB. All rights reserved.</p>
        </footer>
</body>
</html>