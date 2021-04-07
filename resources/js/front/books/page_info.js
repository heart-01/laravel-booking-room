// btn next Page_detail
$("#next-info").click(function(){
    var name = $(this).attr('data-name');
    var classrooms_id = $(this).attr('data-classroomsID');   
    var semesters_id = $("#semesters_id").val();     
    var days = $("#Droom").val();
    var time_start = $("#TroomS").val();
    var time_end = $("#TroomE").val();
    
    var seats = $("#seats").val();
    
    // Next Step
    current_fs = $('#page_info');
    next_fs = $('#page_detail');
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
            setProgressBar(4);
            // End Next Step
            $("#next-detail").attr('data-classroomsID', classrooms_id);
            $("#next-detail").attr('data-name', name);
            $("#classID").val(classrooms_id);
            $("#semesters_ids").val(semesters_id);
            $("#days").val(days);
            $("#time_start").val(time_start);
            $("#time_end").val(time_end);
            $("#seat").val(seats);
            $("#classroomsName").val(name);
            $.getScript(config.js.page_detail);
        }
    }); 

    return false;
});

// btn back Page_room
$("#back-info").click(function(){
    current_fs = $('#page_info');
    previous_fs = $('#page_room');

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
            setProgressBar(2);
        }
    });
});

// Validity Form
document.getElementById('fname').oninvalid = function(event) {
    event.target.setCustomValidity('กรุณากรอกชื่อเป็นภาษาไทย หรือ ภาษาอักฤษ');
}
document.getElementById('fname').oninput = function(event) {
    event.target.setCustomValidity('');
}

document.getElementById('lname').oninvalid = function(event) {
    event.target.setCustomValidity('กรุณากรอกนามสกุลเป็นภาษาไทย หรือ ภาษาอักฤษ');
}
document.getElementById('lname').oninput = function(event) {
    event.target.setCustomValidity('');
}

document.getElementById('email').oninvalid = function(event) {
    event.target.setCustomValidity('รูปแบบอีเมลไม่ถูกต้อง');
}
document.getElementById('email').oninput = function(event) {
    event.target.setCustomValidity('');
}

document.getElementById('tel').oninvalid = function(event) {
    event.target.setCustomValidity('กรุณากรอกเบอร์ภายในเป็นตัวเลข');
}
document.getElementById('tel').oninput = function(event) {
    event.target.setCustomValidity('');
}

document.getElementById('subject').oninvalid = function(event) {
    event.target.setCustomValidity('กรุณากรอกชื่อวิชาเป็นภาษาไทย หรือ ภาษาอักฤษ');
}
document.getElementById('subject').oninput = function(event) {
    event.target.setCustomValidity('');
}

document.getElementById('course_code').oninvalid = function(event) {
    event.target.setCustomValidity('รูปแบบรหัสวิชาไม่ถูกต้อง');
}
document.getElementById('course_code').oninput = function(event) {
    event.target.setCustomValidity('');
}