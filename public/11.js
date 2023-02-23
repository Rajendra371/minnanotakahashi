webpackJsonp([11],{

/***/ 568:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});
exports.default = ChangePassword;

var _react = __webpack_require__(0);

var _react2 = _interopRequireDefault(_react);

var _SectionTitle = __webpack_require__(28);

var _SectionTitle2 = _interopRequireDefault(_SectionTitle);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function ChangePassword() {
    (0, _react.useEffect)(function () {
        window.scrollTo(0, 0);
    }, []);
    return _react2.default.createElement(
        _react2.default.Fragment,
        null,
        _react2.default.createElement(_SectionTitle2.default, { title: 'Change Password' }),
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
                        { className: 'col-md-3' },
                        'Old Password'
                    ),
                    _react2.default.createElement(
                        'div',
                        { className: 'col-md-9' },
                        _react2.default.createElement('input', { className: 'col-md-10', type: 'text', placeholder: 'Enter old password' })
                    )
                ),
                _react2.default.createElement(
                    'div',
                    { className: 'form-group' },
                    _react2.default.createElement(
                        'label',
                        { className: 'col-md-3' },
                        'New Password'
                    ),
                    _react2.default.createElement(
                        'div',
                        { className: 'col-md-9' },
                        _react2.default.createElement('input', { className: 'col-md-10', type: 'text', placeholder: 'Enter new password' })
                    )
                ),
                _react2.default.createElement(
                    'div',
                    { className: 'form-group' },
                    _react2.default.createElement(
                        'label',
                        { className: 'col-md-3' },
                        'Confirm New Password'
                    ),
                    _react2.default.createElement(
                        'div',
                        { className: 'col-md-9' },
                        _react2.default.createElement('input', { className: 'col-md-10', type: 'text', placeholder: 'Confirm new password' })
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