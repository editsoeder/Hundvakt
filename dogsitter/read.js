let hej = <div class="dropdown">
  <button onclick="myFunction()" class="dropbtn">Dropdown</button>
  <div id="myDropdown" class="dropdown-content">
    {/* <input type="text" placeholder="Search.." id="myInput" onkeyup="filterFunction()"> */}
    <a href="#about">About</a>
    <a href="#base">Base</a>
    <a href="#blog">Blog</a>
    <a href="#contact">Contact</a>
    <a href="#custom">Custom</a>
    <a href="#support">Support</a>
    <a href="#tools">Tools</a>
  </div>
</div>

document.body.append(hej);
console.log("hej");

function hello() {
    return console.log("hej");
}


function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

function filterFunction() {
//   var input, filter, ul, li, a, i;
//   input = document.getElementById("myInput");
//   filter = input.value.toUpperCase();
  let div = document.getElementById("myDropdown");
  let a = div.getElementsByTagName("a");
  for (i = 0; i < a.length; i++) {
    txtValue = a[i].textContent || a[i].innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      a[i].style.display = "";
    } else {
      a[i].style.display = "none";
    }
  }
}
