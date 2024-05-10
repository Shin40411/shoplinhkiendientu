
function loadPage(page, id, id_cate, tag) {
  var xhttp = new XMLHttpRequest();
  if (id && id_cate) {
    xhttp.open("GET", "pages/" + page + ".php?id=" + id + "&id_category=" + id_cate, true);
  } else {
    xhttp.open("GET", "pages/" + page + ".php", true);
  }
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {

      document.getElementById("app").innerHTML = this.responseText;
      // console.log(featuredCars);
      hidecontent();

      window.location.href = tag;
    }
  };

  xhttp.send();
}

var form = document.getElementById("contactform");

async function handleSubmit(event) {
  event.preventDefault();
  var status = document.getElementById("my-form-status");
  var data = new FormData(event.target);
  fetch(event.target.action, {
    method: form.method,
    body: data,
    headers: {
      'Accept': 'application/json'
    }
  }).then(response => {
    if (response.ok) {
      status.innerHTML = "Cảm ơn bạn đã liên hệ!";
      form.reset()
    } else {
      response.json().then(data => {
        if (Object.hasOwn(data, 'errors')) {
          status.innerHTML = data["errors"].map(error => error["message"]).join(", ")
        } else {
          status.innerHTML = "Đã có lỗi xảy ra! tin nhắn chưa được gửi đi"
        }
      })
    }
  }).catch(error => {
    status.innerHTML = "Đã có lỗi xảy ra! tin nhắn chưa được gửi đi"
  });
}

form.addEventListener("submit", handleSubmit)

function commentsend(idpro) {

  var review = document.getElementById('comment');
  var sendbtn = document.getElementById('cmt');

  var datasend = {
    commentmess: review.value,
    idproduct: idpro
  };

  if (review.value === "") {
    alert("Vui lòng nhập nội dung!");
    return;
  }

  var xhr = new XMLHttpRequest();
  xhr.open("POST", "function/comment.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhr.onreadystatechange = function () {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        var response = JSON.parse(xhr.responseText);
        if (response.success) {
          sendbtn.innerHTML = '<i class="fa fa-spinner fa-spin" style="font-size:16px"></i> Vui lòng chờ...';
          setTimeout(() => {
            alert("Bình luận đã được gửi đi, vui lòng chờ duyệt");
            review.value = '';
            sendbtn.innerHTML = 'Gửi bình luận';
          }, 5000);
        } else {
          alert(response.message);
        }
      } else {
        console.error("Failed to add item to cart. Status code: " + xhr.status);
      }
    }

  };

  xhr.send(JSON.stringify(datasend));
}

function loadCategory() {
  var functionName = 'getCategory';
  var url = 'function/search.php?function=' + encodeURIComponent(functionName);
  var xhr = new XMLHttpRequest();

  xhr.open('GET', url, true);

  xhr.onload = function () {
    if (xhr.status >= 200 && xhr.status < 300) {
      var categories = JSON.parse(xhr.responseText);

      var selectElement = document.getElementById('cate');

      selectElement.innerHTML = '';

      var defaultOption = document.createElement('option');
      defaultOption.value = '';
      defaultOption.textContent = 'Chọn danh mục';
      selectElement.appendChild(defaultOption);

      categories.forEach(function (category) {
        var option = document.createElement('option');
        option.value = category.id;
        option.textContent = category.name;
        selectElement.appendChild(option);
      });
    } else {
      console.error('Request failed with status', xhr.status);
    }
  };

  xhr.onerror = function () {
    console.error('Request failed');
  };

  xhr.send();
}

loadCategory();

function getSelectedValue(selectId) {
  var selectElement = document.getElementById(selectId);
  var selectedOption = selectElement.options[selectElement.selectedIndex];
  return selectedOption.value;
}

