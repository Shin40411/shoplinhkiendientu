function addToCart(itemId) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "cart.php?id=" + itemId, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                    updateCartSummary();
                } else {
                    console.error("Error adding item to cart: " + response.message);
                }
            } else {
                console.error("Failed to add item to cart. Status code: " + xhr.status);
            }
        }
    };

    xhr.send("themgiohang=true");
}

function updateCartSummary() {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "cart.php?getCartSummary=1", true);
    xhr.setRequestHeader("Content-Type", "application/json");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                if (xhr.responseText) {
                    var cartSummary = JSON.parse(xhr.responseText);
                    var cartButton = document.getElementById('cart-indicator').querySelector('button');
                    if (cartSummary.number > 0 && cartSummary.total > 0) {
                        document.getElementById('item-count').innerText = cartSummary.number;
                        document.getElementById('progressbarcart').style.display = "unset";
                        document.getElementById('cartbodies').innerHTML = cartSummary.cartbody;
                        cartButton.style.animationName = 'bag-shake';
                    } else {
                        document.getElementById('item-count').innerText = 0;
                        document.getElementById('progressbarcart').style.display = "none";
                        document.getElementById('cartbodies').innerHTML = '<td colspan="8"><p style="line-height:43px;">Chưa có sản phẩm!</p></td>';
                        cartButton.style.animationName = 'none';
                    }
                }
            } else {
                console.error("Failed to fetch cart summary. Status code: " + xhr.status);
            }
        }
    };

    xhr.send();
}

updateCartSummary();

function updateCart(itemId, action) {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "cart.php?" + action + "=" + itemId, true);

    xhr.onreadystatechange = function () {
        xhr.responseText;
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                updateCartSummary();
            } else {
                console.error("Failed to update cart. Status code: " + xhr.status);
            }
        }
    };

    xhr.send();
}

function removeFromCart(itemId) {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "cart.php?xoa=" + itemId, true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                if (xhr.responseText) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        updateCartSummary();
                    } else {
                        console.error("Failed to remove item from cart");
                    }
                }
            } else {
                console.error("Failed to remove item from cart. Status code: " + xhr.status);
            }
        }
    };

    xhr.send();
}

function removeAllFromCart() {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "cart.php?xoatatca=1");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                if (xhr.responseText) {
                    var cartButton = document.getElementById('cart-indicator').querySelector('button');
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        updateCartSummary();
                        cartButton.style.animationName = 'none';
                    } else {
                        console.error("Failed to remove item from cart");
                    }
                }
            } else {
                console.error("Failed to remove item from cart. Status code: " + xhr.status);
            }
        }
    };

    xhr.send();
}

function shipping() {
    event.preventDefault();
    checkSession(function (sessionExists) {
        if (sessionExists) {
            document.getElementById('changeStep').innerHTML = '<button class="btn btn-success"><i class="fa fa-spinner fa-spin" style="font-size:16px"></i> Vui lòng chờ...</button>';
            setTimeout(function () {
                goToStep(1);
                loadShippingPage();
                document.getElementById('changeStep').innerHTML = '';
                document.querySelector('.removeitem').innerHTML = '';
                document.querySelector('.removeitems').innerHTML = '';
            }, 4000);
        } else {
            $('#result').html('<span class="h5">Vui lòng đăng nhập để tiến hành thanh toán</span>');
        }
    });
}

function checkSession(callback) {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'checksessionlogin.php', true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                if (xhr.responseText === "1") {
                    callback(true);
                } else {
                    callback(false);
                }
            } else {
                console.error("Error:", xhr.statusText);
                callback(false);
            }
        }
    };
    xhr.send();
}

function loadShippingPage() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'shipping.php', true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                if (response && response.shippinghtml) {
                    document.getElementById('shipping').innerHTML = response.shippinghtml;
                } else {
                    console.error("Invalid response from server:", response);
                }
            } else {
                console.error("XHR request failed with status:", xhr.status);
            }
        }
    };
    xhr.send();
}

