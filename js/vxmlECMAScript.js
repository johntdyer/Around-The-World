function parseHumidity(i) {
    r = i.split(" ");
    return r[1].slice(0, -1);
}
function tokenizeNumberString(string) {
    var tokenizedArrayVar = new Array();
    tokenizedArrayVar = string.split("");
    return tokenizedArrayVar;
}
function parseWeather(i) {
    if (i == 'fog' || i == 'smoke' || i == 'haze' || i == 'dust') {
        return "fog";
    }
    else if (i == 'snow' || i == 'ice' || i == 'flurries' || i == 'sleet' || i == 'chance_of_snow') {
        return "snowing";
    }
    else if (i == 'chance_of_tstorm' || i == 'rain' || i == 'mist') {
        return "rainy";
    }
    else if (i == 'thunderstorm' || i == 'storm') {
        return "thunderstorms";
    }
    else if (i == 'cloudy' || i == 'chance_of_rain' || i == 'chance_of_storm' || i == 'mostly_cloudy') {
        return "overcast";
    }
    else if (i == 'partly_cloudy' || i == 'mostly_sunny') {
        return "partly_cloudy";
    } else if (i == 'sunny') {
        return 'sunny';
    } else {
        // INCASE WE GET A WACK GOOGLE RESPOSE WE PRETEND =^P
        return 'sunny';
    }
}

function buildAudioFileArray(i) {
    var temp = Number(i);
    var returnVal = [];
    if (temp & lt; = 19) return returnVal = [temp];
    else if (temp == 20) return returnVal = [20];
    else if (temp == 30) return returnVal = [30];
    else if (temp == 40) return returnVal = [40];
    else if (temp == 50) return returnVal = [50];
    else if (temp == 60) return returnVal = [60];
    else if (temp == 70) return returnVal = [70];
    else if (temp == 80) return returnVal = [80];
    else if (temp == 90) return returnVal = [90];
    else if (temp & gt; = 21 & amp; & amp; temp & lt; = 99) {
        var first = String(temp).slice(0, 1);
        var second = String(temp).slice(1, 2);
        return returnVal = [first + '0', second];
    }
    else if (temp & gt; = 100) {
        var first = String(temp).slice(1, 2);
        var second = String(temp).slice(2, 3);
        if (first == "0") first = 'and';
        return returnVal = ['1', '100', first, second];
    }
}