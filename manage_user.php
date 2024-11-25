<?php
include('header.php');

checkUser();
adminArea();
$msg = "";
$username = "";
$password = "";
$role = "User"; // New variable for role
$label = "Add";

if(isset($_GET['id']) && $_GET['id'] > 0){
    $label = "Edit";
    $id = get_safe_value($_GET['id']);
    $res = mysqli_query($con, "select * from users where id=$id");
    $row = mysqli_fetch_assoc($res);
    $username = $row['username'];
    $password = $row['password'];
    // $role = $row['role']; Get the role value from the database
}

if(isset($_POST['submit'])){
    $username = get_safe_value($_POST['username']);
    $password = get_safe_value($_POST['password']);
    // $role = get_safe_value($_POST['role']);  Get the role value from the form

    $type = "add";
    $sub_sql = "";
    if(isset($_GET['id']) && $_GET['id'] > 0){
        $type = "edit";
        $sub_sql = " and id!='$id'";
    }

    $res = mysqli_query($con, "select * from users where username='$username' $sub_sql");

    if(mysqli_num_rows($res) > 0){
        $msg = 'Username already exists';
    }else{
        $sql = "insert into users(username, password, role) values('$username', '$password', '$role')";
        if(isset($_GET['id']) && $_GET['id'] > 0){
            $sql = "update users set username='$username', password='$password', role='$role' where id='$id'";
        }
        mysqli_query($con, $sql);
        redirect('user.php');
    }
}

?>
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                <h2><?php echo $label ?> User</h2>
                        <a href="user.php">Back</a>
                        <br/><br/>
                    <div class="card">
                        

                        <div class="card-body card-block">
                            <form method="post" class="form-horizontal">
                                <div class="form-group">
                                <label for="item" class="col-sm-2 control-label">Username</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="username" required value="<?php echo $username; ?>" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                <label for="price" class="col-sm-2 control-label">Password</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="password" required value="<?php echo $password; ?>" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <input type="submit" name="submit" required value="Submit" class="btn btn-lg btn-info btn-block">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php echo $msg; ?>

<?php
include('footer.php');
?>