$("#frmQuestionPrototype").submit(function(e){
    e.preventDefault();
    Swal.fire({
        title: "<span class='kanin'>ยืนยันการคัดลอกแบบฟอร์ม</span>",
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
                url: config.routes.questionPrototype_setQuestion,
                data: formData,
                cache: false, 
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function(){
                    $("#page_questionPrototype").fadeOut(10);
                    $("#loading").removeAttr('style');    
                    $("#btnQuestionPrototype").css('cursor', 'not-allowed');
                    $("#btnQuestionPrototype").prop('disabled', true);
                },
                success: function(result) { console.log(result);
                    //afterSend
                    $("#page_questionPrototype").removeAttr('style'); 
                    $("#loading").css('display', 'none');
                    $("#btnQuestionPrototype").css('cursor','default');
                    $("#btnQuestionPrototype").removeAttr('disabled'); 
                    
                    if(result == 'success'){
                        Swal.fire({
                            title: "<span class='kanin'>คัดลอกแบบฟอร์ม เรียบร้อย..</span>",
                            text: "",
                            icon: "success",
                            showConfirmButton: false,
                            timer: 1500,
                        }).then(()=> {
                            window.location.href = config.routes.questionPrototype;
                        }); 
                    }else{
                        Swal.fire({
                            title: "<span class='kanin'>ไม่สามารถคัดลอกแบบฟอร์มได้<br>โปรดติดต่อผู้ดูแลระบบ..</span>",
                            text: "", 
                            icon: "error",
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
                                window.location.href = config.routes.questionPrototype;
                            }
                        });
                    }       
                } //close success
            });
        }
    });
});

//showEdit
$(".showEdit").click(function(){
    var question_prototype_id  = $(this).attr('data-id');
    var article = $(this).attr('data-article');
    var question = $(this).attr('data-question');

    $('#showEdit').modal('show'); 
    $("#question_prototype_id-edit").val(question_prototype_id);
    $("#article-edit").val(article);
    $("#question-edit").val(question);

    return false;
});

//showDel
$(".showDel").click(function(){
    var question_prototype_id  = $(this).attr('data-id');
    var article = $(this).attr('data-article');
    
    Swal.fire({
        title: "<span class='kanin'>ต้องการลบแบบสอบถาม<br>ข้อ <span style='color:#d33'>\""+article+"\"</span> ใช่หรือไม่ ??</span>",
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
                    url: config.routes.questionPrototype_del,
                    type: 'POST',
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: { question_prototype_id : question_prototype_id },
                    success:function(data){
                        result = data;
                    }
                })
            ).then(function() {
                if(result=="del"){
                    Swal.fire({
                        title: "<span class='kanin'>ลบแบบสอบถามข้อ \""+article+"\" เรียบร้อย..</span>",
                        text: "",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 1500,
                    }).then(()=> {
                        window.location.href = config.routes.questionPrototype;
                    });                    
                }
            });
        }
    });

    return false;
});