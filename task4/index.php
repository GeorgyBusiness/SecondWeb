<?php

header('Content-Type: text/html; charset=UTF-8');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  $messages = array();
  if (!empty($_COOKIE['save'])) {
      setcookie('save', '', 100000);
      $messages['allok'] = '<div class="good">Спасибо, результаты сохранены</div>';
  }
  $errors = array();
  $errors['name1'] = !empty($_COOKIE['name_error1']);
  $errors['name2'] = !empty($_COOKIE['name_error2']);
  $errors['phone1'] = !empty($_COOKIE['phone_error1']);
  $errors['phone2'] = !empty($_COOKIE['phone_error2']);
  $errors['email1'] = !empty($_COOKIE['email_error1']);
  $errors['email2'] = !empty($_COOKIE['email_error2']);
  $errors['year1'] = !empty($_COOKIE['year_error1']);
  $errors['year2'] = !empty($_COOKIE['year_error2']);
  $errors['gender1'] = !empty($_COOKIE['gender_error1']);
  $errors['gender2'] = !empty($_COOKIE['gender_error2']);
  $errors['languages1'] = !empty($_COOKIE['languages_error1']);
  $errors['languages2'] = !empty($_COOKIE['languages_error2']);
  $errors['biography1'] = !empty($_COOKIE['biography_error1']);
  $errors['biography2'] = !empty($_COOKIE['biography_error2']);
  $errors['checkboxContract'] = !empty($_COOKIE['checkboxContract_error']);

  if ($errors['name1']) {
    setcookie('name_error1', '', 100000);
    $messages['name1'] = '<p class="msg">Заполните имя</p>';
  }
  if ($errors['name2']) {
    setcookie('name_error2', '', 100000);
    $messages['name2'] = '<p class="msg">Корректно* заполните имя</p>';
  }
  if ($errors['email1']) {
    setcookie('email_error1', '', 100000);
    $messages['email1'] = '<p class="msg">Заполните email</p>';
  } else if ($errors['email2']) {
    setcookie('email_error2', '', 100000);
    $messages['email2'] = '<p class="msg">Корректно* заполните email</p>';
  }
  if (empty($phone)) {
    setcookie('phone_error1', '', 100000);
    $messages['phone1'] = '<p class="msg">Заполните телефон</p>';
  } else if (!preg_match('/^(\+\d+|\d+)$/', $phone)) {
    setcookie('phone_error2', '', 100000);
    $messages['phone2'] = '<p class="msg">Корректно* заполните телефон</p>';
  }
  if ($errors['year1']) {
    setcookie('year_error1', '', 100000);
    $messages['year1'] = '<p class="msg">Неправильный формат ввода года</p>';
  } else if ($errors['year2']) {
    setcookie('year_error2', '', 100000);
    $messages['year2'] = '<p class="msg">Вам должно быть 18 лет</p>';
  }
  if ($errors['gender1']) {
    setcookie('gender_error1', '', 100000);
    $messages['gender1'] = '<p class="msg">Выберите пол</p>';
  }
  if ($errors['gender2']) {
    setcookie('gender_error2', '', 100000);
    $messages['gender2'] = '<p class="msg">Выбран неизвестный пол</p>';
  }
  if ($errors['languages1']) {
    setcookie('languages_error1', '', 100000);
    $messages['languages1'] = '<p class="msg">Выберите хотя бы один<br>язык программирования</p>';
  } else if ($errors['languages2']) {
    setcookie('languages_error2', '', 100000);
    $messages['languages2'] = '<p class="msg">Выбран неизвестный<br>язык программирования</p>';
  }
  if ($errors['biography1']) {
    setcookie('biography_error1', '', 100000);
    $messages['biography1'] = '<p class="msg">Расскажи о себе что-нибудь</p>';
  } else if ($errors['biography2']) {
    setcookie('biography_error2', '', 100000);
    $messages['biography2'] = '<p class="msg">Недопустимый формат ввода <br> биографии</p>';
  }
  if ($errors['checkboxContract']) {
    setcookie('checkboxContract_error', '', 100000);
    $messages['checkboxContract'] = '<p class="msg">Ознакомьтесь с контрактом</p>';
  }
  $values = array();
  $values['name'] = empty($_COOKIE['name_value']) ? '' : $_COOKIE['name_value'];
  $values['phone'] = empty($_COOKIE['phone_value']) ? '' : $_COOKIE['phone_value'];
  $values['email'] = empty($_COOKIE['email_value']) ? '' : $_COOKIE['email_value'];
  $values['year'] = empty($_COOKIE['year_value']) ? '' : $_COOKIE['year_value'];
  $values['gender'] = empty($_COOKIE['gender_value']) ? '' : $_COOKIE['gender_value'];
  $values['languages'] = empty($_COOKIE['languages_value']) ? '' : $_COOKIE['languages_value'];
  $values['biography'] = empty($_COOKIE['biography_value']) ? '' : $_COOKIE['biography_value'];
  $values['checkboxContract'] = empty($_COOKIE['checkboxContract_value']) ? '' : $_COOKIE['checkboxContract_value'];
  include('form.php');
} else {
  $errors = FALSE;

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

  if (empty($name)) {
    setcookie('name_error1', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  } else if (!preg_match('/^[a-zA-Zа-яА-ЯёЁ\s\-]+$/u', $name)) {
    setcookie('name_error2', '1', time() + 24 * 60 * 60);
    setcookie('name_value', $name, time() + 30 * 24 * 60 * 60);
    $errors = TRUE;
  } else {
    setcookie('name_value', $name, time() + 30 * 24 * 60 * 60);
  }

  if (empty($phone)) {
    setcookie('phone_error1', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  } else if (!preg_match('/^(\+\d+|\d+)$/', $phone)) {
    setcookie('phone_error2', '1', time() + 24 * 60 * 60);
    setcookie('phone_value', $phone, time() + 30 * 24 * 60 * 60);
    $errors = TRUE;
  } else {
    setcookie('phone_value', $phone, time() + 30 * 24 * 60 * 60);
  }

  if (empty($email)) {
    setcookie('email_error1', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    setcookie('email_error2', '1', time() + 24 * 60 * 60);
    setcookie('email_value', $email, time() + 30 * 24 * 60 * 60);
    $errors = TRUE;
  } else {
    setcookie('email_value', $email, time() + 30 * 24 * 60 * 60);
  }

  if (!is_numeric($year)) {
    setcookie('year_error1', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  } else if ($year < 1924 || $year > 2010) {
    setcookie('year_error2', '1', time() + 24 * 60 * 60);
    setcookie('year_value', $year, time() + 30 * 24 * 60 * 60);
    $errors = TRUE;
  } else {
    setcookie('year_value', $year, time() + 30 * 24 * 60 * 60);
  }

  if (empty($gender)) {
    setcookie('gender_error1', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  } else if ($gender != 'male' && $gender != 'female') {
    setcookie('gender_error2', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  } else {
    setcookie('gender_value', $gender, time() + 30 * 24 * 60 * 60);
  }

  if (empty($languages)) {
    setcookie('languages_error1', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  } else if (count($filtred_languages) != count($languages)) {
    setcookie('languages_error2', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  } else {
    setcookie('languages_value', serialize($languages), time() + 30 * 24 * 60 * 60);
  }

  if (empty($biography)) {
    setcookie('biography_error1', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  } else if (!preg_match('/^[a-zA-Zа-яА-ЯёЁ0-9.,;!? \-]+$/u', $biography)) {
    setcookie('biography_error2', '1', time() + 24 * 60 * 60);
    setcookie('biography_value', $biography, time() + 30 * 24 * 60 * 60);
    $errors = TRUE;
  } else {
    setcookie('biography_value', $biography, time() + 30 * 24 * 60 * 60);
  }

  if ($checkboxContract == '') {
    setcookie('checkboxContract_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  } else {
    setcookie('checkboxContract_value', $checkboxContract, time() + 30 * 24 * 60 * 60);
  }

  if ($errors) {
    header('Location: index.php');
    exit();
  }
  else {
    setcookie('name_error1', '', 100000);
    setcookie('name_error2', '', 100000);
    setcookie('phone_error1', '', 100000);
    setcookie('phone_error2', '', 100000);
    setcookie('email_error1', '', 100000);
    setcookie('email_error2', '', 100000);
    setcookie('year_error1', '', 100000);
    setcookie('year_error2', '', 100000);
    setcookie('gender_error1', '', 100000);
    setcookie('gender_error2', '', 100000);
    setcookie('languages_error1', '', 100000);
    setcookie('languages_error2', '', 100000);
    setcookie('biography_error1', '', 100000);
    setcookie('biography_error2', '', 100000);
    setcookie('checkboxContract_error', '', 100000);
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
  setcookie('save', '1');
  header('Location: index.php');
}
