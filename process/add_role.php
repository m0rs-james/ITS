<?php

include '../process/categoryProcess.php'; 

    if (isset($_SESSION['message'])):
?>
    <div class="alert alert-<?php $_SESSION['msg_type'] ?>">
        <p><?php echo $_SESSION['message'];?></p>

        <?php unset($_SESSION['message']); ?>
        <script language="javascript">
                alert("Category has been updated successfully");
                top.location.href = "../pages/productCategory.php"; //the page to redirect
        </script>
    </div>
    <?php endif ?>