<?php
    require_once('./require/header.php');

// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$stmt = "SELECT username, email FROM accounts WHERE id = '$acct_id'";
// In this case we can use the account ID to get the account info.
//Execute Query
        $res = mysqli_query($con, $stmt);

        //Check if the query executed successfully or not
        if($res==true)
        {
            //Query <br />Executed
            $row = mysqli_fetch_assoc($res);

            //Get the Individual Value
			$acct_name = $row['username'];
			$email = $row['email'];
        } else
			{
				//Redirect to Homepage
				header('location: ./home.php');
		}

?>

<?=template_header('Profile')?>
		<div class="w3-content">
			<h1>PROFILE</h1>
      <hr></hr>
			<div class="">
				<h3>Account Details</h3>
				<table>
					<tr>
						<td>Username:</td>
						<td><?=$acct_name?></td>
					</tr>
					<tr>
						<td>Email:</td>
						<td><?=$email?></td>
					</tr>
					<tr>
						<td> <a href="resetpsswd.php" class="w3-button">Reset Password</a></td>
					</tr>
				</table>
			</div>
		</div>

<?php require_once('./require/footer.php');?>
