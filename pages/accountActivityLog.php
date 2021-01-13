<?php
// for navigation active link
$page = "report";

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
                <h6 class="m-0 font-weight-bold- text-primary"> Activity Log
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="activityTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Time</th>
                                <th>Description</th>
                                <th>Area</th>
                                <th>User</th>
                                <th>Permission</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $stmt = "SELECT * FROM activityLog";
                                $selectStmt = mysqli_query($db, $stmt) or die (mysqli_error(($db)));
                                
                                while ($row = mysqli_fetch_assoc($selectStmt)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $row['activity_id'] ?></td>
                                            <td><?php $date = new DateTime($row['entry_date']); echo $date->format('F j, Y g:i a'); ?></td>
                                            <td><?php echo $row['description'] ?></td>
                                            <td><?php echo $row['area'] ?></td>
                                            <td><?php echo $row['user'] ?></td>
                                            <td><?php echo $row['permission'] ?></td>
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
        $('#activityTable').DataTable( {
            // sort by recent inserted data
            aaSorting: [[0, 'desc']]
        });
    } );
</script>

<?php
    include '../includes/footer.php';
?>