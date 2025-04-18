<?php
    include("connection.php");

    //get insect data from home page to update page
    $insdata = $_GET['insectdata']; 
    $sql1 = "SELECT * FROM insectmaster WHERE id = '$insdata'";
    $result1 = mysqli_query($conn,$sql1);
    $total1 = mysqli_num_rows($result1);
    $row1 = mysqli_fetch_assoc($result1); 

    //get insect category to update page
    $sql2 = "SELECT catmaster.cname AS cn,catmaster.cid AS ci FROM catmaster 
             JOIN trans ON catmaster.cid = trans.cid WHERE trans.insid = '$insdata'";
    $result2 = mysqli_query($conn,$sql2);
    $total2 = mysqli_num_rows($result2);
    $row2 = mysqli_fetch_assoc($result2);
    
?>

<!-- ---------------------------------------------------------------------------------------------------------- -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
    <link rel="stylesheet" href="edit.css">
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

    <form class="form" method="post" action="#" enctype="multipart/form-data">
<!-- Insect data updation form -->
        <h1>Edit Insect</h1>
        <label>Insect Image: </label>
        <input type="file" id="photo" name="photo" accept="image/*" value="<?php echo $row1['photo']?>"><br><br>
        <input type="hidden" name="id" value="<?php echo $row1['id'] ?>">
        <label>Name:</label>
        <input type="text" name="change_sciname" value = "<?php echo $row1['scientificName']?>" ><br><br>
        <label>Short Name:</label>
        <input type="text" name="change_name" value = "<?php echo $row1['name']?>" ><br><br>
        <label>Description: </label>
        <textarea name="desc"><?php echo $row1['description']?></textarea><br><br>
        <label>Category:</label>

<!-- ---------------------------------------------------------------------------------------------------------- -->

<?php
//auto generating catagroy dropdown to update insect category
    $sql4 = "SELECT cname,cid FROM catmaster";
    $result4 = mysqli_query($conn,$sql4);
    if(mysqli_num_rows($result4) > 0){
        echo "<select name='change_catname'>
                <option value='";
        echo $row2['ci'];
        echo "'>".$row2['cn']."</option>";
        
        while($row4 = mysqli_fetch_assoc($result4)){
            if(count($row4) > 0){
                $cnstring = implode("," , $row4);
            }
            echo"<option value='".$row4['cid']."'>".$row4['cname']."</option>";
        }
        echo "</select><br><br> ";
    } 
?>

<!-- ---------------------------------------------------------------------------------------------------------- -->

    <button type="submit" name="edit">Edit Insect Data</button>


    </form>

    <footer>
            <p>&copy; 2025 Insect DB. All rights reserved.</p>
        </footer>
</body>
</html>

<!-- ---------------------------------------------------------------------------------------------------------- -->

<?php

    if(isset($_POST["edit"])){
        $id = $_POST['id'];
        $sciname = $_POST['change_sciname'];
        $name = $_POST['change_name'];
        $cat = $_POST['change_catname'];
        $desc = $_POST['desc'];

        if (!empty($_FILES["photo"]["name"])) {
            $filename = $_FILES["photo"]["name"];
            $tempname = $_FILES["photo"]["tmp_name"];
            $imagefolder = "image/".$filename;
            move_uploaded_file($tempname, $imagefolder);
            // Update image field
            $sql6 = "UPDATE insectmaster SET photo = '$imagefolder' WHERE id = '$id'";
            mysqli_query($conn, $sql6);
        }
                
        //Query to update regular insect data
        $sql6 = "UPDATE insectmaster SET scientificName = '$sciname', name = '$name',  description='$desc' WHERE id = '$id'";
            if($result6 = mysqli_query($conn, $sql6)){
                echo "Insect record updated successfully.";
            }        
        
        //Query to update selected insect's category name
        $sql7 = "UPDATE trans SET cid = '$cat' WHERE insid = '$id'";
            if($result7 = mysqli_query($conn,$sql7)){
                echo "Insect record updated successfully.";
            } 
        
    }

?>