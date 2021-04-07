/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 5);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/front/books/index.js":
/*!*******************************************!*\
  !*** ./resources/js/front/books/index.js ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// Page_data Calendar

/*$('#DTusing').daterangepicker({
    "drops": 'up',
    "opens": "right",
    "showDropdowns": true,
    "timePicker": true,
    "timePicker24Hour": true,
    "timePickerIncrement": 60,
    "autoUpdateInput": false,
    locale: {
        "separator": " ถึง ",
        "applyLabel": "Apply",
        "cancelLabel": "Clear",
        "format": 'DD/MM/YYYY HH:mm',
        "daysOfWeek": [
            "อา",
            "จ",
            "อ",
            "พ",
            "พฤ",
            "ศ",
            "ส"
        ],
        "monthNames": [
            "มกราคม",
            "กุมภาพันธ์",
            "มีนาคม",
            "เมษายน",
            "พฤษภาคม",
            "มิถุนายน",
            "กรกฎาคม",
            "สิงหาคม",
            "กันยายน",
            "ตุลาคม",
            "พฤศจิกายน",
            "ธันวาคม"
        ],
    },
    isInvalidDate: function(date) {
        //return (date.day() == 0 || date.day() == 6); //ปิดวันเสาร์อาทิตย์
        if (date.format('YYYY-MM-DD') == '2016-08-01') {
            return true; 
        } else {
            return false; 
        } //ปิดใช้งานวันที่ระบุ
    },
    "minDate":  config.data.minDate,
    "maxDate":  config.data.maxDate,
});
$('#DTusing').on('apply.daterangepicker', function(ev, picker) {
    if(picker.startDate.format('HH') >= '08' && picker.startDate.format('HH') <= '21'  && picker.endDate.format('HH') >= '08' && picker.endDate.format('HH') <= '21'){
    $('#DTshow').text(picker.startDate.format('DD/MM/YYYY HH:mm') + ' ถึง ' + picker.endDate.format('DD/MM/YYYY HH:mm'));
    $('#DTroomS').val(picker.startDate.format('YYYY-MM-DD HH:mm'));
    $('#DTroomE').val(picker.endDate.format('YYYY-MM-DD HH:mm'));          
    }else{
    Swal.fire("<span class='kanin'>กรุณาเลือกช่วงเวลาการจองระหว่าง 08.00 ถึง 21.00</span>", "", "warning");
    }
});
$('#DTusing').on('cancel.daterangepicker', function(ev, picker) {
    $('#DTshow').text('');
    $('#DTroomS').val('');
    $('#DTroomE').val('');
});*/
// Page_data next Page_room

/*var resAjax = null;
function getData(data1, data2, callback){
    $.ajax({
        url: config.routes.prohibit,
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: { prohibit_Start:data1, prohibit_End:data2, },
        success: function (res) {
            callback(res);
        }
    })
}*/
$("#div-semester").hide();

function clearBorder() {
  $("#div-semester").removeClass('border border-danger');
  $("#dDroom").removeClass('border border-danger');
  $("#dTroomS").removeClass('border border-danger');
  $("#dTroomE").removeClass('border border-danger');
  $("input[name=seats]").removeClass('border border-danger');
  $(".g-recaptcha").removeClass('border border-danger');
}

