import React from "react";

export function CartCounter(props) {
  return(
    <div className="bump">
      <img className="pop" src='/logo/bump.svg' alt=""/>
      <p className="count">{props.count}</p>
    </div>
  )
}