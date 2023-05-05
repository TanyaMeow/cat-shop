'use strict'

const container = document.querySelector('.block_card');
let count = document.querySelector('.product');
let textItem = document.querySelector('.item');
let totalPrice = document.querySelector('.total_price');

const spinner = new Spin.Spinner().spin(document.body);
spinner.stop();

axios.get('api/cart/count')
  .then((response) => {
    switch (response.data.count) {
      case 0:
        textItem.textContent = 'товаров';
        break
      case 1:
        textItem.textContent = 'товар';
        break
      case 2:
      case 3:
      case 4:
        textItem.textContent = 'товарa';
        break
      default:
        textItem.textContent = 'товаров';
    }

    count.textContent = response.data.count;
  })

axios.get('api/cart/total')
    .then((response) => {
      totalPrice.textContent = response.data.total;
    })

container.onclick = function (event) {
    const deleteItem = event.target.closest('.delete_item');
    const currentCard = event.target.closest('.card');
    const buttonMin = event.target.closest('.minus');
    const buttonMax = event.target.closest('.plus');
    const amount = currentCard.querySelector('.amount');

    if (buttonMax) {
      axios.put('api/cart', {
        product_id: currentCard.dataset.id,
        count: Number(amount.textContent) + 1
      })
        .then(() => {
          amount.textContent = Number(amount.textContent) + 1 + '';
          return axios.get('/api/cart/total');
        })
        .then((response) => {
          totalPrice.textContent = response.data.total;
        })
    }

    if (buttonMin) {
      axios.put('/api/cart', {
        product_id: currentCard.dataset.id,
        count: Number(amount.textContent) - 1
      })
        .then(() => {
          amount.textContent = Number(amount.textContent) - 1 + '';
          return axios.get('/api/cart/total');
        })
        .then((response) => {
          totalPrice.textContent = response.data.total;
        })
    }

    if (!deleteItem) {
      return
    }

    axios.delete(`/api/cart/${currentCard.dataset.id}`)
      .then(() => {
        container.removeChild(currentCard);
        return axios.get('api/cart/count');
      })
      .then((response) => {
        switch (response.data.count) {
          case response.data.count > 4:
          case 0:
            textItem.textContent = 'товаров';
            break
          case 1:
            textItem.textContent = 'товар';
            break
          case 2:
          case 3:
          case 4:
            textItem.textContent = 'товарa';
            break
        }
        count.textContent = response.data.count;

        return axios.get('api/cart/total');
      })
      .then((response) => {
        totalPrice.textContent = response.data.total;
      })
}
