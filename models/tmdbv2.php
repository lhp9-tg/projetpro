<?php 

class TMDB {

    private $apiKey;

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function searchMovie(string $movie) : ?object
    {
        $token = "Authorization: Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJjNWM2ZmJmNDY2N2YwY2M4NzQ3ZmMxMzkzZmI4OTAwMyIsInN1YiI6IjYzZDNlZTQ2Y2I3MWI4MDA4NWRlNzE2MCIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.x1GLvyKm24wi9GP5N6zJENbUs-AoFKNK2jWD_ZhMgl0";
        $url = "https://api.themoviedb.org/3/search/movie?api_key={$this->apiKey}&query={$movie}&language=fr-FR";
        $curl = curl_init($url);
        curl_setopt_array($curl, [
            CURLOPT_HTTPHEADER => array('Content-Type: application/json' , $token ),
            CURLOPT_CAINFO => 'C:\Users\thoma\OneDrive\Code\Mes projets\Projet Pro\cert\Amazon_Root_CA_1.crt',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 1
        ]);
	    $data = curl_exec($curl);
        if ($data === false || curl_getinfo($curl, CURLINFO_HTTP_CODE) != 200) {
            return null;
        }
        $dir = 'C:\Users\thoma\OneDrive\Code\Mes projets\Projet Pro\cache';
        file_put_contents($dir . '/' . $movie . '.json', $data);	
		$data = json_decode($data);
		return $data;
    }
	

}