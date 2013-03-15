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
if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    //  It must be included from a Moodle page.
}

require_once($CFG->libdir.'/formslib.php');

class userdelete_form extends moodleform {

    public function definition() {
        global $CFG;

        $mform =& $this->_form;

        $mform->addElement('header', '', get_string('eledia_desc_header', 'block_eledia_userdelete'), 'config_userdelete');
        $mform->addElement('static', 'desc', '', get_string('desc', 'block_eledia_userdelete'));

        $mform->addElement('header', '', get_string('eledia_delete_header', 'block_eledia_userdelete'), 'config_userdelete');
        $mform->addElement('textarea', 'user_mails', '', 'wrap="virtual" rows="20" cols="50"');

        $mform->addElement('submit', 'submitbutton', get_string('start_confirm', 'block_eledia_userdelete'));
        $mform->addElement('cancel', 'cancelbutton', get_string('back', 'block_eledia_userdelete'));
    }

    public function definition_after_data() {
        global $CFG;
        $mform =& $this->_form;

    }
}
