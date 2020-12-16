(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[2],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vuetify-loader/lib/loader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/Index.vue?vue&type=script&lang=js&":
/*!******************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vuetify-loader/lib/loader.js??ref--11-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/Index.vue?vue&type=script&lang=js& ***!
  \******************************************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//vanila js
//start of vue
/* harmony default export */ __webpack_exports__["default"] = ({
  data: function data() {
    return {
      login_data: {
        email: "",
        password: ""
      },
      register_data: {
        first_name: "",
        last_name: "",
        email: "",
        password: "",
        confirm_password: ""
      },
      forgotPw_data: {
        email: ""
      },
      loginLoading: false,
      showPassword: false,
      registerDialog: false,
      forgotPwDialog: false,
      validationError: [],
      rules: {
        required: function required(value) {
          return !!value || "Required.";
        },
        min: function min(v) {
          return v.length >= 8 || "Min 8 characters";
        },
        emailMatch: function emailMatch() {
          return "The email and password you entered don't match";
        }
      }
    };
  },
  mounted: function mounted() {
    this.changetab();
  },
  methods: {
    login: function login() {
      var _this = this;

      this.loginLoading = true;
      axios.get("/sanctum/csrf-cookie").then(function (response) {
        axios.post("/login", {
          email: _this.login_data.email,
          password: _this.login_data.password
        }).then(function (response) {
          var token = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
          localStorage.setItem("token", token);
          axios.get("api/user").then(function (response) {
            var userType = response.data.user_type_id;

            if (userType == 1) {
              _this.$router.push({
                name: "ExaminationRoom"
              });
            } else if (userType == 2) {
              _this.$router.push({
                name: "ManageRoom"
              });
            }
          });
        })["catch"](function (error) {
          var validationErrors = Object.values(error.response.data.errors);
          validationErrors = validationErrors.flat();
          _this.validationError = validationErrors;
          _this.loginLoading = false;
        });
      })["catch"](function (error) {
        console.log("sanctum error");
        _this.loginLoading = false;
      });
    },
    register: function register() {
      axios.post("/register", {
        first_name: this.register_data.first_name,
        last_name: this.register_data.last_name,
        email: this.register_data.email,
        password: this.register_data.password,
        password_confirmation: this.register_data.confirm_password,
        user_type_id: 1
      }).then(function (response) {
        console.log("registered successfully");
      })["catch"](function (error) {
        console.log("registered failed");
      });
    },
    forgotPassword: function forgotPassword() {
      axios.post("/password/email", {
        email: this.forgotPw_data.email
      }).then(function (response) {
        console.log("sent successfully");
      })["catch"](function (error) {
        console.log("sending failed");
      });
    },
    changetab: function changetab() {
      document.addEventListener("visibilitychange", function () {
        if (document.hidden) {
          console.log("nagpalitngtab");
        }
      });
    }
  }
});

/***/ }),

