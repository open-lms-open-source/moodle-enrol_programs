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

/**
 * Program enrolment plugin language file.
 *
 * @package    enrol_programs
 * @copyright  2022 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addprogram'] = 'Add program';
$string['addset'] = 'Add new set';
$string['allocationend'] = 'Allocation end';
$string['allocationend_help'] = 'Allocation end date meaning depends on enabled allocation sources. Usually new allocation are not possible after this date if specified.';
$string['allocation'] = 'Allocation';
$string['allocations'] = 'Allocations';
$string['programallocations'] = 'Program Allocations';
$string['allocationdate'] = 'Allocation date';
$string['allocationsources'] = 'Allocation sources';
$string['allocationstart'] = 'Allocation start';
$string['allocationstart_help'] = 'Allocation start date meaning depends on enabled allocation sources. Usually new allocation are possible only after this date if specified.';
$string['allprograms'] = 'All programs';
$string['appenditem'] = 'Append item';
$string['appendinto'] = 'Append into item';
$string['archive'] = 'Archive';
$string['archived'] = 'Archived';
$string['benefitname'] = '{$a}: Program allocation';
$string['calendarprogramend'] = '{$a} ends';
$string['calendarprogramdue'] = '{$a} is due';
$string['calendarprogramstart'] = '{$a} starts';
$string['catalogue'] = 'Program catalogue';
$string['catalogue_dofilter'] = 'Search';
$string['catalogue_resetfilter'] = 'Clear';
$string['catalogue_searchtext'] = 'Search text';
$string['catalogue_tag'] = 'Filter by tag';
$string['certificatetemplatechoose'] = 'Choose a template...';
$string['cohorts'] = 'Visible to cohorts';
$string['cohorts_help'] = 'Non-public programs can be made visible to specified cohort members.

Visibility status does not affect already allocated programs.';
$string['columnusedalready'] = 'Column is used already';
$string['completiondate'] = 'Completion date';
$string['completiondelay'] = 'Completion delay';
$string['completionoverride'] = 'Override completion';
$string['creategroups'] = 'Course groups';
$string['creategroups_help'] = 'If enabled a group will be created in each course added to program and all allocated users will be added as group members.';
$string['customfields'] = 'Programs custom fields';
$string['customfieldsettings'] = 'Commmon programs custom fields settings';
$string['customfieldvisibleto'] = 'Field content is visible to';
$string['customfieldvisible:allocated'] = 'Users allocated to programs';
$string['customfieldvisible:everyone'] = 'Everybody who can see other program details';
$string['customfieldvisible:viewcapability'] = 'Users with view programs capability';
$string['deleteallocation'] = 'Delete program allocation';
$string['deletecourse'] = 'Remove course';
$string['deleteprogram'] = 'Delete program';
$string['deleteset'] = 'Delete set';
$string['deletetraining'] = 'Remove training';
$string['documentation'] = 'Programs for Moodle documentation';
$string['duedate'] = 'Due date';
$string['enrolrole'] = 'Course role';
$string['enrolrole_desc'] = 'Select role that will be used by programs for course enrolment';
$string['errorcontentproblem'] = 'Problem detected in the program content structure, program completion will not be tracked correctly!';
$string['errorcoursemissing'] = 'Course is missing';
$string['errorcoursesmissing'] = 'Missing courses: {$a}';
$string['errorinvalidoverridedates'] = 'Invalid date overrides';
$string['errordifferenttenant'] = 'Program from another tenant cannot be accessed';
$string['errornoallocations'] = 'No user allocations found';
$string['errornoallocation'] = 'Program is not allocated';
$string['errornomyprograms'] = 'You are not allocated to any programs.';
$string['errornoprograms'] = 'No programs found.';
$string['errornorequests'] = 'No program requests found';
$string['errornotenabled'] = 'Programs plugin is not enabled';
$string['event_program_completed'] = 'Program completed';
$string['event_program_created'] = 'Program created';
$string['event_program_deleted'] = 'Program deleted';
$string['event_program_updated'] = 'Program updated';
$string['event_program_viewed'] = 'Program viewed';
$string['event_user_allocated'] = 'User allocated to program';
$string['event_user_deallocated'] = 'User deallocated from program';
$string['evidence'] = 'Other evidence';
$string['evidencedate'] = 'Evidence completion date';
$string['evidenceupdate'] = 'Update other evidence';
$string['evidenceupload'] = 'Upload completion evidences';
$string['evidenceupload_csvfile'] = 'CSV file';
$string['evidenceupload_errors'] = '{$a} invalid rows detected';
$string['evidenceupload_skipped'] = '{$a} rows skipped';
$string['evidenceupload_updated'] = 'Completion evidence updated for {$a} users';
$string['evidence_details'] = 'Details';
$string['evidence_detailsdefault'] = 'Default details';
$string['export'] = 'Export programs';
$string['exportfile_info'] = 'info';
$string['exportfile_programs'] = 'programs';
$string['exportformat'] = 'File format';
$string['exportformat_csv'] = 'CSV';
$string['exportformat_json'] = 'JSON';
$string['extra_menu_management_index'] = 'Programs actions';
$string['extra_menu_management_program_general'] = 'Program actions';
$string['extra_menu_management_program_users'] = 'Users actions';
$string['extra_menu_management_program_allocation'] = 'Allocation actions';
$string['fixeddate'] = 'At a fixed date';
$string['importallocationend'] = 'Allocation end ({$a})';
$string['importallocationstart'] = 'Allocation start ({$a})';
$string['importprogramallocation'] = 'Import program allocation';
$string['importprogramallocationconfirmation'] = 'You are importing allocation settings from program __{$a->fullname} / {$a->idnumber} / {$a->category}__.

Please select all settings that you want to import.';
<<<<<<< HEAD
=======
$string['source_externaldb_run'] = 'Run external database allocation';
$string['source_externaldb_runconfirm'] = 'Synchronise the program allocations immediately with the configured external database?';
$string['source_externaldb_runcomplete'] = 'External database allocation synchronisation finished.';
>>>>>>> e3f9c16 (Add privacy provider tests and cron task tests for enrol_programs plugin)
$string['importprogramcontent'] = 'Import program content';
$string['importprogramcontentconfirmation'] = 'You are importing content from program __{$a->fullname} / {$a->idnumber} / {$a->category}__.';
$string['importprogramdue'] = 'Program due ({$a})';
$string['importprogramend'] = 'Program end ({$a})';
$string['importprogramstart'] = 'Program start ({$a})';
$string['importselectprogram'] = 'Select program';
$string['invalidallocationdates'] = 'Invalid program allocation dates';
$string['invalidcompletiondate'] = 'Invalid program completion date';
$string['item'] = 'Item';
$string['itemcompletion'] = 'Program item completion';
$string['itempoints'] = 'Points';
$string['itemrecalculate'] = 'Recalculate item completion';
$string['management'] = 'Program management';
$string['messageprovider:allocation_notification'] = 'Program allocation notification';
$string['messageprovider:approval_request_notification'] = 'Program approval request notification';
$string['messageprovider:approval_reject_notification'] = 'Program request rejection notification';
$string['messageprovider:completion_notification'] = 'Program completed notification';
$string['messageprovider:completion_relateduser_notification'] = 'Program completed notification - related user';
$string['messageprovider:deallocation_notification'] = 'Program deallocation notification';
$string['messageprovider:duesoon_notification'] = 'Program due date soon notification';
$string['messageprovider:duesoon_relateduser_notification'] = 'Program due date soon notification - related user';
$string['messageprovider:due_notification'] = 'Program overdue notification';
$string['messageprovider:due_relateduser_notification'] = 'Program overdue notification - related user';
$string['messageprovider:endsoon_notification'] = 'Program end date soon notification';
$string['messageprovider:endsoon_relateduser_notification'] = 'Program end date soon notification - related user';
$string['messageprovider:endcompleted_notification'] = 'Completed program ended notification';
$string['messageprovider:endfailed_notification'] = 'Failed program ended notification';
$string['messageprovider:endfailed_relateduser_notification'] = 'Failed program ended notification - related user';
$string['messageprovider:reset_notification'] = 'Program reset notification';
$string['messageprovider:start_notification'] = 'Program started notification';
$string['moveitem'] = 'Move item';
$string['moveitemcancel'] = 'Cancel moving';
$string['moveafter'] = 'Move "{$a->item}" after "{$a->target}"';
$string['movebefore'] = 'Move "{$a->item}" before "{$a->target}"';
$string['moveinto'] = 'Move "{$a->item}" into "{$a->target}"';
$string['myprograms'] = 'My programs';
$string['notification_allocation'] = 'User allocated';
$string['notification_allocation_subject'] = 'Program allocation notification';
$string['notification_allocation_body'] = 'Hello {$a->user_fullname},

you have been allocated to program "{$a->program_fullname}", the start date is {$a->program_startdate}.
';
$string['notification_allocation_description'] = 'Notification sent to users when they are allocated to program.';
$string['notification_completion'] = 'Program completed';
$string['notification_completion_subject'] = 'Program completed';
$string['notification_completion_body'] = 'Hello {$a->user_fullname},

you have completed program "{$a->program_fullname}".
';
$string['notification_completion_description'] = 'Notification sent to users when they are complete their program.';
$string['notification_completion_relateduser'] = 'Program completed - related user';
$string['notification_completion_relateduser_subject'] = 'User {$a->user_fullname} completed program';
$string['notification_completion_relateduser_body'] = 'Hello {$a->relateduser_fullname},

user {$a->user_fullname} has completed program "{$a->program_fullname}".
';
$string['notification_completion_relateduser_description'] = 'Notification sent to users related to user when they are complete their program.';
$string['notification_deallocation'] = 'User deallocated';
$string['notification_deallocation_subject'] = 'Program deallocation notification';
$string['notification_deallocation_body'] = 'Hello {$a->user_fullname},

you have been deallocated from program "{$a->program_fullname}".
';
$string['notification_deallocation_description'] = 'Notification sent to users when they are deallocated from program.';
$string['notification_duesoon'] = 'Program due date soon';
$string['notification_duesoon_subject'] = 'Program completion is expected soon';
$string['notification_duesoon_body'] = 'Hello {$a->user_fullname},

completion of program "{$a->program_fullname}" is expected on {$a->program_duedate}.
';
$string['notification_duesoon_description'] = 'Notification sent to users ahead of their program completion date unless program is already completed.';
$string['notification_duesoon_relateduser'] = 'Program due date soon - related user';
$string['notification_duesoon_relateduser_subject'] = 'Program completion is expected soon for user {$a->user_fullname}';
$string['notification_duesoon_relateduser_body'] = 'Hello {$a->relateduser_fullname},

completion of program "{$a->program_fullname}" for user {$a->user_fullname} is expected on {$a->program_duedate}.
';
$string['notification_duesoon_relateduser_description'] = 'Notification sent to users related to user ahead of their program completion date unless program is already completed.';
$string['notification_due'] = 'Program overdue';
$string['notification_due_subject'] = 'Program completion was expected';
$string['notification_due_body'] = 'Hello {$a->user_fullname},

completion of program "{$a->program_fullname}" was expected before {$a->program_duedate}.
';
$string['notification_due_description'] = 'Notification sent to users when their program completion is overdue.';
$string['notification_due_relateduser'] = 'Program overdue - related user';
$string['notification_due_relateduser_subject'] = 'Program completion was expected for user {$a->user_fullname}';
$string['notification_due_relateduser_body'] = 'Hello {$a->relateduser_fullname},

completion of program "{$a->program_fullname}" for user {$a->user_fullname} was expected before {$a->program_duedate}.
';
$string['notification_due_relateduser_description'] = 'Notification sent to users related to user when their program completion is overdue.';
$string['notification_endsoon'] = 'Program end date soon';
$string['notification_endsoon_subject'] = 'Program ends soon';
$string['notification_endsoon_body'] = 'Hello {$a->user_fullname},

program "{$a->program_fullname}" is ending on {$a->program_enddate}.
';
$string['notification_endsoon_description'] = 'Notification sent to users ahead of their program end date unless program is already completed.';
$string['notification_endsoon_relateduser'] = 'Program end date soon - related user';
$string['notification_endsoon_relateduser_subject'] = 'Program ends soon for user {$a->user_fullname}';
$string['notification_endsoon_relateduser_body'] = 'Hello {$a->relateduser_fullname},

program "{$a->program_fullname}" for user {$a->user_fullname} is ending on {$a->program_enddate}.
';
$string['notification_endsoon_relateduser_description'] = 'Notification sent to users related to user ahead of their program end date unless program is already completed.';
$string['notification_endcompleted'] = 'Completed program ended';
$string['notification_endcompleted_subject'] = 'Completed program ended';
$string['notification_endcompleted_body'] = 'Hello {$a->user_fullname},

program "{$a->program_fullname}" ended, you have completed it earlier.
';
$string['notification_endcompleted_description'] = 'Notification sent to users when their completed program ends.';
$string['notification_endfailed'] = 'Failed program ended';
$string['notification_endfailed_subject'] = 'Failed program ended';
$string['notification_endfailed_body'] = 'Hello {$a->user_fullname},

program "{$a->program_fullname}" ended, you have failed to complete it.
';
$string['notification_endfailed_description'] = 'Notification sent to users when program they failed to complete ends.';
$string['notification_endfailed_relateduser'] = 'Failed program ended - related user';
$string['notification_endfailed_relateduser_subject'] = 'Failed program ended for user {$a->user_fullname}';
$string['notification_endfailed_relateduser_body'] = 'Hello {$a->relateduser_fullname},

program "{$a->program_fullname}" ended and user {$a->user_fullname} failed to complete it.
';
$string['notification_endfailed_relateduser_description'] = 'Notification sent to users related to user when program they failed to complete ends.';
$string['notification_relateduserfield'] = 'Notification related user field';
$string['notification_relateduserfield_desc'] = 'Select related users profile field to be used for notification of related users.';
$string['notification_reset'] = 'User progress reset';
$string['notification_reset_subject'] = 'Program reset notification';
$string['notification_reset_body'] = 'Hello {$a->user_fullname},

your progress in program "{$a->program_fullname}" was reset.
';
$string['notification_reset_description'] = 'Notification sent to users when their program progress is reset.';
$string['notification_start'] = 'Program started';
$string['notification_start_subject'] = 'Program started';
$string['notification_start_body'] = 'Hello {$a->user_fullname},

program "{$a->program_fullname}" has started.
';
$string['notification_start_description'] = 'Notification sent to users when their program started.';
$string['notificationdates'] = 'Notification dates';
$string['notset'] = 'Not set';
$string['plugindisabled'] = 'Program enrolment plugin is disabled, programs will not be functional.

[Enable plugin now]({$a->url})';
$string['pluginname'] = 'Programs';
$string['pluginname_desc'] = 'Programs are designed to allow creation of course sets.';
$string['privacy:metadata:field:programid'] = 'Program id';
$string['privacy:metadata:field:userid'] = 'User id';
$string['privacy:metadata:field:allocationid'] = 'Program allocation id';
$string['privacy:metadata:field:sourceid'] = 'Source of allocation';
$string['privacy:metadata:field:itemid'] = 'Item ID';
$string['privacy:metadata:field:timecreated'] = 'Creation date';
$string['privacy:metadata:field:timecompleted'] = 'Completion date';

$string['privacy:metadata:table:enrol_programs_allocations'] = 'Information about program allocations';
$string['privacy:metadata:field:archived'] = 'Is the record archived';
$string['privacy:metadata:field:sourcedatajson'] = 'Information about the source of the allocation';
$string['privacy:metadata:field:timeallocated'] = 'Program allocation date';
$string['privacy:metadata:field:timestart'] = 'Start date';
$string['privacy:metadata:field:timedue'] = 'Due date';
$string['privacy:metadata:field:timeend'] = 'End date';

$string['privacy:metadata:table:enrol_programs_certs_issues'] = 'Program allocation certificate issues';
$string['privacy:metadata:field:issueid'] = 'Issue ID';

$string['privacy:metadata:table:enrol_programs_completions'] = 'Program allocation completions';

$string['privacy:metadata:table:enrol_programs_evidences'] = 'Information about other completion evidences';
$string['privacy:metadata:field:evidencejson'] = 'Information about completion evidence';
$string['privacy:metadata:field:createdby'] = 'Evidence created by';

$string['privacy:metadata:table:enrol_programs_requests'] = 'Information about allocation request';
$string['privacy:metadata:field:datajson'] = 'Information about the request';
$string['privacy:metadata:field:timerequested'] = 'Request date';
$string['privacy:metadata:field:timerejected'] = 'Rejection date';
$string['privacy:metadata:field:rejectedby'] = 'Request rejected by';


$string['privacy:metadata:table:enrol_programs_usr_snapshots'] = 'Program allocation snapshots';
$string['privacy:metadata:field:reason'] = 'Reason';
$string['privacy:metadata:field:timesnapshot'] = 'Snapshot date';
$string['privacy:metadata:field:snapshotby'] = 'Snapshot by';
$string['privacy:metadata:field:explanation'] = 'Explanation';
$string['privacy:metadata:field:completionsjson'] = 'Information about completion';
$string['privacy:metadata:field:evidencesjson'] = 'Information about completion evidence';

$string['privacy:metadata:table:enrol_programs_src_commholds'] = 'Commerce allocation reservations';
$string['privacy:metadata:field:quantity'] = 'Quantity';

$string['program'] = 'Program';
$string['programautofix'] = 'Auto repair program';
$string['programdue'] = 'Program due';
$string['programdue_help'] = 'Program due date indicates when users are expected to complete the program.';
$string['programdue_delay'] = 'Due after start';
$string['programdue_date'] = 'Due date';
$string['programend'] = 'Program end';
$string['programend_help'] = 'Users cannot enter program courses after program end.';
$string['programend_delay'] = 'End after start';
$string['programend_date'] = 'Program end date';
$string['programcompletion'] = 'Program completion date';
$string['programcompletionoverride'] = 'Override program completion';
$string['programidnumber'] = 'Program idnumber';
$string['programimage'] = 'Program image';
$string['programname'] = 'Program name';
$string['programurl'] = 'Program URL';
$string['programs'] = 'Programs';
$string['programsactive'] = 'Active';
$string['programsarchived'] = 'Archived';
$string['programsarchived_help'] = 'Archived programs are hidden from users and their progress is locked.';
$string['programstart'] = 'Program start';
$string['programstart_help'] = 'Users cannot enter program courses before program start.';
$string['programstart_allocation'] = 'Start immediately after allocation';
$string['programstart_delay'] = 'Delay start after allocation';
$string['programstart_date'] = 'Program start date';
$string['programstatus'] = 'Program status';
$string['programstatus_completed'] = 'Completed';
$string['programstatus_any'] = 'Any program status';
$string['programstatus_archived'] = 'Archived';
$string['programstatus_archivedcompleted'] = 'Archived completed';
$string['programstatus_overdue'] = 'Overdue';
$string['programstatus_open'] = 'Open';
$string['programstatus_future'] = 'Not open yet';
$string['programstatus_failed'] = 'Failed';
$string['programs:addcourse'] = 'Add course to programs';
$string['programs:addtocertifications'] = 'Add program to certifications';
$string['programs:addtoplan'] = 'Add program to plans';
$string['programs:allocate'] = 'Allocate students to programs';
$string['programs:archive'] = 'Archive program allocations';
$string['programs:clone'] = 'Allow cloning of program content and settings';
$string['programs:configframeworks'] = 'Configure program availability in plan frameworks';
$string['programs:configurecustomfields'] = 'Configure program custom fields';
$string['programs:delete'] = 'Delete programs';
$string['programs:edit'] = 'Add and update programs';
$string['programs:export'] = 'Export programs';
$string['programs:admin'] = 'Advanced program administration';
$string['programs:manageallocation'] = 'Manage user allocations';
$string['programs:manageevidence'] = 'Manage other completion evidence';
$string['programs:reset'] = 'Reset program progress';
$string['programs:upload'] = 'Upload programs';
$string['programs:view'] = 'View program management';
$string['programs:viewcatalogue'] = 'Access program catalogue';
$string['public'] = 'Public';
$string['public_help'] = 'Public programs are visible to all users.

Visibility status does not affect already allocated programs.';
$string['purchaseaccess'] = 'Purchase access';
$string['resetallocation'] = 'Reset program progress';
$string['resettype'] = 'Reset type';
$string['resettype_deallocate'] = 'Program de-allocation only';
$string['resettype_full'] = 'Full course purge';
$string['resettype_none'] = 'None';
$string['resettype_standard'] = 'Standard course purge';
$string['sequencetype'] = 'Completion type';
$string['sequencetype_allinorder'] = 'All in order';
$string['sequencetype_allinanyorder'] = 'All in any order';
$string['sequencetype_atleast'] = 'At least {$a->min}';
$string['sequencetype_minpoints'] = 'Minimum {$a->minpoints} points';
$string['selectcategory'] = 'Select category';
$string['source'] = 'Source';
$string['source_approval'] = 'Requests with approval';
$string['source_approval_allownew'] = 'Allow approvals';
$string['source_approval_allownew_desc'] = 'Allow adding new _requests with approval_ sources to programs';
$string['source_approval_allowrequest'] = 'Allow new requests';
$string['source_approval_confirm'] = 'Please confirm that you want to request allocation to the program.';
$string['source_approval_daterequested'] = 'Date requested';
$string['source_approval_daterejected'] = 'Date rejected';
$string['source_approval_makerequest'] = 'Request access';
$string['source_approval_notification_approval_request_subject'] = 'Program request notification';
$string['source_approval_notification_approval_request_body'] = '
User {$a->user_fullname} requested access to program "{$a->program_fullname}".
';
$string['source_approval_notification_approval_reject_subject'] = 'Program request rejection notification';
$string['source_approval_notification_approval_reject_body'] = 'Hello {$a->user_fullname},

your request to access "{$a->program_fullname}" program was rejected.

{$a->reason}
';
$string['source_approval_requestallowed'] = 'Requests are allowed';
$string['source_approval_requestnotallowed'] = 'Requests are not allowed';
$string['source_approval_requests'] = 'Requests';
$string['source_approval_requestpending'] = 'Access request pending';
$string['source_approval_requestrejected'] = 'Access request was rejected';
$string['source_approval_requestapprove'] = 'Approve request';
$string['source_approval_requestreject'] = 'Reject request';
$string['source_approval_requestdelete'] = 'Delete request';
$string['source_approval_rejectionreason'] = 'Rejection reason';
$string['source_certify'] = 'Certifications';
$string['source_certify_allownew'] = 'Allow certifications allocation';
$string['source_certify_allownew_desc'] = 'Allow adding new _certification_ sources to programs';
$string['source_cohort'] = 'Automatic cohort allocation';
$string['source_cohort_allownew'] = 'Allow cohort allocation';
$string['source_cohort_allownew_desc'] = 'Allow adding new _cohort auto allocation_ sources to programs';
$string['source_cohort_cohortstoallocate'] = 'Allocate cohorts';
$string['source_ecommerce'] = 'E-Commerce allocation';
$string['source_ecommerce_allownew'] = 'Allow e-commerce allocation';
$string['source_ecommerce_allownew_desc'] = 'Allow adding new e-commerce auto allocation sources to programs';
$string['source_ecommerce_allowsignup'] = 'Allow new allocations';
$string['source_ecommerce_cohortmembershiprequirement'] = 'Users must be a member of one of the following cohorts: {$a}';
$string['source_ecommerce_maxusers'] = 'Max users';
$string['source_ecommerce_nocapacity'] = 'There is no remaining capacity on this program';
<<<<<<< HEAD
=======
$string['source_externaldb'] = 'External database allocation';
$string['source_externaldb_allownew'] = 'Allow external database allocation';
$string['source_externaldb_allownew_desc'] = 'Allow adding new external database allocation sources to programs';
$string['source_externaldb_heading'] = 'External database connection';
$string['source_externaldb_heading_desc'] = 'Configure the database connection that provides program allocations.';
$string['source_externaldb_dbtype'] = 'Database driver';
$string['source_externaldb_dbtype_desc'] = 'Driver name understood by ADODB, for example mysqli, postgres, oracle, sqlite3 or pdo.';
$string['source_externaldb_dbhost'] = 'Database host / DSN';
$string['source_externaldb_dbuser'] = 'Database user';
$string['source_externaldb_dbpass'] = 'Database password';
$string['source_externaldb_dbname'] = 'Database name';
$string['source_externaldb_dbencoding'] = 'Database encoding';
$string['source_externaldb_dbsetupsql'] = 'Setup SQL';
$string['source_externaldb_dbsybasequoting'] = 'Enable Sybase quotes';
$string['source_externaldb_debugdb'] = 'Debug external DB connection';
$string['source_externaldb_debugdb_desc'] = 'Enable verbose output from ADODB when connecting to the external database. Use for troubleshooting only.';
$string['source_externaldb_remotetable'] = 'Remote allocation table';
$string['source_externaldb_programfield'] = 'Program field name';
$string['source_externaldb_userfield'] = 'User field name';
$string['source_externaldb_localprogramfield'] = 'Local program field';
$string['source_externaldb_localuserfield'] = 'Local user field';
$string['source_externaldb_archivemissing'] = 'Archive missing allocations';
$string['source_externaldb_archivemissing_desc'] = 'Archive allocations created by this source when the corresponding record is no longer present in the external database.';
$string['source_externaldb_archivemissing_help'] = 'When enabled, allocations created by this source will be archived automatically if the matching record is removed from the external database table.';
$string['source_externaldb_configinfo'] = 'External table: {$a->table}, program field: {$a->programfield}, user field: {$a->userfield}';
$string['source_externaldb_confignotset'] = 'External database connection is not configured. Complete the settings above before enabling this source.';
$string['source_externaldb_programvalue'] = 'Program identifier override';
$string['source_externaldb_programvalue_help'] = 'Optional value that should match the external program field. Leave empty to use the configured local program field value.';
$string['source_externaldb_missingprogramvalue'] = 'Enter a value or populate the program {$a} field so that the external record can be matched.';
$string['source_externaldb_status_programvalue'] = 'external value {$a}';
$string['source_externaldb_status_programfield'] = 'taken from program value {$a}';
$string['source_externaldb_status_archiving'] = 'missing entries archived automatically';
$string['error_source_disable_hasallocations'] = 'This allocation source already has users assigned and cannot be disabled.';
>>>>>>> e3f9c16 (Add privacy provider tests and cron task tests for enrol_programs plugin)
$string['source_manual'] = 'Manual allocation';
$string['source_manual_allocateusers'] = 'Allocate users';
$string['source_manual_csvfile'] = 'CSV file';
$string['source_manual_hasheaders'] = 'First line is header';
$string['source_manual_potusersmatching'] = 'Matching allocation candidates';
$string['source_manual_potusers'] = 'Allocation candidates';
$string['source_manual_result_assigned'] = '{$a} users were assigned to program.';
$string['source_manual_result_errors'] = '{$a} errors detected when assigning programs.';
$string['source_manual_result_skipped'] = '{$a} users were already assigned to program.';
$string['source_manual_timeduecolumn'] = 'Time due column';
$string['source_manual_timeendcolumn'] = 'Time end column';
$string['source_manual_timestartcolumn'] = 'Time start column';
$string['source_manual_uploadusers'] = 'Upload allocations';
$string['source_manual_usercolumn'] = 'User identification column';
$string['source_manual_usermapping'] = 'User mapping via';
$string['source_manual_userupload_allocated'] = 'Allocated to \'{$a}\'';
$string['source_manual_userupload_alreadyallocated'] = 'Already allocated to \'{$a}\'';
$string['source_manual_userupload_invalidprogram'] = 'Cannot allocate to \'{$a}\'';
$string['source_selfallocation'] = 'Self allocation';
$string['source_selfallocation_allocate'] = 'Sign up';
$string['source_selfallocation_allownew'] = 'Allow self allocation';
$string['source_selfallocation_allownew_desc'] = 'Allow adding new _self allocation_ sources to programs';
$string['source_selfallocation_allowsignup'] = 'Allow new sign ups';
$string['source_selfallocation_confirm'] = 'Please confirm that you want to be allocated to the program.';
$string['source_selfallocation_enable'] = 'Enable self allocation';
$string['source_selfallocation_key'] = 'Sign up key';
$string['source_selfallocation_keyrequired'] = 'Sign up key is required';
$string['source_selfallocation_maxusers'] = 'Max users';
$string['source_selfallocation_maxusersreached'] = 'Maximum number of users self-allocated already';
$string['source_selfallocation_maxusers_status'] = 'Users {$a->count}/{$a->max}';
$string['source_selfallocation_signupallowed'] = 'Sign ups are allowed';
$string['source_selfallocation_signupnotallowed'] = 'Sign ups are not allowed';
$string['source_udplans'] = 'User development plans';
$string['source_udplans_allownew'] = 'User development plans';
$string['source_udplans_allownew_desc'] = 'Allow adding new _user development plans_ sources to programs';
$string['source_udplans_allowed'] = 'Allowed';
$string['source_udplans_noframeworks'] = 'Cannot be added to any plans';
$string['source_udplans_notallowed'] = 'Not allowed';
$string['source_udplans_requirecap'] = 'Add capability required';
$string['set'] = 'Course set';
$string['settings'] = 'Program settings';
$string['scheduling'] = 'Scheduling';
$string['taballocation'] = 'Allocation settings';
$string['tabcontent'] = 'Content';
$string['tabgeneral'] = 'General';
$string['tabusers'] = 'Users';
$string['tabvisibility'] = 'Visibility settings';
$string['tagarea_program'] = 'Programs';
$string['taskcertificate'] = 'Programs certificate issuing cron';
$string['taskcron'] = 'Programs plugin cron';
<<<<<<< HEAD
=======
$string['taskexternaldbsync'] = 'Synchronise external database allocations';
>>>>>>> e3f9c16 (Add privacy provider tests and cron task tests for enrol_programs plugin)
$string['training'] = 'Training';
$string['trainingcompletion'] = 'Required training: {$a}';
$string['trainingprogress'] = 'Training progress: {$a->current}/{$a->total}';
$string['unarchive'] = 'Restore';
$string['unlinkeditems'] = 'Unlinked items';
$string['updateprogram'] = 'Update program';
$string['updateallocation'] = 'Update allocation';
$string['updateallocations'] = 'Update allocations';
$string['updatecourse'] = 'Update course';
$string['updateset'] = 'Update set';
$string['updatescheduling'] = 'Update scheduling';
$string['updatesource'] = 'Update {$a}';
$string['updatetraining'] = 'Update training';
$string['upload'] = 'Upload programs';
$string['upload_invalidcount'] = 'Invalid records';
$string['upload_files'] = 'Files';
$string['upload_files_error'] = 'Multiple CSV files, one JSON file or one Zip archive are expected';
$string['upload_preview'] = 'Data preview';
$string['upload_status'] = 'Status';
$string['upload_status_invalid'] = 'Invalid';
$string['upload_targetcontext'] = 'Add programs into context';
$string['upload_uploadcount'] = 'Programs to upload';
$string['upload_usecategory'] = 'Use category column for contexts';
$string['userupload_completion_error'] = 'Program completion cannot be updated';
$string['userupload_completion_updated'] = 'Program completion was updated';

$string['rb_allocatedprograms'] = 'Allocated programs';
$string['rb_complete'] = 'Complete';
$string['rb_completiondate'] = 'Completion Date';
$string['rb_completionstatus'] = 'Completion Status';
$string['rb_datecompleted'] = 'Date Completed';
$string['rb_dateallocated'] = 'Date Allocated';
$string['rb_datestarted'] = 'Date Started';
$string['rb_coursesall'] = 'Course(s) - All';
$string['rb_incomplete'] = 'Incomplete';
$string['rb_isallocated'] = 'Is allocated';
$string['rb_iscomplete'] = 'Is complete?';
$string['rb_iscompleteany'] = 'Is complete? (any method)';
$string['rb_isinprogress'] = 'Is in progress?';
$string['rb_isnotcomplete'] = 'Is not complete?';
$string['rb_isnotyetstarted'] = 'Is not yet started?';
$string['rb_notstarted'] = 'Not Started';
$string['rb_officewhencompletedbasic'] = 'Office when completed (basic)';
$string['rb_privacy:metadata'] = 'The plugin does not store any personal data.';
$string['rb_programcategory'] = 'Program Category (or Site)';
$string['rb_programcategoryid'] = 'Program Category ID (N/A if site)';
$string['rb_programcategoryidnumber'] = 'Program Category ID Number (N/A if site)';
$string['rb_programcategorymultichoice'] = 'Program Category (multichoice)';
$string['rb_programedatecreated'] = 'Program Date Created';
$string['rb_programduedate'] = 'Program Due Date';
$string['rb_programenddate'] = 'Program Allocation End Date';
$string['rb_programallocationtype'] = 'Allocation Type';
$string['rb_programallocationtypes'] = 'Allocation Types';
$string['rb_programexpandlink'] = 'Program Name (expanding details)';
$string['rb_programid'] = 'Program ID';
$string['rb_programidnumber'] = 'Program ID Number';
$string['rb_programname'] = 'Program Name';
$string['rb_programnameandsummary'] = 'Program Name and Description';
$string['rb_programnamelinked'] = 'Program Name (linked to program page)';
$string['rb_programmultiitem'] = 'Program (multi-item)';
$string['rb_programsingleitem'] = 'Program';
$string['rb_programstartdate'] = 'Program Allocation Start Date';
$string['rb_programsummary'] = 'Program Description';
$string['rb_programvisible'] = 'Program is Public';
$string['rb_programvisibledisabled'] = 'Program Visible (not applicable)';
$string['rb_progress'] = 'Progress';
$string['rb_progressnumeric'] = 'Progress (numeric)';
$string['rb_progresspercent'] = 'Progress (% complete)';
$string['rb_source_allocation'] = 'Program Allocations';
$string['rb_timetocompletesinceenrol'] = 'Time to complete (since allocation date)';
$string['rb_timetocompletesincestart'] = 'Time to complete (since start date)';
$string['rb_type_program'] = 'Program';
$string['rb_type_program_category'] = 'Category';
$string['rb_type_program_completion'] = 'Program Allocation';
$string['rb_type_program_customfields'] = 'Program custom fields';
$string['rb_user'] = 'The user';
$string['rb_viewprogram'] = 'View Program';
$string['rb_visiblecohorts'] = 'Cohorts with visibility';
