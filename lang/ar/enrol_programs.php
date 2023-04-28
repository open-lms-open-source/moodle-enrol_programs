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

$string['addprogram'] = 'إضافة برنامج';
$string['addset'] = 'إضافة مجموعة جديدة';
$string['allocationend'] = 'انتهاء التخصيص';
$string['allocationend_help'] = 'يعتمد معنى تاريخ انتهاء التخصيص على مصادر التخصيص المُمكَّنة. ولا تكون عمليات التخصيص الجديدة ممكنة عادة بعد هذا التاريخ حال تحديده.';
$string['allocation'] = 'التخصيص';
$string['allocations'] = 'عمليات التخصيص';
$string['programallocations'] = 'عمليات تخصيص البرنامج';
$string['allocationdate'] = 'تاريخ التخصيص';
$string['allocationsources'] = 'مصادر التخصيص';
$string['allocationstart'] = 'بداية التخصيص';
$string['allocationstart_help'] = 'يعتمد معنى تاريخ بداية التخصيص على مصادر التخصيص المُمكَّنة. ولا تكون عمليات التخصيص الجديدة ممكنة عادة إلا بعد هذا التاريخ حال تحديده.';
$string['allprograms'] = 'كل البرامج';
$string['appenditem'] = 'إلحاق عنصر';
$string['appendinto'] = 'الإلحاق بعنصر';
$string['archived'] = 'تمت الأرشفة';
$string['catalogue'] = 'كتالوج البرنامج';
$string['catalogue_dofilter'] = 'بحث';
$string['catalogue_resetfilter'] = 'مسح';
$string['catalogue_searchtext'] = 'بحث نصي';
$string['catalogue_tag'] = 'التصفية حسب الوسم';
$string['certificatetemplatechoose'] = 'يتم الآن اختيار قالب...';
$string['cohorts'] = 'مرئي للجماعات';
$string['cohorts_help'] = 'يمكن جعل البرامج غير العامة مرئية لأعضاء معيَّنين في الجماعة.

