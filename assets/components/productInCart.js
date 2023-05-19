import React, {useContext} from "react";
import {DeleteContext} from "../Contexts/DeleteContext";

export function ProductInCart(props) {
  const deleteProduct = useContext(DeleteContext);

  return (
    <div className="card_cart" data-id={props.id}>
      <img className="image" src={props.image_path} alt=""/>

        <div className="card_title">

          <p className="description">{props.name} </p>
          <div className="bottom">
            <p className="price">{props.price} ₽</p>
            <button className="delete_item" onClick={() => deleteProduct(props.id, props.functionUpdate)}>Удалить</button>
          </div>

        </div>
        <div className="quantity">

          <button className="minus" onClick={() => {
            props.functionUpdate();
          }}>
            <div className="min"></div>
          </button>
          <p className="amount">{props.count}</p>
          <button className="plus" onClick={() => {
            props.functionUpdate();
          }}>
            <div className="max"></div>
            <div className="max_end"></div>
          </button>

        </div>
    </div>
  )
}
