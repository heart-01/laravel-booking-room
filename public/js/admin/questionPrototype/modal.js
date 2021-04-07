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
/******/ 	return __webpack_require__(__webpack_require__.s = 15);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/admin/questionPrototype/modal.js":
/*!*******************************************************!*\
  !*** ./resources/js/admin/questionPrototype/modal.js ***!
  \*******************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$("#frmQuestionPrototype").submit(function (e) {
  var _this = this;

  e.preventDefault();
  Swal.fire({
    title: "<span class='kanin'>ยืนยันการคัดลอกแบบฟอร์ม</span>",
    text: "",
    icon: "question",
    iconColor: '#28a745',
    width: 700,
    showCancelButton: true,
    confirmButtonColor: '#28a745',
    confirmButtonText: 'ตกลง',
    cancelButtonColor: '#d33',
    cancelButtonText: 'ยกเลิก'
  }).then(function (result) {
    if (result.isConfirmed) {
      var formData = new FormData(_this);
      $.ajax({
        type: "POST",
        url: config.routes.questionPrototype_setQuestion,
        data: formData,
        cache: false,
        processData: false,
        contentType: false,
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function beforeSend() {
          $("#page_questionPrototype").fadeOut(10);
          $("#loading").removeAttr('style');
          $("#btnQuestionPrototype").css('cursor', 'not-allowed');
          $("#btnQuestionPrototype").prop('disabled', true);
        },
        success: function success(result) {
          console.log(result); //afterSend

          $("#page_questionPrototype").removeAttr('style');
          $("#loading").css('display', 'none');
          $("#btnQuestionPrototype").css('cursor', 'default');
          $("#btnQuestionPrototype").removeAttr('disabled');

          if (result == 'success') {
            Swal.fire({
              title: "<span class='kanin'>คัดลอกแบบฟอร์ม เรียบร้อย..</span>",
              text: "",
              icon: "success",
              showConfirmButton: false,
              timer: 1500
            }).then(function () {
              window.location.href = config.routes.questionPrototype;
            });
          } else {
            Swal.fire({
              title: "<span class='kanin'>ไม่สามารถคัดลอกแบบฟอร์มได้<br>โปรดติดต่อผู้ดูแลระบบ..</span>",
              text: "",
              icon: "error",
              iconColor: '#d33',
              width: 700,
              showCancelButton: true,
              confirmButtonColor: '#28a745',
              confirmButtonText: 'ตกลง',
              cancelButtonColor: '#d33',
              cancelButtonText: 'ยกเลิก'
            }).then(function (result) {
              if (result.isConfirmed) {
                window.location.href = config.routes.questionPrototype;
              }
            });
          }
        } //close success

      });
    }
  });
}); //showEdit

$(".showEdit").click(function () {
  var question_prototype_id = $(this).attr('data-id');
  var article = $(this).attr('data-article');
  var question = $(this).attr('data-question');
  $('#showEdit').modal('show');
  $("#question_prototype_id-edit").val(question_prototype_id);
  $("#article-edit").val(article);
  $("#question-edit").val(question);
  return false;
}); //showDel

$(".showDel").click(function () {
  var question_prototype_id = $(this).attr('data-id');
  var article = $(this).attr('data-article');
  Swal.fire({
    title: "<span class='kanin'>ต้องการลบแบบสอบถาม<br>ข้อ <span style='color:#d33'>\"" + article + "\"</span> ใช่หรือไม่ ??</span>",
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
        url: config.routes.questionPrototype_del,
        type: 'POST',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
          question_prototype_id: question_prototype_id
        },
        success: function success(data) {
          result = data;
        }
      })).then(function () {
        if (result == "del") {
          Swal.fire({
            title: "<span class='kanin'>ลบแบบสอบถามข้อ \"" + article + "\" เรียบร้อย..</span>",
            text: "",
            icon: "success",
            showConfirmButton: false,
            timer: 1500
          }).then(function () {
            window.location.href = config.routes.questionPrototype;
          });
        }
      });
    }
  });
  return false;
});

/***/ }),

/***/ 15:
/*!*************************************************************!*\
  !*** multi ./resources/js/admin/questionPrototype/modal.js ***!
  \*************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\xampp\htdocs\Room\resources\js\admin\questionPrototype\modal.js */"./resources/js/admin/questionPrototype/modal.js");


/***/ })

/******/ });