<?php
session_start();
include '../includes/header.php';
?>

<div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">
        <!-- Size of the outer card -->
        <div class="col-xl-6 col-lg-6 col-md-6">

            <div class="card o-hidden border-1 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <!-- Size of the inner card -->
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Skin Magical Southside</h1>
                                </div>

                                <form class="user" action="../process/loginProcess.php?action=login" method="POST">
                                    <div class="form-group">
                                        <input type="text" name="username" class="form-control form-control-user"
                                            placeholder="Enter Username..." required>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control form-control-user"
                                            placeholder="Password" required>
                                    </div>
                                    <!-- <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" class="custom-control-input" id="customCheck">
                                            <label class="custom-control-label" for="customCheck">Remember
                                                Me</label>
                                        </div>
                                    </div> -->
                                    <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ajax script for popup modal & sweetAlert -->
<?php
    include '../includes/scripts2.php';
?>

<?php 
include '../includes/footer.php';
?>