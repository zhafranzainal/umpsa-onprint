<?php

return [
    'common' => [
        'actions' => 'Actions',
        'create' => 'Create',
        'edit' => 'Edit',
        'update' => 'Update',
        'new' => 'New',
        'cancel' => 'Cancel',
        'attach' => 'Attach',
        'detach' => 'Detach',
        'save' => 'Save',
        'delete' => 'Delete',
        'delete_selected' => 'Delete selected',
        'search' => 'Search...',
        'back' => 'Back to Index',
        'are_you_sure' => 'Are you sure?',
        'no_items_found' => 'No items found',
        'created' => 'Successfully created',
        'saved' => 'Saved successfully',
        'removed' => 'Successfully removed',
    ],

    'categories' => [
        'name' => 'Categories',
        'index_title' => 'Categories List',
        'new_title' => 'New Category',
        'create_title' => 'Create Category',
        'edit_title' => 'Edit Category',
        'show_title' => 'Show Category',
        'inputs' => [
            'name' => 'Name',
        ],
    ],

    'deliveries' => [
        'name' => 'Deliveries',
        'index_title' => 'Deliveries List',
        'new_title' => 'New Delivery',
        'create_title' => 'Create Delivery',
        'edit_title' => 'Edit Delivery',
        'show_title' => 'Show Delivery',
        'inputs' => [
            'transaction_id' => 'Transaction',
            'commission_fee' => 'Commission Fee',
            'delivered_date' => 'Delivered Date',
        ],
    ],

    'delivery_options' => [
        'name' => 'Delivery Options',
        'index_title' => 'DeliveryOptions List',
        'new_title' => 'New Delivery option',
        'create_title' => 'Create DeliveryOption',
        'edit_title' => 'Edit DeliveryOption',
        'show_title' => 'Show DeliveryOption',
        'inputs' => [
            'name' => 'Name',
            'price' => 'Price',
        ],
    ],

    'feedbacks' => [
        'name' => 'Feedbacks',
        'index_title' => 'Feedbacks List',
        'new_title' => 'New Feedback',
        'create_title' => 'Create Feedback',
        'edit_title' => 'Edit Feedback',
        'show_title' => 'Show Feedback',
        'inputs' => [
            'complaint_id' => 'Complaint',
            'description' => 'Description',
        ],
    ],

    'inventories' => [
        'name' => 'Inventories',
        'index_title' => 'Inventories List',
        'new_title' => 'New Inventory',
        'create_title' => 'Create Inventory',
        'edit_title' => 'Edit Inventory',
        'show_title' => 'Show Inventory',
        'inputs' => [
            'name' => 'Name',
        ],
    ],

    'outlets' => [
        'name' => 'Outlets',
        'index_title' => 'Outlets List',
        'new_title' => 'New Outlet',
        'create_title' => 'Create Outlet',
        'edit_title' => 'Edit Outlet',
        'show_title' => 'Show Outlet',
        'inputs' => [
            'campus_id' => 'Campus',
            'name' => 'Name',
        ],
    ],

    'packages' => [
        'name' => 'Packages',
        'index_title' => 'Packages List',
        'new_title' => 'New Package',
        'create_title' => 'Create Package',
        'edit_title' => 'Edit Package',
        'show_title' => 'Show Package',
        'inputs' => [
            'category_id' => 'Category',
            'name' => 'Name',
            'min_quantity' => 'Min Quantity',
            'price_rate' => 'Price Rate',
        ],
    ],

    'riders' => [
        'name' => 'Riders',
        'index_title' => 'Riders List',
        'new_title' => 'New Rider',
        'create_title' => 'Create Rider',
        'edit_title' => 'Edit Rider',
        'show_title' => 'Show Rider',
        'inputs' => [
            'user_id' => 'User',
            'total_commission' => 'Total Commission',
        ],
    ],

    'users' => [
        'name' => 'Users',
        'index_title' => 'Users List',
        'new_title' => 'New User',
        'create_title' => 'Create User',
        'edit_title' => 'Edit User',
        'show_title' => 'Show User',
        'inputs' => [
            'name' => 'Name',
            'email' => 'Email',
            'username' => 'Username',
            'password' => 'Password',
            'mobile_no' => 'Mobile No',
        ],
    ],

    'orders' => [
        'name' => 'Orders',
        'index_title' => 'Orders List',
        'new_title' => 'New Order',
        'create_title' => 'Create Order',
        'edit_title' => 'Edit Order',
        'show_title' => 'Show Order',
        'inputs' => [
            'outlet_id' => 'Outlet',
            'package_id' => 'Package',
            'delivery_option_id' => 'Delivery Option',
            'transaction_id' => 'Transaction',
            'document_file' => 'Document File',
            'quantity' => 'Quantity',
            'total_price' => 'Total Price',
            'point' => 'Point',
            'status' => 'Status',
            'qr_code' => 'Qr Code',
        ],
    ],

    'transactions' => [
        'name' => 'Transactions',
        'index_title' => 'Transactions List',
        'new_title' => 'New Transaction',
        'create_title' => 'Create Transaction',
        'edit_title' => 'Edit Transaction',
        'show_title' => 'Show Transaction',
        'inputs' => [
            'user_id' => 'User',
            'amount' => 'Amount',
            'status' => 'Status',
        ],
    ],

    'complaints' => [
        'name' => 'Complaints',
        'index_title' => 'Complaints List',
        'new_title' => 'New Complaint',
        'create_title' => 'Create Complaint',
        'edit_title' => 'Edit Complaint',
        'show_title' => 'Show Complaint',
        'inputs' => [
            'delivery_id' => 'Delivery',
            'description' => 'Description',
            'status' => 'Status',
        ],
    ],

    'roles' => [
        'name' => 'Roles',
        'index_title' => 'Roles List',
        'create_title' => 'Create Role',
        'edit_title' => 'Edit Role',
        'show_title' => 'Show Role',
        'inputs' => [
            'name' => 'Name',
        ],
    ],

    'permissions' => [
        'name' => 'Permissions',
        'index_title' => 'Permissions List',
        'create_title' => 'Create Permission',
        'edit_title' => 'Edit Permission',
        'show_title' => 'Show Permission',
        'inputs' => [
            'name' => 'Name',
        ],
    ],
];
