<?php

return [

    // Titles
    'showing-all-comments'     => 'Showing All Comments',
    'products-menu-alt'        => 'Show comments Management Menu',
    'create-new-comment'       => 'Create New comment',
    'show-deleted-comments'    => 'Show Deleted comment',
    'editing-comment'          => 'Editing comment :name',
    'showing-comment'          => 'Showing comment :name',
    'showing-comment-title'    => ':name\'s Information',

    // Flash Messages
    'createSuccess'   => 'Successfully created comment! ',
    'updateSuccess'   => 'Successfully updated comment! ',
    'deleteSuccess'   => 'Successfully deleted comment! ',
    'deleteSelfError' => 'You cannot delete yourself! ',

    // Show product Tab
    'viewProfile'            => 'View Profile',
    'editcomment'               => 'Edit comment',
    'deletecomment'             => 'Delete comment',
    'commentsBackBtn'           => 'Back to comment',
    'commentsPanelTitle'        => 'comment Information',
    'label-content'          => 'Add comment to product',
    'labelEmail'             => 'Email:',
    'labelFirstName'         => 'First Name:',
    'labelLastName'          => 'Last Name:',
    'labelRole'              => 'Role:',
    'labelStatus'            => 'Status:',
    'labelAccessLevel'       => 'Access',
    'labelPermissions'       => 'Permissions:',
    'labelCreatedAt'         => 'Created At:',
    'labelUpdatedAt'         => 'Updated At:',
    'labelIpEmail'           => 'Email Signup IP:',
    'labelIpConfirm'         => 'Confirmation IP:',
    'labelIpSocial'          => 'Socialite Signup IP:',
    'labelIpAdmin'           => 'Admin Signup IP:',
    'labelIpUpdate'          => 'Last Update IP:',
    'labelDeletedAt'         => 'Deleted on',
    'labelIpDeleted'         => 'Deleted IP:',
    'productsDeletedPanelTitle' => 'Deleted product Information',
    'productsBackDelBtn'        => 'Back to Deleted products',

    'successRestore'    => 'product successfully restored.',
    'successDestroy'    => 'product record successfully destroyed.',
    'errorproductNotFound' => 'product not found.',

    'labelproductLevel'  => 'Level',
    'labelproductLevels' => 'Levels',

    'table' => [
        'caption'   => '{1} :productscount product total|[2,*] :productscount total products',
        'id'        => 'ID',
        'content'     => 'Content',
        'approved'     => 'Approve/Reject',
        'created'   => 'Created',
        'updated'   => 'Updated',
        'actions'   => 'Actions',
        'updated'   => 'Updated',
    ],

    'buttons' => [
        'create-new'    => 'New product',
        'delete'        => '<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>  <span class="hidden-xs hidden-sm">Delete</span><span class="hidden-xs hidden-sm hidden-md"> comment</span>',
        'show'          => '<i class="fa fa-eye fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Show</span><span class="hidden-xs hidden-sm hidden-md"> comment</span>',
        'edit'          => '<i class="fa fa-pencil fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Edit</span><span class="hidden-xs hidden-sm hidden-md"> comment</span>',
        'back-to-products' => '<span class="hidden-sm hidden-xs">Back to </span><span class="hidden-xs">products</span>',
        'back-to-product'  => 'Back  <span class="hidden-xs">to product</span>',
        'delete-product'   => '<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>  <span class="hidden-xs">Delete</span><span class="hidden-xs"> comment</span>',
        'edit-product'     => '<i class="fa fa-pencil fa-fw" aria-hidden="true"></i> <span class="hidden-xs">Edit</span><span class="hidden-xs"> comment</span>',
    ],

    'tooltips' => [
        'delete'        => 'Delete',
        'show'          => 'Show',
        'edit'          => 'Edit',
        'create-new'    => 'Create New product',
        'back-products'    => 'Back to products',
        'submit-search' => 'Submit products Search',
        'clear-search'  => 'Clear Search Results',
    ],

    'messages' => [
        'productNameRequired'       => 'name is required',
        'product-creation-success'  => 'Successfully created product!',
        'update-product-success'    => 'Successfully updated product!',
        'delete-success'         => 'Successfully deleted the product!',
        'cannot-delete-yourself' => 'You cannot delete yourself!',
    ],

    'show-comment' => [
        'id'                => 'Comment ID',
        'content'           => 'Content',
        'description'       => 'Description',
        'comments'          => 'Comments',
    ],

    'search'  => [
        'title'             => 'Showing Search Results',
        'found-footer'      => ' Record(s) found',
        'no-results'        => 'No Results',
        'search-products-ph'   => 'Search products',
    ],

    'modals' => [
        'delete_product_message' => 'Are you sure you want to delete :product?',
    ],
];
