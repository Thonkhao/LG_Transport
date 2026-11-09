<?php
// รูปแบบเดียวกับ wnv_authgroup.model.php: รับค่าทีละช่อง ไม่รับ PDO หรือ metadata จาก Controller
class model_wnv_lg_deliverylocation
{
    public static function GetDeliveryLocation()
    {
        try {
            $conn = DBConnection::getConnection();
            $sql = "SELECT [BPCode], [BPName], [ShipVia], [TruckA], [TruckB], [TruckC], [TruckD], [HardCost], [Min_HardCost], [BF_DueDate], [AT_DueDate], [Latitude], [Longitude], [Req_Booking]
                    FROM [dbo].[WNV_LG_DeliveryLocation]
                    ORDER BY [BPCode]";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("[" . date('Y-m-d H:i:s') . "] " . $e->getMessage());
            return false;
        }
    }

    public static function Action_DeliveryLocation($BPCode, $BPName, $ShipVia, $TruckA, $TruckB, $TruckC, $TruckD, $HardCost, $Min_HardCost, $BF_DueDate, $AT_DueDate, $Latitude, $Longitude, $Req_Booking, $action)
    {
        try {
            $BPName = ($BPName === '') ? null : $BPName;
            $ShipVia = ($ShipVia === '') ? null : $ShipVia;
            $TruckA = ($TruckA === '') ? null : $TruckA;
            $TruckB = ($TruckB === '') ? null : $TruckB;
            $TruckC = ($TruckC === '') ? null : $TruckC;
            $TruckD = ($TruckD === '') ? null : $TruckD;
            $HardCost = ($HardCost === '') ? null : $HardCost;
            $Min_HardCost = ($Min_HardCost === '') ? null : $Min_HardCost;
            $BF_DueDate = ($BF_DueDate === '') ? null : $BF_DueDate;
            $AT_DueDate = ($AT_DueDate === '') ? null : $AT_DueDate;
            $Latitude = ($Latitude === '') ? null : $Latitude;
            $Longitude = ($Longitude === '') ? null : $Longitude;
            $Req_Booking = ($Req_Booking === '') ? null : $Req_Booking;
            $conn = DBConnection::getConnection();
            $sql = "EXEC [dbo].[WNV_LG_DeliveryLocationInsUpDelSp] @BPCode=:BPCode, @BPName=:BPName, @ShipVia=:ShipVia, @TruckA=:TruckA, @TruckB=:TruckB, @TruckC=:TruckC, @TruckD=:TruckD, @HardCost=:HardCost, @Min_HardCost=:Min_HardCost, @BF_DueDate=:BF_DueDate, @AT_DueDate=:AT_DueDate, @Latitude=:Latitude, @Longitude=:Longitude, @Req_Booking=:Req_Booking, @action=:action";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':BPCode', $BPCode, $BPCode === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
            $stmt->bindParam(':BPName', $BPName, $BPName === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
            $stmt->bindParam(':ShipVia', $ShipVia, $ShipVia === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
            $stmt->bindParam(':TruckA', $TruckA, $TruckA === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
            $stmt->bindParam(':TruckB', $TruckB, $TruckB === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
            $stmt->bindParam(':TruckC', $TruckC, $TruckC === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
            $stmt->bindParam(':TruckD', $TruckD, $TruckD === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
            $stmt->bindParam(':HardCost', $HardCost, $HardCost === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
            $stmt->bindParam(':Min_HardCost', $Min_HardCost, $Min_HardCost === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
            $stmt->bindParam(':BF_DueDate', $BF_DueDate, $BF_DueDate === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
            $stmt->bindParam(':AT_DueDate', $AT_DueDate, $AT_DueDate === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
            $stmt->bindParam(':Latitude', $Latitude, $Latitude === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
            $stmt->bindParam(':Longitude', $Longitude, $Longitude === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
            $stmt->bindParam(':Req_Booking', $Req_Booking, $Req_Booking === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
            $stmt->bindParam(':action', $action, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("[" . date('Y-m-d H:i:s') . "] " . $e->getMessage());
            return false;
        }
    }
}
