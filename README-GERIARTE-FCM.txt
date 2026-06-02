هذا مشروع Android كامل وليس APK فقط.

المطلوب قبل البناء:
1. افتح Firebase Console وأنشئ Android app للحزمة:
   com.webview.geriartechat

2. حمّل ملف:
   google-services.json

3. ضعه داخل:
   app/google-services.json

4. افتح المشروع في Android Studio ثم Build > Generate Signed Bundle / APK.

5. اربط ووردبريس بكود wordpress-fcm-module.php ثم ضع Firebase Server Key أو عدله إلى HTTP v1.

ملاحظة:
هذا مشروع WebView + Firebase Cloud Messaging جاهز كبنية أساسية.
إرسال الإشعار من ووردبريس يحتاج دمج دالة geriarte_send_fcm_to_user عند إنشاء رسالة/إعجاب/تعليق.
