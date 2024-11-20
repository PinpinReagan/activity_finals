<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $photoSize = isset($_POST['txtvolume']) ? $_POST['txtvolume'] : 60;
    $borderColor = isset($_POST['clrTheme']) ? $_POST['clrTheme'] : "#4CAF50"; // Default green theme
    $scalingFactor = 0.1 + ($photoSize * 0.9) / 100;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Peys App</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f5; /* Light grey background */
            color: #333; /* Dark grey text */
            text-align: center;
            margin: 20px;
        }
        h2 {
            color: #4CAF50; /* Green title */
        }
        #profileImage {
            width: 100%;
            max-width: 300px;
            height: auto;
            border: 5px solid #4CAF50; /* Green border */
            border-radius: 8px;
            transition: transform 0.2s ease-in-out;
        }
        form {
            background-color: #ffffff; /* White form background */
            padding: 20px;
            margin: auto;
            display: inline-block;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        }
        label {
            font-weight: bold;
        }
        input[type="range"] {
            width: 80%;
        }
        input[type="color"] {
            width: 50px;
            height: 30px;
            border: 1px solid #ccc; /* Light grey border */
            border-radius: 5px;
        }
        button {
            background-color: #4CAF50; /* Green button */
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        button:hover {
            background-color: #45a049; /* Slightly darker green */
        }
        #txtvolume {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h2>Peys App</h2>

    <form id="photoForm" method="POST" action="">
        <label for="txtvolume">Select Photo Size:</label><br>
        <input type="range" name="txtvolume" id="txtvolume" min="10" max="100" 
               value="<?php echo isset($photoSize) ? $photoSize : 60; ?>" step="10"> <br><br>

        <label for="clrTheme">Select Border Color: </label><br>
        <input type="color" name="clrTheme" id="clrTheme" 
               value="<?php echo isset($borderColor) ? $borderColor : '#4CAF50'; ?>"> <br><br>

        <button type="submit">Process</button> <br><br>

        <img src="pogisisir.png" alt="Profile Image" id="profileImage" 
             style="transform: scale(<?php echo isset($scalingFactor) ? $scalingFactor : 0.6; ?>); 
                    border-color: <?php echo isset($borderColor) ? $borderColor : '#4CAF50'; ?>;">
    </form>

    <script>
        let scaleValue = <?php echo isset($scalingFactor) ? $scalingFactor : 0.6; ?>;

        function adjustScale() {
            let volumeInput = document.getElementById('txtvolume').value;
            scaleValue = 0.1 + (volumeInput * 0.9) / 100;
        }

        document.getElementById('txtvolume').addEventListener('keydown', function(event) {
            let slider = this;
            let currentValue = parseInt(slider.value);

            event.preventDefault();

            if (event.key === 'ArrowUp' || event.key === 'ArrowRight') {
                if (currentValue < 100) {
                    slider.value = currentValue + 10;
                }
            } else if (event.key === 'ArrowDown' || event.key === 'ArrowLeft') {
                if (currentValue > 10) {
                    slider.value = currentValue - 10;
                }
            }

            adjustScale();
        });

        document.getElementById('photoForm').addEventListener('submit', function(event) {
            event.preventDefault();
            document.getElementById('profileImage').style.transform = `scale(${scaleValue})`;
            this.submit();
        });

        window.onload = function() {
            document.getElementById('txtvolume').focus();
        };

        adjustScale();
    </script>
</body>
</html>