/***/ "./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vuetify-loader/lib/loader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/Index.vue?vue&type=style&index=0&id=494d9643&scoped=true&lang=css&":
/*!*************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader??ref--6-1!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--6-2!./node_modules/vuetify-loader/lib/loader.js??ref--11-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/Index.vue?vue&type=style&index=0&id=494d9643&scoped=true&lang=css& ***!
  \*************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports
exports.push([module.i, "@import url(https://fonts.googleapis.com/css2?family=Poppins&display=swap);", ""]);
exports.push([module.i, "@import url(https://fonts.googleapis.com/css2?family=Open+Sans:wght@600&display=swap);", ""]);
exports.push([module.i, "@import url(https://fonts.googleapis.com/css2?family=Open+Sans:wght@600;800&display=swap);", ""]);

// module
exports.push([module.i, "\n.font-body[data-v-494d9643] {\r\n    font-family: \"Poppins\", sans-serif;\n}\n.font-title[data-v-494d9643] {\r\n    font-family: \"Padauk\", sans-serif;\n}\na[data-v-494d9643] {\r\n    text-decoration: none;\n}\n.input-login[data-v-494d9643] {\r\n    width: 400px;\n}\n.input-register[data-v-494d9643] {\r\n    width: 350px;\n}\n.signin[data-v-494d9643] {\r\n    width: 300px;\n}\n.template[data-v-494d9643] {\r\n    background-color: #f5f5f5;\n}\n.register-title[data-v-494d9643] {\r\n    font-family: \"Open Sans\", sans-serif;\r\n    font-size: 2rem;\r\n    font-weight: 800;\r\n    color: #4f46e5;\n}\nul[data-v-494d9643] {\r\n    list-style-type: none;\n}\r\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vuetify-loader/lib/loader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/Index.vue?vue&type=style&index=0&id=494d9643&scoped=true&lang=css&":
/*!*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader!./node_modules/css-loader??ref--6-1!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--6-2!./node_modules/vuetify-loader/lib/loader.js??ref--11-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/Index.vue?vue&type=style&index=0&id=494d9643&scoped=true&lang=css& ***!
  \*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../node_modules/css-loader??ref--6-1!../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../node_modules/postcss-loader/src??ref--6-2!../../../node_modules/vuetify-loader/lib/loader.js??ref--11-0!../../../node_modules/vue-loader/lib??vue-loader-options!./Index.vue?vue&type=style&index=0&id=494d9643&scoped=true&lang=css& */ "./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vuetify-loader/lib/loader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/Index.vue?vue&type=style&index=0&id=494d9643&scoped=true&lang=css&");

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(/*! ../../../node_modules/style-loader/lib/addStyles.js */ "./node_modules/style-loader/lib/addStyles.js")(content, options);

if(content.locals) module.exports = content.locals;

