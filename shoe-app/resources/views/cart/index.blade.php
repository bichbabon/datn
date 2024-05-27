@extends('../layout')

@section('content')
<style>
    .title {
        margin-bottom: 5vh;
    }

    .card {
        margin: auto;
        max-width: 950px;
        width: 90%;
        box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        border-radius: 1rem;
        border: transparent;
    }

    @media(max-width:767px) {
        .card {
            margin: 3vh auto;
        }
    }

    .cart {
        background-color: #fff;
        padding: 4vh 5vh;
        border-bottom-left-radius: 1rem;
        border-top-left-radius: 1rem;
    }

    @media(max-width:767px) {
        .cart {
            padding: 4vh;
            border-bottom-left-radius: unset;
            border-top-right-radius: 1rem;
        }
    }

    .summary {
        background-color: #ddd;
        border-top-right-radius: 1rem;
        border-bottom-right-radius: 1rem;
        padding: 4vh;
        color: rgb(65, 65, 65);
    }

    @media(max-width:767px) {
        .summary {
            border-top-right-radius: unset;
            border-bottom-left-radius: 1rem;
        }
    }

    .summary .col-2 {
        padding: 0;
    }

    .summary .col-10 {
        padding: 0;
    }

    .row {
        margin: 0;
    }

    .title b {
        font-size: 1.5rem;
    }

    .main {
        margin: 0;
        padding: 2vh 0;
        width: 100%;
    }

    .col-2,
    .col {
        padding: 0 1vh;
    }

    a {
        padding: 0 1vh;
    }

    .close {
        margin-left: auto;
        font-size: 0.7rem;
    }

    .back-to-shop {
        margin-top: 4.5rem;
    }

    h5 {
        margin-top: 4vh;
    }

    hr {
        margin-top: 1.25rem;
    }

    form {
        padding: 2vh 0;
    }

    select {
        border: 1px solid rgba(0, 0, 0, 0.137);
        padding: 1.5vh 1vh;
        margin-bottom: 4vh;
        outline: none;
        width: 100%;
        background-color: rgb(247, 247, 247);
    }

    input {
        border: 1px solid rgba(0, 0, 0, 0.137);
        padding: 1vh;
        margin-bottom: 4vh;
        outline: none;
        width: 100%;
        background-color: rgb(247, 247, 247);
    }

    input:focus::-webkit-input-placeholder {
        color: transparent;
    }

    .btn {
        background-color: #000;
        border-color: #000;
        color: white;
        width: 100%;
        font-size: 0.7rem;
        margin-top: 4vh;
        padding: 1vh;
        border-radius: 0;
    }

    .btn:focus {
        box-shadow: none;
        outline: none;
        box-shadow: none;
        color: white;
        -webkit-box-shadow: none;
        -webkit-user-select: none;
        transition: none;
    }

    .btn:hover {
        color: white;
    }

    a {
        color: black;
    }

    a:hover {
        color: black;
        text-decoration: none;
    }

    #code {
        background-image: linear-gradient(to left, rgba(255, 255, 255, 0.253), rgba(255, 255, 255, 0.185)), url("https://img.icons8.com/small/16/000000/long-arrow-right.png");
        background-repeat: no-repeat;
        background-position-x: 95%;
        background-position-y: center;
    }
</style>

<div class="bg0 m-t-23 p-b-50">
</div>

<div class="card">
    <div class="row">
        <div class="col-md-8 cart">
            <div class="title">
                <div class="row">
                    <div class="col">
                        <h4><b>Giỏ hàng</b></h4>
                    </div>
                    <!-- <div class="col align-self-center text-right text-muted" id="item-count">3 items</div> -->
                </div>
            </div>
            <div class="cart-items"></div> <!-- Container for cart items -->
            <div class="back-to-shop"><a href="{{ route('product.index') }}">&leftarrow;</a><span class="text-muted">Quay lại</span></div>
        </div>

        <div class="col-md-4 summary">
            <div>
                <h5><b>Thông tin cá nhân</b></h5>
            </div>
            <hr>
            <div class="row">
                <div class="col" style="padding-left:0;"></div>
                <div class="col text-right" id="total-price">&euro; 132.00</div>
            </div>
            <form id="form-cart">

                <p>Tên</p>
                <input type="text" id="ten" placeholder="Enter your name">

                <p>Số điện thoại</p>
                <input type="tel" id="sdt" placeholder="Enter your phone number">

                <p>Địa chỉ</p>
                <input type="text" id="diachi" placeholder="Enter your address">

                <p>Phương thức thanh toán</p>
                <select id="payment-method">
                    <option value="">Chọn một Phương thức thanh toán</option>
                    <option value="Thẻ tín dụng">Thẻ tín dụng</option>
                    <option value="PayPal">PayPal</option>
                    <option value="Chuyển khoản ngân hàng">Chuyển khoản ngân hàng</option>
                    <option value="Thanh toán khi giao hàng">Thanh toán khi giao hàng</option>
                </select>

                <button class="btn" type="submit">Thanh Toán</button>
            </form>
        </div>
    </div>

