//softwares_edit
$(".showEdit").click(function(){
    var softwares_id = $(this).attr('data-softwares_id');
    var softwares = $(this).attr('data-softwares');

    $('#showEdit').modal('show'); 
    $("#softwares_id-edit").val(softwares_id);
    $("#softwares-edit").val(softwares);

    return false;
});

//softwares_delete
$(".softwares_delete").click(function(){
    var softwares_id = $(this).attr('data-id');
    var softwares = $(this).attr('data-softwares');
    
    Swal.fire({
        title: "<span class='kanin'>ต้องการลบข้อมูลซอฟแวร์ <span style='color:#d33'>\n\""+softwares+"\"</span> ใช่หรือไม่ ??</span>",
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
                    url: config.routes.softwares_del,
                    type: 'POST',
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: { softwares_id : softwares_id },
                    success:function(data){
                        result = data;
                    }
                })
            ).then(function() {
                if(result=="del"){
                    Swal.fire({
                        title: "<span class='kanin'>ลบข้อมูลซอฟแวร์ \""+softwares+"\" เรียบร้อย..</span>",
                        text: "",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 1500,
                    }).then(()=> {
                        window.location.href = config.routes.softwares;
                    });                    
                }
            });
        }
    });

    return false;
});