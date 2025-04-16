<?php
    include("connection.php");
    
    //get category data from category page to update page
    $catdata = $_GET['categorydata']; 
    $sql1 = "SELECT * FROM catmaster WHERE cid = '$catdata'";
    $result1 = mysqli_query($conn,$sql1);
    $total1 = mysqli_num_rows($result1);
    $row1 = mysqli_fetch_assoc($result1);
    
?>

<!-- ---------------------------------------------------------------------------------------------------------- -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Category</title>
    <link rel="stylesheet" href="edit_category.css">
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

    <form class="form" method = "post" action="#">
    <h1>Edit Category</h1>
        <label>Current Category Name: </label>

<!-- ---------------------------------------------------------------------------------------------------------- -->

<?php
//current category name
    $sql3 = "SELECT cid,cname FROM catmaster";
    $result3 = mysqli_query($conn,$sql3);
    if(mysqli_num_rows($result3) > 0){
       
        echo "$row1[cname]";
        
    } 
?><br><br>

<!-- ---------------------------------------------------------------------------------------------------------- -->

        <label>New Category Name:</label>
        <input type="text" name="new_cname"><br><br>
        <button type="submit" name="edit_catname">Edit Category</button>
    </form>

        <footer>
            <p>&copy; 2025 Insect DB. All rights reserved.</p>
        </footer>
</body>
</html>

<!-- ---------------------------------------------------------------------------------------------------------- -->

<?php

    if(isset($_POST['edit_catname'])){
        $new_cat = $_POST['new_cname'];
        $curr_cid = $row1['cid'];

        echo $sql4 = "UPDATE catmaster SET cname = '$new_cat' WHERE cid = '$curr_cid'";
        if($result4 = mysqli_query($conn,$sql4)){
            echo "Catagroy name changed";
        }
    }
?>