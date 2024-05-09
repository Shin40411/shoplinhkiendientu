var featuredCars = document.querySelectorAll(".single-featured-cars");

function loadPage(page, id, id_cate) {
  var xhttp = new XMLHttpRequest();
  var target = '';
  if (id && id_cate) {
    xhttp.open("GET", "pages/" + page + ".php?id=" + id + "&id_category=" + id_cate, true);
    target = '#detail-pro'
  } else {
    xhttp.open("GET", "pages/" + page + ".php", true);
    target = '#orderclient';
  }
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {

      document.getElementById("app").innerHTML = this.responseText;
      console.log(featuredCars);

      window.location.href = target;
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
  sendbtn.innerHTML = '<i class="fa fa-spinner fa-spin" style="font-size:16px"></i> Vui lòng chờ...';

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

for (var i = 0; i < 4 && i < featuredCars.length; i++) {
  featuredCars[i].style.display = "unset";
}

var galleryButton = document.getElementById("gallery-btn");

galleryButton.addEventListener('click', function (event) {
  event.preventDefault();

  var hiddenFeaturedCars = document.querySelectorAll("#featured-cars > div > div.featured-cars-content > div.row > div > div:not([style='display: unset;'])");
  console.log(hiddenFeaturedCars);
  for (var i = 0; i < 4 && i < hiddenFeaturedCars.length; i++) {
    hiddenFeaturedCars[i].style.display = "unset";
    hiddenFeaturedCars[i].style.opacity = 0;
    fadeIn(hiddenFeaturedCars[i], 800);
  }

  if (hiddenFeaturedCars.length <= 4) {
    this.style.display = "none";
  }
});

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
