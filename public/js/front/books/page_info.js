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
/******/ 	return __webpack_require__(__webpack_require__.s = 7);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/front/books/page_info.js":
/*!***********************************************!*\
  !*** ./resources/js/front/books/page_info.js ***!
  \***********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// btn next Page_detail
$("#next-info").click(function () {
  var name = $(this).attr('data-name');
  var classrooms_id = $(this).attr('data-classroomsID');
  var semesters_id = $("#semesters_id").val();
  var days = $("#Droom").val();
  var time_start = $("#TroomS").val();
  var time_end = $("#TroomE").val();
  var seats = $("#seats").val(); // Next Step

  current_fs = $('#page_info');
  next_fs = $('#page_detail'); //Add Class Active

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
      setProgressBar(4); // End Next Step

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
}); // btn back Page_room

$("#back-info").click(function () {
  current_fs = $('#page_info');
  previous_fs = $('#page_room'); //Remove class active

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
      setProgressBar(2);
    }
  });
}); // Validity Form

document.getElementById('fname').oninvalid = function (event) {
  event.target.setCustomValidity('กรุณากรอกชื่อเป็นภาษาไทย หรือ ภาษาอักฤษ');
};

document.getElementById('fname').oninput = function (event) {
  event.target.setCustomValidity('');
};

document.getElementById('lname').oninvalid = function (event) {
  event.target.setCustomValidity('กรุณากรอกนามสกุลเป็นภาษาไทย หรือ ภาษาอักฤษ');
};

document.getElementById('lname').oninput = function (event) {
  event.target.setCustomValidity('');
};

document.getElementById('email').oninvalid = function (event) {
  event.target.setCustomValidity('รูปแบบอีเมลไม่ถูกต้อง');
};

document.getElementById('email').oninput = function (event) {
  event.target.setCustomValidity('');
};

document.getElementById('tel').oninvalid = function (event) {
  event.target.setCustomValidity('กรุณากรอกเบอร์ภายในเป็นตัวเลข');
};

document.getElementById('tel').oninput = function (event) {
  event.target.setCustomValidity('');
};

document.getElementById('subject').oninvalid = function (event) {
  event.target.setCustomValidity('กรุณากรอกชื่อวิชาเป็นภาษาไทย หรือ ภาษาอักฤษ');
};

document.getElementById('subject').oninput = function (event) {
  event.target.setCustomValidity('');
};

document.getElementById('course_code').oninvalid = function (event) {
  event.target.setCustomValidity('รูปแบบรหัสวิชาไม่ถูกต้อง');
};

document.getElementById('course_code').oninput = function (event) {
  event.target.setCustomValidity('');
};

/***/ }),

/***/ 7:
/*!*****************************************************!*\
  !*** multi ./resources/js/front/books/page_info.js ***!
  \*****************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\xampp\htdocs\Room\resources\js\front\books\page_info.js */"./resources/js/front/books/page_info.js");


/***/ })

/******/ });