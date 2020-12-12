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
/******/ 	__webpack_require__.p = "";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = "./blocks/index.js");
/******/ })
/************************************************************************/
/******/ ({

/***/ "./blocks/bet-calculator/editor.scss":
/*!*******************************************!*\
  !*** ./blocks/bet-calculator/editor.scss ***!
  \*******************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./blocks/bet-calculator/icon.js":
/*!***************************************!*\
  !*** ./blocks/bet-calculator/icon.js ***!
  \***************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
var icon = wp.element.createElement(
  "svg",
  {
    xmlns: "http://www.w3.org/2000/svg",
    width: "20px",
    height: "20px",
    viewBox: "0 0 24 24"
  },
  wp.element.createElement("path", { fill: "none", d: "M0 0H24V24H0z" }),
  wp.element.createElement("path", { d: "M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5.97 4.06L14.09 6l1.41 1.41L16.91 6l1.06 1.06-1.41 1.41 1.41 1.41-1.06 1.06-1.41-1.4-1.41 1.41-1.06-1.06 1.41-1.41-1.41-1.42zm-6.78.66h5v1.5h-5v-1.5zM11.5 16h-2v2H8v-2H6v-1.5h2v-2h1.5v2h2V16zm6.5 1.25h-5v-1.5h5v1.5zm0-2.5h-5v-1.5h5v1.5z" })
);

/* harmony default export */ __webpack_exports__["default"] = (icon);

/***/ }),

/***/ "./blocks/bet-calculator/index.js":
/*!****************************************!*\
  !*** ./blocks/bet-calculator/index.js ***!
  \****************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _icon__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./icon */ "./blocks/bet-calculator/icon.js");
/* harmony import */ var _style_scss__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./style.scss */ "./blocks/bet-calculator/style.scss");
/* harmony import */ var _editor_scss__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./editor.scss */ "./blocks/bet-calculator/editor.scss");
/**
 * Block dependencies
 */




/**
 * Internal block libraries
 */
var __ = wp.i18n.__;
var registerBlockType = wp.blocks.registerBlockType;
var _wp = wp,
    ServerSideRender = _wp.serverSideRender;

var blockId = 'predicblocks/bet-calculator';

registerBlockType(blockId, {
  title: __('Bet calculator', 'predic-blocks'),
  description: __('Calculate how much a bet returns for any given stake.', 'predic-blocks'),
  icon: {
    background: '#fbb34b',
    src: _icon__WEBPACK_IMPORTED_MODULE_0__["default"]
  },
  category: 'widgets',
  attributes: {},
  edit: function edit(_ref) {
    var attributes = _ref.attributes;

    return wp.element.createElement(ServerSideRender, {
      block: blockId,
      attributes: attributes
    });
  },
  // end edit
  save: function save() {
    // Rendering in PHP
    return null;
  }
});

/***/ }),

/***/ "./blocks/bet-calculator/style.scss":
/*!******************************************!*\
  !*** ./blocks/bet-calculator/style.scss ***!
  \******************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./blocks/i18n.js":
/*!************************!*\
  !*** ./blocks/i18n.js ***!
  \************************/
/*! no static exports found */
/***/ (function(module, exports) {

wp.i18n.setLocaleData({ '': {} }, 'predic-blocks');

/***/ }),

/***/ "./blocks/index.js":
/*!*************************!*\
  !*** ./blocks/index.js ***!
  \*************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _i18n_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./i18n.js */ "./blocks/i18n.js");
/* harmony import */ var _i18n_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_i18n_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _sports_odds_table__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./sports-odds-table */ "./blocks/sports-odds-table/index.js");
/* harmony import */ var _bet_calculator__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./bet-calculator */ "./blocks/bet-calculator/index.js");


/**
 * Import blocks
 */



/***/ }),

