<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * De language file for the plugin.
 *
 * @package    blocks
 * @subpackage eledia_userdelete
 * @author     Benjamin Wolf <support@eledia.de>
 * @copyright  2013 eLeDia GmbH
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['back'] = 'zurück';

$string['delete_desc'] = 'Es werden jeweils bis zu 100 User angezeigt, deren Löschung Sie bestätigen können. User die schon gelöscht wurden, werden in der Liste nicht angezeigt.';
$string['desc'] = 'Dies ist ein Plugin zum löschen von Nutzern anhand Ihrer E-Mail Adresse.
    Fügen Sie in der Textbox die E-Mail Adressen ein und klicken Sie auf Nutzer Prüfen zum fortfahren.<br /><br />
    Beim einfügen bitte eine E-Mail Adresse pro Zeile.';
$string['desc2'] = 'Diese Seite erm&ouml;glicht Ihnen eine Liste von Usern zu l&ouml;schen, die aus der Datei
        "{moodledata}/temp/delete_users.csv" ausgelesen wurden. <br><br>Die Datei muss per Hand an
        dieser Stelle abgelegt werden. Die Nutzer werden hierbei über die email Adresse identifiziert.
        In jeder Zeile der csv Datei muss also eine mail Adresse abgelegt werden. <br><br>Es werden
        jeweils 100 User angezeigt, deren L&ouml;schung Sie best&auml;tigen k&ouml;nnen. User die
        schon gel&ouml;scht wurden, werden in der Liste nicht angezeigt.';

$string['eledia_config_header'] = 'Konfiguration für das löschen von Nutzer/innen';
$string['eledia_delete_header'] = 'Mail Liste der zu löschenden Nutzer';
$string['eledia_desc_header'] = 'Pluginbeschreibung';
$string['eledia_header'] = 'Nutzer löschen';
$string['eledia_userdelete:addinstance'] = 'Block Nutzer löschen hinzufügen';

$string['failed_deleting'] = 'Einige User konnten nicht gel&ouml;scht werden.';
$string['file_not_found'] = 'Datei wurde nicht gefunden!';
$string['file_not_readable'] = 'Datei kann nicht gelesen werden!';

$string['last_seen'] = 'Zuletzt gesehen';

$string['only_deletted_user'] = 'Die Liste enth&auml;lt nur bereits gel&ouml;schte Benutzer.';

$string['pluginname'] = 'Nutzer löschen';

$string['start_confirm'] = 'Nutzer prüfen';
$string['start_deleting'] = 'Löschen beginnen';
$string['successful_deleting'] = 'Die ausgew&auml;hlten Benutzer wurden gel&ouml;scht.';

$string['title'] = 'Nutzer löschen';