if(false) {}

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vuetify-loader/lib/loader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/Index.vue?vue&type=template&id=494d9643&scoped=true&":
/*!**********************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vuetify-loader/lib/loader.js??ref--11-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/Index.vue?vue&type=template&id=494d9643&scoped=true& ***!
  \**********************************************************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    { staticClass: "template fill-height font-body" },
    [
      _c(
        "v-container",
        { staticClass: "mt-12", attrs: { justify: "center" } },
        [
          _c(
            "div",
            { staticClass: "text-center" },
            [
              _c("img", {
                attrs: { src: __webpack_require__(/*! ../../assets/img/vixam_logo.png */ "./resources/assets/img/vixam_logo.png") }
              }),
              _vm._v(" "),
              _c("h1", { staticClass: "mt-3 mb-2 for-title" }, [
                _vm._v("Sign in to your account")
              ]),
              _vm._v(" "),
              _c("span", { staticClass: "grey--text text--darken-1" }, [
                _vm._v("Or")
              ]),
              _vm._v(" "),
              _c(
                "v-dialog",
                {
                  attrs: { persistent: "", "max-width": "550" },
                  scopedSlots: _vm._u([
                    {
                      key: "activator",
                      fn: function(ref) {
                        var on = ref.on
                        var attrs = ref.attrs
                        return [
                          _c(
                            "span",
                            _vm._g(
                              _vm._b(
                                { staticClass: "indigo--text" },
                                "span",
                                attrs,
                                false
                              ),
                              on
                            ),
                            [_vm._v("create your own account")]
                          )
                        ]
                      }
                    }
                  ]),
                  model: {
                    value: _vm.registerDialog,
                    callback: function($$v) {
                      _vm.registerDialog = $$v
                    },
                    expression: "registerDialog"
                  }
                },
                [
                  _vm._v(" "),
                  _c(
                    "v-card",
                    { staticClass: "register-card font-body" },
                    [
                      _c(
                        "v-card-title",
                        { staticClass: "pl-8 pr-8 pt-8 justify-center" },
                        [
                          _c(
                            "span",
                            {
                              staticClass:
                                "text-center text-uppercase register-title"
                            },
                            [_vm._v("Register Form")]
                          )
                        ]
                      ),
                      _vm._v(" "),
                      _c("v-card-text", [
                        _c(
                          "div",
                          { staticClass: "ml-8 mr-8" },
                          [
                            _c(
                              "v-row",
                              [
                                _c(
                                  "v-col",
                                  [
                                    _c(
                                      "label",
                                      {
                                        staticClass:
                                          "text-md-body-1 register-input",
                                        attrs: { for: "first-name" }
                                      },
                                      [
                                        _vm._v(
                                          "\n                                        First Name"
                                        )
                                      ]
                                    ),
                                    _vm._v(" "),
                                    _c("v-text-field", {
                                      attrs: {
                                        outlined: "",
                                        clearable: "",
                                        id: "first-name"
                                      },
                                      model: {
                                        value: _vm.register_data.first_name,
                                        callback: function($$v) {
                                          _vm.$set(
                                            _vm.register_data,
                                            "first_name",
                                            $$v
                                          )
                                        },
                                        expression: "register_data.first_name"
                                      }
                                    })
                                  ],
                                  1
                                ),
                                _vm._v(" "),
                                _c(
                                  "v-col",
                                  [
                                    _c(
                                      "label",
                                      {
                                        staticClass:
                                          "text-md-body-1 register-input",
                                        attrs: { for: "last-name" }
                                      },
                                      [
                                        _vm._v(
                                          "\n                                        Last Name"
                                        )
                                      ]
                                    ),
                                    _vm._v(" "),
                                    _c("v-text-field", {
                                      attrs: {
                                        outlined: "",
                                        clearable: "",
                                        id: "last-name"
                                      },
                                      model: {
                                        value: _vm.register_data.last_name,
                                        callback: function($$v) {
                                          _vm.$set(
                                            _vm.register_data,
                                            "last_name",
                                            $$v
                                          )
                                        },
                                        expression: "register_data.last_name"
                                      }
                                    })
                                  ],
                                  1
                                )
                              ],
                              1
                            )
                          ],
                          1
                        ),
                        _vm._v(" "),
                        _c(
                          "div",
                          { staticClass: "ml-8 mr-8" },
                          [
                            _c(
                              "label",
                              {
                                staticClass: "text-md-body-1",
                                attrs: { for: "register-email" }
                              },
                              [
                                _vm._v(
                                  "\n                                Email Address"
                                )
                              ]
                            ),
                            _vm._v(" "),
                            _c("v-text-field", {
                              attrs: {
                                outlined: "",
                                "prepend-inner-icon": "mdi-email-outline",
                                clearable: "",
                                id: "register-email"
                              },
                              model: {
                                value: _vm.register_data.email,
                                callback: function($$v) {
                                  _vm.$set(_vm.register_data, "email", $$v)
                                },
                                expression: "register_data.email"
                              }
                            })
                          ],
                          1
                        ),
                        _vm._v(" "),
                        _c(
                          "div",
                          { staticClass: "ml-8 mr-8" },
                          [
                            _c(
                              "v-row",
                              [
                                _c(
                                  "v-col",
                                  [
                                    _c(
                                      "label",
                                      {
                                        staticClass:
                                          "text-md-body-1 register-input",
                                        attrs: { for: "register-password" }
                                      },
                                      [
                                        _vm._v(
                                          "\n                                        Password"
                                        )
                                      ]
                                    ),
                                    _vm._v(" "),
                                    _c("v-text-field", {
                                      attrs: {
                                        outlined: "",
                                        clearable: "",
                                        "prepend-inner-icon": "mdi-key-variant",
                                        id: "register-password"
                                      },
                                      model: {
                                        value: _vm.register_data.password,
                                        callback: function($$v) {
                                          _vm.$set(
                                            _vm.register_data,
                                            "password",
                                            $$v
                                          )
                                        },
                                        expression: "register_data.password"
                                      }
                                    })
                                  ],
                                  1
                                ),
                                _vm._v(" "),
                                _c(
                                  "v-col",
                                  [
                                    _c(
                                      "label",
                                      {
                                        staticClass:
                                          "text-md-body-1 register-input",
                                        attrs: {
                                          for: "register-confirm-password"
                                        }
                                      },
                                      [
                                        _vm._v(
                                          "\n                                        Confirm Password"
                                        )
                                      ]
                                    ),
                                    _vm._v(" "),
                                    _c("v-text-field", {
                                      attrs: {
                                        outlined: "",
                                        clearable: "",
                                        "prepend-inner-icon": "mdi-key-variant",
                                        id: "register-confirm-password"
                                      },
                                      model: {
                                        value:
                                          _vm.register_data.confirm_password,
                                        callback: function($$v) {
                                          _vm.$set(
                                            _vm.register_data,
                                            "confirm_password",
                                            $$v
                                          )
                                        },
                                        expression:
                                          "\n                                            register_data.confirm_password\n                                        "
                                      }
                                    })
                                  ],
                                  1
                                )
                              ],
                              1
                            )
                          ],
                          1
                        )
                      ]),
                      _vm._v(" "),
                      _c(
                        "v-card-actions",
                        [
                          _c("v-spacer"),
                          _vm._v(" "),
                          _c(
                            "v-btn",
                            {
                              staticClass: "text-uppercase",
                              attrs: { color: "green darken-1", text: "" },
                              on: { click: _vm.register }
                            },
                            [
                              _vm._v(
                                "\n                            Register\n                        "
                              )
                            ]
                          ),
                          _vm._v(" "),
                          _c(
                            "v-btn",
                            {
                              staticClass: "text-uppercase",
                              attrs: { color: "red darken-1", text: "" },
                              on: {
                                click: function($event) {
                                  _vm.registerDialog = false
                                }
                              }
                            },
                            [
                              _vm._v(
                                "\n                            Close\n                        "
                              )
                            ]
                          )
                        ],
                        1
                      )
                    ],
                    1
                  )
                ],
                1
              )
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "v-card",
            { staticClass: "mt-5 mx-auto", attrs: { width: "500" } },
            [
              _c(
                "v-card-text",
                [
                  _c(
                    "div",
                    { staticClass: "ml-8 mr-8 pt-10" },
                    [
                      _c(
                        "label",
                        {
                          staticClass: "text-md-body-1",
                          attrs: { for: "email" }
                        },
                        [_vm._v("\n                        Email Address")]
                      ),
                      _vm._v(" "),
                      _c("v-text-field", {
                        staticClass: "input-login",
                        attrs: {
                          solo: "",
                          "prepend-inner-icon": "mdi-email-outline",
                          clearable: "",
                          id: "email"
                        },
                        model: {
                          value: _vm.login_data.email,
                          callback: function($$v) {
                            _vm.$set(_vm.login_data, "email", $$v)
                          },
                          expression: "login_data.email"
                        }
                      }),
                      _vm._v(" "),
                      _c(
                        "label",
                        {
                          staticClass: "text-md-body-1",
                          attrs: { for: "password" }
                        },
                        [_vm._v("\n                        Password")]
                      ),
                      _vm._v(" "),
                      _c("v-text-field", {
                        staticClass: "input-group--focused input-login",
                        attrs: {
                          solo: "",
                          id: "password",
                          "append-icon": _vm.showPassword
                            ? "mdi-eye"
                            : "mdi-eye-off",
                          rules: [_vm.rules.required, _vm.rules.min],
                          type: _vm.showPassword ? "text" : "password",
                          name: "input-10-2",
                          hint: "At least 8 characters",
                          "prepend-inner-icon": "mdi-key-variant"
                        },
                        on: {
                          "click:append": function($event) {
                            _vm.showPassword = !_vm.showPassword
                          }
                        },
                        model: {
                          value: _vm.login_data.password,
                          callback: function($$v) {
                            _vm.$set(_vm.login_data, "password", $$v)
                          },
                          expression: "login_data.password"
                        }
                      }),
                      _vm._v(" "),
                      _c(
                        "div",
                        { staticClass: "text-right mr-5" },
                        [
                          _c(
                            "v-dialog",
                            {
                              attrs: { persistent: "", "max-width": "550" },
                              scopedSlots: _vm._u([
                                {
                                  key: "activator",
                                  fn: function(ref) {
                                    var on = ref.on
                                    var attrs = ref.attrs
                                    return [
                                      _c(
                                        "span",
                                        _vm._g(
                                          _vm._b(
                                            { staticClass: "indigo--text" },
                                            "span",
                                            attrs,
                                            false
                                          ),
                                          on
                                        ),
                                        [_vm._v("Forgot your password?")]
                                      )
                                    ]
                                  }
                                }
                              ]),
                              model: {
                                value: _vm.forgotPwDialog,
                                callback: function($$v) {
                                  _vm.forgotPwDialog = $$v
                                },
                                expression: "forgotPwDialog"
                              }
                            },
                            [
                              _vm._v(" "),
                              _c(
                                "v-card",
                                { staticClass: "register-card font-body" },
                                [
                                  _c(
                                    "v-card-title",
                                    {
                                      staticClass:
                                        "pl-8 pr-8 pt-8 justify-center"
                                    },
                                    [
                                      _c(
                                        "span",
                                        {
                                          staticClass:
                                            "text-center text-uppercase register-title"
                                        },
                                        [_vm._v("Reset Password")]
                                      )
                                    ]
                                  ),
                                  _vm._v(" "),
                                  _c("v-card-text", [
                                    _c(
                                      "div",
                                      { staticClass: "ml-8 mr-8" },
                                      [
                                        _c(
                                          "label",
                                          {
                                            staticClass: "text-md-body-1",
                                            attrs: { for: "register-email" }
                                          },
                                          [
                                            _vm._v(
                                              "\n                                            Email Address"
                                            )
                                          ]
                                        ),
                                        _vm._v(" "),
                                        _c("v-text-field", {
                                          attrs: {
                                            outlined: "",
                                            "prepend-inner-icon":
                                              "mdi-email-outline",
                                            clearable: "",
                                            id: "register-email"
                                          },
                                          model: {
                                            value: _vm.forgotPw_data.email,
                                            callback: function($$v) {
                                              _vm.$set(
                                                _vm.forgotPw_data,
                                                "email",
                                                $$v
                                              )
                                            },
                                            expression: "forgotPw_data.email"
                                          }
                                        })
                                      ],
                                      1
                                    )
                                  ]),
                                  _vm._v(" "),
                                  _c(
                                    "v-card-actions",
                                    [
                                      _c("v-spacer"),
                                      _vm._v(" "),
                                      _c(
                                        "v-btn",
                                        {
                                          staticClass: "text-uppercase",
                                          attrs: {
                                            color: "green darken-1",
                                            text: ""
                                          },
                                          on: { click: _vm.forgotPassword }
                                        },
                                        [
                                          _vm._v(
                                            "\n                                        Send Reset PW\n                                    "
                                          )
                                        ]
                                      ),
                                      _vm._v(" "),
                                      _c(
                                        "v-btn",
                                        {
                                          staticClass: "text-uppercase",
                                          attrs: {
                                            color: "red darken-1",
                                            text: ""
                                          },
                                          on: {
                                            click: function($event) {
                                              _vm.forgotPwDialog = false
                                            }
                                          }
                                        },
                                        [
                                          _vm._v(
                                            "\n                                        Close\n                                    "
                                          )
                                        ]
                                      )
                                    ],
                                    1
                                  )
                                ],
                                1
                              )
                            ],
                            1
                          )
                        ],
                        1
                      )
                    ],
                    1
                  ),
                  _vm._v(" "),
                  _c(
                    "div",
                    { staticClass: "text-center mt-2" },
                    [
                      _c("div", [
                        _c(
                          "ul",
                          _vm._l(_vm.validationError, function(valErr) {
                            return _c(
                              "li",
                              { key: valErr.id, staticClass: "red--text" },
                              [
                                _vm._v(
                                  "\n                                " +
                                    _vm._s(valErr) +
                                    "\n                            "
                                )
                              ]
                            )
                          }),
                          0
                        )
                      ]),
                      _vm._v(" "),
                      _c(
                        "v-btn",
                        {
                          staticClass: "signin pr-12 pl-12",
                          attrs: {
                            depressed: "",
                            color: "primary",
                            loading: _vm.loginLoading
                          },
                          on: { click: _vm.login }
                        },
                        [_vm._v("Sign in")]
                      )
                    ],
                    1
                  ),
                  _vm._v(" "),
                  _c(
                    "v-row",
                    {
                      staticClass: "pr-12 pl-12 mt-5",
                      attrs: { align: "center" }
                    },
                    [
                      _c("v-divider"),
                      _vm._v(" "),
                      _c("span", { staticClass: "pr-3 pl-3 text-md-body-1" }, [
                        _vm._v("Or continue with")
                      ]),
                      _vm._v(" "),
                      _c("v-divider")
                    ],
                    1
                  ),
                  _vm._v(" "),
                  _c(
                    "div",
                    { staticClass: "mt-5 pr-12 pl-12 mb-4" },
                    [
                      _c(
                        "v-btn",
                        { staticClass: "ml-3 pr-10 pl-10" },
                        [_c("v-icon", [_vm._v("mdi-facebook")])],
                        1
                      ),
                      _vm._v(" "),
                      _c(
                        "v-btn",
                        { staticClass: "ml-3 mr-3 pr-10 pl-10" },
                        [_c("v-icon", [_vm._v("mdi-twitter")])],
                        1
                      ),
                      _vm._v(" "),
                      _c(
                        "v-btn",
                        { staticClass: "pr-10 pl-10" },
                        [_c("v-icon", [_vm._v("mdi-github")])],
                        1
                      )
                    ],
                    1
                  )
                ],
                1
              )
            ],
            1
          )
        ],
        1
      )
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/views/Index.vue":
/*!**************************************!*\
  !*** ./resources/js/views/Index.vue ***!
  \**************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Index_vue_vue_type_template_id_494d9643_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Index.vue?vue&type=template&id=494d9643&scoped=true& */ "./resources/js/views/Index.vue?vue&type=template&id=494d9643&scoped=true&");
