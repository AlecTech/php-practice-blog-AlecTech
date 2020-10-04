<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $GLOBALS['pageTitle']; ?></title>

  <!-- Style(s) -->
  <link rel="stylesheet" type="text/css" href="css/main.css">

  <!-- Script(s) -->
  <script type="text/JavaScript" src="js/scripts.js" defer></script>
</head>
<body>
    <h1><?php echo $GLOBALS['pageTitle']; ?></h1>
 
<?php
if(isset($_POST ['search']))
    $searchq = $_POST['search'];
    $searchq = preg_replace("#[^0-9a-z]#i", "", $searchq);
    $query = $articleArray
?>

    <form method="POST" action="index.php">
        <div id="myDIV" class="header">
            <h2 style="margin:5px">Search Bar</h2>
            <div class="inputFieldBtns">
                <input type="text" id="myInput" name="search" placeholder="look up"  >
                <button type="submit" class="addBtn" name="submit"> search </button>
            </div>
        </div>
    </form>

<?php

  // Require will cause a fatal error if the file is not found.
  // _once means if it has been required already, subsequent requires will not run the file again.
  require_once './includes/articles.Class.php';
  // If an include can't find the file, it results only in a warning (your execution will still continue.)
  

  // An array to store instances of art.
  $arts = [];
//   var_dump( $articles );
    // echo '<pre>';
    // var_dump($articles);
    // echo '</pre>';
  // Let's retrieve our list of articles from the JSON.
  // Also look into... fopen() fread() fwrite()
   $articleFileString = file_get_contents( './article.json' ); // Retrieves the contents of the file as a STRING.
  // If the articles file was found and read...
//   echo '<pre>';
//   var_dump($articleFileString);
//   echo '</pre>';

  if ( $articleFileString )
  { // Convert the JSON to a PHP array or object.
    $articleArray = json_decode( $articleFileString );

    // echo '<pre>';
    // var_dump($articleArray);
    // echo '</pre>';
    // If conversion was successful...
    if ( $articleArray )
    {
      // Let's loop through and make articles objects!
      foreach ( $articleArray as $art )
      {
        // $snacks[] = $value
        // is the same as...
        // array_push( $snacks, $value )
        // $arts[] = new Articles( ...$art );
        $arts[] = new Articles( $art->id, $art->title, $art->content);
      } // Check if our articles array looks good!
      // var_dump( $arts );
    }
  }
?>

<h2>Our Articles</h2>
<?php if ( !empty( $arts ) ) : // If there are articles, output them! ?>
  <?php foreach ( $arts as $art ) $art->output(); ?>
<?php else : // If there are no articles though... ?>
  <p>Sorry, no articles found!</p>
<?php endif; ?>
