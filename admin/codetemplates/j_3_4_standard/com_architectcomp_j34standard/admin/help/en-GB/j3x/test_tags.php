Titulo=[%%ArchitectComp_name%%]=TSJ CDMX Libros CompArch
Nombre del paquete com_architectcomp=[%%com_architectcomp%%]=com_jt
Descripción [%%Architectcomp_description_ini%%]=<p>voy a comenzar con un libro de ejemplo y de allí iré avanzando.</p>
Release [%%COMPONENTSTARTVERSION%%]
Copyright [%%COMPONENTCOPYRIGHT%%]=Copyright (c)2013 - 3000. All Rights Reserved
COMPONENTSTARTVERSION=[%%COMPONENTSTARTVERSION%%]=1.0.0
COMPONENTAUTHOR=[%%COMPONENTAUTHOR%%]=caballeroantonio
COMPONENTWEBSITE=[%%COMPONENTWEBSITE%%]=caballeroantonio.com


architectcomp_name=[%%architectcomp_name%%]=tsj cdmx libros comparch
COM_ARCHITECTCOMP=[%%COM_ARCHITECTCOMP%%]=COM_JT
ARCHITECTCOMP=[%%ARCHITECTCOMP%%]=JT
ArchitectComp=[%%ArchitectComp%%]=¿?
architectcomp[%%architectcomp%%]=jt

[%%compobjectprefix%%]=#__


[%%FOREACH COMPONENT_OBJECT%%]{1.0}
	{COMPONENT_OBJECT}
    Compobject_name=[%%Compobject_name%%]=Libro de ejemplo
    Compobject_description_ini=[%%Compobject_description_ini%%]=<p>el libro de ejeplo sliver para ......</p>
	
    COMPOBJECT=[%%COMPOBJECT%%]=JTLEJEMPLO
    compobject=[%%compobject%%]=jtlejemplo
    
    compobject_name=[%%compobject_name%%]=libro de ejemplo
    CompObject_short_name=[%%CompObject_short_name%%]=Jtlejemplo
    Compobject_short_name=[%%Compobject_short_name%%]=Jtlejemplo
    compobject_short_name=[%%compobject_short_name%%]=jtlejemplo
    
    COMPOBJECTPLURAL=[%%COMPOBJECTPLURAL%%]=LEJEMPLO
    compobjectplural=[%%compobjectplural%%]=lejemplo
    compobject_plural_name=[%%compobject_plural_name%%]=ejemplos
    CompObject_plural_name=[%%CompObject_plural_name%%]=Ejemplos
    compobject_short_plural_name=[%%compobject_short_plural_name%%]=jtlejemploes
    CompObject_short_plural_name=[%%CompObject_short_plural_name%%]=Jtlejemploes
    
    
    [%%FOREACH OBJECT_FIELDSET%%]
        {OBJECT_FIELDSET}
    	FIELDSET_CODE_NAME_UPPER=[%%FIELDSET_CODE_NAME_UPPER%%]=JTLEJEMPLOFS
        FIELDSET_NAME=[%%FIELDSET_NAME%%]=jtl_ejemplo_fs
        FIELDSET_CODE_NAME_UPPER=[%%FIELDSET_CODE_NAME_UPPER%%]=JTLEJEMPLOFS
        FIELDSET_DESCRIPTION=[%%FIELDSET_DESCRIPTION%%]=""¿4?
        
        [%%FOREACH OBJECT_FIELD%%]{1.1}
            {OBJECT_FIELD}
            FIELD_OPTIONS_LANGUAGE_VARS=[%%FIELD_OPTIONS_LANGUAGE_VARS%%]=¿?
            FIELD_CODE_NAME_UPPER=[%%FIELD_CODE_NAME_UPPER%%]=¿?
                        
            FIELD_INTRO=[%%FIELD_INTRO%%]=¿?
            FIELD_DESCRIPTION_INI=[%%FIELD_DESCRIPTION_INI%%]=¿?
            
            `[%%FIELD_CODE_NAME%%]` [%%FIELD_DBTYPEANDSIZE%%] [%%FIELD_DBDEFAULT%%] 
            COMMENT '[%%FIELD_DBCOMMENT%%]',

            
            [%%IF FIELD_LINK%%]
                {FIELD_LINK}
                FIELD_FOREIGN_OBJECT_ACRONYM_UPPER=[%%FIELD_FOREIGN_OBJECT_ACRONYM_UPPER%%]=¿?
                FIELD_FOREIGN_OBJECT_UPPER=[%%FIELD_FOREIGN_OBJECT_UPPER%%]=¿?
            [%%ENDIF FIELD_LINK%%]

            [%%FOREACH VALIDATE_FIELD%%]
            	{VALIDATE_FIELD}
                FIELD_CUSTOM_ERROR_MESSAGE=[%%FIELD_CUSTOM_ERROR_MESSAGE%%]
            [%%ENDFOR VALIDATE_FIELD%%]        

        
        [%%FOREACH REGISTRY_FIELD%%]{1.2}
            {REGISTRY_FIELD}
            `[%%FIELD_CODE_NAME%%]` [%%FIELD_DBTYPEANDSIZE%%] [%%FIELD_DBDEFAULT%%],
            [%%FOREACH REGISTRY_ENTRY%%]
                {REGISTRY_ENTRY}
            [%%ENDFOR REGISTRY_ENTRY%%]
        [%%ENDFOR REGISTRY_FIELD%%]{-1.2}

        

        
