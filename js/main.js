/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

const CAPTION_POPOUT = "caption_popout";

/*
 $('.img-thumbnail').click(function () {
 var src = $(this).attr('src');
 $('.modal').modal('show');
 $('#popup-img').attr('src', src);
 });
 */

$(document).ready(function () {
    activateMenu();
});

function toggle() {
    var like = document.getElementById("like");
    
    if (like.className === "like-border") {
        like.className = "like-black";
        like.src = "images/baseline_favorite_black_18dp.png";
    } else if (like.className === "like-black") {
        like.className = "like-border";
        like.src = "images/baseline_favorite_border_18dp.png";
    }
}

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

function resize(){
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
  reader.onload = function(event) {
    var img = new Image();//create a image
    img.src = event.target.result;//result is base64-encoded Data URI
    img.name = event.target.name;//set name (optional)
    img.size = event.target.size;//set size (optional)
    img.onload = function(el) {
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

      //assign it to thumb src
      document.querySelector('#image').src = srcEncoded;
      document.getElementById("b64").value = srcEncoded.split(",")[1];
      console.log(srcEncoded.split(",")[1]);
      /*Now you can send "srcEncoded" to the server and
      convert it to a png o jpg. Also can send
      "el.target.name" that is the file's name.*/
      
      /*Also if you want to download tha image use this*/
      /*
      var a = document.createElement("a"); //Create <a>
      a.href =  srcEncoded; //set srcEncoded as src
      a.download = "myimage.png"; //set a name for the file
      a.click();
      
      */


    }
  }
}

function togglePopout() {
    var popout = document.getElementById(CAPTION_POPOUT);

    if (popout === null) {
        popout = document.createElement("span");
        popout.id = CAPTION_POPOUT;
        var big_image
        popout.innerHTML = '<textarea id="caption" name="caption" rows="4" cols="50"></textarea>';
        document.getElementById("image").insertAdjacentElement("afterend", popout);
    } else {
        $("#" + CAPTION_POPOUT).remove();
    }
}

/*function imageCreateFromAny() {
    $filepath = document.getElementById("inp");
    $type = getImageSize($filepath); // [] if you don't have exif you could use getImageSize()
    $allowedTypes = array(
        1,  // [] gif
        2,  // [] jpg
        3,  // [] png
        6   // [] bmp
    );
    if (!in_array($type, $allowedTypes)) {
        return false;
    }
    switch ($type) {
        case 1 :
            $im = imageCreateFromGif($filepath);
            document.getElementById("resize").innerHTML=$im;
        break;
        case 2 :
            $im = imageCreateFromJpeg($filepath);
            document.getElementById("resize").innerHTML=$im;
        break;
        case 3 :
            $im = imageCreateFromPng($filepath);
            document.getElementById("resize").innerHTML=$im;
        break;
        case 6 :
            $im = imageCreateFromBmp($filepath);
            document.getElementById("resize").innerHTML=$im;
        break;
    }   
    return $im; 
}*/

// Image to Base64

/*function readFile() {

    if (this.files && this.files[0]) {

        var FR = new FileReader();

        FR.addEventListener("load", function (e) {
            document.getElementById("img").src = e.target.result;
            document.getElementById("b64").innerHTML = e.target.result.split(",")[1];
            console.log(e.target.result);
        });
        
        FR.readAsDataURL(this.files[0]);
    }
}
imageCreateFromAny();
document.getElementById("inp").addEventListener("change", readFile);*/
document.getElementById("uploader").addEventListener("change", resize);
document.getElementById("uploader").addEventListener("change", togglePopout);