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
</style>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">
                <center>หน้าหลัก</center>
            </h1><br>

            <h2>ระบบที่พัฒนาเสร็จแล้ว แต่อาจจะยังไม่สมบูรณ์</h2><br>
            ระบบซื้อตั๋ว เมื่อซื้อเปลียนสถานะที่นั่งเรือ <br>
            ระบบจองตั๋ว เมื่อจอง ถ้ายังไม่จ่ายเงินตามระยะเวลาที่กำหนด จะคืนที่นั่งกลับสู่โหมดปกติ <br>
            ระบบแสดงสลิปเข้ามาแบบ async สลิปแสดงมาเรือยๆ โดยไม่ต้องรีเฟซ<br>
            ระบบยกเลิกตั๋ว <br>
            ระบบ check in and check out สำหรับพนักงาน<br>
            ระบบแก้ไขตั๋ว และ แก้ไขข้อมูลพนักงาน <br>
            ระบบจัดการพนักงาน <br>
            ระบบจัดการสถานที่<br> 
            ระบบจัดการเรือ <br>
            แสดงข้อมูลรหัสตั๋วตอนบันทึกตั๋ว (ยังไม่สมบูรณ์)<br>
            ระบบเพิ่มวันหยุดงาน(ป้องกัน การซื้อตั๋ว ณ วันหยุด) <br>
            ระบบ Login <br>
            <br><br>

            <h2>ระบบที่ยังพัฒนาไม่เสร็จ</h2><br>
            ระบบที่นั่งเมื่อถึงปลายทางแล้วให้คืนที่นั่ง ทันที่<br>
            ระบบแสดงผลลัพธ์ (กราฟ) <br>
            ระบบจัดการที่นั่งเรือ <br>
            ระบบจัดการเส้นทางเรือ <br>
            ระบบจัดราคาตั๋ว <br>
            ระบบนับจำนวนผู้โดยสาร(ใช้แทนการ check in)<br>
            ระบบจัดการข้อมูลการเช็คอิน <br>
            ระบบแสดงข้อมูลหน้าหลัก <br><br>


        </div>
    </main>


    <!--  Finish -->
    <?php
    require 'footer.php';
    ?>