لا تؤثر حالة الرؤية في البرامج المخصصة بالفعل.';
$string['completiondate'] = 'تاريخ الإكمال';
$string['creategroups'] = 'مجموعات المقرر الدراسي';
$string['creategroups_help'] = 'عند التمكين، سيتم إنشاء مجموعة في كل مقرر دراسي يُضاف إلى البرنامج وستتم إضافة كل المستخدمين المخصصين بصفتهم أعضاءً في المجموعة.';
$string['deleteallocation'] = 'حذف تخصيص البرنامج';
$string['deletecourse'] = 'إزالة المقرر الدراسي';
$string['deleteprogram'] = 'حذف البرنامج';
$string['deleteset'] = 'حذف المجموعة';
$string['documentation'] = 'برامج لوثائق Moodle';
$string['duedate'] = 'تاريخ الاستحقاق';
$string['enrolrole'] = 'دور المقرر الدراسي';
$string['enrolrole_desc'] = 'تحديد الدور الذي ستستخدمه البرامج للتسجيل في المقرر الدراسي';
$string['errorcontentproblem'] = 'تم اكتشاف مشكلة في بناء محتوى البرنامج، ولن يتم تعقب إكمال البرنامج بشكل صحيح!';
$string['errordifferenttenant'] = 'لا يمكن الوصول إلى برنامج من مستأجر آخر';
$string['errornoallocations'] = 'لم يتم العثور على عمليات تخصيص للمستخدمين';
$string['errornoallocation'] = 'البرنامج غير مخصص';
$string['errornomyprograms'] = 'أنت غير مخصص لأي برامج.';
$string['errornoprograms'] = 'لم يتم العثور على برامج.';
$string['errornorequests'] = 'لم يتم العثور على طلبات برامج';
$string['errornotenabled'] = 'لم يتم تمكين المكون الإضافي للبرامج';
$string['event_program_completed'] = 'اكتمل البرنامج';
$string['event_program_created'] = 'تم إنشاء البرنامج';
$string['event_program_deleted'] = 'تم حذف البرنامج';
$string['event_program_updated'] = 'تم تحديث البرنامج';
$string['event_program_viewed'] = 'تم عرض البرنامج';
$string['event_user_allocated'] = 'تم تخصيص المستخدم للبرنامج';
$string['event_user_deallocated'] = 'تم إلغاء تخصيص المستخدم للبرنامج';
$string['evidence'] = 'أدلة أخرى';
$string['evidence_details'] = 'التفاصيل';
$string['fixeddate'] = 'في تاريخ محدد';
$string['item'] = 'العنصر';
$string['itemcompletion'] = 'إكمال عنصر البرنامج';
$string['management'] = 'إدارة البرنامج';
$string['messageprovider:allocation_notification'] = 'إعلام تخصيص البرنامج';
$string['messageprovider:approval_request_notification'] = 'إعلام طلب اعتماد البرنامج';
$string['messageprovider:approval_reject_notification'] = 'إعلام رفض طلب البرنامج';
$string['messageprovider:completion_notification'] = 'إعلام اكتمال البرنامج';
$string['messageprovider:deallocation_notification'] = 'إعلام إلغاء تخصيص البرنامج';
$string['messageprovider:duesoon_notification'] = 'إعلام اقتراب تاريخ استحقاق البرنامج';
$string['messageprovider:due_notification'] = 'إعلام تجاوز تاريخ استحقاق البرنامج';
$string['messageprovider:endsoon_notification'] = 'إعلام اقتراب تاريخ انتهاء البرنامج';
$string['messageprovider:endcompleted_notification'] = 'إعلام انتهاء البرنامج المكتمل';
$string['messageprovider:endfailed_notification'] = 'إعلام انتهاء البرنامج الفاشل';
$string['messageprovider:start_notification'] = 'إعلام بدء البرنامج';
$string['moveitem'] = 'نقل العنصر';
$string['moveitemcancel'] = 'إلغاء النقل';
$string['moveafter'] = 'نقل "{‎$a->item}" بعد "{‎$a->target}"';
$string['movebefore'] = 'نقل "{‎$a->item}" قبل "{‎$a->target}"';
$string['moveinto'] = 'نقل "{‎$a->item}" إلى "{‎$a->target}"';
$string['myprograms'] = 'برامجي';
$string['notification_allocation'] = 'تم تخصيص المستخدم';
$string['notification_completion'] = 'اكتمل البرنامج';
$string['notification_completion_subject'] = 'اكتمل البرنامج';
$string['notification_completion_body'] = 'أهلاً يا {‎$a->user_fullname}،

لقد أكملت البرنامج "{‎$a->program_fullname}".
';
$string['notification_deallocation'] = 'تم إلغاء تخصيص المستخدم';
$string['notification_duesoon'] = 'اقترب تاريخ استحقاق البرنامج';
$string['notification_duesoon_subject'] = 'من المتوقع إكمال البرنامج قريبًا';
$string['notification_duesoon_body'] = 'أهلاً يا {‎$a->user_fullname}،

من المتوقع إكمال البرنامج "{‎$a->program_fullname}" في يوم {‎$a->program_duedate}.
';
$string['notification_due'] = 'تم تجاوز تاريخ استحقاق البرنامج';
$string['notification_due_subject'] = 'كان من المتوقع إكمال البرنامج';
$string['notification_due_body'] = 'أهلاً يا {‎$a->user_fullname}،

كان من المتوقع إكمال البرنامج "{‎$a->program_fullname}" قبل {‎$a->program_duedate}.
';
$string['notification_endsoon'] = 'اقترب تاريخ انتهاء البرنامج';
$string['notification_endsoon_subject'] = 'البرنامج ينتهي قريبًا';
$string['notification_endsoon_body'] = 'أهلاً يا {‎$a->user_fullname}،

