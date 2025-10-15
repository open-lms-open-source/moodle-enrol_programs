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
$string['archive'] = 'アーカイブ';
$string['archived'] = 'アーカイブ';
$string['benefitname'] = '{$a}：プログラム割り当て';
$string['calendarprogramend'] = '{$a} 終了';
$string['calendarprogramdue'] = '{$a} が期日';
$string['calendarprogramstart'] = '{$a} に開始';
$string['catalogue'] = 'プログラムカタログ';
$string['catalogue_dofilter'] = '検索';
$string['catalogue_resetfilter'] = 'クリア';
$string['catalogue_searchtext'] = '検索文字列';
$string['catalogue_tag'] = 'タグでフィルタ';
$string['certificatetemplatechoose'] = 'テンプレートを選択する...';
$string['cohorts'] = 'コーホートに表示する';
$string['cohorts_help'] = '指定したコーホートメンバーに、非公開のプログラムを表示できます。

可視性ステータスは、すでに割り当て済みのプログラムには影響しません。';
$string['columnusedalready'] = '列はすでに使用されています';
$string['completepercent'] = '{$a} %完了';
$string['completion'] = '完了';
$string['completiondate'] = '完了日';
$string['completiondelay'] = '完了の遅延';
$string['completionoverride'] = 'オーバーライドの完了';
$string['creategroups'] = 'コースグループ';
$string['creategroups_help'] = '有効な場合、プログラムに追加されたコースごとにグループが作成され、すべての割り当て済みユーザがグループメンバーとして追加されます。';
$string['customfields'] = 'プログラムのカスタムフィールド';
$string['customfieldsettings'] = '一般的なプログラムのカスタムフィールド設定';
$string['customfieldvisibleto'] = 'フィールドのコンテンツ表示先';
$string['customfieldvisible:allocated'] = 'ユーザがプログラムに割り当てられました';
$string['customfieldvisible:everyone'] = '他のプログラムの詳細を表示できるすべてのユーザ';
$string['customfieldvisible:viewcapability'] = 'プログラムケイパビリティを表示できるユーザ';
$string['deleteallocation'] = 'プログラム割り当てを削除する';
$string['deletecourse'] = 'コースを削除する';
$string['deleteprogram'] = 'プログラムを削除する';
$string['deleteset'] = 'セットを削除する';
$string['deletetraining'] = 'トレーニングを削除する';
$string['documentation'] = 'Programs for Moodleの文書';
$string['duedate'] = '終了日時';
$string['enrolrole'] = 'コースロール';
$string['enrolrole_desc'] = 'コース登録のためにプログラムによって使用されるロールを選択';
$string['errorcontentproblem'] = 'プログラムコンテンツ構造に問題が検出されました。プログラムの完了を適切にトラッキングできません！';
$string['errorcoursemissing'] = 'コースが見つかりません';
$string['errorcoursesmissing'] = '見つからないコース：{$a}';
$string['errorinvalidoverridedates'] = '無効な日付のオーバーライド';
$string['errordifferenttenant'] = '他のテナントのプログラムにはアクセスできません';
$string['errorduplicateprogramid'] = 'プログラムIDナンバーはすでに別のプログラムで使用されています。一意のプログラムIDナンバーを使用してください。';
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
$string['evidencedate'] = 'エビデンスの完了日';
$string['evidenceupdate'] = 'その他のエビデンスの更新';
$string['evidenceupload'] = '完了エビデンスのアップロード';
$string['evidenceupload_csvfile'] = 'CSVファイル';
$string['evidenceupload_errors'] = '{$a} 個の無効な行が検出されました';
$string['evidenceupload_skipped'] = '{$a} 個の行がスキップされました';
$string['evidenceupload_updated'] = '{$a} ユーザの完了エビデンスが更新されました';
$string['evidence_details'] = '詳細';
$string['evidence_detailsdefault'] = 'デフォルトの詳細';
$string['export'] = 'プログラムをエクスポートする';
$string['exportfile_info'] = '情報';
$string['exportfile_programs'] = 'プログラム';
$string['exportformat'] = 'ファイルフォーマット';
$string['exportformat_csv'] = 'CSV';
$string['exportformat_json'] = 'JSON';
$string['extra_menu_management_index'] = 'プログラムアクション';
$string['extra_menu_management_program_general'] = 'プログラムアクション';
$string['extra_menu_management_program_users'] = 'ユーザアクション';
$string['extra_menu_management_program_allocation'] = '割り当てアクション';
$string['fixeddate'] = '指定期日';
$string['idnumbersymbol'] = 'ID #：';
$string['importallocationend'] = '割り当て終了（{$a}）';
$string['importallocationstart'] = '割り当て開始（{$a}）';
$string['importprogramallocation'] = 'プログラム割り当てをインポートする';
$string['importprogramallocationconfirmation'] = 'プログラム __{$a->fullname} / {$a->idnumber} / {$a->category}__ から割り当て設定をインポートしています。

