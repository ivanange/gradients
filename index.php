<!DOCTYPE html>
<html lang="">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="jquery-3.3.1.min.js"></script>
    <title>
        gradients </title>
    <style>
        body,
        .body {
            padding: 0px;
            margin: 0px;
            font-family: "quick sans", "open sans", quicksans, opensans, sans, lato, proxima, helvatica, sans-serif;
        }

        .body {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
        }

        .gradient {
            margin: 20px;
            width: 250px;
            height: 250px;
            border-radius: 5px;
            box-shadow: -1px -1px 15px 2px rgba(0, 0, 0, 0.44);
            position: relative;
            display: flex;
            align-items: flex-start;
            justify-content: flex-end;

        }

        .info {

            margin: 20px 10px;
            background-color: rgba(0, 0, 0, 0.83);
            color: white;
            display: none;
            border-radius: 5px;
            text-align: center;
            padding: 10px;

        }

        .info:hover {cursor: pointer;}

        .alert {
            position: fixed;
            top: 100px;
            --width: 80px;
            width: var(--width);
            left: calc(50% - (var(--width) / 2));
            z-index: 6;

        }

        #overlay {
            height: 100vh;
            width: 100vw;
            z-index: 3;
            position: fixed;
            top: 0px;
            left: 0px;
            margin: 0px;
            padding: 0px;
            display: none;

        }

        #overlay span {
            box-sizing: border-box;
            position: absolute;
            top: 10px;
            right: 50px;
            font-size: 40px;
            background-color: transparent;
            display: inline-block;
            padding: 10px;
            color: white;

        }

        #overlay span:hover {
            cursor: pointer;
        }

        .full {
            padding: 10px;
        }

    </style>
</head>

<body>


    <div class="body">
        <?php exec("python generate-html.py"); 
         include "content.php"; ?>
    </div>
    <div class="alert info"> Copied ! </div>
    <textarea id="container" style="opacity:0;"></textarea>
    <div id="overlay"><span>X</span></div>

    <script>
        $text = $("#container");
        $gradient = $(".gradient");
        $overlay = $("#overlay");
        $overlayClose = $($overlay[0].firstChild);
        $currentGradient = null;

        function fadeOverlayButton() {
            $overlay.attr("interval", setTimeout(
                function() {
                    $overlayClose.fadeOut()
                }, 2000));
        }


        $(".full").click(
            function($e) {
                $e.stopImmediatePropagation();
                $parent = $(this).parent();
                $currentGradient = $parent;
                $overlay[0].style.backgroundImage = $parent.attr("clip-data");
                $overlay.fadeIn("fast");
                fadeOverlayButton();
            }
        );


        $gradient.click(function($e) {
            $text.val($(this).attr("clip-data"));
            $text[0].select();
            document.execCommand("copy");
            $alert = $(".alert");
            $alert.fadeIn("fast");
            setTimeout(function() {
                $alert.fadeOut("fast");
            }, 1000);

        }).hover(

            function($e) {
                $children = $(this).children(".info");
                $children.slideDown("fast");
            },
            function($e) {
                $children.slideUp("fast");
            });



        $overlayClose.click(
            function($e) {
                $e.stopPropagation();
                $overlay.fadeOut("fast");

            })

        $overlay.mousemove(
            function() {
                clearTimeout($overlay.attr("interval"));


                if ($overlayClose.not(":visible")) {
                    $overlayClose.fadeIn();
                    fadeOverlayButton();
                }

            }).click(() => {
            $currentGradient.click()
        });

    </script>
</body>


</html>
