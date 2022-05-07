<section class="item-card_section">

    <div class="container mt-4 mb-5">
        <div class="row my-2">

            <?php

                session_start();

                if (!isset($_GET["item_id"]) || !isset($_SESSION["username"])) {

                    header("Location:display_items.php");

                } else {

                    $username =	$_SESSION["username"];
                    $cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
                    $cleardb_server = $cleardb_url["host"];
                    $cleardb_username = $cleardb_url["user"];
                    $cleardb_password = $cleardb_url["pass"];
                    $cleardb_db = substr($cleardb_url["path"],1);
                    $active_group = 'default';
                    $query_builder = TRUE;
                    // Connect to DB
                    $conn = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);	

                    if ($conn->connect_error) {
                        die("Connection failed!".$conn->connect_error);
                    }

                    $statement = "SELECT * FROM item WHERE item_id=?";
                    $iid = $_GET["item_id"];

                    $stmt = $conn->prepare($statement);
                    $stmt->bind_param("s", $iid);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $row = $result->fetch_assoc(); /*select the data of the specific item from the ITEM table*/


                    $iid = $row["item_id"];
                    $iname= $row["item_name"];
                    $i_desc = $row["item_desc"];
                    $iiprice = $row["init_bid"];
                    $end_date = $row["date"];
                    $hours = $row["hours"];
                    $minutes = $row["minutes"];
                    $seconds = $row["seconds"];
                    $bid_num = $row["bid_num"];
                    $icprice = $row["current_bid"];
                    $iimg = "item/";
                    $iimg = $iimg.$row["item_pic"];

                    echo "<div class='col-lg-6 col-md-6 p-0 py-md-5 my-xs-0 my-lg-4 my-md-5'>";
                    echo "<div class='image py-2 my-lg-0 my-md-5'>";
                    echo "<img src='$iimg' class='img-fluid' alt='image'>";
                    echo "</div>";
                    echo "</div>";
                    echo "<div class='col-lg-6 col-md-6 shadow content p-5'>";
                    echo "<div class='row my-3'>";
                    echo "<div class='d-flex justify-content-between'>";
                    echo "<div class='numOfBids'>Number of Bids: <span>$bid_num</span></div>";
                    echo "<div class='price'>Current Bid: $<span>$icprice</span></div>";
                    echo "</div>";
                    echo "</div>";
                    echo "<div class='row my-lg-5 my-md-4'>";
                    echo "<h1>$iname</h1>";
                    echo "<p>$i_desc</p>";
                    echo "</div>";
                    echo "<div class='row my-5'>";
                    echo "<p>Enter Bid</p>";
                    echo "<form action='bid.php' method='POST' role='form' class='form-inline'>";
                    echo "<input type='hidden' value='$iid' name='item_id'/>";	
                    echo "<input type='hidden' value='$username' name='username'>";
                    echo "<div class='row'>";
                    echo "<div class='col-md-6'>";
                    echo "<div class='input-group'>";
                    echo "<select name='bid' class='custom-select' id='inputGroupSelect04'>";
                    echo "<option selected>Choose...</option>";
                    for ($i=0; $i < 10; $i++) {
                        $j = $i*10;
                        echo "<option value='$j'>$$j</option>";
                    }
                    echo "</select>";
                    echo "<div class='input-group-append'>";
                    echo "<button class='btn btn-primary' id='submit_btn' type='submit' value='Bid'>Submit</button>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                    echo "</form>";
                    echo "</div>";
                    echo "<div class='row my-3'>";
                    echo "<h5>End Time:</h5>";
                    echo "<p id='count_down_date'></p>";
                    echo "</div>";
                    echo "</div>";

                    $conn->close();

                }

                
            ?>

        </div>
    </div>

</section>

<script>

    let countDownDate = <?php echo strtotime("$end_date $hours:$minutes:$seconds") ?> * 1000
    let now = <?php echo time() ?> * 1000

    let x = setInterval(function() {

        now = now + 1000

        let distance = countDownDate - now

        let days = Math.floor(distance / (1000 * 60 * 60 * 24))
        let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60))
        let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60))
        let seconds = Math.floor((distance % (1000 * 60)) / 1000)

        document.getElementById('count_down_date').innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s"

        if (distance < 0) {
            clearInterval(x)
            document.getElementById('count_down_date').innerHTML = 'EXPIRED'
            document.querySelector("#submit_btn").disabled = true

            let expiration = <?php ?>

        }

    }, 1000)

</script>


<!-- $time_zone = getTimeZoneFromIpAddress();

                function getTimeZoneFromIpAddress(){
                    $clientsIpAddress = get_client_ip();

                    $clientInformation = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$clientsIpAddress));

                    $clientsLatitude = $clientInformation['geoplugin_latitude'];
                    $clientsLongitude = $clientInformation['geoplugin_longitude'];
                    $clientsCountryCode = $clientInformation['geoplugin_countryCode'];

                    $timeZone = get_nearest_timezone($clientsLatitude, $clientsLongitude, $clientsCountryCode) ;

                    return $timeZone;

                }

                function get_client_ip() {
                    $ipaddress = '';
                    if (getenv('HTTP_CLIENT_IP'))
                        $ipaddress = getenv('HTTP_CLIENT_IP');
                    else if(getenv('HTTP_X_FORWARDED_FOR'))
                        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
                    else if(getenv('HTTP_X_FORWARDED'))
                        $ipaddress = getenv('HTTP_X_FORWARDED');
                    else if(getenv('HTTP_FORWARDED_FOR'))
                        $ipaddress = getenv('HTTP_FORWARDED_FOR');
                    else if(getenv('HTTP_FORWARDED'))
                        $ipaddress = getenv('HTTP_FORWARDED');
                    else if(getenv('REMOTE_ADDR'))
                        $ipaddress = getenv('REMOTE_ADDR');
                    else
                        $ipaddress = 'UNKNOWN';
                    return $ipaddress;
                }

                function get_nearest_timezone($cur_lat, $cur_long, $country_code = '') {
                    $timezone_ids = ($country_code) ? DateTimeZone::listIdentifiers(DateTimeZone::PER_COUNTRY, $country_code)
                        : DateTimeZone::listIdentifiers();

                    if($timezone_ids && is_array($timezone_ids) && isset($timezone_ids[0])) {

                        $time_zone = '';
                        $tz_distance = 0;

                        //only one identifier?
                        if (count($timezone_ids) == 1) {
                            $time_zone = $timezone_ids[0];
                        } else {

                            foreach($timezone_ids as $timezone_id) {
                                $timezone = new DateTimeZone($timezone_id);
                                $location = $timezone->getLocation();
                                $tz_lat   = $location['latitude'];
                                $tz_long  = $location['longitude'];

                                $theta    = $cur_long - $tz_long;
                                $distance = (sin(deg2rad($cur_lat)) * sin(deg2rad($tz_lat)))
                                    + (cos(deg2rad($cur_lat)) * cos(deg2rad($tz_lat)) * cos(deg2rad($theta)));
                                $distance = acos($distance);
                                $distance = abs(rad2deg($distance));
                                // echo '<br />'.$timezone_id.' '.$distance;

                                if (!$time_zone || $tz_distance > $distance) {
                                    $time_zone   = $timezone_id;
                                    $tz_distance = $distance;
                                }

                            }
                        }
                        return  $time_zone;
                    }
                    return 'unknown';
                } -->