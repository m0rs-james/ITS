    <!-- PopUp Modal jQuery Script -->
    <script type="text/javascript" src='https://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.3.min.js'></script>

    <!-- SweetAlert -->
    <script src="../js/sweetalert.min.js"></script>
    <?php
        
        if (isset($_SESSION['status']) && $_SESSION['status'] !='') {
          ?>
          <script>
            swal({
                title: "<?php echo $_SESSION['status']; ?>",
                icon: "<?php echo $_SESSION['status_code']; ?>",
                button: "Ok",
            });
          </script>
      <?php
          unset($_SESSION['status']);
        }
      ?>