webpackJsonp([9],{

/***/ 572:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});
exports.default = Orders;

var _react = __webpack_require__(0);

var _react2 = _interopRequireDefault(_react);

var _SectionTitle = __webpack_require__(28);

var _SectionTitle2 = _interopRequireDefault(_SectionTitle);

var _GlobalContext = __webpack_require__(13);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function Orders() {
    (0, _react.useEffect)(function () {
        window.scrollTo(0, 0);
    }, []);

    var statusStyle = {
        padding: ".25rem .5rem",
        borderRadius: "20px",
        fontSize: "11px",
        fontWeight: "600",
        textTransform: "uppercase"
    };
    return _react2.default.createElement(
        _react2.default.Fragment,
        null,
        _react2.default.createElement(_SectionTitle2.default, { title: 'My Orders' }),
        _react2.default.createElement(
            'div',
            { className: 'sidenav_main_content' },
            _react2.default.createElement(
                'table',
                { className: 'table table-borderless table-striped' },
                _react2.default.createElement(
                    'thead',
                    null,
                    _react2.default.createElement(
                        'tr',
                        null,
                        _react2.default.createElement(
                            'th',
                            null,
                            'Order No'
                        ),
                        _react2.default.createElement(
                            'th',
                            null,
                            'Date'
                        ),
                        _react2.default.createElement(
                            'th',
                            null,
                            'Payment Status'
                        ),
                        _react2.default.createElement(
                            'th',
                            null,
                            'Fulfillment Status'
                        ),
                        _react2.default.createElement(
                            'th',
                            null,
                            'Total'
                        )
                    )
                ),
                _react2.default.createElement(
                    'tbody',
                    null,
                    _react2.default.createElement(
                        'tr',
                        null,
                        _react2.default.createElement(
                            'td',
                            null,
                            '2343'
                        ),
                        _react2.default.createElement(
                            'td',
                            null,
                            '21 Aug 2020'
                        ),
                        _react2.default.createElement(
                            'td',
                            null,
                            'Paid'
                        ),
                        _react2.default.createElement(
                            'td',
                            null,
                            _react2.default.createElement(
                                'span',
                                { style: Object.assign({ backgroundColor: "yellow" }, statusStyle) },
                                'ONGOING'
                            )
                        ),
                        _react2.default.createElement(
                            'td',
                            null,
                            'Rs.23445'
                        )
                    ),
                    _react2.default.createElement(
                        'tr',
                        null,
                        _react2.default.createElement(
                            'td',
                            null,
                            '23343'
                        ),
                        _react2.default.createElement(
                            'td',
                            null,
                            '25 Aug 2020'
                        ),
                        _react2.default.createElement(
                            'td',
                            null,
                            'Pending'
                        ),
                        _react2.default.createElement(
                            'td',
                            null,
                            _react2.default.createElement(
                                'span',
                                { style: Object.assign({ backgroundColor: "red", color: "#fff" }, statusStyle) },
                                'cancelled'
                            )
                        ),
                        _react2.default.createElement(
                            'td',
                            null,
                            'Rs.23445'
                        )
                    ),
                    _react2.default.createElement(
                        'tr',
                        null,
                        _react2.default.createElement(
                            'td',
                            null,
                            '2343'
                        ),
                        _react2.default.createElement(
                            'td',
                            null,
                            '21 Aug 2023'
                        ),
                        _react2.default.createElement(
                            'td',
                            null,
                            'Paid'
                        ),
                        _react2.default.createElement(
                            'td',
                            null,
                            _react2.default.createElement(
                                'span',
                                { style: Object.assign({ backgroundColor: "green", color: "#fff" }, statusStyle) },
                                'delivered'
                            )
                        ),
                        _react2.default.createElement(
                            'td',
                            null,
                            'Rs.234434'
                        )
                    )
                )
            )
        )
    );
}

/***/ })

});