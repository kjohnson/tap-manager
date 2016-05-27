<?php if ( ! defined( 'ABSPATH' ) ) exit;

final class TapManager_Admin_Menu extends TapManager_Classes_Menu
{
    public $page_title = 'Beer on Tap';

    public $icon_url = 'dashicons-clipboard';

    public $position = '26';

    public function display()
    {
        ?><div class="wrap"><?
        // TODO: Implement display() method.
        do_meta_boxes( $this->menu_slug, 'normal', NULL );
        do_meta_boxes( $this->menu_slug, 'advanced', NULL );
        ?></div><?
    }
}