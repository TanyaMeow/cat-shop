import React from "react";

export function ProductCard (props) {
    return(
      <div className="card">
        <img className="img" src={props.image_path} alt=""/>
          <h1 className="title">{props.name}</h1>

          <div className="footer_card">
            <p className="price">{props.price} ₽</p>
            <button className="button" onClick={() => props.onProductAddToCart(Number(props.id))}>
              <img src="/logo/button.svg" alt=""/>
            </button>
          </div>
      </div>
    )
}
