<?php include('header.php'); ?>

<?php
if (isset($_POST["btnSearch"])) {
    $orgin = $_POST['select-Location_start-responsive'];
    $destination = $_POST['select-Location_end-responsive'];
    $boatId = $_POST['boat-number'];
    $date = $_POST['date'];
    echo $orgin . "       a";
    if ($orgin == "0" || $destination == "0") {
        echo "<script type='text/javascript'>";
        echo "window.location = 'index.php'; ";
        echo "alert('ต้นทาง หรือ ปลายทาง ยังไม่ได้เลือก  !!!');";
        echo "</script>";
    } else if ($orgin == $destination) {
        echo "<script type='text/javascript'>";
        echo "window.location = 'index.php'; ";
        echo "alert('ต้นทาง และ ปลายทาง เหมือนกัน  !!!');";
        echo "</script>";
    }
}
?>

<style>
    input[type='radio'] {
        display: inline;
        width: 10%;
    }

    .tableSet {
        overflow: auto;
    }

    td {
        cursor: pointer;
    }

    button[class="form-control btn btn-danger"],
    button[class="form-control btn btn-primary"] {
        width: 24%;
        margin-bottom: 10px;
        font-family: 'Kanit', sans-serif;
    }

    button[id="btnSaveTicket"],
    button[class="btn btn-warning"] {
        width: 15%;
        font-family: 'Kanit', sans-serif;
    }

    .font {
        font-family: 'Kanit', sans-serif;
    }

    table[class="table table-bordered table-primary"] {
        width: 85%;
        margin-bottom: 5px;
    }

    #container-boatSeat-customerData {
        display: none;
        width: 95%;
    }

    #tableFromBoatSeatTop {
        width: 97%;
    }

    input[type="text"],
    input[type="number"]{
        width: 95%;
        margin-top:-10px;
    }

    #register-customer-detail b{
        margin-bottom:100px;
    }

    .flex-container {
        display: -webkit-flex;
        display: flex;
        width: 100%;
        height: 80px;
        background-color: #ffff;
        margin-bottom: 20px;
    }
    .flex-center {
        width: 60%;
        display: flex;
        margin-left: 20%;
    }

    .flex-green {
        background-color: green;
        width: 20%;
        margin: 10px;
    }
    .flex-yellow {
        background-color: yellow;
        width: 20%;
        margin: 10px;
    }
    .flex-gray {
        background-color: gray;
        width: 20%;
        margin: 10px;
    }
    .flex-blue {
        background-color: #b8daff;
        width: 20%;
        margin: 10px;
    }
    .flex {
        background-color: #ffff;
        width: 200px;
        margin-top: 20px;
        font-size: 14px;
    }

    @media (max-width: 890px) {

        button[class="form-control btn btn-danger"],
        button[class="form-control btn btn-primary"] {
            width: 100%;
            margin-bottom: 10px;
        }

        button[class="btn btn-success"],
        button[class="btn btn-warning"] {
            width: 15%;
        }

        input[type='radio'] {
            display: inline;
            width: 90%;
        }

        table[class="table table-bordered table-primary"] {
            width: 90%;
            margin-bottom: 5px;
            margin-left: 15px;
        }
        

        #container-boatSeat-customerData{
            display: none;
            width: 90%;
        }

        #tableFromBoatSeatTop {
            width: 100%;
        }
        @media (max-width: 590px) {
            .flex {
                width: 500px;
                font-size: 10px;
                margin-top: 10px;
            }
            .flex-center {
                display: flex;
                width: 90%;
                margin-left: 5px;
            }
            .flex-green,.flex-yellow,.flex-blue,.flex-gray{
                width: 50%;
                height:20px;
                margin-right: 5px;
            }
            .flex-container {
                height: 50px;
            }
        }
    }
</style>

<script>
    var listSeat = []; //List Boat Seat ID
    var listSeatNumber = []; //List Boat Seat Number
    var ticketPrice; // set price
    var listCountFloor = [];
    var listFloorData;
    getTicketPrice(2);
</script>

<body class="has1">

<center>

    <div class="container-fluid">


        <br><br><br>
        <div id="container-boatSeat-customerData">
            <b>เลือกที่นั่งเรือของลูกค้า</b><br><br>
            
            <div class="tableSet" id="tableFromBoatSeat">

            </div>
            <br>
            <div id='container-btnFloor'>
            
            </div>

            <!-- <br><br><b>เลขที่นั่งเรือ :</b> <label id="number-boatseat" style="background-color: red;">กรุณาเลือกที่นั่งเรือ</label> -->
            <!-- <br><br><b>ราคารวมทั้งหมด :</b> <label id="priceSum"></label> -->
            <br>

            
            
                <div class="flex-container">
                
                    <div class="flex-center">
                        <div class="flex-blue"></div> <div class="flex">ที่ว่าง</div> 
                        <div class="flex-gray"></div> <div class="flex">เลือกที่นั่ง</div>
                        <div class="flex-yellow"></div> <div class="flex">ที่นั่งถูกจอง</div>
                        <div class="flex-green"></div> <div class="flex">ที่นั่งถูกซื้อแล้ว</div>
                         
                    </div>
                
                </div>
            
            

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
            <button class="form-control btn-primary" id="floorTwoBtn" onclick="registerCustomer()">ตกลง</button><br>
            <button class="form-control btn-danger" onclick="setResetBoatSeatAll()">รีเซ็ต</button>
        </div>
    </div>




    <!-- <div id="container-boatSeat-customerData">
            <h3 class="has2">เลือกที่นั่งเรือของลูกค้า</h3>
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

        <button id="floorOneBtn" class="btn btn-success" onclick="btnFloorOne()">ชั้น 1</button>
        <button id="floorTwoBtn" class="btn btn-warning" onclick="btnFloorTwo()">ชั้น 2</button>
        <br><br>
            เลขที่นั่งเรือ : <label id="number-boatseat">กรุณาเลือกที่นั่งเรือ</label>
        <br><br>

        <button type="button" class="form-control btn btn-primary" id="floorTwoBtn" 
        onclick="registerCustomer(boatId,listSeatNumber,origin,destination)">ตกลง</button>

        <a href='index.php'><button type="button" class="form-control btn btn-danger">ยกเลิก</button></a>


        <div class="container">
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">
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
                            <button class="btn btn-success" id="btnSaveTicket" 
                            onclick="saveTicketNormal(listSeat,listSeatNumber,origin,destination)">บันทึก</button>
                            
                            <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                        </div>
                    </div>

                </div>
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
                        <button class="btn btn-success" id="btnSaveTicket" onclick="saveTicketOnline(listSeat,
                                    listSeatNumber,
                                    <?php echo $orgin ?>,
                                    <?php echo $destination ?>,<?php echo $date ?>
                                    )">Save</button>
                        <button type="button" class="btn btn-danger" data-dismiss=" ">Close</button>
                    </div>
                </div>

            </div>
        </div>
    </div>

</body>
<script>
    let origin = "<?php echo $orgin ?>";
    let destination = "<?php echo $destination ?>";
    let boatId = "<?php echo $boatId ?>";
    let date = "<?php echo $date ?>";
    getBoatSeat(boatId, date, origin, destination);
</script>
<br>
</center>