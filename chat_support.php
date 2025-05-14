<div id="chat-widget">
    <div id="chat-header">
        <strong>💬 Chat Support</strong>
        <span id="toggle-chat">▼</span>
    </div>
    <div id="chat-body">
        <div id="chat-messages"></div>
        <div id="chat-input">
            <input type="text" id="user-input" placeholder="Type a message...">
            <button id="send-btn">Send</button>
        </div>
    </div>
</div>

<style>
    /* Floating Chat Widget */
    #chat-widget {
        position: fixed;
        bottom: 20px;
        right: 20px;
        width: 350px;
        background: #fff;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        border-radius: 10px;
        overflow: hidden;
        font-family: 'Arial', sans-serif;
        z-index: 1000;
        transition: all 0.3s ease-in-out;
    }

    #chat-header {
        background: #007bff;
        color: white;
        padding: 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
    }

    #chat-body {
        display: none;
        height: 400px;
        overflow-y: auto;
        padding: 10px;
        background: #f9f9f9;
        border-top: 2px solid #007bff;
    }

    #chat-messages {
        display: flex;
        flex-direction: column;
    }

    .message {
        padding: 10px 15px;
        margin: 5px 0;
        border-radius: 15px;
        max-width: 75%;
        font-size: 14px;
    }

    .user-message {
        align-self: flex-end;
        background: #007bff;
        color: white;
        border-radius: 15px 15px 0 15px;
    }

    .bot-message {
        align-self: flex-start;
        background: #e6e6e6;
        color: black;
        border-radius: 15px 15px 15px 0;
    }

    #chat-input {
        display: flex;
        padding: 10px;
        border-top: 1px solid #ddd;
        background: white;
    }

    #chat-input input {
        flex: 1;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 14px;
    }

    #chat-input button {
        margin-left: 5px;
        background: #007bff;
        color: white;
        border: none;
        padding: 10px 15px;
        cursor: pointer;
        font-size: 14px;
        border-radius: 4px;
    }

    /* Mobile Responsiveness */
    @media (max-width: 768px) {
        #chat-widget {
            width: 90%;
            right: 5%;
            bottom: 10px;
        }
    }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    // Toggle Chat Box
    $("#toggle-chat").click(function () {
        $("#chat-body").slideToggle();
    });

    // Send Message
    $("#send-btn").click(function () {
        sendMessage();
    });

    $("#user-input").keypress(function (e) {
        if (e.which == 13) {
            sendMessage();
        }
    });

    function sendMessage() {
        var userMessage = $("#user-input").val().trim();
        if (userMessage === "") return;

        // Append user message
        $("#chat-messages").append('<div class="message user-message">' + userMessage + '</div>');
        $("#user-input").val("");
        $("#chat-body").scrollTop($("#chat-body")[0].scrollHeight);

        // Send message to backend (PHP)
        $.ajax({
            type: "POST",
            url: "chat_backend.php",
            data: { message: userMessage },
            dataType: "json",
            success: function (response) {
                // Append AI response
                $("#chat-messages").append('<div class="message bot-message">' + response.ai_response + '</div>');
                $("#chat-body").scrollTop($("#chat-body")[0].scrollHeight);
            }
        });
    }
});
</script>
