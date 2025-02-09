<?php
ob_start();
include 'header.php'; ?>

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

                <?php
                if (isset($_SESSION['message'])): ?>
                  <div class="alert alert-danger" role="alert">
                    <?php echo $_SESSION['message']; ?>
                  </div>
                  <?php
                  unset($_SESSION['message']);
                endif;
                ?>
                <h2>Add Category</h2>
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
                <form action="" method="post">
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Enter Category Name</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="cat_name">
                  </div>
                  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </form>
                <?php
                if (isset($_POST['submit'])) {
                  $category_name = mysqli_real_escape_string($config, $_POST['cat_name']);
                  $duplicate_category_sql = "SELECT * FROM categories WHERE cat_name = '$category_name'";
                  $duplicate_category_query = mysqli_query($config, $duplicate_category_sql);
                  $raw = mysqli_num_rows($duplicate_category_query);
                  if ($raw > 0) {
                    $msg = "Category Already Exists";
                    $_SESSION['message'] = $msg;
                  } else {
                    $sql = "INSERT INTO categories (cat_name) value ('$category_name')";
                    $result = mysqli_query($config, $sql);
                    if ($result) {
                      $msg = "Category Added Successfully";
                      $_SESSION['message'] = $msg;
                    } else {
                      $msg = "Category Added Failed";
                      $_SESSION['message'] = $msg;
                    }
                  }
                } else {
                  $msg = "Category Name is Required";
                  $_SESSION['message'] = $msg;
                  header("location:category_create.php");
                }
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--end::Row-->
    </div>
    <!--end::Container-->
  </div>
  <!--end::App Content-->
</main>
<?php include 'footer.php';