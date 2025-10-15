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
$string['archive'] = '封存';
$string['archived'] = '封存檔';
$string['benefitname'] = '{$a}：計畫分配';
$string['calendarprogramend'] = '{$a} 結束';
$string['calendarprogramdue'] = '{$a} 已截止';
$string['calendarprogramstart'] = '{$a} 開始';
$string['catalogue'] = '計畫目錄';
$string['catalogue_dofilter'] = '搜尋';
$string['catalogue_resetfilter'] = '清除';
$string['catalogue_searchtext'] = '搜尋文字';
$string['catalogue_tag'] = '依標籤篩選';
$string['certificatetemplatechoose'] = '選擇一個範本...';
$string['cohorts'] = '同期學員可以看見';
$string['cohorts_help'] = '經過設定後，特定同期學員成員便可看見非公開計畫。

可見性狀態對於已分配之計畫不造成影響。';
$string['columnusedalready'] = '欄已經被使用';
$string['completepercent'] = '{$a}% 已完成';
$string['completion'] = '進度';
$string['completiondate'] = '完成日期';
$string['completiondelay'] = '完成延遲';
$string['completionoverride'] = '覆寫完成';
$string['creategroups'] = '課程小組';
$string['creategroups_help'] = '啟用這個選項，就會在新增至計畫的每個課程中建立一個小組，且所有已分配使用者都會被新增至小組中而成為小組成員。';
$string['customfields'] = '計畫自訂欄位';
$string['customfieldsettings'] = '通用計畫自訂欄位設定';
$string['customfieldvisibleto'] = '可看見欄位內容者：';
$string['customfieldvisible:allocated'] = '已分配至計畫的使用者';
$string['customfieldvisible:everyone'] = '可看見其他計畫詳細資料的所有人';
$string['customfieldvisible:viewcapability'] = '可檢視計畫的使用者';
$string['deleteallocation'] = '刪除計畫分配';
$string['deletecourse'] = '移除課程';
$string['deleteprogram'] = '刪除計畫';
$string['deleteset'] = '刪除集合';
$string['deletetraining'] = '移除訓練';
$string['documentation'] = 'Moodle 文件相關計畫';
$string['duedate'] = '截止日期';
$string['enrolrole'] = '課程角色';
$string['enrolrole_desc'] = '選取將供計畫用來進行課程註冊的角色';
$string['errorcontentproblem'] = '在計畫內容結構中偵測到問題，計畫完成狀態將無法正確追蹤！';
$string['errorcoursemissing'] = '缺少課程';
$string['errorcoursesmissing'] = '缺少課程：{$a}';
$string['errorinvalidoverridedates'] = '無效的日期覆寫';
$string['errordifferenttenant'] = '無法存取其他租用戶的計畫';
$string['errorduplicateprogramid'] = '計畫編號已用於其他計畫，請使用唯一的計畫編號。';
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
$string['evidencedate'] = '證明完成日期';
$string['evidenceupdate'] = '更新其他證明';
$string['evidenceupload'] = '上傳完成證明';
$string['evidenceupload_csvfile'] = 'CSV 檔案';
$string['evidenceupload_errors'] = '偵測到 {$a} 個無效列';
$string['evidenceupload_skipped'] = '略過 {$a} 列';
$string['evidenceupload_updated'] = '已更新 {$a} 位使用者的完成證明';
$string['evidence_details'] = '詳細資料';
$string['evidence_detailsdefault'] = '預設詳細資料';
$string['export'] = '匯出計畫';
$string['exportfile_info'] = '資訊';
$string['exportfile_programs'] = '計畫';
$string['exportformat'] = '檔案格式';
$string['exportformat_csv'] = 'CSV';
$string['exportformat_json'] = 'JSON';
$string['extra_menu_management_index'] = '計畫動作';
$string['extra_menu_management_program_general'] = '計畫動作';
$string['extra_menu_management_program_users'] = '使用者動作';
$string['extra_menu_management_program_allocation'] = '分配動作';
$string['fixeddate'] = '在固定的日期';
$string['idnumbersymbol'] = '編號：';
$string['importallocationend'] = '分配結束 ({$a})';
$string['importallocationstart'] = '分配開始 ({$a})';
$string['importprogramallocation'] = '匯入計畫分配';
$string['importprogramallocationconfirmation'] = '您正在從計畫 __{$a->fullname}/{$a->idnumber}/{$a->category}__ 匯入分配設定。

