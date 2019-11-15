/**
 * AdminLTE Demo Menu
 * ------------------
 * You should not use this file in production.
 * This file is for demo purposes only.
 */
$(function () {
  'use strict'

  /**
   * Get access to plugins
   */

  $('[data-toggle="control-sidebar"]').controlSidebar()
  $('[data-toggle="push-menu"]').pushMenu()

  var $pushMenu       = $('[data-toggle="push-menu"]').data('lte.pushmenu')
  var $controlSidebar = $('[data-toggle="control-sidebar"]').data('lte.controlsidebar')
  var $layout         = $('body').data('lte.layout')



  // Create the new tab
  var $tabPane = $('<div />', {
    'id'   : 'control-sidebar-theme-demo-options-tab',
    'class': 'tab-pane active'
  })

  // Create the tab button
  var $tabButton = $('<li />', { 'class': 'active' })
    .html('<a href=\'#control-sidebar-theme-demo-options-tab\' data-toggle=\'tab\'>'
      + '<i class="fa fa-wrench"></i>'
      + '</a>')

  // Add the tab button to the right sidebar tabs
  $('[href="#control-sidebar-home-tab"]')
    .parent()
    .before($tabButton)

  // Create the menu
  var $demoSettings = $('<div />')

    var direccion='';
    var ining = $('#ining').val();
    if (ining == 1) ining=1
    else if (ining == 2) ining=1
    else if (ining == 3) ining=2
    else if (ining == 4) ining=2
    else if (ining == 5) ining=3
    else if (ining == 6) ining=3
    else if (ining == 7) ining=4
    else if (ining == 8) ining=4
    else if (ining == 9) ining=5
    else if (ining == 10) ining=5
    else if (ining == 11) ining=6
    else if (ining == 12) ining=6
    else if (ining == 13) ining=7
    else if (ining == 14) ining=7
    else if (ining == 15) ining=8
    else if (ining == 16) ining=8
    else if (ining == 17) ining=9
    else if (ining == 18) ining=9
    else if (ining == 19) ining=10
    else if (ining == 20) ining=10
    else if (ining == 21) ining=11
    else if (ining == 22) ining=11
    else if (ining == 23) ining=12
    else if (ining == 24) ining=12
    else if (ining == 25) ining=13
    else if (ining == 26) ining=13

     if (ining == 1 || ining == 3 || ining == 5 || ining == 7 || ining == 9 || ining == 11 || ining == 13 || ining == 15 || ining == 17 || ining == 19 || ining == 21 || ining == 23 || ining == 25)
         ining+='▲';
     else
         ining+='▼';

  // Layout options
  $demoSettings.append(
    '<h4 class="control-sidebar-heading">'
    + 'Pizarra Electrónica'
    + '</h4>'
    // Fixed layout
    + '<table>\n' +
      '   <tr>\n' +
      '     <td align="center">\n' +
      '       <strong>Ining: </strong>' +
              ining +
      '     </td>\n' +
      '     <td align="center">\n' +
      '       <img src="/obdulio/web/public/images/bases/0.jpg' +
      '     </td>' +
      '   </tr>' +
      '</table>'

  )

  $tabPane.append($demoSettings)
  $('#control-sidebar-home-tab').after($tabPane)

  setup()

  $('[data-toggle="tooltip"]').tooltip()
})
