function closeModal(){
    $('#modal').modal('hide');
    $('#result').modal('hide');
}

$('#cmdCancel').click(function (e) 
    {
        $('#modal').modal('toggle');
    }
);

//reload để load lại dữ liệu từ sql
function reloadPage(){   
    location.reload();
}

//Reset khi tắt modal add
/*
$('#modal').on('hidden.bs.modal', function (e) 
    {
        reloadPage();
    }
);
*/

//=========================== Xử lý submit dữ liệu =================================//
var request;
//Nếu form submit
$('#cmdDelete').click(function(event){
    // Abort any pending request
    event.preventDefault();

    if (request) {
        request.abort();
    }
    var myFormData = new FormData();
    myFormData.append('cmdDelete', "");
    if ($("#bid").length) {
        myFormData.append('bid', $("#bid").val());
    }else if($("#bimgid").length){
        myFormData.append('bimgid', $("#bimgid").val());
    }else if($("#fid").length){
        myFormData.append('fid', $("#fid").val());
    }else if($("#roleid").length){
        myFormData.append('roleid', $("#roleid").val());
    }
    //var $form = $(this);
    //var serializedData = $form.serialize();
    // Fire off the request to /form.php
    
    
    request = $.ajax({
        url: "./Pages/process.php",
        type: "post",
        data: myFormData,
        processData: false,
        contentType: false
    });
    // Callback handler that will be called on success
    request.done(function (response, textStatus, jqXHR){
        // Log a message to the console
        //alert(textStatus);
        if (response=="ok") {
            $("#txtResult").addClass("text-success");
            $("#txtResult").html("<h2>Xóa thành công!</h2>");
            $('#result').modal('show');
            window.setTimeout(closeModal, 1500);
            window.setTimeout(reloadPage, 500);
        }else{
            //$("#txtResult").addClass("text-success");
            $("#txtResult").html(response);
            $('#result').modal('show');
        }
        
    });

    // Callback handler that will be called on failure
    request.fail(function (jqXHR, textStatus, errorThrown){
        // Log the error to the console
        console.error(
            "The following error occurred: "+
            textStatus, errorThrown
        );
    });

    // Callback handler that will be called regardless
    // if the request failed or succeeded
    request.always(function () {
        
    });
});
