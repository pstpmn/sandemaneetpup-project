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
                <div class="tableSet" id="tableFromBoatSeatBottom">
                    <table class="table table-bordered table-primary" id="">
                        <tr id="rightBottom">
                            <td bgcolor="#fff">
                                <center>Right</center>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="125" bgcolor="#fff">
                                <center>ที่นั่งเรือ</center>
                            </td>
                        </tr>
                        <tr id="leftBottom">
                            <td bgcolor="#fff">
                                <center>Left</center>
                            </td>
                        </tr>

                    </table>
                </div>

                <div class="tableSet" id="tableFromBoatSeatTop" style="display:none">
                    <table class="table table-bordered table-primary" id="">
                        <tr id="rightTop">
                            <td bgcolor="#fff">
                                <center>Right</center>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="125" bgcolor="#fff">
                                <center>ที่นั่งเรือ</center>
                            </td>
                        </tr>
                        <tr id="leftTop">
                            <td bgcolor="#fff">
                                <center>Left</center>
                            </td>
                        </tr>

                    </table>
                </div>


                <button class="btn btn-success" id="floorOneBtn" onclick="btnFloorOne()">ชั้น 1</button>
                <button class="btn btn-warning" id="floorTwoBtn" onclick="btnFloorTwo()">ชั้น 2</button>
                <br><br><b>เลขที่นั่งเรือ :</b> <label id="number-boatseat">กรุณาเลือกที่นั่งเรือ</label>

                <br><br><br>
                <button class="form-control btn-primary" id="floorTwoBtn" onclick="registerCustomer(listSeat,
                listSeatNumber,
                document.getElementById('select-Location_start').value,
                document.getElementById('select-Location_end').value)">ตกลง</button><br>
                <button class="form-control btn-danger" id="floorTwoBtn" onclick="">รีเซ็ต</button>

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
                                    document.getElementById('select-Location_end').value)">Save</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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