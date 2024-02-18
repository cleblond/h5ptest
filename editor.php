<?php


// Include the necessary H5P classes.
//require_once 'path/to/h5p/H5PPlugin.php';
require_once 'h5p-php-library/h5p.classes.php';

//require_once 'h5p-php-library/h5p.classes.php';

require_once 'h5p-php-library/h5p-file-storage.interface.php';
require_once 'h5p-php-library/h5p-default-storage.class.php';
require_once 'h5p-php-library/h5p-development.class.php';

require_once 'h5p-editor-php-library/h5peditor.class.php';
require_once 'h5p-editor-php-library/h5peditor-ajax.class.php';
require_once 'h5p-editor-php-library/h5peditor-storage.interface.php';


require_once 'class-h5p-grav.php';
require_once 'class-h5p-editor-grav-storage.php';


// Define some necessary constants and variables.
define('H5P_FILE_PATH', '/h5ptest/files');
define('H5P_URL', 'http://localhost/h5ptest');
define('H5P_EDITOR_URL', 'http://localhost/h5ptest/editor.php');

$my_h5p_framework = new MyH5PFramework();

// Set up the file storage class.
$h5p_fs = new H5PDefaultStorage(H5P_FILE_PATH);

// Set up the core H5P class.
//$h5p_core = new H5PCore($h5p_fs, H5P_URL, H5P_EDITOR_URL, 'en', false);
$h5p_core = new H5PCore($my_h5p_framework, H5P_FILE_PATH, H5P_URL, 'en', false);

// Set up the H5P editor class.
//$h5p_editor_fs = new H5PEditorStorage(H5P_FILE_PATH);
//$h5p_editor_fs = new H5PEditorGravStorage(H5P_FILE_PATH);
//var_dump($h5p_editor_fs);


$my_h5p_editor_storage = new H5PEditorGravStorage();




$h5p_editor = new H5peditor($h5p_core, $my_h5p_editor_storage, 'files');


//$editor = $h5p_editor->getEditor($content_id);
//echo $editor;

echo "<pre>";
//var_dump($h5p_editor);
echo "</pre>";

//var_dump($h5p_editor);


/*
// Load the editor.
$core_scripts = $h5p_core->getScripts();
$editor_scripts = $h5p_editor->getScripts();

// Combine the scripts from H5P core and editor.
$scripts = array_merge($core_scripts, $editor_scripts);

// Output the script tags for the combined scripts.
foreach ($scripts as $script) {
    echo "<script src='$script'></script>\n";
}
*/

// Create a new H5P content or load an existing one.
$content_id = null; // Set this to the ID of the content you want to edit, or leave it as null to create a new content.
//$editor = $h5p_editor->getEditor($content_id);

// Output the editor HTML.
//echo $editor;


$h5pIntegration = [
    'baseUrl' => 'http://localhost', // URL to your site
    'url' => 'http://localhost/h5ptest', // URL to the H5P content
    'postUserStatistics' => false, // Whether to post user statistics
    'ajax' => [
        'setFinished' => 'http://localhost/h5ptest/h5p-ajax-endpoint', // Endpoint for recording results
    ],
    'l10n' => [
        'H5P' => [
            'fullscreen' => 'Fullscreen',
            'disableFullscreen' => 'Disable fullscreen',
            // Other translations for the H5P namespace
        ],
        // Other translation namespaces
    ],
    // Other necessary settings and data
];

echo '<script>
    //var H5PIntegration = ' . json_encode($h5pIntegration) . ';
</script>';





?>

<!DOCTYPE html>
<head>
    <title>H5P Editor</title>
    <!-- Include H5P core and editor styles -->
    
    <!--
    <link rel="stylesheet" href="path/to/h5p-php-library/styles/h5p.css">
    <link rel="stylesheet" href="path/to/h5p-editor-php-library/styles/h5peditor.css">
    -->
    
    <!-- Include H5P core and editor scripts -->
    

    



</head>

    <body>
          
          
          <div id="minor-publishing" <?php if (/*get_option('h5p_hub_is_enabled', TRUE)*/1) : print 'style="display:none"'; endif; ?>>
          <label><input type="radio" name="action" value="upload"<?php //if ($upload): print ' checked="checked"'; endif; ?>/><?php //esc_html_e('Upload', $this->plugin_slug); ?></label>
          <label><input type="radio" name="action" value="create"/><?php //esc_html_e('Create', $this->plugin_slug); ?></label>
          
          
          
          
          <input type="hidden" name="library" value="<?php //print esc_attr($library); ?>"/>
          <input type="hidden" name="parameters" value="<?php //print $parameters; ?>"/>
          </div>
    
    
    
    
            <div class="h5p-upload">
              <input type="file" name="h5p_file" id="h5p-file"/>
              <?php //if (current_user_can('disable_h5p_security')): ?>
                <div class="h5p-disable-file-check">
                  <label><input type="checkbox" name="h5p_disable_file_check" id="h5p-disable-file-check"/> <?php //_e('Disable file extension check', $this->plugin_slug); ?></label>
                  <div class="h5p-warning"><?php //_e("Warning! This may have security implications as it allows for uploading php files. That in turn could make it possible for attackers to execute malicious code on your site. Please make sure you know exactly what you're uploading.", $this->plugin_slug); ?></div>
                </div>
              <?php //endif; ?>
            </div>
    
    
            <div class="h5p-create"><div class="h5p-editor"></div></div>
    
    <!--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
    
    </body>


