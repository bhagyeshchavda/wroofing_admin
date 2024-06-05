<?php
namespace App\Libraries;

use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;
use Input;

class Constant {

   public static function getUserType(){
      return [
         "admin" => "Admin",
      ];
   }

   public static function getMenuList(){
      return [
         'dashboard' => array(
            'value' => 'Dashboard', 
            'icon' => 'fa-tachometer-alt',
            'link' => route('home').'/admin/',
            'active_link' => array('admin'),
            'current_links' => array('admin','admin/dashboard/*'),
            'sub' => array()
         ), 
         'customer' => array(
            'value' => 'Customer List', 
            'icon' => 'fa-clipboard-list',
            'active_link' => array('admin/customer', 'admin/customer/create', 'admin/customer/*/edit'),
            'current_links' => array('admin/customer/*'),
            'link' => route('home').'/admin/customer',
            'sub' => array(
               // array(
               //    'value' => 'Add Customer', 
               //    'icon' => 'fa fa-user-plus',
               //    'link' => route('home').'/admin/customer/create',
               //    'active_link' => array('admin/customer/create', 'admin/customer/create'),
               // ),
               array(
                  'value' => 'Customer List', 
                  'icon' => 'fa-user',
                  'link' => route('home').'/admin/customer',
                  'active_link' => array('admin/customer', 'admin/customer', request()->is('admin/customer/*/edit')),
               ),
            ),
         ),
         'contractor' => array(
            'value' => 'Contractor List', 
            'icon' => 'fa-hard-hat',
            'active_link' => array('admin/contractor', 'admin/contractor/create', 'admin/contractor/*/edit'),
            'current_links' => array('admin/contractor/*'),
            'link' => route('home').'/admin/contractor',
            'sub' => array(
               // array(
               //    'value' => 'Add Contractor', 
               //    'icon' => 'fa fa-user-plus',
               //    'link' => route('home').'/admin/contractor/create',
               //    'active_link' => array('admin/contractor/create', 'admin/contractor/create'),
               // ),
               array(
                  'value' => 'Contractor List', 
                  'icon' => 'fa-user',
                  'link' => route('home').'/admin/contractor',
                  'active_link' => array('admin/contractor', 'admin/contractor', request()->is('admin/contractor/*/edit')),
               ),
            ),
         ),  
         // 'media' => array(
         //    'value' => 'Media', 
         //    'icon' => 'fas fa-photo-video',
         //    'link' => route('home').'/admin/media',
         //    'active_link' => array('admin/media'),
         //    'current_links' => array('admin/media','admin/media/*'),
         //    'sub' => array()
         // ),   
         'contacts' => array(
            'value' => 'Contacts', 
            'icon' => 'fas fa-phone',
            'active_link' => array('admin/contacts', 'admin/contacts', 'admin/contacts/*/edit', 'admin/post-type/contacts'),
            'current_links' => array('admin/contacts/*'),
            'link' => route('home').'/admin/contacts',
            'sub' => array(
               array(
                  'value' => 'All Contacts', 
                  'icon' => 'nav-icon fas fa-book',
                  'link' => route('home').'/admin/contacts',
                  'active_link' => array('admin/contacts', 'admin/contacts', request()->is('admin/post-type/contacts/*/edit')),
               ),
            ),
         ), 
         'user' => array(
            'value' => 'Admin Management', 
            'icon' => 'fa-users',
            'active_link' => array('admin/user', 'admin/user/create', 'admin/user/*/edit'),
            'current_links' => array('admin/user/*'),
            'link' => route('home').'/admin/user',
            'sub' => array(
               array(
                  'value' => 'Add Admin', 
                  'icon' => 'fa fa-user-plus',
                  'link' => route('home').'/admin/user/create',
                  'active_link' => array('admin/user/create', 'admin/user/create'),
               ),
               array(
                  'value' => 'Admin List', 
                  'icon' => 'fa-user',
                  'link' => route('home').'/admin/user',
                  'active_link' => array('admin/user', 'admin/user', request()->is('admin/user/*/edit')),
               ),
            ),
         ),
         'settings' => array(
            'value' => 'General Setting', 
            'icon' => 'fa fa-wrench',
            'active_link' => array('admin/setting', 'admin/setting'),
            'current_links' => array('admin/setting/*'),
            'link' => route('home').'/admin/setting',
         ),
      ];
   }

}
