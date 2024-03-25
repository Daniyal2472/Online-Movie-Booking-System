<?php
include("header.php");

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
?>

<div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                <div class="col-sm-12 col-xl-6">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Add Theatre</h6>
                            <form method="post" action="" >
                            <div class="form-floating mb-3">
                                <input name="name" type="text" class="form-control" id="floatingInput"
                                    placeholder="name@example.com">
                                <label for="floatingInput">Name</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input name="location" type="text" class="form-control" id="floatingInput"
                                    placeholder="name@example.com">
                                <label for="floatingInput">Location</label>
                            </div>
                            
                        
                            <div class="m-n2">
                                <button name="add" type="submit" class="btn btn-outline-primary m-2">Add Theatre</button></div>
                        </div>
                        </form>
                    </div>

<?php
if(isset($_POST['add'])) {
    $name = $_POST['name'];
    $location = $_POST['location'];

    // Perform the database insertion
    $query = "INSERT INTO `theatres`(`id`, `name`, `location`) VALUES ('','$name','$location')";
    $result = mysqli_query($con, $query);}
?>


                    
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Theatres</h6>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Location</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                    $query = "SELECT * FROM `theatres` ORDER BY name";
                    $result = mysqli_query($con, $query);
                    if ($result) {
                        $rowNumber = 1;
                        while ($row = mysqli_fetch_assoc($result)) {?>
                                    <tr>
                                    <th scope="row"><?php echo $rowNumber; ?></th>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo $row['location']; ?></td>
                                        <td><a href="edit theatre.php?id=<?php echo $row['id'] ?>" type="button" class="btn btn-outline-success m-2">Update</a></td>
                                        <td><a href="theatre.php?id=<?php echo $row['id'] ?>" type="button" class="btn btn-outline-danger m-2">Delete</a></td>
                                    </tr>
                                    
                                    <?php
                                    $rowNumber++;
                        }
                    } else {
                        echo "<tr><td colspan='4'>Error fetching data</td></tr>";
                    }?> 
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php
if (isset($_GET['id'])) {
    $del = $_GET['id'];
    $check = mysqli_query($con, "DELETE FROM `theatres` WHERE id=$del");
    if ($check) {
        echo "<script>location.assign('theatre.php')</script>";
    }
}
?>
<?php
}
else{ ?>
    <div class="text-center">
        <p>You must be logged in to access the admin panel.</p>
        <a href="signin.php" class="btn btn-outline-warning w-50 m-2" type="button">Log In</a>
    </div>
<?php
}
include("footer.php");
?>