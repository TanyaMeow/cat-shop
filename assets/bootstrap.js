import React, {Component} from "react";
import {ShopPage} from "./pages/shopPage.js";
import {createRoot} from "react-dom/client";

class App extends Component {
    render() {
        return (
          <ShopPage />
        )
    }
}

const root = createRoot(document.querySelector('#root'))
root.render(<App />)
