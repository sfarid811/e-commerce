
<!DOCTYPE html>
<?php
session_start();
 ?>
<html lang="en">

<head>

    <!-- Required meta tags -->
	<meta charset="utf-8" />
	<meta name="viewport" content="initial-scale=1"/>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;1,100&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="index.css">
	<meta name="robots" content="follow,index"/>
	<meta name="description" content="Ecommerce e-shop sells furnitures to equip your house and make it confortable for best price. Chairs, armchairs, sofas, tables, shelves, lounges, in vintage, modern and classic styles."/>

    <title>Eshop page</title>
</head>

<body>
    <div class="container" id="conteneur_global">
        <!--NAV BAR-->
        <header class="header">
        <!--icon hamburger-->
        <a href="#" class="nav__icon"><img src="img/hamburger.png" alt="hamburger"> </a>
        <!--logo-->
          <img src="img/Logo.png" class="logo" alt="logo entreprise">
            <nav class="menu">
              <a href="#">HOME</a>
              <a href="#">SHOP</a>
              <a href="#">MAGAZINE</a>
            </nav>
      <!-- div pour panier+login -->

        	<div class="pictos">

          		<a class="panier" href="#"><img src="img/Cart_Button.png" width="17" height="17" alt="panier"></a>

              <?php
              if (isset($_COOKIE['eshop']))
              {
              ?>
              <a class="connexion" href = "logout.php" title="Logout">LOGOUT.</a>
              <?php
              }
              else
              {
              ?>
              <a class="connexion" href = "signin.php" title="Login">LOGIN.</a>
              <?php
              }
              ?>

        	</div>
      	</header>

      <!--SEARCH BAR-->

      	<div class="row search_best ">
			<div class="col-lg-1 col-sm-1 loupe_parent">
				<img src="img/Search.png"  alt="loupe">
			</div>
			<div class="col-lg-8 col-sm-11 search_parent">
			<!-- Search form -->
			<div class="search_bar">
				<input class="form-control" type="text" placeholder="living room" aria-label="Search">
				<img src="img/Sajari_Logo.png" alt="logo Sajari">
			</div>
			</div>
		<!---Best match-->
			<div class="col-lg-3 col-sm-12">
				<div class="selector_sarah">
					<select>
					<option value="">Best match</option>
					</select>
				</div>
			</div>
		</div>
        <!--CONTENT-->

        <div class="row content_div">
            <!--UNE SEULE DIV POUR LE CONTENT-->

            <div class="col-lg-3 col-sm-12 filter_div">
				<div id="checkbox_div">
					<input type ="checkbox" id="filter">
					<label for="filter" id="label_filter">Filters</label>

					<div>
						<p>FILTER BY</p>
					</div>
					<div class="selector">
					<select>
						<option value="">Collection</option>
					</select>
					</div>
					<div class="selector">
					<select>
						<option value="">Color</option>
					</select>
					</div>
					<div class="selector">
					<select>
						<option value="">Category</option>
					</select>
					</div>
					<div class="slider" id="first_silder">
					<label for="Min_price">Min price</label>
					<input type="range" min="0" max="10000" value="1" id="Min_price">
					<div>
						<label for=Min_price>0$</label>
						<label for=Min_price>10,000$+</label>
					</div>
					</div>
					<div class="slider">
					<label for="Max_price">Max price</label>
					<input type="range" min="0" max="10000" value="1" id="Max_price">
					<div>
						<label for=Max_price>0$</label>
						<label for=Max_price>10,000$+</label>
					</div>
					</div>
				</div>
			</div>

            <!-- INFOCARDS -->

