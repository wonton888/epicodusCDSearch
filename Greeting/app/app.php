<?php

    require_once __DIR__."/../vendor/autoload.php";

    $app = new Silex\Application();

    $app->get("/", function() {
      return
      "<!DOCTYPE html>
      <html>
      <head>
        <title>Hello friend!</title>
        <link href='https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css' rel='stylesheet'>
      </head>
      <body>
        <div class='container'>
          <h1>Hello from Epicodus!</h1>
          <p>Dear Friend,</p>
          <p>I am currently inside of a building with my new friend Adam learning how to code together </p>
          <p>It's going pretty well. Well sort of..</p>
          <p>Looking forward to seeing you soon.</p>
          <p>Cheers!</p>
          <a href= '/goodbye'>Goodbye!</a>
        </div>
      </body>
      </html>
      ";
    });

    $app->get("/goodbye", function() {
      return "Goodbye friend!!";
    });

    return $app;

?>
