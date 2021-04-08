var arr_day = { '1':'จันทร์', '2':'อังคาร', '3':'พุธ', '4':'พฤหัสบดี', '5':'ศุกร์', '6':'เสาร์' }
// btn next Page_confirm
$("#frmBooking").submit(function(e){
    e.preventDefault();
    Swal.fire({
        title: "<span class='kanin mb-3 text-success'>รายละเอียดการจองห้องเรียน</span>",
        text: "", 
        // icon: "question",
        // iconColor: '#28a745',
        html:   `<div class="col-12 text-center mb-3 text-info" style="font-size: 25px;">${$('#classroomsName').val()}</div>` +
                `<div class="text-left">` +
                    `<dl class="row text-dark">` +
                        `<dt class="col-sm-3">ชื่อ :</dt> <dd class="col-sm-9"> ${$('#fname').val()} </dd>` +
                        `<dt class="col-sm-3">นามสกุล :</dt> <dd class="col-sm-9"> ${$('#lname').val()} </dd>` +
                        `<dt class="col-sm-3">E-mail :</dt> <dd class="col-sm-9"> ${$('#email').val()} </dd>` +
                        `<dt class="col-sm-3">เบอร์ภายใน :</dt> <dd class="col-sm-9"> ${$('#tel').val()} </dd>` +
                        `<dt class="col-sm-3">คณะ :</dt> <dd class="col-sm-9"> ${$('#faculty').val()} </dd>` +
                        `<dt class="col-sm-3">ภาควิชา :</dt> <dd class="col-sm-9"> ${$('#department').val()} </dd>` +
                        `<dt class="col-sm-3">วิชา :</dt> <dd class="col-sm-9"> ${$('#subject').val()} </dd>` +
                        `<dt class="col-sm-3">รหัสวิชา :</dt> <dd class="col-sm-9"> ${$('#course_code').val()} </dd>` +
                        `<dt class="col-sm-3">ตอนเรียน :</dt> <dd class="col-sm-9"> ${$('#part').val()} </dd>` +
                        `<dt class="col-sm-3">จำนวนนักเรียน :</dt> <dd class="col-sm-9"> ${$('#seat').val()} </dd>` +
                        `<dt class="col-sm-3">ชื่อห้อง :</dt> <dd class="col-sm-9"> ${$('#classroomsName').val()} </dd>` +
                        `<dt class="col-sm-3">วันจอง :</dt> <dd class="col-sm-9"> ${arr_day[$('#days').val()]} </dd>` +
                        `<dt class="col-sm-3">เวลาจอง :</dt> <dd class="col-sm-9"> ${$('#time_start').val()} - ${$('#time_end').val()} </dd>` +
                    `</dl>` +
                `</div>`,
        width: 700,
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        confirmButtonText: '<i class="fas fa-calendar-check mr-1"></i> ยืนยัน',
        cancelButtonColor: '#ffc107',
        cancelButtonText: '<i class="fas fa-edit"></i> แก้ไข'
    })
    .then((result) => {
        if (result.isConfirmed) {  
            var name = $("#next-detail").attr('data-name');  
            var formData = new FormData(this);
            $.ajax({
                type: "POST",
                url: config.routes.page_confirmDetail,
                data: formData,
                cache: false, 
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function(){
                    $("#page_detail").fadeOut(10);
                    $("#loading").removeAttr('style');    
                    $("#next-detail").css('cursor', 'not-allowed');
                    $("#next-detail").prop('disabled', true);
                },
                success: function(result) {
                    //afterSend
                    $("#page_detail").removeAttr('style'); 
                    $("#loading").css('display', 'none');
                    $("#next-detail").css('cursor','default');
                    $("#next-detail").removeAttr('disabled'); 
                    
                    // Next Step
                    current_fs = $('#page_detail');
                    next_fs = $('#page_confirm');
                    //Add Class Active
                    $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
                    //show the next fieldset
                    next_fs.show();
                    //hide the current fieldset with style
                    current_fs.animate({opacity: 0}, {
                        step: function(now) {
                            // for making fielset appear animation
                            opacity = 1 - now;

                            current_fs.css({
                                'display': 'none',
                                'position': 'relative'
                            });
                            next_fs.css({'opacity': opacity});
                        },
                        duration: 500,
                        complete: function() {
                            setProgressBar(5);
                            // End Next Step
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: "<span class='kanin'>จองห้องเรียนสำเร็จ !</span>",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            // Insert data page_confirm
                            $("#con_name").html(name);
                            $("#con_name").attr('href', config.routes.page_roomDetail+'/'+name+'/'+result["data"]["classID"]);
                            $("#con_fname").val(result["data"]["fname"]);
                            $("#con_lname").val(result["data"]["lname"]);
                            $("#con_email").val(result["data"]["email"]);
                            $("#con_tel").val(result["data"]["tel"]);
                            $("#con_faculty").val(result["data"]["faculty"]);
                            $("#con_department").val(result["data"]["department"]);
                            $("#con_subject").val(result["data"]["subject"]);
                            $("#con_code").val(result["data"]["course_code"]);
                            $("#con_part").val(result["data"]["part"]);
                            $("#con_seats").val(result["data"]["seat"]);
                            $('#con_Sof').selectpicker('val', result["data"]["selSoftwares"]);
                            $("#con_otherSof").val(result["data"]["otherSofware"]);
                            $("#con_Rname").val(name);
                            $("#con_DTs").val(arr_day[result["data"]["days"]]);
                            // $("#con_DTe").val(moment(result["data"]["time_start"]).format('เวลา HH:mm') +' - '+ moment(result["data"]["time_end"]).format('เวลา HH:mm'));
                            $("#con_DTe").val(result["data"]["time_start"]+' - '+result["data"]["time_end"]);
                            $("#BookingsLastId").val(result["bookingsId"]);
                            $("#BookingsLastIds").val(result["bookingsId"]);
                        }
                    });                     
                } //close success
            });
        }
    });
});

