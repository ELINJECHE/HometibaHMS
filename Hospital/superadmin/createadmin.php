<?php
// Include config file
require_once "../config.php";
$msg = "";
 
// Define variables and initialize with empty values
  $password =$email = $cpassword  = $mobile = $firstname = $lastname=$idno="";
  $mobile_err= $email_err = $firstname_err = $lastname_err="";
 
    if (isset($_POST['submit'])) {
        $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
        $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, md5($_POST['password']));
        $cpassword = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
        $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
        $role = "admin";
        
        if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE email='{$email}'")) > 0) {
            $msg = "<div class='alert alert-danger'>{$email} - This email address  already exists.</div>";
        }
        else
         if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE Telphone='{$mobile}'")) > 0) {
            $msg = "<div class='alert alert-danger'>{$mobile} - This phone number already exists.</div>";
          
        }
        
          else {
            if ($password === $cpassword) {
                $sql = "INSERT INTO users (FirstName,LastName, email, password, Telphone,Role) VALUES ('{$firstname}','{$lastname}', '{$email}', '{$password}', '{$mobile}','{$role}')";
                $result = mysqli_query($conn, $sql);

                if ($result) {
                    
                    $msg = "<div class='alert alert-info'>Admin registered successfully.</div>";
                } 
                else {
                    $msg = "<div class='alert alert-danger'>Something wrong went.</div>";
                }
            } else {
                $msg = "<div class='alert alert-danger'>Password and Confirm Password do not match</div>";
            }
            
        }
    }
    mysqli_close($conn);

?>
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
                    <div class="section col-md-6 mt-2 p-2 mx-auto">
                    <center><h3 class="mt-1">Register Admin</h3></center>
                        <?php echo $msg; ?>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <div class="form-input">
                                <!-- <label  class="fw-bold  p-1">F Name:</label> -->
                            <div class="input-group form-control-sm">
                                 <div class="input-group-text"><i class="fas fa-user"></i></div>
                                <input type="text" name="firstname" placeholder="First Name" onkeydown="return /[a-z]/i.test(event.key)"  required class="form-control <?php echo (!empty($firstname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $firstname; ?>">
                                <span class="invalid-feedback"><?php echo $firstname_err;?></span>
                            </div>
                        </div> 
                        <div class="form-input">
                                <!-- <label  class="fw-bold  p-1">L Name:</label> -->
                            <div class="input-group form-control-sm">
                                 <div class="input-group-text"><i class="fas fa-user"></i></div>
                                <input type="text" name="lastname" placeholder="Last Name" onkeydown="return /[a-z]/i.test(event.key)" required class="form-control <?php echo (!empty($lastname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $lastname; ?>">
                                <span class="invalid-feedback"><?php echo $lastname_err;?></span>
                            </div>
                        </div>
                        <div class="form-group">
                                <!-- <label  class="fw-bold  p-1">Mobile:</label> -->
                            <div class="input-group form-control-sm">
                                <div class="input-group-text"><i class="fas fa-phone"></i></div>
                                <input type="text"  name="mobile" placeholder="Phone Number (254)" onkeypress="return onlyNumberKey(event)" maxlength="12" minlength="12" pattern="[2]{1}[5]{1}[4]{1}[0-9]{9}"
                                class="form-control <?php echo (!empty($mobile_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $mobile; ?>" required>
                                <span class="invalid-feedback"><?php echo $mobile_err;?></span>
                            </div>
                        </div>
                        <div class="form-group ">
                                <!-- <label  class="fw-bold  p-1">Email Address:</label> -->
                            <div class="input-group form-control-sm">
                                 <div class="input-group-text"><i class="fas fa-envelope"></i></div>
                                <input name="email" placeholder="Email Address" required class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                                <span class="invalid-feedback"><?php echo $email_err;?></span>
                            </div>
                        </div>
                        <div class="form-group ">
                                <!-- <label  class="fw-bold  p-1">Password:</label> -->
                            <div class="input-group form-control-sm">
                                <div class="input-group-text"><i class="fas fa-lock"></i></div>
                                <input type="password" name="password" placeholder="Password" id="password" class="form-control" maxlength="8" required>
                            </div>
                        </div>
                        <div class="form-group ">
                                <!-- <label  class="fw-bold  p-1">Confirm Password:</label> -->
                            <div class="input-group form-control-sm">
                                <div class="input-group-text"><i class="fas fa-lock"></i></div>
                                <input type="password" name="cpassword" placeholder="Confirm Password" id="password" class="form-control" maxlength="8" required >
                            </div>
                        </div>
                      
                        <div class="form-group text-center ">
                            <button type="submit" class="btn text-center col-md-6 my-3  " style="background: #0dcaf0;color:white;font-weight:bold;"  name="submit"  value="Submit">Register Administrator</button>
                        </div>
                    </form>
                </div>
                    </div>
                </main>
<?php
include "includes/footer.php";
?>