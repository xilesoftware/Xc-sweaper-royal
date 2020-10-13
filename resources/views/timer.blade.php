<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Timer</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #3e3e3e;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
                padding-top: 300px;
                padding-bottom: 300px;
            }

            .title {
                font-size: 90px;
                text-shadow: 3px 2px rgb(11, 128, 7);
                font-family: "times new roman";
                color: #96c32a;
            }


            h1 {
                color: #96c32a; 
                font-family: "times new roman";
                text-shadow: 3px 2px rgb(11, 128, 7);
                font-size: 150px;
            }

            input {
                width: 5%;
                padding:10px;
                border-radius:10px;
                color: #3e3e3e;
                background-color: #96c32a;

            }
  

        </style>
    </head>
    <body>
        <div class= "content title">
            <input type="text" id="month" placeholder="Month">
            <input type="text" id="day" placeholder="Day">
            <input type="text" id="year" placeholder="Year">
            <input type="text" id="hour" placeholder="Hour">
            <input type="text" id="min" placeholder="Min">
            <input type="button" value="Count Down!" onclick="settimer();">
            <p id="timer_value"></p>
            </div>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <h1 id="demo"></h1>
            </div>
        </div>
    
    </body>
    <script>
var timer;
function settimer()
{
 clearInterval(timer);

 var timer_month=document.getElementById("month").value;
 var timer_day=document.getElementById("day").value;
 var timer_year=document.getElementById("year").value;
 var timer_hour=document.getElementById("hour").value;
 if(timer_hour=="")timer_hour=0;
 var timer_min=document.getElementById("min").value;
 if(timer_min=="")timer_min=0;

 var timer_date=timer_month+"/"+timer_day+"/"+timer_year+" "+timer_hour+":"+timer_min;
 var end = new Date(timer_date); // Arrange values in Date Time Format
 var now = new Date(); // Get Current date time
 var second = 1000; // Total Millisecond In One Sec
 var minute = second * 60; // Total Sec In One Min
 var hour = minute * 60; // Total Min In One Hour
 var day = hour * 24; // Total Hour In One Day

 function showtimer() {
  var now = new Date();
  var remain = end - now; // Get The Difference Between Current and entered date time
  if(remain < 0) 
  {
   clearInterval(timer);
   document.getElementById("timer_value").innerHTML = 'Reached!';
   return;
  }
  var days = Math.floor(remain / day); // Get Remaining Days
  var hours = Math.floor((remain % day) / hour); // Get Remaining Hours
  var minutes = Math.floor((remain % hour) / minute); // Get Remaining Min
  var seconds = Math.floor((remain % minute) / second); // Get Remaining Sec
 
  document.getElementById("timer_value").innerHTML = days + 'Days ';
  document.getElementById("timer_value").innerHTML += hours + 'Hrs ';
  document.getElementById("timer_value").innerHTML += minutes + 'Mins ';
  document.getElementById("timer_value").innerHTML += seconds + 'Secs';
 }
 timer = setInterval(showtimer, 1000); // Display Timer In Every 1 Sec
}
</script>
</html>