سينتهي البرنامج "{‎$a->program_fullname}" في يوم {‎$a->program_enddate}.
';
$string['notification_endcompleted'] = 'انتهى البرنامج المكتمل';
$string['notification_endcompleted_subject'] = 'انتهى البرنامج المكتمل';
$string['notification_endcompleted_body'] = 'أهلاً يا {‎$a->user_fullname}،

انتهى البرنامج "{‎$a->program_fullname}"، لقد أكملته سابقًا.
';
$string['notification_endfailed'] = 'انتهى البرنامج الفاشل';
$string['notification_endfailed_subject'] = 'انتهى البرنامج الفاشل';
$string['notification_endfailed_body'] = 'أهلاً يا {‎$a->user_fullname}،

انتهى البرنامج "{‎$a->program_fullname}"، لقد فشلت في إكماله.
';
$string['notification_start'] = 'بدأ البرنامج';
$string['notification_start_subject'] = 'بدأ البرنامج';
$string['notification_start_body'] = 'أهلاً يا {‎$a->user_fullname}،

لقد بدأ البرنامج "{‎$a->program_fullname}".
';
$string['notificationdates'] = 'تواريخ الإعلام';
$string['notset'] = 'لم يتم التعيين';
$string['plugindisabled'] = 'تم تعطيل المكون الإضافي للتسجيل في البرنامج، ولن تعمل البرامج.

[Enable plugin now]({$a->url})';
$string['pluginname'] = 'البرامج';
$string['pluginname_desc'] = 'البرامج مصممة لتتيح إنشاء مجموعات المقرر الدراسي.';
$string['privacy:metadata:field:programid'] = 'معرف البرنامج';
$string['privacy:metadata:field:userid'] = 'معرف المستخدم';
$string['privacy:metadata:field:allocationid'] = 'معرف تخصيص البرنامج';
$string['privacy:metadata:field:sourceid'] = 'مصدر التخصيص';
$string['privacy:metadata:field:itemid'] = 'معرف العنصر';
$string['privacy:metadata:field:timecreated'] = 'تاريخ الإنشاء';
$string['privacy:metadata:field:timecompleted'] = 'تاريخ الإكمال';

$string['privacy:metadata:table:enrol_programs_allocations'] = 'معلومات عن عمليات تخصيص البرنامج';
$string['privacy:metadata:field:archived'] = 'هل السجل مؤرشف؟';
$string['privacy:metadata:field:sourcedatajson'] = 'معلومات عن مصدر التخصيص';
$string['privacy:metadata:field:timeallocated'] = 'تاريخ تخصيص البرنامج';
$string['privacy:metadata:field:timestart'] = 'تاريخ البدء';
$string['privacy:metadata:field:timedue'] = 'تاريخ الاستحقاق';
$string['privacy:metadata:field:timeend'] = 'تاريخ الانتهاء';

$string['privacy:metadata:table:enrol_programs_certs_issues'] = 'إصدارات شهادة تخصيص البرنامج';
$string['privacy:metadata:field:issueid'] = 'معرف الإصدار';

$string['privacy:metadata:table:enrol_programs_completions'] = 'عمليات إكمال تخصيص البرنامج';

$string['privacy:metadata:table:enrol_programs_evidences'] = 'معلومات عن أدلة الإكمال الأخرى';
$string['privacy:metadata:field:evidencejson'] = 'معلومات عن دليل الإكمال';
$string['privacy:metadata:field:createdby'] = 'تم إنشاء الدليل بواسطة';

$string['privacy:metadata:table:enrol_programs_requests'] = 'معلومات عن طلب التخصيص';
$string['privacy:metadata:field:datajson'] = 'معلومات عن الطلب';
$string['privacy:metadata:field:timerequested'] = 'تاريخ الطلب';
$string['privacy:metadata:field:timerejected'] = 'تاريخ الرفض';
$string['privacy:metadata:field:rejectedby'] = 'تم رفض الطلب بواسطة';


