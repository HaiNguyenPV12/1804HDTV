function showModal(type, title, url){
    if (type=="small") {
        $("#modalSetting").attr("class","modal-dialog modal-sm modal-dialog-centered modal-dialog-scrollable");
    }else if(type=="large"){
        $("#modalSetting").attr("class","modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable");
    }else{
        $("#modalSetting").attr("class","modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable");
    }
    $("#modalHeader").html(title);
    $("#modalBody").load(encodeURI(url));
}

$('#modal').on('hidden.bs.modal', function () {
    $('#modal').modal('hide');
    $("#modalHeader").html("");
    $("#modalBody").html("");
    $("#main").load("flowercatelist.php");
});

$(document).ready(function() {
    $("#main").load("flowercatelist.php");
});