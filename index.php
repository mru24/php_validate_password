<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>HTML PHP TEST</title>
  </head>
  <body>
    <div style="padding: 90px;">
      <form class="" action="index.php" method="post">
        <input type="text" name="password" value="">
        <input type="submit" name="submit" value="submit">
      </form>
    </div>
  </body>
</html>
<?php

if(isset($_POST['submit'])) {
  $check = new CheckPassword();
  $password = $_POST['password'];

  if($check->validatePassword($password)) {
    echo 'Strong password.';
  } else {
    $error = $check->getError();
    echo '<h1>'.$error.'</h1>';
  }
}

class CheckPassword {
  protected $error;
  public function validatePassword($password) {
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number = preg_match('@[0-9]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);

    if(!$uppercase) {
      $this->error = "UPPERCASE";
      return false;
    }
    if(!$lowercase) {
      $this->error = "LOWERCASE";
      return false;
    }
    if(!$number) {
      $this->error = "NUMBER";
      return false;
    }
    if(!$specialChars) {
      $this->error = "SPECIAL CHAR";
      return false;
    }
    if(strlen($password) < 8) {
      $this->error = "8 CHARS";
      return false;
    }
    return true;
  }
  public function getError() {
    return $this->error;
  }
}