/* harmony import */ var _Index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Index.vue?vue&type=script&lang=js& */ "./resources/js/views/Index.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _Index_vue_vue_type_style_index_0_id_494d9643_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./Index.vue?vue&type=style&index=0&id=494d9643&scoped=true&lang=css& */ "./resources/js/views/Index.vue?vue&type=style&index=0&id=494d9643&scoped=true&lang=css&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");
/* harmony import */ var _node_modules_vuetify_loader_lib_runtime_installComponents_js__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../../../node_modules/vuetify-loader/lib/runtime/installComponents.js */ "./node_modules/vuetify-loader/lib/runtime/installComponents.js");
/* harmony import */ var _node_modules_vuetify_loader_lib_runtime_installComponents_js__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_node_modules_vuetify_loader_lib_runtime_installComponents_js__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var vuetify_lib_components_VBtn__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! vuetify/lib/components/VBtn */ "./node_modules/vuetify/lib/components/VBtn/index.js");
/* harmony import */ var vuetify_lib_components_VCard__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! vuetify/lib/components/VCard */ "./node_modules/vuetify/lib/components/VCard/index.js");
/* harmony import */ var vuetify_lib_components_VGrid__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! vuetify/lib/components/VGrid */ "./node_modules/vuetify/lib/components/VGrid/index.js");
/* harmony import */ var vuetify_lib_components_VDialog__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! vuetify/lib/components/VDialog */ "./node_modules/vuetify/lib/components/VDialog/index.js");
/* harmony import */ var vuetify_lib_components_VDivider__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! vuetify/lib/components/VDivider */ "./node_modules/vuetify/lib/components/VDivider/index.js");
/* harmony import */ var vuetify_lib_components_VIcon__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! vuetify/lib/components/VIcon */ "./node_modules/vuetify/lib/components/VIcon/index.js");
/* harmony import */ var vuetify_lib_components_VTextField__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(/*! vuetify/lib/components/VTextField */ "./node_modules/vuetify/lib/components/VTextField/index.js");






