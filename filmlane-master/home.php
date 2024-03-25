<?php
include("header.php");
?>

<!-- 
        - #UPCOMING
      -->

      <section id="upcoming" class="upcoming">
        <div class="container">

          <div class="flex-wrapper">

            <div class="title-wrapper">
              <p class="section-subtitle">All</p>

              <h2 class="h2 section-title">Movies</h2>
            </div>

            <ul class="filter-list">

              <li>
                <button class="filter-btn">Movies</button>
              </li>

              <li>
                <button class="filter-btn">TV Shows</button>
              </li>

              <li>
                <button class="filter-btn">Anime</button>
              </li>

            </ul>

          </div>

          <ul class="movies-list  has-scrollbar">

          <?php
                    $query = "SELECT * FROM `movies` ORDER BY name";
                    $result = mysqli_query($con, $query);
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
            <li>
              <div class="movie-card">

                <a href="movie-details.php?id=<?php echo $row['id'] ?>">
                  <figure class="card-banner">
                    <img src="<?php echo $row['pictures']; ?>" alt="<?php echo $row['pictures']; ?>">
                  </figure>
                </a>

                <div class="title-wrapper">
                  <a href="movie-details.php?id=<?php echo $row['id'] ?>">
                    <h3 class="card-title"><?php echo $row['name']; ?></h3>
                  </a>

                  <time datetime="2022"><?php echo $row['year']; ?></time>
                </div>

                <div class="card-meta">
                  <div class="badge badge-outline"><?php echo $row['category']; ?></div>

                  <div class="duration">
                    <ion-icon name="time-outline"></ion-icon>

                    <time datetime="PT137M">137 min</time>
                  </div>

                  <div class="rating">
                    <ion-icon name="star"></ion-icon>

                    <data><?php echo $row['rating']; ?></data>
                  </div>
                </div>

              </div>
            </li>
            <?php
                        }
                    } else {
                        echo "<tr><td colspan='5'>Error fetching data</td></tr>";
                    }
                    ?>


                </div>

              </div>
            </li>

          </ul>

        </div>
      </section>

<section class="upcoming" id="theatres">
        <div class="container">

          <div class="flex-wrapper">

            <div class="title-wrapper">
              <p class="section-subtitle">All</p>

              <h2 class="h2 section-title">Theatres</h2>
            </div>

            

          </div>

          <ul class="movies-list  has-scrollbar">

          <?php
                    $query = "SELECT * FROM `theatres` ORDER BY name";
                    $result = mysqli_query($con, $query);
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
            <li>
              <div class="movie-card">

                <a href="">
                  <figure class="card-banner">
                    <img src="<?php echo $row['picture']; ?>" alt="<?php echo $row['picture']; ?>">
                  </figure>
                </a>

                <div class="title-wrapper">
                  <a href="./movie-details.html">
                    <h3 class="card-title"><?php echo $row['name']; ?></h3>
                  </a>
                </div>

                <div class="card-meta">
                  <div class="badge badge-outline"><?php echo $row['location']; ?></div>
                </div>

              </div>
            </li>
            <?php
                        }
                    } else {
                        echo "<tr><td colspan='5'>Error fetching data</td></tr>";
                    }
                    ?>


          </ul>

        </div>
      </section>

      
<?php
include("footer.php");
?>