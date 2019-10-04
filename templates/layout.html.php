<?php
require '../database.php';
$categoriesTable = new \CSY2028\DatabaseTable($pdo, 'categories', 'id', 'stdclass', []);
$categories = $categoriesTable->findAll();
$locationsTable = new \CSY2028\DatabaseTable($pdo, 'locations', 'id', 'stdclass', []);
$locations = $locationsTable->findAll();
?>


<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <title><?= $title ?></title>
</head>

<body>
  <header>
  </header>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/">
      <img src="/images/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
      Fotheby's Auction House
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-item nav-link active" href="/home">Home <span class="sr-only">(current)</span></a>
        <a class="nav-item nav-link" href="/catalogue">Catalogue</a>
        <?php
        if (isset($_SESSION['loggedin'])) {
          echo '<a class="nav-item nav-link" href="/logout">Logout</a>';
        } else {
          echo '<a class="nav-item nav-link" href="/login">Login</a>';
        }
        ?>
      </div>
    </div>
    <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#searchCollapse" aria-expanded="false" aria-controls="searchCollapse">
      Advance Search
    </button>
  </nav>
  <div class="collapse" id="searchCollapse">
    <div class="card card-body">
      <form action="/catalogue" method="get" class="p-2">
        <div class="form-group">
          <label for="artist">Artist</label>
          <input type="text" name="artist" class="form-control" id="artist" placeholder="">
        </div>
        <div class="form-group">
          <label for="category">Category</label>
          <select class="form-control" id="category" name="categoryID">
            <option value="all">All</option>
            <?php
            foreach ($categories as $row) {
              if ($row->status !== 'DISABLED') {
                echo '<option value="' . $row->id . '">' . $row->name . '</option>';
              }
            }
            ?>
          </select>
        </div>
        <div class="form-group">
          <label for="minPrice">Min Price</label>
          <input type="text" class="form-control" name="minPrice" id="minPrice" placeholder="">
        </div>
        <div class="form-group">
          <label for="maxPrice">Max Price</label>
          <input type="text" class="form-control" name="maxPrice" id="maxPrice" placeholder="">
        </div>
        Auctions Between
        <div class="form-group">
          <label for="date1">Date 1</label>
          <input type="date" name="date1" id="date1" min="<?= date("Y-m-d"); ?>" max="3000-12-31" class="form-control" />
        </div>
        <div class="form-group">
          <label for="date2">Date 2</label>
          <input type="date" name="date2" id="date2" min="<?= date("Y-m-d"); ?>" max="3000-12-31" class="form-control" />
        </div>
        <div class="form-group">
          <label for="auctionSlot">Auction Slot</label>
          <select class="form-control" id="auctionSlot" name="auctionSlot">
            <option value="all">All</option>
            <option value="Morning">Morning</option>
            <option value="Afternoon">Afternoon</option>
            <option value="Evening">Evening</option>
          </select>
        </div>
        <div class="form-group">
          <label for="subjectClassification">Subject Classification</label>
          <input type="text" class="form-control" name="subjectClassification" id="subjectClassification" placeholder="">
        </div>
        <div class="form-group">
          <label for="artist">Year Produced</label>
          <input type="text" class="form-control" name="yearProduced" id="yearProduced" placeholder="">
        </div>

        <button type="submit" class="btn btn-primary">Search</button>
      </form>
    </div>
  </div>
  </div>
  <main>
    <?= $output ?>
  </main>
</body>

</html>