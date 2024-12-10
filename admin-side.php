<?php

?>

<!-- Coding by CodingLab | www.codinglabweb.com -->
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!----======== CSS ======== -->
    <link rel="stylesheet" href="customer-sidebar.css">

    <!----===== Boxicons CSS ===== -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    
    <title>Dashboard Sidebar Menu</title> 
</head>
<body>
    <nav class="sidebar close">
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="logo.png" alt="">
                </span>

                <div class="text logo-text">
                    <span class="name">Codinglab</span>
                    <span class="profession">Web developer</span>
                </div>
            </div>

            <i class='bx bx-chevron-right toggle'></i>
        </header>

        <div class="menu-bar"> 
            <div class="menu">

                <li class="search-box">
                    
                    <input type="text" placeholder="Search...">
                </li>

                <ul class="menu-links">
                    <li class="nav-link">
                        <a href="#">
                            <i class='bx bx-home-alt icon' ></i>
                            <span class="text nav-text">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="#">
                            <i class='bx bx-bar-chart-alt-2 icon' ></i>
                            <span class="text nav-text">Revenue</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="#">
                            <i class='bx bx-bell icon'></i>
                            <span class="text nav-text">Notifications</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="#">
                            <i class='bx bx-pie-chart-alt icon' ></i>
                            <span class="text nav-text">Analytics</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="#">
                            <i class='bx bx-heart icon' ></i>
                            <span class="text nav-text">Likes</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="#">
                            <i class='bx bx-wallet icon' ></i>
                            <span class="text nav-text">Wallets</span>
                        </a>
                    </li>

                </ul>
