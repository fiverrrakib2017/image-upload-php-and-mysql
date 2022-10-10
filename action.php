<?php 
$con=new mysqli("localhost","root","","shop");

if (isset($_POST['addData'])) {
   $file_name= $_FILES['file']['name'];
   $file_size= $_FILES['file']['size'];

   $extension=pathinfo($file_name,PATHINFO_EXTENSION);
   $valid_extension=array("jpg","jped","gif","png");
   $maxSize=2*1024*1024;
   if($file_size >$maxSize){
        echo 2;
   }else{
        if (in_array($extension,$valid_extension)) {
            $new_name=rand().".".$extension;
            $path="image/".$new_name;
            $result=move_uploaded_file($_FILES['file']['tmp_name'],$path);
            $con->query("INSERT INTO upload_image(path_name	)VALUES('$path')");
            echo 1;
        }
   }

}

//get all image 
if (isset($_POST['getImage'])) {
   //if($con->query("SELECT id,path_name FROM upload_image"){}
   if ($ALLdATA=$con->query("SELECT id,path_name FROM upload_image")) {
        while ($rows=$ALLdATA->fetch_array()) {
            echo '<div class="col-sm-3 mb-3 ">
            <img src=" '.$rows['path_name'].' " alt="" class="img-fluid img-thumbnail" style="max-width: 200px; height: 100px;"><br>
            <button type="button" class="btn-sm btn btn-danger deleteBtn" data-id="'.$rows['id'].'">Delete</button>
        </div>';
        }
   }
}

//delete Data

if (isset($_POST['deleteData'])) {
    $id=$_POST['id'];
    if ($allData=$con->query("SELECT * FROM upload_image WHERE id=$id ")) {
        while ($rows=$allData->fetch_array()) {
            $path=$rows['path_name'];
          
        }
        
    }
}



?>