<script>

var H5PIntegration = {
  "editor" : {"libraryUrl": "/var/www/html/h5ptest/"},
  "baseUrl": "http://www.mysite.com", // No trailing slash
  "url": "/path/to/h5p-dir",          // Relative to web root
  "postUserStatistics": true,         // Only if user is logged in 
  "ajaxPath": "/path/to/h5p-ajax",     // Only used by older Content Types
  "ajax": {
    // Where to post user results
    "setFinished": "/interactive-contents/123/results/new", 
    // Words beginning with : are placeholders
    "contentUserData": "/interactive-contents/:contentId/user-data?data_type=:dataType&subContentId=:subContentId"
  },
  "saveFreq": 30, // How often current content state should be saved. false to disable.
  "user": { // Only if logged in !
    "name": "User Name",
    "mail": "user@mysite.com"
  },
  "siteUrl": "http://www.mysite.com", // Only if NOT logged in!
  "l10n": { // Text string translations
    "H5P": { 
      "fullscreen": "Fullscreen",
      "disableFullscreen": "Disable fullscreen",
      "download": "Download",
      "copyrights": "Rights of use",
      "embed": "Embed",
      "size": "Size",
      "showAdvanced": "Show advanced",
      "hideAdvanced": "Hide advanced",
      "advancedHelp": "Include this script on your website if you want dynamic sizing of the embedded content:",
      "copyrightInformation": "Rights of use",
      "close": "Close",
      "title": "Title",
      "author": "Author",
      "year": "Year",
      "source": "Source",
      "license": "License",
      "thumbnail": "Thumbnail",
      "noCopyrights": "No copyright information available for this content.",
      "downloadDescription": "Download this content as a H5P file.",
      "copyrightsDescription": "View copyright information for this content.",
      "embedDescription": "View the embed code for this content.",
      "h5pDescription": "Visit H5P.org to check out more cool content.",
      "contentChanged": "This content has changed since you last used it.",
      "startingOver": "You'll be starting over.",
      "by": "by",
      "showMore": "Show more",
      "showLess": "Show less",
      "subLevel": "Sublevel"
    } 
  },
  "loadedJs": ['multichoice.js'], // Only required when Embed Type = div
  "loadedCss": []
};




