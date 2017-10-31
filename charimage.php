<?php
//THIS PHP ECHOS AN IMAGE ELEMENT FOR A GIVEN CHARACTER AND REALM

ini_set("allow_url_fopen", 1);

//get data from the posted array {name:"character name", realm:"character realm"}
$charName = $_POST['name'];     //$charName = "character name"
$realmName = $_POST['realm'];   //$realmName = "character realm"

//if there are spaces in the realm name find them and replace them with %20
if(strpos($realmName, ' ') !== false){
    $realmName = str_replace(' ', '%20', $realmName);
}

//API urls
$charURL = "https://us.api.battle.net/wow/character/".$realmName."/".$charName."?locale=en_US&apikey=vhamuv4qktrbzp8hrdamtxkkrps4tv96";

//get the response from the Blizzard API and store the result
$charResult = @file_get_contents($charURL);
//if there is no result, or error return no result and exit script
if($charResult === false){
    echo $noResult;
    exit();
}
//JSON parse API responses into readable arrays
$charData = json_decode($charResult, true);

//gather the image data from the JSON array
$charJPG = $charData['thumbnail'];
//find and replace "avatar" with "main"
if(strpos($charJPG, 'avatar') !== false){
    $charJPG = str_replace('avatar', 'main', $charJPG);
}
//return an image element
echo "<img src='https://render-us.worldofwarcraft.com/character/$charJPG' class='imgcol'>";