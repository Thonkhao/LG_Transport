function toastralert(title, msg, stat) {
    if (stat == 'Y') {
        var showalert = 'success';
    } else if (stat == 'I') {
        var showalert = 'info';
    } else if (stat == 'W') {
        var showalert = 'warning';
    } else {
        var showalert = 'error';
    }

    toastr.options = {
        "escapeHtml": true,
        "closeButton": false,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-center",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "4000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    toastr[showalert](msg, title)
}


function handleSubmitViaClick(formSelector, loadingOverlayId = 'loading-overlay') {
    const form = document.querySelector(formSelector);
    if (!form) return;

    // Disable ปุ่ม submit
    const submitButton = form.querySelector("button[type='submit']");
    if (submitButton) {
        submitButton.disabled = true;
    }

    const buttonButton = form.querySelector("button[type='button']");
    if (buttonButton) {
        buttonButton.disabled = true;
    }

    // ป้องกันการ refresh
    window.addEventListener("keydown", function (e) {
        if (e.key === "F5" || (e.ctrlKey && e.key.toLowerCase() === "r")) {
            e.preventDefault();
            alert("กำลังดำเนินการ กรุณารอ...");
        }
    });

    // ป้องกันปุ่ม back
    history.pushState(null, null, location.href);
    window.onpopstate = function () {
        history.go(1);
        alert("ไม่สามารถย้อนกลับได้ระหว่างดำเนินการ");
    };
    // แสดง overlay
    const loadingOverlay = document.getElementById(loadingOverlayId);
    if (loadingOverlay) {
        loadingOverlay.style.display = 'flex';
    }
    document.body.style.pointerEvents = 'none';
    form.submit();
}

$(function () {
    $('#menu-toggle').on('click', function () {
        const open = document.body.classList.toggle('menu-open');
        this.setAttribute('aria-expanded', String(open));
    });
});
