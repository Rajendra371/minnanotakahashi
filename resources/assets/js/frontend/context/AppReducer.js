export default (state, action) => {
  switch (action.type) {
    case "SHOW_CAT_NAV":
      return {
        ...state,
        cartList: action.payload,
      };
    case "SHOW_FROM_CART":
      return {
        ...state,
        cartList: action.payload,
      };
    case "SHOW_FROM_FAV":
      return {
        ...state,
        wishList: action.payload,
      };
    case "DELETE_FROM_CART":
      return {
        ...state,
        cartList: state.cartList.filter(
          (cartitem) => cartitem.id !== action.payload
        ),
      };
    case "ADD_TO_CART":
      return {
        ...state,
        cartList: [action.payload, ...state.cartList],
      };
    case "DELETE_FROM_WISHLIST":
      return {
        ...state,
        wishList: state.wishList.filter(
          (wishitem) => wishitem.id !== action.payload
        ),
      };
    case "ADD_TO_WISHLIST":
      return {
        ...state,
        wishList: [...action.payload],
      };
    case "ADD_ADDRESS": {
      if (!action.payload.checkoutCompleted) {
        window.localStorage.setItem("checkoutCompleted", "NC");
        window.localStorage.setItem(
          "checkoutAddress",
          JSON.stringify(action.payload.address)
        );
      }
      return {
        ...state,
        addressList: { ...action.payload.address },
        checkoutCompleted: action.payload.checkoutCompleted,
      };
    }
    case "ADD_TO_COMPARE":
      return {
        ...state,
        compareList: [action.payload, ...state.compareList],
      };
    case "DELETE_FROM_COMPARE":
      return {
        ...state,
        compareList: state.compareList.filter(
          (compareitem) => compareitem.id !== action.payload
        ),
      };
    case "INCREASE_QTY": {
      let itemToincrease = state.cartList.find(
        (cartitem) => cartitem.id === action.payload
      );
      itemToincrease.qty += 1;
      return {
        ...state,
        itemToincrease,
      };
    }
    case "DECREASE_QTY": {
      let itemTodecrease = state.cartList.find(
        (cartitem) => cartitem.id === action.payload
      );
      if (itemTodecrease.qty > 1) {
        itemTodecrease.qty -= 1;
      }
      return {
        ...state,
        itemTodecrease,
      };
    }

    case "PAYMENT_METHOD": {
      return {
        ...state,
        paymentMethod: [...action.payload],
      };
    }
    case "SET_CURRENCY": {
      return {
        ...state,
        currency: action.payload,
      };
    }
    case "SET_COLORS": {
      return {
        ...state,
        color: action.payload,
      };
    }
    case "SET_SNACKBAR": {
      const {
        snackbarOpen,
        snackbarMessage,
        snackbarType,
        snackbarId,
      } = action;
      return {
        ...state,
        snackbarOpen,
        snackbarType,
        snackbarMessage,
        snackbarId,
      };
    }
    default:
      return state;
  }
};
