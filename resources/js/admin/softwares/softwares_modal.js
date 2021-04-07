//modal Add
var softwares = document.getElementById('softwares');
softwares.oninvalid = function(event) {
    event.target.setCustomValidity('กรุณากรอกชื่อซอฟแวร์ ที่เป็นภาษาไทยหรืออักฤษเท่านั้น');
}
softwares.oninput = function(event) {
    event.target.setCustomValidity('');
}

//modal Edit
var softwares_edit = document.getElementById('softwares-edit');
softwares_edit.oninvalid = function(event) {
    event.target.setCustomValidity('กรุณากรอกชื่อซอฟแวร์ ที่เป็นภาษาไทยหรืออักฤษเท่านั้น');
}
softwares_edit.oninput = function(event) {
    event.target.setCustomValidity('');
}