請選擇所有要匯入的設定。';
$string['importprogramcontent'] = '匯入計畫內容';
$string['importprogramcontentconfirmation'] = '您正在從計畫 __{$a->fullname} / {$a->idnumber} / {$a->category}__ 匯入內容。';
$string['importprogramdue'] = '計畫截止 ({$a})';
$string['importprogramend'] = '計畫結束 ({$a})';
$string['importprogramstart'] = '計畫開始 ({$a})';
$string['importselectprogram'] = '選擇計畫';
$string['invalidallocationdates'] = '無效的計畫分配日期';
$string['invalidcompletiondate'] = '無效的計畫完成日期';
$string['item'] = '項目';
$string['itemcompletion'] = '計畫項目完成';
$string['itempoints'] = '分數';
$string['itemrecalculate'] = '重新計算項目完成';
$string['layoutgrid'] = '方格版面配置';
$string['layouttable'] = '表格版面配置';
$string['management'] = '計畫管理';
$string['messageprovider:allocation_notification'] = '計畫分配通知';
$string['messageprovider:approval_request_notification'] = '計畫核准請求通知';
$string['messageprovider:approval_reject_notification'] = '計畫請求拒絕通知';
$string['messageprovider:completion_notification'] = '計畫已完成通知';
$string['messageprovider:completion_relateduser_notification'] = '計畫已完成通知 - 相關使用者';
$string['messageprovider:deallocation_notification'] = '計畫解除分配通知';
$string['messageprovider:duesoon_notification'] = '計畫將屆截止日期通知';
$string['messageprovider:duesoon_relateduser_notification'] = '計畫將屆截止日期通知 - 相關使用者';
$string['messageprovider:due_notification'] = '計畫已過期通知';
$string['messageprovider:due_relateduser_notification'] = '計畫已過期通知 - 相關使用者';
$string['messageprovider:endsoon_notification'] = '計畫將屆結束日期通知';
$string['messageprovider:endsoon_relateduser_notification'] = '計畫將屆結束日期通知 - 相關使用者';
$string['messageprovider:endcompleted_notification'] = '已完成計畫已結束通知';
$string['messageprovider:endfailed_notification'] = '失敗計畫已結束通知';
$string['messageprovider:endfailed_relateduser_notification'] = '失敗計畫已結束通知 - 相關使用者';
$string['messageprovider:reset_notification'] = '計畫重設通知';
$string['messageprovider:start_notification'] = '計畫已開始通知';
$string['moveitem'] = '移動項目';
$string['moveitemcancel'] = '取消移動';
$string['moveafter'] = '將「{$a->item}」移至「{$a->target}」之後';
$string['movebefore'] = '將「{$a->item}」移至「{$a->target}」之前';
$string['moveinto'] = '將「{$a->item}」移入「{$a->target}」';
$string['myprograms'] = '我的計畫';
$string['notification_allocation'] = '已分配使用者';
$string['notification_allocation_subject'] = '計畫分配通知';
$string['notification_allocation_body'] = '{$a->user_fullname}，您好：

您已分配至「{$a->program_fullname}」計畫，開始日期為 {$a->program_startdate}。
';
$string['notification_allocation_description'] = '在將使用者分配至計畫時所傳送給使用者的通知。';
$string['notification_completion'] = '已完成計畫';
$string['notification_completion_subject'] = '已完成計畫';
$string['notification_completion_body'] = '{$a->user_fullname}，您好：

您已完成「{$a->program_fullname}」計畫。
';
$string['notification_completion_description'] = '在使用者完成計畫時所傳送給使用者的通知。';
$string['notification_completion_relateduser'] = '計畫已完成 - 相關使用者';
$string['notification_completion_relateduser_subject'] = '「{$a->user_fullname}」使用者已完成計畫';
$string['notification_completion_relateduser_body'] = '{$a->relateduser_fullname}，您好：

「{$a->user_fullname}」使用者已完成「{$a->program_fullname}」計畫。
';
$string['notification_completion_relateduser_description'] = '在使用者完成計畫時所傳送給該使用者之相關使用者的通知。';
$string['notification_deallocation'] = '已解除分配使用者';
$string['notification_deallocation_subject'] = '計畫解除分配通知';
$string['notification_deallocation_body'] = '{$a->user_fullname}，您好：

您已從「{$a->program_fullname}」計畫解除分配。
';
$string['notification_deallocation_description'] = '在將使用者從計畫解除分配時所傳送給使用者的通知。';
$string['notification_duesoon'] = '計畫將屆截止日期';
$string['notification_duesoon_subject'] = '計畫預計即將完成';
$string['notification_duesoon_body'] = '{$a->user_fullname}，您好：

