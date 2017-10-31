<?php
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
$squatURL = "https://us.api.battle.net/wow/character/wyrmrest%20accord/Squatticus?locale=en_US&apikey=vhamuv4qktrbzp8hrdamtxkkrps4tv96";
$raceURL = "https://us.api.battle.net/wow/data/character/races?locale=en_US&apikey=vhamuv4qktrbzp8hrdamtxkkrps4tv96";
$classURL = "https://us.api.battle.net/wow/data/character/classes?locale=en_US&apikey=vhamuv4qktrbzp8hrdamtxkkrps4tv96";

//gather API responses
$noResult = "<p>Character not found!</p>";

//get the response from the Blizzard API and store the result
$charResult = @file_get_contents($charURL);
//if there is no result, or error return no result and exit script
if($charResult === false){
    echo $noResult;
    exit();
}
//get response from static url's and store them
$squatResult = file_get_contents($squatURL);
$raceResult = file_get_contents($raceURL);
$classResult = file_get_contents($classURL);

//JSON parse API responses into readable arrays
$charData = json_decode($charResult, true);
$squatData = json_decode($squatResult, true);
$raceData = json_decode($raceResult, true);
$classData = json_decode($classResult, true);

//number of similar attributes
$numSimilar = 0;

//if the names are the same
if($charData['name'] != $squatData['name']){
    echo"<p><b>Name: </b>".$charData['name']."<img src='http://www.iconsdb.com/icons/preview/soylent-red/x-mark-xxl.png' class='icon'></p>";
}
else{
    $numSimilar ++;
    echo"<p><b>Name: </b>".$charData['name']."<img src='http://www.iconsdb.com/icons/preview/green/checkmark-xxl.png' class='icon'></p>";
}

//if the realm is the same
if($charData['realm'] != $squatData['realm']){
    echo"<p><b>Realm: </b>".$charData['realm']."<img src='http://www.iconsdb.com/icons/preview/soylent-red/x-mark-xxl.png' class='icon'></p>";
}
else{
    $numSimilar ++;
    echo"<p><b>Realm: </b>".$charData['realm']."<img src='http://www.iconsdb.com/icons/preview/green/checkmark-xxl.png' class='icon'></p>";
}

//if the races are the same
if($charData['race'] != $squatData['race']){
    echo"<p><b>Race: </b>".$raceData['races'][$charData['race']-1]['name']."<img src='http://www.iconsdb.com/icons/preview/soylent-red/x-mark-xxl.png' class='icon'></p>";
}
else{
    $numSimilar ++;
    echo"<p><b>Race: </b>".$raceData['races'][$charData['race']-1]['name']."<img src='http://www.iconsdb.com/icons/preview/green/checkmark-xxl.png' class='icon'></p>";
}

//if the classes are the same
if($charData['class'] != $squatData['class']){
    echo"<p><b>Class: </b>".$classData['classes'][$charData['class']-1]['name']."<img src='http://www.iconsdb.com/icons/preview/soylent-red/x-mark-xxl.png' class='icon'></p>";
}
else{
    $numSimilar ++;
    echo"<p><b>Class: </b>".$classData['classes'][$charData['class']-1]['name']."<img src='http://www.iconsdb.com/icons/preview/green/checkmark-xxl.png' class='icon'></p>";
}

//if the genders are the same
if($charData['gender'] != $squatData['gender']){
    if($charData['gender'] == 0){
        echo"<p><b>Gender: </b>Male<img src='http://www.iconsdb.com/icons/preview/soylent-red/x-mark-xxl.png' class='icon'></p>";
    }
    else{
        echo"<p><b>Gender: </b>Female<img src='http://www.iconsdb.com/icons/preview/soylent-red/x-mark-xxl.png' class='icon'></p>";
    }
}
else{
    $numSimilar ++;
    if($charData['gender'] == 0){
        echo"<p><b>Gender: </b>Male<img src='http://www.iconsdb.com/icons/preview/green/checkmark-xxl.png' class='icon'></p>";
    }
    else{
        echo"<p><b>Gender: </b>Female<img src='http://www.iconsdb.com/icons/preview/green/checkmark-xxl.png' class='icon'></p>";
    }
}

//if levels are the same
if($charData['level'] != $squatData['level']){
    echo"<p><b>Level: </b>".$charData['level']."<img src='http://www.iconsdb.com/icons/preview/soylent-red/x-mark-xxl.png' class='icon'></p>";
}
else{
    $numSimilar ++;
    echo"<p><b>Level: </b>".$charData['level']."<img src='http://www.iconsdb.com/icons/preview/green/checkmark-xxl.png' class='icon'></p>";
}

