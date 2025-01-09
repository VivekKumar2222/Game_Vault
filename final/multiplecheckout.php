<?php
include 'conn.php';


$sql_query = "SELECT * 
FROM game 
WHERE ID IN (SELECT ItemID FROM carts);";

$result_sql = mysqli_query($conn, $sql_query);

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CheckOut</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="multipleCheckout.css">
  
</head>
  <body>

  

<div class="close_tab_container">
  <a href="cart.php" class="cancel_img"><img src="image/cancel-02.png" alt=""></a>
</div>

    <div class="container_self_wrapper">
   <div class="container_self">
<div class="left_side">
    <h3 class="check_out_heading">Check Out</h3>
    <div class="line"></div>
    <div class="payment_method_option_container">
      <h4>choose payment method</h4>
      <div class="payment_option_div">
        <div class="payment_method" id="method_1"><img src="image/debit_card-01.png" alt=""></div>
        <div class="payment_method" id="method_2"><img src="image/pay_pal-01.png" alt=""></div>
        <div class="payment_method" id="method_3"><img src="image/redeem_code-01.png" alt=""></div>
      </div>
    </div>
    <div id="pay_1" class="payment_slide_container">
      <div  class="payment_slide">
        <form action="">
          
          <div class="mb-3">
            <label for="cardholderName" class="form-label">Cardholder Name</label>
            <input type="text" class="form-control" id="cardholderName" placeholder="Enter cardholder name" required>
          </div>
          <!-- Card Number -->
          <div class="mb-3">
            <label for="cardNumber" class="form-label">Card Number</label>
            <input type="text" class="form-control" id="cardNumber" placeholder="1234 5678 9012 3456" maxlength="19" required>
          </div>
          <!-- Expiration Date and CVV -->
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="expirationDate" class="form-label">Expiration Date</label>
              <input type="text" class="form-control" id="expirationDate" placeholder="MM/YY" maxlength="5" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="cvv" class="form-label">CVV</label>
              <input type="password" class="form-control" id="cvv" placeholder="123" maxlength="3" required>
            </div>
          </div>
          <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
          <label class="form-check-label" for="defaultCheck1">
            Remember Me
          </label>
          <p class="note_txt" style="color: #757575; margin-top: 9px;">By choosing to save your payment information, this payment method will be selected as the default for all purchases made using GameVault payment, including purchases in Fortnite, Rocket League, Fall Guys and the GameVault Store.</p>
        </form>
      </div>
    </div>
    <div id="pay_2" class="payment_slide_container">
      <div  class="payment_slide">
        <form action="">
          <div class="mb-3">
            <label for="UserName" class="form-label">User Name</label>
            <input type="text" class="form-control" id="UserName" placeholder="Enter User name" required>
          </div>

          <div class="mb-3">
            <label for="UserEmail" class="form-label">User Email</label>
            <input type="email" class="form-control" id="UserEmail" placeholder="Enter User Email" required>
          </div>
          
          <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
          <label class="form-check-label" for="defaultCheck1">
            Remember Me
          </label>
          <p class="note_txt" style="color: #757575; margin-top: 9px;">By choosing to save your payment information, this payment method will be selected as the default for all purchases made using GameVault payment, including purchases in Fortnite, Rocket League, Fall Guys and the GameVault Store.</p>
        </form>
      </div>
    </div>
    <div id="pay_3" class="payment_slide_container">
      <div  class="payment_slide">
        <form action="">
          <div class="mb-3">
            <label for="referalCode" class="form-label">Referal Code</label>
            <input type="text" class="form-control" id="referalCode" placeholder="Enter Referal Code" required>
          </div>
          
          <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
          <label class="form-check-label" for="defaultCheck1">
            Remember Me
          </label>
          <p class="note_txt" style="color: #757575; margin-top: 9px;">By choosing to save your payment information, this payment method will be selected as the default for all purchases made using GameVault payment, including purchases in Fortnite, Rocket League, Fall Guys and the GameVault Store.</p>
        </form>
      </div>
    </div>