「{$a->program_fullname}」計畫預計於 {$a->program_duedate} 完成。
';
$string['notification_duesoon_description'] = '在計畫完成日期前所傳送給使用者的通知，除非計畫已經完成。';
$string['notification_duesoon_relateduser'] = '計畫將屆截止日期 - 相關使用者';
$string['notification_duesoon_relateduser_subject'] = '「{$a->user_fullname}」使用者的計畫預計即將完成';
$string['notification_duesoon_relateduser_body'] = '{$a->relateduser_fullname}，您好：

「{$a->user_fullname}」使用者的「{$a->program_fullname}」計畫預計於 {$a->program_duedate} 完成。
';
$string['notification_duesoon_relateduser_description'] = '在計畫完成日期前所傳送給使用者之相關使用者的通知，除非計畫已經完成。';
$string['notification_due'] = '計畫已過期';
$string['notification_due_subject'] = '計畫未按預計時程完成';
$string['notification_due_body'] = '{$a->user_fullname}，您好：

「{$a->program_fullname}」計畫預計於 {$a->program_duedate} 之前完成。
';
$string['notification_due_description'] = '在使用者計畫過期仍未完成時所傳送給使用者的通知。';
$string['notification_due_relateduser'] = '計畫已過期 - 相關使用者';
$string['notification_due_relateduser_subject'] = '「{$a->user_fullname}」使用者的計畫未按預計時程完成';
$string['notification_due_relateduser_body'] = '{$a->relateduser_fullname}，您好：

「{$a->user_fullname}」使用者的「{$a->program_fullname}」計畫未於 {$a->program_duedate} 之前完成。
';
$string['notification_due_relateduser_description'] = '在使用者計畫過期仍未完成時所傳送給使用者之相關使用者的通知。';
$string['notification_endsoon'] = '計畫將屆結束日期';
$string['notification_endsoon_subject'] = '計畫即將結束';
$string['notification_endsoon_body'] = '{$a->user_fullname}，您好：

「{$a->program_fullname}」計畫將於 {$a->program_enddate} 結束。
';
$string['notification_endsoon_description'] = '在計畫結束日期前所傳送給使用者的通知，除非計畫已經完成。';
$string['notification_endsoon_relateduser'] = '計畫將屆結束日期 - 相關使用者';
$string['notification_endsoon_relateduser_subject'] = '「{$a->user_fullname}」使用者的計畫即將結束';
$string['notification_endsoon_relateduser_body'] = '{$a->relateduser_fullname}，您好：

「{$a->user_fullname}」使用者的「{$a->program_fullname}」計畫即將於 {$a->program_enddate} 結束。
';
$string['notification_endsoon_relateduser_description'] = '在計畫結束日期前所傳送給使用者之相關使用者的通知，除非計畫已經完成。';
$string['notification_endcompleted'] = '已完成計畫已結束';
$string['notification_endcompleted_subject'] = '已完成計畫已結束';
$string['notification_endcompleted_body'] = '{$a->user_fullname}，您好：

「{$a->program_fullname}」計畫已結束，而您在這之前便已將其完成。
';
$string['notification_endcompleted_description'] = '在使用者已完成的計畫結束時所傳送給使用者的通知。';
$string['notification_endfailed'] = '失敗計畫已結束';
$string['notification_endfailed_subject'] = '失敗計畫已結束';
$string['notification_endfailed_body'] = '{$a->user_fullname}，您好：

「{$a->program_fullname}」計畫已結束，而您並未成功將其完成。
';
$string['notification_endfailed_description'] = '在使用者未成功完成的計畫結束時所傳送給使用者的通知。';
$string['notification_endfailed_relateduser'] = '失敗計畫已結束 - 相關使用者';
$string['notification_endfailed_relateduser_subject'] = '「{$a->user_fullname}」使用者的失敗計畫已結束';
$string['notification_endfailed_relateduser_body'] = '{$a->relateduser_fullname}，您好：

「{$a->program_fullname}」計畫已結束，而「{$a->user_fullname}」使用者並未成功將其完成。
';
$string['notification_endfailed_relateduser_description'] = '在使用者未成功完成的計畫結束時所傳送給使用者之相關使用者的通知。';
$string['notification_relateduserfield'] = '通知相關使用者欄位';
$string['notification_relateduserfield_desc'] = '選擇通知相關使用者時，所使用的相關使用者資訊欄位。';
$string['notification_reset'] = '使用者進度重設';
$string['notification_reset_subject'] = '計畫重設通知';
$string['notification_reset_body'] = '{$a->user_fullname}，您好：

