function compareCharacter(charName, realmName) {
    //if charname and realmname arent empty
    if(charName !== "" && realmName !== "") {
        //create parameter array
        var params = {};
        params['name'] = charName;      //insert name:"character name" into array
        params['realm'] = realmName;    //insert realm:"character realm" into array

        //call the character.php script with the provided params array
        $.post("character.php", params, function (data) {
            var myNode = document.getElementById("mid");    //get the <div> with id mid
            //loop to remove all child elements of myNode
            while (myNode.firstChild) {
                myNode.removeChild(myNode.firstChild);
            }
            $("#mid").append(data); //places all of the return data from the php script into <div>
        });
        //call the charimage.php script with the provided params array
        $.post("charimage.php", {name: "squatticus", realm: "wyrmrest accord"}, function (data) {
            var myNode = document.getElementById("leftside");
            //loop to remove all child elements of myNode
            while (myNode.firstChild) {
                myNode.removeChild(myNode.firstChild);
            }
            $("#leftside").append(data);
        });
        //call the charimage.php script with the provided params array
        $.post("charimage.php", params, function (data) {
            var myNode = document.getElementById("rightside");
            //loop to remove all child elements of myNode
            while (myNode.firstChild) {
                myNode.removeChild(myNode.firstChild);
            }
            $("#rightside").append(data);
        });
    }
    else{
        document.getElementById("compError").innerHTML = "Please Enter Name and Realm."
    }
}