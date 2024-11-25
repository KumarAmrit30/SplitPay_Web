<?php
include('header.php');

checkUser();
adminArea();
include('user_header.php');



if(isset($_GET['type']) && $_GET['type'] == 'delete' && isset($_GET['id']) && $_GET['id'] > 0){
    $id = get_safe_value($_GET['id']);
    mysqli_query($con, "delete from category where id='$id'");
    echo "<br/>Category deleted<br/>";
}

$res = mysqli_query($con, "select * from category order by id desc");
?>




<?php 
if(mysqli_num_rows($res) > 0){
?>
<div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                            <h2>Category</h2>
                            <br/>
                            <a href="manage_category.php">Add Category</a>
                            <br/><br/>
                                <div class="table-responsive table--no-card m-b-30">
                                    <table class="table table-borderless table-striped table-earning">
                                        <thead>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Action</th>
    </tr>
    </tr>
    <tbody>
    <?php 
    while($row = mysqli_fetch_assoc($res)){ ?>
    <tr>
        <td><?php echo $row['id'];?></td>
        <td><?php echo $row['name'];?></td>
        <td>
            <a href="manage_category.php?id=<?php echo $row['id'];?>">Edit</a>
            <a href="?type=delete&id=<?php echo $row['id'];?>">Delete</a>
    </tr>
    <?php } ?>
    </tbody>

<?php }else{ ?>
    <h3>No category found</h3>
<?php } ?>

</div>
</div>
</div>
</div>
</div>
</div>
<?php
include('footer.php');
?>