let page_single = 1;
document.addEventListener("DOMContentLoaded", function () {
   var mainElement = document.querySelector("main");

   if (mainElement && mainElement.classList.contains("single-page")) {
      let fullIconsSingle = document.querySelectorAll(".icon_full");
      if (fullIconsSingle) {
         lightbox_ajax(fullIconsSingle);
      }
      loadPosts_Single();

      let loadmoresingle = document.getElementById("load-more-single");
      loadmoresingle.addEventListener("click", function () {
         page_single++;
         loadPosts_Single();
      });

      console.log('La page avec la classe "single-page" a exécutez votre script.');
   } else {
      console.log("La page ne correspond pas aux critères.");
   }
});


function loadPosts_Single() {
   let url = ajaxurl + "?action=loadPosts_Single&page=" + page_single;
   console.log(url);
   
   fetch(url, {
      method: "POST",
      headers: {
         "X-Requested-With": "XMLHttpRequest",
      },
   })
   .then((response) => response.json())
   .then((single) => {
      // console.log("max", data.max);
      document.getElementById("images-container").innerHTML = single.content;
      if (single.max == 1) {
         document.getElementById("load-more-single").style.display = "none";
      } else {
         document.getElementById("load-more-single").style.display = "block";
      }
      
      let fullIcons_single = document.querySelectorAll(".icon_full");
      if (fullIcons_single) {
         lightbox_ajax(fullIcons_single);
      }
   })
   .catch((error) => console.error("Erreur lors de la requête AJAX:", error));
}
