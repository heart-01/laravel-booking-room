//classrooms_edit
$(".showEdit").click(function(){
    var classrooms_id = $(this).attr('data-classrooms_id');
    var classrooms = $(this).attr('data-classrooms');
    var numbers = $(this).attr('data-numbers');
    var seats = $(this).attr('data-seats');
    var prohibitDS = $(this).attr('data-prohibitDS');
    var prohibitTS = $(this).attr('data-prohibitTS');
    var prohibitDE = $(this).attr('data-prohibitDE');
    var prohibitTE = $(this).attr('data-prohibitTE');

    $('#showEdit').modal('show'); 
    $("#classrooms_id-edit").val(classrooms_id);
    $("#classrooms-edit").val(classrooms);
    $("#numbers-edit").val(numbers);
    $("#seats-edit").val(seats);
    (prohibitDS != 'NULL') ? $("#prohibitDS-edit").val(prohibitDS) : $("#prohibitDS-edit").val(0) ;
    (prohibitTS != 'NULL') ? $("#prohibitTS-edit").selectpicker('val', prohibitTS) : $("#prohibitTS-edit").selectpicker('val', 0) ;
    (prohibitDE != 'NULL') ? $("#prohibitDE-edit").val(prohibitDE) : $("#prohibitDE-edit").val(0) ;
    (prohibitTE != 'NULL') ? $("#prohibitTE-edit").selectpicker('val', prohibitTE) : $("#prohibitTE-edit").selectpicker('val', 0) ;
    
    return false;
});

//classrooms_status
$(".classrooms_status").click(function(){
    var classrooms_id = $(this).attr('data-id');
    var status = $(this).attr('data-status');
    
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
                    url: config.routes.classrooms_status,
                    type: 'POST',
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: { classrooms_id: classrooms_id, status: status },
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
                        window.location.href = config.routes.classrooms;
                    });                    
                }
            });
        }
    });

    return false;
});

//classrooms_delete
$(".classrooms_delete").click(function(){
    var classrooms_id = $(this).attr('data-id');
    var classrooms = $(this).attr('data-classrooms');
    var numbers = $(this).attr('data-numbers');
    
    Swal.fire({
        title: "<span class='kanin'>ต้องการลบข้อมูลห้อง <span style='color:#d33'>\n\""+classrooms+"&nbsp;"+numbers+"\"</span> ใช่หรือไม่ ??</span>",
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
                    url: config.routes.classrooms_del,
                    type: 'POST',
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: { classrooms_id: classrooms_id, numbers: numbers },
                    success:function(data){
                        result = data;
                    }
                })
            ).then(function() {
                if(result=="del"){
                    Swal.fire({
                        title: "<span class='kanin'>ลบข้อมูลห้อง \""+classrooms+"&nbsp;"+numbers+"\" เรียบร้อย..</span>",
                        text: "",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 1500,
                    }).then(()=> {
                        window.location.href = config.routes.classrooms;
                    });                    
                }
            });
        }
    });

    return false;
});