$string['privacy:metadata:table:enrol_programs_usr_snapshots'] = 'لقطات تخصيص البرنامج';
$string['privacy:metadata:field:reason'] = 'السبب';
$string['privacy:metadata:field:timesnapshot'] = 'تاريخ اللقطة';
$string['privacy:metadata:field:snapshotby'] = 'لقطة بواسطة';
$string['privacy:metadata:field:explanation'] = 'الشرح';
$string['privacy:metadata:field:completionsjson'] = 'معلومات عن الإكمال';
$string['privacy:metadata:field:evidencesjson'] = 'معلومات عن دليل الإكمال';

$string['program'] = 'البرنامج';
$string['programautofix'] = 'الإصلاح التلقائي للبرنامج';
$string['programdue'] = 'البرنامج المستحق';
$string['programdue_help'] = 'يشير تاريخ استحقاق البرنامج إلى الوقت الذي يُتوقع من المستخدمين إكمال البرنامج فيه.';
$string['programdue_delay'] = 'مستحق بعد البدء';
$string['programdue_date'] = 'تاريخ الاستحقاق';
$string['programend'] = 'انتهاء البرنامج';
$string['programend_help'] = 'لا يمكن للمستخدمين دخول المقررات الدراسية للبرنامج بعد انتهائه.';
$string['programend_delay'] = 'الانتهاء بعد البدء';
$string['programend_date'] = 'تاريخ انتهاء البرنامج';
$string['programcompletion'] = 'تاريخ إكمال البرنامج';
$string['programidnumber'] = 'رقم معرف البرنامج';
$string['programimage'] = 'صورة البرنامج';
$string['programname'] = 'اسم البرنامج';
$string['programurl'] = 'عنوان URL للبرنامج';
$string['programs'] = 'البرامج';
$string['programsactive'] = 'نشط';
$string['programsarchived'] = 'تمت الأرشفة';
$string['programsarchived_help'] = 'يتم إخفاء البرامج المؤرشفة عن المستخدمين وتأمين تقدمها.';
$string['programstart'] = 'بداية البرنامج';
$string['programstart_help'] = 'لا يمكن للمستخدمين دخول المقررات الدراسية للبرنامج قبل بدئه.';
$string['programstart_allocation'] = 'البدء فورًا بعد التخصيص';
$string['programstart_delay'] = 'تأخير البدء بعد التخصيص';
$string['programstart_date'] = 'تاريخ بدء البرنامج';
$string['programstatus'] = 'حالة البرنامج';
$string['programstatus_completed'] = 'مكتمل';
$string['programstatus_any'] = 'أي حالة للبرنامج';
$string['programstatus_archived'] = 'تمت الأرشفة';
$string['programstatus_archivedcompleted'] = 'مؤرشف مكتمل';
$string['programstatus_overdue'] = 'متأخر';
$string['programstatus_open'] = 'مفتوحة';
$string['programstatus_future'] = 'غير مفتوح بعد';
$string['programstatus_failed'] = 'فشل';
$string['programs:addcourse'] = 'إضافة مقرر دراسي إلى البرامج';
$string['programs:allocate'] = 'تخصيص الطلاب للبرامج';
$string['programs:delete'] = 'حذف البرامج';
$string['programs:edit'] = 'إضافة البرامج وتحديثها';
$string['programs:admin'] = 'إدارة البرنامج المتقدم';
$string['programs:manageevidence'] = 'إدارة أدلة الإكمال الأخرى';
$string['programs:view'] = 'عرض إدارة البرنامج';
$string['programs:viewcatalogue'] = 'الوصول إلى كتالوج البرنامج';
$string['public'] = 'عام';
$string['public_help'] = 'البرامج العامة مرئية لجميع المستخدمين.

