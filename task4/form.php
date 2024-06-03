<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
  <link rel="stylesheet" href="style.css">
  <title>Form</title>
</head>
<body>
  <?php
  if (!empty($messages['allok'])) {
    print($messages['allok']);
  }
  ?>
  <form action="" method="POST">
    <div class="form-head">
        <h1>Форма</h1>
    </div>
    <div class="form-content">
      <div class="form-item">
        <p <?php if ($errors['name1'] || $errors['name2']) {print 'class="error"';} ?>>Имя</p>
        <input class="line" name="name" value="<?php echo $values['name']; ?>" />
        <?php if ($errors['name1']) {print $messages['name1'];} else if ($errors['name2']) {print $messages['name2'];}?>
      </div>
      <div class="form-item">
        <p <?php if ($errors['phone1'] || $errors['phone2']) {print 'class="error"';} ?>>Телефон</p>
        <input class="line" name="phone" value="<?php print $values['phone']; ?>" />
        <?php if ($errors['phone1']) {print $messages['phone1'];} else if ($errors['phone2']) {print $messages['phone2'];}?>
      </div>
      <div class="form-item">
        <p <?php if ($errors['email1'] || $errors['email2']) {print 'class="error"';} ?>>Email</p>
        <input class="line" name="email" value="<?php print $values['email']; ?>" />
        <?php if ($errors['email1']) {print $messages['email1'];} else if ($errors['email2']) {print $messages['email2'];}?>
      </div>
      <div class="form-item">
        <div class="date">
          <span <?php if ($errors['year1'] || $errors['year2']) {print 'class="error"';} ?>>Год рождения:</span>
          <select name="year">
            <?php 
              for ($i = 2023; $i >= 1922; $i--) {
                if ($i == $values['year']) {
                  printf('<option selected value="%d">%d год</option>', $i, $i);
                } else {
                printf('<option value="%d">%d год</option>', $i, $i);
                }
              }
            ?>
          </select>
        </div>
        <?php if ($errors['year1']) {print $messages['year1'];} else if ($errors['year2']) {print $messages['year2'];}?>  
      </div>
      <div class="form-item">
        <p <?php if ($errors['gender1'] || $errors['gender2']) {print 'class="error"';} ?>>Пол:</p>
        <?php if ($errors['gender1']) {print $messages['gender1'];} else if ($errors['gender2']) {print $messages['gender2'];}?>  
        <ul>
          <li>
            <input type="radio" id="radioMale" name="gender" value="male" <?php if ($values['gender'] == 'male') {print 'checked';} ?>>
            <label for="radioMale">Мужчина</label>
          </li>
          <li>
            <input type="radio" id="radioFemale" name="gender" value="female" <?php if ($values['gender'] == 'female') {print 'checked';} ?>>
            <label for="radioFemale">Женщина</label>
          </li>
        </ul>
      </div>
      <div class="form-item">
        <p <?php if ($errors['languages1'] || $errors['languages2']) {print 'class="error"';} ?>>Выбери любимые<br>языки программирования:</p>
        <?php if ($errors['languages1']) {print $messages['languages1'];} else if ($errors['languages2']) {print $messages['languages2'];}?>
        <ul>
          <li>
            <input type="checkbox" id="Pascal" name="languages[]" value=1 <?php if (isset($values['languages']) && !empty($values['languages']) && in_array(1, unserialize($values['languages']))) {print 'checked';}?>>
            <label for="Pascal">Pascal</label>
          </li>
          <li>
            <input type="checkbox" id="C" name="languages[]" value=2 <?php if (isset($values['languages']) && !empty($values['languages']) && in_array(2, unserialize($values['languages']))) {print 'checked';}?>>
            <label for="C">C</label>
          </li>
          <li>
            <input type="checkbox" id="Cpp" name="languages[]" value=3 <?php if (isset($values['languages']) && !empty($values['languages']) && in_array(3, unserialize($values['languages']))) {print 'checked';}?>>
            <label for="Cpp">C++</label>
          </li>
          <li>
            <input type="checkbox" id="JavaScript" name="languages[]" value=4 <?php if (isset($values['languages']) && !empty($values['languages']) && in_array(4, unserialize($values['languages']))) {print 'checked';}?>>
            <label for="JavaScript">JavaScript</label>
          </li>
          <li>
            <input type="checkbox" id="PHP" name="languages[]" value=5 <?php if (isset($values['languages']) && !empty($values['languages']) && in_array(5, unserialize($values['languages']))) {print 'checked';}?>>
            <label for="PHP">PHP</label>
          </li>
          <li>
            <input type="checkbox" id="Python" name="languages[]" value=6 <?php if (isset($values['languages']) && !empty($values['languages']) && in_array(6, unserialize($values['languages']))) {print 'checked';}?>>
            <label for="Python">Python</label>
          </li>
          <li>
            <input type="checkbox" id="Java" name="languages[]" value=7 <?php if (isset($values['languages']) && !empty($values['languages']) && in_array(7, unserialize($values['languages']))) {print 'checked';}?>>
            <label for="Java">Java</label>
          </li>
          <li>
            <input type="checkbox" id="Haskel" name="languages[]" value=8 <?php if (isset($values['languages']) && !empty($values['languages']) && in_array(8, unserialize($values['languages']))) {print 'checked';}?>>
            <label for="Haskel">Haskel</label>
          </li>
          <li>
            <input type="checkbox" id="Clojure" name="languages[]" value=9 <?php if (isset($values['languages']) && !empty($values['languages']) && in_array(9, unserialize($values['languages']))) {print 'checked';}?>>
            <label for="Clojure">Clojure</label>
          </li>
          <li>
            <input type="checkbox" id="Prolog" name="languages[]" value=10 <?php if (isset($values['languages']) && !empty($values['languages']) && in_array(10, unserialize($values['languages']))) {print 'checked';}?>>
            <label for="Prolog">Prolog</label>
          </li>
          <li>
            <input type="checkbox" id="Scala" name="languages[]" value=11 <?php if (isset($values['languages']) && !empty($values['languages']) && in_array(11, unserialize($values['languages']))) {print 'checked';}?>>
            <label for="Scala">Scala</label>
          </li>
        </ul> 
      </div>
      <div class="form-item">
        <p class="big-text <?php if ($errors['biography1'] || $errors['biography2']) {print 'error';} ?>">Расскажи о себе:</p>
        <?php if ($errors['biography1']) {print $messages['biography1'];} else if ($errors['biography2']) {print $messages['biography2'];}?>
        <textarea name="biography" cols=24 rows=4 maxlength=128 spellcheck="false"><?php if (!empty($values['biography'])) {print $values['biography'];} ?></textarea>
      </div>
    </div>  
    <div class="send">
      <div class="contract">
        <input type="checkbox" id="checkboxContract" name="checkboxContract" <?php if ($values['checkboxContract'] == '1') {print 'checked';} ?>>
        <label for="checkboxContract" <?php if ($errors['checkboxContract']) {print 'class="error"';} ?>>С контрактом ознакомлен</label>
        <?php if ($errors['checkboxContract']) {print $messages['checkboxContract'];} ?>
      </div>
      <input class="btn" type="submit" name="submit" value="Отправить" />
    </div>
  </form>
</body> 
</html>
