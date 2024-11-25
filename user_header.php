<?php
if($_SESSION['UROLE'] == 'User'){
    ?>
    <a href="dashboard.php">Dashboard</a>&nbsp;
    <a href="expense.php">Expense</a>&nbsp;
    <a href="reports.php">Reports</a>&nbsp;
    <a href="logout.php">Logout</a>&nbsp;
    <?php
    
}else{
    ?>
    <a href="category.php">Category</a>&nbsp;
    <a href="user.php">User</a>&nbsp;
    <a href="logout.php">Logout</a>&nbsp;
    <?php
}

?>

