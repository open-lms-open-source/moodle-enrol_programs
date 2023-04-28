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

$string['addprogram'] = 'プログラムを追加する';
$string['addset'] = '新しいセットを追加する';
$string['allocationend'] = '割り当て終了';
$string['allocationend_help'] = '割り当て終了日の意味は、有効な割り当てソースに応じて異なります。指定した場合、通常はこの日付以降に新しい割り当てを指定できません。';
$string['allocation'] = '割り当て';
$string['allocations'] = '割り当て';
$string['programallocations'] = 'プログラム割り当て';
$string['allocationdate'] = '割り当て日';
$string['allocationsources'] = '割り当てソース';
$string['allocationstart'] = '割り当て開始';
$string['allocationstart_help'] = '割り当て開始日の意味は、有効な割り当てソースに応じて異なります。指定した場合、通常はこの日付以降でのみ新しい割り当てを指定できます。';
$string['allprograms'] = 'すべてのプログラム';
$string['appenditem'] = '項目を追加する';
$string['appendinto'] = '項目に追加する';
$string['archived'] = 'アーカイブ';
$string['catalogue'] = 'プログラムカタログ';
$string['catalogue_dofilter'] = '検索';
$string['catalogue_resetfilter'] = 'クリア';
$string['catalogue_searchtext'] = '検索文字列';
$string['catalogue_tag'] = 'タグでフィルタ';
$string['certificatetemplatechoose'] = 'テンプレートを選択する...';
$string['cohorts'] = 'コーホートに表示する';
$string['cohorts_help'] = '非公開のプログラムを指定したコーホートメンバーに表示できます。

可視性ステータスは、すでに割り当て済みのプログラムには影響しません。';
$string['completiondate'] = '完了日';
$string['creategroups'] = 'コースグループ';
$string['creategroups_help'] = '有効な場合、プログラムに追加されたコースごとにグループが作成され、すべての割り当て済みユーザがグループメンバーとして追加されます。';
$string['deleteallocation'] = 'プログラム割り当てを削除する';
$string['deletecourse'] = 'コースを削除する';
$string['deleteprogram'] = 'プログラムを削除する';
$string['deleteset'] = 'セットを削除する';
$string['documentation'] = 'Programs for Moodleの文書';
$string['duedate'] = '終了日時';
$string['enrolrole'] = 'コースロール';
$string['enrolrole_desc'] = 'コース登録のためにプログラムによって使用されるロールを選択';
$string['errorcontentproblem'] = 'プログラムコンテンツ構造に問題が検出されました。プログラムの完了を適切にトラッキングできません！';
$string['errordifferenttenant'] = '他のテナントのプログラムにはアクセスできません';
$string['errornoallocations'] = 'ユーザ割り当てが見つかりません';
$string['errornoallocation'] = 'プログラムが割り当てられていません';
$string['errornomyprograms'] = 'あなたはどのグループにも割り当てられていません。';
$string['errornoprograms'] = 'プログラムが見つかりませんでした。';
$string['errornorequests'] = 'プログラムリクエストが見つかりませんでした';
$string['errornotenabled'] = 'プログラムプラグインが有効にされていません';
$string['event_program_completed'] = 'プログラムが完了しました';
$string['event_program_created'] = 'プログラムが作成されました';
$string['event_program_deleted'] = 'プログラムが削除されました';
$string['event_program_updated'] = 'プログラムが更新されました';
$string['event_program_viewed'] = 'プログラムが表示されました';
$string['event_user_allocated'] = 'ユーザがプログラムに割り当てられました';
$string['event_user_deallocated'] = 'ユーザがプログラムから割り当て解除されました';
$string['evidence'] = 'その他のエビデンス';
$string['evidence_details'] = '詳細';
$string['fixeddate'] = '指定期日';
$string['item'] = '項目';
$string['itemcompletion'] = 'プログラム項目の完了';
$string['management'] = 'プログラム管理';
$string['messageprovider:allocation_notification'] = 'プログラム割り当て通知';
$string['messageprovider:approval_request_notification'] = 'プログラム承認リクエスト通知';
$string['messageprovider:approval_reject_notification'] = 'プログラムリクエスト拒否通知';
$string['messageprovider:completion_notification'] = 'プログラム完了通知';
$string['messageprovider:deallocation_notification'] = 'プログラム割り当て解除通知';
$string['messageprovider:duesoon_notification'] = 'プログラム期日接近通知';
$string['messageprovider:due_notification'] = 'プログラム期限切れ通知';
$string['messageprovider:endsoon_notification'] = 'プログラム終了日接近通知';
$string['messageprovider:endcompleted_notification'] = '完了済みプログラム終了通知';
$string['messageprovider:endfailed_notification'] = 'プログラム終了による失敗通知';
$string['messageprovider:start_notification'] = 'プログラム開始通知';
$string['moveitem'] = '項目の移動';
$string['moveitemcancel'] = '移動をキャンセルする';
$string['moveafter'] = '"{$a->item}"を"{$a->target}"の後に移動する';
$string['movebefore'] = '"{$a->item}"を"{$a->target}"の前に移動する';
$string['moveinto'] = '"{$a->item}"を"{$a->target}"に移動する';
$string['myprograms'] = 'マイプログラム';
$string['notification_allocation'] = 'ユーザが割り当てられました';
$string['notification_completion'] = 'プログラムが完了しました';
$string['notification_completion_subject'] = 'プログラムが完了しました';
$string['notification_completion_body'] = '{$a->user_fullname} さん、こんにちは

