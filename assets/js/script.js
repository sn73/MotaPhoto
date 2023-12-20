/* Fonction liste déroulante catégories */
function categoriesDropdown() {
    var dropdown = document.querySelector(".categories-dropdown ul");
    dropdown.style.display = dropdown.style.display === "none" || dropdown.style.display === "" ? "block" : "none";
 }
 
 function selectcat(option) {
    document.querySelector(".categories-dropdown button").innerText = option;
    categoriesDropdown(); // Ferme la liste déroulante après la sélection
 }
 /* Fonction liste déroulante format */
 function formatDropdown() {
    var dropdown = document.querySelector(".format-dropdown ul");
    dropdown.style.display = dropdown.style.display === "none" || dropdown.style.display === "" ? "block" : "none";
 }
 
 function selectformat(option) {
    document.querySelector(".format-dropdown button").innerText = option;
    formatDropdown(); // Ferme la liste déroulante après la sélection
 }
 /* Fonction liste déroulante trier par */
 function sortbyDropdown() {
    var dropdown = document.querySelector(".sortby-dropdown ul");
    dropdown.style.display = dropdown.style.display === "none" || dropdown.style.display === "" ? "block" : "none";
 }
 
 function selectsortby(option) {
    document.querySelector(".sortby-dropdown button").innerText = option;
    sortbyDropdown(); // Ferme la liste déroulante après la sélection
 }
