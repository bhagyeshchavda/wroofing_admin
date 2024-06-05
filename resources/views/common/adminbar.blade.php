@if (isset(Auth::user()->role))
    @if (Auth::user()->role == 'admin')
        <div id="bcc-adminbar">
            <div id="bccadminbar" class="nojq nojs">
                <div class="quicklinks" id="wp-toolbar" role="navigation" aria-label="Toolbar">
                    <ul id="wp-admin-bar-root-default" class="ab-top-menu">
                        <style>
                            img.avatar.avatar-26.photo {
                                width: 16px !important;
                                height: 16px !important;
                            }

                            #bcc-adminbar {
                                height: 32px
                            }

                            #bccadminbar * {
                                height: auto;
                                width: auto;
                                margin: 0;
                                padding: 0;
                                position: static;
                                text-shadow: none;
                                text-transform: none;
                                letter-spacing: normal;
                                font-size: 13px;
                                font-weight: 400;
                                font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
                                line-height: 2.46153846;
                                border-radius: 0;
                                box-sizing: content-box;
                                transition: none;
                                -webkit-font-smoothing: subpixel-antialiased;
                                -moz-osx-font-smoothing: auto
                            }

                            .rtl #bccadminbar * {
                                font-family: Tahoma, sans-serif
                            }

                            html:lang(he-il) .rtl #bccadminbar * {
                                font-family: Arial, sans-serif
                            }

                            #bccadminbar .ab-empty-item {
                                cursor: default
                            }

                            #bccadminbar .ab-empty-item,
                            #bccadminbar a.ab-item,
                            #bccadminbar>#wp-toolbar span.ab-label,
                            #bccadminbar>#wp-toolbar span.noticon {
                                color: #f0f0f1
                            }

                            #bccadminbar #wp-admin-bar-my-sites a.ab-item,
                            #bccadminbar #wp-admin-bar-site-name a.ab-item {
                                white-space: nowrap
                            }

                            #bccadminbar ul li:after,
                            #bccadminbar ul li:before {
                                content: normal
                            }

                            #bccadminbar a,
                            #bccadminbar a img,
                            #bccadminbar a img:hover,
                            #bccadminbar a:hover {
                                border: none;
                                text-decoration: none;
                                background: 0 0;
                                box-shadow: none
                            }

                            #bccadminbar a:active,
                            #bccadminbar a:focus,
                            #bccadminbar div,
                            #bccadminbar input[type=email],
                            #bccadminbar input[type=number],
                            #bccadminbar input[type=password],
                            #bccadminbar input[type=search],
                            #bccadminbar input[type=text],
                            #bccadminbar input[type=url],
                            #bccadminbar select,
                            #bccadminbar textarea {
                                box-shadow: none
                            }

                            #bccadminbar a:focus {
                                outline-offset: -1px
                            }

                            #bccadminbar {
                                direction: ltr;
                                color: #c3c4c7;
                                font-size: 13px;
                                font-weight: 400;
                                font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
                                line-height: 2.46153846;
                                height: 32px;
                                position: fixed;
                                top: 0;
                                left: 0;
                                width: 100%;
                                min-width: 600px;
                                z-index: 99999999;
                                background: #1d2327
                            }

                            #bccadminbar .ab-sub-wrapper,
                            #bccadminbar ul,
                            #bccadminbar ul li {
                                background: 0 0;
                                clear: none;
                                list-style: none;
                                margin: 0;
                                padding: 0;
                                position: relative;
                                text-indent: 0;
                                z-index: 99999
                            }

                            #bccadminbar ul#wp-admin-bar-root-default>li {
                                margin-right: 0
                            }

                            #bccadminbar .quicklinks ul {
                                text-align: left
                            }

                            #bccadminbar li {
                                float: left
                            }

                            #bccadminbar .ab-empty-item {
                                outline: 0
                            }

                            #bccadminbar .quicklinks .ab-top-secondary>li {
                                float: right
                            }

                            #bccadminbar .quicklinks .ab-empty-item,
                            #bccadminbar .quicklinks a,
                            #bccadminbar .shortlink-input {
                                height: 32px;
                                display: block;
                                padding: 0 10px;
                                margin: 0
                            }

                            #bccadminbar .quicklinks>ul>li>a {
                                padding: 0 8px 0 7px
                            }

                            #bccadminbar .menupop .ab-sub-wrapper,
                            #bccadminbar .shortlink-input {
                                margin: 0;
                                padding: 0;
                                box-shadow: 0 3px 5px rgba(0, 0, 0, .2);
                                background: #2c3338;
                                display: none;
                                position: absolute;
                                float: none
                            }

                            #bccadminbar .ab-top-menu>.menupop>.ab-sub-wrapper {
                                min-width: 100%
                            }

                            #bccadminbar .ab-top-secondary .menupop .ab-sub-wrapper {
                                right: 0;
                                left: auto
                            }

                            #bccadminbar .ab-submenu {
                                padding: 6px 0
                            }

                            #bccadminbar .selected .shortlink-input {
                                display: block
                            }

                            #bccadminbar .quicklinks .menupop ul li {
                                float: none
                            }

                            #bccadminbar .quicklinks .menupop ul li a strong {
                                font-weight: 600
                            }

                            #bccadminbar .quicklinks .menupop ul li .ab-item,
                            #bccadminbar .quicklinks .menupop ul li a strong,
                            #bccadminbar .quicklinks .menupop.hover ul li .ab-item,
                            #bccadminbar .shortlink-input,
                            #bccadminbar.nojs .quicklinks .menupop:hover ul li .ab-item {
                                line-height: 2;
                                height: 26px;
                                white-space: nowrap;
                                min-width: 140px
                            }

                            #bccadminbar .shortlink-input {
                                width: 200px
                            }

                            #bccadminbar li.hover>.ab-sub-wrapper,
                            #bccadminbar.nojs li:hover>.ab-sub-wrapper {
                                display: block
                            }

                            #bccadminbar .menupop li.hover>.ab-sub-wrapper,
                            #bccadminbar .menupop li:hover>.ab-sub-wrapper {
                                margin-left: 100%;
                                margin-top: -32px
                            }

                            #bccadminbar .ab-top-secondary .menupop li.hover>.ab-sub-wrapper,
                            #bccadminbar .ab-top-secondary .menupop li:hover>.ab-sub-wrapper {
                                margin-left: 0;
                                left: inherit;
                                right: 100%
                            }

                            #bccadminbar .ab-top-menu>li.hover>.ab-item,
                            #bccadminbar.nojq .quicklinks .ab-top-menu>li>.ab-item:focus,
                            #bccadminbar:not(.mobile) .ab-top-menu>li:hover>.ab-item,
                            #bccadminbar:not(.mobile) .ab-top-menu>li>.ab-item:focus {
                                background: #2c3338;
                                color: #72aee6
                            }

                            #bccadminbar:not(.mobile)>#wp-toolbar a:focus span.ab-label,
                            #bccadminbar:not(.mobile)>#wp-toolbar li:hover span.ab-label,
                            #bccadminbar>#wp-toolbar li.hover span.ab-label {
                                color: #72aee6
                            }

                            #bccadminbar .ab-icon,
                            #bccadminbar .ab-item:before,
                            #bccadminbar>#wp-toolbar>#wp-admin-bar-root-default .ab-icon,
                            .wp-admin-bar-arrow {
                                position: relative;
                                float: left;
                                font: normal 20px/1 dashicons;
                                speak: never;
                                padding: 4px 0;
                                -webkit-font-smoothing: antialiased;
                                -moz-osx-font-smoothing: grayscale;
                                background-image: none !important;
                                margin-right: 6px
                            }

                            #bccadminbar #adminbarsearch:before,
                            #bccadminbar .ab-icon:before,
                            #bccadminbar .ab-item:before {
                                color: #a7aaad;
                                color: rgba(240, 246, 252, .6)
                            }

                            #bccadminbar #adminbarsearch:before,
                            #bccadminbar .ab-icon:before,
                            #bccadminbar .ab-item:before {
                                position: relative;
                                transition: all .1s ease-in-out
                            }

                            #bccadminbar .ab-label {
                                display: inline-block;
                                height: 32px
                            }

                            #bccadminbar .ab-submenu .ab-item {
                                color: #c3c4c7;
                                color: rgba(240, 246, 252, .7)
                            }

                            #bccadminbar .quicklinks .menupop ul li a,
                            #bccadminbar .quicklinks .menupop ul li a strong,
                            #bccadminbar .quicklinks .menupop.hover ul li a,
                            #bccadminbar.nojs .quicklinks .menupop:hover ul li a {
                                color: #c3c4c7;
                                color: rgba(240, 246, 252, .7)
                            }

                            #bccadminbar .quicklinks .ab-sub-wrapper .menupop.hover>a,
                            #bccadminbar .quicklinks .menupop ul li a:focus,
                            #bccadminbar .quicklinks .menupop ul li a:focus strong,
                            #bccadminbar .quicklinks .menupop ul li a:hover,
                            #bccadminbar .quicklinks .menupop ul li a:hover strong,
                            #bccadminbar .quicklinks .menupop.hover ul li a:focus,
                            #bccadminbar .quicklinks .menupop.hover ul li a:hover,
                            #bccadminbar .quicklinks .menupop.hover ul li div[tabindex]:focus,
                            #bccadminbar .quicklinks .menupop.hover ul li div[tabindex]:hover,
                            #bccadminbar li #adminbarsearch.adminbar-focused:before,
                            #bccadminbar li .ab-item:focus .ab-icon:before,
                            #bccadminbar li .ab-item:focus:before,
                            #bccadminbar li a:focus .ab-icon:before,
                            #bccadminbar li.hover .ab-icon:before,
                            #bccadminbar li.hover .ab-item:before,
                            #bccadminbar li:hover #adminbarsearch:before,
                            #bccadminbar li:hover .ab-icon:before,
                            #bccadminbar li:hover .ab-item:before,
                            #bccadminbar.nojs .quicklinks .menupop:hover ul li a:focus,
                            #bccadminbar.nojs .quicklinks .menupop:hover ul li a:hover {
                                color: #72aee6
                            }

                            #bccadminbar.mobile .quicklinks .ab-icon:before,
                            #bccadminbar.mobile .quicklinks .ab-item:before {
                                color: #c3c4c7
                            }

                            #bccadminbar.mobile .quicklinks .hover .ab-icon:before,
                            #bccadminbar.mobile .quicklinks .hover .ab-item:before {
                                color: #72aee6
                            }

                            #bccadminbar .ab-top-secondary .menupop .menupop>.ab-item:before,
                            #bccadminbar .menupop .menupop>.ab-item .wp-admin-bar-arrow:before {
                                position: absolute;
                                font: normal 17px/1 dashicons;
                                speak: never;
                                -webkit-font-smoothing: antialiased;
                                -moz-osx-font-smoothing: grayscale
                            }

                            #bccadminbar .menupop .menupop>.ab-item {
                                display: block;
                                padding-right: 2em
                            }

                            #bccadminbar .menupop .menupop>.ab-item .wp-admin-bar-arrow:before {
                                top: 1px;
                                right: 10px;
                                padding: 4px 0;
                                color: inherit
                            }

                            #bccadminbar .ab-top-secondary .menupop .menupop>.ab-item {
                                padding-left: 2em;
                                padding-right: 1em
                            }

                            #bccadminbar .ab-top-secondary .menupop .menupop>.ab-item .wp-admin-bar-arrow:before {
                                top: 1px;
                                left: 6px
                            }

                            #bccadminbar .quicklinks .menupop ul.ab-sub-secondary {
                                display: block;
                                position: relative;
                                right: auto;
                                margin: 0;
                                box-shadow: none
                            }

                            #bccadminbar .quicklinks .menupop ul.ab-sub-secondary,
                            #bccadminbar .quicklinks .menupop ul.ab-sub-secondary .ab-submenu {
                                background: #3c434a
                            }

                            #bccadminbar .quicklinks .menupop .ab-sub-secondary>li .ab-item:focus a,
                            #bccadminbar .quicklinks .menupop .ab-sub-secondary>li>a:hover {
                                color: #72aee6
                            }

                            #bccadminbar .quicklinks a span#ab-updates {
                                background: #f0f0f1;
                                color: #2c3338;
                                display: inline;
                                padding: 2px 5px;
                                font-size: 10px;
                                font-weight: 600;
                                border-radius: 10px
                            }

                            #bccadminbar .quicklinks a:hover span#ab-updates {
                                background: #fff;
                                color: #000
                            }

                            #bccadminbar .ab-top-secondary {
                                float: right
                            }

                            #bccadminbar ul li:last-child,
                            #bccadminbar ul li:last-child .ab-item {
                                box-shadow: none
                            }

                            #bccadminbar #wp-admin-bar-recovery-mode {
                                color: #fff;
                                background-color: #d63638
                            }

                            #bccadminbar .ab-top-menu>#wp-admin-bar-recovery-mode.hover>.ab-item,
                            #bccadminbar.nojq .quicklinks .ab-top-menu>#wp-admin-bar-recovery-mode>.ab-item:focus,
                            #bccadminbar:not(.mobile) .ab-top-menu>#wp-admin-bar-recovery-mode:hover>.ab-item,
                            #bccadminbar:not(.mobile) .ab-top-menu>#wp-admin-bar-recovery-mode>.ab-item:focus {
                                color: #fff;
                                background-color: #d63638
                            }

                            #wp-admin-bar-my-account>ul {
                                min-width: 198px
                            }

                            #wp-admin-bar-my-account:not(.with-avatar)>.ab-item {
                                display: inline-block
                            }

                            #wp-admin-bar-my-account>.ab-item:before {
                                top: 2px;
                                float: right;
                                margin-left: 6px;
                                margin-right: 0
                            }

                            #wp-admin-bar-my-account.with-avatar>.ab-item:before {
                                display: none;
                                content: none
                            }

                            #wp-admin-bar-my-account.with-avatar>ul {
                                min-width: 270px
                            }

                            #bccadminbar #wp-admin-bar-user-actions>li {
                                margin-left: 16px;
                                margin-right: 16px
                            }

                            #bccadminbar #wp-admin-bar-user-actions.ab-submenu {
                                padding: 6px 0 12px
                            }

                            #bccadminbar #wp-admin-bar-my-account.with-avatar #wp-admin-bar-user-actions>li {
                                margin-left: 88px
                            }

                            #bccadminbar #wp-admin-bar-user-info {
                                margin-top: 6px;
                                margin-bottom: 15px;
                                height: auto;
                                background: 0 0
                            }

                            #wp-admin-bar-user-info .avatar {
                                position: absolute;
                                left: -72px;
                                top: 4px;
                                width: 64px;
                                height: 64px
                            }

                            #bccadminbar #wp-admin-bar-user-info a {
                                background: 0 0;
                                height: auto
                            }

                            #bccadminbar #wp-admin-bar-user-info span {
                                background: 0 0;
                                padding: 0;
                                height: 18px
                            }

                            #bccadminbar #wp-admin-bar-user-info .display-name,
                            #bccadminbar #wp-admin-bar-user-info .username {
                                display: block
                            }

                            #bccadminbar #wp-admin-bar-user-info .username {
                                color: #a7aaad;
                                font-size: 11px
                            }

                            #bccadminbar #wp-admin-bar-my-account.with-avatar>.ab-empty-item img,
                            #bccadminbar #wp-admin-bar-my-account.with-avatar>a img {
                                width: auto;
                                height: 16px;
                                padding: 0;
                                border: 1px solid #8c8f94;
                                background: #f0f0f1;
                                line-height: 1.84615384;
                                vertical-align: middle;
                                margin: -4px 0 0 6px;
                                float: none;
                                display: inline
                            }

                            #bccadminbar #wp-admin-bar-wp-logo>.ab-item .ab-icon {
                                width: 15px;
                                height: 20px;
                                margin-right: 0;
                                padding: 6px 0 5px
                            }

                            #bccadminbar #wp-admin-bar-wp-logo>.ab-item {
                                padding: 0 7px
                            }

                            #bccadminbar #wp-admin-bar-wp-logo>.ab-item .ab-icon:before {
                                top: 2px
                            }

                            #bccadminbar .quicklinks li .blavatar {
                                display: inline-block;
                                vertical-align: middle;
                                font: normal 16px/1 dashicons !important;
                                speak: never;
                                -webkit-font-smoothing: antialiased;
                                -moz-osx-font-smoothing: grayscale;
                                color: #f0f0f1
                            }

                            #bccadminbar .quicklinks .ab-sub-wrapper .menupop.hover>a .blavatar,
                            #bccadminbar .quicklinks li a:focus .blavatar,
                            #bccadminbar .quicklinks li a:hover .blavatar {
                                color: #72aee6
                            }

                            #bccadminbar .quicklinks li div.blavatar:before,
                            #bccadminbar .quicklinks li img.blavatar {
                                height: 16px;
                                width: 16px;
                                margin: 0 8px 2px -2px
                            }

                            #bccadminbar .quicklinks li div.blavatar:before {
                                display: inline-block
                            }

                            #bccadminbar #wp-admin-bar-appearance {
                                margin-top: -12px
                            }

                            #bccadminbar #wp-admin-bar-my-sites>.ab-item:before,
                            #bccadminbar #wp-admin-bar-site-name>.ab-item:before {
                                top: 2px
                            }

                            #bccadminbar #wp-admin-bar-customize>.ab-item:before {
                                top: 2px
                            }

                            #bccadminbar #wp-admin-bar-edit>.ab-item:before {
                                top: 2px
                            }

                            #bccadminbar #wp-admin-bar-comments .ab-icon {
                                margin-right: 6px
                            }

                            #bccadminbar #wp-admin-bar-comments .ab-icon:before {
                                top: 3px
                            }

                            #bccadminbar #wp-admin-bar-comments .count-0 {
                                opacity: .5
                            }

                            #bccadminbar #wp-admin-bar-new-content .ab-icon:before {
                                top: 4px
                            }

                            #bccadminbar #wp-admin-bar-updates .ab-icon:before {
                                top: 2px
                            }

                            #bccadminbar #wp-admin-bar-updates.spin .ab-icon:before {
                                display: inline-block;
                                animation: rotation 2s infinite linear
                            }

                            @media (prefers-reduced-motion:reduce) {
                                #bccadminbar #wp-admin-bar-updates.spin .ab-icon:before {
                                    animation: none
                                }
                            }

                            #bccadminbar #wp-admin-bar-search .ab-item {
                                padding: 0;
                                background: 0 0
                            }

                            #bccadminbar #adminbarsearch {
                                position: relative;
                                height: 32px;
                                padding: 0 2px;
                                z-index: 1
                            }

                            #bccadminbar #adminbarsearch:before {
                                position: absolute;
                                top: 6px;
                                left: 5px;
                                z-index: 20;
                                font: normal 20px/1 dashicons !important;
                                speak: never;
                                -webkit-font-smoothing: antialiased;
                                -moz-osx-font-smoothing: grayscale
                            }

                            #bccadminbar>#wp-toolbar>#wp-admin-bar-top-secondary>#wp-admin-bar-search #adminbarsearch input.adminbar-input {
                                display: inline-block;
                                float: none;
                                position: relative;
                                z-index: 30;
                                font-size: 13px;
                                font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
                                line-height: 1.84615384;
                                text-indent: 0;
                                height: 24px;
                                width: 24px;
                                max-width: none;
                                padding: 0 3px 0 24px;
                                margin: 0;
                                color: #c3c4c7;
                                background-color: rgba(255, 255, 255, 0);
                                border: none;
                                outline: 0;
                                cursor: pointer;
                                box-shadow: none;
                                box-sizing: border-box;
                                transition-duration: .4s;
                                transition-property: width, background;
                                transition-timing-function: ease
                            }

                            #bccadminbar>#wp-toolbar>#wp-admin-bar-top-secondary>#wp-admin-bar-search #adminbarsearch input.adminbar-input:focus {
                                z-index: 10;
                                color: #000;
                                width: 200px;
                                background-color: rgba(255, 255, 255, .9);
                                cursor: text;
                                border: 0
                            }

                            #bccadminbar #adminbarsearch .adminbar-button {
                                display: none
                            }

                            .customize-support #bccadminbar .hide-if-customize,
                            .customize-support .hide-if-customize,
                            .customize-support .wp-core-ui .hide-if-customize,
                            .customize-support.wp-core-ui .hide-if-customize,
                            .no-customize-support #bccadminbar .hide-if-no-customize,
                            .no-customize-support .hide-if-no-customize,
                            .no-customize-support .wp-core-ui .hide-if-no-customize,
                            .no-customize-support.wp-core-ui .hide-if-no-customize {
                                display: none
                            }

                            #bccadminbar .screen-reader-text,
                            #bccadminbar .screen-reader-text span {
                                border: 0;
                                clip: rect(1px, 1px, 1px, 1px);
                                -webkit-clip-path: inset(50%);
                                clip-path: inset(50%);
                                height: 1px;
                                margin: -1px;
                                overflow: hidden;
                                padding: 0;
                                position: absolute;
                                width: 1px;
                                word-wrap: normal !important
                            }

                            #bccadminbar .screen-reader-shortcut {
                                position: absolute;
                                top: -1000em
                            }

                            #bccadminbar .screen-reader-shortcut:focus {
                                left: 6px;
                                top: 7px;
                                height: auto;
                                width: auto;
                                display: block;
                                font-size: 14px;
                                font-weight: 600;
                                padding: 15px 23px 14px;
                                background: #f0f0f1;
                                color: #2271b1;
                                z-index: 100000;
                                line-height: normal;
                                text-decoration: none;
                                box-shadow: 0 0 2px 2px rgba(0, 0, 0, .6)
                            }

                            @media screen and (max-width:782px) {
                                html #bccadminbar {
                                    height: 46px;
                                    min-width: 240px
                                }

                                #bccadminbar * {
                                    font-size: 14px;
                                    font-weight: 400;
                                    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
                                    line-height: 2.28571428
                                }

                                #bccadminbar .quicklinks .ab-empty-item,
                                #bccadminbar .quicklinks>ul>li>a {
                                    padding: 0;
                                    height: 46px;
                                    line-height: 3.28571428;
                                    width: auto
                                }

                                #bccadminbar .ab-icon {
                                    font: 40px/1 dashicons !important;
                                    margin: 0;
                                    padding: 0;
                                    width: 52px;
                                    height: 46px;
                                    text-align: center
                                }

                                #bccadminbar .ab-icon:before {
                                    text-align: center
                                }

                                #bccadminbar .ab-submenu {
                                    padding: 0
                                }

                                #bccadminbar #wp-admin-bar-my-account a.ab-item,
                                #bccadminbar #wp-admin-bar-my-sites a.ab-item,
                                #bccadminbar #wp-admin-bar-site-name a.ab-item {
                                    text-overflow: clip
                                }

                                #bccadminbar .quicklinks .menupop ul li .ab-item,
                                #bccadminbar .quicklinks .menupop ul li a strong,
                                #bccadminbar .quicklinks .menupop.hover ul li .ab-item,
                                #bccadminbar .shortlink-input,
                                #bccadminbar.nojs .quicklinks .menupop:hover ul li .ab-item {
                                    line-height: 1.6
                                }

                                #bccadminbar .ab-label {
                                    display: none
                                }

                                #bccadminbar .menupop li.hover>.ab-sub-wrapper,
                                #bccadminbar .menupop li:hover>.ab-sub-wrapper {
                                    margin-top: -46px
                                }

                                #bccadminbar .ab-top-menu .menupop .ab-sub-wrapper .menupop>.ab-item {
                                    padding-right: 30px
                                }

                                #bccadminbar .menupop .menupop>.ab-item:before {
                                    top: 10px;
                                    right: 6px
                                }

                                #bccadminbar .ab-top-menu>.menupop>.ab-sub-wrapper .ab-item {
                                    font-size: 16px;
                                    padding: 8px 16px
                                }

                                #bccadminbar .ab-top-menu>.menupop>.ab-sub-wrapper a:empty {
                                    display: none
                                }

                                #bccadminbar #wp-admin-bar-wp-logo>.ab-item {
                                    padding: 0
                                }

                                #bccadminbar #wp-admin-bar-wp-logo>.ab-item .ab-icon {
                                    padding: 0;
                                    width: 52px;
                                    height: 46px;
                                    text-align: center;
                                    vertical-align: top
                                }

                                #bccadminbar #wp-admin-bar-wp-logo>.ab-item .ab-icon:before {
                                    font: 28px/1 dashicons !important;
                                    top: -3px
                                }

                                #bccadminbar .ab-icon,
                                #bccadminbar .ab-item:before {
                                    padding: 0
                                }

                                #bccadminbar #wp-admin-bar-customize>.ab-item,
                                #bccadminbar #wp-admin-bar-edit>.ab-item,
                                #bccadminbar #wp-admin-bar-my-account>.ab-item,
                                #bccadminbar #wp-admin-bar-my-sites>.ab-item,
                                #bccadminbar #wp-admin-bar-site-name>.ab-item {
                                    text-indent: 100%;
                                    white-space: nowrap;
                                    overflow: hidden;
                                    width: 52px;
                                    padding: 0;
                                    color: #a7aaad;
                                    position: relative
                                }

                                #bccadminbar .ab-icon,
                                #bccadminbar .ab-item:before,
                                #bccadminbar>#wp-toolbar>#wp-admin-bar-root-default .ab-icon {
                                    padding: 0;
                                    margin-right: 0
                                }

                                #bccadminbar #wp-admin-bar-customize>.ab-item:before,
                                #bccadminbar #wp-admin-bar-edit>.ab-item:before,
                                #bccadminbar #wp-admin-bar-my-account>.ab-item:before,
                                #bccadminbar #wp-admin-bar-my-sites>.ab-item:before,
                                #bccadminbar #wp-admin-bar-site-name>.ab-item:before {
                                    display: block;
                                    text-indent: 0;
                                    font: normal 32px/1 dashicons;
                                    speak: never;
                                    top: 7px;
                                    width: 52px;
                                    text-align: center;
                                    -webkit-font-smoothing: antialiased;
                                    -moz-osx-font-smoothing: grayscale
                                }

                                #bccadminbar #wp-admin-bar-appearance {
                                    margin-top: 0
                                }

                                #bccadminbar .quicklinks li .blavatar:before {
                                    display: none
                                }

                                #bccadminbar #wp-admin-bar-search {
                                    display: none
                                }

                                #bccadminbar #wp-admin-bar-new-content .ab-icon:before {
                                    top: 0;
                                    line-height: 1.33333333;
                                    height: 46px !important;
                                    text-align: center;
                                    width: 52px;
                                    display: block
                                }

                                #bccadminbar #wp-admin-bar-updates {
                                    text-align: center
                                }

                                #bccadminbar #wp-admin-bar-updates .ab-icon:before {
                                    top: 3px
                                }

                                #bccadminbar #wp-admin-bar-comments .ab-icon {
                                    margin: 0
                                }

                                #bccadminbar #wp-admin-bar-comments .ab-icon:before {
                                    display: block;
                                    font-size: 34px;
                                    height: 46px;
                                    line-height: 1.38235294;
                                    top: 0
                                }

                                #bccadminbar #wp-admin-bar-my-account>a {
                                    position: relative;
                                    white-space: nowrap;
                                    text-indent: 150%;
                                    width: 28px;
                                    padding: 0 10px;
                                    overflow: hidden
                                }

                                #bccadminbar .quicklinks li#wp-admin-bar-my-account.with-avatar>a img {
                                    position: absolute;
                                    top: 13px;
                                    right: 10px;
                                    width: 26px;
                                    height: 26px
                                }

                                #bccadminbar #wp-admin-bar-user-actions.ab-submenu {
                                    padding: 0
                                }

                                #bccadminbar #wp-admin-bar-user-actions.ab-submenu img.avatar {
                                    display: none
                                }

                                #bccadminbar #wp-admin-bar-my-account.with-avatar #wp-admin-bar-user-actions>li {
                                    margin: 0
                                }

                                #bccadminbar #wp-admin-bar-user-info .display-name {
                                    height: auto;
                                    font-size: 16px;
                                    line-height: 1.5;
                                    color: #f0f0f1
                                }

                                #bccadminbar #wp-admin-bar-user-info a {
                                    padding-top: 4px
                                }

                                #bccadminbar #wp-admin-bar-user-info .username {
                                    line-height: .8 !important;
                                    margin-bottom: -2px
                                }

                                #wp-toolbar>ul>li {
                                    display: none
                                }

                                #bccadminbar li#wp-admin-bar-comments,
                                #bccadminbar li#wp-admin-bar-customize,
                                #bccadminbar li#wp-admin-bar-edit,
                                #bccadminbar li#wp-admin-bar-menu-toggle,
                                #bccadminbar li#wp-admin-bar-my-account,
                                #bccadminbar li#wp-admin-bar-my-sites,
                                #bccadminbar li#wp-admin-bar-new-content,
                                #bccadminbar li#wp-admin-bar-site-name,
                                #bccadminbar li#wp-admin-bar-updates,
                                #bccadminbar li#wp-admin-bar-wp-logo {
                                    display: block
                                }

                                #bccadminbar li.hover ul li,
                                #bccadminbar li:hover ul li,
                                #bccadminbar li:hover ul li:hover ul li {
                                    display: list-item
                                }

                                #bccadminbar .ab-top-menu>.menupop>.ab-sub-wrapper {
                                    min-width: -moz-fit-content;
                                    min-width: fit-content
                                }

                                #bccadminbar ul#wp-admin-bar-root-default>li {
                                    margin-right: 0
                                }

                                #bccadminbar #wp-admin-bar-comments,
                                #bccadminbar #wp-admin-bar-edit,
                                #bccadminbar #wp-admin-bar-my-account,
                                #bccadminbar #wp-admin-bar-my-sites,
                                #bccadminbar #wp-admin-bar-new-content,
                                #bccadminbar #wp-admin-bar-site-name,
                                #bccadminbar #wp-admin-bar-updates,
                                #bccadminbar #wp-admin-bar-wp-logo,
                                #bccadminbar .ab-top-menu,
                                #bccadminbar .ab-top-secondary {
                                    position: static
                                }

                                #bccadminbar #wp-admin-bar-my-account {
                                    float: right
                                }

                                .network-admin #bccadminbar ul#wp-admin-bar-top-secondary>li#wp-admin-bar-my-account {
                                    margin-right: 0
                                }

                                #bccadminbar .ab-top-secondary .menupop .menupop>.ab-item:before {
                                    top: 10px;
                                    left: 0
                                }
                            }

                            @media screen and (max-width:600px) {
                                #bccadminbar {
                                    position: absolute
                                }

                                #wp-responsive-overlay {
                                    position: fixed;
                                    top: 0;
                                    left: 0;
                                    width: 100%;
                                    height: 100%;
                                    z-index: 400
                                }

                                #bccadminbar .ab-top-menu>.menupop>.ab-sub-wrapper {
                                    width: 100%;
                                    left: 0
                                }

                                #bccadminbar .menupop .menupop>.ab-item:before {
                                    display: none
                                }

                                #bccadminbar #wp-admin-bar-wp-logo.menupop .ab-sub-wrapper {
                                    margin-left: 0
                                }

                                #bccadminbar .ab-top-menu>.menupop li>.ab-sub-wrapper {
                                    margin: 0;
                                    width: 100%;
                                    top: auto;
                                    left: auto;
                                    position: relative
                                }

                                #bccadminbar .ab-top-menu>.menupop li>.ab-sub-wrapper .ab-item {
                                    font-size: 16px;
                                    padding: 6px 15px 19px 30px
                                }

                                #bccadminbar li:hover ul li ul li {
                                    display: list-item
                                }

                                #bccadminbar li#wp-admin-bar-updates,
                                #bccadminbar li#wp-admin-bar-wp-logo {
                                    display: none
                                }

                                #bccadminbar .ab-top-menu>.menupop li>.ab-sub-wrapper {
                                    position: static;
                                    box-shadow: none
                                }
                            }

                            @media screen and (max-width:400px) {
                                #bccadminbar li#wp-admin-bar-comments {
                                    display: none
                                }
                            }

                            #wp-admin-bar-edit img.editpage {
                                width: 25px;
                                height: 15px;
                                margin-top: -3px;
                                margin-right: -5px;
                            }
                        </style>


                        <li id="wp-admin-bar-my-sites" class="menupop">
                            <a class="ab-item" aria-haspopup="true" href="#">{{ trans('My Sites') }}</a>
                            <div class="ab-sub-wrapper">
                                <ul id="wp-admin-bar-blog-1-default" class="ab-submenu">
                                    <li id="wp-admin-bar-blog-1-d"><a class="ab-item" href="{{ route('admin.home') }}"
                                            data-turbolinks="false">{{ trans('Dashboard') }}</a>
                                    </li>
                                    <li id="wp-admin-bar-blog-1-n"><a class="ab-item"
                                            href="{{ route('post-type.posts') }}"
                                            data-turbolinks="false">{{ trans('New Post') }}</a></li>
                                    <li id="wp-admin-bar-blog-1-c"><a class="ab-item"
                                            href="{{ route('post-type.pages') }}"
                                            data-turbolinks="false">{{ trans('New Page') }}</a></li>
                                </ul>
                            </div>
                        </li>

                        <li id="wp-admin-bar-new-content" class="menupop">
                            <a class="ab-item" aria-haspopup="true" href="">
                                <span class="ab-label">{{ trans('New') }}</span>
                            </a>

                            <div class="ab-sub-wrapper">
                                <ul id="wp-admin-bar-new-content-default" class="ab-submenu">
                                    <li id="wp-admin-bar-new-post"><a class="ab-item"
                                            href="{{ route('post-type.posts') }}"
                                            data-turbolinks="false">{{ trans('New Post') }}</a>
                                    </li>

                                    <li id="wp-admin-bar-new-page"><a class="ab-item"
                                            href="{{ route('post-type.pages') }}"
                                            data-turbolinks="false">{{ trans('New Page') }}</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        @php
                            $pageId = 0;
                            $meta_title = null;
                            $meta_description = null;
                            if (isset($postData)) {
                                if(isset($postData['postId'])){
                                    $pageId = $postData['postId'];
                                }
                                if (isset($postData['pageData'])) {
                                    if (isset($postData['pageData'][0])) {
                                        $meta_title = $postData['pageData'][0]->meta_title;
                                        $meta_description = $postData['pageData'][0]->meta_description;
                                    }
                                }
                            }
                        @endphp
                        @if (function_exists('get_edit_url_by_ID'))
                            {{ get_edit_url_by_ID($pageId) }}
                        @endif
                    </ul>

                    <ul id="wp-admin-bar-top-secondary" class="ab-top-secondary ab-top-menu">
                        {{-- <li id="wp-admin-bar-search" class="admin-bar-search">
                        <div class="ab-item ab-empty-item" tabindex="-1">
                            <form action="" method="get" id="adminbarsearch">
                                <input class="adminbar-input" name="s" id="adminbar-search" type="text" value=""
                                        maxlength="150"/><label for="adminbar-search"
                                                                class="screen-reader-text">Search</label><input type="submit"
                                                                                                                class="adminbar-button"
                                                                                                                value="Search"/>
                            </form>
                        </div>
                    </li> --}}
                        <li id="wp-admin-bar-my-account" class="menupop with-avatar">
                            <a class="ab-item" aria-haspopup="true" href="">
                                {{ ucfirst(Auth::user()->first_name) }} <span
                                    class="display-name">{{ ucfirst(Auth::user()->last_name) }}</span>
                                @if (Auth::user()->profile_picture != '')
                                    <img alt="user-profile" src="{{ asset(Auth::user()->profile_picture) }}"
                                        srcset="{{ asset(Auth::user()->profile_picture) }}"
                                        class="avatar avatar-26 photo" height="26" width="26" loading="lazy" />
                                @else
                                    <img alt="user-profile" src="{{ asset('storage/user_images/avatar.png') }}"
                                        srcset="{{ asset('storage/user_images/avatar.png') }}"
                                        class="avatar avatar-26 photo" height="26" width="26" loading="lazy" />
                                @endif
                            </a>

                            <div class="ab-sub-wrapper">
                                <ul id="wp-admin-bar-user-actions" class="ab-submenu">
                                    <li id="wp-admin-bar-user-info">
                                        <a class="ab-item" tabindex="-1" href="" data-turbolinks="false">
                                            @if (Auth::user()->profile_picture != '')
                                                <img alt="user-profile"
                                                    src="{{ asset(Auth::user()->profile_picture) }}"
                                                    srcset="{{ asset(Auth::user()->profile_picture) }}"
                                                    class="avatar avatar-64 photo" height="64" width="64"
                                                    loading="lazy" />
                                            @else
                                                <img alt="user-profile"
                                                    src="{{ asset('storage/user_images/avatar.png') }}"
                                                    srcset="{{ asset('storage/user_images/avatar.png') }}"
                                                    class="avatar avatar-64 photo" height="64" width="64"
                                                    loading="lazy" />
                                            @endif
                                            <span class="display-name">{{ ucfirst(Auth::user()->last_name) }}</span>
                                        </a>
                                    </li>

                                    <li id="wp-admin-bar-logout">
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();"
                                            data-turbolinks="false" class="ab-item"><i
                                                class="dropdown-icon fa fa-sign-out"></i> {{ trans('logout') }} </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            style="display:none">
                                            @csrf
                                        </form>
                                    </li>

                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    @endif
@endif
