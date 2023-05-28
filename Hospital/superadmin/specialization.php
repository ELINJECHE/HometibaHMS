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
$msg = "";
if (isset($_POST['submit'])) {
    $doctorspecilization = $_POST['doctorspecilization'];

    if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM doctorSpecilization WHERE specilization='{$doctorspecilization}'")) > 0) {
        $_SESSION['msg'] = "{$doctorspecilization} - This specialization already exists!!";
    }
    else{
        $sql = mysqli_query($conn, "INSERT INTO doctorSpecilization(specilization) values('$doctorspecilization')");
    $_SESSION['msg'] = "Doctor Specialization added successfully";
    }

    
}
//Code Deletion specialization
if (isset($_GET['del'])) {
    $sid = $_GET['id'];
    $res = mysqli_query($conn, "DELETE FROM doctorSpecilization where id = '$sid'");
    if($res){
         $_SESSION['msg'] = "Specilization deleted successfully.";
    }
  
}
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <div class=" col-md-12 mt-2 p-2">
                <div class=" section  ">
                    <!-- <center><h3 class=" pull-left">User Details</h3></center> -->
                    <h6 class="col-md-8">Specialization Details <b class="text-warning "> New</b></h6>
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
                                <input type="text" name="doctorspecilization" class="form-control" required
                                    placeholder="Enter Doctor Specialization">
                            </div>
                            <button type="submit" name="submit" class="btn btn-sm m-2"
                                style="background: #0dcaf0;color:white;font-weight:bold;">
                                <i class="fas fa-plus"></i> Add
                            </button>
                        </form>
                    </div>

                </div>
                <hr style="color:#ff2400">
                <h6 class="col-md-8 m-3">Specialization Details <b class="text-warning "> Manage</b></h6>
                <div class=" col-md-12 mx-auto shadow-lg  ">
                    <?php


                    // Attempt select query execution
                    $sql = "SELECT * FROM doctorSpecilization";
                    $count = 1;
                    if ($result = mysqli_query($conn, $sql)) {
                        if (mysqli_num_rows($result) > 0) {
                            ?>
                            <table class=" table table-responsive table-borderless table-sm table-hover">
                                <thead class='text-white bg-success'>
                                    <th class='center'>#</th>
                                    <th>Specialization</th>
                                    <th class='hidden-xs'>Creation Date</th>
                                    <th>Updation Date</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </thead>
                                <tbody class='text-dark'>
                                    <?php
                                    while ($row = mysqli_fetch_array($result)) {
                                        ?>
                                        <tr style='color:black; font-size:15px'>
                                            <td class='center'>
                                                <?php echo $count ?>
                                            </td>
                                            <td> <?php echo $row['specilization'] ?></td>
                                            <td>
                                                <?php echo $row['creationDate'] ?>
                                            </td>
                                            <td> <?php echo $row['updationDate'] ?></td>


                                            <td>
                                                <div class="text-leading">
                                                    <a href="editdoctorspecialization.php?id=<?php echo $row['id'] ?>"
                                                        title="Update  " data-toggle="tooltip"><span
                                                            class=" fas fa-pencil"></span></a>
                                                </div>

                                            </td>
                                            <td>
                                                <div class="text-leading ">
                                                    <a href="specialization.php?id=<?php echo $row['id'];?>&del=delete"
                                                        onClick="return confirm('Are you sure you want to delete?')"  >
                                                        <i class="fa fa-times text-danger"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                        $count = $count + 1;
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <?php
                            // Free result set
                            mysqli_free_result($result);


                        } else {
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }


                    } else {
                        echo "Oops! Something went wrong. Please try again later.";
                    }


                    // Close connection
                    mysqli_close($conn);
                    ?>

                </div>
            </div>
        </div>
    </main>
    <?php
    include "includes/footer.php";
    ?>