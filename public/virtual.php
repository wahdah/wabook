<?php

class FakePages {

    public function __construct() {
        add_filter( 'the_posts', array( $this, 'fake_pages' ) );
    }

    /**
     * Internally registers pages we want to fake. Array key is the slug under which it is being available from the frontend
     * @return mixed
     */
    private static function get_fake_pages() {

        $fake_pages['details'] = array(
            'title'   => 'Book Details',
            'content' => '[booking_details]'
        );
		 $fake_pages['payment'] = array(
            'title'   => 'Payment',
            'content' => '[payment]'
        );
		 $fake_pages['history'] = array(
            'title'   => 'History',
            'content' => '[booklist]'
        );
		 $fake_pages['viewhistory'] = array(
            'title'   => 'History Details',
            'content' => '[view_book_details]'
        );
		 $fake_pages['thankyou'] = array(
            'title'   => 'Thank You',
            'content' => '[thankU]'
        );
		$fake_pages['profile'] = array(
            'title'   => 'Profile',
            'content' => '[profile]'
        );

        return $fake_pages;
    }

    /**
     * Fakes get posts result
     *
     * @param $posts
     *
     * @return array|null
     */
    public function fake_pages( $posts ) {
        global $wp, $wp_query;
        $fake_pages       = self::get_fake_pages();
        $fake_pages_slugs = array();
        foreach ( $fake_pages as $slug => $fp ) {
            $fake_pages_slugs[] = $slug;
        }
        if ( true === in_array( strtolower( $wp->request ), $fake_pages_slugs )
             || ( true === isset( $wp->query_vars['page_id'] )
                  && true === in_array( strtolower( $wp->query_vars['page_id'] ), $fake_pages_slugs )
            )
        ) {
            if ( true === in_array( strtolower( $wp->request ), $fake_pages_slugs ) ) {
                $fake_page = strtolower( $wp->request );
            } else {
                $fake_page = strtolower( $wp->query_vars['page_id'] );
            }
            $posts                  = null;
            $posts[]                = self::create_fake_page( $fake_page, $fake_pages[ $fake_page ] );
            $wp_query->is_page      = true;
            $wp_query->is_singular  = true;
            $wp_query->is_home      = false;
            $wp_query->is_archive   = false;
            $wp_query->is_category  = false;
            $wp_query->is_fake_page = true;
            $wp_query->fake_page    = $wp->request;
            //Longer permalink structures may not match the fake post slug and cause a 404 error so we catch the error here
            unset( $wp_query->query["error"] );
            $wp_query->query_vars["error"] = "";
            $wp_query->is_404              = false;
        }

        return $posts;
    }

    /**
     * Creates virtual fake page
     *
     * @param $pagename
     * @param $page
     *
     * @return stdClass
     */
    private static function create_fake_page( $pagename, $page ) {
        $post                 = new stdClass;
        $post->post_author    = 1;
        $post->post_name      = $pagename;
        $post->guid           = get_bloginfo( 'wpurl' ) . '/' . $pagename;
        $post->post_title     = $page['title'];
        $post->post_content   = $page['content'];
        $post->ID             = - 1;
        $post->post_status    = 'static';
        $post->comment_status = 'closed';
        $post->ping_status    = 'closed';
        $post->comment_count  = 0;
        $post->post_date      = current_time( 'mysql' );
        $post->post_date_gmt  = current_time( 'mysql', 1 );

        return $post;
    }
}

new FakePages();