/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _Index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Index_vue_vue_type_template_id_494d9643_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Index_vue_vue_type_template_id_494d9643_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "494d9643",
  null
  
)

/* vuetify-loader */














_node_modules_vuetify_loader_lib_runtime_installComponents_js__WEBPACK_IMPORTED_MODULE_4___default()(component, {VBtn: vuetify_lib_components_VBtn__WEBPACK_IMPORTED_MODULE_5__["VBtn"],VCard: vuetify_lib_components_VCard__WEBPACK_IMPORTED_MODULE_6__["VCard"],VCardActions: vuetify_lib_components_VCard__WEBPACK_IMPORTED_MODULE_6__["VCardActions"],VCardText: vuetify_lib_components_VCard__WEBPACK_IMPORTED_MODULE_6__["VCardText"],VCardTitle: vuetify_lib_components_VCard__WEBPACK_IMPORTED_MODULE_6__["VCardTitle"],VCol: vuetify_lib_components_VGrid__WEBPACK_IMPORTED_MODULE_7__["VCol"],VContainer: vuetify_lib_components_VGrid__WEBPACK_IMPORTED_MODULE_7__["VContainer"],VDialog: vuetify_lib_components_VDialog__WEBPACK_IMPORTED_MODULE_8__["VDialog"],VDivider: vuetify_lib_components_VDivider__WEBPACK_IMPORTED_MODULE_9__["VDivider"],VIcon: vuetify_lib_components_VIcon__WEBPACK_IMPORTED_MODULE_10__["VIcon"],VRow: vuetify_lib_components_VGrid__WEBPACK_IMPORTED_MODULE_7__["VRow"],VSpacer: vuetify_lib_components_VGrid__WEBPACK_IMPORTED_MODULE_7__["VSpacer"],VTextField: vuetify_lib_components_VTextField__WEBPACK_IMPORTED_MODULE_11__["VTextField"]})


