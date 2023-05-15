import React from "react";

export function TotalPrice(props) {
  return(
    <div style={{display: "contents"}}>
      <div className="border"></div>

      <p className="total">Итого к оплате: {props.total} ₽</p>

      <button className="order">Заказать</button>
    </div>
  )
}
