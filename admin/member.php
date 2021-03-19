<?php

$insert = false;

include "partials/_dbconnect.php";


 if ($_SERVER["REQUEST_METHOD"] == "POST"){
     $name = $_POST["name"];
     $phone_no = $_POST["phone_no"];
     $message = $_POST["msg"];
    
    $sql = "INSERT INTO `contact` (`name`,  `phone_no`, `msg`, `date`) VALUES ('$name',  '$phone_no', '$message', current_timestamp())";
    $result = mysqli_query($conn, $sql);


        if($result){
            $insert = true;
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
  <label for="meassage" class="form-label">Mesaage</label>
  <textarea class="form-control" name ="messageEdit" id="messageEdit" row="3"  ></textarea>
</div>


<div class = "form-group mb-3">

<input type="submit" text ="Update Record" class = " btn btn-success" id = "btn-submit">
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
<form method = "post">
<div class="mb-3">
  <label for="name" class="form-label">Name</label>
  <input type="text"  name ="name" class="form-control" id="name" >
</div>
<div class="mb-3">
  <label for="phone_no" class="form-label">Phone No</label>
  <input type = "phone" name ="phone_no" class="form-control" id="phone_no" >
</div>

<div class="mb-3">
  <label for="meassage" class="form-label">Mesaage</label>
  <textarea class="form-control" name ="msg" id="phone_no" row="3"  ></textarea>
</div>


<div class = "form-group mb-3">

<input type="submit" text ="Submit" class = " btn btn-success" id = "btn-submit">
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
      <th scope="col">Message</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>

  <?php

$sql = "SELECT * FROM `contact`";
$result = mysqli_query($conn, $sql);
$sr_no = 0;
while($row = mysqli_fetch_assoc($result)){

    $sr_no = $sr_no + 1;
    echo "<tr>
    <th scope='row'>".$sr_no."</th>
    <td>".$row['name']."</td>
    <td>".$row['phone_no']."</td>
    <td>".$row['msg']."</td>
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
        message = tr.getElementsByTagName("td")[2].innerText;
        console.log(name, phone_no,message);
        nameEdit.value = name;
        phone_noEdit.value = phone_no;
        messageEdit.value = message;
        sr_noEdit.value = e.target.id;
        console.log(e.target.id)
        $('#editModal').modal('toggle');
      })
    })
</body>
</html>