<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Live 1 2D</title>
    <style>
        :root {
            --page-bg: #efefef;
            --header-bg: #ffe600;
            --card-red: #f31313;
            --green: #2f9d2d;
            --green-soft: #8bc34a;
            --ink: #212121;
            --muted: #8f8f8f;
            --shadow: 0 8px 18px rgba(0, 0, 0, 0.15);
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            min-height: 100%;
            background: var(--page-bg);
            font-family: Arial, Helvetica, sans-serif;
            color: var(--ink);
        }

        body {
            min-height: 100vh;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        .page {
            min-height: 100vh;
            background:
                radial-gradient(circle at top, rgba(255, 255, 255, 0.9), rgba(239, 239, 239, 0.9) 40%, rgba(235, 235, 235, 1) 100%);
        }

        .topbar {
            height: 86px;
            background: linear-gradient(180deg, #ffe900 0%, #f7de00 100%);
            box-shadow: inset 0 -1px 0 rgba(0, 0, 0, 0.12), 0 3px 10px rgba(0, 0, 0, 0.18);
            padding: 10px 16px 12px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .brand {
            display: flex;
            flex-direction: column;
            justify-content: center;
            line-height: 1.05;
            min-width: 0;
        }

        .brand-kicker {
            font-size: 12px;
            font-weight: 700;
            color: #453000;
            margin-left: 66px;
            text-align: left;
        }

        .brand-title {
            font-size: 26px;
            font-weight: 700;
            color: #2d1b00;
            letter-spacing: -0.02em;
            text-shadow: 0 1px 0 rgba(255, 255, 255, 0.2);
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-shrink: 0;
        }

        .nav-badge {
            width: 38px;
            height: 38px;
            border-radius: 999px;
            display: grid;
            place-items: center;
            box-shadow: inset 0 -2px 0 rgba(0, 0, 0, 0.12);
            font-weight: 700;
            font-size: 12px;
            position: relative;
        }

        .nav-badge.green {
            background: linear-gradient(180deg, #8ed332 0%, #66bf2c 100%);
            color: #5f3010;
        }

        .nav-calendar {
            width: 34px;
            height: 34px;
            border-radius: 6px;
            background: linear-gradient(180deg, #75d0a9 0%, #59c18b 100%);
            position: relative;
            display: grid;
            place-items: center;
            box-shadow: inset 0 -2px 0 rgba(0, 0, 0, 0.12);
        }

        .nav-calendar::before {
            content: "";
            position: absolute;
            top: -4px;
            left: 4px;
            right: 4px;
            height: 8px;
            border-radius: 5px 5px 0 0;
            background: #2c9360;
        }

        .nav-calendar::after {
            content: "1";
            position: relative;
            z-index: 1;
            font-size: 15px;
            font-weight: 700;
            color: #0b4024;
            margin-top: 6px;
        }

        .nav-menu {
            width: 30px;
            height: 38px;
            display: grid;
            place-items: center;
            color: #1d1d1d;
            font-size: 30px;
            line-height: 1;
            margin-left: 2px;
        }

        .nav-menu span {
            transform: translateY(-4px);
        }

        .content {
            max-width: 640px;
            margin: 0 auto;
            padding: 42px 18px 36px;
        }

        .hero {
            text-align: center;
            margin-bottom: 22px;
        }

        .hero-number {
            margin: 0;
            font-family: Georgia, "Times New Roman", serif;
            font-size: 72px;
            line-height: 1;
            font-weight: 700;
            color: var(--green);
            text-shadow: 0 1px 0 rgba(255, 255, 255, 0.8);
        }

        .updated-row {
            margin-top: 16px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #8f99a1;
            font-size: 18px;
            font-style: italic;
            font-weight: 500;
        }

        .status-icon {
            width: 22px;
            height: 22px;
            display: grid;
            place-items: center;
            flex-shrink: 0;
        }

        .status-icon svg {
            width: 20px;
            height: 20px;
            display: block;
        }

        .status-icon.mark {
            display: none;
        }

        .result-card {
            background: linear-gradient(180deg, #ff1b1b 0%, #ef0606 100%);
            border-radius: 18px;
            box-shadow: var(--shadow);
            border: 1px solid rgba(255, 255, 255, 0.12);
            padding: 18px 16px 16px;
            color: #fff;
            margin-bottom: 14px;
        }

        .result-time {
            font-family: Georgia, "Times New Roman", serif;
            font-size: 34px;
            line-height: 1.05;
            font-weight: 400;
            text-align: center;
            letter-spacing: 0.01em;
            padding-bottom: 8px;
            margin-bottom: 12px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.16);
        }

        .result-grid {
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            align-items: end;
            gap: 8px;
        }

        .result-side {
            min-width: 0;
            text-align: center;
            color: rgba(255, 255, 255, 0.92);
        }

        .result-side-label {
            display: block;
            font-size: 14px;
            opacity: 0.7;
            line-height: 1;
            margin-bottom: 4px;
        }

        .result-side-value {
            display: block;
            font-family: Georgia, "Times New Roman", serif;
            font-size: 18px;
            font-weight: 700;
            line-height: 1;
        }

        .result-center {
            font-family: Georgia, "Times New Roman", serif;
            font-size: 40px;
            line-height: 1;
            font-weight: 700;
            text-align: center;
            color: #fff;
            letter-spacing: 0.01em;
            padding-bottom: 2px;
            min-width: 72px;
        }

        .result-card.result-active .result-center {
            text-shadow: 0 0 1px rgba(255, 255, 255, 0.5);
        }

        .hints-card {
            background: linear-gradient(180deg, #ff1a1a 0%, #ef0505 100%);
            border-radius: 18px;
            box-shadow: var(--shadow);
            border: 1px solid rgba(255, 255, 255, 0.12);
            color: #fff;
            padding: 16px 14px 18px;
        }

        .hints-row {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 14px;
            align-items: start;
        }

        .hint-column {
            text-align: center;
        }

        .hint-code {
            font-family: Georgia, "Times New Roman", serif;
            font-size: 22px;
            line-height: 1;
            color: rgba(255, 255, 255, 0.92);
            margin-bottom: 10px;
        }

        .hint-pill {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 118px;
            height: 42px;
            padding: 0 20px;
            border-radius: 999px;
            background: linear-gradient(180deg, #f7f6f1 0%, #dfe5df 100%);
            color: #6a9d6c;
            border: 2px solid #d7cd95;
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.8), 0 1px 2px rgba(0, 0, 0, 0.15);
            font-size: 21px;
            font-family: Georgia, "Times New Roman", serif;
        }

        .hint-code.bottom {
            margin-top: 10px;
            margin-bottom: 0;
        }

        @media (max-width: 560px) {
            .topbar {
                height: 84px;
                padding-inline: 12px;
            }

            .brand-kicker {
                margin-left: 40px;
                font-size: 11px;
            }

            .brand-title {
                font-size: 20px;
            }

            .nav-actions {
                gap: 8px;
            }

            .nav-badge {
                width: 34px;
                height: 34px;
                font-size: 11px;
            }

            .nav-calendar {
                width: 32px;
                height: 32px;
            }

            .nav-menu {
                width: 24px;
                font-size: 28px;
            }

            .content {
                padding: 26px 12px 28px;
            }

            .hero {
                margin-bottom: 18px;
            }

            .hero-number {
                font-size: 60px;
            }

            .updated-row {
                font-size: 16px;
            }

            .result-time {
                font-size: 28px;
            }

            .result-center {
                font-size: 32px;
                min-width: 62px;
            }

            .result-side-value {
                font-size: 16px;
            }

            .hints-row {
                gap: 10px;
            }

            .hint-pill {
                min-width: 92px;
                height: 38px;
                font-size: 17px;
                padding-inline: 14px;
            }

            .hint-code {
                font-size: 18px;
            }
        }

        @media (max-width: 380px) {
            .brand-kicker {
                margin-left: 30px;
            }

            .brand-title {
                font-size: 18px;
            }

            .nav-actions {
                gap: 6px;
            }

            .nav-badge {
                width: 30px;
                height: 30px;
            }

            .hero-number {
                font-size: 54px;
            }

            .result-grid {
                gap: 4px;
            }

            .result-center {
                font-size: 28px;
            }

            .result-time {
                font-size: 26px;
            }

            .hint-pill {
                min-width: 84px;
                font-size: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="page">
        <header class="topbar">
            <a href="/index" class="brand" aria-label="Thailand Myanmar home">
                <span class="brand-kicker">2D</span>
                <span class="brand-title">Thailand Myanmar</span>
            </a>

            <nav class="nav-actions" aria-label="Live navigation">
                <a href="/live1" class="nav-badge green" aria-label="2D live">2D</a>
                <a href="/live3" class="nav-badge green" aria-label="3D live">3D</a>
                <a href="/calendar" class="nav-calendar" aria-label="Calendar"></a>
                <a href="/option" class="nav-menu" aria-label="Options"><span>&#8942;</span></a>
            </nav>
        </header>

        <main class="content">
            <section class="hero">
                <h1 id="liveNumber" class="hero-number">50</h1>
                <div class="updated-row">
                    <span id="mark" class="status-icon mark" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none">
                            <path d="M20 6L9 17l-5-5" stroke="#2f9d2d" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"></path>
                            <circle cx="12" cy="12" r="9" stroke="#2f9d2d" stroke-width="1.8"></circle>
                        </svg>
                    </span>
                    <span id="clock" class="status-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none">
                            <circle cx="12" cy="12" r="9" stroke="#9aa5ad" stroke-width="1.8"></circle>
                            <path d="M12 7v5l3 2" stroke="#9aa5ad" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </span>
                    <span>Updated <span id="time">15:16:04</span></span>
                </div>
            </section>

            <section class="result-card" id="morning-card">
                <div id="time1" class="result-time">12:00 AM</div>
                <div class="result-grid">
                    <div class="result-side">
                        <span class="result-side-label">Set</span>
                        <span id="set0" class="result-side-value">1296.53</span>
                    </div>
                    <div id="twod0" class="result-center">34</div>
                    <div class="result-side">
                        <span class="result-side-label">Val</span>
                        <span id="value0" class="result-side-value">13168.10</span>
                    </div>
                </div>
            </section>

            <section class="result-card" id="evening-card">
                <div id="time2" class="result-time">04:30 PM</div>
                <div class="result-grid">
                    <div class="result-side">
                        <span class="result-side-label">Set</span>
                        <span id="set2" class="result-side-value">1300.88</span>
                    </div>
                    <div id="twod2" class="result-center">50</div>
                    <div class="result-side">
                        <span class="result-side-label">Val</span>
                        <span id="value2" class="result-side-value">42969.52</span>
                    </div>
                </div>
            </section>

            <section class="hints-card">
                <div class="hints-row">
                    <div class="hint-column">
                        <div id="hint-am-money" class="hint-code">AM.69</div>
                        <div class="hint-pill">Money</div>
                        <div id="hint-pm-money" class="hint-code bottom">PM.65</div>
                    </div>
                    <div class="hint-column">
                        <div id="hint-am-internet" class="hint-code">AM.34</div>
                        <div class="hint-pill">Internet</div>
                        <div id="hint-pm-internet" class="hint-code bottom">PM.30</div>
                    </div>
                    <div class="hint-column">
                        <div id="hint-am-modern" class="hint-code">AM.86</div>
                        <div class="hint-pill">Modern</div>
                        <div id="hint-pm-modern" class="hint-code bottom">PM.57</div>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <script type="text/javascript">
        const endpoints = @json(config('twod.endpoints'));

        const liveNumber = document.getElementById('liveNumber');
        const updatedTime = document.getElementById('time');
        const mark = document.getElementById('mark');
        const clock = document.getElementById('clock');

        const morningCard = document.getElementById('morning-card');
        const eveningCard = document.getElementById('evening-card');

        function apiUrl(key) {
            return endpoints[key];
        }

        function setText(id, value) {
            const element = document.getElementById(id);
            if (element) {
                element.textContent = value ?? '--';
            }
        }

        function normalizeNumber(value) {
            return String(value ?? '--').replaceAll(',', '.');
        }

        function setHintPair(prefix, source, suffix) {
            const value = source ?? '--';
            setText(prefix, `${suffix}.${value}`);
        }

        function updateMorningResult(record) {
            setText('set0', normalizeNumber(record?.set));
            setText('value0', normalizeNumber(record?.value));
            setText('twod0', record?.twod ?? '--');
        }

        function updateEveningResult(record) {
            setText('set2', normalizeNumber(record?.set));
            setText('value2', normalizeNumber(record?.value));
            setText('twod2', record?.twod ?? '--');
        }

        function highlightCard(target) {
            morningCard.classList.remove('result-active');
            eveningCard.classList.remove('result-active');
            if (target === 'morning') {
                morningCard.classList.add('result-active');
            }
            if (target === 'evening') {
                eveningCard.classList.add('result-active');
            }
        }

        function fetchYesterdayHint() {
            fetch(apiUrl('hints_yesterday'), {
                method: 'GET',
                headers: {
                    accept: 'application/json',
                },
            })
                .then((response) => response.json())
                .then((data) => {
                    (data.hints || []).forEach((row) => {
                        if (row.time === '09:30:00') {
                            setHintPair('hint-am-money', row.money, 'AM');
                            setHintPair('hint-am-internet', row.internet, 'AM');
                            setHintPair('hint-am-modern', row.morden, 'AM');
                        }

                        if (row.time === '14:00:00') {
                            setHintPair('hint-pm-money', row.money, 'PM');
                            setHintPair('hint-pm-internet', row.internet, 'PM');
                            setHintPair('hint-pm-modern', row.morden, 'PM');
                        }
                    });
                })
                .catch((error) => {
                    console.error('Hint load error:', error);
                });
        }

        function fetchYesterdayLive() {
            fetch(apiUrl('live_yesterday'), {
                method: 'GET',
                headers: {
                    accept: 'application/json',
                },
            })
                .then((response) => response.json())
                .then((data) => {
                    const rows = data.data || [];
                    rows.forEach((row) => {
                        if (row.open_time === '12:00') {
                            setText('time1', '12:00 AM');
                            setText('time2', '04:30 PM');
                            setText('time', `${row.recorded_at} ${row.open_time}`);
                            setText('liveNumber', row.number);
                            updateMorningResult(row);
                        }

                        if (row.open_time === '16:30') {
                            setText('time2', '04:30 PM');
                            setText('liveNumber', row.number);
                            updateEveningResult(row);
                        }
                    });

                    mark.style.display = 'none';
                    clock.style.display = 'block';
                    highlightCard('morning');
                })
                .catch((error) => {
                    console.error('Yesterday live load error:', error);
                });
        }

        function fetchData() {
            fetch(apiUrl('live'), {
                method: 'GET',
                headers: {
                    accept: 'application/json',
                },
            })
                .then((response) => response.json())
                .then((data) => {
                    const now = new Date();
                    const currentHour = now.getHours();
                    const currentMinutes = now.getMinutes();
                    const morning = data.result?.[0] || {};
                    const evening = data.result?.[2] || {};

                    setText('time', data.live?.time || '--');
                    setText('time1', '12:00 AM');
                    setText('time2', '04:30 PM');
                    updateMorningResult(morning);
                    updateEveningResult(evening);

                    if (currentHour < 12) {
                        setText('liveNumber', data.live?.twod ?? '--');
                        updateMorningResult(data.live || morning);
                        setText('set2', '--');
                        setText('value2', '--');
                        setText('twod2', '--');
                        mark.style.display = 'none';
                        clock.style.display = 'block';
                        highlightCard('morning');
                        return;
                    }

                    if (currentHour === 12 || currentHour === 13 || (currentHour === 14 && currentMinutes === 0)) {
                        setText('liveNumber', morning.twod ?? '--');
                        updateMorningResult(morning);
                        mark.style.display = 'none';
                        clock.style.display = 'block';
                        highlightCard('morning');
                        return;
                    }

                    if (currentHour >= 14 && currentHour < 16) {
                        setText('liveNumber', data.live?.twod ?? '--');
                        updateEveningResult(data.live || evening);
                        setText('twod2', '--');
                        mark.style.display = 'none';
                        clock.style.display = 'block';
                        highlightCard('evening');
                        return;
                    }

                    if (currentHour === 16 && currentMinutes < 30) {
                        setText('liveNumber', data.live?.twod ?? '--');
                        updateEveningResult(data.live || evening);
                        setText('twod2', '--');
                        mark.style.display = 'none';
                        clock.style.display = 'block';
                        highlightCard('evening');
                        return;
                    }

                    if (currentHour === 16 && currentMinutes >= 30) {
                        setText('liveNumber', evening.twod ?? '--');
                        updateEveningResult(evening);
                        mark.style.display = 'block';
                        clock.style.display = 'none';
                        highlightCard('evening');
                        return;
                    }

                    if (currentHour > 16) {
                        setText('liveNumber', evening.twod ?? '--');
                        updateEveningResult(evening);
                        mark.style.display = 'block';
                        clock.style.display = 'none';
                        highlightCard('evening');
                    }
                })
                .catch((error) => {
                    console.error('Live load error:', error);
                });
        }

        function shouldShowYesterday() {
            const now = new Date();
            const currentHour = now.getHours();
            const currentMinutes = now.getMinutes();
            const today = now.getDay();

            return today === 0 || today === 6 || currentHour < 9 || (currentHour === 9 && currentMinutes < 30);
        }

        function refreshPage() {
            fetchYesterdayHint();
            if (shouldShowYesterday()) {
                fetchYesterdayLive();
                return;
            }

            fetchData();
            setInterval(fetchData, 3000);
        }

        mark.style.display = 'none';
        clock.style.display = 'block';

        refreshPage();
    </script>
</body>
</html>
