<?php
class controller_wnv_lg_truckdowngrade
{
    public static function GetTruckDowngrade()
    {
        $result = model_wnv_lg_truckdowngrade::GetTruckDowngrade();
        return $result;
    }

    public static function Action_TruckDowngrade()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            try {
                TemplateController::validateCsrf();
                $action = TemplateController::sanitizeInput($_POST["action"] ?? '');
                if ($action === 'I') {
                    $DeliveryZone = TemplateController::sanitizeInput($_POST['DeliveryZone'] ?? '');
                    $DowngradeStep = TemplateController::sanitizeInput($_POST['DowngradeStep'] ?? '');
                    $TruckType = TemplateController::sanitizeInput($_POST['TruckType'] ?? '');
                } else if ($action === 'E') {
                    $Recordedit = TemplateController::sanitizeInput($_POST["Recordedit"] ?? '');
                    $ArrayReason = array_map('rawurldecode', explode("|", $Recordedit));
                    $DeliveryZone = TemplateController::sanitizeInput($ArrayReason[0] ?? '');
                    $DowngradeStep = TemplateController::sanitizeInput($ArrayReason[1] ?? '');
                    $TruckType = TemplateController::sanitizeInput($ArrayReason[2] ?? '');
                } else if ($action === 'D') {
                    $Recordedit = TemplateController::sanitizeInput($_POST["Recordedit"] ?? '');
                    $ArrayReason = array_map('rawurldecode', explode("|", $Recordedit));
                    $DeliveryZone = TemplateController::sanitizeInput($ArrayReason[0] ?? '');
                    $DowngradeStep = TemplateController::sanitizeInput($ArrayReason[1] ?? '');
                    $TruckType = TemplateController::sanitizeInput($ArrayReason[2] ?? '');
                } else {
                    throw new InvalidArgumentException('Action ไม่ถูกต้อง');
                }
                if ($DeliveryZone === '' || $DowngradeStep === '' || $TruckType === '') {
                    throw new InvalidArgumentException('กรุณาระบุ Primary Key ให้ครบ');
                }
                TemplateController::ProcessAction();
                $result = model_wnv_lg_truckdowngrade::Action_TruckDowngrade($DeliveryZone, $DowngradeStep, $TruckType, $action);
                if ($result === false) {
                    controller_requested::callalert('Truck Downgrade', 'บันทึกไม่สำเร็จ กรุณาตรวจข้อมูล สิทธิ์ และ Stored Procedure', 'N', 'wnv_lg_truckdowngrade&s=master');
                    return;
                }
                $massage = $result['massage'] ?? 'Procedure ไม่ส่งข้อความผลการทำงานกลับมา';
                $flag = $result['flag'] ?? 'N';
                controller_requested::callalert('Truck Downgrade', $massage, $flag, 'wnv_lg_truckdowngrade&s=master');
            } catch (InvalidArgumentException $e) {
                controller_requested::callalert('Truck Downgrade', $e->getMessage(), 'N', 'wnv_lg_truckdowngrade&s=master');
            }
        }
    }
}
