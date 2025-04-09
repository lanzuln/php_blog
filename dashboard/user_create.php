<?php
ob_start();

include 'header.php'; ?>

<?php
if (isset($_POST['register_user'])) {
  $user_name = mysqli_real_escape_string($config, $_POST['name']);
  $email = mysqli_real_escape_string($config, $_POST['email']);
  $pass = mysqli_real_escape_string($config, sha1($_POST['password']));
  $con_pass = mysqli_real_escape_string($config, sha1($_POST['confirm_password']));
  $role = mysqli_real_escape_string($config, $_POST['role']);

  if (strlen($user_name) < 4 || strlen($user_name) > 100) {
    $error = "User name must be between 4 and 100 characters";
  } elseif (strlen($pass) < 4) {
    $error = "Password must be at least 4 characters";
  } elseif ($pass !== $con_pass) {
    $error = "Password does not match";
  }elseif ($role !== '0' && $role !== '1') {
    $error = "Please select a valid role";
  }else {
    $email_sql = "SELECT * FROM users WHERE email = '$email'";
    $email_query = mysqli_query($config, $email_sql);
    $email_count = mysqli_num_rows($email_query);
    if ($email_count > 0) {
      $error = "Email already exists";
    }else{
      $sql = "INSERT INTO users (name, email, password, role) VALUES ( '$user_name', '$email', '$pass', '$role')";
      $result = mysqli_query($config, $sql);
      if ($result) {
        $msg = ['User Added Successfully', 'success'];
        $_SESSION['message'] = $msg;
        header("location: user_all.php");
      } else {
        $msg = ['User Not Added', 'danger'];
        $_SESSION['message'] = $msg;
        header("location: user_all.php");
      }
    }
   
  }

}
?>

<main class="app-main">

  <div class="app-content">
    <!--begin::Container-->
    <div class="container-fluid">
      <!--begin::Row-->
      <div class="row d-flex justify-content-center">
        <div class="col-md-10">

          <div class="section_heading">
            <div class="row">
              <div class="col-sm-6">


                <h2>Create New User</h2>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Simple Tables</li>
                </ol>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card">
              <div class="card-body">
                <?php if (!empty($error)): ?>
                  <div class="alert alert-danger" role="alert">
                    <?php echo $error; ?>
                  </div>
                <?php endif; ?>

                <form method="POST" action="">
                  <div class="mb-3">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="name" name="name"
                      value="<?php echo (!empty($error)) ? $user_name : ''; ?>">
                  </div>

                  <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email"
                      value="<?php echo (!empty($error)) ? $email : ''; ?>">
                  </div>

                  <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                  </div>

                  <div class="mb-3">
                    <label for="confirm_password" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                  </div>

                  <div class="mb-3">
                    <label for="role" class="form-label">Select Role</label>
                    <select class="form-control" id="role" name="role">
                      <option value=" ">-- Select Role --</option>
                      <option value="1">Admin</option>
                      <option value="0">User</option>
                    </select>
                  </div>

                  <button type="submit" name="register_user" class="btn btn-primary">Register</button>
                  <a class="btn btn-danger" href="user_all.php">Back</a>
                </form>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<?php include 'footer.php'; ?>