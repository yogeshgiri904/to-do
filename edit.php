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
    $sql = "SELECT * FROM `notes` WHERE `sn` = $id";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_array($result);
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <title>Edit Note</title>
  </head>
  <body>

  <div class="container mt-5">
        <h4>Edit Note</h4>
        <form method="POST" autocomplete="off">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" required class="form-control" id="title" name="title" value="<?php echo $data['title'];?>">
        </div>
        <div class="mb-3">
            <label for="note" class="form-label">Note</label>
            <textarea class="form-control" required id="note" rows="3" name="note"><?php echo $data['note'];?></textarea>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Edit</button>
        </form>
    </div>


    <?php
        
    if(isset($_POST['submit']))
    {
        $title = $_POST['title'];
        $note = $_POST['note'];
        $editSql = "UPDATE `notes` SET `title` = '$title', `note` = '$note' WHERE `notes`.`sn` = $id;";
        $result = mysqli_query($conn, $editSql);
        if($result)
        {
            header("Location: index.php");
        }
        else
        {
            echo "Error in editing this note.";
        }
    }
    ?>
  </body>
</html>