<!-- CARD 1 -->

            <div class="col-sm-12 col-lg-3  card_content w-100">
						<img class="card-img-top" src="img/img1.png" alt="lounge atmosphere in the living room..."> <!-- Image au dessus de card prend largeur max -->

					<div class="card">
						<div class="card-body card_product">

							<div class="cont_1"> <!-- 1ere ligne sous l'image: Collection et Price-->

								<div class="Collection">
									<p class="card-text justify-left">Coombes</p>
								</div>

								<div class="Price">
									<p class="card-text d-inline-block" >$2,600</p>
								</div>
							</div>
				<!-- 2e ligne -->
							<div class="cont_2">
					<!--contient 2 colonnes -->
											<!-- colonne 1 (2 lignes) -->
								<div class="col-9">

												<!-- 1ere ligne -->
									<div class="row Category" >
										<p class="card-text d-inline-block">LOUNGE</p>
									</div>
												<!-- 2e ligne -->

									<div class="row stars">
										<div class="w-25 h-25 d-flex flex-col col_stars">
										<img src="img/Star_On.png" alt="1 star" class="card-img-top star_On">
										<img src="img/Star_On.png" alt="1 star" class="card-img-top star_On">
										<img src="img/Star_On.png" alt="1 star" class="card-img-top star_On">
										<img src="img/Star_On.png" alt="1 star" class="card-img-top star_On">
										<img src="img/Star.png" alt="0 stars" class="card-img-top star_Off">
										</div>
									</div>
								</div>
											<!-- colonne 2 (pas de lignes) -->
								<div class="col-3 caddie">
										<a class="button btn_panier" href="panier">
										<img src="img/caddie_add.png" alt="logo caddie">
										</a>
								</div>
							</div>
						</div>
					</div>
			</div>

<!-- CARD 2 -->

            <div class="col-sm-12 col-lg-3  card_content w-100">
						<img class="card-img-top" src="img/img2.png" alt="table and whites chairs."> <!-- Image au dessus de card prend largeur max -->

					<div class="card">
						<div class="card-body card_product">

							<div class="cont_1"> <!-- 1ere ligne sous l'image: Collection et Price-->

								<div class="Collection">
									<p class="card-text justify-left">Keeve Set</p>
								</div>

								<div class="Price">
									<p class="card-text d-inline-block" >$590</p>
								</div>
							</div>
				<!-- 2e ligne -->
							<div class="cont_2">
					<!-- contient 2 colonnes -->
											<!-- colonne 1 (2 lignes) -->
								<div class="col-9">

												<!-- 1ere ligne -->
									<div class="row Category" >
										<p class="card-text d-inline-block">TABLE & CHAIRS</p>
									</div>
												<!-- 2e ligne -->

									<div class="row stars">
										<div class="w-25 h-25 d-flex flex-col col_stars">
										<img src="img/Star_On.png" alt="1 star" class="card-img-top star_On">
										<img src="img/Star_On.png" alt="1 star" class="card-img-top star_On">
										<img src="img/Star_On.png" alt="1 star" class="card-img-top star_On">
										<img src="img/Star_On.png" alt="1 star" class="card-img-top star_On">
										<img src="img/Star.png" alt="0 stars" class="card-img-top star_Off">
										</div>
									</div>
								</div>
											<!-- colonne 2 (pas de lignes) -->
								<div class="col-3 caddie">
									<a class="button btn_panier" href="#">
										<img src="img/caddie_add.png" alt="logo caddie">
									</a>
								</div>
							</div>
						</div>
					</div>
			</div>

<!-- CARD 3 -->

	        <div class="col-sm-12 col-lg-3  card_content w-100">
						<img class="card-img-top" src="img/img3.png" alt="armchairs in a garden."> <!-- Image au dessus de card prend largeur max -->

					<div class="card">
						<div class="card-body card_product">

							<div class="cont_1"> <!-- 1ere ligne sous l'image: Collection et Price-->

								<div class="Collection">
									<p class="card-text justify-left">Nillè</p>
								</div>

								<div class="Price">
									<p class="card-text d-inline-block" >$950</p>
								</div>
							</div>
				<!-- 2e ligne -->
							<div class="cont_2">
					<!-- contient 2 colonnes -->
											<!-- colonne 1 (2 lignes) -->
								<div class="col-9">

												<!-- 1ere ligne -->
									<div class="row Category" >
										<p class="card-text d-inline-block">ARMCHAIR</p>
									</div>
												<!-- 2e ligne -->

									<div class="row stars">
										<div class="w-25 h-25 d-flex flex-col col_stars">
										<img src="img/Star_On.png" alt="1 star" class="card-img-top star_On">
										<img src="img/Star_On.png" alt="1 star" class="card-img-top star_On">
										<img src="img/Star_On.png" alt="1 star" class="card-img-top star_On">
										<img src="img/Star_On.png" alt="1 star" class="card-img-top star_On">
										<img src="img/Star_On.png" alt="1 star" class="card-img-top star_On">
										</div>
									</div>
								</div>
											<!-- colonne 2 (pas de lignes) -->
								<div class="col-3 caddie">
									<a class="button btn_panier" href="#">
										<img src="img/caddie_add.png" alt="logo caddie">
									</a>
								</div>
							</div>
						</div>
					</div>
			</div>

