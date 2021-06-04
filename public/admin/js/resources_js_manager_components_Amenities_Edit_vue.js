(self["webpackChunkhousing"] = self["webpackChunkhousing"] || []).push([["resources_js_manager_components_Amenities_Edit_vue"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/ts-loader/index.js??clonedRuleSet-24!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/manager/components/Amenities/Edit.vue?vue&type=script&lang=ts":
/*!********************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/ts-loader/index.js??clonedRuleSet-24!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/manager/components/Amenities/Edit.vue?vue&type=script&lang=ts ***!
  \********************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");
/* harmony import */ var vuex__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! vuex */ "./node_modules/vuex/dist/vuex.esm-bundler.js");
/* harmony import */ var vue_router__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! vue-router */ "./node_modules/vue-router/dist/vue-router.esm-bundler.js");
/* harmony import */ var _store_amenity__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../store/amenity */ "./resources/js/manager/store/amenity.js");


function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }

function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }





/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ((0,vue__WEBPACK_IMPORTED_MODULE_1__.defineComponent)({
  setup: function setup() {
    var store = (0,vuex__WEBPACK_IMPORTED_MODULE_3__.useStore)();
    var router = (0,vue_router__WEBPACK_IMPORTED_MODULE_4__.useRouter)();
    var route = (0,vue_router__WEBPACK_IMPORTED_MODULE_4__.useRoute)();
    var isLoading = (0,vue__WEBPACK_IMPORTED_MODULE_1__.computed)(function () {
      return store.state.amenityModule.isLoading;
    });
    var isSending = (0,vue__WEBPACK_IMPORTED_MODULE_1__.ref)(false);
    var amenity = (0,vue__WEBPACK_IMPORTED_MODULE_1__.reactive)(store.state.amenityModule.activeAmenity || new _store_amenity__WEBPACK_IMPORTED_MODULE_2__.Amenity());
    var formInvalid = (0,vue__WEBPACK_IMPORTED_MODULE_1__.computed)(function () {
      return isSending.value || !amenity || !amenity.name;
    });

    var updateAmenity = /*#__PURE__*/function () {
      var _ref = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default().mark(function _callee() {
        var response;
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default().wrap(function _callee$(_context) {
          while (1) {
            switch (_context.prev = _context.next) {
              case 0:
                _context.prev = 0;
                isSending.value = true;
                _context.next = 4;
                return store.dispatch("amenityModule/saveAmenity", amenity);

              case 4:
                response = _context.sent;
                isSending.value = false;
                _context.next = 8;
                return store.dispatch("SET_SNACKBAR", {
                  title: response,
                  icon: 'success'
                });

              case 8:
                _context.next = 10;
                return router.push({
                  name: 'manager-amenities-list'
                });

              case 10:
                _context.next = 17;
                break;

              case 12:
                _context.prev = 12;
                _context.t0 = _context["catch"](0);
                isSending.value = false;
                _context.next = 17;
                return store.dispatch("SET_SNACKBAR", {
                  title: "Response Status",
                  html: _context.t0,
                  icon: 'error'
                });

              case 17:
              case "end":
                return _context.stop();
            }
          }
        }, _callee, null, [[0, 12]]);
      }));

      return function updateAmenity() {
        return _ref.apply(this, arguments);
      };
    }();

    var getAmenity = /*#__PURE__*/function () {
      var _ref2 = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default().mark(function _callee2() {
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default().wrap(function _callee2$(_context2) {
          while (1) {
            switch (_context2.prev = _context2.next) {
              case 0:
                _context2.prev = 0;
                _context2.next = 3;
                return store.dispatch("amenityModule/getAmenity", {
                  id: route.params.id || null
                });

              case 3:
                _context2.next = 11;
                break;

              case 5:
                _context2.prev = 5;
                _context2.t0 = _context2["catch"](0);
                _context2.next = 9;
                return store.dispatch("SET_SNACKBAR", {
                  title: _context2.t0,
                  icon: 'error'
                });

              case 9:
                _context2.next = 11;
                return router.push({
                  name: 'manager-amenities-list'
                });

              case 11:
              case "end":
                return _context2.stop();
            }
          }
        }, _callee2, null, [[0, 5]]);
      }));

      return function getAmenity() {
        return _ref2.apply(this, arguments);
      };
    }();

    getAmenity();
    return {
      amenity: amenity,
      isLoading: isLoading,
      isSending: isSending,
      formInvalid: formInvalid,
      updateAmenity: updateAmenity
    };
  }
}));

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/manager/components/Amenities/Edit.vue?vue&type=template&id=0f70e96b&scoped=true":
/*!********************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/manager/components/Amenities/Edit.vue?vue&type=template&id=0f70e96b&scoped=true ***!
  \********************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");


var _withId = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.withScopeId)("data-v-0f70e96b");

(0,vue__WEBPACK_IMPORTED_MODULE_0__.pushScopeId)("data-v-0f70e96b");

var _hoisted_1 = {
  "class": "mt-2"
};
var _hoisted_2 = {
  key: 0,
  "class": "fa fa-spinner fa-spin"
};
var _hoisted_3 = {
  key: 1,
  "class": "card"
};
var _hoisted_4 = {
  "class": "card-header bg-gradient-secondary"
};

var _hoisted_5 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("h3", {
  "class": "card-title"
}, "Property/room amenity form", -1
/* HOISTED */
);

var _hoisted_6 = {
  "class": "card-tools"
};

var _hoisted_7 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("i", {
  "class": "fa fa-backward"
}, null, -1
/* HOISTED */
);

var _hoisted_8 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" Back To List ");

var _hoisted_9 = {
  "class": "card-body table-responsive"
};
var _hoisted_10 = {
  "class": "form-group"
};