あなたはプログラム"{$a->program_fullname}"を完了しました。
';
$string['notification_deallocation'] = 'ユーザが割り当て解除されました';
$string['notification_duesoon'] = 'プログラムの期日が迫っています';
$string['notification_duesoon_subject'] = 'まもなくプログラムが完了します';
$string['notification_duesoon_body'] = '{$a->user_fullname} さん、こんにちは

プログラム"{$a->program_fullname}"の完了は {$a->program_duedate} に予定されます。
';
$string['notification_due'] = 'プログラム期限切れ';
$string['notification_due_subject'] = 'プログラムの完了が予定されていました';
$string['notification_due_body'] = '{$a->user_fullname} さん、こんにちは

プログラム"{$a->program_fullname}"の完了は {$a->program_duedate} に予定されていました。
';
$string['notification_endsoon'] = 'プログラム終了日接近';
$string['notification_endsoon_subject'] = 'プログラム終了接近';
$string['notification_endsoon_body'] = '{$a->user_fullname} さん、こんにちは

プログラム"{$a->program_fullname}"は {$a->program_enddate} に終了します。
';
$string['notification_endcompleted'] = '完了済みプログラム終了';
$string['notification_endcompleted_subject'] = '完了済みプログラム終了';
$string['notification_endcompleted_body'] = '{$a->user_fullname} さん、こんにちは

プログラム"{$a->program_fullname}"は終了しました。あなたはプログラムを予定よりも早く完了しました。
';
$string['notification_endfailed'] = 'プログラム終了による失敗';
$string['notification_endfailed_subject'] = 'プログラム終了による失敗';
$string['notification_endfailed_body'] = '{$a->user_fullname} さん、こんにちは

プログラム"{$a->program_fullname}"は終了しました。あなたはプログラムを完了できませんでした。
';
$string['notification_start'] = 'プログラムが開始されました';
$string['notification_start_subject'] = 'プログラムが開始されました';
$string['notification_start_body'] = '{$a->user_fullname} さん、こんにちは

プログラム"{$a->program_fullname}"が開始されました。
';
$string['notificationdates'] = '通知日';
$string['notset'] = '設定なし';
$string['plugindisabled'] = 'プログラム登録プラグインが無効です。プログラムは動作しません。

