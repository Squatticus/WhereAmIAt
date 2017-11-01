/********************************************************************************
 Default function on page load, fills the ContentContainer Div on Main.html with
 description text of the website's functions.
 This also handles the click functions for the Nav Menu.
 @return none
 ********************************************************************************/
function def() {
    //On Webpage load's the default text to ContentContainer Container Div
    $('#ContentContainer').load('onload.html #loadstuff');
    $(home).addClass("using").siblings("a").removeClass("using");
    //Handler for a click even on a piece of the Nav Menu
    $("div a").click(function () {
        //If the Home item is clicked
        if (this.id === "home") {
            //load in the character comparison div from the Char file
            $('#ContentContainer').load('onload.html #loadstuff');
        }
        //If the Character item is clicked
        if (this.id === "char") {
            //load in the character comparison div from the Char file
            $('#ContentContainer').load('character.html #characterComparisonDiv');
        }
        //If the Achievement item is clicked
        if (this.id === "achi") {
            //load in the achievement comparison div from the Achi file
            $('#ContentContainer').load('achievement.html #dummy');
        }
        //If the Itmes item is clicked
        if (this.id === "item") {
            //load in the achievement comparison div from the Item file
            $('#ContentContainer').load('items.html #dummy');
        }
        //If the PvP item is clicked
        if (this.id === "pvp") {
            //load in the achievement comparison div from the PvP file
            $('#ContentContainer').load('pvp.html #dummy');
        }
        //If the Character item is clicked
        if (this.id === "prog") {
            //load in the achievement comparison div from the PvE file
            $('#ContentContainer').load('pve.html #dummy');
            //getCharProfile();
        }
        //apply using class to the clicked nav menu item and remove using from other
        $(this).addClass("using").siblings("a").removeClass("using");
    });
}

function compareCharacterData(charName, charRealm) {
    /*************************************************************************************
     * This function will retrieve and parse the JSON representation of a character profile from
     * the Blizzard API. Once the data has been parsed it will be used to manipulate the DOM elements
     * creating the contents of the character comparison body. This function will also load in the
     * main character render provided by Blizzard
     *************************************************************************************/

    if (charName !== "" && charRealm !== "") {    //check if empty strings
        var URL = "https://us.api.battle.net/wow/character/" + charRealm + "/" + charName + "?locale=en_US&apikey=vhamuv4qktrbzp8hrdamtxkkrps4tv96";
        var squatURL = "https://us.api.battle.net/wow/character/wyrmrest%20accord/Squatticus?locale=en_US&apikey=vhamuv4qktrbzp8hrdamtxkkrps4tv96";
        var raceURL = "https://us.api.battle.net/wow/data/character/races?locale=en_US&apikey=vhamuv4qktrbzp8hrdamtxkkrps4tv96";
        var classURL = "https://us.api.battle.net/wow/data/character/classes?locale=en_US&apikey=vhamuv4qktrbzp8hrdamtxkkrps4tv96";
        //get response from the API url

        var charData, squatData, classData, raceData;

        $.when( //when all of the JSON data is retrieved
            $.getJSON(URL, function (data) {    //get character data
                JSON.stringify(data);   //parse character data
                charData = data;    //save character data
            }),
            $.getJSON(squatURL, function (data) {   //get squat data
                JSON.stringify(data);   //parse squat data
                squatData = data;   //save squat data
            }),
            $.getJSON(raceURL, function (data) {    //get race data
                JSON.stringify(data);   //parse race data
                raceData = data;    //save race data
            }),
            $.getJSON(classURL, function (data) {   //get class data
                JSON.stringify(data);   //parse class data
                classData = data;   //save class data
            })
        ).then(function () {    //then use that data to format the page
            //find the <div id='mid'> and empty it
            var myNode = document.getElementById("mid");
            while (myNode.firstChild) {
                myNode.removeChild(myNode.firstChild);
            }
            //place character name into mid
            var charNode = document.createElement('p'); //create paragraph element
            charNode.innerHTML = charData['name'];  //place the name of submitted character into the paragraph element
            myNode.appendChild(charNode);   //add the paragraph element to the mid div
            //place character realm into mid
            var realmNode = document.createElement('p'); //create paragraph element
            realmNode.innerHTML = charData['realm'];  //place the name of submitted character into the paragraph element
            myNode.appendChild(realmNode);   //add the paragraph element to the mid div
            //place character level into mid
            var levelNode = document.createElement('p'); //create paragraph element
            levelNode.innerHTML = charData['level'];  //place the name of submitted character into the paragraph element
            myNode.appendChild(levelNode);   //add the paragraph element to the mid div
            //place character gender into mid
            //place character race into mid
            //place character class into mid
            //place character faction into mid
        });
    }
}

//Preforms 'def' funtion on page load.
window.onload = def;
