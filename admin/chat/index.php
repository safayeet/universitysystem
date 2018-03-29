<?php
if (!isset($_SESSION))
    session_start();
$_SESSION['link'] = 'chat/index.php';
?>
<div class="container">

    <h1 class="text-center">Web chat</h1>
    <main class="col-sm-6" id="chatbody">
        <div class="userSettings">
            <label for="userName">Username:</label>
            <input id="userName" type="text" placeholder="Username" maxlength="32" value="Somebody">
        </div>

        <div class="chat">
            <div class="" id="chatOutput"></div>
            <input id="chatInput" type="text" placeholder="Input Text here" maxlength="128">
            <button id="chatSend">Send</button>
        </div>
    </main>
</div>
<script>
    "use strict";
    $(document).ready(function () {
        var chatInterval = 250; //refresh interval in ms
        var $userName = $("#userName");
        var $chatOutput = $("#chatOutput");
        var $chatInput = $("#chatInput");
        var $chatSend = $("#chatSend");

        function sendMessage() {
            var userNameString = $userName.val();
            var chatInputString = $chatInput.val();

            $.get("../chat/write.php", {
                username: userNameString,
                text: chatInputString
            });

            $userName.val("");
            $chatInput.val("");
            retrieveMessages();
        }

        function retrieveMessages() {
            $.get("../chat/read.php", function (data) {
                $chatOutput.html(data); //Paste content into chat output
                console.log(data);
            });
        }


        $chatSend.click(function () {
            sendMessage();
        });

        setInterval(function () {
            retrieveMessages();
        }, chatInterval);
    });
</script>