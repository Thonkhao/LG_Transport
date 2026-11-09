<?php
class controller_wnv_lg_sobooking
{
    public static function GetSOBooking()
    {
        $result = model_wnv_lg_sobooking::GetSOBooking();
        return $result;
    }

    public static function Action_SOBooking()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            try {
                TemplateController::validateCsrf();
                $action = TemplateController::sanitizeInput($_POST["action"] ?? '');
                if ($action === 'I') {
                    $SONo = TemplateController::sanitizeInput($_POST['SONo'] ?? '');
                    $BookingDate = TemplateController::sanitizeInput($_POST['BookingDate'] ?? '');
                } else if ($action === 'E') {
                    $Recordedit = TemplateController::sanitizeInput($_POST["Recordedit"] ?? '');
                    $ArrayReason = array_map('rawurldecode', explode("|", $Recordedit));
                    $SONo = TemplateController::sanitizeInput($ArrayReason[0] ?? '');
                    $BookingDate = TemplateController::sanitizeInput($_POST['BookingDate'] ?? '');
                } else if ($action === 'D') {
                    $Recordedit = TemplateController::sanitizeInput($_POST["Recordedit"] ?? '');
                    $ArrayReason = array_map('rawurldecode', explode("|", $Recordedit));
                    $SONo = TemplateController::sanitizeInput($ArrayReason[0] ?? '');
                    $BookingDate = null;
                } else {
                    throw new InvalidArgumentException('Action ไม่ถูกต้อง');
                }
                if ($SONo === '') {
                    throw new InvalidArgumentException('กรุณาระบุ Primary Key ให้ครบ');
                }
                TemplateController::ProcessAction();
                $result = model_wnv_lg_sobooking::Action_SOBooking($SONo, $BookingDate, $action);
                if ($result === false) {
                    controller_requested::callalert('SO Booking', 'บันทึกไม่สำเร็จ กรุณาตรวจข้อมูล สิทธิ์ และ Stored Procedure', 'N', 'wnv_lg_sobooking&s=master');
                    return;
                }
                $massage = $result['massage'] ?? 'Procedure ไม่ส่งข้อความผลการทำงานกลับมา';
                $flag = $result['flag'] ?? 'N';
                controller_requested::callalert('SO Booking', $massage, $flag, 'wnv_lg_sobooking&s=master');
            } catch (InvalidArgumentException $e) {
                controller_requested::callalert('SO Booking', $e->getMessage(), 'N', 'wnv_lg_sobooking&s=master');
            }
        }
    }
}
