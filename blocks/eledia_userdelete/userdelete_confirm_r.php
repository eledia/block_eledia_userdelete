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
/******************************************************************
 *
 * Dieses Script parst eine CSV-Datei die im Verzeichnis "{moodledata}/temp"
 * liegt. Die Datei muss das Format "userid;username;" haben. Dieses
 * Script selbst, muss im Verzeichnis "{moodleroot}/admin" abgelegt werden.
 *
 * Aus dem Dateiinhalt wird eine Liste von aktiven (lies: nicht gel�scht) Accounts
 * generiert, die dann in 100er Schritten gel�scht werden k�nnen.
 *
 * @copy eLeDia GmbH
 * @author Ralf Wiederhold <ralf.wiederhold@eledia.de>
 */

require_once('../../config.php');
global $OUTPUT, $DB;

require_login();
require_capability('moodle/site:config', get_context_instance(CONTEXT_SYSTEM));

$PAGE->set_url('/blocks/eledia_userdelte/userdelete_confirm.php');
$PAGE->set_context(get_context_instance(CONTEXT_SYSTEM));
$PAGE->set_heading('Userdeletion - with Confirmation');
echo $OUTPUT->header();

echo '<div style="width:800px; margin:20px auto;">';

echo '<div style="width:500px; margin:10px 150px;">
        Diese Seite erm&ouml;glicht Ihnen eine Liste von Usern zu l&ouml;schen, die aus der Datei
        "{moodledata}/temp/delete_users.csv" ausgelesen wurden. <br><br>Die Datei muss per Hand an
        dieser Stelle abgelegt werden. Die Nutzer werden hierbei über die email Adresse identifiziert.
        In jeder Zeile der csv Datei muss also eine mail Adresse abgelegt werden. <br><br>Es werden
        jeweils 100 User angezeigt, deren L&ouml;schung Sie best&auml;tigen k&ouml;nnen. User die
        schon gel&ouml;scht wurden, werden in der Liste nicht angezeigt.
      </div>';

$datafile = $CFG->dataroot.'/temp/delete_users.csv';

if ($formdata = data_submitted()) {
    $success = true;
    foreach ($formdata->users as $id) {
        if (is_numeric($id) && ((int) $id) != 0) {

            $u = $DB->get_record('user', array('id' => (int) $id));
            $success = $success && delete_user($u);
        }
    }

    if ($success) {
        echo '<div style="width:500px; margin:10px 150px; color:green; font-weight:bold;">
            Die ausgew&auml;hlten Benutzer wurden gel&ouml;scht.</div>';
    } else {
        echo '<div style="width:500px; margin:10px 150px; color:red; font-weight:bold;">
            Einige User konnten nicht gel&ouml;scht werden.</div>';
    }
}

if (!file_exists($datafile)) {
    echo '<div style="width:500px; margin:10px 150px; color:red; font-weight:bold;">
        Datei wurde nicht gefunden!</div>';
} else {
    if (!is_readable($datafile)) {
        echo '<div style="width:500px; margin:10px 150px; color:red; font-weight:bold;">
            Datei kann nicht gelesen werden!</div>';
    } else {
        $users = array();
        $handle = fopen($datafile, 'r');
        while (false !== ($data = fgetcsv($handle, 1024, ';'))) {
            $u = $DB->get_record('user', array('email' => $data[0]));
            if (!$u || $u->deleted) {
                continue;
            }
            $users[] = $u;
        }
    }

    if (empty($users)) {
        echo '<div style="width:500px; margin:10px 150px; color:red; font-weight:bold;">
            Die Liste enth&auml;lt nur bereits gel&ouml;schte Benutzer.</div>';
    } else {

        echo '<form action="userdelete_confirm.php" method="post">';
        echo '<style type="text/css">table#userdeletionlist th, table#userdeletionlist td {border:1px solid black;</style>';
        echo '<table id="userdeletionlist" style="width:800px;margin-top:50px;text-align:center; border:1px solid black;">
                <tr>
                    <th>Username</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Zuletzt gesehen</th>
                </tr>';

        if (count($users)>100) {
            $num_users = 100;
        } else {
            $num_users = count($users);
        }

        for ($i=0; $i < $num_users; $i++) {
            if (isset($users[$i])) {
                $u = $users[$i];

                if ($u->lastaccess==0) {
                    $lastaccess = 'nie';
                } else {
                    $lastaccess = date('d.m.Y - H:m', $u->lastaccess);
                }

                echo '<tr>
                        <td>
                            '.$u->username.'
                            <input type="hidden" name="users[]" value="'.$u->id.'" />
                        </td>
                        <td>'.fullname($u).'</td>
                        <td>'.$u->email.'</td>
                        <td>'.$lastaccess.'</td>
                      </tr>';
            }
        }

        echo '<tr><td colspan="4" style="text-align:right;"><br /><input type="submit" /></td></tr>';
        echo '</table>';

        echo '</form>';
    }
}

echo '</div>';
echo $OUTPUT->footer();
