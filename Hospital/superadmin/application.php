<?php
session_start();
// if (!empty($_SESSION["admin"])) {
//     header('Locatio:../login.php');
// }
include "../config.php";
include "includes/header.php";
include "includes/topnav.php";
include "includes/sidenav.php";
// approving applicaiton
if (isset($_GET['approve'])) {
    $id = $_GET['id'];
    $sqlresult = mysqli_query($conn, "SELECT * FROM applications WHERE id = '$id'");
    $row = mysqli_fetch_array($sqlresult);
    $firstname = $row['firstname'];
    $lastname = $row['lastname'];
    $password = $row['password'];
    $role = $row['Role'];
    $cv = $row['cv'];
    $telphone = $row['Telphone'];
    $email = $row['firstname'] . $row['lastname'] . '@gmail.com';
    $status = 'Approved';
    $disbledoc = 'Disabled';
    if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE email='{$email}'")) > 0) {
        $_SESSION['msg'] = "{$email} - Doctor already Approved.";
    }
   
     elseif($row > 0) {
        
        // // if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM doctors WHERE email='{$email}'")) > 0) {
            
        //     $sqlinsert = mysqli_query($conn, "INSERT INTO users(FirstName,LastName,Password,Role,email,Telphone) VALUES('{$firstname}','{$lastname}','{$password}','{$role}','{$email}','{$telphone}')");
        //     $docupdate = mysqli_query($conn, "UPDATE doctors SET status='$status' WHERE email='$email'");
        //     if ($sqlinsert && $docupdate ) {
        //         $sqlqry = mysqli_query($conn, "UPDATE applications SET status='$status' WHERE id='$id'");
        //         if($sqlqry){
        //             $_SESSION['msg'] = "Updated Successfully";
        //         }
              
        //     // } 
        // }
        if($row['Role']=="Doctor") {
            $sqlqry = mysqli_query($conn, "UPDATE applications SET status='$status' WHERE id='$id'");
            $sqlinsert = mysqli_query($conn, "INSERT INTO users(FirstName,LastName,Password,Role,email,Telphone) VALUES('{$firstname}','{$lastname}','{$password}','{$role}','{$email}','{$telphone}')");
            $sqlinsertdoctor = mysqli_query($conn, "INSERT INTO doctors(firstName,lastname,password,status,email,phone,cv) VALUES('{$firstname}','{$lastname}','{$password}','{$status}','{$email}','{$telphone}','{$cv}')");
            if ($sqlqry && $sqlinsert && $sqlinsertdoctor ) {
                $_SESSION['msg'] = "Doctor Approved Successfully";
            }
           
        } else{
            $sqlqry = mysqli_query($conn, "UPDATE applications SET status='$status' WHERE id='$id'");
            $sqlinsert = mysqli_query($conn, "INSERT INTO users(FirstName,LastName,Password,Role,email,Telphone) VALUES('{$firstname}','{$lastname}','{$password}','{$role}','{$email}','{$telphone}')");
            $sqlinsertdoctor = mysqli_query($conn, "INSERT INTO doctors(firstName,lastname,password,status,email,phone,cv) VALUES('{$firstname}','{$lastname}','{$password}','{$status}','{$email}','{$telphone}','{$cv}')");
            if ($sqlqry && $sqlinsert && $sqlinsertdoctor ) {
                $_SESSION['msg'] = "Nurse Approved Successfully";
            }
        }

    } else {
        $_SESSION['msg'] = "Somethig went wrong.";
    }

}
// rejecting/  doctor/nurse
if (isset($_GET['del'])) {
    $id = $_GET['id'];
    $sqlresult = mysqli_query($conn, "SELECT * FROM applications WHERE id = '$id'");
    $row = mysqli_fetch_array($sqlresult);
    $firstname = $row['firstname'];
    $lastname = $row['lastname'];
    $password = md5(123);
    $role = "Doctor";
    $email = $row['firstname'] . $row['lastname'] . '@gmail.com';
    $status = 'Rejected';
    $docsts = "Disabled";
    if($row > 0) {
        $sqlqry = mysqli_query($conn, "DELETE FROM  users WHERE email='$email' ");
        $sqlinsert = mysqli_query($conn, "UPDATE applications SET status='$status' WHERE id='$id'");
        $docupdate = mysqli_query($conn, "UPDATE doctors SET status='$docsts' WHERE email='$email'");
        if ($sqlqry && $sqlinsert && $docsts) {
            $_SESSION['msg'] = " Rejected Successfully";
        } else {
            $_SESSION['msg'] = "Check the application well.";
        }

    } else {
        $_SESSION['msg'] = "Somethig went wrong.";
    }

}
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <div class="section col-md-12 mt-2 p-2">
                <div class=" col-md-12  d-flex">
                    <!-- <center><h3 class=" pull-left">User Details</h3></center> -->
                    <h6 class="col-md-9">Application Details <b class="text-warning "> New</b></h6>
                </div>
                <hr style="color:#ff2400">
                <p style="color:red">
                    <?php echo htmlentities($_SESSION['msg']); ?>
                    <?php echo htmlentities($_SESSION['msg'] = ""); ?>
                </p>
                <div class=" col-md-12 mx-auto shadow-lg  ">
                    <?php
                    // Include config file
                    include "../config.php";
                    $msg = "";

                    // Attempt select query execution
                    $sql = "SELECT * FROM applications Where Role='doctor'";
                    $count = 1;
                    if ($result = mysqli_query($conn, $sql)) {
                        if (mysqli_num_rows($result) > 0) {
                            echo '<table class=" text-warning  table table-bordered table-striped table-responsive table table-borderless table-sm table-hover ">';
                            echo "<thead >";
                            echo "<tr class='text-white bg-success'>";
                            echo "<th class='center'>#</th>";
                            echo "<th>First Name</th>";
                            echo "<th>Last Name</th>";
                            echo "<th>Why  You?</th>";
                            echo "<th>CV</th>";
                            echo "<th>Specialization</th>";
                            echo "<th>Status</th>";
                            echo "<th>Approve</th>";
                            echo "<th>Reject/Disable</th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody class='text-dark'>";
                            while ($row = mysqli_fetch_array($result)) {
                                echo "<tr style='color:black; font-size:15px'>";
                                echo "<td class='center'>" . $count . "</td>";
                                echo "<td>" . $row['firstname'] . "</td>";
                                echo "<td>" . $row['lastname'] . "</td>";
                                echo "<td width='200px' style='font-size: 10px;font-family:italic;'>";

                                if ($row['whychooseyou'] == !null): ?>
                                    <?php
                                    echo $row['whychooseyou'];
                                    ?>
                                <?php elseif ($row['whychooseyou'] == null): ?>
                                    <p class=" text-primary ">Null</p>
                                <?php endif;

                                echo "</td>";
                                echo "<td>";
                                if ($row["cv"] == null): ?>
                                    <p class="text-primary fs-6">---</p>
                                <?php elseif ($row['cv'] == !null):
                                    echo '<a href="../images/cvs/' . $row["cv"] . '" target="_blank"><i class="fa fa-download" aria-hidden="true"></i></a>';
                                ?>
                                <?php endif;
                                echo "</td>";
                                echo "<td>";
                                if ($row['Role'] == 'doctor'): ?>
                                    <span class="badge bg-primary">Doctor</span>
                                <?php elseif ($row['Role'] == 'nurse'): ?>
                                    <span class="badge bg-secondary">Nurse</span>
                                <?php endif;
                                "</td>";
                                echo "<td>";
                                if ($row['status'] == 'Pending'): ?>
                                    <span class="badge bg-warning">Pending</span>
                                <?php elseif ($row['status'] == 'Approved'): ?>
                                    <span class="badge bg-success">Approved</span>
                                <?php elseif ($row['status'] == 'Rejected'): ?>
                                    <span class="badge bg-danger">Rejected</span>
                                <?php endif;
                                "</td>";
                                echo "<td>";
                                ?>
                                <a href="application.php?id=<?php echo $row['id']; ?>&approve=app" title="approve doctor"
                                    onClick="return confirm('Are you sure you want to Approve?')">
                                    <i class="fa fa-check text-success"></i></a>
                                <input hidden name="apid" value="<?php echo $row['id'] ?>" type="text">
                                <?php
                                echo "</td>";
                                echo "<td>";
                                ?>
                                <a href="application.php?id=<?php echo $row['id']; ?>&del=delete" title="approve doctor"
                                    onClick="return confirm('Are you sure you want to Reject?')">
                                    <i class="fa fa-times text-danger"></i></a>
                                <?php
                                echo " </td>";



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