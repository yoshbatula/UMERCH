<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LANDING PAGE</title>
  <link rel="stylesheet" href="/css/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="/css/mainpage.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <!-- INCLUDE NAVIGATION BAR -->
    <?php include 'navigation.php'; ?>
    <div class="hero-section">
        <div class="overlay">
            <small>CASUAL & EVERYDAY</small>
            <h1>Effortlessly combine comfort with campus style!</h1>
            <p>Discover our Casual & Everyday Collection at UMerch, where relaxed designs meet a refined university look.</p>
            <button class="btn btn-dark text-white">VIEW COLLECTION</button>
        </div>
    </div>
    <section>
      <div class="container mt-3">
        <div class="row justify-content-center g-5">
          <div class="col-md-2">
              <img src="/assets/images/brand-1.png" alt="Brand 1" class="img-fluid">
          </div>
          <div class="col-md-2">
              <img src="/assets/images/brand-2.png" alt="Brand 2" class="img-fluid">
          </div>
          <div class="col-md-2">
              <img src="/assets/images/brand-3.png" alt="Brand 3" class="img-fluid">
          </div>
          <div class="col-md-2">
              <img src="/assets/images/brand-4.png" alt="Brand 4" class="img-fluid">
          </div>
          <div class="col-md-2">
              <img src="/assets/images/brand-5.png" alt="Brand 5" class="img-fluid">
          </div>
        </div>
      </div>
    </section>
    <section>
      <div class="container mt-5">
        <div class="row">
          <div class="col-md-4">
            <div class="sale-section">
              <img src="/assets/images/sale.png" alt="" height="400">
              <div class="overlay">
                <h3>20% Off on T-Shirts</h3>
                <small>Get the best deals on your favorite items.</small>
                <button class="btn-featured btn text-white" style="font-size: 12px;" onclick="location.href='shop.php'">SHOP NOW</button>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="sale-section">
              <img src="/assets/images/sale.png" alt="" height="400">
              <div class="overlay">
                <h3>20% Off on T-Shirts</h3>
                <small>Get the best deals on your favorite items.</small>
                <button class="btn-featured btn text-white" style="font-size: 12px;" onclick="location.href='shop.php'">SHOP NOW</button>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="sale-section">
              <img src="/assets/images/sale.png" alt="" height="400">
              <div class="overlay">
                <h3>20% Off on T-Shirts</h3>
                <small>Get the best deals on your favorite items.</small>
                <button class="btn-featured btn text-white" style="font-size: 12px;" onclick="location.href='shop.php'">SHOP NOW</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section style="background-color: #F6F6F6;">
      <div class="d-flex mt-5" style="background-color: #F6F6F6;">
        <div class="container">
          <div class="text-center mt-5 mb-5">
            <h1 style="font-size: 42px;">Featured Products</h1>
            <hr>
          </div>
            <div class="row">
              <div class="col-md-3 mt-5">
                  <div class="card custom-card-height" style="width: 100%;">
                      <img src="/assets/images/esports.jpg" class="card-img-top" alt="..." height="210">
                      <div class="card-body">
                          <h5 class="card-title">UM CCE ESPORTS</h5>
                          <h5 class="card-title">JERSEY</h5>
                          <small class="card-text">Men</small>
                          <div class="d-flex flex-row">
                              <p class="card-text text-decoration-line-through text-danger">$150.00</p>
                              <p class="card-text text-success">&nbsp;&nbsp;$120.00</p>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-md-3 mt-5">
                  <div class="card custom-card-height" style="width: 100%;">
                      <img src="/assets/images/esports.jpg" class="card-img-top" alt="..." height="210">
                      <div class="card-body">
                          <h5 class="card-title">UM CCE ESPORTS</h5>
                          <h5 class="card-title">JERSEY</h5>
                          <small class="card-text">Men</small>
                          <div class="d-flex flex-row">
                              <p class="card-text text-decoration-line-through text-danger">$150.00</p>
                              <p class="card-text text-success">&nbsp;&nbsp;$120.00</p>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-md-3 mt-5">
                  <div class="card custom-card-height" style="width: 100%;">
                      <img src="/assets/images/esports.jpg" class="card-img-top" alt="..." height="210">
                      <div class="card-body">
                          <h5 class="card-title">UM CCE ESPORTS</h5>
                          <h5 class="card-title">JERSEY</h5>
                          <small class="card-text">Men</small>
                          <div class="d-flex flex-row">
                              <p class="card-text text-decoration-line-through text-danger">$150.00</p>
                              <p class="card-text text-success">&nbsp;&nbsp;$120.00</p>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-md-3 mt-5">
                  <div class="card custom-card-height" style="width: 100%;">
                      <img src="/assets/images/esports.jpg" class="card-img-top" alt="..." height="210">
                      <div class="card-body">
                          <h5 class="card-title">UM CCE ESPORTS</h5>
                          <h5 class="card-title">JERSEY</h5>
                          <small class="card-text">Men</small>
                          <div class="d-flex flex-row">
                              <p class="card-text text-decoration-line-through text-danger">$150.00</p>
                              <p class="card-text text-success">&nbsp;&nbsp;$120.00</p>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-md-3 mt-5">
                  <div class="card custom-card-height" style="width: 100%;">
                      <img src="/assets/images/esports.jpg" class="card-img-top" alt="..." height="210">
                      <div class="card-body">
                          <h5 class="card-title">UM CCE ESPORTS</h5>
                          <h5 class="card-title">JERSEY</h5>
                          <small class="card-text">Men</small>
                          <div class="d-flex flex-row">
                              <p class="card-text text-decoration-line-through text-danger">$150.00</p>
                              <p class="card-text text-success">&nbsp;&nbsp;$120.00</p>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-md-3 mt-5">
                  <div class="card custom-card-height" style="width: 100%;">
                      <img src="/assets/images/esports.jpg" class="card-img-top" alt="..." height="210">
                      <div class="card-body">
                          <h5 class="card-title">UM CCE ESPORTS</h5>
                          <h5 class="card-title">JERSEY</h5>
                          <small class="card-text">Men</small>
                          <div class="d-flex flex-row">
                              <p class="card-text text-decoration-line-through text-danger">$150.00</p>
                              <p class="card-text text-success">&nbsp;&nbsp;$120.00</p>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-md-3 mt-5">
                  <div class="card custom-card-height" style="width: 100%;">
                      <img src="/assets/images/esports.jpg" class="card-img-top" alt="..." height="210">
                      <div class="card-body">
                          <h5 class="card-title">UM CCE ESPORTS</h5>
                          <h5 class="card-title">JERSEY</h5>
                          <small class="card-text">Men</small>
                          <div class="d-flex flex-row">
                              <p class="card-text text-decoration-line-through text-danger">$150.00</p>
                              <p class="card-text text-success">&nbsp;&nbsp;$120.00</p>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-md-3 mt-5">
                  <div class="card custom-card-height" style="width: 100%;">
                      <img src="/assets/images/esports.jpg" class="card-img-top" alt="..." height="210">
                      <div class="card-body">
                          <h5 class="card-title">UM CCE ESPORTS</h5>
                          <h5 class="card-title">JERSEY</h5>
                          <small class="card-text">Men</small>
                          <div class="d-flex flex-row">
                              <p class="card-text text-decoration-line-through text-danger">$150.00</p>
                              <p class="card-text text-success">&nbsp;&nbsp;$120.00</p>
                          </div>
                      </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="container mt-5 text-white">
        <div class="limited-time-offer">
          <img src="/assets/images/yeppeo.png" alt="">
            <div class="overlay">
              <h5 class="mb-4">Limited Time Offer</h5>
              <h1 class="mb-4">Special Edition</h1>
              <small>Lorem ipsum dolor sit amet</small>
              <small>consecetur. Purus aenean</small>
              <small class="mb-4">bibendum ipsum ligula sit velit nibh.</small>
              <h5>Buy T-shirt at 20% Discount,</h5>
              <h5 class="mb-4">Use Code OFF20</h5>
              <button class="btn-featured btn text-white" style="font-size: 12px;" onclick="location.href='shop.php'">SHOP NOW</button>
            </div>
        </div>
      </div>
      <div class="d-flex mt-5">
        <div class="container">
          <div class="text-center mb-5 mt-5">
            <h1 style="font-size: 42px;">UM Accessories</h1>
            <hr>
          </div>
          <div class="row">
              <div class="col-md-3 mt-5">
                  <div class="card custom-card-height" style="width: 100%;">
                      <img src="/assets/images/esports.jpg" class="card-img-top" alt="..." height="210">
                      <div class="card-body">
                          <h5 class="card-title">UM Wooden</h5>
                          <h5 class="card-title">Tumber</h5>
                          <div class="d-flex flex-row">
                              <p class="card-text text-decoration-line-through text-danger">$150.00</p>
                              <p class="card-text text-success">&nbsp;&nbsp;$120.00</p>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-md-3 mt-5">
                  <div class="card custom-card-height" style="width: 100%;">
                      <img src="/assets/images/esports.jpg" class="card-img-top" alt="..." height="210">
                      <div class="card-body">
                          <h5 class="card-title">UM CCE ESPORTS</h5>
                          <h5 class="card-title">JERSEY</h5>
                          <small class="card-text">Men</small>
                          <div class="d-flex flex-row">
                              <p class="card-text text-decoration-line-through text-danger">$150.00</p>
                              <p class="card-text text-success">&nbsp;&nbsp;$120.00</p>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-md-3 mt-5">
                  <div class="card custom-card-height" style="width: 100%;">
                      <img src="/assets/images/esports.jpg" class="card-img-top" alt="..." height="210">
                      <div class="card-body">
                          <h5 class="card-title">UM CCE ESPORTS</h5>
                          <h5 class="card-title">JERSEY</h5>
                          <small class="card-text">Men</small>
                          <div class="d-flex flex-row">
                              <p class="card-text text-decoration-line-through text-danger">$150.00</p>
                              <p class="card-text text-success">&nbsp;&nbsp;$120.00</p>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-md-3 mt-5">
                  <div class="card custom-card-height" style="width: 100%;">
                      <img src="/assets/images/esports.jpg" class="card-img-top" alt="..." height="210">
                      <div class="card-body">
                          <h5 class="card-title">UM CCE ESPORTS</h5>
                          <h5 class="card-title">JERSEY</h5>
                          <small class="card-text">Men</small>
                          <div class="d-flex flex-row">
                              <p class="card-text text-decoration-line-through text-danger">$150.00</p>
                              <p class="card-text text-success">&nbsp;&nbsp;$120.00</p>
                          </div>
                      </div>
                  </div>
              </div>
            </div>
        </div>
      </div>  
      <div class="d-flex mt-5">
        <div class="quotes-container">
                <div class="overlay">
                    <div class="d-flex flex-row ml-5">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#FFB600" d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.62L12 2L9.19 8.62L2 9.24l5.45 4.73L5.82 21z"/></svg>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#FFB600" d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.62L12 2L9.19 8.62L2 9.24l5.45 4.73L5.82 21z"/></svg>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#FFB600" d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.62L12 2L9.19 8.62L2 9.24l5.45 4.73L5.82 21z"/></svg>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#FFB600" d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.62L12 2L9.19 8.62L2 9.24l5.45 4.73L5.82 21z"/></svg>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#FFB600" d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.62L12 2L9.19 8.62L2 9.24l5.45 4.73L5.82 21z"/></svg>
                    </div>
                    <p>"I recently purchased a cozy sweater from the Casual & Everyday</p>
                    <p class="mb-2">collection. It is both comfortable and stylish, perfectly capturing the spirit of our campus."</p>
                    <small>MARIA L., UM STUDENT</small>
                </div>
        </div>
      </div>
      <div class="container mt-5">
        <div class="quality-section">
            <div class="row justify-content-between text-center">
                <div class="col-md-3">
                    <img src="/assets/images/quality-1.png" alt="Campus Delivery">
                    <h6>Campus Delivery</h6>
                    <p>Lorem ipsum dolor sit amet.</p>
                    <p>Consecutor. Edget sed sapien</p>
                    <p>Quisque et suspendisse.</p>
                </div>
                <div class="col-md-3">
                    <img src="/assets/images/quality-2.png" alt="Campus Delivery">
                    <h6>Best Quality</h6>
                    <p>Lorem ipsum dolor sit amet.</p>
                    <p>Consecutor. Edget sed sapien</p>
                    <p>Quisque et suspendisse.</p>
                </div>
                <div class="col-md-3">
                    <img src="/assets/images/quality-3.png" alt="Campus Delivery">
                    <h6>Best Offers</h6>
                    <p>Lorem ipsum dolor sit amet.</p>
                    <p>Consecutor. Edget sed sapien</p>
                    <p>Quisque et suspendisse.</p>
                </div>
                <div class="col-md-3">
                    <img src="/assets/images/quality-4.png" alt="Campus Delivery">
                    <h6>Secure Payments</h6>
                    <p>Lorem ipsum dolor sit amet.</p>
                    <p>Consecutor. Edget sed sapien</p>
                    <p>Quisque et suspendisse.</p>
                </div>
            </div>
        </div>
      </div>
    </section>
    <section>
    <div class="d-flex flex-column">
            <div class="explore-container">
                <div class="overlay">
                    <small id="header">Explore</small>
                    <h1 id="header1">Elevate your fashion, embrace</h1>
                    <h1 id="header2">UM Timeless Style!</h1>
                    <small id="text1">Explore our collection today and experience the joy of fashion.</small>
                    <small id="text2">Shop now for the ultimate casual style!</small>
                    <button class="btn-featured btn text-white" style="font-size: 12px;" onclick="location.href='shop.php'">SHOP NOW</button>
                </div>
            </div>
        </div>
    </section>
    <?php include 'footer.php'; ?>
</body>
</html>