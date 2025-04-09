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
                <h2>All User</h2>
              </div>
              <div class="col-sm-6 text-end">
                <a href="user_create.php" class="btn btn-primary btn-lg">Add New</a>
              </div>
            </div>
          </div>
          <table class="table table-striped table-bordered auto-width-table">
            <thead>
              <tr>
                <th scope="col" style="width: 30px;">SL</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col" colspan="2" style="width: 100px;">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $sql = 'SELECT * FROM users';
              $result = mysqli_query($config, $sql);
              $row = mysqli_num_rows($result);
              // var_dump($row);
              if ($row > 0) {
                $key = 1;

                while ($item = mysqli_fetch_assoc($result)) {
                  ?>
                  <tr>
                    <th scope="row"><?php echo $key++; ?></th>
                    <td><?php echo $item['name']; ?></td>
                    <td><?php echo $item['email']; ?></td>
                    <td><?php
                    $role = $item['role'] == 1 ? "Admin" : "User";
                    echo $role;
                    ?></td>
                    <td style="width: 50px;">
                      <span>
                        <form action="" method="POST" onsubmit="return confirm('Are you sure to Delete this user?')">
                          <input type="hidden" name="delete_user_id" value="<?php echo $item['user_id']; ?>">
                          <button type="submit" name="delete_user" class="btn btn-danger">Delete</button>
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

if (isset($_POST['delete_user'])) {
  $user_id = mysqli_real_escape_string($config, $_POST['delete_user_id']);
  $sql = "DELETE FROM users WHERE user_id = '{$user_id}'";
  $result = mysqli_query($config, $sql);
  if ($result) {
    $msg = ['User Deleted Successfully', 'success'];
    $_SESSION['message'] = $msg;
    header("location: user_all.php");
  } else {
    $msg = ['User Not Deleted', 'danger'];
    $_SESSION['message'] = $msg;
    header("location: user_all.php");
  }
}

