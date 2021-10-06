<?php include('server.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Insert and Retrieve data from MySQL database with ajax</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

        <style>
        .wrapper {
  width: 45%;
  height: auto;
  margin: 10px auto;
  border: 1px solid #cbcbcb;
  background: white;
}
/*
* COMMENT FORM
**/
.comment_form {
  width: 80%;
  margin: 100px auto;
  border: 1px solid green;
  background: #fafcfc;
  padding: 20px;
}
.comment_form label {
  display: block;
  margin: 5px 0px 5px 0px;
}
.comment_form input, textarea {
  padding: 5px;
  width: 95%;
}
#submit_btn, #update_btn {
  padding: 8px 15px;
  color: white;
  background: #339;
  border: none;
  border-radius: 4px;
  margin-top: 10px;
}
#update_btn {
  background: #1c7600;
}
/*
* COMMENT DISPLAY AREA
**/
#display_area {
  width: 90%;
  padding-top: 15px;
  margin: 10px auto;
}
.comment_box {
  cursor: default;
  margin: 5px;
  border: 1px solid #cbcbcb;
  padding: 5px 10px;
  position: relative;
}
.delete {
  position: absolute;
  top: 0px;
  right: 3px;
  color: red;
  display: none;
  cursor: pointer;
}
.edit {
  position: absolute;
  top: 0px;
  right: 45px;
  color: green;
  display: none;
  cursor: pointer;
}
.comment_box:hover .edit, .comment_box:hover .delete {
  display: block;
}
.comment_text {
  text-align: justify;
}
.display_name {
  color: blue;
  padding: 0px;
  margin: 0px 0px 5px 0px;
}
        </style>
</head>
<body>
  <div class="wrapper">
   <?php echo $comments; ?>
   <form class="comment_form">
      <div>
        <label for="name">Name:</label>
       <input type="text" name="name" id="name">
      </div>
      <div>
       <label for="comment">Comment:</label>
       <textarea name="comment" id="comment" cols="30" rows="5"></textarea>
      </div>
      <button type="button" id="submit_btn">POST</button>
      <button type="button" id="update_btn" style="display: none;">UPDATE</button>
   </form>
  </div>
</body>
</html>
<!-- Add JQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.js"
integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.js"></script>
<script src="scripts.js"></script>

    <!-- <script src="jquery.min.js"></script> -->
