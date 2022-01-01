"use strict";

fetch("../dogsitter/dogsitter.json")
.then(response => response.json())
.then(json => data(json));

let downOne = document.createElement("div");
let downTwo = document.createElement("div");
let downThree = document.createElement("div");

let buttonOne = document.createElement("button");
let dropdownContentOne = document.createElement("div");
buttonOne.className = "dropbtnOne";
buttonOne.id = "dropBtn";
buttonOne.innerHTML = "Sortera efter pris";
dropdownContentOne.className = "dropDownContent";
dropdownContentOne.id = "dropOne";
dropdownContentOne.innerHTML = " <a id='high'>Högst först</a> <a id ='low'>Lägst först</a> ";

let buttonTwo = document.createElement("button");
let dropdownContentTwo = document.createElement("div");
buttonTwo.className = "dropbtnTwo";
buttonTwo.id = "dropBtn";
buttonTwo.innerHTML = "Sortera efter dagar";
dropdownContentTwo.className = "dropContent";
dropdownContentTwo.id = "dropTwo";
dropdownContentTwo.innerHTML = " <a id='monday'>Måndag</a> <a id ='tuesday'>Tisdag</a> <a id ='wednesday'>onsdag</a> <a id ='thursday'>Torsdag</a> <a id ='friday'>Fredag</a> <a id ='saturday'>Lördag</a> <a id ='sunday'>Söndag</a>";

let buttonThree = document.createElement("button");
let dropdownContentThree = document.createElement("div");
buttonThree.className = "dropbtnThree";
buttonThree.id = "dropBtn";
buttonThree.innerHTML = "Sortera efter område";
dropdownContentThree.className = "downContent";
dropdownContentThree.id = "dropThree";
dropdownContentThree.innerHTML = " <a id='fosie'>Fosie</a> <a id='hyllie'>Hyllie</a> <a id='husie'>Husie</a> <a id='kirseberg'>Kirseberg</a> <a id='limhamn'>Limhamn-Bunkeflo</a> <a id='malmo'>Malmö Centrum</a> <a id='oxie'>Oxie</a> <a id='rosengard'>Rosengård</a> <a id='sodra'>Södra Innerstad</a> <a id='vastra'>Västra Innerstad</a> ";

downOne.append(buttonOne, dropdownContentOne);
downTwo.append(buttonTwo, dropdownContentTwo);
downThree.append(buttonThree, dropdownContentThree);

document.getElementById("filterOwner").append(downOne, downTwo, downThree);

buttonOne.addEventListener('click', function(){
  this.classList.toggle("active");
  document.getElementById("dropOne").classList.toggle("show");
});

buttonTwo.addEventListener('click', function(){
  this.classList.toggle("active");
  document.getElementById("dropTwo").classList.toggle("show");
});

buttonThree.addEventListener('click', function(){
  this.classList.toggle("active");
  document.getElementById("dropThree").classList.toggle("show");
});

