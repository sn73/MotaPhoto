<form id="dropdown" class="dropdown" action="" method="POST">
    <div class="dropdown_categories">
        <ul class="dropdown_btn" id="categorie" data-value="" name="categories">
            <div>
                <span class="dropdown_btn_text">Catégories</span>
                <i class="fa-solid fa-chevron-down" style="color: #000000;"></i>
            </div>
            <li class="dropdown_btn_list" data-value="">Catégories</li>
            <?php
            $selected_category = isset($_POST['categories']) ? $_POST['categories'] : ''; // Récupère la valeur sélectionnée, si elle existe

            $category_terms = get_terms('categorie');
            foreach ($category_terms as $term_cat) {
                $selected = ($term_cat->slug == $selected_category) ? 'selected' : '';
                echo '<li class="dropdown_btn_list" data-value="' . $term_cat->slug . '" ' . $selected . '>' . $term_cat->name . '</li>';
            }
            ?>
        </ul>
    </div>
    <div class="dropdown_format">
        <ul class="dropdown_btn" id="format" value="" name="formats"><span class="dropdown_btn_text">Formats</span> <i class="fa-solid fa-chevron-down" style="color: #000000;"></i>
            <li class="dropdown_btn_list" data-value="">Formats</li>
            <?php
            $selected_format = isset($_POST['formats']) ? $_POST['formats'] : ''; // Récupère la valeur sélectionnée, si elle existe

            $format_terms = get_terms('format');
            foreach ($format_terms as $term_form) {
                $selected = ($term_form->slug == $selected_format) ? 'selected' : '';
                echo '<li class="dropdown_btn_list" data-value="' . $term_form->slug . '" ' . $selected . '>' . $term_form->name . '</li>';
            }
            ?>
        </ul>
    </div>
    <div class="dropdown_sortby">
        <ul class="dropdown_btn" id="sortby" value="" name="sortby"><span class="dropdown_btn_text">Trier par</span> <i class="fa-solid fa-chevron-down" style="color: #000000;"></i>
            <li class="dropdown_btn_list" data-value="">Trier par</li>
            <?php
            $select_sortby = isset($_POST['sortby']) ? $_POST['sortby'] : '';
            ?>
            <li class="dropdown_btn_list" data-value="ASC" <?php echo ($select_sortby == 'ASC') ? 'selected' : ''; ?>>Du plus récent au plus ancien</li>
            <li class="dropdown_btn_list" data-value="DESC" <?php echo ($select_sortby == 'DESC') ? 'selected' : ''; ?>>Du plus ancien au plus récent</li>
        </ul>
    </div>
</form>