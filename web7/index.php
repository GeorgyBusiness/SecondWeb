<?php
header('Content-Type: text/html; charset=UTF-8');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $messages = array();
    if (!empty($_COOKIE['save'])) {
        setcookie('save', '', 100000);
        setcookie('login', '', 100000);
        setcookie('pass', '', 100000);
        $messages[] = 'Спасибо, результаты сохранены. ';
        if (!empty($_COOKIE['pass'])) {
            $messages[] = sprintf('Вы можете <a href="login.php">войти</a> с логином <strong>%s</strong>
        и паролем <strong>%s</strong> для изменения данных.',
                htmlspecialchars($_COOKIE['login'], ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($_COOKIE['pass'], ENT_QUOTES, 'UTF-8'));
        }
    }
    $errors = array();
    $errors['names'] = !empty($_COOKIE['name_error']);
    $errors['phone'] = !empty($_COOKIE['phone_error']);
    $errors['email'] = !empty($_COOKIE['email_error']);
    $errors['data'] = !empty($_COOKIE['data_error']);
    $errors['gender'] = !empty($_COOKIE['gender_error']);
    $errors['agree'] = !empty($_COOKIE['agree_error']);

    if ($errors['names']) {
        setcookie('names_error', '', 100000);
        $messages[] = '<div>Заполните имя.</div>';
    }
    if ($errors['phone']) {
        setcookie('phone_error', '', 100000);
        $messages[] = '<div>Некорректный телефон.</div>';
    }
    if ($errors['email']) {
        setcookie('email_error', '', 100000);
        $messages[] = '<div>Некорректный email.</div>';
    }
    if ($errors['data']) {
        setcookie('data_error', '', 100000);
        $messages[] = '<div>Выберите год рождения.</div>';
    }
    if ($errors['gender']) {
        setcookie('gender_error', '', 100000);
        $messages[] = '<div>Выберите пол.</div>';
    }
    if ($errors['agree']) {
        setcookie('agree_error', '', 100000);
        $messages[] = '<div>Поставьте галочку.</div>';
    }
    $values = array();
    $values['names'] = isset($_COOKIE['names_value']) ? htmlspecialchars($_COOKIE['names_value'], ENT_QUOTES, 'UTF-8') : '';
    $values['phone'] = isset($_COOKIE['phone_value']) ? htmlspecialchars($_COOKIE['phone_value'], ENT_QUOTES, 'UTF-8') : '';
    $values['email'] = isset($_COOKIE['email_value']) ? htmlspecialchars($_COOKIE['email_value'], ENT_QUOTES, 'UTF-8') : '';
    $values['data'] = isset($_COOKIE['data_value']) ? htmlspecialchars($_COOKIE['data_value'], ENT_QUOTES, 'UTF-8') : '';
    $values['gender'] = isset($_COOKIE['gender_value']) ? htmlspecialchars($_COOKIE['gender_value'], ENT_QUOTES, 'UTF-8') : '';
    $values['biography'] = isset($_COOKIE['biography_value']) ? htmlspecialchars($_COOKIE['biography_value'], ENT_QUOTES, 'UTF-8') : '';
    $values['agree'] = isset($_COOKIE['agree_value']) ? htmlspecialchars($_COOKIE['agree_value'], ENT_QUOTES, 'UTF-8') : '';
    if (empty($_COOKIE['language_value'])) {
        $values['language'] = array();
    } else {
        $values['language'] = json_decode($_COOKIE['language_value'], true);  
    }
    $language = isset($language) ? $language : array();
    if (!empty($_SESSION['login'])) {
        printf('Вход с логином %s, uid %d', htmlspecialchars($_SESSION['login'], ENT_QUOTES, 'UTF-8'), $_SESSION['uid']);
    }
    if (!empty($_COOKIE[session_name()]) && !empty($_SESSION['login'])) {
        $db = new PDO('mysql:host=localhost;dbname=u67508', 'u67508', '2263537', array(PDO::ATTR_PERSISTENT => true));
        $stmt = $db->prepare("SELECT * FROM application WHERE id = ?");
        $stmt->execute([$_SESSION['uid']]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $values['names'] = htmlspecialchars($row['names'], ENT_QUOTES, 'UTF-8');
        $values['phone'] = isset($_COOKIE['phone']) ? htmlspecialchars($_COOKIE['phone'], ENT_QUOTES, 'UTF-8') : '';
        $values['email'] = htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8');
        $values['data'] = isset($_COOKIE['data']) ? htmlspecialchars($_COOKIE['data'], ENT_QUOTES, 'UTF-8') : '';
        $values['gender'] = htmlspecialchars($row['gender'], ENT_QUOTES
