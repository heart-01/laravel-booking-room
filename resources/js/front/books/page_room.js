// Page_room
$('.selcRoom').click(function(){
    var classrooms_id = $(this).attr('data-classroomsID');    
    var name = $(this).attr('data-name');   

    $.ajax({
        url: config.routes.page_infoDetail,
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: { classrooms_id: classrooms_id },
        beforeSend: function(){
            $("#page_room").fadeOut(10);
            $("#loading").removeAttr('style');    
            $(".selcRoom").css('cursor', 'not-allowed');
            $(".selcRoom").prop('disabled', true);
        },
        success:function(result){
            //afterSend
            $("#page_room").removeAttr('style'); 
            $("#loading").css('display', 'none');
            $(".selcRoom").css('cursor','default');
            $(".selcRoom").removeAttr('disabled');  

            if(result != ''){
                // Next Step
                current_fs = $('#page_room');
                next_fs = $('#page_info');

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
                        setProgressBar(3);
                        // End Next Step

                        // Insert data page_info
                        var data ="";
                        $("#data_info").empty();
                        data += `<div class="container text-center d-flex justify-content-center"><div class="alert alert-primary w-100" role="alert" style="font-size: 25px;font-weight: 600">${name}</div></div>`
                                    +`<div class="container text-center d-flex justify-content-center">`
                                        +`<p class="imglist" style="max-width: 550px;">`
                                            // Desktop
                                            +`<a data-fancybox-trigger="preview" class="d-none d-sm-none d-md-block d-lg-block">`
                                                +`<img src="${config.image.img_room}/${result["imgPre"]["0"]["image"]}" width="500" height="300" class="mb-3 border border-secondary" />`
                                            +`</a>`
                                            // Mobile
                                            +`<a data-fancybox-trigger="preview" class="d-block d-xl-none d-lg-none d-md-none">`
                                                +`<img src="${config.image.img_room}/${result["imgPre"]["0"]["image"]}" width="285" height="200" class="mb-3 border border-secondary" />`
                                            +`</a>`
                                            $.each(result["img"]["0"],function(index,value){
                                                data += `<a href="${config.image.img_room}/${value.image}" data-fancybox="preview" data-width="1500" data-height="1000">`
                                                            +`<img src="${config.image.img_room}/${value.image}" width="120" height="80" class="mb-2 mr-2 border border-secondary" />`
                                                        +`</a>`
                                            });
                                        data +=`</p>`
                                    +`</div>`
                        data += `<div class="container text-center d-flex justify-content-center">`
                                    +`<div class="alert alert-success col-lg-5 col-md-12 col-sm-12" role="alert" style="font-size: 25px;font-weight: 600"> สิ่งอำนวยความสะดวก </div>`
                                +`</div>` 
                                +`<div class="container text-center d-flex justify-content-center">`
                                    +`<table class="table table-sm">`
                                        +`<thead>`
                                            +`<tr class="d-flex justify-content-center">`
                                                +`<th class="col-lg-1 col-md-1 col-sm-1">#</th>`
                                                +`<th class="col-lg-5 col-md-12 col-sm-12">รายการ</th>`
                                            +`</tr>`
                                        +`</thead>`
                                        +`<tbody>`
                                            if(result["sup"]["0"].length==0){
                                            data +=`<tr class="d-flex justify-content-center">`
                                                +`<th class="col-lg-1 col-md-1 col-sm-1">-</th>`
                                                +`<td class="col-lg-5 col-md-12 col-sm-12">-</td>`
                                            +`</tr>`
                                            }
                                            $.each(result["sup"]["0"],function(index,value){
                                            data +=`<tr class="d-flex justify-content-center">`
                                                +`<th class="col-lg-1 col-md-1 col-sm-1">${index+1}</th>`
                                                +`<td class="col-lg-5 col-md-12 col-sm-12">${value.classrooms_support}</td>`
                                            +`</tr>`
                                            });
                                        data +=`</tbody>`
                                    +`</table>`
                                +`</div>`
                            data += `<div class="container text-center d-flex justify-content-center mt-5">`
                                    +`<div class="alert alert-success col-lg-5 col-md-12 col-sm-12" role="alert" style="font-size: 25px;font-weight: 600"> ซอฟแวร์ที่ใช้งานได้ </div>`
                                +`</div>` 
                                +`<div class="container text-center d-flex justify-content-center">`
                                    +`<table class="table table-sm">`
                                        +`<thead>`
                                            +`<tr class="d-flex justify-content-center">`
                                                +`<th class="col-lg-1 col-md-1 col-sm-1">#</th>`
                                                +`<th class="col-lg-5 col-md-12 col-sm-12">รายการ</th>`
                                            +`</tr>`
                                        +`</thead>`
                                        +`<tbody>`
                                            if(result["sof"]["0"].length==0){
                                            data +=`<tr class="d-flex justify-content-center">`
                                                +`<th class="col-lg-1 col-md-1 col-sm-1">-</th>`
                                                +`<td class="col-lg-5 col-md-12 col-sm-12">-</td>`
                                            +`</tr>`
                                            }
                                            $.each(result["sof"]["0"],function(index,value){
                                            data +=`<tr class="d-flex justify-content-center">`
                                                +`<th class="col-lg-1 col-md-1 col-sm-1">${index+1}</th>`
                                                +`<td class="col-lg-5 col-md-12 col-sm-12">${value.softwares}</td>`
                                            +`</tr>`
                                            });
                                        data +=`</tbody>`
                                    +`</table>`
                                +`</div>`

                        $("#data_info").append(data);
                        $("#next-info").attr('data-classroomsID', result["Encrypt_classID"]);
                        $("#next-info").attr('data-name', name);
                        $.getScript(config.js.page_info);
                    }
                });                
            }
        }
    });

    return false;
});