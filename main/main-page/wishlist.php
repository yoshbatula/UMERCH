<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WISHLIST</title>
    <link rel="stylesheet" href="/css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/wishlist.css">
</head>
<body>
    <?php include 'navigation.php'; ?>
    <div class="d-flex">
        <div class="label-check-form text-center">
            <img src="/assets/images/headerimg.png" alt="">
            <div class="overlay justify-content-center">
                <p>WISHLIST DETAILS</p>
                <h6>HOME / WISHLIST</h6>
            </div>
        </div>
    </div>
    <section class="wishlist">
        <div class="container mt-4">
            <h3>My Wishlist</h3>
                <div class="mt-4">
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>IMAGE</th>
                        <th>PRODUCT</th>
                        <th>UNIT PRICE</th>
                        <th>STOCK</th>
                        <th>ADD ITEM</th>
                        <th>REMOVE</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="ml-5"><img src="/assets/images/esports.jpg" alt="" width="50"></td>
                        <td>CCE JERSEY</td>
                        <td>$130.00</td>
                        <td>In Stock</td>
                        <td>
                            <button class="btn btn-dark text-white" style="width: 130px; height: 30px; font-size: 12px; font-weight: bold;">ADD TO CART</button>
                        </td>
                        <td>
                            <a href="#"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg></a>
                        </td>
                    </tr>
                    <tr>
                        <td class="ml-5"><img src="/assets/images/esports.jpg" alt="" width="50"></td>
                        <td>CCE JERSEY</td>
                        <td>$130.00</td>
                        <td>In Stock</td>
                        <td>
                            <button class="btn btn-dark text-white" style="width: 130px; height: 30px; font-size: 12px; font-weight: bold;">ADD TO CART</button>
                        </td>
                        <td> 
                            <a href="#"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg></a>
                        </td>
                    </tr>
                    <tr>
                        <td class="ml-5"><img src="/assets/images/esports.jpg" alt="no image shown" width="50"></td>
                        <td>CCE JERSEY</td>
                        <td>$130.00</td>
                        <td>In Stock</td>
                        <td>
                            <button class="btn btn-dark text-white" style="width: 130px; height: 30px; font-size: 12px; font-weight: bold;">ADD TO CART</button>
                        </td>
                        <td>
                            <a href="#"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg></a>
                        </td>
                    </tr>
                </tbody>
            </table>
                </div>
        </div>
    </section>
    <?php include 'footer.php'; ?>
</body>
</html>