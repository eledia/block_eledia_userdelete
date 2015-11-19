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
 * Second formular with list of users to confirm the deletion
 *
 * @package    blocks
 * @subpackage eledia_userdelete
 * @author     Benjamin Wolf <support@eledia.de>
 * @copyright  2013 eLeDia GmbH
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    // It must be included from a Moodle page.
}

require_once($CFG->libdir.'/formslib.php');

class userdeleteconfirm_form extends moodleform {

    public function definition() {
        global $CFG, $DB;

        $mform =& $this->_form;

        $mform->addElement('header', '', get_string('eledia_desc_header', 'block_eledia_userdelete'), 'config_userdelete');
        $mform->addElement('static', 'desc', '', get_string('delete_desc', 'block_eledia_userdelete'));

        $mform->addElement('header', '', get_string('eledia_delete_header', 'block_eledia_userdelete'), 'config_userdelete');

        $user_mails = $_SESSION['eledia_deleteuser']->user_mails;
        $user_mails = explode("\n", $user_mails);

        // Table headers.
        $mform->addElement('html', '<table border="1"><tr>');
        $mform->addElement('html', '<th>'.get_string('username').'</th>');
        $mform->addElement('html', '<th>Name</th>');
        $mform->addElement('html', '<th>'.get_string('email').'</th>');
        $mform->addElement('html', '<th>'.get_string('last_seen', 'block_eledia_userdelete').'</th>');
        $mform->addElement('html', '</tr>');
        $i = 0;
        foreach ($user_mails as $mail) {

            if ($i == 100){// Max user per page.
                break;
            }

            $ulist = $DB->get_records('user', array('email' => trim($mail)));
            foreach ($ulist as $u) {
                // Ignoring non existing and delteted users.
                if (empty($u) || $u->deleted) {
                    continue;
                }
                // User fields.
                $mform->addElement('html', '<tr>');
                $mform->addElement('html', '<td>'.$u->username.'</td>');
                $mform->addElement('html', '<td>'.$u->firstname.' '.$u->lastname.'</td>');
                $mform->addElement('html', '<td>'.$u->email.'</td>');
                if (empty($u->lastaccess)) {
                    $mform->addElement('html', '<td>'.  get_string('never').'</td>');
                } else {
                    $mform->addElement('html', '<td>'.date('d.m.Y', $u->lastaccess).'</td>');
                }

                $mform->addElement('html', '</tr>');
                $i++;
            }
        }
        $mform->addElement('html', '</table>');

        $mform->addElement('submit', 'submitbutton', get_string('start_deleting', 'block_eledia_userdelete'));
        $mform->addElement('cancel', 'cancelbutton', get_string('back', 'block_eledia_userdelete'));
    }

    public function definition_after_data() {
        global $CFG;
        $mform =& $this->_form;

    }
}
