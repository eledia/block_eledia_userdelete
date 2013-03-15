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
require_once('userdelete_confirm_form.php');

// Check for valid admin user - no guest autologin.
require_login(0, false);

$PAGE->set_url('/blocks/eledia_userdelete/userdelete.php');
$PAGE->set_context(get_context_instance(CONTEXT_SYSTEM));
$PAGE->navbar->add(get_string('pluginname', 'block_eledia_userdelete'));
$PAGE->set_pagelayout('course');

$context = get_context_instance(CONTEXT_SYSTEM);

require_capability('moodle/site:config', $context);

$mform = new userdeleteconfirm_form();
if ($mform->is_cancelled()) {
    redirect($CFG->httpswwwroot.'/blocks/eledia_userdelete/userdelete.php');
} else if ($genparams = $mform->get_data()) {
    $user_mails = explode("\n", $_SESSION['eledia_deleteuser']->user_mails);
    $i = 0;
    foreach ($user_mails as $mail) {

        if ($i == 100){// Max user per page.
            break;
        }

        $u = $DB->get_record('user', array('email' => trim($mail)));
        if (empty($u) || $u->deleted){// Ignoring non existing and delteted users.
            $_SESSION['eledia_deleteuser']->user_mails = str_replace($mail."\n", '', $_SESSION['eledia_deleteuser']->user_mails);
            continue;
        }
        // Delete user.
        delete_user($u);
        $_SESSION['eledia_deleteuser']->user_mails = str_replace($mail."\n", '', $_SESSION['eledia_deleteuser']->user_mails);

        $i++;
        $mform = new userdeleteconfirm_form();
    }
}

$header = get_string('eledia_header', 'block_eledia_userdelete');
$PAGE->set_heading($header);

echo $OUTPUT->header();
$mform->display();
echo $OUTPUT->footer();
