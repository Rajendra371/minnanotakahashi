webpackJsonp([4],{

/***/ 571:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});
exports.default = WishList;

var _react = __webpack_require__(0);

var _react2 = _interopRequireDefault(_react);

var _SectionTitle = __webpack_require__(28);

var _SectionTitle2 = _interopRequireDefault(_SectionTitle);

var _GlobalContext = __webpack_require__(13);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function WishList() {
    var _useContext = (0, _react.useContext)(_GlobalContext.GlobalContext),
        wishList = _useContext.wishList,
        deleteFromwishList = _useContext.deleteFromwishList;

    var items = wishList.map(function (wishitem) {
        return _react2.default.createElement(
            'tr',
            { key: wishitem.id },
            _react2.default.createElement(
                'td',
                null,
                _react2.default.createElement('img', { src: '../../../../../../public/images/frontend/product/' + wishitem.img + '.jpg', alt: 'Product', height: '60' })
            ),
            _react2.default.createElement(
                'td',
                null,
                wishitem.id
            ),
            _react2.default.createElement(
                'td',
                null,
                wishitem.product
            ),
            _react2.default.createElement(
                'td',
                null,
                wishitem.price
            ),
            _react2.default.createElement(
                'td',
                null,
                _react2.default.createElement(
                    'a',
                    { onClick: function onClick() {
                            return deleteFromwishList(wishitem.id);
                        }, className: 'remove' },
                    _react2.default.createElement('i', { className: 'fa fa-trash-o' })
                )
            )
        );
    });
    (0, _react.useEffect)(function () {
        window.scrollTo(0, 0);
    }, []);
    return _react2.default.createElement(
        _react2.default.Fragment,
        null,
        _react2.default.createElement(_SectionTitle2.default, { title: 'My WishList' }),
        _react2.default.createElement(
            'div',
            { className: 'sidenav_main_content' },
            _react2.default.createElement(
                'table',
                { className: 'table table-borderless ' },
                _react2.default.createElement(
                    'thead',
                    null,
                    _react2.default.createElement(
                        'tr',
                        null,
                        _react2.default.createElement(
                            'th',
                            null,
                            'Image'
                        ),
                        _react2.default.createElement(
                            'th',
                            null,
                            'Product Id'
                        ),
                        _react2.default.createElement(
                            'th',
                            null,
                            'Product Name'
                        ),
                        _react2.default.createElement(
                            'th',
                            null,
                            'Price'
                        ),
                        _react2.default.createElement(
                            'th',
                            null,
                            'Remove'
                        )
                    )
                ),
                _react2.default.createElement(
                    'tbody',
                    null,
                    items.length ? items : _react2.default.createElement(
                        'tr',
                        null,
                        _react2.default.createElement(
                            'td',
                            { align: 'center', colSpan: '5' },
                            'No products in your wishlist'
                        )
                    )
                )
            )
        )
    );
}

/***/ })

});