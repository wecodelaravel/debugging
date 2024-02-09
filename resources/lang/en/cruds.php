<?php

return [
    'userManagement' => [
        'title'          => 'User management',
        'title_singular' => 'User management',
    ],
    'permission' => [
        'title'          => 'Permissions',
        'title_singular' => 'Permission',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'role' => [
        'title'          => 'Roles',
        'title_singular' => 'Role',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'Title',
            'title_helper'       => ' ',
            'permissions'        => 'Permissions',
            'permissions_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'user' => [
        'title'          => 'Users',
        'title_singular' => 'User',
        'fields'         => [
            'id'                        => 'ID',
            'id_helper'                 => ' ',
            'name'                      => 'Name',
            'name_helper'               => ' ',
            'email'                     => 'Email',
            'email_helper'              => ' ',
            'email_verified_at'         => 'Email verified at',
            'email_verified_at_helper'  => ' ',
            'password'                  => 'Password',
            'password_helper'           => ' ',
            'roles'                     => 'Roles',
            'roles_helper'              => ' ',
            'remember_token'            => 'Remember Token',
            'remember_token_helper'     => ' ',
            'created_at'                => 'Created at',
            'created_at_helper'         => ' ',
            'updated_at'                => 'Updated at',
            'updated_at_helper'         => ' ',
            'deleted_at'                => 'Deleted at',
            'deleted_at_helper'         => ' ',
            'approved'                  => 'Approved',
            'approved_helper'           => ' ',
            'verified'                  => 'Verified',
            'verified_helper'           => ' ',
            'verified_at'               => 'Verified at',
            'verified_at_helper'        => ' ',
            'verification_token'        => 'Verification token',
            'verification_token_helper' => ' ',
        ],
    ],
    'productManagement' => [
        'title'          => 'Product Management',
        'title_singular' => 'Product Management',
    ],
    'productCategory' => [
        'title'          => 'Categories',
        'title_singular' => 'Category',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'name'               => 'Name',
            'name_helper'        => ' ',
            'description'        => 'Description',
            'description_helper' => ' ',
            'photo'              => 'Photo',
            'photo_helper'       => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated At',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted At',
            'deleted_at_helper'  => ' ',
            'published'          => 'Published',
            'published_helper'   => ' ',
            'slug'               => 'Slug',
            'slug_helper'        => ' ',
        ],
    ],
    'productTag' => [
        'title'          => 'Tags',
        'title_singular' => 'Tag',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => ' ',
        ],
    ],
    'product' => [
        'title'          => 'Products',
        'title_singular' => 'Product',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'name'                     => 'Name',
            'name_helper'              => ' ',
            'description'              => 'Description',
            'description_helper'       => ' ',
            'price'                    => 'Price',
            'price_helper'             => ' ',
            'category'                 => 'Categories',
            'category_helper'          => ' ',
            'tag'                      => 'Tags',
            'tag_helper'               => ' ',
            'photo'                    => 'Photo',
            'photo_helper'             => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated At',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted At',
            'deleted_at_helper'        => ' ',
            'additional_photos'        => 'Additional Photos',
            'additional_photos_helper' => ' ',
            'documents'                => 'Documents',
            'documents_helper'         => ' ',
            'msrp'                     => 'MSRP',
            'msrp_helper'              => ' ',
            'product_type'             => 'Product Type',
            'product_type_helper'      => ' ',
            'published'                => 'Published',
            'published_helper'         => ' ',
            'slug'                     => 'Slug',
            'slug_helper'              => ' ',
        ],
    ],
    'contentManagement' => [
        'title'          => 'Content management',
        'title_singular' => 'Content management',
    ],
    'contentCategory' => [
        'title'          => 'Categories',
        'title_singular' => 'Category',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'slug'              => 'Slug',
            'slug_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => ' ',
        ],
    ],
    'contentTag' => [
        'title'          => 'Tags',
        'title_singular' => 'Tag',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'slug'              => 'Slug',
            'slug_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => ' ',
        ],
    ],
    'contentPage' => [
        'title'          => 'Pages',
        'title_singular' => 'Page',
        'fields'         => [
            'id'                    => 'ID',
            'id_helper'             => ' ',
            'title'                 => 'Title',
            'title_helper'          => ' ',
            'category'              => 'Categories',
            'category_helper'       => ' ',
            'tag'                   => 'Tags',
            'tag_helper'            => ' ',
            'page_text'             => 'Full Text',
            'page_text_helper'      => ' ',
            'excerpt'               => 'Excerpt',
            'excerpt_helper'        => ' ',
            'featured_image'        => 'Featured Image',
            'featured_image_helper' => ' ',
            'created_at'            => 'Created at',
            'created_at_helper'     => ' ',
            'updated_at'            => 'Updated At',
            'updated_at_helper'     => ' ',
            'deleted_at'            => 'Deleted At',
            'deleted_at_helper'     => ' ',
            'published'             => 'Published',
            'published_helper'      => ' ',
            'slug'                  => 'Slug',
            'slug_helper'           => ' ',
        ],
    ],
    'productType' => [
        'title'          => 'Product Types',
        'title_singular' => 'Product Type',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'slug'              => 'Slug',
            'slug_helper'       => ' ',
            'photos'            => 'Photos',
            'photos_helper'     => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'published'         => 'Published',
            'published_helper'  => ' ',
        ],
    ],
    'staticSeo' => [
        'title'          => 'Static Seo',
        'title_singular' => 'Static Seo',
        'fields'         => [
            'id'                          => 'ID',
            'id_helper'                   => ' ',
            'page_name'                   => 'Page Name',
            'page_name_helper'            => ' ',
            'page_path'                   => 'Page Path',
            'page_path_helper'            => ' ',
            'meta_title'                  => 'Meta Title',
            'meta_title_helper'           => ' ',
            'facebook_title'              => 'Facebook Title',
            'facebook_title_helper'       => ' ',
            'twitter_title'               => 'Twitter Title',
            'twitter_title_helper'        => ' ',
            'content_type'                => 'Content Type',
            'content_type_helper'         => 'Please select the type of content to add seo to.',
            'json_ld_tag'                 => 'Json Ld Tag',
            'json_ld_tag_helper'          => 'Wrap you tag in script tags',
            'canonical'                   => 'Canonical',
            'canonical_helper'            => 'url()->current() is used.',
            'html_schema_1'               => 'Html Schema 1',
            'html_schema_1_helper'        => ' ',
            'html_schema_2'               => 'Html Schema 2',
            'html_schema_2_helper'        => ' ',
            'html_schema_3'               => 'Html Schema 3',
            'html_schema_3_helper'        => ' ',
            'body_schema'                 => 'Body Schema',
            'body_schema_helper'          => ' ',
            'facebook_description'        => 'Facebook Description',
            'facebook_description_helper' => ' ',
            'twitter_description'         => 'Twitter Description',
            'twitter_description_helper'  => ' ',
            'meta_description'            => 'Meta Description',
            'meta_description_helper'     => 'no Html only text',
            'open_graph_type'             => 'Open Graph Type',
            'open_graph_type_helper'      => ' ',
            'seo_image'                   => 'Seo Image',
            'seo_image_helper'            => ' ',
            'menu_name'                   => 'Menu Name',
            'menu_name_helper'            => ' ',
            'seo_image_url'               => 'Seo Image Url',
            'seo_image_url_helper'        => ' ',
            'noindex'                     => 'No Index',
            'noindex_helper'              => 'Disallow search engines from adding this page to their index, and therefore disallow them from showing it in their results.',
            'nofollow'                    => 'No Follow',
            'nofollow_helper'             => 'Tells the search engines robots not to ‘endorse’ (pass equity through) any links on the page. Note that this includes all links on the page, including, e.g., those in navigation elements, links to images or other resources, and so on.',
            'noimageindex'                => 'No Image  Index',
            'noimageindex_helper'         => 'Disallow search engines from indexing images on the page.',
            'noarchive'                   => 'No Archive',
            'noarchive_helper'            => 'Prevents the search engines from showing a cached copy of this page in their search results listings.',
            'nosnippet'                   => 'No Snippet',
            'nosnippet_helper'            => 'Prevents the search engines from showing a text or video snippet (i.e., a meta description) of this page in the search results, and prevents them from showing a cached copy of this page in their search results listings.',
            'created_at'                  => 'Created at',
            'created_at_helper'           => ' ',
            'updated_at'                  => 'Updated at',
            'updated_at_helper'           => ' ',
            'deleted_at'                  => 'Deleted at',
            'deleted_at_helper'           => ' ',
        ],
    ],
    'post' => [
        'title'          => 'Post',
        'title_singular' => 'Post',
        'fields'         => [
            'id'                    => 'ID',
            'id_helper'             => ' ',
            'published'             => 'Published',
            'published_helper'      => ' ',
            'title'                 => 'Title',
            'title_helper'          => ' ',
            'category'              => 'Categories',
            'category_helper'       => ' ',
            'tag'                   => 'Tags',
            'tag_helper'            => ' ',
            'page_text'             => 'Full Text',
            'page_text_helper'      => ' ',
            'excerpt'               => 'Excerpt',
            'excerpt_helper'        => ' ',
            'featured_image'        => 'Featured Image',
            'featured_image_helper' => ' ',
            'slug'                  => 'Slug',
            'slug_helper'           => ' ',
            'created_at'            => 'Created at',
            'created_at_helper'     => ' ',
            'updated_at'            => 'Updated At',
            'updated_at_helper'     => ' ',
            'deleted_at'            => 'Deleted At',
            'deleted_at_helper'     => ' ',
        ],
    ],
    'slider' => [
        'title'          => 'Sliders',
        'title_singular' => 'Slider',
        'fields'         => [
            'id'                             => 'ID',
            'id_helper'                      => ' ',
            'image'                          => 'Image',
            'image_helper'                   => ' ',
            'sub_title'                      => 'Sub Title',
            'sub_title_helper'               => ' ',
            'main_title'                     => 'Main Title',
            'main_title_helper'              => ' ',
            'sub_title_2'                    => 'Sub Title 2',
            'sub_title_2_helper'             => ' ',
            'slider_description'             => 'Slider Description',
            'slider_description_helper'      => ' ',
            'text_heading'                   => 'Text Heading',
            'text_heading_helper'            => ' ',
            'heading_1'                      => 'Heading 1',
            'heading_1_helper'               => ' ',
            'heading_2'                      => 'Heading 2',
            'heading_2_helper'               => ' ',
            'heading_3'                      => 'Heading 3',
            'heading_3_helper'               => ' ',
            'text'                           => 'Text',
            'text_helper'                    => ' ',
            'main_button_text'               => 'Main Button Text',
            'main_button_text_helper'        => ' ',
            'main_button_link'               => 'Main Button Link',
            'main_button_link_helper'        => ' ',
            'main_button_tab_index'          => 'Main Button Tab Index',
            'main_button_tab_index_helper'   => ' ',
            'second_button_text'             => 'Second Button Text',
            'second_button_text_helper'      => ' ',
            'second_button_link'             => 'Second Button Link',
            'second_button_link_helper'      => ' ',
            'second_button_tab_index'        => 'Second Button Tab Index',
            'second_button_tab_index_helper' => ' ',
            'created_at'                     => 'Created at',
            'created_at_helper'              => ' ',
            'updated_at'                     => 'Updated at',
            'updated_at_helper'              => ' ',
            'deleted_at'                     => 'Deleted at',
            'deleted_at_helper'              => ' ',
            'location'                       => 'Location',
            'location_helper'                => 'select what slider location to add image',
        ],
    ],
    'setting' => [
        'title'          => 'Site Settings',
        'title_singular' => 'Site Setting',
        'fields'         => [
            'id'                   => 'ID',
            'id_helper'            => ' ',
            'facebook_link'        => 'FaceBook Link',
            'facebook_link_helper' => ' ',
            'twitter_link'         => 'Twitter Link',
            'twitter_link_helper'  => ' ',
            'youtube_link'         => 'YouTube Link',
            'youtube_link_helper'  => ' ',
            'short_bio'            => 'Short Bio',
            'short_bio_helper'     => ' ',
            'phone'                => 'Phone',
            'phone_helper'         => ' ',
            'address'              => 'Address',
            'address_helper'       => ' ',
            'avatar'               => 'Avatar',
            'avatar_helper'        => ' ',
            'created_at'           => 'Created at',
            'created_at_helper'    => ' ',
            'updated_at'           => 'Updated at',
            'updated_at_helper'    => ' ',
            'deleted_at'           => 'Deleted at',
            'deleted_at_helper'    => ' ',
        ],
    ],
    'service' => [
        'title'          => 'Services',
        'title_singular' => 'Service',
        'fields'         => [
            'id'                   => 'ID',
            'id_helper'            => ' ',
            'published'            => 'Published',
            'published_helper'     => ' ',
            'title'                => 'Title',
            'title_helper'         => ' ',
            'subtitle'             => 'Subtitle',
            'subtitle_helper'      => ' ',
            'intro'                => 'Intro',
            'intro_helper'         => ' ',
            'content'              => 'Content',
            'content_helper'       => ' ',
            'banner'               => 'Banner',
            'banner_helper'        => ' ',
            'service_photo'        => 'Service Photo',
            'service_photo_helper' => ' ',
            'created_at'           => 'Created at',
            'created_at_helper'    => ' ',
            'updated_at'           => 'Updated at',
            'updated_at_helper'    => ' ',
            'deleted_at'           => 'Deleted at',
            'deleted_at_helper'    => ' ',
        ],
    ],
    'testimonial' => [
        'title'          => 'Testimonials',
        'title_singular' => 'Testimonial',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'published'                => 'Published',
            'published_helper'         => ' ',
            'title'                    => 'Title',
            'title_helper'             => ' ',
            'body'                     => 'Content',
            'body_helper'              => ' ',
            'website'                  => 'Website',
            'website_helper'           => ' ',
            'rating'                   => 'Rating',
            'rating_helper'            => 'between 1 and 5',
            'signiture'                => 'Signiture',
            'signiture_helper'         => ' ',
            'signiture_company'        => 'Signiture Company',
            'signiture_company_helper' => ' ',
            'photo'                    => 'Photo',
            'photo_helper'             => ' ',
            'button_link'              => 'Button Link',
            'button_link_helper'       => ' ',
            'button_text'              => 'Button Text',
            'button_text_helper'       => ' ',
            'slug'                     => 'Slug',
            'slug_helper'              => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
        ],
    ],
    'faqManagement' => [
        'title'          => 'FAQ Management',
        'title_singular' => 'FAQ Management',
    ],
    'faqCategory' => [
        'title'          => 'Categories',
        'title_singular' => 'Category',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'category'          => 'Category',
            'category_helper'   => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => ' ',
        ],
    ],
    'faqQuestion' => [
        'title'          => 'Questions',
        'title_singular' => 'Question',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'category'          => 'Category',
            'category_helper'   => ' ',
            'question'          => 'Question',
            'question_helper'   => ' ',
            'answer'            => 'Answer',
            'answer_helper'     => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => ' ',
        ],
    ],
    'successStory' => [
        'title'          => 'Success Stories',
        'title_singular' => 'Success Story',
        'fields'         => [
            'id'                   => 'ID',
            'id_helper'            => ' ',
            'title'                => 'Title',
            'title_helper'         => ' ',
            'story_about'          => 'Story About',
            'story_about_helper'   => ' ',
            'story'                => 'Story',
            'story_helper'         => ' ',
            'before'               => 'Before',
            'before_helper'        => 'Used as Before image',
            'after'                => 'After',
            'after_helper'         => 'Used as After image',
            'combined'             => 'Combined',
            'combined_helper'      => 'If image is already combined with before and after images.',
            'services_used'        => 'Services Used',
            'services_used_helper' => ' ',
            'created_at'           => 'Created at',
            'created_at_helper'    => ' ',
            'updated_at'           => 'Updated at',
            'updated_at_helper'    => ' ',
            'deleted_at'           => 'Deleted at',
            'deleted_at_helper'    => ' ',
        ],
    ],
    'pageSection' => [
        'title'          => 'Page Sections',
        'title_singular' => 'Page Section',
        'fields'         => [
            'id'                             => 'ID',
            'id_helper'                      => ' ',
            'published'                      => 'Published',
            'published_helper'               => ' ',
            'section_title'                  => 'Section Title',
            'section_title_helper'           => ' ',
            'section'                        => 'Section',
            'section_helper'                 => ' ',
            'section_nickname'               => 'Section Nickname',
            'section_nickname_helper'        => ' ',
            'order'                          => 'Order',
            'order_helper'                   => ' ',
            'css'                            => 'Section CSS',
            'css_helper'                     => 'add any css you want added to the  page for the section',
            'js'                             => 'Section Js',
            'js_helper'                      => 'add your js code for the section here.',
            'cdn_css'                        => 'CDN CSS',
            'cdn_css_helper'                 => 'Add your external cdn links here to be added to the head of the page',
            'cdn_js'                         => 'CDN Scripts',
            'cdn_js_helper'                  => ' ',
            'use_editor'                     => 'Use Editor',
            'use_editor_helper'              => ' ',
            'default_section_classes'        => 'Default Section Classes',
            'default_section_classes_helper' => 'These classes match the theme used.',
            'created_at'                     => 'Created at',
            'created_at_helper'              => ' ',
            'updated_at'                     => 'Updated at',
            'updated_at_helper'              => ' ',
            'deleted_at'                     => 'Deleted at',
            'deleted_at_helper'              => ' ',
            'custom_class'                   => 'Custom Class',
            'custom_class_helper'            => ' ',
        ],
    ],

];
