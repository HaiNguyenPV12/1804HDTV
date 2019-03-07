$("[name=cid]").click(function(){
    $("#cusname").html($(this).val());
});

$("#add").click(function(){
    if ($("#quan").val()>=1) {
        if (($("#view").html()).indexOf($("#insert :selected").val())!=-1) {
            $("li[name=cartitem]").each(function(i,data){
                //console.log($(this).html());
                if (($(this).html()).indexOf($("#insert :selected").val())!=-1) {
                    //console.log($("#insert :selected").val());
                    var oldquan = $(this).find("[name=itemquan]");
                    var newquan = +oldquan.val() + +$("#quan").val();
                    var itemid = $(this).find("[name=itemid]").val();
                    //consolelog(fnewquan);
                    var item = $(this).find("[name='item[]']");
                    //console.log(fdata.val());

                    oldquan.val(newquan);
                    item.val(itemid+":"+newquan)
                    $(this).find("[name=itemvquan]").html(newquan);
                }
            });
        }else{
            $("#view").append("<li name='cartitem'>"
            +"<span name='itemvname'>"+$("#insert :selected").html()+"</span>"
            +" : "
            +"<span name='itemvquan'>"+$("#quan").val()+"</span>"
            + "<input type='hidden' name='item[]' value='"+$("#insert :selected").val()+":"+$("#quan").val()+"'>"
            + "<input type='hidden' name='itemid' value='"+$("#insert :selected").val()+"'>"
            + "<input type='hidden' name='itemquan' value='"+$("#quan").val()+"'>"
            + "</li>");
        }
        
    }
});

$(document).on("click","#cartitem",function(){
    $(this).remove();
 });