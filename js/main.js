(function ($) {

    "use strict";
    // Setup the calendar with the current date
    $(document).ready(function () {
        var date = new Date();
        var today = date.getDate();
        // Set click handlers for DOM elements
        $(".right-button").click({date: date}, next_year);
        $(".left-button").click({date: date}, prev_year);
        $(".month").click({date: date}, month_click);
        $("#add-button").click({date: date}, new_event);
        // Set current month as active
        $(".months-row").children().eq(date.getMonth()).addClass("active-month");
        get_events();
        init_calendar(date);
        var events = check_events(today, date.getMonth() + 1, date.getFullYear());
        show_events(events, months[date.getMonth()], today);
    });

// Initialize the calendar by appending the HTML dates
    function init_calendar(date) {
        $(".tbody").empty();
        $(".events-container").empty();
        var calendar_days = $(".tbody");
        var month = date.getMonth();
        var year = date.getFullYear();
        var day_count = days_in_month(month, year);
        var row = $("<tr class='table-row'></tr>");
        var today = date.getDate();
        // Set date to 1 to find the first day of the month
        date.setDate(1);
        var first_day = date.getDay();
        // 35+firstDay is the number of date elements to be added to the dates table
        // 35 is from (7 days in a week) * (up to 5 rows of dates in a month)
        for (var i = 0; i < 35 + first_day; i++) {
            // Since some of the elements will be blank, 
            // need to calculate actual date from index
            var day = i - first_day + 1;
            // If it is a sunday, make a new row
            if (i % 7 === 0) {
                calendar_days.append(row);
                row = $("<tr class='table-row'></tr>");
            }
            // if current index isn't a day in this month, make it blank
            if (i < first_day || day > day_count) {
                var curr_date = $("<td class='table-date nil'>" + "</td>");
                row.append(curr_date);
            } else {
                var curr_date = $("<td class='table-date'>" + day + "</td>");
                var events = check_events(day, month + 1, year);
                if (today === day && $(".active-date").length === 0) {
                    curr_date.addClass("active-date");
                    show_events(events, months[month], day);
                }
                // If this date has any events, style it with .event-date
                if (events.length !== 0) {
                    curr_date.addClass("event-date");
                }
                // Set onClick handler for clicking a date
                curr_date.click({events: events, month: months[month], day: day}, date_click);
                row.append(curr_date);
            }
        }
        // Append the last row and set the current year
        calendar_days.append(row);
        $(".year").text(year);
    }

// Get the number of days in a given month/year
    function days_in_month(month, year) {
        var monthStart = new Date(year, month, 1);
        var monthEnd = new Date(year, month + 1, 1);
        return (monthEnd - monthStart) / (1000 * 60 * 60 * 24);
    }

// Event handler for when a date is clicked
    function date_click(event) {
        $(".events-container").show(250);
        $("#dialog").hide(250);
        $(".active-date").removeClass("active-date");
        $(this).addClass("active-date");
        show_events(event.data.events, event.data.month, event.data.day);
    }
    ;

// Event handler for when a month is clicked
    function month_click(event) {
        $(".events-container").show(250);
        $("#dialog").hide(250);
        var date = event.data.date;
        $(".active-month").removeClass("active-month");
        $(this).addClass("active-month");
        var new_month = $(".month").index(this);
        date.setMonth(new_month);
        init_calendar(date);
    }

// Event handler for when the year right-button is clicked
    function next_year(event) {
        $("#dialog").hide(250);
        var date = event.data.date;
        var new_year = date.getFullYear() + 1;
        $("year").html(new_year);
        date.setFullYear(new_year);
        init_calendar(date);
    }

// Event handler for when the year left-button is clicked
    function prev_year(event) {
        $("#dialog").hide(250);
        var date = event.data.date;
        var new_year = date.getFullYear() - 1;
        $("year").html(new_year);
        date.setFullYear(new_year);
        init_calendar(date);
    }

// Event handler for clicking the new event button
    function new_event(event) {
        // if a date isn't selected then do nothing
        if ($(".active-date").length === 0)
            return;
        // remove red error input on click
        $("input").click(function () {
            $(this).removeClass("error-input");
        });
        // empty inputs and hide events
        $("#dialog input[type=text]").val('');
        $("#dialog input[type=number]").val('');
        $(".events-container").hide(250);
        $("#dialog").show(250);
        // Event handler for cancel button
        $("#cancel-button").click(function () {
            $("#name").removeClass("error-input");
            $("#count").removeClass("error-input");
            $("#dialog").hide(250);
            $(".events-container").show(250);
        });
        var plateforme = $("#plateforme").val().trim();
        getConfig(plateforme);
        // Event handler for ok button
        $("#ok-button").unbind().click({date: event.data.date}, function () {
            var date = event.data.date;
            var idProjet = $("#projet").val().trim();
            var idEssai = $("#essai").val().trim();
            var plateforme = $("#plateforme").val().trim();
            var config = $("#config").val().trim();
            var dateFin = $("#dateFin").val().trim();
            var day = parseInt($(".active-date").html());

//            console.log(idProjet);
//            console.log(idEssai);
//            console.log(client);
            // Basic form validation
            if (idProjet.length === 0) {
                $("#name").addClass("error-input");
            } else if (idEssai.length === 0) {
                $("#count").addClass("error-input");
            } else {
                new_event_json(idProjet, idEssai, date, day, plateforme, config, dateFin);

                $("#dialog").hide(250), 1500;

                date.setDate(day);
                init_calendar(date);

            }
        });
    }

// Adds a json event to event_data
    function new_event_json(idProjet, idEssai, date, day, plateforme, config, dateFin) {

        var annee = date.getFullYear();
        var mois = date.getMonth();
        var event = {
            "projet": idProjet,
            "essai": idEssai,
            "plateforme": plateforme,
            "config": config,
            "year": annee,
            "month": mois + 1,
            "day": day,
            "dateFin": dateFin
        };
        var dateModif = annee + "-" + (mois + 1) + "-" + day;
        
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                if (this.responseText === "true") {
                    event_data["events"].push(event);
                    location.reload();
                } else {
                    alert("Erreur, L'essai n'a pas pu être ajouté. /!\\");
                }
            }
        };
        xhttp.open("POST", "verifEtAjoutEssai.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("date=" + dateModif + "&idEssai=" + idEssai + "&idProjet=" + idProjet + "&plateforme=" + plateforme + "&config=" + config +"&dateFin="+ dateFin);

    }

// Display all events of the selected date in card views
    function show_events(events, month, day) {
        // Clear the dates container
        $(".events-container").empty();
        $(".events-container").show(250);
        // If there are no events for this date, notify the user
        if (events.length === 0) {
            var event_card = $("<div class='event-card'></div>");
            var event_name = $("<div class='event-name'>There are no events planned for " + month + " " + day + ".</div>");
            $(event_card).css({"color": "#FF1744"});
            $(event_card).append(event_name);
            $(".events-container").append(event_card);
        } else {
            // Go through and add each event as a card to the events container
            for (var i = 0; i < events.length; i++) {
                var jour = events[i].day; var mois= events[i].month;
                if((events[i].day).toString().length === 1){
                    jour = "0"+events[i].day;
                }
                if((events[i].month).toString().length === 1){
                    mois = "0"+events[i].month;
                }
                var dateDebut = events[i].year + "-" + mois + "-" + jour;
                var dateFin = events[i].dateFin;
                var event_card = $('<div class="event-card"></div>');
                var event_name = $("<div class='event-name'>Essai n°" + events[i]["essai"] + ":</div>");
                var event_essai = $("<div class='event-count'>Projet n°" + events[i]["projet"] + "</div>");
                var event_Config = $("<div class='event-count'>" + events[i]["plateforme"] + ": " + events[i]["config"] + "</div>");
                var modif_date = $('<span class="datepicker-toggle"> <span class="datepicker-toggle-button"><input type="date" id="' + events[i]["essai"] + '"class="datepicker-input" onchange="updateDate(this.id,this.value)">&#x1F4C5;</span></span>');
                var print_dateFin;
                if(dateDebut !== dateFin){
                    print_dateFin = $("<br><div class='event-count'> date de fin de l'essai: " + dateFin + "</div>");
                }
                var valid_essai = $("<div class='event-count'><a id='"+events[i].essai+"' onclick='validationEssai(this.id)' style='cursor: pointer;'>&#x1F6A9; </a></div>");
                if (events[i]["cancelled"] === true) {
                    $(event_card).css({
                        "border-left": "10px solid #FF1744"
                    });
                    event_count = $("<div class='event-cancelled'>Cancelled</div>");
                }

                $(event_card).append(event_name).append(event_essai).append(modif_date).append(event_Config).append(print_dateFin).append(valid_essai);
                $(event_name).css({
                    "color": events[i]["couleur"]
                });
                $(".events-container").append(event_card);
            }
        }
    }

// Checks if a specific date has any events
    function check_events(day, month, year) {
        var events = [];
        for (var i = 0; i < event_data["events"].length; i++) {
            var event = event_data["events"][i];
            if (event["day"] === day &&
                    event["month"] === month &&
                    event["year"] === year) {
                events.push(event);
            }
        }
        return events;
    }

//get events int the DB
    function get_events() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                var obj = $.parseJSON(this.responseText);
                for (var i = 0; i < obj.length; i++) {
                    var dateBDD = new Date(obj[i].dateDebut);
                    var day = parseInt(obj[i].dateDebut.substring(8));
                    var mois = dateBDD.getMonth();
                    var annee = dateBDD.getFullYear();
                    var idProjet = obj[i].idProjet;
                    var idEssai = obj[i].idEssai;
                    var plateforme = obj[i].libellePlat;
                    var config = obj[i].libelleConfig;
                    var couleur = obj[i][7];
                    var dateFin = obj[i].dateFin;
                    console.log(couleur);
                    var event = {
                        "projet": idProjet,
                        "essai": idEssai,
                        "plateforme": plateforme,
                        "config": config,
                        "year": annee,
                        "month": mois + 1,
                        "day": day,
                        "couleur": couleur,
                        "dateFin": dateFin
                    };
                    event_data["events"].push(event);
                }
                var date = new Date();
                init_calendar(date);
            }
        };
        xhttp.open("GET", "recupEssai.php", true);
        xhttp.send();
    }


