<tr class="form-field">
    <th scope="row" valign="top"><label><?php _e('SortID', UT_THEME_NAME) ?></label></th>
    <td>
        <input type="text" name="SortID" value="<?php if (isset($term->SortID)) echo $term->SortID; ?>"><br/>
        <span class="description">Sorting ID</span>
    </td>
</tr>