インポートする設定をすべて選択してください。';
$string['importprogramcontent'] = 'プログラムコンテンツをインポートする';
$string['importprogramcontentconfirmation'] = 'プログラム__{$a->fullname}/{$a->idnumber}/{$a->category}__からコンテンツをインポートしています。';
$string['importprogramdue'] = 'プログラムの期日（{$a}）';
$string['importprogramend'] = 'プログラム終了（{$a}）';
$string['importprogramstart'] = 'プログラム開始（{$a}）';
$string['importselectprogram'] = 'プログラムを選択する';
$string['invalidallocationdates'] = '無効なプログラム割り当て日';
$string['invalidcompletiondate'] = '無効なプログラム完了日';
$string['item'] = '項目';
$string['itemcompletion'] = 'プログラム項目の完了';
$string['itempoints'] = '評点';
$string['itemrecalculate'] = '項目の完了の再計算';
$string['layoutgrid'] = 'グリッドレイアウト';
$string['layouttable'] = 'テーブルレイアウト';
$string['management'] = 'プログラム管理';
$string['messageprovider:allocation_notification'] = 'プログラム割り当て通知';
$string['messageprovider:approval_request_notification'] = 'プログラム承認リクエスト通知';
$string['messageprovider:approval_reject_notification'] = 'プログラムリクエスト拒否通知';
$string['messageprovider:completion_notification'] = 'プログラム完了通知';
$string['messageprovider:completion_relateduser_notification'] = 'プログラム完了通知 - 関連ユーザ';
$string['messageprovider:deallocation_notification'] = 'プログラム割り当て解除通知';
$string['messageprovider:duesoon_notification'] = 'プログラム期日接近通知';
$string['messageprovider:duesoon_relateduser_notification'] = 'プログラム期日接近通知 - 関連ユーザ';
$string['messageprovider:due_notification'] = 'プログラム期限切れ通知';
$string['messageprovider:due_relateduser_notification'] = 'プログラム期限切れ通知 - 関連ユーザ';
$string['messageprovider:endsoon_notification'] = 'プログラム終了日接近通知';
$string['messageprovider:endsoon_relateduser_notification'] = 'プログラム終了日接近通知 - 関連ユーザ';
$string['messageprovider:endcompleted_notification'] = '完了済みプログラム終了通知';
$string['messageprovider:endfailed_notification'] = 'プログラム終了による失敗通知';
$string['messageprovider:endfailed_relateduser_notification'] = 'プログラム終了による失敗通知 - 関連ユーザ';
$string['messageprovider:reset_notification'] = 'プログラムリセット通知';
$string['messageprovider:start_notification'] = 'プログラム開始通知';
$string['moveitem'] = '項目の移動';
$string['moveitemcancel'] = '移動をキャンセルする';
$string['moveafter'] = '「{$a->item}」の後に「{$a->target}」を移動する';
$string['movebefore'] = '「{$a->item}」の前に「{$a->target}」を移動する';
$string['moveinto'] = '「{$a->item}」に「{$a->target}」を移動する';
$string['myprograms'] = 'マイプログラム';
$string['notification_allocation'] = 'ユーザが割り当てられました';
$string['notification_allocation_subject'] = 'プログラム割り当て通知';
$string['notification_allocation_body'] = '{$a->user_fullname} 様

あなたはプログラム「{$a->program_fullname}」に割り当てられました。開始日は {$a->program_startdate} です。
';
$string['notification_allocation_description'] = 'プログラムが割り当てられたユーザに通知が送信されました。';
$string['notification_completion'] = 'プログラムが完了しました';
$string['notification_completion_subject'] = 'プログラムが完了しました';
$string['notification_completion_body'] = '{$a->user_fullname} 様

