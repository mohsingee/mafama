@extends('layouts.main') @section("content")
<style>
    .add-opt-icon .icon + span, .chat-option-link .icon + span, .chat-members-link .icon + span, .contacts-add-link .icon + span, .add-opt-icon .icon + div, .chat-option-link .icon + div, .chat-members-link .icon + div, .contacts-add-link .icon + div { margin-left: 0.75rem; }
    .chat-item { position: relative; border-radius: 4px; transition: background-color .3s; }
    .chat-item:hover { background-color: #ebeef2; }
    .chats-dropdown .chat-item:hover { background-color: #f5f6fa; }
    .chat-item:hover .chat-actions { opacity: 1; pointer-events: initial; transition: opacity .5s; }
    .chat-item.current { background-color: #f5f6fa; }
    .chat-item.current:hover { background-color: #ebeef2; }
    .chat-link { display: flex; align-items: center; width: 100%; padding: .75rem; cursor: pointer; }
   
    .chat-media + .chat-info { margin-left: 1rem; }
    .chat-info { width: calc(100% - 3.75rem); }
    .chat-from { display: flex; align-items: center; justify-content: space-between; }
    .chat-from .name { font-size: 0.9375rem; margin-bottom: 0; font-weight: 500; color: #526484; }
    .is-unread .chat-from .name { font-weight: 700; color: #364a63; }
    .chat-from .time { font-size: 12px; color: #8094ae; }
    .chat-context { display: flex; align-items: center; justify-content: space-between; }
    .chat-context .text { width: calc(100% - 2.5rem); white-space: nowrap; text-overflow: ellipsis; overflow: hidden; font-size: 13px; color: #8094ae; }
    .is-unread .chat-context .text { font-weight: 500; color: #526484; }
    .chat-context .status { display: flex; color: rgba(128, 148, 174, 0.8); }
    .is-unread .chat-context .status { color: #6576ff; }
    .chat-context .status.seen { color: #6576ff; }
    .chat-actions { background-color: #ebeef2; position: absolute; top: 0; bottom: 0; right: 0.75rem; opacity: 0; pointer-events: none; z-index: 2; display: flex; align-items: center; justify-content: flex-end; width: 3rem; }
    .chat-profile-group { border-top: 1px solid #e5e9f2; padding: .25rem 0; }
    .chat-profile-head { padding: 1.25rem 1.5rem; display: flex; align-items: center; justify-content: space-between; }
    .chat-profile-head .title { margin-bottom: 0; }
    .chat-profile-head .indicator-icon { display: inline-flex; }
    .chat-profile-head.collapsed .indicator-icon { transform: rotate(-180deg); }
    .chat-profile-body-inner { padding: 0 1.5rem 1.5rem; }
    .chat-profile-options { margin: -0.25rem; }
    .chat-profile-options li { padding: .25rem; }
    .chat-profile-settings { margin: -0.5rem; }
    .chat-profile-settings li { padding: .5rem; }
    .chat-profile-settings .custom-control-sm .custom-control-label { padding-left: 0.25rem; font-size: 13px; font-weight: 500; color: #526484; }
    .chat-profile-media { display: flex; margin: -0.25rem; }
    .chat-profile-media li { width: 33.33%; padding: 0.25rem; }
    .chat-profile-media li a { display: inline-block; }
    .chat-profile-media li img { border-radius: 4px; }
    .chat-option-link { display: flex; align-items: center; }
    .chat-option-link .lead-text { font-weight: 500; font-size: 13px; transition: color .3s; color: #526484; }
    .chat-option-link:hover .lead-text { color: #1c2b46; }
    .chat-members { margin: -0.375rem -.5rem; }
    .chat-members li { position: relative; }
    .chat-members-link { display: flex; align-items: center; padding: 0.375rem .5rem; }
    .chat-members .user-card { position: relative; padding: 0.375rem .5rem; border-radius: 3px; transition: background-color .3s; }
    .chat-members .user-card > a { width: 100%; display: flex; align-items: center; }
    .chat-members .user-card:hover { background-color: #ebeef2; }
    .chat-members .user-card:hover .user-actions { opacity: 1; pointer-events: initial; transition: opacity .5s; }
    .chat-members .user-role { margin-left: auto; font-size: 12px; color: #8094ae; }
    .chat-members .user-actions { position: absolute; top: 0; right: .25rem; bottom: 0; width: 3rem; background-color: #ebeef2; display: flex; align-items: center; justify-content: flex-end; opacity: 0; pointer-events: none; }
    .chat { display: flex; align-items: flex-end; margin: -4px; }
    .chat > div { padding: 4px; }
    .chat + .chat { padding-top: 0.5rem; }
    .chat-avatar { margin-bottom: 1.4rem; }
    .chat-avatar.no-meta { margin-bottom: 0; }
    .chat-bubble { display: flex; align-items: center; padding: .125rem 0; }
    .chat-bubble:hover .chat-msg-more { opacity: 1; }
    .chat-bubbles .attach-files { margin-top: .75rem; }
    .chat-msg { background-color: #fff; border-radius: 8px; padding: .5rem 1rem; }
    .chat-msg-more { display: flex; align-items: center; margin: 0 0.75rem; opacity: 0; flex-shrink: 0; transition: all .3s; }
    .chat-msg-more > li { padding: 0.25rem; }
    .chat-msg.is-light { background-color: #ebeef2; color: #526484; }
    .chat-msg.is-theme { background-color: #6576ff; color: #fff; }
    .chat-meta { display: flex; align-items: center; margin: .25rem -.375rem 0; }
    .chat-meta li { position: relative; padding: 0 .375rem; font-size: 12px; color: #8094ae; }
    .chat-meta li:not(:first-child):before { content: ""; font-family: "Nioicon"; position: absolute; left: 0; top: 50%; font-size: 11px; line-height: 10px; transform: translate(-50%, -50%); opacity: .8; }
    .chat-sap { overflow: hidden; text-align: center; padding: 1rem 0; }
    .chat-sap-meta { position: relative; display: inline-block; padding: 0 .75rem; color: #8094ae; font-size: 12px; line-height: 1.4; }
    .chat-sap-meta:before, .chat-sap-meta:after { position: absolute; height: 1px; background: #dbdfea; content: ''; width: 100vw; top: 50%; }
    .chat-sap-meta:before { right: 100%; }
    .chat-sap-meta:after { left: 100%; }
    .chat.is-you .chat-bubbles .attach-files { border-color: #fff; overflow: hidden; }
    .chat.is-you .chat-bubbles .attach-files, .chat.is-you .chat-bubbles .attach-foot { background-color: #fff; }
    .chat.is-you .chat-bubble:last-child .chat-msg { border-bottom-left-radius: 0; }
    .chat.is-you .chat-bubble:not(:first-child) .chat-msg { border-top-left-radius: 4px; }
    .chat.is-you .chat-bubble:not(:last-child) .chat-msg { border-bottom-left-radius: 4px; }
    .chat.is-me { justify-content: flex-end; }
    .chat.is-me .chat-msg { background-color: #6576ff; color: #fff; }
    .chat.is-me .chat-meta { justify-content: flex-end; }
    .chat.is-me .chat-bubble { flex-direction: row-reverse; }
    .chat.is-me .chat-bubbles .attach-files { border-color: #c4cefe; overflow: hidden; }
    .chat.is-me .chat-bubbles .attach-files, .chat.is-me .chat-bubbles .attach-foot { background-color: #fff; }
    .chat.is-me .chat-bubble:last-child .chat-msg { border-bottom-right-radius: 0; }
    .chat.is-me .chat-bubble:not(:first-child) .chat-msg { border-top-right-radius: 4px; }
    .chat.is-me .chat-bubble:not(:last-child) .chat-msg { border-bottom-right-radius: 4px; }
    .chat-upload-option { display: none; position: absolute; left: 100%; padding: 0.5rem; background-color: #fff; }
    .chat-upload-option.expanded { display: block; }
    .chat-upload-option ul { display: flex; align-items: center; }
    .chat-upload-option a { color: #6576ff; font-size: 1.25rem; height: 36px; width: 36px; display: inline-flex; align-items: center; justify-content: center; }
    .chat-upload-option a:hover { color: #3c52ff; }
    .fav-list { display: flex; margin: -0.375rem; overflow-x: auto; }
    .fav-list li { padding: 0.375rem; }
    .fav-list a:hover > .user-avatar:after { opacity: 1; }
    .fav-list .user-avatar { height: 44px; width: 44px; }
    .fav-list .user-avatar:after { content: ""; position: absolute; width: 100%; left: 0; height: 100%; background: #e5e9f2; transform: scale(1.15); opacity: 0; border-radius: 50%; z-index: -1; transition: opacity .3s; }
    @media (min-width: 768px) { .fav-list { flex-wrap: wrap; } }
    @media (max-width: 859px) { .fav-list { margin: -0.375rem 0; }
      .fav-list li:first-child { padding-left: 0; }
      .fav-list li:last-child { padding-right: 0; } }
    .channel-list li { margin: 0.125rem -0.5rem; }
    .channel-list a { padding: 0.375rem .5rem; display: block; transition: all .3s; font-weight: 500; color: #526484; border-radius: 3px; }
    .channel-list a:hover, .channel-list a.active { color: #6576ff; background: #eff1ff; }
    .contacts-list { margin: -0.375rem -.5rem; }
    .contacts-list + .contacts-list { margin-top: 1.75rem; }
    .contacts-list li { position: relative; }
    .contacts-list li > .title { padding-left: 1.25rem; margin-bottom: .25rem; }
    .contacts-list .user-card { position: relative; padding: 0.375rem .5rem; border-radius: 3px; transition: background-color .3s; }
    .contacts-list .user-card > a { width: 100%; display: flex; align-items: center; }
    .contacts-list .user-card:hover { background-color: #ebeef2; }
    .contacts-list .user-card:hover .user-actions { opacity: 1; pointer-events: initial; transition: opacity .4s; }
    .contacts-list .user-meta { margin-left: auto; font-size: 12px; color: #8094ae; }
    .contacts-list .user-actions { font-size: 12px; position: absolute; top: 0; right: .25rem; bottom: 0; width: 4.5rem; background-color: #ebeef2; display: flex; align-items: center; justify-content: flex-end; opacity: 0; pointer-events: none; }
    .contacts-list .user-actions > a { padding: 0 .375rem; }
    .contacts-add-link { padding: 0.375rem .5rem; display: flex; align-items: center; }
    .contacts-add-link .lead-text { font-weight: 500; font-size: 13px; }
    .nk-chat { position: relative; display: flex; overflow: hidden; min-height: calc(100vh - 65px); max-height: calc(100vh - 65px); background: #fff; }
    .nk-chat-blank { display: flex; align-items: center; justify-content: center; flex-direction: column; height: 100%; background-color: #ebeef2; }
    .nk-chat-blank-icon { margin-bottom: 1.5rem; }
    .nk-chat-boxed { border: 1px solid #dbdfea; border-radius: 4px; min-height: calc(100vh - (65px + 64px + 64px)); max-height: calc(100vh - (65px + 64px + 64px)); }
    .nk-chat-aside { background: #fff; width: 100%; overflow: hidden; max-height: 100%; position: relative; display: flex; flex-direction: column; flex-shrink: 0; }
    .nk-chat-boxed .nk-chat-aside { border-top-left-radius: 3px; border-bottom-left-radius: 3px; }
    .nk-chat-aside-head { display: flex; align-items: center; justify-content: space-between; padding: 1.125rem 1.25rem 0.875rem; }
    .nk-chat-aside-user .title { font-size: 1.375rem; color: #364a63; }
    .nk-chat-aside-user .user-avatar { height: 36px; width: 36px; }
    .nk-chat-aside-user .user-avatar + .title { margin-left: 1rem; }
    .nk-chat-aside-user .dropdown-toggle:after { font-size: 1.125rem; color: #8094ae; margin-left: 1rem; }
    .nk-chat-aside-tools { display: flex; align-items: center; }
    .nk-chat-aside-body { max-height: 100%; height: 100%; overflow: auto; }
    .nk-chat-aside-search { padding: 0 1.25rem; margin-bottom: 1.75rem; margin-top: 0.25rem; }
    .nk-chat-aside-search .form-control { background-color: #f5f6fa; border-color: #f5f6fa; }
    .nk-chat-aside-search .form-control::placeholder { color: #8094ae; }
    .nk-chat-aside-panel { padding: 0 1.25rem 1.75rem; }
    .nk-chat-aside-panel .title { margin-bottom: .75rem; }
    .nk-chat-list { padding: 0 0.5rem; }
    .nk-chat-list .title { margin-left: .75rem; }
    .nk-chat-body { background: #fff; position: absolute; top: 0; left: 0; right: 0; bottom: 0; flex-grow: 1; display: flex; flex-direction: column; overflow: hidden; transition: padding .3s ease-in-out; opacity: 0; pointer-events: none; z-index: 5; }
    .nk-chat-body.show-chat { opacity: 1; pointer-events: auto; }
    .nk-chat-head { position: relative; display: flex; align-items: center; justify-content: space-between; padding: 1rem 1.75rem; border-bottom: 1px solid #e5e9f2; background-color: #fff; }
    .nk-chat-head-info { width: 60%; }
    .nk-chat-head-info .user-avatar + .user-info { margin-left: 0.75rem; }
    .nk-chat-head-info .user-info .lead-text { display: block; text-overflow: ellipsis; overflow: hidden; white-space: nowrap; }
    .nk-chat-head-info, .nk-chat-head-tools { display: flex; align-items: center; margin: -0.125rem; }
    .nk-chat-head-info > li, .nk-chat-head-tools > li { padding: .125rem; }
    .nk-chat-head-info .btn-icon .icon, .nk-chat-head-tools .btn-icon .icon { font-size: 1.25rem; }
    .nk-chat-head-search { position: absolute; top: calc(100% + 1rem); left: 0; z-index: 9; width: 100%; padding: 0 1.75rem; opacity: 0; pointer-events: none; transform: translateY(-10px); transition: all .5s; }
    .nk-chat-head-search.show-search { opacity: 1; pointer-events: auto; transform: none; }
    .nk-chat-panel { background-color: rgba(235, 238, 242, 0.7); height: 100%; max-height: 100%; overflow: auto; padding: 1.25rem; }
    .nk-chat-editor { display: flex; align-items: center; padding: 1rem 1.25rem; background-color: #fff; }
    .nk-chat-editor-form { padding: 0 .5rem; flex-grow: 1; }
    .nk-chat-editor-form .form-control { min-height: 36px; padding-top: 0.5rem; }
    .nk-chat-editor-upload, .nk-chat-editor-tools { display: flex; align-items: center; }
    .nk-chat-editor-upload .btn-icon .icon, .nk-chat-editor-tools .btn-icon .icon { font-size: 1.5rem; }
    .nk-chat-editor-upload { position: relative; z-index: 2; }
    .nk-chat-editor-upload .toggle-opt { transition: .3s; }
    .nk-chat-editor-upload .toggle-opt.active { opacity: 0.7; transform: rotate(-45deg); }
    .nk-chat-profile { position: absolute; top: 0; right: 0; width: 325px; height: 100%; max-height: 100%; transform: translateX(100%); transition: transform .3s  ease-in-out; background: #fff; z-index: 100; }
    .nk-chat-profile-overlay { position: fixed; top: 0; right: 0; bottom: 0; left: 0; background: rgba(16, 25, 36, 0.4); z-index: 600; z-index: 90; animation: overlay-fade-in .4s ease 1; }
    .nk-chat-profile.visible { transform: none; }
    @media (max-width: 575.98px) { .nk-chat-boxed { border: none; border-radius: 4px; min-height: calc(100vh - (65px + 85px)); max-height: calc(100vh - (65px + 85px)); margin: -24px -18px; }
      .nk-chat-head { padding: 0.75rem 1.25rem; }
      .nk-chat-head-user { max-width: calc(100% - 34px); }
      .nk-chat-head-user .user-avatar { height: 36px; width: 36px; }
      .nk-chat-head-user .user-info { width: calc(100% - 36px - .75rem); } }
    @media (min-width: 576px) { .nk-chat-head-info, .nk-chat-head-tools { margin: -0.375rem; }
      .nk-chat-head-info > li, .nk-chat-head-tools > li { padding: .375rem; } }
    @media (min-width: 576px) and (max-width: 991px) { .nk-chat-aside-head, .nk-chat-aside-search { padding-left: 2.25rem; padding-right: 2.25rem; }
      .nk-chat-aside-panel { padding: 0 2.25rem 1.75rem; }
      .nk-chat-list { padding: 0 1.5rem; }
      .nk-chat-head, .nk-chat-panel, .nk-chat-editor { padding-left: 2.25rem; padding-right: 2.25rem; }
      .nk-chat-head-search { padding: 0 2.25rem; } }
    @media (min-width: 860px) { .nk-chat-aside { width: 320px; border-right: 1px solid #e5e9f2; }
      .nk-chat-body { position: static; opacity: 1; pointer-events: auto; }
      .nk-chat-body-close { display: none; } }
    @media (max-width: 859px) { .nk-chat-body.show-chat { position: fixed; z-index: 2999; }
      .nk-chat-head { padding-top: 0.75rem; padding-bottom: 0.75rem; } }
    @media (min-width: 860px) and (max-width: 991px) { .nk-chat-aside { width: 345px; border-right: 1px solid #e5e9f2; } }
    @media (min-width: 992px) { .nk-chat-aside-panel, .nk-chat-aside-head, .nk-chat-aside-search { padding-left: 1.75rem; padding-right: 1.75rem; }
      .nk-chat-list { padding: 0 1rem; }
      .nk-chat-aside { width: 325px; }
      .nk-chat-panel { padding: 1.25rem 1.75rem; }
      .chat-profile-head, .chat-profile-body-inner { padding-right: 1.75rem; padding-left: 1.75rem; } }
    @media (min-width: 1200px) { .nk-chat-body.profile-shown { padding-right: 325px; }
      .nk-chat-profile { border-left: 1px solid #e5e9f2; } }
    @media (min-width: 1540px) { .nk-chat-aside { width: 382px; }
      .nk-chat-body.profile-shown { padding-right: 365px; }
      .nk-chat-profile { width: 365px; } }
    @media (max-width: 1539.98px) { .profile-shown .nk-chat-profile-toggle { right: 262px; }
      .has-apps-sidebar .profile-shown .nk-chat-profile-toggle { right: -18px; } }
    .nk-header.is-light:not([class*=bg-]) {
        background: #1b5cc7;
    }
    .is-dark .nk-sidebar-head {
        border-color: #0d1ab7;
    }
    .nk-sidebar.is-dark {
        background: #1b5cc7;
        border-right-color: #4285f4;
    }
    .nk-menu-link {
        color: #fff;
        background-color: #3d76d5;
        border-radius: 10px;
    }
    .nk-menu-sub .nk-menu-link {
        color: #fff;
        background-color: #1b5cc7;
        border-radius: 10px;
    }
    .nk-menu-link:hover, .active > .nk-menu-link {
        color: #fff;
        background-color: #3d76d5;
        border-radius: 10px;
    }
    .btn-black
    {
      background-color:#000;
      color:#fff;
    }
    .col-md-5th {
        width: 20%;
        float: left;
    }
    .col-xs-5th, .col-sm-5th, .col-md-5th, .col-lg-5th {
        position: relative;
        min-height: 1px;
        padding-right: 10px;
        padding-left: 10px;
        width: 20%;
        float: left;
    }
    /* th, td {
        text-align: center;
    } */
    .red
    {
      color:red;
    }
    .green
    {
      color:green;
    }
    .fsize-20
    {
      font-size:20px !important;
    }
    .nk-chat-body.profile-shown {
        padding-right: 240px;
    }
    .nk-chat-profile {
        position: absolute;
        top: 0;
        right: 0;
        width: 240px;
    }
    .nk-chat-profile {
        border-left: 1px solid #da291c33;
        background-color: #fae3e2;
    }
    .nk-chat-aside {
        background: #fae3e2;
        border-right: 1px solid #da291c33;
    }

    .nk-chat-body {
        background:#fae3e2;
    }
    .nk-chat-editor {
        background-color: #fae3e2;
    }
    .nk-chat-aside-user .title {
        font-size: 1.875rem;
        color: #da291c;
    }
    .nk-chat-head {
        background-color: #da291c;
    }
    .bg-purple {
        background-color: #1b5cc7 !important;
    }
    .bg-purple span{
      color:#fff; !important;
    }
    .nk-chat-aside-head {
        background-color: #da291c;
      padding: 1.125rem 1.25rem 0.420rem;
      margin-bottom:10px;
    }
    .nk-chat-aside-head .title
    {
      color:#fff;
    }
    .pricing-table .nk-tb-col {
        position: relative;
        display: table-cell;
        vertical-align: middle;
        padding: .5rem .5rem;
    }
    .dataTable tr {
        white-space: inherit;
    }

    .user-avatar img, [class^="user-avatar"]:not([class*="-group"]) img {
        border-radius: 0% !important;
    }
    .img-tr th
    {
      vertical-align: middle;
        padding-top: 80px !important;
        padding-bottom: 80px !important;
        border: 1px solid #da291c85;
        text-align: center;
    }
    .img-tr span{
      font-size:16px;
    }
    tr, td {
        text-align: center;
    }

    .chat-from .name {
        font-size: 0.9375rem;
        margin-bottom: 0;
        font-weight: 500;
        color: #0c62fb;
    }
    .chat-context .text {
        width: calc(100% - 2.5rem);
        white-space: nowrap;
        text-overflow: ellipsis;
        overflow: hidden;
        font-size: 13px;
        color: #010d1d;
    }
    .overline-title-alt {
        font-family: Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif;
        font-weight: 700;
        line-height: 1.2;
        letter-spacing: 0.15em;
        font-size: 11px;
        color: #086bf3;
        text-transform: uppercase;
    }
    .chat-list
    {
      list-style:none;
      padding-left: 0px;
    }
    ul.nk-chat-head-info {
        list-style: none;
      padding-left: 0px;
      width: 100%;
    }
    .user-avatar, [class^="user-avatar"]:not([class*="-group"]) {
        color: #4285f4;
        background: #ffffff;
      border-radius: 50%;
        height: 40px;
        width: 40px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 14px;
        font-weight: 500;
        letter-spacing: 0.06em;
        flex-shrink: 0;
        position: relative;
    }
    .user-avatar + .user-info, [class^="user-avatar"]:not([class*="-group"]) + .user-info {
        margin-left: 1rem;
        color: #fff;
    }
    .nk-chat-head-info .user-info .lead-text {
        display: block;
        text-overflow: ellipsis;
        overflow: hidden;
        white-space: nowrap;
    }
    .nk-chat-head-info, .nk-chat-head-tools {
        display: flex;
        align-items: center;
    }
    .user-card {
        display: flex;
        align-items: center;
    }
    span.d-none.d-sm-inline.mr-1 {
        color: #fff;
    }
    .chat-media img{
      width:108px !important;
    }
    .chat-media {
        height: 108px;
        width: 108px;
        border-radius: 0%;
    }
    .nk-chat-aside-user .title {
        font-size: 3.2rem;
    }
    .btn-warning {
        color: #fff;
        background-color: #6309c6;
        border-color: #6309c6;
    }
    .btn-blue {
        color: #fff;
        background-color: #0c6ff7;
        border-color: #0c6ff7;
    }
    .color-td {
        height: 20px !important;
        width: 26px !important;
    }
    .imageThumb {
  max-height: 40px;
  border: 1px solid;
  padding: 1px;
  cursor: pointer;
}
.pip {
  display: inline-block;
  margin: 10px 10px 0 0;
}
.remove {
  display: block;
  background: #444;
  border: 1px solid black;
  color: white;
  text-align: center;
  cursor: pointer;
}
.remove:hover {
  background: white;
  color: black;
}

.chat-msg-reply {
    background: #dddddd73;
    font-size: 12px;
    padding: 2px;
}
.nk-chat-aside{background: rgb(247, 244, 255);}
.nk-chat-panel{background: rgb(247, 244, 255);}
.nk-chat-editor{background: rgb(247, 244, 255);}
.nk-chat-profile{background: rgb(247, 244, 255);}

 img#bannimg {
    width: 126px;
    height: 100px;
}
</style>
<section>
    <div class="container">
        <div class="row">
            <!-- tabs -->
            <!-- tabs content -->
            <div class="col-md-12 col-sm-12">
                <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                    <h4>Email Management / Chat</h4>
                </div>
                <div class="col-md-12 text-right margin-bottom-20">
                    <?php if($chat != "off"){ ?>
                    <a href="{{ url('chat') }}" class="btn btn-md btn-info margin-right-10">Chat</a>
                    <?php } ?>
                    <?php if($tools != "off"){ ?>
                    <a href="{{ url('tools') }}" class="btn btn-md btn-info margin-right-10">Tools</a>
                    <?php } ?>
                    <a href="{{ url('calender_meeting') }}" class="btn btn-md btn-info margin-right-10">Calender meetings / tasks</a>
                    <a href="{{ url()->previous() }}" class="btn btn-md btn-info">Back</a>
                </div>
                <div class="col-md-12">
                    <!--<ul class="nav nav-tabs nav-button-tabs nav-justified">
                  <li class="active"><a href="email_campaign.php" >Email Campaigns</a></li>
                  <li><a href="send_cards.php" >Send Card</a></li>
                  <li><a href="send_video.php" >Send Videos</a></li>
                  <li><a href="{{ url('chat') }}">Chat</a></li>
                  <li><a href="send_sms.php" >Send SMS</a></li>
                  
                </ul>
                <div class="tab-content margin-top-10"  style="">-->
                  <div class="row">
                    <div class="col-md-3">
                      <label><b>Chat Background color:</b></label>
                    </div>
                    <div class="col-md-9">
                      <ul style="list-style-type: none; padding: 0; margin: 0">
                        @foreach($colors as $color)<li class="color-td" style="background-color: {{ $color->color }}; display: inline-block;"></li>@endforeach</ul>
                    </div>
                  </div>
                    <div class="nk-chat">
                        <div class="nk-chat-aside">
                            <div class="nk-chat-aside-head">
                                <div class="nk-chat-aside-user" style="width: 100%;">
                                    <div class="dropdown" style="display: inline-flex; width: 100%;">
                                        <a href="">
                                            <div class="title">Chat Room</div>
                                        </a>
                                       
                                    </div>
                                </div>
                            </div>
                            <div class="nk-chat-aside-body" data-simplebar>
                              <form method="post" id="managechatform" enctype="multipart/form-data">  
                                    @csrf
                                    <input type="hidden" name="user_checked" id="user_checked"> 
                                <div class="nk-chat-list">
                                    <div style="display: inline-flex;">
                                    <label class="checkbox chk-sm" style="margin-right:8px;margin-top: 10px">
                                        <input type="checkbox" id="selectAll" value="1">
                                        <i></i>Select All
                                    </label>
                                        <div class="nk-chat-aside-search padding-0">
                                            <div class="form-group">
                                                <div class="form-control-wrap">
                                                    <div class="form-icon form-icon-left">
                                                        <em class="icon ni ni-search"></em>
                                                    </div>
                                                    <input type="text" class="form-control form-round" id="default-03" placeholder="Search by name" onkeyup="search_user(this.value)"  style="border-radius: 20px; height: 40px;" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <h6 class="title overline-title-alt">Messages</h6>
                                    <ul class="chat-list" >
                                       
                                      
                                    </ul>
                                    <!-- .chat-list -->
                                </div>
                                <!-- .nk-chat-list -->
                            </div>
                        </div>
                        <!-- .nk-chat-aside -->
                        <div class="nk-chat-body profile-shown ">
                            <div class="nk-chat-head" style="display: block; padding: 0px;">
                               
                   <div class="col-md-12" style="padding: 1rem 1.75rem;    height: 62px;">
                   <ul class="nk-chat-head-info">
                    <li class="nk-chat-body-close">
                        <a href="javascript:void(0)" class="btn btn-icon btn-trigger nk-chat-hide ml-n1"><em class="icon ni ni-arrow-left"></em></a>
                    </li>
                    <li class="nk-chat-head-user">
                        <div class="user-card">
                            <div class="user-avatar bg-purple">
                                <span><?=\App\Chat::short_name(Auth::user()->name);?></span>
                            </div>
                            <div class="user-info">
                                <div class="lead-text" style="color: #fff;"><?=Auth::user()->name;?></div>
                                <div class="sub-text">
                                    <span class="d-none d-sm-inline mr-1">Active </span>
                                     </div>
                            </div>
                        </div>
                    </li>
                </ul>
                     
                            </div>
                            <div class="col-md-12" style="padding: 0px;">
                             
                                @if(!empty($banner))
                                <img  src="{{ asset('public/videos/'.$banner->img) }}" style="width: 100%; height: 102px;" >
                                @endif
                            </div>



                            <div class="col-md-12"  style="padding: 0px;">

                                <div class="appndbanner">

                                    <div class="user_banner1"><table cellpadding="0" cellspacing="0" class="style1" style="width: 100%;margin-bottom:0px;"><tbody><tr><td id="ctl00_ucBanner1_td_banner" style="width: 100%;"><table border="0" cellspacing="0" cellpadding="0" style="width: 100%;"><tbody><tr><td style="vertical-align: top;"><table border="0" cellpadding="0" cellspacing="0" style="width: 100%;"><tbody><tr><td style="text-align: left; vertical-align: top;"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td class="Slogan" style="text-align: center; vertical-align: top; height: 30px; padding-bottom: 5px; padding-top: 5px;"><div class="business_name1" style="font-weight: bold; font-size: 10px; color: rgb(255, 255, 170);"><?php if($affiliate_banner->business_name != ""){ echo $affiliate_banner->business_name; } else{ echo $affiliate_details->company; ?>  <?php } ?></div></td></tr><tr><td style="text-align: center; vertical-align: top; padding-left: 10px; padding-right: 10px;">
                                        <div class="description" style="min-height: 20px; padding: 0px;"><?php if($affiliate_banner->message != ""){ echo $affiliate_banner->message; }?></div>
                                        </td></tr><tr><td class="Heading" style="padding-left: 10px; padding-right: 10px; padding-bottom: 5px; padding-top: 5px;">
                                            <div class="phone_no1"><?php if($affiliate_banner->phone_no != ""){ ?>Phone No:  <?= $affiliate_banner->phone_no; ?><?php } else{ ?><b>Phone No: </b> <?= $affiliate_details->business_telephone; ?><?php } ?></div>
                                            <div class="address1"><?php if($affiliate_banner->phone_no != ""){ ?>Address: <?= $affiliate_banner->address; ?><?php } else{ ?><b>Address: </b> <?= $affiliate_details->billing_address ?>, <?= $affiliate_details->billing_city ?> <?= $affiliate_details->zip_code; ?><?php } ?></div>
                                            <div class="web_address1"><?php if($affiliate_banner->web_address != ""){ ?><b>Web Address: </b> <?= $affiliate_banner->web_address; ?><?php } ?></div></td></tr></tbody></table></td><td style="">
                                                <img id="bannimg" src="<?php if($affiliate_banner->img != ""){ ?>{{ asset('public/videos') }}/<?= $affiliate_banner->img ?><?php }else{?>{{ asset('public/images/affiliates') }}/<?= $affiliate_details->image ?> <?php } ?>"  style="border: 2px solid white;   padding: 2px; border-radius: 12px; margin: 10px;"></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></div>

                                    



                                </div>

                            </div>


                            </div>
                            <!-- .nk-chat-head -->
                            <div class="nk-chat-panel chat_history"  id="chat_history" data-simplebar>
                              
                            </div>
                            <!-- .nk-chat-panel -->
                           
                            <div class="nk-chat-editor">
                                <div class="nk-chat-editor-form">
                                    <div class="form-control-wrap">
                                       <!--  <textarea class="form-control form-control-simple no-resize write_msg" rows="1" name="chat_message" id="default-textarea" placeholder="Type your message..." style="padding-left: 10px; padding-right: 10px;"></textarea> -->
                                       <div id="reply-msg"></div>
                                        <div id="chat_message" contenteditable="true" class="form-control form-control-simple no-resize write_msg" style="padding-left: 10px; padding-right: 10px;">
                                         </div>
                                        <div class="attach-sec" style="padding-top: 10px;">
                                            <ul class="" style="float: right; display: flex; list-style: none;">
                                                <li style="margin-right: 10px;">
                                                    <a href="javascript:void(0);" title="Upload Photo" onclick="$('input[id=my_file]').click();"><i style="font-size: 18px;" class="fa fa-image "></i></a> <input type="file" id="my_file" name="file" style="display: none;" accept="image/*" />
                                                </li>
                                               <li style="margin-right: 10px;">
                                                    <a href="javascript:void(0);" title="Upload Video" onclick="$('input[id=my_file1]').click();"><i style="font-size: 18px;" class="fa fa-camera "></i></a><input type="file" id="my_file1" name="video_link" style="display: none;" accept="video/*" />
                                                </li> 
                                                <!-- <li style="margin-right: 10px;">
                                                    <a href="#"><i style="font-size: 18px;" class="fa fa-microphone"></i></a>
                                                </li>
                                                <li style="margin-right: 10px;">
                                                    <a href="#"><em style="font-size: 18px;" class="fa fa-arrows-alt"></em></a>
                                                </li> -->
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                 <input type="hidden" name="to_user_id" id="to_user_id" >
                                 <input type="hidden" name="msg_id" id="msg_id" >
                                 <input type="hidden" name="reply_uid" id="reply_uid" >
                                <ul class="nk-chat-editor-tools g-2 " style="margin-top: -30px !important; list-style: none;">
                                    <li>
                                        <button type="submit" class="btn btn-round btn-blue btn-icon"><i class="fa fa-send-o"></i></button>
                                    </li>
                                </ul>
                            </div>
                            </form>
                            <div class="nk-chat-profile visible"   data-simplebar>
                                <div class="simplebar-wrapper" style="margin: 0px;">
                                    <div class="simplebar-height-auto-observer-wrapper">
                                        <div class="simplebar-height-auto-observer"></div>
                                    </div>
                                    <div class="simplebar-mask">
                                        <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                            <div class="simplebar-content-wrapper" >
                                                <div class="simplebar-content" style="padding: 0px;">
                                                    <div class="nk-chat-aside-head">
                                                        <div class="nk-chat-aside-user" style="height: 45px;">
                                                        </div>
                                                    </div>
                                                    <div class="user-card user-card-s2" >
                                                        <div class="col-md-12">
                                                            <button type="button" class="btn btn-sm btn-info margin-right-10
                                                            videos-btn">Videos</button>
                                                            <button type="button" class="btn btn-sm btn-info margin-right-10 attachments-btn">Attachments</button>
                                                            <br/>
                                                            <br/>
                                                            <div class="videos-attachments" style="overflow-y: scroll;height: 400px;">
                                                                <div  class="col-md-12" id="videos" class="videos">
                                                                    @forelse($videos as $values1)
                                                                    <div>
                                                                        @if($values->video_link!='')
                                                                        <video width="150" height="150" controls><source src="{{asset('public/videos/'.$values1->video_link)}}" type="video/mp4"></video><br />
                                                                        @endif
                                                                    </div><br />        
                                                                    @empty
                                                                        <div>No attachments found!</div>
                                                                    @endforelse
                                                                    
                                                                </div>
                                                                <div  class="col-md-12" id="attachments"  class="attachments">
                                                                    @forelse($attachments as $values)
                                                                    <div>
                                                                        @if($values->attachment!='')
                                                                        <img src="{{asset('public/images/'.$values->attachment)}}" class="img-thumbnail" width="150" height="150" /><br />
                                                                        @endif
                                                                    </div><br />
                                                                    @empty
                                                                        <div>No videos found!</div>
                                                                    @endforelse
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="simplebar-placeholder" style="width: 324px; height: 749px;"></div>
                                </div>
                                <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                    <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                                </div>
                                <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                                    <div class="simplebar-scrollbar" style="height: 93px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">


     showColor();

    function showColor(){

        var back_color = $(".user_banner").css("background-color");

        // var back_color = "#fae3e2";

        var font_color = $(".user_banner").css("color");

        $(".user_banner1").css("background-color", back_color);

        $(".user_banner1").css("color", font_color);

        $(".business_name1").css("color", font_color);

        $(".phone_no1").css("color", font_color);

        $(".address1").css("color", font_color);

        $(".web_address1").css("color", font_color);

    }
    $("div#videos").show();
    $("div#attachments").hide();
    $(".videos-btn").on("click", function(){
        $("div#videos").show();
        $("div#attachments").hide();
    });
    $(".attachments-btn").on("click", function(){
        $("div#attachments").show();
        $("div#videos").hide();
    });
  $(document).on("click", ".color-td", function(){
     var bakg = $(this).css("background-color");
      $(".nk-chat-aside").css("background", bakg);
      $(".nk-chat-panel").css("background", bakg);
      $(".nk-chat-editor").css("background", bakg);
      $(".nk-chat-profile").css("background", bakg);
      // var classes = $(this).attr("class");

      // var bakg = classes.split('color-td ');
      // $(".nk-chat-aside").attr("class", "nk-chat-aside "+bakg[1]);
      // $(".nk-chat-panel").attr("class", "nk-chat-panel "+bakg[1]);
      // $(".nk-chat-editor").attr("class", "nk-chat-editor "+bakg[1]);
      // $(".nk-chat-profile").attr("class", "nk-chat-profile visible "+bakg[1]);
  });




</script>
@include('chat.chat_script')
@endsection
