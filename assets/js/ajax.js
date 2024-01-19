let page = 1;
document.addEventListener("DOMContentLoaded", function () {
   let fullIcons = document.querySelectorAll(".icon_full");
   if (fullIcons) {
      lightbox_ajax(fullIcons);
   }

   loadPosts();

   let Select = document.querySelectorAll("select");
   Select.forEach((element) => {
      element.addEventListener("change", function () {
         page = 1;
         loadPosts();
      });
   });
   let loadmore = document.getElementById("load-more");
   loadmore.addEventListener("click", function () {
      page++;
      loadPosts();
   });
});

function loadPosts() {
   // Récupère les valeurs du formulaire
   let categories = document.getElementById("categorie").value;
   let formats = document.getElementById("format").value;
   let sortby = document.getElementById("sortby").value;

   // Récupère les paramètres de l'URL actuelle
   // let urlParams = new URLSearchParams(window.location.search);
   // let existingCategories = urlParams.get("categories");
   // let existingFormats = urlParams.get("formats");
   // let existingSortBy = urlParams.get("sortby");

   // Utilise les valeurs du formulaire si elles existent, sinon utilise celles de l'URL
   categories = categories || "";
   formats = formats || "";
   sortby = sortby || "";

   let url = ajaxurl + "?action=loadPosts&page=" + page + "&categories=" + encodeURIComponent(categories) + "&formats=" + encodeURIComponent(formats) + "&sortby=" + encodeURIComponent(sortby);
   console.log(url);

   fetch(url, {
      action: "loadPosts",
      method: "POST",
      headers: {
         "X-Requested-With": "XMLHttpRequest",
         "Content-Type": "application/x-www-form-urlencoded",
      },
      body: new URLSearchParams({
         page: page,
         categories: categories,
         formats: formats,
         sortby: sortby,
      }),
   })
      .then((response) => response.json())
      .then((data) => {
         // console.log("max", data.max);
         document.getElementById("images-container").innerHTML = data.content;
         if (data.max == 1) {
            document.getElementById("load-more").style.display = "none";
         } else {
            document.getElementById("load-more").style.display = "block";
         }

         let fullIcons2 = document.querySelectorAll(".icon_full");
         if (fullIcons2) {
            lightbox_ajax(fullIcons2);
         }
      })
      .catch((error) => console.error("Erreur lors de la requête AJAX:", error));
}

// FONCTION POUR L'AFFICHAGE DE LA LIGHTBOX
function lightbox_ajax(element) {
   element.forEach((fullIcon) => {
      fullIcon.addEventListener("click", function () {
         // Récupérer l'id associé à la lightbox
         let postId = fullIcon.getAttribute("data-post-id");
         let lightboxId = "lightbox_" + postId;
         let lightbox = document.getElementById(lightboxId);

         // Afficher la lightbox en plein écran
         if (lightbox) {
            lightbox.style.display = "flex";
         }

         document.addEventListener("click", function (event) {
            let close = event.target.closest(".lightbox_close");
            let lightbox_close = event.target.closest(".lightbox");

            if (close && lightbox_close && window.getComputedStyle(lightbox_close).display === "flex") {
               lightbox_close.style.display = "none";
            }
         });
      });
   });
   let imgs = document.querySelectorAll(".lightbox_container img");
   let ref_photo = document.querySelectorAll(".ref_photo");
   let categ_photo = document.querySelectorAll(".categ");
   let lightbox = document.querySelectorAll(".lightbox");

   let Dataregroupe = [];

   imgs.forEach((e, index) => {
      let imageSrc = e.src;
      let reference = ref_photo[index].getAttribute("data-ref");
      let category = categ_photo[index].getAttribute("data-categorie");
      let lightboxID = lightbox[index].getAttribute("data-post-id");

      Dataregroupe[index] = {
         imageSrc: imageSrc,
         reference: reference,
         category: category,
         ID_lightbox: lightboxID,
      };
   });
   console.table(Dataregroupe);

   const lightboxSections = document.querySelectorAll(".lightbox");

   let position = 0;
   // Parcourez chaque section de lightbox
   lightboxSections.forEach((lightboxSection) => {
      const fGauche = lightboxSection.querySelector(".arrow_left");
      const fDroite = lightboxSection.querySelector(".arrow_right");

      fGauche.addEventListener("click", function () {
         position--;
         if (position < 0) {
            position = Dataregroupe.length - 1;
         }
         updateArrowsVisibility(position);
         changeContent(position, lightboxSection);
      });

      fDroite.addEventListener("click", function () {
         position++;
         if (position > Dataregroupe.length - 1) {
            position = 0;
         }
         updateArrowsVisibility(position);
         changeContent(position, lightboxSection);
      });

      function updateArrowsVisibility(position) {
         // Mettre à jour la visibilité des flèches en fonction de la position actuelle
         fGauche.style.display = position === 0 ? "none" : "inline-block";
         fDroite.style.display = position === Dataregroupe.length - 1 ? "none" : "inline-block";
      }

      function changeContent(position, lightboxSection) {
         let currentData = Dataregroupe[position];

         // Mise à jour de l'image
         let imglightbox = lightboxSection.querySelector(".lightbox_image");
         if (imglightbox) {
            imglightbox.src = currentData.imageSrc;
            imglightbox.onerror = function () {
               console.error("Erreur lors du chargement de l'image:", currentData.imageSrc);
            };
         }

         // Mise à jour de la référence
         let ref_photos = lightboxSection.querySelectorAll(".ref_photo");
         ref_photos.forEach((ref_photo) => {
            ref_photo.setAttribute("data-ref", currentData.reference);
            ref_photo.innerText = currentData.reference;
         });

         // Mise à jour de la catégorie
         let categ_photos = lightboxSection.querySelectorAll(".categ");
         categ_photos.forEach((categ_photo) => {
            categ_photo.setAttribute("data-categorie", currentData.category);
            categ_photo.innerText = currentData.category;
         });
      }
   });
}