var H5PIntegration = {
    "baseUrl": "http://localhost/wordpress",
    "url": "/wordpress/wp-content/uploads/h5p",
    "postUserStatistics": true,
    "ajax": {
        "setFinished": "http://localhost/wordpress/wp-admin/admin-ajax.php?token=64588136bf&action=h5p_setFinished",
        "contentUserData": "http://localhost/wordpress/wp-admin/admin-ajax.php?token=24a7d3ad74&action=h5p_contents_user_data&content_id=:contentId&data_type=:dataType&sub_content_id=:subContentId"
    },
    "saveFreq": false,
    "siteUrl": "http://localhost/wordpress",
    "l10n": {
        "H5P": {
            "fullscreen": "Fullscreen",
            "disableFullscreen": "Disable fullscreen",
            "download": "Download",
            "copyrights": "Rights of use",
            "embed": "Embed",
            "size": "Size",
            "showAdvanced": "Show advanced",
            "hideAdvanced": "Hide advanced",
            "advancedHelp": "Include this script on your website if you want dynamic sizing of the embedded content:",
            "copyrightInformation": "Rights of use",
            "close": "Close",
            "title": "Title",
            "author": "Author",
            "year": "Year",
            "source": "Source",
            "license": "License",
            "thumbnail": "Thumbnail",
            "noCopyrights": "No copyright information available for this content.",
            "reuse": "Reuse",
            "reuseContent": "Reuse Content",
            "reuseDescription": "Reuse this content.",
            "downloadDescription": "Download this content as a H5P file.",
            "copyrightsDescription": "View copyright information for this content.",
            "embedDescription": "View the embed code for this content.",
            "h5pDescription": "Visit H5P.org to check out more cool content.",
            "contentChanged": "This content has changed since you last used it.",
            "startingOver": "You'll be starting over.",
            "by": "by",
            "showMore": "Show more",
            "showLess": "Show less",
            "subLevel": "Sublevel",
            "confirmDialogHeader": "Confirm action",
            "confirmDialogBody": "Please confirm that you wish to proceed. This action is not reversible.",
            "cancelLabel": "Cancel",
            "confirmLabel": "Confirm",
            "licenseU": "Undisclosed",
            "licenseCCBY": "Attribution",
            "licenseCCBYSA": "Attribution-ShareAlike",
            "licenseCCBYND": "Attribution-NoDerivs",
            "licenseCCBYNC": "Attribution-NonCommercial",
            "licenseCCBYNCSA": "Attribution-NonCommercial-ShareAlike",
            "licenseCCBYNCND": "Attribution-NonCommercial-NoDerivs",
            "licenseCC40": "4.0 International",
            "licenseCC30": "3.0 Unported",
            "licenseCC25": "2.5 Generic",
            "licenseCC20": "2.0 Generic",
            "licenseCC10": "1.0 Generic",
            "licenseGPL": "General Public License",
            "licenseV3": "Version 3",
            "licenseV2": "Version 2",
            "licenseV1": "Version 1",
            "licensePD": "Public Domain",
            "licenseCC010": "CC0 1.0 Universal (CC0 1.0) Public Domain Dedication",
            "licensePDM": "Public Domain Mark",
            "licenseC": "Copyright",
            "contentType": "Content Type",
            "licenseExtras": "License Extras",
            "changes": "Changelog",
            "contentCopied": "Content is copied to the clipboard",
            "connectionLost": "Connection lost. Results will be stored and sent when you regain connection.",
            "connectionReestablished": "Connection reestablished.",
            "resubmitScores": "Attempting to submit stored results.",
            "offlineDialogHeader": "Your connection to the server was lost",
            "offlineDialogBody": "We were unable to send information about your completion of this task. Please check your internet connection.",
            "offlineDialogRetryMessage": "Retrying in :num....",
            "offlineDialogRetryButtonLabel": "Retry now",
            "offlineSuccessfulSubmit": "Successfully submitted results."
        }
    },
    "hubIsEnabled": true,
    "reportingIsEnabled": false,
    "libraryConfig": null,
    "crossorigin": null,
    "crossoriginCacheBuster": null,
    "pluginCacheBuster": "?v=1.15.7",
    "libraryUrl": "http://localhost/wordpress/wp-content/plugins/h5p/h5p-php-library/js",
    "user": {
        "name": "cleblond",
        "mail": "openochem@gmail.com"
    },
    "core": {
        "styles": [
            "/wordpress/wp-content/plugins/h5p/h5p-php-library/styles/h5p.css?ver=1.15.7",
            "/wordpress/wp-content/plugins/h5p/h5p-php-library/styles/h5p-confirmation-dialog.css?ver=1.15.7",
            "/wordpress/wp-content/plugins/h5p/h5p-php-library/styles/h5p-core-button.css?ver=1.15.7"
        ],
        "scripts": [
            "/wordpress/wp-content/plugins/h5p/h5p-php-library/js/jquery.js?ver=1.15.7",
            "/wordpress/wp-content/plugins/h5p/h5p-php-library/js/h5p.js?ver=1.15.7",
            "/wordpress/wp-content/plugins/h5p/h5p-php-library/js/h5p-event-dispatcher.js?ver=1.15.7",
            "/wordpress/wp-content/plugins/h5p/h5p-php-library/js/h5p-x-api-event.js?ver=1.15.7",
            "/wordpress/wp-content/plugins/h5p/h5p-php-library/js/h5p-x-api.js?ver=1.15.7",
            "/wordpress/wp-content/plugins/h5p/h5p-php-library/js/h5p-content-type.js?ver=1.15.7",
            "/wordpress/wp-content/plugins/h5p/h5p-php-library/js/h5p-confirmation-dialog.js?ver=1.15.7",
            "/wordpress/wp-content/plugins/h5p/h5p-php-library/js/h5p-action-bar.js?ver=1.15.7",
            "/wordpress/wp-content/plugins/h5p/h5p-php-library/js/request-queue.js?ver=1.15.7"
        ]
    },
    "loadedJs": [],
    "loadedCss": [],
    "editor": {
        "filesPath": "/wordpress/wp-content/uploads/h5p/editor",
        "fileIcon": {
            "path": "http://localhost/wordpress/wp-content/plugins/h5p/h5p-editor-php-library/images/binary-file.png",
            "width": 50,
            "height": 50
        },
        "ajaxPath": "http://localhost/wordpress/wp-admin/admin-ajax.php?token=2126142daa&action=h5p_",
        "libraryUrl": "http://localhost/h5ptest/h5p-editor-php-library/",
        "copyrightSemantics": {
            "name": "copyright",
            "type": "group",
            "label": "Copyright information",
            "fields": [
                {
                    "name": "title",
                    "type": "text",
                    "label": "Title",
                    "placeholder": "La Gioconda",
                    "optional": true
                },
                {
                    "name": "author",
                    "type": "text",
                    "label": "Author",
                    "placeholder": "Leonardo da Vinci",
                    "optional": true
                },
                {
                    "name": "year",
                    "type": "text",
                    "label": "Year(s)",
                    "placeholder": "1503 - 1517",
                    "optional": true
                },
                {
                    "name": "source",
                    "type": "text",
                    "label": "Source",
                    "placeholder": "http://en.wikipedia.org/wiki/Mona_Lisa",
                    "optional": true,
                    "regexp": {
                        "pattern": "^http[s]?://.+",
                        "modifiers": "i"
                    }
                },
                {
                    "name": "license",
                    "type": "select",
                    "label": "License",
                    "default": "U",
                    "options": [
                        {
                            "value": "U",
                            "label": "Undisclosed"
                        },
                        {
                            "value": "CC BY",
                            "label": "Attribution",
                            "versions": [
                                {
                                    "value": "4.0",
                                    "label": "4.0 International"
                                },
                                {
                                    "value": "3.0",
                                    "label": "3.0 Unported"
                                },
                                {
                                    "value": "2.5",
                                    "label": "2.5 Generic"
                                },
                                {
                                    "value": "2.0",
                                    "label": "2.0 Generic"
                                },
                                {
                                    "value": "1.0",
                                    "label": "1.0 Generic"
                                }
                            ]
                        },
                        {
                            "value": "CC BY-SA",
                            "label": "Attribution-ShareAlike",
                            "versions": [
                                {
                                    "value": "4.0",
                                    "label": "4.0 International"
                                },
                                {
                                    "value": "3.0",
                                    "label": "3.0 Unported"
                                },
                                {
                                    "value": "2.5",
                                    "label": "2.5 Generic"
                                },
                                {
                                    "value": "2.0",
                                    "label": "2.0 Generic"
                                },
                                {
                                    "value": "1.0",
                                    "label": "1.0 Generic"
                                }
                            ]
                        },
                        {
                            "value": "CC BY-ND",
                            "label": "Attribution-NoDerivs",
                            "versions": [
                                {
                                    "value": "4.0",
                                    "label": "4.0 International"
                                },
                                {
                                    "value": "3.0",
                                    "label": "3.0 Unported"
                                },
                                {
                                    "value": "2.5",
                                    "label": "2.5 Generic"
                                },
                                {
                                    "value": "2.0",
                                    "label": "2.0 Generic"
                                },
                                {
                                    "value": "1.0",
                                    "label": "1.0 Generic"
                                }
                            ]
                        },
                        {
                            "value": "CC BY-NC",
                            "label": "Attribution-NonCommercial",
                            "versions": [
                                {
                                    "value": "4.0",
                                    "label": "4.0 International"
                                },
                                {
                                    "value": "3.0",
                                    "label": "3.0 Unported"
                                },
                                {
                                    "value": "2.5",
                                    "label": "2.5 Generic"
                                },
                                {
                                    "value": "2.0",
                                    "label": "2.0 Generic"
                                },
                                {
                                    "value": "1.0",
                                    "label": "1.0 Generic"
                                }
                            ]
                        },
                        {
                            "value": "CC BY-NC-SA",
                            "label": "Attribution-NonCommercial-ShareAlike",
                            "versions": [
                                {
                                    "value": "4.0",
                                    "label": "4.0 International"
                                },
                                {
                                    "value": "3.0",
                                    "label": "3.0 Unported"
                                },
                                {
                                    "value": "2.5",
                                    "label": "2.5 Generic"
                                },
                                {
                                    "value": "2.0",
                                    "label": "2.0 Generic"
                                },
                                {
                                    "value": "1.0",
                                    "label": "1.0 Generic"
                                }
                            ]
                        },
                        {
                            "value": "CC BY-NC-ND",
                            "label": "Attribution-NonCommercial-NoDerivs",
                            "versions": [
                                {
                                    "value": "4.0",
                                    "label": "4.0 International"
                                },
                                {
                                    "value": "3.0",
                                    "label": "3.0 Unported"
                                },
                                {
                                    "value": "2.5",
                                    "label": "2.5 Generic"
                                },
                                {
                                    "value": "2.0",
                                    "label": "2.0 Generic"
                                },
                                {
                                    "value": "1.0",
                                    "label": "1.0 Generic"
                                }
                            ]
                        },
                        {
                            "value": "GNU GPL",
                            "label": "General Public License",
                            "versions": [
                                {
                                    "value": "v3",
                                    "label": "Version 3"
                                },
                                {
                                    "value": "v2",
                                    "label": "Version 2"
                                },
                                {
                                    "value": "v1",
                                    "label": "Version 1"
                                }
                            ]
                        },
                        {
                            "value": "PD",
                            "label": "Public Domain",
                            "versions": [
                                {
                                    "value": "-",
                                    "label": "-"
                                },
                                {
                                    "value": "CC0 1.0",
                                    "label": "CC0 1.0 Universal"
                                },
                                {
                                    "value": "CC PDM",
                                    "label": "Public Domain Mark"
                                }
                            ]
                        },
                        {
                            "value": "C",
                            "label": "Copyright"
                        }
                    ]
                },
                {
                    "name": "version",
                    "type": "select",
                    "label": "License Version",
                    "options": []
                }
            ]
        },
        "metadataSemantics": [
            {
                "name": "title",
                "type": "text",
                "label": "Title",
                "placeholder": "La Gioconda"
            },
            {
                "name": "license",
                "type": "select",
                "label": "License",
                "default": "U",
                "options": [
                    {
                        "value": "U",
                        "label": "Undisclosed"
                    },
                    {
                        "type": "optgroup",
                        "label": "Creative Commons",
                        "options": [
                            {
                                "value": "CC BY",
                                "label": "Attribution (CC BY)",
                                "versions": [
                                    {
                                        "value": "4.0",
                                        "label": "4.0 International"
                                    },
                                    {
                                        "value": "3.0",
                                        "label": "3.0 Unported"
                                    },
                                    {
                                        "value": "2.5",
                                        "label": "2.5 Generic"
                                    },
                                    {
                                        "value": "2.0",
                                        "label": "2.0 Generic"
                                    },
                                    {
                                        "value": "1.0",
                                        "label": "1.0 Generic"
                                    }
                                ]
                            },
                            {
                                "value": "CC BY-SA",
                                "label": "Attribution-ShareAlike (CC BY-SA)",
                                "versions": [
                                    {
                                        "value": "4.0",
                                        "label": "4.0 International"
                                    },
                                    {
                                        "value": "3.0",
                                        "label": "3.0 Unported"
                                    },
                                    {
                                        "value": "2.5",
                                        "label": "2.5 Generic"
                                    },
                                    {
                                        "value": "2.0",
                                        "label": "2.0 Generic"
                                    },
                                    {
                                        "value": "1.0",
                                        "label": "1.0 Generic"
                                    }
                                ]
                            },
                            {
                                "value": "CC BY-ND",
                                "label": "Attribution-NoDerivs (CC BY-ND)",
                                "versions": [
                                    {
                                        "value": "4.0",
                                        "label": "4.0 International"
                                    },
                                    {
                                        "value": "3.0",
                                        "label": "3.0 Unported"
                                    },
                                    {
                                        "value": "2.5",
                                        "label": "2.5 Generic"
                                    },
                                    {
                                        "value": "2.0",
                                        "label": "2.0 Generic"
                                    },
                                    {
                                        "value": "1.0",
                                        "label": "1.0 Generic"
                                    }
                                ]
                            },
                            {
                                "value": "CC BY-NC",
                                "label": "Attribution-NonCommercial (CC BY-NC)",
                                "versions": [
                                    {
                                        "value": "4.0",
                                        "label": "4.0 International"
                                    },
                                    {
                                        "value": "3.0",
                                        "label": "3.0 Unported"
                                    },
                                    {
                                        "value": "2.5",
                                        "label": "2.5 Generic"
                                    },
                                    {
                                        "value": "2.0",
                                        "label": "2.0 Generic"
                                    },
                                    {
                                        "value": "1.0",
                                        "label": "1.0 Generic"
                                    }
                                ]
                            },
                            {
                                "value": "CC BY-NC-SA",
                                "label": "Attribution-NonCommercial-ShareAlike (CC BY-NC-SA)",
                                "versions": [
                                    {
                                        "value": "4.0",
                                        "label": "4.0 International"
                                    },
                                    {
                                        "value": "3.0",
                                        "label": "3.0 Unported"
                                    },
                                    {
                                        "value": "2.5",
                                        "label": "2.5 Generic"
                                    },
                                    {
                                        "value": "2.0",
                                        "label": "2.0 Generic"
                                    },
                                    {
                                        "value": "1.0",
                                        "label": "1.0 Generic"
                                    }
                                ]
                            },
                            {
                                "value": "CC BY-NC-ND",
                                "label": "Attribution-NonCommercial-NoDerivs (CC BY-NC-ND)",
                                "versions": [
                                    {
                                        "value": "4.0",
                                        "label": "4.0 International"
                                    },
                                    {
                                        "value": "3.0",
                                        "label": "3.0 Unported"
                                    },
                                    {
                                        "value": "2.5",
                                        "label": "2.5 Generic"
                                    },
                                    {
                                        "value": "2.0",
                                        "label": "2.0 Generic"
                                    },
                                    {
                                        "value": "1.0",
                                        "label": "1.0 Generic"
                                    }
                                ]
                            },
                            {
                                "value": "CC0 1.0",
                                "label": "Public Domain Dedication (CC0)"
                            },
                            {
                                "value": "CC PDM",
                                "label": "Public Domain Mark (PDM)"
                            }
                        ]
                    },
                    {
                        "value": "GNU GPL",
                        "label": "General Public License v3"
                    },
                    {
                        "value": "PD",
                        "label": "Public Domain"
                    },
                    {
                        "value": "ODC PDDL",
                        "label": "Public Domain Dedication and Licence"
                    },
                    {
                        "value": "C",
                        "label": "Copyright"
                    }
                ]
            },
            {
                "name": "licenseVersion",
                "type": "select",
                "label": "License Version",
                "options": [
                    {
                        "value": "4.0",
                        "label": "4.0 International"
                    },
                    {
                        "value": "3.0",
                        "label": "3.0 Unported"
                    },
                    {
                        "value": "2.5",
                        "label": "2.5 Generic"
                    },
                    {
                        "value": "2.0",
                        "label": "2.0 Generic"
                    },
                    {
                        "value": "1.0",
                        "label": "1.0 Generic"
                    }
                ],
                "optional": true
            },
            {
                "name": "yearFrom",
                "type": "number",
                "label": "Years (from)",
                "placeholder": "1991",
                "min": "-9999",
                "max": "9999",
                "optional": true
            },
            {
                "name": "yearTo",
                "type": "number",
                "label": "Years (to)",
                "placeholder": "1992",
                "min": "-9999",
                "max": "9999",
                "optional": true
            },
            {
                "name": "source",
                "type": "text",
                "label": "Source",
                "placeholder": "https://",
                "optional": true
            },
            {
                "name": "authors",
                "type": "list",
                "field": {
                    "name": "author",
                    "type": "group",
                    "fields": [
                        {
                            "label": "Author's name",
                            "name": "name",
                            "optional": true,
                            "type": "text"
                        },
                        {
                            "name": "role",
                            "type": "select",
                            "label": "Author's role",
                            "default": "Author",
                            "options": [
                                {
                                    "value": "Author",
                                    "label": "Author"
                                },
                                {
                                    "value": "Editor",
                                    "label": "Editor"
                                },
                                {
                                    "value": "Licensee",
                                    "label": "Licensee"
                                },
                                {
                                    "value": "Originator",
                                    "label": "Originator"
                                }
                            ]
                        }
                    ]
                }
            },
            {
                "name": "licenseExtras",
                "type": "text",
                "widget": "textarea",
                "label": "License Extras",
                "optional": true,
                "description": "Any additional information about the license"
            },
            {
                "name": "changes",
                "type": "list",
                "field": {
                    "name": "change",
                    "type": "group",
                    "label": "Changelog",
                    "fields": [
                        {
                            "name": "date",
                            "type": "text",
                            "label": "Date",
                            "optional": true
                        },
                        {
                            "name": "author",
                            "type": "text",
                            "label": "Changed by",
                            "optional": true
                        },
                        {
                            "name": "log",
                            "type": "text",
                            "widget": "textarea",
                            "label": "Description of change",
                            "placeholder": "Photo cropped, text changed, etc.",
                            "optional": true
                        }
                    ]
                }
            },
            {
                "name": "authorComments",
                "type": "text",
                "widget": "textarea",
                "label": "Author comments",
                "description": "Comments for the editor of the content (This text will not be published as a part of copyright info)",
                "optional": true
            },
            {
                "name": "contentType",
                "type": "text",
                "widget": "none"
            },
            {
                "name": "defaultLanguage",
                "type": "text",
                "widget": "none"
            }
        ],
        "assets": {
            "css": [
                "/wordpress/wp-content/plugins/h5p/h5p-php-library/styles/h5p.css?ver=1.15.7",
                "/wordpress/wp-content/plugins/h5p/h5p-php-library/styles/h5p-confirmation-dialog.css?ver=1.15.7",
                "/wordpress/wp-content/plugins/h5p/h5p-php-library/styles/h5p-core-button.css?ver=1.15.7",
                "/wordpress/wp-content/plugins/h5p/h5p-editor-php-library/libs/darkroom.css?ver=1.15.7",
                "/wordpress/wp-content/plugins/h5p/h5p-editor-php-library/styles/css/h5p-hub-client.css?ver=1.15.7",
                "/wordpress/wp-content/plugins/h5p/h5p-editor-php-library/styles/css/fonts.css?ver=1.15.7",
                "/wordpress/wp-content/plugins/h5p/h5p-editor-php-library/styles/css/application.css?ver=1.15.7",
                "/wordpress/wp-content/plugins/h5p/h5p-editor-php-library/styles/css/libs/zebra_datepicker.min.css?ver=1.15.7"
            ],
            "js": [
                "/wordpress/wp-content/plugins/h5p/h5p-php-library/js/jquery.js?ver=1.15.7",
                "/wordpress/wp-content/plugins/h5p/h5p-php-library/js/h5p.js?ver=1.15.7",
                "/wordpress/wp-content/plugins/h5p/h5p-php-library/js/h5p-event-dispatcher.js?ver=1.15.7",
                "/wordpress/wp-content/plugins/h5p/h5p-php-library/js/h5p-x-api-event.js?ver=1.15.7",
                "/wordpress/wp-content/plugins/h5p/h5p-php-library/js/h5p-x-api.js?ver=1.15.7",
                "/wordpress/wp-content/plugins/h5p/h5p-php-library/js/h5p-content-type.js?ver=1.15.7",
                "/wordpress/wp-content/plugins/h5p/h5p-php-library/js/h5p-confirmation-dialog.js?ver=1.15.7",
                "/wordpress/wp-content/plugins/h5p/h5p-php-library/js/h5p-action-bar.js?ver=1.15.7",
                "/wordpress/wp-content/plugins/h5p/h5p-php-library/js/request-queue.js?ver=1.15.7",
                "/wordpress/wp-content/plugins/h5p/h5p-editor-php-library/scripts/h5p-hub-client.js?ver=1.15.7",
                "/wordpress/wp-content/plugins/h5p/h5p-editor-php-library/scripts/h5peditor.js?ver=1.15.7",
                "/wordpress/wp-content/plugins/h5p/h5p-editor-php-library/scripts/h5peditor-semantic-structure.js?ver=1.15.7",
                "/wordpress/wp-content/plugins/h5p/h5p-editor-php-library/scripts/h5peditor-library-selector.js?ver=1.15.7",
                "/wordpress/wp-content/plugins/h5p/h5p-editor-php-library/scripts/h5peditor-fullscreen-bar.js?ver=1.15.7",
                "/wordpress/wp-content/plugins/h5p/h5p-editor-php-library/scripts/h5peditor-form.js?ver=1.15.7",
                "/wordpress/wp-content/plugins/h5p/h5p-editor-php-library/scripts/h5peditor-text.js?ver=1.15.7",
                "/wordpress/wp-content/plugins/h5p/h5p-editor-php-library/scripts/h5peditor-html.js?ver=1.15.7",
                "/wordpress/wp-content/plugins/h5p/h5p-editor-php-library/scripts/h5peditor-number.js?ver=1.15.7",
                "/wordpress/wp-content/plugins/h5p/h5p-editor-php-library/scripts/h5peditor-textarea.js?ver=1.15.7",
                "/wordpress/wp-content/plugins/h5p/h5p-editor-php-library/scripts/h5peditor-file-uploader.js?ver=1.15.7",
                "/wordpress/wp-content/plugins/h5p/h5p-editor-php-library/scripts/h5peditor-file.js?ver=1.15.7",
                "/wordpress/wp-content/plugins/h5p/h5p-editor-php-library/scripts/h5peditor-image.js?ver=1.15.7",
                "/wordpress/wp-content/plugins/h5p/h5p-editor-php-library/scripts/h5peditor-image-popup.js?ver=1.15.7",
                "/wordpress/wp-content/plugins/h5p/h5p-editor-php-library/scripts/h5peditor-av.js?ver=1.15.7",
                "/wordpress/wp-content/plugins/h5p/h5p-editor-php-library/scripts/h5peditor-group.js?ver=1.15.7",
                "/wordpress/wp-content/plugins/h5p/h5p-editor-php-library/scripts/h5peditor-boolean.js?ver=1.15.7",
                "/wordpress/wp-content/plugins/h5p/h5p-editor-php-library/scripts/h5peditor-list.js?ver=1.15.7",
                "/wordpress/wp-content/plugins/h5p/h5p-editor-php-library/scripts/h5peditor-list-editor.js?ver=1.15.7",
                "/wordpress/wp-content/plugins/h5p/h5p-editor-php-library/scripts/h5peditor-library.js?ver=1.15.7",
                "/wordpress/wp-content/plugins/h5p/h5p-editor-php-library/scripts/h5peditor-library-list-cache.js?ver=1.15.7",
                "/wordpress/wp-content/plugins/h5p/h5p-editor-php-library/scripts/h5peditor-select.js?ver=1.15.7",
                "/wordpress/wp-content/plugins/h5p/h5p-editor-php-library/scripts/h5peditor-selector-hub.js?ver=1.15.7",
                "/wordpress/wp-content/plugins/h5p/h5p-editor-php-library/scripts/h5peditor-selector-legacy.js?ver=1.15.7",
                "/wordpress/wp-content/plugins/h5p/h5p-editor-php-library/scripts/h5peditor-dimensions.js?ver=1.15.7",
                "/wordpress/wp-content/plugins/h5p/h5p-editor-php-library/scripts/h5peditor-coordinates.js?ver=1.15.7",
                "/wordpress/wp-content/plugins/h5p/h5p-editor-php-library/scripts/h5peditor-none.js?ver=1.15.7",
                "/wordpress/wp-content/plugins/h5p/h5p-editor-php-library/scripts/h5peditor-metadata.js?ver=1.15.7",
                "/wordpress/wp-content/plugins/h5p/h5p-editor-php-library/scripts/h5peditor-metadata-author-widget.js?ver=1.15.7",
                "/wordpress/wp-content/plugins/h5p/h5p-editor-php-library/scripts/h5peditor-metadata-changelog-widget.js?ver=1.15.7",
                "/wordpress/wp-content/plugins/h5p/h5p-editor-php-library/scripts/h5peditor-pre-save.js?ver=1.15.7",
                "/wordpress/wp-content/plugins/h5p/h5p-editor-php-library/ckeditor/ckeditor.js?ver=1.15.7"
            ]
        },
        "deleteMessage": "Are you sure you wish to delete this content?",
        "apiVersion": {
            "majorVersion": 1,
            "minorVersion": 26
        },
        "language": "en"
    }
}







