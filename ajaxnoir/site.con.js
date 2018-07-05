/*! DO NOT EDIT ajaxnoir 2017-06-28 */
function Login(sel) {

    var form = $(sel);
    form.submit(function(event) {
        event.preventDefault();

        console.log("Submitted");

        $.ajax({
            url: "post/login.php",
            data: form.serialize(),
            method: "POST",
            success: function(data) {
                var json = parse_json(data);
                if(json.ok) {
                    // Login was successful
                    window.location.assign("./");
                } else {
                    // Login failed, a message is in json.message
                    $(sel + " .message").html("<p>" + json.message + "</p>");
                }
            },
            error: function(xhr, status, error) {
                // An error!
                $(sel + " .message").html("<p>Error: " + error + "</p>");
            }
        });
    });
}
/**
 * Created by dillonstock on 6/26/17.
 */
function MovieInfo(sel, title, year) {
    console.log("MovieInfo: " + title + "/" + year);

    $.ajax({
        url: "https://api.themoviedb.org/3/search/movie",
        data: {api_key: "fcef748263676c69166c66661f0b77db", query: title, year: year},
        method: "GET",
        dataTpe: "text",
        success: function (data) {
            var that = this;
            if (data.results.length > 0) {
                // Successfully updated
                console.log("Successful MovieDB Query");
                var tabs = $(".paper > ul > li");
                var infoTab = tabs.get(0);
                var plotTab = tabs.get(1);
                var posterTab = tabs.get(2);
                console.log(infoTab);
                console.log(plotTab);
                console.log(posterTab);

                //console.log(data);
                //console.log(data['results']);
                var title = data['results'][0]['title'];
                var release = data['results'][0]['release_date'];
                var voteAvg = data['results'][0]['vote_average'];
                var voteCount = data['results'][0]['vote_count'];
                var info = "<p>" + title + "</p><p>" + release;
                info += "</p><p>" + voteAvg + "</p><p>" + voteCount + "</p>";
                //console.log(infoTab);
                $(infoTab).children("div").html(info);

                var overview = data['results'][0]['overview'];
                var plot = "<p>" + overview + "</p>";
                console.log(plotTab);
                $(plotTab).children("div").html(plot);
                //$(tab2).children(". ").attr('class', 'show');
                //$(tab2).children(".show").html(plotTab);

                var url = data['results'][0]['poster_path'];
                if(url ===  null){
                    //var posterTab = "";
                    var posterSrc = "";
                }
                else{
                    var url = url.substr(1);
                    var posterSrc = "http://image.tmdb.org/t/p/w500/" + url;
                    //console.log(posterSrc)
                    $(posterTab).children("div").children('p').children('img').attr('src', posterSrc);
                    $(posterTab).children("div").children('p').children('img').attr('opacity', "0.5");
                }


                //$(".paper > ul > li > .show > p").html("<p>" + allTabs + "</p>");
                //$(".paper > a").html("<p>" + infoTab + "</p>");
                //$($(".paper > a").get(1)).html("<p>" + plotTab + "</p>");
                //$($(".paper > a").get(1)).html("<p>" + posterTab + "</p>");
                //console.log($(".paper > ul > li > .show").parent().children("a").children("img"));

                //$(".paper > ul > li > .show").parent().children("a").children("img").attr('style', "width:300px;height:350px;");
                //$(".paper > ul > li > .show").siblings("a > img").attr('style', "width:300px;height:350px;");

            } else {
                // Update failed
                console.log("Info Request Failed");
                $(".paper").html("<p>No information available</p>");
            }
        },

        error: function (xhr, status, error) {
            // Error
            console.log("Info Request Failed (No Connection)");
            $(".paper").html("<p>Unable to communicate<br>with themoviedb.org</p>");
        }
    });

    var tabs = $(".paper > ul > li");
    var tab1 = $(tabs).children(0);
    //console.log($(tabs.get(0)).children('a').children('img'));
    $(tabs.get(0)).children('a').children('img').css({opacity:1});
    console.log(tabs);
    for(var i=0; i<tabs.length; i++){
        this.installListener(tabs, i);
    }
}


MovieInfo.prototype.installListener = function(tabs, tabNum){
    var tabNum = tabNum;
    var tab = $(tabs.get(tabNum));
    var aTag = tab.children('a');

    //alert('listening for tab ' + tabNum);
    console.log("listening for tab " + tabNum);
    aTag.click(function(event){
        //alert('clicked')
        event.preventDefault();
        var that = this;
        //console.log($(that).parents('li').children('div'));
        var tabs = $(".paper > ul > li");
        for(var i=0; i<3; i++){
            var tab = $(tabs.get(i));
            $(tab).children('div').fadeOut(2000);
            //$(tab).children('div').attr("class", "");
            $(tab).children('a').children('img').css({opacity: 0.3});
        }
        $(that).parents('li').children('div').attr("class", "show").hide().fadeIn(2000);
        $(that).children('img').css({opacity: 1}).hide().fadeIn(2000);
        //$(that).hide();
        //$(that).fadeIn(1000);
        console.log(that);
    });
}
function parse_json(json) {
    try {
        var data = $.parseJSON(json);
    } catch(err) {
        throw "JSON parse error: " + json;
    }

    return data;
}
function Stars(sel) {
    console.log("Stars constructor");
    var table = $(sel + " table");  // The table tag
    console.log(table);
    // Loop over the table rows
    var rows = table.find("tr");    // All of the table rows
    for(var r=1; r<rows.length; r++) {
        // Get a row
        var row = $(rows.get(r));

        // Determine the row ID
        var id = row.find('input[name="id"]').val();

        // Find and loop over the stars, installing a listener for each
        var stars = row.find("img");
        for(var s=0; s<=stars.length; s++) {
            var star = $(stars.get(s));

            // We are at a star
            this.installListener(row, star, id, s+1);
        }
    }
}

Stars.prototype.installListener = function(row, star, id, rating) {
    var that = this;

    console.log("listening...");

    star.click(function() {

        $.ajax({
            url: "post/stars.php",
            data: {id: id, rating: rating},
            method: "POST",
            success: function(data) {
                var json = parse_json(data);
                console.log(json);
                if(json.ok) {
                    // Successfully updated
                    //that.update(row, rating);
                    that.updateTable(json.table);
                    that.message("<p>Successfully updated</p>");
                    new Stars("form");

                } else {
                    // Update failed
                    that.message("<p>Update failed</p>");

                }
            },
            error: function(xhr, status, error) {
                // Error
                that.message("<p>Error: " + error + "</p>");
            }
        });
    });
}

/*
Stars.prototype.update = function(row, rating) {

    // Loop over the stars, setting the correct image
    var stars = row.find("img");
    for(var s=0; s<stars.length; s++) {
        var star = $(stars.get(s));

        if(s < rating) {
            star.attr("src", "images/star-green.png")
        } else {
            star.attr("src", "images/star-gray.png");
        }
    }

    var num = row.find("span.num");
    num.text("" + rating + "/10");
}
*/


Stars.prototype.message = function(message) {
    $(".message").html(message).show().delay(2000).fadeOut(1000);
}

Stars.prototype.updateTable = function(table) {
    $(".table").html(table);
}

