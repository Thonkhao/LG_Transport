<div class="app-content-header">
    <div class="container-fluid"><h3 class="mb-0">Truck Downgrade</h3></div>
</div>
<div class="app-content">
    <div class="container-fluid">
        <button type="button" class="fixed-circle-button btn btn-primary" onclick="cleardata(); $('#modal-InsEditTruckDowngrade').modal('show');" <?= $bootstrapError ? 'disabled' : '' ?>>＋</button>
        <div class="card mb-4">
            <div class="card-body">
                <?php if ($bootstrapError): ?><div class="alert alert-warning" role="alert"><?= h($bootstrapError) ?></div><?php endif; ?>
                <div class="table-responsive mt-4">
                    <table id="example" class="table table-head-fixed" style="width:100%">
                        <thead><tr>
                        <th>DeliveryZone</th>
                        <th>DowngradeStep</th>
                        <th>TruckType</th>
                        <th>Edit</th><th>Delete</th>
                        </tr></thead>
                        <tbody>
                        <?php
                        $i = 0;
                        $Record_List = $bootstrapError ? false : controller_wnv_lg_truckdowngrade::GetTruckDowngrade();
                        if ($Record_List === false) {
                        } else {
                            if ($Record_List != null && count($Record_List) > 0) {
                                foreach ($Record_List as $key => $result) {
                        $DeliveryZone = $result['DeliveryZone'];
                        $DowngradeStep = $result['DowngradeStep'];
                        $TruckType = $result['TruckType'];
                                    $i++;
                                    // รูปแบบ editshow เหมือนตัวอย่าง: encode ก่อนคั่น เพื่อไม่ให้ | ในข้อมูลทำให้แยกผิด
                                    $editValue = implode('|', array_map(
                                        fn($value) => rawurlencode((string)($value ?? '')),
                                        [$DeliveryZone, $DowngradeStep, $TruckType]
                                    ));
                        ?>
                        <tr>
                        <td><?= h($DeliveryZone) ?></td>
                        <td><?= h($DowngradeStep) ?></td>
                        <td><?= h($TruckType) ?></td>
                            <td><button type="button" class="btn btn-link btn-sm edit-record" data-edit-index="<?= $i ?>" disabled title="ตารางนี้มีเฉพาะ Primary Key จึงไม่มีคอลัมน์ที่แก้ไขได้">Edit</button></td>
                            <td><button type="button" class="btn btn-link btn-sm text-danger" onclick="DeleteTruckDowngrade(<?= $i ?>);">Delete</button></td>
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

<div class="modal fade" id="modal-InsEditTruckDowngrade" tabindex="-1" aria-labelledby="edit-title" aria-hidden="true">
    <div class="modal-dialog modal-lg"><div class="modal-content">
        <div class="modal-header"><h5 class="modal-title" id="edit-title">Truck Downgrade</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="ปิด"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
            <form id="RecordForm" method="post" action="?s=master&r=wnv_lg_truckdowngrade">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="DeliveryZone">DeliveryZone · Key</label>
                        <input class="form-control" type="text" id="DeliveryZone" name="DeliveryZone" required maxlength="10">
                        <small class="text-muted">nvarchar(10)</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="DowngradeStep">DowngradeStep · Key</label>
                        <input class="form-control" type="number" step="1" id="DowngradeStep" name="DowngradeStep" inputmode="decimal" required>
                        <small class="text-muted">int</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="TruckType">TruckType · Key</label>
                        <input class="form-control" type="text" id="TruckType" name="TruckType" required maxlength="10">
                        <small class="text-muted">nvarchar(10)</small>
                    </div>
                </div>
                <input type="hidden" name="csrf_token" value="<?= h($_SESSION['csrf_token']) ?>">
                <input type="hidden" id="action" name="action" value="I">
                <input type="hidden" name="Recordedit" id="Recordedit">
                <div class="d-flex justify-content-end" style="gap:12px">
                    <button type="button" class="btn btn-outline-dark" onclick="cleardata();">Clear</button>
                    <button type="button" class="btn btn-primary" id="saveBtn" onclick="ValidateTruckDowngrade();">Save</button>
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
<script src="views/js/master/wnv_lg_truckdowngrade.js"></script>
<?php
// เช่นเดียวกับท้าย WNV_AuthGroup.php ของตัวอย่าง
if (!$bootstrapError) {
    $ActionRecord = new controller_wnv_lg_truckdowngrade;
    $ActionRecord->Action_TruckDowngrade();
}
?> 