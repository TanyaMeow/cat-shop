import React from "react";

export function CartTitle(props) {
  return (
    <div className="cart_title">
      <h1 className="cart">Корзина</h1>
      <p className="product">{props.count} товаров</p>
    </div>
  )
}

