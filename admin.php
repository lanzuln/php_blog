<?php
session_start();
include 'config.php';
include 'header.php';

?>

<section class="d-flex justify-content-center align-items-center bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card shadow p-4">
                    <h3 class="text-center mb-4">Welcome</h3>
                    <?php if(isset($_SESSION['user_data'])):?>
                    <div class="alert alert-success mt-5" role="alert">
                        <?php echo "Welcome". $_SESSION['user_data']['2'];?>
                    </div>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </div>
</section>


<?php
include 'footer.php';