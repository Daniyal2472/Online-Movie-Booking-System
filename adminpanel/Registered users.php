<?php
include("header.php");
if (isset($_SESSION['user_id'])) {
$query = "SELECT * FROM `users` WHERE role = 'customer' ORDER BY name";
$result = mysqli_query($con, $query);

    ?>
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">Registered users</h6>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th></th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Role</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result) {
                                $rowNumber = 1; // Initialize row number
                                while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                <tr>
                                    <th scope="row"><?php echo $rowNumber; ?></th>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo $row['role']; ?></td>
                                    <td><a href="Registered users.php?id=<?php echo $row['id'] ?>" class="btn btn-primary m-2">Delete</a></td>
                                    
                                </tr>
                            <?php
                                    $rowNumber++; // Increment row number
                                }
                            }
                            if (isset($_GET['id'])) {
                                $del = $_GET['id'];
                                $check = mysqli_query($con, "DELETE FROM `users` WHERE id=$del");
                                if ($check) {
                                    echo "<script>location.assign('Registered users.php')</script>";
                                    exit();
                                }
                            }
                        
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


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