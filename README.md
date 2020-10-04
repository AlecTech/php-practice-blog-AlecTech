
### This version unpacks JSON as an object not array
```
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
  // Let's retrieve our list of snacks from the JSON.
  // Also look into... fopen() fread() fwrite()
  $articleFileString = file_get_contents( './article.json' ); // Retrieves the contents of the file as a STRING.
  // If the snacks file was found and read...
//   echo '<pre>';
//   var_dump($articleFileString);
//   echo '</pre>';

  if ( $articleFileString )
  { // Convert the JSON to a PHP array or object.
    $articleArray = json_decode( $articleFileString, true );

    // echo '<pre>';
    // var_dump($articleArray);
    // echo '</pre>';
    // If conversion was successful...
    if ( $articleArray )
    {
      // Let's loop through and make Snack objects!
      foreach ( $articleArray as $art )
      {
        // $snacks[] = $value
        // is the same as...
        // array_push( $snacks, $value )
        // $arts[] = new Articles( ...$art );
        array_push ($arts, new Articles( $art['id'], $art['title'], $art['content']));

      } // Check if our Snack array looks good!
      var_dump( $arts );
    }
  }
?>

<h2>Our Articles</h2>
<?php if ( !empty( $arts ) ) : // If there are snacks, output them! ?>
  <?php foreach ( $arts as $art ) $art->output(); ?>
<?php else : // If there are no snacks though... ?>
  <p>Sorry, no snacks found!</p>
<?php endif; ?>
```