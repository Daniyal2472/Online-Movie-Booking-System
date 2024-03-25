<?php
include("header.php");
?>

<?php
                        if (isset($_GET['id'])) {
                            $ed = $_GET['id'];
                            $update = mysqli_query($con, "SELECT * FROM `theatres` WHERE id=$ed");
                            $row = mysqli_fetch_assoc($update);
                        }?>

<div class="container-fluid pt-4 px-4">
                <div class="row ">
                <div class="col">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Edit Theatre</h6>
                            <form method="post" action="" >
                            <div class="form-floating mb-3">
                                <input name="name" type="text" class="form-control" id="floatingInput"
                                    placeholder="name@example.com">
                                <label ><?php echo $row['name'] ?></label>
                            </div>
                            <div class="form-floating mb-3">
                                <input name="location" type="text" class="form-control" id="floatingInput"
                                    placeholder="name@example.com">
                                <label for="floatingInput"><?php echo $row['location'] ?></label>
                            </div>
                            
                        
                            <div class="m-n2">
                                <button name="add" type="submit" class="btn btn-outline-primary m-2">Edit Theatre</button></div>
                        </div>
                        </form>
                        <?php
if(isset($_POST['add'])) {
    $name = $_POST['name'];
    $location = $_POST['location'];

    // Perform the database insertion
    $query = "UPDATE `theatres` SET `name`='$name', `location`='$location' WHERE `id`='$ed'";
    $result = mysqli_query($con, $query);
    echo "<script>alert('Theatre updated successfully.');</script>";
    echo "<script>location.assign('theatre.php')</script>";}
?>
                    </div>

<?php
include("footer.php");
?>