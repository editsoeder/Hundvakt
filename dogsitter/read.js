fetch("dogsitter.json")
.then(response => response.json())
.then(json => data(json));
// .then(json => console.log(json));


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



document.getElementById("low").addEventListener("click", function () {
  //Sortera lägst pris först
  
})


function data(json) {
  
  // let data = JSON.stringify(json);
  // listcards.innerHTML = data;

 //     <div class='one'>
        //     <img src='' alt='Profil picture'>
        //     <p>{$foundDogSitter['first_name']}</p>
        //     <p>Tillgänglig i områden: {$areas}</p>
        //     <p>Tillgänglig dagar: {$days}</p>
        //     <p>Timkostnad: {$foundDogSitter['cost']}</p>
        // </div>

        // <div class='two'>
        //     <p>Kontaktas via:</p>
        //     <p>{$foundDogSitter['email']}</p>
        // </div>

        // <div class='three'>
        //     <p>Bra att veta:</p>
        //     <p>{$foundDogSitter['extra_info']}</p>
        // </div>
  // return json;

 
   

    

        let div = "<a href='read.php?id='>Läs mer</a>";
       
      
    
    

  
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


    // a = '<a href="read.php?id="${json[i].id_sitter}">Läs mer</a>"';

  }
  // console.log(json.first_name);

  document.getElementById("high").addEventListener("click", function () {
    //Sortera högst pris först
    // array.sort((a,b) => a.release > b.release);
    let hej = json.sort((a,b) => a.cost <  b.cost);
    // console.log(hej);
  })
}
// console.log(json.first_name);