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
$string['archive'] = 'الأرشفة';
$string['archived'] = 'تمت الأرشفة';
$string['benefitname'] = '{$a}: تخصيص البرنامج';
$string['calendarprogramend'] = '{$a} ينتهي';
$string['calendarprogramdue'] = '{$a} مستحق';
$string['calendarprogramstart'] = '{$a} يبدأ';
$string['catalogue'] = 'كتالوج البرنامج';
$string['catalogue_dofilter'] = 'بحث';
$string['catalogue_resetfilter'] = 'مسح';
$string['catalogue_searchtext'] = 'بحث نصي';
$string['catalogue_tag'] = 'التصفية حسب الوسم';
$string['certificatetemplatechoose'] = 'يتم الآن اختيار قالب...';
$string['cohorts'] = 'مرئي للجماعات';
$string['cohorts_help'] = 'يمكن جعل البرامج غير العامة مرئية لأعضاء معينين في الجماعة.

لا تؤثر حالة الرؤية في البرامج المخصصة بالفعل.';
$string['columnusedalready'] = 'العمود مُستخدم بالفعل';
$string['completepercent'] = '{$a}% مكتمل';
$string['completion'] = 'الإكمال';
$string['completiondate'] = 'تاريخ الإكمال';
$string['completiondelay'] = 'تأخير الإكمال';
$string['completionoverride'] = 'تجاوز الإكمال';
$string['creategroups'] = 'مجموعات المقرر الدراسي';
$string['creategroups_help'] = 'عند التمكين، سيتم إنشاء مجموعة في كل مقرر دراسي يُضاف إلى البرنامج وستتم إضافة كل المستخدمين المخصصين بصفتهم أعضاءً في المجموعة.';
$string['customfields'] = 'الحقول المخصصة للبرامج';
$string['customfieldsettings'] = 'إعدادات الحقول المخصصة للبرامج المشتركة';
$string['customfieldvisibleto'] = 'من يمكنه رؤية محتوى الحقول';
$string['customfieldvisible:allocated'] = 'المستخدمون المخصصون للبرامج';
$string['customfieldvisible:everyone'] = 'كل من يمكنه الاطلاع على تفاصيل البرامج الأخرى';
$string['customfieldvisible:viewcapability'] = 'المستخدمون الذين لديهم القدرة على عرض البرامج';
$string['deleteallocation'] = 'حذف تخصيص البرنامج';
$string['deletecourse'] = 'إزالة المقرر الدراسي';
$string['deleteprogram'] = 'حذف البرنامج';
$string['deleteset'] = 'حذف المجموعة';
$string['deletetraining'] = 'إزالة التدريب';
$string['documentation'] = 'برامج لوثائق Moodle';
$string['duedate'] = 'تاريخ الاستحقاق';
$string['enrolrole'] = 'دور المقرر الدراسي';
$string['enrolrole_desc'] = 'تحديد الدور الذي ستستخدمه البرامج للتسجيل في المقرر الدراسي';
$string['errorcontentproblem'] = 'تم اكتشاف مشكلة في بناء محتوى البرنامج، ولن يتم تعقب إكمال البرنامج بشكل صحيح!';
$string['errorcoursemissing'] = 'المقرر الدراسي مفقود';
$string['errorcoursesmissing'] = 'المقررات الدراسية المفقودة: {$a}';
$string['errorinvalidoverridedates'] = 'تجاوزات التاريخ غير صالحة';
$string['errordifferenttenant'] = 'لا يمكن الوصول إلى برنامج من مستأجر آخر';
$string['errorduplicateprogramid'] = 'رقم معرّف البرنامج مُستخدم بالفعل من قبل فئة أخرى، يُرجى استخدام رقم معرّف برنامج فريد.';
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
$string['evidencedate'] = 'تاريخ إكمال الأدلة';
$string['evidenceupdate'] = 'تحديث الأدلة الأخرى';
$string['evidenceupload'] = 'رفع أدلة الإكمال';
$string['evidenceupload_csvfile'] = 'ملف CSV';
$string['evidenceupload_errors'] = 'تم اكتشاف {$a} من الصفوف غير صالحة';
$string['evidenceupload_skipped'] = 'تم تخطي {$a} من الصفوف';
$string['evidenceupload_updated'] = 'تم تحديث أدلة الإكمال لعدد {$a} من المستخدمين';
$string['evidence_details'] = 'التفاصيل';
$string['evidence_detailsdefault'] = 'التفاصيل الافتراضية';
$string['export'] = 'تصدير البرامج';
$string['exportfile_info'] = 'المعلومات';
$string['exportfile_programs'] = 'البرامج';
$string['exportformat'] = 'تنسيق الملف';
$string['exportformat_csv'] = 'CSV';
$string['exportformat_json'] = 'JSON';
$string['extra_menu_management_index'] = 'إجراءات البرامج';
$string['extra_menu_management_program_general'] = 'إجراءات البرنامج';
$string['extra_menu_management_program_users'] = 'إجراءات المستخدمين';
$string['extra_menu_management_program_allocation'] = 'إجراءات التخصيص';
$string['fixeddate'] = 'في تاريخ محدد';
$string['idnumbersymbol'] = 'المعرّف #:';
$string['importallocationend'] = 'انتهاء التخصيص ({$a})';
$string['importallocationstart'] = 'بداية التخصيص ({$a})';
$string['importprogramallocation'] = 'استيراد تخصيص البرنامج';
$string['importprogramallocationconfirmation'] = 'أنت تقوم باستيراد إعدادات التخصيص من البرنامج __{$a->fullname} / {$a->idnumber} / {$a->category}__.

