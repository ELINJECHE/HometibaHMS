<?php
// Include config file
require_once "../config.php";
$msg = "";
 
// Define variables and initialize with empty values
  $password =$email = $cpassword  = $mobile = $firstname = $lastname=$idno=$county="";
  $mobile_err= $email_err = $firstname_err = $lastname_err=$county_err=$idno_err="";
 
    if (isset($_POST['submit'])) {
        $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
        $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, md5($_POST['password']));
        $cpassword = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
        $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
        $county = mysqli_real_escape_string($conn, $_POST['county']);
        $idno = mysqli_real_escape_string($conn, $_POST['idno']);
        $status = "Approved";
        $role = 'doctor';
        
        if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM doctors WHERE email='{$email}'")) > 0) {
            $msg = "<div class='alert alert-danger'>{$email} - This email address  already exists.</div>";
        }
        else
         if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM doctors WHERE phone='{$mobile}'")) > 0) {
            $msg = "<div class='alert alert-danger'>{$mobile} - This phone number already exists.</div>";
          
        }
        else
         if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM doctors WHERE id='{$idno}'")) > 0) {
            $msg = "<div class='alert alert-danger'>{$idno} - This ID number already exists.</div>";
          
        }
       
        
          else {
            if ($password === $cpassword) {
                $sql = "INSERT INTO doctors (firstname,lastname, email, password, phone,county,id,status) VALUES ('{$firstname}','{$lastname}', '{$email}', '{$password}', '{$mobile}','{$county}','{$idno}','{$status}')";
                $sqlinsert = mysqli_query($conn, "INSERT INTO users(FirstName,LastName,Password,Role,email,Telphone) VALUES('{$firstname}','{$lastname}','{$password}','{$role}','{$email}','{$mobile}')");
                $result = mysqli_query($conn, $sql);


                if ($result && $sqlinsert) {
                    
                    $msg = "<div class='alert alert-info'>DOC registered successfully.</div>";
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

include "includes/header.php";
include "includes/topnav.php";
include "includes/sidenav.php";
?>
<div id="layoutSidenav_content">
<div class="container-fluid px-4">
            <div class="section col-md-6 mt-2 p-2 mx-auto">
                    <center><h3 class="mt-1">Register Doctor</h3></center>
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
                                <div class="input-group-text"><i class="fa fa-id-card"></i></div>
                                <input type="text" name="idno" placeholder="Id No" id="idno" class="form-control" onkeypress="return onlyNumberKey(event)" pattern="[0-9]{8}" maxlength="8" minlength="8" required>
                            </div>
                        </div>
                        <div class="form-group">
                                <!-- <label  class="fw-bold  p-1">county:</label> -->
                            <div class="input-group form-control-sm">
                                 <div class="input-group-text"><i class="fa fa-map-marker"></i></div>
                                <select class="input-sm form-control "  name="county" >
                                    <option   >County</option>
                                    <option value="Nairobi">Nairobi</option>
                                    <option value="Nakuru">Nakuru</option>
                                    <option value="Kisumu">Kisumu</option>
                                    <option value="Kiambu">Kiambu</option>
                                    <option value="Meru">Meru</option>
                                    <option value="Tharaka Nithi">Tharaka Nithi</option>
                                    <option value="Migori">Migori</option>
                                    <option value="Nyamira">Nyamira</option>
                                    <option value="Kisii">Kisii</option>
                                    <option value="Narok">Narok</option>
                                    <option value="Kajiado">Kajiado</option>
                                    <option value="Eligeiyo Markwe">Eligeiyo Markwet</option>
                                    <option value="Garissa">Garissa</option>
                                    <option value="Marsabit">Marsabit</option>
                                    <option value="Kitui">Kitui</option>
                                    <option value="Machakos">Machakos</option>
                                    <option value="Nyeri">Nyeri</option>
                                </select>
                                <span class="invalid-feedback"><?php echo $county_err;?></span>
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
                            <button type="submit" class="btn btn-sm text-center col-md-4 my-3 mx-auto  " style="background: #0dcaf0;color:white;font-weight:bold;"  name="submit"  value="Submit">Register Doctor</button>
                            <a type="cancel" href="doctors.php" class="btn btn-sm col-md-4 my-3 mx-auto "
                                style="background: #6c757d;color:white;font-weight:bold;">
                                <i class="fas fa-hand"></i> Back
                            </a>
                        </div>
                        

                    </form>
                </div>
        </div>     
</div>
</div>
<?php
include "includes/footer.php";
?>