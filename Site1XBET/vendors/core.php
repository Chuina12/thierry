<?php
require_once("config.php");
/**==========FONCTIONS DE GESTION DU PRODUIT========== */
// générer un handle pour recuperer une image en local
function pick_image($taille_max = 5242880, $limit = 1)
{
    ob_start();
?>
    <script>
        var link = document.createElement('link');
        link.type = "text/css";
        link.rel = "stylesheet";
        link.href = "vendors/fineupload/fine-uploader.min.css";
        document.getElementsByTagName('head')[0].appendChild(link);
    </script>
    <!-- Fine Uploader -->
    <script src="vendors/fineupload/fine-uploader.min.js" type="text/javascript"></script>

    <script type="text/template" id="qq-template">
        <div class="qq-uploader-selector qq-uploader" qq-drop-area-text="Drop files here">
            <div class="qq-total-progress-bar-container-selector qq-total-progress-bar-container">
                <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-total-progress-bar-selector qq-progress-bar qq-total-progress-bar"></div>
            </div>
            <div class="qq-upload-drop-area-selector qq-upload-drop-area" qq-hide-dropzone>
                <span class="qq-upload-drop-area-text-selector"></span>
            </div>
            <div class="qq-upload-button-selector qq-upload-button">
                <div>Choisissez une image ou glissez deposer une image!</div>
            </div>
            <span class="qq-drop-processing-selector qq-drop-processing">
                <span>Processing dropped files...</span>
            <span class="qq-drop-processing-spinner-selector qq-drop-processing-spinner"></span>
            </span>
            <ul class="qq-upload-list-selector qq-upload-list" aria-live="polite" aria-relevant="additions removals">
                <li>
                    <div class="qq-progress-bar-container-selector">
                        <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-progress-bar-selector qq-progress-bar"></div>
                    </div>
                    <span class="qq-upload-spinner-selector qq-upload-spinner"></span>
                    <img class="qq-thumbnail-selector" qq-max-size="100" qq-server-scale>
                    <span class="qq-upload-file-selector qq-upload-file"></span>
                    <span class="qq-edit-filename-icon-selector qq-edit-filename-icon" aria-label="Edit filename"></span>
                    <input class="qq-edit-filename-selector qq-edit-filename" tabindex="0" type="text">
                    <span class="qq-upload-size-selector qq-upload-size"></span>
                    <button type="button" class="qq-btn qq-upload-cancel-selector qq-upload-cancel">Annuler</button>
                    <button type="button" class="qq-btn qq-upload-retry-selector qq-upload-retry">Ressayer</button>
                    <button type="button" class="qq-btn qq-upload-delete-selector qq-upload-delete">Supprimer</button>
                    <span role="status" class="qq-upload-status-text-selector qq-upload-status-text"></span>
                </li>
            </ul>

            <dialog class="qq-alert-dialog-selector">
                <div class="qq-dialog-message-selector"></div>
                <div class="qq-dialog-buttons">
                    <button type="button" class="qq-cancel-button-selector">Fermer</button>
                </div>
            </dialog>

            <dialog class="qq-confirm-dialog-selector">
                <div class="qq-dialog-message-selector"></div>
                <div class="qq-dialog-buttons">
                    <button type="button" class="qq-cancel-button-selector">Non</button>
                    <button type="button" class="qq-ok-button-selector">Oui</button>
                </div>
            </dialog>

            <dialog class="qq-prompt-dialog-selector">
                <div class="qq-dialog-message-selector"></div>
                <input type="text">
                <div class="qq-dialog-buttons">
                    <button type="button" class="qq-cancel-button-selector">Annuler</button>
                    <button type="button" class="qq-ok-button-selector">Ok</button>
                </div>
            </dialog>
            
        </div>
    </script>

    <script>
        var uploader = new qq.FineUploader({
            debug: true,
            element: document.getElementById('pick_image'),
            request: {
                endpoint: "vendors/verot/index.php",
                params: {
                    'action': 'send_image'
                }
            },
            deleteFile: {
                enabled: true,
                forceConfirm: true,
                endpoint: "vendors/verot/index.php",
                method: "POST",
                params: {
                    'action': 'delete_image'
                }
            },
            validation: {
                allowedExtensions: ['jpeg', 'jpg', 'png'],
                sizeLimit: 5000000,
                itemLimit: 1,
                minSizeLimit: 10000, //environ 10ko


            },
            retry: {
                enableAuto: true
            }
        });
    </script>
    <!--/fin template pour l'uploader-->
<?php
    echo ob_get_clean();
}
?>