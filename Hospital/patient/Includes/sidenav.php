<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Core</div>
                    <a class="nav-link" href="dashboard.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>

                    <div class="sb-sidenav-menu-heading">Modules</div>
                    <a class="nav-link" href="bookappointment.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                        Book Appointment
                    </a>
                    <a class="nav-link" href="appointmenthistory.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                        Appointment History
                    </a>
                    <a class="nav-link" href="medicalhistory.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                        Medical History
                    </a>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <?php

                $id = $_SESSION['login'];
                $sql = mysqli_query($conn, "SELECT * FROM users where userid='$id'");
                while ($row = mysqli_fetch_array($sql)) {
                   ?> 
                
                <div class="small"><?php echo $row['FirstName'];?><span style=" color:#0dcaf0">|</span><?php echo $row['LastName'];?>:</div>
                
                <p style=" color:#0dcaf0"><?php echo $row['Role']; ?></p>

                <?php
                }
                ?>
            </div>
        </nav>
    </div>