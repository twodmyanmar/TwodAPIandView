<!DOCTYPE html>
<html lang="my">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>2D ပြက္ခဒိန်</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        window.__TWOD_API__ = @json(config('twod.endpoints'));
    </script>
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>
<body class="bg-gray-50">
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
        <h1 class="h4 mb-0">2D ပြက္ခဒိန်</h1>
        <div class="d-flex gap-2">
            <a href="{{ url('/index') }}" class="btn btn-sm btn-secondary">ပြန်</a>
            <a href="{{ url('/admin') }}" class="btn btn-sm btn-outline-dark">Admin</a>
        </div>
    </div>
    <p class="text-muted small">နီရောင် / ပန်းခရမ်းရောင် = ပိတ်ရက် နှိပ်ပါ။ အပြာရောင် = ရက်အလိုက် 2D အတိုချုပ်။</p>
    <div id="calendar"></div>
</div>
</body>
</html>
