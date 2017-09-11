<?php 
/**
 * tomé el archivo admin/codetemplates/j_3_4_standard/com_architectcomp_j34standard/admin/config.xml
 * y con él generé éste archivo.
 * 
 * El objetivo es mostrar la lista de todos los campos de configuración con sus descripciones
 * en formato latex.
 * 
 * Para obtener los valores de las etiquetas del archivo language.ini coloco el
 * compilado de este archivo en admin/views/dashboard/tmpl/ y lo despliego dentro de una vista, ejemplo
 * http://localhost/JPruebas/administrator/index.php?option=com_t396&view=dashboard&layout=borrame
 * 
 * el archivo language.ini puede contener carácteres especiales de latex, por lo que habrá que depurar.
 * 
 */
class Foo {
	
    protected $_lyx_forbidden = array('\r\n', '~', '^', '\\', '&', '%', '$', '#', '_', '{', '}',);
    protected $_lyx_replacement = array(
                '', '\textasciitilde ', '\textasciicircum ', '\textbackslash ',
                '\&', '\%', '\$', '\#', '\_', '\{', '\}', 
            );
	
    /**
     * Obtiene el valor una constante i18n definida en un archivo .ini
     * @param string $label Constante i18n
     * @return string valor equivalente
     */
    function jtext2lyx($label){
        return str_replace( $this->_lyx_forbidden, $this->_lyx_replacement, JText::_($label));
    }

    function printConfigs(){
        #JFactory::getLanguage()->load('com_jtsca', JPATH_ADMINISTRATOR, 'es-GB', true);
        JFactory::getLanguage()->load('[%%com_architectcomp%%]', JPATH_ADMINISTRATOR, 'es-ES', true);
        $output = '';

[%%IF INCLUDE_VERSIONS%%]
    $output .= '\textbf{' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_FIELDSET_VERSION_CONTROL_LABEL'). '} & \textbf{' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_FIELDSET_VERSION_CONTROL_DESC'). '} \tabularnewline\hline '. "\r\n";
    $output .= $this->jtext2lyx('JGLOBAL_HISTORY_LIMIT_OPTIONS_LABEL'). ' & ' . $this->jtext2lyx('JGLOBAL_HISTORY_LIMIT_OPTIONS_DESC'). ' \tabularnewline\hline '. "\r\n";
    $output .= $this->jtext2lyx('JGLOBAL_SAVE_HISTORY_OPTIONS_LABEL'). ' & ' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_SAVE_HISTORY_OPTIONS_DESC'). ' \tabularnewline\hline '. "\r\n";
[%%FOREACH COMPONENT_OBJECT%%]
[%%IF INCLUDE_VERSIONS%%]
    $output .= $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_FIELD_SAVE_HISTORY_LABEL'). ' & ' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_FIELD_SAVE_HISTORY_DESC'). ' \tabularnewline\hline '. "\r\n";
[%%ENDIF INCLUDE_VERSIONS%%]
[%%ENDFOR COMPONENT_OBJECT%%]
[%%ENDIF INCLUDE_VERSIONS%%]
[%%FOREACH COMPONENT_OBJECT%%]
[%%IF GENERATE_SITE%%]
[%%IF INCLUDE_PARAMS_GLOBAL%%]
    $output .= '\textbf{' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_FIELD_CONFIG_SINGLE_ITEM_DISPLAY'). '} & \textbf{' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_FIELD_CONFIG_SINGLE_ITEM_DESC'). '} \tabularnewline\hline '. "\r\n";
    $output .= $this->jtext2lyx('JGLOBAL_FIELD_LAYOUT_LABEL'). ' & ' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_CHOOSE_LAYOUT_DESC'). ' \tabularnewline\hline '. "\r\n";
    $output .= $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_SHOW_ICONS_LABEL'). ' & ' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_SHOW_ICONS_DESC'). ' \tabularnewline\hline '. "\r\n";
    $output .= $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_SHOW_PRINT_ICON_LABEL'). ' & ' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_SHOW_PRINT_ICON_DESC'). ' \tabularnewline\hline '. "\r\n";
    $output .= $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_SHOW_EMAIL_ICON_LABEL'). ' & ' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_SHOW_EMAIL_ICON_DESC'). ' \tabularnewline\hline '. "\r\n";
    $output .= $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_KEEP_ITEMID_LABEL'). ' & ' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_KEEP_ITEMID_DESC'). ' \tabularnewline\hline '. "\r\n";
    $output .= $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_SHOW_NAVIGATION_LABEL'). ' & ' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_SHOW_NAVIGATION_DESC'). ' \tabularnewline\hline '. "\r\n";