[Enable plugin now]　({$a->url})';
$string['pluginname'] = 'プログラム';
$string['pluginname_desc'] = 'プログラムは、コースセットを作成できるよう設計されています。';
$string['privacy:metadata:field:programid'] = 'プログラムID';
$string['privacy:metadata:field:userid'] = 'ユーザID';
$string['privacy:metadata:field:allocationid'] = 'プログラム割り当てID';
$string['privacy:metadata:field:sourceid'] = '割り当てのソース';
$string['privacy:metadata:field:itemid'] = '項目ID';
$string['privacy:metadata:field:timecreated'] = '作成日時';
$string['privacy:metadata:field:timecompleted'] = '完了日';

$string['privacy:metadata:table:enrol_programs_allocations'] = 'プログラム割り当てに関する情報';
$string['privacy:metadata:field:archived'] = 'レコードはアーカイブされていますか';
$string['privacy:metadata:field:sourcedatajson'] = '割り当てのソースに関する情報';
$string['privacy:metadata:field:timeallocated'] = 'プログラム割り当て日';
$string['privacy:metadata:field:timestart'] = '開始日';
$string['privacy:metadata:field:timedue'] = '終了日時';
$string['privacy:metadata:field:timeend'] = '終了日';

$string['privacy:metadata:table:enrol_programs_certs_issues'] = 'プログラム割り当て証明書の発行';
$string['privacy:metadata:field:issueid'] = '発行ID';

$string['privacy:metadata:table:enrol_programs_completions'] = 'プログラム割り当て完了';

$string['privacy:metadata:table:enrol_programs_evidences'] = '他の完了エビデンスに関する情報';
$string['privacy:metadata:field:evidencejson'] = '完了エビデンスに関する情報';
$string['privacy:metadata:field:createdby'] = 'エビデンスの作成者';

$string['privacy:metadata:table:enrol_programs_requests'] = '割り当てリクエストに関する情報';
$string['privacy:metadata:field:datajson'] = 'リクエストに関する情報';
$string['privacy:metadata:field:timerequested'] = 'リクエスト日';
$string['privacy:metadata:field:timerejected'] = '拒否日';
$string['privacy:metadata:field:rejectedby'] = 'リクエストの拒否者';


$string['privacy:metadata:table:enrol_programs_usr_snapshots'] = 'プログラム割り当てスナップショット';
$string['privacy:metadata:field:reason'] = '理由';
$string['privacy:metadata:field:timesnapshot'] = 'スナップショット作成日';
$string['privacy:metadata:field:snapshotby'] = 'スナップショットの作成者';
$string['privacy:metadata:field:explanation'] = '説明';
$string['privacy:metadata:field:completionsjson'] = '完了に関する情報';
$string['privacy:metadata:field:evidencesjson'] = '完了エビデンスに関する情報';

$string['program'] = 'プログラム';
$string['programautofix'] = 'プログラムを自動修復する';
$string['programdue'] = 'プログラムの期日';
$string['programdue_help'] = 'プログラムの期日は、ユーザがプログラムを完了することが期待される日を示します。';
$string['programdue_delay'] = '期日 (開始日から)';
$string['programdue_date'] = '終了日時';
$string['programend'] = 'プログラム終了';
$string['programend_help'] = 'プログラムの終了後、ユーザはプログラムコースを入力できません。';
$string['programend_delay'] = '終了 (開始日から)';
$string['programend_date'] = 'プログラム終了日';
$string['programcompletion'] = 'プログラム完了日';
$string['programidnumber'] = 'プログラムID番号';
$string['programimage'] = 'プログラムイメージ';
$string['programname'] = 'プログラム名';
$string['programurl'] = 'プログラムURL';
$string['programs'] = 'プログラム';
$string['programsactive'] = 'アクティブ';
$string['programsarchived'] = 'アーカイブ';
$string['programsarchived_help'] = 'アーカイブされたプログラムはユーザから見えず、進捗がロックされます。';
$string['programstart'] = 'プログラム開始';
$string['programstart_help'] = 'プログラムの開始前、ユーザはプログラムコースを入力できません。';
$string['programstart_allocation'] = '割り当て後即座に開始';
$string['programstart_delay'] = '割り当て後遅延開始';
$string['programstart_date'] = 'プログラム開始日';
$string['programstatus'] = 'プログラムステータス';
$string['programstatus_completed'] = '受験完了';
$string['programstatus_any'] = '任意のプログラムステータス';
$string['programstatus_archived'] = 'アーカイブ';
$string['programstatus_archivedcompleted'] = 'アーカイブ完了';
$string['programstatus_overdue'] = '期限切れ';
$string['programstatus_open'] = 'オープン';
$string['programstatus_future'] = '未オープン';
$string['programstatus_failed'] = '失敗';
$string['programs:addcourse'] = 'コースをプログラムに追加する';
$string['programs:allocate'] = '学生をプログラムに割り当てる';
$string['programs:delete'] = 'プログラムを削除する';
$string['programs:edit'] = 'プログラムを追加および更新する';
$string['programs:admin'] = 'プログラムの高度な管理';
$string['programs:manageevidence'] = '他の完了エビデンスを管理する';
$string['programs:view'] = 'プログラム管理を表示する';
$string['programs:viewcatalogue'] = 'プログラムカタログにアクセスする';
$string['public'] = '公開';
$string['public_help'] = '公開プログラムはすべてのユーザに表示されます。

