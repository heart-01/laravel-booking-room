//modal Add
var classrooms_support = document.getElementById('classrooms_support');
classrooms_support.oninvalid = function(event) {
    event.target.setCustomValidity('กรุณากรอกชื่อสิ่งอำนวยความสะดวก ที่เป็นภาษาไทยหรืออักฤษเท่านั้น');
}
classrooms_support.oninput = function(event) {
    event.target.setCustomValidity('');
}

//modal Edit
var classrooms_support_edit = document.getElementById('classrooms_support-edit');
classrooms_support_edit.oninvalid = function(event) {
    event.target.setCustomValidity('กรุณากรอกสิ่งอำนวยความสะดวก ที่เป็นภาษาไทยหรืออักฤษเท่านั้น');
}
classrooms_support_edit.oninput = function(event) {
    event.target.setCustomValidity('');
}