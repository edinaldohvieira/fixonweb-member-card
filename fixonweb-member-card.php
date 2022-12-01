<?php
/**
 * Plugin Name:     fixonweb-member-card
 * Plugin URI:      https://fixonweb.com.br/plugins/fixonweb-member-card
 * Description:     fixonweb-member-card
 * Author:          fixonweb
 * Author URI:      https://fixonweb.com.br/
 * Text Domain:     fixonwebmembercard
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Fixonweb_Member_Card
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

$fix_path_plugin = plugin_dir_path( __FILE__ );
$plugin_file =  __FILE__ ;

#*******************************
# Ref: fix166941-01-00-cpt
#*******************************

$fix166941cpt['name'] = 'Cartões do Associado';
$fix166941cpt['singular_name'] = 'Cartão do Associado';
$fix166941cpt['menu_name'] = 'Cartão do Associado';
$fix166941cpt['slug'] = 'a6l8mvmn';

add_action( 'init', 'fix166941cpt_start' );
function fix166941cpt_start() {
    global $fix166941cpt;

    register_post_type(
        $fix166941cpt['slug'],
        [
            'labels'                => [
                'name'                  => __( $fix166941cpt['name'], 'fixonwebmembercard' ),
                'singular_name'         => __( $fix166941cpt['singular_name'], 'fixonwebmembercard' ),
                'all_items'             => __( 'All '.$fix166941cpt['name'].'', 'fixonwebmembercard' ),
                'archives'              => __( ''.$fix166941cpt['name'].' Archives', 'fixonwebmembercard' ),
                'attributes'            => __( ''.$fix166941cpt['singular_name'].' Attributes', 'fixonwebmembercard' ),
                'insert_into_item'      => __( 'Insert into '.$fix166941cpt['singular_name'].'', 'fixonwebmembercard' ),
                'uploaded_to_this_item' => __( 'Uploaded to this '.$fix166941cpt['singular_name'].'', 'fixonwebmembercard' ),
                'featured_image'        => _x( 'Featured Image', $fix166941cpt['singular_name'], 'fixonwebmembercard' ),
                'set_featured_image'    => _x( 'Set featured image', $fix166941cpt['singular_name'], 'fixonwebmembercard' ),
                'remove_featured_image' => _x( 'Remove featured image', $fix166941cpt['singular_name'], 'fixonwebmembercard' ),
                'use_featured_image'    => _x( 'Use as featured image', $fix166941cpt['singular_name'], 'fixonwebmembercard' ),
                'filter_items_list'     => __( 'Filter '.$fix166941cpt['name'].' list', 'fixonwebmembercard' ),
                'items_list_navigation' => __( ''.$fix166941cpt['singular_name'].' list navigation', 'fixonwebmembercard' ),
                'items_list'            => __( ''.$fix166941cpt['name'].' list', 'fixonwebmembercard' ),
                'new_item'              => __( 'New '.$fix166941cpt['name'].'', 'fixonwebmembercard' ),
                'add_new'               => __( 'Add New', 'fixonwebmembercard' ),
                'add_new_item'          => __( 'Add New '.$fix166941cpt['singular_name'].'', 'fixonwebmembercard' ),
                'edit_item'             => __( 'Edit '.$fix166941cpt['singular_name'].'', 'fixonwebmembercard' ),
                'view_item'             => __( 'View '.$fix166941cpt['singular_name'].'', 'fixonwebmembercard' ),
                'view_items'            => __( 'View '.$fix166941cpt['name'].'', 'fixonwebmembercard' ),
                'search_items'          => __( 'Search '.$fix166941cpt['name'].'', 'fixonwebmembercard' ),
                'not_found'             => __( 'No '.$fix166941cpt['singular_name'].' found', 'fixonwebmembercard' ),
                'not_found_in_trash'    => __( 'No '.$fix166941cpt['name'].' found in trash', 'fixonwebmembercard' ),
                'parent_item_colon'     => __( 'Parent '.$fix166941cpt['singular_name'].':', 'fixonwebmembercard' ),
                'menu_name'             => __( $fix166941cpt['menu_name'], 'fixonwebmembercard' ),
            ],
            'public'                => false,//true,
            'hierarchical'          => false,
            'show_ui'               => true,
            'show_in_nav_menus'     => false,//true,
            'supports'              => [ 'title', 'revisions'  ],
            'has_archive'           => false,
            'rewrite'               => false,
            'query_var'             => true,
            'menu_position'         => null,
            'menu_icon'             => 'dashicons-admin-post',
            'show_in_rest'          => false,
            'rest_base'             => $fix166941cpt['slug'],
            'rest_controller_class' => 'WP_REST_Posts_Controller',
        ]
    );

}


add_filter( 'post_updated_messages', 'fix166941cpt_post_updated_messages' );
function fix166941cpt_post_updated_messages( $messages ) {
    global $post;

    global $fix166941cpt;
    $slug = $fix166941cpt['slug'];

    $permalink = get_permalink( $post );

    $messages[$slug] = [
        0  => '', // Unused. Messages start at index 1.
        /* translators: %s: post permalink */
        1  => sprintf( __( ''.$fix166941cpt['name'].' updated. <a target="_blank" href="%s">View '.$fix166941cpt['name'].'</a>', 'fincorbus' ), esc_url( $permalink ) ),
        2  => __( 'Custom field updated.', 'fincorbus' ),
        3  => __( 'Custom field deleted.', 'fincorbus' ),
        4  => __( ''.$fix166941cpt['name'].' updated.', 'fincorbus' ),
        /* translators: %s: date and time of the revision */
        5  => isset( $_GET['revision'] ) ? sprintf( __( ''.$fix166941cpt['name'].' restored to revision from %s', 'fincorbus' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false, // phpcs:ignore WordPress.Security.NonceVerification.Recommended
        /* translators: %s: post permalink */
        6  => sprintf( __( ''.$fix166941cpt['name'].' published. <a href="%s">View '.$fix166941cpt['name'].'</a>', 'fincorbus' ), esc_url( $permalink ) ),
        7  => __( ''.$fix166941cpt['name'].' saved.', 'fincorbus' ),
        /* translators: %s: post permalink */
        8  => sprintf( __( ''.$fix166941cpt['name'].' submitted. <a target="_blank" href="%s">Preview '.$fix166941cpt['name'].'</a>', 'fincorbus' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
        /* translators: 1: Publish box date format, see https://secure.php.net/date 2: Post permalink */
        9  => sprintf( __( ''.$fix166941cpt['name'].' scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview '.$fix166941cpt['name'].'</a>', 'fincorbus' ), date_i18n( __( 'M j, Y @ G:i', 'fincorbus' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
        /* translators: %s: post permalink */
        10 => sprintf( __( ''.$fix166941cpt['name'].' draft updated. <a target="_blank" href="%s">Preview '.$fix166941cpt['name'].'</a>', 'fincorbus' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
    ];

    return $messages;
}


add_filter( 'bulk_post_updated_messages', 'fix166941cpt_bulk_post_updated_messages', 10, 2 );
function fix166941cpt_bulk_post_updated_messages( $bulk_messages, $bulk_counts ) {
    global $post;
    global $fix166941cpt;
    $slug = $fix166941cpt['slug'];


    $bulk_messages[$slug] = [
        'updated'   => _n( '%s '.$fix166941cpt['name'].' updated.', '%s '.$fix166941cpt['name'].' updated.', $bulk_counts['updated'], 'fincorbus' ),
        'locked'    => ( 1 === $bulk_counts['locked'] ) ? __( '1 '.$fix166941cpt['name'].' not updated, somebody is editing it.', 'fincorbus' ) :
                        _n( '%s '.$fix166941cpt['name'].' not updated, somebody is editing it.', '%s '.$fix166941cpt['name'].' not updated, somebody is editing them.', $bulk_counts['locked'], 'fincorbus' ),
        'deleted'   => _n( '%s '.$fix166941cpt['name'].' permanently deleted.', '%s '.$fix166941cpt['name'].' permanently deleted.', $bulk_counts['deleted'], 'fincorbus' ),
        'trashed'   => _n( '%s '.$fix166941cpt['name'].' moved to the Trash.', '%s '.$fix166941cpt['name'].' moved to the Trash.', $bulk_counts['trashed'], 'fincorbus' ),
        'untrashed' => _n( '%s '.$fix166941cpt['name'].' restored from the Trash.', '%s '.$fix166941cpt['name'].' restored from the Trash.', $bulk_counts['untrashed'], 'fincorbus' ),
    ];

    return $bulk_messages;
}

#*******************************
# Ref: fix166941-02-00-mb-inc
#*******************************
add_action( 'add_meta_boxes', 'fix166941cpt_mb_ini' );
function fix166941cpt_mb_ini(){
    global $fix166941cpt;
    add_meta_box( 
        'fix166941cpt_mb_id', 
        'Parametros', 
        'fix166941cpt_mb_fields', 
        $fix166941cpt['slug'], 
        'normal', 
        'high' 
    );
}

function fix166941cpt_mb_fields(){
    global $post;
    global $fix166941cpt;
    $post_id = $post->ID;
    $values = get_post_custom( $post->ID );

    $fix166941_titular = isset( $values['fix166941_titular'] ) ? esc_attr( $values['fix166941_titular'][0] ) : '';
    $fix166941_endereco1 = isset( $values['fix166941_endereco1'] ) ? esc_attr( $values['fix166941_endereco1'][0] ) : '';
    $fix166941_endereco2 = isset( $values['fix166941_endereco2'] ) ? esc_attr( $values['fix166941_endereco2'][0] ) : '';
    $fix166941_plano = isset( $values['fix166941_plano'] ) ? esc_attr( $values['fix166941_plano'][0] ) : '';
    $fix166941_validade = isset( $values['fix166941_validade'] ) ? esc_attr( $values['fix166941_validade'][0] ) : '';

    $fix166941_key = isset( $values['fix166941_key'] ) ? esc_attr( $values['fix166941_key'][0] ) : '';
    
    wp_nonce_field( 'fix1665674048value', 'fix1665674070key' );
    ?>
    <script type="text/javascript">
        jQuery(function($){
            var fixtitle = $('#title').val();
            if(!fixtitle) {
                fixtitle = '<?php echo $fix166941cpt['slug'].strtolower( wp_generate_password( 16, false, false ) );?>';
                $('#title').val(fixtitle);
                $('#fix166941_key_reg').val(fixtitle);
                $('#fix166941_key').val(fixtitle);
            }
            // $( "#title" ).prop( "disabled", true );
        });
    </script>

    <style type="text/css" media="screen">
        #fix-table {
            width: 100%;
        }
        #fix-table th {
            text-align: right;
            width: 200px;
        }   
    </style>
    <table id="fix-table">
        <tr>
            <th colspan="" rowspan="" headers="">Titular:</th>
            <td colspan="" rowspan="" headers="">
                <input style="min-width:100%" type="text" name="fix166941_titular" id="fix166941_titular" value="<?php echo $fix166941_titular ?>" automplete="off" >
            </td>
        </tr>
        <tr>
            <th colspan="" rowspan="" headers="">Endereço linha 1:</th>
            <td colspan="" rowspan="" headers="">
                <input style="min-width:100%" type="text" name="fix166941_endereco1" id="fix166941_endereco1" value="<?php echo $fix166941_endereco1 ?>" automplete="off" >
            </td>
        </tr>
        <tr>
            <th colspan="" rowspan="" headers="">Endereço linha 2:</th>
            <td colspan="" rowspan="" headers="">
                <input style="min-width:100%" type="text" name="fix166941_endereco2" id="fix166941_endereco2" value="<?php echo $fix166941_endereco2 ?>" automplete="off" >
            </td>
        </tr>
        <tr>
            <th colspan="" rowspan="" headers="">Validade:</th>
            <td colspan="" rowspan="" headers="">
                <input style="min-width:100%" type="text" name="fix166941_validade" id="fix166941_validade" value="<?php echo $fix166941_validade ?>" automplete="off" >
            </td>
        </tr>
        <tr>
            <th colspan="" rowspan="" headers="">Plano:</th>
            <td colspan="" rowspan="" headers="">
                <input style="min-width:100%" type="text" name="fix166941_plano" id="fix166941_plano" value="<?php echo $fix166941_plano ?>" automplete="off" >
            </td>
        </tr>
        <tr>
            <th colspan="" rowspan="" headers="">Key:</th>
            <td colspan="" rowspan="" headers="">
                <input style="min-width:100%" type="text" name="fix166941_key" id="fix166941_key" value="<?php echo $fix166941_key ?>" automplete="off" >
                <?php 
                if($fix166941_key){
                    ?>
                    <a target="_blank" href="<?php echo site_url() ?>/exibir-cartao/<?php echo $fix166941_key ?>">Exibir cartão</a>
                    <?php 
                }
                ?>
            </td>
        </tr>
    </table>
    <?php
}

add_action( 'save_post', 'fix166941cpt_save_post' );
function fix166941cpt_save_post( $post_id ){
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if( !isset( $_POST['fix1665674070key'] ) || !wp_verify_nonce( $_POST['fix1665674070key'], 'fix1665674048value' ) ) return;
    // if( !current_user_can( 'edit_post' ) ) return;
    $allowed = array(
        'a' => array(
            'href' => array()
        )
    );



    if( isset( $_POST['fix166941_titular'] ) )
    update_post_meta( $post_id, 'fix166941_titular', wp_kses( $_POST['fix166941_titular'], $allowed ) );

    if( isset( $_POST['fix166941_endereco1'] ) )
    update_post_meta( $post_id, 'fix166941_endereco1', wp_kses( $_POST['fix166941_endereco1'], $allowed ) );

    if( isset( $_POST['fix166941_endereco2'] ) )
    update_post_meta( $post_id, 'fix166941_endereco2', wp_kses( $_POST['fix166941_endereco2'], $allowed ) );

    if( isset( $_POST['fix166941_validade'] ) )
    update_post_meta( $post_id, 'fix166941_validade', wp_kses( $_POST['fix166941_validade'], $allowed ) );

    if( isset( $_POST['fix166941_plano'] ) )
    update_post_meta( $post_id, 'fix166941_plano', wp_kses( $_POST['fix166941_plano'], $allowed ) );

    if( isset( $_POST['fix166941_key'] ) )
    update_post_meta( $post_id, 'fix166941_key', wp_kses( $_POST['fix166941_key'], $allowed ) );
}











#*******************************
# Ref: fix166941-03-0-cols
#*******************************

add_filter( 'manage_'.$fix166941cpt['slug'].'_posts_columns', 'fix166941cpt_cols_title' );
function fix166941cpt_cols_title( $columns ) {

    // $columns = array(
    //  'cb' => $columns['cb'],
    //  'title' => __( 'Key' ),
    //  'fix166941_titular' => 'metaEspecialidade',
    // );
    $columns['fix166941_titular'] = 'Titular';
    $columns['fix166941_plano'] = 'Plano';
    $columns['fix166941_validade'] = 'Validade';

    return $columns;

}


add_action( 'manage_'.$fix166941cpt['slug'].'_posts_custom_column', 'fix166941cpt_cols_fields', 10, 2);
function fix166941cpt_cols_fields( $column, $post_id ) {
    global $fix166941cpt_tax;

    if ( 'fix166941_titular' === $column ) {
        $fix166941_titular = get_post_meta( $post_id, 'fix166941_titular', true );
        echo $fix166941_titular;
    }
    if ( 'fix166941_plano' === $column ) {
        $fix166941_plano = get_post_meta( $post_id, 'fix166941_plano', true );
        echo $fix166941_plano;
    }
    if ( 'fix166941_validade' === $column ) {
        $fix166941_validade = get_post_meta( $post_id, 'fix166941_validade', true );
        echo $fix166941_validade;
    }
}

#*******************************
# Ref: fix166941-08-0-filter-admin-manager
#*******************************
add_filter( 'parse_query', 'fix166941_filter_in_admin' );
function fix166941_filter_in_admin( $query ){
    global $pagenow;
    global $fix166941cpt;
    
    $post_type = isset($_GET['post_type']) ? $_GET['post_type'] : '';
    if($post_type<>$fix166941cpt['slug']) return;

    // die($post_type);
    if ( is_admin() && $pagenow=='edit.php' && isset($_GET['ADMIN_FILTER_FIELD_NAME']) && $_GET['ADMIN_FILTER_FIELD_NAME'] != '') {
        $query->query_vars['meta_key'] = $_GET['ADMIN_FILTER_FIELD_NAME'];
        $query->query_vars['meta_compare'] = 'LIKE';

        if (isset($_GET['ADMIN_FILTER_FIELD_VALUE']) && $_GET['ADMIN_FILTER_FIELD_VALUE'] != ''){
            $query->query_vars['meta_value'] = $_GET['ADMIN_FILTER_FIELD_VALUE'];
        }
    }
}

add_action( 'restrict_manage_posts', 'fix166941_restrict_manage_posts' );
function fix166941_restrict_manage_posts(){
    global $wpdb;
    global $fix166941cpt;
    // $post_type = get_post_type();
    
    $post_type = isset($_GET['post_type']) ? $_GET['post_type'] : '';
    if($post_type<>$fix166941cpt['slug']) return;

    $sql = "SELECT DISTINCT meta_key FROM ".$wpdb->postmeta." WHERE meta_key LIKE 'fix166941%' ";
    $fields = $wpdb->get_results($sql, ARRAY_N);

    // echo $post_type;
        ?>
        <select name="ADMIN_FILTER_FIELD_NAME">
            <option value=""><?php _e('-- Filtrar campos --', 'baapf'); ?></option>
            <?php
            $current = isset($_GET['ADMIN_FILTER_FIELD_NAME'])? $_GET['ADMIN_FILTER_FIELD_NAME']:'';
            $current_v = isset($_GET['ADMIN_FILTER_FIELD_VALUE'])? $_GET['ADMIN_FILTER_FIELD_VALUE']:'';
            foreach ($fields as $field) {
                if (substr($field[0],0,1) != "_"){
                    printf(
                        '<option value="%s"%s>%s</option>',
                        $field[0],
                        $field[0] == $current? ' selected="selected"':'',
                        strtoupper( substr($field[0], 10) )
                    );
                }
            }
        ?>
        </select>
        <?php 
            _e('Value:', 'baapf'); 
        ?>
            <input type="TEXT" name="ADMIN_FILTER_FIELD_VALUE" value="<?php echo $current_v; ?>" />
        <?php
}








#*******************************
# Ref: fix166941-07-0-tax-categorias
#*******************************

$fix166941cpt_tax['singular'] = 'Categoria';
$fix166941cpt_tax['plural'] = 'Categorias';
$fix166941cpt_tax['menu_name'] = 'Categoria';
$fix166941cpt_tax['slug'] = $fix166941cpt['slug'].'-l26scuia';

add_action( 'init', 'fix166941_categorias', 0 );
function fix166941_categorias() {
    global $fix166941cpt;
    global $fix166941cpt_tax;



    $labels = array(
        'name' => $fix166941cpt_tax['menu_name'],
        'singular_name' => $fix166941cpt_tax['singular'],
        'search_items' =>  __( 'Localizar '.$fix166941cpt_tax['singular'] ),
        'popular_items' => __( $fix166941cpt_tax['plural'].' mais visto' ),
        'all_items' => __( 'Todos os '.$fix166941cpt_tax['plural'] ),
        'parent_item' => null,
        'parent_item_colon' => null,
        'edit_item' => __( 'Editar '.$fix166941cpt_tax['singular'] ), 
        'update_item' => __( 'Atualizar '.$fix166941cpt_tax['singular'] ),
        'add_new_item' => __( 'Criar um novo '.$fix166941cpt_tax['singular'] ),
        'new_item_name' => __( 'Nome do novo '.$fix166941cpt_tax['singular'] ),
        'separate_items_with_commas' => __( 'Separe o '.$fix166941cpt_tax['singular'].' com vírgulas' ),
        'add_or_remove_items' => __( 'Adicionar ou remover '.$fix166941cpt_tax['singular'] ),
        'choose_from_most_used' => __( 'Escolha um dos '.$fix166941cpt_tax['singular'].' mais usados' ),
        'menu_name' => $fix166941cpt_tax['menu_name'],
    ); 

    register_taxonomy($fix166941cpt_tax['slug'],$fix166941cpt['slug'],array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var' => true,
        'rewrite' => array( 'slug' => $fix166941cpt_tax['slug'] ),
    ));
}


add_action('restrict_manage_posts','fix166941_restrict_manage_posts_cat');
function fix166941_restrict_manage_posts_cat() {
    global $typenow;
    global $wp_query;
    global $fix166941cpt;
    global $fix166941cpt_tax;

    if ($typenow==$fix166941cpt['slug']) {
        $taxonomy = $fix166941cpt_tax['slug'];
        $term = isset($wp_query->query[$taxonomy]) ? $wp_query->query[$taxonomy] :'';
        $business_taxonomy = get_taxonomy($taxonomy);
        wp_dropdown_categories(array(
            'show_option_all' =>  __("Show All"),
            'taxonomy'        =>  $taxonomy,
            'name'            =>  $taxonomy,
            'orderby'         =>  'name',
            'selected'        =>  $term,
            'hierarchical'    =>  true,
            'depth'           =>  3,
            'show_count'      =>  true, // Show # listings in parens
            'hide_empty'      =>  true, // Don't show businesses w/o listings
        ));
    }
}


add_filter('parse_query','fix166941_parse_query_cat');
function fix166941_parse_query_cat($query) {

    global $pagenow;
    global $fix166941cpt;
    global $fix166941cpt_tax;

    $fix166941cpt_tax_slug = $fix166941cpt_tax['slug'];
    $qv =& $query->query_vars;

    if ( $pagenow=='edit.php' && isset($qv[$fix166941cpt_tax_slug]) && is_numeric($qv[$fix166941cpt_tax_slug]) ) {
        $term = get_term_by('id',$qv[$fix166941cpt_tax_slug],$fix166941cpt_tax_slug);
        $qv[$fix166941cpt_tax_slug] = ($term ? $term->slug : '');
    }
}










########################## show card in PDF

add_action( 'parse_request', 'fix1669419081');
function fix1669419081( &$wp ) {
    if (substr($wp->request, 0, 13) == 'exibir-cartao'){

        global $fix166941cpt;

        // echo $wp->request;
        $cartao = substr($wp->request, 14);

        $sql_term = "";
        $sql_term_join = "";


        $busca = isset($_GET['busca']) ? $_GET['busca'] : '';
        $sql_busca = '';


        $sql = "
        SELECT 
            p.ID,
            p.post_name,
            p.post_title,
            p.post_date,
            p.guid,
            m01.meta_value as fix166941_titular,
            m02.meta_value as fix166941_endereco1,
            m03.meta_value as fix166941_endereco2,
            m04.meta_value as fix166941_plano,
            m05.meta_value as fix166941_validade
            
        FROM ".$GLOBALS['wpdb']->prefix."posts p
            left join ".$GLOBALS['wpdb']->prefix."postmeta m01 on m01.post_id = p.ID and m01.meta_key = 'fix166941_titular'
            left join ".$GLOBALS['wpdb']->prefix."postmeta m02 on m02.post_id = p.ID and m02.meta_key = 'fix166941_endereco1'
            left join ".$GLOBALS['wpdb']->prefix."postmeta m03 on m03.post_id = p.ID and m03.meta_key = 'fix166941_endereco2'
            left join ".$GLOBALS['wpdb']->prefix."postmeta m04 on m04.post_id = p.ID and m04.meta_key = 'fix166941_plano'
            left join ".$GLOBALS['wpdb']->prefix."postmeta m05 on m05.post_id = p.ID and m05.meta_key = 'fix166941_validade'
            ".$sql_term_join."
        where 
            p.post_status = 'publish' 
            and p.post_type = '".$fix166941cpt['slug']."' 
            and p.post_name like '".$cartao."'
            ".$sql_busca."
            ".$sql_term."
        ";

        // echo "<pre>";
        // echo $sql;
        // echo "</pre>";   

        $rows = $GLOBALS['wpdb']->get_results($sql, 'ARRAY_A');

        // echo "<pre>";
        // echo count($rows);
        // echo "</pre>";

        // echo "<pre>";
        // print_r($rows);
        // echo "</pre>";

        global $fix_path_plugin;
        $path_fpdf = $fix_path_plugin."fpdf184/fpdf.php";
        if( !file_exists($path_fpdf) ){
            echo "<p>fpdf184 ausente</p>";
            exit;;
        }
        require $path_fpdf;


        $border = 0;
        class PDF extends FPDF{}; 
        $pdf=new PDF('p','mm','A4');
        $pdf->AddPage('P');
        $pdf->SetMargins(0, 0, 0); 

        $ln = 0; 
        $pc = 1;


        $pdf->SetFont('Arial','',8);
        $pdf->SetXY(13, 10);
        $pdf->Cell(90,4,date("d/m/Y H:i"),$border,1,"L");

        $pdf->SetFont('Arial','',8);
        $pdf->SetXY(103, 10);
        $pdf->Cell(90,4,site_url(),$border,1,"R");
        global $plugin_file;

        $path_img = plugin_dir_path( $plugin_file )."cartao.jpg";
        // die($path_img);
        $pdf->Image($path_img,5,10+$ln,200,70);
        // $pdf->Image('cartao.jpg',5,10+$ln,200,70);


        if( !count($rows) ){
            // echo "dados ausentes";
            // return;
            // $pdf->Output();
            $pdf->Output('I', 'cartao-template.pdf');
            exit;
            // die();
        }
        $unidade = str_pad($rows[0]['ID'], 6, "0", STR_PAD_LEFT);
        $fix_nome = $rows[0]['fix166941_titular'];
        $endereco1 = $rows[0]['fix166941_endereco1'];
        $endereco2 = $rows[0]['fix166941_endereco2'];
        $plano = $rows[0]['fix166941_plano'];
        $validade = $rows[0]['fix166941_validade'];

        // echo "<div>".$fix_nome."</div>";
        // echo "<div>".$endereco1."</div>";
        // echo "<div>".$endereco2."</div>";
        // echo "<div>".$plano."</div>";
        // echo "<div>".$validade."</div>";

        

        // http://localhost:11027/wp-content/plugins/fix-cartao/add-inc/cartao/images/cartao.jpg
        // /var/www/html/wp-content/plugins/fix-cartao/add-inc/images/cartao.jpg

        $pdf->SetTextColor(7,28,7);

    $pdf->SetFont('Arial','B',10);
    $pdf->SetXY(12, $ln+46);
    $pdf->Cell(80,4,substr(strtoupper($fix_nome),0,40),$border,1,"L");

    

    $pdf->SetFont('Arial','',8);
    $pdf->SetXY(12, $ln+54);
    $pdf->Cell(80,3,strtoupper($endereco1),$border,1,"L");
    $pdf->SetXY(12, $ln+57);
    $pdf->Cell(80,4,strtoupper($endereco2),$border,1,"L");


    $pdf->SetFont('Arial','B',10);
    $pdf->SetXY(12, $ln+66);
    $pdf->Cell(15,3, $unidade,$border,1,"L");

    $pdf->SetFont('Arial','B',8);
    $pdf->SetXY(33, $ln+66);
    $pdf->Cell(40,3, $plano,$border,1,"L");

    $pdf->SetFont('Arial','B',10);
    $pdf->SetXY(75, $ln+66);
    $pdf->Cell(20,3,$validade,$border,1,"R");

        // $pdf->Output();
        $fix_nome_file = strtolower( preg_replace('/ /', '-', $fix_nome) ); 
        $file_pdf_name = "cartao-do-associado-".$fix_nome_file.".pdf";
        $pdf->Output('I', $file_pdf_name );
        exit;
    }
}


