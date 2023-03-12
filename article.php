 <?php
   // connect to the database
  // Create database connection
  $servername = "localhost";
  $username = "yourusername";
  $password = "yourpassword";
  $dbname = "yourdatabase";

    $db = new mysqli($servername, $username, $password, $dbname);


            // check connection
            if (!$db) {
                die("Connection failed: " . mysqli_connect_error());
            }
            // Get the current page URL
            $page_url = $_SERVER['REQUEST_URI'];

            // Check if the page URL is already in the database
            $sqlcheck = "SELECT * FROM page_views WHERE page_url = '$page_url'";
            $resultcheck = $db->query($sqlcheck);

            if ($resultcheck->num_rows > 0) {
             // If the page URL is already in the database, update the view count
             // increment the view count
            $sqlupdate = "UPDATE page_views SET view_count = view_count + 1 WHERE page_url='$page_url'";
            mysqli_query($db, $sqlupdate );

            } else {
                // If the page URL is not in the database, insert a new row
                $sqlnew = "INSERT INTO page_views (page_url, view_count) VALUES ('$page_url', 1)";
                $db->query($sqlnew);
            }


            // retrieve the view count
            $sqlretrieve  = "SELECT view_count FROM page_views WHERE page_url='$page_url'";
            $resultretrieve = mysqli_query($db, $sqlretrieve);

                $rowretrieve = mysqli_fetch_assoc($resultretrieve);
                $view_count = $rowretrieve["view_count"];
               echo "This page has been viewed " . $view_count . " times.";


            // close the database connection
            mysqli_close($db);
 ?>
