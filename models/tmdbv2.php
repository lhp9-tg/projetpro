<?php 

class TMDB {

    private $apiKey;
    private $token = "Authorization: Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJjNWM2ZmJmNDY2N2YwY2M4NzQ3ZmMxMzkzZmI4OTAwMyIsInN1YiI6IjYzZDNlZTQ2Y2I3MWI4MDA4NWRlNzE2MCIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.x1GLvyKm24wi9GP5N6zJENbUs-AoFKNK2jWD_ZhMgl0";


    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function searchMovie(string $movie) : ?object
    {
        $token = $this->token;
        $url = 'https://api.themoviedb.org/3/search/movie?api_key='.$this->apiKey.'&query='.$movie.'&include_adult=false&language=fr-FR';
        // $curl = curl_init($url);
        // curl_setopt_array($curl, [
        //     CURLOPT_HTTPHEADER => array('Content-Type: application/json' , $token ),
        //     CURLOPT_CAINFO => '..\cert\Amazon_Root_CA_1.crt',
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_TIMEOUT => 1
        // ]);
	    // $data = curl_exec($curl);
        $data = file_get_contents($url);
        // if ($data === false || curl_getinfo($curl, CURLINFO_HTTP_CODE) != 200) {
        //     return null;
        // }
        $dir = '..\cache';
        file_put_contents($dir . '/' . $movie . '.json', $data);	
		$data = json_decode($data);
		return $data;
    }

    public function getMovieInfosByMovieId(int $id) : ?object
    {
        $token = $this->token;
        $url = 'https://api.themoviedb.org/3/movie/'.$id.'?api_key='.$this->apiKey.'&language=fr-FR&adult=false';
        // $curl = curl_init($url);
        // curl_setopt_array($curl, [
        //     CURLOPT_HTTPHEADER => array('Content-Type: application/json' , $token ),
        //     CURLOPT_CAINFO => '..\cert\Amazon_Root_CA_1.crt',
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_TIMEOUT => 1
        // ]);
        // $data = curl_exec($curl);
        // if ($data === false || curl_getinfo($curl, CURLINFO_HTTP_CODE) != 200) {
        //     return null;
        // }
        $data = file_get_contents($url);
        $data = json_decode($data);
        return $data;
    }
}

// Authentification (ecrit par chatGPT)
// <?php
// $ch = curl_init();

// // Définir l'URL de la requête
// curl_setopt($ch, CURLOPT_URL, "https://www.example.com");

// // Retourner le transfert en tant que chaîne au lieu de l'afficher directement
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// // Activer la vérification du certificat SSL
// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);

// // Vérifier que le nom commun existe et qu'il correspond au nom d'hôte du serveur
// curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);

// // Définir l'en-tête Authorization
// $authorization = "Authorization: Bearer YOUR_BEARER_TOKEN_HERE";
// curl_setopt($ch, CURLOPT_HTTPHEADER, array($authorization));

// $output = curl_exec($ch);

// if($output === false) {
//     // Une erreur s'est produite, afficher l'erreur
//     echo 'Erreur cURL : ' . curl_error($ch);
// } else {
//     // Pas d'erreur, afficher le résultat
//     echo $output;
// }

// curl_close($ch);
// ?>