// btn back Page_info
$("#back-detail").click(function(){
    current_fs = $('#page_detail');
    previous_fs = $('#page_info');

    //Remove class active
    $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

    //show the previous fieldset
    previous_fs.show();

    //hide the current fieldset with style
    current_fs.animate({opacity: 0}, {
        step: function(now) {
            // for making fielset appear animation
            opacity = 1 - now;

            current_fs.css({
                'display': 'none',
                'position': 'relative'
            });
            previous_fs.css({'opacity': opacity});
        },
        duration: 10,
        complete: function() {
            setProgressBar(3);
        }
    });
});

// btn desktop click
$('#btnCancel').click(function(){
    var name = $("#con_Rname").val();
    var BookingsId = $("#BookingsLastId").val();
    
    Swal.fire({
        title: "<span class='kanin'>ต้องการยกเลิกการจอง <span style='color:#d33'>\n\""+name+"\"</span> ใช่หรือไม่ ??</span>",
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
                    success:function(data){
                        result = data;
                    }
                })
            ).then(function() {
                if(result=="success"){
                    Swal.fire({
                        title: "<span class='kanin'>ยกเลิกการจอง \""+name+"\" เรียบร้อย..</span>",
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
                        title: "<span class='kanin'>ยกเลิกการจอง \""+name+"\" ไม่สำเร็จ..</span>",
                        text: 'โปรดติดต่อผู้ดูแลระบบ',
                    }).then(()=> {
                        window.location.href = config.routes.book;
                    });
                }
            });
        }
    });

    return false;
});

// btn mobile click
$('#btnPDFsm').click(function(){
    $('#btnPDF').trigger('click');     
    return false;         
});
$('#btnEditsm').click(function(){
    $('#btnEdit').trigger('click');  
    return false;            
});
$('#btnCancelsm').click(function(){
    $('#btnCancel').trigger('click');    
    return false;          
});