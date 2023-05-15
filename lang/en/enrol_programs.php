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
$string['archived'] = 'Archived';
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
$string['creategroups'] = 'Course groups';
$string['creategroups_help'] = 'If enabled a group will be created in each course added to program and all allocated users will be added as group members.';
$string['deleteallocation'] = 'Delete program allocation';
$string['deletecourse'] = 'Remove course';
$string['deleteprogram'] = 'Delete program';
$string['deleteset'] = 'Delete set';
$string['documentation'] = 'Programs for Moodle documentation';
$string['duedate'] = 'Due date';
$string['enrolrole'] = 'Course role';
$string['enrolrole_desc'] = 'Select role that will be used by programs for course enrolment';
$string['errorcontentproblem'] = 'Problem detected in the program content structure, program completion will not be tracked correctly!';
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
$string['evidence_details'] = 'Details';
$string['fixeddate'] = 'At a fixed date';
$string['invalidallocationdates'] = 'Invalid program allocation dates';
$string['invalidcompletiondate'] = 'Invalid program completion date';
$string['item'] = 'Item';
$string['itemcompletion'] = 'Program item completion';
$string['management'] = 'Program management';
$string['messageprovider:allocation_notification'] = 'Program allocation notification';
$string['messageprovider:approval_request_notification'] = 'Program approval request notification';
$string['messageprovider:approval_reject_notification'] = 'Program request rejection notification';
$string['messageprovider:completion_notification'] = 'Program completed notification';
$string['messageprovider:deallocation_notification'] = 'Program deallocation notification';
$string['messageprovider:duesoon_notification'] = 'Program due date soon notification';
$string['messageprovider:due_notification'] = 'Program overdue notification';
$string['messageprovider:endsoon_notification'] = 'Program end date soon notification';
$string['messageprovider:endcompleted_notification'] = 'Completed program ended notification';
$string['messageprovider:endfailed_notification'] = 'Failed program ended notification';
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
$string['notification_due'] = 'Program overdue';
$string['notification_due_subject'] = 'Program completion was expected';
$string['notification_due_body'] = 'Hello {$a->user_fullname},

completion of program "{$a->program_fullname}" was expected before {$a->program_duedate}.
';
$string['notification_due_description'] = 'Notification sent to users when their program completion is overdue.';
$string['notification_endsoon'] = 'Program end date soon';
$string['notification_endsoon_subject'] = 'Program ends soon';
$string['notification_endsoon_body'] = 'Hello {$a->user_fullname},

program "{$a->program_fullname}" is ending on {$a->program_enddate}.
';
$string['notification_endsoon_description'] = 'Notification sent to users ahead of their program end date unless program is already completed.';
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
$string['programs:addtoplan'] = 'Add program to plans';
$string['programs:allocate'] = 'Allocate students to programs';
$string['programs:delete'] = 'Delete programs';
$string['programs:configframeworks'] = 'Configure program availability in plan frameworks';
$string['programs:edit'] = 'Add and update programs';
$string['programs:admin'] = 'Advanced program administration';
$string['programs:manageevidence'] = 'Manage other completion evidence';
$string['programs:view'] = 'View program management';
$string['programs:viewcatalogue'] = 'Access program catalogue';
$string['public'] = 'Public';
$string['public_help'] = 'Public programs are visible to all users.

Visibility status does not affect already allocated programs.';
$string['sequencetype'] = 'Completion type';
$string['sequencetype_allinorder'] = 'All in order';
$string['sequencetype_allinanyorder'] = 'All in any order';
$string['sequencetype_atleast'] = 'At least {$a->min}';
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
$string['source_cohort'] = 'Automatic cohort allocation';
$string['source_cohort_allownew'] = 'Allow cohort allocation';
$string['source_cohort_allownew_desc'] = 'Allow adding new _cohort auto allocation_ sources to programs';
$string['source_cohort_cohortstoallocate'] = 'Allocate cohorts';
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
$string['unlinkeditems'] = 'Unlinked items';
$string['updateprogram'] = 'Update program';
$string['updateallocation'] = 'Update allocation';
$string['updateallocations'] = 'Update allocations';
$string['updateset'] = 'Update set';
$string['updatescheduling'] = 'Update scheduling';
$string['updatesource'] = 'Update {$a}';
$string['userupload_completion_error'] = 'Program completion cannot be updated';
$string['userupload_completion_updated'] = 'Program completion was updated';
