jQuery(document).ready(function ($) {
   $(".prev-link, .next-link").on("click", function () {
      var postId = $(this).data("post-id");

      if (postId) {
         $.ajax({
            type: "POST",
            url: ajaxurl,
            data: {
               action: "get_lightbox_content",
               post_id: postId,
            },
            success: function (response) {
               // Mettre à jour la lightbox avec les données reçues dans la réponse
               if (response) {
                  console.log(response);
                  // Mettre à jour l'image
                  $(".lightbox_container img").attr("src", response.image_url + "?nocache=" + new Date().getTime());
                  // var image = $(".lightbox_container img");

                  // image.off("load").off("error");
                  // image
                  //    .on("load", function () {
                  //       console.log("Image chargée avec succès");
                  //    })
                  //    .on("error", function () {
                  //       console.error("Erreur lors du chargement de l'image");
                  //    });

                  // // Mettre à jour la référence du champ ACF
                  $(".lightbox_info span:first-child").text(response.ref_photo);

                  // Mettre à jour la taxonomie "categorie"
                  $(".lightbox_info .categ").text(response.categories);

                  $(".lightbox").attr("id", "lightbox_" + postId);
               }
            },
            error: function (error) {
               console.error(error);
            },
         });
      }
   });
});