function updateShipping(actions) {
    var fullname = document.getElementById("fullname").value;
    var phone_number = document.getElementById("phone_number").value;
    var addresses = document.getElementById("addresses").value;
    var note = document.getElementById("note").value;
    var data = {
        fullname: fullname,
        phone_number: phone_number,
        addresses: addresses,
        note: note,
        action: actions
    };

    if (fullname === "" || phone_number === "" || addresses === "") {
        document.getElementById('notification').innerHTML = '<div class="d-flex justify-content-center panel-footer"><span class="h5 text-danger">Vui lòng nhập đầy đủ thông tin!</span></div>';
        return;
    }

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "shipping.php");
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                document.getElementById('updatevanchuyen').innerHTML = '<i class="fa fa-spinner fa-spin" style="font-size:16px"></i> Vui lòng chờ...';
                setTimeout(function () {
                    document.getElementById('notification').innerHTML = '<div class="d-flex justify-content-center panel-footer"><span class="h5 text-success">Cập nhật thông tin thành công!</span></div>';
                    setTimeout(() => {
                        loadShippingPage();

                    }, 3000);
                }, 4000);
            } else {
                console.error(xhr.status);
            }
        }
    };

    xhr.send(JSON.stringify(data));


}

function nextpaystep() {
    document.getElementById('paystep').innerHTML = '<i class="fa fa-spinner fa-spin" style="font-size:16px"></i> Vui lòng chờ...';
    var fullname = document.getElementById("fullname");
    var phone_number = document.getElementById("phone_number");
    var addresses = document.getElementById("addresses");
    var note = document.getElementById("note");
    setTimeout(function () {
        goToStep(2);
        document.getElementById('submitbutt').innerHTML = '';
        document.getElementById('addcount').innerHTML = '';
        document.getElementById('minuscount').innerHTML = '';

        fullname.disabled = true;
        phone_number.disabled = true;
        addresses.disabled = true;
        note.disabled = true;
        loadPaymentPage();
    }, 4000);
}

function loadPaymentPage() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'billinfo.php', true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                if (response && response.formpay) {
                    document.getElementById('payment').innerHTML = response.formpay;
                } else {
                    console.error("Invalid response from server:", response);
                }
            } else {
                console.error("XHR request failed with status:", xhr.status);
            }
        }
    };
    xhr.send();
}

const steps = document.querySelectorAll('#progressbarcart .step');

function goToStep(index) {
    if (index < 0 || index >= steps.length) {
        console.error('Index không hợp lệ');
        return;
    }


    let currentIndex = -1;
    for (let i = 0; i < steps.length; i++) {
        if (steps[i].classList.contains('current')) {
            currentIndex = i;
            break;
        }
    }

    if (index === 0) {
        steps.forEach(step => step.classList.remove('done'));
    }

    if (currentIndex === -1) {
        currentIndex = 0;
        steps[currentIndex].classList.add('current');
    }

    steps[currentIndex].classList.remove('current');

    for (let i = currentIndex; i < index; i++) {
        steps[i].classList.add('done');
    }

    steps[index].classList.add('current');
}

function backtoFirstState() {
    goToStep(0);
    var changeS = document.getElementById('changeStep');
    if (changeS) changeS.innerHTML = '<button class="btn btn-success">Thanh toán</button>';
    var addS = document.getElementById('addcount');
    if (addS) addS.innerHTML = '<i class="fa fa-plus fa-style" aria-hidden="true"></i>';
    var minusS = document.getElementById('minuscount');
    if (minusS) minusS.innerHTML = '<i class="fa fa-minus fa-style" aria-hidden="true"></i>';
    var delS = document.querySelector('.removeitem');
    if (delS) delS.innerHTML = '<i class="fa fa-trash"></i>';
    var delAS = document.querySelector('.removeitems');
    if (delAS) delAS.innerHTML = '<i class="fa fa-trash"></i> Xóa tất cả';
    document.getElementById('shipping').innerHTML = '';
    document.getElementById('payment').innerHTML = '';
}

var modal = document.getElementById('cart');
modal.addEventListener('click', function (event) {
    if (event.target === modal) {
        backtoFirstState();
    }
});