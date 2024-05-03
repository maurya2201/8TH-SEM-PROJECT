const cart = JSON.parse(localStorage.getItem("cart")) || [];

const viewCart = document.getElementsByClassName("cartbtn")[0];
viewCart.textContent = `Viewcart(${cart.length})`;
viewCart.addEventListener("click", () => {
  location.href = "viewcart.php";
});

const getAllBooks = async () => {
  try {
    const response = await fetch(
      `http://localhost/files/8TH%20SEM%20PROJECT/buyer/getallbooks.php`
    );
    const books = await response.json();
    let book = ``;
    books.map(
      ({id,name,image}) =>
        (book += `
  <div class="col-3">
  <div class="card">
  <img src="../assets/images/${image}" height="200px" width="200px" class="card-img-top" alt="${name}">
  <div class="card-body">
    <p class="card-title"><b>${name.toUpperCase()}</b></p>
  <button onclick="viewDetails(${id})" type="button"  class="cartbtn btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#exampleModal_${id}">Viewdetails</button>
  </div>
  </div>
</div>
`)
    );
    document.querySelector(".row").innerHTML = book;
  } catch (error) {
    console.log(error);
  }
};
getAllBooks();

async function addToCart(bid) {
  try {
    const data = await fetch(
      `http://localhost/files/8TH%20SEM%20PROJECT/buyer/getonebook.php?id=${bid}`
    );
    const book = await data.json();
    const bookCart = {
      id: parseInt(book.id),
      name: book.name,
      image: book.image,
      buyerId: parseInt(sessionStorage.getItem("id")),
      price: parseInt(book.price),
      totalprice: parseInt(book.price),
      sellerId: parseInt(book.seller_id),
      quantity: 1,
    };
    const findId = cart.findIndex((element) => element.id == bid);
    if (findId != -1) {
      cart[findId].quantity++;
      cart[findId].totalprice = cart[findId].totalprice + cart[findId].price;
      Toastify({
        text: "Quantity updated!",
        className: "info",
        style: {
        background: "linear-gradient(to right, #eab676e6, #eab676e6)",
        color: "#000000"
        }}).showToast();
      localStorage.setItem("cart", JSON.stringify(cart));
    } else {
      Toastify({
        text: "Item added successfully!",
        className: "info",
        style: {
        background: "linear-gradient(to right, #eab676e6, #eab676e6)",
        color: "#000000"
        }}).showToast();
      setTimeout(()=>{
      cart.unshift(bookCart);
      localStorage.setItem("cart", JSON.stringify(cart));
      location.reload();
      },2000);
    }
  } catch (error) {
    console.log(error);
  }
}
async function viewDetails(bid) {
  const result = await fetch(`http://localhost/files/8TH%20SEM%20PROJECT/buyer/getonebook.php?id=${bid}`);
  const data = await result.json();
  const {name,price,author,description,image} = data;
  const modal = `
    <div class="modal fade" id="exampleModal_${bid}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-body">
          <center>
          <img src="../assets/images/${image}" height=250px" width="200px" class="card-img-top" alt="${name}">
          <div>
          <i class="card-title"><b>BOOKNAME:</b>${name}</i>
          </div>
          <div>
          <i class="card-title"><b>PRICE:</b> $${price}</i>
          </div>
          <div>
          <i class="card-title"><b>AUTHOR:</b> ${author}</i>
          </div>
          <div>
          <i class="card-text"><b>DESCRIPTION</b>: ${description}</i>
          </div>
          <br>
          <div>
          <button onclick="addToCart(${bid})" type="button" class="btn btn-outline-danger">Add to cart</button>
          <button type="button"  class="btn btn-outline-info" data-dismiss="modal">Close</button>
          </div>
          </center>
          </div>
        </div>
      </div>
    </div>
  `;
  document.body.insertAdjacentHTML('beforeend', modal);
  const myModal = new bootstrap.Modal(document.getElementById(`exampleModal_${bid}`));
  myModal.show();
}