[%%IF GENERATE_CATEGORIES%%]
    $output .= $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_SHOW_CATEGORY_BREADCRUMB_LABEL'). ' & ' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_SHOW_CATEGORY_BREADCRUMB_DESC'). ' \tabularnewline\hline '. "\r\n";
    $output .= $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_LIMIT_CATEGORY_NAVIGATION_LABEL'). ' & ' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_LIMIT_CATEGORY_NAVIGATION_DESC'). ' \tabularnewline\hline '. "\r\n";
[%%ENDIF GENERATE_CATEGORIES%%]
    $output .= $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_SHOW_READMORE_LABEL'). ' & ' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_SHOW_READMORE_DESC'). ' \tabularnewline\hline '. "\r\n";
    $output .= $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_SHOW_READMORE_LIMIT_LABEL'). ' & ' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_SHOW_READMORE_LIMIT_DESC'). ' \tabularnewline\hline '. "\r\n";
[%%IF INCLUDE_NAME%%]
    $output .= $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_SHOW_READMORE_NAME_LABEL'). ' & ' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_SHOW_READMORE_NAME_DESC'). ' \tabularnewline\hline '. "\r\n";
[%%ENDIF INCLUDE_NAME%%]
[%%IF INCLUDE_ACCESS%%]
    $output .= $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_SHOW_UNAUTH_LINKS_LABEL'). ' & ' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_SHOW_UNAUTH_LINKS_DESC'). ' \tabularnewline\hline '. "\r\n";
[%%ENDIF INCLUDE_ACCESS%%]
[%%IF INCLUDE_NAME%%]
    $output .= $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_SHOW_NAME_LABEL'). ' & ' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_SHOW_NAME_DESC'). ' \tabularnewline\hline '. "\r\n";
    $output .= $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_LINKED_NAMES_LABEL'). ' & ' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_LINKED_NAMES_DESC'). ' \tabularnewline\hline '. "\r\n";
[%%ENDIF INCLUDE_NAME%%]
[%%IF INCLUDE_INTRO%%]
    $output .= $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_SHOW_INTRO_LABEL'). ' & ' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_SHOW_INTRO_DESC'). ' \tabularnewline\hline '. "\r\n";
[%%ENDIF INCLUDE_INTRO%%]
[%%IF INCLUDE_IMAGE%%]
    $output .= $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_SHOW_IMAGE_LABEL'). ' & ' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_SHOW_IMAGE_DESC'). ' \tabularnewline\hline '. "\r\n";
    $output .= $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_SHOW_IMAGE_FLOAT_LABEL'). ' & ' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_SHOW_IMAGE_FLOAT_DESC'). ' \tabularnewline\hline '. "\r\n";
    $output .= $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_SHOW_IMAGE_WIDTH_LABEL'). ' & ' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_SHOW_IMAGE_WIDTH_DESC'). ' \tabularnewline\hline '. "\r\n";
    $output .= $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_SHOW_IMAGE_HEIGHT_LABEL'). ' & ' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_SHOW_IMAGE_HEIGHT_DESC'). ' \tabularnewline\hline '. "\r\n";
