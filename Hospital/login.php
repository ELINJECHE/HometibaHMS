<?php



include 'config.php';
$msg = "";



// login in user
if (isset($_POST['submit'])) {
  session_start();
  $phone = mysqli_real_escape_string($conn, $_POST['phone']);
  $password = mysqli_real_escape_string($conn, md5($_POST['password']));
  $sql = "SELECT * FROM users WHERE Telphone='{$phone}' AND Password='{$password}'";
  $result = mysqli_query($conn, $sql);
  // counting table row
  if (mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);
    // user redirect
    if ($row['Role'] == 'Admin') {
      $_SESSION['login'] = $row['userid'];
      $_SESSION['name'] = $row['Firstname'];
      header("Location: superadmin/dashboard.php");
      die();
    }
    if
    ($row['Role'] == 'Doctor') {
      $_SESSION['login'] = $row['userid'];
      $_SESSION['name'] = $row['Firstname'];
      header("Location: doctor/dashboard.php");
      die();
    }
    if
    ($row['Role'] == 'Patient') {
      $_SESSION["login"] = $row['userid'];
      $_SESSION['name'] = $row['Firstname'];
      header("Location: patient/dashboard.php");
      die();
    }
    if
    ($row['Role'] == 'Nurse') {
      $_SESSION["login"] = $row['userid'];
      $_SESSION['name'] = $row['Firstname'];
      header("Location: homecarenurse/dashboard.php");
      die();
    }

  } else {
    $msg = "<div class='alert alert-danger'>Email or password do not match.</div>";
  }
}
?>
<?php
include 'homeincludes/header.php';
include 'homeincludes/navbar.php';
?>

<div class="container  p-2 mt-3 col-md-3 " style="background:#c5ede8; border-radius:10px">
  <?php
  echo $msg;
  ?>
  <h4 class="text-center">Login</h4>
  <form action="" method="POST">
    <div class="mb-2 mt-2">
      <label>Username:</label>
      <input type="phone" class="form-control" id="phone" placeholder="Enter phone" name="phone" required>
    </div>
    <div class="mb-2">
      <label>Password:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password" required>
    </div>
    <div class="form-check mb-2">
      <label class="form-check-label">
        <input class="form-check-input" type="checkbox" name="remember"> Remember me
      </label>
    </div>
    <button type="submit" name="submit" class="btn btn-primary mb-1">Login</button>
    <div class="mb-1">
      <p>Not Registered? <a href="register.php">Register</a> </p>
    </div>
  </form>
</div>
<?php
include 'homeincludes/footer.php';
?>