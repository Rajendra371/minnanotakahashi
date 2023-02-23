webpackJsonp([8],{

/***/ 566:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});
exports.default = ProfileInfo;

var _react = __webpack_require__(0);

var _react2 = _interopRequireDefault(_react);

var _SectionTitle = __webpack_require__(28);

var _SectionTitle2 = _interopRequireDefault(_SectionTitle);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function ProfileInfo() {
    (0, _react.useEffect)(function () {
        window.scrollTo(0, 0);
    }, []);
    console.log("rendered");
    return _react2.default.createElement(
        _react2.default.Fragment,
        null,
        _react2.default.createElement(_SectionTitle2.default, { title: 'Personal Info' }),
        _react2.default.createElement(
            'div',
            { className: 'sidenav_main_content' },
            _react2.default.createElement(
                'form',
                null,
                _react2.default.createElement(
                    'div',
                    { className: 'form-group' },
                    _react2.default.createElement(
                        'label',
                        { className: 'col-12 col-md-2' },
                        'Full Name'
                    ),
                    _react2.default.createElement(
                        'div',
                        { className: 'col-12 col-md-10 col-lg-9' },
                        _react2.default.createElement('input', { className: 'col-md-12 col-lg-10', type: 'text', placeholder: 'Enter your Full name' })
                    )
                ),
                _react2.default.createElement(
                    'div',
                    { className: 'form-group' },
                    _react2.default.createElement(
                        'label',
                        { className: 'col-12 col-md-2' },
                        'Email'
                    ),
                    _react2.default.createElement(
                        'div',
                        { className: 'col-12 col-md-10 col-lg-9' },
                        _react2.default.createElement('input', { className: 'col-md-12 col-lg-10', type: 'email', placeholder: 'Enter your email', disabled: true })
                    )
                ),
                _react2.default.createElement(
                    'div',
                    { className: 'form-group' },
                    _react2.default.createElement(
                        'label',
                        { className: 'col-12 col-md-2' },
                        'Mobile'
                    ),
                    _react2.default.createElement(
                        'div',
                        { className: 'col-12 col-md-10 col-lg-9' },
                        _react2.default.createElement('input', { className: 'col-md-12 col-lg-10', type: 'text', placeholder: 'Number', disabled: true })
                    )
                ),
                _react2.default.createElement(
                    'div',
                    { className: 'form-group' },
                    _react2.default.createElement(
                        'label',
                        { className: 'col-12 col-md-2' },
                        'DOB:'
                    ),
                    _react2.default.createElement(
                        'div',
                        { className: 'col-12 col-md-10 col-lg-9 ' },
                        _react2.default.createElement(
                            'div',
                            { className: 'row' },
                            _react2.default.createElement(
                                'div',
                                { className: 'col-md-5 col-lg-5' },
                                _react2.default.createElement(
                                    'select',
                                    { className: 'nice-select' },
                                    _react2.default.createElement(
                                        'option',
                                        null,
                                        'Month'
                                    ),
                                    _react2.default.createElement(
                                        'option',
                                        null,
                                        'Province No.2'
                                    ),
                                    _react2.default.createElement(
                                        'option',
                                        null,
                                        'Province No.3'
                                    ),
                                    _react2.default.createElement(
                                        'option',
                                        null,
                                        'Province No.4'
                                    ),
                                    _react2.default.createElement(
                                        'option',
                                        null,
                                        'Province No.5'
                                    ),
                                    _react2.default.createElement(
                                        'option',
                                        null,
                                        'Province No.6'
                                    ),
                                    _react2.default.createElement(
                                        'option',
                                        null,
                                        'Province No.7'
                                    )
                                )
                            ),
                            _react2.default.createElement(
                                'div',
                                { className: 'col-md-3 col-lg-2 my-2 my-md-0 px-md-0' },
                                _react2.default.createElement(
                                    'select',
                                    { className: 'nice-select' },
                                    _react2.default.createElement(
                                        'option',
                                        null,
                                        'Day'
                                    ),
                                    _react2.default.createElement(
                                        'option',
                                        null,
                                        'Province No.2'
                                    ),
                                    _react2.default.createElement(
                                        'option',
                                        null,
                                        'Province No.3'
                                    ),
                                    _react2.default.createElement(
                                        'option',
                                        null,
                                        'Province No.4'
                                    ),
                                    _react2.default.createElement(
                                        'option',
                                        null,
                                        'Province No.5'
                                    ),
                                    _react2.default.createElement(
                                        'option',
                                        null,
                                        'Province No.6'
                                    ),
                                    _react2.default.createElement(
                                        'option',
                                        null,
                                        'Province No.7'
                                    )
                                )
                            ),
                            _react2.default.createElement(
                                'div',
                                { className: 'col-md-4 col-lg-3' },
                                _react2.default.createElement(
                                    'select',
                                    { className: 'nice-select' },
                                    _react2.default.createElement(
                                        'option',
                                        null,
                                        'Year'
                                    ),
                                    _react2.default.createElement(
                                        'option',
                                        null,
                                        'Province No.2'
                                    ),
                                    _react2.default.createElement(
                                        'option',
                                        null,
                                        'Province No.3'
                                    ),
                                    _react2.default.createElement(
                                        'option',
                                        null,
                                        'Province No.4'
                                    ),
                                    _react2.default.createElement(
                                        'option',
                                        null,
                                        'Province No.5'
                                    ),
                                    _react2.default.createElement(
                                        'option',
                                        null,
                                        'Province No.6'
                                    ),
                                    _react2.default.createElement(
                                        'option',
                                        null,
                                        'Province No.7'
                                    )
                                )
                            )
                        )
                    )
                ),
                _react2.default.createElement(
                    'div',
                    { className: 'text-center' },
                    _react2.default.createElement(
                        'button',
                        { className: 'btn ' },
                        'Save'
                    )
                )
            )
        )
    );
}

/***/ })

});