可視性ステータスは、すでに割り当て済みのプログラムには影響しません。';
$string['sequencetype'] = '完了タイプ';
$string['sequencetype_allinorder'] = '順序どおりにすべて';
$string['sequencetype_allinanyorder'] = '任意の順序ですべて';
$string['sequencetype_atleast'] = '{$a->min} 以上';
$string['selectcategory'] = 'カテゴリを選択する';
$string['source'] = 'ソース';
$string['source_approval'] = '承認を得たリクエスト';
$string['source_approval_allownew'] = '承認を許可する';
$string['source_approval_allownew_desc'] = '新しい_requests with approval_ソースをプログラムに追加することを許可する';
$string['source_approval_allowrequest'] = '新しいリクエストを許可する';
$string['source_approval_confirm'] = 'プログラムへの割り当てリクエストを確認してください。';
$string['source_approval_daterequested'] = 'リクエストされた日付';
$string['source_approval_daterejected'] = '拒否された日付';
$string['source_approval_makerequest'] = 'アクセスをリクエストする';
$string['source_approval_notification_allocation_subject'] = 'プログラム承認通知';
$string['source_approval_notification_allocation_body'] = '{$a->user_fullname} さん、こんにちは

プログラム"{$a->program_fullname}"へのサインアップが承認されました。開始日は {$a->program_startdate} です。
';
$string['source_approval_notification_approval_request_subject'] = 'プログラムリクエスト通知';
$string['source_approval_notification_approval_request_body'] = '
ユーザ {$a->user_fullname} がプログラム"{$a->program_fullname}"へのアクセスをリクエストしました。
';
$string['source_approval_notification_approval_reject_subject'] = 'プログラムリクエスト拒否通知';
$string['source_approval_notification_approval_reject_body'] = '{$a->user_fullname} さん、こんにちは

"{$a->program_fullname}"プログラムへのアクセスリクエストは拒否されました。

{$a->reason}
';
$string['source_approval_requestallowed'] = 'リクエストは許可されています';
$string['source_approval_requestnotallowed'] = 'リクエストは許可されていません';
$string['source_approval_requests'] = 'リクエスト';
$string['source_approval_requestpending'] = 'アクセスリクエストは保留中です';
$string['source_approval_requestrejected'] = 'アクセスリクエストは拒否されました';
$string['source_approval_requestapprove'] = 'リクエストを承認する';
$string['source_approval_requestreject'] = 'リクエストを拒否する';
$string['source_approval_requestdelete'] = 'リクエストを削除する';
$string['source_approval_rejectionreason'] = '拒否の理由';
$string['notification_allocation_subject'] = 'プログラム割り当て通知';
$string['notification_allocation_body'] = '{$a->user_fullname} さん、こんにちは

あなたはプログラム"{$a->program_fullname}"に割り当てられました。開始日は {$a->program_startdate} です。
';
$string['notification_deallocation_subject'] = 'プログラム割り当て解除通知';
$string['notification_deallocation_body'] = '{$a->user_fullname} さん、こんにちは

