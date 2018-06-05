"use strict";

function Modal(modal_id) {
    var _back_modal = document.getElementById("modal");
    var _modal = document.getElementById(modal_id);
    
    this.elem = _modal;

    this.show = function () {
        _back_modal.style.display = "block";
        _modal.style.display = "block";
    }

    this.hide = function () {
        _back_modal.style.display = "none";
        _modal.style.display = "none";
    }

    this.setText = function (text) {
        if (text == undefined) {
            _modal.innerHTML = "Пожалуйста, подождите...";
            return;
        }
        _modal.innerHTML = text;
    }
}

var wait_window = new Modal("wait_window");
var create_window = new Modal("create_window");
var form = document.forms[0];

document.getElementsByClassName("add_article_btn")[0].addEventListener("click", function () {
    create_window.show();
});

document.getElementById("modal").addEventListener("click", function (e) {
    if (create_window.elem.contains(document.elementFromPoint(e.pageX, e.pageY))) return;
    create_window.hide();
});

form.addEventListener("submit", function (e) {
    e.preventDefault();
    
    create_window.hide();
    wait_window.setText();
    wait_window.show();
    
    var xhr = new XMLHttpRequest();

    xhr.open("post", "/create_article.php", true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState != 4) return;

        if (xhr.status != 200) {
            wait_window.setText(xhr.status + ": " + xhr.statusText);
        } else {
            wait_window.setText("Статья успешно добавлена!");

            setTimeout(function () {
                wait_window.hide();
                location.reload();
            }, 2000);
        }
    }

    xhr.send(new FormData(form));
    
});
