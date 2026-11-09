<?php
// รูปแบบเดียวกับ wnv_authgroup.model.php: รับค่าทีละช่อง ไม่รับ PDO หรือ metadata จาก Controller
class model_wnv_lg_deliverytimewindow
{
    public static function GetDeliveryTimeWindow()
    {
        try {
            $conn = DBConnection::getConnection();
            $sql = "SELECT [BPCode], [DeliveryDay], [StartTime], [EndTime]
                    FROM [dbo].[WNV_LG_DeliveryTimeWindow]
                    ORDER BY [BPCode], [DeliveryDay]";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("[" . date('Y-m-d H:i:s') . "] " . $e->getMessage());
            return false;
        }
    }

    public static function Action_DeliveryTimeWindow($BPCode, $DeliveryDay, $StartTime, $EndTime, $action)
    {
        try {
            $StartTime = ($StartTime === '') ? null : $StartTime;
            $EndTime = ($EndTime === '') ? null : $EndTime;
            $conn = DBConnection::getConnection();
            $sql = "EXEC [dbo].[WNV_LG_DeliveryTimeWindowInsUpDelSp] @BPCode=:BPCode, @DeliveryDay=:DeliveryDay, @StartTime=:StartTime, @EndTime=:EndTime, @action=:action";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':BPCode', $BPCode, $BPCode === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
            $stmt->bindParam(':DeliveryDay', $DeliveryDay, $DeliveryDay === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
            $stmt->bindParam(':StartTime', $StartTime, $StartTime === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
            $stmt->bindParam(':EndTime', $EndTime, $EndTime === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
            $stmt->bindParam(':action', $action, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("[" . date('Y-m-d H:i:s') . "] " . $e->getMessage());
            return false;
        }
    }
}
