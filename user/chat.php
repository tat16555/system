<?php 
    session_start();
    require_once '../config/dbConfig.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>hat System</title>
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
