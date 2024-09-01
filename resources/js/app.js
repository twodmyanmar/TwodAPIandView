import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';

document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    Promise.all([fetch('api/event-days'), fetch('api/calendar')])
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(([eventDays, liveEvents]) => {
            var events = eventDays.map(day => ({
                title: day.title,
                start: day.event_date,
                allDay: true,
                color: 'red'
            }));

            // Add live events if needed
            liveEvents.forEach(event => {
                events.push({
                    twod: event.twod,
                    allDay: true,
                    color: 'blue'
                });
            });

            var calendar = new Calendar(calendarEl, {
                plugins: [dayGridPlugin, interactionPlugin],
                initialView: 'dayGridMonth',
                events: events,
                businessHours: {
                    daysOfWeek: [1, 2, 3, 4, 5], // Monday - Friday
                    startTime: '09:00', // 9am
                    endTime: '17:00', // 5pm
                },
                weekends: true // Hide Saturdays and Sundays
            });

            calendar.render();
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
        });
});
