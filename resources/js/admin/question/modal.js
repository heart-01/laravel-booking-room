//showEdit
$(".showEdit").click(function(){
    var question_id  = $(this).attr('data-id');
    var article = $(this).attr('data-article');
    var question = $(this).attr('data-question');

    $('#showEdit').modal('show'); 
    $("#question_id-edit").val(question_id);
    $("#article-edit").val(article);
    $("#question-edit").val(question);

    return false;
});

//showDel
$(".showDel").click(function(){
    var question_id  = $(this).attr('data-id');
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
                    url: config.routes.question_del,
                    type: 'POST',
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: { question_id : question_id },
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
                        window.location.href = config.routes.question;
                    });                    
                }
            });
        }
    });

    return false;
});