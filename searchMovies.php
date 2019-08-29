<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['color'])) {

    //Building the query api:  
    $apiKey = 'fc55497d';
    $movieSearchWebServiceUrl = "http://www.omdbapi.com/?s={color}&apikey={apiKey}";
    $movieSearchWebServiceUrl = str_replace("{color}", $_POST['color'], $movieSearchWebServiceUrl);
    $movieSearchWebServiceUrl = str_replace("{apiKey}", $apiKey, $movieSearchWebServiceUrl);

    searchMovies($movieSearchWebServiceUrl);

}else{
    echo "Unexpected Error";
}




//Function that accepts the query string to do the restful calls 
function searchMovies($movieSourceUrl){
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $searchParameters);
    curl_setopt($curl, CURLOPT_URL, $movieSourceUrl);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($curl);
    $decodedResult = json_decode($result,true);
    
    $searchResult = $decodedResult['Search'];


    //Simple inbuilt template engine
    $template = "<div class=\"card\" style=\"width: 18rem;\">
    <img class=\"card-img-top\" src=\"{MovieImage}\" alt=\"Card image cap\">
    <div class=\"card-body\">
        <h5 class=\"card-title\">{movieTitle}</h5>
   
      <p class=\"card-text\">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    </div>
  </div>";

    $output = str_replace("{movieTitle}", $searchResult['0']['Title'], $template);
    $output = str_replace("{MovieImage}", $searchResult['0']['Poster'], $output);
    $output = str_replace("{year}", $searchResult['0']['Year'], $output);

    curl_close($curl);

    var_dump($output);

}



?>