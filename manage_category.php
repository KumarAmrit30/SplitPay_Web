<?php
include('header.php');

checkUser();
adminArea();
$msg = "";
$category = "";
$label = "Add";
if (isset($_GET['id']) && $_GET['id'] > 0) {
    $label = "Edit";
    $id = get_safe_value($_GET['id']);
    $res = mysqli_query($con, "select * from category where id=$id");
    $row = mysqli_fetch_assoc($res);
    $category = $row['name'];
}
if (isset($_POST['submit'])) {

    $name = get_safe_value($_POST['name']);

    $type = "add";
    $sub_sql = "";
    if (isset($_GET['id']) && $_GET['id'] > 0) {
        $type = "edit";
        $sub_sql = " and id!='$id'";
    }

    $res = mysqli_query($con, "select * from category where name='$name' $sub_sql");

    if (mysqli_num_rows($res) > 0) {
        $msg = 'Category already exists';
    } else {
        $sql = "insert into category(name) values('$name')";
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $sql = "update category set name='$name' where id='$id'";
        }
        mysqli_query($con, $sql);
        redirect('category.php');
    }
}

?>

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h2><?php echo $label ?> Category</h2>
                    <a href="category.php">Back</a>
                    <br/><br/>
                    <div class="card">
                        <div class="card-body card-block">
                        <form method="post" class="form-horizontal">

                                <div class="form-group">
                                    <label for="item" class="col-sm-2 control-label">Name: </label>
                                    <div class="col-sm-10">
                                        <input type="text" name="name" required value="<?php echo $category; ?>" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <input type="submit" name="submit" required value="Submit" class="btn btn-lg btn-info btn-block">
                                    </div>
                                </div>

                            </form>
                            <?php echo $msg; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include('footer.php');
?>