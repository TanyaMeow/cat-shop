'use strict'

const container = document.querySelector('.shop_block');
const popCou = document.querySelector('.popcou');
let countProduct = document.querySelector('.count');

axios.get("/api/cart/count")
  .then(response => {
    if(response.data.count > 0) {
      countProduct.textContent = response.data.count;
      popCou.style.display = "contents";
    }
  })

container.onclick = function(event) {
  const button = event.target.closest('.button');

  if (!button) {
    return
  }

  popCou.style.display = "contents";
  console.log('клик');
  const card = event.target.closest('.card');

  axios.put("/api/cart", {
    product_id: card.dataset.id,
    count: 1
  })
    .then(() => {
      return axios.get("/api/cart/count")
    })
    .then((response) => {
      countProduct.textContent = response.data.count;
    })
}
