<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Delete Account</title>
    <style>
      body {
        background-color: #f2f2f2;
      }
      h1 {
        text-align: center;
      }
      form {
        background-color: white;
        max-width: 500px;
        margin: 0 auto;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      }
      label {
        display: block;
        margin-bottom: 10px;
      }
      input[type="email"] {
        padding: 10px;
        border: none;
        border-radius: 5px;
        margin-bottom: 20px;
        width: 100%;
      }
      button[type="submit"] {
        background-color: #333;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
      }
    </style>
  </head>
  <body>
  <img src="../media/logo ECEBOOK.png" alt="Logo" class="logo">
    <h1>Delete Account</h1>

    <form method="POST" action="../controller/userSup.php">
      <label for="mail">Email:</label>
      <input type="email" name="mail" id="mail" required>
      <br>
      <button type="submit">Delete Account</button>
    </form>
  </body>
</html>

