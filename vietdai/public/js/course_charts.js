
let x=$('#language').val().split('-');
x.shift();
let y=$('#course').val().split('-');
y.shift();
var title_=$('#title').val();
var barColors = [
"#fcb045",
"#fd1d1d",
"#833ab4",
"#4bc0c8",
"#c779d0",
"#feac5e",
"#FFA17F"
];
function shuffle(array) {
    let counter = array.length;
 
    // While there are elements in the array
    while (counter > 0) {
        // Pick a random index
        let index = Math.floor(Math.random() * counter);
 
        // Decrease counter by 1
        counter--;
 
        // And swap the last element with it
        let temp = array[counter];
        array[counter] = array[index];
        array[index] = temp;
    }
 
    return array;
}

new Chart("courseChart", {
    type: "doughnut",
    data: {
        labels: x,
        datasets: [{
        backgroundColor:shuffle(barColors),
        data: y
        }]
    },
    options: {
        title: {
        display: true,
        text: title_
        }
    }
});

let x_=$('#form').val().split('-');
x_.shift();
let y_=$('#count').val().split('-');
y_.shift();
var title_=$('#title_').val();
new Chart("countForm", {
    type: "doughnut",
    data: {
        labels: x_,
        datasets: [{
        backgroundColor: shuffle(barColors),
        data: y_
        }]
    },
    options: {
        title: {
        display: true,
        text: title_
        }
    }
});