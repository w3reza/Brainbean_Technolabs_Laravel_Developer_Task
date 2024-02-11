var totalPrice = 0;
var selectedProducts = [];
var Products = [];

function addToSelected(id, product, price) {
// Create a new row
var newRow = document.createElement('tr');

// Create cells for product name, price, quantity, and total
var productNameCell = document.createElement('td');
productNameCell.textContent = product;
var priceCell = document.createElement('td');
priceCell.textContent = '$' + price.toFixed(2);
var quantityCell = document.createElement('td');
var quantityInput = document.createElement('input');
quantityInput.type = 'number';
quantityInput.value = 1;
quantityInput.min = 1;
quantityInput.classList.add('quantity-input');
quantityInput.addEventListener('change', function() {
updateTotal();
});
quantityCell.appendChild(quantityInput);
var totalCell = document.createElement('td');

newRow.appendChild(productNameCell);
newRow.appendChild(quantityCell);
newRow.appendChild(priceCell);


document.getElementById('selectedProducts').appendChild(newRow);

// Add product to the selected products array for display and calculation
selectedProducts.push({
id: id,
name: product,
price: price,
quantityInput: quantityInput,
});

// Add product to the Products array
Products.push({
id: id,
price: price,
qty: quantityInput.value
});

updateTotal();

// Show the selected products card and sell button
document.getElementById('selectedProductsCard').style.display = 'block';
}

function updateTotal() {

totalPrice = 0;


selectedProducts.forEach(product => {
var quantity = parseInt(product.quantityInput.value);
if (!isNaN(quantity)) {
totalPrice += (product.price * quantity);
}
});


var discount = parseFloat(document.getElementById('discountInput').value);
if (!isNaN(discount)) {
var discountedTotal = totalPrice - discount;

// Total price displayed on the page
document.getElementById('totalPrice').textContent = discountedTotal.toFixed(2);
totalPrice = discountedTotal;
} else {

document.getElementById('totalPrice').textContent = 'Invalid Discount';
}
}

document.getElementById('discountInput').addEventListener('input', function() {
updateTotal();


});

async function sellProducts() {
try {
let CustomerName = document.getElementById('CustomerName').value;

if (!CustomerName) {

alert('Please select a customer name');
return;
}
let postBody = {
total_price: totalPrice,
discount: document.getElementById('discountInput').value,
customer_name: CustomerName,
products: Products,
};

let response = await axios.post('/transaction/store', postBody);

if (response.data.status == 'success') {
const Toast = Swal.mixin({
toast: true,
position: 'top-right',
iconColor: 'green',
showConfirmButton: false,
timer: 2000,
timerProgressBar: true,

});

(async () => {
Toast.fire({
icon: 'success',
title: response.data.message,
});
})();

setTimeout(() => {
window.location.href = '/transactions';
}, 2000);


} else {
alert('Error during make transactions');
}


console.log(response.data);
} catch (error) {

console.error('Error during make transactions:', error);
}
}
