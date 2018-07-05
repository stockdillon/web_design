function Game(sel, solvedTable){
    console.log("Game constructor");
    //alert("hello!");
    var table = $(sel + " table");  // The table tag
    this.table = $(sel + " table");  // The table tag
    //console.log(table);
    //console.log(this.table);
    var rows = table.find("tr");    // All of the table rows
    //console.log(rows);
    for(var r=0; r<rows.length; r++) {
        // Get a row
        var row = $(rows.get(r));

        // Find and loop over the stars, installing a listener for each
        var cells = row.find("td");
        for(var s=0; s<cells.length; s++) {
            var cell = $(cells.get(s));

            // We are at a cell
            if($(cell).attr('class') == 'cell'){
                this.installListener(cell);
            }
        }
    }

    var checkButton = $('#check');
    var solveButton = $('#solved');
    var clearButton = $('#clear');
    this.installButtonListener(checkButton);
    this.installButtonListener(solveButton);
    this.installButtonListener(clearButton);
    var yesButton = $('#yes');
    var noButton = $('#no');
    this.installYesNoListener(yesButton);
    this.installYesNoListener(noButton);
}




Game.prototype.installListener = function(cell) {
    console.log("listening...");
    var that = this;

    cell.click(function(event) {
        if(that.disabled){
            return;
        }
        that.fixRed();
        //var that = this;
        console.log("clicked!");
        //var div = $(that).children('div');
        var div = $(this).children('div');
        console.log(div.attr('class'));
        $(div).children('p').html('&nbsp;');

        if(div.attr('class') == 'empty'){
            div.attr('class', 'blue_cell');
        }

        else if(div.attr('class') == 'island'){
            div.attr('class', 'empty');
        }

        else if(div.attr('class') == 'blue_cell'){
            div.attr('class', 'island');
            $(div).children('p').html('&#9679;');
        }

        that.isSolved();
    });
}






Game.prototype.installButtonListener = function(button) {
    console.log("listening for button...");
    var that = this;

    button.click(function(event) {
        console.log("clicked!");
        //var action = $(that).attr('id');
        var action = $(this).attr('id');
        $('#message').css({'color': '#732093'});
        $('#message').show().css({'font-stlye': 'italic'})

        if(action == 'check'){
            console.log('clicked check');
            that.checkGame();
            return;
        }

        if(action == 'solved'){
            $('#message').html('Are you sure you want to solve?');
            $('#yes').attr('type', 'submit');
            $('#no').attr('type', 'submit');
            $('#solved').attr('type', 'hidden');
            $('#check').attr('type', 'hidden');
            $('#clear').attr('type', 'hidden');
            return;
        }

        if(action == 'clear'){
            console.log('clicked clear');
            that.clearGame();
            return;
        }
    });
}


Game.prototype.installYesNoListener = function(YesNo) {
    console.log("listening for YesNo...");
    var that = this;

    YesNo.click(function(event) {
        console.log("clicked Yes or No!");
        var action = $(this).attr('id');
        console.log(action);
        if(action == 'yes'){
            console.log("attempting to call solveGame");
            that.disabled = true;
            that.solveGame();
        }

        else if(action == 'no'){
            $('#message').html('');
            $('#yes').attr('type', 'hidden');
            $('#no').attr('type', 'hidden');
            $('#solved').attr('type', 'submit');
            $('#check').attr('type', 'submit');
            $('#clear').attr('type', 'submit');
            return false;
        }
    });
}


