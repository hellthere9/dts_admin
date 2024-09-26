<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Function Rooms Reservation Schedule</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Adjust iframe to be responsive */
        .calendar-container {
            position: relative;
            padding-bottom: 75%; /* 4:3 Aspect Ratio */
            height: 0;
            overflow: hidden;
            max-width: 100%;
        }

        .calendar-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }
    </style>
</head>
<body>

<div class="container mt-5">

    <div class="calendar-container">
        <!-- Replace the src value below with your Google Calendar embed link -->
        <iframe src="https://calendar.google.com/calendar/embed?src=c_8464de0924075257af2ebf25bcb126ca0bd0a7c9d8b124d74eb1595592124210@group.calendar.google.com&ctz=Asia/Manila"
                frameborder="0" scrolling="no"></iframe>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>

</body>
</html>