您在「{$a->program_fullname}」計畫中的進度已重設。
';
$string['notification_reset_description'] = '使用者計畫進度重設時所傳送給使用者的通知。';
$string['notification_start'] = '計畫已開始';
$string['notification_start_subject'] = '計畫已開始';
$string['notification_start_body'] = '{$a->user_fullname}，您好：

「{$a->program_fullname}」計畫已經開始。
';
$string['notification_start_description'] = '在使用者的計畫開始時所傳送給使用者的通知。';
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

$string['privacy:metadata:table:enrol_programs_src_commholds'] = '商務分配保留';
$string['privacy:metadata:field:quantity'] = '數量';

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
$string['programcompletionoverride'] = '覆寫計畫完成';
$string['programidnumber'] = '計畫編號';
$string['programimage'] = '計畫影像';
$string['programname'] = '計畫名稱';
$string['programurl'] = '計畫 URL';
$string['programs'] = '計畫';
$string['programsactive'] = '作用中';
$string['programsarchived'] = '封存檔';
$string['programsarchived_help'] = '使用者無法看到已封存計畫，且其進度將保持鎖定狀態。';
$string['programslayout'] = '計畫詳細資料頁面版面配置';
$string['programslayout_desc'] = '控制計畫版面配置 - 「我的計畫」頁面的表格或方格檢視。';
$string['programslayoutallowuserswitch'] = '允許使用者切換計畫版面配置';
$string['programslayoutallowuserswitch_desc'] = '允許使用者切換計畫版面配置';
$string['programslayout_desc'] = '控制計畫版面配置 - 「我的計畫」頁面的表格或方格檢視。';
$string['programsblocklayout'] = '我的計畫區塊版面配置';
$string['programsblocklayout_desc'] = '控制計畫版面配置 - 「我的計畫」區塊的表格或方格檢視。';

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
$string['programs:addtocertifications'] = '新增計畫至證書中';
$string['programs:addtoplan'] = '新增計畫至發展計畫中';
$string['programs:allocate'] = '分配學員至計畫中';
$string['programs:archive'] = '封存計畫分配';
$string['programs:clone'] = '允許複製計畫內容和設定';
$string['programs:configframeworks'] = '在發展計畫框架中設定計畫可用性';
$string['programs:configurecustomfields'] = '設定計畫自訂欄位';
$string['programs:delete'] = '刪除計畫';
$string['programs:edit'] = '新增及更新計畫';
$string['programs:export'] = '匯出計畫';
$string['programs:admin'] = '進階計畫管理';
$string['programs:manageallocation'] = '管理使用者分配';
$string['programs:manageevidence'] = '管理其他完成證明';
$string['programs:reset'] = '重設計畫進度';
$string['programs:upload'] = '上傳計畫';
$string['programs:view'] = '查看計畫管理';
$string['programs:viewcatalogue'] = '存取計畫目錄';
$string['public'] = '公開';
$string['public_help'] = '所有使用者均可看見公開計畫。

