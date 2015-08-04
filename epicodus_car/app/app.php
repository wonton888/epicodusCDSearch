<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/car.php";

    $app = new Silex\Application();

    $app->get("/", function() {
      return "
      <!DOCTYPE html>
      <html>
      <head>
        <link href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css' rel='stylesheet'>
        <title>Adam and Sam's Cardealership</title>
      </head>
      <body>
        <div class='container'>
        <h1>Looking for your Car!</h1>
          <p>Enter the dimensions of your rectangle to see if it's a square.</p>
          <form action='/car_results'>
          <div class='form-group'>
          <label for='miles'>Enter the desire Miles:</label>
          <input id='miles' name='miles' class='form-control' type='number'>
          </div>
          <div class='form-group'>
          <label for='price'>Enter the desire Price:</label>
          <input id='price' name='price' class='form-control' type='number'>
          </div>
          <button type='submit' class='btn-success'>Create</button>
      </form>
    </div>
  </body>
</html>
      ";
    });

  $app->get("/car_results", function() {

    $first_car = new Car("2014 Porsche 911", 114991, 7864, "images/porsche.jpg");
    $second_car = new Car("2011 Ford F450", 55995, 14241, "images/ford.jpg");
    $third_car = new Car("2013 Lexus RX 350", 44700, 20000, "images/lexus.jpg");
    $fourth_car = new Car("Mercedes Benz CLS550", 39900, 37979, "images/mercedes.jpg");
    $cars = array($first_car, $second_car, $third_car, $fourth_car);

    $cars_matching_search = array();
    foreach ($cars as $car) {
        if ($car->getPrice() < $_GET['price']) {
          if($car->getMiles() < $_GET['miles']) {
            array_push($cars_matching_search, $car);
          }
        }
    }

  $output = "";
  foreach ($cars_matching_search as $car) {
      $output = $output . "<div class='row'>
          <div class='col-md-6'>
              <img src=" . $car->getPhoto() . ">
          </div>
          <div class='col-md-6'>
              <p>" . $car->getModel() . "</p>
              <p>By " . $car->getMiles() . "</p>
              <p>$" . $car->getPrice() . "</p>
          </div>
      </div>
      ";
  }
  return $output;
});
    return $app;
?>
