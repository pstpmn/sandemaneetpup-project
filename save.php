<?php
date_default_timezone_set('Asia/Bangkok');
require 'header.php';
?>
<title>Ticket Recode</title>
<?php
require 'navbar.php';
$listSeat = "asdsa";
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

    td {
        cursor: pointer;
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
    var listSeat = []; //List Boat Seat ID
    var listSeatNumber = []; //List Boat Seat Number
    var ticketPrice; // set price
    var listCountFloor = [];
    var listFloorData;
    getTicketPrice(1);
</script>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">
                <center>บันทึกการซื้อตั๋ว</center>
            </h1><br><br>
            ต้นทาง <select id='select-Location_start' class='custom-select' onchange="getSearchBoat(
                document.getElementById('select-Location_start').value,
                document.getElementById('select-Location_end').value
                )">

            </select>
            <br><br>
            ปลายทาง <select id='select-Location_end' class='custom-select' onchange="getSearchBoat(
                document.getElementById('select-Location_start').value,
                document.getElementById('select-Location_end').value
                )">

            </select>
            <script>
                getSelectLocation();
            </script>
            <br> <br>
            เลือกหมายเลขเรือ <select id='boat-number' class='custom-select'>
                <option>!!! เลือกต้นทาง และปลายทาง ก่อนถึงจะแสดง !!!</option>
            </select>
            <br><br>
            เลือกวันที่ออกเดินทาง
            <input type='date' id='date' class="form-control" value="<?php echo date('Y-m-d') ?>">

            <br>
            <button class="btn btn-primary" id="search-boat" onclick="getBoatSeat(
                document.getElementById('boat-number').value,
                document.getElementById('date').value,
                document.getElementById('select-Location_start').value,
                document.getElementById('select-Location_end').value
                )">ค้นหาที่นั่งเรือ</button>

            <br><br><br>
            <div id="container-boatSeat-customerData">
                <b>เลือกที่นั่งเรือของลูกค้า</b><br><br>

                <div class="tableSet" id="tableFromBoatSeat">

                </div>
                <div id='container-btnFloor'>
                    <!-- <button class="btn btn-success" id="floorOneBtn" onclick="btnFloorOne()">ชั้น 1</button>
                    <button class="btn btn-warning" id="floorTwoBtn" onclick="btnFloorTwo()">ชั้น 2</button> -->
                </div>

                <!-- <br><br><b>เลขที่นั่งเรือ :</b> <label id="number-boatseat" style="background-color: red;">กรุณาเลือกที่นั่งเรือ</label> -->
                <!-- <br><br><b>ราคารวมทั้งหมด :</b> <label id="priceSum"></label> -->
                <br><br><br>
                <div class="row">
                    <div class="col-lg-4 mb-4">
                        <!-- Billing card 1-->
                        <div class="card h-100 border-left-lg border-left-primary">
                            <div class="card-body">
                                <div class="small text-muted"><i>จำนวนลูกค้า</i></div>
                                <div class="h3">
                                    <div id='countBoatSeatToSelected'>0 ที่นั่ง</div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 mb-4">
                        <!-- Billing card 1-->
                        <div class="card h-100 border-left-lg border-left-primary">
                            <div class="card-body">
                                <div class="small text-muted"><i>ราคาต่อที่นั่ง</i></div>
                                <div class="h3">
                                    <div id='priceToSeat'></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 mb-4">
                        <!-- Billing card 1-->
                        <div class="card h-100 border-left-lg border-left-primary">
                            <div class="card-body">
                                <div class="small text-muted"><i>ราคารวม</i></div>
                                <div class="h3"> <label id="priceSum">0</label> บาท</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Billing card 1-->
                <div class="card h-100 border-left-lg border-left-primary">
                    <div class="card-body">
                        <div class="small text-muted"><i>เลขที่นั่งเรือ</i></div>
                        <div class="h4"> <label id="priceSum"><label id="number-boatseat">กรุณาเลือกที่นั่งเรือ</label></label></div>
                    </div>
                </div>


                <br><br><br>
                <button class="form-control btn-primary" id="floorTwoBtn" onclick="registerCustomer(listSeat,
                listSeatNumber,
                document.getElementById('select-Location_start').value,
                document.getElementById('select-Location_end').value)">ตกลง</button><br>
                <button class="form-control btn-danger" onclick="setResetBoatSeatAll()">รีเซ็ต</button>
            </div>
        </div>






        <br>
        <!-- <div id="register-customer">
                    <div id="register-customer-detail">

                    </div>
                </div> -->

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
                            <button class="btn btn-success" id="btnSaveTicket" onclick="saveTicketNormal(listSeat,
                                    listSeatNumber,
                                    document.getElementById('select-Location_start').value,
                                    document.getElementById('select-Location_end').value,
                                    <?php echo $_SESSION['empId']; ?>)">Save</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="container" style="overflow: auto;">
            <!-- Modal -->
            <div class="modal fade " id="result-buyTicket" role="dialog" style="overflow: auto;">
                <div class="modal-dialog modal-xl" style="overflow: auto;">
                    <!-- Modal content-->
                    <div class="modal-content" style="overflow: auto;">
                        <div id="ModalHeader" class="modal-header alert alert-success">
                            <div id="txtModalHeader"></div>
                            <button type="button" onclick="getRefreshPage()" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body-result">
                            <center>
                                <div role="alert" style="width:95%;">
                                    <h4 id="txtTicketCode" class="alert-heading"></h4>
                                    <hr>
                                    <table style="width: 100%;" id="detail-boat">
                                        <!-- ดำเนินการโดย Database -->
                                    </table>
                                    <hr>
                                    <table style="width: 100%;" border="0" id="detail-customer">
                                        <!-- ดำเนินการโดย Database -->
                                    </table>

                                    <br>
                                    <br>
                                    <div style="text-align:right;width:95%">
                                        จำนวนผู้โดยสาร : <label id="result-CountCustomer"> ที่นั่ง</label><br>
                                        จำนวนเงินทั้งหมด : <label id="result-priceSum"></label> บาท<br>
                                    </div>
                                </div>
                            </center>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="btnClose" onclick="getRefreshPage()" class="btn btn-success" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>

    <br>
    <!--  Finish -->
    <?php
    require 'footer.php';
    ?>