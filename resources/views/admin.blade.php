<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pusher</title>
</head>
<body>
    
    <h2>Welcome to Pusher</h2>
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script>
            Pusher.logToConsole = true;

            var pusher = new Pusher('9505259233ff4e3756e7', {
      cluster: 'ap2'
    });

    
    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
      alert(JSON.stringify(data));
    });
    </script>
</body>
</html>