<!-- CARD 4 -->

	        <div class="col-sm-12 col-lg-3  card_content w-100">
						<img class="card-img-top" src="img/img4.png" alt="Blanko side table."> <!-- Image au dessus de card prend largeur max -->

					<div class="card">
						<div class="card-body card_product">

							<div class="cont_1"> <!-- 1ere ligne sous l'image: Collection et Price-->

								<div class="Collection">
									<p class="card-text justify-left">Blanko</p>
								</div>

								<div class="Price">
									<p class="card-text d-inline-block" >$90</p>
								</div>
							</div>
				<!-- 2e ligne -->
							<div class="cont_2">
					<!-- contient 2 colonnes -->
											<!-- colonne 1 (2 lignes) -->
								<div class="col-9">

												<!-- 1ere ligne -->
									<div class="row Category" >
										<p class="card-text d-inline-block">SIDE TABLE</p>
									</div>
												<!-- 2e ligne -->

									<div class="row stars">
										<div class="w-25 h-25 d-flex flex-col col_stars">
										<img src="img/Star_On.png" alt="1 star" class="card-img-top star_On">
										<img src="img/Star_On.png" alt="1 star" class="card-img-top star_On">
										<img src="img/Star_On.png" alt="1 star" class="card-img-top star_On">
										<img src="img/Star_On.png" alt="1 star" class="card-img-top star_On">
										<img src="img/Star.png" alt="0 stars" class="card-img-top star_Off">
										</div>
									</div>
								</div>
											<!-- colonne 2 (pas de lignes) -->
								<div class="col-3 caddie">
									<a class="button btn_panier" href="#">
										<img src="img/caddie_add.png" alt="logo caddie">
									</a>
								</div>
							</div>
						</div>
					</div>
			</div>

<!-- CARD 5 -->

	        <div class="col-sm-12 col-lg-3  card_content w-100">
						<img class="card-img-top" src="img/img5.png" alt="shelve with books."> <!-- Image au dessus de card prend largeur max -->

					<div class="card">
						<div class="card-body card_product">

							<div class="cont_1"> <!-- 1ere ligne sous l'image: Collection et Price-->

								<div class="Collection">
									<p class="card-text justify-left">Momo</p>
								</div>

								<div class="Price">
									<p class="card-text d-inline-block" >$890</p>
								</div>
							</div>
				<!-- 2e ligne -->
							<div class="cont_2">
					<!-- contient 2 colonnes -->
											<!-- colonne 1 (2 lignes) -->
								<div class="col-9">

												<!-- 1ere ligne -->
									<div class="row Category" >
										<p class="card-text d-inline-block">SHELVES</p>
									</div>
												<!-- 2e ligne -->

									<div class="row stars">
										<div class="w-25 h-25 d-flex flex-col col_stars">
										<img src="img/Star_On.png" alt="1 star" class="card-img-top star_On">
										<img src="img/Star_On.png" alt="1 star" class="card-img-top star_On">
										<img src="img/Star_On.png" alt="1 star" class="card-img-top star_On">
										<img src="img/Star_On.png" alt="1 star" class="card-img-top star_On">
										<img src="img/Star.png" alt="0 stars" class="card-img-top star_Off">
										</div>
									</div>
								</div>
											<!-- colonne 2 (pas de lignes) -->
								<div class="col-3 caddie">
									<a class="button btn_panier" href="#">
										<img src="img/caddie_add.png" alt="logo caddie">
									</a>
								</div>
							</div>
						</div>
					</div>
			</div>



