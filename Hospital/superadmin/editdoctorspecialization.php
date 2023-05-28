<?php
session_start();
if (!isset($_SESSION['login'])) {
    header('location:../index.php');
}
include "includes/header.php";
include "includes/topnav.php";
include "includes/sidenav.php";
// Include config file
include "../config.php";

$id = intval($_GET['id']); // get value
if (isset($_POST['submit'])) {
    $docspecialization = $_POST['doctorspecilization'];
    $sql = mysqli_query($conn, "update  doctorSpecilization set specilization='$docspecialization' where id='$id'");
    $_SESSION['msg'] = "Doctor Specialization updated successfully !!";
    // header('location:specialization.php');

}

?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <div class=" col-md-12 mt-2 p-2">
                <div class=" section  ">
                    <!-- <center><h3 class=" pull-left">User Details</h3></center> -->
                    <h6 class="col-md-8">Edit Specialization Details <b class="text-warning "> New</b></h6>
                    <p style="color:red">
                        <?php echo htmlentities($_SESSION['msg']); ?>
                        <?php echo htmlentities($_SESSION['msg'] = ""); ?>
                    </p>
                    <div class="card p-2 col-md-5">
                        <form role="form" name="dcotorspcl" method="post">
                            <div class="form-group">
                                <h6 class="text-bold">
                                    Doctor Specialization
                                </h6>
                                <?php
                                $id = intval($_GET['id']);
                                $sql = mysqli_query($conn, "select * from doctorSpecilization where id='$id'");
                                while ($row = mysqli_fetch_array($sql)) {
                                    ?>
                                    <input type="text" name="doctorspecilization" class="form-control"
                                        value="<?php echo $row['specilization']; ?>">
                                <?php } ?>
                            </div>
                            <button type="submit" name="submit" class="btn btn-sm m-2"
                                style="background: #0dcaf0;color:white;font-weight:bold;">
                                <i class="fas fa-pencil"></i> Edit
                            </button>
                            <a type="cancel" href="specialization.php" class="btn btn-sm m-2"
                                style="background: #6c757d;color:white;font-weight:bold;">
                                <i class="fas fa-hand"></i> Cancel
                            </a>
                        </form>

                    </div>

                </div>

            </div>
        </div>
    </main>
    <?php
    include "includes/footer.php";
    ?>