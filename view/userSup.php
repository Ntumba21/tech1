<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Delete Account</title>
  </head>
  <body>
    <h1>Delete Account</h1>

    <form method="POST" action="../controller/activationMailSup.php">
      <label for="mail">Email:</label>
      <input type="email" name="mail" id="mail" required>
      <br>
      <button type="submit">Delete Account</button>
    </form>
  </body>
</html>