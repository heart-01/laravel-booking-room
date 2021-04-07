//modal Add
var term = document.getElementById('term');
term.oninvalid = function(event) {
    event.target.setCustomValidity('กรุณาเลือกเทอมการศึกษา');
}
term.oninput = function(event) {
    event.target.setCustomValidity('');
}
var year = document.getElementById('year');
year.oninvalid = function(event) {
    event.target.setCustomValidity('กรุณาเลือกปีการศึกษา');
}
year.oninput = function(event) {
    event.target.setCustomValidity('');
}

//modal Edit
var term_edit = document.getElementById('term-edit');
term_edit.oninvalid = function(event) {
    event.target.setCustomValidity('กรุณาเลือกเทอมการศึกษา');
}
term_edit.oninput = function(event) {
    event.target.setCustomValidity('');
}
var year_edit = document.getElementById('year-edit');
year_edit.oninvalid = function(event) {
    event.target.setCustomValidity('กรุณาเลือกปีการศึกษา');
}
year_edit.oninput = function(event) {
    event.target.setCustomValidity('');
}