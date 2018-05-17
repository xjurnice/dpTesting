function random_rgba() {

    var r = Math.floor((Math.random() * 256));
    var g = Math.floor((Math.random() * 256));
    var b = Math.floor((Math.random() * 256));
    return 'rgb(' + r + ', ' + g + ', ' + b + ')';
}

var color = [];
var color2 = [];
var color3 = [];
for (i = 0; i < 200; i++) {
    color[i] = random_rgba();
}
for (i = 0; i < 200; i++) {
    color2[i] = random_rgba();
}
for (i = 0; i < 200; i++) {
    color3[i] = random_rgba();
}

function shuffle(array) {
    var m = array.length, t, i;
    while (m > 0) {
        i = Math.floor(Math.random() * m--);
        t = array[m];
        array[m] = array[i];
        array[i] = t;
    }
    return array;
}

