<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $catName = $conn->real_escape_string($_POST['catName']);
    $dateCreated = date("Y-m-d H:i:s");

    $sql = "INSERT INTO menucategory (catName, dateCreated) VALUES ('$catName', '$dateCreated')";

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Category added successfully."); window.location.href="admin_menu.php";</script>';
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();

    header("Location: admin_menu.php");
    exit();
}
?>
