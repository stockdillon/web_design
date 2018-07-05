function hangman() {
    console.log("Hangman!!!");
    var game = document.getElementById('play-area');
    var imageNum = 0;
    var image = '';
    var theWord = '';
    var showWord = '';
    var blankString = '';
    var wordHidden = '<input type="hidden" id="word" value="">';
    //var guessButton = '<button id="guessButton" type="submit">Guess!</button>';
    //var newGame = '<button id="newGame" type="submit" value="New Game">New Game</button>';
    var guessButton = '<input id="guessButton" type="submit" value="Guess!">';
    var newGame = '<input id="newGame" type="submit" value="New Game">';
    var textBox = '<input type="text" id="text">';
    var blanks = '';
    var blanksHTML = '';
    var gameString = '';
    var guess = '';
    var message = "<p id='message'></p>";







    image = '<img id="image" src="hm' + imageNum+ '.png">';

    //console.log(word);
    //console.log(word.charAt(0));

    //console.log("before newWord...");
    //console.log("word: " + theWord);
    //console.log("showWord: " + showWord);
    //console.log("blankString: " + blankString);

    newWord();

    console.log("after newWord...");
    console.log("word: " + theWord);
    console.log("showWord: " + showWord);
    console.log("blankString: " + blankString);


    blanksHTML = '<p id="blanks">' + blankString + '</p>';


    gameString =
        image +
        wordHidden +
        blanksHTML +
        "<form>" +
        textBox +
        guessButton +
        newGame +
        message +
        "</form>";

    game.innerHTML = gameString;

    document.getElementById('word').value = theWord;

    installListener("guessButton");
    installNewGameListener("newGame");



    function display(){
        //console.log(theWord);
        document.getElementById('word').value = theWord;
        console.log("Hidden Word: " + document.getElementById('word').value);

        //blanksHTML = '<p id="blanks">' + blankString + '</p>';
        document.getElementById('blanks').innerHTML = blankString;

        //console.log(imageNum);
        document.getElementById('message').innerHTML = "";
        document.getElementById('image').src = "hm" + imageNum + ".png";

        if(imageNum >= 6){
            //message.innerHTML = "You Lose!";
            document.getElementById('message').innerHTML = 'You guessed poorly!';
            showWord = theWord;
            buildBlankString();
            document.getElementById('blanks').innerHTML = blankString;
            console.log(blankString);
            installListener("guessButton");
            installNewGameListener("newGame");
            return;
        }

        if(showWord == theWord){
            //message.innerHTML = "You Win!";
            document.getElementById('message').innerHTML = "You Win!";
            installListener("guessButton");
            installNewGameListener("newGame");
            return;
        }
        //image = '<img id="image" src="hm' + imageNum+ '.png">';
        document.getElementById('image').src = "hm" + imageNum + ".png";
        //imageNum ++;







        installListener("guessButton");
        installNewGameListener("newGame")
    }


    function installListener(submitId) {
        //document.getElementById("guessButton").onclick = function(event) {
        document.getElementById(submitId).onclick = function (event) {
            event.preventDefault();
            guess = document.getElementById('text').value;
            //console.log(guess);

            if(guess == null || guess == ''){
                document.getElementById('message').innerHTML = "You must enter a letter!";
                installListener("guessButton");
                installNewGameListener("newGame");
                return;
            }

            var goodGuess = false;
            for (var i = 1; i <= theWord.length; i++) {
                if (guess.charAt(0) == theWord.charAt(i - 1)) {
                    showWord = showWord.substr(0, i - 1) + guess.charAt(0) + showWord.substr(i, showWord.length - i);
                    goodGuess = true;
                }
            }
            //console.log(showWord);

            if(!goodGuess){
                imageNum++;
            }
            if(imageNum > 6){
                //lose();
            }
            document.getElementById('text').value = '';
            buildBlankString();
            display();
        }
    }






    function installNewGameListener(submitId) {
        document.getElementById(submitId).onclick = function (event) {
            event.preventDefault();
            document.getElementById('text').value = '';
            newWord();
            buildBlankString();
            imageNum = 0;
            display();
        }
    }





    function newWord(){
        theWord = randomWord();
        wordHidden.value = theWord;
        blanks = '';
        showWord = '';
        for (var i = 1; i < theWord.length; i++) {
            showWord += "_";
            blanks += " ";
        }
        showWord += "_";

        blankString = showWord.charAt(0);
        for(i=1; i<=theWord.length; i++){
            blankString += blanks.charAt(i-1);
            blankString += showWord.charAt(i);
        }
    }





    function buildBlankString(){
        blankString = '';
        //blankString += showWord.charAt(0);
        for(i=0; i<showWord.length; i++){
            blankString += showWord.charAt(i);
            blankString += blanks.charAt(i);
        }
    }








    function randomWord() {
        var words = ["moon", "home", "mega", "blue", "send", "frog", "book", "hair", "late",
            "club", "bold", "lion", "sand", "pong", "army", "baby", "baby", "bank", "bird", "bomb", "book",
            "boss", "bowl", "cave", "desk", "drum", "dung", "ears", "eyes", "film", "fire", "foot", "fork",
            "game", "gate", "girl", "hose", "junk", "maze", "meat", "milk", "mist", "nail", "navy", "ring",
            "rock", "roof", "room", "rope", "salt", "ship", "shop", "star", "worm", "zone", "cloud",
            "water", "chair", "cords", "final", "uncle", "tight", "hydro", "evily", "gamer", "juice",
            "table", "media", "world", "magic", "crust", "toast", "adult", "album", "apple",
            "bible", "bible", "brain", "chair", "chief", "child", "clock", "clown", "comet", "cycle",
            "dress", "drill", "drink", "earth", "fruit", "horse", "knife", "mouth", "onion", "pants",
            "plane", "radar", "rifle", "robot", "shoes", "slave", "snail", "solid", "spice", "spoon",
            "sword", "table", "teeth", "tiger", "torch", "train", "water", "woman", "money", "zebra",
            "pencil", "school", "hammer", "window", "banana", "softly", "bottle", "tomato", "prison",
            "loudly", "guitar", "soccer", "racket", "flying", "smooth", "purple", "hunter", "forest",
            "banana", "bottle", "bridge", "button", "carpet", "carrot", "chisel", "church", "church",
            "circle", "circus", "circus", "coffee", "eraser", "family", "finger", "flower", "fungus",
            "garden", "gloves", "grapes", "guitar", "hammer", "insect", "liquid", "magnet", "meteor",
            "needle", "pebble", "pepper", "pillow", "planet", "pocket", "potato", "prison", "record",
            "rocket", "saddle", "school", "shower", "sphere", "spiral", "square", "toilet", "tongue",
            "tunnel", "vacuum", "weapon", "window", "sausage", "blubber", "network", "walking", "musical",
            "penguin", "teacher", "website", "awesome", "attatch", "zooming", "falling", "moniter",
            "captain", "bonding", "shaving", "desktop", "flipper", "monster", "comment", "element",
            "airport", "balloon", "bathtub", "compass", "crystal", "diamond", "feather", "freeway",
            "highway", "kitchen", "library", "monster", "perfume", "printer", "pyramid", "rainbow",
            "stomach", "torpedo", "vampire", "vulture"];

        return words[Math.floor(Math.random() * words.length)];
    }


}