يُرجى تحديد كل الإعدادات التي ترغب في استيرادها.';
$string['importprogramcontent'] = 'استيراد محتوى البرنامج';
$string['importprogramcontentconfirmation'] = 'أنت تقوم باستيراد محتوى من البرنامج __{$a->fullname} / {$a->idnumber} / {$a->category}__.';
$string['importprogramdue'] = 'تاريخ استحقاق البرنامج ({$a})';
$string['importprogramend'] = 'انتهاء البرنامج ({$a})';
$string['importprogramstart'] = 'بداية البرنامج ({$a})';
$string['importselectprogram'] = 'تحديد البرنامج';
$string['invalidallocationdates'] = 'تواريخ تخصيص البرنامج غير صالحة';
$string['invalidcompletiondate'] = 'تاريخ إكمال البرنامج غير صالح';
$string['item'] = 'العنصر';
$string['itemcompletion'] = 'إكمال عنصر البرنامج';
$string['itempoints'] = 'النقاط';
$string['itemrecalculate'] = 'إعادة حساب إكمال العنصر';
$string['layoutgrid'] = 'تخطيط الشبكة';
$string['layouttable'] = 'تخطيط الجدول';
$string['management'] = 'إدارة البرنامج';
$string['messageprovider:allocation_notification'] = 'إعلام تخصيص البرنامج';
$string['messageprovider:approval_request_notification'] = 'إعلام طلب اعتماد البرنامج';
$string['messageprovider:approval_reject_notification'] = 'إعلام رفض طلب البرنامج';
$string['messageprovider:completion_notification'] = 'إعلام اكتمال البرنامج';
$string['messageprovider:completion_relateduser_notification'] = 'إعلام اكتمال البرنامج - المستخدم ذو الصلة';
$string['messageprovider:deallocation_notification'] = 'إعلام إلغاء تخصيص البرنامج';
$string['messageprovider:duesoon_notification'] = 'إعلام اقتراب تاريخ استحقاق البرنامج';
$string['messageprovider:duesoon_relateduser_notification'] = 'إعلام اقتراب تاريخ استحقاق البرنامج - المستخدم ذو الصلة';
$string['messageprovider:due_notification'] = 'إعلام تجاوز تاريخ استحقاق البرنامج';
$string['messageprovider:due_relateduser_notification'] = 'إعلام تجاوز تاريخ استحقاق البرنامج - المستخدم ذو الصلة';
$string['messageprovider:endsoon_notification'] = 'إعلام اقتراب تاريخ انتهاء البرنامج';
$string['messageprovider:endsoon_relateduser_notification'] = 'إعلام اقتراب تاريخ انتهاء البرنامج - المستخدم ذو الصلة';
$string['messageprovider:endcompleted_notification'] = 'إعلام انتهاء البرنامج المكتمل';
$string['messageprovider:endfailed_notification'] = 'إعلام انتهاء البرنامج الفاشل';
$string['messageprovider:endfailed_relateduser_notification'] = 'إعلام انتهاء البرنامج الفاشل - المستخدم ذو الصلة';
$string['messageprovider:reset_notification'] = 'إعلام إعادة تعيين البرنامج';
$string['messageprovider:start_notification'] = 'إعلام بدء البرنامج';
$string['moveitem'] = 'نقل العنصر';
$string['moveitemcancel'] = 'إلغاء النقل';
$string['moveafter'] = 'نقل "{$a->item}" بعد "{$a->target}"';
$string['movebefore'] = 'نقل "{$a->item}" قبل "{$a->target}"';
$string['moveinto'] = 'نقل "{$a->item}" إلى "{$a->target}"';
$string['myprograms'] = 'برامجي';
$string['notification_allocation'] = 'تم تخصيص المستخدم';
$string['notification_allocation_subject'] = 'إعلام تخصيص البرنامج';
$string['notification_allocation_body'] = 'مرحبًا {$a->user_fullname}،

