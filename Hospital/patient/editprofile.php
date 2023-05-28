<?php
$msg = '';
session_start();
include "../config.php";
$id = $_SESSION["login"];
$sql = "SELECT * FROM users where userid='{$id}'" or die(mysqli_errno($conn));
$rel = mysqli_query($conn, $sql);
$row2 = mysqli_fetch_assoc($rel);
if (isset($_POST['submit'])) {

    $id = $row2['userid'];
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    // $oldpassword = $_POST['oldpassword'];
    $cpassword = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
    $password = mysqli_real_escape_string($conn, md5($_POST['password']));
   



    if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE Telphone='{$mobile}'")) > 1) {
        $msg = "<div class='alert alert-danger'>{$mobile} -This Mobile number has been registered </div>";
    } 
    elseif ($password === $cpassword) {
        $update = "UPDATE users SET firstname='$firstname',lastname='$lastname', password='$password',email='$email' WHERE userid='$id'" or die(mysqli_errno($conn));
        $sql2 = mysqli_query($conn, $update);
        if ($sql2) {
            $msg = "<div class='alert alert-success'>{$firstname} -You have updated your profile sucessfullly </div>";
        } else {
            $msg = "<div class='alert alert-danger'>Check the creditials and try again </div>";
        }

    }
}

// if (!empty($_SESSION["admin"])) {
//     header('Locatio:../login.php');
// }
include "includes/header.php";
include "includes/topnav.php";
include "includes/sidenav.php";
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-2">
            <div class=" container-fluid  mx-auto">
                <h4>Edit Profile</h4>
                <hr class="mt-1" style="color:#ff2400">
                <?php echo $msg; ?>
            </div>
            <form class=" pt-4 col-md-6 container-fluid" method="post" enctype="multipart/form-data">
                <?php
                $id = $_SESSION["login"];

                $sql = mysqli_query($conn, "SELECT * FROM users WHERE userid='$id'");
                while ($row = mysqli_fetch_array($sql)) {
                    ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-secondary" for="First Name">First Name</label>
                                <input type="text" class="form-control input-sm my-1" name="firstname"
                                    value="<?php echo $row['FirstName']; ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-secondary" for="Last Name">Last Name</label>
                                <input type="text" class="form-control input-sm my-1" name="lastname"
                                    value="<?php echo $row['LastName']; ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-secondary" for="phone number">Phone Number</label>
                                <input type="tel" disabled class="form-control input-sm my-1" name="mobile"
                                    value="<?php echo $row['Telphone']; ?>" maxlength="12" minlength="12"
                                    pattern="[2]{1}[5]{1}[4]{1}[0-9]{9}" required>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="text-secondary" for="First Name">Email Address</label>
                                <input type="email" class="form-control input-sm my-1" name="email"
                                    value="<?php echo $row['email']; ?>">
                            </div>
                        </div>
                    </div>
                    <!-- <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="text-secondary" for="password"> Enter Old Password</label>
                                <input type="password" class="form-control input-sm my-1" name="oldpassword"
                                     id="myInput" required>
                            </div>
                        </div>
                    </div> -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="text-secondary" for="password"> Enter New Password</label>
                                <input type="password" class="form-control input-sm my-1" name="password"
                                    placeholder="New password" id="myInput" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="text-secondary" for="password"> Confirm New Password</label>
                                <input type="password" class="form-control input-sm my-1" name="cpassword"
                                    placeholder="Confirm password" id="myInput" required>
                            </div>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-md-3 mx-auto">
                            <button name="submit" type="submit" class="btn text-center my-4 btn-sm w-100"
                                style="background: #ff2400;color:white;font-weight:bold;border-radius:20px;">Update</button>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </form>



        </div>
    </main>
    <?php
    include "includes/footer.php";
    ?>