function search() {
  var yearselected = getSelectedValue("searchyear");
  var priceselected = getSelectedValue("searchprice");
  var viewselected = getSelectedValue("searchviews");
  var cateselected = getSelectedValue("cate");
  var searchkeyword = document.getElementById("searchkeyword");

  if (yearselected === "" && priceselected === "" && viewselected === "" && cateselected === "" && searchkeyword.value === "") {
    alert('Vui lòng nhập ít nhất 1 điều kiện');
    return;
  }

  var data = {
    yearproduce: yearselected,
    views: priceselected,
    price: viewselected,
    category: cateselected,
    keyword: searchkeyword.value
  };

  var functionName = 'searching';
  var url = 'function/search.php?function=' + encodeURIComponent(functionName);

  var xhr = new XMLHttpRequest();
  xhr.open("POST", url);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhr.onreadystatechange = function () {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        document.getElementById('searchsubmission').innerHTML = '<i class="fa fa-spinner fa-spin" style="font-size:16px"></i> Vui lòng chờ...';
        var result = JSON.parse(xhr.responseText);
        setTimeout(function () {
          document.getElementById('searchcontainer').innerHTML = result.RenderHtml;
          searchkeyword.value = "";
          document.getElementById('searchsubmission').innerHTML = '<i class="fa fa-search" style="font-size: 30px"></i>';
        }, 4000);
      } else {
        console.error(xhr.status);
      }
    }
  };

  xhr.send(JSON.stringify(data));
}

function showPassword() {
  var x = document.getElementById("personalpassword");
  var icon = document.querySelector('.showpass');
  if (x.type === "password") {
    x.type = "text";
    icon.classList.remove('fa-eye');
    icon.classList.add('fa-eye-slash');
  } else {
    x.type = "password";
    icon.classList.remove('fa-eye-slash');
    icon.classList.add('fa-eye');
  }
}


function hidecontent() {
  var featuredCars = document.querySelectorAll(".single-featured-cars");

  for (var i = 0; i < 8 && i < featuredCars.length; i++) {
    featuredCars[i].style.display = "unset";
  }
}

hidecontent();

function showmore(e) {
  event.preventDefault();
  var hiddenFeaturedCars = document.querySelectorAll("#featured-cars > div > div.featured-cars-content > div.row > div > div:not([style='display: unset;'])");
  // console.log(hiddenFeaturedCars);
  for (var i = 0; i < hiddenFeaturedCars.length; i++) {
    hiddenFeaturedCars[i].style.display = "unset";
    hiddenFeaturedCars[i].style.opacity = 0;
    fadeIn(hiddenFeaturedCars[i], 800);
  }

  if (hiddenFeaturedCars.length <= hiddenFeaturedCars.length) {
    e.style.display = "none";
  }
}

function fadeIn(element, duration) {
  var increment = 16 / duration;
  var opacity = 0;
  element.style.opacity = 0;
  (function fade() {
    opacity += increment;
    element.style.opacity = opacity;
    if (opacity >= 1) {
      opacity = 1;
    } else {
      setTimeout(fade, 16);
    }
  })();
}

function editPersonalInfo() {
  var name = document.getElementById("personalname").value.trim();
  var email = document.getElementById("personalemail").value.trim();
  var password = document.getElementById("personalpassword").value.trim();

  var submitBtn = document.getElementById("submitinfo");

  if (name === "" || email === "" || password === "") {
    alert("Please fill in all required fields.");
    return;
  }
  var formData = new FormData(document.getElementById("updateForm"));
  var xhr = new XMLHttpRequest();

  submitBtn.innerHTML = '<i class="fa fa-spinner fa-spin" style="font-size:16px"></i> Vui lòng chờ...';
  xhr.onreadystatechange = function () {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        var response = JSON.parse(xhr.responseText);
        if (response.success) {
          setTimeout(function () {
            loadPage('taikhoancuatoi', '', '', '#myaccount');
            alert("Cập nhật thông tin thành công!");
            submitBtn.innerHTML = "Cập nhật";
          }, 4000);
        } else {
          alert("Lỗi: " + response.message);
          submitBtn.innerHTML = "Cập nhật";
        }
      } else {
        alert('Error occurred during update: ' + xhr.status);
        submitBtn.innerHTML = "Cập nhật";
      }
    }
  };

  xhr.open("POST", "function/personal.php", true);
  xhr.send(formData);
}