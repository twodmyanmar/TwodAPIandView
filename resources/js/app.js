import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';

function buildTitleForDay(records) {
    if (!records || !records.length) {
        return '';
    }
    return records
        .map((r) => {
            const n = r.number ?? r.twod ?? '--';

            return `${r.open_time}: ${n}`;
        })
        .join(' | ');
}

function twodUrl(key, fallbackPath) {
    const ep = typeof window !== 'undefined' && window.__TWOD_API__ ? window.__TWOD_API__ : {};
    const v = ep[key];

    return v && v.length ? v : fallbackPath;
}

document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById('calendar');
    if (!calendarEl) {
        return;
    }

    const params = new URLSearchParams({
        year: String(new Date().getFullYear()),
        month: String(new Date().getMonth() + 1),
    });

    const closuresUrl = twodUrl('trading_closures', '/api/trading-closures');
    const closuresFull = closuresUrl.includes('?')
        ? `${closuresUrl}&${params.toString()}`
        : `${closuresUrl}?${params.toString()}`;

    Promise.all([
        fetch(twodUrl('event_days', '/api/event-days')).then((r) => r.json()),
        fetch(twodUrl('calendar', '/api/calendar')).then((r) => r.json()),
        fetch(closuresFull).then((r) => r.json()),
    ])
        .then(([eventDays, calJson, closures]) => {
            const events = [];

            (closures || []).forEach((c) => {
                events.push({
                    title: c.title,
                    start: c.date,
                    allDay: true,
                    display: 'background',
                    color: '#fde8e8',
                });
            });

            (eventDays || []).forEach((day) => {
                events.push({
                    title: day.title || 'ပိတ်ရက်',
                    start: day.event_date,
                    allDay: true,
                    color: '#b91c1c',
                });
            });

            const data = calJson && calJson.data ? calJson.data : {};
            Object.keys(data).forEach((dateStr) => {
                const dayRows = data[dateStr];
                const title = buildTitleForDay(dayRows);
                if (title) {
                    events.push({
                        title: `2D: ${title}`,
                        start: dateStr,
                        allDay: true,
                        color: '#0369a1',
                    });
                }
            });

            const calendar = new Calendar(calendarEl, {
                plugins: [dayGridPlugin, interactionPlugin],
                initialView: 'dayGridMonth',
                events,
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: '',
                },
                height: 'auto',
            });

            calendar.render();
        })
        .catch((error) => {
            console.error('Calendar load error:', error);
        });
});
