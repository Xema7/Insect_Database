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
    <title>Home Page</title>
    <link rel="stylesheet" href="home_page.css">
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

    <div class="main">

<!-- ---------------------------------------------------------------------------------------------------------- -->

<?php

    //get whole insects table
    $sql1 = "SELECT * FROM insectmaster";
    $result1 = mysqli_query($conn, $sql1);
            if(mysqli_num_rows($result1) > 0){
                echo "<div class='table-div'>
                <table>
                <tr class='thead'>
                <td style='width: 7%;'>Insect Image</td>
                <td style='width: 20%;'>Full Name</td>
                <td style='width: 20%;'>Short Name</td>
                <td style='width: 20%;'>Category</td>
                <td style='width: 8%;'>Operations</td>
                </tr>";
            while($row1 = mysqli_fetch_assoc($result1)){

                $sql2 = "SELECT cname FROM catmaster JOIN trans ON catmaster.cid = trans.cid 
                            WHERE trans.insid = '$row1[id]'";
                $result2 = mysqli_query($conn,$sql2);
                    if(mysqli_num_rows($result2) > 0){
                        while($row2 = mysqli_fetch_assoc($result2)){                
                
                    echo "<tr>
                      <td><img src='".$row1['photo']."' style='width: 100px; height: 100px;'></td>
                      <td>".$row1['scientificName']."</td>
                      <td>".$row1['name']."</td>
                      <td>".$row2['cname']."</td>
                      <td><a class='link' href='edit.php?insectdata=$row1[id]'>Update</a>
                      <button class='delete_btn' onclick='confirmDelete({$row1['id']})'>Delete</button></td>
                      </tr>";
                    }
                }
            }
            echo "</table> </div>";
        }
?>
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
                    // window.location.href = 'delete.php?insectdata=$row1[id]';
                }
            }
        </script>
</body>
</html>
<?php 
    
    mysqli_close($conn);

?>
    