<!-- CARD 6 -->

	        <div class="col-sm-12 col-lg-3  card_content w-100">
						<img class="card-img-top" src="img/img6.png" alt="modern white chair."> <!-- Image au dessus de card prend largeur max -->

					<div class="card">
						<div class="card-body card_product">

							<div class="cont_1"> <!-- 1ere ligne sous l'image: Collection et Price-->

								<div class="Collection">
									<p class="card-text justify-left">Penemillè</p>
								</div>

								<div class="Price">
									<p class="card-text d-inline-block" >$120</p>
								</div>
							</div>
				<!-- 2e ligne -->
							<div class="cont_2">
					<!-- contient 2 colonnes -->
											<!-- colonne 1 (2 lignes) -->
								<div class="col-9">

												<!-- 1ere ligne -->
									<div class="row Category" >
										<p class="card-text d-inline-block">CHAIR</p>
									</div>
												<!-- 2e ligne -->

									<div class="row stars">
										<div class="w-25 h-25 d-flex flex-col col_stars">
										<img src="img/Star_On.png" alt="1 star" class="card-img-top star_On">
										<img src="img/Star_On.png" alt="1 star" class="card-img-top star_On">
										<img src="img/Star_On.png" alt="1 star" class="card-img-top star_On">
										<img src="img/Star_On.png" alt="1 star" class="card-img-top star_On">
										<img src="img/Star.png" alt="0 stars" class="card-img-top star_Off">
										</div>
									</div>
								</div>
											<!-- colonne 2 (pas de lignes) -->
								<div class="col-3 caddie">
									<a class="button btn_panier" href="#">
										<img src="img/caddie_add.png" alt="logo caddie">
									</a>
								</div>
							</div>
						</div>
					</div>
			</div>

<!-- CARD 7 -->
	        <div class="col-sm-12 col-lg-3  card_content w-100">
						<img class="card-img-top" src="img/img7.png" alt="vintage shelve."> <!-- Image au dessus de card prend largeur max -->

					<div class="card">
						<div class="card-body card_product">

							<div class="cont_1"> <!-- 1ere ligne sous l'image: Collection et Price-->

								<div class="Collection">
									<p class="card-text justify-left">Kappu</p>
								</div>

								<div class="Price">
									<p class="card-text d-inline-block" >$420</p>
								</div>
							</div>
				<!-- 2e ligne -->
							<div class="cont_2">
					<!-- contient 2 colonnes -->
											<!-- colonne 1 (2 lignes) -->
								<div class="col-9">

												<!-- 1ere ligne -->
									<div class="row Category" >
										<p class="card-text d-inline-block">SHELVES</p>
									</div>
												<!-- 2e ligne -->

									<div class="row stars">
										<div class="w-25 h-25 d-flex flex-col col_stars">
										<img src="img/Star_On.png" alt="1 star" class="card-img-top star_On">
										<img src="img/Star_On.png" alt="1 star" class="card-img-top star_On">
										<img src="img/Star_On.png" alt="1 star" class="card-img-top star_On">
										<img src="img/Star_On.png" alt="1 star" class="card-img-top star_On">
										<img src="img/Star.png" alt="0 stars" class="card-img-top star_Off">
										</div>
									</div>
								</div>
											<!-- colonne 2 (pas de lignes) -->
								<div class="col-3 caddie">
									<a class="button btn_panier" href="#">
										<img src="img/caddie_add.png" alt="logo caddie">
									</a>
								</div>
							</div>
						</div>
					</div>
			</div>
<!-- ..................................... et jusqu'à là dans votre code................ -->

        <!--FOOTER-->

        </div>
		<footer>
			<div class="div_footer"><!--Mettre dans une div pour rendre le footer flexible-->
			  <div class="numbers" id="current_page">
				<a href="#">
				  <p>1</p>
				</a>
			  </div>
			  <div class="numbers">
				<a href="#">
				  <p>2</p>
				</a>
			  </div>
			  <div class="numbers">
				<a href="#">
				  <p>3</p>
				</a>
			  </div>
			  <div class="numbers">
				<a href="#">
				  <p>4</p>
				</a>
			  </div>
			  <div class="numbers">
				<a href="#">
				  <p>5</p>
				</a>
			  </div>
			  <div class="numbers">
				<a href="#">
				  <p>6</p>
				</a>
			  </div>
			  <div class="numbers">
				<a href="#">
				  <p>7</p>
				</a>
			  </div><div class="numbers">
				<a href="#">
				  <p>8</p>
				</a>
			  </div>
			  <div class="numbers">
				<a href="#">
				  <p>9</p>
				</a>
			  </div>
			  <div class="numbers">
				<a href="#">
				  <p>10</p>
				</a>
			  </div>
			  <div class="numbers">
				<a href="#">
				  <p>></p>
				</a>
			  </div>
			</div>
		</footer>

    </div>
</body>

</html>
