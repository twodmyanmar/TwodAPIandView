<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Live 4D</title>
</head>
<style>
    .navbar-custom {
        width: 100%;
        height: 3.5rem;
        background: #feed3b;
        box-shadow: 1px 1px 10px #feed3b ;
        display: flex;
        justify-content: center;
        align-items: center;
        color: white;
        text-align: center;
    }
    .titile {
        text-shadow: 2px 2px 10px #000000;
        font-weight: 900 !important;
        font-size: 10rem;
        line-height: 5;
        color: white;
    }
    .number {
        color: #30ad42;
        text-shadow: 2px 2px 4px #30ad42;
        font-weight: 700 !important;
        font-size: 9rem;
        line-height: 1.3;
    }

    .bg-red {
        color:white;
        padding: 5%;
    }

    .text-large {
        font-size: 1.3rem;
        color: white;
    }

    .

    .time {
        font-size: 1.3rem;
    }

    .normalBig {
        font-size: 1.5rem;
        font-weight: 900 !important;
    }
</style>
<body class="">
    <div class="bg-[#feed3b]  h-16 pt-2">
        <div class="flex justify-between align-items-center">
            <div class="flex flex-col justify-center text-[#542601 mx-3 mt-1">
                <a href="/index" class="nav-link">
                    <p class="text-xs text-center">2D</p>
                    <h4 class="text-center font-bold">Thailand Myanmar</h4>
                </a>
            </div>


            <div class="flex justify-center align-items-center mt-1">
                <a href="#"><img src="assets/image/2d.png" class="h-7 w-7 mr-3" /></a>
                <a href="#"><img src="assets/image/3D.png" class="h-7 w-7 mr-3" /></a>
                <a href="#"><img src="assets/image/calendarweek1.png" class="h-8 w-9 mr-2" /></a>
                <a href="#"  >
                    <?xml version="1.0" encoding="utf-8"?>
                    <svg  fill="#000000" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-4" viewBox="0 0 52 52"
                        enable-background="new 0 0 52 52" xml:space="preserve">
                        <path d="M20,44c0-3.3,2.7-6,6-6s6,2.7,6,6s-2.7,6-6,6S20,47.3,20,44z M20,26c0-3.3,2.7-6,6-6s6,2.7,6,6s-2.7,6-6,6
 						S20,29.3,20,26z M20,8c0-3.3,2.7-6,6-6s6,2.7,6,6s-2.7,6-6,6S20,11.3,20,8z" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
    <marquee id="header-title" class="mt-3">
        မြန်မာ 2D အဝါသည် ဒိုင်ကြီးများအားလုံးရဲ့ ချုပ်ကိုင်မှုအောက်ရှိနေ
		မြန်မာ 2D အဝါအဟောင်းနဲ့အလျှော်အစာမလုပ်ဖိုကိုအသိပေးပါရစေ
		မြန်မာ 2D အသစ်သည် ထွက်ရှိလာပါပြီနော် ဟောထိပ်ဂဏန်းမထွက်
		ကံသက်သက်မိုထိုးသားများအားလုံးနဲ့ဖြတ်ကိုင်ဒိုင်လေးအားလုံးအတွက်
		ရောင်းဂဏန်း ဝယ်ဂဏန်း လုပ်ကွက်များကြောက်စရာမလိုကစားကြပါ
		ကံသက်သက်ကစားကြသော ဖြတ်ကိုင်ဒိုင်များနဲ့ ထိုးသားများသိစေရန်
		မြန်မာ2Dအဟောင်းကိုင်ဆောင်သူ ဒိုင်ကြီးသည်ဟော့ထိပ်စည်းတွေကို
		သူထဲနည်းတာချပေးပြီ ငွေများယူနေပါသည် ဖြတ်ကိုင်ဒိုင်နဲ့ထိုးသားများ
		အားလုံးကိုစေတနာနဲ့သတိပေးလိုက်ပါစေ မြန်မာ2Dအသစ်နဲ့ကစားပါ။
		သတိပြုရန် မြန်မာ2D အဟောင်အဝါနဲ့ပုံစံကွဲ ပလေးစတိုးမှာများကြီးပါ
		New.2D နဲ့ ကံသက်သက်ကစားရန်ဒေါင်းယူကြည့်ပါ။
    </marquee>


    <div class="container d-flex justify-content-center align-items-center flex-column ">
        <h1 id="liveNumber" class="number">

        </h1>


        <div class="flex justify-center align-items-center gap-2">
             <span id="mark">
                <?xml version="1.0" encoding="utf-8"?>
                <svg fill="#13d22a" width="34px" height="34px" viewBox="0 0 24 24" id="check-mark-circle-2"
                    data-name="Flat Line" xmlns="http://www.w3.org/2000/svg" class="icon flat-line">
                    <polyline id="primary" points="21 5 12 14 8 10"
                        style="fill: none; stroke: rgb(19, 210, 42); stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;">
                    </polyline>
                    <path
                        id="primary-2"
                        data-name="primary"
                        d="M20.94,11A8.26,8.26,0,0,1,21,12a9,9,0,1,1-9-9,8.83,8.83,0,0,1,4,1"
                        style="fill: none; stroke:  rgb(19, 210, 42); stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;">
                    </path>
                </svg>
            </span>
            <span id="clock">
                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24px" height="24px" viewBox="0 0 50 50">
                    <path d="M 25 2 C 12.309295 2 2 12.309295 2 25 C 2 37.690705 12.309295 48 25 48 C 37.690705 48 48 37.690705 48 25 C 48 12.309295 37.690705 2 25 2 z M 25 4 C 36.609824 4 46 13.390176 46 25 C 46 36.609824 36.609824 46 25 46 C 13.390176 46 4 36.609824 4 25 C 4 13.390176 13.390176 4 25 4 z M 24.984375 6.9863281 A 1.0001 1.0001 0 0 0 24 8 L 24 22.173828 A 3 3 0 0 0 22 25 A 3 3 0 0 0 22.294922 26.291016 L 16.292969 32.292969 A 1.0001 1.0001 0 1 0 17.707031 33.707031 L 23.708984 27.705078 A 3 3 0 0 0 25 28 A 3 3 0 0 0 28 25 A 3 3 0 0 0 26 22.175781 L 26 8 A 1.0001 1.0001 0 0 0 24.984375 6.9863281 z"></path>
                </svg>
            </span>
            <p class="italic text-slate-300 text-center text-sm tracking-tighter">
                Updated
                <span id="time"></span>
            </p>
        </div>
        <div class="mt-3"></div>



        <div class="card col-12 bg-[#f44236] text-white my-1 py-2 px-2">
            <div id="time1" class="d-flex justify-content-center align-items-center time text-[22px] font-semibold mb-1">
                04:05 PM
            </div>
            <hr class="border-t-2">
            <div class="d-flex justify-content-ceter align-items-center flex-row mt-2">
                <div class="col-4 text-start pl-7 text-sm text-slate-400 font-light" style="color:white;opacity:0.5;">SET</div>
                <div class="col-4 text-center text-sm text-slate-400 font-light" style="color:white;opacity:0.5;">Value</div>
                <div class="col-4 text-center font-extrabold text-xs font-light text-sm text-slate-400" style="color:white;opacity:0.5;">4D</div>
            </div>

            <div class="d-flex justify-content-ceter align-items-center flex-row ">
                <h6 id="set" class="col-4 text-lg pl-2 text-start font-light ">1223.23</h6>
                <h6 id="value" class="col-4 text-lg text-center font-light ">32424.32</h6>
                <h6 class="col-4 d-flex justify-content-center font-light align-items-center  ">
                    <span id="fourd" class="text-yellow-200 text-center  font-extrabold text-xl ml-7">
                    </span>
                    <a href="#" class="ml-5">
                        <svg class="ml-" xmlns="http://www.w3.org/2000/svg" height="16" width="10" viewBox="0 0 320 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path fill="white" d="M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z"/></svg>

                    </a>
                </h6>
            </div>
        </div>


    </div>