[%%IF INCLUDE_INTRO%%]
    $output .= $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_SHOW_INTRO_IMAGE_LABEL'). ' & ' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_SHOW_INTRO_IMAGE_DESC'). ' \tabularnewline\hline '. "\r\n";
    $output .= $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_SHOW_INTRO_IMAGE_FLOAT_LABEL'). ' & ' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_SHOW_INTRO_IMAGE_FLOAT_DESC'). ' \tabularnewline\hline '. "\r\n";
    $output .= $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_SHOW_INTRO_IMAGE_WIDTH_LABEL'). ' & ' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_SHOW_INTRO_IMAGE_WIDTH_DESC'). ' \tabularnewline\hline '. "\r\n";
    $output .= $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_SHOW_INTRO_IMAGE_HEIGHT_LABEL'). ' & ' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_SHOW_INTRO_IMAGE_HEIGHT_DESC'). ' \tabularnewline\hline '. "\r\n";
[%%ENDIF INCLUDE_INTRO%%]
[%%ENDIF INCLUDE_IMAGE%%]
[%%IF INCLUDE_URLS%%]
    $output .= $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_SHOW_URLS_LABEL'). ' & ' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_SHOW_URLS_DESC'). ' \tabularnewline\hline '. "\r\n";
    $output .= $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_SHOW_URLS_POSITION_LABEL'). ' & ' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_SHOW_URLS_POSITION_DESC'). ' \tabularnewline\hline '. "\r\n";
[%%ENDIF INCLUDE_URLS%%]
[%%IF GENERATE_CATEGORIES%%]
    $output .= $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_SHOW_CATEGORY_LABEL'). ' & ' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_SHOW_CATEGORY_DESC'). ' \tabularnewline\hline '. "\r\n";
    $output .= $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_LINK_CATEGORY_LABEL'). ' & ' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_LINK_CATEGORY_DESC'). ' \tabularnewline\hline '. "\r\n";
    $output .= $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_SHOW_PARENT_CATEGORY_LABEL'). ' & ' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_SHOW_PARENT_CATEGORY_DESC'). ' \tabularnewline\hline '. "\r\n";
    $output .= $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_LINK_PARENT_CATEGORY_LABEL'). ' & ' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_LINK_PARENT_CATEGORY_DESC'). ' \tabularnewline\hline '. "\r\n";
[%%ENDIF GENERATE_CATEGORIES%%]
[%%IF INCLUDE_TAGS%%]
    $output .= $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_FIELD_SHOW_TAGS_LABEL'). ' & ' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_FIELD_SHOW_TAGS_DESC'). ' \tabularnewline\hline '. "\r\n";
[%%ENDIF INCLUDE_TAGS%%]
[%%IF INCLUDE_CREATED%%]
    $output .= $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_SHOW_CREATED_BY_LABEL'). ' & ' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_SHOW_CREATED_BY_DESC'). ' \tabularnewline\hline '. "\r\n";
    $output .= $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_LINK_CREATED_BY_LABEL'). ' & ' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_LINK_CREATED_BY_DESC'). ' \tabularnewline\hline '. "\r\n";
    $output .= $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_SHOW_CREATED_BY_ALIAS_LABEL'). ' & ' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_SHOW_CREATED_BY_ALIAS_DESC'). ' \tabularnewline\hline '. "\r\n";
    $output .= $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_SHOW_CREATED_LABEL'). ' & ' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_SHOW_CREATED_DESC'). ' \tabularnewline\hline '. "\r\n";
[%%ENDIF INCLUDE_CREATED%%]
[%%IF INCLUDE_MODIFIED%%]
    $output .= $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_SHOW_MODIFIED_LABEL'). ' & ' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_SHOW_MODIFIED_DESC'). ' \tabularnewline\hline '. "\r\n";
[%%ENDIF INCLUDE_MODIFIED%%]
[%%IF INCLUDE_PUBLISHED_DATES%%]
    $output .= $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_SHOW_PUBLISH_UP_LABEL'). ' & ' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_SHOW_PUBLISH_UP_DESC'). ' \tabularnewline\hline '. "\r\n";
    $output .= $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_SHOW_PUBLISH_DOWN_LABEL'). ' & ' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_SHOW_PUBLISH_DOWN_DESC'). ' \tabularnewline\hline '. "\r\n";
[%%ENDIF INCLUDE_PUBLISHED_DATES%%]
[%%IF INCLUDE_HITS%%]
    $output .= $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_SHOW_HITS_LABEL'). ' & ' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_SHOW_HITS_DESC'). ' \tabularnewline\hline '. "\r\n";
