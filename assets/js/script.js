// FONCTION POUR L'OUVERTURE DE LA POP-UP CONTACT DE L'ACCUEIL

document.addEventListener("DOMContentLoaded", function () {
   let btn_menu = document.getElementById("menu-item-107");
   let popup_contact = document.querySelector(".popup");
   let main = document.querySelector("main");

   btn_menu.addEventListener("click", function (event) {
      popup_contact.style.display = "block";
      main.classList.add("blur_main");
      // Empêcher la propagation du clic à l'extérieur de la popup
      event.stopPropagation();
   });

   document.addEventListener("click", function (event) {
      // Vérifier si le clic s'est produit à l'extérieur de la popup
      if (!popup_contact.contains(event.target) && popup_contact.style.display === "block") {
         popup_contact.style.display = "none";
         main.classList.remove("blur_main");
      }
   });
});

// FONCTION POUR L'OUVERTURE DE LA POP-UP CONTACT SUR LA PAGE D'ARTICLE SEUL

document.addEventListener("DOMContentLoaded", function () {
   // Vérifiez si la classe main contient "single-page"
   const mainElement = document.querySelector("main");
   if (mainElement.classList.contains("single-page")) {
      let btn_cta_order = document.querySelector(".cta_order");
      let popup_contact = document.querySelector(".popup");
      let main = document.querySelector("main");

      btn_cta_order.addEventListener("click", function (event) {
         // Récupère la ref de la photo
         var referencePhotoValue = document.querySelector(".ref_form").innerText;
         // Injecter la ref dans le formulaire
         document.querySelector('[name="reference"]').value = referencePhotoValue;

         popup_contact.style.display = "block";
         main.classList.add("blur_main");
         event.stopPropagation();
      });

      document.addEventListener("click", function (event) {
         if (!popup_contact.contains(event.target) && popup_contact.style.display === "block") {
            popup_contact.style.display = "none";
            main.classList.remove("blur_main");
         }
      });
   }
});

// FONCTION POUR L'AFFICHAGE DES LIGHTBOX DU POST CIBLÉ

document.addEventListener("DOMContentLoaded", function () {
   let fullIcons = document.querySelectorAll(".icon_full");

   fullIcons.forEach((fullIcon) => {
      fullIcon.addEventListener("click", function () {
         // Récupérer l'id associé à la lightbox
         let postId = fullIcon.getAttribute("data-post-id");
         let lightboxId = "lightbox_" + postId;
         let lightbox = document.getElementById(lightboxId);
         let close = document.querySelector(".lightbox_close");

         // Afficher la lightbox en plein écran
         if (lightbox) {
            lightbox.style.display = "flex";
         }

         close.classList.toggle("croix");

         document.addEventListener("click", function (event) {
            let close = event.target.closest(".lightbox_close");
            let lightbox_close = event.target.closest(".lightbox");

            if (close && lightbox_close && window.getComputedStyle(lightbox_close).display === "flex") {
               lightbox_close.style.display = "none";
            }
         });
      });
   });
});

document.addEventListener("DOMContentLoaded", function () {
   let btndropdown = document.querySelectorAll(".dropdown_btn");

   btndropdown.forEach((btndrop) => {
      btndrop.addEventListener("click", function () {
         const BlueBorder = btndrop.style.border === "1px solid blue";
         btndrop.style.border = BlueBorder ? "" : "1px solid blue";
      });
   });
});