あなたはプログラム「{$a->program_fullname}」を完了しました。
';
$string['notification_completion_description'] = 'プログラムを完了したユーザに通知が送信されました。';
$string['notification_completion_relateduser'] = 'プログラム完了 - 関連ユーザ';
$string['notification_completion_relateduser_subject'] = 'ユーザ {$a->user_fullname} 様がプログラムを完了しました';
$string['notification_completion_relateduser_body'] = '{$a->relateduser_fullname} 様

ユーザ {$a->user_fullname} 様がプログラム「{$a->program_fullname}」を完了しました。
';
$string['notification_completion_relateduser_description'] = 'プログラムを完了したユーザに関連するユーザに通知が送信されました。';
$string['notification_deallocation'] = 'ユーザが割り当て解除されました';
$string['notification_deallocation_subject'] = 'プログラム割り当て解除通知';
$string['notification_deallocation_body'] = '{$a->user_fullname} 様

あなたは、プログラム「{$a->program_fullname}」から割り当て解除されました。
';
$string['notification_deallocation_description'] = 'プログラムから割り当て解除されたユーザに通知が送信されました。';
$string['notification_duesoon'] = 'プログラムの期日が迫っています';
$string['notification_duesoon_subject'] = 'まもなくプログラムが完了します';
$string['notification_duesoon_body'] = '{$a->user_fullname} 様

プログラム「{$a->program_fullname}」は、{$a->program_duedate} に完了する予定になっています。
';
$string['notification_duesoon_description'] = 'プログラムが完了済みでないかぎり、プログラム完了日前に通知が送信されます。';
$string['notification_duesoon_relateduser'] = 'プログラム期日接近 - 関連ユーザ';
$string['notification_duesoon_relateduser_subject'] = 'ユーザ {$a->user_fullname} 様のプログラムがまもなく完了します';
$string['notification_duesoon_relateduser_body'] = '{$a->relateduser_fullname} 様

ユーザ {$a->user_fullname} 様のプログラム「{$a->program_fullname}」は、{$a->program_duedate} に完了する予定になっています。
';
$string['notification_duesoon_relateduser_description'] = 'プログラムが完了済みでないかぎり、プログラム完了日前に関連するユーザに通知が送信されます。';
$string['notification_due'] = 'プログラム期限切れ';
$string['notification_due_subject'] = 'プログラムの完了が予定されていました';
$string['notification_due_body'] = '{$a->user_fullname} 様

プログラム「{$a->program_fullname}」は、{$a->program_duedate} 前に完了する予定になっていました。
';
$string['notification_due_description'] = 'プログラム完了期日が過ぎたユーザに通知が送信されました。';
$string['notification_due_relateduser'] = 'プログラム期限切れ - 関連ユーザ';
$string['notification_due_relateduser_subject'] = 'ユーザ {$a->user_fullname} 様のプログラムの完了が予定されていました。';
$string['notification_due_relateduser_body'] = '{$a->relateduser_fullname} 様

ユーザ {$a->user_fullname} 様のプログラム「{$a->program_fullname}」は、{$a->program_duedate} 前に完了する予定でした。
';
$string['notification_due_relateduser_description'] = 'プログラム完了期日が過ぎたユーザに関連するユーザに通知が送信されました。';
$string['notification_endsoon'] = 'プログラム終了日接近';
$string['notification_endsoon_subject'] = 'プログラム終了接近';
$string['notification_endsoon_body'] = '{$a->user_fullname} 様

プログラム「{$a->program_fullname}」が {$a->program_enddate} に終了します。
';
$string['notification_endsoon_description'] = 'プログラムが完了済みでないかぎり、プログラム終了日前に通知が送信されます。';
$string['notification_endsoon_relateduser'] = 'プログラム終了日接近 - 関連ユーザ';
$string['notification_endsoon_relateduser_subject'] = 'ユーザ {$a->user_fullname} 様のプログラム終了日接近';
$string['notification_endsoon_relateduser_body'] = '{$a->relateduser_fullname} 様

