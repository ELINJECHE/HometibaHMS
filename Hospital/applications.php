<?php
include_once 'config.php';
$msg = "";
if (isset($_POST['submit'])) {
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
    $specialization = mysqli_real_escape_string($conn, $_POST['role']);
    $password = mysqli_real_escape_string($conn, md5($_POST['password']));
    $cpassword = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
    $whychooseyou = mysqli_real_escape_string($conn, $_POST['whychooseyou']);
    $status = 'pending';

    $cvTo = 'images/cvs/';

    $uploadCVTo = "";
    if (isset($_FILES['cv'])) {
        $cv = $_FILES['cv']['name'];
        $pdf_size = $_FILES['cv']['size'];
        $id_tmp = $_FILES['cv']['tmp_name'];
        $uploadCVTo = $cvTo . $cv;
        $movepdf = move_uploaded_file($id_tmp, $uploadCVTo);
    }
    if ($_FILES['cv']['size'] > 1000000) { // id shouldn't be larger than 1Megabyte
        $msg = "<div class='alert alert-danger'>CV copy too large!</div>";
    }
    if ($password !== $cpassword) {
        $msg = $msg = "<div class='alert alert-danger'>Password and Confirm Password do not match</div>";
    }
    if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM applications WHERE Telphone='{$mobile}'")) > 0) {
        $msg = "<div class='alert alert-danger'>{$mobile} -This mobile number can apply only once.</div>";
    } else {
        $sql = "INSERT INTO applications (firstname,lastname,Telphone,Role,password,status,cv,whychooseyou) VALUES 
                    ('$firstname','$lastname','$mobile','$specialization','$password','$status','$cv','$whychooseyou')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $msg = "<div class='alert alert-info'>Application sent successfully.</div>";
        }
    }
   
   

}
mysqli_close($conn);

?>
<?php
include 'homeincludes/header.php';
include 'homeincludes/navbar.php';
?>

<main class=" bg-light col-md-8 mx-auto mt-4">
    <div class="row col-md-8">

        <div class="row-item col-md-9 mx-auto fs-5">
            <em>Nurse/Doctor Role Application <span style="color:#0dcaf0;">HomeTiba</span></em>
        </div>
    </div>
    <hr style="color:#ff2400">
    <div class="col-md-11 mx-auto aleart alert-danger">
        <?php echo $msg ?>
    </div>
    <form class="container-fluid " method="POST" enctype="multipart/form-data">
        <!-- section for personal details -->
        <div class="row mb-2">
            <div class="col-md-3">
                <h6 style="font-family: italic;font-weight:bold">Personal Details <span style="color: red;">*</span>
                </h6>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <input type="text" class="input-sm form-control my-1" placeholder="First Name"
                        onkeydown="return /[a-z]/i.test(event.key)" name="firstname" autocomplete="off" required>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <input type="text" class="input-sm form-control my-1" placeholder="Last Name"
                        onkeydown="return /[a-z]/i.test(event.key)" name="lastname" autocomplete="off" required>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <input type="text" class="input-sm form-control my-1" name="mobile" placeholder="phone No. 254..."
                        onkeypress="return onlyNumberKey(event)" pattern="[2]{1}[5]{1}[4]{1}[0-9]{9}" maxlength="12"
                        minlength="12" required>
                </div>
            </div>
        </div>
        <!-- file upload for identification card -->
        <div class="row mb-2 ">
            <div class="col-md-3">
                <h6 style="font-family: italic;font-weight:bold">Updated CV <span style="color: red;">*</span></h6>
            </div>
            <div class="col-md-9">
                <div class="form-group">
                    <input class="form-control file-loading my-1" name="cv" type="file" accept="application/pdf"
                        autocomplete="off" required>
                </div>
            </div>
        </div>
        <!-- row for role details -->
        <div class="row mb-2">
            <div class="col-md-3">
                <h6 style="font-family: italic;font-weight:bold">Role Details <span style="color: red;">*</span>
                </h6>
            </div>
            <div class="col-md-9">
                <label class="label-control">Specialization <span style="color: red;">*</span></label>
                <select class="input-sm form-control my-1" name="role" required>
                    <option disabled value="">Choose</option>
                    <option value="doctor">Doctor</option>
                    <option value="nurse">Nurse</option>
                </select>
            </div>
        </div>
        <!-- whychooseyou -->
        <div class="row mb-2">
            <div class="col-md-3">
                <h6 style="font-family: italic;font-weight:bold">Why Hire you? <span style="color: red;">*</span>
                </h6>
            </div>
            <div class="col-md-9">
                <div class="form-group">
                    <textarea class="input-sm form-control my-1" name="whychooseyou"   autocomplete="off" required>
                    </textarea>
                </div>
            </div>
        </div>
        <!-- password -->
        <div class="row mb-2">
            <div class="col-md-3">
                <h6 style="font-family: italic; font-weight:bold">password <span style="color: red;">*</span></h6>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <input class="form-control  my-1" name="password" type="password" placeholder=" password"
                        autocomplete="off" required>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <input class="form-control  my-1" name="cpassword" type="password" placeholder="confirm password"
                        autocomplete="off" required>
                </div>
            </div>
        </div>

        <!-- submit button -->
        <div class="form-group text-center ">
            <button type="submit" class="btn text-center col-md-6 my-2 "
                style="background: #0dcaf0;color:white;font-weight:bold;border-radius:20px;"
                name="submit">Apply</button>
        </div>
    </form>
</main>

<?php
include 'homeincludes/footer.php';
?>