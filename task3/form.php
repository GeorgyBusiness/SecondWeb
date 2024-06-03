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
  <form action="" method="POST">
    <div class="form-head">
        <h1>Форма</h1>
    </div>
    <div class="form-content">
      <div class="form-item">
        <div class="form-item">
          <label class="labelText">Имя</label>
          <input class="line" type="text" name="name" placeholder="">
        </div>
        <div class="form-item">
          <label class="labelText" for="phone">Телефон</label>
          <input class="line" type="tel" name="phone" placeholder="">
        </div>
        <div class="form-item">
          <label class="labelText" for="email">Email</label>
          <input class="line" type="text" name="email" placeholder="">
        </div>
      </div>
      <div class="form-item">
        <div class="date">
          <span>Год рождения:</span>
          <select name="year">
            <?php 
              for ($i = 2024; $i >= 1924; $i--) {
                printf('<option value="%d">%d год</option>', $i, $i);
              }
            ?>
          </select>
        </div>
      </div>
      <div class="form-item">
        <p>Пол:</p>
        <ul>
          <li>
            <input type="radio" id="radioMale" name="gender" value="male" checked>
            <label for="radioMale">Мужчина</label>
          </li>
          <li>
            <input type="radio" id="radioFemale" name="gender" value="female">
            <label for="radioFemale">Женщина</label>
          </li>
        </ul>
      </div>
      <div class="form-item">
        <p>Выбери любимые<br>языки программирования:</p>
        <ul>
          <li>
            <input type="checkbox" id="Pascal" name="languages[]" value=1>
            <label for="Pascal">Pascal</label>
          </li>
          <li>
            <input type="checkbox" id="C" name="languages[]" value=2>
            <label for="C">C</label>
          </li>
          <li>
            <input type="checkbox" id="Cpp" name="languages[]" value=3>
            <label for="Cpp">C++</label>
          </li>
          <li>
            <input type="checkbox" id="JavaScript" name="languages[]" value=4>
            <label for="JavaScript">JavaScript</label>
          </li>
          <li>
            <input type="checkbox" id="PHP" name="languages[]" value=5>
            <label for="PHP">PHP</label>
          </li>
          <li>
            <input type="checkbox" id="Python" name="languages[]" value=6>
            <label for="Python">Python</label>
          </li>
          <li>
            <input type="checkbox" id="Java" name="languages[]" value=7>
            <label for="Java">Java</label>
          </li>
          <li>
            <input type="checkbox" id="Haskel" name="languages[]" value=8>
            <label for="Haskel">Haskel</label>
          </li>
          <li>
            <input type="checkbox" id="Clojure" name="languages[]" value=9>
            <label for="Clojure">Clojure</label>
          </li>
          <li>
            <input type="checkbox" id="Prolog" name="languages[]" value=10>
            <label for="Prolog">Prolog</label>
          </li>
          <li>
            <input type="checkbox" id="Scala" name="languages[]" value=11>
            <label for="Scala">Scala</label>
          </li>
        </ul> 
      </div>
      <div class="form-item">
        <p class="big-text">Расскажи о себе:</p>
        <textarea name="biography" cols=24 rows=4 maxlength=128 spellcheck="false"></textarea>
      </div>
    </div>  
    <div class="send">
      <div class="contract">
        <input type="checkbox" id="checkboxContract" name="checkboxContract">
        <label for="checkboxContract">С контрактом ознакомлен</label>
      </div>
      <input class="btn" type="submit" name="submit" value="Отправить" />
    </div>
  </form>
</body> 
</html>