<?php
//Database connection by using PHP PDO
$username = 'czteam5';
$password = 'teampet';
$connection = new PDO( 'mysql:host=localhost;dbname=czteam5', $username, $password ); // Create Object of PDO class by connecting to Mysql database

if(isset($_POST["action"])) //Check value of $_POST["action"] variable value is set to not
{
 //For Load All Data
 if($_POST["action"] == "Load") 
 {
  $statement = $connection->prepare("SELECT * FROM hesla ORDER BY id DESC");
  $statement->execute();
  $result = $statement->fetchAll();
  $output = '';
  $output .= '
   <table class="table table-bordered">
    <tr>
     <th width="40%">jmeno</th>
     <th width="40%">email</th>
	 <th width="40%">heslo</th>
	 <th width="40%">typ</th>
     <th width="10%">Update</th>
     <th width="10%">Delete</th>
    </tr>
  ';
  if($statement->rowCount() > 0)
  {
   foreach($result as $row)
   {
    $output .= '
    <tr>
     <td>'.$row["jmeno"].'</td>
     <td>'.$row["email"].'</td>
	 <td>'.$row["heslo"].'</td>
	 <td>'.$row["typ"].'</td>
     <td><button type="button" id="'.$row["id"].'" class="btn btn-warning btn-xs update">Update</button></td>
     <td><button type="button" id="'.$row["id"].'" class="btn btn-danger btn-xs delete">Delete</button></td>
    </tr>
    ';
   }
  }
  else
  {
   $output .= '
    <tr>
     <td align="center">Data not Found</td>
    </tr>
   ';
  }
  $output .= '</table>';
  echo $output;
 }

 //This code for Create new Records
 if($_POST["action"] == "Create")
 {
  $statement = $connection->prepare("
   INSERT INTO hesla (jmeno, email, heslo, typ) 
   VALUES (:jmeno, :email, :heslo, :typ)
  ");
  $result = $statement->execute(
   array(
    ':jmeno' => $_POST["jmeno"],
    ':email' => $_POST["email"],
	':heslo' => $_POST["heslo"],
    ':typ' => $_POST["typ"]
   )
  );
  if(!empty($result))
  {
   echo 'Data Inserted';
  }
 }

 //This Code is for fetch single customer data for display on Modal
 if($_POST["action"] == "Select")
 {
  $output = array();
  $statement = $connection->prepare(
   "SELECT * FROM hesla
   WHERE id = '".$_POST["id"]."' 
   LIMIT 1"
  );
  $statement->execute();
  $result = $statement->fetchAll();
  foreach($result as $row)
  {
   $output["jmeno"] = $row["jmeno"];
   $output["email"] = $row["email"];
   $output["heslo"] = $row["heslo"];
   $output["typ"] = $row["typ"];
  }
  echo json_encode($output);
 }

 if($_POST["action"] == "Update")
 {
  $statement = $connection->prepare(
   "UPDATE hesla
   SET jmeno = :jmeno, email = :email, heslo = :heslo, typ = :typ 
   WHERE id = :id
   "
  );
  $result = $statement->execute(
   array(
    ':jmeno' => $_POST["jmeno"],
    ':email' => $_POST["email"],
	':heslo' => $_POST["heslo"],
    ':typ' => $_POST["typ"],
    ':id' => $_POST["id"],
   )
  );
  if(!empty($result))
  {
   echo 'Data Updated';
  }
 }

 if($_POST["action"] == "Delete")
 {
  $statement = $connection->prepare(
   "DELETE FROM hesla WHERE id = :id"
  );
  $result = $statement->execute(
   array(
    ':id' => $_POST["id"]
   )
  );
  if(!empty($result))
  {
   echo 'Data Deleted';
  }
 }

}

?>
