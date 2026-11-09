<div class="app-content-header">
    <div class="container-fluid"><h3 class="mb-0">Delivery Location</h3></div>
</div>
<div class="app-content">
    <div class="container-fluid">
        <button type="button" class="fixed-circle-button btn btn-primary" onclick="cleardata(); $('#modal-InsEditDeliveryLocation').modal('show');" <?= $bootstrapError ? 'disabled' : '' ?>>＋</button>
        <div class="card mb-4">
            <div class="card-body">
                <?php if ($bootstrapError): ?><div class="alert alert-warning" role="alert"><?= h($bootstrapError) ?></div><?php endif; ?>
                <div class="table-responsive mt-4">
                    <table id="example" class="table table-head-fixed" style="width:100%">
                        <thead><tr>
                        <th>BPCode</th>
                        <th>BPName</th>
                        <th>ShipVia</th>
                        <th>TruckA</th>
                        <th>TruckB</th>
                        <th>TruckC</th>
                        <th>TruckD</th>
                        <th>HardCost</th>
                        <th>Min_HardCost</th>
                        <th>BF_DueDate</th>
                        <th>AT_DueDate</th>
                        <th>Latitude</th>
                        <th>Longitude</th>
                        <th>Req_Booking</th>
                        <th>Edit</th><th>Delete</th>
                        </tr></thead>
                        <tbody>
                        <?php
                        $i = 0;
                        $Record_List = $bootstrapError ? false : controller_wnv_lg_deliverylocation::GetDeliveryLocation();
                        if ($Record_List === false) {
                        } else {
                            if ($Record_List != null && count($Record_List) > 0) {
                                foreach ($Record_List as $key => $result) {
                        $BPCode = $result['BPCode'];
                        $BPName = $result['BPName'];
                        $ShipVia = $result['ShipVia'];
                        $TruckA = $result['TruckA'];
                        $TruckB = $result['TruckB'];
                        $TruckC = $result['TruckC'];
                        $TruckD = $result['TruckD'];
                        $HardCost = $result['HardCost'];
                        $Min_HardCost = $result['Min_HardCost'];
                        $BF_DueDate = $result['BF_DueDate'];
                        $AT_DueDate = $result['AT_DueDate'];
                        $Latitude = $result['Latitude'];
                        $Longitude = $result['Longitude'];
                        $Req_Booking = $result['Req_Booking'];
                                    $i++;
                                    // รูปแบบ editshow เหมือนตัวอย่าง: encode ก่อนคั่น เพื่อไม่ให้ | ในข้อมูลทำให้แยกผิด
                                    $editValue = implode('|', array_map(
                                        fn($value) => rawurlencode((string)($value ?? '')),
                                        [$BPCode, $BPName, $ShipVia, $TruckA, $TruckB, $TruckC, $TruckD, $HardCost, $Min_HardCost, $BF_DueDate, $AT_DueDate, $Latitude, $Longitude, $Req_Booking]
                                    ));
                        ?>
                        <tr>
                        <td><?= h($BPCode) ?></td>
                        <td><?= h($BPName) ?></td>
                        <td><?= h($ShipVia) ?></td>
                        <td><?= h($TruckA) ?></td>
                        <td><?= h($TruckB) ?></td>
                        <td><?= h($TruckC) ?></td>
                        <td><?= h($TruckD) ?></td>
                        <td><?= h($HardCost) ?></td>
                        <td><?= h($Min_HardCost) ?></td>
                        <td><?= h($BF_DueDate) ?></td>
                        <td><?= h($AT_DueDate) ?></td>
                        <td><?= h($Latitude) ?></td>
                        <td><?= h($Longitude) ?></td>
                        <td><?= h($Req_Booking) ?></td>
                            <td><button type="button" class="btn btn-link btn-sm edit-record" data-edit-index="<?= $i ?>" onclick="EditDeliveryLocation(<?= $i ?>);">Edit</button></td>
                            <td><button type="button" class="btn btn-link btn-sm text-danger" onclick="DeleteDeliveryLocation(<?= $i ?>);">Delete</button></td>
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

<div class="modal fade" id="modal-InsEditDeliveryLocation" tabindex="-1" aria-labelledby="edit-title" aria-hidden="true">
    <div class="modal-dialog modal-lg"><div class="modal-content">
        <div class="modal-header"><h5 class="modal-title" id="edit-title">Delivery Location</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="ปิด"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
            <form id="RecordForm" method="post" action="?s=master&r=wnv_lg_deliverylocation">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="BPCode">BPCode · Key</label>
                        <input class="form-control" type="text" id="BPCode" name="BPCode" required maxlength="10">
                        <small class="text-muted">nvarchar(10)</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="BPName">BPName</label>
                        <input class="form-control" type="text" id="BPName" name="BPName"  maxlength="100">
                        <small class="text-muted">nvarchar(100)</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="ShipVia">ShipVia</label>
                        <input class="form-control" type="text" id="ShipVia" name="ShipVia"  maxlength="10">
                        <small class="text-muted">nvarchar(10)</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="TruckA">TruckA</label>
                        <input class="form-control" type="text" id="TruckA" name="TruckA"  maxlength="1">
                        <small class="text-muted">nvarchar(1)</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="TruckB">TruckB</label>
                        <input class="form-control" type="text" id="TruckB" name="TruckB"  maxlength="1">
                        <small class="text-muted">nvarchar(1)</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="TruckC">TruckC</label>
                        <input class="form-control" type="text" id="TruckC" name="TruckC"  maxlength="1">
                        <small class="text-muted">nvarchar(1)</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="TruckD">TruckD</label>
                        <input class="form-control" type="text" id="TruckD" name="TruckD"  maxlength="1">
                        <small class="text-muted">nvarchar(1)</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="HardCost">HardCost</label>
                        <input class="form-control" type="number" step="0.01" id="HardCost" name="HardCost" inputmode="decimal" >
                        <small class="text-muted">decimal(18,2)</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="Min_HardCost">Min_HardCost</label>
                        <input class="form-control" type="number" step="0.01" id="Min_HardCost" name="Min_HardCost" inputmode="decimal" >
                        <small class="text-muted">decimal(18,2)</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="BF_DueDate">BF_DueDate</label>
                        <input class="form-control" type="number" step="1" id="BF_DueDate" name="BF_DueDate" inputmode="decimal" >
                        <small class="text-muted">int</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="AT_DueDate">AT_DueDate</label>
                        <input class="form-control" type="number" step="1" id="AT_DueDate" name="AT_DueDate" inputmode="decimal" >
                        <small class="text-muted">int</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="Latitude">Latitude</label>
                        <input class="form-control" type="text" id="Latitude" name="Latitude"  maxlength="50">
                        <small class="text-muted">nvarchar(50)</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="Longitude">Longitude</label>
                        <input class="form-control" type="text" id="Longitude" name="Longitude"  maxlength="50">
                        <small class="text-muted">nvarchar(50)</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="Req_Booking">Req_Booking</label>
                        <input class="form-control" type="text" id="Req_Booking" name="Req_Booking"  maxlength="1">
                        <small class="text-muted">nvarchar(1)</small>
                    </div>
                </div>
                <input type="hidden" name="csrf_token" value="<?= h($_SESSION['csrf_token']) ?>">
                <input type="hidden" id="action" name="action" value="I">
                <input type="hidden" name="Recordedit" id="Recordedit">
                <div class="d-flex justify-content-end" style="gap:12px">
                    <button type="button" class="btn btn-outline-dark" onclick="cleardata();">Clear</button>
                    <button type="button" class="btn btn-primary" id="saveBtn" onclick="ValidateDeliveryLocation();">Save</button>
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
<script src="views/js/master/wnv_lg_deliverylocation.js"></script>
<?php
// เช่นเดียวกับท้าย WNV_AuthGroup.php ของตัวอย่าง
if (!$bootstrapError) {
    $ActionRecord = new controller_wnv_lg_deliverylocation;
    $ActionRecord->Action_DeliveryLocation();
}
?>
