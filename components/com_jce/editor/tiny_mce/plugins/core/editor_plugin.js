/* jce - 2.9.2 | 2021-01-28 | https://www.joomlacontenteditor.net | Copyright (C) 2006 - 2020 Ryan Demmer. All rights reserved | GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html */
!function(){var Entities=tinymce.html.Entities;tinymce.create("tinymce.plugins.CorePLugin",{init:function(ed,url){function isEmpty(){return"TEXTAREA"===elm.nodeName?""==elm.value:""==elm.innerHTML}function insertContent(value){return value=Entities.decode(value),value&&("TEXTAREA"===elm.nodeName?elm.value=value:elm.innerHTML=value),!0}var contentLoaded=!1,elm=ed.getElement(),startup_content_html=ed.settings.startup_content_html||"";ed.onBeforeRenderUI.add(function(){if(startup_content_html&&elm&&!contentLoaded&&isEmpty())return contentLoaded=!0,insertContent(startup_content_html)}),ed.onKeyUp.add(function(ed,e){var quoted="&ldquo;{$selection}&rdquo;";"de"==ed.settings.language&&(quoted="&bdquo;{$selection}&ldquo;"),("'"===e.key||'"'==e.key)&&e.shiftKey&&e.ctrlKey&&(ed.undoManager.add(),ed.execCommand("mceReplaceContent",!1,quoted))})}}),tinymce.PluginManager.add("core",tinymce.plugins.CorePLugin)}();