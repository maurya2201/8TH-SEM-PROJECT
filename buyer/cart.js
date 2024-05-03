const cart = JSON.parse(localStorage.getItem("cart")) || [];
let total = 0;
const totalPrice = document.querySelector("pre");
setInterval(()=>{
  let total = 0;
  for(let i=0;i<cart.length;i++){
    total+=cart[i].totalprice;
  }
  totalPrice.textContent=`Total Price:$${total}`;
},0);

if (cart.length === 0) {
  Toastify({
    text: "Cart is empty!",
    className: "info",
    style: {
    background: "linear-gradient(to right, #eab676e6, #eab676e6)",
    color: "#000000"
    }}).showToast();
    setTimeout(()=>{
      window.location.href="./buyer.php";
    },1000);
  }
const getCart = () => {
  let listing = ``;
  cart.map(
    ({ name, image, totalprice, quantity }, index) =>
      (listing += `
  <tr>
  <td>${name}</td>
  <td><img height="100px" width="100px" src="../assets/images/${image}"></td>
  <td>$${totalprice}</td>
  <td>
  <button class="btn btn-outline-primary"  onclick="removeOne(${index})">-</button>
  ${quantity}
  <button  class="btn btn-outline-primary" onclick="addOne(${index})">+</button>
  </td>
  <td><button class="btn btn-outline-danger" onclick="removeItem(${index})">Remove</button></td>
  </tr>
  `)
  );
  document.querySelector("tbody").innerHTML = listing;
};
getCart();

function removeOne(id) {
  cart[id].quantity--;
  cart[id].totalprice = cart[id].totalprice - cart[id].price;
  Toastify({
    text: "Quantity updated successfully!",
    className: "info",
    style: {
    background: "linear-gradient(to right, #eab676e6, #eab676e6)",
    color: "#000000"
    }}).showToast();
  localStorage.setItem("cart", JSON.stringify(cart));
  if (cart[id].quantity === 0) {
    const deleted = cart.filter((element, index, arr) => index !== id);
    localStorage.setItem("cart", JSON.stringify(deleted));
    setTimeout(()=>{
    Toastify({
      text: "Item removed!",
      className: "info",
      style: {
      background: "linear-gradient(to right, #eab676e6, #eab676e6)",
      color: "#000000"
      }}).showToast();
    },2000);
    setTimeout(()=>{
      location.reload();
    },2000);
  }
  getCart();
}
function addOne(id) {
  cart[id].quantity++;
  cart[id].totalprice = cart[id].totalprice + cart[id].price;
  localStorage.setItem("cart", JSON.stringify(cart));
  getCart();
  Toastify({
    text: "Quantity updated successfully!",
    className: "info",
    style: {
    background: "linear-gradient(to right, #eab676e6, #eab676e6)",
    color: "#000000"
    }}).showToast();
}
async function placeOrder() {
  let orders;
  let order;
  for(let i=0;i<cart.length;i++){
  orders=cart[i];
  order = await fetch(
    "http://localhost/files/8TH%20SEM%20PROJECT/buyer/insertorder.php",
    {
      method: "POST",
      headers: {
        "Content-Type": "application/json;charset=utf-8",
      },
      body: JSON.stringify(orders),
    }
  );}
  if(order.status===200){
  localStorage.removeItem("cart");
  Toastify({
    text: "Order placed successfully!",
    className: "info",
    style: {
    background: "linear-gradient(to right, #eab676e6, #eab676e6)",
    color: "#000000"
    }}).showToast();
  setTimeout(()=>{
    window.location.href="./buyer.php";
  },2000);
  }else{
    Toastify({
      text: "Error while placing order!",
      className: "info",
      style: {
      background: "linear-gradient(to right, #eab676e6, #eab676e6)",
      color: "#000000"
      }}).showToast();
  }
}
function removeItem(id) {
  const deleted = cart.filter((element, index) => index !== id);
  localStorage.setItem("cart", JSON.stringify(deleted));
  Toastify({
    text: "Item removed successfully!",
    className: "info",
    style: {
    background: "linear-gradient(to right, #eab676e6, #eab676e6)",
    color: "#000000"
    }}).showToast();
  setTimeout(()=>{
    location.reload();
  },2000);
}
