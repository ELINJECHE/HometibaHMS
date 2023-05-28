<?php
    
    include 'config.php';
    $msg = "";

    if (isset($_POST['submit'])) {
        $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
        $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $password = mysqli_real_escape_string($conn, md5($_POST['password']));
        $cpassword = mysqli_real_escape_string($conn, md5($_POST['cpassword']));

        if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE Telphone='{$phone}'")) > 0) {
            $msg = "<div class='alert alert-danger'>{$phone} - This phone number already registered.</div>";
        }
        else if (empty($firstname)) {
                $msg = "<div class='alert alert-danger'>Fill in Firstname</div>";
        }
        else if (empty($lastname)) {
                $msg = "<div class='alert alert-danger'>Fill in Lastname</div>";
        }
        else if (empty($phone)) {
                $msg = "<div class='alert alert-danger'>Fill in Email address</div>";
        }
        
          else {
            if ($password === $cpassword) {
                $sql = "INSERT INTO users (FirstName,LastName, Telphone, Password) VALUES ('{$firstname}','{$lastname}', '{$phone}', '{$password}')";
                $result = mysqli_query($conn, $sql);

                if ($result) {
                    $sqlres = mysqli_query($conn, "SELECT * from users WHERE Telphone='{$phone}'");
                    if($patient = mysqli_fetch_array($sqlres)){
                    $userid = $patient['userid'];
                    $sqlinsert = mysqli_query($conn, "INSERT INTO patients (usr_id) VALUES ('{$userid}')");
                    
                    }
                    $msg = "<div class='alert alert-success'>Successfully registered.</div>";
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
include 'homeincludes/header.php';
include 'homeincludes/navbar.php';
?>
   
<div class="container  p-2 mt-3 col-md-3 " style="background:#c5ede8; border-radius:10px">
    <!-- <div class=""> -->
        <?php echo $msg?>
    <!-- </div> -->
<h4 class="text-center">Patient Registeration</h4>
  <form action="" method="POST">
    <div class="mb-2 mt-2">
      <label>FirstName:</label>
      <input type="text" class="form-control" placeholder="Enter FirstName" name="firstname">
    </div>
    <div class="mb-2 mt-2">
      <label >LastName:</label>
      <input type="text" class="form-control"  placeholder="Enter LastName" name="lastname">
    </div>
    <div class="mb-2 mt-2">
      <label >Telphone:</label>
      <input type="phone" class="form-control"  placeholder="Enter phone" name="phone">
    </div>
    <div class="mb-2">
      <label for="password">Password:</label>
      <input type="password" class="form-control"  placeholder="Enter password" name="password">
    </div>
    <div class="mb-2">
      <label for="password">Confirm Password:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Confirm password" name="cpassword">
    </div>
    <div class="form-check mb-2">
      <label class="form-check-label">
        <input class="form-check-input" type="checkbox" name="remember"> Remember me
      </label>
    </div>
    <button type="submit" name="submit" class="btn btn-primary mb-1">Register</button>
    <div class="mb-1">
      <p>Already Registered? <a href="login.php">Login</a> </p>
    </div>
  </form>
</div>
<?php
include 'homeincludes/footer.php';
?>