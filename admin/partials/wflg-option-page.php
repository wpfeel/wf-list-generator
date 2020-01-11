<?php

//setting options class initialize
$settings = new WFLG_Settings();
$tabs = $settings->wflg_get_options_tabs();

?>
<style>
    .wflg-nav-tab-wrapper a:focus {
        outline: none;
        box-shadow: none;
    }
</style>
<div class="wrap">
    <h1>WF List Generator</h1>
    <nav>
        <div class="nav nav-tabs nav-tab-wrapper wflg-nav-tab-wrapper" id="nav-tab" role="tablist">
            <?php
            foreach ($tabs as $tab) {

                ?>
                <a href="#<?php echo $tab['slug']; ?>" class="<?php echo wflg_array_separator(' ', $tab['class']); ?>"
                   data-toggle="tab" role="tab" aria-selected="true"><?php echo $tab['title']; ?></a>
                <?php
            }
            ?>

        </div>
    </nav>

    <form method="post" action="" novalidate="novalidate">
        <div class="tab-content">
            <div class="tab-pane active" id="general">
                <table class="form-table" role="presentation">
                    <tr>
                        <th scope="row"><label for="wflg_layout">Layout</label></th>
                        <td>
                            <select name="wflg_layout" id="wflg_layout">
                                <option selected="selected" value="default">Default</option>
                                <option value="classic">Classic</option>
                                <option value="modern">Modern</option>
                            </select>
                            <p class="description"><?php echo sprintf(__('%s', 'wf-list-generator'), 'Select layout design to change the view.'); ?></p>
                        </td>
                    </tr>

                    <tr>
                        <th scope="row"><label for="wflg_gen_entry_perpage">Entry Per Page</label></th>
                        <td>
                            <input name="wflg_gen_entry_perpage" type="text" id="wflg_gen_entry_perpage" value="10"
                                   class="regular-text">
                            <p class="description"><?php echo sprintf(__('%s', 'wf-list-generator'), 'Number of items will display per page.'); ?></p>
                        </td>
                    </tr>

                    <tr>
                        <th scope="row"><label for="wflg_display_role">Display Role</label></th>
                        <td>
                            <select name="wflg_display_role" id="wflg_display_role">
                                <option selected="selected" value="administrator">Administrator</option>
                                <option value="author">Author</option>
                                <option value="contributor">Contributor</option>
                                <option value="editor">Editor</option>
                                <option value="subscriber">Subscriber</option>
                            </select>
                            <p class="description"><?php echo sprintf(__('%s', 'wf-list-generator'), 'Choose capable role to show all list'); ?></p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="wflg_show_del_btn">Show Delete Button</label></th>
                        <td>
                            <input name="wflg_show_del_btn" type="checkbox" id="wflg_show_del_btn" value="1">
                            <p class="description"><?php echo sprintf(__('%s', 'wf-list-generator'), 'Select to show delete button in lists.'); ?></p>
                        </td>
                    </tr>


                </table>
            </div>

            <div class="tab-pane" id="page">
                <h2>Page Title</h2>
            </div>

            <div class="tab-pane" id="post">
                <h2>Post Title</h2>
            </div>

            <div class="tab-pane" id="author">
                <h2>Author Title</h2>
            </div>

            <?php submit_button('Save Changes', 'button button-primary', 'wflg-settings'); ?>
        </div>
    </form>


</div>

