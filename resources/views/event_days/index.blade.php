<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

	<link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet'>

    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
    <!-- Include FullCalendar CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.7.2/main.min.css" rel="stylesheet">

    <title>2D Thailand Myanmar</title>
  </head>

  <style type="text/css">
  	#calendar-container {
  		position: fixed;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
	}

	.fc-header-toolbar {
	  /*
	  the calendar will be butting up against the edges,
	  but let's scoot in the header's buttons
	  */
	  padding-top: 1em;
	  padding-left: 1em;
	  padding-right: 1em;
}

  </style>
  <body>
  	<div class="bg-[#feed3b]  h-16 pt-2">
        <div class="flex justify-between align-items-center">
            <div class="flex flex-col justify-center text-[#542601 mx-3 mt-1">
                <a href="/index" class="nav-item">
                    <p class="text-xs text-center">2D</p>
                    <h4 class="font-bold text-center">Thailand Myanmar</h4>
                </a>
            </div>


            <div class="flex justify-center mt-1 align-items-center">
                <a href="#"><img src="assets/image/2d.png" class="mr-3 h-7 w-7" /></a>
                <a href="/live3"><img src="assets/image/3D.png" class="mr-3 h-7 w-7" /></a>
                <a href="/calendar"><img src="assets/image/calendarweek1.png" class="h-8 mr-2 w-9" /></a>
                <a href="#"  >
                    <?xml version="1.0" encoding="utf-8"?>
                    <svg  fill="#000000" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-4" viewBox="0 0 52 52"
                        enable-background="new 0 0 52 52" xml:space="preserve">
                        <path d="M20,44c0-3.3,2.7-6,6-6s6,2.7,6,6s-2.7,6-6,6S20,47.3,20,44z M20,26c0-3.3,2.7-6,6-6s6,2.7,6,6s-2.7,6-6,6
 						S20,29.3,20,26z M20,8c0-3.3,2.7-6,6-6s6,2.7,6,6s-2.7,6-6,6S20,11.3,20,8z" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
<div class="container mt-5">
    <h1>Event Days</h1>
    <a class="btn btn-primary" href="{{ route('event_days.create') }}">Add Event Day</a>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Event Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($eventDays as $eventDay)
                <tr>
                    <td>{{ $eventDay->id }}</td>
                    <td>{{ $eventDay->title }}</td>
                    <td>{{ $eventDay->event_date }}</td>
                    <td>
                        <a class="btn btn-warning" href="{{ route('event_days.edit', $eventDay->id) }}">Edit</a>
                        <form action="{{ route('event_days.destroy', $eventDay->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
