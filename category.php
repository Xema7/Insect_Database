<?php
   include("connection.php");
?>

<!-- ---------------------------------------------------------------------------------------------------------- -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category</title>
    <link rel="stylesheet" href="category.css">
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

<!-- ---------------------------------------------------------------------------------------------------------- -->

    <?php
    if (isset($_GET['error'])) {
        echo "<p style='color:red; text-align:center; font-weight:bold;'>".htmlspecialchars($_GET['error'])."</p>";
    }
    if (isset($_GET['success'])) {
        echo "<p style='color:green; text-align:center; font-weight:bold;'>".htmlspecialchars($_GET['success'])."</p>";
    }

    $sql = "SELECT * FROM catmaster";
    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result) > 0){
        echo "<div class='table-div'>
             <table >
              <tr>
              <td>Category Name</td>
              <td>Operation</td>
              </tr>";
        while($row = mysqli_fetch_assoc($result)){
            echo "<tr>
                  <td><a class='catname' href='catwise_list.php?catid=$row[cid]&cname=$row[cname]' name='catwise_list'>".$row['cname']."</a></td>
                  <td><a class='link' href = 'edit_category.php?categorydata=$row[cid]'>Update</a>
                  <button class='delete_btn' onclick = 'confirmDelete({$row['cid']})'>Delete</button></td>
                  </tr>";
        }
        echo "</table> </div>";
    }        

?>

<!-- ---------------------------------------------------------------------------------------------------------- -->

</div>
        <footer>
            <p>&copy; 2025 Insect DB. All rights reserved.</p>
        </footer>

        <div id="confirmBox" class="modal">
            <div class="modal-content">
                <form method="post">
                <p>Are you sure you want to delete this row?</p>
                <button type="button" onclick="deleteRow()">Yes</button>
                <button type="button" onclick="closePopup()">No</button>
            </div>
            </form>
        </div>

        <script>
            let deleteId = null;
            function confirmDelete(cid){
                deleteId = cid;

                document.getElementById('confirmBox').style.display = 'flex';
            }
            function closePopup(){
                document.getElementById('confirmBox').style.display = 'none';
                deleteId = null;
            }

            function deleteRow(){
                if(deleteId !== null){
                    window.location.href = `delete_cat.php?cid=${deleteId}`;
                   
                }
            }
        </script>
</body>
</html>

