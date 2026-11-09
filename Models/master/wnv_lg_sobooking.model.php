<?php
// รูปแบบเดียวกับ wnv_authgroup.model.php: รับค่าทีละช่อง ไม่รับ PDO หรือ metadata จาก Controller
class model_wnv_lg_sobooking
{
    public static function GetSOBooking()
    {
        try {
            $conn = DBConnection::getConnection();
            $sql = "SELECT [SONo], [BookingDate]
                    FROM [dbo].[WNV_LG_SOBooking]
                    ORDER BY [SONo]";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("[" . date('Y-m-d H:i:s') . "] " . $e->getMessage());
            return false;
        }
    }

    public static function Action_SOBooking($SONo, $BookingDate, $action)
    {
        try {
            $BookingDate = ($BookingDate === '') ? null : $BookingDate;
            $conn = DBConnection::getConnection();
            $sql = "EXEC [dbo].[WNV_LG_SOBookingInsUpDelSp] @SONo=:SONo, @BookingDate=:BookingDate, @action=:action";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':SONo', $SONo, $SONo === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
            $stmt->bindParam(':BookingDate', $BookingDate, $BookingDate === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
            $stmt->bindParam(':action', $action, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("[" . date('Y-m-d H:i:s') . "] " . $e->getMessage());
            return false;
        }
    }
}