لا تؤثر حالة الرؤية في البرامج المخصصة بالفعل.';
$string['sequencetype'] = 'نوع الإكمال';
$string['sequencetype_allinorder'] = 'الكل مرتب';
$string['sequencetype_allinanyorder'] = 'الكل بأي ترتيب';
$string['sequencetype_atleast'] = '{‎$a->min} على الأقل';
$string['selectcategory'] = 'تحديد فئة';
$string['source'] = 'المصدر';
$string['source_approval'] = 'الطلبات ذات الاعتماد';
$string['source_approval_allownew'] = 'السماح بالاعتمادات';
$string['source_approval_allownew_desc'] = 'السماح بإضافة مصادر _requests with approval_ الجديدة إلى البرامج';
$string['source_approval_allowrequest'] = 'السماح بالطلبات الجديدة';
$string['source_approval_confirm'] = 'يُرجى تأكيد رغبتك في طلب التخصيص للبرنامج.';
$string['source_approval_daterequested'] = 'التاريخ المطلوب';
$string['source_approval_daterejected'] = 'تاريخ الرفض';
$string['source_approval_makerequest'] = 'الوصول إلى الطلب';
$string['source_approval_notification_allocation_subject'] = 'إعلام اعتماد البرنامج';
$string['source_approval_notification_allocation_body'] = 'أهلاً يا {‎$a->user_fullname}،

تم اعتماد تسجيلك في البرنامج "{‎$a->program_fullname}" وتاريخ البدء هو {‎$a->program_startdate}.
';
$string['source_approval_notification_approval_request_subject'] = 'إعلام طلب البرنامج';
$string['source_approval_notification_approval_request_body'] = '
طلب المستخدم {‎$a->user_fullname} الوصول إلى البرنامج "{‎$a->program_fullname}".
';
$string['source_approval_notification_approval_reject_subject'] = 'إعلام رفض طلب البرنامج';
$string['source_approval_notification_approval_reject_body'] = 'أهلاً يا {‎$a->user_fullname}،

تم رفض طلبك للوصول إلى البرنامج "{‎$a->program_fullname}".

{$a->reason}
';
$string['source_approval_requestallowed'] = 'الطلبات مسموح بها';
$string['source_approval_requestnotallowed'] = 'الطلبات غير مسموح بها';
$string['source_approval_requests'] = 'الطلبات';
$string['source_approval_requestpending'] = 'طلب الوصول معلق';
$string['source_approval_requestrejected'] = 'تم رفض طلب الوصول';
$string['source_approval_requestapprove'] = 'الموافقة على الطلب';
$string['source_approval_requestreject'] = 'رفض الطلب';
$string['source_approval_requestdelete'] = 'حذف الطلب';
$string['source_approval_rejectionreason'] = 'سبب الرفض';
$string['notification_allocation_subject'] = 'إعلام تخصيص البرنامج';
$string['notification_allocation_body'] = 'أهلاً يا {‎$a->user_fullname}،

لقد تم تخصيصك للبرنامج "{‎$a->program_fullname}"، وتاريخ البدء هو {‎$a->program_startdate}.
';
$string['notification_deallocation_subject'] = 'إعلام إلغاء تخصيص البرنامج';
$string['notification_deallocation_body'] = 'أهلاً يا {‎$a->user_fullname}،

