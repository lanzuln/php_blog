<?php


include 'header.php';

if (isset($_SESSION['user_data'])) {
  $auth_id = $_SESSION['user_data']['0'];


}

$sql = 'SELECT * FROM categories';
$query = mysqli_query($config, $sql);
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


                <h2>Add Blog</h2>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Simple Tables</li>
                </ol>
              </div>
            </div>
          </div>
          <div class="col-md-7">
            <div class="card">
              <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                  <?php echo $auth_id; ?>
                  <div class="mb-3">
                    <label class="form-label">Select Category</label>
                    <select name="cat_name" id="" class="form-control">
                      <?php while ($item = mysqli_fetch_assoc($query)): ?>
                        <option value="<?php echo $item['cat_id'] ?>"><?php echo $item['cat_name'] ?></option>
                      <?php endwhile; ?>
                    </select>
                  </div>

                  <div class="mb-3">
                    <label for="input_title" class="form-label">Blog Title</label>
                    <input type="text" class="form-control" id="input_title" name="blog_Title" Required>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Blog Content</label>
                    <textarea Required class="form-control" name="blog_content" id="textarea"></textarea>
                  </div>

                  <div class="mb-3">
                    <label for="input_file" class="form-label">Blog Image</label>
                    <input type="file" Required class="form-control" name="blog_image" id="input_file"
                      aria-describedby="emailHelp">
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
      $msg = ["Category Added Successfully", "success"];
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