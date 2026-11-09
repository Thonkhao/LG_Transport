<?php
class controller_wnv_lg_deliverytime
{
    public static function GetDeliveryTime()
    {
        $result = model_wnv_lg_deliverytime::GetDeliveryTime();
        return $result;
    }

    public static function Action_DeliveryTime()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            try {
                TemplateController::validateCsrf();
                $action = TemplateController::sanitizeInput($_POST["action"] ?? '');
                if ($action === 'I') {
                    $TimeType = TemplateController::sanitizeInput($_POST['TimeType'] ?? '');
                    $DurationSec = TemplateController::sanitizeInput($_POST['DurationSec'] ?? '');
                } else if ($action === 'E') {
                    $Recordedit = TemplateController::sanitizeInput($_POST["Recordedit"] ?? '');
                    $ArrayReason = array_map('rawurldecode', explode("|", $Recordedit));
                    $TimeType = TemplateController::sanitizeInput($ArrayReason[0] ?? '');
                    $DurationSec = TemplateController::sanitizeInput($_POST['DurationSec'] ?? '');
                } else if ($action === 'D') {
                    $Recordedit = TemplateController::sanitizeInput($_POST["Recordedit"] ?? '');
                    $ArrayReason = array_map('rawurldecode', explode("|", $Recordedit));
                    $TimeType = TemplateController::sanitizeInput($ArrayReason[0] ?? '');
                    $DurationSec = null;
                } else {
                    throw new InvalidArgumentException('Action ไม่ถูกต้อง');
                }
                if ($TimeType === '') {
                    throw new InvalidArgumentException('กรุณาระบุ Primary Key ให้ครบ');
                }
                TemplateController::ProcessAction();
                $result = model_wnv_lg_deliverytime::Action_DeliveryTime($TimeType, $DurationSec, $action);
                if ($result === false) {
                    controller_requested::callalert('Delivery Time', 'บันทึกไม่สำเร็จ กรุณาตรวจข้อมูล สิทธิ์ และ Stored Procedure', 'N', 'wnv_lg_deliverytime&s=master');
                    return;
                }
                $massage = $result['massage'] ?? 'Procedure ไม่ส่งข้อความผลการทำงานกลับมา';
                $flag = $result['flag'] ?? 'N';
                controller_requested::callalert('Delivery Time', $massage, $flag, 'wnv_lg_deliverytime&s=master');
            } catch (InvalidArgumentException $e) {
                controller_requested::callalert('Delivery Time', $e->getMessage(), 'N', 'wnv_lg_deliverytime&s=master');
            }
        }
    }
}
