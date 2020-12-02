/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

const CAPTION_POPOUT = "caption_popout";
const UPLOAD_POPOUT = "upload_popout";

$(document).ready(function () {
    // When like button is clicked
    $(".like-btn").on("click", function () {
        var post_id = $(this).data("id");
        $clicked_btn = $(this);
        if ($clicked_btn.hasClass("fa-thumbs-o-up")) {
            action = "like";
        } else if ($clicked_btn.hasClass("fa-thumbs-up")) {
            action = "unlike";
        }
        $.ajax({
            url: "server.php",
            type: "post",
            data: {
                "action": action,
                "post_id": post_id
            },
            success: function (data) {
                res = JSON.parse(data);
                if (action == "like") {
                    $clicked_btn.removeClass("fa-thumbs-o-up");
                    $clicked_btn.addClass("fa-thumbs-up");
                } else if (action == "unlike") {
                    $clicked_btn.removeClass("fa-thumbs-up");
                    $clicked_btn.addClass("fa-thumbs-o-up");
                }
                // Display the number of likes and dislikes
                $clicked_btn.siblings("span.likes").text(res.likes);
                $clicked_btn.siblings("span.dislikes").text(res.dislikes);

                // Change button styling of the other button if other button is clicked the second time
                $clicked_btn.siblings("i.fa-thumbs-down").removeClass("fa-thumbs-down").addClass("fa-thumbs-o-down");
            }
        });
    });

    // When dislike button is clicked
    $(".dislike-btn").on("click", function () {
        var post_id = $(this).data("id");
        $clicked_btn = $(this);
        if ($clicked_btn.hasClass("fa-thumbs-o-down")) {
            action = "dislike";
        } else if ($clicked_btn.hasClass("fa-thumbs-down")) {
            action = "undislike";
        }
        $.ajax({
            url: "server.php",
            type: "post",
            data: {
                "action": action,
                "post_id": post_id
            },
            success: function (data) {
                res = JSON.parse(data);
                if (action == "dislike") {
                    $clicked_btn.removeClass("fa-thumbs-o-down");
                    $clicked_btn.addClass("fa-thumbs-down");
                } else if (action == "undislike") {
                    $clicked_btn.removeClass("fa-thumbs-down");
                    $clicked_btn.addClass("fa-thumbs-o-down");
                }
                // Display the number of likes and dislikes
                $clicked_btn.siblings("span.likes").text(res.likes);
                $clicked_btn.siblings("span.dislikes").text(res.dislikes);

                // Change button styling of the other button if other button is clicked the second time
                $clicked_btn.siblings("i.fa-thumbs-up").removeClass("fa-thumbs-up").addClass("fa-thumbs-o-up");
            }
        });
    });
});

function resize() {
    var uploadpopout = document.getElementById(UPLOAD_POPOUT);
    //define the width to resize e.g 600px
    var resize_width = 100;//without px

    //get the image selected
    var item = document.querySelector('#uploader').files[0];

    //create a FileReader
    var reader = new FileReader();

    //image turned to base64-encoded Data URI.
    reader.readAsDataURL(item);
    reader.name = item.name;//get the image's name
    reader.size = item.size; //get the image's size
    reader.onload = function (event) {
        var img = new Image();//create a image
        img.src = event.target.result;//result is base64-encoded Data URI
        img.name = event.target.name;//set name (optional)
        img.size = event.target.size;//set size (optional)
        img.onload = function (el) {
            var elem = document.createElement('canvas');//create a canvas

            //scale the image to 600 (width) and keep aspect ratio
            var scaleFactor = resize_width / el.target.width;
            elem.width = resize_width;
            elem.height = el.target.height * scaleFactor;

            //draw in canvas
            var ctx = elem.getContext('2d');
            ctx.drawImage(el.target, 0, 0, elem.width, elem.height);

            //get the base64-encoded Data URI from the resize image
            var srcEncoded = ctx.canvas.toDataURL(el.target, 'image/jpeg', 0);

            if (uploadpopout !== null) {
                $("#" + UPLOAD_POPOUT).remove();
            }

            uploadpopout = document.createElement("span");
            uploadpopout.id = UPLOAD_POPOUT;
            uploadpopout.innerHTML = '<img id="image" alt="Temp Image">';
            document.getElementById("uploader").insertAdjacentElement("afterend", uploadpopout);

            //assign it to thumb src
            document.querySelector('#image').src = srcEncoded;
            document.getElementById("b64").value = srcEncoded.split(",")[1];
            console.log(srcEncoded.split(",")[1]);
        }
    }
}

function togglePopout() {
    var popout = document.getElementById(CAPTION_POPOUT);

    if (popout !== null) {
        $("#" + CAPTION_POPOUT).remove();
    }
    popout = document.createElement("span");
    popout.id = CAPTION_POPOUT;
    popout.innerHTML = '<br><label for="caption">Caption</label><br><textarea id="caption" name="caption" rows="4" cols="50"></textarea>';
    document.getElementById("uploader").insertAdjacentElement("afterend", popout);
}

document.getElementById("uploader").addEventListener("change", resize);
document.getElementById("uploader").addEventListener("change", togglePopout);