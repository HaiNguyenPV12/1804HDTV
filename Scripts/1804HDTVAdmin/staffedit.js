$(document).ready(function () {
    //scroll to top
    $('html,body').animate({ scrollTop: 0 }, 100); //miliseconds
    $('#staffEditForm').change(function (e) {
        e.preventDefault();
        $('#btnStaffEditLink').attr('href', '#!staffedit/update/' + staffID.value
            + '/' + staffName.value + '/' + staffRole.value
            + '/' + staffEmail.value + '/' + staffUID.value
            + '/' + staffPW.value + '/' + staffPhone.value
            + '/' + staffAdd.value + '/' + staffEmployed.value
        );
        // console.log($('#btnStaffEditLink').attr('href'));
    });
});