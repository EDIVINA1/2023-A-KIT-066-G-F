<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iris Recognition System</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            margin-top: 50px;
        }
        #webcam-container {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center">Iris Recognition System</h2>

        <div id="webcam-container">
            <video id="webcam" width="640" height="480" autoplay></video>
            <br>
            <button class="btn btn-primary" id="captureButton">Capture Image</button>
        </div>

        <form id="irisForm" action="process_iris.php" method="post" enctype="multipart/form-data" class="mt-4">
            <input type="file" id="imageInput" name="irisImage" class="form-control" accept="image/*" style="display: none;">
            <button type="submit" class="btn btn-success">Submit Image</button>
        </form>
    </div>

    <!-- Bootstrap JS & Dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Webcam setup using JavaScript
        const videoElement = document.getElementById('webcam');
        const captureButton = document.getElementById('captureButton');
        const imageInput = document.getElementById('imageInput');

        // Start webcam
        navigator.mediaDevices.getUserMedia({ video: true })
            .then(stream => {
                videoElement.srcObject = stream;
            })
            .catch(err => console.error('Error accessing webcam: ', err));

        // Capture the image from webcam and display it for submission
        captureButton.addEventListener('click', () => {
            const canvas = document.createElement('canvas');
            const context = canvas.getContext('2d');
            canvas.width = videoElement.videoWidth;
            canvas.height = videoElement.videoHeight;
            context.drawImage(videoElement, 0, 0, canvas.width, canvas.height);

            // Convert canvas image to blob and create an input file for upload
            canvas.toBlob((blob) => {
                const file = new File([blob], "iris_image.png", { type: 'image/png' });
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                imageInput.files = dataTransfer.files;
            });
        });
    </script>
</body>
</html>
