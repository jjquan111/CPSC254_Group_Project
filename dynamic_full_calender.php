<!DOCTYPE html>
<html>
<head>
    <title>Dynamic Full Calendar</title>
    <!-- Linking FullCalendar and Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Linking jQuery, Popper.js, and Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Linking Moment.js and FullCalendar JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
</head>
<body>
    <!--calendar container-->
    <div id="calendar"></div>

    <script>
    //will execute when document is ready
    $(document).ready(function() {
        //initialize FullCalendar
        $('#calendar').fullCalendar({
            //fetch events from display_event.php
            events: 'display_event.php'
        });
    });
    </script>
</body>
</html>