可見性狀態對於已指派的計畫不造成影響。';
$string['purchaseaccess'] = '購買存取權限';
$string['resetallocation'] = '重設計畫進度';
$string['resettype'] = '重設類型';
$string['resettype_deallocate'] = '僅解除分配計畫';
$string['resettype_full'] = '完整課程清除';
$string['resettype_none'] = '無';
$string['resettype_standard'] = '標準課程清除';
$string['sequencetype'] = '完成類型';
$string['sequencetype_allinorder'] = '顯示全部 (按順序)';
$string['sequencetype_allinanyorder'] = '顯示全部 (按任何順序)';
$string['sequencetype_atleast'] = '至少 {$a->min}';
$string['sequencetype_minpoints'] = '最低 {$a->minpoints} 分';
$string['selectcategory'] = '選擇類別';
$string['sortbyprogramname'] = '依據計畫名稱排序';
$string['sortbyprogramid'] = '依據計畫編號排序';
$string['sortbyprogramstart'] = '依據計畫開始日期排序';
$string['sortbyprogramdue'] = '依據計畫到期日期排序';
$string['sortbyprogramend'] = '依據計畫結束日期排序';
$string['source'] = '來源';
$string['source_approval'] = '附核准的請求';
$string['source_approval_allownew'] = '允許核准';
$string['source_approval_allownew_desc'] = '允許新增「_requests with approval_」來源至計畫中';
$string['source_approval_allowrequest'] = '允許新請求';
$string['source_approval_confirm'] = '請確認您是否要請求分配至此計畫。';
$string['source_approval_daterequested'] = '請求日期';
$string['source_approval_daterejected'] = '拒絕日期';
$string['source_approval_makerequest'] = '請求存取';
$string['source_approval_notification_approval_request_subject'] = '計畫請求通知';
$string['source_approval_notification_approval_request_body'] = '
「{$a->user_fullname}」使用者已請求存取「{$a->program_fullname}」計畫。
';
$string['source_approval_notification_approval_reject_subject'] = '計畫請求拒絕通知';
$string['source_approval_notification_approval_reject_body'] = '{$a->user_fullname}，您好：

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
$string['source_certify'] = '證書';
$string['source_certify_allownew'] = '允許證書分配';
$string['source_certify_allownew_desc'] = '允許新增「_certification_」來源至計畫中';
$string['source_cohort'] = '自動同期學員分配';
$string['source_cohort_allownew'] = '允許同期學員分配';
$string['source_cohort_allownew_desc'] = '允許新增「_cohort auto allocation_」來源至計畫中';
$string['source_cohort_cohortstoallocate'] = '分配同期學員';
$string['source_ecommerce'] = '電子商務分配';
$string['source_ecommerce_allownew'] = '允許電子商務分配';
$string['source_ecommerce_allownew_desc'] = '允許新增電子商務自動分配來源至計畫中';
$string['source_ecommerce_allowsignup'] = '允許新分配';
$string['source_ecommerce_cohortmembershiprequirement'] = '使用者必須是下列其中一組同期學員的成員：{$a}';
$string['source_ecommerce_maxusers'] = '使用者人數上限';
$string['source_ecommerce_nocapacity'] = '此計畫的容納人數已額滿';
$string['source_manual'] = '手動分配';
$string['source_manual_allocateusers'] = '分配使用者';
$string['source_manual_csvfile'] = 'CSV 檔案';
$string['source_manual_hasheaders'] = '第一行是標題';
$string['source_manual_potusersmatching'] = '匹配分配人選';
$string['source_manual_potusers'] = '分配人選';
$string['source_manual_result_assigned'] = '有 {$a} 個使用者被指派計畫。';
$string['source_manual_result_errors'] = '指派計畫時偵測到了 {$a} 個錯誤。';
$string['source_manual_result_skipped'] = '有 {$a} 個使用者已經被指派計畫。';
$string['source_manual_timeduecolumn'] = '截止日期欄';
$string['source_manual_timeendcolumn'] = '結束日期欄';
$string['source_manual_timestartcolumn'] = '開始日期欄';
$string['source_manual_uploadusers'] = '上傳分配';
$string['source_manual_usercolumn'] = '使用者身份欄';
$string['source_manual_usermapping'] = '透過下列方式進行之使用者對應：';
$string['source_manual_userupload_allocated'] = '分配至「{$a}」';
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
$string['source_selfallocation_maxusers_status'] = '{$a->count}/{$a->max} 個使用者';
$string['source_selfallocation_signupallowed'] = '允許報名';
$string['source_selfallocation_signupnotallowed'] = '不允許報名';
$string['source_udplans'] = '使用者發展計畫';
$string['source_udplans_allownew'] = '使用者發展計畫';
$string['source_udplans_allownew_desc'] = '允許新增「_user development plans_」來源至計畫中';
$string['source_udplans_allowed'] = '被允許的';
$string['source_udplans_noframeworks'] = '無法新增至任何發展計畫';
$string['source_udplans_notallowed'] = '不允許';
$string['source_udplans_requirecap'] = '新增所需能力';
$string['set'] = '課程集合';
$string['settings'] = '計畫設定';
$string['scheduling'] = '排程';
$string['taballocation'] = '分配設定';
$string['tabcontent'] = '內容';
$string['tabgeneral'] = '一般';
$string['tabusers'] = '個使用者';
$string['tabvisibility'] = '可見性設定';
$string['tagarea_enrol_programs_programs'] = '計畫';
$string['taskcertificate'] = '計畫證書頒發 cron';
$string['taskcron'] = '計畫外掛程式 cron';
$string['training'] = '訓練';
$string['trainingcompletion'] = '必要訓練：{$a}';
$string['trainingprogress'] = '訓練進度：{$a->current}/{$a->total}';
$string['unarchive'] = '還原';
$string['unlinkeditems'] = '未連結項目';
$string['updateprogram'] = '更新計畫';
$string['updateallocation'] = '更新分配';
$string['updateallocations'] = '更新分配';
$string['updatecourse'] = '更新課程';
$string['updateset'] = '更新集合';
$string['updatescheduling'] = '更新排程';
$string['updatesource'] = '更新 {$a}';
$string['updatetraining'] = '更新訓練';
$string['upload'] = '上傳計畫';
$string['upload_invalidcount'] = '無效的記錄';
$string['upload_files'] = '檔案';
$string['upload_files_error'] = '預計會有多個 CSV 檔案、一個 JSON 檔案或一個 Zip 壓縮封存檔';
$string['upload_preview'] = '資料預覽';
$string['upload_status'] = '狀態';
$string['upload_status_invalid'] = '無效';
$string['upload_targetcontext'] = '新增計畫至情境';
$string['upload_uploadcount'] = '所要上傳的計畫';
$string['upload_usecategory'] = '將情境的類別欄';
$string['userupload_completion_error'] = '無法更新計畫完成';
$string['userupload_completion_updated'] = '已更新計畫完成';

