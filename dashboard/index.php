<?php
include 'header.php';

if (isset($_SESSION['user_data'])) {
  $auth_id = $_SESSION['user_data']['0'];
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
                <h2>All Blog</h2>
              </div>
              <div class="col-sm-6 text-end">
                <a href="add-blog.php" class="btn btn-primary btn-lg">Add New Post</a>
              </div>
            </div>
          </div>
          <table class="table table-striped table-bordered auto-width-table">
            <thead>
              <tr>
                <th scope="col" style="width: 30px;">SL</th>
                <th scope="col" style="width: 100px;">Thumbnail</th>
                <th scope="col">Title</th>
                <th scope="col" style="width: 100px;">Category</th>
                <th scope="col" style="width: 100px;">Author</th>
                <th scope="col" style="width: 150px;">date</th>
                <th scope="col" colspan="2" style="width: 100px;">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $sql = "SELECT * FROM blogs LEFT JOIN categories ON blogs.category = categories.cat_id LEFT JOIN users ON blogs.author_id = users.user_id  WHERE users.user_id = {$auth_id} ORDER BY blogs.publish_date  DESC";
              $result = mysqli_query($config, $sql);
              $row = mysqli_num_rows($result);
              if ($row > 0) {
                $key = 1;

                while ($item = mysqli_fetch_assoc($result)) {
                  ?>
                  <tr>
                    <th scope="row"><?php echo $key++; ?></th>
                    <td>
                      <img style="max-width: 100px;" src="<?php echo $item['blog_image']; ?>" alt="">
                    </td>
                    <td><?php echo $item['blog_title']; ?></td>
                    
                    <td><?php echo $item['cat_name']; ?></td>
                    <td><?php echo $item['name']; ?></td>
                    <td><?php echo date('d-M-Y', strtotime($item['publish_date'])); ?></td>
                    <td style="width: 50px;">
                      <span><a href="blog_edit.php?id=<?php echo $item['blog_id']; ?>"
                          class="btn btn-primary">Edit</a></span>

                    </td>
                    <td style="width: 50px;">
                      <span>
                        <form action="" method="POST" onsubmit="return confirm('Are you sure to Delete This Post?')">
                          <input type="hidden" name="delete_blog_id" value="<?php echo $item['blog_id']; ?>">
                          <input type="hidden" name="delete_blog_image" value="<?php echo $item['blog_image']; ?>">
                          <button type="submit" name="delete_blog" class="btn btn-danger">Delete</button>
                        </form>
                      </span>
                    </td>
                  </tr>
                  <?php
                }
              } else {
                echo "<tr><td colspan='7'>No Data Found</td></tr>";
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
      <!--end::Row-->
    </div>
    <!--end::Container-->
  </div>
  <!--end::App Content-->
</main>
<?php include 'footer.php';

if (isset($_POST['delete_blog'])) {
  $blog_id = $_POST['delete_blog_id'];
  $blog_image = $_POST['delete_blog_image'];
  $sql = "DELETE FROM blogs WHERE blog_id = '$blog_id'";
  $result = mysqli_query($config, $sql);
  if ($result) {
    if (!empty($blog_image)) {
      unlink($blog_image);
    }
    $msg = ['Blog Deleted Successfully', 'success'];
    $_SESSION['message'] = $msg;
    header("location: index.php");
  } else {
    $msg = ['Blog Not Deleted', 'danger'];
    $_SESSION['message'] = $msg;
    header("location: index.php");
  }
}

