webpackJsonp([6],{

/***/ 575:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});
exports.default = Summary;

var _react = __webpack_require__(0);

var _react2 = _interopRequireDefault(_react);

var _reactRouterDom = __webpack_require__(21);

var _GlobalContext = __webpack_require__(13);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function Summary() {
    var _useContext = (0, _react.useContext)(_GlobalContext.GlobalContext),
        cartList = _useContext.cartList,
        wishList = _useContext.wishList;

    var cartitem = cartList.map(function (item) {
        return item.img;
    });
    var wishitem = wishList.map(function (item) {
        return item.img;
    });
    return _react2.default.createElement(
        _react2.default.Fragment,
        null,
        _react2.default.createElement(
            'div',
            { className: 'col-12 mb-4' },
            _react2.default.createElement(
                'div',
                { className: 'section-title-one', 'data-title': 'GOOD MORNING' },
                _react2.default.createElement(
                    'h1',
                    null,
                    'Welcome, Username'
                )
            )
        ),
        _react2.default.createElement(
            'div',
            { className: 'user_summary mt-4' },
            _react2.default.createElement(
                'div',
                { className: 'row  ' },
                _react2.default.createElement(
                    'div',
                    { className: 'col-md-4' },
                    _react2.default.createElement(
                        'div',
                        { className: 'card ' },
                        _react2.default.createElement(
                            _reactRouterDom.Link,
                            { to: '/profile/orders' },
                            _react2.default.createElement(
                                'span',
                                { className: 'icon', style: { backgroundColor: "#f0cfd196" } },
                                _react2.default.createElement('i', { style: { color: "#ff0000" }, className: 'ti-dropbox' })
                            ),
                            _react2.default.createElement(
                                'h1',
                                null,
                                '5'
                            ),
                            _react2.default.createElement(
                                'p',
                                { className: 'title' },
                                'Total Orders'
                            ),
                            _react2.default.createElement('hr', null),
                            _react2.default.createElement(
                                'div',
                                { className: 'd-flex align-items-center justify-content-center flex-wrap' },
                                _react2.default.createElement('img', { src: '../../../../../public/images/frontend/product/product-4.jpg', width: '30', height: '30' }),
                                _react2.default.createElement('img', { src: '../../../../../public/images/frontend/product/product-3.jpg', width: '30', height: '30' }),
                                _react2.default.createElement('img', { src: '../../../../../public/images/frontend/product/product-5.jpg', width: '30', height: '30' }),
                                _react2.default.createElement('img', { src: '../../../../../public/images/frontend/product/product-7.jpg', width: '30', height: '30' }),
                                _react2.default.createElement('img', { src: '../../../../../public/images/frontend/product/product-8.jpg', width: '30', height: '30' })
                            )
                        )
                    )
                ),
                _react2.default.createElement(
                    'div',
                    { className: 'col-md-4' },
                    _react2.default.createElement(
                        'div',
                        { className: 'card ' },
                        _react2.default.createElement(
                            _reactRouterDom.Link,
                            { to: '/profile/wishlist' },
                            _react2.default.createElement(
                                'span',
                                { className: 'icon', style: { backgroundColor: "rgb(252 242 188/ 75%)" } },
                                _react2.default.createElement('i', { style: { color: "rgb(245 215 48)" }, className: 'ti-heart' })
                            ),
                            _react2.default.createElement(
                                'h1',
                                null,
                                wishList.length
                            ),
                            _react2.default.createElement(
                                'p',
                                { className: 'title' },
                                'Total in Wishlist'
                            ),
                            _react2.default.createElement('hr', null),
                            _react2.default.createElement(
                                'div',
                                { className: 'd-flex align-items-center justify-content-center flex-wrap' },
                                wishitem.map(function (item, idx) {
                                    return _react2.default.createElement('img', { key: idx, src: '../../../../../public/images/frontend/product/' + item, width: '30', height: '30' });
                                })
                            )
                        )
                    )
                ),
                _react2.default.createElement(
                    'div',
                    { className: 'col-md-4' },
                    _react2.default.createElement(
                        'div',
                        { className: 'card ' },
                        _react2.default.createElement(
                            'span',
                            { className: 'icon', style: { backgroundColor: "rgb(243 186 188 / 50%)" } },
                            _react2.default.createElement('i', { style: { color: "rgb(219 39 48)" }, className: 'ti-shopping-cart' })
                        ),
                        _react2.default.createElement(
                            'h1',
                            null,
                            cartList.length
                        ),
                        _react2.default.createElement(
                            'p',
                            { className: 'title' },
                            'Total in Cart'
                        ),
                        _react2.default.createElement('hr', null),
                        _react2.default.createElement(
                            'div',
                            { className: 'd-flex align-items-center justify-content-center flex-wrap' },
                            cartitem.map(function (item, idx) {
                                return _react2.default.createElement('img', { key: idx, src: '../../../../../public/images/frontend/product/' + item, width: '30', height: '30' });
                            })
                        )
                    )
                )
            )
        )
    );
}

/***/ })

});