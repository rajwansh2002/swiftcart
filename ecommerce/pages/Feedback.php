<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback - Your E-commerce Website</title>
    <?php
    require('header.php');
    ?>
    <style>
        body {
            font-family: Georgia, 'Times New Roman', Times, serif;
            margin: 0;
            padding: 0;
            position: relative;
        }

        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('Login.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            filter: blur(6px);
            z-index: -1;
        }

        .feedback-section {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.5);
            padding: 20px;
            border-radius: 10px;
            margin: 50px auto;
            max-width: 800px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            font-size: 33px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        textarea {
            width: 40%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-sizing: border-box;
        }

        .rating {
            display: inline-flex;
            flex-direction: row;
            unicode-bidi: bidi-override;
            direction: rtl;
        }

        .rating input {
            display: none;
        }

        .rating label {
            color: #ccc;
            font-size: 24px;
            cursor: pointer;
            margin-right: 5px;
        }

        .rating label:hover,
        .rating label:hover~label {
            color: #ffcc00;
        }

        .rating input:checked~label {
            color: #ffcc00;
        }

        /* .rating {
            unicode-bidi: bidi-override;
            direction: rtl;
        }

        .rating input {
            display: none;
        }

        .rating label {
            color: #ccc;
            font-size: 24px;
            cursor: pointer;
        }

        .rating label:before {
            content: "\2605";
        }

        .rating input:checked~label {
            color: #ffcc00;
        } */

        button[type="submit"] {
            background-color: #8c8c8c;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #646464;
        }
    </style>
</head>

<body>
    <main>
        <div class="container">
            <section class="feedback-section">
                <h1>Share Your Feedback</h1>
                <p>We value your opinion and would love to hear your thoughts about our products and services.</p>
                <form id="feedback-form" action="#" method="post">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" required>
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="rating">Overall Rating:</label>
                        <div class="rating">
                            <input type="radio" id="rating-1" name="rating" value="1">
                            <label for="rating-1" title="1 star">&#9733;</label>
                            <input type="radio" id="rating-2" name="rating" value="2">
                            <label for="rating-2" title="2 stars">&#9733;</label>
                            <input type="radio" id="rating-3" name="rating" value="3">
                            <label for="rating-3" title="3 stars">&#9733;</label>
                            <input type="radio" id="rating-4" name="rating" value="4">
                            <label for="rating-4" title="4 stars">&#9733;</label>
                            <input type="radio" id="rating-5" name="rating" value="5">
                            <label for="rating-5" title="5 stars">&#9733;</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="comments">Comments:</label>
                        <textarea id="comments" name="comments" rows="5" required></textarea>
                    </div>

                    <button type="submit">Submit Feedback</button>
                </form>
            </section>
        </div>

    </main>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const feedbackForm = document.getElementById('feedback-form');

            feedbackForm.addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent the form from submitting normally

                // Get form data
                const formData = new FormData(feedbackForm);
                const name = formData.get('name');
                const email = formData.get('email');
                const rating = formData.get('rating');
                const comments = formData.get('comments');

                // Validate form data
                if (!name || !email || !rating || !comments) {
                    alert('Please fill in all fields.');
                    return;
                }

                // Create an object with the form data
                const feedbackData = {
                    name: name,
                    email: email,
                    rating: rating,
                    comments: comments
                };

                // Send the feedback data to the server
                sendFeedbackToServer(feedbackData);

                // Reset the form
                feedbackForm.reset();
                alert('Thank you for your feedback!');
            });
        });

        function sendFeedbackToServer(feedbackData) {
            // Here, you would typically send the feedback data to your server using an AJAX request or fetch API
            // For demonstration purposes, we'll just log the data to the console
            console.log('Feedback Data:', feedbackData);

            // You can replace this with your server-side code to handle the feedback data
            // For example, you can send an HTTP POST request to a server-side script
        }
    </script>
</body>
<?php
require('footer.php');
?>

</html>