Game.prototype.solveGame = function() {
    console.log("solving the game!");
    var that = this;

    $.ajax({
        url: "http://webdev.cse.msu.edu/~stockdil/project3/game-post.php",
        data: {test: 'successful data transfer'},
        method: "GET",
        dataTpe: "text",
        success: function (data) {
            //var that = this;
            if (data != null && data.length > 0) {
                // Successfully updated
                console.log("Successful GET");
                var data = $.parseJSON(data);
                console.log(data);
                var clearTable = data[0];
                console.log(clearTable);
                var solvedTable = data[1];
                console.log(solvedTable);

                $('#yes').attr('type', 'hidden');
                $('#no').attr('type', 'hidden');
                $('#solved').attr('type', 'hidden');
                $('#check').attr('type', 'hidden');
                $('#clear').attr('type', 'hidden');
                $('#message').html("You're a winner").css({color:'white'});

                var table = that.table;
                var rows = table.find("tr");
                console.log('number of rows: ' + rows.length);
                for(var r=0; r<rows.length; r++) {
                    // Get a row
                    var row = $(rows.get(r));

                    // Find and loop over the cells, installing a listener for each
                    var cells = row.find("td");
                    for(var c=0; c<cells.length; c++) {
                        var cell = $(cells.get(c));
                        var div = $(cell).children('div');
                        //console.log("div.class: " + div.attr('class'));
                        //console.log(solvedTable[r][c]);

                        if(div.attr('class') != 'locked'){
                            if(solvedTable[r][c] == 'sea'){
                                div.attr('class', 'blue_cell');
                            }

                            else if(solvedTable[r][c] == 'empty'){
                                div.attr('class', 'empty');
                            }

                            else if(solvedTable[r][c] == 'island'){
                                div.attr('class', 'island');
                                $(div).children('p').html('&#9679;');
                            }
                        }
                    }
                }


            } else {
                // Update failed
                console.log("Info Request Failed");
            }
        },

        error: function (xhr, status, error) {
            // Error
            console.log("Info Request Failed (No Connection)");
        }
    });

}






Game.prototype.clearGame = function() {
    console.log("clearing the game!");
    var that = this;

    $.ajax({
        url: "http://webdev.cse.msu.edu/~stockdil/project3/game-post.php",
        data: {test: 'successful data transfer'},
        method: "GET",
        dataTpe: "text",
        success: function (data) {
            if (data != null && data.length > 0) {
                // Successfully updated
                console.log("Successful GET");
                var data = $.parseJSON(data);
                console.log(data);
                var clearTable = data[0];
                console.log(clearTable);
                var solvedTable = data[1];
                console.log(solvedTable);

                $('#yes').attr('type', 'hidden');
                $('#no').attr('type', 'hidden');

                var table = that.table;
                var rows = table.find("tr");
                console.log('number of rows: ' + rows.length);
                for(var r=0; r<rows.length; r++) {
                    // Get a row
                    var row = $(rows.get(r));

                    // Find and loop over the cells, installing a listener for each
                    var cells = row.find("td");
                    for(var c=0; c<cells.length; c++) {
                        var cell = $(cells.get(c));
                        var div = $(cell).children('div');

                        if(div.attr('class') != 'locked'){
                            div.attr('class', 'empty');
                            $(div).children('p').html('&nbsp;');
                        }
                    }
                }


            } else {
                // Update failed
                console.log("Info Request Failed");
            }
        },

        error: function (xhr, status, error) {
            // Error
            console.log("Info Request Failed (No Connection)");
        }
    });
}











Game.prototype.checkGame = function() {
    console.log("checking the game!");
    var that =  this;
    /*
    var table = this.table;
    var rows = $(table).find('tr');
    var row = $(rows).get(0);
    var cells = $(row).find('td');
    //$(cells).children('td').children('div').attr('class','red_island');
    //cells.children.className = 'red_island';
    console.log(cells.children(''));
    var cell = $(cells).get(1);
    var div = $(cell).children('div');
    //$(div).attr('class', 'red_sea'); // ******* changes color of cell to red ***********
    */



    $.ajax({
        url: "http://webdev.cse.msu.edu/~stockdil/project3/game-post.php",
        data: {test: 'successful data transfer'},
        method: "GET",
        dataTpe: "text",
        success: function (data) {
            //var that = this;
            if (data != null && data.length > 0) {
                // Successfully updated
                console.log("Successful GET");
                var data = $.parseJSON(data);
                console.log(data);
                var clearTable = data[0];
                console.log(clearTable);
                var solvedTable = data[1];
                console.log(solvedTable);

                $('#yes').attr('type', 'hidden');
                $('#no').attr('type', 'hidden');

                var table = that.table;
                var rows = table.find("tr");
                console.log('number of rows: ' + rows.length);
                for(var r=0; r<rows.length; r++) {
                    // Get a row
                    var row = $(rows.get(r));

                    // Find and loop over the cells, installing a listener for each
                    var cells = row.find("td");
                    for(var c=0; c<cells.length; c++) {
                        var cell = $(cells.get(c));
                        var div = $(cell).children('div');
                        //console.log("div.class: " + div.attr('class'));
                        //console.log(solvedTable[r][c]);

                        if(div.attr('class') != 'locked'){
                            if(solvedTable[r][c] == 'sea'){
                                if(div.attr('class') == 'island'){
                                    div.attr('class', 'red_island');
                                    //$(div).children('p').html('&#9679;');
                                }
                            }

                            else if(solvedTable[r][c] == 'empty'){
                                div.attr('class', 'empty');
                            }

                            else if(solvedTable[r][c] == 'island'){
                                if(div.attr('class') == 'blue_cell'){
                                    div.attr('class', 'red_sea');
                                    //$(div).children('p').html('&nbsp;');
                                }
                            }
                        }
                    }
                }


            } else {
                // Update failed
                console.log("Info Request Failed");
            }
        },

        error: function (xhr, status, error) {
            // Error
            console.log("Info Request Failed (No Connection)");
        }
    });
}






