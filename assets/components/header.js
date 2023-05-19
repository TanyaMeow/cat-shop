import React, {Component} from "react";
import {useContext} from 'react';
import {CountContext} from "../Contexts/CountContext";
import {Navigation} from "./navigation";
import {CartCounter} from "./cartCounter";

export function Header() {
  const count = useContext(CountContext);

  return (
    <header>
      <div className='container_header'>
        <div className='block_header'>
          <img className='logo' src='/logo/logo.svg' alt=''/>

          <Navigation/>

          <a className='cart'><img src='/logo/CArT (1).svg' alt=''/>
            {count > 0 && <CartCounter count={count}/>}
          </a>

        </div>
      </div>
    </header>
  )
}
