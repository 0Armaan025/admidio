<?php
/**
 ***********************************************************************************************
 * Create and edit categories
 *
 * @copyright 2004-2016 The Admidio Team
 * @see http://www.admidio.org/
 * @license https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2.0 only
 ***********************************************************************************************
 */

/******************************************************************************
 * Parameters:
 *
 * men_id: Id of the menu that should be edited
 *
 ****************************************************************************/

require_once('../../system/common.php');
require_once('../../system/login_valid.php');

// Initialize and check the parameters
$getMenId = admFuncVariableIsValid($_GET, 'men_id', 'int');

// Rechte pruefen
if(!$gCurrentUser->isAdministrator())
{
    $gMessage->show($gL10n->get('SYS_NO_RIGHTS'));
}

// set module headline
$headline = $gL10n->get('SYS_MENU');

// set headline of the script
if($getMenId > 0)
{
    $headline = $gL10n->get('SYS_EDIT_VAR', array($headline));
}
else
{
    $headline = $gL10n->get('SYS_CREATE_VAR', array($headline));
}

$gNavigation->addUrl(CURRENT_URL, array($headline));

$menuArray = array(0 => 'MAIN');

/**
 * die Albenstruktur fuer eine Auswahlbox darstellen und das aktuelle Album vorausw�hlen
 * @param int    $parentId
 * @param string $vorschub
 * @param        $menu
 */
function subfolder($parentId, $vorschub, $menu)
{
    global $gDb, $gCurrentOrganization, $menuArray;

    $vorschub .= '&nbsp;&nbsp;&nbsp;';
    $sqlConditionParentId = '';
    $parentMenu = new TableMenu($gDb);

    $queryParams = array($menu->getValue('men_id'));
    // Erfassen des auszugebenden Albums
    if ($parentId > 0)
    {
        $sqlConditionParentId .= ' AND men_parent_id = ? -- $parentId';
        $queryParams[] = $parentId;
    }
    else
    {
        $sqlConditionParentId .= ' AND men_parent_id IS NULL';
    }

    $sql = 'SELECT *
              FROM '.TBL_MENU.'
             WHERE men_id    <> ? -- $menu->getValue(\'men_id\')
                   '.$sqlConditionParentId;
    $childStatement = $gDb->queryPrepared($sql, $queryParams);

    while($admPhotoChild = $childStatement->fetch())
    {
        $parentMenu->clear();
        $parentMenu->setArray($admPhotoChild);

        // add entry to array of all photo albums
        $menuArray[$parentMenu->getValue('men_id')] = $vorschub.'&#151; '.$parentMenu->getValue('men_translate_name');

        subfolder($parentMenu->getValue('men_id'), $vorschub, $menu);
    }//while
}//function

// UserField-objekt anlegen
$menu = new TableMenu($gDb);

// create html page object
$page = new HtmlPage($headline);

// add back link to module menu
$menuCreateMenu = $page->getMenu();
$menuCreateMenu->addItem('menu_item_back', $gNavigation->getPreviousUrl(), $gL10n->get('SYS_BACK'), 'back.png');

// alle aus der DB aus lesen
$sqlRoles =  'SELECT *
                FROM '.TBL_ROLES.'
          INNER JOIN '.TBL_CATEGORIES.'
                  ON cat_id = rol_cat_id
               WHERE rol_valid  = 1
                 AND rol_system = 0
            ORDER BY rol_name';
$rolesViewStatement = $gDb->query($sqlRoles);

while($rowViewRoles = $rolesViewStatement->fetchObject())
{
    // Jede Rolle wird nun dem Array hinzugefuegt
    $parentRoleViewSet[] = array($rowViewRoles->rol_id, $rowViewRoles->rol_name, $rowViewRoles->cat_name);
}

// show form
$form = new HtmlForm('menu_edit_form', $g_root_path.'/adm_program/modules/menu/menu_function.php?men_id='.$getMenId.'&amp;mode=1', $page);

// systemcategories should not be renamed
$fieldPropertyStandart = FIELD_REQUIRED;
$standart = 0;
$roleViewSet[] = 0;

if($getMenId > 0)
{
    $menu->readDataById($getMenId);
    $fieldPropertyStandart = FIELD_DISABLED;
    $standart = $menu->getValue('men_standart');

    // Read current roles rights of the menu
    $display = new RolesRights($gDb, 'menu_view', $getMenId);
    $roleViewSet = $display->getRolesIds();
}

subfolder(null, '', $menu);
$form->addSelectBox('men_parent_id', $gL10n->get('SYS_CATEGORY'), $menuArray, array(
        'property'                       => FIELD_REQUIRED,
        'defaultValue'                   => $menu->getValue('men_parent_id'),
        'showContextDependentFirstEntry' => false,
        'helpTextIdLabel'                => array('PHO_PARENT_ALBUM_DESC', 'MAIN')
    )
);

$form->addInput('men_modul_name', $gL10n->get('SYS_NAME_ABBREVIATION'), $menu->getValue('men_modul_name', 'database'), array('maxLength' => 100, 'property' => $fieldPropertyStandart));

$form->addCheckbox('men_need_enable', $gL10n->get('MNU_NEED_ENABLED'), $menu->getValue('men_need_enable'), array('icon' => 'star.png'));

$form->addSelectBox('menu_view', $gL10n->get('SYS_VISIBLE_FOR'), $parentRoleViewSet, array('property'  => FIELD_REQUIRED,
                                                                                              'defaultValue' => $roleViewSet,
                                                                                              'multiselect'  => true));

$form->addInput('men_url', $gL10n->get('ORG_URL'), $menu->getValue('men_url', 'database'), array('maxLength' => 100));

$array_icon = array_slice(scandir(THEME_ADMIDIO_PATH . '/icons'), 2);
$def_icon = array_search($menu->getValue('men_icon', 'database'), $array_icon);
$form->addSelectBox('men_icon', $gL10n->get('SYS_ICON'), $array_icon, array('defaultValue' => $def_icon,
                                                                            'showContextDependentFirstEntry' => true));

$form->addInput('men_translate_name', $gL10n->get('SYS_NAME'), $menu->getValue('men_translate_name', 'database'), array('maxLength' => 100,
                                                                                                                        'helpTextIdLabel' => 'MNU_NAME_DESC'));

$form->addInput('men_translate_desc', $gL10n->get('SYS_DESCRIPTION'), $menu->getValue('men_translate_desc', 'database'), array('maxLength'       => 100,
                                                                                                                               'helpTextIdLabel' => 'MNU_NAME_DESC_DESC'));

if($fieldPropertyStandart == FIELD_DISABLED)
{
    $form->addInput('men_modul_name', null, $menu->getValue('men_modul_name', 'database'), array('type' => 'hidden'));
}
$form->addInput('men_standart', null, $standart, array('type' => 'hidden'));

$form->addSubmitButton('btn_save', $gL10n->get('SYS_SAVE'), array('icon' => THEME_PATH.'/icons/disk.png'));

// add form to html page and show page
$page->addHtml($form->show(false));
$page->show();
