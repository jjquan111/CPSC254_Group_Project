<!DOCTYPE html>
<html>
<head>
    <!--use fullcalendar css for calendar-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css" rel="stylesheet" />
    
    <!--use jquery for DOM-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
    <!--use momentjs to format dates-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
    
    <!--fullcalendar library -->
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