あなたはプログラム"{$a->program_fullname}"から割り当て解除されました。
';
$string['source_cohort'] = '自動コーホート割り当て';
$string['source_cohort_allownew'] = 'コーホート割り当てを許可する';
$string['source_cohort_allownew_desc'] = '新しい_cohort auto allocation_ソースをプログラムに追加することを許可する';
$string['source_manual'] = '手動割り当て';
$string['source_manual_allocateusers'] = 'ユーザを割り当てる';
$string['source_manual_csvfile'] = 'CSVファイル';
$string['source_manual_hasheaders'] = '最初の行をヘッダーにする';
$string['source_manual_potusersmatching'] = '一致する割り当て候補';
$string['source_manual_potusers'] = '割り当て候補';
$string['source_manual_result_assigned'] = '{$a} 名のユーザがプログラムに割り当てられました。';
$string['source_manual_result_errors'] = 'プログラムの割り当て時に {$a} 件のエラーが検出されました。';
$string['source_manual_result_skipped'] = '{$a} 名のユーザがすでにプログラムに割り当てられていました。';
$string['source_manual_uploadusers'] = '割り当てをアップロードする';
$string['source_manual_usercolumn'] = 'ユーザ識別列';
$string['source_manual_usermapping'] = 'ユーザマッピングの方法';
$string['source_manual_userupload_allocated'] = '\'{$a}\'に割り当てられました';
$string['source_manual_userupload_alreadyallocated'] = 'すでに\'{$a}\'に割り当てられています';
$string['source_manual_userupload_invalidprogram'] = '\'{$a}\'に割り当てることができません';
$string['source_selfallocation'] = '自己割り当て';
$string['source_selfallocation_allocate'] = 'サインアップ';
$string['source_selfallocation_allownew'] = '自己割り当てを許可する';
$string['source_selfallocation_allownew_desc'] = '新しい_self allocation_ソースをプログラムに追加することを許可する';
$string['source_selfallocation_allowsignup'] = '新しいサインアップを許可する';
$string['source_selfallocation_confirm'] = 'プログラムへの割り当てを希望することを確認してください。';
$string['source_selfallocation_enable'] = '自己割り当てを有効にする';
$string['source_selfallocation_key'] = 'サインアップキー';
$string['source_selfallocation_keyrequired'] = 'サインアップキーが必要です';
$string['source_selfallocation_maxusers'] = '最大ユーザ';
$string['source_selfallocation_maxusersreached'] = 'すでに自己割り当て可能な最大ユーザ数に達しています';
$string['source_selfallocation_maxusers_status'] = '{$a->count}/{$a->max} ユーザ';
$string['source_selfallocation_notification_allocation_subject'] = 'プログラム割り当て通知';
$string['source_selfallocation_notification_allocation_body'] = '{$a->user_fullname} さん、こんにちは

あなたはプログラム"{$a->program_fullname}"にサインアップしました。開始日は {$a->program_startdate} です。
';
$string['source_selfallocation_signupallowed'] = 'サインアップは許可されています';
$string['source_selfallocation_signupnotallowed'] = 'サインアップは許可されていません';
$string['set'] = 'コースセット';
$string['settings'] = 'プログラム設定';
$string['scheduling'] = 'スケジュール';
$string['taballocation'] = '割り当て設定';
$string['tabcontent'] = 'コンテンツ';
$string['tabgeneral'] = '一般設定';
$string['tabusers'] = 'ユーザ';
$string['tabvisibility'] = '可視性設定';
$string['tagarea_program'] = 'プログラム';
$string['taskcertificate'] = 'プログラム証明書発行cron';
$string['taskcron'] = 'プログラムプラグインcron';
$string['unlinkeditems'] = 'リンクされていない項目';
$string['updateprogram'] = 'プログラムを更新する';
$string['updateallocation'] = '割り当てを更新する';
$string['updateallocations'] = '割り当てを更新する';
$string['updateset'] = 'セットを更新する';
$string['updatescheduling'] = 'スケジュールを更新する';
$string['updatesource'] = '{$a} を更新する';
