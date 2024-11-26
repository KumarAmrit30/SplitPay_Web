<?php
include('header.php');

checkUser();
userArea();

?>

<div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h2 class="title-1">overview</h2>
                                </div>
                            </div>
                        </div>
                        <div class="row m-t-25">
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c1">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="text">
                                                <h2><?php echo getDashboardExpense('today'); ?></h2>
                                                <span>Today's Expense <br></span>
                                                <a href="dashboard_report.php?from=<?php echo date('Y-m-d'); ?>&to=<?php echo date('Y-m-d'); ?>&type=today" class="detail_link" > Details </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c2">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            
                                            <div class="text">
                                                <h2><?php echo getDashboardExpense('yesterday'); ?></h2>
                                                <span>Yesterday's Expense</span>
                                                <a href="dashboard_report.php?from=<?php echo date('Y-m-d', strtotime('yesterday')); ?>&to=<?php echo date('Y-m-d', strtotime('yesterday')); ?>&type=yesterday" class="detail_link">Details</a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c3">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            
                                            <div class="text">
                                                <h2><?php echo getDashboardExpense('week'); ?></h2>
                                                <span>This week's Expense</span>
                                                <a href="dashboard_report.php?from=<?php echo date('Y-m-d', strtotime('-1 week')); ?>&to=<?php echo date('Y-m-d'); ?>&type=week" class="detail_link">Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c4">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            
                                            <div class="text">
                                                <h2><?php echo getDashboardExpense('month'); ?></h2>
                                                <span>This month's Expense</span>
                                                <a href="dashboard_report.php?from=<?php echo date('Y-m-d', strtotime('-1 month')); ?>&to=<?php echo date('Y-m-d'); ?>&type=month" class="detail_link">Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c3">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            
                                            <div class="text">
                                                <h2><?php echo getDashboardExpense('year'); ?></h2>
                                                <span>This year's Expense <br></span>
                                                <a href="dashboard_report.php?from=<?php echo date('Y-m-d', strtotime('-1 year')); ?>&to=<?php echo date('Y-m-d'); ?>&type=year" class="detail_link">Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c4">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            
                                            <div class="text">
                                                <h2><?php echo getDashboardExpense('total'); ?></h2>
                                                <span>Total Expense <br></span>
                                                <a href="dashboard_report.php?type=total" class="detail_link">Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>



<br/><br/>

<?php
include('footer.php');
?>
