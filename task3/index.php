<?php

header('Content-Type: text/html; charset=UTF-8');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  if (!empty($_GET['save'])) {
    print('<p>Спасибо, результаты сохранены.</p>');
  }
  include('form.php');
  exit();
}

$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$year = $_POST['year'];
$gender = $_POST['gender'];
if(isset($_POST["languages"])) {
  $languages = $_POST["languages"];
  $filtred_languages = array_filter($languages, 
  function($value) {
    return($value == 1 || $value == 2 || $value == 3
    || $value == 3 || $value == 4 || $value == 5
    || $value == 6|| $value == 7|| $value == 8
    || $value == 9 || $value == 10 || $value == 11);
    }
  );
}
$biography = $_POST['biography'];
$checkboxContract = isset($_POST['checkboxContract']);

$errors = FALSE;

if (empty($name)) {
  print('<h1>Заполните поле "Имя".</h1><br/>');
  $errors = TRUE;
} else if (!preg_match('/^[a-zA-Zа-яА-ЯёЁ\s\-]+$/u', $name)) {
  print('<h1>Введены недопустимые символы в поле "Имя".</h1><br/>');
  $errors = TRUE;
}

if (empty($phone)) {
  print('<h1>Заполните поле "Телефон".</h1><br/>');
  $errors = TRUE;
} else if (!preg_match('/^(\+\d+|\d+)$/', $phone)) {
  print('<h1>Введены недопустимые символы в поле "Телефон".</h1><br/>');
  $errors = TRUE;
}

if (empty($email)) {
  print('<h1>Заполните поле "Email".</h1><br/>');
  $errors = TRUE;
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  print('<h1>Корректно* заполните поле "Email".</h1><br/>');
  $errors = TRUE;
}

if (!is_numeric($year)) {
  print('<h1>Неправильный формат ввода года.</h1><br/>');
  $errors = TRUE;
} else if ($year < 1920 || $year > 2010) {
  print('<h1>Введите действительный год рождения.</h1><br/>');
  $errors = TRUE;
}

if ($gender != 'male' && $gender != 'female') {
  print('<h1>Выбран неизвестный пол.</h1><br/>');
  $errors = TRUE;
}

if (empty($languages)) {
  print('<h1>Выберите хотя бы один язык программирования.</h1><br/>');
  $errors = TRUE;
} else if (count($filtred_languages) != count($languages)) {
  print('<h1>Выбран неизвестный язык программирования.</h1><br/>');
  $errors = TRUE;
}

if (empty($biography)) {
  print('<h1>Заполните поле "Биография".</h1><br/>');
  $errors = TRUE;
} else if (!preg_match('/^[a-zA-Zа-яА-ЯёЁ0-9.,;!? \-]+$/u', $biography)) {
  print('<h1>Введены недопустимые символы в поле "Биография".</h1><br/>');
  $errors = TRUE;
} else if (strlen($biography) > 128) { 
  print('<h1>Превышено количество символов в поле "Биография".</h1><br/>');
  $errors = TRUE;
}

if ($checkboxContract == '') {
  print('<h1>Ознакомьтесь с контрактом.</h1><br/>');
  $errors = TRUE;
}

if ($errors) {
  exit();
}

include('dbconnect.php');

try {
  $stmt = $db->prepare("INSERT INTO application (name, phone, email, year, gender, biography) VALUES (?, ?, ?, ?, ?, ?)");
  $stmt->execute([$name, $phone, $email, $year, $gender, $biography]);
  $application_id = $db->lastInsertId();
  $stmt = $db->prepare("INSERT INTO languages (application_id, language_id) VALUES (?, ?)");
  foreach ($languages as $language_id) {
    $stmt->execute([$application_id, $language_id]);
  }
} catch (PDOException $e) {
  print('Error : ' . $e->getMessage());
  exit();
}
header('Location: ?save=1');