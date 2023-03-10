<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Tuto PHP API</title>
</head>
<style>
    .movie {
        display: flex;
        flex-direction: row;
        margin: 20px;
        padding: 20px;
        border: 1px solid black;
        border-radius: 10px;
    }
    .movie img {
        display: block;
        width: 200px;
        height: 300px;
    }
    .movie_info {
        margin-left: 50px;
    }
</style>
<body>
<?php

function cleanString($string) {
	$string = strtolower($string);
	$string = preg_replace("/[^a-z0-9_'\s-]/", "", $string);
	$string = preg_replace("/[\s-]+/", " ", $string);
	$string = preg_replace("/[\s_]/", " ", $string);
	return $string;
}

if(isset($_POST['mot']) && !empty($_POST['mot'])) {
	$motRecherche = urlencode(cleanString($_POST['mot']));

	$dir = 'cache';
	$match = '';

	foreach(glob($dir.'/*.json') as $fichier) {
		if(basename($fichier, '.json') == $motRecherche) {
			$match = $fichier;
		}
	}

	if($match != '' && (time()-filemtime($match) < 60)) {
		$raw = file_get_contents($match);
		$json = json_decode($raw);
	}
    else {
		// $url = "https://api.themoviedb.org/3/movie/" . $motRecherche . "?api_key=c5c6fbf4667f0cc8747fc1393fb89003&language=fr-FR";
        $url = "https://api.themoviedb.org/3/search/movie?api_key=c5c6fbf4667f0cc8747fc1393fb89003&language=fr-FR&query=" . $motRecherche . "&page=1&include_adult=false";
		$raw = file_get_contents($url);
		file_put_contents($dir . '/' . $motRecherche . '.json', $raw);		
		$json = json_decode($raw);
	}

	if(!empty($json->results)) {	
		foreach($json->results as $movies) {
            echo "<div class='movie'>";
            echo "<img src='https://image.tmdb.org/t/p/w500" . $movies->poster_path . "' alt='".$movies->title."'>";
            echo "<div class='movie_info'>";
			echo "<h2>" . $movies->title . "</h2>";
            echo "<p>" . $movies->overview . "</p>";
            echo "<p>" . $movies->release_date . "</p>";
            echo "</div>";
            echo "</div>";
		}
	}
    else {
		echo "Rien n'a ??t?? trouv??.";
	}	

}
else {
	echo "Aucune recherche ??ffectu??e.";
}

?>
</body>
</html>