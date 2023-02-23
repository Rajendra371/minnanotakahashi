webpackJsonp([3],{

/***/ 569:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});

var _slicedToArray = function () { function sliceIterator(arr, i) { var _arr = []; var _n = true; var _d = false; var _e = undefined; try { for (var _i = arr[Symbol.iterator](), _s; !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"]) _i["return"](); } finally { if (_d) throw _e; } } return _arr; } return function (arr, i) { if (Array.isArray(arr)) { return arr; } else if (Symbol.iterator in Object(arr)) { return sliceIterator(arr, i); } else { throw new TypeError("Invalid attempt to destructure non-iterable instance"); } }; }();

exports.default = AddressInfo;

var _react = __webpack_require__(0);

var _react2 = _interopRequireDefault(_react);

var _GlobalContext = __webpack_require__(13);

var _SectionTitle = __webpack_require__(28);

var _SectionTitle2 = _interopRequireDefault(_SectionTitle);

var _AddressIndividual = __webpack_require__(570);

var _AddressIndividual2 = _interopRequireDefault(_AddressIndividual);

var _useInputValue = __webpack_require__(275);

var _useInputValue2 = _interopRequireDefault(_useInputValue);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _toConsumableArray(arr) { if (Array.isArray(arr)) { for (var i = 0, arr2 = Array(arr.length); i < arr.length; i++) { arr2[i] = arr[i]; } return arr2; } else { return Array.from(arr); } }

function AddressInfo() {
    var _useContext = (0, _react.useContext)(_GlobalContext.GlobalContext),
        addAddress = _useContext.addAddress;

    var _useState = (0, _react.useState)(1),
        _useState2 = _slicedToArray(_useState, 2),
        address = _useState2[0],
        setAddress = _useState2[1];

    var newAddress = function newAddress() {
        setAddress(address + 1);
    };
    (0, _react.useEffect)(function () {
        window.scrollTo(0, 0);
    }, []);
    var street = (0, _useInputValue2.default)("");
    var street2 = (0, _useInputValue2.default)("");
    var province = (0, _useInputValue2.default)("");
    var district = (0, _useInputValue2.default)("");
    var region = (0, _useInputValue2.default)("");
    var postal = (0, _useInputValue2.default)("");

    var handleSubmit = function handleSubmit(e) {
        e.preventDefault();
        var addressDetail = {
            street: street.value,
            street2: street2.value,
            province: province.value,
            district: district.value,
            region: region.value,
            postal: postal.value
        };
        addAddress(addressDetail);
    };

    return _react2.default.createElement(
        _react2.default.Fragment,
        null,
        _react2.default.createElement(_SectionTitle2.default, { title: 'Address Info' }),
        _react2.default.createElement(
            'div',
            { className: 'sidenav_main_content' },
            _react2.default.createElement(
                'form',
                { onSubmit: handleSubmit },
                [].concat(_toConsumableArray(Array(address))).map(function (k, i) {
                    return _react2.default.createElement(_AddressIndividual2.default, { key: i, number: i + 1, street: street, street2: street2, province: province, district: district, region: region, postal: postal });
                }),
                _react2.default.createElement(
                    'div',
                    { className: 'col-12 d-flex justify-content-between' },
                    _react2.default.createElement(
                        'button',
                        { className: 'add_address', onClick: newAddress },
                        'Add Address'
                    ),
                    _react2.default.createElement(
                        'button',
                        { type: 'submit', className: 'btn ' },
                        'Save'
                    )
                )
            )
        )
    );
}

/***/ }),

/***/ 570:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});

var _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; };

exports.default = AddressIndividual;

var _react = __webpack_require__(0);

var _react2 = _interopRequireDefault(_react);

var _SideNavTitle = __webpack_require__(94);

var _SideNavTitle2 = _interopRequireDefault(_SideNavTitle);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function AddressIndividual(_ref) {
    var number = _ref.number,
        street = _ref.street,
        street2 = _ref.street2,
        province = _ref.province,
        district = _ref.district,
        region = _ref.region,
        postal = _ref.postal;


    return _react2.default.createElement(
        'div',
        { className: 'position-relative mb-2' },
        _react2.default.createElement(_SideNavTitle2.default, { title: 'Address ' + number }),
        _react2.default.createElement(
            'a',
            { className: 'float-right' },
            _react2.default.createElement('i', { className: 'ti-trash ' + (number > 1 ? 'd-block' : 'd-none'), style: { position: "absolute", right: "5%", top: "7%", fontSize: "1.4rem", color: "red", cursor: "pointer" } })
        ),
        _react2.default.createElement(
            'div',
            { className: 'form-group' },
            _react2.default.createElement(
                'label',
                { className: 'col-md-2' },
                'Street Address'
            ),
            _react2.default.createElement(
                'div',
                { className: 'col-md-5' },
                _react2.default.createElement('input', _extends({}, street, { type: 'text', placeholder: '' }))
            ),
            _react2.default.createElement(
                'div',
                { className: 'col-md-5' },
                _react2.default.createElement('input', _extends({}, street2, { type: 'text', placeholder: '' }))
            )
        ),
        _react2.default.createElement(
            'div',
            { className: 'form-group' },
            _react2.default.createElement(
                'label',
                { className: 'col-md-2' },
                'Province'
            ),
            _react2.default.createElement(
                'div',
                { className: 'col-md-4' },
                _react2.default.createElement(
                    'select',
                    _extends({ className: 'nice-select' }, province),
                    _react2.default.createElement(
                        'option',
                        null,
                        'Province No.1'
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
                'label',
                { className: 'col-md-2' },
                'District'
            ),
            _react2.default.createElement(
                'div',
                { className: 'col-md-4' },
                _react2.default.createElement(
                    'select',
                    _extends({ className: 'nice-select' }, district),
                    _react2.default.createElement(
                        'option',
                        null,
                        'Province No.1'
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
        ),
        _react2.default.createElement(
            'div',
            { className: 'form-group' },
            _react2.default.createElement(
                'label',
                { className: 'col-md-2' },
                'Region'
            ),
            _react2.default.createElement(
                'div',
                { className: 'col-md-4' },
                _react2.default.createElement(
                    'select',
                    _extends({ className: 'nice-select' }, region),
                    _react2.default.createElement(
                        'option',
                        null,
                        'Province No.1'
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
                'label',
                { className: 'col-md-2' },
                'Postal Code'
            ),
            _react2.default.createElement(
                'div',
                { className: 'col-md-4' },
                _react2.default.createElement('input', _extends({}, postal, { type: 'text', placeholder: 'Enter Postal/Zip Code' }))
            )
        )
    );
}

/***/ })

});