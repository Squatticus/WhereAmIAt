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
        if(this.id === "home"){
            //load in the character comparison div from the Char file
            $('#ContentContainer').load('onload.html #loadstuff');
        }
        //If the Character item is clicked
        if(this.id === "char"){
            //load in the character comparison div from the Char file
            $('#ContentContainer').load('character.html #characterComparisonDiv');
        }
		//If the Achievement item is clicked
        if(this.id === "achi"){
            //load in the achievement comparison div from the Achi file
            $('#ContentContainer').load('achievement.html #dummy');
        }
		//If the Itmes item is clicked
        if(this.id === "item"){
            //load in the achievement comparison div from the Item file
            $('#ContentContainer').load('items.html #dummy');
        }
		//If the PvP item is clicked
        if(this.id === "pvp"){
            //load in the achievement comparison div from the PvP file
            $('#ContentContainer').load('pvp.html #dummy');
        }
		//If the Character item is clicked
        if(this.id === "prog"){
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

    if(charName !== "" && charRealm !== ""){    //check if empty strings
        var URL = "https://us.api.battle.net/wow/character/"+charRealm+"/"+charName+"?locale=en_US&apikey=vhamuv4qktrbzp8hrdamtxkkrps4tv96";
        //get response from the API url
        $.getJSON(URL, function (data) {
            //find the <div id='mid'> and empty it
            var myNode = document.getElementById("mid");
            while (myNode.firstChild) {
                myNode.removeChild(myNode.firstChild);
            }
            JSON.stringify(data);   //create JSON array object

            var dataField = ['name','realm','class','race','gender','level','faction'];
            dataField.forEach(function (t) {
                var newNode = document.createElement('p'); //test paragraph element
                newNode.innerHTML = data[t];  //place the name of submitted character into the test element
                myNode.appendChild(newNode);   //add the paragraph element to the mid div
            })
        });
    }
}

//Preforms 'def' funtion on page load.
window.onload = def;
