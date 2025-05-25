<?php

session_start();

if(isset($_POST['addtocart'])){

  if(isset($_SESSION['cart'])){

    $featured_array_ids = array_column($_SESSION['cart'],"featured_id");
    if(!in_array($_POST['featured_id'], $featured_array_ids)){
      
      $featured_array = array(
        'featured_id' => $_POST['featured_id'],
        'featured_image' => $_POST['featured_image'],
        'featured_name' => $_POST['featured_name'],
        'featured_price' => $_POST['featured_price'],
        'featured_quantity' => $_POST['featured_quantity']
      );
    
    $featured_id = $_POST['featured_id'];
    $_SESSION['cart'][$featured_id] = $featured_array;

    }else{
      echo '<script>alert("Item Added")</script>';
    }

  }else{
    $featured_id = $_POST['featured_id'];
    $featured_image = $_POST['featured_image'];
    $featured_name = $_POST['featured_name'];
    $featured_price = $_POST['featured_price'];
    $featured_quantity = $_POST['featured_quantity'];

    $featured_array = array(
      'featured_id' => $featured_id,
      'featured_image' => $featured_image,
      'featured_name' => $featured_name,
      'featured_price' => $featured_price,
      'featured_quantity' => $featured_quantity
    );

    $_SESSION['cart'][$featured_id] = $featured_array;

  }


}else if(isset($_POST['remove_product'])){
  $product_id = $_POST['product_id'];
  unset($_SESSION['cart'][$product_id]);


}else{
  header('location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Panacea Pharmaceutical</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Lato:wght@300;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="indexcss.css">
  <link rel="icon" href="images/mainlogos/panacea smol logo.png">
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            customBlue: '#0077c8',
            customGreen: {
              700: '#28A745',
              500: '#2FC250'
            }
          },
          fontFamily: {
            primary: ['"Playfair Display"', 'sans-serif']
          }
        }
      }
    }
  </script>
