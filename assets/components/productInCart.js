import React from "react";

export function ProductInCart(props) {
  return (
    <div className="card_cart" data-id={props.id}>
      <img className="image" src={props.image_path} alt=""/>

        <div className="card_title">

          <p className="description">{props.name} </p>
          <div className="bottom">
            <p className="price">{props.price} ₽</p>
            <button className="delete_item" onClick={() => props.onDeleteProduct(props.id, props.functionUpdate)}>Удалить</button>
          </div>

        </div>
        <div className="quantity">

          <button className="minus">
            <div className="min"></div>
          </button>
          <p className="amount">{props.count}</p>
          <button className="plus">
            <div className="max"></div>
            <div className="max_end"></div>
          </button>

        </div>
    </div>
  )
}
