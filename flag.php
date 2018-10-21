
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <title></title>
</head>
<body>
<div class="container">
  <h3>What's wrong with the item you have flagged</h3>
  <strong>Below please specify what's wrong with the post by selecting one of the following selectors</strong>
  <b>Please Note:</b><p>that all flags are taken very seriously and will be acted on imideitly</p>
  <p>Also, if we detect that you are spaming you will be given a ban</p>
  <button class="btn btn-danger" id="Accept">Accept</button> 
  <form action="flagReq.php" method="POST" class="form">
    <b>Please choose one</b>
    <input type="radio" name="Badthing1">Bad thing1
    <input type="radio" name="Badthing2">Bad thing2
    <input type="radio" name="Badthing3">Bad thing3
    <input type="radio" name="Badthing4">Bad thing4
    <input type="text" name="postName" required placeholder="Write the company name">
    <input type="text" name="pers" required placeholder="Write your name">
    <input type="radio" name="other" class="other">Other
    <textarea class = "text" name="desc" maxlength="200" minlength="10" style="width: 150px; height: 100px;" placeholder="please specify"></textarea>
    <button type="submit" name="btn" class="btn btn-info">Submit</button>
  </form>
</div>
<script type="text/javascript">
  $(document).ready(function(){
    $(".form").hide();
  });

  $("#Accept").click(function(){
    $(".form").slideDown("slow");
  });

  $(document).ready(function(){
    $(".text").hide();
  });

  $(".other").click(function(){
    $(".text").slideDown();
  })

</script>
</body>
</html>