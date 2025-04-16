<?php

    include("connection.php");

    if (isset($_GET['cid'])) {
        $cid = $_GET['cid'];

        // Check if this category is assigned to any insects
        $check_sql = "SELECT * FROM trans WHERE cid = '$cid'";
        $check_result = mysqli_query($conn, $check_sql);

        if (mysqli_num_rows($check_result) > 0) {
            // Redirect back with error message
            header("Location: category.php?error=Category+cannot+be+deleted+as+it+is+assigned+to+insects");
            exit();
        }

        // If no insects are linked, delete the category
        $sql1 = "DELETE FROM catmaster WHERE cid = '$cid'";
        mysqli_query($conn, $sql1);

        header("Location: category.php?success=Category+deleted+successfully");
        exit();
    }

    mysqli_close($conn);

?>