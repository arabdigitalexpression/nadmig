<?php
return [

    /*
    |--------------------------------------------------------------------------
    | English Admin Language Lines
    |--------------------------------------------------------------------------
    */

    "report" => [

        "like_dislike_reports" => [
            "create"                    => "Create report",
            "edit"                      => "Edit report",
            "index"                     => "report",
            "show"                      => "Show report"
        ],
        "space_manger_2" => [
            "create"                    => "Create report",
            "edit"                      => "Edit report",
            "index"                     => "report",
            "show"                      => "Show report"
        ],
        "trainer" => "تقارير المدربين"
    ],
    "LikeDislikeReport" => [
        "fields" => [
            "id" => "رقم التسلسل",
            "like" => 'أعجبني',
            "dislike" => 'لم يعجبني',
            "need_to_enhance" => "يحتاج لتحسين",
            "user_id" => "أسم المستخدم",
            "organization_id" => "المؤسسة",
            "created_at" => "أنشئ في",
            "updated_at" => "عًدل في"
        ]
    ],
    "Report8" => [
        "fields" => [
            "id" => "رقم التسلسل",
            "what_happens" => "ماذا يتم بالفعل",
            "notes" => "انطبعات\ملاحظات\أسئلة\توصيات على ماذا سمعته",
            "does_it_achive_the_goal" => "تمت أهداف التدريب بشكل كامل",
            "trainer_explaination_intraction" => "طريقة شرح المدرب تفاعلية",
            "trainer_answers" => "طريقة اجابة المدرب على الأسئلة كانت واضحة",
            "trainer_intraction" => "كان المتدريبن متفاعلين مع الأنشطة ",
            "workshop_overall" => "التدريب بشكل عام كان مفيد",
            "user_id" => "أسم المستخدم",
            "organization_id" => "المؤسسة",
            "created_at" => "أنشئ في",
            "updated_at" => "عًدل في"
        ]
    ],
    "TrainerReport" => [
        "fields" => [
            "id" => "رقم التسلسل",
            "event_id" => 'الفاعلية',
            "attendees_id" => 'آسم المشارك',
            "trainer_id" => "آسم المدرب",
            "week" => "الأسبوع",
            "organization_id" => "المؤسسة",
            "confidence" => [
                "percentage" => "نسبة (الثقة في النفس)",
                "text" => "دليل على الفعل (الثقة في النفس)"
            ],
            "initiative" => [
                "percentage" => "نسبة (الأخذ بالمبادرة)",
                "text" => "دليل على الفعل (الأخذ بالمبادرة)"
            ],
            "respect_and_accept" => [
                "percentage" => "نسبة (احترام وتقبل رأي الأخر)",
                "text" => "دليل على الفعل (احترام وتقبل رأي الأخر)"
            ],
            "team_work" => [
                "percentage" => "نسبة (القدرة على العمل الجماعي)",
                "text" => "دليل على الفعل (القدرة على العمل الجماعي)"
            ],
            "critical_thinking" => [
                "percentage" => "نسبة (التفكير النقدي)",
                "text" => "دليل على الفعل (التفكير النقدي)"
            ],
            "imagination" => [
                "percentage" => "نسبة (القدرة على الخيال)",
                "text" => "دليل على الفعل (القدرة على الخيال)"
            ],
            "open_to_change" => [
                "percentage" => "نسبة (منفتح على التغــُير والتغيير)",
                "text" => "دليل على الفعل (منفتح على التغــُير والتغيير)"
            ],
            "ability_to_understand_the_content" => [
                "percentage" => "نسبة (القدرة على فهم المحتوى)",
                "text" => "دليل على الفعل (القدرة على فهم المحتوى)"
            ],
            "ability_to_produce_art" => [
                "percentage" => "نسبة (القدرة على انتاج عمل فني)",
                "text" => "دليل على الفعل (القدرة على انتاج عمل فني)"
            ],
            "ability_to_thinking" => [
                "percentage" => "نسبة (القدرة على التحليل)",
                "text" => "دليل على الفعل (القدرة على التحليل)"
            ],
            "ability_to_inovate" => [
                "percentage" => "نسبة (القدرة على الابتكار)",
                "text" => "دليل على الفعل (القدرة على الابتكار)"
            ],
            "created_at" => "أنشئ في",
            "updated_at" => "عًدل في"
        ]
    ],
    "SpaceManager2Report" => [
        "fields" => [
            "id" => "رقم التسلسل",
            "date" => "التاريخ",
            "attendees" => "عدد الحضور",
            "trainer_id" => "آسم المدرب",
            "session_id" => "الجلسة",
            "notes" => "ملاحظات",
            "type" => "نوع الجلسة",
            "user_id" => "أسم المستخدم",
            "organization_id" => "المؤسسة",
            "created_at" => "أنشئ في",
            "updated_at" => "عًدل في"
        ]
    ],
    "fields" => [
        "report" => [
            "language_id"           => "Language",
            "content"               => "Content",
            "description"           => "Description",
            "title"                 => "Title"
        ],
        "likedislike" => [
            "id" => "رقم التسلسل",
            "like" => 'أعجبني',
            "dislike" => 'لم يعجبني',
            "need_to_enhance" => "يحتاج لتحسين",
            "user_id" => "أسم المستخدم",
            "organization_id" => "المؤسسة",
            "created_at" => "أنشئ في",
            "updated_at" => "عًدل في"  
        ]
    ],
    "menu" => [
        "report" => [
            "root" => "التقارير",
            "export" => "تصدير التقارير",
            "like_dislike" => [
                "add"                   => "أضف تقرير ( أعجبني و لم يعجبني )",
                "all"                   => "تقارير ( أعجبني و لم يعجبني )",
            ],
            "space_manger_2" => [
                "add"                   => "أضف تقرير ( مسؤول المساحة )",
                "all"                   => "تقارير ( مسؤول المساحة )",
            ],
            "report_8" => [
                "add"                   => "أضف تقرير ( نموذج ٨ )",
                "all"                   => "تقارير ( نموذج ٨ )",
            ],
            "trainer" => [
                "all" => "تقارير المدربين"
            ]
        ]
    ]
];
