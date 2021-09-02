<?php
$host = '127.0.0.1';
$servername = "localhost";
$username = "root";
$password = "programmer";

// Create connection
$conn = mysqli_connect($host,$servername, $username, $password);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";

$sql = "INSERT INTO responses_chatbot (C_Name, Email, Phone_Number,C_Message)
VALUES ('$name', '$visitor_email', $phone_number,'$message')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

if(!isset($_POST['submit']))
{
//This page should not be accessed directly. Need to submit the form.
	echo "error; you need to submit the form!";
}
$name = $_POST['name'];
$visitor_email = $_POST['email'];
$message = $_POST['message'];
$phone_number = $_POST['message'];


$email_from = "$visitor_email";//<== update the email address
$email_subject = "New Form submission";
$email_body = "You have received a new message from the user $name.\n".
    "Here is the message:\n $message".
    
$to = "issamdoe2019@gmail.com";//<== update the email address
$headers = "From: $email_from \r\n";
$headers .= "Reply-To: $visitor_email \r\n";
//Send the email!
mail($to,$email_subject,$email_body,$headers);
//done. redirect to thank-you page.
header('Location: index.html');


// Function to validate against any email injection attempts
function IsInjected($str)
{
  $injections = array('(\n+)',
              '(\r+)',
              '(\t+)',
              '(%0A+)',
              '(%0D+)',
              '(%08+)',
              '(%09+)'
              );
  $inject = join('|', $injections);
  $inject = "/$inject/i";
  if(preg_match($inject,$str))
    {
    return true;
  }
  else
    {
    return false;
  }
}

$conn->close();
   
?> 