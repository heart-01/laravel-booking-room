//semesters_edit
$(".showEdit").click(function(){
    var semesters_id = $(this).attr('data-semesters_id');
    var semesters = $(this).attr('data-semesters');
    var semesters_start = $(this).attr('data-semesters_start');
    var semesters_end = $(this).attr('data-semesters_end');

    var result  = semesters.split('/');
    var year = result[0];
    var term = result[1];

    $('#showEdit').modal('show'); 
    $("#semesters_id-edit").val(semesters_id);
    $("#term-edit").val(term);
    $("#year-edit").val(year);
    $("#semesters_start_edit").val(semesters_start);
    $("#semesters_end_edit").val(semesters_end);

    return false;
});

//semesters_status
$(".semesters_status").click(function(){
    var semesters_id = $(this).attr('data-id');
    var semesters_status = $(this).attr('data-status');
    
    Swal.fire({
        title: "<span class='kanin'>ต้องการเปลี่ยนสถานะใช่หรือไม่ ??</span>",
        text: "", 
        icon: "warning",
        width: 600,
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
                    url: config.routes.semesters_status,
                    type: 'POST',
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: { semesters_id: semesters_id, semesters_status: semesters_status },
                    success:function(data){
                        result = data;
                    }
                })
            ).then(function() {
                if(result=="change"){
                    Swal.fire({
                        title: "<span class='kanin'>เปลี่ยนสถานะเรียบร้อย..</span>",
                        text: "",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 1500,
                    }).then(()=> {
                        window.location.href = config.routes.semesters;
                    });                    
                }
            });
        }
    });

    return false;
});

//semesters_delete
$(".semesters_delete").click(function(){
    var semesters_id = $(this).attr('data-id');
    var semesters = $(this).attr('data-semesters');
    
    Swal.fire({
        title: "<span class='kanin'>ต้องการลบข้อมูลภาคการศึกษา <span style='color:#d33'>\n\""+semesters+"\"</span> ใช่หรือไม่ ??</span>",
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
                    url: config.routes.semesters_del,
                    type: 'POST',
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: { semesters_id : semesters_id },
                    success:function(data){
                        result = data;
                    }
                })
            ).then(function() {
                if(result=="del"){
                    Swal.fire({
                        title: "<span class='kanin'>ลบข้อมูลภาคการศึกษา \""+semesters+"\" เรียบร้อย..</span>",
                        text: "",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 1500,
                    }).then(()=> {
                        window.location.href = config.routes.semesters;
                    });                    
                }
            });
        }
    });

    return false;
});