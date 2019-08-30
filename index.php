<!DOCTYPE html>
<html>
<head>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<style>
    .red{
        background-color: red;
    }
    .green{
        background-color: green;
    }
    .blue{
        background-color: blue;
    }
    .yellow{
        background-color: yellow;
    }

    .white-text{
        color: white;
    }

    .black-text{
        color: black;
    }

    .card {
        margin: 0 auto; 
        float: none; 
        margin-top: 10px;
        margin-bottom: 10px; 
    }

</style>

</head>
<body>
<div id="mainform">

<div class="innerdiv">
<h2 class="red-text text-center">Showing Colorful Movies</h2>

<div class="row">
<div class="col"> 
<button type="button" class="btn white-text red" value="red" onclick="displayMoviesWithColor(this.value)" >Red</button>
</div>

<div class="col"> 
<button type="button" class="btn white-text green" value="green" onclick="displayMoviesWithColor(this.value)">Green</button>
</div>

<div class="col"> 
<button type="button" class="btn white-text  blue" value="blue" onclick="displayMoviesWithColor(this.value)">Blue</button>
</div>

<div class="col"> 
<button type="button" class="btn black-text yellow" value="yellow" onclick="displayMoviesWithColor(this.value)">Yellow</button>
</div>

</div>
</body>


<div id="searchResult" class="row">
<!-- Place Holder for incoming movie search results -->
</div>




</html>

<script>
/**
 * Function that does Ajax call to the PHP script for movie searching based on color
 * @param the color for querying the remote service of movies with names that contain this particular color
 */
function displayMoviesWithColor(color) {
    var searchString = 'color=' + color;
    if (color == '') {
        alert("No selected Color");
    } else {
        $.ajax({
        type: "POST",
        url: "searchMovies.php",
        data: searchString,
        cache: false,
        dataType: 'text',
        success: function(data) {
            $("#searchResult").empty();
            $( "#searchResult" ).append(decodeHTML(data));
        }
        });
    }
    return false;
}


/**
 * Helper function
 */
 var decodeHTML = function (html) {
	var txt = document.createElement('textarea');
	txt.innerHTML = html;
	return txt.value;
};
</script>