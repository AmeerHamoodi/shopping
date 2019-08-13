<?php

$conn = mysqli_connect("localhost", "root", "", "shopping");

if(isset($_POST['fileuploadsubmit'])) {

 $fileupload = $_FILES['fileupload']['name'];

 $fileuploadTMP = $_FILES['fileupload']['tmp_name'];

 $folder = "images/";


$company = $_POST['company'];
$obj = $_POST['object'];
$price = $_POST['price'];

$select = $_POST['topics'];


move_uploaded_file($fileuploadTMP, $folder.$fileupload);



$sql = "INSERT INTO `updis`(imagename, name, price, company_name, selector) VALUES ('$fileupload', '$obj', '$price', '$company', '$select')";

$qry = mysqli_query($conn, $sql);



}

?>
<?php
session_start();  
 $connect = mysqli_connect("localhost", "root", "", "test");  
 if(isset($_POST["add_to_cart"]))  
 {  
      if(isset($_SESSION["shopping_cart"]))  
      {  
           $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");  
           if(!in_array($_GET["id"], $item_array_id))  
           {  
                $count = count($_SESSION["shopping_cart"]);  
                $item_array = array(  
                     'item_id'               =>     $_GET["id"],  
                     'item_name'               =>     $_POST["hidden_name"],  
                     'item_price'          =>     $_POST["hidden_price"],  
                     'item_quantity'          =>     $_POST["quantity"]  
                );  
                $_SESSION["shopping_cart"][$count] = $item_array;  
           }  
           else  
           {  
                echo '<script>alert("Item Already Added")</script>';  
                echo '<script>window.location="index.php"</script>';  
           }  
      }  
      else  
      {  
           $item_array = array(  
                'item_id'               =>     $_GET["id"],  
                'item_name'               =>     $_POST["hidden_name"],  
                'item_price'          =>     $_POST["hidden_price"],  
                'item_quantity'          =>     $_POST["quantity"]  
           );  
           $_SESSION["shopping_cart"][0] = $item_array;  
      }  
 }  
 if(isset($_GET["action"]))  
 {  
      if($_GET["action"] == "delete")  
      {  
           foreach($_SESSION["shopping_cart"] as $keys => $values)  
           {  
                if($values["item_id"] == $_GET["id"])  
                {  
                     unset($_SESSION["shopping_cart"][$keys]);  
                     echo '<script>alert("Item Removed")</script>';  
                     echo '<script>window.location="index.php"</script>';  
                }  
           }  
      }  
 } 

 if(isset($_POST['sub'])){
  if(isset($_SESSION['name'])){
    header("Location: index.php?logged=true");
      

  
  }else{
  
  $first = mysqli_real_escape_string($conn, $_POST['first']);
  $last = mysqli_real_escape_string($conn, $_POST['last']);
  $email = mysqli_real_escape_string($conn, $_POST['mail']);
  $psw = mysqli_real_escape_string($conn, $_POST['psw']);
  $psw2 = mysqli_real_escape_string($conn, $_POST['psw2']);

  if($psw == $psw2){
    $stmt = $conn->prepare("INSERT INTO users(first, last, email, psw) VALUES(?,?,?,?)");
    $stmt->bind_param("ssss", $first, $last, $email, $psw);
    $stmt->execute();

    $_SESSION['name'] = $first;




  }else{
    header("Location: index.php?password!=password"); 


  

}
}
}

if(isset($_POST['suby'])){
    $first = mysqli_real_escape_string($conn, $_POST['first']);
    $psw = mysqli_real_escape_string($conn, $_POST['psw']);

    $sql = "SELECT * FROM users WHERE first = '$first' AND psw = '$psw' ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);

    if($row['psw'] == $psw && $row['first'] == $first){
      header("Location:index.php?logged=true");
      $_SESSION['name'] = $first;
    }else{
      echo "Email or password is inccorect";
    }
  }

 
 ?>  



<!DOCTYPE html>
<html>
<head>
  <style type="text/css">
  #hide{
    margin-top: 9px;
    margin-left: 5px;
    margin-right: 5px;
  }
  #max{
    margin-top: 10px; 
  }
  .dane{
    margin-left: 5px;
  }
  .well img{
    height: 200px;
    width: 200px;
  }
  .modal-header, h4.log, .close {
      background-color: #5cb85c;
      color:white !important;
      text-align: center;
      font-size: 30px;
  }
  .modal-footer {
      background-color: #f9f9f9;
  }
  #myBtn{
    color: white;
    margin-top: 9px;
    float: right;
  }

