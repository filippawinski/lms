<?php

/*
 *  iNET LMS
 *
 *  (C) Copyright 2012-2015 iNET LMS Developers
 *
 *  Please, see the doc/AUTHORS for more information about authors!
 *
 *  This program is free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License Version 2 as
 *  published by the Free Software Foundation.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program; if not, write to the Free Software
 *  Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA 02111-1307,
 *  USA.
 *
 *  Sylwester Kondracki
 *  sylwester.kondracki@gmail.com
 *  gadu-gadu : 6164816
 *
*/

if (!isset($annex_info) || empty($annex_info) || !is_array($annex_info))
    $annex_info = array('section' => 'global', 'ownerid' => 0);

$SMARTY->assign('annex_info',$annex_info);

function get_list_annex()
{
    global $LMS,$SMARTY,$annex_info;
    $layout['popup'] = true;
    $obj = new xajaxResponse();
    
    $filelist = $LMS->GetFilesList($annex_info['section'],$annex_info['ownerid']);
    $SMARTY->assign('filelist',$filelist);

    $obj->assign("id_annex_content","innerHTML",$SMARTY->fetch('annexlist.html'));
    return $obj;
}

function delete_file_annex($id)
{
    global $LMS,$SMARTY,$annex_info;
    $layout['popup'] = true;
    $obj = new xajaxResponse();
    $LMS->DeleteFile(intval($id));
    $obj->script("xajax_get_list_annex();");
    return $obj;
}

$LMS->InitXajax();
$LMS->RegisterXajaxFunction(array('get_list_annex','delete_file_annex'));
$SMARTY->assign('xajax',$LMS->RunXajax());

?>