<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
  <title><?php echo the_title(); ?></title>

  <link rel="icon" href="https://i.ibb.co/NNd05gt/money-bag-rupee-color-icon.png" type="image/x-icon" />
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600&display=swap" rel="stylesheet">

  <style>
    html, body {
      margin: 0;
      padding: 0;
      overflow-x: hidden;
      width: 100%;
      background: #f9f9f9;
      font-family: 'Open Sans', sans-serif;
      color: #444;
      text-align: center;
    }

    a {
      color: #ce6c1c;
      text-decoration: none;
    }

    a:hover {
      text-decoration: underline;
    }

    #container {
      max-width: 800px;
      margin: 20px auto;
      background: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    #redirect-link {
      background-image: url(/files/timer.gif);
      background-repeat: no-repeat;
      background-position: center;
      height: 215px;
      position: relative;
      display: inline-block;
    }

    #countdown-border {
      width: 200px;
      height: 200px;
      position: relative;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto;
    }

    #outer-loader {
      position: absolute;
      inset: -5px;
      border-radius: 50%;
      border: 8px solid transparent;
      border-top-color: #2C18B4;
      animation: outer-spin 0.6s linear infinite;
    }

    #inner-loader {
      position: absolute;
      inset: 15px;
      border-radius: 50%;
      border: 7px solid transparent;
      border-bottom-color: #2C18B4;
      animation: inner-spin 0.6s linear infinite;
    }

    @keyframes outer-spin {
      from { transform: rotate(0deg); }
      to { transform: rotate(360deg); }
    }

    @keyframes inner-spin {
      from { transform: rotate(0deg); }
      to { transform: rotate(-360deg); }
    }

    .rtg-button {
      display: inline-block;
      padding: 10px 20px;
      border-radius: 8px;
      font-size: 1rem;
      background-color: #2C18B4;
      color: #fff;
      border: none;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .rtg-button:hover {
      background-color: #5A4DE6;
    }

    .rtg-button:disabled {
      background-color: #aaa;
      cursor: not-allowed;
    }

    @media screen and (max-width: 768px) {
      #redirect-link {
        height: 180px;
      }

      #countdown-border {
        width: 150px;
        height: 150px;
      }

      #8r76tufhgibu7fd8ftrtgnetwork34 {
        font-size: 30px;
      }

      .rtg-button {
        font-size: 0.9rem;
        padding: 8px 16px;
      }
    }
  </style>
</head>

<body>
  <a href="/" target="_self" class="site-logo">
    <img src="<?php echo $code['logo']; ?>" width="300" height="75" alt="Logo" style="margin: 20px;">
  </a>

  <div id="container">
    <center><div><?php echo $wpsaf->ads1; ?></div></center>

    <h1><?php the_title(); ?></h1>

    <div id="redirect-link">
      <div id="countdown-border">
        <div id="outer-loader"></div>
        <div id="inner-loader"></div>
        <h1 id="8r76tufhgibu7fd8ftrtgnetwork34"><?php echo $code['delay']; ?></h1>
      </div>
    </div>

    <p id="txt3" style="display: none;">
      <b>Scroll down & click on <span style="color:#2C18B4;">Continue</span> button for your destination link</b>
    </p>

    <center><div><?php echo $wpsaf->ads2; ?></div></center>

    <hr><?php the_content(); ?>

    <center><div><?php echo $wpsaf->ads3; ?></div></center>

    <div id="button1" style="display: none;">
      <a id="scrollTarget"></a>
      <button class="rtg-button" onclick="rtglink()">Dual Tap "Continue"</button>
    </div>

    <div id="button2" style="display: none;">
      <button class="rtg-button" disabled>Please wait...</button>
    </div>

    <div id="button3" style="display: none;">
      <a href="<?php echo $code['linkr']; ?>" rel="nofollow" style="text-decoration: none;">
        <button class="rtg-button" type="submit">OPEN - CONTINUE</button>
      </a>
    </div>

    <center><div><?php echo $wpsaf->ads4; ?></div></center>
  </div>

  <script>
    var count = <?php echo $code['delay']; ?>;
    var counter = setInterval(timer, 1500);

    function timer() {
      count--;
      if (count <= 0) {
        clearInterval(counter);
        document.getElementById('redirect-link').style.display = 'none';
        document.getElementById('txt3').style.display = 'block';
        document.getElementById('button1').style.display = 'block';

        // Scroll to "Continue" button
        document.getElementById('scrollTarget').scrollIntoView({ behavior: 'smooth' });
        return;
      }
      document.getElementById("8r76tufhgibu7fd8ftrtgnetwork34").innerHTML = count;
    }

    function rtglink() {
      document.getElementById('button1').style.display = 'none';
      document.getElementById('button2').style.display = 'block';

      var count = 5;
      var counter = setInterval(timer, 1500);

      function timer() {
        count--;
        if (count <= 0) {
          document.getElementById('button2').style.display = 'none';
          document.getElementById('button3').style.display = 'block';
          clearInterval(counter);
          return;
        }
      }
    }
  </script>
</body>

</html>
