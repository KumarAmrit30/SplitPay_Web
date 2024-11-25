<?php
include('header.php');

checkUser();
userArea();


// Get parameters from the URL
$from = isset($_GET['from']) ? $_GET['from'] : '';
$to = isset($_GET['to']) ? $_GET['to'] : '';
$type = isset($_GET['type']) ? ucfirst($_GET['type']) : '';

// Validate and fetch report data
$where = "";
if ($from && $to) {
    $where = " WHERE expense.expense_date BETWEEN '$from' AND '$to'";
}

$query = "
    SELECT category.name AS category_name, SUM(expense.price) AS total_price 
    FROM expense 
    INNER JOIN category ON expense.category_id = category.id AND expense.added_by = {$_SESSION['UID']}
    $where
    GROUP BY expense.category_id
    ORDER BY category.name ASC
";

$res = mysqli_query($con, $query);

?>

<!-- Table for Report -->
<?php if (mysqli_num_rows($res) > 0): ?>
    <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                            <br/>
                            <h2><?php echo $type ? "$type Report" : "Report"; ?></h2>
<p>
    <b>Report Period:</b> 
    <?php echo $from ? date('d-M-Y', strtotime($from)) : 'N/A'; ?> 
    to 
    <?php echo $to ? date('d-M-Y', strtotime($to)) : 'N/A'; ?>
</p>
<br/>                                
<div class="table-responsive table--no-card m-b-30">
    <table class="table table-borderless table-striped table-earning">

    <thead>
        <tr>
            <th>Category</th>
            <th>Total Expense (₹)</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $grand_total = 0;
        while ($row = mysqli_fetch_assoc($res)): 
            $grand_total += $row['total_price'];
        ?>
        <tr>
            <td><?php echo $row['category_name']; ?></td>
            <td><?php echo number_format($row['total_price'], 2); ?></td>
        </tr>
        <?php endwhile; ?>
        <tr>
            <th>Grand Total</th>
            <th><?php echo number_format($grand_total, 2); ?></th>
        </tr>
    </tbody>
</table>
<?php else: ?>
    <p>No expenses found for the selected period.</p>
<?php endif; ?>

<!-- Back Button -->
<br/>


<?php
include('footer.php');
?>
