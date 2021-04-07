$("#frmBookingUpdate").submit(function(e){
    e.preventDefault();
    Swal.fire({
        title: "<span class='kanin'>ยืนยันแก้ไขข้อมูล</span>",
        text: "", 
        icon: "question",
        iconColor: '#28a745',
        width: 700,
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        confirmButtonText: 'ตกลง',
        cancelButtonColor: '#d33',
        cancelButtonText: 'ยกเลิก'
    })
    .then((result) => {
        if (result.isConfirmed) {
            var formData = new FormData(this);
            $.ajax({
                type: "POST",
                url: config.routes.bookUpdate,
                data: formData,
                cache: false, 
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function(){
                    $("#page_BookingUpdate").fadeOut(10);
                    $("#loading").removeAttr('style');  
                    $("#back-history").css('cursor', 'not-allowed');
                    $("#back-history").prop('disabled', true);
                    $("#btnfrmBookingUpdate").css('cursor', 'not-allowed');
                    $("#btnfrmBookingUpdate").prop('disabled', true);
                },
                success: function(result) {
                    if(result=='Success'){
                        //afterSend
                        $("#page_BookingUpdate").removeAttr('style'); 
                        $("#loading").css('display', 'none');
                        $("#btnfrmBookingUpdate").css('cursor','default');
                        $("#btnfrmBookingUpdate").removeAttr('disabled'); 
                        $("#back-history").css('cursor','default');
                        $("#back-history").removeAttr('disabled'); 

                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: "<span class='kanin'>แก้ไขข้อมูลเรียบร้อย !</span>",
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }else{
                        Swal.fire("ไม่สามารถแก้ไขข้อมูลได้<br>โปรดติดต่อผู้ดูแลระบบ !", "", "error").then(() => { window.location.href = config.routes.history; });
                    }             
                } //close success
            });
        }
    });
});