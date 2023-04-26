import React, {Component} from "react";
import HelloWorld from "./components/helloWorld";
import {createRoot} from "react-dom/client";

class App extends Component {
    render() {
        return (<HelloWorld />)
    }
}

const root = createRoot(document.querySelector('#root'))
root.render(<App />)