تم تخصيصك للبرنامج "{$a->program_fullname}"، وتاريخ البداية هو {$a->program_startdate}.
';
$string['notification_allocation_description'] = 'إعلام يُرسَل إلى المستخدمين عند تخصيصهم للبرنامج.';
$string['notification_completion'] = 'اكتمل البرنامج';
$string['notification_completion_subject'] = 'اكتمل البرنامج';
$string['notification_completion_body'] = 'مرحبًا {$a->user_fullname}،

لقد أكملت البرنامج "{$a->program_fullname}".
';
$string['notification_completion_description'] = 'إعلام يُرسَل إلى المستخدمين عندما يكملون البرنامج.';
$string['notification_completion_relateduser'] = 'اكتمل البرنامج - المستخدم ذو الصلة';
$string['notification_completion_relateduser_subject'] = 'أكمل المستخدم {$a->user_fullname} البرنامج';
$string['notification_completion_relateduser_body'] = 'مرحبًا {$a->relateduser_fullname}،

لقد أكمل المستخدم {$a->user_fullname} البرنامج "{$a->program_fullname}".
';
$string['notification_completion_relateduser_description'] = 'إعلام يُرسَل إلى المستخدمين ذوي الصلة بالمستخدم عند إكمال المستخدم البرنامج.';
$string['notification_deallocation'] = 'تم إلغاء تخصيص المستخدم';
$string['notification_deallocation_subject'] = 'إعلام إلغاء تخصيص البرنامج';
$string['notification_deallocation_body'] = 'مرحبًا {$a->user_fullname}،

لقد تم إلغاء تخصيصك للبرنامج "{$a->program_fullname}".
';
$string['notification_deallocation_description'] = 'إعلام يُرسَل إلى المستخدمين عند إلغاء تخصيصهم للبرنامج.';
$string['notification_duesoon'] = 'اقترب تاريخ استحقاق البرنامج';
$string['notification_duesoon_subject'] = 'من المتوقع إكمال البرنامج قريبًا';
$string['notification_duesoon_body'] = 'مرحبًا {$a->user_fullname}،

من المتوقع إكمال البرنامج "{$a->program_fullname}" في {$a->program_duedate}.
';
$string['notification_duesoon_description'] = 'إعلام يُرسَل إلى المستخدمين قبل تاريخ إكمال البرنامج، ما لم يكن البرنامج قد اكتمل بالفعل.';
$string['notification_duesoon_relateduser'] = 'اقترب تاريخ استحقاق البرنامج - المستخدم ذو الصلة';
$string['notification_duesoon_relateduser_subject'] = 'من المتوقع إكمال البرنامج للمستخدم {$a->user_fullname} قريبًا';
$string['notification_duesoon_relateduser_body'] = 'مرحبًا {$a->relateduser_fullname}،

من المتوقع إكمال البرنامج "{$a->program_fullname}" للمستخدم {$a->user_fullname} في {$a->program_duedate}.
';
$string['notification_duesoon_relateduser_description'] = 'إعلام يُرسَل إلى المستخدمين ذوي الصلة بالمستخدم قبل تاريخ إكماله البرنامج، ما لم يكن البرنامج قد اكتمل بالفعل.';
$string['notification_due'] = 'تم تجاوز تاريخ استحقاق البرنامج';
$string['notification_due_subject'] = 'كان من المتوقع إكمال البرنامج';
$string['notification_due_body'] = 'مرحبًا {$a->user_fullname}،