$("#next-data").click(function () {
  var semester = $("select[name=semester]").val(); // var DTroomS = $("input[name=DTroomS]").val();
  // var DTroomE = $("input[name=DTroomE]").val();

  var Droom = $("select[name=Droom]").val();
  var TroomS = $("select[name=TroomS]").val();
  var TroomE = $("select[name=TroomE]").val();
  var semesters_id = $("#semesters_id").val();
  var seats = $("input[name=seats]").val();
  var reCaptcha = grecaptcha.getResponse();

  if (semester == "") {
    Swal.fire("กรุณาเลือกภาคการศึกษา", "", "warning");
    clearBorder();
    $("#div-semester").addClass('border border-danger');
  } else if (Droom == "") {
    Swal.fire("กรุณาเลือกวันที่จองห้อง", "", "warning");
    clearBorder();
    $("#dDroom").addClass('border border-danger');
  } else if (TroomS == "") {
    Swal.fire("กรุณาเลือกเวลาเริ่มจองห้อง", "", "warning");
    clearBorder();
    $("#dTroomS").addClass('border border-danger');
  } else if (TroomE == "") {
    Swal.fire("กรุณาเลือกเวลาสิ้นสุดจองห้อง", "", "warning");
    clearBorder();
    $("#dTroomE").addClass('border border-danger');
  } else if (seats == "") {
    Swal.fire("กรุณากรอกจำนวนนักศึกษา", "", "warning");
    clearBorder();
    $("input[name=seats]").addClass('border border-danger');
  } else if (reCaptcha == "") {
    Swal.fire("กรุณายืนยันตัวตนด้วย reCAPTCHA ก่อนส่งข้อมูล.", "", "warning");
    clearBorder();
    $(".g-recaptcha").addClass('border border-danger');
  } else {
    clearBorder();
    $.ajax({
      url: config.routes.page_data,
      type: 'POST',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      data: {
        semester: semester,
        Droom: Droom,
        TroomS: TroomS,
        TroomE: TroomE,
        semesters_id: semesters_id,
        seats: seats,
        reCaptcha: reCaptcha
      },
      beforeSend: function beforeSend() {
        $("#page_data").fadeOut(10);
        $("#loading").removeAttr('style');
        $("#next-data").css('cursor', 'not-allowed');
        $("#next-data").prop('disabled', true);
      },
      success: function success(result) {
        //afterSend
        $("#page_data").removeAttr('style');
        $("#loading").css('display', 'none');
        $("#next-data").css('cursor', 'default');
        $("#next-data").removeAttr('disabled');

        if (result == 'ReCaptcha') {
          Swal.fire("การตรวจสอบ ReCaptcha ไม่ถูกต้อง.", "", "warning").then(function () {
            window.location.href = config.routes.book;
          });
          return false;
        } else if (result == 'seats_room') {
          Swal.fire("ขออภัย..<br> จำนวนที่นั่งในห้องเรียนไม่เพียงพอกับจำนวนนักศึกษา", "", "warning").then(function () {
            window.location.href = config.routes.book;
          });
          return false;
        } else if (result == 'Full_booking') {
          Swal.fire("ขออภัย..<br> จำนวนห้องเรียนที่ว่างไม่เพียงพอกับจำนวนนักศึกษา", "", "warning").then(function () {
            window.location.href = config.routes.book;
          });
          return false;
        } else if (result == 'time') {
          Swal.fire("กรอกข้อมูลเวลาจองห้องไม่ถูกต้อง", "", "warning").then(function () {
            window.location.href = config.routes.book;
          });
          return false;
        } else if (result == 'minute') {
          Swal.fire("เวลาในการจองห้องต้องไม่ต่ำกว่า 1 ชั่วโมง", "", "warning").then(function () {
            window.location.href = config.routes.book;
          });
          return false;
        } else {
          // Next Step
          current_fs = $('#next-data').parent();
          next_fs = $('#next-data').parent().next(); //Add Class Active

          $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active"); //show the next fieldset

          next_fs.show(); //hide the current fieldset with style

          current_fs.animate({
            opacity: 0
          }, {
            step: function step(now) {
              // for making fielset appear animation
              opacity = 1 - now;
              current_fs.css({
                'display': 'none',
                'position': 'relative'
              });
              next_fs.css({
                'opacity': opacity
              });
            },
            duration: 500
          });
          setProgressBar(++current); // End Next Step
          // Insert data page_room

          var data = "";
          $("#data_room").empty();
          $.each(result, function (index, value) {
            var prohibit_Start = value.prohibit_Start.split("#");
            var prohibitDS = prohibit_Start[0];
            var prohibitTS = parseFloat(prohibit_Start[1]);
            var prohibit_End = value.prohibit_End.split("#");
            var prohibitDE = prohibit_End[0];
            var prohibitTE = parseFloat(prohibit_End[1]);
            console.log('Droom : ' + Droom);
            console.log('TroomS : ' + TroomS);
            console.log('TroomE : ' + TroomE);
            console.log('prohibit_Start : ' + value.prohibit_Start);
            console.log('prohibit_End : ' + value.prohibit_End);

            if (value.prohibit_Start != 'NULL#NULL' && value.prohibit_End != 'NULL#NULL') {
              console.log('prohibit'); //check date prohibit

              if (Droom >= prohibitDS && Droom <= prohibitDE) {
                console.log('day prohibit'); //check time prohibit
                //prohibitBetween

                var prohibitBetween = new Array();

                if (Number.isInteger(prohibitTS)) {
                  console.log('prohibitT int');
                  var LprohibitTE = Math.round(prohibitTE);
                  console.log('LprohibitTE :' + prohibitTS + ' ' + LprohibitTE);

                  for (var i = prohibitTS; i < LprohibitTE; i++) {
                    var tmp1 = i.toString();
                    var tmp2 = Math.round(i + 0.50).toString();

                    for (var j = 0; j <= 1; j++) {
                      if (j == 0) {
                        prohibitBetween.push(tmp1 + '.3');
                      } else if (j == 1 && i != LprohibitTE) {
                        if (tmp2 < LprohibitTE) {
                          prohibitBetween.push(tmp2);
                        } else if (!Number.isInteger(prohibitTE)) {
                          if (tmp2 == LprohibitTE) {
                            prohibitBetween.push(tmp2);
                          }
                        }
                      }
                    }
                  }
                } else {
                  console.log('prohibitT not int');
                  var LprohibitTE = Math.round(prohibitTE);
                  console.log('LprohibitTE :' + prohibitTS + ' ' + LprohibitTE);

                  for (var i = prohibitTS; i < LprohibitTE; i++) {
                    var tmp = Math.round(i + 0.50).toString();

                    if (tmp < LprohibitTE) {
                      for (var j = 0; j <= 1; j++) {
                        if (j == 0) {
                          prohibitBetween.push(tmp);
                        } else if (j == 1 && i != LprohibitTE) {
                          prohibitBetween.push(tmp + '.3');
                        }
                      }
                    } else if (!Number.isInteger(prohibitTE)) {
                      if (tmp == LprohibitTE) {
                        prohibitBetween.push(tmp);
                      }
                    }
                  }
                } //roomBetween --------------------------------


                var TroomBetween = new Array();

                if (Number.isInteger(TroomS % 1)) {
                  //S int E int 
                  var LTroomS = Math.round(TroomS);
                  var LTroomE = Math.round(TroomE);
                  console.log('S int E int : ' + LTroomS + ' ' + LTroomE);

                  for (var i = LTroomS; i <= LTroomE; i++) {
                    tmp = i.toString();

                    for (var j = 0; j <= 1; j++) {
                      if (j == 0) {
                        TroomBetween.push(tmp);
                      } else if (j == 1 && i != LTroomE) {
                        TroomBetween.push(tmp + '.3');
                      } else if (j == 1 && i == LTroomE && !Number.isInteger(TroomE % 1)) {
                        TroomBetween.push(tmp + '.3');
                      }
                    }
                  }
                } else {
                  //S float E float
                  var LTroomS = Math.round(TroomS);
                  var LTroomE = Math.round(TroomE);
                  console.log('S float E float : ' + LTroomS + ' ' + LTroomE);

                  for (var i = LTroomS; i <= LTroomE; i++) {
                    var tmp1 = i.toString();
                    var tmp2 = Math.round(i + 0.50).toString();

                    for (var j = 0; j <= 1; j++) {
                      if (j == 0) {
                        if (i == LTroomE && Number.isInteger(TroomE % 1)) {} else {
                          TroomBetween.push(tmp1 + '.3');
                        }
                      } else if (j == 1 && i != LTroomE) {
                        TroomBetween.push(tmp2);
                      }
                    }
                  }
                } //------------------------------------------------


                find = prohibitBetween.find(function (val) {
                  return TroomBetween.includes(val);
                });
                console.log(prohibitBetween);
                console.log(TroomBetween);
                console.log(find ? find : 'not'); // ---------------------------------------------------------------------------

                if (!find) {
                  console.log('not day time prohibit'); //ถ้าไม่ใช่วันเวลาที่มีการงดจอง

                  data += "<div class=\"col-12 col-sm-12 col-md-6 col-lg-3 mb-5\">" + "<div class=\"card border\" style=\"width: 100%;\">" + "<a>" + "<img class=\"card-img-top\" src=\"".concat(config.image.img_room, "/").concat(value.image, "\" height=\"190px\" width=\"50px\" alt=\"Card image cap\">") + "</a>" + "<div class=\"card-body text-center\">" + "<p class=\"card-title\" style=\"font-size: 18px;\">".concat(value.classrooms, "</p>") + "<table class=\"card-table table border-bottom-0\">" + "<tr>" + "<td class=\"border-right\" >\u0E2B\u0E21\u0E32\u0E22\u0E40\u0E25\u0E02\u0E2B\u0E49\u0E2D\u0E07</td>" + "<td>".concat(value.numbers, "</td>") + "</tr>" + "<tr>" + "<td class=\"border-right\" >\u0E08\u0E33\u0E19\u0E27\u0E19\u0E17\u0E35\u0E48\u0E19\u0E31\u0E48\u0E07</td>" + "<td>".concat(value.seats, "</td>") + "</tr>";
                  /*if(value.prohibit_Start!='NULL#NULL' && value.prohibit_End!='NULL#NULL'){
                      getData(value.prohibit_Start,value.prohibit_End, function(res) {
                          resAjax = res;
                          data +=`<tr class="text-danger">`
                                  +`<td class="border-right" >งดจอง</td>`
                                  +`<td>${res}</td>`
                              +`</tr>`
                      });
                      console.log(data);
                  }*/

                  data += "<tr>" + "<td colspan=\"2\">" + "<a data-fancybox data-type=\"iframe\" href=\"".concat(config.routes.page_roomDetail, "/").concat(value.classrooms, " ").concat(value.numbers, "/").concat(value.classrooms_id, "\" class=\"fancybox btn btn-success btn-sm\">") + "<i class=\"fas fa-info-circle mr-1\"></i> \u0E23\u0E32\u0E22\u0E25\u0E30\u0E40\u0E2D\u0E35\u0E22\u0E14" + "</a>" + "</td>" + "</tr>" + "<tr>" + "<td colspan=\"2\">" + "<a class=\"btn btn-primary btn-block text-white selcRoom\" data-classroomsID=\"".concat(value.classrooms_id, "\" data-name=\"").concat(value.classrooms, " ").concat(value.numbers, "\">") + "<i class=\"far fa-hand-point-right\"></i> \u0E40\u0E25\u0E37\u0E2D\u0E01\u0E2B\u0E49\u0E2D\u0E07\u0E40\u0E23\u0E35\u0E22\u0E19\u0E19\u0E35\u0E49 <i class=\"far fa-hand-point-left\"></i>" + "</a>" + "</td>" + "</tr>" + "</table>" + "</div>" + "</div>" + "</div>";
                } else if (index == 0 && result.length == 1) {
                  console.log('day time prohibit');
                  Swal.fire("ขออภัย..<br> ไม่มีห้องว่างตรงกับเงื่อนไขที่ท่านค้นหา", "", "warning").then(function () {
                    window.location.href = config.routes.book;
                  });
                }
              } else {
                console.log('not day prohibit'); //ถ้าไม่ใช่วันที่มีการงดจอง

                data += "<div class=\"col-12 col-sm-12 col-md-6 col-lg-3 mb-5\">" + "<div class=\"card border\" style=\"width: 100%;\">" + "<a>" + "<img class=\"card-img-top\" src=\"".concat(config.image.img_room, "/").concat(value.image, "\" height=\"190px\" width=\"50px\" alt=\"Card image cap\">") + "</a>" + "<div class=\"card-body text-center\">" + "<p class=\"card-title\" style=\"font-size: 18px;\">".concat(value.classrooms, "</p>") + "<table class=\"card-table table border-bottom-0\">" + "<tr>" + "<td class=\"border-right\" >\u0E2B\u0E21\u0E32\u0E22\u0E40\u0E25\u0E02\u0E2B\u0E49\u0E2D\u0E07</td>" + "<td>".concat(value.numbers, "</td>") + "</tr>" + "<tr>" + "<td class=\"border-right\" >\u0E08\u0E33\u0E19\u0E27\u0E19\u0E17\u0E35\u0E48\u0E19\u0E31\u0E48\u0E07</td>" + "<td>".concat(value.seats, "</td>") + "</tr>";
                /*if(value.prohibit_Start!='NULL#NULL' && value.prohibit_End!='NULL#NULL'){
                    getData(value.prohibit_Start,value.prohibit_End, function(res) {
                        resAjax = res;
                        data +=`<tr class="text-danger">`
                                +`<td class="border-right" >งดจอง</td>`
                                +`<td>${res}</td>`
                            +`</tr>`
                    });
                    console.log(data);
                }*/

                data += "<tr>" + "<td colspan=\"2\">" + "<a data-fancybox data-type=\"iframe\" href=\"".concat(config.routes.page_roomDetail, "/").concat(value.classrooms, " ").concat(value.numbers, "/").concat(value.classrooms_id, "\" class=\"fancybox btn btn-success btn-sm\">") + "<i class=\"fas fa-info-circle mr-1\"></i> \u0E23\u0E32\u0E22\u0E25\u0E30\u0E40\u0E2D\u0E35\u0E22\u0E14" + "</a>" + "</td>" + "</tr>" + "<tr>" + "<td colspan=\"2\">" + "<a class=\"btn btn-primary btn-block text-white selcRoom\" data-classroomsID=\"".concat(value.classrooms_id, "\" data-name=\"").concat(value.classrooms, " ").concat(value.numbers, "\">") + "<i class=\"far fa-hand-point-right\"></i> \u0E40\u0E25\u0E37\u0E2D\u0E01\u0E2B\u0E49\u0E2D\u0E07\u0E40\u0E23\u0E35\u0E22\u0E19\u0E19\u0E35\u0E49 <i class=\"far fa-hand-point-left\"></i>" + "</a>" + "</td>" + "</tr>" + "</table>" + "</div>" + "</div>" + "</div>";
              }
            } else {
              data += "<div class=\"col-12 col-sm-12 col-md-6 col-lg-3 mb-5\">" + "<div class=\"card border\" style=\"width: 100%;\">" + "<a>" + "<img class=\"card-img-top\" src=\"".concat(config.image.img_room, "/").concat(value.image, "\" height=\"190px\" width=\"50px\" alt=\"Card image cap\">") + "</a>" + "<div class=\"card-body text-center\">" + "<p class=\"card-title\" style=\"font-size: 18px;\">".concat(value.classrooms, "</p>") + "<table class=\"card-table table border-bottom-0\">" + "<tr>" + "<td class=\"border-right\" >\u0E2B\u0E21\u0E32\u0E22\u0E40\u0E25\u0E02\u0E2B\u0E49\u0E2D\u0E07</td>" + "<td>".concat(value.numbers, "</td>") + "</tr>" + "<tr>" + "<td class=\"border-right\" >\u0E08\u0E33\u0E19\u0E27\u0E19\u0E17\u0E35\u0E48\u0E19\u0E31\u0E48\u0E07</td>" + "<td>".concat(value.seats, "</td>") + "</tr>";
              /*if(value.prohibit_Start!='NULL#NULL' && value.prohibit_End!='NULL#NULL'){
                  getData(value.prohibit_Start,value.prohibit_End, function(res) {
                      resAjax = res;
                      data +=`<tr class="text-danger">`
                              +`<td class="border-right" >งดจอง</td>`
                              +`<td>${res}</td>`
                          +`</tr>`
                  });
                  console.log(data);
              }*/

              data += "<tr>" + "<td colspan=\"2\">" + "<a data-fancybox data-type=\"iframe\" href=\"".concat(config.routes.page_roomDetail, "/").concat(value.classrooms, " ").concat(value.numbers, "/").concat(value.classrooms_id, "\" class=\"fancybox btn btn-success btn-sm\">") + "<i class=\"fas fa-info-circle mr-1\"></i> \u0E23\u0E32\u0E22\u0E25\u0E30\u0E40\u0E2D\u0E35\u0E22\u0E14" + "</a>" + "</td>" + "</tr>" + "<tr>" + "<td colspan=\"2\">" + "<a class=\"btn btn-primary btn-block text-white selcRoom\" data-classroomsID=\"".concat(value.classrooms_id, "\" data-name=\"").concat(value.classrooms, " ").concat(value.numbers, "\">") + "<i class=\"far fa-hand-point-right\"></i> \u0E40\u0E25\u0E37\u0E2D\u0E01\u0E2B\u0E49\u0E2D\u0E07\u0E40\u0E23\u0E35\u0E22\u0E19\u0E19\u0E35\u0E49 <i class=\"far fa-hand-point-left\"></i>" + "</a>" + "</td>" + "</tr>" + "</table>" + "</div>" + "</div>" + "</div>";
            }

            console.log('----------------------------');
          });
          $("#data_room").append(data);
          $.getScript(config.js.page_room);
        }
      }
    });
  }
});

/***/ }),

/***/ 5:
/*!*************************************************!*\
  !*** multi ./resources/js/front/books/index.js ***!
  \*************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\xampp\htdocs\Room\resources\js\front\books\index.js */"./resources/js/front/books/index.js");


/***/ })

/******/ });