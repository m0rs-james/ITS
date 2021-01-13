<?php
// for navigation active link
$page = "sales";

include '../includes/header.php';
include '../includes/sidebar.php';
include '../includes/topbar.php';

include '../config/connection.php';
?>

<!-- Content Wrapper -->

<div id="content-wrapper" class="d-flex flex-column">

    <div class="contatiner-fluid">
        <!-- Tables -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold- text-primary"> Shipment Log
                </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="shipmentTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th width="1%">Shipment ID</th>
                                <th width="1%">Sales ID</th>
                                <th>Courier</th>
                                <th width="13%">Status</th>
                                <th>Date</th>
                                <th>changes</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $selectShipment = "SELECT * FROM shipment INNER JOIN sales ON shipment.sales_id = sales.sales_id
                                INNER JOIN delivery ON shipment.delivery_id = delivery.delivery_id";
                                $selectShipmentResult = mysqli_query($db, $selectShipment) or die (mysqli_error($db));

                                while ($shipmentRow = mysqli_fetch_assoc($selectShipmentResult)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $shipmentRow['shipment_id'] ?></td>
                                        <td><?php echo $shipmentRow['sales_id'] ?></td>
                                        <td><?php echo $shipmentRow['delivery_name'] ?></td>
                                        <td><?php if($shipmentRow['status'] == 0) { ?>
                                            <p class="px-2 py-2 bg-gradient-warning text-black btn-sm">For Pick-Up</p>
                                        <?php } else { ?>
                                            <p class="px-2 py-2 bg-gradient-success text-black btn-sm">Delivered</p>
                                        <?php } ?>
                                        </td>
                                        <td><?php $date = new DateTime($shipmentRow['shipment_updated_at']); echo $date->format('F j, Y g:i a'); ?></td>
                                        <td><?php if($shipmentRow['status'] == 0) {
                                            ?>
                                            <a href="../pages/viewOrder.php?id=<?php echo $shipmentRow['sales_id']?>" class="btn btn-info btn-sm"><i class="fa fa-eye"></i>View</a>&nbsp
                                        <a href="../process/deliveryProcess.php?id=<?php echo $shipmentRow['shipment_id'] ?>" class="btn btn-primary btn-sm"><i class="fa fa-check-square"></i>Picked up</a>
                                            <?php
                                        } else {
                                            ?>
                                            <a href="../pages/viewOrder.php?id=<?php echo $shipmentRow['sales_id']?>" class="btn btn-info btn-sm"><i class="fa fa-eye"></i>View</a>
                                            <?php
                                        } ?>
                                        
                                        </td>
                                    </tr>
                                    <?php
                                }
                            ?>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- This div is not connected to anything but it fixes the position of the footer -->
</div>


<!-- ajax script for popup modal & sweetAlert -->
<?php
    include '../includes/scripts2.php';
?>
<!-- DataTable -->
<script>
    $(document).ready(function() {
        $('#shipmentTable').DataTable();
    } );
</script>

<?php
    include '../includes/footer.php';
?>