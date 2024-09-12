<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Online Healthcare System</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">MediCare</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="{{ route('login') }}">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('register') }}">Register</a>
        </li>
      </ul>
    </div>
  </nav>

  <!-- Hero Section -->
  <section class="jumbotron text-center">
    <div class="container">
      <h1 class="display-4">Welcome to MediCare</h1>
      <p class="lead">Get the care you deserve from the comfort of your home</p>
      <a href="#" class="btn btn-primary">Book an Appointment</a>
    </div>
  </section>

  <!-- Services Section -->
  <section class="container">
    <h2 class="text-center mb-4">Our Services</h2>
    <div class="row">
      <div class="col-md-4 mb-4">
        <div class="card">
          <img src="pics\p1.jpg" class="card-img-top" alt="Service 1">
          <div class="card-body">
            <h5 class="card-title">Telemedicine</h5>
            <p class="card-text">Consult with our doctors remotely using video calls</p>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <div class="card">
          <img src="pics\p2.jpg" class="card-img-top" alt="Service 2">
          <div class="card-body">
            <h5 class="card-title">Online Pharmacy</h5>
            <p class="card-text">Order your medications online and get them delivered to your doorstep</p>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <div class="card">
          <img style='width: 300px; height: 230px;' src="pics\p3.png" class="card-img-top" alt="Service 3">
          <div class="card-body">
            <h5 class="card-title">Health Monitoring</h5>
            <p class="card-text">Track your health vitals using our mobile app and wearable devices</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- About Section -->
  <section class="bg-light py-5">
    <div class="container">
      <h2 class="text-center mb-4">About Us</h2>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque feugiat auctor ligula sed malesuada. Duis commodo sapien sit amet pharetra consectetur. Integer tristique ipsum at pulvinar tincidunt. Curabitur accumsan, mi at efficitur fermentum, ex ligula varius nulla, in luctus nulla nibh sed ligula.</p>
    </div>
  </section>

  <!-- Contact Section -->
  <section class="container py-5">
    <h2 class="text-center mb-4">Contact Us</h2>
    <div class="row">
      <div class="col-md-6">
        <form>
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Name">
          </div>
          <div class="form-group">
            <input type="email" class="form-control" placeholder="Email">
          </div>
          <div class="form-group">
            <textarea class="form-control" rows="5" placeholder="Message"></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
      <div class="col-md-6">
        <h5>Contact Information</h5>
        <p>123 Street, City, Country</p>
        <p>Email: info@onlinehealthcare.com</p>
        <p>Phone: +1 234 567890</p>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-light text-center py-3">
    <p>© 2023 Online Healthcare. All rights reserved.</p>
  </footer>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

