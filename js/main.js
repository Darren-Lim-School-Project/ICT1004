/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/*
 $('.img-thumbnail').click(function () {
 var src = $(this).attr('src');
 $('.modal').modal('show');
 $('#popup-img').attr('src', src);
 });
 */
const ID_POPUP = "id_popup";
const sign_in_btn = document.querySelector("#sign-in-btn");
const sign_up_btn = document.querySelector("#sign-up-btn");
const container = document.querySelector(".logreg-container");

$(document).ready(function () {
    registerEventHandlers();
    activateMenu();
});

function activateMenu() {
    var current_page_URL = location.href;

    $(".navbar-nav a").each(function ()
    {
        var target_URL = $(this).prop("href");
        if (target_URL === current_page_URL) {
            $('nav a').parents('li, ul').removeClass('active');
            $(this).parent('li').addClass('active');
            return false;
        }
    });
}

function registerEventHandlers() {
    var thumbnails = document.getElementsByClassName("img-thumbnail");
    if (thumbnails !== null) {
        for (var i = 0; i < thumbnails.length; i++) {
            var thumbnail = thumbnails[i];
            thumbnail.addEventListener("click", togglePopup);
        }
    } else {
        console.log("No thumbnail images found!");
    }
}

function togglePopup(e) {
    var popup = document.getElementById(ID_POPUP);

    if (popup === null) {
        popup = document.createElement("span");
        popup.id = ID_POPUP;
        popup.setAttribute("class", "img-popup");

        var thumbnail = e.target;
        var small_image = thumbnail.src;
        var big_image = small_image.replace("_small", "_large");

        popup.innerHTML = '<img src=' + big_image + '>';
        thumbnail.insertAdjacentElement("afterend", popup);
    } else {
        $("#" + ID_POPUP).remove();
    }
}

// Image to Base64
function readFile() {

    if (this.files && this.files[0]) {

        var FR = new FileReader();

        FR.addEventListener("load", function (e) {
            document.getElementById("img").src = e.target.result;
            document.getElementById("b64").innerHTML = e.target.result;
            console.log(e.target.result);
        });
        
        FR.readAsDataURL(this.files[0]);
    }
}

document.getElementById("inp").addEventListener("change", readFile);