كان من المتوقع إكمال البرنامج "{$a->program_fullname}" قبل {$a->program_duedate}.
';
$string['notification_due_description'] = 'إعلام يُرسَل إلى المستخدمين عند تجاوز تاريخ إكمال البرنامج.';
$string['notification_due_relateduser'] = 'تجاوز تاريخ استحقاق البرنامج - المستخدم ذو الصلة';
$string['notification_due_relateduser_subject'] = 'كان من المتوقع إكمال البرنامج للمستخدم {$a->user_fullname}';
$string['notification_due_relateduser_body'] = 'مرحبًا {$a->relateduser_fullname}،

كان من المتوقع إكمال البرنامج "{$a->program_fullname}" للمستخدم {$a->user_fullname} قبل {$a->program_duedate}.
';
$string['notification_due_relateduser_description'] = 'إعلام يُرسَل إلى المستخدمين ذوي الصلة بالمستخدم عند تجاوزه تاريخ إكمال البرنامج.';
$string['notification_endsoon'] = 'اقترب تاريخ انتهاء البرنامج';
$string['notification_endsoon_subject'] = 'البرنامج ينتهي قريبًا';
$string['notification_endsoon_body'] = 'مرحبًا {$a->user_fullname}،

ينتهي البرنامج "{$a->program_fullname}" في {$a->program_enddate}.
';
$string['notification_endsoon_description'] = 'إعلام يُرسَل إلى المستخدمين قبل تاريخ انتهاء البرنامج، ما لم يكن البرنامج قد اكتمل بالفعل.';
$string['notification_endsoon_relateduser'] = 'اقترب تاريخ انتهاء البرنامج - المستخدم ذو الصلة';
$string['notification_endsoon_relateduser_subject'] = 'سينتهي البرنامج للمستخدم {$a->user_fullname} قريبًا';
$string['notification_endsoon_relateduser_body'] = 'مرحبًا {$a->relateduser_fullname}،

ينتهي البرنامج "{$a->program_fullname}" للمستخدم {$a->user_fullname} في {$a->program_enddate}.
';
$string['notification_endsoon_relateduser_description'] = 'إعلام يُرسَل إلى المستخدمين ذوي الصلة بالمستخدم قبل تاريخ انتهاء برنامجه، ما لم يكن البرنامج قد اكتمل بالفعل.';
$string['notification_endcompleted'] = 'انتهى البرنامج المكتمل';
$string['notification_endcompleted_subject'] = 'انتهى البرنامج المكتمل';
$string['notification_endcompleted_body'] = 'مرحبًا {$a->user_fullname}،

انتهى البرنامج "{$a->program_fullname}" وقد أكملته سابقًا.
';
$string['notification_endcompleted_description'] = 'إعلام يُرسَل إلى المستخدمين عند انتهاء البرنامج المكتمل.';
$string['notification_endfailed'] = 'انتهى البرنامج الفاشل';
$string['notification_endfailed_subject'] = 'انتهى البرنامج الفاشل';
$string['notification_endfailed_body'] = 'مرحبًا {$a->user_fullname}،

انتهى البرنامج "{$a->program_fullname}" ولم تتمكن من إكماله.
';
$string['notification_endfailed_description'] = 'إعلام يُرسَل إلى المستخدمين عند انتهاء البرنامج الذي لم يتمكنوا من إكماله.';
$string['notification_endfailed_relateduser'] = 'انتهاء البرنامج الفاشل - المستخدم ذو الصلة';
$string['notification_endfailed_relateduser_subject'] = 'انتهى البرنامج الفاشل للمستخدم {$a->user_fullname}';
$string['notification_endfailed_relateduser_body'] = 'مرحبًا {$a->relateduser_fullname}،

انتهى البرنامج "{$a->program_fullname}" ولم يتمكن المستخدم {$a->user_fullname} من إكماله.
';
$string['notification_endfailed_relateduser_description'] = 'إعلام يُرسَل إلى المستخدمين ذوي الصلة بالمستخدم عند انتهاء البرنامج الذي فشل في إكماله.';
$string['notification_relateduserfield'] = 'حقل إعلام المستخدم ذي الصلة';
$string['notification_relateduserfield_desc'] = 'حدد حقل ملف تعريف المستخدمين ذوي الصلة لاستخدامه في إعلامات المستخدمين ذوي الصلة.';
$string['notification_reset'] = 'إعادة تعيين تقدم المستخدم';
$string['notification_reset_subject'] = 'إعلام إعادة تعيين البرنامج';
$string['notification_reset_body'] = 'مرحبًا {$a->user_fullname}،

