fetch("dogsitter.json")
.then(response => response.json())
.then(json => data(json));

 


let button = document.createElement("button");
let dropdownContent = document.createElement("div");
button.className = "dropbtn";
button.innerHTML = "Sortera efter";
dropdownContent.className = "dropdown-content";
dropdownContent.id = "myDropdown";
dropdownContent.innerHTML = " <a id='high'>Högst först</a> <a id ='low'>Lägst först</a> ";

document.getElementById("filter").append(button, dropdownContent);
button.addEventListener('mouseover', function(){
  document.getElementById("myDropdown").classList.toggle("show");
});



// document.getElementById("low").addEventListener("click", function () {
//   //Sortera lägst pris först
//   let hej = json.sort((a,b) => a.cost > b.cost);

  
// })




function data(json) {
  document.getElementById("low").addEventListener("click", function () {
    //Sortera lägst pris först
    let lowest = json.sort((a,b) => a.cost > b.cost);
    document.querySelector(".list").innerHTML = "";

    for (let i = 0; i < lowest.length; i++) {
      let listcards = document.createElement("div");
      let image = document.createElement("img");
      let name = document.createElement("p");
      let areas = document.createElement("p");
      let days = document.createElement("p");
      let cost = document.createElement("p");
      let a = document.createElement("a");
      listcards.append(name, areas, days, cost, image, a);
      document.querySelector(".list").append(listcards);
      // console.log(json[i].first_name);
      name.innerHTML = lowest[i].first_name;
      areas.innerHTML = lowest[i].areas;
      days.innerHTML = lowest[i].days;
      cost.innerHTML = lowest[i].cost;
      // image.innerHTML = json[i].image;
      a.innerHTML = "Läs mer";
      a.href = "read.php?id=" + lowest[i].id_sitter;
    }
  });
  
  
  for (let i = 0; i < json.length; i++) {
    let listcards = document.createElement("div");
    let image = document.createElement("img");
    let name = document.createElement("p");
    let areas = document.createElement("p");
    let days = document.createElement("p");
    let cost = document.createElement("p");
    let a = document.createElement("a");
    listcards.append(name, areas, days, cost, image, a);
    document.querySelector(".list").append(listcards);
    // console.log(json[i].first_name);
    name.innerHTML = json[i].first_name;
    areas.innerHTML = json[i].areas;
    days.innerHTML = json[i].days;
    cost.innerHTML = json[i].cost;
    // image.innerHTML = json[i].image;
    a.innerHTML = "Läs mer";
    a.href = "read.php?id=" + json[i].id_sitter;


    // a.innerText = '<a href=read.php?id= '+ json[i].id_sitter>"Läs mer"</a>';

  }
  // console.log(json.first_name);

  document.getElementById("high").addEventListener("click", function () {
    //Sortera högst pris först
    let hej = json.sort((a,b) => a.cost <  b.cost);
    console.log(hej);
    const array = JSON.stringify(hej);


  })
}
// console.log(json.first_name);