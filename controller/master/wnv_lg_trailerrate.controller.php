<?php
class controller_wnv_lg_trailerrate
{
    public static function GetTrailerRate()
    {
        $result = model_wnv_lg_trailerrate::GetTrailerRate();
        return $result;
    }

    public static function Action_TrailerRate()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            try {
                TemplateController::validateCsrf();
                $action = TemplateController::sanitizeInput($_POST["action"] ?? '');
                if ($action === 'I') {
                    $TruckType = TemplateController::sanitizeInput($_POST['TruckType'] ?? '');
                    $TrailerNo = TemplateController::sanitizeInput($_POST['TrailerNo'] ?? '');
                    $TrailerCost = TemplateController::sanitizeInput($_POST['TrailerCost'] ?? '');
                } else if ($action === 'E') {
                    $Recordedit = TemplateController::sanitizeInput($_POST["Recordedit"] ?? '');
                    $ArrayReason = array_map('rawurldecode', explode("|", $Recordedit));
                    $TruckType = TemplateController::sanitizeInput($ArrayReason[0] ?? '');
                    $TrailerNo = TemplateController::sanitizeInput($ArrayReason[1] ?? '');
                    $TrailerCost = TemplateController::sanitizeInput($_POST['TrailerCost'] ?? '');
                } else if ($action === 'D') {
                    $Recordedit = TemplateController::sanitizeInput($_POST["Recordedit"] ?? '');
                    $ArrayReason = array_map('rawurldecode', explode("|", $Recordedit));
                    $TruckType = TemplateController::sanitizeInput($ArrayReason[0] ?? '');
                    $TrailerNo = TemplateController::sanitizeInput($ArrayReason[1] ?? '');
                    $TrailerCost = null;
                } else {
                    throw new InvalidArgumentException('Action ไม่ถูกต้อง');
                }
                if ($TruckType === '' || $TrailerNo === '') {
                    throw new InvalidArgumentException('กรุณาระบุ Primary Key ให้ครบ');
                }
                TemplateController::ProcessAction();
                $result = model_wnv_lg_trailerrate::Action_TrailerRate($TruckType, $TrailerNo, $TrailerCost, $action);
                if ($result === false) {
                    controller_requested::callalert('Trailer Rate', 'บันทึกไม่สำเร็จ กรุณาตรวจข้อมูล สิทธิ์ และ Stored Procedure', 'N', 'wnv_lg_trailerrate&s=master');
                    return;
                }
                $massage = $result['massage'] ?? 'Procedure ไม่ส่งข้อความผลการทำงานกลับมา';
                $flag = $result['flag'] ?? 'N';
                controller_requested::callalert('Trailer Rate', $massage, $flag, 'wnv_lg_trailerrate&s=master');
            } catch (InvalidArgumentException $e) {
                controller_requested::callalert('Trailer Rate', $e->getMessage(), 'N', 'wnv_lg_trailerrate&s=master');
            }
        }
    }
}
