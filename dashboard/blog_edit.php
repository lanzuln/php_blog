<?php
include 'header.php';

$id = $_GET['id'];

if (isset($_SESSION['user_data'])) {
  $auth_id = $_SESSION['user_data']['0'];
}

// all category 
$sql = 'SELECT * FROM categories';
$query = mysqli_query($config, $sql);

// blog from blog id 
$sql2 = "SELECT * FROM blogs LEFT JOIN categories ON blogs.category = categories.cat_id 
LEFT JOIN users ON blogs.author_id = users.user_id WHERE blogs.blog_id = {$id}";

$query2 = mysqli_query($config, $sql2);
$result2 = mysqli_fetch_assoc($query2);

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


                <h2>Update Blog</h2>
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
                  <div class="mb-3">
                    <label class="form-label">Select Category</label>
                    <select name="cat_name_update" id="" class="form-control">
                      <?php while ($item = mysqli_fetch_assoc($query)): ?>
                        <option value="<?php echo $item['cat_id'] ?>" <?php if ($item['cat_id'] == $result2['category'])
                             echo "selected" ?>>
                          <?php echo $item['cat_name'] ?>
                        </option>
                      <?php endwhile; ?>
                    </select>
                  </div>

                  <div class="mb-3">
                    <label for="input_title" class="form-label">Blog Title</label>
                    <input type="text" class="form-control" value="<?php echo $result2['blog_title'] ?? "" ?>"
                      id="input_title" name="blog_Title_update" Required>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Blog Content</label>
                    <textarea Required class="form-control" name="blog_content_update" id="textarea">
                    <?php echo $result2['blog_body'] ?? "" ?>
                    </textarea>
                  </div>
                  <!-- preview image   -->
                  <div class="mb-3">
                    <input type="image" style="max-width: 150px;" src="<?php echo $result2['blog_image'] ?? "" ?>"
                      alt="">
                  </div>

                  <div class="mb-3">
                    <label for="input_file" class="form-label">Blog Image</label>
                    <input type="file" class="form-control" name="blog_image_update" id="input_file"
                      aria-describedby="emailHelp">
                  </div>

                  <button type="submit" name="add_blog_update" class="btn btn-primary">Update</button>
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
if (isset($_POST['add_blog_update'])) {
  $title = mysqli_real_escape_string($config, $_POST['blog_Title_update']);
  $desc = mysqli_real_escape_string($config, $_POST['blog_content_update']);
  $blog_cat = mysqli_real_escape_string($config, $_POST['cat_name_update']);

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

  $blog_image = $_FILES['blog_image_update']['name']; //extension সহ নামটা । ex- flower.png
  $blog_image_tmp = $_FILES['blog_image_update']['tmp_name']; // এই file er জন্য একটা temporary path ।
  $blog_image_ext = strtolower(pathinfo($blog_image, PATHINFO_EXTENSION)); // just image এর extension টা দেয়।
  $allow_type = ['jpg', 'png', 'jpeg'];
  $local_path = 'uploads/' . $blog_image;
  $blog_image_size = $_FILES['blog_image_update']['size'];

  if (!empty($blog_image)) {
    if (in_array($blog_image_ext, $allow_type)) {
      if ($blog_image_size < 5000000) {
        unlink($blog_image);
        move_uploaded_file($blog_image_tmp, $local_path);

        // $sql = "INSERT INTO blogs (blog_title, blog_body, blog_image, category, author_id) 
        $sql3 = "UPDATE blogs SET 
      blog_title = '$title', 
      blog_body = '$desc', 
      blog_image = '$local_path', 
      category = '$blog_cat' ,
      author_id = '$auth_id'
      WHERE blog_id = '$id'";
        $result3 = mysqli_query($config, $sql3);
        if ($result3) {
          $msg = ["Blog Added With Image Successfully", "success"];
          $_SESSION['message'] = $msg;
          header("location: index.php");
        } else {
          $msg = ['Blog Not Added', 'danger'];
          $_SESSION['message'] = $msg;
          header("location: index.php");
        }
      } else {
        $msg = ['Image Size Should be less than 5MB', 'danger'];
        $_SESSION['message'] = $msg;
        header("location: index.php");
      }
    } else {
      $msg = ['Invalid Image Format', 'danger'];
      $_SESSION['message'] = $msg;
      header("location: index.php");
    }
  } else {
    $sql = "UPDATE blogs SET blog_title = '$title', 
  blog_body = '$desc', 
  category = '$blog_cat' ,
  author_id = '$auth_id'
  WHERE blog_id = '$id'";
    $result = mysqli_query($config, $sql);
    if ($result) {
      $msg = ["Blog Added without Image Successfully", "success"];
      $_SESSION['message'] = $msg;
      header("location: index.php");
    } else {
      $msg = ['Blog Not Added', 'danger'];
      $_SESSION['message'] = $msg;
      header("location: index.php");

    }
  }
}
?>