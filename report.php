<?php
//validated the report

if (isset($_GET['reportType']) == true && $_GET['reportType'] == "income") {
} else if (isset($_GET['reportType']) == true && $_GET['reportType'] == "checkIn") {
} else if (isset($_GET['reportType']) == true && $_GET['reportType'] == "newCustomer") {
} else if (isset($_GET['reportType']) == true && $_GET['reportType'] == "ticketStatus") {
} else if (isset($_GET['reportType']) == true && $_GET['reportType'] == "ticketCategory") {
} else if (isset($_GET['reportType']) == true && $_GET['reportType'] == "countTicket") {
} else if (isset($_GET['reportType']) == true && $_GET['reportType'] == "confirmIdentity") {
} else {
    header("Location:home.php");
}
require 'header.php';
require 'navbar.php';
?>

<!-- Declare variables used Function -->
<script>
    var barChart;
    var pieChart;
</script>

<!-- import function js -->
<script src="controller/fnReport/fnNewCustomer.js"></script>
<script src="controller/fnReport/fnCountTicket.js"></script>
<script src="controller/fnReport/fnIncome.js"></script>
<script src="controller/fnReport/fnTicketCategory.js"></script>
<script src="controller/fnReport/fnCheckIn.js"></script>
<script src="controller/fnReport/fnConfirmIdentity.js"></script>





<title>Report</title>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">
                <center>Report System</center>
            </h1><br>


            <div class="container p-3 my-3 border bg-white">
                <h1 class="h3 mb-2 text-gray-800">เลือกประเภท</h1>
                <?php
                if ($_GET['reportType'] == "checkIn") {
                ?>
                    <div id='container-ReportType'>
                        <input type="date" class="form-control" id='txtDate'>
                    </div>
                    <br>
                    <select class="custom-select mr-sm-2" style="width: 300px;" id="txtInput-dataTable">
                        <option value="check-in">
                            เฉพาะ check-in
                        </option>
                        <option value="check-out">
                            เฉพาะ check-out
                        </option>
                        <option value="all">
                            check-in และ check-out (ทั้งสอง)
                        </option>
                    </select><br><br>
                    <button class="btn btn-info" onclick="getDataTableCheckIn()">แสดงข้อมูล</button>
                <?php
                } else {
                ?>
                    <button class="btn btn-warning" onclick="setBtnReportType(this)" name='day' id='btnDay'>รายวัน (ต่อสัปดาห์)</button>
                    <button onclick="setBtnReportType(this)" id='btnWeek' name='week' class="btn btn-warning">รายสัปดาห์</button>
                    <button class="btn btn-warning" id='btnMonth' name='month' onclick="setBtnReportType(this)">รายเดือน</button>
                    <button class="btn btn-warning" id='btnYear' name='year' onclick="setBtnReportType(this)">รายปี</button>
                    <br><br>
                    <div id='container-ReportType'>
                        <input type="text" class="form-control" disabled placeholder="กรุณาเลือกประเภทก่อนน">
                    </div>
                    <br>
                    <button class="btn btn-info" onclick="getGraph('<?php echo $_GET['reportType']; ?>')">แสดงข้อมูล</button>
                <?php
                }
                ?>
            </div>

            <div id='showGraph' style="display: none;">

                <div class="container" style="padding:0;">
                    <sbpro-card _ngcontent-jvv-c126="" _nghost-jvv-c73="">
                        <div _ngcontent-jvv-c73="" class="card mb-4 card-header-actions h-100">
                            <div _ngcontent-jvv-c126="" class="card-header">Bar Chart
                            </div>
                            <div _ngcontent-jvv-c126="" class="card-body">
                                <canvas id="myChart"></canvas>

                            </div>
                        </div>
                    </sbpro-card>
                </div>



                <br>
                <div class="container" style="padding:0;">
                    <div _ngcontent-jvv-c126="" class="row">
                        <div _ngcontent-jvv-c126="" class="col-lg-6 mb-4">
                            <sbpro-card _ngcontent-jvv-c126="" _nghost-jvv-c73="">
                                <div _ngcontent-jvv-c73="" class="card mb-4 card-header-actions h-100">
                                    <div _ngcontent-jvv-c126="" class="card-header">Pie Chart
                                    </div>
                                    <div _ngcontent-jvv-c126="" class="card-body" style="height: 290px;">
                                        <canvas id="PieChart"></canvas>

                                    </div>
                                </div>
                            </sbpro-card>
                        </div>
                        <div _ngcontent-jvv-c126="" class="col-lg-6 mb-4">
                            <sbpro-card _ngcontent-jvv-c126="" _nghost-jvv-c73="">
                                <div _ngcontent-jvv-c73="" class="card mb-4 card-header-actions h-100" style="overflow: auto;">
                                    <div _ngcontent-jvv-c126="" class="card-header">Detail</div>
                                    <div _ngcontent-jvv-c126="" class="card-body" style="height: 290px;">
                                        <center>
                                            <h5>ตารางแสดงรายละเอียด</h5>
                                        </center>
                                        <table class="table table-hover" style="text-align: center;" id="table-detailGraph">
                                            <tr id='table-column'>
                                                <!-- implement By Fn -->
                                            </tr>
                                            <tr id='table-data'>
                                                <!-- implement By Fn -->

                                            </tr>
                                            <tr id='table-percentage'>
                                                <!-- implement By Fn -->
                                            </tr>
                                        </table>

                                        <div style="text-align: right;" id='table-resultGraph'>
                                            <!-- implement By Fn -->
                                        </div>

                                    </div>
                                </div>
                            </sbpro-card>
                        </div>
                    </div>
                </div>
                <br>
            </div>
        </div>


        <div id='container-dataTable' style="display: none;">
            <div class="container" style="padding:0;">
                <sbpro-card _ngcontent-jvv-c126="" _nghost-jvv-c73="">
                    <div _ngcontent-jvv-c73="" class="card mb-4 card-header-actions h-100">
                        <div _ngcontent-jvv-c126="" class="card-header">DataTable
                        </div>
                        <div _ngcontent-jvv-c126="" class="card-body" style="height: 420px;overflow:auto">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div id='container-dataTable-btn'>

                                    </div>
                                    <br>
                                    <table class="table table-bordered" style="text-align: center;" id="dataTable-report" width="100%" cellspacing="0">
                                        <thead id="dataTable-thead">
                                            <tr>
                                                <th>รหัสตั๋ว</th>
                                                <th>ชื่อ-นามสกุล</th>
                                                <th>ประเภท</th>
                                            </tr>
                                        </thead>
                                        <tbody id="table-ticket-edit">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- <table id="myTable" class='table table-hover' style="width: 100%;" id="dataTable-report">
                                <div style="padding-right: 5px;margin-bottom:15px">
                                    <div id='container-dataTable-btn'>

                                    </div>
                                </div>
                                <thead style="text-align: center;" id="dataTable-thead">
                                    <tr>
                                        <th>รหัสตั๋ว</th>
                                        <th>ชื่อ-นามสกุล</th>
                                        <th>ประเภท</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align: center;" id="dataTable-tbody">

                                </tbody>
                            </table> -->
                        </div>
                    </div>
                </sbpro-card>
            </div>
        </div>

    </main>
    <?php
    require 'footer.php';
    ?>