ユーザ {$a->user_fullname} 様のプログラム「{$a->program_fullname}」は、{$a->program_enddate} に終了します。
';
$string['notification_endsoon_relateduser_description'] = 'プログラムが完了済みでないかぎり、プログラム終了日前に関連するユーザに通知が送信されます。';
$string['notification_endcompleted'] = '完了済みプログラム終了';
$string['notification_endcompleted_subject'] = '完了済みプログラム終了';
$string['notification_endcompleted_body'] = '{$a->user_fullname} 様

プログラム「{$a->program_fullname}」は終了しました。あなたはプログラムを予定よりも早く完了しました。
';
$string['notification_endcompleted_description'] = 'プログラムを終了したユーザに通知が送信されました。';
$string['notification_endfailed'] = 'プログラム終了による失敗';
$string['notification_endfailed_subject'] = 'プログラム終了による失敗';
$string['notification_endfailed_body'] = '{$a->user_fullname} 様

プログラム「{$a->program_fullname}」は終了しました。あなたはプログラムを完了できませんでした。
';
$string['notification_endfailed_description'] = 'プログラムを完了できなかったユーザに通知が送信されました。';
$string['notification_endfailed_relateduser'] = 'プログラム終了による失敗 - 関連ユーザ';
$string['notification_endfailed_relateduser_subject'] = 'ユーザ {$a->user_fullname} 様のプログラム終了による失敗';
$string['notification_endfailed_relateduser_body'] = '{$a->relateduser_fullname} 様

プログラム「{$a->program_fullname}」は終了しました。ユーザ {$a->user_fullname} 様はプログラムを完了できませんでした。
';
$string['notification_endfailed_relateduser_description'] = 'プログラムを完了できなかったユーザに関連するユーザに通知が送信されました。';
$string['notification_relateduserfield'] = '通知関連ユーザフィールド';
$string['notification_relateduserfield_desc'] = '関連ユーザの通知に使用される関連ユーザプロファイルフィールドを選択します。';
$string['notification_reset'] = 'ユーザの進捗のリセット';
$string['notification_reset_subject'] = 'プログラムリセット通知';
$string['notification_reset_body'] = '{$a->user_fullname} 様

実行中のプログラム「{$a->program_fullname}」の進捗がリセットされました。
';
$string['notification_reset_description'] = 'プログラムの進捗がリセットされたユーザに通知が送信されました。';
$string['notification_start'] = 'プログラムが開始されました';
$string['notification_start_subject'] = 'プログラムが開始されました';
$string['notification_start_body'] = '{$a->user_fullname} 様

プログラム「{$a->program_fullname}」が開始されました。
';
$string['notification_start_description'] = 'プログラムを開始したユーザに通知が送信されました。';
$string['notificationdates'] = '通知日';
$string['notset'] = '設定なし';
$string['plugindisabled'] = 'プログラム登録プラグインが無効です。プログラムは動作しません。

[Enable plugin now]（{$a->url}）';
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

$string['privacy:metadata:table:enrol_programs_src_commholds'] = '商取引割り当て予約';
$string['privacy:metadata:field:quantity'] = '数量';

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
$string['programcompletionoverride'] = 'プログラム完了をオーバーライド';
$string['programidnumber'] = 'プログラムID番号';
$string['programimage'] = 'プログラムイメージ';
$string['programname'] = 'プログラム名';
$string['programurl'] = 'プログラムURL';
$string['programs'] = 'プログラム';
$string['programsactive'] = 'アクティブ';
$string['programsarchived'] = 'アーカイブ';
$string['programsarchived_help'] = 'アーカイブされたプログラムはユーザから見えず、進捗がロックされます。';
$string['programslayout'] = 'プログラムの詳細ページのレイアウト';
$string['programslayout_desc'] = 'プログラムのレイアウトを制御します。my/programsページのテーブルビューまたはグリッドビュー。';
$string['programslayoutallowuserswitch'] = 'ユーザのプログラムレイアウトの切り替えを許可する';
$string['programslayoutallowuserswitch_desc'] = 'ユーザのプログラムレイアウトの切り替えを許可する';
$string['programslayout_desc'] = 'プログラムのレイアウトを制御します。my/programsページのテーブルビューまたはグリッドビュー。';
$string['programsblocklayout'] = 'マイプログラムのブロックレイアウト';
$string['programsblocklayout_desc'] = 'プログラムのレイアウトを制御します。[マイプログラム]ブロックのテーブルビューまたはグリッドビュー。';

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
$string['programs:addtocertifications'] = 'プログラムを証明書に追加する';
$string['programs:addtoplan'] = 'プログラムを計画に追加する';
$string['programs:allocate'] = '学生をプログラムに割り当てる';
$string['programs:archive'] = 'プログラム割り当てをアーカイブする';
$string['programs:clone'] = 'プログラムのコンテンツと設定のクローン作製を許可する';
$string['programs:configframeworks'] = '計画のフレームワークにプログラムの可用性を設定する';
$string['programs:configurecustomfields'] = 'プログラムカスタムフィールドを設定する';
$string['programs:delete'] = 'プログラムを削除する';
$string['programs:edit'] = 'プログラムを追加および更新する';
$string['programs:export'] = 'プログラムをエクスポートする';
$string['programs:admin'] = 'プログラムの高度な管理';
$string['programs:manageallocation'] = 'ユーザ割り当ての管理';
$string['programs:manageevidence'] = '他の完了エビデンスを管理する';
$string['programs:reset'] = 'プログラムの進捗をリセットする';
$string['programs:upload'] = 'プログラムをアップロードする';
$string['programs:view'] = 'プログラム管理を表示する';
$string['programs:viewcatalogue'] = 'プログラムカタログにアクセスする';
$string['public'] = '公開';
$string['public_help'] = '公開プログラムはすべてのユーザに表示されます。

