<div class="app-content-header">
    <div class="container-fluid"><h3 class="mb-0">SO Booking</h3></div>
</div>
<div class="app-content">
    <div class="container-fluid">
        <button type="button" class="fixed-circle-button btn btn-primary" onclick="cleardata(); $('#modal-InsEditSOBooking').modal('show');" <?= $bootstrapError ? 'disabled' : '' ?>>＋</button>
        <div class="card mb-4">
            <div class="card-body">
                <?php if ($bootstrapError): ?><div class="alert alert-warning" role="alert"><?= h($bootstrapError) ?></div><?php endif; ?>
                <div class="table-responsive mt-4">
                    <table id="example" class="table table-head-fixed" style="width:100%">
                        <thead><tr>
                        <th>SONo</th>
                        <th>BookingDate</th>
                        <th>Edit</th><th>Delete</th>
                        </tr></thead>
                        <tbody>
                        <?php
                        $i = 0;
                        $Record_List = $bootstrapError ? false : controller_wnv_lg_sobooking::GetSOBooking();
                        if ($Record_List === false) {
                        } else {
                            if ($Record_List != null && count($Record_List) > 0) {
                                foreach ($Record_List as $key => $result) {
                        $SONo = $result['SONo'];
                        $BookingDate = $result['BookingDate'];
                                    $i++;
                                    // รูปแบบ editshow เหมือนตัวอย่าง: encode ก่อนคั่น เพื่อไม่ให้ | ในข้อมูลทำให้แยกผิด
                                    $editValue = implode('|', array_map(
                                        fn($value) => rawurlencode((string)($value ?? '')),
                                        [$SONo, $BookingDate]
                                    ));
                        ?>
                        <tr>
                        <td><?= h($SONo) ?></td>
                        <td><?= h($BookingDate) ?></td>
                            <td><button type="button" class="btn btn-link btn-sm edit-record" data-edit-index="<?= $i ?>" onclick="EditSOBooking(<?= $i ?>);">Edit</button></td>
                            <td><button type="button" class="btn btn-link btn-sm text-danger" onclick="DeleteSOBooking(<?= $i ?>);">Delete</button></td>
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

<div class="modal fade" id="modal-InsEditSOBooking" tabindex="-1" aria-labelledby="edit-title" aria-hidden="true">
    <div class="modal-dialog modal-lg"><div class="modal-content">
        <div class="modal-header"><h5 class="modal-title" id="edit-title">SO Booking</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="ปิด"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
            <form id="RecordForm" method="post" action="?s=master&r=wnv_lg_sobooking">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="SONo">SONo · Key</label>
                        <input class="form-control" type="text" id="SONo" name="SONo" required maxlength="9">
                        <small class="text-muted">nvarchar(9)</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="BookingDate">BookingDate</label>
                        <input class="form-control" type="datetime-local" id="BookingDate" name="BookingDate" step="any" >
                        <small class="text-muted">datetime</small>
                    </div>
                </div>
                <input type="hidden" name="csrf_token" value="<?= h($_SESSION['csrf_token']) ?>">
                <input type="hidden" id="action" name="action" value="I">
                <input type="hidden" name="Recordedit" id="Recordedit">
                <div class="d-flex justify-content-end" style="gap:12px">
                    <button type="button" class="btn btn-outline-dark" onclick="cleardata();">Clear</button>
                    <button type="button" class="btn btn-primary" id="saveBtn" onclick="ValidateSOBooking();">Save</button>
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
<script src="views/js/master/wnv_lg_sobooking.js"></script>
<?php
// เช่นเดียวกับท้าย WNV_AuthGroup.php ของตัวอย่าง
if (!$bootstrapError) {
    $ActionRecord = new controller_wnv_lg_sobooking;
    $ActionRecord->Action_SOBooking();
}
?>
