fetch("dogsitter.json")
.then(response => response.json())
.then(json => console.log(json));

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


document.getElementById("high").addEventListener("click", function () {
  //Sortera högst pris först
  // array.sort((a,b) => a.release > b.release);
  // json.sort((a,b) => a.release > b.release);
})

document.getElementById("low").addEventListener("click", function () {
  //Sortera lägst pris först
  
})


