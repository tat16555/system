<?php
  $conn = new mysqli("localhost", "root", "", "upload_db");
  $message = $conn->real_escape_string($_POST['message']);
  $username = $_SESSION['username']; // assuming you have stored the user's username in the session

  $conn->query("INSERT INTO messages (username, message) VALUES ('$username', '$message')");

  header("Location: chat.php");
?>
<html>
  <head>
    <title>Chat System</title>
    <style>
      .chat-box {
        width: 500px;
        height: 500px;
        border: 1px solid black;
        overflow: auto;
        padding: 10px;
      }
      .message-box {
        width: 100%;
        height: 50px;
      }
    </style>
  </head>
  <body>
    <div class="chat-box">
      <!-- Display messages here -->
      <?php
        $stmt = $conn->query("SELECT * FROM messages");
        while ($message = $stmt->fetch_assoc()) {
          echo "<p>" . $message['username'] . ": " . $message['message'] . "</p>";
        }
      ?>
    </div>
    <div class="message-box">
      <!-- Message input form -->
      <form action="send_message.php" method="post">
        <input type="text" name="message" placeholder="Enter your message">
        <input type="submit" value="Send">
      </form>
    </div>
  </body>
</html>

