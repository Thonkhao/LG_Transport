<?php
class controller_wnv_lg_deliverylocation
{
    public static function GetDeliveryLocation()
    {
        $result = model_wnv_lg_deliverylocation::GetDeliveryLocation();
        return $result;
    }

    public static function Action_DeliveryLocation()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            try {
                TemplateController::validateCsrf();
                $action = TemplateController::sanitizeInput($_POST["action"] ?? '');
                if ($action === 'I') {
                    $BPCode = TemplateController::sanitizeInput($_POST['BPCode'] ?? '');
                    $BPName = TemplateController::sanitizeInput($_POST['BPName'] ?? '');
                    $ShipVia = TemplateController::sanitizeInput($_POST['ShipVia'] ?? '');
                    $TruckA = TemplateController::sanitizeInput($_POST['TruckA'] ?? '');
                    $TruckB = TemplateController::sanitizeInput($_POST['TruckB'] ?? '');
                    $TruckC = TemplateController::sanitizeInput($_POST['TruckC'] ?? '');
                    $TruckD = TemplateController::sanitizeInput($_POST['TruckD'] ?? '');
                    $HardCost = TemplateController::sanitizeInput($_POST['HardCost'] ?? '');
                    $Min_HardCost = TemplateController::sanitizeInput($_POST['Min_HardCost'] ?? '');
                    $BF_DueDate = TemplateController::sanitizeInput($_POST['BF_DueDate'] ?? '');
                    $AT_DueDate = TemplateController::sanitizeInput($_POST['AT_DueDate'] ?? '');
                    $Latitude = TemplateController::sanitizeInput($_POST['Latitude'] ?? '');
                    $Longitude = TemplateController::sanitizeInput($_POST['Longitude'] ?? '');
                    $Req_Booking = TemplateController::sanitizeInput($_POST['Req_Booking'] ?? '');
                } else if ($action === 'E') {
                    $Recordedit = TemplateController::sanitizeInput($_POST["Recordedit"] ?? '');
                    $ArrayReason = array_map('rawurldecode', explode("|", $Recordedit));
                    $BPCode = TemplateController::sanitizeInput($ArrayReason[0] ?? '');
                    $BPName = TemplateController::sanitizeInput($_POST['BPName'] ?? '');
                    $ShipVia = TemplateController::sanitizeInput($_POST['ShipVia'] ?? '');
                    $TruckA = TemplateController::sanitizeInput($_POST['TruckA'] ?? '');
                    $TruckB = TemplateController::sanitizeInput($_POST['TruckB'] ?? '');
                    $TruckC = TemplateController::sanitizeInput($_POST['TruckC'] ?? '');
                    $TruckD = TemplateController::sanitizeInput($_POST['TruckD'] ?? '');
                    $HardCost = TemplateController::sanitizeInput($_POST['HardCost'] ?? '');
                    $Min_HardCost = TemplateController::sanitizeInput($_POST['Min_HardCost'] ?? '');
                    $BF_DueDate = TemplateController::sanitizeInput($_POST['BF_DueDate'] ?? '');
                    $AT_DueDate = TemplateController::sanitizeInput($_POST['AT_DueDate'] ?? '');
                    $Latitude = TemplateController::sanitizeInput($_POST['Latitude'] ?? '');
                    $Longitude = TemplateController::sanitizeInput($_POST['Longitude'] ?? '');
                    $Req_Booking = TemplateController::sanitizeInput($_POST['Req_Booking'] ?? '');
                } else if ($action === 'D') {
                    $Recordedit = TemplateController::sanitizeInput($_POST["Recordedit"] ?? '');
                    $ArrayReason = array_map('rawurldecode', explode("|", $Recordedit));
                    $BPCode = TemplateController::sanitizeInput($ArrayReason[0] ?? '');
                    $BPName = null;
                    $ShipVia = null;
                    $TruckA = null;
                    $TruckB = null;
                    $TruckC = null;
                    $TruckD = null;
                    $HardCost = null;
                    $Min_HardCost = null;
                    $BF_DueDate = null;
                    $AT_DueDate = null;
                    $Latitude = null;
                    $Longitude = null;
                    $Req_Booking = null;
                } else {
                    throw new InvalidArgumentException('Action ไม่ถูกต้อง');
                }
                if ($BPCode === '') {
                    throw new InvalidArgumentException('กรุณาระบุ Primary Key ให้ครบ');
                }
                TemplateController::ProcessAction();
                $result = model_wnv_lg_deliverylocation::Action_DeliveryLocation($BPCode, $BPName, $ShipVia, $TruckA, $TruckB, $TruckC, $TruckD, $HardCost, $Min_HardCost, $BF_DueDate, $AT_DueDate, $Latitude, $Longitude, $Req_Booking, $action);
                if ($result === false) {
                    controller_requested::callalert('Delivery Location', 'บันทึกไม่สำเร็จ กรุณาตรวจข้อมูล สิทธิ์ และ Stored Procedure', 'N', 'wnv_lg_deliverylocation&s=master');
                    return;
                }
                $massage = $result['massage'] ?? 'Procedure ไม่ส่งข้อความผลการทำงานกลับมา';
                $flag = $result['flag'] ?? 'N';
                controller_requested::callalert('Delivery Location', $massage, $flag, 'wnv_lg_deliverylocation&s=master');
            } catch (InvalidArgumentException $e) {
                controller_requested::callalert('Delivery Location', $e->getMessage(), 'N', 'wnv_lg_deliverylocation&s=master');
            }
        }
    }
}
