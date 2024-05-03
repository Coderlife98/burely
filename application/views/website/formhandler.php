<?php
session_start();

if(isset($_POST['submit'])){
    $name =$_POST['name'];
    $email= $_POST['email'];
    $phone =$_POST['phone'];
    $address =$_POST['address'];
    $message=$_POST['message'];

    $to ="info@camwel.com";
    $subject ="Enquiry from ".$email;
    $headers ='from '.$email ."\r\n";
    $headers .= 'content-type:text/html;charset=iso-8859-1'."\r\n";
    $full_message = "<html>
    
    <head>
    <title>Enquiry Data </title>
    </head>
    <body>
    <table>
    <tr>
    <td>Name</td>
    <td>&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
    <td>".$name."</td>
    </tr>
    <tr>
    <td>Email Id</td>
    <td>&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
    <td>".$email."</td>
    </tr>
    <tr>
    <td>Phone Number</td>
    <td>&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
    <td>".$phone."</td>
    </tr>
    <tr>
    <td>Address</td>
    <td>&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
    <td>".$address."</td>
    </tr>
    <tr>
    <td>Message</td>
    <td>&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
    <td>".$message."</td>
    </tr>
</table>
</body>
</html>";

$user =$email;
$user_subject = "Thank You $name";
$user_headers ='From: '."\r\n";
$user_message ="Dear ".$name."\nWelcome to company name \n We have got your query. we will reach you soon. \n Thank You";

if(mail($to,$subject,$full_message,$headers))
{

    mail($user,$user_subject,$user_message,$user_headers);

    $_SESSION["response"] ="<h3>Dear <span style='color:black;'>".$name."</span>,</h3><blockquote><p>We have got your query. We will contact you soon.<br/>For Quick Enquiry<span style='color:#e70780;'>Call Us</span>at <span><i class='fa-solid fa-phone px-2 text-dark'></i><a style='text-decoration:none;color:black' href='tel:+91 7003762445'> 7003762445</a></span></p><p>Thank You!</p></blockquote>";
}else{
    $_SESSION["response"] = "<h3>Dear <span style='color:#e70780;'>".$name."</span>,</h3><blockquote><p>Something is wrong. It seems like the internet is not working well.<br/>For Quick Enquiry <span style='color:#e70780;'>Call Us<span> at <span><i class='fa-solid fa-phone px-2 text-dark'></i><a style='text-decoration:none;color:black' href='tel:+91 7003762445'> 7003762445</a></span></p><p>Please, try again!</p><p>Thank You!</p></blockquote>";
}
header("Location:thanku.php");
exit();
}

?>