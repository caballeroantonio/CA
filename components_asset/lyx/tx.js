// JavaScript Document
/*
div.Unindented div.float div.table = hay algunos captions vacios, es deseable que
si el contenido es empty, aplicar el estilo = display: none;
 */
$(function() {
    $('html body div#globalWrapper div.fulltoc div.tocheader').each(function()
      {
        $(this).text($(this).text().replace('Table of Contents', 'Contenido '));
      }
    );
    
    $('div.toc a.Link').each(function()
      {
        $(this).text($(this).text().replace('Part ', 'Parte '));
        $(this).text($(this).text().replace('Chapter ', ' '));
        $(this).text($(this).text().replace('Section ', ' '));
        $(this).text($(this).text().replace('Subsection ', ' '));
        $(this).text($(this).text().replace('Subsubsection:', ' '));
        $(this).text($(this).text().replace('Subsubsection', ' '));
        $(this).text($(this).text().replace('.None.', '.0.'));
      }
    );
    
    $('a.toc').each(function()
      {
        $(this).text($(this).text().replace('Part ', 'Parte '));
        $(this).text($(this).text().replace('.None.', '.0.'));
      }
    );
    
    $('div.figure div.caption').each(function()
      {
        $(this).text($(this).text().replace('Figure ', 'Figura '));
      }
    );
    $('div.table div.caption').each(function()
      {
        $(this).text($(this).text().replace('Table ', 'Tabla '));
      }
    );
    
    $('div.listing div.caption').each(function()
      {
        $(this).text($(this).text().replace('Algorithm', 'Algoritmo'));
      }
    );
    
    $('table tbody tr td').each(function()
      {
        $(this).text($(this).text().replace('\\strikeout off\\uuline off\\uwave off', ''));
      }
    );
    
    $('table tbody tr td.medium').removeAttr( "bgcolor" );
    
    $('div.listing pre.listing table').parent().removeClass('listing');
	
    //pre deja espacio indeseable, lo cambiaré por div
    $('div.listing pre table').parent().replaceTag('<div>', 0, 0);
});

