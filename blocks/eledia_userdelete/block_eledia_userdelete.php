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
 * Block class for the plugin.
 *
 * @package    blocks
 * @subpackage eledia_userdelete
 * @author     Benjamin Wolf <support@eledia.de>
 * @copyright  2013 eLeDia GmbH
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

class block_eledia_userdelete extends block_base {

    public function init() {
        $this->title   = get_string('title', 'block_eledia_userdelete');
        $this->version = 2013013100;// Format yyyymmddvv.
    }

    public function applicable_formats() {
        return array('site' => true);
    }

    public function get_content() {
        global $USER, $CFG, $COURSE;
        if ($this->content !== null) {
            return $this->content;
        }

        $this->content = new object();
        $this->content->text = '';
        $this->content->footer = '';

        if (has_capability('moodle/site:config', CONTEXT_SYSTEM::instance())) {

            $this->content->text .= '<ul>';
            $this->content->text .= '<li>';
            $this->content->text .= '<a href="'.$CFG->wwwroot.'/blocks/eledia_userdelete/userdelete.php" >';
            $this->content->text .= get_string('eledia_header', 'block_eledia_userdelete');
            $this->content->text .= '</a>';
            $this->content->text .= '</li>';
            $this->content->text .= '</ul>';
        }
        return $this->content;
    }

    public function has_config() {
        return false;
    }

}
