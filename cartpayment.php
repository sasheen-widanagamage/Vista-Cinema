<?php
session_start();

include('database.php'); // Ensure database connection is correct

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize input values
    $username = htmlspecialchars($_POST['name']);
    $cardNumber = htmlspecialchars($_POST['card-number']);
    $cvv = htmlspecialchars($_POST['cvv']);
    $password = htmlspecialchars($_POST['password']);

    // Validate input values
    if (!empty($cardNumber) && !empty($cvv) && !empty($password) && !empty($username)) {
        // Prepare the SQL query
        $stmt = $conn->prepare("INSERT INTO payment (username, cardNumber, cvv, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $cardNumber, $cvv, $password);

        // Execute and handle the result
        if ($stmt->execute()) {
            echo "<script>alert('Payment successful!'); window.location.href = 'movie.html';</script>";
            exit();
        } else {
            echo "<script>alert('Error: Unable to process your payment.');</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('Please fill out all fields.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vista Cinema Payment</title>
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="payment.css">
</head>
<body>
  <div class="payment-container">
    <!-- Payment Form -->
    <div class="form-section">
      <div class="header">
        <h2>Vista Cinema Pay</h2>
        <div class="timer">01:30</div> <!-- Timer -->
      </div>
      <script>
        const timerElement = document.querySelector('.timer');
        let timeRemaining = 90;

        function updateTimer() {
          const minutes = Math.floor(timeRemaining / 60);
          const seconds = timeRemaining % 60;
          timerElement.textContent = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;

          if (timeRemaining > 0) {
            timeRemaining--;
          } else {
            clearInterval(timerInterval);
            alert("Time's up! Please try again.");
          }
        }

        const timerInterval = setInterval(updateTimer, 1000);
        updateTimer();
      </script>
      <form method="post">
        <div class="form-group">
          <label for="name">Name</label>
          <div class="input-group">
            <input type="text" id="name" name="name" placeholder="Enter your Name" maxlength="21" required>
            <i class='bx bx-credit-card'></i>
          </div>
        </div>
        <div class="form-group">
          <label for="card-number">Card Number</label>
          <div class="input-group">
            <input type="text" id="card-number" name="card-number" placeholder="Enter your card number" maxlength="19" required>
            <i class='bx bx-credit-card'></i>
          </div>
        </div>
        <div class="form-group">
          <label for="cvv">CVV</label>
          <div class="input-group">
            <input type="password" id="cvv" name="cvv" placeholder="Enter CVV" maxlength="3" required>
            <i class='bx bx-lock'></i>
          </div>
        </div>
        <div class="form-group">
          <label for="expiry">Expiry Date</label>
          <div class="expiry-input">
            <input type="text" id="expiry-month" placeholder="MM" maxlength="2" required>
            <span>/</span>
            <input type="text" id="expiry-year" placeholder="YY" maxlength="2" required>
          </div>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <div class="input-group">
            <input type="password" id="password" name="password" placeholder="Enter your dynamic password" required>
            <i class='bx bx-key'></i>
          </div>
        </div>
        <button type="submit" class="pay-btn">Pay Now</button>
      </form>
    </div>
    <div> <br><h4>Important Notice:</h4>
           <p>Please ensure you enter your full name <br>accurately as it will be used for ticket<br> issuance at the counter. Incorrect <br>or incomplete names may result in delays or <br>issues when claiming your ticket.
           </p>
            <p>Thank you for your cooperation!</p></div>  
  </div>
</body>
</html>


