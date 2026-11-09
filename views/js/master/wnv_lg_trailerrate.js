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
    const edit = $('#modal-InsEditTrailerRate');
    if (edit.hasClass('show')) {
        edit.one('hidden.bs.modal', function () { $('#' + ids).modal('show'); });
        edit.modal('hide');
    } else {
        $('#' + ids).modal('show');
    }
}
function EditTrailerRate(i) {
    var RecordData = $('#editshow-' + i).val();
    var RecordParts = RecordData.split('|').map(decodeURIComponent);
    document.getElementById('TruckType').disabled = true;
    document.getElementById('TrailerNo').disabled = true;
    $('#TruckType').val(RecordParts[0] ?? '');
    $('#TrailerNo').val(RecordParts[1] ?? '');
    $('#TrailerCost').val(RecordParts[2] ?? '');
    $('#action').val('E');
    $('#saveBtn').text('Save');
    $('#Recordedit').val(RecordData);
    $('#textshow').text('ยืนยันการแก้ไขข้อมูล');
    $('#modal-InsEditTrailerRate').modal('show');
}
function cleardata() {
    $('#action').val('I');
    document.getElementById('TruckType').disabled = false;
    document.getElementById('TrailerNo').disabled = false;
    $('#TruckType').val('');
    $('#TrailerNo').val('');
    $('#TrailerCost').val('');
    $('#Recordedit').val('');
    $('#textshow').text('ยืนยันการบันทึกข้อมูล');
    $('#saveBtn').text('Save');
}
function DeleteTrailerRate(i) {
    var RecordData = $('#editshow-' + i).val();
    $('#action').val('D');
    $('#Recordedit').val(RecordData);
    $('#textshow').text('ยืนยันการลบข้อมูล');
    Confirmaction('Confirmaction');
}
function ValidateTrailerRate() {
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
        if (reopen) $('#modal-InsEditTrailerRate').modal('show');
    }).modal('hide');
}
