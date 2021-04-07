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
/******/ 	return __webpack_require__(__webpack_require__.s = 8);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/front/books/page_detail.js":
/*!*************************************************!*\
  !*** ./resources/js/front/books/page_detail.js ***!
  \*************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

var arr_day = {
  '1': 'จันทร์',
  '2': 'อังคาร',
  '3': 'พุธ',
  '4': 'พฤหัสบดี',
  '5': 'ศุกร์',
  '6': 'เสาร์'
}; // btn next Page_confirm

$("#frmBooking").submit(function (e) {
  var _this = this;

  e.preventDefault();
  Swal.fire({
    title: "<span class='kanin mb-3 text-success'>รายละเอียดการจองห้องเรียน</span>",
    text: "",
    // icon: "question",
    // iconColor: '#28a745',
    html: "<div class=\"col-12 text-center mb-3 text-info\" style=\"font-size: 25px;\">".concat($('#classroomsName').val(), "</div>") + "<div class=\"text-left\">" + "<dl class=\"row text-dark\">" + "<dt class=\"col-sm-3\">\u0E0A\u0E37\u0E48\u0E2D :</dt> <dd class=\"col-sm-9\"> ".concat($('#fname').val(), " </dd>") + "<dt class=\"col-sm-3\">\u0E19\u0E32\u0E21\u0E2A\u0E01\u0E38\u0E25 :</dt> <dd class=\"col-sm-9\"> ".concat($('#lname').val(), " </dd>") + "<dt class=\"col-sm-3\">E-mail :</dt> <dd class=\"col-sm-9\"> ".concat($('#email').val(), " </dd>") + "<dt class=\"col-sm-3\">\u0E40\u0E1A\u0E2D\u0E23\u0E4C\u0E20\u0E32\u0E22\u0E43\u0E19 :</dt> <dd class=\"col-sm-9\"> ".concat($('#tel').val(), " </dd>") + "<dt class=\"col-sm-3\">\u0E04\u0E13\u0E30 :</dt> <dd class=\"col-sm-9\"> ".concat($('#faculty').val(), " </dd>") + "<dt class=\"col-sm-3\">\u0E27\u0E34\u0E0A\u0E32 :</dt> <dd class=\"col-sm-9\"> ".concat($('#subject').val(), " </dd>") + "<dt class=\"col-sm-3\">\u0E23\u0E2B\u0E31\u0E2A\u0E27\u0E34\u0E0A\u0E32 :</dt> <dd class=\"col-sm-9\"> ".concat($('#course_code').val(), " </dd>") + "<dt class=\"col-sm-3\">\u0E15\u0E2D\u0E19\u0E40\u0E23\u0E35\u0E22\u0E19 :</dt> <dd class=\"col-sm-9\"> ".concat($('#part').val(), " </dd>") + "<dt class=\"col-sm-3\">\u0E08\u0E33\u0E19\u0E27\u0E19\u0E19\u0E31\u0E01\u0E40\u0E23\u0E35\u0E22\u0E19 :</dt> <dd class=\"col-sm-9\"> ".concat($('#seat').val(), " </dd>") + "<dt class=\"col-sm-3\">\u0E0A\u0E37\u0E48\u0E2D\u0E2B\u0E49\u0E2D\u0E07 :</dt> <dd class=\"col-sm-9\"> ".concat($('#classroomsName').val(), " </dd>") + "<dt class=\"col-sm-3\">\u0E27\u0E31\u0E19\u0E08\u0E2D\u0E07 :</dt> <dd class=\"col-sm-9\"> ".concat(arr_day[$('#days').val()], " </dd>") + "<dt class=\"col-sm-3\">\u0E40\u0E27\u0E25\u0E32\u0E08\u0E2D\u0E07 :</dt> <dd class=\"col-sm-9\"> ".concat($('#time_start').val(), " - ").concat($('#time_end').val(), " </dd>") + "</dl>" + "</div>",
    width: 700,
    showCancelButton: true,
    confirmButtonColor: '#28a745',
    confirmButtonText: '<i class="fas fa-calendar-check mr-1"></i> ยืนยัน',
    cancelButtonColor: '#ffc107',
    cancelButtonText: '<i class="fas fa-edit"></i> แก้ไข'
  }).then(function (result) {
    if (result.isConfirmed) {
      var name = $("#next-detail").attr('data-name');
      var formData = new FormData(_this);
      $.ajax({
        type: "POST",
        url: config.routes.page_confirmDetail,
        data: formData,
        cache: false,
        processData: false,
        contentType: false,
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function beforeSend() {
          $("#page_detail").fadeOut(10);
          $("#loading").removeAttr('style');
          $("#next-detail").css('cursor', 'not-allowed');
          $("#next-detail").prop('disabled', true);
        },
        success: function success(result) {
          //afterSend
          $("#page_detail").removeAttr('style');
          $("#loading").css('display', 'none');
          $("#next-detail").css('cursor', 'default');
          $("#next-detail").removeAttr('disabled'); // Next Step

          current_fs = $('#page_detail');
          next_fs = $('#page_confirm'); //Add Class Active

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
            duration: 500,
            complete: function complete() {
              setProgressBar(5); // End Next Step

              Swal.fire({
                position: 'center',
                icon: 'success',
                title: "<span class='kanin'>จองห้องเรียนสำเร็จ !</span>",
                showConfirmButton: false,
                timer: 1500
              }); // Insert data page_confirm

              $("#con_name").html(name);
              $("#con_name").attr('href', config.routes.page_roomDetail + '/' + name + '/' + result["data"]["classID"]);
              $("#con_fname").val(result["data"]["fname"]);
              $("#con_lname").val(result["data"]["lname"]);
              $("#con_email").val(result["data"]["email"]);
              $("#con_tel").val(result["data"]["tel"]);
              $("#con_faculty").val(result["data"]["faculty"]);
              $("#con_subject").val(result["data"]["subject"]);
              $("#con_code").val(result["data"]["course_code"]);
              $("#con_part").val(result["data"]["part"]);
              $("#con_seats").val(result["data"]["seat"]);
              $('#con_Sof').selectpicker('val', result["data"]["selSoftwares"]);
              $("#con_otherSof").val(result["data"]["otherSofware"]);
              $("#con_Rname").val(name);
              $("#con_DTs").val(arr_day[result["data"]["days"]]); // $("#con_DTe").val(moment(result["data"]["time_start"]).format('เวลา HH:mm') +' - '+ moment(result["data"]["time_end"]).format('เวลา HH:mm'));

              $("#con_DTe").val(result["data"]["time_start"] + ' - ' + result["data"]["time_end"]);
              $("#BookingsLastId").val(result["bookingsId"]);
              $("#BookingsLastIds").val(result["bookingsId"]);
            }
          });
        } //close success

      });
    }
  });
}); // btn back Page_info

$("#back-detail").click(function () {
  current_fs = $('#page_detail');
  previous_fs = $('#page_info'); //Remove class active

  $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active"); //show the previous fieldset

  previous_fs.show(); //hide the current fieldset with style

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
      previous_fs.css({
        'opacity': opacity
      });
    },
    duration: 10,
    complete: function complete() {
      setProgressBar(3);
    }
  });
}); // btn desktop click

$('#btnCancel').click(function () {
  var name = $("#con_Rname").val();
  var BookingsId = $("#BookingsLastId").val();
  Swal.fire({
    title: "<span class='kanin'>ต้องการยกเลิกการจอง <span style='color:#d33'>\n\"" + name + "\"</span> ใช่หรือไม่ ??</span>",
    text: "",
    icon: "warning",
    iconColor: '#d33',
    width: 700,
    showCancelButton: true,
    confirmButtonColor: '#28a745',
    confirmButtonText: 'ตกลง',
    cancelButtonColor: '#d33',
    cancelButtonText: 'ยกเลิก'
  }).then(function (result) {
    if (result.isConfirmed) {
      $.when($.ajax({
        url: config.routes.book_cancel,
        type: 'POST',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
          BookingsId: BookingsId
        },
        success: function success(data) {
          result = data;
        }
      })).then(function () {
        if (result == "success") {
          Swal.fire({
            title: "<span class='kanin'>ยกเลิกการจอง \"" + name + "\" เรียบร้อย..</span>",
            text: "",
            icon: "success",
            showConfirmButton: false,
            timer: 1500
          }).then(function () {
            window.location.href = config.routes.history;
          });
        } else {
          Swal.fire({
            icon: 'error',
            title: "<span class='kanin'>ยกเลิกการจอง \"" + name + "\" ไม่สำเร็จ..</span>",
            text: 'โปรดติดต่อผู้ดูแลระบบ'
          }).then(function () {
            window.location.href = config.routes.book;
          });
        }
      });
    }
  });
  return false;
}); // btn mobile click

$('#btnPDFsm').click(function () {
  $('#btnPDF').trigger('click');
  return false;
});
$('#btnEditsm').click(function () {
  $('#btnEdit').trigger('click');
  return false;
});
$('#btnCancelsm').click(function () {
  $('#btnCancel').trigger('click');
  return false;
});

/***/ }),

/***/ 8:
/*!*******************************************************!*\
  !*** multi ./resources/js/front/books/page_detail.js ***!
  \*******************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\xampp\htdocs\Room\resources\js\front\books\page_detail.js */"./resources/js/front/books/page_detail.js");


/***/ })

/******/ });