</script>    




    
<script src='h5p-php-library/js/jquery.js'></script>
          
<script src='h5p-php-library/js/h5p.js'></script>   


      
<script src='h5p-php-library/js/h5p-event-dispatcher.js'></script>    

    









<script src='h5p-php-library/js/h5p-x-api-event.js'></script>
<script src='h5p-php-library/js/h5p-x-api.js'></script>
<script src='h5p-php-library/js/h5p-content-type.js'></script>
<script src='h5p-php-library/js/h5p-confirmation-dialog.js'></script>
<script src='h5p-php-library/js/h5p-action-bar.js'></script>

<script src='h5p-php-library/js/request-queue.js'></script>

<script src='h5p-php-library/js/h5p-tooltip.js'></script>


<script src='h5p-editor-php-library/scripts/h5p-hub-client.js'></script>

<script src='h5p-editor-php-library/scripts/h5p-hub-client.js'></script>


<script src='h5p-editor-php-library/scripts/h5peditor-editor.js'></script>
<script src='h5p-editor-php-library/scripts/h5peditor.js'></script>
<script src='h5p-editor-php-library/language/en.js'></script>
<script src='h5p-editor.js'></script> 
    
    
<script src='h5p-editor-php-library/scripts/h5peditor-semantic-structure.js'></script>