[%%ENDIF INCLUDE_HITS%%]
    $output .= $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_SHOW_ADMIN_LABEL'). ' & ' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_SHOW_ADMIN_DESC'). ' \tabularnewline\hline '. "\r\n";
[%%IF GENERATE_PLUGINS_VOTE%%]
    $output .= $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_SHOW_VOTE_LABEL'). ' & ' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_SHOW_VOTE_DESC'). ' \tabularnewline\hline '. "\r\n";
[%%ENDIF GENERATE_PLUGINS_VOTE%%]
[%%FOREACH OBJECT_FIELD%%]
[%%IF FIELD_NOT_HIDDEN%%]
    $output .= $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_SHOW_FIELD_[%%FIELD_CODE_NAME_UPPER%%]_LABEL'). ' & ' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_SHOW_FIELD_[%%FIELD_CODE_NAME_UPPER%%]_DESC'). ' \tabularnewline\hline '. "\r\n";
[%%ENDIF FIELD_NOT_HIDDEN%%]
[%%ENDFOR OBJECT_FIELD%%]
[%%FOREACH REGISTRY_FIELD%%]
    $output .= $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_SHOW_FIELD_[%%FIELD_CODE_NAME_UPPER%%]_LABEL'). ' & ' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_SHOW_FIELD_[%%FIELD_CODE_NAME_UPPER%%]_DESC'). ' \tabularnewline\hline '. "\r\n";
[%%ENDFOR REGISTRY_FIELD%%]
    $output .= '\textbf{' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_FIELD_CONFIG_BLOG_LIST_LABEL'). '} & \textbf{' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_FIELD_CONFIG_BLOG_LIST_DESC'). '} \tabularnewline\hline '. "\r\n";
[%%IF GENERATE_SITE_LAYOUT_BLOG%%]
    $output .= $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_NUM_LEADING_LABEL'). ' & ' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_NUM_LEADING_DESC'). ' \tabularnewline\hline '. "\r\n";
    $output .= $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_NUM_INTRO_LABEL'). ' & ' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_NUM_INTRO_DESC'). ' \tabularnewline\hline '. "\r\n";
    $output .= $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_NUM_COLUMNS_LABEL'). ' & ' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_NUM_COLUMNS_DESC'). ' \tabularnewline\hline '. "\r\n";
    $output .= $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_NUM_LINKS_LABEL'). ' & ' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_NUM_LINKS_DESC'). ' \tabularnewline\hline '. "\r\n";
    $output .= $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_MULTI_COLUMN_ORDER_LABEL'). ' & ' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_MULTI_COLUMN_ORDER_DESC'). ' \tabularnewline\hline '. "\r\n";
[%%ENDIF GENERATE_SITE_LAYOUT_BLOG%%]
[%%IF GENERATE_CATEGORIES%%]
    $output .= $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_CATEGORY_ORDER_LABEL'). ' & ' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_CATEGORY_ORDER_DESC'). ' \tabularnewline\hline '. "\r\n";
    $output .= $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_CATEGORY_ORDER_LABEL'). ' & ' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_CATEGORY_ORDER_DESC'). ' \tabularnewline\hline '. "\r\n";
[%%IF INCLUDE_CREATED%%]
[%%ENDIF INCLUDE_CREATED%%]
[%%IF INCLUDE_NAME%%]
[%%ENDIF INCLUDE_NAME%%]
[%%IF INCLUDE_CREATED%%]
[%%ENDIF INCLUDE_CREATED%%]
[%%IF INCLUDE_HITS%%]
[%%ENDIF INCLUDE_HITS%%]
[%%IF INCLUDE_ORDERING%%]
[%%ENDIF INCLUDE_ORDERING%%]
    $output .= $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_ORDERING_DATE_LABEL'). ' & ' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_ORDERING_DATE_DESC'). ' \tabularnewline\hline '. "\r\n";