//if factions are the same
if($charData['faction'] != $squatData['faction']){
    if($charData['faction'] == 0){
        echo"<p><b>Faction: </b>Alliance<img src='http://www.iconsdb.com/icons/preview/soylent-red/x-mark-xxl.png' class='icon'></p>";
    }
    else{
        echo"<p><b>Faction: </b>Horde<img src='http://www.iconsdb.com/icons/preview/soylent-red/x-mark-xxl.png' class='icon'></p>";
    }
}
else{
    $numSimilar ++;
    if($charData['faction'] == 0){
        echo"<p><b>Faction: </b>Alliance<img src='http://www.iconsdb.com/icons/preview/green/checkmark-xxl.png' class='icon'></p>";
    }
    else{
        echo"<p><b>Faction: </b>Horde<img src='http://www.iconsdb.com/icons/preview/green/checkmark-xxl.png' class='icon'></p>";
    }
}

echo "<p>Congrats you're ".$numSimilar."/7 of a Squatticus, or ".(($numSimilar/7)*100)."% of a Squatticus.</p>";

/*{                                                         {
    "name": "Sigath",                                           "name": "Squatticus",
    "realm": "Emerald Dream",                                   "realm": "Wyrmrest Accord",
    "class": 5,                                                 "class": 6,
    "race": 10,                                                 "race": 10,
    "gender": 0,                                                "gender": 0,
    "level": 110,                                               "level": 110,
    "achievementPoints": 8930,                                  "achievementPoints": 10745,
    "faction": 1,                                               "faction": 1,
    "totalHonorableKills": 10699                                "totalHonorableKills": 54072
}                                                         }*/

//https://render-us.worldofwarcraft.com/character/

/*{
    "races": [{
        "id": 1,
        "mask": 1,
        "side": "alliance",
        "name": "Human"
    }, {
        "id": 2,
        "mask": 2,
        "side": "horde",
        "name": "Orc"
    }, {
        "id": 3,
        "mask": 4,
        "side": "alliance",
        "name": "Dwarf"
    }, {
        "id": 4,
        "mask": 8,
        "side": "alliance",
        "name": "Night Elf"
    }, {
        "id": 5,
        "mask": 16,
        "side": "horde",
        "name": "Undead"
    }, {
        "id": 6,
        "mask": 32,
        "side": "horde",
        "name": "Tauren"
    }, {
        "id": 7,
        "mask": 64,
        "side": "alliance",
        "name": "Gnome"
    }, {
        "id": 8,
        "mask": 128,
        "side": "horde",
        "name": "Troll"
    }, {
        "id": 9,
        "mask": 256,
        "side": "horde",
        "name": "Goblin"
    }, {
        "id": 10,
        "mask": 512,
        "side": "horde",
        "name": "Blood Elf"
    }, {
        "id": 11,
        "mask": 1024,
        "side": "alliance",
        "name": "Draenei"
    }, {
        "id": 22,
        "mask": 2097152,
        "side": "alliance",
        "name": "Worgen"
    }, {
        "id": 24,
        "mask": 8388608,
        "side": "neutral",
        "name": "Pandaren"
    }, {
        "id": 25,
        "mask": 16777216,
        "side": "alliance",
        "name": "Pandaren"
    }, {
        "id": 26,
        "mask": 33554432,
        "side": "horde",
        "name": "Pandaren"
    }]
}*/

/*{
    "classes": [{
        "id": 1,
        "mask": 1,
        "powerType": "rage",
        "name": "Warrior"
    }, {
        "id": 2,
        "mask": 2,
        "powerType": "mana",
        "name": "Paladin"
    }, {
        "id": 3,
        "mask": 4,
        "powerType": "focus",
        "name": "Hunter"
    }, {
        "id": 4,
        "mask": 8,
        "powerType": "energy",
        "name": "Rogue"
    }, {
        "id": 5,
        "mask": 16,
        "powerType": "mana",
        "name": "Priest"
    }, {
        "id": 6,
        "mask": 32,
        "powerType": "runic-power",
        "name": "Death Knight"
    }, {
        "id": 7,
        "mask": 64,
        "powerType": "mana",
        "name": "Shaman"
    }, {
        "id": 8,
        "mask": 128,
        "powerType": "mana",
        "name": "Mage"
    }, {
        "id": 9,
        "mask": 256,
        "powerType": "mana",
        "name": "Warlock"
    }, {
        "id": 10,
        "mask": 512,
        "powerType": "energy",
        "name": "Monk"
    }, {
        "id": 11,
        "mask": 1024,
        "powerType": "mana",
        "name": "Druid"
    }, {
        "id": 12,
        "mask": 2048,
        "powerType": "fury",
        "name": "Demon Hunter"
    }]
}*/
?>