/***/ "./blocks/sports-odds-table/icon.js":
/*!******************************************!*\
  !*** ./blocks/sports-odds-table/icon.js ***!
  \******************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
var icon = wp.element.createElement(
  "svg",
  {
    xmlns: "http://www.w3.org/2000/svg",
    width: "20px",
    height: "20px",
    viewBox: "0 0 24 24"
  },
  wp.element.createElement("path", { fill: "none", d: "M0 0H24V24H0z" }),
  wp.element.createElement("path", { d: "M19 7H9c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h10c1.1 0 2-.9 2-2V9c0-1.1-.9-2-2-2zm0 2v2H9V9h10zm-6 6v-2h2v2h-2zm2 2v2h-2v-2h2zm-4-2H9v-2h2v2zm6-2h2v2h-2v-2zm-8 4h2v2H9v-2zm8 2v-2h2v2h-2zM6 17H5c-1.1 0-2-.9-2-2V5c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2v1h-2V5H5v10h1v2z" })
);

/* harmony default export */ __webpack_exports__["default"] = (icon);

/***/ }),

/***/ "./blocks/sports-odds-table/index.js":
/*!*******************************************!*\
  !*** ./blocks/sports-odds-table/index.js ***!
  \*******************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _icon__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./icon */ "./blocks/sports-odds-table/icon.js");
/* harmony import */ var _style_scss__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./style.scss */ "./blocks/sports-odds-table/style.scss");
/**
 * Block dependencies
 */



/**
 * Internal block libraries
 */
var __ = wp.i18n.__;
var registerBlockType = wp.blocks.registerBlockType;
var _wp = wp,
    ServerSideRender = _wp.serverSideRender;

var blockId = 'predicblocks/sports-odds-table';

registerBlockType(blockId, {
  title: __('Sports odds table', 'predic-blocks'),
  description: __('Shows odds for top 10 games of user’s choice from Live Sports Odds API.', 'predic-blocks'),
  icon: {
    background: '#fbb34b',
    src: _icon__WEBPACK_IMPORTED_MODULE_0__["default"]
  },
  category: 'widgets',
  attributes: {},
  edit: function edit(_ref) {
    var attributes = _ref.attributes;

    return wp.element.createElement(ServerSideRender, {
      block: blockId,
      attributes: attributes
    });
  },
  // end edit
  save: function save() {
    // Rendering in PHP
    return null;
  }
});

/***/ }),

