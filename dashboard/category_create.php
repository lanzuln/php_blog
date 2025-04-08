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
                <form method="POST">
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Enter Category Name</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="cat_name" Required>
                  </div>
                  <button type="submit" name="add_cat" class="btn btn-primary">Submit</button>
                  <a class="btn btn-danger" href="category_all.php">Back</a>
                </form>
             
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
<?php include 'footer.php'; ?>

<?php
if (isset($_POST['cat_name'])) {
  $category_name = mysqli_real_escape_string($config, $_POST['cat_name']);
  
  $duplicate_category_sql = "SELECT * FROM categories WHERE cat_name = '$category_name'";
  $duplicate_category_query = mysqli_query($config, $duplicate_category_sql);
  $row = mysqli_num_rows($duplicate_category_query);
  if ($row > 0) {
    $msg = ['Category Already Exists', 'danger'];
    $_SESSION['message'] = $msg;
    header("location: category_create.php");
  } else {
    $sql = "INSERT INTO categories (cat_name) value ('$category_name')";
    $result = mysqli_query($config, $sql);
    if ($result) {
      $msg =[ "Category Added Successfully", "success"];
      $_SESSION['message'] = $msg;
      header("location: category_create.php");
    } else {
      $msg = ['Category Not Added', 'danger'];
      $_SESSION['message'] = $msg;
      header("location: category_create.php");
    }
  }
} 
?>