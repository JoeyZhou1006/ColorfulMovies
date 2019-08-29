<!DOCTYPE html>
<html>
<head>
<title>Submit Form Using AJAX PHP and javascript</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>


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
        margin-bottom: 10px; 
    }

</style>

</head>
<body>
<div id="mainform">

<div class="innerdiv">
<h2 class="red-text text-center">Showing Colorful Movies</h2>

<div class="col-md-3 text-center"> 
<button type="button" class="btn white-text red" value="red" onclick="displayMoviesWithColor(this.value)" >Red</button>
</div>

<div class="col-md-3 text-center"> 
<button type="button" class="btn white-text green" value="green" onclick="displayMoviesWithColor(this.value)">Green</button>
</div>

<div class="col-md-3 text-center"> 
<button type="button" class="btn white-text  blue" value="blue" onclick="displayMoviesWithColor(this.value)">Blue</button>
</div>

<div class="col-md-3 text-center"> 
<button type="button" class="btn black-text yellow" value="yellow" onclick="displayMoviesWithColor(this.value)">Yellow</button>
</div>

</div>
</body>
</html>

<script>


function displayMoviesWithColor(color) {

var searchString = 'color=' + color;
if (color == '') {
    alert("No selected Color");
} else {
// AJAX Post query to call php script for movie searching.
$.ajax({
type: "POST",
url: "searchMovies.php",
data: searchString,
cache: false,
success: function(data) {
    const parsedObj = JSON.parse(data);
    console.log(parsedObj);

}
});
}
return false;
}
</script>