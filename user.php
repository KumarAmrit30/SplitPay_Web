<?php
include('header.php');

checkUser();
adminArea();

if(isset($_GET['type']) && $_GET['type'] == 'delete' && isset($_GET['id']) && $_GET['id'] > 0){
    $id = get_safe_value($_GET['id']);
    mysqli_query($con, "delete from users where id='$id'");
    echo "<br/>User deleted<br/>";
}

$res = mysqli_query($con, "select * from users where role='user' order by id desc");
?>

<h2>Users</h2>
<a href="manage_user.php">Add User</a>
<br/><br/>

<?php 
if(mysqli_num_rows($res) > 0){
?>
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Users</h2>
                    <br/>
                    <a href="manage_user.php">Add User</a>
                    <br/><br/>
                    <div class="table-responsive table--no-card m-b-30">
                        <table class="table table-borderless table-striped table-earning">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Username</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                while($row = mysqli_fetch_assoc($res)){ ?>
                                <tr>
                                    <td><?php echo $row['id'];?></td>
                                    <td><?php echo $row['username'];?></td>
                                    <td>
                                        <a href="manage_user.php?id=<?php echo $row['id'];?>">Edit</a>
                                        <a href="?type=delete&id=<?php echo $row['id'];?>">Delete</a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php }else{ ?>
    <h3>No user found</h3>
<?php } ?>

<?php
include('footer.php');
?>