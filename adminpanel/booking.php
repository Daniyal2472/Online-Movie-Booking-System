<?php
include("header.php");
if (isset($_SESSION['user_id'])) {
?>

<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">Bookings</h6>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th></th>
                                <th scope="col">User</th>
                                <th scope="col">Movie</th>
                                <th scope="col">Theatre</th>
                                <th scope="col">Class</th>
                                <th scope="col">Seats</th>
                                <th scope="col">Amount</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT * FROM `booking`";
                            $result = mysqli_query($con, $query);

                            if ($result) {
                                $rowNumber = 1;
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $user_id = $row['user_id'];
                                    $movie_id = $row['movie'];
                                    $class_id = $row['class_id'];
                                    $seats = $row['seats'];
                                    $booking_id = $row['id'];
                            ?>
                                    <tr>
                                        <th scope="row"><?php echo $rowNumber; ?></th>
                                        <?php
                                        $uquery = "SELECT `name` FROM `users` WHERE id='$user_id'";
                                        $user = mysqli_query($con, $uquery);
                                        $row_user = mysqli_fetch_assoc($user);
                                        ?>
                                        <td><?php echo $row_user['name']; ?></td>
                                        <?php
                                        $mquery = "SELECT * FROM `movie_schedule` WHERE id='$movie_id'";
                                        $movie = mysqli_query($con, $mquery);
                                        $row_movie = mysqli_fetch_assoc($movie);

                                        $mquery = "SELECT * FROM `movie_schedule` WHERE id='$movie_id'";
                                        $movie = mysqli_query($con, $mquery);
                                        $row_movie = mysqli_fetch_assoc($movie);

                                        $mquery = "SELECT * FROM `movie_schedule` WHERE id='$movie_id'";
                                        $movie = mysqli_query($con, $mquery);
                                        $row_movie = mysqli_fetch_assoc($movie);
                                        ?>
                                        <td><?php echo $row_movie['name']; ?></td>
                                        
                                        
                                        <?php
                                        $squery = "SELECT `seats` FROM `booking` WHERE seats='$seats'";
                                        $seats_query = mysqli_query($con, $squery);
                                        $row_seats = mysqli_fetch_assoc($seats_query);
                                        ?>
                                        <td><?php echo $row_seats['seats']; ?></td>
                                        <?php
                                        
                                        $seats = $row_seats['seats'];
                                        $cquery = "SELECT `name`, `price` FROM `classes` WHERE id='$class_id'";
                                        $class = mysqli_query($con, $cquery);
                                        $row = mysqli_fetch_assoc($class);
                                        $price = $row['price'];
                                        $total = $seats * $price;
                                        ?>
                                        <td>Rs <?php echo $total; ?></td>
                                        <td><a href="booking.php?id=<?php echo $booking_id ?>" class="btn btn-primary m-2">Delete</a></td>
                                    </tr>
                                    <?php
                                    $rowNumber++;
                                }
                            } else {
                                echo "<tr><td colspan='5'>Error fetching data</td></tr>";
                            }

                            if (isset($_GET['id'])) {
                                $del = $_GET['id'];
                                $check = mysqli_query($con, "DELETE FROM `booking` WHERE id=$del");
                                if ($check) {
                                    echo "<script>location.assign('booking.php')</script>";
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
