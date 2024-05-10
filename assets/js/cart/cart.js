function addToCart(itemId) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "function/cart.php?id=" + itemId, true);
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
    xhr.open("GET", "function/cart.php?getCartSummary=1", true);
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
                        var carbody = document.getElementById('cartbodies');
                        if (carbody) {
                            carbody.innerHTML = '<td colspan="8"><p style="line-height:43px;">Chưa có sản phẩm!</p></td>';
                        } else {
                            document.getElementById('carttable').innerHTML = `
                            <table style="text-align:center;width: 100%;border-collapse: collapse;" border="1">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="vertical-align: middle;">#</th>
                                        <th class="text-center" style="vertical-align: middle;">Tên sản phẩm</th>
                                        <th class="text-center" style="vertical-align: middle;">Số lượng</th>
                                        <th class="text-center" style="vertical-align: middle;">Giá</th>
                                        <th class="text-center" style="vertical-align: middle;">Mã sản phẩm</th>
                                        <th class="text-center" style="vertical-align: middle;">Hình ảnh</th>
                                        <th class="text-center" style="vertical-align: middle;">Thành tiền</th>
                                        <th class="text-center" style="vertical-align: middle;">Xóa sản phẩm</th>
                                    </tr>
                                </thead>
                                <tbody id="cartbodies">
                                    <td colspan="8"><p style="line-height:43px;">Chưa có sản phẩm!</p></td>
                                </tbody>
                            `;
                        }
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
    xhr.open("GET", "function/cart.php?" + action + "=" + itemId, true);

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
    xhr.open("GET", "function/cart.php?xoa=" + itemId, true);

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
    xhr.open("GET", "function/cart.php?xoatatca=1");

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
                var trashcan = document.querySelectorAll('.removeitem');
                trashcan.forEach((trash, index) => {
                    trash.innerHTML = '';
                });
                document.querySelector('.removeitems').innerHTML = '';
            }, 4000);
        } else {
            $('#result').html('<span class="h5">Vui lòng đăng nhập để tiến hành thanh toán</span>');
        }
    });
}

function checkSession(callback) {
    // var xhr = new XMLHttpRequest();
    // xhr.open('GET', 'function/checksessionlogin.php', true);
    // xhr.onreadystatechange = function () {
    if (document.getElementById('loginsession').value != "") {
        callback(true);
    } else {
        callback(false);
    }
    // };
    // xhr.send();
}

function loadShippingPage() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'function/shipping.php', true);
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
    xhr.open("POST", "function/shipping.php");
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
        var increase = document.querySelectorAll('.increasenumber');
        increase.forEach((ic) => {
            ic.innerHTML = '';
        });
        var decrease = document.querySelectorAll('.decreasenumber');
        decrease.forEach((dc) => {
            dc.innerHTML = '';
        });

        fullname.disabled = true;
        phone_number.disabled = true;
        addresses.disabled = true;
        note.disabled = true;
        loadPaymentPage();
    }, 4000);
}

function loadPaymentPage() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'function/billinfo.php', true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                if (response && response.formpay) {
                    document.getElementById('payment').innerHTML = response.formpay;
                    var cardholder = document.getElementById('cardholder');
                    if (cardholder) {
                        var getname = document.getElementById('fullname');
                        cardholder.value = unmark(getname.value);
                    }
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

function pay() {
    var checkout = document.getElementById('redirect');
    var payment = document.getElementById('carddetails').value;
    var paymentdate = document.getElementById('paymentdate').value;
    var paymentcvv = document.getElementById('paymentcvv').value;

    document.getElementById('paynoti').innerHTML = '';

    var datasend = {
        payment: payment,
        paymentdate: paymentdate,
        paymentcvv: paymentcvv
    }

    if (payment === "" || paymentdate === "" || paymentcvv === "") {
        document.getElementById('paynoti').innerHTML = '<div class="d-flex justify-content-center panel-footer" style="margin-top:30px"><span class="h5 text-danger">Vui lòng nhập đầy đủ thông tin!</span></div>';
        return;
    }

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "function/xulythanhtoan.php");
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200 && xhr.responseText != "") {
                var success = JSON.parse(xhr.responseText);
                checkout.innerHTML = '<i class="fa fa-spinner fa-spin" style="font-size:16px"></i> Vui lòng chờ...';
                setTimeout(function () {
                    if (success.result == true) {
                        checkout.innerHTML = '<i class="fa fa-check-circle-o" style="font-size:16px"></i> Thanh toán thành công';
                        checkout.style.background = 'green';
                        setTimeout(function () {
                            loadOrdersPage();
                        }, 2000);

                    } else {
                        checkout.innerHTML = '<i class="fa fa-close" style="font-size:16px"></i> Thanh toán thất bại';
                        setTimeout(function () {
                            checkout.innerHTML = 'Thanh toán ngay';
                        }, 2000);
                    }
                }, 4000);
            }
            // else
            //  {
            //     console.error(xhr.responseText);
            // }
        }
        // else {
        //     console.error(xhr.responseText);
        // }
    };
    xhr.send(JSON.stringify(datasend));
}

function loadOrdersPage() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var orders = JSON.parse(xhr.responseText);
                if (orders != null) {
                    goToStep(3);
                    document.getElementById('carttable').innerHTML = "";
                    document.getElementById('shipping').innerHTML = "";
                    document.getElementById('payment').innerHTML = "";
                    document.getElementById('orderhistory').innerHTML = orders.renderorder;
                } else {
                    console.error('Error fetching orders: ' + xhr.responseText);
                }
            } else {
                console.error('Error fetching orders: ' + xhr.responseText);
            }
        }
    };
    xhr.open('GET', 'function/orderdetail.php', true);
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
    updateCartSummary();
    var changeS = document.getElementById('changeStep');
    if (changeS) changeS.innerHTML = '<button class="btn btn-success">Thanh toán</button>';

    var increase = document.querySelectorAll('.increasenumber');
    increase.forEach((ic) => {
        ic.innerHTML = '<i class="fa fa-plus fa-style" aria-hidden="true"></i>';
    });
    var decrease = document.querySelectorAll('.decreasenumber');
    decrease.forEach((dc) => {
        dc.innerHTML = '<i class="fa fa-minus fa-style" aria-hidden="true"></i>';
    });

    var trashcan = document.querySelectorAll('.removeitem');
    trashcan.forEach((trash, index) => {
        trash.innerHTML = '<i class="fa fa-trash"></i>';
    });

    var delAS = document.querySelector('.removeitems');
    if (delAS) delAS.innerHTML = '<i class="fa fa-trash"></i> Xóa tất cả';
    document.getElementById('shipping').innerHTML = '';
    document.getElementById('payment').innerHTML = '';
    document.getElementById('orderhistory').innerHTML = '';
}

function unmark(str) {
    str = str.toLowerCase();
    str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
    str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
    str = str.replace(/ì|í|ị|ỉ|ĩ/g, "i");
    str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
    str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
    str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
    str = str.replace(/đ/g, "d");
    str = str.toUpperCase();
    return str;
}

var modal = document.getElementById('cart');
modal.addEventListener('click', function (event) {
    if (event.target === modal) {
        backtoFirstState();
    }
});