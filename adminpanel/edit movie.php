<?php
include("header.php");
?>

<?php
                        if (isset($_GET['id'])) {
                            $ed = $_GET['id'];
                            $update = mysqli_query($con, "SELECT * FROM `movies` WHERE id=$ed");
                            $row = mysqli_fetch_assoc($update);
                        }?>
<div class="container-fluid pt-4 px-4">
    <div class="row">
        <div class="col-10">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">Edit Movie</h6>
                <form method="post" action="" enctype="multipart/form-data">
                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input value="<?php echo $row['name'] ?>" name="name" type="text" placeholder="<?php echo $row['name'] ?>" class="form-control" id="inputEmail3">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">Year</label>
                                    <div class="col-sm-10">
                                        <input value="<?php echo $row['year'] ?>" name="year" type="number" placeholder="<?php echo $row['year'] ?>" class="form-control" id="inputPassword3">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">Trailer</label>
                                    <div class="col-sm-10">
                                        <input value="<?php echo $row['trailers'] ?>" name="trailer" type="text" placeholder="<?php echo $row['year'] ?>" class="form-control" id="inputPassword3">
                                    </div>
                                </div>
                                <select value="<?php echo $row['year'] ?>" name="category" class="form-select form-select-sm mb-3" aria-label=".form-select-sm example">
                                <option selected>Category</option>
                                <option value='horror'>Horror</option>
                                <option value='comedy'>Comedy</option>
                                <option value='Action'>Action</option>
                            </select>
                                <select value="<?php echo $row['rating'] ?>" name="rating" class="form-select form-select-sm mb-3" aria-label=".form-select-sm example">
                                <option selected>Rating</option>
                                <?php
                for ($i = 1; $i <= 9; $i++) {
                    echo "<option value='$i'>$i</option>";
                }
                ?>
                            </select>
                            <div class="mb-3">
                                <label for="formFileSm" class="form-label">Image</label>
                                <input value="<?php echo $row['pictures'] ?>" name="picture" class="form-control form-control-sm bg-dark" id="formFileSm" type="file">
                            </div>
                            
                                
                                
                            <button name="add" type="submit" class="btn btn-primary">Update movie</button>
                            </form>
            </div>
        </div>

        <?php
if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $year = $_POST['year'];
    $rating = $_POST['rating'];
    $trailer = $_POST['trailer'];

    // Handle file uploads
    $pictureFileName = $_FILES['picture']['name'];
    $pictureTmpName = $_FILES['picture']['tmp_name'];
    

    // Specify the destination directories for uploaded files
    $pictureDestination = "../pictures" . $pictureFileName;
    

    // Check file extensions
    $pictureExtension = strtolower(pathinfo($pictureFileName, PATHINFO_EXTENSION));
    

    if (in_array($pictureExtension, ['jpg', 'jpeg', 'png'])) {
        // Move uploaded files to specific directories
        move_uploaded_file($pictureTmpName, $pictureDestination);
        move_uploaded_file($trailerTmpName, $trailerDestination);

        // Insert data into the database
        $query = "UPDATE `movies` 
        SET 
          `name`='$name',
          `year`='$year',
          `rating`='$rating',
          `pictures`='$pictureDestination',
          `trailers`='$trailer'
        WHERE 
          `id`='$ed';
        ";
        $result = mysqli_query($con, $query);

        if ($result) {
            echo "<script>alert('Movie updated successfully.');</script>";
            echo "<script>location.assign('movies.php')</script>";
        } else {
            echo "<script>alert('Error updating movie.');</script>";
        }
    } else {
        echo "<script>alert('Error: Unsupported file extension. Please use jpg, jpeg, png for pictures and mp4, avi, mkv for trailers.')</script>";
    }
}
?>

<?php
include("footer.php");
?>