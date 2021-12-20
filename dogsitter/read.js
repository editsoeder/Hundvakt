{/* <div class="dropdown">
  <button onclick="myFunction()" class="dropbtn">Dropdown</button>
  <div id="myDropdown" class="dropdown-content"> */}
    {/* <input type="text" placeholder="Search.." id="myInput" onkeyup="filterFunction()"> */}
    {/* <a href="#about">About</a>
    <a href="#base">Base</a>
    <a href="#blog">Blog</a>
    <a href="#contact">Contact</a>
    <a href="#custom">Custom</a>
    <a href="#support">Support</a>
    <a href="#tools">Tools</a>
  </div>
</div>; */}


// function myFunction() {
//   document.getElementById("myDropdown").classList.toggle("show");
// }

// function filterFunction() {
//   var input, filter, ul, li, a, i;
//   input = document.getElementById("myInput");
//   filter = input.value.toUpperCase();
//   let div = document.getElementById("myDropdown");
//   let a = div.getElementsByTagName("a");
//   for (i = 0; i < a.length; i++) {
//     txtValue = a[i].textContent || a[i].innerText;
//     if (txtValue.toUpperCase().indexOf(filter) > -1) {
//       a[i].style.display = "";
//     } else {
//       a[i].style.display = "none";
//     }
//   }
// }


function hello() {
  let a = document.createElement("div");
  a.innerHTML = "HEJ HEJ HEJ";
    return a;
}

document.body.append(hello());
// console.log("HEJDÅ");