<?php
return [
    "types" => [
        "other" => [
            "id" => 1,
            "input" => [
                [
                    "name" => "new_document_type",
                    "type" => "text",
                    "label" => "Loại tài liệu mới",
                    "placeholder" => "Nhập loại tài liệu mới",
                    "required" => true,
                ]
            ]
        ],
        "legal" => [
            "id" => 2,
            "other" => 1,
            "input" => [
                [
                    "name" => "id_type",
                    "type" => "select",
                    "label" => "Loại tài liệu",
                    "placeholder" => "Chọn loại tài liệu",
                    "required" => true,
                    "options" => []
                ],
                [
                    "name" => "doc_number",
                    "type" => "text",
                    "label" => "Số hiệu văn bản",
                    "placeholder" => "Nhập số hiệu văn bản",
                    "required" => true,
                ],
                [
                    "name" => "validity",
                    "type" => "date",
                    "label" => "Thời gian có hiệu lực",
                    "placeholder" => "",
                    "required" => true,
                ],
                [
                    "name" => "new_document_type",
                    "type" => "text",
                    "label" => "Loại tài liệu hợp pháp mới",
                    "placeholder" => "Nhập loại tài liệu hợp pháp mới",
                    "required" => true,
                ]
            ]
        ],

        "scientific_publication" => [
            "id" => 3,
            "other" => 1,
            "input" => [
                [
                    "name" => "id_type",
                    "type" => "select",
                    "label" => "Loại tài liệu",
                    "placeholder" => "Chọn loại tài liệu",
                    "required" => true,
                    "options" => []
                ],
                [
                    "name" => "year",
                    "type" => "text",
                    "label" => "Năm xuất bản",
                    "placeholder" => "",
                    "required" => true,
                ],
                [
                    "name" => "new_document_type",
                    "type" => "text",
                    "label" => "Loại tài liệu khoa học mới",
                    "placeholder" => "Nhập loại tài liệu khoa học mới",
                    "required" => true,
                ]
            ]
        ],

        "biodiversity" => [
            "id" => 4,
            "other" => 1,
            "input" => [
                [
                    "name" => "id_type",
                    "type" => "select",
                    "label" => "Loại tài liệu",
                    "placeholder" => "Chọn loại tài liệu",
                    "required" => true,
                    "options" => []
                ],
                [
                    "name" => "new_document_type",
                    "type" => "text",
                    "label" => "Loại tài liệu đa dạng sinh học mới",
                    "placeholder" => "Nhập loại tài liệu đa dạng sinh học mới",
                    "required" => true,
                ]
            ]
        ],

    ]
];
