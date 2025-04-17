<?php
// This file is part of Moodle - https://moodle.org/
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
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

namespace enrol_programs\local\form;

use enrol_programs\local\program;
use enrol_programs\local\allocation;
use enrol_programs\local\source\profile;

/**
 * Edit cohort allocation settings.
 *
 * @package    enrol_programs
 * @copyright  2025 
 * @author     Johnny Tsheke
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class source_profile_edit extends \local_openlms\dialog_form {

    protected function definition() {
        global $DB, $CFG, $PAGE, $COURSE;
        $mform = $this->_form;
        $context = $this->_customdata['context'];
        $source = $this->_customdata['source'];
        $program = $this->_customdata['program'];

        // Daily version for javascript files to load. This is to avoid cache issues
        //$todayversion = 'tv='. mktime(0, 0, 0, date("m"), date("d"), date("Y")).''; //timestanp
        $todayversion = 'tv='.time().'';
     
        $mform->addElement('select', 'enable', get_string('active'), ['1' => get_string('yes'), '0' => get_string('no')]);
        $mform->setDefault('enable', $source->enable);
        if ($source->hasallocations) {
            $mform->hardFreeze('enable');
        }
    
         // load jquery librairy for the pop up
         $urlstyle= new \moodle_url($CFG->wwwroot . '/enrol/programs/style-profile.css'.'?'."$todayversion");
        $mform->addElement('html', "<link href='$urlstyle' rel='stylesheet'/>");
        $plugins = [];
        require($CFG->libdir . '/jquery/plugins.php');
        foreach ($plugins as $ptype => $files) {
            foreach ($files['files'] as $file) {
                if(file_exists($CFG->libdir . '/jquery/' . $file)){
                    $ulrfile = new \moodle_url($CFG->wwwroot . '/lib/jquery/'.$file.'?'."$todayversion");
                    if($ptype  == 'ui-css'){
                        $mform->addElement('html', "<link href='$ulrfile' rel='stylesheet'/>");
                    }else{
                        $mform->addElement('html', "<script src='$ulrfile'></script>");
                    }
                    
                    break;
                }
            }
        }
        //end style
        $mform->addElement('textarea', 'datajson', get_string('attrsyntax', 'enrol_programs'));
        $mform->addHelpButton('datajson', 'attrsyntax', 'enrol_programs');

        $mform->addElement('html', '<div class="alert alert-warning alert-block fade in" 
            role="alert" data-aria-autofocus="true">' . get_string('listitem_description', 'enrol_programs') . '</div>');
         
        $mform->addElement('hidden', 'programid');
        $mform->setType('programid', PARAM_INT);
        $mform->setDefault('programid', $program->id);
        $mform->addElement('hidden', 'courseid');
        $mform->setType('courseid', PARAM_INT);
        $mform->setDefault('courseid', $COURSE->id);

        $mform->addElement('hidden', 'type');
        $mform->setType('type', PARAM_ALPHANUMEXT);
        $mform->setDefault('type', $source->type);
        
        $this->add_action_buttons(true, get_string('update'));
        $this->set_data($source);
        //----
       
        //load javascript data for profile rules settings
        $urljsparams= new \moodle_url($CFG->wwwroot . '/enrol/programs/jsparams.php'.'?'."$todayversion");
        $mform->addElement('html', "<script src='$urljsparams'></script>");
        $ulreditor = new \moodle_url($CFG->wwwroot . '/enrol/programs/js/jquery.booleanEditor.min.js'.'?'."$todayversion");
        $mform->addElement('html', "<script src='$ulreditor'></script>");
        $urljs = new \moodle_url($CFG->wwwroot . '/enrol/programs/js/javascript.min.js'.'?'."$todayversion");
        $mform->addElement('html', "<script src='$urljs'></script>");
        $urlstr =  new \moodle_url($CFG->wwwroot . '/lib/javascript-static.js'.'?'."$todayversion");
        $mform->addElement('html', "<script src='$urlstr'></script>");
    }

    public function validation($data, $files) {
        $errors = parent::validation($data, $files);

        return $errors;
    }
}
