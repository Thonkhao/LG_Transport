# LG Transport

PHP + SQL Server สำหรับจัดการข้อมูลหลักด้านการขนส่ง 8 ตาราง
ใช้โครงสร้าง Model / Controller / View / JavaScript ตามตัวอย่างของพี่
ยังไม่รวมระบบ login และสิทธิ์ผู้ใช้

## ไฟล์หลัก
- index.php: โหลดคลาส การเชื่อมต่อ และเปิด Template
- dbconnect/Connect.php: โหลด .env และเชื่อม SQL Server ด้วย PDO
- controller/template.controller.php: ฟังก์ชันส่วนกลางและการแจ้งผล
- Models/master/: SELECT และ EXEC Stored Procedure แยกตามตาราง
- controller/master/: รับ POST แยก I / E / D แล้วเรียก Model
- views/modules/Master/: ตารางและฟอร์มแต่ละหน้า
- views/js/master/: DataTables เปิดฟอร์ม และยืนยันบันทึก
- views/js/template.js: ส่งฟอร์มและแสดง Toastr
- views/template.php และ theme/: โครงหน้าและเมนู
- views/plugins/ และ views/component/: ไลบรารีที่หน้าเว็บเรียกใช้
- sql/: สคริปต์สร้าง Procedure แยกทั้ง 8 ตาราง

## เปิดเว็บ
ดับเบิลคลิก start-local.bat แล้วเปิด http://127.0.0.1:8080
หรือรัน:
    C:\php\php.exe -S 127.0.0.1:8080 -t C:\LG_Transport

ถ้าใช้ IIS ตั้ง root เป็น C:\LG_Transport และติดตั้ง PHP/FastCGI
web.config ใช้กับ IIS; .htaccess ใช้กับ Apache

## การเชื่อมต่อ
Connect.php คงเส้นทางที่คุณตั้งไว้:
    C:\inetpub\config\vendor\autoload.php
    C:\inetpub\config\LG_Transport\.env

ต้องมี pdo_sqlsrv และ Microsoft ODBC Driver ที่ตรงกับ PHP
.env ต้องชี้ฐานข้อมูล WNV_LN ของคุณ ไม่ต้องส่งรหัสผ่านในแชต
schema ของตารางคือ dbo ตามที่ยืนยัน

## Stored Procedure
เปิดไฟล์ sql/WNV_LG_*InsUpDelSp.sql ของแต่ละตารางใน SSMS
ตรวจเทียบ CREATE TABLE จริง เลือกฐานข้อมูล WNV_LN แล้วจึง Execute
ไฟล์ใช้ CREATE PROCEDURE ถ้ามีชื่ออยู่แล้วจะไม่เขียนทับ
ต้องตรวจของเดิมก่อนใช้ ALTER

การมีไฟล์ .sql ไม่ได้แปลว่า Procedure ถูกสร้างบนเซิร์ฟเวอร์แล้ว
ชื่อและพารามิเตอร์ต้องตรงกับ EXEC ใน Model
SQL ชุดนี้เขียนตามตารางที่ให้มา ไม่ใช่เนื้อหา Procedure ที่ดึงจากเซิร์ฟเวอร์ของพี่

## ลำดับการทำงาน
อ่าน: View -> Controller -> Model -> SELECT -> กลับมาสร้างตาราง
บันทึก: ฟอร์ม POST -> Controller -> Model -> EXEC -> Session แจ้งผล -> เปิดหน้าใหม่

Primary Key อ้างอิงคอลัมน์สีแดงที่ยืนยันไว้
ตารางที่มีคีย์หลายคอลัมน์ใช้ทุกคอลัมน์ร่วมกัน
ไม่ให้เปลี่ยนคีย์ตอนแก้ไข; TruckDowngrade มีเฉพาะคีย์จึงเปิดเพิ่ม/ลบและปิด Edit

## สถานะ
ไฟล์เว็บและเส้นทางผ่านการตรวจด้วยข้อมูลจำลอง แต่ยังไม่ได้ทดสอบกับ SQL Server จริง
Transport Speed ยืนยันโครงสร้างจริงแล้ว; SQL UPDATE ยังต้องเพิ่ม UpdatedBy และ RecordDate ตามที่คุยกัน
ตารางอื่นยังต้องตรวจ NULL/default และคอลัมน์เพิ่มเติมก่อนยืนยันว่าบันทึกได้จริง
