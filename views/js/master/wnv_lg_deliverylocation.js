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
    const edit = $('#modal-InsEditDeliveryLocation');
    if (edit.hasClass('show')) {
        edit.one('hidden.bs.modal', function () { $('#' + ids).modal('show'); });
        edit.modal('hide');
    } else {
        $('#' + ids).modal('show');
    }
}
function EditDeliveryLocation(i) {
    var RecordData = $('#editshow-' + i).val();
    var RecordParts = RecordData.split('|').map(decodeURIComponent);
    document.getElementById('BPCode').disabled = true;
    $('#BPCode').val(RecordParts[0] ?? '');
    $('#BPName').val(RecordParts[1] ?? '');
    $('#ShipVia').val(RecordParts[2] ?? '');
    $('#TruckA').val(RecordParts[3] ?? '');
    $('#TruckB').val(RecordParts[4] ?? '');
    $('#TruckC').val(RecordParts[5] ?? '');
    $('#TruckD').val(RecordParts[6] ?? '');
    $('#HardCost').val(RecordParts[7] ?? '');
    $('#Min_HardCost').val(RecordParts[8] ?? '');
    $('#BF_DueDate').val(RecordParts[9] ?? '');
    $('#AT_DueDate').val(RecordParts[10] ?? '');
    $('#Latitude').val(RecordParts[11] ?? '');
    $('#Longitude').val(RecordParts[12] ?? '');
    $('#Req_Booking').val(RecordParts[13] ?? '');
    $('#action').val('E');
    $('#saveBtn').text('Save');
    $('#Recordedit').val(RecordData);
    $('#textshow').text('ยืนยันการแก้ไขข้อมูล');
    $('#modal-InsEditDeliveryLocation').modal('show');
}
function cleardata() {
    $('#action').val('I');
    document.getElementById('BPCode').disabled = false;
    $('#BPCode').val('');
    $('#BPName').val('');
    $('#ShipVia').val('');
    $('#TruckA').val('');
    $('#TruckB').val('');
    $('#TruckC').val('');
    $('#TruckD').val('');
    $('#HardCost').val('');
    $('#Min_HardCost').val('');
    $('#BF_DueDate').val('');
    $('#AT_DueDate').val('');
    $('#Latitude').val('');
    $('#Longitude').val('');
    $('#Req_Booking').val('');
    $('#Recordedit').val('');
    $('#textshow').text('ยืนยันการบันทึกข้อมูล');
    $('#saveBtn').text('Save');
}
function DeleteDeliveryLocation(i) {
    var RecordData = $('#editshow-' + i).val();
    $('#action').val('D');
    $('#Recordedit').val(RecordData);
    $('#textshow').text('ยืนยันการลบข้อมูล');
    Confirmaction('Confirmaction');
}
function ValidateDeliveryLocation() {
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
        if (reopen) $('#modal-InsEditDeliveryLocation').modal('show');
    }).modal('hide');
}
