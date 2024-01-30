<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Congratulations!</title>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Add your CSS styles here -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            overflow: hidden;
            background: linear-gradient(to right, #4FACFE, #00F2FE);
        }

        .container {
            text-align: center;
            margin-top: 100px;
            color: #fff;
        }

        h2 {
            font-size: 3em;
            margin-bottom: 30px;
            animation: bounce 1s ease-in-out infinite;
        }

        p {
            font-size: 1.5em;
            animation: fadeIn 2s ease-in-out;
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-30px);
            }
            60% {
                transform: translateY(-15px);
            }
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }

        .btn-primary {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-primary:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        .confetti {
            position: fixed;
            width: 10px;
            height: 10px;
            background-color: #f8d61e;
            clip-path: polygon(50% 0%, 0% 100%, 100% 100%);
            opacity: 0;
            animation: fall 4s ease-in-out infinite, rotate 4s linear infinite;
        }

        @keyframes fall {
            0% {
                transform: translateY(-500px);
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                transform: translateY(500px);
                opacity: 0;
            }
        }

        @keyframes rotate {
            0%, 100% {
                transform: rotate(0deg);
            }
            50% {
                transform: rotate(180deg);
            }
        }
    </style>
</head>
<body class="bg-light">

<div class="container">
    <h2>Congratulations!</h2>
    <p>You successfully guessed the celebrity.</p>
    <a class="btn btn-primary" href="../index.php">Back</a>
</div>

<!-- Confetti Animation -->
<?php for ($i = 0; $i < 50; $i++): ?>
    <div class="confetti" style="left: <?= rand(0, 100) ?>vw; animation-delay: <?= rand(0, 4) ?>s;"></div>
<?php endfor; ?>

<!-- Add Bootstrap JS and Popper.js -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>
