<div class="app-content-header">
    <div class="container-fluid"><h3 class="mb-0">Truck Type</h3></div>
</div>
<div class="app-content">
    <div class="container-fluid">
        <button type="button" class="fixed-circle-button btn btn-primary" onclick="cleardata(); $('#modal-InsEditTruckType').modal('show');" <?= $bootstrapError ? 'disabled' : '' ?>>＋</button>
        <div class="card mb-4">
            <div class="card-body">
                <?php if ($bootstrapError): ?><div class="alert alert-warning" role="alert"><?= h($bootstrapError) ?></div><?php endif; ?>
                <div class="table-responsive mt-4">
                    <table id="example" class="table table-head-fixed" style="width:100%">
                        <thead><tr>
                        <th>TruckType</th>
                        <th>TruckTypeName</th>
                        <th>Capacity</th>
                        <th>Tolerance</th>
                        <th>Installment</th>
                        <th>DriverCost</th>
                        <th>HelperCost</th>
                        <th>FuelRate</th>
                        <th>WearCost</th>
                        <th>MaintCost</th>
                        <th>TransRate</th>
                        <th>Day</th>
                        <th>LoadMin</th>
                        <th>BkkBan</th>
                        <th>MaxTrailer</th>
                        <th>NightCost</th>
                        <th>Edit</th><th>Delete</th>
                        </tr></thead>
                        <tbody>
                        <?php
                        $i = 0;
                        $Record_List = $bootstrapError ? false : controller_wnv_lg_trucktype::GetTruckType();
                        if ($Record_List === false) {
                        } else {
                            if ($Record_List != null && count($Record_List) > 0) {
                                foreach ($Record_List as $key => $result) {
                        $TruckType = $result['TruckType'];
                        $TruckTypeName = $result['TruckTypeName'];
                        $Capacity = $result['Capacity'];
                        $Tolerance = $result['Tolerance'];
                        $Installment = $result['Installment'];
                        $DriverCost = $result['DriverCost'];
                        $HelperCost = $result['HelperCost'];
                        $FuelRate = $result['FuelRate'];
                        $WearCost = $result['WearCost'];
                        $MaintCost = $result['MaintCost'];
                        $TransRate = $result['TransRate'];
                        $Day = $result['Day'];
                        $LoadMin = $result['LoadMin'];
                        $BkkBan = $result['BkkBan'];
                        $MaxTrailer = $result['MaxTrailer'];
                        $NightCost = $result['NightCost'];
                                    $i++;
                                    // รูปแบบ editshow เหมือนตัวอย่าง: encode ก่อนคั่น เพื่อไม่ให้ | ในข้อมูลทำให้แยกผิด
                                    $editValue = implode('|', array_map(
                                        fn($value) => rawurlencode((string)($value ?? '')),
                                        [$TruckType, $TruckTypeName, $Capacity, $Tolerance, $Installment, $DriverCost, $HelperCost, $FuelRate, $WearCost, $MaintCost, $TransRate, $Day, $LoadMin, $BkkBan, $MaxTrailer, $NightCost]
                                    ));
                        ?>
                        <tr>
                        <td><?= h($TruckType) ?></td>
                        <td><?= h($TruckTypeName) ?></td>
                        <td><?= h($Capacity) ?></td>
                        <td><?= h($Tolerance) ?></td>
                        <td><?= h($Installment) ?></td>
                        <td><?= h($DriverCost) ?></td>
                        <td><?= h($HelperCost) ?></td>
                        <td><?= h($FuelRate) ?></td>
                        <td><?= h($WearCost) ?></td>
                        <td><?= h($MaintCost) ?></td>
                        <td><?= h($TransRate) ?></td>
                        <td><?= h($Day) ?></td>
                        <td><?= h($LoadMin) ?></td>
                        <td><?= h($BkkBan) ?></td>
                        <td><?= h($MaxTrailer) ?></td>
                        <td><?= h($NightCost) ?></td>
                            <td><button type="button" class="btn btn-link btn-sm edit-record" data-edit-index="<?= $i ?>" onclick="EditTruckType(<?= $i ?>);">Edit</button></td>
                            <td><button type="button" class="btn btn-link btn-sm text-danger" onclick="DeleteTruckType(<?= $i ?>);">Delete</button></td>
                        </tr>
                        <?php
                                    $editRecords[$i] = $editValue;
                                }
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                    <?php if ($Record_List === false && !$bootstrapError): ?>
                    <div class="alert alert-danger">อ่านข้อมูลไม่สำเร็จ กรุณาตรวจการเชื่อมต่อและสิทธิ์</div>
                    <?php endif; ?>
                </div>
                <?php foreach (($editRecords ?? []) as $recordIndex => $editValue): ?>
                <input type="hidden" id="editshow-<?= $recordIndex ?>" value="<?= h($editValue) ?>">
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-InsEditTruckType" tabindex="-1" aria-labelledby="edit-title" aria-hidden="true">
    <div class="modal-dialog modal-lg"><div class="modal-content">
        <div class="modal-header"><h5 class="modal-title" id="edit-title">Truck Type</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="ปิด"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
            <form id="RecordForm" method="post" action="?s=master&r=wnv_lg_trucktype">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="TruckType">TruckType · Key</label>
                        <input class="form-control" type="text" id="TruckType" name="TruckType" required maxlength="10">
                        <small class="text-muted">nvarchar(10)</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="TruckTypeName">TruckTypeName</label>
                        <input class="form-control" type="text" id="TruckTypeName" name="TruckTypeName"  maxlength="100">
                        <small class="text-muted">nvarchar(100)</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="Capacity">Capacity</label>
                        <input class="form-control" type="number" step="0.01" id="Capacity" name="Capacity" inputmode="decimal" >
                        <small class="text-muted">decimal(18,2)</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="Tolerance">Tolerance</label>
                        <input class="form-control" type="number" step="0.01" id="Tolerance" name="Tolerance" inputmode="decimal" >
                        <small class="text-muted">decimal(18,2)</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="Installment">Installment</label>
                        <input class="form-control" type="number" step="0.01" id="Installment" name="Installment" inputmode="decimal" >
                        <small class="text-muted">decimal(18,2)</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="DriverCost">DriverCost</label>
                        <input class="form-control" type="number" step="0.01" id="DriverCost" name="DriverCost" inputmode="decimal" >
                        <small class="text-muted">decimal(18,2)</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="HelperCost">HelperCost</label>
                        <input class="form-control" type="number" step="0.01" id="HelperCost" name="HelperCost" inputmode="decimal" >
                        <small class="text-muted">decimal(18,2)</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="FuelRate">FuelRate</label>
                        <input class="form-control" type="number" step="0.01" id="FuelRate" name="FuelRate" inputmode="decimal" >
                        <small class="text-muted">decimal(18,2)</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="WearCost">WearCost</label>
                        <input class="form-control" type="number" step="0.01" id="WearCost" name="WearCost" inputmode="decimal" >
                        <small class="text-muted">decimal(18,2)</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="MaintCost">MaintCost</label>
                        <input class="form-control" type="number" step="0.01" id="MaintCost" name="MaintCost" inputmode="decimal" >
                        <small class="text-muted">decimal(18,2)</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="TransRate">TransRate</label>
                        <input class="form-control" type="number" step="0.01" id="TransRate" name="TransRate" inputmode="decimal" >
                        <small class="text-muted">decimal(18,2)</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="Day">Day</label>
                        <input class="form-control" type="text" id="Day" name="Day"  maxlength="1">
                        <small class="text-muted">nvarchar(1)</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="LoadMin">LoadMin</label>
                        <input class="form-control" type="number" step="1" id="LoadMin" name="LoadMin" inputmode="decimal" >
                        <small class="text-muted">int</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="BkkBan">BkkBan</label>
                        <input class="form-control" type="text" id="BkkBan" name="BkkBan"  maxlength="1">
                        <small class="text-muted">nvarchar(1)</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="MaxTrailer">MaxTrailer</label>
                        <input class="form-control" type="number" step="1" id="MaxTrailer" name="MaxTrailer" inputmode="decimal" >
                        <small class="text-muted">int</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="NightCost">NightCost</label>
                        <input class="form-control" type="number" step="0.01" id="NightCost" name="NightCost" inputmode="decimal" >
                        <small class="text-muted">decimal(18,2)</small>
                    </div>
                </div>
                <input type="hidden" name="csrf_token" value="<?= h($_SESSION['csrf_token']) ?>">
                <input type="hidden" id="action" name="action" value="I">
                <input type="hidden" name="Recordedit" id="Recordedit">
                <div class="d-flex justify-content-end" style="gap:12px">
                    <button type="button" class="btn btn-outline-dark" onclick="cleardata();">Clear</button>
                    <button type="button" class="btn btn-primary" id="saveBtn" onclick="ValidateTruckType();">Save</button>
                </div>
            </form>
        </div>
    </div></div>
</div>
<div class="modal fade" id="Confirmaction" tabindex="-1" aria-labelledby="textshow" aria-hidden="true">
    <div class="modal-dialog"><div class="modal-content">
        <div class="modal-body text-center"><h5 id="textshow">ยืนยันการบันทึกข้อมูล</h5>
            <div class="d-flex justify-content-center mt-4" style="gap:12px">
                <button type="button" class="btn btn-outline-dark" onclick="cancelConfirm();">Cancel</button>
                <button type="button" class="btn btn-primary" id="Submitbtn" onclick="handleSubmitViaClick('#RecordForm');">Confirm</button>
            </div>
        </div>
    </div></div>
</div>
<script src="views/js/master/wnv_lg_trucktype.js"></script>
<?php
// เช่นเดียวกับท้าย WNV_AuthGroup.php ของตัวอย่าง
if (!$bootstrapError) {
    $ActionRecord = new controller_wnv_lg_trucktype;
    $ActionRecord->Action_TruckType();
}
?>
