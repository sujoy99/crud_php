<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>

<body>
    
    <?php require_once "process.php" ?>

   


    <?php if(isset($_SESSION['message']) && $_SESSION['msg_type'] == "success") {?>
        <div class="alert alert-success">
            <?php 
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            ?>
        </div>
    <?php } elseif(isset($_SESSION['message']) && $_SESSION['msg_type'] == "warning") {?>
        <div class="alert alert-warning">
            <?php 
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            ?>
        </div>
    <?php } elseif(isset($_SESSION['message']) && $_SESSION['msg_type'] == "dark") {?>
        <div class="alert alert-dark">
            <?php 
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            ?>
        </div>
    <?php }?>
    <div class="container">
    <?php          
        $mysqli = new mysqli("localhost", "root", "", "crud") or die(mysqli_error($mysqli));

        $result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);

        // pre_r($result);
        // pre_r($result->fetch_assoc());
        // function pre_r($array){
        //     echo "<pre>";
        //     print_r($array);
        //     echo "</pre>";
        // }
    ?>

    <div class="row justify-content-center">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Location</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>

            <tbody>
                <?php 
                    while($row = $result->fetch_assoc()): ?>

                    <tr>
                        <td><?php echo $row['name'] ?></td>
                        <td><?php echo $row['location'] ?></td>
                        <td>
                            <a href="index.php?edit=<?php echo $row["id"]; ?>" class="btn btn-info">Edit</a>
                            <a href="index.php?delete=<?php echo $row["id"]; ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>

                    <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <div class="row justify-content-center">
        <form action="process.php" method="POST">

            <input type="hidden" name="id" value="<?php echo $id; ?>">


            <div class="form-group">
                <label for="name">Name : </label>
                <input type="text" class="form-control" name="name" id="name" value="<?php echo $name; ?>" placeholder="Enter your name">
            </div>

            <div class="form-group">
                <label for="location">Location : </label>
                <input type="text" class="form-control" name="location" id="location" value="<?php echo $location; ?>" placeholder="Enter your location">
            </div>

            <div class="form-group">
                <?php 
                    if($update == true):
                ?>
                <button type="submit" class="btn btn-info" name="update">Update</button>
                
                <?php else: ?>
                    <button type="submit" class="btn btn-primary" name="save">Save</button>
                <?php endif; ?>

            </div>

        </form>
    </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>