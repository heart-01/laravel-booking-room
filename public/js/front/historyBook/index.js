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
/******/ 	return __webpack_require__(__webpack_require__.s = 9);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/front/historyBook/index.js":
/*!*************************************************!*\
  !*** ./resources/js/front/historyBook/index.js ***!
  \*************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// btn desktop click
$('.btnCancel').click(function () {
  var BookingsId = $(this).attr('data-BookingsId');
  Swal.fire({
    title: "<span class='kanin'>ต้องการยกเลิกการจองห้องเรียนใช่หรือไม่ ??</span>",
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
        beforeSend: function beforeSend() {
          $("#divBookings").fadeOut(10);
          $("#loading").removeAttr('style');
        },
        success: function success(data) {
          result = data;
        }
      })).then(function () {
        if (result == "success") {
          //afterSend
          $("#divBookings").removeAttr('style');
          $("#loading").css('display', 'none');
          Swal.fire({
            title: "<span class='kanin'>ยกเลิกการจองห้องเรียน เรียบร้อย..</span>",
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
            title: "<span class='kanin'>ยกเลิกการจองห้องเรียน ไม่สำเร็จ..</span>",
            text: 'โปรดติดต่อผู้ดูแลระบบ'
          }).then(function () {
            window.location.href = config.routes.history;
          });
        }
      });
    }
  });
  return false;
});

/***/ }),

/***/ 9:
/*!*******************************************************!*\
  !*** multi ./resources/js/front/historyBook/index.js ***!
  \*******************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\xampp\htdocs\Room\resources\js\front\historyBook\index.js */"./resources/js/front/historyBook/index.js");


/***/ })

/******/ });