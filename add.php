<?php

    include("connection.php");
?>

<!-- ---------------------------------------------------------------------------------------------------------- -->

<?php    
    $msg1 = "";
    $msg2 = "";

    if(isset($_POST["add"])){
        $sciname = $_POST['sciname'];
        $name = $_POST['name'];
        $catname = $_POST['catname'];
        $desc = $_POST['desc'];

        $filename = $_FILES["photo"]["name"];
        $tempname = $_FILES["photo"]["tmp_name"];
        $imagefolder = "image/".$filename;
        move_uploaded_file($tempname, $imagefolder);
        
        // insert insect data into insectmaster table
        $sql1 = "INSERT INTO insectmaster (photo,scientificName, name, description) VALUES ('$imagefolder','$sciname','$name','$desc')";
            $result1 = mysqli_query($conn, $sql1);
                if($result1){
                    $msg1 = "<p class='success'>Data inserted successfully.</p>";
                }else{
                    $msg1 = "<p class='error'>Data can not be inserted.</p>";
                }

        $sql4 = "INSERT INTO trans (insid,cid) VALUES ((SELECT id FROM insectmaster WHERE name = '$name'),
                 (SELECT cid FROM catmaster WHERE cname = '$catname'))";
            $result4 = mysqli_query($conn, $sql4);
                
    }

    if(isset($_POST["addcat"])){
        $cat = $_POST['cat'];

    // Query to create new category and add in catamaster table 
    $sql5 = "INSERT INTO catmaster (cname) VALUES ('$cat')";
        $result5 = mysqli_query($conn, $sql5);
            if($result5 == true){
                $msg2 = "<p class='success'>New category added successfully.</p>";
            }else{
                $msg2 = "<p class='error'>New category can not be inserted.</p>";
            }
    }

?>

<!-- ---------------------------------------------------------------------------------------------------------- -->
    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Form</title>
    <link rel="stylesheet" href="add.css">
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
    <div class="container">
    <form class="form1" method="post" action="#" enctype="multipart/form-data">
        <h1>Add New Insect</h1>
        <label>Insect Image: </label>
        <input type="file" id="photo" name="photo" accept="image/*" required><br><br>
        <label>Scientific Name: </label>
        <input type="text" name="sciname" required><br><br>
        <label>Name: </label>
        <input type="text" name="name" required><br><br>
        <label>Description: </label>
        <textarea name="desc"></textarea><br><br>
        <label>Category: </label>
        
<!-- ---------------------------------------------------------------------------------------------------------- -->

<?php
    //auto generating dropdown for catagroy in "add insect" section
    $sql = "SELECT cname FROM catmaster";
    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result) > 0){
        echo "<select name='catname'>
                <option value=''>Select Category</option>";
        while($row = mysqli_fetch_assoc($result)){
            if(count($row) > 0){
                $cnstring = implode("," , $row);
            }
            echo"<option value='".$row['cname']."'>".$row['cname']."</option>";
        }
        echo "</select>";
    } 
?>

<!-- ---------------------------------------------------------------------------------------------------------- -->

<br><br><button type="submit" name="add">Add Insect Data</button>
    <?php if (!empty($msg1)) echo $msg1; ?>
    </form><br><br>

    
<!-- From to create new category for insect in catmaster table -->
    <form class="form2" method="post" action="#">
        <h1>Add New Category</h1>
        <label>Category: </label>
        <input type="text" name="cat" required><br><br>

        <button type="submit" name="addcat">Add Category</button>
    </form>
    </div>
        <footer>
            <p>&copy; 2025 Insect DB. All rights reserved.</p>
        </footer>
</body>
</html>

<?php
    mysqli_close($conn);
?>