可視性ステータスは、すでに割り当て済みのプログラムには影響しません。';
$string['purchaseaccess'] = 'アクセス権を購入する';
$string['resetallocation'] = 'プログラムの進捗をリセットする';
$string['resettype'] = 'タイプをリセットする';
$string['resettype_deallocate'] = 'プログラム登録解除のみ';
$string['resettype_full'] = 'フルコースのパージ';
$string['resettype_none'] = 'なし';
$string['resettype_standard'] = '標準コースのパージ';
$string['sequencetype'] = '完了タイプ';
$string['sequencetype_allinorder'] = '順序どおりにすべて';
$string['sequencetype_allinanyorder'] = '任意の順序ですべて';
$string['sequencetype_atleast'] = '{$a->min} 以上';
$string['sequencetype_minpoints'] = '{$a->minpoints} ポイント以上';
$string['selectcategory'] = 'カテゴリを選択する';
$string['sortbyprogramname'] = 'プログラム名で並べ替える';
$string['sortbyprogramid'] = 'プログラムIDで並べ替える';
$string['sortbyprogramstart'] = 'プログラム開始日で並べ替える';
$string['sortbyprogramdue'] = 'プログラム期限で並べ替える';
$string['sortbyprogramend'] = 'プログラム終了日で並べ替える';
$string['source'] = 'ソース';
$string['source_approval'] = '承認を得たリクエスト';
$string['source_approval_allownew'] = '承認を許可する';
$string['source_approval_allownew_desc'] = '新しい_requests with approval_ソースをプログラムに追加することを許可する';
$string['source_approval_allowrequest'] = '新しいリクエストを許可する';
$string['source_approval_confirm'] = 'プログラムへの割り当てリクエストを確認してください。';
$string['source_approval_daterequested'] = 'リクエストされた日付';
$string['source_approval_daterejected'] = '拒否された日付';
$string['source_approval_makerequest'] = 'アクセスをリクエストする';
$string['source_approval_notification_approval_request_subject'] = 'プログラムリクエスト通知';
$string['source_approval_notification_approval_request_body'] = '
ユーザ {$a->user_fullname} 様がプログラム「{$a->program_fullname}」へのアクセスをリクエストしました。
';
$string['source_approval_notification_approval_reject_subject'] = 'プログラムリクエスト拒否通知';
$string['source_approval_notification_approval_reject_body'] = '{$a->user_fullname} 様、

