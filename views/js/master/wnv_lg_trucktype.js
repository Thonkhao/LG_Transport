$(document).ready(function () {
    $('#example').DataTable({
        order: [],
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
        searching: true,
        autoWidth: true,
        scrollX: true,
        columnDefs: [{ targets: [-1, -2], orderable: false, searchable: false }]
    });
});
function hideModel(ids) { $('#' + ids).modal('hide'); }
function Confirmaction(ids) {
    const edit = $('#modal-InsEditTruckType');
    if (edit.hasClass('show')) {
        edit.one('hidden.bs.modal', function () { $('#' + ids).modal('show'); });
        edit.modal('hide');
    } else {
        $('#' + ids).modal('show');
    }
}
function EditTruckType(i) {
    var RecordData = $('#editshow-' + i).val();
    var RecordParts = RecordData.split('|').map(decodeURIComponent);
    document.getElementById('TruckType').disabled = true;
    $('#TruckType').val(RecordParts[0] ?? '');
    $('#TruckTypeName').val(RecordParts[1] ?? '');
    $('#Capacity').val(RecordParts[2] ?? '');
    $('#Tolerance').val(RecordParts[3] ?? '');
    $('#Installment').val(RecordParts[4] ?? '');
    $('#DriverCost').val(RecordParts[5] ?? '');
    $('#HelperCost').val(RecordParts[6] ?? '');
    $('#FuelRate').val(RecordParts[7] ?? '');
    $('#WearCost').val(RecordParts[8] ?? '');
    $('#MaintCost').val(RecordParts[9] ?? '');
    $('#TransRate').val(RecordParts[10] ?? '');
    $('#Day').val(RecordParts[11] ?? '');
    $('#LoadMin').val(RecordParts[12] ?? '');
    $('#BkkBan').val(RecordParts[13] ?? '');
    $('#MaxTrailer').val(RecordParts[14] ?? '');
    $('#NightCost').val(RecordParts[15] ?? '');
    $('#action').val('E');
    $('#saveBtn').text('Save');
    $('#Recordedit').val(RecordData);
    $('#textshow').text('ยืนยันการแก้ไขข้อมูล');
    $('#modal-InsEditTruckType').modal('show');
}
function cleardata() {
    $('#action').val('I');
    document.getElementById('TruckType').disabled = false;
    $('#TruckType').val('');
    $('#TruckTypeName').val('');
    $('#Capacity').val('');
    $('#Tolerance').val('');
    $('#Installment').val('');
    $('#DriverCost').val('');
    $('#HelperCost').val('');
    $('#FuelRate').val('');
    $('#WearCost').val('');
    $('#MaintCost').val('');
    $('#TransRate').val('');
    $('#Day').val('');
    $('#LoadMin').val('');
    $('#BkkBan').val('');
    $('#MaxTrailer').val('');
    $('#NightCost').val('');
    $('#Recordedit').val('');
    $('#textshow').text('ยืนยันการบันทึกข้อมูล');
    $('#saveBtn').text('Save');
}
function DeleteTruckType(i) {
    var RecordData = $('#editshow-' + i).val();
    $('#action').val('D');
    $('#Recordedit').val(RecordData);
    $('#textshow').text('ยืนยันการลบข้อมูล');
    Confirmaction('Confirmaction');
}
function ValidateTruckType() {
    const form = document.getElementById('RecordForm');
    if (!form.checkValidity()) {
        form.reportValidity();
        return;
    }
    $('#textshow').text($('#action').val() === 'I' ? 'ยืนยันการบันทึกข้อมูล' : 'ยืนยันการแก้ไขข้อมูล');
    Confirmaction('Confirmaction');
}
function cancelConfirm() {
    const reopen = $('#action').val() !== 'D';
    $('#Confirmaction').one('hidden.bs.modal', function () {
        if (reopen) $('#modal-InsEditTruckType').modal('show');
    }).modal('hide');
}
