window.ParsleyConfig = window.ParsleyConfig || {};

(function ($) {
  window.ParsleyConfig = $.extend( true, {}, window.ParsleyConfig, {
    messages: {
      // parsley //////////////////////////////////////
        defaultMessage: "تنسيق الحقل غير صحيح"
        , type: {
            email:      "اكتب البريد الإلكتروني بالطريقة المطلوبة"
          , url:        "اكتب الرابط بالطريقة المطلوبة"
          , urlstrict:  "اكتب الرابط بالطريقة المطلوبة"
          , number:     "اكتب أرقام ففط (عدد صحيح)"
          , digits:     "اكتب أرقاما فقط"
          , dateIso:    "اكتب التاريخ بهذه الصيغة (YYYY-MM-DD)."
          , alphanum:   "اكتب حروف وأرقام فقط"
          , phone:      "اكتب رقم هاتف بالطريقة المطلوبة"
        }
      , notnull:        "هذا الحقل مطلوب"
      , notblank:       "هذا الحقل مطلوب"
      , required:       "هذا الحقل مطلوب"
      , regexp:         "تنسيق الحقل غير صحيح"
      , min:            "الرقم يجب أن يكون أكبر من أو يساوي : %s."
      , max:            "الرقم يجب أن يكون أصغر من أو يساوي : %s."
      , range:          "الرقم يجب أن يكون بين %s و %s."
      , minlength:      "الحقل قصير. يجب أن يحتوي على %s حرف/أحرف أو أكثر"
      , maxlength:      "الحقل طويل. يجب أن يحتوي على %s حرف/أحرف أو أقل"
      , rangelength:    "طول الحقل غير مقبول. يجب أن يكون بين %s و %s حرف/أحرف"
      , mincheck:       "يجب أن تختار %s (اختيار) على الأقل"
      , maxcheck:       "يجب أن تختار %s (اختبار) أو أقل"
      , rangecheck:     "يجب أن تختار بين %s و %s (اختبار)."
      , equalto:        "يجب أن يتساوى الحقلان"

      // parsley.extend ///////////////////////////////
      , minwords:       "يجب أن يحتوي الحقل على %s كلمة/كلمات على الأقل"
      , maxwords:       "يجب أن يحتوي الحقل على %s كلمة/كلمات كحد أعلى"
      , rangewords:     "عدد الكلمات المسوح بها مابين %s و %s كلمة/كلمات."
      , greaterthan:    "يجب أن تكون القيمة أكبر من %s."
      , lessthan:       "يجب أن تكون القيمة أقل من %s."
      , beforedate:     "التاريخ يجب أن يكون قبل  %s."
      , afterdate:      "التاريخ يجب أن يكون بعد  %s."
      , americandate:  "اكتب التاريخ بالطريقة المطلوبة (MM/DD/YYYY)."
    }
  });
}(window.jQuery || window.Zepto));
