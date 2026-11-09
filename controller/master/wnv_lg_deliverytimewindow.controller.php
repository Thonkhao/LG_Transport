<?php
class controller_wnv_lg_deliverytimewindow
{
    public static function GetDeliveryTimeWindow()
    {
        $result = model_wnv_lg_deliverytimewindow::GetDeliveryTimeWindow();
        return $result;
    }

    public static function Action_DeliveryTimeWindow()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            try {
                TemplateController::validateCsrf();
                $action = TemplateController::sanitizeInput($_POST["action"] ?? '');
                if ($action === 'I') {
                    $BPCode = TemplateController::sanitizeInput($_POST['BPCode'] ?? '');
                    $DeliveryDay = TemplateController::sanitizeInput($_POST['DeliveryDay'] ?? '');
                    $StartTime = TemplateController::sanitizeInput($_POST['StartTime'] ?? '');
                    $EndTime = TemplateController::sanitizeInput($_POST['EndTime'] ?? '');
                } else if ($action === 'E') {
                    $Recordedit = TemplateController::sanitizeInput($_POST["Recordedit"] ?? '');
                    $ArrayReason = array_map('rawurldecode', explode("|", $Recordedit));
                    $BPCode = TemplateController::sanitizeInput($ArrayReason[0] ?? '');
                    $DeliveryDay = TemplateController::sanitizeInput($ArrayReason[1] ?? '');
                    $StartTime = TemplateController::sanitizeInput($_POST['StartTime'] ?? '');
                    $EndTime = TemplateController::sanitizeInput($_POST['EndTime'] ?? '');
                } else if ($action === 'D') {
                    $Recordedit = TemplateController::sanitizeInput($_POST["Recordedit"] ?? '');
                    $ArrayReason = array_map('rawurldecode', explode("|", $Recordedit));
                    $BPCode = TemplateController::sanitizeInput($ArrayReason[0] ?? '');
                    $DeliveryDay = TemplateController::sanitizeInput($ArrayReason[1] ?? '');
                    $StartTime = null;
                    $EndTime = null;
                } else {
                    throw new InvalidArgumentException('Action ไม่ถูกต้อง');
                }
                if ($BPCode === '' || $DeliveryDay === '') {
                    throw new InvalidArgumentException('กรุณาระบุ Primary Key ให้ครบ');
                }
                TemplateController::ProcessAction();
                $result = model_wnv_lg_deliverytimewindow::Action_DeliveryTimeWindow($BPCode, $DeliveryDay, $StartTime, $EndTime, $action);
                if ($result === false) {
                    controller_requested::callalert('Delivery Time Window', 'บันทึกไม่สำเร็จ กรุณาตรวจข้อมูล สิทธิ์ และ Stored Procedure', 'N', 'wnv_lg_deliverytimewindow&s=master');
                    return;
                }
                $massage = $result['massage'] ?? 'Procedure ไม่ส่งข้อความผลการทำงานกลับมา';
                $flag = $result['flag'] ?? 'N';
                controller_requested::callalert('Delivery Time Window', $massage, $flag, 'wnv_lg_deliverytimewindow&s=master');
            } catch (InvalidArgumentException $e) {
                controller_requested::callalert('Delivery Time Window', $e->getMessage(), 'N', 'wnv_lg_deliverytimewindow&s=master');
            }
        }
    }
}