</div>

<div class="bg0 m-t-23 p-b-50">
</div>


<script>
    function loadCartData() {
        const cartItemsContainer = document.querySelector('.cart-items');
        const itemCountElement = document.getElementById('item-count');
        const userId = sessionStorage.getItem('id');

        if (!userId) {
            console.error("No user ID found in sessionStorage.");
            return;
        }

        fetch(`http://localhost/shoe-api/public/api/giohang/${userId}`)
            .then(response => response.json())
            .then(cartItems => {
                let total = 0;
                let itemsCount = cartItems.length;
                //itemCountElement.textContent = `${itemsCount} items`;

                cartItems.forEach((item, index) => {
                    var sanpham_size_mausac_id = item.sanpham_size_mausac_id
                    fetch(`http://localhost/shoe-api/public/api/getsanphambycart/${sanpham_size_mausac_id}`)
                        .then(response => response.json())
                        .then(productData => {
                            const price = productData.gia - (productData.gia * productData.giamgia / 100);
                            total += price * item.soluong;

                            const itemHTML = `
                            <div class="row border-top border-bottom item" id="item-${index}">
                                <div class="row main align-items-center">
                                    <div class="col-2"><img style="width: 3.5rem;" class="img-fluid" src="http://localhost/shoe-api/storage/app/public/uploads/${productData.anhsanpham[0].anhminhhoa}" alt="IMG"></div>
                                    <div class="col">
                                        <div class="row text-muted">${productData.thuonghieu.ten}</div>
                                        <div class="row">${productData.ten}</div>
                                    </div>
                                    <div class="col">
                                        <a href="#" class="modify-qty" data-id="${productData.id}" data-index="${index}" data-change="decrease" data-sanpham-size-mausac-id="${sanpham_size_mausac_id}">-</a>
                                        <a href="#" class="border quantity">${item.soluong}</a>
                                        <a href="#" class="modify-qty" data-id="${productData.id}" data-index="${index}" data-change="increase" data-sanpham-size-mausac-id="${sanpham_size_mausac_id}">+</a>
                                    </div>
                                    <div class="col price-per-item"> ${formatCurrencyVND(price)} <span class="close" data-id="${productData.id}" onclick="removeItem(${index}, '${productData.id}','${sanpham_size_mausac_id}')">&#10005;</span></div>
                                </div>
                            </div>
                        `;
                            cartItemsContainer.insertAdjacentHTML('beforeend', itemHTML);
                        });
                });

                // Add event listeners after DOM is updated
                cartItemsContainer.addEventListener('click', function (event) {
                    if (event.target.classList.contains('modify-qty')) {
                        const btn = event.target;
                        const itemId = btn.getAttribute('data-id');
                        const itemIndex = btn.getAttribute('data-index');
                        const changeType = btn.getAttribute('data-change');
                        const sanphamSizeMausacId = btn.getAttribute('data-sanpham-size-mausac-id');

                        updateQuantity(itemId, itemIndex, changeType, sanphamSizeMausacId);
                    }
                });
            })
            .catch(error => console.error('Error fetching cart data: ', error));
        updateTotalPrice()
    }

    function removeItem(index, itemId, sanpham_size_mausac_id) {
        fetch(`http://localhost/shoe-api/public/api/removegiohang/${sessionStorage.getItem('id')}/${sanpham_size_mausac_id}`, {
            method: 'DELETE'
        })
            .then(response => response.json())
            .then(data => {
                updateTotalPrice()
                console.log('Item removed', data);
                document.getElementById(`item-${index}`).remove();
            })
            .catch(error => console.error('Error removing item', error));
    }

    function updateQuantity(itemId, index, changeType, sanpham_size_mausac_id) {
        const itemContainer = document.querySelector(`#item-${index}`);
        const qtyElement = itemContainer.querySelector('.border');
        let currentQty = parseInt(qtyElement.textContent);

        if (changeType === 'increase') {
            currentQty += 1;
        } else if (changeType === 'decrease' && currentQty > 1) {
            currentQty -= 1;
        }

        // Update quantity in the DOM
        qtyElement.textContent = currentQty;

        // Call API to update the server
        const postData = JSON.stringify({
            sanpham_size_mausac_id: sanpham_size_mausac_id,
            khachhang_id: sessionStorage.getItem('id'),
            soluong: currentQty
        });

        // Call API to update the server using POST method
        fetch(`http://localhost/shoe-api/public/api/updategiohang`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: postData
        })
            .then(response => response.json())
            .then(data => {
                updateTotalPrice()
                console.log('Quantity updated', data)
            }

            )
            .catch(error => console.error('Error updating quantity', error));
    }
    document.addEventListener('DOMContentLoaded', function () {
        loadCartData();
        setInterval(updateTotalPrice, 1000);
        updateTotalPrice()
        fetch('http://localhost/shoe-api/public/api/khachhang/' + sessionStorage.getItem('id'))
            .then(response => response.json())
            .then(data => {
                // Giả sử JSON trả về có cấu trúc { name: '', phone: '', address: '', paymentMethod: '' }
                document.getElementById('ten').value = data.ten || '';
                document.getElementById('sdt').value = data.sdt || '';
                document.getElementById('diachi').value = data.diachi || '';

            })
            .catch(error => {
                console.error('Error fetching customer data:', error);
            });

        const form = document.getElementById('form-cart');

        form.addEventListener('submit', function (e) {
            e.preventDefault();
            const cartItemsContainer = document.querySelector('.cart-items');
            const totalPriceElement = document.querySelector('#total-price'); // Make sure the ID matches
            let totalPrice = 0;

            cartItemsContainer.querySelectorAll('.item').forEach(item => {
                const qty = parseInt(item.querySelector('.quantity').textContent);
                const priceText = item.querySelector('.price-per-item').textContent;
                const price = parseFloat(priceText.replace(/[.₫]/g, "").trim());
                totalPrice += qty * price;
            });

            const khachhang_id = sessionStorage.getItem('id')
            const ten = document.getElementById('ten').value;
            const sdt = document.getElementById('sdt').value;
            const diachi = document.getElementById('diachi').value;
            const pttt = document.getElementById('payment-method').value;


            fetch('http://localhost/shoe-api/public/api/donhang', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
    },
    body: JSON.stringify({ khachhang_id, ten, sdt, diachi, pttt })
})
    .then(response => {
        if (!response.ok) {
            if (response.status === 400) {
                return response.json().then(errorData => {
                    throw new Error(errorData.message);
                });
            } else {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
        }
        return response.json();
    })
    .then(data => {
        console.log(data); // Log dữ liệu response để kiểm tra

        if (pttt === "Thanh toán khi giao hàng") {
            alert('Đơn hàng đã được gửi thành công!');
            window.location.href = '{{route("home")}}';
        } else {
            window.location.href = `https://stripe-x19c.onrender.com?id=${data.id}&price=${totalPrice}`;
        }
    })
    .catch((error) => {
        console.error('Error:', error); // Log lỗi để kiểm tra
        alert(`Đã xảy ra lỗi khi gửi đơn hàng: ${error.message}`);
    });

        });
    })



    function updateTotalPrice() {
        const cartItemsContainer = document.querySelector('.cart-items');
        const totalPriceElement = document.querySelector('#total-price'); // Make sure the ID matches
        let totalPrice = 0;

        cartItemsContainer.querySelectorAll('.item').forEach(item => {
            const qty = parseInt(item.querySelector('.quantity').textContent);
            const priceText = item.querySelector('.price-per-item').textContent;
            const price = parseFloat(priceText.replace(/[.₫]/g, "").trim());
            totalPrice += qty * price;
        });

        totalPriceElement.textContent = formatCurrencyVND(totalPrice); // Ensure formatting matches your locale
    }


</script>
@endsection