Game.prototype.isSolved = function() {
    console.log("Checking if the user has won...");
    var that = this;

    $.ajax({
        url: "http://webdev.cse.msu.edu/~stockdil/project3/game-post.php",
        data: {test: 'successful data transfer'},
        method: "GET",
        dataTpe: "text",
        success: function (data) {
            //var that = this;
            if (data != null && data.length > 0) {
                // Successfully updated
                console.log("Successful GET");
                var data = $.parseJSON(data);
                console.log(data);
                var clearTable = data[0];
                console.log(clearTable);
                var solvedTable = data[1];
                console.log(solvedTable);

                $('#yes').attr('type', 'hidden');
                $('#no').attr('type', 'hidden');

                var table = that.table;
                var rows = table.find("tr");
                console.log('number of rows: ' + rows.length);
                for(var r=0; r<rows.length; r++) {
                    // Get a row
                    var row = $(rows.get(r));

                    // Find and loop over the cells, installing a listener for each
                    var cells = row.find("td");
                    for(var c=0; c<cells.length; c++) {
                        var cell = $(cells.get(c));
                        var div = $(cell).children('div');
                        console.log("div.class: " + div.attr('class'));
                        console.log("correct value: " + solvedTable[r][c]);

                        if(div.attr('class') != 'locked'){
                            if(solvedTable[r][c] == 'sea'){
                                if(div.attr('class') == 'island'){
                                    console.log("cell " + r + "," + c + " is incorrect");
                                    return false;
                                }
                            }

                            if(solvedTable[r][c] == 'island'){
                                if(div.attr('class') == 'blue_cell'){
                                    console.log("cell " + r + "," + c + " is incorrect");
                                    return false;
                                }
                            }

                            if(div.attr('class') == 'empty'){
                                console.log("cell " + r + "," + c + " is incorrect (EMPTY)");
                                return false;
                            }
                        }
                    }
                }

                console.log("returning true... user has won.");
                $('#yes').attr('type', 'hidden');
                $('#no').attr('type', 'hidden');
                $('#solved').attr('type', 'hidden');
                $('#check').attr('type', 'hidden');
                $('#clear').attr('type', 'hidden');
                $('#message').html("You're a winner").css({color:'white'});
                //$('div input').off;
                that.disabled = true;
                return true; // means the game has been solved by the user ------------


            } else {
                // Update failed
                console.log("Info Request Failed");
            }
        },

        error: function (xhr, status, error) {
            // Error
            console.log("Info Request Failed (No Connection)");
        }
    });
}






Game.prototype.fixRed = function(){
    console.log("fixing red cells...");
    var that = this;
    var table = that.table;
    var rows = table.find("tr");
    //console.log('number of rows: ' + rows.length);
    for(var r=0; r<rows.length; r++) {
        // Get a row
        var row = $(rows.get(r));

        // Find and loop over the cells
        var cells = row.find("td");
        for(var c=0; c<cells.length; c++) {
            var cell = $(cells.get(c));
            var div = $(cell).children('div');

            if(div.attr('class') != 'locked'){
                //console.log(div.attr('class'));
                if(div.attr('class') == 'red_sea'){
                    div.attr('class', 'blue_cell');
                }

                else if(div.attr('class') == 'red_island'){
                    div.attr('class', 'island');
                }
            }
        }
    }
}