تمت إعادة تعيين تقدمك في البرنامج "{$a->program_fullname}".
';
$string['notification_reset_description'] = 'إعلام يُرسَل إلى المستخدمين عند إعادة تعيين تقدم البرنامج.';
$string['notification_start'] = 'بدأ البرنامج';
$string['notification_start_subject'] = 'بدأ البرنامج';
$string['notification_start_body'] = 'مرحبًا {$a->user_fullname}،

بدأ البرنامج "{$a->program_fullname}".
';
$string['notification_start_description'] = 'إعلام يُرسَل إلى المستخدمين عند بدء البرنامج.';
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

$string['privacy:metadata:table:enrol_programs_src_commholds'] = 'حجوزات Commerce allocation';
$string['privacy:metadata:field:quantity'] = 'الكمية';

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
$string['programcompletionoverride'] = 'تجاوز تاريخ إكمال البرنامج';
$string['programidnumber'] = 'رقم معرف البرنامج';
$string['programimage'] = 'صورة البرنامج';
$string['programname'] = 'اسم البرنامج';
$string['programurl'] = 'عنوان URL للبرنامج';
$string['programs'] = 'البرامج';
$string['programsactive'] = 'نشط';
$string['programsarchived'] = 'تمت الأرشفة';
$string['programsarchived_help'] = 'يتم إخفاء البرامج المؤرشفة عن المستخدمين وتأمين تقدمها.';
$string['programslayout'] = 'تخطيط صفحة تفاصيل البرنامج';
$string['programslayout_desc'] = 'يتحكم في تخطيط البرامج - عرض الجدول أو الشبكة لصفحة "برامجي".';
$string['programslayoutallowuserswitch'] = 'السماح للمستخدمين بتبديل تخطيط البرنامج';
$string['programslayoutallowuserswitch_desc'] = 'السماح للمستخدمين بتبديل تخطيط البرنامج';
$string['programslayout_desc'] = 'يتحكم في تخطيط البرامج - عرض الجدول أو الشبكة لصفحة "برامجي".';
$string['programsblocklayout'] = 'تخطيط كتلة "برامجي"';
$string['programsblocklayout_desc'] = 'يتحكم في تخطيط البرامج - طريقة عرض الجدول أو الشبكة لكتلة "برامجي".';

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
$string['programs:addtocertifications'] = 'إضافة البرنامج إلى الشهادات';
$string['programs:addtoplan'] = 'إضافة البرنامج إلى الخطط';
$string['programs:allocate'] = 'تخصيص الطلاب للبرامج';
$string['programs:archive'] = 'أرشفة عمليات تخصيص البرنامج';
$string['programs:clone'] = 'السماح بنسخ محتوى البرنامج وإعداداته';
$string['programs:configframeworks'] = 'تكوين إتاحة البرنامج في أطر عمل الخطط';
$string['programs:configurecustomfields'] = 'تكوين الحقول المخصصة للبرنامج';
$string['programs:delete'] = 'حذف البرامج';
$string['programs:edit'] = 'إضافة البرامج وتحديثها';
$string['programs:export'] = 'تصدير البرامج';
$string['programs:admin'] = 'إدارة البرنامج المتقدم';
$string['programs:manageallocation'] = 'إدارة عمليات تخصيص المستخدمين';
$string['programs:manageevidence'] = 'إدارة أدلة الإكمال الأخرى';
$string['programs:reset'] = 'إعادة تعيين تقدم البرنامج';
$string['programs:upload'] = 'رفع البرامج';
$string['programs:view'] = 'عرض إدارة البرنامج';
$string['programs:viewcatalogue'] = 'الوصول إلى كتالوج البرنامج';
$string['public'] = 'عام';
$string['public_help'] = 'البرامج العامة مرئية لجميع المستخدمين.

