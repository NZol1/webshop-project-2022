const paypage = document.getElementById('checkout');
const cartpage = document.getElementById('card active');
const prevpage = document.getElementById('prevpg');
const paymentpg = document.getElementById('payment-page');
function toPaypage() {
  if (!paypage.classList.contains('active'))
  {
    paypage.classList.toggle('active');
    cartpage.classList.remove('active');
  }
  
}


function backtoPaypage() {
  if (paypage.classList.contains('active'))
  {
    cartpage.classList.add('active');
    paypage.classList.remove('active');
  }
}

function buttonShow() {
  const prevbttn = document.getElementById('prevpg');
  if (cartpage.classList.contains('active'))
  {
    prevbttn.style.display = "inline-block";
  }
}

function gotoPaymentPg() {
  if (paypage.classList.contains('active'))
  {
    paymentpg.classList.add('active');
    paypage.classList.remove('active');
  }
}

function backtoCheckoutpg() {
  if (paymentpg.classList.contains('active'))
  {
    paypage.classList.add('active');
    paymentpg.classList.remove('active');
  }
}
