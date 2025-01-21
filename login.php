<?php
ob_start();
session_start();
include 'config.php';
include 'header.php';

?>

<section class="d-flex justify-content-center align-items-center bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card shadow p-4">
                    <h3 class="text-center mb-4">Login</h3>
                    <form method="post">
                        <!-- Email Input -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-control" id="email"
                                placeholder="Enter your email">
                        </div>

                        <!-- Password Input -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="password"
                                placeholder="Enter your password">
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid">
                            <button type="submit" name="submit" class="btn btn-primary">Login</button>
                        </div>

                        <?php if (isset($_SESSION['error'])): ?>
                            <div class="alert alert-danger mt-5" role="alert">
                                <?php echo $_SESSION['error'];
                                unset($_SESSION['error']);
                                ?>
                            </div>
                        <?php endif; ?>

                        <!-- Forgot Password Link -->
                        <!-- <div class="text-center mt-3">
                            <a href="#" class="text-decoration-none">Forgot password?</a>
                        </div> -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
if (isset($_POST['submit'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email= '{$email}' AND password = '{$password}'";
    $query = mysqli_query($config, $sql);

    $data = mysqli_num_rows($query);
    if ($data == 1) {
        $result = mysqli_fetch_assoc($query);
        $user_data = [$result['user_id'], $result['name'], $result['role']];
        $_SESSION['user_data'] = $user_data;

        header("location: dashboard/index.php");

    } else {
        $_SESSION['error'] = "Wrong Credential";
        header("location:login.php");
    }
}
?>

<?php
include 'footer.php';