لا تؤثر حالة الرؤية في البرامج المخصصة بالفعل.';
$string['purchaseaccess'] = 'شراء صلاحية الوصول';
$string['resetallocation'] = 'إعادة تعيين تقدم البرنامج';
$string['resettype'] = 'نوع إعادة التعيين';
$string['resettype_deallocate'] = 'إلغاء تخصيص البرنامج فقط';
$string['resettype_full'] = 'مسح كامل للمقرر الدراسي';
$string['resettype_none'] = 'بلا';
$string['resettype_standard'] = 'مسح قياسي للمقرر الدراسي';
$string['sequencetype'] = 'نوع الإكمال';
$string['sequencetype_allinorder'] = 'الكل مرتب';
$string['sequencetype_allinanyorder'] = 'الكل بأي ترتيب';
$string['sequencetype_atleast'] = '{$a->min} على الأقل';
$string['sequencetype_minpoints'] = '{$a->minpoints} من النقاط بحد أدنى';
$string['selectcategory'] = 'تحديد فئة';
$string['sortbyprogramname'] = 'فرز حسب اسم البرنامج';
$string['sortbyprogramid'] = 'فرز حسب معرّف البرنامج';
$string['sortbyprogramstart'] = 'فرز حسب تاريخ بدء البرنامج';
$string['sortbyprogramdue'] = 'فرز حسب تاريخ استحقاق البرنامج';
$string['sortbyprogramend'] = 'فرز حسب تاريخ انتهاء البرنامج';
$string['source'] = 'المصدر';
$string['source_approval'] = 'الطلبات ذات الاعتماد';
$string['source_approval_allownew'] = 'السماح بالاعتمادات';
$string['source_approval_allownew_desc'] = 'السماح بإضافة مصادر _requests with approval_ الجديدة إلى البرامج';
$string['source_approval_allowrequest'] = 'السماح بالطلبات الجديدة';
$string['source_approval_confirm'] = 'يُرجى تأكيد رغبتك في طلب التخصيص للبرنامج.';
$string['source_approval_daterequested'] = 'التاريخ المطلوب';
$string['source_approval_daterejected'] = 'تاريخ الرفض';
$string['source_approval_makerequest'] = 'الوصول إلى الطلب';
$string['source_approval_notification_approval_request_subject'] = 'إعلام طلب البرنامج';
$string['source_approval_notification_approval_request_body'] = '
طلب المستخدم {$a->user_fullname} الوصول إلى البرنامج "{$a->program_fullname}".
';
$string['source_approval_notification_approval_reject_subject'] = 'إعلام رفض طلب البرنامج';
$string['source_approval_notification_approval_reject_body'] = 'مرحبًا {$a->user_fullname}،

