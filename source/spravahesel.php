<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<!--změna textového formátu kvůli interpunkcím -->

<title>Redakční systém Admin</title>
<link rel="icon" type="=image/pgn" href="img/favicon.png">
<!-- <link href="css/css.css" rel="stylesheet" type="text/css" />-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<style>
@font-face {
	font-family: MyriadCond;
	src: url(../font/MyriadProCond.otf);
}
@font-face {
	font-family: MyriadCondBold;
	src: url(../font/MyriadProBoldCond.otf);
}
a:link, a:visited {
	color: #000;
	text-decoration: none;
}
.zpetbutton {
	margin: 0px, auto;
	font-size: 38pt;
	float: left;
	margin-left: 42px;
	/*margin-top: 14px;*/
}
a:hover { 
    color: #ED1C24;
}
body {
	background-color: #777 !important;
	margin: 0;
	padding: 0;
	font-family: MyriadCond;
	width: 1024px;
	height: 768px;
	margin: auto;
}
.box {
	background-image: url(img/tabulkypozadio20.png) !important;
	width: 1024px;
	height: 768px;
	padding: 20px;
	/*background-color: #fff;*/
	/*border:1px solid #ccc;*/
	/*border-radius: 5px;*/
	margin-top: 10px;
}
</style>
</head>
<body>
<div class="container box">
  <h1 align="center" style="font-size: 38pt;">Správa hesel</h1>
  <br />
  <div align="right">
    <button type="button" id="modal_button" class="btn btn-info">Vytvorit uživatele</button>
    <!-- It will show Modal for Create new Records !--> 
  </div>
  <br />
  <div id="result" class="table-responsive"> <!-- Data will load under this tag!--> 
    
  </div>
   <div class="zpetbutton"><a href="admin.html">zpět</a> </div>
</div>
</body>
</html>

<!-- This is Customer Modal. It will be use for Create new Records and Update Existing Records!-->
<div id="customerModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Vytvorit uzivatele</h4>
      </div>
      <div class="modal-body">
        <label>jmeno</label>
        <input type="text" name="jmeno" id="jmeno" class="form-control" />
        <br />
        <label>email</label>
        <input type="text" name="email" id="email" class="form-control" />
        <br />
        <label>heslo</label>
        <input type="text" name="heslo" id="heslo" class="form-control" />
        <br />
        <label>typ</label>
        <input type="text" name="typ" id="typ" class="form-control" />
        <br />
      </div>
      <div class="modal-footer">
        <input type="hidden" name="id" id="id" />
        <input type="submit" name="action" id="action" class="btn btn-success" />
        <button type="button" class="btn btn-default" data-dismiss="modal">zavrit</button>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function(){
 fetchUser(); //This function will load all data on web page when page load
 function fetchUser() // This function will fetch data from table and display under <div id="result">
 {
  var action = "Load";
  $.ajax({
   url : "action.php", //Request send to "action.php page"
   method:"POST", //Using of Post method for send data
   data:{action:action}, //action variable data has been send to server
   success:function(data){
    $('#result').html(data); //It will display data under div tag with id result
   }
  });
 }

 //This JQuery code will Reset value of Modal item when modal will load for create new records
 $('#modal_button').click(function(){
  $('#customerModal').modal('show'); //It will load modal on web page
  $('#jmeno').val(''); //This will clear Modal jmeno textbox
  $('#email').val(''); //This will clear Modal email textbox
  $('#heslo').val(''); //This will clear Modal heslo textbox
  $('#typ').val(''); //This will clear Modal typ textbox
  $('.modal-title').text("Create New Records"); //It will change Modal title to Create new Records
  $('#action').val('Create'); //This will reset Button value ot Create
 });

 //This JQuery code is for Click on Modal action button for Create new records or Update existing records. This code will use for both Create and Update of data through modal
 $('#action').click(function(){
  var jmeno = $('#jmeno').val(); //Get the value of jmeno textbox.
  var email = $('#email').val(); //Get the value of email textbox
  var heslo = $('#heslo').val(); //Get the value of heslo textbox
  var typ = $('#typ').val(); //Get the value of typ textbox
  var id = $('#id').val();  //Get the value of hidden field id
  var action = $('#action').val();  //Get the value of Modal Action button and stored into action variable
  if(jmeno != '' && heslo != '') //This condition will check both variable has some value
  {
   $.ajax({
    url : "action.php",    //Request send to "action.php page"
    method:"POST",     //Using of Post method for send data
    data:{jmeno:jmeno, email:email, heslo:heslo, typ:typ, id:id, action:action}, //Send data to server
    success:function(data){
     alert(data);    //It will pop up which data it was received from server side
     $('#customerModal').modal('hide'); //It will hide Customer Modal from webpage.
     fetchUser();    // Fetch User function has been called and it will load data under divison tag with id result
    }
   });
  }
  else
  {
   alert("Both Fields are Required"); //If both or any one of the variable has no value them it will display this message
  }
 });

 //This JQuery code is for Update customer data. If we have click on any customer row update button then this code will execute
 $(document).on('click', '.update', function(){
  var id = $(this).attr("id"); //This code will fetch any customer id from attribute id with help of attr() JQuery method
  var action = "Select";   //We have define action variable value is equal to select
  $.ajax({
   url:"action.php",   //Request send to "action.php page"
   method:"POST",    //Using of Post method for send data
   data:{id:id, action:action},//Send data to server
   dataType:"json",   //Here we have define json data type, so server will send data in json format.
   success:function(data){
    $('#customerModal').modal('show');   //It will display modal on webpage
    $('.modal-title').text("Update Records"); //This code will change this class text to Update records
    $('#action').val("Update");     //This code will change Button value to Update
    $('#id').val(id);     //It will define value of id variable to this customer id hidden field
    $('#jmeno').val(data.jmeno);  //It will assign value to modal jmeno texbox
    $('#email').val(data.email);  //It will assign value of modal email textbox
	$('#heslo').val(data.heslo);  //It will assign value of modal heslo textbox
	$('#typ').val(data.typ);  //It will assign value of modal typ textbox
   }
  });
 });

 //This JQuery code is for Delete customer data. If we have click on any customer row delete button then this code will execute
 $(document).on('click', '.delete', function(){
  var id = $(this).attr("id"); //This code will fetch any customer id from attribute id with help of attr() JQuery method
  if(confirm("Are you sure you want to remove this data?")) //Confim Box if OK then
  {
   var action = "Delete"; //Define action variable value Delete
   $.ajax({
    url:"action.php",    //Request send to "action.php page"
    method:"POST",     //Using of Post method for send data
    data:{id:id, action:action}, //Data send to server from ajax method
    success:function(data)
    {
     fetchUser();    // fetchUser() function has been called and it will load data under divison tag with id result
     alert(data);    //It will pop up which data it was received from server side
    }
   })
  }
  else  //Confim Box if cancel then 
  {
   return false; //No action will perform
  }
 });
});
</script>