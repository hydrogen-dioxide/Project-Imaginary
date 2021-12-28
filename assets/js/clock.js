function countTime(){
    var now = new Date().getTime(); 
    const zeroPad = (num, places) => String(num).padStart(places, '0');
    now += 1000 * 60 * 60 * 8; // Hong Kong UTC+8
    var hours = Math.floor((now % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((now % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((now % (1000 * 60)) / 1000);
    document.getElementById("clock").innerHTML =  zeroPad(hours, 2) + ":" + zeroPad(minutes, 2) + ":" + zeroPad(seconds, 2);
    setTimeout(countTime, 1000);
}
countTime();