</div>
<div class="right_side">
  <?php
  $rows = []; // Store all rows in an array
  $total_price = 0;
  
  if ($result_sql) {
      while ($row = mysqli_fetch_assoc($result_sql)) {
          $rows[] = $row; // Save each row to the array
      }
  }
  
  // First loop to display images and names
  foreach ($rows as $row) {
      $name = $row['Name'];
      $cover_img = $row['Cover_Image'];
      $logo = $row['Logo'];
  
      echo '
      <div class="game_name_img_container">
          <div class="img_div"><img src="image/' . $cover_img . '" alt=""></div>
          <div class="game_name">
              <img src="image/' . $logo . '" alt="">
              <p class="game_name_text">' . $name . '</p>
          </div>
      </div>';
  }

  echo '<br></br>';
  
  // Second loop to calculate prices
  foreach ($rows as $row) {
      $price = $row['Price'];
      $discount = $row['Discount'];
      $discount_amount = ($price * $discount) / 100;
      $updated_price = $price - $discount_amount;
      $total_price += $updated_price;
  
      echo '
      <div class="item_price_container">
          <p class="item_price_text">Item Price</p>
          <p class="item_price">$' . $updated_price . '</p>
      </div>';
  }
  
  // Display total price
  echo '<div class="line"></div>
        <div class="total_price_container">
          <p class="total_price_text">Total Price</p>
          <p class="total_price">$' . $total_price . '</p>
        </div>';
  

      ?>
      <input type="text" class="referal_code" placeholder="Enter Referal Code">

      <div class="note_container">
        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
        <label class="form-check-label" for="flexCheckDefault">
          Please note that all purchases are final and non-refundable. Ensure your order details are correct before proceeding, as game files will be available for immediate download after checkout.
        </label>
      </div>
      
      <button type="submit" class="place_order">Place Order</button>
</div>


   </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script>
    // Get payment method options and corresponding forms
// Get payment method options and corresponding forms
const method1 = document.getElementById("method_1");
const method2 = document.getElementById("method_2");
const method3 = document.getElementById("method_3");

const pay1 = document.getElementById("pay_1");
const pay2 = document.getElementById("pay_2");
const pay3 = document.getElementById("pay_3");



// Function to hide all payment forms
function hideAllForms() {
  pay1.style.display = "none";
  pay2.style.display = "none";
  pay3.style.display = "none";
}

// Initially show pay_1, hide others
pay1.style.display = "block";
pay2.style.display = "none";
pay3.style.display = "none";

// Event listeners for each payment method
method1.addEventListener("click", function() {
  hideAllForms();
  pay1.style.display = "block"; // Show pay_1
  method1.style.border = "2px solid #C6C6C6";
  method2.style.border = "none";
  method3.style.border = "none";
});

method2.addEventListener("click", function() {
  hideAllForms();
  pay2.style.display = "block"; // Show pay_2
  method2.style.border = "2px solid #C6C6C6";
  method1.style.border = "none";
  method3.style.border = "none";
});

method3.addEventListener("click", function() {
  hideAllForms();
  pay3.style.display = "block"; // Show pay_3
  method3.style.border = "2px solid #C6C6C6";
  method2.style.border = "none";
  method1.style.border = "none";
});

function isPaymentMethodFilled() {
  // Get the values from all payment method forms
  const cardholderName = document.getElementById("cardholderName").value.trim();
  const cardNumber = document.getElementById("cardNumber").value.trim();
  const expirationDate = document.getElementById("expirationDate").value.trim();
  const cvv = document.getElementById("cvv").value.trim();

  const userName = document.getElementById("UserName").value.trim();
  const userEmail = document.getElementById("UserEmail").value.trim();

  const referralCode = document.getElementById("referalCode").value.trim();

  // Check if at least one payment method form is filled
  if (
    (cardholderName && cardNumber && expirationDate && cvv) || 
    (userName && userEmail) ||
    referralCode 
  ) {
    return true;
  } else {
    return false; 
  }
}


const placeOrderBtn = document.querySelector(".place_order");
placeOrderBtn.addEventListener("click", function (event) {
  if (isPaymentMethodFilled()) {
    alert("Your Order is Placed");
    // 
    // $del_query = "DELETE FROM `carts` WHERE ItemID = '$id'";
    // $del_result = mysqli_query($conn, $del_query);
    // 
  } else {
    alert("Please fill out at least one payment method before placing your order.");
    event.preventDefault(); 
  }
});


  </script>
  </body>
</html>