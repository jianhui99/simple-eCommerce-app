<div>
    <button id="SyncWpProductBtn" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="right" title="Synchronize from Word Press">Synchronize Products</button>&nbsp;&nbsp;&nbsp;<span id="progressText" style="display: none;">System is synchronizing products from WordPress...</span>
</div>

<script>
    $('#SyncWpProductBtn').on('click', function (){
        $('#SyncWpProductBtn').attr('disabled', true);
        $("#progressText").css("display", "block");
        $.ajax({
            method: 'get',
            url: 'sync-wp-products',
            data: {},
            success: function (res) {
                $('#SyncWpProductBtn').attr('disabled', false);
                $("#progressText").removeAttr('style');
                var succ_msg = "Synchronize wp products successfully";
                var error_msg = "Synchronize wp products failed";
                if(res.status == 1){
                    console.log(res);
                    $.pjax.reload('#pjax-container');
                    toastr.success(succ_msg);
                }else{
                    console.log(res);

                    toastr.error(error_msg);
                }
            }
        });
    }); 
</script>