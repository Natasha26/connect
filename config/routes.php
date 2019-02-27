<?php
return [
    ""                    => "home/index",
    "page404"             => "home/page404",
    "login"               => "home/login",
    "logout"              => "home/logout",
    
    "establishments"              => "establishment/list",
    "establishment/([0-9]+)"      => "establishment/view/$1",
    "establishment/edit/([0-9]+)" => "establishment/edit/$1",
    "establishment/add"          => "establishment/add",

    "departments"              => "department/list",
    "department/([0-9]+)"      => "department/view/$1",
    "department/edit/([0-9]+)" => "department/edit/$1",
    "department/add"          => "department/add", 
    
    "groups"              => "group/list",
    "group/([0-9]+)"      => "group/view/$1",
    "group/edit/([0-9]+)" => "group/edit/$1",
    "group/add"           => "group/add",   

    "users"                   => "user/list",
    "user/([0-9]+)"           => "user/view/$1",
    "user/edit/([0-9]+)"      => "user/edit/$1",
    "user/add"                => "user/add",
    "user/add/([0-9]+)"       => "user/add/$1"
];
