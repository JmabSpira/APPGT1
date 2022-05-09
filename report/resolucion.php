<?php
    include_once('tbs_class.php'); 
    include_once('../public/plugins/tbs/tbs_plugin_opentbs.php'); 
    $TBS = new clsTinyButStrong; 
    $TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN); 


    
    //Parametros
    $proveido = '12334';
    $memosg = 'memo seg';
    $memogt = 'memo gt';
    $memof = 'memo facultad';
    $facultad = 'facultad abc';

    //$firmadecano = 'firma.png';

    //Cargando template
    $template = 'BACHILLERCU.docx';   
    $TBS->LoadTemplate($template, OPENTBS_ALREADY_UTF8);

    //Escribir Nuevos campos
    $TBS->MergeField('pro.proveido', $proveido);
    $TBS->MergeField('pro.memosg', $memosg);
    $TBS->MergeField('pro.memogt', $memogt);
    $TBS->MergeField('pro.memof', $memof);
    $TBS->MergeField('pro.facultad', $facultad);

    $TBS->PlugIn(OPENTBS_DELETE_COMMENTS);

    //save_as sera el nombre de la resolucion

    $save_as = (isset($_POST['save_as']) && (trim($_POST['save_as'])!=='') && ($_SERVER['SERVER_NAME']=='localhost')) ? trim($_POST['save_as']) : '';
    $output_file_name = str_replace('.', $facultad.'_'.date('Y-m-d').$save_as.'.', $template);
    //se verifica si el nombre esta vacio
    if ($save_as==='s') {
        $TBS->Show(OPENTBS_DOWNLOAD, $output_file_name);
        exit();
    } else {
        $TBS->Show(OPENTBS_FILE, $output_file_name);
        exit("Resolución [$output_file_name] ha sido creado.");
    }
?>