<?php
session_start();
if (!isset($_SESSION['login'])) {
    header('location:../index.php');
}
include('../config.php');
$msg = '';
include "includes/header.php";
include "includes/topnav.php";
include "includes/sidenav.php";

//Code Deletion patient
if (isset($_GET['del'])) {
    $user_id = $_GET['id'];
    $res = mysqli_query($conn, "DELETE FROM users WHERE userid = '$user_id'");
    $respatient = mysqli_query($conn, "DELETE FROM patients where usr_id = '$user_id'");
    if($res &&  $respatient){
        $msg = "<div class=' alert-danger mb-2 p-2 col-md-2'>Patient Deleted!! <a href='patients.php'> <I class='fa fa-times'></i></a> </div> ";
        header('location:patients.php');
    }
   
  
}
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <div class=" col-md-12 mt-2 p-2">
                <div class=" col-md-12  d-flex">
                    <!-- <center><h3 class=" pull-left">User Details</h3></center> -->
                    <h6 class="col-md-9">Patient Details <b class="text-warning "> New</b></h6>
                    <!-- <a href="createdoctor.php" class="btn btn-sm col-md-2 " style="background: #0dcaf0;color:white;font-weight:bold;"><i class="fas fa-plus"></i> Add Doctor</a> -->
                </div>
                <hr style="color:#ff2400">
                <?php echo $msg; ?>
                <div class=" col-md-12 mx-auto shadow-lg  ">
                    <?php
                    // Include config file
                    include "../config.php";
                    $msg = "";

                    // Attempt select query execution
                    $sql = "SELECT * FROM users WHERE Role='patient'";
                    $count = 1;
                    if ($result = mysqli_query($conn, $sql)) {
                        if (mysqli_num_rows($result) > 0) {
                            echo '<table class=" text-warning  table table-responsive table table-borderless table-sm table-hover ">';
                            echo "<thead >";
                            echo "<tr class='text-white bg-success'>";
                            echo "<th class='center'>#</th>";
                            echo "<th>First Name</th>";
                            echo "<th>Last Name</th>";
                            echo "<th>Mobile</th>";
                            echo "<th>View </th>";
                            echo "<th>Delete</th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody class='text-dark'>";
                            while ($row = mysqli_fetch_array($result)) {
                                echo "<tr style='color:black; font-size:15px'>";
                                echo "<td class='center'>" . $count . "</td>";
                                echo "<td>" . $row['FirstName'] . "</td>";
                                echo "<td>" . $row['LastName'] . "</td>";
                                echo "<td>" . $row['Telphone'] . "</td>";
                                echo "<td>";
                                echo '<a  "class="text-info" href="updatedoctor.php?docid=' . $row['userid'] . '"  title="Update patient " data-toggle="tooltip"><span class=" fas fa-eye"></span></a>';
                                echo " </td>";
                                echo "<td>";
                                ?>
                                <a href="patients.php?id=<?php echo $row['userid'];?>&del=delete"
                                                        onClick="return confirm('The user will be pemanently be removed from our records .Are you sure you want to delete? ')"  >
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
    <?php
    include "includes/footer.php";
    ?>