<?php
session_start();
 
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
 
$servername = "localhost";
$username = "u52925";
$password = "3596996";
$dbname = "u52925";
 
// Ñîçäàíèå ïîäêëþ÷åíèÿ
try {
    $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password, [
        PDO::ATTR_PERSISTENT => true,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
 
$user_id = $_SESSION['user_id'];
 
// Îáðàáîòêà äàííûõ ôîðìû è îáíîâëåíèå èíôîðìàöèè î ïîëüçîâàòåëå â áàçå äàííûõ
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $birth_year = $_POST['birth_year'];
    $gender = $_POST['gender'];
    $limbs = $_POST['limbs'];
    $bio = $_POST['bio'];
    $contract = 1;
 
    $stmt = $db->prepare("UPDATE users SET name = ?, email = ?, birth_year = ?, gender = ?, limbs = ?, bio = ?, contract = ? WHERE id = ?");
    $stmt->execute([$name, $email, $birth_year, $gender, $limbs, $bio, $contract, $user_id]);
 
    header("Location: userinfo.php");
    exit();
}
?>
