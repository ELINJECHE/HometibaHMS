<?php
session_start();
if (!isset($_SESSION['login'])) {
    header('location:../index.php');
}
include '../config.php';
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
                            <?php echo htmlentities($_SESSION['msg']); ?>
                            <?php echo htmlentities($_SESSION['msg'] = ""); ?>
                        </p>
                        <table class="table table-hover" id="sample-table-1">
                            <thead>
                                <tr>
                                    <th class="center">#</th>
                                    <th class="hidden-xs">Doctor Name</th>
                                    <th>Specialization</th>
                                    <th>Consultancy Fee</th>
                                    <th>Appointment Date / Time </th>
                                    <th>Appointment Creation Date </th>
                                    <th>Current Status</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = mysqli_query($conn, "SELECT doctors.firstname AS docname,appointment.*  FROM appointment JOIN doctors on doctors.docid=appointment.doctorId where appointment.uId='" .$_SESSION['login'] . "'");
                                $cnt = 1;
                                while ($row = mysqli_fetch_array($sql)) {
                                    ?>

                                    <tr>
                                        <td class="center"><?php echo $cnt; ?>.</td>
                                        <td class="hidden-xs">
                                            <?php echo $row['docname']; ?>
                                        </td>
                                        <td><?php echo $row['doctorSpecialization']; ?></td>
                                        <td>
                                            <?php echo $row['consultancyFees']; ?>
                                        </td>
                                        <td><?php echo $row['appointmentDate']; ?> / <?php echo
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
                                                echo "Cancel by You";
                                            }

                                            if (($row['userStatus'] == 1) && ($row['doctorStatus'] == 0)) {
                                                echo "Cancel by Doctor";
                                            }



                                            ?></td>
                                        <td>
                                            <div class="visible-md visible-lg hidden-sm hidden-xs">
                                                <?php if (($row['userStatus'] == 1) && ($row['doctorStatus'] == 1)) { ?>


                                                    <a href="appointment-history.php?id=<?php echo $row['id'] ?>&cancel=update"
                                                        onClick="return confirm('Are you sure you want to cancel this appointment ?')"
                                                        class="btn btn-transparent btn-xs tooltips" title="Cancel Appointment"
                                                        tooltip-placement="top" tooltip="Remove">Cancel</a>
                                                <?php } else {

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
                                } ?>


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