<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title> <?= $title ?> </title>
    </head>

    <body>
    </body>
</hmtl>
<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<style>
body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
</style>
<body class="w3-light-blue">

<!-- w3-content defines a container for fixed size centered content, 
and is wrapped around the whole page content, except for the footer in this example -->
<div class="w3-content" style="max-width:1400px">

<!-- Header -->
<header class="w3-container w3-center w3-padding-32"> 
  <h1><b><?= $title ?></b></h1>
  <p>Bienvenue sur le blog de <span class="w3-tag">hugo et charly</span></p>
</header>

<!-- Grid -->
<div class="w3-row">

<!-- Blog entries -->
<div class="w3-col l8 s12">
  <!-- Blog entry -->
  <?php
  if (isset($formulaire)) 
  {?>
    <div class="w3-card-4 w3-margin w3-white">
      <div class="w3-container">
        <h3><b><?= $title ?></b></h3>
        <h5><?= $formulaire?></h5>
      </div>
      <div class="w3-container">
      </div>
    </div>
    <hr>
  <?php
  }
  ?>

  <!-- Blog entry -->
  <?php
        if (isset($content)) 
        {?>
          <div class="w3-card-4 w3-margin w3-white">
            <h2><b><?= $title2 ?></b></h2>
              <div class="w3-card-4 w3-margin w3-white">
              <div class="w3-container">
              <h5><?= $content?></h5>
              </div>
              <div class="w3-container">
              <div class="w3-row">
              </div>
              </div>
              </div>
          </div>
          <?php
        }
        ?>
<!-- END BLOG ENTRIES -->
</div>

<!-- Introduction menu -->
<div class="w3-col l4">
  <!-- MENU CONNEXION -->
  <?php
        if (isset($menu)) 
        {
        ?>
          <div class="w3-card w3-margin w3-margin-top">

            <div class="w3-container w3-white">
              <h4><b><?= $menu ?></b></h4>
            </div>
          </div><hr>
          <?php
        }
        ?>
  
<!-- END Introduction Menu -->
</div>

<!-- END GRID -->
</div><br>

<!-- END w3-content -->
</div>
</body>
</html>