</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body class="actual">
  <div class="content">
  <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">MerShop-co.</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Home</a></li>
    </ul>
    <?php
    if(isset($_SESSION['name'])){ ?>
    <form action="logout.php" method="POST">
    <button class="btn btn-danger navbar-right" type="submit" style="margin-top: 9px; margin-left: 7px; margin-right: 1px;">Logout
    </button>
  </form>
  <?php
}?>
    <form class="navbar-form navbar-right" action="search.php">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Search" name="search">
        <div class="input-group-btn">
          <button class="btn btn-default" type="submit">
            <i class="glyphicon glyphicon-search"></i>
          </button>
        </div>
      </div>
    </form>
    <?php if(isset($_SESSION['name'])){
      echo "<button class = 'btn btn-success navbar-right' id ='hide'><span class = 'glyphicon glyphicon-cloud-upload'></span> Upload new products</button> ";
    }
    ?>
    <button class="btn btn-success" id="myBtn"><span class="glyphicon glyphicon-user" > Login </span></button>
  </div>
  
</nav>
<?php 
if(isset($_SESSION['name'])){
echo "<h4>Welcome ".$_SESSION['name']." to MerShop-co";
}
?>

    <div class="modal fade" id="signUpp" role = "dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header" style="padding: 35px 50px;">
            <button type="button" class="close" data-dismiss = "modal">&times;</button>
            <h4 class="log"><span class="glyphicon glyphicon-lock"></span> Signup</h4>
          </div>
          <div class="modal-body">
            <form role="form" action="" method="POST">
              <div class="form-group">
                <label for ="first"><span class="glyphicon glyphicon-user"></span> Firstname</label>
                <input type="text" class = "form-control" name="first" placeholder="enter your Firstname">
              </div>
              <div class="form-group">
                <label for="last"><span class="glyphicon glyphicon-user"></span> Lastname</label>
                <input type="text" class = "form-control" name="last" placeholder="enter your Lastname">
              </div>
              <div class="form-group">
                <label for="mail"><span class="glyphicon glyphicon-envelope"></span> Email</label>
                <input type="email" class = "form-control" name="mail" placeholder="enter your email">
              </div>
              <div class="form-group">
                <label for="psw"><span class="glyphicon glyphicon-lock"></span> Password</label>
                <input type="password" class = "form-control" name="psw" placeholder="enter your password">
              </div>
              <div class="form-group">
                <label for="psw2"><span class="glyphicon glyphicon-lock"></span> Check your password</label>
                <input type="password" class = "form-control" name="psw2" placeholder="double check your password">
              </div>
              <button type="submit" name="sub" class="btn btn-success"><span class="glyphicon glyphicon-check"></span> Submit</button>
            </form>
          </div>
          <div class="modal-footer">
            <b>By pressing submit you agree to our <a href="#">Terms & conditions</a></b>
          </div>
      </div>
    </div>
</div>
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="padding:35px 50px;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="log"><span class="glyphicon glyphicon-lock"></span> Login</h4>
        </div>
        <div class="modal-body" style="padding:40px 50px;">
          <form role="form" action="" method="POST">
            <div class="form-group">
              <label for="usrname"><span class="glyphicon glyphicon-user"></span> Username</label>
              <input type="text" class="form-control" id="usrname" name = "first" placeholder="Enter Firstname">
            </div>
            <div class="form-group">
              <label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Password</label>
              <input type="password" class="form-control" name = "psw" id="psw" placeholder="Enter password">
            </div>
            <div class="checkbox">
              <label><input type="checkbox" value="" checked>Remember me</label>
            </div>
              <button type="submit" name="suby" class="btn btn-success btn-block"><span class="glyphicon glyphicon-off"></span> Login</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
          <p>Not a member? <a id="clack">Sign Up</a></p>
          <p>Forgot <a href="#">Password?</a></p>
        </div>
      </div>
      
    </div>
  </div>  
</div>


<?php



$conn = mysqli_connect("localhost", "root", "", "shopping");


$select = " SELECT * FROM updis " ;

$query = mysqli_query($conn, $select) ;



while($row = mysqli_fetch_array($query)) {

 $image = $row['imagename'];
 $company = $row['company_name'];
 $thing = $row['name'];
 $price = $row['price'];


 

}




 
 



