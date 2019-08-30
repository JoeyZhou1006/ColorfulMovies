<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['color'])) {

    //Building the query api:  
    $apiKey = 'fc55497d';
    $movieSearchWebServiceUrl = "http://www.omdbapi.com/?s={color}&apikey={apiKey}";
    $movieSearchWebServiceUrl = str_replace("{color}", $_POST['color'], $movieSearchWebServiceUrl);
    $movieSearchWebServiceUrl = str_replace("{apiKey}", $apiKey, $movieSearchWebServiceUrl);

    //Fetching the template for building list of movie cards for display
    $templatefile = 'movieCard.tpl';
    $template = file_get_contents($templatefile);

    searchMovies($movieSearchWebServiceUrl, $template);

}else{
    echo "Unexpected Error";
}

/**
 * Function that accepts the query string and template file to do the restful calls for movie searching
 * @param   movieSourceUrl  the web service content provider url for movie searching
 * @param   movieItemTemplate The template file that are used for rendering single movie item card for display
 * @return      array 
 */
function searchMovies($movieSourceUrl, $movieItemTemplate){
    
    //The final output array to be sent out 
    $output = array();
    //Building block of a single movie bootstrap html card
    $singleMovieCard = "";

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $searchParameters);
    curl_setopt($curl, CURLOPT_URL, $movieSourceUrl);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($curl);
    curl_close($curl);

    $decodedResult = json_decode($result,true);
    $searchResult = $decodedResult['Search'];

    //Building the output html for display
    foreach($searchResult as $movieItem){

        $singleMovieCard = str_replace("{movieTitle}", $movieItem['Title'], $movieItemTemplate);
        $singleMovieCard = str_replace("{MovieImage}", $movieItem['Poster'], $singleMovieCard);
        $singleMovieCard = str_replace("{movieYear}", $movieItem['Year'], $singleMovieCard);
        $singleMovieCard = str_replace("{backgroundColor}", $_POST['color'], $singleMovieCard);
        array_push($output, $singleMovieCard);

    }

    echo(htmlentities(implode(" ",$output)));
}

?>