<?php
session_start();
if (!isset($_SESSION['login'])) {
    header('location:../index.php');
}
include "includes/header.php";
include "includes/topnav.php";
include "includes/sidenav.php";
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <div class=" col-md-12 mt-2 p-2">
                <div class=" col-md-12  d-flex">
                    <!-- <center><h3 class=" pull-left">User Details</h3></center> -->
                    <h6 class="col-md-9">Nurse Details <b class="text-warning "> New</b></h6>
                </div>
                <hr style="color:#ff2400">
                <div class=" col-md-12 mx-auto shadow-lg  ">
                    <?php
                    // Include config file
                    include "../config.php";
                    $msg = "";

                    // Attempt select query execution
                    $sql = "SELECT * FROM users WHERE Role='nurse'";
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
                            echo "<th>Role</th>";
                            // echo "<th>View</th>";
                            echo "<th>Edit Role</th>";
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
                                echo '<span class="badge bg-success">Nurse</span>';
                                echo "</td>";
                                // echo "<td>";
                                // echo '<a class="text-success" href="showdoctor.php?docid='.$row['userid'] .'"  title="View doctor" data-toggle="tooltip"><span class=" fas fa-eye"></span></a>';
                                // echo "</td>";
                                echo "<td>";
                                echo '<a  "class="text-info" href="updatedoctor.php?docid=' . $row['userid'] . '"  title="Update doctor " data-toggle="tooltip"><span class=" fas fa-pencil"></span></a>';
                                echo " </td>";
                                echo "<td>";
                                echo '<a class="text-danger " href="deletedoctor.php?docid=' . $row['userid'] . '"  title="Delete doctor" data-bs-toggle="modal" data-bs-target="#deleteUser"><i class="fa fa-times" aria-hidden="true"></i></a>';
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