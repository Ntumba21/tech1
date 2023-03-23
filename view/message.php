<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <link rel="stylesheet" href="../view/style/message.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $("form.chat-form").on("submit", function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "/controller/message.php?action=send&receiver_id=<?php echo $_GET['receiver_id']; ?>",
                    data: $(this).serialize(),
                    success: function() {
                        $("textarea").val("");
                        loadMessages();
                    }
                });
            });

            function loadMessages() {
                $.ajax({
                    type: "GET",
                    url: "/controller/message.php?action=getMessages&receiver_id=<?php echo $_GET['receiver_id']; ?>",
                    success: function(data) {
                        $(".conversation").html(data);
                    }
                });
            }

            loadMessages();
            setInterval(loadMessages, 3000);
        });
    </script>
</head>
<body>
   
<div class="chat-global">

    <div class="nav-top">
        <div class="location">
            <img src="../media/left-chevron.svg">
            <p>Back</p>
        </div>

        <div class="utilisateur">
            <p>John Doe</p>
            <p>Active Now</p>
        </div>
    </div>

    <div class="conversation">
        <!-- Les messages seront chargés ici -->
    </div>


    <form class="chat-form">

        <div class="container-inputs-stuffs">


            <div class="group-inp">
                <textarea name="content" placeholder="Enter your message here" minlength="1" maxlength="1500"></textarea>
                <img src="../media/smile.svg">
            </div>


            <button class="submit-msg-btn" type="submit">
                <img src="../media/send.svg">
            </button>
        </div>

    </form>
</div>


</body>
</html>