لقد تم إلغاء تخصيصك للبرنامج "{‎$a->program_fullname}".
';
$string['source_cohort'] = 'التخصيص التلقائي للجماعة';
$string['source_cohort_allownew'] = 'السماح بتخصيص الجماعة';
$string['source_cohort_allownew_desc'] = 'السماح بإضافة مصادر _cohort auto allocation_ الجديدة إلى البرامج';
$string['source_manual'] = 'التخصيص اليدوي';
$string['source_manual_allocateusers'] = 'تخصيص المستخدمين';
$string['source_manual_csvfile'] = 'ملف CSV';
$string['source_manual_hasheaders'] = 'السطر الأول هو العنوان';
$string['source_manual_potusersmatching'] = 'مطابقة مرشحي التخصيص';
$string['source_manual_potusers'] = 'مرشحو التخصيص';
$string['source_manual_result_assigned'] = 'تم تعيين {‎$a} من المستخدمين للبرنامج.';
$string['source_manual_result_errors'] = 'تم اكتشاف {‎$a} من الأخطاء عند تعيين البرامج.';
$string['source_manual_result_skipped'] = 'تم تعيين {‎$a} من المستخدمين بالفعل للبرنامج.';
$string['source_manual_uploadusers'] = 'رفع عمليات التخصيص';
$string['source_manual_usercolumn'] = 'عمود تعريف المستخدم';
$string['source_manual_usermapping'] = 'تعيين المستخدم عبر';
$string['source_manual_userupload_allocated'] = 'تم التخصيص إلى "{‎$a}"';
$string['source_manual_userupload_alreadyallocated'] = 'تم التخصيص بالفعل إلى "{‎$a}"';
$string['source_manual_userupload_invalidprogram'] = 'يتعذر التخصيص إلى "{‎$a}"';
$string['source_selfallocation'] = 'التخصيص الذاتي';
$string['source_selfallocation_allocate'] = 'التسجيل';
$string['source_selfallocation_allownew'] = 'السماح بالتخصيص الذاتي';
$string['source_selfallocation_allownew_desc'] = 'السماح بإضافة مصادر _self allocation_ الجديدة إلى البرامج';
$string['source_selfallocation_allowsignup'] = 'السماح بالتسجيلات الجديدة';
$string['source_selfallocation_confirm'] = 'يُرجى تأكيد رغبتك في التخصيص للبرنامج.';
$string['source_selfallocation_enable'] = 'تمكين التخصيص الذاتي';
$string['source_selfallocation_key'] = 'زر التسجيل';
$string['source_selfallocation_keyrequired'] = 'زر التسجيل مطلوب';
$string['source_selfallocation_maxusers'] = 'الحد الأقصى للمستخدمين';
$string['source_selfallocation_maxusersreached'] = 'تم بالفعل الوصول إلى الحد الأقصى لعدد المستخدمين الذين قاموا بالتسجيل الذاتي';
$string['source_selfallocation_maxusers_status'] = 'المستخدمون {‎$a->count}‏/{‎$a->max}';
$string['source_selfallocation_notification_allocation_subject'] = 'إعلام تخصيص البرنامج';
$string['source_selfallocation_notification_allocation_body'] = 'أهلاً يا {‎$a->user_fullname}،

لقد اشتركت في البرنامج "{‎$a->program_fullname}"، وتاريخ البدء هو {$a->program_startdate}.
';
$string['source_selfallocation_signupallowed'] = 'عمليات التسجيل مسموح بها';
$string['source_selfallocation_signupnotallowed'] = 'عمليات التسجيل غير مسموح بها';
$string['set'] = 'مجموعة المقرر الدراسي';
$string['settings'] = 'إعدادات البرنامج';
$string['scheduling'] = 'الجدولة';
$string['taballocation'] = 'إعدادات التخصص';
$string['tabcontent'] = 'المحتوى';
$string['tabgeneral'] = 'عام';
$string['tabusers'] = 'المستخدمون';
$string['tabvisibility'] = 'إعدادات الرؤية';
$string['tagarea_program'] = 'البرامج';
$string['taskcertificate'] = 'أداة cron لإصدار شهادات البرامج';
$string['taskcron'] = 'أداة cron للمكون الإضافي للبرامج';
$string['unlinkeditems'] = 'عناصر غير مرتبطة';
$string['updateprogram'] = 'تحديث البرنامج';
$string['updateallocation'] = 'تحديث التخصيص';
$string['updateallocations'] = 'تحديث عمليات التخصيص';
$string['updateset'] = 'تحديث المجموعة';
$string['updatescheduling'] = 'جدولة التحديث';
$string['updatesource'] = 'التحديث {‎$a}';
