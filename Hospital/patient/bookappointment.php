<?php
session_start();
if (!isset($_SESSION['login'])) {
    header('location:../index.php');
}
// if (!isset($_SESSION['login']) && $_SESSION['role']=='patient' && $_SESSION['loggedin'] == true) {
//     header('location:../index.php');
// } 

include '../config.php';
include "includes/header.php";
include "includes/topnav.php";
include "includes/sidenav.php";
include '../config.php';

$id = $_SESSION["login"];
$sql = "SELECT * from users where userid='$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$msg = "";

if (isset($_POST['submit'])) {
    $specilization = $_POST['Doctorspecialization'];
    $doctorid = $_POST['doctor'];
    $userid = $_SESSION['login'];
    // $fees = $_POST['fees'];
    $appdate = $_POST['appdate'];
    $time = $_POST['apptime'];
    $userstatus = 1;
    $docstatus = 1;
    $query = mysqli_query($conn, "INSERT INTO appointment(doctorSpecialization,doctorId,uId,appointmentDate,appointmentTime,userStatus,doctorStatus) values('$specilization','$doctorid','$userid','$appdate','$time','$userstatus','$docstatus')");
    if ($query) {
        echo "<script>alert('Your appointment successfully booked');</script>";
    }
}
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <div class=" container-fluid my-2 mx-auto">
                <span><a href="dashboard.php?id=<?php echo $row['userid'] ?>"><i
                            class="fas fa-home p-1 btn btn-warning"></i></a><b>Book/</b><b
                        class="text-warning">Appointment</b><span>
                        <hr style="color:#ff2400" class="mt-1">
                        <div class="">
                            <?php echo $msg ?>
                        </div>
            </div>
            <div class="card-body bg-light col-md-8 mx-auto m-2">
                <section id="page-title">
                    <div class="row">
                        <div class="col-sm-8">
                            <h5 class="mainTitle mb-4">Book Appointment</h5>
                        </div>
                    </div>
                </section>
                <form class="container-fluid " method="post">
                    <!-- section for personal details -->
                    <div class="row mb-2">
                        <div class="col-md-3">
                            <h6 style="font-family: italic;font-weight:bold">Personal Details <span
                                    style="color: red;">*</span></h6>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="text" class="input-sm form-control my-1"
                                    value="<?php echo $row['FirstName'] ?>" name="firstname"
                                    onkeydown="return /[a-z]/i.test(event.key)" autocomplete="off" disabled>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="text" class="input-sm form-control my-1"
                                    value="<?php echo $row['LastName'] ?>" name="lastname"
                                    onkeydown="return /[a-z]/i.test(event.key)" autocomplete="off" disabled>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="tel" class="input-sm form-control my-1" name="mobile"
                                    value="<?php echo $row['Telphone'] ?>" required pattern="[2]{1}[5]{1}[4]{1}[0-9]{9}"
                                    autocomplete="off" maxlength="12" minlength="12" disabled>
                            </div>
                        </div>
                    </div>
                    <!-- row for specilization details -->
                    <div class="row mb-2">
                        <div class="col-md-3">
                            <h6 style="font-family: italic;font-weight:bold">Doctor specilization <span
                                    style="color: red;">*</span></h6>
                        </div>

                        <div class="col-md-6">
                           
                            <select class="input-sm form-select" aria-label="Default select example" name="Doctorspecialization"
                                autocomplete="off" required>
                                <?php
                            $qry = mysqli_query($conn, "SELECT * FROM doctorspecilization");
                            while($row=mysqli_fetch_array($qry)):
                                ?>
                                <option value="<?php echo $row['specilization']; ?>"><?php echo $row['specilization']; ?></option>
                                <?php endwhile; ?>
                            </select>
                            
                        </div>
                    </div>
                    <!-- problem description -->

                    <div class="row mb-2 ">
                        <div class="col-md-3">
                            <h6 style="font-family: italic;font-weight:bold">Doctors <span style="color: red;">*</span>
                            </h6>
                        </div>
                        <div class="col-md-6">
                            <select class="form-select my-1" aria-label="Default select example" name="doctor"
                                autocomplete="off" required>
                                <?php
                            $sql_qry = mysqli_query($conn, "SELECT * FROM doctors WHERE status='Approved' AND Availability='Available'");
                                while ($data = mysqli_fetch_array($sql_qry)) {
                                    ?>
                                <option value="<?php echo $data['docid']; ?>"><?php echo $data['firstname']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <!-- problem text-area -->
                    <div class="row ">
                        <div class="col-md-3">
                            <h6 style="font-family: italic;font-weight:bold">Consultancy Fees <span
                                    style="color: red;">*</span></h6>
                        </div>
                        <div class="col-md-6">
                            <div class="form-input">
                                <textarea type="text" class="form-control my-1" name="exactproblem" autocomplete="off"
                                    disabled required></textarea>
                            </div>
                        </div>
                    </div>
                    <!-- date and time to receive technician -->
                    <div class="row">
                        <div class="col-md-3">
                            <h6 style="font-family: italic; font-weight:bold">Date and Time to see Doctor <span
                                    style="color: red;">*</span></h6>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="date" list="thesedates" class="form-control my-1 " id="datepicker"
                                    name="appdate" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="time" list="thesetimes" class="form-control my-1" id="timepicker"
                                    name="apptime" autocomplete="off" required>
                            </div>
                        </div>
                    </div>

                    <!-- submit button -->
                    <input hidden type="text" name="id" value="<?php echo $id ?>">
                    <div class="form-group text-center ">
                        <button type="submit" class="btn text-center col-md-6 my-2  "
                            style="background: #0dcaf0;color:white;font-weight:bold;border-radius:20px;" name="submit"
                            class="btn btn-sm  text-bold  mt-4" value="Submit">Book Appointment</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <?php
    include "includes/footer.php";
    ?>