<script src='h5p-editor-php-library/scripts/h5peditor-library-selector.js'></script>
<script src='h5p-editor-php-library/scripts/h5peditor-fullscreen-bar.js'></script>
<script src='h5p-editor-php-library/scripts/h5peditor-form.js'></script>
<script src='h5p-editor-php-library/scripts/h5peditor-text.js'></script>
<script src='h5p-editor-php-library/scripts/h5peditor-html.js'></script>
<script src='h5p-editor-php-library/scripts/h5peditor-number.js'></script>
<script src='h5p-editor-php-library/scripts/h5peditor-textarea.js'></script>
<script src='h5p-editor-php-library/scripts/h5peditor-file-uploader.js'></script>
<script src='h5p-editor-php-library/scripts/h5peditor-file.js'></script>
<script src='h5p-editor-php-library/scripts/h5peditor-image.js'></script>
<script src='h5p-editor-php-library/scripts/h5peditor-image-popup.js'></script>
<script src='h5p-editor-php-library/scripts/h5peditor-av.js'></script>
<script src='h5p-editor-php-library/scripts/h5peditor-group.js'></script>
<script src='h5p-editor-php-library/scripts/h5peditor-boolean.js'></script>
<script src='h5p-editor-php-library/scripts/h5peditor-list.js'></script>
<script src='h5p-editor-php-library/scripts/h5peditor-list-editor.js'></script>
<script src='h5p-editor-php-library/scripts/h5peditor-library.js'></script>
<script src='h5p-editor-php-library/scripts/h5peditor-library-list-cache.js'></script>
<script src='h5p-editor-php-library/scripts/h5peditor-select.js'></script>
<script src='h5p-editor-php-library/scripts/h5peditor-selector-hub.js'></script>
<script src='h5p-editor-php-library/scripts/h5peditor-selector-legacy.js'></script>
<script src='h5p-editor-php-library/scripts/h5peditor-dimensions.js'></script>
<script src='h5p-editor-php-library/scripts/h5peditor-coordinates.js'></script>
<script src='h5p-editor-php-library/scripts/h5peditor-none.js'></script>
<script src='h5p-editor-php-library/scripts/h5peditor-metadata.js'></script>
<script src='h5p-editor-php-library/scripts/h5peditor-metadata-author-widget.js'></script>
<script src='h5p-editor-php-library/scripts/h5peditor-metadata-changelog-widget.js'></script>
<script src='h5p-editor-php-library/scripts/h5peditor-pre-save.js'></script>
<script src='h5p-editor-php-library/ckeditor/ckeditor.js'></script>


<script>
H5P.init(document.getElementById('h5p-editor'));

</script>  




</html>