/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/views/Index.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/views/Index.vue?vue&type=script&lang=js&":
/*!***************************************************************!*\
  !*** ./resources/js/views/Index.vue?vue&type=script&lang=js& ***!
  \***************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vuetify_loader_lib_loader_js_ref_11_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vuetify-loader/lib/loader.js??ref--11-0!../../../node_modules/vue-loader/lib??vue-loader-options!./Index.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vuetify-loader/lib/loader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/Index.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vuetify_loader_lib_loader_js_ref_11_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/views/Index.vue?vue&type=style&index=0&id=494d9643&scoped=true&lang=css&":
/*!***********************************************************************************************!*\
  !*** ./resources/js/views/Index.vue?vue&type=style&index=0&id=494d9643&scoped=true&lang=css& ***!
  \***********************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vuetify_loader_lib_loader_js_ref_11_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_style_index_0_id_494d9643_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/style-loader!../../../node_modules/css-loader??ref--6-1!../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../node_modules/postcss-loader/src??ref--6-2!../../../node_modules/vuetify-loader/lib/loader.js??ref--11-0!../../../node_modules/vue-loader/lib??vue-loader-options!./Index.vue?vue&type=style&index=0&id=494d9643&scoped=true&lang=css& */ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vuetify-loader/lib/loader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/Index.vue?vue&type=style&index=0&id=494d9643&scoped=true&lang=css&");
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vuetify_loader_lib_loader_js_ref_11_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_style_index_0_id_494d9643_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vuetify_loader_lib_loader_js_ref_11_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_style_index_0_id_494d9643_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vuetify_loader_lib_loader_js_ref_11_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_style_index_0_id_494d9643_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__) if(["default"].indexOf(__WEBPACK_IMPORT_KEY__) < 0) (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vuetify_loader_lib_loader_js_ref_11_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_style_index_0_id_494d9643_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));
 /* harmony default export */ __webpack_exports__["default"] = (_node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vuetify_loader_lib_loader_js_ref_11_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_style_index_0_id_494d9643_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0___default.a); 

/***/ }),

/***/ "./resources/js/views/Index.vue?vue&type=template&id=494d9643&scoped=true&":
/*!*********************************************************************************!*\
  !*** ./resources/js/views/Index.vue?vue&type=template&id=494d9643&scoped=true& ***!
  \*********************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vuetify_loader_lib_loader_js_ref_11_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_template_id_494d9643_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vuetify-loader/lib/loader.js??ref--11-0!../../../node_modules/vue-loader/lib??vue-loader-options!./Index.vue?vue&type=template&id=494d9643&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vuetify-loader/lib/loader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/Index.vue?vue&type=template&id=494d9643&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vuetify_loader_lib_loader_js_ref_11_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_template_id_494d9643_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vuetify_loader_lib_loader_js_ref_11_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_template_id_494d9643_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);