$string['rb_allocatedprograms'] = '已分配的計畫';
$string['rb_complete'] = '完成';
$string['rb_completiondate'] = '完成日期';
$string['rb_completionstatus'] = '完成狀態';
$string['rb_datecompleted'] = '完成日期';
$string['rb_dateallocated'] = '分配日期';
$string['rb_datestarted'] = '開始日期';
$string['rb_coursesall'] = '課程 - 全部';
$string['rb_incomplete'] = '未完成';
$string['rb_isallocated'] = '已分配';
$string['rb_iscomplete'] = '已完成？';
$string['rb_iscompleteany'] = '已完成？(任何方法)';
$string['rb_isinprogress'] = '進行中？';
$string['rb_isnotcomplete'] = '未完成？';
$string['rb_isnotyetstarted'] = '尚未開始？';
$string['rb_notstarted'] = '未開始';
$string['rb_officewhencompletedbasic'] = '完成時的辦公室 (基本)';
$string['rb_privacy:metadata'] = '外掛程式不會儲存任何個人資料。';
$string['rb_programcategory'] = '計畫類別 (或網站)';
$string['rb_programcategoryid'] = '計畫類別編號 (若是網站則不適用)';
$string['rb_programcategoryidnumber'] = '計畫類別編號數字 (若是網站則不適用)';
$string['rb_programcategorymultichoice'] = '計畫類別 (複選)';
$string['rb_programedatecreated'] = '計畫日期已建立';
$string['rb_programduedate'] = '計畫截止日期';
$string['rb_programenddate'] = '計畫分配結束日期';
$string['rb_programallocationtype'] = '分配類型';
$string['rb_programallocationtypes'] = '分配類型';
$string['rb_programexpandlink'] = '計畫名稱 (展開詳細資料)';
$string['rb_programid'] = '計畫編號';
$string['rb_programidnumber'] = '計畫編號數字';
$string['rb_programname'] = '計畫名稱';
$string['rb_programnameandsummary'] = '計畫名稱和說明';
$string['rb_programnamelinked'] = '計畫名稱 (連結至計畫頁面)';
$string['rb_programmultiitem'] = '計畫 (多項目)';
$string['rb_programsingleitem'] = '計畫';
$string['rb_programstartdate'] = '計畫分配開始日期';
$string['rb_programsummary'] = '計畫說明';
$string['rb_programvisible'] = '計畫為公開';
$string['rb_programvisibledisabled'] = '計畫可見性 (不適用)';
$string['rb_progress'] = '進度';
$string['rb_progressnumeric'] = '進度 (數值)';
$string['rb_progresspercent'] = '進度 (完成 %)';
$string['rb_source_allocation'] = '計畫分配';
$string['rb_timetocompletesinceenrol'] = '至完成為止的時間 (自分配日期起算)';
$string['rb_timetocompletesincestart'] = '至完成為止的時間 (自開始日期起算)';
$string['rb_type_program'] = '計畫';
$string['rb_type_program_category'] = '類別';
$string['rb_type_program_completion'] = '計畫分配';
$string['rb_type_program_customfields'] = '計畫自訂欄位';
$string['rb_user'] = '使用者';
$string['rb_viewprogram'] = '檢視計畫';
$string['rb_visiblecohorts'] = '可看見內容的同期學員';
