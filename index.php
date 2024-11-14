<?php
if(isset($_POST['download'])){
    $imgUrl = $_POST['imgUrl']; //get img url from hidden input
    $ch = curl_init($imgUrl);// init curl
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);// transfers data  as the return value of curl_exec 
     $download  = curl_exec($ch);
     curl_close($ch);
     //set download header
     header('Content-Type: image/jpeg');
     header('Content-Disposition: attachment; filename="thumbnail.jpg"');
  echo $download;
  exit();
}
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Youtube Thumbnail Download</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <div class="card-header text-mute">
                            <h1>Download Thumbnial</h1>
                        </div>
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="">Past Url:</label>
                                <input type="text" placeholder="www.youtube.com.np" id="urlField" class="form-control" required>
                           <input type="hidden" name="imgUrl" class="hidden-input">
                            </div>
                            <div class="preview-area">
                                <img class="thumbnail" src="" alt="thumbnail" style=display:none;width:450px;height:300px;>
                                <span>Paste Video url to see preview</span>
                            </div>
                            <button type="submit" name="download"  class="btn btn-primary">Download Thumbnail</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const urlField = document.querySelector("#urlField");
        previewArea = document.querySelector(".preview-area");
        imgTag = previewArea.querySelector(".thumbnail");
        hiddenInput = document.querySelector(".hidden-input");
        
        urlField.onkeyup = ()=>{
            let imgUrl = urlField.value;// user value;
           let ytThumbUrl;
// full youtube video url format
            if(imgUrl.indexOf("https://www.youtube.com/watch?v=")!== -1){// youtubr video url link
          let vidId = imgUrl.split("v=")[1].substring(0,11);
          ytThumbUrl = `https://img.youtube.com/vi/${vidId}/maxresdefault.jpg`;
        
            }
            else if(imgUrl.indexOf("https://youtu.be/")!== -1) { // video url 
                let vidId = imgUrl.split("https://youtu.be/")[1].substring(0,11);
                ytThumbUrl = `https://img.youtube.com/vi/${vidId}/maxresdefault.jpg`;
        
            }
             else if (imgUrl.match(/\.(jpg|png|gif|bmp|webp)$/i)){// img file url
                ytThumbUrl= imgUrl;
            }else{
                imgTag.src = "";
                previewArea.classList.remove("active");
                return;
            }
            imgTag.src = ytThumbUrl;// set thumbnail url
            imgTag.style.display='block';
             hiddenInput.value = ytThumbUrl; 
        };
    </script>

      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>