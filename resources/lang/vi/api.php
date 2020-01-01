<?php

return [
    'manager'             => 'Quản lý API',
    'name'                => 'Tên',
    'name_help'           => 'Là tên trong router của API: route/api.php',
    'hidden_default'      => 'Trường ẩn mặc định',
    'hidden_default_help' => 'Ẩn các field này nếu "Loại Api" là "public"',
    'type'                => 'Loại Api',
    'type_help'           => 'private: chỉ sử dụng trên local, secrect: yêu cầu khóa bí mật, public: không yêu cầu bảo mật',
    'status'              => 'Trạng thái',
    'secret_key'          => 'Khóa bí mật',
    'hidden_fileds'       => 'Trường ẩn',
    'hidden_fileds_help'  => 'Ẩn các file này tương ứng với khóa bí mật.',
    'exp'                 => 'Hết hạn',
    'ip_allow'            => 'IPs allow',
    'ip_allow_help'       => 'Chỉ đồng ý những IP này. Ưu tiên cao hơn so với danh sách chặn.',
    'ip_deny'             => 'IPs deny',
    'created_at'          => 'Ngày tạo',
    'updated_at'          => 'Ngày cập nhật',
    'guide'               => 'Hướng dẫn sử dụng <a target=_new href="https://s-cart.org/guide/api.html?lang=vi">Ở ĐÂY</a>',
    'no_hidden'           => 'Không có trường ẩn',
    'no_secret'           => 'Không có khóa bí mật',

];
