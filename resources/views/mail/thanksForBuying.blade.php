<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
        .thank-you-container {
            text-align: center;
            padding: 50px 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            margin: 20px;
        }
        h3 {
            color: #4caf50;
            font-size: 2em;
        }
        p {
            font-size: 1.2em;
            color: #555;
        }
        @media (max-width: 600px) {
            h3 {
                font-size: 1.5em;
            }
            p {
                font-size: 1em;
            }
        }
    </style>
</head>
<body>

<div class="thank-you-container">
    <h3>Thank You for Your Purchase! {{$user ->name}}</h3>
    <p>Your order has been successfully completed. We appreciate your business!</p>
</div>
<div>
    <img src="{{$message->embed('storage/'.$game->image)}}" alt="" srcset="">
</div>
</body>
</html>