تم رفض طلبك للوصول إلى البرنامج "{$a->program_fullname}".

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
$string['source_certify'] = 'الشهادات';
$string['source_certify_allownew'] = 'السماح بتخصيص الشهادات';
$string['source_certify_allownew_desc'] = 'السماح بإضافة مصادر _certification_ الجديدة إلى البرامج';
$string['source_cohort'] = 'التخصيص التلقائي للجماعة';
$string['source_cohort_allownew'] = 'السماح بتخصيص الجماعة';
$string['source_cohort_allownew_desc'] = 'السماح بإضافة مصادر _cohort auto allocation_ الجديدة إلى البرامج';
$string['source_cohort_cohortstoallocate'] = 'تخصيص الجماعات';
$string['source_ecommerce'] = 'E-Commerce allocation';
$string['source_ecommerce_allownew'] = 'السماح بتعيين e-commerce allocation';
$string['source_ecommerce_allownew_desc'] = 'السماح بإضافة مصادر تخصيص e-commerce التلقائي الجديدة إلى البرامج';
$string['source_ecommerce_allowsignup'] = 'السماح بعمليات تخصيص جديدة';
$string['source_ecommerce_cohortmembershiprequirement'] = 'يجب أن يكون المستخدمون أعضاءً في إحدى الجماعات الآتية: {$a}';
$string['source_ecommerce_maxusers'] = 'الحد الأقصى للمستخدمين';
$string['source_ecommerce_nocapacity'] = 'لا توجد سعة متبقية في هذا البرنامج';
$string['source_manual'] = 'التخصيص اليدوي';
$string['source_manual_allocateusers'] = 'تخصيص المستخدمين';
$string['source_manual_csvfile'] = 'ملف CSV';
$string['source_manual_hasheaders'] = 'السطر الأول هو العنوان';
$string['source_manual_potusersmatching'] = 'مطابقة مرشحي التخصيص';
$string['source_manual_potusers'] = 'مرشحو التخصيص';
$string['source_manual_result_assigned'] = 'تم تعيين {$a} من المستخدمين للبرنامج.';
$string['source_manual_result_errors'] = 'تم اكتشاف {$a} من الأخطاء عند تعيين البرامج.';
$string['source_manual_result_skipped'] = 'تم تعيين {$a} من المستخدمين بالفعل للبرنامج.';
$string['source_manual_timeduecolumn'] = 'عمود وقت الاستحقاق';
$string['source_manual_timeendcolumn'] = 'عمود وقت الانتهاء';
$string['source_manual_timestartcolumn'] = 'عمود وقت البداية';
$string['source_manual_uploadusers'] = 'رفع عمليات التخصيص';
$string['source_manual_usercolumn'] = 'عمود تعريف المستخدم';
$string['source_manual_usermapping'] = 'تعيين المستخدم عبر';
$string['source_manual_userupload_allocated'] = 'مخصص لـ \'{$a}\'';
$string['source_manual_userupload_alreadyallocated'] = 'مخصص بالفعل لـ \'{$a}\'';
$string['source_manual_userupload_invalidprogram'] = 'يتعذر التخصيص لـ \'{$a}\'';
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
$string['source_selfallocation_maxusers_status'] = 'المستخدمون {$a->count}/{$a->max}';
$string['source_selfallocation_signupallowed'] = 'عمليات التسجيل مسموح بها';
$string['source_selfallocation_signupnotallowed'] = 'عمليات التسجيل غير مسموح بها';
$string['source_udplans'] = 'خطط تطوير المستخدم';
$string['source_udplans_allownew'] = 'خطط تطوير المستخدم';
$string['source_udplans_allownew_desc'] = 'السماح بإضافة مصادر _user development plans_ الجديدة إلى البرامج';
$string['source_udplans_allowed'] = 'مسموح';
$string['source_udplans_noframeworks'] = 'تتعذر الإضافة إلى أي خطط';
$string['source_udplans_notallowed'] = 'غير مسموح';
$string['source_udplans_requirecap'] = 'مطلوب إضافة القدرة';
$string['set'] = 'مجموعة المقرر الدراسي';
$string['settings'] = 'إعدادات البرنامج';
$string['scheduling'] = 'الجدولة';
$string['taballocation'] = 'إعدادات التخصص';
$string['tabcontent'] = 'المحتوى';
$string['tabgeneral'] = 'عام';
$string['tabusers'] = 'المستخدمون';
$string['tabvisibility'] = 'إعدادات الرؤية';
$string['tagarea_enrol_programs_programs'] = 'البرامج';
$string['taskcertificate'] = 'أداة cron لإصدار شهادات البرامج';
$string['taskcron'] = 'أداة cron للمكون الإضافي للبرامج';
$string['training'] = 'التدريب';
$string['trainingcompletion'] = 'التدريب المطلوب: {$a}';
$string['trainingprogress'] = 'تقدم التدريب: {$a->current}/{$a->total}';
$string['unarchive'] = 'الاستعادة';
$string['unlinkeditems'] = 'عناصر غير مرتبطة';
$string['updateprogram'] = 'تحديث البرنامج';
$string['updateallocation'] = 'تحديث التخصيص';
$string['updateallocations'] = 'تحديث عمليات التخصيص';
$string['updatecourse'] = 'تحديث مقرر دراسي';
$string['updateset'] = 'تحديث المجموعة';
$string['updatescheduling'] = 'جدولة التحديث';
$string['updatesource'] = 'تحديث {$a}';
$string['updatetraining'] = 'تحديث التدريب';
$string['upload'] = 'رفع البرامج';
$string['upload_invalidcount'] = 'سجلات غير صالحة';
$string['upload_files'] = 'الملفات';
$string['upload_files_error'] = 'من المتوقع وجود ملفات CSV متعددة، أو ملف JSON واحد، أو أرشيف Zip واحد';
$string['upload_preview'] = 'معاينة البيانات';
$string['upload_status'] = 'الحالة';
$string['upload_status_invalid'] = 'غير صالح';
$string['upload_targetcontext'] = 'إضافة البرامج إلى السياق';
$string['upload_uploadcount'] = 'البرامج التي سيتم رفعها';
$string['upload_usecategory'] = 'استخدام عمود الفئة للسياقات';
$string['userupload_completion_error'] = 'لا يمكن تحديث إكمال البرنامج';
$string['userupload_completion_updated'] = 'تم تحديث إكمال البرنامج';

