<?php
    if ( isset($_GET['id']) && $_GET['id'] < 3 ) { $id = $_GET['id']; }
    else { $id = 0; }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Régis COQUELET">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>patinage artistique saison-2017-2018 classements</title>
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
    <div id='main'>
        <?php
            require 'lib/headerView.php';

            $url = "https://sites.google.com/site/csnpatinage/saison-2017-2018/classements"; // Url des classements
            $liens = new Liens($url);

            $mainPage = headerView($liens,$id); // header

            require_once 'lib/class/class_Clubs.php';
            require_once 'lib/class/class_Competitions.php';
            require_once 'lib/class/class_Competitors.php';
            $clubs = new Clubs;
            $competitions = new Competitions;
            $competitors = new Competitors;

            switch ( $id ) {
                case 0 : // French Ranking
                    require 'lib/functions/rowExtract.php';
                    $page = file_get_contents($liens->url(0)); // Copie la page
                    $regex = '/<tr.*?>(.*?)<\/tr>/';  // Selection des lignes du tableau
                    preg_match_all($regex, $page, $matches);
                    foreach ($matches[1] as $value) { rowExtract($value, $clubs, $competitions, $competitors); }
                    require 'lib/mainView.php';
                    MainView($clubs, $competitions, $competitors);

                    break;
                case 1 :
                    // French Ranking Clubs
                    echo '<p>Page en construction</p>';
                    break;
                case 2 :
                    // Sélectionnables
                    echo '<p>Page en construction</p>';
                    break;
            }
        ?>
    </div>
        <script src="js/getSelectedText.js" type="text/javascript"></script>
    <!-- Script addEventListener -->
        <script src="js/event/eventLinks.js" type="text/javascript"></script>
        <script src="js/event/eventSex.js" type="text/javascript"></script>
        <script src="js/event/eventRegion.js" type="text/javascript"></script>
        <script src="js/event/eventLevel.js" type="text/javascript"></script>
        <script src="js/event/eventCategory.js" type="text/javascript"></script>
        <script src="js/event/eventClub.js" type="text/javascript"></script>
    <!-- Script for hidden -->
        <script src="js/hiddenTab.js" type="text/javascript"></script>
        <script src="js/hiddenRow.js" type="text/javascript"></script>
    <!-- Script submit -->
        <script src="js/event/submit.js" type="text/javascript"></script>
    </body>

</html>


