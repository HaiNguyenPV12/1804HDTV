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

$('#imgModal').on('hidden.bs.modal', function () {
    $('#imgModal').modal('hide');
    $("#modalHeader").html("");
    $("#modalBody").html("");
    var bid = $("#imgbid").val();
    $("#main").load("bouquetimglist.php?bid="+bid);
});

$(document).ready(function() {
    var bid = $("#imgbid").val();
    $("#main").load("bouquetimglist.php?bid="+bid);
});