<?php
include('header.php');

checkUser();
userArea();


// Default query for all categories
$query = "SELECT SUM(expense.price) AS price, category.name 
          FROM expense, category 
          WHERE expense.category_id = category.id and expense.added_by='$_SESSION[UID]'";

// Modify the query if a category is selected
if (isset($_GET['category_id']) && $_GET['category_id'] !== '') {
    $category_id = get_safe_value($_GET['category_id']);
    $query .= " AND expense.category_id = '$category_id'";
}

// Group by category if no specific category is selected
if (!isset($_GET['category_id']) || $_GET['category_id'] === '') {
    $query .= " GROUP BY expense.category_id";
}

$res = mysqli_query($con, $query);

// Initialize total price
$final_price = 0;
?>

<div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">

<form method="get" action="">
    <select name="category_id" onchange="this.form.submit()">
        <option value="">-- All Categories --</option>
        <?php
        $categories = getCategory();
        foreach ($categories as $category) {
            $selected = (isset($_GET['category_id']) && $_GET['category_id'] == $category['id']) ? 'selected' : '';
            echo "<option value='" . $category['id'] . "' " . $selected . ">" . $category['name'] . "</option>";
        }
        ?>
    </select>
</form>
<br/><br/>

<h2>Reports</h2>
                            
                            <br/><br/>
                                <div class="table-responsive table--no-card m-b-30">
                                    <table class="table table-borderless table-striped table-earning">
                                        <thead>
    <tr>
        <th>Category</th>
        <th>Price</th>
    </tr>
</thead>
<tbody>
    <?php 
    while ($row = mysqli_fetch_assoc($res)) { 
        $final_price += $row['price'];
    ?>
    <tr>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['price']; ?></td>
    </tr>
    <?php } ?>
    <tr>
        <th>Total</th>
        <th><?php echo $final_price; ?></th>
    </tr>
</table>
    </tbody>
    

                            </div>
                        </div>
                    </div>
                </div>
            </div>

<?php
include('footer.php');
?>