</body>
<script type="text/javascript">
    var apiUrl = "http://127.0.0.1:8000/api/fourd/live";
    let updatedTime = document.getElementById('time');
    let mark = document.getElementById('mark');
    let clock = document.getElementById('clock');


    mark.style.display = "block";
    clock.style.display = "block";
    const redirectToOptions = () => {
        window.location.repalce('http://127.0.0.1:8000/options');
    }

    const JumpNumber = () => {
        const time = new Date();
        const currentHour = time.getHours();
        const currentMinutes = time.getMinutes();
        const isBeforeNoon = currentHour < 16;

        if (
            (currentHour === 16 && currentMinutes >= 05)
            ||
            (currentHour > 16))
        {
            return;
        }

        const liveNumber = document.getElementById('liveNumber');
        const set = isBeforeNoon ? document.getElementById('set') : document.getElementById('set');
        const value = isBeforeNoon ? document.getElementById('value') : document.getElementById('value');

        

        liveNumber.innerHTML = "----";
        liveNumber.style.textShadow = "2px 2px 4px #ffffff";
        liveNumber.style.color = "white";
        set.style.color = "#f44236";
        value.style.color = "#f44236";

        fetchData();
    };

    const fetchData = () => {

        const apiUrl = "http://127.0.0.1:8000/api/fourd/live";
        fetch(apiUrl,{
                method: 'GET',
                headers: {
                    accept: 'application/json',
                },
            })
            .then((res) => {
                // Parse the JSON response here
                return res.json();
            })
            .then((data) => {
                const time = new Date();
                const currentHour = time.getHours();
                const currentMinutes = time.getMinutes();
                updatedTime.innerHTML = data.live.time;
                let liveNumber = document.getElementById('liveNumber');

                let set = document.getElementById('set');
                let value = document.getElementById('value');
                let fourd = document.getElementById('fourd');

                

                set.innerHTML = data.result[0].set.replace(",",'.');
                value.innerHTML = data.result[0].value.replace(",",'.').replace(",",'.');
                fourd.innerHTML = data.result[0].fourd;

                set.style.color = "white";
                value.style.color = "white";
                // fourd.style.color = "white";


                if (currentHour < 16) {

                    set.classList.add('pl-8')
                    liveNumber.style.textShadow = "2px 2px 4px #ffffff";
                    liveNumber.style.color = "#30ad42";
                    document.getElementById('set').innerHTML = data.live.set.replace(",",'.');

                    document.getElementById('value').innerHTML = data.live.value.replace(",",'.');
                    document.getElementById('fourd').innerHTML = "----";

                    //set.innerHTML = "--";
                    //value.innerHTML = "--";
                    //fourd.innerHTML  = "----";

                    mark.style.display = "none";
                    liveNumber.innerHTML = data.live.fourd;

                }
                else if (currentMinutes < 05 && currentHour == 16 ){
                    liveNumber.innerHTML = data.live.fourd;
                    liveNumber.style.textShadow = "2px 2px 4px #ffffff";
                    liveNumber.style.color = "#30ad42";
                    document.getElementById('set').innerHTML = data.live.set.replace(",",'.');
                    document.getElementById('value').innerHTML = data.live.value.replace(",",'.');
                    document.getElementById('fourd').innerHTML = "--";
                    mark.style.display = "none";

                }else if (currentHour == 16 && currentMinutes >= 05 ) {
                    const status = data.result[0].status;
                    if(status != "1")
                    {
                        mark.style.display = "block";
                        clock.style.display = "none";
                    } else {
                        clock.style.display = "block";
                        mark.style.display = "none";
                    }
                    liveNumber.innerHTML = data.result[0].fourd;
                    document.getElementById('set').innerHTML = data.result[0].set.replace(",",'.');
                    document.getElementById('value').innerHTML = data.result[0].value.replace(",",'.');
                    document.getElementById('fourd').innerHTML = data.result[0].fourd;

                } else if (currentHour > 16 ) {
                    const status = data.result[0].status;
                    if(status != "1")
                    {
                        mark.style.display = "block";
                        clock.style.display = "none";
                    } else {
                        clock.style.display = "block";
                        mark.style.display = "none";
                    }
                    liveNumber.style.textShadow = "2px 2px 4px #ffffff";
                    liveNumber.style.color = "#30ad42";
                    liveNumber.innerHTML = data.result[0].twod;
                    document.getElementById('set').innerHTML = data.result[0].set.replace(",",'.');
                    document.getElementById('value').innerHTML = data.result[0].value.replace(",",'.');
                    document.getElementById('fourd').innerHTML = data.result[0].fourd;
                }
            })
            .catch((error) => {
                console.error("Error:", error);
            });
    }
    fetchData();
    setInterval(fetchData, 2000);
    setInterval(JumpNumber,5000);

</script>

</html>

