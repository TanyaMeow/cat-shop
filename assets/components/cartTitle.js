import React, {useContext} from "react";
import {CountContext} from "../Contexts/CountContext";

export function CartTitle() {
  const count = useContext(CountContext);

  return (
    <div className="cart_title">
      <h1 className="cart">Корзина</h1>
      <p className="product">{count} товаров</p>
    </div>
  )
}

