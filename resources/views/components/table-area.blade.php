<div>
    <p>Em desenvolvimento...
<br>

<!--=======================/////////////////////|||||||||||||||||||||   |||||||||||||||||||||\\\\\\\\\\\\\\\\\\\\\\=======================-->

<?php
$servername = "localhost";
$username = "erick";
$password = "123";
$dbname = "projetos";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>
<!--=======================/////////////////////|||||||||||||||||||||   |||||||||||||||||||||\\\\\\\\\\\\\\\\\\\\\\=======================-->

    </p>
</div>