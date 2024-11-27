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
                                <h4 class="mb-sm-0">Notes List</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="card-header">
                        <div class="card">
                            <div class="card-body">
                                <button type="button" class="btn btn-success btn-animation waves-effect waves-light" data-text="Add Note" data-bs-toggle="modal" data-bs-target="#myModal"><span>Add Note</span></button>
                                <br>
                                <br>
                                <div class="table-responsive">
                                    <table id='example' class="table table-primary table-striped align-middle table-nowrap mb-0">
                                        <thead>
                                            <tr>
                                                <th scope="col">Id</th>
                                                <th scope="col">Notes</th>
                                                <th scope="col">Date Create</th>
                                                <th scope="col" class="text-center">#</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            include('../dbConnect.php');
                                            $query = "SELECT *
                                            FROM file
                                            WHERE user_id='$uid'";
                                            $result = $conn->query($query);
                                            $modal = 1;
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    $id = $row['id'];
                                                    $note = $row['note'];
                                                    $created_at = $row['created_at'];

                                                    // Create a DateTime object from the current date
                                                    $date = new DateTime($created_at);
                                                    
                                                    // Format the date as 'd-m-Y' (day-month-year)
                                                    $formatted_date = $date->format('d-m-Y');



                                                    $color = 'success';
                                                    echo "
                                                        <tr class='table-$color'>
                                                        <th scope='row'>$modal</th>
                                                        <td>$note</td>
                                                        <td>$formatted_date</td>
                                                     
                                                        <td >
                                                            <center>
                                                                <button type='button' class='btn btn-primary btn-animation waves-effect waves-light data-text='Update' data-bs-toggle='modal' data-bs-target='#view2$modal'>
                                                                    Update
                                                                </button>
                                                                <a href='./Api/removeNote.php?id=$id' class='btn btn-danger btn-animation waves-effect waves-light data-text='Buang'>
                                                                    Remove
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
                                                                        <h5 class='modal-title' id='myModalLabel'>Update Note</h5>
                                                                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'> </button>
                                                                    </div>
                                                                    <form method='post' action='Api/updateNote.php'>
                                                                        <div class='modal-body'>
                                                                                <div class='col-md-12'>
                                                                                    <label for='inputEmail4' class='form-label'>Note</label>
                                                                                    <textarea type='text' class='form-control' name='note' value='$note' row='5' required>$note</textarea>
                                                                                </div>
                                                                                <input type='hidden' value='$id' name='id' />
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
                                                    <td colspan='12' align='center'>No Note Add</td>
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
                    <h3 class="modal-title" id="myModalLabel">Add Note</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <form method='post' action='Api/addNote.php' enctype='multipart/form-data'>
                    <div class='modal-body'>



                        <div class='col-md-12'>
                            <label for='inputEmail4' class='form-label'>Note</label>
                            <textarea type='text' class='form-control' name='note' row='5' required></textarea>
                        </div>
                        <input type='hidden' class='form-control' name='uid' value='<?php echo $uid; ?>' />
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