「{$a->program_fullname}」プログラムへのアクセスリクエストは拒否されました。

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
$string['source_certify'] = '証明書';
$string['source_certify_allownew'] = '証明書割り当てを許可する';
$string['source_certify_allownew_desc'] = '新しい_certification_ソースのプログラムへの追加を許可する';
$string['source_cohort'] = '自動コーホート割り当て';
$string['source_cohort_allownew'] = 'コーホート割り当てを許可する';
$string['source_cohort_allownew_desc'] = '新しい_cohort auto allocation_ソースをプログラムに追加することを許可する';
$string['source_cohort_cohortstoallocate'] = 'コーホートを割り当てる';
$string['source_ecommerce'] = '電子商取引割り当て';
$string['source_ecommerce_allownew'] = '電子商取割り当てを許可する';
$string['source_ecommerce_allownew_desc'] = '新しい電子商取自動割り当てソースのプログラムへの追加を許可する';
$string['source_ecommerce_allowsignup'] = '新しい割り当てを許可する';
$string['source_ecommerce_cohortmembershiprequirement'] = 'ユーザは次のいずれかのコーホートのメンバーであること：{$a}';
$string['source_ecommerce_maxusers'] = '最大ユーザ';
$string['source_ecommerce_nocapacity'] = 'このプログラムには定員の空きがありません';
$string['source_manual'] = '手動割り当て';
$string['source_manual_allocateusers'] = 'ユーザを割り当てる';
$string['source_manual_csvfile'] = 'CSVファイル';
$string['source_manual_hasheaders'] = '最初の行をヘッダーにする';
$string['source_manual_potusersmatching'] = '一致する割り当て候補';
$string['source_manual_potusers'] = '割り当て候補';
$string['source_manual_result_assigned'] = '{$a} 名のユーザがプログラムに割り当てられました。';
$string['source_manual_result_errors'] = 'プログラムの割り当て時に {$a} 件のエラーが検出されました。';
$string['source_manual_result_skipped'] = '{$a} 名のユーザがすでにプログラムに割り当てられていました。';
$string['source_manual_timeduecolumn'] = '期限列';
$string['source_manual_timeendcolumn'] = '終了時間列';
$string['source_manual_timestartcolumn'] = '開始時間列';
$string['source_manual_uploadusers'] = '割り当てをアップロードする';
$string['source_manual_usercolumn'] = 'ユーザ識別列';
$string['source_manual_usermapping'] = 'ユーザマッピングの方法';
$string['source_manual_userupload_allocated'] = '\'{$a}\’に割り当てられました';
$string['source_manual_userupload_alreadyallocated'] = 'すでに\'{$a}\’に割り当てられています';
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
$string['source_selfallocation_maxusers_status'] = 'ユーザ：{$a->count}/{$a->max} 人';
$string['source_selfallocation_signupallowed'] = 'サインアップは許可されています';
$string['source_selfallocation_signupnotallowed'] = 'サインアップは許可されていません';
$string['source_udplans'] = 'ユーザ開発計画';
$string['source_udplans_allownew'] = 'ユーザ開発計画';
$string['source_udplans_allownew_desc'] = '新しい_user development plans_ソースのプログラムへの追加を許可する';
$string['source_udplans_allowed'] = '許可済み';
$string['source_udplans_noframeworks'] = '計画に追加できません';
$string['source_udplans_notallowed'] = '許可されませんでした';
$string['source_udplans_requirecap'] = '必須のケイパビリティを追加する';
$string['set'] = 'コースセット';
$string['settings'] = 'プログラム設定';
$string['scheduling'] = 'スケジュール';
$string['taballocation'] = '割り当て設定';
$string['tabcontent'] = 'コンテンツ';
$string['tabgeneral'] = '一般設定';
$string['tabusers'] = 'ユーザ';
$string['tabvisibility'] = '可視性設定';
$string['tagarea_enrol_programs_programs'] = 'プログラム';
$string['taskcertificate'] = 'プログラム証明書発行cron';
$string['taskcron'] = 'プログラムプラグインcron';
$string['training'] = 'トレーニング';
$string['trainingcompletion'] = '必須のトレーニング：{$a}';
$string['trainingprogress'] = 'トレーニングの進捗：{$a->current}/{$a->total}';
$string['unarchive'] = 'リストア';
$string['unlinkeditems'] = 'リンクされていない項目';
$string['updateprogram'] = 'プログラムを更新する';
$string['updateallocation'] = '割り当てを更新する';
$string['updateallocations'] = '割り当てを更新する';
$string['updatecourse'] = 'コースを更新する';
$string['updateset'] = 'セットを更新する';
$string['updatescheduling'] = 'スケジュールを更新する';
$string['updatesource'] = '{$a} を更新する';
$string['updatetraining'] = 'トレーニングを更新する';
$string['upload'] = 'プログラムをアップロードする';
$string['upload_invalidcount'] = '無効な記録';
$string['upload_files'] = 'ファイル';
$string['upload_files_error'] = '複数のCSVファイル、1つのJSONファイルまたは1つのZipアーカイブが予測されます';
$string['upload_preview'] = 'データプレビュー';
$string['upload_status'] = '状態';
$string['upload_status_invalid'] = '無効';
$string['upload_targetcontext'] = 'コンテクストにプログラムを追加する';
$string['upload_uploadcount'] = 'アップロードするプログラム';
$string['upload_usecategory'] = 'コンテクストにカテゴリ列を使用する';
$string['userupload_completion_error'] = 'プログラムの完了は更新できません';
$string['userupload_completion_updated'] = 'プログラムの完了が更新されました';