</div>

            <div class="bottom-content">
                <li class="">
                    <a href="#">
                        <i class='bx bx-log-out icon' ></i>
                        <span class="text nav-text">Logout</span>
                    </a>
                </li>

                <li class="mode">
                    <div class="sun-moon">
                        <i class='bx bx-moon icon moon'></i>
                        <i class='bx bx-sun icon sun'></i>
                    </div>
                    <span class="mode-text text">Dark mode</span>

                    <div class="toggle-switch">
                        <span class="switch"></span>
                    </div>
                </li>
                
            </div>
        </div>

    </nav>

    <section class="home">
      <nav>
            <div class="dashboard">
              
              <span class="dashboard">Dashboard</span>
            </div>
            <div class="search-box">
              <input type="text" placeholder="Search..." />
              <i class="bx bx-search"></i>
            </div>
            <div class="profile-details">
              <img src="images/profile.jpg" alt="" />
              <span class="admin_name">Prem Shahi</span>
              <i class="bx bx-chevron-down"></i>
            </div>
          </nav>

        
      <div class="home-content">
        <div class="overview-boxes">
          <div class="box">
            <div class="right-side">
              <div class="box-topic">Savings Account</div>
              <div class="number">40,876</div>
              <div class="indicator">
                <i class="bx bx-up-arrow-alt"></i>
                <span class="text">Up from yesterday</span>
              </div>
            </div>
            <i class="bx bx-cart-alt cart"></i>
          </div>
          <div class="box">
            <div class="right-side">
              <div class="box-topic">Checking Account</div>
              <div class="number">38,876</div>
              <div class="indicator">
                <i class="bx bx-up-arrow-alt"></i>
                <span class="text">Up from yesterday</span>
              </div>
            </div>
            <i class="bx bxs-cart-add cart two"></i>
          </div>
          <div class="box">
            <div class="right-side">
              <div class="box-topic">Loan/Credit Cards</div>
              <div class="number">$12,876</div>
              <div class="indicator">
                <i class="bx bx-up-arrow-alt"></i>
                <span class="text">Up from yesterday</span>
              </div>
            </div>
            <i class="bx bx-cart cart three"></i>
          </div>
          <div class="box">
            <div class="right-side">
              <div class="box-topic">Total Investors</div>
              <div class="number">11,086</div>
              <div class="indicator">
                <i class="bx bx-down-arrow-alt down"></i>
                <span class="text">Down From Today</span>
              </div>
            </div>
            <i class="bx bxs-cart-download cart four"></i>
          </div>
        </div>

        <div class="sales-boxes">
          <div class="recent-sales box">
            <div class="title">Top 10 Investors</div>
            <div class="sales-details">
              <ul class="details">
                <li class="topic">Date</li>
                <li><a href="#">02 Jan 2021</a></li>
                <li><a href="#">02 Jan 2021</a></li>
                <li><a href="#">02 Jan 2021</a></li>
                <li><a href="#">02 Jan 2021</a></li>
                <li><a href="#">02 Jan 2021</a></li>
                <li><a href="#">02 Jan 2021</a></li>
                <li><a href="#">02 Jan 2021</a></li>
              </ul>
              <ul class="details">
                <li class="topic">Customer</li>
                <li><a href="#">Alex Doe</a></li>
                <li><a href="#">David Mart</a></li>
                <li><a href="#">Roe Parter</a></li>
                <li><a href="#">Diana Penty</a></li>
                <li><a href="#">Martin Paw</a></li>
                <li><a href="#">Doe Alex</a></li>
                <li><a href="#">Aiana Lexa</a></li>
                <li><a href="#">Rexel Mags</a></li>
                <li><a href="#">Tiana Loths</a></li>
              </ul>
              <ul class="details">
                <li class="topic">Sales</li>
                <li><a href="#">Delivered</a></li>
                <li><a href="#">Pending</a></li>
                <li><a href="#">Returned</a></li>
                <li><a href="#">Delivered</a></li>
                <li><a href="#">Pending</a></li>
                <li><a href="#">Returned</a></li>
                <li><a href="#">Delivered</a></li>
                <li><a href="#">Pending</a></li>
                <li><a href="#">Delivered</a></li>
              </ul>
              <ul class="details">
                <li class="topic">Total</li>
                <li><a href="#">$204.98</a></li>
                <li><a href="#">$24.55</a></li>
                <li><a href="#">$25.88</a></li>
                <li><a href="#">$170.66</a></li>
                <li><a href="#">$56.56</a></li>
                <li><a href="#">$44.95</a></li>
                <li><a href="#">$67.33</a></li>
                <li><a href="#">$23.53</a></li>
                <li><a href="#">$46.52</a></li>
              </ul>
            </div>
            <div class="button">
              <a href="#">See All</a>
            </div>
          </div>
          <div class="top-sales box">
            <div class="title">Rewards</div>
            <ul class="top-sales-details">
              <li>
                <a href="#">
                  <img src="images/sunglasses.jpg" alt="" />
                  <span class="product">Vuitton Sunglasses</span>
                </a>
                <span class="price">$1107</span>
              </li>
              <li>
                <a href="#">
                  <img src="images/jeans.jpg" alt="" />
                  <span class="product">Hourglass Jeans </span>
                </a>
                <span class="price">$1567</span>
              </li>
              <li>
                <a href="#">
                  <img src="images/nike-min.jpg" alt="" />
                  <span class="product">Nike Sport Shoe</span>
                </a>
                <span class="price">$1234</span>
              </li>
              <li>
                <a href="#">
                  <img src="images/scarves.jpg" alt="" />
                  <span class="product">Hermes Silk Scarves.</span>
                </a>
                <span class="price">$2312</span>
              </li>
              <li>
                <a href="#">
                  <img src="images/blueBag.jpg" alt="" />
                  <span class="product">Succi Ladies Bag</span>
                </a>
                <span class="price">$1456</span>
              </li>
              <li>
                <a href="#">
                  <img src="images/bag.jpg" alt="" />
                  <span class="product">Gucci Womens's Bags</span>
                </a>
                <span class="price">$2345</span>
              </li>

              <li>
                <a href="#">
                  <img src="images/addidas.jpg" alt="" />
                  <span class="product">Addidas Running Shoe</span>
                </a>
                <span class="price">$2345</span>
              </li>
              <li>
                <a href="#">
                  <img src="images/shirt.jpg" alt="" />
                  <span class="product">Bilack Wear's Shirt</span>
                </a>
                <span class="price">$1245</span>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section>
        
    </section>


    <script src="customer-sidebar.js"></script>

</body>
</html>