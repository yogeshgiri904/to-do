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
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
    <title>Sasti Notebook</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
        <img src="https://cdn.iconscout.com/icon/premium/png-256-thumb/notebook-2333053-1939355.png" alt="" width="35" height="35" class="d-inline-block align-top">
        <b>SASTI NOTEBOOK</b>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
        <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 200px;">
            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="#">About</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="#">Contact</a>
            </li>
        </ul>
        <form class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
        </div>
    </div>
    </nav>
    <?php
    if($success)
    {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Success!</strong> Your note has been saved successfully.
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>";
    }
    ?>
    <div class="container mt-5">
        <h4>Add Your Note Here</h4>
        <form method="POST" autocomplete="off">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" required class="form-control" id="title" name="title">
        </div>
        <div class="mb-3">
            <label for="note" class="form-label">Note</label>
            <textarea class="form-control" required id="note" rows="3" name="note"></textarea>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Add Note</button>
        </form>
    </div>

    
    <div class="container mt-5 my-5">
    <table class="table" id="myTable">
    <thead class="table-dark">
        <tr>
        <th scope="col">S.No.</th>
        <th scope="col">Title</th>
        <th scope="col">Note</th>
        <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
    <?php
        $i = 0;
        $sql = "SELECT * FROM `notes`";
        $result = mysqli_query($conn, $sql);
        if($result)
        {
            while($data = mysqli_fetch_assoc($result))
            {
                $i++;
                $sn = $data['sn'];
                $showtitle = $data['title'];
                $shownote = $data['note'];
                echo "<tr>
                        <th scope='row'>$i</th>
                        <td> $showtitle </td>
                        <td> $shownote </td>
                        <td>
                            <a class='btn btn-outline-success' href='edit.php?id=$sn'>Edit</a>
                            <a class='btn btn-outline-danger' href='delete.php?id=$sn'>Delete</a>
                        </td>
                    </tr>";         
            }
        }
    ?>
    </tbody>
    </table>
    </div>




</body>
</html>
<script src="//cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>