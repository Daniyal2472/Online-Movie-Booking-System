<?php
include("header.php");
if (isset($_SESSION['user_id'])) {
?>
<div class="container-fluid pt-4 px-4">
<div class="row g-4">

<div class="col-sm-12 col-xl-6">
<form method="post" action="" enctype="multipart/form-data">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Schedule</h6>
                            <select name="theatre" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                                <option selected>Theatre</option>
                                <?php
                    $query = "SELECT * FROM `theatres`";
                    $result = mysqli_query($con, $query);
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                                <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?> - <?php echo $row['location']; ?></option>
                                <?php
                    }} ?>                                
                          </select>
                            <select name="movie" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                                <option selected>Movie</option>
                                <?php
                    $query = "SELECT * FROM `movies`";
                    $result = mysqli_query($con, $query);
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                                <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?> - <?php echo $row['category']; ?></option>
                    <?php
                    }} ?>            
                            </select>
                            <select name="slot" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                                <option selected>Time slot</option>
                                <?php
                    $query = "SELECT * FROM `slots`";
                    $result = mysqli_query($con, $query);
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                                <option value="<?php echo $row['id']; ?>"><?php echo $row['slot']; ?></option>
                                <?php
                    }} ?>  
                            </select>
                            <button name="submit" type="submit" class="btn btn-primary">Add</button>                            
                            <?php
if (isset($_POST['submit'])) {
    $theatre = $_POST['theatre'];
    $movie = $_POST['movie'];
    $slot = $_POST['slot'];

    $query = "INSERT INTO `movie_schedule`(`id`, `theatre_id`, `movie_id`, `slot_id`) VALUES ('','$theatre','$movie','$slot')";
    $result = mysqli_query($con, $query);

        if ($result) {
            echo "<script>location.assign('movie_schedule.php')</script>";
        }}
    ?></form>
                        </div>
                    </div>
                    
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Basic Table</h6>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th ></th>
                                        <th scope="col">Movie</th>
                                        <th scope="col">Theatre</th>
                                        <th scope="col">Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                    $query = "SELECT * FROM `movie_schedule`";
                    $result = mysqli_query($con, $query);
                    if ($result) {
                        $rowNumber = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            $movie_id = $row['movie_id'];
                            $theatre_id = $row['theatre_id'];
                            $slot_id = $row['slot_id'];
                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $rowNumber; ?></th>
                                        <?php
                                        
                                        $mquery = "SELECT * FROM `movies` WHERE id='$movie_id'";
                                        $movie = mysqli_query($con, $mquery);
                                        $row = mysqli_fetch_assoc($movie);
                                        ?>
                                        <td><?php echo $row['name']; ?></td>
                                        <?php
                                        
                                        $tquery = "SELECT * FROM `theatres` WHERE id='$theatre_id'";
                                        $theatre = mysqli_query($con, $tquery);
                                        $row = mysqli_fetch_assoc($theatre);
                                        ?>
                                        <td><?php echo $row['name']; ?></td>
                                        <?php
                                        
                                        $tquery = "SELECT * FROM `slots` WHERE id='$slot_id'";
                                        $slot_id = mysqli_query($con, $tquery);
                                        $row = mysqli_fetch_assoc($slot_id);
                                        ?>
                                        <td><?php echo $row['slot']; ?></td>
                                    </tr>
                                    <?php
                                    $rowNumber++;
                        }
                    } else {
                        echo "<tr><td colspan='5'>Error fetching data</td></tr>";
                    }
                    ?>
                                    
                                </tbody>
                            </table>
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