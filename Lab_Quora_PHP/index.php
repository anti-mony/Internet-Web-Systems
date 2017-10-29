<?php 
include('session.php');
include('config.php'); 
?> 
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Prashn-Uttar</title>
    <link rel="shortcut icon" type="image/png" href="ic_blur_on_black_48dp.png" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <script src="https://use.fontawesome.com/e934e1e459.js"></script>
    <style>
        #trendBanner {
            margin: 0px;
        }
        
        .card {
            margin: 16px;
        }
        
        footer {
            height: 200px;
            width: 100%;
            background-color: #343a40;
            padding: 16px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" role="navigation">
        <a class="navbar-brand col-md-3 d-flex justify-content-center" href="#">
            <img src="logo.png" alt="Prashn-Uttar" width="240" height="36">
        </a>
        <ul class="navbar-nav col-md-3 d-flex justify-content-center">
            <li class="nav-item active">
                <a class="nav-link" href="#"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fa fa-check" aria-hidden="true"></i> Answer</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="#"><i class="fa fa-bell" aria-hidden="true"></i> Notifications</a>
            </li>
        </ul>
        <form class="navbar-nav form-inline col-md-3">
            <input class="form-control col-md-8" type="text" placeholder="Search" aria-label="Search">&nbsp;&nbsp;&nbsp;
            <button class="btn btn-success " type="submit">Search</button>
        </form>
        <ul class="navbar-nav col-md-3 d-flex justify-content-center">
            <li class="nav-item active">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap"><i class="fa fa-question" aria-hidden="true" data-toggle="modal" data-target="#exampleModal"></i> Ask Question</button>
            </li>&nbsp;&nbsp;&nbsp;&nbsp;
            <li class="nav-item">
                <a class="btn btn-danger" href="logout.php"><i class="fa fa-power-off" aria-hidden="true" ></i> Logout </a>
            </li>
        </ul>

    </nav>
    <?php
    	$trnds['t1'] = "Pollution" ;
    	$trnds['t2'] = "Mumbai" ;
    	$trnds['t3'] = "Donald Trump" ;
    	$trnds['t4'] = "Modi" ;
    	$trnds['t5'] = "GST" ;
    	$trnds['t6'] = "Nucleya" ;
    	$trnds['t7'] = "Ganpati" ;
        $loca = $_GET['loc'];
        if(isset($loca)){
            $sql = "SELECT * FROM trendingtopics Where State = '$loca'";
            $result = mysqli_query($db,$sql);
            $trnds = mysqli_fetch_array($result,MYSQLI_ASSOC);   
        }
        
    ?>
    <section class="jumbotron row" style="padding-top: 80px" id="trendBanner">
        <section class="col-md-4">
            <h1 class="display-3">Trending Topics</h1>
            <p class="lead">Topics based on Geographic Data!</p>
            <hr class="my-4">
            <a class="btn btn-primary" href="#" role="button"><?php echo $trnds['t1'] ?></a>
            <a class="btn btn-primary" href="#" role="button"><?php echo $trnds['t2'] ?></a>
            <a class="btn btn-primary" href="#" role="button"><?php echo $trnds['t3'] ?></a>
            <p></p>
            <a class="btn btn-primary" href="#" role="button"><?php echo $trnds['t4'] ?></a>
            <a class="btn btn-primary" href="#" role="button"><?php echo $trnds['t5'] ?></a>
            <a class="btn btn-primary" href="#" role="button"><?php echo $trnds['t6'] ?></a>
            <a class="btn btn-primary" href="#" role="button"><?php echo $trnds['t7'] ?></a>

        </section>
        <section id="map" class="col-md-8"></section>

    </section>
    <div class="row" style="margin: 8px;">
        <aside class="list-group col-md-2" style="border-right:solid #cfd8dc">
            <a href="#" class="list-group-item list-group-item-action border-0">
                <div class="d-flex w-80 justify-content-between">
                    <strong class="mb-1">Feeds</strong>
                    <small>Edit</small>
                </div>
            </a>
            <a onclick="topStories()" class="list-group-item list-group-item-action border-0"><small>Top Stories</small></a>
            <a href="#" class="list-group-item list-group-item-action border-0"><small>Favorites</small>
            <a class="list-group-item list-group-item-action border-0" onclick="showBM()"><small>Bookmarked Questions</small></a>
            <a href="#" class="list-group-item list-group-item-action border-right-0 border-left-0 "><small>Silicon Valley</small></a>
            <a href="#" class="list-group-item list-group-item-action border-0"><small>Cows</small></a>
            <a href="#" class="list-group-item list-group-item-action border-0"><small>Technology</small></a>
        </aside>
        <section class="col-md-10" id="cards">
        </section>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ask your question!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                     </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="tagss" class="form-control-label">Tags</label>
                            <input type="text" class="form-control" id="tagss">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="form-control-label">Question</label>
                            <textarea class="form-control" id="message-text"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Ask! </button>
                </div>
            </div>
        </div>
    </div>

    <footer class="row mx-0">
        <section class="col-md-4 ">
            <strong class="d-flex justify-content-center" style="color:#FFF;margin: 8px">Get to Know Us</strong>
            <ul style="color:#FFF; padding: 0px">
                <li class="d-flex justify-content-center"><a class="btn" href="">About Us</a></li>
                <li class="d-flex justify-content-center"><a class="btn" href="">Contact Us</a></li>
                <li class="d-flex justify-content-center"><a class="btn" href="">Careers</a></li>

            </ul>
        </section>
        <section class="col-md-4">
            <strong class="d-flex justify-content-center" style="color:#FFF;margin: 8px">Connect with us</strong>
            <ul style="color:#FFF; padding: 0px">
                <li class="d-flex justify-content-center"><a class="btn " href=""><i class="fa fa-facebook" aria-hidden="true"></i> Facebook</a></li>
                <li class="d-flex justify-content-center"><a class="btn " href=""><i class="fa fa-twitter" aria-hidden="true"></i> Twittter</a></li>
                <li class="d-flex justify-content-center"><a class="btn " href=""><i class="fa fa-linkedin" aria-hidden="true"></i> LinkedIn</a></li>

            </ul>
        </section>
        <section class="col-md-4">
            <strong class="d-flex justify-content-center" style="color:#FFF;margin: 8px">Support</strong>
            <ul style="color:#FFF; padding: 0px">
                <li class="d-flex justify-content-center"><a class="btn" href=""><i class="fa fa-envelope" aria-hidden="true"></i> Email</a></li>
                <li class="d-flex justify-content-center"><a class="btn" href=""><i class="fa fa-phone-square" aria-hidden="true"></i> Mobile</a></li>
                <li class="d-flex justify-content-center"><a class="btn" href=""><i class="fa fa-list" aria-hidden="true"></i> Forums</a></li>

            </ul>
        </section>
    </footer>

    <script>
        function initMap() {
            // Create a map object and specify the DOM element for display.
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {
                    lat: 27,
                    lng: 77
                },
                zoom: 6
            });
            var geocoder = new google.maps.Geocoder();
            
            google.maps.event.addListener(map, 'click', function(event) {
              geocoder.geocode({
                'latLng': event.latLng
            }, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                  if (results[0]) {
                    var addr = results[0].formatted_address;
                    var pos = addr.lastIndexOf(",");
                    addr = addr.slice(0,pos);
                    var posl = addr.lastIndexOf(",");
                    addr = addr.slice(posl+1,pos-1);
                    addr = addr.slice(0,-6).trim();
                    console.log(addr);
                    window.location.href = "http://localhost/Internet-Web-Systems/Lab_Quora_PHP/index.php?loc=" + addr;
                  }
            }
        });
          });
            
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBWbSrKPiCcxPVLAq4rovC6wHLN3kdk8uM&callback=initMap" async defer></script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script  src="https://code.jquery.com/jquery-3.2.1.js"  integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
  crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $('#cards').load('dataLoader.php?BMV=0');
        $(function() {
            $("[data-toggle='tooltip']").tooltip();
        });
        $('button').click(function() {
            $('.btn-group').find('label').removeClass('active')
                .end().find('[type="radio"]').prop('checked', false);
        });
        
        var addBMark = function(qID){
            console.log(qID);
            $.post('addBM.php', {'qid': qID});
            console.log("Done!");
        };

        var showBM = function(){
            $('#cards').load('dataLoader.php?BMV=1');
        }

        var topStories = function(){
            $('#cards').load('dataLoader.php?BMV=0');
        } 

    </script>
</body>

</html>