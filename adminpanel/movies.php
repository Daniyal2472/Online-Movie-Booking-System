<?php
include("header.php");
if (isset($_SESSION['user_id'])) {
 ?>
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-6">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">Add Movie</h6>
                <form method="post" action="" enctype="multipart/form-data">
                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input name="name" type="text" class="form-control" id="inputEmail3" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">Year</label>
                                    <div class="col-sm-10">
                                        <input name="year" type="number" class="form-control" id="inputPassword3" required>
                                    </div>
                                    
                                </div>
                                <div class="row mb-3">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">Trailer</label>
                                    <div class="col-sm-10">
                                        <input name="trailer" type="text" class="form-control" id="inputPassword3" required>
                                    </div>
                                    
                                </div>
                                
                                <select name="category" class="form-select form-select-sm mb-3" aria-label=".form-select-sm example" required>
                                <option selected>Category</option>
                                <option value='Horror'>Horror</option>
                                <option value='Comedy'>Comedy</option>
                                <option value='Action'>Action</option>
                            </select>
                            <select name="rating" class="form-select form-select-sm mb-3" aria-label=".form-select-sm example" required>
                <option selected disabled>Rating</option>
                <?php
                for ($i = 1; $i <= 9; $i++) {
                    echo "<option value='$i'>$i</option>";
                }
                ?>
            </select>
            
                            <div class="mb-3">
                                <label for="formFileSm" class="form-label">Image</label>
                                <input name="picture" class="form-control form-control-sm bg-dark" id="formFileSm" type="file" required>
                            </div>
                            
                            
                                
                                
                            <button name="add" type="submit" class="btn btn-primary">Add movie</button>
                            </form>
            </div>
        </div>

        <?php
if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $year = $_POST['year'];
    $category = $_POST['category'];
    $rating = $_POST['rating'];
    $trailer = $_POST['trailer'];
       

    // Handle file uploads
    $pictureFileName = $_FILES['picture']['name'];
    $pictureTmpName = $_FILES['picture']['tmp_name'];
    // $trailerFileName = $_FILES['trailer']['name'];
    // $trailerTmpName = $_FILES['trailer']['tmp_name'];

    // Specify the destination directories for uploaded files
    $pictureDestination = "../pictures/" . $pictureFileName;
    // $trailerDestination = "../trailers/" . $trailerFileName;

    // Check file extensions
    $pictureExtension = strtolower(pathinfo($pictureFileName, PATHINFO_EXTENSION));
    // $trailerExtension = strtolower(pathinfo($trailerFileName, PATHINFO_EXTENSION));

    

    if (in_array($pictureExtension, ['jpg', 'jpeg', 'png'])) {
        // Move uploaded files to specific directories
        move_uploaded_file($pictureTmpName, $pictureDestination);
        // move_uploaded_file($trailerTmpName, $trailerDestination);

        // Insert data into the database
        $query = "INSERT INTO `movies` (`name`, `year`, `category`, `rating`, `pictures`, `trailers`, `description`) VALUES ('$name', '$year', '$category','$rating', '$pictureDestination', '$trailer','$description')";
        $result = mysqli_query($con, $query);

        if ($result) {
            echo "<script>location.assign('movies.php')</script>";
        } else {
            echo "<script>alert('Error adding movie.');</script>";
        }
    } else {
        echo "<script>alert('Error: Unsupported file extension. Please use jpg, jpeg, png for pictures and mp4, avi, mkv for trailers.')</script>";
    }
}
?>



<div class="col-sm-12 col-md-6">
    <div class="bg-secondary rounded h-100 p-4">
        <h6 class="mb-4">Movies</h6>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th></th>
                        <th scope="col">Images</th>
                        <th scope="col">Name</th>
                        <th scope="col">Year</th>
                        <th scope="col">Category</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM `movies` ORDER BY name";
                    $result = mysqli_query($con, $query);
                    if ($result) {
                        $rowNumber = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                            <tr>
                            <th scope="row"><?php echo $rowNumber; ?></th>
                                <td><img src="<?php echo $row['pictures']; ?>" alt="" style="height: 100px; width: 100px"></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['year']; ?></td>
                                <td><?php echo $row['category']; ?></td>
                                <td>
                                    <a href="edit movie.php?id=<?php echo $row['id'] ?>" type="button" class="btn btn-outline-success m-2">Update</a>
                                    <a href="movies.php?id=<?php echo $row['id'] ?>" type="button" class="btn btn-outline-danger m-2">Delete</a>
                                </td>
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
        <?php
        if (isset($_GET['id'])) {
            $del = $_GET['id'];
            $check = mysqli_query($con, "DELETE FROM `movies` WHERE id=$del");
            if ($check) {
                echo "<script>location.assign('movies.php')</script>";
            }
        }
        ?>
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