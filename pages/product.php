<?php
include '../includes/header.php';
include '../includes/sidebar.html';
include '../includes/topbar.html';
?>

<!-- Content Wrapper -->

<div id="content-wrapper" class="d-flex flex-column">

    <div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Role Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
        <form action="code.php" method="POST">
            

            <div class="modal-body">

                <div class="form-group">
                    <label> Product Name </label>
                    <input type="text" name="username" class="form-control" placeholder="Enter Product Name">
                </div>
                <div class="form-group">
                    <label>Brand</label>
                    <select name="" id="" class="form-control">
                        <option value="">Safeguard</option>
                        <option value="">Dove</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Category</label>
                    <select name="" id="" class="form-control">
                        <option value="">Soap</option>
                        <option value="">Shampoo</option>
                    </select>
                </div>
                <div class="form-group">
                    <label> Price </label>
                    <input type="text" name="username" class="form-control" placeholder="Enter Product Price">
                </div>
                <div class="form-group">
                    <label> Quantity </label>
                    <input type="text" name="username" class="form-control" placeholder="Enter Product Quantity">
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="registerbtn" class="btn btn-primary">Save</button>
            </div>
        </form>

        </div>
    </div>
    </div>

    <div class="contatiner-fluid">
        <!-- Tables -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold- text-primary"> Product
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
                        Add Product
                    </button>
                </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">

                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Brand</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>changes</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Safeguard Fresh Green soap with Family Germ Protection</td>
                                <td>Safeguard</td>
                                <td>Soap</td>
                                <td>₱50.00</td>
                                <td>420</td>
                                <td><button class="btn btn-info">Edit</button>&nbsp<button class="btn btn-danger">Delete</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- This div is not connected to anything but it fixes the position of the footer -->
</div>

<!-- End of contatiner fluid -->

<?php
    include '../includes/footer.php';
?>