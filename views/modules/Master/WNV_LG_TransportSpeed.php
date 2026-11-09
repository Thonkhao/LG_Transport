<div class="app-content-header">
    <div class="container-fluid"><h3 class="mb-0">Transport Speed</h3></div>
</div>
<div class="app-content">
    <div class="container-fluid">
        <button type="button" class="fixed-circle-button btn btn-primary" onclick="cleardata(); $('#modal-InsEditTransportSpeed').modal('show');" <?= $bootstrapError ? 'disabled' : '' ?>>＋</button>
        <div class="card mb-4">
            <div class="card-body">
                <?php if ($bootstrapError): ?><div class="alert alert-warning" role="alert"><?= h($bootstrapError) ?></div><?php endif; ?>
                <div class="table-responsive mt-4">
                    <table id="example" class="table table-head-fixed" style="width:100%">
                        <thead><tr>
                        <th>Code</th>
                        <th>Desc</th>
                        <th>Speed</th>
                        <th>Edit</th><th>Delete</th>
                        </tr></thead>
                        <tbody>
                        <?php
                        $i = 0;
                        $Record_List = $bootstrapError ? false : controller_wnv_lg_transportspeed::GetTransportSpeed();
                        if ($Record_List === false) {
                        } else {
                            if ($Record_List != null && count($Record_List) > 0) {
                                foreach ($Record_List as $key => $result) {
                        $Code = $result['Code'];
                        $Desc = $result['Desc'];
                        $Speed = $result['Speed'];
                                    $i++;
                                    // รูปแบบ editshow เหมือนตัวอย่าง: encode ก่อนคั่น เพื่อไม่ให้ | ในข้อมูลทำให้แยกผิด
                                    $editValue = implode('|', array_map(
                                        fn($value) => rawurlencode((string)($value ?? '')),
                                        [$Code, $Desc, $Speed]
                                    ));
                        ?>
                        <tr>
                        <td><?= h($Code) ?></td>
                        <td><?= h($Desc) ?></td>
                        <td><?= h($Speed) ?></td>
                            <td><button type="button" class="btn btn-link btn-sm edit-record" data-edit-index="<?= $i ?>" onclick="EditTransportSpeed(<?= $i ?>);">Edit</button></td>
                            <td><button type="button" class="btn btn-link btn-sm text-danger" onclick="DeleteTransportSpeed(<?= $i ?>);">Delete</button></td>
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

<div class="modal fade" id="modal-InsEditTransportSpeed" tabindex="-1" aria-labelledby="edit-title" aria-hidden="true">
    <div class="modal-dialog modal-lg"><div class="modal-content">
        <div class="modal-header"><h5 class="modal-title" id="edit-title">Transport Speed</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="ปิด"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
            <form id="RecordForm" method="post" action="?s=master&r=wnv_lg_transportspeed">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="Code">Code · Key</label>
                        <input class="form-control" type="text" id="Code" name="Code" required maxlength="50">
                        <small class="text-muted">nvarchar(50)</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="Desc">Desc</label>
                        <input class="form-control" type="text" id="Desc" name="Desc"  maxlength="100">
                        <small class="text-muted">nvarchar(100)</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="Speed">Speed</label>
                        <input class="form-control" type="number" step="1" id="Speed" name="Speed" inputmode="decimal" >
                        <small class="text-muted">int</small>
                    </div>
                </div>
                <input type="hidden" name="csrf_token" value="<?= h($_SESSION['csrf_token']) ?>">
                <input type="hidden" id="action" name="action" value="I">
                <input type="hidden" name="Recordedit" id="Recordedit">
                <div class="d-flex justify-content-end" style="gap:12px">
                    <button type="button" class="btn btn-outline-dark" onclick="cleardata();">Clear</button>
                    <button type="button" class="btn btn-primary" id="saveBtn" onclick="ValidateTransportSpeed();">Save</button>
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
<script src="views/js/master/wnv_lg_transportspeed.js"></script>
<?php
// เช่นเดียวกับท้าย WNV_AuthGroup.php ของตัวอย่าง
if (!$bootstrapError) {
    $ActionRecord = new controller_wnv_lg_transportspeed;
    $ActionRecord->Action_TransportSpeed();
}
?>