$string['rb_allocatedprograms'] = '割り当て済みプログラム';
$string['rb_complete'] = '完了';
$string['rb_completiondate'] = '完了日';
$string['rb_completionstatus'] = '完了ステータス';
$string['rb_datecompleted'] = '完了日';
$string['rb_dateallocated'] = '割り当て日';
$string['rb_datestarted'] = '開始日';
$string['rb_coursesall'] = 'コース - すべて';
$string['rb_incomplete'] = '不完全';
$string['rb_isallocated'] = '割り当て済み';
$string['rb_iscomplete'] = '完了していますか？';
$string['rb_iscompleteany'] = '完了していますか？（任意の方法）';
$string['rb_isinprogress'] = '進行中ですか？';
$string['rb_isnotcomplete'] = '未完了ですか？';
$string['rb_isnotyetstarted'] = '未開始ですか？';
$string['rb_notstarted'] = '未開始';
$string['rb_officewhencompletedbasic'] = '完了時のオフィス（基本）';
$string['rb_privacy:metadata'] = 'プラグインでは個人情報を保存しません。';
$string['rb_programcategory'] = 'プログラムカテゴリ（またはサイト）';
$string['rb_programcategoryid'] = 'プログラムカテゴリID（サイトの場合はN/A）';
$string['rb_programcategoryidnumber'] = 'プログラムカテゴリID番号（サイトの場合はN/A）';
$string['rb_programcategorymultichoice'] = 'プログラムカテゴリ（複数選択）';
$string['rb_programedatecreated'] = 'プログラムデータが作成されました';
$string['rb_programduedate'] = 'プログラム期限';
$string['rb_programenddate'] = 'プログラム割り当て終了日';
$string['rb_programallocationtype'] = '割り当てタイプ';
$string['rb_programallocationtypes'] = '割り当てタイプ';
$string['rb_programexpandlink'] = 'プログラム名（詳細の表示）';
$string['rb_programid'] = 'プログラムID';
$string['rb_programidnumber'] = 'プログラムIDナンバー';
$string['rb_programname'] = 'プログラム名';
$string['rb_programnameandsummary'] = 'プログラム名と説明';
$string['rb_programnamelinked'] = 'プログラム名（プログラムページにリンク済み）';
$string['rb_programmultiitem'] = 'プログラム（複数項目）';
$string['rb_programsingleitem'] = 'プログラム';
$string['rb_programstartdate'] = 'プログラム割り当て開始日';
$string['rb_programsummary'] = 'プログラムの説明';
$string['rb_programvisible'] = 'プログラムは公開されています';
$string['rb_programvisibledisabled'] = 'プログラムの表示（該当なし）';
$string['rb_progress'] = '進捗';
$string['rb_progressnumeric'] = '進捗（数値）';
$string['rb_progresspercent'] = '進捗（%完了）';
$string['rb_source_allocation'] = 'プログラム割り当て';
$string['rb_timetocompletesinceenrol'] = '完了までの時間（割り当て日以降）';
$string['rb_timetocompletesincestart'] = '完了までの時間（開始日以降）';
$string['rb_type_program'] = 'プログラム';
$string['rb_type_program_category'] = 'カテゴリ';
$string['rb_type_program_completion'] = 'プログラム割り当て';
$string['rb_type_program_customfields'] = 'プログラムカスタムフィールド';
$string['rb_user'] = 'ユーザ';
$string['rb_viewprogram'] = 'プログラムを表示する';
$string['rb_visiblecohorts'] = '視覚化されたコーホート';
