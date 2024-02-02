<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Random Anime Picture</title>

  <!-- css ni -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- download ta ani -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
        crossorigin="anonymous" />

    <style>
        body {
            background-color: #f0f0f0; 
        }

        .container {
            border: 10px solid #333; 
            padding: 20px;
            border-radius: 10px; 
        }

        .blink {
            animation: blinker 1s linear infinite;
        }

/* para blinker sa title haha */



        @keyframes blinker {
            50% {
                opacity: 0;
            }
        }
    </style>
</head>
<body class="antialiased">
    <div class="container my-5">
        <div class="text-center">
            <h1 class="display-4 text-center mb-3 blink" id='quotes'>Anime Character List</h1>
            <div class="d-flex justify-content-center">
                <img src="" alt="Waifu Image" id="waifuImage" style="max-width: 100%; max-height: 400px; display: none;">
            </div>
            <p id="description" class="display-5 blink" style="font-style: italic"></p>
            <button class="btn btn-primary my-3" id="get">New Picture</button>
            <button class="btn btn-danger my-3" id="clear">Clear Picture</button>
        </div>
        <hr />
        <div id="res"></div>
        <div id="output"></div>
    </div>

    <script>
        const apiEndpoint = 'https://api.waifu.pics/sfw/waifu';
        const descriptionApiEndpoint = '';

        function ajaxGet() {
            $.ajax({
                url: apiEndpoint,
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    output(response);
                    fetchDescription();
                },
                error: function(error) {
                    console.error(error);
                }
            });
        }

        function fetchDescription() {
            $.ajax({
                url: descriptionApiEndpoint,
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    updateDescription(response);
                },
                error: function(error) {
                    console.error(error);
                }
            });
        }

        function updateDescription(response) {
            const descriptionContainer = document.querySelector('#description');
           
            descriptionContainer.innerText = response.description;
        }

        function clearPicture() {
            const waifuImage = document.querySelector('#waifuImage');
            waifuImage.style.display = 'none';
        }

        function output(response) {
            const container = document.querySelector('#quotes');
            const waifuImage = document.querySelector('#waifuImage');
            
            waifuImage.src = response.url;
            waifuImage.style.display = 'block';
        }

        $(document).ready(function() {
            $('#get').on('click', ajaxGet);
            $('#clear').on('click', clearPicture);
        });
    </script>
</body>
</html>