[%%IF INCLUDE_CREATED%%]
[%%ENDIF INCLUDE_CREATED%%]
[%%IF INCLUDE_MODIFIED%%]
[%%ENDIF INCLUDE_MODIFIED%%]
[%%IF INCLUDE_PUBLISHED_DATES%%]
[%%ENDIF INCLUDE_PUBLISHED_DATES%%]
[%%ENDIF GENERATE_CATEGORIES%%]
    $output .= $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_ORDER_LABEL'). ' & ' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_ORDER_DESC'). ' \tabularnewline\hline '. "\r\n";
[%%IF INCLUDE_CREATED%%]
[%%ENDIF INCLUDE_CREATED%%]
[%%IF INCLUDE_MODIFIED%%]
[%%ENDIF INCLUDE_MODIFIED%%]
[%%IF INCLUDE_PUBLISHED_DATES%%]
[%%ENDIF INCLUDE_PUBLISHED_DATES%%]
[%%IF INCLUDE_NAME%%]
[%%ENDIF INCLUDE_NAME%%]
[%%IF INCLUDE_CREATED%%]
[%%ENDIF INCLUDE_CREATED%%]
[%%IF INCLUDE_HITS%%]
[%%ENDIF INCLUDE_HITS%%]
[%%IF INCLUDE_ORDERING%%]
[%%ENDIF INCLUDE_ORDERING%%]
    $output .= $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_ORDER_DIRECTION_LABEL'). ' & ' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_ORDER_DIRECTION_DESC'). ' \tabularnewline\hline '. "\r\n";
    $output .= $this->jtext2lyx('JGLOBAL_FILTER_FIELD_LABEL'). ' & ' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_FILTER_FIELD_DESC'). ' \tabularnewline\hline '. "\r\n";
[%%IF INCLUDE_NAME%%]
[%%ELSE INCLUDE_NAME%%]
[%%IF INCLUDE_CREATED%%]
[%%ELSE INCLUDE_CREATED%%]
[%%IF INCLUDE_HITS%%]
[%%ELSE INCLUDE_HITS%%]
[%%ENDIF INCLUDE_HITS%%]
[%%ENDIF INCLUDE_CREATED%%]
[%%ENDIF INCLUDE_NAME%%]
[%%IF INCLUDE_NAME%%]
[%%ENDIF INCLUDE_NAME%%]
[%%IF INCLUDE_CREATED%%]
[%%ENDIF INCLUDE_CREATED%%]
[%%IF INCLUDE_HITS%%]
[%%ENDIF INCLUDE_HITS%%]
    $output .= $this->jtext2lyx('JGLOBAL_SHOW_HEADINGS_LABEL'). ' & ' . $this->jtext2lyx('JGLOBAL_SHOW_HEADINGS_DESC'). ' \tabularnewline\hline '. "\r\n";
    $output .= $this->jtext2lyx('JGLOBAL_PAGINATION_LABEL'). ' & ' . $this->jtext2lyx('JGLOBAL_PAGINATION_DESC'). ' \tabularnewline\hline '. "\r\n";
    $output .= $this->jtext2lyx('JGLOBAL_PAGINATION_RESULTS_LABEL'). ' & ' . $this->jtext2lyx('JGLOBAL_PAGINATION_RESULTS_DESC'). ' \tabularnewline\hline '. "\r\n";
    $output .= $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_SHOW_PAGINATION_LIMIT_LABEL'). ' & ' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_SHOW_PAGINATION_LIMIT_DESC'). ' \tabularnewline\hline '. "\r\n";
    $output .= $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_NUM_PER_PAGE_LABEL'). ' \tabularnewline\hline '. "\r\n";
    $output .= $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_NO_ITEMS_LABEL'). ' & ' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_NO_ITEMS_DESC'). ' \tabularnewline\hline '. "\r\n";
    $output .= $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_SHOW_ADD_LINK_LABEL'). ' & ' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_SHOW_ADD_LINK_DESC'). ' \tabularnewline\hline '. "\r\n";
    $output .= $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_SHOW_DATE_LABEL'). ' & ' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_SHOW_DATE_DESC'). ' \tabularnewline\hline '. "\r\n";
