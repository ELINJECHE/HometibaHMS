<?php
session_start();
if (!isset($_SESSION['login'])) {
    header('location:../index.php');
}

include "includes/header.php";
include "includes/topnav.php";
include "includes/sidenav.php";
include('../config.php');
$msg = "";

//Code Deletion doctor
if (isset($_GET['del'])) {
    $doctorid = $_GET['id'];
    $res = mysqli_query($conn, "DELETE FROM doctors where docid = '$doctorid'");
    if($res){
        $msg = "<div class=' alert-danger mb-2 p-2 col-md-2'>Doctor Deleted!! <a href='doctors.php'> <I class='fa fa-times'></i></a> </div> ";
        // header('location:doctors.php');
    }
   
  
}
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <div class="section col-md-12 mt-2 p-2">
                <div class=" col-md-12  d-flex">
                    <!-- <center><h3 class=" pull-left">User Details</h3></center> -->
                    <h6 class="col-md-9">Doctor Details <b class="text-warning "> New</b></h6>
                    <a href="createdoctor.php" class="btn btn-sm col-md-2 "
                        style="background: #0dcaf0;color:white;font-weight:bold;"><i class="fas fa-plus"></i> Add
                        Doctor</a>
                </div>
                <hr style="color:#ff2400">
                <?php echo $msg; ?>
                <div class=" col-md-12 mx-auto shadow-lg  ">
                    <?php
                    // Include config file
                    include "../config.php";
                    

                    // Attempt select query execution
                    $sql = "SELECT * FROM doctors";
                    $count = 1;
                    if ($result = mysqli_query($conn, $sql)) {
                        if (mysqli_num_rows($result) > 0) {
                            echo '<table class="  table table-responsive table table-borderless table-sm table-hover">';
                            echo "<thead >";
                            echo "<tr class='text-white bg-success'>";
                            echo "<th class='center'>#</th>";
                            echo "<th>First Name</th>";
                            echo "<th>Last Name</th>";
                            echo "<th>County</th>";
                            echo "<th>Mobile</th>";
                            echo "<th>Status</th>";
                            echo "<th>Edit</th>";
                            echo "<th>Delete</th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody class='text-dark'>";
                            while ($row = mysqli_fetch_array($result)) {
                                echo "<tr style='color:black; font-size:15px'>";
                                echo "<td class='center'>" . $count . "</td>";
                                echo "<td>" . $row['firstname'] . "</td>";
                                echo "<td>" . $row['lastname'] . "</td>";
                                echo "<td>" . $row['county'] . "</td>";
                                echo "<td>" . $row['phone'] . "</td>";
                                echo "<td>";
                                if ($row['status'] == 'Pending'): ?>
                                    <span class="badge bg-warning">Pending</span>
                                <?php elseif ($row['status'] == 'Approved'): ?>
                                    <span class="badge bg-success">Approved</span>
                                <?php elseif ($row['status'] == 'Rejected'): ?>
                                    <span class="badge bg-danger">Rejected</span>
                                    <?php elseif ($row['status'] == 'Disabled'): ?>
                                    <span class="badge bg-danger">Disabled</span>
                                <?php endif;
                                "</td>";
                                echo "<td>";
                                echo '<a  "class="text-info" href="updatedoctor.php?docid=' . $row['docid'] . '"  title="Update doctor " data-toggle="tooltip"><span class=" fas fa-pencil"></span></a>';
                                echo " </td>";
                                echo "<td>";
                                ?>
                                <a href="doctors.php?id=<?php echo $row['docid'];?>&del=delete"
                                                        onClick="return confirm('Are you sure you want to delete?')"  >
                                                        <i class="fa fa-trash text-danger"></i></a>
                                 <?php                       

                                echo "</td>";


                                echo "</tr>";
                                $count = $count + 1;
                            }
                            echo "</tbody>";
                            echo "</table>";
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
</div>
</div>
<?php
include "includes/footer.php";
?>