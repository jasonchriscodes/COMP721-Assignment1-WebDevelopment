function renderTime(){

 // Date
 var myDate = new Date();
 var myYear = myDate.getFullYear();
 if(myYear < 1000){
  myYear += 1900;
 }
 var day = myDate.getDay();
 var month = myDate.getMonth();
 var daym = myDate.getDate();
 var dayArray = new Array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
 var monthArray = new Array("January","February","March","April","May","June","July","August","September","October","November","December");

 // Time
 var currentTime = new Date();
 var h = currentTime.getHours();
 var m = currentTime.getMinutes();
 var s = currentTime.getSeconds();
 // 24 Hour Format
 if(h == 24){
  h = 0;
 } else if(h > 12){
  h = h - 0;
 }
 // Show 01:00:00 instead of 1:00:00
 if(h < 10){
  h = "0" + h;
 }
 if(m < 10){
  m = "0" + m;
 }
 if(s < 10){
  s = "0" + s;
 }

 var myClock = document.getElementById("clockDisplay");
 myClock.textContent = dayArray[day] + ", " + monthArray[month] + " " + daym + ", " + myYear + " " + h + ":" + m + ":" + s;
 myClock.innerText = dayArray[day] + ", " + monthArray[month] + " " + daym + ", " + myYear + " " + h + ":" + m + ":" + s;

 // every 1 sec trigger the function renderTime()
 setTimeout("renderTime()", 1000);
}
renderTime();