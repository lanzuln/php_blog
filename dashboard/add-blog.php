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

                  <button type="submit" name="add_blog" class="btn btn-primary">Submit</button>
                  <a class="btn btn-danger" href="index.php">Back</a>
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
if (isset($_POST['add_blog'])) {
  $title = mysqli_real_escape_string($config, $_POST['blog_Title']);
  $desc = mysqli_real_escape_string($config, $_POST['blog_content']);
  $blog_cat = mysqli_real_escape_string($config, $_POST['cat_name']);

    /*** 
    $_FILE এর মাঝে এইসব থাকে 

    array(6) {
      ["name"]=>
      string(13) "back part.png"
      ["full_path"]=>
      string(13) "back part.png"
      ["type"]=>
      string(9) "image/png"
      ["tmp_name"]=>
      string(42) "C:\Users\ln\AppData\Local\Temp\php640D.tmp"
      ["error"]=>
      int(0)
      ["size"]=>
      int(175197)
    }
  */

  $blog_image = $_FILES['blog_image']['name']; //extension সহ নামটা । ex- flower.png
  $blog_image_tmp = $_FILES['blog_image']['tmp_name']; // এই file er জন্য একটা temporary path ।
  $blog_image_ext = strtolower(pathinfo($blog_image, PATHINFO_EXTENSION)); // just image এর extension টা দেয়।
  $allow_type = ['jpg', 'png', 'jpeg'];
  $local_path = 'uploads/' . $blog_image;
  $blog_image_size = $_FILES['blog_image']['size'];

  if (in_array($blog_image_ext, $allow_type)) {
    if ($blog_image_size < 5000000) {
      move_uploaded_file($blog_image_tmp, $local_path);

      $sql = "INSERT INTO blogs (blog_title, blog_body, blog_image, category, author_id) 
      value ('$title', '$desc','$local_path', '$blog_cat', '$auth_id')";
      $result = mysqli_query($config, $sql);
      if ($result) {
        $msg = ["Blog Added Successfully", "success"];
        $_SESSION['message'] = $msg;
        header("location: add-blog.php");
      } else {
        $msg = ['Blog Not Added', 'danger'];
        $_SESSION['message'] = $msg;
        header("location: add-blog.php");
      }
    } else {
      $msg = ['Image Size Should be less than 5MB', 'danger'];
      $_SESSION['message'] = $msg;
      header("location: add-blog.php");
    }
  } else {
    $msg = ['Invalid Image Format', 'danger'];
    $_SESSION['message'] = $msg;
    header("location: add-blog.php");
  }
}
?>