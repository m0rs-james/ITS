<?php  
    include '../process/chart.php';
    
    // for navigation active link
    $page = "dashboard";

    include '../includes/header.php';
    include '../includes/sidebar.php';
    include '../includes/topbar.php';

    
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a id="report" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
    

    <!-- Script for report -->
    <script type="text/javascript">
    $(function () {
        $("a[id='report']").click(function () {
            $("#viewReport").modal("show");
            return false;
        });
        });
    </script>

    <!-- For daily datepicker script  -->
    <script>
    $(function () {
        $("#dateDaily").datepicker({
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            changeYear: true
        }
        );
    });
    </script>

    <!-- For month datepicker script -->
    <script>
    $(function() {
        $('#dateMonth').datepicker( {
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
            dateFormat: 'yy-mm',
            onClose: function(dateText, inst) { 
                var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                $(this).datepicker('setDate', new Date(year, month, 1));
            }
        });
        $("#dateMonth").focus(function () {
        $(".ui-datepicker-calendar").hide();
        $("#ui-datepicker-div").position({
            my: "center top",
            at: "center bottom",
            of: $(this)
        });
    });
    });
    </script>

    <!-- For Year datepicker script -->
    <script>
    $(function() {
        $('#dateYear').datepicker( {
            changeYear: true,
            showButtonPanel: true,
            dateFormat: 'yy-mm',
            onClose: function(dateText, inst) { 
                var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                $(this).datepicker('setDate', new Date(year));
            }
        });
        $("#dateYear").focus(function () {
        $(".ui-datepicker-calendar").hide();
        $("#ui-datepicker-div").position({
            my: "center top",
            at: "center bottom",
            of: $(this)
        });
    });
    });
    </script>

    <!-- For Date Range datepicker script -->
    <script>
    $( function() {
    var dateFormat = "mm/dd/yy",
      from = $( "#from" )
        .datepicker({
          defaultDate: "+1w",
          changeMonth: true,
          changeYear: true,
          numberOfMonths: 1
        })
        .on( "change", function() {
          to.datepicker( "option", "minDate", getDate( this ) );
        }),
      to = $( "#to" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        changeYear: true,
        numberOfMonths: 2
      })
      .on( "change", function() {
        from.datepicker( "option", "maxDate", getDate( this ) );
      });
 
    function getDate( element ) {
      var date;
      try {
        date = $.datepicker.parseDate( dateFormat, element.value );
      } catch( error ) {
        date = null;
      }
 
      return date;
    }
  } );
    </script>

    <!-- For displaying the datepicker -->
    <script>
    $(function() {
        $('#selectDate').change(function() {
            $('.dates').hide();
            $('#' + $(this).val()).show();
        });
    });
    </script>

    <!-- View Reports Modal -->
    <div class="modal fade" id="viewReport" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Sales Report</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
        <form action="../pages/generate_pdf.php" method="POST">
            
            <div class="modal-body">

            <div class="form-group">
                <label>Reports</label>
                <select name="selectDate" id="selectDate" class="form-control" required>
                <option value="">Choose what report to be generated</option>
                   
                   <option value="1">Daily</option>
                   <option value="2">Monthly</option>
                   <option value="3">Yearly</option>
                   <option value="4">Date Range</option>

                </select>
            </div>
            <div id="1" class="form-group dates" style="display:none">
                <label> Select date: </label>
                <input type="text" name="selDay" id="dateDaily">
            </div>

            <div id="2" class="form-group dates" style="display:none">
                <label> Select date: </label>
                <input type="text" name="selMonth" id="dateMonth">
            </div>

            <div id="3" class="form-group dates" style="display:none">
                <label> Select date: </label>
                <input type="text" name="selYear" id="dateYear">
            </div>

            <div id="4" class="form-group dates" style="display:none">
                <label for="from">From</label>
                <input type="text" id="from" name="from">
                <label for="to">to</label>
                <input type="text" id="to" name="to">
            </div>
            
                   

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" name="deleteproductbtn" class="btn btn-primary">Submit</button>
            </div>
        </form>

        </div>
    </div>
    </div>
    
    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary border-bottom-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Earnings (Today)</div>
                                <?php
                                    $stmt = "SELECT *, SUM(total) as totalPrice, DATE_FORMAT(sales_date, '%Y-%m-%d') FROM sales INNER JOIN sales_products ON sales.sales_id = sales_products.sales_id WHERE DATE(sales_date) = CURDATE()";
                                    $resultStmt = mysqli_query($db, $stmt);

                                    while ( $row = mysqli_fetch_assoc($resultStmt)){
                                    ?>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">₱ <?php if ($row['totalPrice'] == 0) { echo 0; } else { echo number_format($row['totalPrice']);} ?></div>
                                    <?php
                                    }
                                ?>
                           
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-wallet fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info border-bottom-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Earnings (<?php echo date('F') ?>)</div>

                                <?php
                                    $month = "SELECT MONTH(sales_date), SUM(total) as totalPrice FROM sales INNER JOIN sales_products ON sales.sales_id = sales_products.sales_id WHERE YEAR(sales_date) = YEAR(CURDATE())";
                                    $monthResult = mysqli_query($db, $month);
                                    while ($row = mysqli_fetch_assoc($monthResult)) {
                                        ?>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">₱ <?php echo number_format($row['totalPrice'])  ?></div>
                                        <?php
                                    }
                                ?>
                            
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-money-bill-wave fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        

    <script type="text/javascript" src='https://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.3.min.js'></script>


    <!-- Script for low stock -->
    <script type="text/javascript">
    $(function () {
        $("a[class='lowstock']").click(function () {
            $("#lowStock").modal("show");
            return false;
        });
        });
    </script>
    <!-- Script for Out of stock -->
    <script type="text/javascript">
    $(function () {
        $("a[class='outofstock']").click(function () {
            $("#outOfStock").modal("show");
            return false;
        });
        });
    </script>


    <!-- View Low Stock Modal -->
    <div class="modal fade" id="lowStock" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Low Stock Product</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
        <form action="../pages/product.php">
            
            <div class="modal-body">

                    <?php
                        $sql = "SELECT * FROM product WHERE product_quantity >= 1 && product_quantity <= 20";
                        $result = mysqli_query($db, $sql) or die (mysqli_error($db));
                        
                        while ($row = mysqli_fetch_assoc($result)) { ?>
                            <p><?php echo $row['product_name'] . "\n"?></p>
                            <?php
                        }
                    ?>    

            </div>
            <div class="modal-footer">
                <h4>Do you want to re-stock?</h4> 
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <button type="submit" name="deleteproductbtn" class="btn btn-danger">Yes</button>
            </div>
        </form>

        </div>
    </div>
    </div>

    <!-- Out of stock modal -->
    <div class="modal fade" id="outOfStock" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Out of Stock Product</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
        <form action="../pages/product.php">
            
            <div class="modal-body">

                    <?php
                        $sql = "SELECT * FROM product WHERE product_quantity <= 0";
                        $result = mysqli_query($db, $sql) or die (mysqli_error($db));
                        
                        while ($row = mysqli_fetch_assoc($result)) { ?>
                            <p><?php echo $row['product_name'] . "\n"?></p>
                            <?php
                        }
                    ?>    

            </div>
            <div class="modal-footer">
                <h4>Do you want to re-stock?</h4> 
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <button type="submit" name="deleteproductbtn" class="btn btn-danger">Yes</button>
            </div>
        </form>

        </div>
    </div>
    </div>

    

        <!-- Low Stock Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <!-- Clickable Card -->
            <!-- inline css: remove the underline in the link and change the cursor to hand pointer -->
            <a class="lowstock" style="cursor: pointer; text-decoration: none">
                <div class="card border-left-warning border-bottom-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Low stock</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <!-- Query to check for low product stock, if product is less than 20-->
                                    <?php 
                                        $sql = "SELECT * FROM product WHERE product_quantity >= 1 &&  product_quantity <= 20";
                                        $result = mysqli_query($db, $sql) or die (mysqli_error($db));
                                        echo mysqli_num_rows($result);
                                    ?>  
                                </div>
                                
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-shopping-basket fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Out of stock card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <!-- Clickable Card -->
            <!-- inline css: remove the underline in the link and change the cursor to hand pointer -->
            <a class="outofstock" style="cursor: pointer; text-decoration: none">
                <div class="card border-left-danger border-bottom-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                    Out of stock</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <!-- Query to check for low product stock, if product is less than 20-->
                                    <?php 
                                        $sql = "SELECT * FROM product WHERE product_quantity <= 0";
                                        $result = mysqli_query($db, $sql) or die (mysqli_error($db));

                                        echo mysqli_num_rows($result);
                                    ?>  
                                </div>
                                
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-exclamation-triangle fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Pending Delivery -->
        <div class="col-xl-3 col-md-6 mb-4">
            <!-- Clickable Card -->
            <!-- inline css: remove the underline in the link and change the cursor to hand pointer -->
            <a href="../pages/sales.php" style="cursor: pointer; text-decoration: none">
                <div class="card border-left-warning border-bottom-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Pending Delivery</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?php
                                        $month = "SELECT *, COUNT(sales_status) as pending FROM sales WHERE sales_status = 0";
                                        $monthResult = mysqli_query($db, $month);
                                        $row = mysqli_fetch_assoc($monthResult)
                                            ?>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $row['pending'] ?></div>
                                    </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-truck fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <!-- Pending Pick-Up -->
        <div class="col-xl-3 col-md-6 mb-4">
            <!-- Clickable Card -->
            <!-- inline css: remove the underline in the link and change the cursor to hand pointer -->
            <a href="../pages/deliveryShipment.php" style="cursor: pointer; text-decoration: none">
                <div class="card border-left-warning border-bottom-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Pending Pick-Up</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?php
                                        $month = "SELECT *, COUNT(status) as pending FROM shipment WHERE status = 0";
                                        $monthResult = mysqli_query($db, $month);
                                        $row = mysqli_fetch_assoc($monthResult)
                                            ?>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $row['pending'] ?></div>
                                    </div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-motorcycle fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>


    
    
    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Options:</div>
                            <a class="dropdown-item" href="#">Day</a>
                            <a class="dropdown-item" href="#">Month</a>
                            <a class="dropdown-item" href="#">Year</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-12 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Product Stocks</h6>
                    <div class="dropdown no-arrow">
                        <!-- <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div> -->
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body" style="height: 32rem;">
                    <div class="chart-area">
                        <canvas id="barChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        
    <!-- Chart -->
    <script src="../js/Chart.min.js"></script>
            
        
    </div>
    <!-- Line Chart (Earnings) Scripts -->
    <script>
      var ctx = document.getElementById("myChart");
      var data = {
          datasets: [{
              data: [<?php echo $earnings; ?>],
              lineTension: 0.3,
              backgroundColor: "rgba(78, 115, 223, 0.05)",
              borderColor: "rgba(78, 115, 223, 1)",
              pointRadius: 3,
              pointBackgroundColor: "rgba(78, 115, 223, 1)",
              pointBorderColor: "rgba(78, 115, 223, 1)",
              pointHoverRadius: 3,
              pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
              pointHoverBorderColor: "rgba(78, 115, 223, 1)",
              pointHitRadius: 10,
              pointBorderWidth: 2,
              label: 'Earnings'
          }],
          labels: [<?php echo $dates; ?>]
      };

        var lineChart = new Chart(ctx, {
            type: 'line',
            data: data,
            options: {
              maintainAspectRatio: false,
              layout: {
                padding: {
                  left: 10,
                  right: 25,
                  top: 25,
                  bottom: 0
                }
              },
              scales: {
                xAxes: [{
                  time: {
                    unit: 'date'
                  },
                  gridLines: {
                    display: false,
                    drawBorder: false
                  },
                  ticks: {
                    maxTicksLimit: 20
                  }
                }],
                yAxes: [{
                  ticks: {
                    maxTicksLimit: 5,
                    padding: 10,
                    // Include a Peso sign in the ticks
                    callback: function(value, index, values) {
                      return '₱' + number_format(value);
                    }
                  },
                  gridLines: {
                    color: "rgb(234, 236, 244)",
                    zeroLineColor: "rgb(234, 236, 244)",
                    drawBorder: false,
                    borderDash: [2],
                    zeroLineBorderDash: [2]
                  }
                }],
              },
              legend: {
                display: false
              },
              tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                titleMarginBottom: 10,
                titleFontColor: '#6e707e',
                titleFontSize: 14,
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                intersect: false,
                mode: 'index',
                caretPadding: 10,
                callbacks: {
                  label: function(tooltipItem, chart) {
                    var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                    return datasetLabel + ': ₱' + number_format(tooltipItem.yLabel);
                  }
                }
              }
            }
          });
    </script>

  <!-- Pie Chart   -->
    <script>

      var myData = [<?php echo $quantities; ?>];
      var myColors=[];

      $.each(myData, function( index, value ) {
        
        if (value <= 20) {

          myColors[index] = "#f6c23e";

        } else {

          myColors[index] = "#4e73df";

        }
      });

      var ctx = document.getElementById("barChart");
      var data = {
          datasets: [{
              data: myData,
              backgroundColor: myColors,
              hoverBackgroundColor: "#2e59d9",
              borderColor: "#4e73df",
              label: 'Product'
          }],
          labels: [<?php echo $products; ?>]
      };

        var barChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: {
              maintainAspectRatio: true,
              layout: {
                padding: {
                  left: 25,
                  right: 10,
                  top: 25,
                  bottom: 0
                }
              },
              scales: {
                xAxes: [{
                  gridLines: {
                    display: true,
                    drawBorder: true
                  },
                  ticks: {
                    maxTicksLimit: 50
                  },
                  maxBarThickness: 25,
                }],
                yAxes: [{
                  ticks: {
                    min: 0,
                    max: 50,
                    maxTicksLimit: 10,
                    padding: 10,
                  },
                  gridLines: {
                    color: "rgb(234, 236, 244)",
                    zeroLineColor: "rgb(234, 236, 244)",
                    drawBorder: false,
                    borderDash: [2],
                    zeroLineBorderDash: [2]
                  }
                }],
              },
              title: {
                display: true,
                text: 'Orange color indicate low stock warning',
                position: 'top'
              },
              legend: {
                display: false
              },
              tooltips: {
                titleMarginBottom: 10,
                titleFontColor: '#6e707e',
                titleFontSize: 14,
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
              },
            }
          });
    </script>

    <!-- Content Row -->
    

    
        

</div>
<!-- /.container-fluid -->

<!-- ajax script for popup modal & sweetAlert -->
<?php
    include '../includes/scripts2.php';
?>

<!-- End of Main Content -->



<!-- Footer -->
<?php
    include '../includes/footer.php';
?>