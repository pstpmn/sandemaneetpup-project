<?php
require 'header.php';
require 'checkAdmin.php';

?>
<title>Ticket Recode</title>
<?php
require 'navbar.php';
?>
<!-- Body Implement -->


<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">
                <center>จัดการ ราคาตั๋ว</center>
            </h1>
            <br><br>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table mr-1"></i>
                    DataTable Example
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" style="text-align: center;" id="dataTable-TicketPrice" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ลำดับ</th>
                                    <th>ประเภทตั๋ว</th>
                                    <th>ราคา</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody id="table-ticketPrice">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- modal edit employee -->
        <div class="container" style="text-align: center;">
            <!-- Modal -->
            <div class="modal fade" id="modal-ticketPrice" role="dialog">
                <div class="modal-dialog modal-lg">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 id="header-Employee">แก้ไขข้อมูล Location</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body" id="modal-body-slip">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <td scope="col" width="30%"><b>ประเภทตั๋ว</b></td>
                                        <td><input id='text-ticketCategory' type="text" disabled value=""></td>
                                    </tr>
                                    <tr>
                                        <td scope="col" width="30%"><b>ราคา</b></td>
                                        <td><input id='text-ticketPrice' type="text" value=""></td>
                                    </tr>
                                   
                                </thead>
                                <tbody id="tbody-modal">

                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id='btnSaveEdit' class="btn btn-success" onclick="setEditLocation()">Edit</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- End -->
    </main>
    <script>
        getListTicketPrice();
        // getLocationCategory();

    </script>
    <!--  Finish -->
    <?php
    require 'footer.php';
    ?>