[%%IF INCLUDE_CREATED%%]
[%%ENDIF INCLUDE_CREATED%%]
[%%IF INCLUDE_PUBLISHED_DATES%%]
[%%ENDIF INCLUDE_PUBLISHED_DATES%%]
[%%IF INCLUDE_MODIFIED%%]
[%%ENDIF INCLUDE_MODIFIED%%]
    $output .= $this->jtext2lyx('JGLOBAL_DATE_FORMAT_LABEL'). ' & ' . $this->jtext2lyx('JGLOBAL_DATE_FORMAT_DESC'). ' \tabularnewline\hline '. "\r\n";
[%%IF INCLUDE_HITS%%]
    $output .= $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_LIST_HITS_LABEL'). ' & ' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_LIST_HITS_DESC'). ' \tabularnewline\hline '. "\r\n";
[%%ENDIF INCLUDE_HITS%%]
[%%IF INCLUDE_CREATED%%]
    $output .= $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_LIST_CREATED_BY_LABEL'). ' & ' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_LIST_CREATED_BY_DESC'). ' \tabularnewline\hline '. "\r\n";
[%%ENDIF INCLUDE_CREATED%%]
[%%IF INCLUDE_ORDERING%%]
    $output .= $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_LIST_ORDERING_LABEL'). ' & ' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_LIST_ORDERING_DESC'). ' \tabularnewline\hline '. "\r\n";
[%%ENDIF INCLUDE_ORDERING%%]
[%%ENDIF INCLUDE_PARAMS_GLOBAL%%]
[%%ENDIF GENERATE_SITE%%]
[%%ENDFOR COMPONENT_OBJECT%%]
[%%IF GENERATE_CATEGORIES%%]
[%%IF GENERATE_SITE%%]
    $output .= '\textbf{' . $this->jtext2lyx('JCATEGORIES'). '} & \textbf{' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_FIELD_CONFIG_CATEGORIES_DESC'). '} \tabularnewline\hline '. "\r\n";
    $output .= $this->jtext2lyx('JGLOBAL_FIELD_SHOW_BASE_DESCRIPTION_LABEL'). ' & ' . $this->jtext2lyx('JGLOBAL_FIELD_SHOW_BASE_DESCRIPTION_DESC'). ' \tabularnewline\hline '. "\r\n";
    $output .= $this->jtext2lyx('JGLOBAL_SHOW_EMPTY_CATEGORIES_LABEL'). ' & ' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_SHOW_EMPTY_CATEGORIES_DESC'). ' \tabularnewline\hline '. "\r\n";
    $output .= $this->jtext2lyx('JGLOBAL_SHOW_SUBCATEGORIES_DESCRIPTION_LABEL'). ' & ' . $this->jtext2lyx('JGLOBAL_SHOW_SUBCATEGORIES_DESCRIPTION_DESC'). ' \tabularnewline\hline '. "\r\n";
    $output .= $this->jtext2lyx('JGLOBAL_MAXIMUM_CATEGORY_LEVELS_LABEL'). ' & ' . $this->jtext2lyx('JGLOBAL_MAXIMUM_CATEGORY_LEVELS_DESC'). ' \tabularnewline\hline '. "\r\n";
    $output .= $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_SHOW_UNAUTH_LINKS_LABEL'). ' & ' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_SHOW_CATEGORY_UNAUTH_LINKS_DESC'). ' \tabularnewline\hline '. "\r\n";
    $output .= $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_CATEGORY_ITEMS_TO_DISPLAY_LABEL'). ' & ' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_CATEGORY_ITEMS_TO_DISPLAY_DESC'). ' \tabularnewline\hline '. "\r\n";
