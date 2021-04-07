// btn desktop click
$('.btnCancel').click(function(){
    var BookingsId = $(this).attr('data-BookingsId');
    
    Swal.fire({
        title: "<span class='kanin'>ต้องการยกเลิกการจองห้องเรียนใช่หรือไม่ ??</span>",
        text: "", 
        icon: "warning",
        iconColor: '#d33',
        width: 700,
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        confirmButtonText: 'ตกลง',
        cancelButtonColor: '#d33',
        cancelButtonText: 'ยกเลิก'
    })
    .then((result) => {
        if (result.isConfirmed) {
            $.when(
                $.ajax({
                    url: config.routes.book_cancel,
                    type: 'POST',
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: { BookingsId : BookingsId },
                    beforeSend: function(){
                        $("#divBookings").fadeOut(10);
                        $("#loading").removeAttr('style');
                    },
                    success:function(data){
                        result = data;
                    }
                })
            ).then(function() {
                if(result=="success"){
                    //afterSend
                    $("#divBookings").removeAttr('style'); 
                    $("#loading").css('display', 'none');

                    Swal.fire({
                        title: "<span class='kanin'>ยกเลิกการจองห้องเรียน เรียบร้อย..</span>",
                        text: "",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 1500,
                    }).then(()=> {
                        window.location.href = config.routes.history;
                    });                    
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: "<span class='kanin'>ยกเลิกการจองห้องเรียน ไม่สำเร็จ..</span>",
                        text: 'โปรดติดต่อผู้ดูแลระบบ',
                    }).then(()=> {
                        window.location.href = config.routes.history;
                    });
                }
            });
        }
    });

    return false;
});