// Given data for events in JSON format
    var event_data = {
        "events": [

        ]
    };

    const months = [
        "Janvier",
        "Fevrier",
        "Mars",
        "Avril",
        "Mai",
        "Juin",
        "Juillet",
        "Août",
        "Septembre",
        "Octobre",
        "Novembre",
        "Decembre"
    ];




})(jQuery);

function getConfig(plateforme) {
    $("#config").empty();
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            var obj = $.parseJSON(this.responseText);
            for (var i = 0; i < obj.length; i++) {
                var option = '<option value="' + obj[i].idConfig + '">' + obj[i].libelleConfig + '</option>';
                $("#config").append(option);
            }
        }
    };
    xhttp.open("GET", "recupConfig.php?p=" + plateforme, true);
    xhttp.send();

}

function updateDate(essai, dateUpdated) {

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            if (this.responseText === "1") {
                // Get the snackbar DIV
                var x = document.getElementById("snackbarReussite");

                // Add the "show" class to DIV
                x.className = "show";

                // After 3 seconds, remove the show class from DIV
                setTimeout(function () {
                    x.className = x.className.replace("show", "");
                }, 3000);
                location.reload();
            } else {
                // Get the snackbar DIV
                var x = document.getElementById("snackbarEchec");

                // Add the "show" class to DIV
                x.className = "show";

                // After 3 seconds, remove the show class from DIV
                setTimeout(function () {
                    x.className = x.className.replace("show", "");
                }, 3000);
            }

        }
    };
    xhttp.open("GET", "updateDateEssai.php?p=" + essai + "&d=" + dateUpdated, true);
    xhttp.send();
}

function validationEssai(essai) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            if (this.responseText === "1") {
                location.reload();
            } else {
                alert("echec de la validation de l'essai");
            }

        }
    };
    xhttp.open("GET", "validationEssai.php?p=" + essai, true);
    xhttp.send();
}