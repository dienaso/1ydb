function immediately(){
var element = document.getElementById("mytext");
if("\v"=="v") {
element.onpropertychange = webChange;
}else{
element.addEventListener("input",webChange,false);
}
function webChange(){
if(element.value){document.getElementById("add10").innerHTML = element.value};
}
}
function add10(){
   document.getElementById("num_dig").value='10';
}

function add50(){
   document.getElementById("num_dig").value='50';
}

function add100(){
   document.getElementById("num_dig").value='100';
}

function add200(){
   document.getElementById("num_dig").value='200';
}

