import React, {
  createContext,
  useReducer,
  useState,
  useEffect,
  useContext,
} from "react";
import AppReducer from "./AppReducer";
import axios from "axios";
// Initial state
const initialState = {

};

// Create context
export const GlobalContext = createContext(initialState);

// Provider component
export const GlobalProvider = ({ children }) => {
  const [state, dispatch] = useReducer(AppReducer, initialState);



  return (
    <GlobalContext.Provider
      value={{
        }}
    >
      {children}
    </GlobalContext.Provider>
  );
};
