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
    $success = false;
    if(isset($_POST['submit']))
    {
        $title = $_POST['title'];
        $note = $_POST['note'];
        $sql = "INSERT INTO `notes` (`title`, `note`, `date`) VALUES ('$title', '$note', current_timestamp());";
        $result = mysqli_query($conn, $sql);
        if($result)
        {
            $success = true;
            header("Location: index.php");
        }
        else
        {
            echo "data not inserted";
        }
    }
?>