$string['rb_allocatedprograms'] = 'البرامج المخصصة';
$string['rb_complete'] = 'إكمال';
$string['rb_completiondate'] = 'تاريخ الإكمال';
$string['rb_completionstatus'] = 'حالة الإكمال';
$string['rb_datecompleted'] = 'تاريخ الإكمال';
$string['rb_dateallocated'] = 'تاريخ التخصيص';
$string['rb_datestarted'] = 'تاريخ البداية';
$string['rb_coursesall'] = 'المقرر الدراسي (المقررات الدراسية) - الكل';
$string['rb_incomplete'] = 'غير مكتمل';
$string['rb_isallocated'] = 'مخصص';
$string['rb_iscomplete'] = 'هل هو مكتمل؟';
$string['rb_iscompleteany'] = 'هل هو مكتمل؟ (أي أسلوب)';
$string['rb_isinprogress'] = 'هل هو قيد التقدم؟';
$string['rb_isnotcomplete'] = 'هل لم يكتمل؟';
$string['rb_isnotyetstarted'] = 'هل لم يبدأ بعد؟';
$string['rb_notstarted'] = 'لم يبدأ';
$string['rb_officewhencompletedbasic'] = 'المكتب عند الإكمال (أساسي)';
$string['rb_privacy:metadata'] = 'لا يُخزن المكون الإضافي أي بيانات شخصية.';
$string['rb_programcategory'] = 'فئة البرنامج (أو الموقع)';
$string['rb_programcategoryid'] = 'معرف فئة البرنامج (لا ينطبق إذا كان موقعًا)';
$string['rb_programcategoryidnumber'] = 'رقم معرف فئة البرنامج (لا ينطبق إذا كان موقعًا)';
$string['rb_programcategorymultichoice'] = 'فئة البرنامج (اختيار من متعدد)';
$string['rb_programedatecreated'] = 'تاريخ إنشاء البرنامج';
$string['rb_programduedate'] = 'تاريخ استحقاق البرنامج';
$string['rb_programenddate'] = 'تاريخ انتهاء تخصيص البرنامج';
$string['rb_programallocationtype'] = 'نوع التخصيص';
$string['rb_programallocationtypes'] = 'أنواع عمليات التخصيص';
$string['rb_programexpandlink'] = 'اسم البرنامج (تفاصيل موسعة)';
$string['rb_programid'] = 'معرف البرنامج';
$string['rb_programidnumber'] = 'رقم معرف البرنامج';
$string['rb_programname'] = 'اسم البرنامج';
$string['rb_programnameandsummary'] = 'اسم البرنامج والوصف';
$string['rb_programnamelinked'] = 'اسم البرنامج (مرتبط بصفحة البرنامج)';
$string['rb_programmultiitem'] = 'البرنامج (عناصر متعددة)';
$string['rb_programsingleitem'] = 'البرنامج';
$string['rb_programstartdate'] = 'تاريخ بداية تخصيص البرنامج';
$string['rb_programsummary'] = 'وصف البرنامج';
$string['rb_programvisible'] = 'البرنامج عام';
$string['rb_programvisibledisabled'] = 'البرنامج مرئي (غير قابل للتطبيق)';
$string['rb_progress'] = 'التقدم';
$string['rb_progressnumeric'] = 'التقدم (رقمي)';
$string['rb_progresspercent'] = 'التقدم (النسبة المئوية للإكمال)';
$string['rb_source_allocation'] = 'عمليات تخصيص البرنامج';
$string['rb_timetocompletesinceenrol'] = 'الوقت اللازم للإكمال (منذ تاريخ التخصيص)';
$string['rb_timetocompletesincestart'] = 'الوقت اللازم للإكمال (منذ تاريخ البداية)';
$string['rb_type_program'] = 'البرنامج';
$string['rb_type_program_category'] = 'الفئة';
$string['rb_type_program_completion'] = 'تخصيص البرنامج';
$string['rb_type_program_customfields'] = 'الحقول المخصصة للبرنامج';
$string['rb_user'] = 'المستخدِم';
$string['rb_viewprogram'] = 'عرض البرنامج';
$string['rb_visiblecohorts'] = 'الجماعات التي لديها إمكانية الرؤية';
