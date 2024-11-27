<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<?php include 'Component/head.php' ?>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

        <header id="page-topbar">
            <div class="layout-width">
                <?php include './Component/header.php' ?>
            </div>
        </header>
        <!-- ========== App Menu ========== -->
        <?php include './Component/asside.php' ?>
        <!-- Left Sidebar End -->
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">User List</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="card-header">
                        <div class="card">
                            <div class="card-body">
                                <button type="button" class="btn btn-success btn-animation waves-effect waves-light" data-text="Add User" data-bs-toggle="modal" data-bs-target="#myModal"><span>Add User</span></button>
                                <br>
                                <br>
                                <div class="table-responsive">
                                    <table id='example' class="table table-primary table-striped align-middle table-nowrap mb-0">
                                        <thead>
                                            <tr>
                                                <th scope="col">Id</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Phone Number</th>
                                                <th scope="col" class="text-center">#</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            include('../dbConnect.php');
                                            $query = "SELECT profile.*, user.password, user.email
                                            FROM user
                                            JOIN profile ON user.id=profile.user_id
                                            WHERE user.role='User'";
                                            $result = $conn->query($query);
                                            $modal = 1;
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    $nama = $row['nama'];
                                                    $noFon = $row['noFon'];
                                                    $pass = $row['password'];
                                                    $email = $row['email'];
                                                    $userId = $row['user_id'];
                                                 
                                           
                                                    $color='success';
                                                    echo "
                                                        <tr class='table-$color'>
                                                        <th scope='row'>$modal</th>
                                                        <td>$email</td>
                                                        <td>$nama</td>
                                                        <td>$noFon</td>
                                                        <td >
                                                            <center>
                                                                <button type='button' class='btn btn-primary btn-animation waves-effect waves-light data-text='Update' data-bs-toggle='modal' data-bs-target='#view2$modal'>
                                                                    Update
                                                                </button>
                                                                <a href='./Api/removeUser.php?userId=$userId' class='btn btn-danger btn-animation waves-effect waves-light data-text='Buang'>
                                                                    Remove
                                                                </a>
                                                                <a href='./userNote.php?userId=$userId' class='btn btn-info btn-animation waves-effect waves-light'>
                                                                    User Note
                                                                </a>
                                                            </center>
                                                        </td>
                                                    </tr>
                                                        ";
                                                     
                                                    echo "
                                                        <div id='view2$modal' class='modal fade' tabindex='-1' aria-labelledby='myModalLabel' aria-hidden='true' style='display: none;'>
                                                            <div class='modal-dialog'>
                                                                <div class='modal-content'>
                                                                    <div class='modal-header'>
                                                                        <h5 class='modal-title' id='myModalLabel'>Update User</h5>
                                                                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'> </button>
                                                                    </div>
                                                                    <form method='post' action='Api/updateUser.php'>
                                                                        <div class='modal-body'>
                                                                                <div class='col-md-12'>
                                                                                    <label for='inputEmail4' class='form-label'>Nama</label>
                                                                                    <input type='text' class='form-control' name='nama' value='$nama' required>
                                                                                </div>
                                                                           
                                                                                <div class='col-md-12'>
                                                                                    <label for='inputEmail4' class='form-label'>Email</label>
                                                                                    <input type='text' class='form-control' name='email' disabled value='$email' >
                                                                                </div>
                                                                           
                                                                                <div class='col-md-12'>
                                                                                    <label for='inputEmail4' class='form-label'>No. Telefon</label>
                                                                                    <input type='text' class='form-control' name='noFon' value='$noFon'  required>
                                                                                </div>
                                                                                <div class='col-md-12'>
                                                                                    <label for='inputEmail4' class='form-label'>Password</label>
                                                                                    <input type='password' class='form-control' name='pass' value='$pass' required>
                                                                                </div>
                                                                                <input type='hidden' value='$userId' name='userId' />
                                                                        </div>
                                                                        <div class='modal-footer'>
                                                                            <button class='btn btn-primary ' type='submit'>Update</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    ";
    
    
                                                    $modal++;
                                                }
                                            } else {
                                                echo "
                                                    <tr>
                                                    <td colspan='12' align='center'>No User Add</td>
                                                    </tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div> <!-- end col -->
                    </div>
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
        </div>
        <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->

    <div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="myModalLabel">Add User</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <form method='post' action='Api/addUser.php' enctype='multipart/form-data'>
                    <div class='modal-body'>
                        <h5 class='fs-15'>
                            <span style='color:red;'>*</span>Fill All Information<br>
                        </h5>

                        <div class='col-md-12'>
                            <label for='inputEmail4' class='form-label'>Name</label>
                            <input type='text' class='form-control' name='nama' required>
                        </div>
                    
                      
                        <div class='col-md-12'>
                            <label for='inputEmail4' class='form-label'>Email</label>
                            <input type='text' class='form-control' name='email' required>
                        </div>
                      
                        <div class='col-md-12'>
                            <label for='inputEmail4' class='form-label'>Password</label>
                            <input type='text' class='form-control' name='password' required>
                        </div>
                  
                        <div class='col-md-12'>
                            <label for='inputEmail4' class='form-label'>Phone Number</label>
                            <input type='text' class='form-control' name='noFon' required>
                        </div>
                        <input type='hidden' class='form-control' name='role' value='User'/>
                    </div>
                    <div class='modal-footer'>
                        <button class='btn btn-primary ' type='submit'>Submit</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <?php include 'Component/footer.php' ?>
    <?php include 'Component/javascript.php' ?>
</body>

</html>