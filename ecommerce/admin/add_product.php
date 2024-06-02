<?php

session_start();
include '../pages/database.php';

// Check if the user is an admin
if (!isset($_SESSION['seller_id'])) {
    header("Location: seller_login.php");
    exit();
}

$message = ''; // Initialize an empty message variable

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category_id = $_POST['category_id'];
    $image = $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], "../images/$image");

    $stmt = $pdo->prepare("INSERT INTO products (name, description, price, category_id, image) VALUES (?, ?, ?, ?, ?)");
    if ($stmt->execute([$name, $description, $price, $category_id, $image])) {
        $message = "Product added successfully.";
        header("Location: success.php"); // Redirect to success page
        exit(); // Ensure script stops executing here
    } else {
        $message = "Failed to add product.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <?php require('seller_header.php'); ?>
    <title>Add Product</title>
    <style>
                .addprod-container {
            font-family: Georgia, 'Times New Roman', Times, serif;
            margin: 0;
            padding: 0;
            position: relative; /* Add this line */
        }

        .addprod-container::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('https://img.freepik.com/free-vector/warehouse-interior-concept-illustration_114360-22336.jpg?t=st=1716794930~exp=1716798530~hmac=7bcae6dbf010bb935303ceec1ead06ddbee3150baa1076794caa886beb8f2178&w=1060');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            filter: blur(6px);
            z-index: -1; /* Ensure the pseudo-element is behind all other content */
        }

        .addprod-container input {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            box-sizing: border-box;
            border: none;
            border-radius: 5px;
            border-bottom: 2px solid navy;
        }

        @keyframes form {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }

        .addprod-container .form-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh; /* vh stands for viewport height */
        }

        .addprod-container .alignbutton {
            text-align: center;
        }

        .addprod-container form {
            background-color: rgba(255, 255, 255, 0.9); /* Use rgba to add transparency */
            padding: 20px;
            border-radius: 10px;
            margin: 50px auto;
            max-width: 400px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            animation-name: form;
            animation-duration: 2s;
            animation-timing-function: ease-out;
        }

        .addprod-container button {
            text-align: center;
            background-color: #1d72ae; /* Green */
            border-radius: 4px;
            border: none;
            color: white;
            padding: 16px 32px;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            transition-duration: 0.4s;
            cursor: pointer;
        }

        .addprod-container button:hover {
            background-color: rgb(23, 186, 251);
        }

        .addprod-container h1 {
            text-align: center;
            color: #333;
        }


        /* text area css */
textarea {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;
  resize: vertical; /* Allow vertical resize only */
  font-family: Arial, sans-serif;
  font-size: 14px;
}

/* Style the text area when it is focused */
textarea:focus {
  border-color: #007bff; /* Change border color on focus */
  outline: none; /* Remove default focus outline */
}

/* Style the placeholder text */
textarea::placeholder {
  color: #a8a8a8;
}

/* Style the scrollbar */
textarea::-webkit-scrollbar {
  width: 10px;
}

textarea::-webkit-scrollbar-thumb {
  background-color: #888;
  border-radius: 5px;
}

textarea::-webkit-scrollbar-track {
  background-color: #f1f1f1;
}

/* select tag css */
/* Reset default styles */
select {
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  padding: 8px 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  background-color: #fff;
  font-size: 16px;
  font-family: inherit;
  cursor: pointer;
  outline: none;
}

/* Hover state */
select:hover {
  border-color: #aaa;
}

/* Focus state */
select:focus {
  border-color: #007bff; /* Change the color as needed */
  box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.25); /* Change the color and size as needed */
}

/* Disabled state */
select:disabled {
  opacity: 0.5;
  cursor: not-allowed;
}


    </style>
</head>
<body>
    <div class="addprod-container"
    <?php echo $message; ?>
        <div class="form-container">
        <form method="POST" action="" enctype="multipart/form-data">
        <input type="text" name="name" required placeholder="Product Name">
        <textarea name="description" required placeholder="Product Description"></textarea>
        <input type="number" name="price" required placeholder="Product Price">
        <select name="category_id" required>
            <!-- Fetch categories from the database and populate the options -->
            <?php
            $stmt = $pdo->query("SELECT id, name FROM categories");
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='{$row['id']}'>{$row['name']}</option>";
            }
            ?>
        </select>
        <input type="file" name="image" required >
        <div class="alignbutton">
        <button type="submit">Add Product</button>
        </div>
        </div>
    </form>
 </div>
</body>
</html>
<?php
require('seller_footer.php');
?>
