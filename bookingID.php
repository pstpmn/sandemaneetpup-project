<?php
require 'header.php';
?>
<title>Ticket Recode</title>
<?php
require 'navbar.php';
?>
<!-- Body Implement -->
<style>
    input[type='radio'] {
        display: inline;
        width: 30%;
    }

    .tableSet {
        overflow: auto;
    }

    #noneTable {
        display: none;
    }

    #container-boatSeat-customerData {
        display: none;
    }

    #register-customer-detail {
        background-color: white;
        padding: 20px;
        border-radius: 5px;
        /* display: none; */
    }
</style>
<script>
    var countCustomerOld;
    var ticketPrice; // set price
    getTicketPrice(1);
</script>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">
                <center>จัดการข้อมูล Booking ID</center>
            </h1>
            <br><br>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table mr-1"></i>
                    ข้อมูลการซื้อตั๋วลูกค้าทั้งหมด
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" style="text-align: center;" id="dataTable-TicketEdit" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>รหัสการจอง</th>
                                    <th>ประเภทตั๋ว</th>
                                    <th>พนักงาน</th>
                                    <th>เวลาซื้อตั๋ว</th>
                                    <th>สิ้นสุดเวลาจอง</th>
                                    <th>วันที่ขึ้นเรือ</th>
                                    <th>สถานะ</th>
                                    <th>รูปภาพสลิป</th>
                                    <th>เวลาอัพสลิป</th>
                                    <th>รายละเอียดเพิ่มเติม</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody id="table-ticket-edit">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="container">
                <!-- Modal -->
                <div class="modal fade" id="dialogListCustomer" role="dialog" style="height:90%; overflow: auto;">
                    <div class="modal-dialog modal-lg">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 id="dialog-ticketCode">รายละเอียดตั๋วและเรือ</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body" id="modal-body-slip" style="overflow: auto;">
                                <center>
                                    <h4>ข้อมูลเกี่ยวกับเรือ</h4>
                                </center><br>
                                ต้นทาง <select id='select-Location_start' disabled class='custom-select' onchange="getSearchBoat(
                document.getElementById('select-Location_start').value,
                document.getElementById('select-Location_end').value
                )">

                                </select>
                                <br><br>
                                ปลายทาง <select id='select-Location_end' disabled class='custom-select' onchange="getSearchBoat(
                document.getElementById('select-Location_start').value,
                document.getElementById('select-Location_end').value
                )">

                                </select>
                                <script>
                                    getSelectLocation();
                                </script>
                                <br> <br>
                                หมายเลขเรือ <select id='boat-number' disabled class='custom-select'>
                                    <option>!!! เลือกต้นทาง และปลายทาง ก่อนถึงจะแสดง !!!</option>
                                </select>
                                <br><br>
                                วันที่ออกเดินทาง
                                <input type='date' id='date' class="form-control" disabled value="<?php echo date('Y-m-d') ?>">
                                <br>
                                <div id='addCustomer-TicketEdit'></div>
                                <table class="table table-bordered" style="text-align: center;">
                                    <thead>
                                        <tr>
                                            <th scope="col">รหัสตั๋ว</th>
                                            <th scope="col">ชื่อ</th>
                                            <th scope="col">นามสกุล</th>
                                            <th scope="col">เบอร์โทรศัพท์</th>
                                            <th scope="col">ที่นั่ง</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody-modal">

                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>



            <div class="container">
                <!-- Modal -->
                <div class="modal fade" id="dialog-TicketEdit" role="dialog" style="height:90%; overflow: auto;">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content" style="overflow: auto;">
                            <div class="modal-header">
                                <h4 id="dialog-ticketCode">แก้ไขข้อมูลตั๋วลูกค้า</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body" id="modal-body-editTicket" style="overflow: auto;">

                                </table>
                            </div>
                            <div id="modal-footer" class="modal-footer">

                            </div>
                        </div>

                    </div>
                </div>
            </div>



            <!-- show select Boat Seat -->
            <div class="container">
                <!-- Modal -->
                <div class="modal fade" id="dialog-showAddTicket" role="dialog" style="height:90%; overflow: auto;">
                    <div class="modal-dialog modal-xl">
                        <!-- Modal content-->
                        <div class="modal-content" style="overflow: auto;">
                            <div class="modal-header">
                                <h4 id="header-select-boatSeat">เพิ่มลูกค้าในรหัสตั๋ว : </h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body" id="modal-body-editTicket">
                                <h1 id='header-addCustomer' class="mt-4">
                                </h1>


                                <br><br><br>
                                <div id="container-boatSeat-customerData">
                                    <b>เลือกที่นั่งเรือเพิ่มเติม</b><br><br>
                                    <div class="tableSet" id="tableFromBoatSeat" style="overflow: auto;">

                                    </div>

                                    <div id='container-btnFloor'>

                                    </div>
                                    <br><br><b>เลขที่นั่งเรือ :</b> <label id="number-boatseat">กรุณาเลือกที่นั่งเรือ</label>
                                    <br><br><b>ราคารวมทั้งหมด :</b> <label id="priceSum"></label>

                                    <br><br><br>
                                    <button class="form-control btn-primary" id='btn-save' onclick="registerCustomer(listSeat,listSeatNumber)">ตกลง</button><br>
                                    <button class="form-control btn-danger" id='btn-reset' onclick="getShowChangeBoatSeat('207952690','111','2021-01-07','1','2','134')">รีเซ็ต</button>

                                    </table>
                                </div>
                                <div id="modal-footer" class="modal-footer">

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <!-- Modal -->
                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4>โปรดระบุข้อมูลลูกค้า</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>

                            </div>
                            <div class="modal-body">
                                <div id="register-customer">
                                    <div id="register-customer-detail">

                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-success" id="btnSaveTicket" onclick="saveTicketAddCustomer(listSeat,
                                    listSeatNumber,
                                    document.getElementById('select-Location_start').value,
                                    document.getElementById('select-Location_end').value,
                                    <?php echo $_SESSION['empId']; ?>)">บันทึก</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
    </main>
    <script>
        // getListTicketEdit();

        $(document).ready(function() {
				var dataTable = $('#dataTable-TicketEdit').DataTable( {
					"processing": true,
					"serverSide": true,
					"ajax":{
						url :"model/apiGetTicketBookAll.php", // json datasource
						type: "post",  // method  , by default get
						error: function(){  // error handling
							$(".employee-grid-error").html("");
							$("#dataTable-TicketEdit").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
							$("#dataTable-TicketEdit_processing").css("display","none");
							
						}
					}
				} );
			} );
    </script>


    <!--  Finish -->
    <?php
    require 'footer.php';
    ?>