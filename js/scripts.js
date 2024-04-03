// Get navbar and navbar toggle button elements
const navbar = document.getElementById("navbar");
const navbarToggle = navbar.querySelector(".navbar-toggle");

// Function to open mobile navbar
function openMobileNavbar() {
  navbar.classList.add("opened");
  navbarToggle.setAttribute("aria-expanded", "true");
}

// Function to close mobile navbar
function closeMobileNavbar() {
  navbar.classList.remove("opened");
  navbarToggle.setAttribute("aria-expanded", "false");
}

// Event listener for navbar toggle button
navbarToggle.addEventListener("click", () => {
  if (navbar.classList.contains("opened")) {
    closeMobileNavbar();
  } else {
    openMobileNavbar();
  }
});

// Get navbar menu and links container elements
const navbarMenu = navbar.querySelector("#navbar-menu");
const navbarLinksContainer = navbar.querySelector(".navbar-links");

// Event listener to stop propagation of click events in navbar links container
navbarLinksContainer.addEventListener("click", (clickEvent) => {
  clickEvent.stopPropagation();
});

// Event listener to close mobile navbar when navbar menu is clicked
navbarMenu.addEventListener("click", closeMobileNavbar);

// Function to confirm deletion
function confirmDelete() {
  if (confirm('Are you sure you want to delete this?') == true) {
    return true;
  }
  else {
    return false;
  }
}

// Function to toggle password visibility
function togglePassword() {
  let pwInput = document.getElementById('password');
  let img = document.getElementById('showHide');

  if (pwInput.type == 'password') {
    pwInput.type = 'text';
    img.src = 'img/hide.png';
  }
  else {
    pwInput.type = 'password';
    img.src = 'img/show.png';
  }
}

// Function to compare passwords
function comparePasswords() {
  let password = document.getElementById('password').value;
  let confirm = document.getElementById('confirm').value;
  let pwErr = document.getElementById('pwErr');

  if (password != confirm) {
    pwErr.innerText = 'Passwords do not match';
    return false;
  }
  else {
    pwErr.innerText = '';
    return true;
  }
}