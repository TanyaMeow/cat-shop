import React, {Component} from "react";
import {ContainerPage} from "./pages/containerPage.js";
import {createRoot} from "react-dom/client";

class App extends Component {
    render() {
        return (
          <ContainerPage />
        )
    }
}

const root = createRoot(document.querySelector('#root'))
root.render(<App />)
