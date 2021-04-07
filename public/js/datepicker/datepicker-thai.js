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

/***/ "./resources/js/datepicker-thai.js":
/*!*****************************************!*\
  !*** ./resources/js/datepicker-thai.js ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

/**
 * Implement Thai-year handling inherit core datepicker and default bootstrap-datepicker backend.
 */
;

(function ($) {
  var dates = $.fn.datepicker.dates,
      DPGlobal = $.fn.datepicker.DPGlobal,
      thai = {
    adj: 543,
    code: 'th',
    bound: 2400 // full year value that detect as thai year 
    ,
    shbound: 40 // short year value that detect as thai year 
    ,
    shwrap: 84 // short year value that wrap to previous century
    ,
    shbase: 2000 // default base for short year 20xx

  };

  function dspThaiYear(language) {
    return language.search('-' + thai.code) >= 0;
  }

  function smartThai(language) {
    return language.search(thai.code) >= 0;
  }

  function smartFullYear(v, language) {
    if (smartThai(language) && v >= thai.bound) v -= thai.adj; // thaiyear 24xx -

    if (dspThaiYear(language) && v < thai.bound - thai.adj) v -= thai.adj;
    return v;
  }

  function smartShortYear(v, language) {
    if (v < 100) {
      if (v >= thai.shwrap) v -= 100; // 1970 - 1999

      if (smartThai(language) && v >= thai.shbound) v -= thai.adj % 100; // thaiyear [2540..2569] -> [1997..2026]

      v += thai.shbase;
    }

    return v;
  }

  function smartYear(v, language) {
    return smartFullYear(smartShortYear(v, language), language);
  }

  function UTCDate() {
    return new Date(Date.UTC.apply(Date, arguments));
  } // inherit default backend


  if (DPGlobal.name && DPGlobal.name.search(/.th$/) >= 0) return;

  var _basebackend_ = $.extend({}, DPGlobal);

  $.extend(DPGlobal, {
    name: (_basebackend_.name || '') + '.th',
    parseDate: function parseDate(date, format, language) {
      if (date == '') {
        date = new Date();
        date = UTCDate(date.getFullYear(), date.getMonth(), date.getDate(), 0, 0, 0);
      }

      if (smartThai(language) && !(date instanceof Date || /^[-+].*/.test(date))) {
        var formats = format //this.parseFormat(format)
        ,
            parts = date && date.match(this.nonpunctuation) || [];
        if (typeof formats === 'string') formats = DPGlobal.parseFormat(format);

        if (parts.length == formats.parts.length) {
          var seps = $.extend([], formats.separators),
              xdate = [];

          for (var i = 0, cnt = formats.parts.length; i < cnt; i++) {
            if (~['yyyy', 'yy'].indexOf(formats.parts[i])) parts[i] = '' + smartYear(parseInt(parts[i], 10), language);
            if (seps.length) xdate.push(seps.shift());
            xdate.push(parts[i]);
          }

          date = xdate.join('');
        }
      }

      return _basebackend_.parseDate.call(this, date, format, language);
    },
    formatDate: function formatDate(date, format, language) {
      var fmtdate = _basebackend_.formatDate.call(this, date, format, language);

      if (dspThaiYear(language)) {
        var formats = format //this.parseFormat(format)
        ,
            parts = fmtdate && fmtdate.match(this.nonpunctuation) || [],
            trnfrm = {
          yy: (thai.adj + date.getUTCFullYear()).toString().substring(2),
          yyyy: (thai.adj + date.getUTCFullYear()).toString()
        };
        if (typeof formats === 'string') formats = DPGlobal.parseFormat(format);

        if (parts.length == formats.parts.length) {
          var seps = $.extend([], formats.separators),
              xdate = [];

          for (var i = 0, cnt = formats.parts.length; i < cnt; i++) {
            if (seps.length) xdate.push(seps.shift());
            xdate.push(trnfrm[formats.parts[i]] || parts[i]);
          }

          fmtdate = xdate.join('');
        }
      }

      return fmtdate;
    }
  }); // inherit core datepicker

  var DatePicker = $.fn.datepicker.Constructor;

  if (!DatePicker.prototype.fillThai) {
    var _basemethod_ = $.extend({}, DatePicker.prototype);

    $.extend(DatePicker.prototype, {
      fillThai: function fillThai() {
        var d = new Date(this.viewDate),
            year = d.getUTCFullYear(),
            month = d.getUTCMonth(),
            elem = this.picker.find('.datepicker-days th:eq(1)', yearStart = "", yearEnd = "");
        elem.text(elem.text().replace('' + year, '' + (year + thai.adj)));
        this.picker.find('.datepicker-months').find('th:eq(2)').text('' + (year + thai.adj)); //console.log(year);
        // yearStart = (parseInt(d.getUTCFullYear() / 10, 10) * 10) + 543;
        // yearEnd = (((parseInt(d.getUTCFullYear() / 10, 10) + 1) * 10) - 1) + 543;   
        //year = parseInt((d.getUTCFullYear()+thai.adj)/100, 10) * 100

        this.picker.find('.datepicker-years').find('th:eq(2)').text(parseInt(d.getUTCFullYear() / 10, 10) * 10 + 543 + '-' + ((parseInt(d.getUTCFullYear() / 10, 10) + 1) * 10 - 1 + 543)).end().find('td').find('span.year').each(function () {
          // console.log(year);
          $(this).text(Number($(this).text()) + thai.adj);
        }); // yearStart = (parseInt(d.getUTCFullYear() / 100, 10) * 100) + 543;
        // yearEnd = (((parseInt(d.getUTCFullYear() / 100, 10) + 1) * 100) - 10) + 543;
        //year = parseInt((d.getUTCFullYear()+thai.adj)/100, 10) * 100

        this.picker.find('.datepicker-decades').find('th:eq(2)').text(parseInt(d.getUTCFullYear() / 100, 10) * 100 + 543 + '-' + ((parseInt(d.getUTCFullYear() / 100, 10) + 1) * 100 - 10 + 543)).end().find('td').find('span.decade').each(function () {
          // console.log(year);
          $(this).text(Number($(this).text()) + thai.adj);
        }); //yearStart = (parseInt(d.getUTCFullYear() / 1000, 10) * 1000) + 543;
        //yearEnd = (((parseInt(d.getUTCFullYear() / 1000, 10) + 1) * 1000) - 100) + 543;
        //year = parseInt((d.getUTCFullYear()+thai.adj)/1000, 10) * 1000

        this.picker.find('.datepicker-centuries').find('th:eq(2)').text(parseInt(d.getUTCFullYear() / 1000, 10) * 1000 + 543 + '-' + ((parseInt(d.getUTCFullYear() / 1000, 10) + 1) * 1000 - 100 + 543)).end().find('td').find('span.century').each(function () {
          // console.log(year);
          $(this).text(Number($(this).text()) + thai.adj);
        });
      },
      fill: function fill() {
        _basemethod_.fill.call(this);

        if (dspThaiYear(this.o.language)) this.fillThai();
      },
      clickThai: function clickThai(e) {
        var target = $(e.target).closest('span');
        if (target.length === 1 && target.is('.year')) target.text(Number(target.text()) - thai.adj);
        if (target.length === 1 && target.is('.decade')) target.text(Number(target.text()) - thai.adj);
        if (target.length === 1 && target.is('.century')) target.text(Number(target.text()) - thai.adj);
      },
      click: function click(e) {
        if (dspThaiYear(this.o.language)) this.clickThai(e);

        _basemethod_.click.call(this, e);
      },
      keydown: function keydown(e) {
        // allow arrow-down to show picker
        if (this.picker.is(':not(:visible)') && e.keyCode == 40 // arrow-down
        && $(e.target).is('[autocomplete="off"]')) {
          this.show();
          return;
        }

        _basemethod_.keydown.call(this, e);
      },
      hide: function hide(e) {
        // fix redundant hide in orginal code
        if (this.picker.is(':visible')) _basemethod_.hide.call(this, e); //else console.log('redundant hide')
      }
    });
  }
})(jQuery);

/***/ }),

/***/ 5:
/*!***********************************************!*\
  !*** multi ./resources/js/datepicker-thai.js ***!
  \***********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\xampp\htdocs\ProjectAccountRice\resources\js\datepicker-thai.js */"./resources/js/datepicker-thai.js");


/***/ })

/******/ });