var _hoisted_11 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("label", null, "Name", -1
/* HOISTED */
);

var _hoisted_12 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("span", {
  "class": "error invalid-feedback"
}, null, -1
/* HOISTED */
);

var _hoisted_13 = {
  "class": "form-group"
};

var _hoisted_14 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("label", null, "Description", -1
/* HOISTED */
);

var _hoisted_15 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("span", {
  "class": "error invalid-feedback"
}, null, -1
/* HOISTED */
);

var _hoisted_16 = {
  "class": "card-footer"
};

var _hoisted_17 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" Save ");

var _hoisted_18 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("i", {
  "class": "far fa-save"
}, null, -1
/* HOISTED */
);

(0,vue__WEBPACK_IMPORTED_MODULE_0__.popScopeId)();

var render = /*#__PURE__*/_withId(function (_ctx, _cache, $props, $setup, $data, $options) {
  var _component_router_link = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("router-link");

  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createBlock)("div", _hoisted_1, [_ctx.isLoading ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createBlock)("span", _hoisted_2)) : ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createBlock)("div", _hoisted_3, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("div", _hoisted_4, [_hoisted_5, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("div", _hoisted_6, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_router_link, {
    to: "/manager/amenities",
    "class": "btn btn-dark btn-sm",
    tag: "a"
  }, {
    "default": _withId(function () {
      return [_hoisted_7, _hoisted_8];
    }),
    _: 1
    /* STABLE */

  })])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("div", _hoisted_9, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("div", _hoisted_10, [_hoisted_11, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("input", {
    type: "text",
    "onUpdate:modelValue": _cache[1] || (_cache[1] = function ($event) {
      return _ctx.amenity.name = $event;
    }),
    "class": "form-control",
    placeholder: "Name of the amenity",
    required: ""
  }, null, 512
  /* NEED_PATCH */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, _ctx.amenity.name]]), _hoisted_12]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("div", _hoisted_13, [_hoisted_14, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("textarea", {
    "onUpdate:modelValue": _cache[2] || (_cache[2] = function ($event) {
      return _ctx.amenity.description = $event;
    }),
    "class": "form-control",
    placeholder: "A description of the amenity"
  }, null, 512
  /* NEED_PATCH */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, _ctx.amenity.description]]), _hoisted_15])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("div", _hoisted_16, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("button", {
    type: "button",
    onClick: _cache[3] || (_cache[3] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.withModifiers)(function ($event) {
      return _ctx.updateAmenity();
    }, ["prevent"])),
    disabled: _ctx.formInvalid,
    "class": "btn btn-warning btn-block"
  }, [_hoisted_17, _hoisted_18], 8
  /* PROPS */
  , ["disabled"])])]))]);
});

/***/ }),

/***/ "./resources/js/manager/components/Amenities/Edit.vue":
/*!************************************************************!*\
  !*** ./resources/js/manager/components/Amenities/Edit.vue ***!
  \************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _Edit_vue_vue_type_template_id_0f70e96b_scoped_true__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Edit.vue?vue&type=template&id=0f70e96b&scoped=true */ "./resources/js/manager/components/Amenities/Edit.vue?vue&type=template&id=0f70e96b&scoped=true");
/* harmony import */ var _Edit_vue_vue_type_script_lang_ts__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Edit.vue?vue&type=script&lang=ts */ "./resources/js/manager/components/Amenities/Edit.vue?vue&type=script&lang=ts");



_Edit_vue_vue_type_script_lang_ts__WEBPACK_IMPORTED_MODULE_1__.default.render = _Edit_vue_vue_type_template_id_0f70e96b_scoped_true__WEBPACK_IMPORTED_MODULE_0__.render
_Edit_vue_vue_type_script_lang_ts__WEBPACK_IMPORTED_MODULE_1__.default.__scopeId = "data-v-0f70e96b"
/* hot reload */
if (false) {}

_Edit_vue_vue_type_script_lang_ts__WEBPACK_IMPORTED_MODULE_1__.default.__file = "resources/js/manager/components/Amenities/Edit.vue"

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_Edit_vue_vue_type_script_lang_ts__WEBPACK_IMPORTED_MODULE_1__.default);

/***/ }),

/***/ "./resources/js/manager/components/Amenities/Edit.vue?vue&type=script&lang=ts":
/*!************************************************************************************!*\
  !*** ./resources/js/manager/components/Amenities/Edit.vue?vue&type=script&lang=ts ***!
  \************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_ts_loader_index_js_clonedRuleSet_24_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Edit_vue_vue_type_script_lang_ts__WEBPACK_IMPORTED_MODULE_0__.default)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_ts_loader_index_js_clonedRuleSet_24_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Edit_vue_vue_type_script_lang_ts__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../node_modules/ts-loader/index.js??clonedRuleSet-24!../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./Edit.vue?vue&type=script&lang=ts */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/ts-loader/index.js??clonedRuleSet-24!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/manager/components/Amenities/Edit.vue?vue&type=script&lang=ts");
 

/***/ }),

/***/ "./resources/js/manager/components/Amenities/Edit.vue?vue&type=template&id=0f70e96b&scoped=true":
/*!******************************************************************************************************!*\
  !*** ./resources/js/manager/components/Amenities/Edit.vue?vue&type=template&id=0f70e96b&scoped=true ***!
  \******************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Edit_vue_vue_type_template_id_0f70e96b_scoped_true__WEBPACK_IMPORTED_MODULE_0__.render)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Edit_vue_vue_type_template_id_0f70e96b_scoped_true__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./Edit.vue?vue&type=template&id=0f70e96b&scoped=true */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/manager/components/Amenities/Edit.vue?vue&type=template&id=0f70e96b&scoped=true");


/***/ })

}]);