[%%ENDFOR OBJECT_FIELD%%]{-1.1}
        {1.1a}[%%FOREACH OBJECT_FIELD%%]
            FIELD_NAME=[%%FIELD_NAME%%]
            FIELD_NAME_LYX=[%%FIELD_NAME_LYX%%]
            FIELD_CODE_NAME=[%%FIELD_CODE_NAME%%]
            FIELD_CODE_NAME_LYX=[%%FIELD_CODE_NAME_LYX%%]
            FIELD_DBCOMMENT=[%%FIELD_DBCOMMENT%%]
            FIELD_DBCOMMENT_LYX=[%%FIELD_DBCOMMENT_LYX%%]
            
            
		{-1.1a}[%%ENDFOR OBJECT_FIELD%%]
    [%%ENDFOR OBJECT_FIELDSET%%]

=======IF'S==========
[%%IF INCLUDE_DESCRIPTION%%]
	INCLUDE_DESCRIPTION OTRA DESCRIPCIÓN !!!
[%%ELSE INCLUDE_DESCRIPTION%%]
	INCLUDE_DESCRIPTION OTRA DESCRIPCIÓN !!!
[%%ENDIF INCLUDE_DESCRIPTION%%]


=======/IF'S==========



======/REGISTRY_ENTRY=====

        

    
    [%%IF GENERATE_SITE_LAYOUT_ARTICLE%%]
	    {GENERATE_SITE_LAYOUT_ARTICLE}
    [%%ENDIF GENERATE_SITE_LAYOUT_ARTICLE%%]
    
    [%%IF GENERATE_SITE_LAYOUT_BLOG%%]
    	{GENERATE_SITE_LAYOUT_BLOG}
    [%%ENDIF GENERATE_SITE_LAYOUT_BLOG%%]
    
        [%%FOREACH FILTER_FIELD%%]{1.3}
        	{FILTER_FIELD}
        [%%ENDFOR FILTER_FIELD%%]{-1.3}
    
[%%ENDFOR COMPONENT_OBJECT%%]{-1.0}

    [%%IF GENERATE_PLUGINS%%]
    	{GENERATE_PLUGINS}        
        [%%IF GENERATE_PLUGINS_VOTE%%]
            {GENERATE_PLUGINS_VOTE}
        [%%ENDIF GENERATE_PLUGINS_VOTE%%]
        
        [%%IF GENERATE_PLUGINS_EMAILCLOAK%%]
            {GENERATE_PLUGINS_EMAILCLOAK}
        [%%ENDIF GENERATE_PLUGINS_EMAILCLOAK%%]

        [%%IF GENERATE_PLUGINS_PAGEBREAK%%]
            {GENERATE_PLUGINS_PAGEBREAK}
        [%%ENDIF GENERATE_PLUGINS_PAGEBREAK%%]
        	
        [%%IF GENERATE_PLUGINS_ITEMNAVIGATION%%]
            {GENERATE_PLUGINS_ITEMNAVIGATION}
        [%%ENDIF GENERATE_PLUGINS_ITEMNAVIGATION%%]
        
        [%%IF GENERATE_PLUGINS_LOADMODULE%%]
            {GENERATE_PLUGINS_LOADMODULE}
        [%%ENDIF GENERATE_PLUGINS_LOADMODULE%%]
    [%%ENDIF GENERATE_PLUGINS%%]


========NO SE DONDE VAN============
[%%IF INCLUDE_BATCH%%] 
    {HAVE BATCH}