function data(json) {

  function cards(array) {
    document.querySelector(".list").innerHTML = "";

    if (array.length == 0) {
      alert("Finns inga hundvakter utefter ditt önskemål");
    } 

    for (let i = 0; i < array.length; i++) {
      let listcards = document.createElement("div");
      let image = document.createElement("img");
      image.id = "listImage";
      let name = document.createElement("p");
      let areas = document.createElement("p");
      let days = document.createElement("p");
      let cost = document.createElement("p");
      let a = document.createElement("a");

      for (let ii = 0; ii < array[i].days.length; ii++) {
        let day = document.createElement("div");
        day.innerHTML = array[i].days[ii];
        days.append(day);
      }  

      name.innerHTML = array[i].first_name;
      areas.innerHTML = array[i].location;
      cost.innerHTML = array[i].cost;
      image.src = "../userImages/" + array[i].image;
      a.innerHTML = "Läs mer";
      a.href = "read.php?id=" + array[i].id_sitter;

      listcards.append(name, areas, days, cost, image, a);
      document.querySelector(".list").append(listcards);
    }
  }

  //Sortera högst pris först
  document.getElementById("high").addEventListener("click", function () {
    let highest = json.sort((a,b) => b.cost - a.cost);

    cards(highest);
  });

  //Sortera lägst pris först
  document.getElementById("low").addEventListener("click", function () {
    let lowest = json.sort((a,b) => a.cost - b.cost);

    cards(lowest);
  });

  //Sortera dagar
  document.querySelector("#monday").addEventListener("click", function () {
    let array = [];

    for (let i = 0; i < json.length; i++) {
      if (json[i].days.includes("Måndag")) {
          array.push(json[i]);
      } 
    }

    cards(array);
  });

  //Sortera dagar
  document.querySelector("#tuesday").addEventListener("click", function () {
    let array = [];

    for (let i = 0; i < json.length; i++) {
      if (json[i].days.includes("Tisdag")) {
        array.push(json[i]);  
      } 
    }

    cards(array);
  });

  //Sortera dagar
  document.querySelector("#wednesday").addEventListener("click", function () {
    let array = [];

    for (let i = 0; i < json.length; i++) {
      if (json[i].days.includes("Onsdag")) {
        array.push(json[i]);
      } 
     
    }

    cards(array);
  });
  //Sortera dagar
  document.querySelector("#thursday").addEventListener("click", function () {
    let array = [];

    for (let i = 0; i < json.length; i++) {
      
      if (json[i].days.includes("Torsdag")) {
        array.push(json[i]);
      } 
    }

    cards(array);
  });

  //Sortera dagar
  document.querySelector("#friday").addEventListener("click", function () {
    let array = [];

    for (let i = 0; i < json.length; i++) {
      
      if (json[i].days.includes("Fredag")) {
        array.push(json[i]);
      } 
    }

    cards(array);
  });

  //Sortera dagar
  document.querySelector("#saturday").addEventListener("click", function () {
    let array = [];

    for (let i = 0; i < json.length; i++) {
      
      if (json[i].days.includes("Lördag")) {
        array.push(json[i]);
      } 
    }

    cards(array);
  });

  //Sortera dagar
  document.querySelector("#sunday").addEventListener("click", function () {
    let array = [];

    for (let i = 0; i < json.length; i++) {
      if (json[i].days.includes("Söndag")) {
        array.push(json[i]);
      }
    }

    cards(array);
  });

  //Sortera område
  document.querySelector("#fosie").addEventListener("click", function () {
    let array = [];

    for (let i = 0; i < json.length; i++) {
      if (json[i].location.includes("Fosie")) {
        array.push(json[i]);
      }
    }

    cards(array);
  });

  //Sortera område
  document.querySelector("#hyllie").addEventListener("click", function () {
    let array = [];

    for (let i = 0; i < json.length; i++) {
      if (json[i].location.includes("Hyllie")) {
        array.push(json[i]);
      }
    }

    cards(array);
  });

  //Sortera område
  document.querySelector("#husie").addEventListener("click", function () {
    let array = [];

    for (let i = 0; i < json.length; i++) {
      if (json[i].location.includes("Husie")) {
        array.push(json[i]);
      }
    }

    cards(array);
  });

  //Sortera område
  document.querySelector("#kirseberg").addEventListener("click", function () {
    let array = [];

    for (let i = 0; i < json.length; i++) {
      if (json[i].location.includes("Kirseberg")) {
        array.push(json[i]);
      }
    }

    cards(array);
  });

  //Sortera område
  document.querySelector("#limhamn").addEventListener("click", function () {
    let array = [];

    for (let i = 0; i < json.length; i++) {
      if (json[i].location.includes("Limhamn-Bunkeflo")) {
        array.push(json[i]);
      }
    }

    cards(array);
  });

  //Sortera område
  document.querySelector("#malmo").addEventListener("click", function () {
    let array = [];

    for (let i = 0; i < json.length; i++) {
      if (json[i].location.includes("Malmö Centrum")) {
        array.push(json[i]);
      }
    }

    cards(array);
  });

  //Sortera område
  document.querySelector("#oxie").addEventListener("click", function () {
    let array = [];

    for (let i = 0; i < json.length; i++) {
      if (json[i].location.includes("Oxie")) {
        array.push(json[i]);
      }
    }

    cards(array);
  });

  //Sortera område
  document.querySelector("#rosengard").addEventListener("click", function () {
    let array = [];

    for (let i = 0; i < json.length; i++) {
      if (json[i].location.includes("Rosengård")) {
        array.push(json[i]);
      }
    }

    cards(array);
  });

  //Sortera område
  document.querySelector("#sodra").addEventListener("click", function () {
    let array = [];

    for (let i = 0; i < json.length; i++) {
      if (json[i].location.includes("Södra Innerstad")) {
        array.push(json[i]);
      }
    }

    cards(array);
  });

  //Sortera område
  document.querySelector("#vastra").addEventListener("click", function () {
    let array = [];

    for (let i = 0; i < json.length; i++) {
      if (json[i].location.includes("Västra Innerstad")) {
        array.push(json[i]);
      }
    }

    cards(array);
  });

  cards(json);
}