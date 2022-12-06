<?php
require_once 'config.php';
$movies = $conn->query("SELECT * FROM movies order by Title");
// var_dump($movies);
$movieArray = array();

while ($movie = $movies->fetch_assoc()) {
    array_push($movieArray, $movie);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
    <script src="bootstrap/bootstrap.bundle.min.js"></script>
    <title>Document</title>
</head>
<style>
    .select {
        margin-left: 13%;
    }
</style>

<body>
    <div class="container pt-4">
        <div class="container">
            <div class="col-md-8 m-auto">
                <div class="input-group input-group-lg">
                    <span class="input-group-text ">Search</span>
                    <input type="text" class="form-control" id="search">
                </div>
                <div class="col-md-10.5 select"><select class="form-select" id="select" multiple></select></div>
                <div class="d-flex mt-5">
                    <div class="col-md-4 m-auto text-center">
                        <button class="" id="prev">Prev</button>
                    </div>
                    <div class="col-md-5 m-auto">
                        <div class="card">
                            <div class="card-header m-auto">
                                <img src="" alt="" class="img-fluid" id="img">
                            </div>
                            <div class="card-footer">
                                <p><b>Title:</b> <span id="title"></span></p>
                                <p><b>Genre:</b> <span id="genre"></span></p>
                                <p><b>Director:</b> <span id="director"></span></p>
                                <p><b>Actors:</b> <span id="actors"></span></p>
                                <p><b>Awards:</b> <span id="awards"></span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 m-auto text-center">
                        <button id="next">Next</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="Jquery/jquery-3.6.0.js"></script>
    <script>
        $(document).ready(function() {
            // alert("Please wait...");
            var pointer = 0;
            var movieArr = <?php echo json_encode($movieArray) ?>;
            console.log(movieArr);
            showUI();

            function showUI(pointer = 0) {
                $('#img').attr('src', 'images/' + movieArr[pointer].imdbID + '.jpg');
                $('#title').html(movieArr[pointer].Title);
                $('#genre').html(movieArr[pointer].Genre);
                $('#director').html(movieArr[pointer].Director);
                $('#actors').html(movieArr[pointer].Actors);
                $('#awards').html(movieArr[pointer].Awards);
            }

            $('#next').click(function() {
                pointer++;
                if (pointer > movieArr.length - 1) {
                    pointer = 0;
                }
                showUI(pointer);
            });
            $('#prev').click(function() {
                pointer--;
                if (pointer < 0) {
                    pointer = movieArr.length - 1;
                }
                showUI(pointer);
            })


        })
    </script>
</body>

</html>