[%%ENDIF INCLUDE_BATCH%%] 

[%%IF INCLUDE_COPY%%]
    {HAVE COPY}
[%%ENDIF INCLUDE_COPY%%]

[%%IF INCLUDE_ORDERING%%]
    {HAVE ORDERING}
[%%ENDIF INCLUDE_ORDERING%%]

[%%IF GENERATE_CATEGORIES%%]
    {HAVE GENERATE_CATEGORIES}
[%%ENDIF GENERATE_CATEGORIES%%]

[%%IF GENERATE_SITE_LAYOUT_BLOG%%]
    {GENERATE_SITE_LAYOUT_BLOG}
[%%ENDIF GENERATE_SITE_LAYOUT_BLOG%%]

[%%IF INCLUDE_PARAMS_RECORD%%]
	{INCLUDE_PARAMS_RECORD}
[%%ENDIF INCLUDE_PARAMS_RECORD%%]

[%%IF INCLUDE_ASSETACL%%]
	{INCLUDE_ASSETACL}
[%%ENDIF INCLUDE_ASSETACL%%]

[%%IF INCLUDE_ALIAS%%]
	{INCLUDE_ALIAS}
[%%ENDIF INCLUDE_ALIAS%%]

[%%IF GENERATE_CATEGORIES%%]
	{GENERATE_CATEGORIES}
[%%ENDIF GENERATE_CATEGORIES%%]

[%%IF INCLUDE_NAME%%]
	{INCLUDE_NAME}
[%%ENDIF INCLUDE_NAME%%]

[%%IF INCLUDE_ACCESS%%]
	{INCLUDE_ACCESS}
[%%ENDIF INCLUDE_ACCESS%%]

[%%IF INCLUDE_LANGUAGE%%]
	{INCLUDE_LANGUAGE}
[%%ENDIF INCLUDE_LANGUAGE%%]

[%%IF INCLUDE_IMAGE%%]
	{INCLUDE_IMAGE}
[%%ENDIF INCLUDE_IMAGE%%]

[%%IF GENERATE_SITE%%]
	{GENERATE_SITE}
[%%ENDIF GENERATE_SITE%%]

[%%IF INCLUDE_PARAMS_GLOBAL%%]
	{INCLUDE_PARAMS_GLOBAL}
[%%ENDIF INCLUDE_PARAMS_GLOBAL%%] 

[%%IF INCLUDE_STATUS%%]
	{INCLUDE_STATUS}
[%%ENDIF INCLUDE_STATUS%%]

[%%IF INCLUDE_MODIFIED%%]
	{INCLUDE_MODIFIED}
[%%ENDIF INCLUDE_MODIFIED%%]

[%%IF INCLUDE_CREATED%%]
	{INCLUDE_CREATED}
[%%ENDIF INCLUDE_CREATED%%]

[%%IF INCLUDE_INTRO%%]
	{INCLUDE_INTRO}
[%%ENDIF INCLUDE_INTRO%%]

[%%IF INCLUDE_TAGS%%]
	{INCLUDE_TAGS}
[%%ENDIF INCLUDE_TAGS%%]

[%%IF INCLUDE_URLS%%]
	{INCLUDE_URLS}
[%%ENDIF INCLUDE_URLS%%]

[%%IF INCLUDE_PARAMS_MENU%%]
	{INCLUDE_PARAMS_MENU}
[%%ENDIF INCLUDE_PARAMS_MENU%%]

[%%IF INCLUDE_PUBLISHED_DATES%%]
	{INCLUDE_PUBLISHED_DATES}
[%%ENDIF INCLUDE_PUBLISHED_DATES%%]

[%%IF INCLUDE_METADATA%%]
	{INCLUDE_METADATA}
[%%ENDIF INCLUDE_METADATA%%]

[%%IF INCLUDE_CHECKOUT%%]
	{INCLUDE_CHECKOUT}
[%%ENDIF INCLUDE_CHECKOUT%%]

[%%IF INCLUDE_HITS%%]
	{INCLUDE_HITS}
[%%ENDIF INCLUDE_HITS%%]

[%%IF INCLUDE_VERSIONS%%]
	{INCLUDE_VERSIONS}
[%%ENDIF INCLUDE_VERSIONS%%]

[%%IF INCLUDE_FEATURED%%]
	{INCLUDE_FEATURED}
[%%ENDIF INCLUDE_FEATURED%%]