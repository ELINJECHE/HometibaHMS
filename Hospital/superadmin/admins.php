<?php
session_start();
// if (!empty($_SESSION["admin"])) {
//     header('Locatio:../login.php');
// }
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
                                <h6 class="col-md-9">Admin Details <b class="text-warning ">  New</b></h6> 
                                <a href="createadmin.php" class="btn btn-sm col-md-2 " style="background: #0dcaf0;color:white;font-weight:bold;"><i class="fas fa-plus"></i> Add Admin</a>
                            </div>
                                <hr style="color:#ff2400">
                            <div class=" col-md-12 mx-auto shadow-lg  ">
                                <?php
                            // Include config file
                        include "../config.php";
                        $msg = "";
                            
                            // Attempt select query execution
                            $sql = "SELECT * FROM users WHERE Role='admin'";
                            if($result = mysqli_query($conn, $sql)){
                                if(mysqli_num_rows($result) > 0){
                                    echo '<table class=" text-warning  table table-responsive table table-borderless table-sm ">';
                                        echo "<thead >";
                                            echo "<tr class='text-white bg-dark'>";
                                                echo "<th>First Name</th>";
                                                echo "<th>Last Name</th>";
                                                echo "<th>Mobile</th>";
                                                echo "<th>Email</th>";
                                                echo "<th>Role</th>";
                                                echo "<th>Edit Role</th>";
                                                echo "<th>Delete</th>";
                                            echo "</tr>";
                                        echo "</thead>";
                                        echo "<tbody class='text-dark'>";
                                        while($row = mysqli_fetch_array($result)){
                                            echo "<tr style='color:black; font-size:15px'>";
                                                echo "<td>" . $row['FirstName'] . "</td>";
                                                echo "<td>" . $row['LastName'] . "</td>";
                                                echo "<td>" . $row['Telphone'] . "</td>";
                                                echo "<td>" .$row['email']. "</td>";
                                                echo "<td>" ;
                                                echo '<span class="badge bg-danger">Admin</span>';
                                                echo "</td>";
                                                echo "<td>";
                                                echo '<a  "class="text-info" href="updateuser.php?userid='. $row['userid'] .'"  title="Update user " data-toggle="tooltip"><span class=" fas fa-pencil"></span></a>';
                                                echo  " </td>";
                                                echo  "<td>";
                                                echo '<a class="text-danger " href="deleteuser.php?userid='. $row['userid'] .'"  title="Delete user" data-bs-toggle="modal" data-bs-target="#deleteUser"><i class="fa fa-times" aria-hidden="true"></i></a>';
                                                echo "</td>";
                                                
                                                
                                            echo "</tr>";
                                        }
                                        echo "</tbody>";                            
                                    echo "</table>";
                                    // Free result set
                                    mysqli_free_result($result);
                                } else{
                                    echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                                }
                            } else{
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