[%%FOREACH COMPONENT_OBJECT%%]
[%%IF GENERATE_CATEGORIES%%]
[%%IF GENERATE_SITE%%]
[%%ENDIF GENERATE_SITE%%]
[%%ENDIF GENERATE_CATEGORIES%%]
[%%ENDFOR COMPONENT_OBJECT%%]
    $output .= $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_NUMBER_CATEGORY_ITEMS_LABEL'). ' & ' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_NUMBER_CATEGORY_ITEMS_DESC'). ' \tabularnewline\hline '. "\r\n";
    $output .= '\textbf{' . $this->jtext2lyx('JCATEGORY'). '} & \textbf{' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_FIELD_CONFIG_CATEGORY_DESC'). '} \tabularnewline\hline '. "\r\n";
    $output .= $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_FIELD_CATEGORY_COMPONENT_LABEL'). ' & ' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_FIELD_CATEGORY_COMPONENT_DESC'). ' \tabularnewline\hline '. "\r\n";
    $output .= $this->jtext2lyx('JGLOBAL_SHOW_CATEGORY_TITLE'). ' & ' . $this->jtext2lyx('JGLOBAL_SHOW_CATEGORY_TITLE_DESC'). ' \tabularnewline\hline '. "\r\n";
    $output .= $this->jtext2lyx('JGLOBAL_SHOW_CATEGORY_DESCRIPTION_LABEL'). ' & ' . $this->jtext2lyx('JGLOBAL_SHOW_CATEGORY_DESCRIPTION_DESC'). ' \tabularnewline\hline '. "\r\n";
    $output .= $this->jtext2lyx('JGLOBAL_SHOW_CATEGORY_IMAGE_LABEL'). ' & ' . $this->jtext2lyx('JGLOBAL_SHOW_CATEGORY_IMAGE_DESC'). ' \tabularnewline\hline '. "\r\n";
    $output .= $this->jtext2lyx('JGLOBAL_SHOW_CATEGORY_HEADING_TITLE_TEXT_LABEL'). ' & ' . $this->jtext2lyx('JGLOBAL_SHOW_CATEGORY_HEADING_TITLE_TEXT_DESC'). ' \tabularnewline\hline '. "\r\n";
    $output .= $this->jtext2lyx('JGLOBAL_SHOW_EMPTY_CATEGORIES_LABEL'). ' & ' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_SHOW_EMPTY_CATEGORIES_DESC'). ' \tabularnewline\hline '. "\r\n";
    $output .= $this->jtext2lyx('JGLOBAL_SHOW_SUBCATEGORIES_DESCRIPTION_LABEL'). ' & ' . $this->jtext2lyx('JGLOBAL_SHOW_SUBCATEGORIES_DESCRIPTION_DESC'). ' \tabularnewline\hline '. "\r\n";
    $output .= $this->jtext2lyx('JGLOBAL_MAXIMUM_CATEGORY_LEVELS_LABEL'). ' & ' . $this->jtext2lyx('JGLOBAL_MAXIMUM_CATEGORY_LEVELS_DESC'). ' \tabularnewline\hline '. "\r\n";
    $output .= $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_SHOW_UNAUTH_LINKS_LABEL'). ' & ' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_SHOW_CATEGORY_UNAUTH_LINKS_DESC'). ' \tabularnewline\hline '. "\r\n";
    $output .= $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_NUMBER_CATEGORY_ITEMS_LABEL'). ' & ' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_NUMBER_CATEGORY_ITEMS_DESC'). ' \tabularnewline\hline '. "\r\n";
[%%IF INCLUDE_TAGS%%]
    $output .= $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_FIELD_SHOW_CATEGORY_TAGS_LABEL'). ' & ' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_FIELD_SHOW_CATEGORY_TAGS_DESC'). ' \tabularnewline\hline '. "\r\n";
[%%ENDIF INCLUDE_TAGS%%]
[%%ENDIF GENERATE_SITE%%]
[%%ENDIF GENERATE_CATEGORIES%%]
[%%IF INCLUDE_ASSETACL%%]
    $output .= '\textbf{' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_PERMISSIONS_LABEL'). '} & \textbf{' . $this->jtext2lyx('[%%COM_ARCHITECTCOMP%%]_PERMISSIONS_DESC'). '} \tabularnewline\hline '. "\r\n";
[%%ENDIF INCLUDE_ASSETACL%%]

        return $output;
    }

}
