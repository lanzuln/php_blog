<?php
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
                <h2>All Category</h2>
              </div>
              <div class="col-sm-6 text-end">
                <a href="Category_create.php" class="btn btn-primary btn-lg">Add New</a>
              </div>
            </div>
          </div>
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">SL</th>
                <th scope="col">Category Id</th>
                <th scope="col">Category Name</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $sql = 'SELECT * FROM categories';
              $result = mysqli_query($config, $sql);
              $row = mysqli_num_rows($result);
              $all_category = mysqli_fetch_assoc($result);
              if ($row > 0) {
                $key = 1; 
            
                while ($item = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <th scope="row"><?php echo $key++; ?></th>
                        <td><?php echo $item['cat_id']; ?></td>
                        <td><?php echo $item['cat_name']; ?></td>
                        <td class="action_td">
                            <span><a href="" class="btn btn-primary">Edit</a></span>
                            <span>
                            <form action="" method="POST" onsubmit="return confirm('Are you sure to Delete it?')">
                                <input type="hidden" name="delete_cat_id" value="<?php echo $item['cat_id']; ?>">
                                <button type="submit" name="delete_cat" class="btn btn-danger">Delete</button>
                            </form>
                            </span>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                echo "<tr><td colspan='4'>No Data Found</td></tr>";
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

// if (isset($_POST['delete_cat'])) {
//     $cat_id = $_POST['delete_cat_id'];
//     $sql = "DELETE FROM categories WHERE cat_id = '$cat_id'";
//     $result = mysqli_query($config, $sql);
//     if ($result) {
//         $msg = ['Category Deleted Successfully', 'success'];
//         $_SESSION['message'] = $msg;
//         header("location: category_all.php");
//     } else {
//         $msg = ['Category Not Deleted', 'danger'];
//         $_SESSION['message'] = $msg;
//         header("location: category_all.php");
//     }
// }