?>


<div class="form">
 <form method="post" action="" enctype="multipart/form-data" id="formFace">
<input type="hidden" name="company" value="<?php echo $_SESSION['name'];?>" required>
<input type="number" min="0.01" max="10000.00" step="0.01" required name="price">
<input type="name" name="object" placeholder="write the objects name">
<input type="file" name="fileupload" />

<input type="submit" name="fileuploadsubmit" />
<label for="topics[]">Select the category of the product</label>
<select name="topics">
   <option value="tech">Tech</option>
   <option value="jewlery">Jewlery</option>
   <option value="clothes">Clothing</option>
   <option value="sports">Sports</option>
   <option value="make-up">Make-up</option>
   <option value="vid">Video-games</option>


 </select>
 </form>
 
</div>

<?php  
                $query = "SELECT * FROM updis ORDER BY id DESC";  
                $result = mysqli_query($conn, $query);  
                if(mysqli_num_rows($result) > 0)  
                {  
                     while($row = mysqli_fetch_array($result))  
                     {  
                ?>
<div class="col-md-3" id="max">  
                     <form method="post" action="index.php?action=add&id=<?php echo $row["id"]; ?>">  
                          <div id="sholudaStyled" align="center"> 
                          <div class="well"> 
                               <img src="images/<?php echo $row["imagename"]; ?>" class="img-responsive" width = "250px" height =" 250px"/>
                               <br />  
                               <h4 class="text-info"><?php echo $row["name"]; ?></h4>  
                               <h4 class="text-danger">$ <?php echo $row["price"]; ?></h4>
                               <h4 class="text-success"><?php echo $row["company_name"]; ?></h4> 
                               <?php if (isset($_SESSION['name'])) {
 ?>                     
                               <input type="text" name="quantity" class="form-control" value="1" /> 
                               <?php }?> 
                               <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />  
                               <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />  
                               <?php if (isset($_SESSION['name'])) { ?>
                                <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" ><a href="flag.php" class="text-danger" id="dane">Flag</a> <?php }?>

                           </div>

                     
                 </form> 
              </div>
               
               </div> 
                
                <?php  
                     }  
                }  
                ?>
                <?php if(isset($_SESSION['name'])){
                  ?>
                <div style="clear:both"></div>  
                <br />  
                <h3>Order Details</h3>  
                <div class="table-responsive">  
                     <table class="table table-bordered">  
                          <tr>  
                               <th width="40%">Item Name</th>  
                               <th width="10%">Quantity</th>  
                               <th width="20%">Price</th>  
                               <th width="15%">Total</th>  
                               <th width="5%">Action</th>  
                          </tr>  
                          <?php   
                          if(!empty($_SESSION["shopping_cart"]))  
                          {  
                               $total = 0;  
                               foreach($_SESSION["shopping_cart"] as $keys => $values)  
                               {  
                          ?>  
                          <tr>  
                               <td><?php echo $values["item_name"]; ?></td>  
                               <td><?php echo $values["item_quantity"]; ?></td>  
                               <td>$ <?php echo $values["item_price"]; ?></td>  
                               <td>$ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2); ?></td>  
                               <td><a href="index.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a></td>  
                          </tr>  
                          <?php  
                                    $total = $total + ($values["item_quantity"] * $values["item_price"] * 1.13);  
                               }  
                          ?>  
                          <tr>  
                               <td colspan="3" align="right">Total</td>  
                               <td align="right">$ <?php echo number_format($total, 2); ?></td>  
                               <td align="right"><button class="btn btn-success" onclick="location.href='checkout.php'">Checkout</button></td>  
                          </tr>  
                          <?php  
                          }  
                          ?>  
                     </table>  
                </div>    
<?php
}?>
<script type="text/javascript">
  $(document).ready(function(){
    $(".form").hide();

  });
  $("#hide").click(function(){
    $(".form").slideToggle();
  });
  function hit(){
    window.location.href = "flag.php";
  }

  $(document).ready(function(){
    $("#myBtn").click(function(){
        $("#myModal").modal();
        $("#clack").click(function(){
          $("#myModal").modal('hide');
        });
    });
});
  $(document).ready(function(){
    $("#clack").click(function(){
      $("#signUpp").modal();
    });

  });

  
  
</script>

</body>
</html>