/***/ "./blocks/sports-odds-table/style.scss":
/*!*********************************************!*\
  !*** ./blocks/sports-odds-table/style.scss ***!
  \*********************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

/******/ });
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9hc3NldHMvanMvZWRpdG9yLmJsb2Nrcy5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy93ZWJwYWNrL2Jvb3RzdHJhcCIsIndlYnBhY2s6Ly8vLi9ibG9ja3MvYmV0LWNhbGN1bGF0b3IvZWRpdG9yLnNjc3M/NmNjNiIsIndlYnBhY2s6Ly8vLi9ibG9ja3MvYmV0LWNhbGN1bGF0b3IvaWNvbi5qcyIsIndlYnBhY2s6Ly8vLi9ibG9ja3MvYmV0LWNhbGN1bGF0b3IvaW5kZXguanMiLCJ3ZWJwYWNrOi8vLy4vYmxvY2tzL2JldC1jYWxjdWxhdG9yL3N0eWxlLnNjc3M/OTc1NSIsIndlYnBhY2s6Ly8vLi9ibG9ja3MvaTE4bi5qcyIsIndlYnBhY2s6Ly8vLi9ibG9ja3MvaW5kZXguanMiLCJ3ZWJwYWNrOi8vLy4vYmxvY2tzL3Nwb3J0cy1vZGRzLXRhYmxlL2ljb24uanMiLCJ3ZWJwYWNrOi8vLy4vYmxvY2tzL3Nwb3J0cy1vZGRzLXRhYmxlL2luZGV4LmpzIiwid2VicGFjazovLy8uL2Jsb2Nrcy9zcG9ydHMtb2Rkcy10YWJsZS9zdHlsZS5zY3NzIl0sInNvdXJjZXNDb250ZW50IjpbIiBcdC8vIFRoZSBtb2R1bGUgY2FjaGVcbiBcdHZhciBpbnN0YWxsZWRNb2R1bGVzID0ge307XG5cbiBcdC8vIFRoZSByZXF1aXJlIGZ1bmN0aW9uXG4gXHRmdW5jdGlvbiBfX3dlYnBhY2tfcmVxdWlyZV9fKG1vZHVsZUlkKSB7XG5cbiBcdFx0Ly8gQ2hlY2sgaWYgbW9kdWxlIGlzIGluIGNhY2hlXG4gXHRcdGlmKGluc3RhbGxlZE1vZHVsZXNbbW9kdWxlSWRdKSB7XG4gXHRcdFx0cmV0dXJuIGluc3RhbGxlZE1vZHVsZXNbbW9kdWxlSWRdLmV4cG9ydHM7XG4gXHRcdH1cbiBcdFx0Ly8gQ3JlYXRlIGEgbmV3IG1vZHVsZSAoYW5kIHB1dCBpdCBpbnRvIHRoZSBjYWNoZSlcbiBcdFx0dmFyIG1vZHVsZSA9IGluc3RhbGxlZE1vZHVsZXNbbW9kdWxlSWRdID0ge1xuIFx0XHRcdGk6IG1vZHVsZUlkLFxuIFx0XHRcdGw6IGZhbHNlLFxuIFx0XHRcdGV4cG9ydHM6IHt9XG4gXHRcdH07XG5cbiBcdFx0Ly8gRXhlY3V0ZSB0aGUgbW9kdWxlIGZ1bmN0aW9uXG4gXHRcdG1vZHVsZXNbbW9kdWxlSWRdLmNhbGwobW9kdWxlLmV4cG9ydHMsIG1vZHVsZSwgbW9kdWxlLmV4cG9ydHMsIF9fd2VicGFja19yZXF1aXJlX18pO1xuXG4gXHRcdC8vIEZsYWcgdGhlIG1vZHVsZSBhcyBsb2FkZWRcbiBcdFx0bW9kdWxlLmwgPSB0cnVlO1xuXG4gXHRcdC8vIFJldHVybiB0aGUgZXhwb3J0cyBvZiB0aGUgbW9kdWxlXG4gXHRcdHJldHVybiBtb2R1bGUuZXhwb3J0cztcbiBcdH1cblxuXG4gXHQvLyBleHBvc2UgdGhlIG1vZHVsZXMgb2JqZWN0IChfX3dlYnBhY2tfbW9kdWxlc19fKVxuIFx0X193ZWJwYWNrX3JlcXVpcmVfXy5tID0gbW9kdWxlcztcblxuIFx0Ly8gZXhwb3NlIHRoZSBtb2R1bGUgY2FjaGVcbiBcdF9fd2VicGFja19yZXF1aXJlX18uYyA9IGluc3RhbGxlZE1vZHVsZXM7XG5cbiBcdC8vIGRlZmluZSBnZXR0ZXIgZnVuY3Rpb24gZm9yIGhhcm1vbnkgZXhwb3J0c1xuIFx0X193ZWJwYWNrX3JlcXVpcmVfXy5kID0gZnVuY3Rpb24oZXhwb3J0cywgbmFtZSwgZ2V0dGVyKSB7XG4gXHRcdGlmKCFfX3dlYnBhY2tfcmVxdWlyZV9fLm8oZXhwb3J0cywgbmFtZSkpIHtcbiBcdFx0XHRPYmplY3QuZGVmaW5lUHJvcGVydHkoZXhwb3J0cywgbmFtZSwgeyBlbnVtZXJhYmxlOiB0cnVlLCBnZXQ6IGdldHRlciB9KTtcbiBcdFx0fVxuIFx0fTtcblxuIFx0Ly8gZGVmaW5lIF9fZXNNb2R1bGUgb24gZXhwb3J0c1xuIFx0X193ZWJwYWNrX3JlcXVpcmVfXy5yID0gZnVuY3Rpb24oZXhwb3J0cykge1xuIFx0XHRpZih0eXBlb2YgU3ltYm9sICE9PSAndW5kZWZpbmVkJyAmJiBTeW1ib2wudG9TdHJpbmdUYWcpIHtcbiBcdFx0XHRPYmplY3QuZGVmaW5lUHJvcGVydHkoZXhwb3J0cywgU3ltYm9sLnRvU3RyaW5nVGFnLCB7IHZhbHVlOiAnTW9kdWxlJyB9KTtcbiBcdFx0fVxuIFx0XHRPYmplY3QuZGVmaW5lUHJvcGVydHkoZXhwb3J0cywgJ19fZXNNb2R1bGUnLCB7IHZhbHVlOiB0cnVlIH0pO1xuIFx0fTtcblxuIFx0Ly8gY3JlYXRlIGEgZmFrZSBuYW1lc3BhY2Ugb2JqZWN0XG4gXHQvLyBtb2RlICYgMTogdmFsdWUgaXMgYSBtb2R1bGUgaWQsIHJlcXVpcmUgaXRcbiBcdC8vIG1vZGUgJiAyOiBtZXJnZSBhbGwgcHJvcGVydGllcyBvZiB2YWx1ZSBpbnRvIHRoZSBuc1xuIFx0Ly8gbW9kZSAmIDQ6IHJldHVybiB2YWx1ZSB3aGVuIGFscmVhZHkgbnMgb2JqZWN0XG4gXHQvLyBtb2RlICYgOHwxOiBiZWhhdmUgbGlrZSByZXF1aXJlXG4gXHRfX3dlYnBhY2tfcmVxdWlyZV9fLnQgPSBmdW5jdGlvbih2YWx1ZSwgbW9kZSkge1xuIFx0XHRpZihtb2RlICYgMSkgdmFsdWUgPSBfX3dlYnBhY2tfcmVxdWlyZV9fKHZhbHVlKTtcbiBcdFx0aWYobW9kZSAmIDgpIHJldHVybiB2YWx1ZTtcbiBcdFx0aWYoKG1vZGUgJiA0KSAmJiB0eXBlb2YgdmFsdWUgPT09ICdvYmplY3QnICYmIHZhbHVlICYmIHZhbHVlLl9fZXNNb2R1bGUpIHJldHVybiB2YWx1ZTtcbiBcdFx0dmFyIG5zID0gT2JqZWN0LmNyZWF0ZShudWxsKTtcbiBcdFx0X193ZWJwYWNrX3JlcXVpcmVfXy5yKG5zKTtcbiBcdFx0T2JqZWN0LmRlZmluZVByb3BlcnR5KG5zLCAnZGVmYXVsdCcsIHsgZW51bWVyYWJsZTogdHJ1ZSwgdmFsdWU6IHZhbHVlIH0pO1xuIFx0XHRpZihtb2RlICYgMiAmJiB0eXBlb2YgdmFsdWUgIT0gJ3N0cmluZycpIGZvcih2YXIga2V5IGluIHZhbHVlKSBfX3dlYnBhY2tfcmVxdWlyZV9fLmQobnMsIGtleSwgZnVuY3Rpb24oa2V5KSB7IHJldHVybiB2YWx1ZVtrZXldOyB9LmJpbmQobnVsbCwga2V5KSk7XG4gXHRcdHJldHVybiBucztcbiBcdH07XG5cbiBcdC8vIGdldERlZmF1bHRFeHBvcnQgZnVuY3Rpb24gZm9yIGNvbXBhdGliaWxpdHkgd2l0aCBub24taGFybW9ueSBtb2R1bGVzXG4gXHRfX3dlYnBhY2tfcmVxdWlyZV9fLm4gPSBmdW5jdGlvbihtb2R1bGUpIHtcbiBcdFx0dmFyIGdldHRlciA9IG1vZHVsZSAmJiBtb2R1bGUuX19lc01vZHVsZSA/XG4gXHRcdFx0ZnVuY3Rpb24gZ2V0RGVmYXVsdCgpIHsgcmV0dXJuIG1vZHVsZVsnZGVmYXVsdCddOyB9IDpcbiBcdFx0XHRmdW5jdGlvbiBnZXRNb2R1bGVFeHBvcnRzKCkgeyByZXR1cm4gbW9kdWxlOyB9O1xuIFx0XHRfX3dlYnBhY2tfcmVxdWlyZV9fLmQoZ2V0dGVyLCAnYScsIGdldHRlcik7XG4gXHRcdHJldHVybiBnZXR0ZXI7XG4gXHR9O1xuXG4gXHQvLyBPYmplY3QucHJvdG90eXBlLmhhc093blByb3BlcnR5LmNhbGxcbiBcdF9fd2VicGFja19yZXF1aXJlX18ubyA9IGZ1bmN0aW9uKG9iamVjdCwgcHJvcGVydHkpIHsgcmV0dXJuIE9iamVjdC5wcm90b3R5cGUuaGFzT3duUHJvcGVydHkuY2FsbChvYmplY3QsIHByb3BlcnR5KTsgfTtcblxuIFx0Ly8gX193ZWJwYWNrX3B1YmxpY19wYXRoX19cbiBcdF9fd2VicGFja19yZXF1aXJlX18ucCA9IFwiXCI7XG5cblxuIFx0Ly8gTG9hZCBlbnRyeSBtb2R1bGUgYW5kIHJldHVybiBleHBvcnRzXG4gXHRyZXR1cm4gX193ZWJwYWNrX3JlcXVpcmVfXyhfX3dlYnBhY2tfcmVxdWlyZV9fLnMgPSBcIi4vYmxvY2tzL2luZGV4LmpzXCIpO1xuIiwiLy8gZXh0cmFjdGVkIGJ5IG1pbmktY3NzLWV4dHJhY3QtcGx1Z2luXG5leHBvcnQge307IiwidmFyIGljb24gPSB3cC5lbGVtZW50LmNyZWF0ZUVsZW1lbnQoXG4gIFwic3ZnXCIsXG4gIHtcbiAgICB4bWxuczogXCJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2Z1wiLFxuICAgIHdpZHRoOiBcIjIwcHhcIixcbiAgICBoZWlnaHQ6IFwiMjBweFwiLFxuICAgIHZpZXdCb3g6IFwiMCAwIDI0IDI0XCJcbiAgfSxcbiAgd3AuZWxlbWVudC5jcmVhdGVFbGVtZW50KFwicGF0aFwiLCB7IGZpbGw6IFwibm9uZVwiLCBkOiBcIk0wIDBIMjRWMjRIMHpcIiB9KSxcbiAgd3AuZWxlbWVudC5jcmVhdGVFbGVtZW50KFwicGF0aFwiLCB7IGQ6IFwiTTE5IDNINWMtMS4xIDAtMiAuOS0yIDJ2MTRjMCAxLjEuOSAyIDIgMmgxNGMxLjEgMCAyLS45IDItMlY1YzAtMS4xLS45LTItMi0yem0tNS45NyA0LjA2TDE0LjA5IDZsMS40MSAxLjQxTDE2LjkxIDZsMS4wNiAxLjA2LTEuNDEgMS40MSAxLjQxIDEuNDEtMS4wNiAxLjA2LTEuNDEtMS40LTEuNDEgMS40MS0xLjA2LTEuMDYgMS40MS0xLjQxLTEuNDEtMS40MnptLTYuNzguNjZoNXYxLjVoLTV2LTEuNXpNMTEuNSAxNmgtMnYySDh2LTJINnYtMS41aDJ2LTJoMS41djJoMlYxNnptNi41IDEuMjVoLTV2LTEuNWg1djEuNXptMC0yLjVoLTV2LTEuNWg1djEuNXpcIiB9KVxuKTtcblxuZXhwb3J0IGRlZmF1bHQgaWNvbjsiLCIvKipcbiAqIEJsb2NrIGRlcGVuZGVuY2llc1xuICovXG5pbXBvcnQgaWNvbiBmcm9tICcuL2ljb24nO1xuaW1wb3J0ICcuL3N0eWxlLnNjc3MnO1xuaW1wb3J0ICcuL2VkaXRvci5zY3NzJztcblxuLyoqXG4gKiBJbnRlcm5hbCBibG9jayBsaWJyYXJpZXNcbiAqL1xudmFyIF9fID0gd3AuaTE4bi5fXztcbnZhciByZWdpc3RlckJsb2NrVHlwZSA9IHdwLmJsb2Nrcy5yZWdpc3RlckJsb2NrVHlwZTtcbnZhciBfd3AgPSB3cCxcbiAgICBTZXJ2ZXJTaWRlUmVuZGVyID0gX3dwLnNlcnZlclNpZGVSZW5kZXI7XG5cbnZhciBibG9ja0lkID0gJ3ByZWRpY2Jsb2Nrcy9iZXQtY2FsY3VsYXRvcic7XG5cbnJlZ2lzdGVyQmxvY2tUeXBlKGJsb2NrSWQsIHtcbiAgdGl0bGU6IF9fKCdCZXQgY2FsY3VsYXRvcicsICdwcmVkaWMtYmxvY2tzJyksXG4gIGRlc2NyaXB0aW9uOiBfXygnQ2FsY3VsYXRlIGhvdyBtdWNoIGEgYmV0IHJldHVybnMgZm9yIGFueSBnaXZlbiBzdGFrZS4nLCAncHJlZGljLWJsb2NrcycpLFxuICBpY29uOiB7XG4gICAgYmFja2dyb3VuZDogJyNmYmIzNGInLFxuICAgIHNyYzogaWNvblxuICB9LFxuICBjYXRlZ29yeTogJ3dpZGdldHMnLFxuICBhdHRyaWJ1dGVzOiB7fSxcbiAgZWRpdDogZnVuY3Rpb24gZWRpdChfcmVmKSB7XG4gICAgdmFyIGF0dHJpYnV0ZXMgPSBfcmVmLmF0dHJpYnV0ZXM7XG5cbiAgICByZXR1cm4gd3AuZWxlbWVudC5jcmVhdGVFbGVtZW50KFNlcnZlclNpZGVSZW5kZXIsIHtcbiAgICAgIGJsb2NrOiBibG9ja0lkLFxuICAgICAgYXR0cmlidXRlczogYXR0cmlidXRlc1xuICAgIH0pO1xuICB9LFxuICAvLyBlbmQgZWRpdFxuICBzYXZlOiBmdW5jdGlvbiBzYXZlKCkge1xuICAgIC8vIFJlbmRlcmluZyBpbiBQSFBcbiAgICByZXR1cm4gbnVsbDtcbiAgfVxufSk7IiwiLy8gZXh0cmFjdGVkIGJ5IG1pbmktY3NzLWV4dHJhY3QtcGx1Z2luXG5leHBvcnQge307Iiwid3AuaTE4bi5zZXRMb2NhbGVEYXRhKHsgJyc6IHt9IH0sICdwcmVkaWMtYmxvY2tzJyk7IiwiaW1wb3J0IFwiLi9pMThuLmpzXCI7XG5cbi8qKlxuICogSW1wb3J0IGJsb2Nrc1xuICovXG5pbXBvcnQgXCIuL3Nwb3J0cy1vZGRzLXRhYmxlXCI7XG5pbXBvcnQgXCIuL2JldC1jYWxjdWxhdG9yXCI7IiwidmFyIGljb24gPSB3cC5lbGVtZW50LmNyZWF0ZUVsZW1lbnQoXG4gIFwic3ZnXCIsXG4gIHtcbiAgICB4bWxuczogXCJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2Z1wiLFxuICAgIHdpZHRoOiBcIjIwcHhcIixcbiAgICBoZWlnaHQ6IFwiMjBweFwiLFxuICAgIHZpZXdCb3g6IFwiMCAwIDI0IDI0XCJcbiAgfSxcbiAgd3AuZWxlbWVudC5jcmVhdGVFbGVtZW50KFwicGF0aFwiLCB7IGZpbGw6IFwibm9uZVwiLCBkOiBcIk0wIDBIMjRWMjRIMHpcIiB9KSxcbiAgd3AuZWxlbWVudC5jcmVhdGVFbGVtZW50KFwicGF0aFwiLCB7IGQ6IFwiTTE5IDdIOWMtMS4xIDAtMiAuOS0yIDJ2MTBjMCAxLjEuOSAyIDIgMmgxMGMxLjEgMCAyLS45IDItMlY5YzAtMS4xLS45LTItMi0yem0wIDJ2Mkg5VjloMTB6bS02IDZ2LTJoMnYyaC0yem0yIDJ2MmgtMnYtMmgyem0tNC0ySDl2LTJoMnYyem02LTJoMnYyaC0ydi0yem0tOCA0aDJ2Mkg5di0yem04IDJ2LTJoMnYyaC0yek02IDE3SDVjLTEuMSAwLTItLjktMi0yVjVjMC0xLjEuOS0yIDItMmgxMGMxLjEgMCAyIC45IDIgMnYxaC0yVjVINXYxMGgxdjJ6XCIgfSlcbik7XG5cbmV4cG9ydCBkZWZhdWx0IGljb247IiwiLyoqXG4gKiBCbG9jayBkZXBlbmRlbmNpZXNcbiAqL1xuaW1wb3J0IGljb24gZnJvbSAnLi9pY29uJztcbmltcG9ydCAnLi9zdHlsZS5zY3NzJztcblxuLyoqXG4gKiBJbnRlcm5hbCBibG9jayBsaWJyYXJpZXNcbiAqL1xudmFyIF9fID0gd3AuaTE4bi5fXztcbnZhciByZWdpc3RlckJsb2NrVHlwZSA9IHdwLmJsb2Nrcy5yZWdpc3RlckJsb2NrVHlwZTtcbnZhciBfd3AgPSB3cCxcbiAgICBTZXJ2ZXJTaWRlUmVuZGVyID0gX3dwLnNlcnZlclNpZGVSZW5kZXI7XG5cbnZhciBibG9ja0lkID0gJ3ByZWRpY2Jsb2Nrcy9zcG9ydHMtb2Rkcy10YWJsZSc7XG5cbnJlZ2lzdGVyQmxvY2tUeXBlKGJsb2NrSWQsIHtcbiAgdGl0bGU6IF9fKCdTcG9ydHMgb2RkcyB0YWJsZScsICdwcmVkaWMtYmxvY2tzJyksXG4gIGRlc2NyaXB0aW9uOiBfXygnU2hvd3Mgb2RkcyBmb3IgdG9wIDEwIGdhbWVzIG9mIHVzZXLigJlzIGNob2ljZSBmcm9tIExpdmUgU3BvcnRzIE9kZHMgQVBJLicsICdwcmVkaWMtYmxvY2tzJyksXG4gIGljb246IHtcbiAgICBiYWNrZ3JvdW5kOiAnI2ZiYjM0YicsXG4gICAgc3JjOiBpY29uXG4gIH0sXG4gIGNhdGVnb3J5OiAnd2lkZ2V0cycsXG4gIGF0dHJpYnV0ZXM6IHt9LFxuICBlZGl0OiBmdW5jdGlvbiBlZGl0KF9yZWYpIHtcbiAgICB2YXIgYXR0cmlidXRlcyA9IF9yZWYuYXR0cmlidXRlcztcblxuICAgIHJldHVybiB3cC5lbGVtZW50LmNyZWF0ZUVsZW1lbnQoU2VydmVyU2lkZVJlbmRlciwge1xuICAgICAgYmxvY2s6IGJsb2NrSWQsXG4gICAgICBhdHRyaWJ1dGVzOiBhdHRyaWJ1dGVzXG4gICAgfSk7XG4gIH0sXG4gIC8vIGVuZCBlZGl0XG4gIHNhdmU6IGZ1bmN0aW9uIHNhdmUoKSB7XG4gICAgLy8gUmVuZGVyaW5nIGluIFBIUFxuICAgIHJldHVybiBudWxsO1xuICB9XG59KTsiLCIvLyBleHRyYWN0ZWQgYnkgbWluaS1jc3MtZXh0cmFjdC1wbHVnaW5cbmV4cG9ydCB7fTsiXSwibWFwcGluZ3MiOiI7QUFBQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOzs7Ozs7Ozs7Ozs7O0FDbEZBO0FBQUE7Ozs7Ozs7Ozs7Ozs7QUNBQTtBQUFBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOzs7Ozs7Ozs7Ozs7QUNaQTtBQUFBO0FBQUE7QUFBQTtBQUFBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOzs7Ozs7Ozs7Ozs7QUN2Q0E7QUFBQTs7Ozs7Ozs7Ozs7O0FDQUE7Ozs7Ozs7Ozs7OztBQ0FBO0FBQUE7QUFBQTtBQUFBO0FBQUE7QUFBQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7Ozs7Ozs7Ozs7Ozs7QUNMQTtBQUFBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOzs7Ozs7Ozs7Ozs7QUNaQTtBQUFBO0FBQUE7QUFBQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7Ozs7Ozs7Ozs7OztBQ3RDQTtBQUFBOzs7OztBIiwic291cmNlUm9vdCI6IiJ9