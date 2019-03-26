<?php
include "../src/fconnectadmin.php";
session_start();
?>

<!-- content -->

<div class="container row border bg-light col-10">
    <div id="contact_form" class="row">
        <div class="col-md-12">
            <h2 class="text-center">Đóng góp ý kiến!</h2>
            <form id="frmFeedback" action="" class="form mb-3 row container">
                <p>Mỗi góp ý của bạn đều giúp cho dịch vụ của chúng tôi hoàn thiện hơn để phục vụ khách hàng một cách tốt nhất!</p>
                <div class="form-group">
                    <input id="txtPhone" name="txtPhone" required class="form-control mb-2" type="text" placeholder="Số điện thoại *">
                    <label class="control-label" for="message">Tin nhắn *</label>
                    <textarea required name="txtDetail" id="txtDetail" cols="50" rows="2" class="form-control mb-2" placeholder="Hãy viết góp ý của bạn tại đây *"></textarea>
                    <button type="submit" id="feedbackSubmit" class="btn btn-primary btn-lg btn-shop" data-loading-text="Sending..." style="display: block; margin-top: 10px;">Gửi góp ý</button>
                </div>
            </form>     
        </div>
    </div>
</div>

