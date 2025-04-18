<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="list.css">
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

    if(isset($_GET['searchbox'])){
        $search = $_GET['searchbox'];

        $sql = "SELECT * FROM insectmaster WHERE scientificName LIKE '%$search%' OR
                name LIKE '%$search%'";
        $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0){
                echo "<div class='table-div'>
                <table>
                <tr class='thead'>
                <td>Image</td>
                <td>Full Name</td>
                <td>Short Name</td>
                <td>Category</td>
                </tr>";

                while($row = mysqli_fetch_assoc($result)){
                    $sql2 = "SELECT cname FROM catmaster JOIN trans ON catmaster.cid = trans.cid 
                            WHERE trans.insid = '$row[id]'";
                $result2 = mysqli_query($conn,$sql2);
                    if(mysqli_num_rows($result2) > 0){
                        while($row2 = mysqli_fetch_assoc($result2)){  
                    echo "<tr>
                      <td><img src='".$row['photo']."' style='width: 20px; height: 20px;'></td>
                      <td><a class='scientficname' href='info.php?id=$row[id]&cn=$row2[cname]'> ".$row['scientificName']."</a></td>
                      <td>".$row['name']."</td>
                      <td>".$row2['cname']."</td>
                      </tr>
                      ";
                     
                }
            }
            
    }echo "</table>
    </div>";
}
    }
?>

</div>
    <footer>
            <p>&copy; 2025 Insect DB. All rights reserved.</p>
        </footer>

</body>
</html>