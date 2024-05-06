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

    <!-- The Modal for New Event Form -->
    <div class="modal fade" id="newEventModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add New Event</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="eventForm">
                        <div class="form-group">
                            <label for="eventName">Event name:</label>
                            <input type="text" class="form-control" id="eventName" placeholder="Enter your event name" required>
                        </div>
                        <div class="form-group">
                            <label for="eventStart">Event start:</label>
                            <input type="date" class="form-control" id="eventStart" required>
                        </div>
                        <div class="form-group">
                            <label for="eventEnd">Event end:</label>
                            <input type="date" class="form-control" id="eventEnd" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Event</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <a href="display_event.php" class="btn btn-info">My Events</a>

    <script>
    // Wait for the document to be ready
    $(document).ready(function() {
       // Initialize the FullCalendar plugin
        $('#calendar').fullCalendar({
          // Configure the header of the calendar
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
             // Set the default view of the calendar
            defaultView: 'month',
            // Allow the user to select dates
            selectable: true,
            // Use a helper to draw the selection
            selectHelper: true,
            // Don't display the event time
            displayEventTime: false,
            // Fetch the events from this URL
            events: 'fetch_events.php',

            // When a date is selected, show the modal
            select: function(start, end) {
                $('#newEventModal').modal('show');
                // Set the start and end dates in the form
                $('#eventStart').val(start.format('YYYY-MM-DD'));
                $('#eventEnd').val(end.format('YYYY-MM-DD'));
            }
        });

        // When the form is submitted
        $('#eventForm').on('submit', function(e) {
          // Prevent the default form submission
            e.preventDefault();
            // Get the values from the form
            var eventName = $('#eventName').val();
            var eventStart = $('#eventStart').val();
            var eventEnd = $('#eventEnd').val();

            // Make an AJAX request to the server to save the new event
            $.ajax({
                // The URL to make the request to
                url: 'save_event.php',
                // The HTTP method to use for the request
                type: 'POST',
                // The data to send with the request
                data: {
                    title: eventName,
                    start: eventStart,
                    end: eventEnd
                },
                // The function to run if the request is successful
                success: function(response) {
                    // Parse the JSON response from the server
                    response = JSON.parse(response);
                    if (response.status === 'success') {
                        // Add the new event to the calendar
                        $('#calendar').fullCalendar('renderEvent', {
                            id: response.event.id,
                            title: response.event.title,
                            start: response.event.start,
                            end: response.event.end
                        }, true);
                        $('#newEventModal').modal('hide');
                    } else {
                        alert('Failed to add event: ' + response.message);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Failed to add event: ' + textStatus);
                }
            });
        });
    });
    </script>
</body>
</html>
