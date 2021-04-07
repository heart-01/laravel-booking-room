//modal Add
var classrooms = document.getElementById('classrooms');
classrooms.oninvalid = function(event) {
    event.target.setCustomValidity('กรุณากรอกชื่อห้องเรียน ที่เป็นภาษาไทยหรืออักฤษเท่านั้น');
}
classrooms.oninput = function(event) {
    event.target.setCustomValidity('');
}
var numbers = document.getElementById('numbers');
numbers.oninvalid = function(event) {
    event.target.setCustomValidity('กรุณากรอกหมายเลขห้อง ที่เป็นตัวเลขเท่านั้น');
}
numbers.oninput = function(event) {
    event.target.setCustomValidity('');
}
var seats = document.getElementById('seats');
seats.oninvalid = function(event) {
    event.target.setCustomValidity('กรุณากรอกจำนวนที่นั่ง เป็นตัวเลขเท่านั้น');
}
seats.oninput = function(event) {
    event.target.setCustomValidity('');
}

//modal Edit
var classrooms_edit = document.getElementById('classrooms-edit');
classrooms_edit.oninvalid = function(event) {
    event.target.setCustomValidity('กรุณากรอกชื่อห้องเรียน ที่เป็นภาษาไทยหรืออักฤษเท่านั้น');
}
classrooms_edit.oninput = function(event) {
    event.target.setCustomValidity('');
}
var numbers_edit = document.getElementById('numbers-edit');
numbers_edit.oninvalid = function(event) {
    event.target.setCustomValidity('กรุณากรอกหมายเลขห้อง ที่เป็นตัวเลขเท่านั้น');
}
numbers_edit.oninput = function(event) {
    event.target.setCustomValidity('');
}
var seats_edit = document.getElementById('seats-edit');
seats_edit.oninvalid = function(event) {
    event.target.setCustomValidity('กรุณากรอกจำนวนที่นั่ง เป็นตัวเลขเท่านั้น');
}
seats_edit.oninput = function(event) {
    event.target.setCustomValidity('');
}