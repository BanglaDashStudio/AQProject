<?php
/**
 * Created by PhpStorm.
 * User: Anton
 * Date: 01.08.2015
 * Time: 1:06
 */
?>

Осталось: <span id="timer">Считаю...</span>

<script>
    var serverTime = 0;
    var serverTimeFlag = false;

    function timerRequest() {
        var xmlhttp = getXmlHttp();

        xmlhttp.open('GET', '<?php echo $this->CreateUrl('test/timerRequest'); ?>', false);
        xmlhttp.send(null);

        if (xmlhttp.status == 200) {
            serverTime = xmlhttp.responseText;
            serverTimeFlag = true;
        }
    }

    function setTimer(){
        var timestamp = Math.floor(new Date().getTime()/1000);
        var timerObj = document.getElementById('timer');

        var countdown = Number(serverTime - timestamp);

        if(countdown > 0) {

            var seconds = Math.floor(countdown%60);
            var minutes = Math.floor((countdown%3600)/60);
            var hours = Math.floor(countdown/3600);

            var timerString = "";

            if(hours > 0)timerString = hours + ":";
            timerString += minutes + ":";
            timerString += seconds;

            timerObj.innerText = timerString;

        } else {
            //if(serverTimeFlag) {
            //    document.location.href = <?php echo $this->CreateUrl('test/');?>;
            //} else {
                timerObj.innerText = "Считаю...";
            //}
        }
    }

    function getXmlHttp(){
        var xmlhttp;
        try {
            xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
            try {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (E) {
                xmlhttp = false;
            }
        }
        if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
            xmlhttp = new XMLHttpRequest();
        }
        return xmlhttp;
    }
    //var firstCall = timerRequest();
    var handler = setInterval(timerRequest, 5000);
    var draw = setInterval(setTimer, 500);
</script>