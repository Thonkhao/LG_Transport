<?php
class controller_wnv_lg_transportspeed
{
    public static function GetTransportSpeed()
    {
        $result = model_wnv_lg_transportspeed::GetTransportSpeed();
        return $result;
    }

    public static function Action_TransportSpeed()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            try {
                TemplateController::validateCsrf();
                $action = TemplateController::sanitizeInput($_POST["action"] ?? '');
                if ($action === 'I') {
                    $Code = TemplateController::sanitizeInput($_POST['Code'] ?? '');
                    $Desc = TemplateController::sanitizeInput($_POST['Desc'] ?? '');
                    $Speed = TemplateController::sanitizeInput($_POST['Speed'] ?? '');
                } else if ($action === 'E') {
                    $Recordedit = TemplateController::sanitizeInput($_POST["Recordedit"] ?? '');
                    $ArrayReason = array_map('rawurldecode', explode("|", $Recordedit));
                    $Code = TemplateController::sanitizeInput($ArrayReason[0] ?? '');
                    $Desc = TemplateController::sanitizeInput($_POST['Desc'] ?? '');
                    $Speed = TemplateController::sanitizeInput($_POST['Speed'] ?? '');
                } else if ($action === 'D') {
                    $Recordedit = TemplateController::sanitizeInput($_POST["Recordedit"] ?? '');
                    $ArrayReason = array_map('rawurldecode', explode("|", $Recordedit));
                    $Code = TemplateController::sanitizeInput($ArrayReason[0] ?? '');
                    $Desc = null;
                    $Speed = null;
                } else {
                    throw new InvalidArgumentException('Action ไม่ถูกต้อง');
                }
                if ($Code === '') {
                    throw new InvalidArgumentException('กรุณาระบุ Primary Key ให้ครบ');
                }
                TemplateController::ProcessAction();
                $result = model_wnv_lg_transportspeed::Action_TransportSpeed($Code, $Desc, $Speed, $action);
                if ($result === false) {
                    controller_requested::callalert('Transport Speed', 'บันทึกไม่สำเร็จ กรุณาตรวจข้อมูล สิทธิ์ และ Stored Procedure', 'N', 'wnv_lg_transportspeed&s=master');
                    return;
                }
                $massage = $result['massage'] ?? 'Procedure ไม่ส่งข้อความผลการทำงานกลับมา';
                $flag = $result['flag'] ?? 'N';
                controller_requested::callalert('Transport Speed', $massage, $flag, 'wnv_lg_transportspeed&s=master');
            } catch (InvalidArgumentException $e) {
                controller_requested::callalert('Transport Speed', $e->getMessage(), 'N', 'wnv_lg_transportspeed&s=master');
            }
        }
    }
}
