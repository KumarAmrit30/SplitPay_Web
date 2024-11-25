<?php
include('header.php');

checkUser();
userArea();

$msg = "";
$category_id = "";
$item = "";
$price = "";
$details = "";
$expense_date = "";
$label = "Add";

// Error Reporting for Debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_GET['id']) && $_GET['id'] > 0) {
    $label = "Edit";
    $id = get_safe_value($_GET['id']);
    $res = mysqli_query($con, "SELECT * FROM expense WHERE id=$id");

    if(mysqli_num_rows($res) == 0){
        redirect('expense.php');
    }
    if ($res && mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);

        $category_id = $row['category_id'];
        $item = $row['item'];
        $price = $row['price'];
        $details = $row['details'];
        $expense_date = $row['expense_date'];
        if($row['added_by'] != $_SESSION['UID']){
            redirect('expense.php');
        }
    }
}

if (isset($_POST['submit'])) {
    $category_id = get_safe_value($_POST['category_id']);
    $item = get_safe_value($_POST['item']);
    $price = get_safe_value($_POST['price']);
    $details = get_safe_value($_POST['details']);
    $expense_date = get_safe_value($_POST['expense_date']);
    $added_on = date('Y-m-d h:i:s'); 

    $added_by = $_SESSION['UID'];

    $sql = "INSERT INTO expense (category_id, item, price, details, added_on, expense_date, added_by) 
            VALUES ('$category_id', '$item', '$price', '$details', '$added_on', '$expense_date', '$added_by')";

    if (isset($_GET['id']) && $_GET['id'] > 0) {
        $sql = "UPDATE expense 
                SET category_id='$category_id', item='$item', price='$price', details='$details', expense_date='$expense_date' 
                WHERE id='$id'";
    }

    if (!mysqli_query($con, $sql)) {
        die("Error executing query: " . mysqli_error($con));
    }

    redirect('expense.php');
}

?>

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                <h2><?php echo $label ?> Expense</h2>
                        <a href="expense.php">Back</a>
                        <br/><br/>
                    <div class="card">
                        

                        <div class="card-body card-block">
                            <form method="post" class="form-horizontal">
                                <div class="form-group">
                                    <label for="category_id" class="col-sm-2 control-label">Category</label>
                                    <div class="col-sm-10">
                                        <select name="category_id" class="form-control">
                                            <?php
                                            $categories = getCategory();
                                            foreach ($categories as $category) {
                                                $selected = ($category['id'] == $category_id) ? 'selected' : '';
                                                echo "<option value='" . $category['id'] . "' " . $selected . ">" . $category['name'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="item" class="col-sm-2 control-label">Item</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="item" required value="<?php echo $item; ?>" class="form-control" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="price" class="col-sm-2 control-label">Price</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="price" required value="<?php echo $price; ?>" class="form-control" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="details" class="col-sm-2 control-label">Details</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="details" required value="<?php echo $details; ?>" class="form-control" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="expense_date" class="col-sm-2 control-label">Expense Date</label>
                                    <div class="col-sm-10">
                                        <input type="date" name="expense_date" required value="<?php echo $expense_date; ?>" class="form-control" required>
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
</div>
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
