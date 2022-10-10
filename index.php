<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Crud Project in php mysql</title>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.css" rel="stylesheet" />
</head>

<body class="bg-black">

    <div class="container">
        <div class="row">
            <div class="col-lg-6 mx-auto">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4>Upload Your Image</h4>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group mb-3">
                                <label for="">Upload Image</label>
                                <input type="file" class="form-control" id="imgInp" required>
                            </div>
                            <div class="form-group mb-3 ">
                                <img src="https://www.pngitem.com/pimgs/m/35-350426_profile-icon-png-default-profile-picture-png-transparent.png" alt="" class="img-fluid img-thumbnail" id="imgPreview" style="max-width: 200px; height: 100px;">
                            </div>
                            <div class="form-group">
                                <button type="button" class="btn btn-success upload_btn">Upload Now</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!------display image ------>
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="card shadow my-4">
                    <div class="card-header  text-white" style="background-color: #FF01E0;">
                        <h4>Upload All Image</h4>
                    </div>
                    <div class="card-body">
                        <div class="row" id="image_area">
                            <div class="col-sm-3 mb-3 ">
                                <img src="https://www.pngitem.com/pimgs/m/35-350426_profile-icon-png-default-profile-picture-png-transparent.png" alt="" class="img-fluid img-thumbnail" style="max-width: 200px; height: 100px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            //get all image 
             getAllImage();
            function getAllImage(){
                var getImage="0";
                $.ajax({
                    type: 'POST',
                    data:{ getImage:getImage},
                    url: 'action.php', 
                    success: function(response) {
                        $("#image_area").html(response);
                        
                    }
                });
            }

            //preview image beore uploaded
            imgInp.onchange = evt => {
                const [file] = imgInp.files
                if (file) {
                    imgPreview.src = URL.createObjectURL(file)
                }
            }
            $('.upload_btn').click(function() {
                var imageData = $("#imgInp").prop('files')[0];
                var form_data = new FormData();
                var addImage = "0";
                form_data.append('file', imageData);
                form_data.append('addData', addImage);
                $.ajax({
                    type: 'POST',
                    url: 'action.php',
                    data: form_data,
                    dataType: 'script',
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        console.log(response);
                        if (response == 1) {
                            alert('Image Uploaded successfully');
                            setTimeout(() => {
                                location.reload();
                            }, 1000);
                        } else {
                            alert('Image Not Uploaded ');
                        }
                    }
                });
            });
            // function deleteImage(deleteId){
            //     alert(deleteId);
            // }
            $(document).on('click','.deleteBtn',function(){
                //
                var dataId=$(this).data('id');
                var deleteData="0";
                $.ajax({
                    type: 'POST',
                    url: 'action.php',
                    data: {deleteData:deleteData,id:dataId},
                    success: function(response) {
                        console.log(response);
                        // if (response == 1) {
                        //     alert('Image Uploaded successfully');
                        //     setTimeout(() => {
                        //         location.reload();
                        //     }, 1000);
                        // } else {
                        //     alert('Image Not Uploaded ');
                        // }
                    }
                });
            });
        });
    </script>
</body>

</html>