import React from "react";
import {PageContainer} from "./pages/PageContainer.js";
import {createRoot} from "react-dom/client";

function App() {
  return (
    <PageContainer />
  )
}

const root = createRoot(document.querySelector('#root'))
root.render(<App />)
