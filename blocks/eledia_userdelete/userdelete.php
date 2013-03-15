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
require_once('../../config.php');
require_once('userdelete_form.php');
global $CFG, $_SESSION;

// Check for valid admin user - no guest autologin.
require_login(0, false);
$PAGE->set_url('/blocks/eledia_userdelete/userdelete.php');
$PAGE->set_context(get_context_instance(CONTEXT_SYSTEM));
$PAGE->navbar->add(get_string('pluginname', 'block_eledia_userdelete'));
$PAGE->set_pagelayout('course');

$context = get_context_instance(CONTEXT_SYSTEM);

require_capability('moodle/site:config', $context);

$mform = new userdelete_form();

if ($mform->is_cancelled()) {
    redirect($CFG->httpswwwroot);
} else if ($genparams = $mform->get_data()) {
    $_SESSION['eledia_deleteuser'] = $genparams;
    redirect($CFG->httpswwwroot.'/blocks/eledia_userdelete/userdelete_confirm.php');
}

$header = get_string('eledia_header', 'block_eledia_userdelete');
$PAGE->set_heading($header);

echo $OUTPUT->header();
$mform->display();
echo $OUTPUT->footer();

