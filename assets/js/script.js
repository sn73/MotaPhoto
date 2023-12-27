/* Fonction liste déroulante catégories */
function categoriesDropdown() {
   var dropdown = document.querySelector(".dropdown_categories ul");
   dropdown.style.display = dropdown.style.display === "none" || dropdown.style.display === "" ? "block" : "none";
}

function selectcat(option) {
   document.querySelector(".dropdown_categories button").innerText = option;
   categoriesDropdown(); // Ferme la liste déroulante après la sélection
}
/* Fonction liste déroulante format */
function formatDropdown() {
   var dropdown = document.querySelector(".dropdown_format ul");
   dropdown.style.display = dropdown.style.display === "none" || dropdown.style.display === "" ? "block" : "none";
}

function selectformat(option) {
   document.querySelector(".dropdown_format button").innerText = option;
   formatDropdown(); // Ferme la liste déroulante après la sélection
}
/* Fonction liste déroulante trier par */
function sortbyDropdown() {
   var dropdown = document.querySelector(".dropdown_sortby ul");
   dropdown.style.display = dropdown.style.display === "none" || dropdown.style.display === "" ? "block" : "none";
}

function selectsortby(option) {
   document.querySelector(".dropdown_sortby button").innerText = option;
   sortbyDropdown(); // Ferme la liste déroulante après la sélection
}

// Gestion évenement clic bouton contact

document.addEventListener("DOMContentLoaded", function () {
   let btn_menu = document.getElementById("menu-item-107");
   let popup_contact = document.querySelector(".popup");
   let main = document.querySelector("main");

   btn_menu.addEventListener("click", function (event) {
      popup_contact.style.display = "block";

      // Empêcher la propagation du clic à l'extérieur de la popup
      event.stopPropagation();
   });

   document.addEventListener("click", function (event) {
      // Vérifier si le clic s'est produit à l'extérieur de la popup
      if (!popup_contact.contains(event.target) && popup_contact.style.display === "block") {
         popup_contact.style.display = "none";
      }
   });
});

document.addEventListener("DOMContentLoaded", function () {
   // Vérifiez si la classe main contient "single-page"
   const mainElement = document.querySelector("main");
   if (mainElement.classList.contains("single-page")) {
      let btn_cta_order = document.querySelector(".cta_order");
      let popup_contact = document.querySelector(".popup");

      btn_cta_order.addEventListener("click", function (event) {
         popup_contact.style.display = "block";
         event.stopPropagation();
      });

      document.addEventListener("click", function (event) {
         if (!popup_contact.contains(event.target) && popup_contact.style.display === "block") {
            popup_contact.style.display = "none";
         }
      });
   }
});

document.addEventListener("DOMContentLoaded", function () {
   let full = document.querySelectorAll(".icon_full");
   let lightbox = document.querySelector(".lightbox");

   full.forEach((e) => {
      e.addEventListener("click", function (event) {
         lightbox.style.display = "flex";

         event.stopPropagation();
      });
   });
   document.addEventListener("click", function (event) {
      if (!lightbox.contains(event.target) && lightbox.style.display === "none") {
         lightbox.style.display = "flex";
      }
   });
});
