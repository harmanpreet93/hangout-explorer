<?php

require 'connect.php';
    if(!empty($_POST["keyword"])) {
        $string = $_POST['keyword'];

      $query = "SELECT `name` FROM swe_cities WHERE `name` LIKE '{$string}%' LIMIT 0,5";
      $result = mysqli_query($conn,$query);
    if(!empty($result)) {
?>
    <ul id="country-list">
<?php
    foreach($result as $country) {
?>
    <!-- <li onClick="selectCity('<?php echo $country["name"]; ?>'); functio"><?php echo $country["name"]; ?></li> -->
    <!-- <li onClick='sc = function() { $("#search-box").val(<?php echo $country["name"]; ?>);$("#suggesstion-box").hide();}'><?php echo $country["name"]; ?></li> -->
    <li class="cityOptions" value='<?php echo $country["name"]; ?>'><?php echo $country["name"]; ?></li>
<?php 
    } 
?>
    </ul>
<?php 
    } } 
?>