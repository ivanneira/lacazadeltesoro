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
/******/ 	return __webpack_require__(__webpack_require__.s = 3);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/monedaatexto.js":
/*!**************************************!*\
  !*** ./resources/js/monedaatexto.js ***!
  \**************************************/
/*! no static exports found */
/***/ (function(module, exports) {

var numeroALetras = function () {
  // Código basado en el comentario de @sapienman
  // Código basado en https://gist.github.com/alfchee/e563340276f89b22042a
  function Unidades(num) {
    switch (num) {
      case 1:
        return 'UN';

      case 2:
        return 'DOS';

      case 3:
        return 'TRES';

      case 4:
        return 'CUATRO';

      case 5:
        return 'CINCO';

      case 6:
        return 'SEIS';

      case 7:
        return 'SIETE';

      case 8:
        return 'OCHO';

      case 9:
        return 'NUEVE';
    }

    return '';
  } //Unidades()


  function Decenas(num) {
    var decena = Math.floor(num / 10);
    var unidad = num - decena * 10;

    switch (decena) {
      case 1:
        switch (unidad) {
          case 0:
            return 'DIEZ';

          case 1:
            return 'ONCE';

          case 2:
            return 'DOCE';

          case 3:
            return 'TRECE';

          case 4:
            return 'CATORCE';

          case 5:
            return 'QUINCE';

          default:
            return 'DIECI' + Unidades(unidad);
        }

      case 2:
        switch (unidad) {
          case 0:
            return 'VEINTE';

          default:
            return 'VEINTI' + Unidades(unidad);
        }

      case 3:
        return DecenasY('TREINTA', unidad);

      case 4:
        return DecenasY('CUARENTA', unidad);

      case 5:
        return DecenasY('CINCUENTA', unidad);

      case 6:
        return DecenasY('SESENTA', unidad);

      case 7:
        return DecenasY('SETENTA', unidad);

      case 8:
        return DecenasY('OCHENTA', unidad);

      case 9:
        return DecenasY('NOVENTA', unidad);

      case 0:
        return Unidades(unidad);
    }
  } //Unidades()


  function DecenasY(strSin, numUnidades) {
    if (numUnidades > 0) return strSin + ' Y ' + Unidades(numUnidades);
    return strSin;
  } //DecenasY()


  function Centenas(num) {
    var centenas = Math.floor(num / 100);
    var decenas = num - centenas * 100;

    switch (centenas) {
      case 1:
        if (decenas > 0) return 'CIENTO ' + Decenas(decenas);
        return 'CIEN';

      case 2:
        return 'DOSCIENTOS ' + Decenas(decenas);

      case 3:
        return 'TRESCIENTOS ' + Decenas(decenas);

      case 4:
        return 'CUATROCIENTOS ' + Decenas(decenas);

      case 5:
        return 'QUINIENTOS ' + Decenas(decenas);

      case 6:
        return 'SEISCIENTOS ' + Decenas(decenas);

      case 7:
        return 'SETECIENTOS ' + Decenas(decenas);

      case 8:
        return 'OCHOCIENTOS ' + Decenas(decenas);

      case 9:
        return 'NOVECIENTOS ' + Decenas(decenas);
    }

    return Decenas(decenas);
  } //Centenas()


  function Seccion(num, divisor, strSingular, strPlural) {
    var cientos = Math.floor(num / divisor);
    var resto = num - cientos * divisor;
    var letras = '';
    if (cientos > 0) if (cientos > 1) letras = Centenas(cientos) + ' ' + strPlural;else letras = strSingular;
    if (resto > 0) letras += '';
    return letras;
  } //Seccion()


  function Miles(num) {
    var divisor = 1000;
    var cientos = Math.floor(num / divisor);
    var resto = num - cientos * divisor;
    var strMiles = Seccion(num, divisor, 'UN MIL', 'MIL');
    var strCentenas = Centenas(resto);
    if (strMiles == '') return strCentenas;
    return strMiles + ' ' + strCentenas;
  } //Miles()


  function Millones(num) {
    var divisor = 1000000;
    var cientos = Math.floor(num / divisor);
    var resto = num - cientos * divisor;
    var strMillones = Seccion(num, divisor, 'UN MILLON DE', 'MILLONES DE');
    var strMiles = Miles(resto);
    if (strMillones == '') return strMiles;
    return strMillones + ' ' + strMiles;
  } //Millones()


  return function NumeroALetras(num, currency) {
    currency = currency || {};
    var data = {
      numero: num,
      enteros: Math.floor(num),
      centavos: Math.round(num * 100) - Math.floor(num) * 100,
      letrasCentavos: '',
      letrasMonedaPlural: currency.plural || 'PESOS CHILENOS',
      //'PESOS', 'Dólares', 'Bolívares', 'etcs'
      letrasMonedaSingular: currency.singular || 'PESO CHILENO',
      //'PESO', 'Dólar', 'Bolivar', 'etc'
      letrasMonedaCentavoPlural: currency.centPlural || 'CHIQUI PESOS CHILENOS',
      letrasMonedaCentavoSingular: currency.centSingular || 'CHIQUI PESO CHILENO'
    };

    if (data.centavos > 0) {
      data.letrasCentavos = 'CON ' + function () {
        if (data.centavos == 1) return Millones(data.centavos) + ' ' + data.letrasMonedaCentavoSingular;else return Millones(data.centavos) + ' ' + data.letrasMonedaCentavoPlural;
      }();
    }

    ;
    if (data.enteros == 0) return 'CERO ' + data.letrasMonedaPlural + ' ' + data.letrasCentavos;
    if (data.enteros == 1) return Millones(data.enteros) + ' ' + data.letrasMonedaSingular + ' ' + data.letrasCentavos;else return Millones(data.enteros) + ' ' + data.letrasMonedaPlural + ' ' + data.letrasCentavos;
  };
}();

/***/ }),

/***/ 3:
/*!********************************************!*\
  !*** multi ./resources/js/monedaatexto.js ***!
  \********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! D:\Projects\torogym\torogymapp\resources\js\monedaatexto.js */"./resources/js/monedaatexto.js");


/***/ })

/******/ });