webpackJsonp([5],{

/***/ 567:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});
exports.default = UserSideNav;

var _react = __webpack_require__(0);

var _react2 = _interopRequireDefault(_react);

var _reactRouterDom = __webpack_require__(21);

var _SideNavTitle = __webpack_require__(94);

var _SideNavTitle2 = _interopRequireDefault(_SideNavTitle);

var _GlobalContext = __webpack_require__(13);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function UserSideNav() {
    var _useContext = (0, _react.useContext)(_GlobalContext.GlobalContext),
        wishList = _useContext.wishList;

    return _react2.default.createElement(
        'div',
        { className: 'sidebar' },
        _react2.default.createElement(
            'div',
            { className: 'text-center user_profile' },
            _react2.default.createElement('img', { src: '../../../../../public/images/frontend/user-profile.png', width: 'auto', height: '80' })
        ),
        _react2.default.createElement(
            'div',
            { className: 'sidebar_menu' },
            _react2.default.createElement(_SideNavTitle2.default, { title: 'Profile' }),
            _react2.default.createElement(
                'ul',
                { className: 'sidenav_list' },
                _react2.default.createElement(
                    'li',
                    null,
                    _react2.default.createElement(
                        _reactRouterDom.Link,
                        { to: '/profile/userinfo' },
                        _react2.default.createElement('i', { className: 'ti-user' }),
                        ' Personal Info'
                    )
                ),
                _react2.default.createElement(
                    'li',
                    null,
                    _react2.default.createElement(
                        _reactRouterDom.Link,
                        { to: '/profile/addressinfo' },
                        _react2.default.createElement('i', { className: 'ti-location-arrow' }),
                        'Address (1)'
                    )
                ),
                _react2.default.createElement(
                    'li',
                    null,
                    _react2.default.createElement(
                        _reactRouterDom.Link,
                        { to: '/profile/offers' },
                        _react2.default.createElement('i', { className: 'ti-ticket' }),
                        ' Offers'
                    )
                )
            ),
            _react2.default.createElement(_SideNavTitle2.default, { title: 'Orders' }),
            _react2.default.createElement(
                'ul',
                { className: 'sidenav_list' },
                _react2.default.createElement(
                    'li',
                    null,
                    _react2.default.createElement(
                        _reactRouterDom.Link,
                        { to: '/profile/orders' },
                        _react2.default.createElement('i', { className: 'ti-shopping-cart' }),
                        ' My Orders (3)'
                    )
                ),
                _react2.default.createElement(
                    'li',
                    null,
                    _react2.default.createElement(
                        _reactRouterDom.Link,
                        { to: '/profile/wishlist' },
                        _react2.default.createElement('i', { className: 'ti-heart' }),
                        'My WishList (',
                        wishList.length,
                        ')'
                    )
                )
            ),
            _react2.default.createElement(_SideNavTitle2.default, { title: 'Settings' }),
            _react2.default.createElement(
                'ul',
                { className: 'sidenav_list' },
                _react2.default.createElement(
                    'li',
                    null,
                    _react2.default.createElement(
                        _reactRouterDom.Link,
                        { to: '/profile/changepassword' },
                        _react2.default.createElement('i', { className: 'ti-key' }),
                        ' Change Password'
                    )
                ),
                _react2.default.createElement(
                    'li',
                    null,
                    _react2.default.createElement(
                        _reactRouterDom.Link,
                        { to: '/profile/addressinfo' },
                        _react2.default.createElement('i', { className: 'fa fa-sign-out' }),
                        'Logout'
                    )
                )
            )
        )
    );
}

/***/ })

});