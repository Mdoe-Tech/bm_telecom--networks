<?php
$servername = "localhost";
$username = "root";
$password = "";
$db="chatbot_response";

// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

$name = mysqli_real_escape_string($conn, $_POST['name']);
$visitor_email = mysqli_real_escape_string($conn, $_POST['email']);
$message = mysqli_real_escape_string($conn, $_POST['message']);
$number = mysqli_real_escape_string($conn, $_POST['number']);

$ins_sql = "INSERT INTO responses_chatbot (C_Name,Phone_number,C_email,C_Message)
VALUES ('$name',$number, '$visitor_email','$message')";
$run=mysqli_query($conn, $ins_sql);


$sql = "SELECT *FROM responses_chatbot";
$result = $conn->query($sql);


//Validate first
if(empty($name)||empty($visitor_email)) 
{
    echo "Name and email are mandatory!";
    exit;
}

if(IsInjected($visitor_email))
{
    echo "Bad email value!";
    exit;
}

$email_from = '$visitor_email';//<== update the email address
$email_subject = "New Form submission";
$email_body = "You have received a new message from the user $name.\n".
    "Here is the message:\n $message".
    
$to = "issamdoe2019@gmail.com.com";//<== update the email address
$headers = "From: $email_from \r\n";
$headers .= "Reply-To: $visitor_email \r\n";
//Send the email!
mail($to,$email_subject,$email_body,$headers);
//done. redirect to thank-you page.
header('Location: thank-you.html');


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
   
?> 