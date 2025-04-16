<?php
    include("connection.php");

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        
         // First delete from trans table (foreign key reference)
        $sql2 = "DELETE FROM trans WHERE insid = '$id'";
        mysqli_query($conn, $sql2);

        // Then delete from insectmaster table
        $sql1 = "DELETE FROM insectmaster WHERE id = '$id'";
        mysqli_query($conn, $sql1);

        // Redirect back to home page
        header("Location: home_page.php");
        exit();
    }

    mysqli_close($conn);
        
?>