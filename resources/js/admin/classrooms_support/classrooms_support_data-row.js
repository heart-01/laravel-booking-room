//classrooms_support_edit
$(".showEdit").click(function(){
    var classrooms_support_id = $(this).attr('data-classrooms_support_id');
    var classrooms_support = $(this).attr('data-classrooms_support');

    $('#showEdit').modal('show'); 
    $("#classrooms_support_id-edit").val(classrooms_support_id);
    $("#classrooms_support-edit").val(classrooms_support);

    return false;
});

//classrooms_support_delete
$(".classrooms_support_delete").click(function(){
    var classrooms_support_id = $(this).attr('data-id');
    var classrooms_support = $(this).attr('data-classrooms_support');
    
    Swal.fire({
        title: "<span class='kanin'>ต้องการลบข้อมูล <span style='color:#d33'>\n\""+classrooms_support+"\"</span> ใช่หรือไม่ ??</span>",
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
                    url: config.routes.classrooms_support_del,
                    type: 'POST',
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: { classrooms_support_id : classrooms_support_id },
                    success:function(data){
                        result = data;
                    }
                })
            ).then(function() {
                if(result=="del"){
                    Swal.fire({
                        title: "<span class='kanin'>ลบข้อมูล \""+classrooms_support+"\" เรียบร้อย..</span>",
                        text: "",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 1500,
                    }).then(()=> {
                        window.location.href = config.routes.classrooms_support;
                    });                    
                }
            });
        }
    });

    return false;
});