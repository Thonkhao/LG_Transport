<?php
// รูปแบบเดียวกับ wnv_authgroup.model.php: รับค่าทีละช่อง ไม่รับ PDO หรือ metadata จาก Controller
class model_wnv_lg_trucktype
{
    public static function GetTruckType()
    {
        try {
            $conn = DBConnection::getConnection();
            $sql = "SELECT [TruckType], [TruckTypeName], [Capacity], [Tolerance], [Installment], [DriverCost], [HelperCost], [FuelRate], [WearCost], [MaintCost], [TransRate], [Day], [LoadMin], [BkkBan], [MaxTrailer], [NightCost]
                    FROM [dbo].[WNV_LG_TruckType]
                    ORDER BY [TruckType]";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("[" . date('Y-m-d H:i:s') . "] " . $e->getMessage());
            return false;
        }
    }

    public static function Action_TruckType($TruckType, $TruckTypeName, $Capacity, $Tolerance, $Installment, $DriverCost, $HelperCost, $FuelRate, $WearCost, $MaintCost, $TransRate, $Day, $LoadMin, $BkkBan, $MaxTrailer, $NightCost, $action)
    {
        try {
            $TruckTypeName = ($TruckTypeName === '') ? null : $TruckTypeName;
            $Capacity = ($Capacity === '') ? null : $Capacity;
            $Tolerance = ($Tolerance === '') ? null : $Tolerance;
            $Installment = ($Installment === '') ? null : $Installment;
            $DriverCost = ($DriverCost === '') ? null : $DriverCost;
            $HelperCost = ($HelperCost === '') ? null : $HelperCost;
            $FuelRate = ($FuelRate === '') ? null : $FuelRate;
            $WearCost = ($WearCost === '') ? null : $WearCost;
            $MaintCost = ($MaintCost === '') ? null : $MaintCost;
            $TransRate = ($TransRate === '') ? null : $TransRate;
            $Day = ($Day === '') ? null : $Day;
            $LoadMin = ($LoadMin === '') ? null : $LoadMin;
            $BkkBan = ($BkkBan === '') ? null : $BkkBan;
            $MaxTrailer = ($MaxTrailer === '') ? null : $MaxTrailer;
            $NightCost = ($NightCost === '') ? null : $NightCost;
            $conn = DBConnection::getConnection();
            $sql = "EXEC [dbo].[WNV_LG_TruckTypeInsUpDelSp] @TruckType=:TruckType, @TruckTypeName=:TruckTypeName, @Capacity=:Capacity, @Tolerance=:Tolerance, @Installment=:Installment, @DriverCost=:DriverCost, @HelperCost=:HelperCost, @FuelRate=:FuelRate, @WearCost=:WearCost, @MaintCost=:MaintCost, @TransRate=:TransRate, @Day=:Day, @LoadMin=:LoadMin, @BkkBan=:BkkBan, @MaxTrailer=:MaxTrailer, @NightCost=:NightCost, @action=:action";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':TruckType', $TruckType, $TruckType === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
            $stmt->bindParam(':TruckTypeName', $TruckTypeName, $TruckTypeName === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
            $stmt->bindParam(':Capacity', $Capacity, $Capacity === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
            $stmt->bindParam(':Tolerance', $Tolerance, $Tolerance === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
            $stmt->bindParam(':Installment', $Installment, $Installment === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
            $stmt->bindParam(':DriverCost', $DriverCost, $DriverCost === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
            $stmt->bindParam(':HelperCost', $HelperCost, $HelperCost === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
            $stmt->bindParam(':FuelRate', $FuelRate, $FuelRate === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
            $stmt->bindParam(':WearCost', $WearCost, $WearCost === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
            $stmt->bindParam(':MaintCost', $MaintCost, $MaintCost === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
            $stmt->bindParam(':TransRate', $TransRate, $TransRate === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
            $stmt->bindParam(':Day', $Day, $Day === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
            $stmt->bindParam(':LoadMin', $LoadMin, $LoadMin === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
            $stmt->bindParam(':BkkBan', $BkkBan, $BkkBan === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
            $stmt->bindParam(':MaxTrailer', $MaxTrailer, $MaxTrailer === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
            $stmt->bindParam(':NightCost', $NightCost, $NightCost === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
            $stmt->bindParam(':action', $action, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("[" . date('Y-m-d H:i:s') . "] " . $e->getMessage());
            return false;
        }
    }
}
