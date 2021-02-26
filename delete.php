<?php
    // $server = "sql113.epizy.com";
    // $username = "epiz_27865341";
    // $password = "AlZKpC1PMWTUEQ";
    // $database = "epiz_27865341_user";

    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "notebook";

    $conn = mysqli_connect($server, $username, $password, $database);
    if(!$conn)
    {
        die("Error in connecting to mySQL: ".mysqli_connect_error());
    }
?>
<?php
    $id = $_GET['id'];
    $delSql = "DELETE FROM `notes` WHERE `notes`.`sn` = $id";
    $result = mysqli_query($conn, $delSql);
    if($result)
    {
        header("Location: index.php");
    }
    else
    {
        echo "Error in deleting this note.";
    }
?>