<?php
session_start();
if (!isset($_SESSION['login'])) {
    header('location:../index.php');
}
$id = $_SESSION['login'];
include('../config.php');
include "includes/header.php";
include "includes/topnav.php";
include "includes/sidenav.php";
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <div class="container-fluid container-fullw bg-white">


                <div class="row">
                    <div class="col-md-12">

                        <p style="color:red;">
                            <?php 
                            // echo htmlentities($_SESSION['msg']); 
                            ?>
                            <?php 
                            // echo htmlentities($_SESSION['msg'] = ""); 
                            ?>
                        </p>
                        <div class=" col-md-12  d-flex">
                            <!-- <center><h3 class=" pull-left">User Details</h3></center> -->
                            <h5 class="col-md-9">Appointment History Details <b class="text-warning "> New</b></h5>
                        </div>
                        <hr style="color:#ff2400">
                        <table class="table table-responsive table table-bordered table-striped table-sm table-hover" id="sample-table-1">
                            <thead>
                                <tr class="text-white bg-success">
                                    <th class="center">#</th>
                                    <!-- <th class="hidden-xs">Doctor Name</th> -->
                                    <th >Patient </th>
                                    <th>Specialization</th>
                                    <th> Fees</th>
                                    <th>Appointment Date </th>
                                    <th>Creation Date </th>
                                    <th>Current Status</th>
                                    <th>Assign Nurse</th>

                                </tr>
                            </thead>
                            <tbody class="text-dark">
                                <?php
                                $sql = mysqli_query($conn, "SELECT doctors.firstname as docname,users.FirstName as pname,appointment.*  from appointment join doctors on doctors.docid=appointment.doctorId join users on users.userid=appointment.uId ");
                                $sqlqry = mysqli_query($conn, "select * from appointment");
                                $cnt = 1;
                                while ($row = mysqli_fetch_array($sql)) {
                                    if (empty($row)) {
                                        echo "<div> NO Appointsments at the momemet</div>";
                                    } else {
                                        ?>

                                    <tr style="color:black; font-size:15px">
                                        <td class="center"><?php echo $cnt; ?>.</td>
                                        <!-- <td class="hidden-xs">
                                            <?php echo $row['docname']; ?>
                                        </td> -->
                                        <td class="hidden-xs"><?php echo $row['pname']; ?></td>
                                        <td>
                                            <?php echo $row['doctorSpecialization']; ?>
                                        </td>
                                        <td><?php echo $row['consultancyFees']; ?></td>
                                        <td>
                                            <?php echo $row['appointmentDate']; ?> / <?php echo
                                                    $row['appointmentTime']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['postingDate']; ?>
                                        </td>
                                        <td>
                                            <?php if (($row['userStatus'] == 1) && ($row['doctorStatus'] == 1)) {
                                                echo "Active";
                                            }
                                            if (($row['userStatus'] == 0) && ($row['doctorStatus'] == 1)) {
                                                echo "Cancel by Patient";
                                            }

                                            if (($row['userStatus'] == 1) && ($row['doctorStatus'] == 0)) {
                                                echo "Cancel by Doctor";
                                            }



                                            ?></td>
                                        <td>
                                            <div class="visible-md visible-lg hidden-sm hidden-xs">
                                                <?php if (($row['userStatus'] == 1) && ($row['doctorStatus'] == 1)) {


                                                    echo "No Action yet";
                                                } else {

                                                    echo "Canceled";
                                                } ?>
                                            </div>
                                            <div class="visible-xs visible-sm hidden-md hidden-lg">
                                                <div class="btn-group" dropdown is-open="status.isopen">
                                                    <button type="button"
                                                        class="btn btn-primary btn-o btn-sm dropdown-toggle"
                                                        dropdown-toggle>
                                                        <i class="fa fa-cog"></i>&nbsp;<span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu pull-right dropdown-light" role="menu">
                                                        <li>
                                                            <a href="#">
                                                                Edit
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#">
                                                                Share
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#">
                                                                Remove
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <?php
                                    $cnt = $cnt + 1;
                                    }        
                                } 
                                ?>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php
    include "includes/footer.php";
    ?>