<!DOCTYPE html>
<html>
<head>
	<title>Form in design</title>
	<link rel="stylesheet" type="text/css" href="Style.css">

</head>
<body>
	<div class="container">
		
		<form method="post" action="regicode.php">
			<div class="form_input">Firstname :
				<input type="text" name="Firstname" placeholder=""/>
            </div><br>
			<div class="form_input">Lastname :
				<input type="text" name="Lastname" placeholder=""/>
             </div><br>
             <div class="form_input">Fathername :
				<input type="text" name="Fathername" placeholder=""/>
			</div><br>
			<div class="form_input">Phonenumber :
				<input type="number" name="phonenumber" placeholder=""/>

              </div><br>
              <div class="form_input">Password :
				<input type="password" name="password" placeholder=""/>
			</div><br>
			<input type="submit" name="submit" value="Register me" class="btn-login"/>
		</form>
	</div>


</body>
</html>	