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
 * @copyright  2023 Open LMS (https://www.openlms.net/)
 * @author     Chris Tranel
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addprogram'] = '新增計畫';
$string['addset'] = '新增集合';
$string['allocationend'] = '分配結束';
$string['allocationend_help'] = '分配結束日期的意義須取決於已啟用的分配來源。一般來說，若已指明，在此日期之後便無法再進行任何新的分配。';
$string['allocation'] = '分配';
$string['allocations'] = '分配';
$string['programallocations'] = '計畫分配';
$string['allocationdate'] = '分配日期';
$string['allocationsources'] = '分配來源';
$string['allocationstart'] = '分配開始';
$string['allocationstart_help'] = '分配開始日期的意義須取決於已啟用的分配來源。一般來說，若已指明，那就只有在此日期之後才可以進行任何新的分配。';
$string['allprograms'] = '全部計畫';
$string['appenditem'] = '附加項目';
$string['appendinto'] = '附加至項目中';
$string['archived'] = '封存檔';
$string['catalogue'] = '計畫目錄';
$string['catalogue_dofilter'] = '搜尋';
$string['catalogue_resetfilter'] = '清除';
$string['catalogue_searchtext'] = '搜尋文字';
$string['catalogue_tag'] = '依標籤篩選';
$string['certificatetemplatechoose'] = '選擇一個範本...';
$string['cohorts'] = '同期學員可以看見';
$string['cohorts_help'] = '經過設定後，特定同期學員成員便可看見非公開計畫。

可見性狀態對於已分配之計畫不造成影響。';
$string['completiondate'] = '完成日期';
$string['creategroups'] = '課程小組';
$string['creategroups_help'] = '啟用這個選項，就會在新增至計畫的每個課程中建立一個小組，且所有已分配使用者都會被新增至小組中而成為小組成員。';
$string['deleteallocation'] = '刪除計畫分配';
$string['deletecourse'] = '移除課程';
$string['deleteprogram'] = '刪除計畫';
$string['deleteset'] = '刪除集合';
$string['documentation'] = 'Moodle 文件相關計畫';
$string['duedate'] = '截止日期';
$string['enrolrole'] = '課程角色';
$string['enrolrole_desc'] = '選取將供計畫用來進行課程註冊的角色';
$string['errorcontentproblem'] = '在計畫內容結構中偵測到問題，計畫完成狀態將無法正確追蹤！';
$string['errordifferenttenant'] = '無法存取其他租用戶的計畫';
$string['errornoallocations'] = '找不到任何使用者分配';
$string['errornoallocation'] = '計畫未分配';
$string['errornomyprograms'] = '您並未分配到任何計畫。';
$string['errornoprograms'] = '找不到任何計畫。';
$string['errornorequests'] = '找不到任何計畫請求';
$string['errornotenabled'] = '計畫外掛程式未啟用';
$string['event_program_completed'] = '已完成計畫';
$string['event_program_created'] = '已建立計畫';
$string['event_program_deleted'] = '已刪除計畫';
$string['event_program_updated'] = '已更新計畫';
$string['event_program_viewed'] = '已檢視計畫';
$string['event_user_allocated'] = '已分配至計畫的使用者';
$string['event_user_deallocated'] = '已從計畫解除分配的使用者';
$string['evidence'] = '其他證明';
$string['evidence_details'] = '詳細資料';
$string['fixeddate'] = '在固定的日期';
$string['item'] = '項目';
$string['itemcompletion'] = '計畫項目完成';
$string['management'] = '計畫管理';
$string['messageprovider:allocation_notification'] = '計畫分配通知';
$string['messageprovider:approval_request_notification'] = '計畫核准請求通知';
$string['messageprovider:approval_reject_notification'] = '計畫請求拒絕通知';
$string['messageprovider:completion_notification'] = '計畫已完成通知';
$string['messageprovider:deallocation_notification'] = '計畫解除分配通知';
$string['messageprovider:duesoon_notification'] = '計畫將屆截止日期通知';
$string['messageprovider:due_notification'] = '計畫已過期通知';
$string['messageprovider:endsoon_notification'] = '計畫將屆結束日期通知';
$string['messageprovider:endcompleted_notification'] = '已完成計畫已結束通知';
$string['messageprovider:endfailed_notification'] = '失敗計畫已結束通知';
$string['messageprovider:start_notification'] = '計畫已開始通知';
$string['moveitem'] = '移動項目';
$string['moveitemcancel'] = '取消移動';
$string['moveafter'] = '移動「{$a->item}」到「{$a->target}」之後';
$string['movebefore'] = '移動「{$a->item}」到「{$a->target}」之前';
$string['moveinto'] = '移動「{$a->item}」到「{$a->target}」中';
$string['myprograms'] = '我的計畫';
$string['notification_allocation'] = '已分配使用者';
$string['notification_completion'] = '已完成計畫';
$string['notification_completion_subject'] = '已完成計畫';
$string['notification_completion_body'] = '{$a->user_fullname} 您好：

您已完成「{$a->program_fullname}」計畫。
';
$string['notification_deallocation'] = '已解除分配使用者';
$string['notification_duesoon'] = '計畫將屆截止日期';
$string['notification_duesoon_subject'] = '計畫預計即將完成';
$string['notification_duesoon_body'] = '{$a->user_fullname} 您好：

「{$a->program_fullname}」計畫預計將在 {$a->program_duedate} 完成。
';
$string['notification_due'] = '計畫已過期';
$string['notification_due_subject'] = '計畫未按預計時程完成';
$string['notification_due_body'] = '{$a->user_fullname} 您好：

「{$a->program_fullname}」計畫按照預計本應在 {$a->program_duedate} 前完成。
';
$string['notification_endsoon'] = '計畫將屆結束日期';
$string['notification_endsoon_subject'] = '計畫即將結束';
$string['notification_endsoon_body'] = '{$a->user_fullname} 您好：

「{$a->program_fullname}」計畫即將在 {$a->program_enddate} 結束。
';
$string['notification_endcompleted'] = '已完成計畫已結束';
$string['notification_endcompleted_subject'] = '已完成計畫已結束';
$string['notification_endcompleted_body'] = '{$a->user_fullname} 您好：

「{$a->program_fullname}」計畫已結束，而您在這之前便已將其完成。
';
$string['notification_endfailed'] = '失敗計畫已結束';
$string['notification_endfailed_subject'] = '失敗計畫已結束';
$string['notification_endfailed_body'] = '{$a->user_fullname} 您好：

「{$a->program_fullname}」計畫已結束，而您並未成功將其完成。
';
$string['notification_start'] = '計畫已開始';
$string['notification_start_subject'] = '計畫已開始';
$string['notification_start_body'] = '{$a->user_fullname} 您好：

「{$a->program_fullname}」計畫已經開始。
';
$string['notificationdates'] = '通知日期';
$string['notset'] = '未設定';
$string['plugindisabled'] = '計畫註冊外掛程式已停用，因此計畫將不會正常運作。

[Enable plugin now]({$a->url})';
$string['pluginname'] = '計畫';
$string['pluginname_desc'] = '因其設計構造，您可以在計畫下建立課程集合。';
$string['privacy:metadata:field:programid'] = '計畫編號';
$string['privacy:metadata:field:userid'] = '使用者編號';
$string['privacy:metadata:field:allocationid'] = '計畫分配編號';
$string['privacy:metadata:field:sourceid'] = '分配來源';
$string['privacy:metadata:field:itemid'] = '項目編號';
$string['privacy:metadata:field:timecreated'] = '建立日期';
$string['privacy:metadata:field:timecompleted'] = '完成日期';

$string['privacy:metadata:table:enrol_programs_allocations'] = '計畫分配相關資訊';
$string['privacy:metadata:field:archived'] = '記錄是否已封存';
$string['privacy:metadata:field:sourcedatajson'] = '分配來源相關資訊';
$string['privacy:metadata:field:timeallocated'] = '計畫分配日期';
$string['privacy:metadata:field:timestart'] = '開始日期';
$string['privacy:metadata:field:timedue'] = '截止日期';
$string['privacy:metadata:field:timeend'] = '結束日期';

$string['privacy:metadata:table:enrol_programs_certs_issues'] = '計畫分配證書頒發作業';
$string['privacy:metadata:field:issueid'] = '頒發作業編號';

$string['privacy:metadata:table:enrol_programs_completions'] = '計畫分配完成';

$string['privacy:metadata:table:enrol_programs_evidences'] = '其他完成證明相關資訊';
$string['privacy:metadata:field:evidencejson'] = '完成證明相關資訊';
$string['privacy:metadata:field:createdby'] = '證明建立者：';

$string['privacy:metadata:table:enrol_programs_requests'] = '分配請求相關資訊';
$string['privacy:metadata:field:datajson'] = '請求相關資訊';
$string['privacy:metadata:field:timerequested'] = '請求日期';
$string['privacy:metadata:field:timerejected'] = '拒絕日期';
$string['privacy:metadata:field:rejectedby'] = '請求拒絕者：';


$string['privacy:metadata:table:enrol_programs_usr_snapshots'] = '計畫分配快照';
$string['privacy:metadata:field:reason'] = '理由';
$string['privacy:metadata:field:timesnapshot'] = '快照日期';
$string['privacy:metadata:field:snapshotby'] = '快照建立者：';
$string['privacy:metadata:field:explanation'] = '解釋';
$string['privacy:metadata:field:completionsjson'] = '完成相關資訊';
$string['privacy:metadata:field:evidencesjson'] = '完成證明相關資訊';

$string['program'] = '計畫';
$string['programautofix'] = '自動修復計畫';
$string['programdue'] = '計畫截止';
$string['programdue_help'] = '計畫截止日期，指的是使用者預計應完成計畫的日期。';
$string['programdue_delay'] = '截止日期為開始後：';
$string['programdue_date'] = '截止日期';
$string['programend'] = '計畫結束';
$string['programend_help'] = '使用者不能在計畫結束後進入計畫課程。';
$string['programend_delay'] = '結束日期為開始後：';
$string['programend_date'] = '計畫結束日期';
$string['programcompletion'] = '計畫完成日期';
$string['programidnumber'] = '計畫編號';
$string['programimage'] = '計畫影像';
$string['programname'] = '計畫名稱';
$string['programurl'] = '計畫 URL';
$string['programs'] = '計畫';
$string['programsactive'] = '作用中';
$string['programsarchived'] = '封存檔';
$string['programsarchived_help'] = '使用者無法看到已封存計畫，且其進度將保持鎖定狀態。';
$string['programstart'] = '計畫開始';
$string['programstart_help'] = '使用者不能在計畫開始前進入計畫課程。';
$string['programstart_allocation'] = '分配後立即開始';
$string['programstart_delay'] = '分配後延遲開始';
$string['programstart_date'] = '計畫開始日期';
$string['programstatus'] = '計畫狀態';
$string['programstatus_completed'] = '已完成';
$string['programstatus_any'] = '任何計畫狀態';
$string['programstatus_archived'] = '封存檔';
$string['programstatus_archivedcompleted'] = '封存已完成';
$string['programstatus_overdue'] = '過期';
$string['programstatus_open'] = '開啟舊檔';
$string['programstatus_future'] = '尚未開啟';
$string['programstatus_failed'] = '失敗';
$string['programs:addcourse'] = '新增課程至計畫中';
$string['programs:allocate'] = '分配學員至計畫中';
$string['programs:delete'] = '刪除計畫';
$string['programs:edit'] = '新增及更新計畫';
$string['programs:admin'] = '進階計畫管理';
$string['programs:manageevidence'] = '管理其他完成證明';
$string['programs:view'] = '查看計畫管理';
$string['programs:viewcatalogue'] = '存取計畫目錄';
$string['public'] = '公開';
$string['public_help'] = '所有使用者均可看見公開計畫。

可見性狀態對於已分配之計畫不造成影響。';
$string['sequencetype'] = '完成類型';
$string['sequencetype_allinorder'] = '顯示全部 (按順序)';
$string['sequencetype_allinanyorder'] = '顯示全部 (按任何順序)';
$string['sequencetype_atleast'] = '{$a->min} 以上';
$string['selectcategory'] = '選擇類別';
$string['source'] = '來源';
$string['source_approval'] = '附核准的請求';
$string['source_approval_allownew'] = '允許核准';
$string['source_approval_allownew_desc'] = '允許新增「_requests with approval_」來源至計畫中';
$string['source_approval_allowrequest'] = '允許新請求';
$string['source_approval_confirm'] = '請確認您是否要請求分配至此計畫。';
$string['source_approval_daterequested'] = '請求日期';
$string['source_approval_daterejected'] = '拒絕日期';
$string['source_approval_makerequest'] = '請求存取';
$string['source_approval_notification_allocation_subject'] = '計畫核准通知';
$string['source_approval_notification_allocation_body'] = '{$a->user_fullname} 您好：

您提出的「{$a->program_fullname}」計畫報名已核准，開始日期為 {$a->program_startdate}。
';
$string['source_approval_notification_approval_request_subject'] = '計畫請求通知';
$string['source_approval_notification_approval_request_body'] = '
使用者 {$a->user_fullname} 已請求存取「{$a->program_fullname}」計畫。
';
$string['source_approval_notification_approval_reject_subject'] = '計畫請求拒絕通知';
$string['source_approval_notification_approval_reject_body'] = '{$a->user_fullname} 您好：

您提出的「{$a->program_fullname}」計畫存取請求已被拒絕。

{$a->reason}
';
$string['source_approval_requestallowed'] = '允許請求';
$string['source_approval_requestnotallowed'] = '不允許請求';
$string['source_approval_requests'] = '請求';
$string['source_approval_requestpending'] = '待處理的存取請求';
$string['source_approval_requestrejected'] = '存取請求已被拒絕';
$string['source_approval_requestapprove'] = '核准請求';
$string['source_approval_requestreject'] = '拒絕請求';
$string['source_approval_requestdelete'] = '刪除請求';
$string['source_approval_rejectionreason'] = '拒絕理由';
$string['notification_allocation_subject'] = '計畫分配通知';
$string['notification_allocation_body'] = '{$a->user_fullname} 您好：

您已分配至「{$a->program_fullname}」計畫，開始日期為 {$a->program_startdate}。
';
$string['notification_deallocation_subject'] = '計畫解除分配通知';
$string['notification_deallocation_body'] = '{$a->user_fullname} 您好：

您已從「{$a->program_fullname}」計畫解除分配。
';
$string['source_cohort'] = '自動同期學員分配';
$string['source_cohort_allownew'] = '允許同期學員分配';
$string['source_cohort_allownew_desc'] = '允許新增「_cohort auto allocation_」來源至計畫中';
$string['source_manual'] = '手動分配';
$string['source_manual_allocateusers'] = '分配使用者';
$string['source_manual_csvfile'] = 'CSV 檔案';
$string['source_manual_hasheaders'] = '第一行是標題';
$string['source_manual_potusersmatching'] = '匹配分配人選';
$string['source_manual_potusers'] = '分配人選';
$string['source_manual_result_assigned'] = '有 {$a} 個使用者被指派計畫。';
$string['source_manual_result_errors'] = '指派計畫時偵測到了 {$a} 個錯誤。';
$string['source_manual_result_skipped'] = '已有 {$a} 個使用者被指派計畫。';
$string['source_manual_uploadusers'] = '上傳分配';
$string['source_manual_usercolumn'] = '使用者身份欄';
$string['source_manual_usermapping'] = '透過下列方式進行之使用者對應：';
$string['source_manual_userupload_allocated'] = '被分配至「{$a}」';
$string['source_manual_userupload_alreadyallocated'] = '已被分配至「{$a}」';
$string['source_manual_userupload_invalidprogram'] = '無法分配至「{$a}」';
$string['source_selfallocation'] = '自行分配';
$string['source_selfallocation_allocate'] = '報名';
$string['source_selfallocation_allownew'] = '允許自行分配';
$string['source_selfallocation_allownew_desc'] = '允許新增「_self allocation_」來源至計畫中';
$string['source_selfallocation_allowsignup'] = '允許新的報名';
$string['source_selfallocation_confirm'] = '請確認您是否想要分配至此計畫。';
$string['source_selfallocation_enable'] = '啟用自行分配';
$string['source_selfallocation_key'] = '報名金鑰';
$string['source_selfallocation_keyrequired'] = '需要報名金鑰';
$string['source_selfallocation_maxusers'] = '使用者人數上限';
$string['source_selfallocation_maxusersreached'] = '已經達到自行分配使用者數目上限';
$string['source_selfallocation_maxusers_status'] = '使用者 {$a->count}/{$a->max}';
$string['source_selfallocation_notification_allocation_subject'] = '計畫分配通知';
$string['source_selfallocation_notification_allocation_body'] = '{$a->user_fullname} 您好：

您已報名「{$a->program_fullname}」計畫，開始日期為 {$a->program_startdate}。
';
$string['source_selfallocation_signupallowed'] = '允許報名';
$string['source_selfallocation_signupnotallowed'] = '不允許報名';
$string['set'] = '課程集合';
$string['settings'] = '計畫設定';
$string['scheduling'] = '排程';
$string['taballocation'] = '分配設定';
$string['tabcontent'] = '內容';
$string['tabgeneral'] = '一般';
$string['tabusers'] = '個使用者';
$string['tabvisibility'] = '可見性設定';
$string['tagarea_program'] = '計畫';
$string['taskcertificate'] = '計畫證書頒發 cron';
$string['taskcron'] = '計畫外掛程式 cron';
$string['unlinkeditems'] = '未連結項目';
$string['updateprogram'] = '更新計畫';
$string['updateallocation'] = '更新分配';
$string['updateallocations'] = '更新分配';
$string['updateset'] = '更新集合';
$string['updatescheduling'] = '更新排程';
$string['updatesource'] = '更新 {$a}';
