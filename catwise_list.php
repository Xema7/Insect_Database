<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="catwise_list.css">
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
        include("connection.php");
    
    $category = $_GET['catid'];
    $cname = $_GET['cname'];


    //get insid to use in sql4 query
    $sql3 = "SELECT insid FROM trans WHERE cid = '$category'";
        $result3 = mysqli_query($conn, $sql3);


            if(mysqli_num_rows($result3) > 0){
                while($row3 = mysqli_fetch_assoc($result3)){
                $ins_id[] = $row3["insid"];
                }
                if(count($ins_id) > 0){
                    $ins_id_string = implode(",", $ins_id);
                }
                
    //get specific catagroy insects list     
    $sql4 = "SELECT * FROM insectmaster WHERE id IN ($ins_id_string)";
        $result4 = mysqli_query($conn, $sql4);
                if(mysqli_num_rows($result4) > 0){
                    echo "<div class='table-div'>
                          <table>
                          <tr class='thead'>
                          <td>Insect Image</td>
                          <td>Full Name</td>
                          <td>Short Name</td>
                          <td>Operations</td>
                          </tr>";
                while($row4 = mysqli_fetch_assoc($result4)){
                    echo "<tr>
                          <td><img src='".$row4['photo']."' style='width: 20px; height: 20px;'></td>
                          <td><a class='scientficname' href='info.php?id=$row4[id]&cn=$cname'>".$row4['scientificName']."</a></td>
                          <td>".$row4['name']."</td>
                          <td><a class='link' href='edit.php?insectdata=$row4[id]'>Update</a>
                          <button class='delete_btn' onclick='confirmDelete({$row4['id']})'>Delete</button></td>
                          </tr>";
                }
            }
            echo "</table> </div>";
        }else {
            echo "<p style='text-align: center; font-weight: bold; color: red;'>No insect records found.</p>";
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
            function confirmDelete(id){
                deleteId = id;

                document.getElementById('confirmBox').style.display = 'flex';
            }
            function closePopup(){
                document.getElementById('confirmBox').style.display = 'none';
                deleteId = null;
            }

            function deleteRow(){
                if(deleteId !== null){
                    window.location.href = `delete.php?id=${deleteId}`;
                }
            }
        </script>
</body>
</html>