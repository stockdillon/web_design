/*! DO NOT EDIT step10 2017-06-24 */
function Buttons() {
    this.on = 1;
    var that = this;

    this.update(1);

    for(var b=1;  b<=3;  b++) {
        this.configButton(b);
    }
}

Buttons.prototype.configButton = function(b) {
    var c = (b == 3 ? 1 : b + 1);
    var that = this;

    $("#b" + b).click(function() {
        if(that.on == b) {
            that.update(c);
        }
    });
}

Buttons.prototype.update = function(a) {
    this.on = a;
    $("#b1").css("background-color", this.on == 1 ? "red" : "green");
    $("#b2").css("background-color", this.on == 2 ? "red" : "green");
    $("#b3").css("background-color", this.on == 3 ? "red" : "green");
    $("#b1").html(this.on == 1 ? "Press Me" : "&nbsp;");
    $("#b2").html(this.on == 2 ? "Press Me" : "&nbsp;");
    $("#b3").html(this.on == 3 ? "Press Me" : "&nbsp;");
}
function Simon(sel) {
    this.state = "initial";
    this.sequence = [0, 2, 1];
    this.current = 0;

    this.configureButton = function(ndx, color) {
        var button = $(this.form.find("input").get(ndx));

        button.click(function(event) {
            document.getElementById(color).currentTime = 0;
            document.getElementById(color).play();
        });

        button.mousedown(function(event) {
            button.css("background-color", color);
            document.getElementById(color).currentTime = 0;
            document.getElementById(color).play();
        });

        button.mouseup(function(event) {
            button.css("background-color", "lightgrey");
        });
    }


    // Get a reference to the form object
    this.form = $(sel);
    this.configureButton(0, "red");
    this.configureButton(1, "green");
    this.configureButton(2, "blue");
    this.configureButton(3, "yellow");

    this.play();
}


Simon.prototype.play = function() {
    this.state = "play";    // State is now playing
    this.current = 0;       // Starting with the first one
    this.playCurrent();
}

Simon.prototype.playCurrent = function() {
    var that = this;

    if(this.current < this.sequence.length) {
        // We have one to play
        var colors = ['red', 'green', 'blue', 'yellow'];
        document.getElementById(colors[this.sequence[this.current]]).play();

        this.current++;
        window.setTimeout(function() {
            that.playCurrent();
            that.buttonOn($(that.form.find("input").get(that.current)));
        }, 1000);
    } else {
        this.state = "enter";
    }
}

Simon.prototype.buttonOn = function(button) {
    var colors = ['red', 'green', 'blue', 'yellow'];
    var button = $(this.form.find("input").get(0));
    //var value = button.attr("value");
    //var values = ['Red', 'Green', 'Blue', 'Yellow'];
    //console.log(button);
    var color = button.attr("value");
    //console.log($(color));
    //console.log(this);
    button.css("background-color", color);
    /*
    for(var i = 0; i<4; var++){
        if(value != values[i]){
            button.css("background-color", "lightgrey");
        }
    }
    */
    //document.getElementById(color).currentTime = 0;
    //document.getElementById(color).play();
    //button.css("background-color", "lightgrey");
}