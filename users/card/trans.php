<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Thank You</title>
  <style>
    body,
    html {
      height: 100%;
      margin: 0;
      padding: 0;
    }

    .full-page-gif {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
  </style>
</head>

<body>
  <video src="../../img/anime-thanks.mp4" class="full-page-gif" autoplay loop muted></video>
  <audio id="thankVoice" src="../../audio/thank-you-voice.mp3"></audio>

  <script>
    // Wait for the page to load, then play the voice and video
    window.onload = function() {
      const voice = document.getElementById('thankVoice');

      // Try to play the voice immediately
      voice.play().catch(function(error) {
        console.log('Audio playback blocked:', error);
      });

      // Redirect after 2.5 seconds
      setTimeout(function() {
        window.location.href = "../HomePage/index.php";
      }, 2500);
    };
  </script>
</body>

</html>