<form id="dropdown" class="dropdown" action="" method="POST">
    <div class="dropdown_categories">
        <select class="dropdown_btn" id="categorie" name="categories">
            <option class="dropdown_btn_list" value="">Catégories</option>
            <?php
            $selected_category = isset($_POST['categories']) ? $_POST['categories'] : ''; // Récupère la valeur sélectionnée, si elle existe

            $category_terms = get_terms('categorie');
            foreach ($category_terms as $term_cat) {
                $selected = ($term_cat->slug == $selected_category) ? 'selected' : '';
                echo '<option class="dropdown_btn_list" value="' . $term_cat->slug . '" ' . $selected . '>' . $term_cat->name . '</option>';
            }
            ?>
        </select>
    </div>
    <div class="dropdown_format">
        <select class="dropdown_btn" id="format" name="formats">
            <option class="dropdown_btn_list" value="">Format</option>
            <?php
            $selected_format = isset($_POST['formats']) ? $_POST['formats'] : ''; // Récupère la valeur sélectionnée, si elle existe

            $format_terms = get_terms('format');
            foreach ($format_terms as $term_form) {
                $selected = ($term_form->slug == $selected_format) ? 'selected' : '';
                echo '<option class="dropdown_btn_list" value="' . $term_form->slug . '" ' . $selected . '>' . $term_form->name . '</option>';
            }
            ?>
        </select>
    </div>
    <div class="dropdown_sortby">
        <select class="dropdown_btn" id="sortby" name="sortby">
            <?php
            $select_sortby = isset($_POST['sortby']) ? $_POST['sortby'] : '';
            ?>
            <option class="dropdown_btn_list" value="" <?php echo ($select_sortby == '') ? 'selected' : ''; ?>>Trier par </option>
            <option class="dropdown_btn_list" value="ASC" <?php echo ($select_sortby == 'ASC') ? 'selected' : ''; ?>>Du plus récent au plus ancien</option>
            <option class="dropdown_btn_list" value="DESC" <?php echo ($select_sortby == 'DESC') ? 'selected' : ''; ?>>Du plus ancien au plus récent</option>
        </select>
    </div>
</form>