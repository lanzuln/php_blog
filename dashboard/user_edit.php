<?php
ob_start();

include 'header.php'; ?>

<?php
$id = $_GET['id'];
echo $id;

$sql = "SELECT * FROM categories where cat_id = '$id'";

$query = mysqli_query($config, $sql);
$row = mysqli_fetch_assoc($query);

$cat_name = $row['cat_name'];

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
                    <input type="text" value="<?php echo $cat_name;?>" class="form-control" id="exampleInputEmail1" name="update_cat_name" Required>
                  </div>
                  <button type="submit" name="update_cat" class="btn btn-primary">Submit</button>
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
if (isset($_POST['update_cat'])) {
  $category_name = mysqli_real_escape_string($config, $_POST['update_cat_name']);
  $Update_sql = "UPDATE categories SET cat_name= '$category_name' WHERE cat_id = '$id'";
  $Update_query = mysqli_query($config, $Update_sql);
  if ($Update_query) {
    $msg = ['Category Update Successfully', 'success'];
    $_SESSION['message'] = $msg;
    header("location: category_all.php");
  } else {

      $msg = ['Something went wrong', 'danger'];
      $_SESSION['message'] = $msg;
      header("location: category_edit.php");
    
  }
} 
?>