</head>
<body class="text-gray-800">
  <!-- Top Gray Bar -->
  <div class="bg-light-bg py-1"></div>

  <!-- Header -->
  <header class="bg-white shadow p-4 flex items-center sticky top-0 z-50">
    <div class="flex items-center space-x-2">
      <a href="/index.php">
        <img src="images/mainlogos/panacea_logo.png" alt="Panacea Logo" class="h-16">
      </a>
    </div>
    <div class="flex-grow mx-4">
      <div class="relative w-1/3">
        <input type="text" placeholder="Search..." class="border rounded p-2 pl-10 w-full" />
        <button class="absolute left-2 top-1/2 transform -translate-y-1/2 text-gray-500">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a7 7 0 100 14 7 7 0 000-14zm0 0l6 6" />
          </svg>
        </button>
      </div>
    </div>
    <nav class="space-x-4">
      <a href="index.php" class="text-gray-700 hover:text-primary hover:underline transition">Home</a>
      <a href="faq.html" class="text-gray-700 hover:text-primary hover:underline transition">FAQ</a>
      <a href="privacy.html" class="text-gray-700 hover:text-primary hover:underline transition">Privacy</a>
      <a href="contact.html" class="text-gray-700 hover:text-primary hover:underline transition">Contact</a>
      <a href="signup.php" class="inline-block align-middle">
        <img src="images/header/user.png" alt="Cart" class="h-6 w-6 inline-block align-middle hover:scale-110 transition-transform duration-200">
      </a>
      <a href="maintenance.html" class="inline-block align-middle">
        <img src="images/header/addtocart.png" alt="Cart" class="h-6 w-6 inline-block align-middle hover:scale-110 transition-transform duration-200">
      </a>
    </nav>
  </header>

  <div class="max-w-6xl mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Your Shopping Cart</h1>

    <div class="overflow-x-auto">
      <table class="min-w-full border bg-white shadow rounded-lg">
        <thead class="bg-gray-200">
          <tr>
            <th class="text-left py-3 px-4 font-semibold">Product</th>
            <th class="text-left py-3 px-4 font-semibold">Price</th>
            <th class="text-left py-3 px-4 font-semibold">Quantity</th>
            <th class="text-left py-3 px-4 font-semibold">Subtotal</th>
            <th class="text-left py-3 px-4 font-semibold">Remove</th>
          </tr>
        </thead>
        <tbody>

        <?php foreach($_SESSION['cart'] as $key => $value){ ?>
          <tr class="border-t">
            <td class="py-4 px-4">
              <div class="flex items-center space-x-4">
                <img src="../<?php echo $value['featured_image']; ?>" alt="Product" class="h-16 w-16 object-cover rounded">
                <span><?php echo $value['featured_name']; ?></span>
              </div>
            </td>
            <td class="py-4 px-4">₱<?php echo $value['featured_price']; ?></td>
            <td class="py-4 px-4">
              <input type="number" value="1" min="1" class="w-16 p-1 border rounded">
            </td>
            <td class="py-4 px-4">₱<?php echo $value['featured_price']; ?></td>
            <td class="py-4 px-4">
            <form method="POST" action="addtocart.php">
              <input type="hidden" name="product_id" value="<?php echo $value['featured_id']; ?>"/>
              <input type="submit" name="remove_product" class="text-red-600 hover:underline" value="remove"/>
            </form>
            </td>
          </tr>
        <?php }?>
        </tbody>
      </table>
    </div>

    <div class="mt-8 flex justify-between items-center">
      <a href="index.php" class="text-blue-600 hover:underline">← Continue Shopping</a>
      <div class="text-right">
        <p class="text-lg font-semibold">Subtotal: <span class="text-customBlue">₱499.00</span></p>
        <button class="mt-3 px-6 py-2 bg-customBlue text-white font-semibold rounded hover:bg-blue-700">
          Proceed to Checkout
        </button>
      </div>
    </div>
  </div>

 <!-- Footer -->
  <footer class="bg-customBlue text-white pt-10 pb-4 px-6 mt-10">
    <div class="max-w-7xl mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">

      <!-- Contact Info -->
      <div>
        <h4 class="text-lg font-semibold font-primary mb-3">CONTACT INFO</h4>
        <p class="text-sm mb-1"><strong>ADDRESS:</strong><br>Gabriela ParkCaster Hills<br>Philippines</p>
        <p class="text-sm mt-2"><strong>PHONE:</strong> <br>+(63) 99 450 4823</p>
        <p class="text-sm mt-2"><strong>EMAIL:</strong> <br>panacea@gmai.com.ph</p>
        <p class="text-sm mt-2"><strong>WORKING DAYS/HOURS:</strong> <br>Mon – Sun / 8:00 AM – 6:00 PM</p>
        <div class="flex space-x-4 mt-4">
          <a href="maintenance.html"><img src="images/socials logos/fb.png" alt="Facebook" class="w-6 h-6"></a>
          <a href="maintenance.html"><img src="images/socials logos/ig.png" alt="Instagram" class="w-6 h-6"></a>
          <a href="maintenance.html"><img src="images/socials logos/x.png" alt="Twitter" class="w-6 h-6"></a>
        </div>
      </div>

      <!-- About -->
      <div>
        <h4 class="text-lg font-semibold font-primary mb-3">ABOUT PANACEA</h4>
        <ul class="space-y-1 text-sm">
          <li><a href="maintenance.html" class="hover:underline">About Us</a></li>
          <li><a href="maintenance.html" class="hover:underline">Careers</a></li>
          <li><a href="maintenance.html" class="hover:underline">Store Finder</a></li>
          <li><a href="maintenance.html" class="hover:underline">Contact Us</a></li>
          <li><a href="maintenance.html" class="hover:underline">Terms and Conditions</a></li>
          <li><a href="maintenance.html" class="hover:underline">Privacy Policy</a></li>
          <li><a href="maintenance.html" class="hover:underline">Call & Pick-Up</a></li>
        </ul>
      </div>

      <!-- Customer Service -->
      <div>
        <h4 class="text-lg font-semibold font-primary mb-3">CUSTOMER SERVICE</h4>
        <ul class="space-y-1 text-sm">
          <li><a href="maintenance.html" class="hover:underline">Help Center</a></li>
          <li><a href="maintenance.html" class="hover:underline">Payment</a></li>
          <li><a href="maintenance.html" class="hover:underline">Shipping & Delivery</a></li>
          <li><a href="maintenance.html" class="hover:underline">Returns & Refunds</a></li>
          <li><a href="maintenance.html" class="hover:underline">How to Buy</a></li>
          <li><a href="maintenance.html" class="hover:underline">Questions?</a></li>
          <li><a href="maintenance.html" class="hover:underline">Track Your Order</a></li>
        </ul>
      </div>

      <!-- Newsletter -->
      <div>
        <h4 class="text-lg font-semibold font-primary mb-3">SUBSCRIBE NEWSLETTER</h4>
        <p class="text-sm mb-3">Get all the latest information on events, sales and offers. Sign up for newsletter:</p>
        <form class="space-y-2">
          <input type="email" placeholder="Email address" class="w-full px-4 py-2 rounded-full bg-blue-800 text-white focus:outline-none">
          <button type="submit" class="bg-customGreen-700 hover:bg-customGreen-500 text-white font-bold py-2 px-4 rounded-full w-full">SUBSCRIBE</button>
          <label class="flex items-start text-xs text-gray-400 mt-2">
            <input type="checkbox" class="mr-2 mt-1">
            By subscribing, you agree to receive our newsletter and accept our privacy policy.
          </label>
        </form>
      </div>
    </div>
    </footer>

    <div class="bg-white text-center p-4">
      <p class="text-sm text-gray-600">&copy; 2025 Panacea Pharmaceutical. All rights reserved.</p>
    </div>
</body>
</html>
