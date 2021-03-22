<?php

$insert = false;

include "partials/_dbconnect.php";

 if(isset($_GET["delete"])){
   $sr_no = $_GET['delete'];
  //  echo $sr_no;

   $sql = "DELETE FROM `review` WHERE `review`.`sr_no` = $sr_no";
   $result = mysqli_query($conn, $sql);

 }

 if ($_SERVER["REQUEST_METHOD"] == "POST"){
   if(isset($_POST["sr_noEdit"])){
    //update the record 
    $sr_no = $_POST["sr_noEdit"];
    $name = $_POST["nameEdit"];
    $phone_no = $_POST["phone_noEdit"];
    $reviews = $_POST["reviewsEdit"];
    $email = $_POST["emailEdit"];
   $sql = "UPDATE `review` SET `name` = '$name' , `phone_no` = '$phone_no',`reviews` = '$reviews',`email` = '$email' WHERE `review`.`sr_no` = $sr_no";



  //  UPDATE `contact` SET `name` = 'shadab1', `phone_no` = '9987654091', `msg` = 'gfwtdfgcdghadgacd1' WHERE `contact`.`sr_no` = 1;
   $result = mysqli_query($conn, $sql);
   }
   else
   {

   
     $name = $_POST["name"];
     $phone_no = $_POST["phone_no"];
     $reviews = $_POST["reviews"];
     $email = $_POST["email"];
    
    $sql = "INSERT INTO `review` (`name`,  `phone_no`, `reviews`,`email`, `date`) VALUES ('$name',  '$phone_no', '$reviews','$email', current_timestamp())";
    $result = mysqli_query($conn, $sql);


        if($result){
            $insert = true;
        }
 }
 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD OPERATIONS</title>

<link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">


<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>

    
</head>
<body>

<!-- edit modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
  Edit modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Record</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <section class="container col-6">

<form method = "post">
<input type="hidden" name="sr_noEdit" id="sr_noEdit">
<div class="mb-3">
  <label for="name" class="form-label">Name</label>
  <input type="text"  name ="nameEdit" class="form-control" id="nameEdit" >
</div>
<div class="mb-3">
  <label for="phone_no" class="form-label">Phone No</label>
  <input type = "phone" name ="phone_noEdit" class="form-control" id="phone_noEdit" >
</div>

<div class="mb-3">
  <label for="reviews" class="form-label">Reviews</label>
  <textarea class="form-control" name ="reviewsEdit" id="reviewsEdit" row="3"  ></textarea>
</div>

<div class="mb-3">
  <label for="email" class="form-label">Email</label>
  <input type = "email" class="form-control" name ="emailEdit" id="emailEdit"  >
</div>


<div class = "form-group mb-3">

<button type="submit" text ="" class = " btn btn-success" id = "btn-submit">Update Record</button>
</div>
</form>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


   <?php require "partials/_header.php";
   ?>

   <?php
   if($insert){
       echo'<div class="alert alert-warning alert-dismissible fade show" role="alert">
       <strong>Success</strong> Your record has be recorded succesfully!
       <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
     </div>';
           }
   ?>
<section class="container col-6">
<div>
<h1> Add a record</h1>
<form action = "review.php" method = "post">
<div class="mb-3">
  <label for="name" class="form-label">Name</label>
  <input type="text"  name ="name" class="form-control" id="name" >
</div>
<div class="mb-3">
  <label for="phone_no" class="form-label">Phone No</label>
  <input type = "phone" name ="phone_no" class="form-control" id="phone_no" >
</div>

<div class="mb-3">
  <label for="reviews" class="form-label">Reviews</label>
  <textarea class="form-control" name ="reviews" id="reviews" row="3"  ></textarea>
</div>


<div class="mb-3">
  <label for="email" class="form-label">Email</label>
  <input type = "email" class="form-control" name ="email" id="email"  >
</div>


<div class = "form-group mb-3">

<button type="submit" class = " btn btn-success" id = "btn-submit">Add Record</button>
</div>
</form>
</div>
</section>



<div class="container">


<table class="table" id = "myTable">
  <thead>
    <tr>
      <th scope="col">Sr_no</th>
      <th scope="col">Name</th>
      <th scope="col">PhoneNo</th>
      <th scope="col">Reviews</th>
      <th scope="col">Email</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>

  <?php

$sql = "SELECT * FROM `review`";
$result = mysqli_query($conn, $sql);
$sr_no = 0;
while($row = mysqli_fetch_assoc($result)){

    $sr_no = $sr_no + 1;
    echo "<tr>
    <th scope='row'>".$sr_no."</th>
    <td>".$row['name']."</td>
    <td>".$row['phone_no']."</td>
    <td>".$row['reviews']."</td>
    <td>".$row['email']."</td>
    <td><button class='edit btn btn-sm btn-primary' id=".$row['sr_no'].">Edit</button> <button class='delete btn btn-sm btn-primary' id=d".$row['sr_no'].">Delete</button> </td>
  </tr>";

}



?>

  </tbody>
</table>
</div>

<?php require "partials/_footer.php";
   ?>

<script src ="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>


<script>
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ");
        tr = e.target.parentNode.parentNode;
        name = tr.getElementsByTagName("td")[0].innerText;
        phone_no = tr.getElementsByTagName("td")[1].innerText;
        reviews = tr.getElementsByTagName("td")[2].innerText;
        email = tr.getElementsByTagName("td")[3].innerText;
        console.log(name, phone_no,reviews,email);
        nameEdit.value = name;
        phone_noEdit.value = phone_no;
        reviewsEdit.value = reviews;
        emailEdit.value = email;
        sr_noEdit.value = e.target.id;
        console.log(e.target.id)

        var myModal = new bootstrap.Modal(document.getElementById('editModal'), {
  keyboard: false
})
        // $('#editModal').modal('toggle');
        myModal.toggle()
      })
    })

    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ");
        sr_no = e.target.id.substr(1);

        if (confirm("Are you sure you want to delete this note!")) {
          console.log("yes");
          window.location = `review.php?delete=${sr_no}`;
          // TODO: Create a form and use post request to submit a form
        }
        else {
          console.log("no");
        }
      })
    })
    </script>
</body>
</html>