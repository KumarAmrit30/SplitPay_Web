<?php
function prx($data){
    echo '<pre>';
    print_r($_POST);
    die();
}
function get_safe_value($data) {
    global $con;

    if (!isset($data) || $data === '') {
        return ''; // Return an empty string for null or empty input
    }

    return mysqli_real_escape_string($con, $data);
}

function redirect($link) {
    if (headers_sent()) {
        // Use JavaScript redirection if headers are already sent
        ?>
        <script>
            window.location.href = "<?php echo $link; ?>";
        </script>
        <?php
    } else {
        // Use PHP header redirect
        header("Location: $link");
        exit();
    }
    die();
}


function checkUser(){
    if(isset($_SESSION['UID']) && $_SESSION['UID'] != ''){
        
    }else{
        redirect('index.php');
    }
}

function getCategory() {
    global $con;
    $data = array();
    $res = mysqli_query($con, "SELECT * FROM category ORDER BY name ASC");

    if (!$res) {
        die("Error fetching categories: " . mysqli_error($con));
    }

    while ($row = mysqli_fetch_assoc($res)) {
        $data[] = $row;
    }
    return $data;
}
function getDashboardExpense($type) {
    global $con;
    $today = date('Y-m-d'); 
    $sub_sql = "";

    if ($type == 'today') {
        $sub_sql = " AND expense_date = '$today'";
    } elseif ($type == 'yesterday') {
        $from = date('Y-m-d', strtotime('yesterday'));
        $sub_sql = " AND expense_date = '$from'";
    } elseif ($type == 'week') {
        $from = date('Y-m-d', strtotime('-1 week'));
        $to = $today;
        $sub_sql = " AND expense_date BETWEEN '$from' AND '$to'";
    } elseif ($type == 'month') {
        $from = date('Y-m-d', strtotime('-1 month'));
        $to = $today;
        $sub_sql = " AND expense_date BETWEEN '$from' AND '$to'";
    } elseif ($type == 'year') {
        $from = date('Y-m-d', strtotime('-1 year'));
        $to = $today;
        $sub_sql = " AND expense_date BETWEEN '$from' AND '$to'";
    }

    $query = "SELECT SUM(price) AS price FROM expense where added_by = {$_SESSION['UID']} $sub_sql";
    $res = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($res);

    return isset($row['price']) ? $row['price'] : 0;
}

function adminArea(){
    if($_SESSION['UROLE']!='Admin' ){
        redirect('dashboard.php');
    }
}

function userArea(){
    if($_SESSION['UROLE']!='User' ){
        redirect('user.php');
    }
}

?>