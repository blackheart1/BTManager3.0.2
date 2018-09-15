INSERT INTO `#prefix#_modules` (`module_id`, `module_enabled`, `module_display`, `module_basename`, `module_class`, `parent_id`, `left_id`, `right_id`, `module_langname`, `module_mode`, `module_auth`) VALUES
(1, 1, 1, '', 'acp', 0, 1, 60, 'ACP_CAT_GENERAL', '', ''),
(2, 1, 1, '', 'acp', 1, 4, 17, 'ACP_QUICK_ACCESS', '', ''),
(3, 1, 1, '', 'acp', 1, 18, 39, 'ACP_BOARD_CONFIGURATION', '', ''),
(4, 1, 1, '', 'acp', 1, 40, 47, 'ACP_CLIENT_COMMUNICATION', '', ''),
(5, 1, 1, '', 'acp', 1, 48, 59, 'ACP_SERVER_CONFIGURATION', '', ''),
(6, 1, 1, '', 'acp', 0, 61, 78, 'ACP_CAT_FORUMS', '', ''),
(7, 1, 1, '', 'acp', 6, 62, 67, 'ACP_MANAGE_FORUMS', '', ''),
(8, 1, 1, '', 'acp', 6, 68, 77, 'ACP_FORUM_BASED_PERMISSIONS', '', ''),
(9, 1, 1, '', 'acp', 0, 79, 102, 'ACP_CAT_POSTING', '', ''),
(10, 1, 1, '', 'acp', 9, 80, 91, 'ACP_MESSAGES', '', ''),
(11, 1, 1, '', 'acp', 9, 92, 101, 'ACP_ATTACHMENTS', '', ''),
(12, 1, 1, '', 'acp', 0, 103, 156, 'ACP_CAT_USERGROUP', '', ''),
(13, 1, 1, '', 'acp', 12, 104, 135, 'ACP_CAT_USERS', '', ''),
(14, 1, 1, '', 'acp', 12, 136, 143, 'ACP_GROUPS', '', ''),
(15, 1, 1, '', 'acp', 12, 144, 155, 'ACP_USER_SECURITY', '', ''),
(16, 1, 1, '', 'acp', 0, 157, 204, 'ACP_CAT_PERMISSIONS', '', ''),
(17, 1, 1, '', 'acp', 16, 160, 169, 'ACP_GLOBAL_PERMISSIONS', '', ''),
(18, 1, 1, '', 'acp', 16, 170, 179, 'ACP_FORUM_BASED_PERMISSIONS', '', ''),
(19, 1, 1, '', 'acp', 16, 180, 189, 'ACP_PERMISSION_ROLES', '', ''),
(20, 1, 1, '', 'acp', 16, 190, 203, 'ACP_PERMISSION_MASKS', '', ''),
(21, 1, 1, '', 'acp', 0, 205, 218, 'ACP_CAT_STYLES', '', ''),
(22, 1, 1, '', 'acp', 21, 206, 209, 'ACP_STYLE_MANAGEMENT', '', ''),
(23, 1, 1, '', 'acp', 21, 210, 217, 'ACP_STYLE_COMPONENTS', '', ''),
(24, 1, 1, '', 'acp', 0, 219, 238, 'ACP_CAT_MAINTENANCE', '', ''),
(25, 1, 1, '', 'acp', 24, 220, 229, 'ACP_FORUM_LOGS', '', ''),
(26, 1, 1, '', 'acp', 24, 230, 237, 'ACP_CAT_DATABASE', '', ''),
(27, 1, 1, '', 'acp', 0, 239, 264, 'ACP_CAT_SYSTEM', '', ''),
(28, 1, 1, '', 'acp', 27, 240, 243, 'ACP_AUTOMATION', '', ''),
(29, 1, 1, '', 'acp', 27, 244, 255, 'ACP_GENERAL_TASKS', '', ''),
(30, 1, 1, '', 'acp', 27, 256, 263, 'ACP_MODULE_MANAGEMENT', '', ''),
(31, 1, 1, '', 'acp', 0, 265, 266, 'ACP_CAT_DOT_MODS', '', ''),
(32, 1, 1, 'attachments', 'acp', 3, 19, 20, 'ACP_ATTACHMENT_SETTINGS', 'attach', 'acl_a_attach'),
(33, 1, 1, 'attachments', 'acp', 11, 93, 94, 'ACP_ATTACHMENT_SETTINGS', 'attach', 'acl_a_attach'),
(34, 1, 1, 'attachments', 'acp', 11, 95, 96, 'ACP_MANAGE_EXTENSIONS', 'extensions', 'acl_a_attach'),
(35, 1, 1, 'attachments', 'acp', 11, 97, 98, 'ACP_EXTENSION_GROUPS', 'ext_groups', 'acl_a_attach'),
(36, 1, 1, 'attachments', 'acp', 11, 99, 100, 'ACP_ORPHAN_ATTACHMENTS', 'orphan', 'acl_a_attach'),
(37, 1, 1, 'ban', 'acp', 15, 145, 146, 'ACP_BAN_EMAILS', 'email', 'acl_a_ban'),
(38, 1, 1, 'ban', 'acp', 15, 147, 148, 'ACP_BAN_IPS', 'ip', 'acl_a_ban'),
(39, 1, 1, 'ban', 'acp', 15, 149, 150, 'ACP_BAN_USERNAMES', 'user', 'acl_a_ban'),
(40, 1, 1, 'bbcodes', 'acp', 10, 81, 82, 'ACP_BBCODES', 'bbcodes', 'acl_a_bbcode'),
(41, 1, 1, 'board', 'acp', 3, 21, 22, 'ACP_BOARD_SETTINGS', 'settings', 'acl_a_board'),
(42, 1, 1, 'board', 'acp', 3, 23, 24, 'ACP_BOARD_FEATURES', 'features', 'acl_a_board'),
(43, 1, 1, 'board', 'acp', 3, 25, 26, 'ACP_AVATAR_SETTINGS', 'avatar', 'acl_a_board'),
(44, 1, 1, 'board', 'acp', 3, 27, 28, 'ACP_MESSAGE_SETTINGS', 'message', 'acl_a_board'),
(45, 1, 1, 'board', 'acp', 10, 83, 84, 'ACP_MESSAGE_SETTINGS', 'message', 'acl_a_board'),
(46, 1, 1, 'board', 'acp', 3, 29, 30, 'ACP_POST_SETTINGS', 'post', 'acl_a_board'),
(47, 1, 1, 'board', 'acp', 3, 31, 32, 'ACP_SIGNATURE_SETTINGS', 'signature', 'acl_a_board'),
(48, 1, 1, 'board', 'acp', 3, 33, 34, 'ACP_REGISTER_SETTINGS', 'registration', 'acl_a_board'),
(49, 1, 1, 'board', 'acp', 4, 41, 42, 'ACP_AUTH_SETTINGS', 'auth', 'acl_a_server'),
(50, 1, 1, 'board', 'acp', 4, 43, 44, 'ACP_EMAIL_SETTINGS', 'email', 'acl_a_server'),
(51, 1, 1, 'board', 'acp', 5, 49, 50, 'ACP_COOKIE_SETTINGS', 'cookie', 'acl_a_server'),
(52, 1, 1, 'board', 'acp', 5, 51, 52, 'ACP_SERVER_SETTINGS', 'server', 'acl_a_server'),
(53, 1, 1, 'board', 'acp', 5, 53, 54, 'ACP_SECURITY_SETTINGS', 'security', 'acl_a_server'),
(54, 1, 1, 'board', 'acp', 5, 55, 56, 'ACP_LOAD_SETTINGS', 'load', 'acl_a_server'),
(55, 1, 1, 'bots', 'acp', 29, 245, 246, 'ACP_BOTS', 'bots', 'acl_a_bots'),
(56, 1, 1, 'captcha', 'acp', 3, 35, 36, 'ACP_VC_SETTINGS', 'visual', 'acl_a_board'),
(57, 1, 0, 'captcha', 'acp', 3, 37, 38, 'ACP_VC_CAPTCHA_DISPLAY', 'img', 'acl_a_board'),
(58, 1, 1, 'database', 'acp', 26, 231, 232, 'ACP_BACKUP', 'backup', 'acl_a_backup'),
(59, 1, 1, 'database', 'acp', 26, 233, 234, 'ACP_RESTORE', 'restore', 'acl_a_backup'),
(60, 1, 1, 'disallow', 'acp', 15, 151, 152, 'ACP_DISALLOW_USERNAMES', 'usernames', 'acl_a_names'),
(61, 1, 1, 'email', 'acp', 29, 247, 248, 'ACP_MASS_EMAIL', 'email', 'acl_a_email'),
(62, 1, 1, 'forums', 'acp', 7, 63, 64, 'ACP_MANAGE_FORUMS', 'manage', 'acl_a_forum'),
(63, 1, 1, 'groups', 'acp', 14, 137, 138, 'ACP_GROUPS_MANAGE', 'manage', 'acl_a_group'),
(64, 1, 1, 'icons', 'acp', 10, 85, 86, 'ACP_ICONS', 'icons', 'acl_a_icons'),
(65, 1, 1, 'icons', 'acp', 10, 87, 88, 'ACP_SMILIES', 'smilies', 'acl_a_icons'),
(66, 1, 1, 'inactive', 'acp', 13, 107, 108, 'ACP_INACTIVE_USERS', 'list', 'acl_a_user'),
(67, 1, 1, 'jabber', 'acp', 4, 45, 46, 'ACP_JABBER_SETTINGS', 'settings', 'acl_a_jabber'),
(68, 1, 1, 'language', 'acp', 29, 249, 250, 'ACP_LANGUAGE_PACKS', 'lang_packs', 'acl_a_language'),
(69, 1, 1, 'logs', 'acp', 25, 221, 222, 'ACP_ADMIN_LOGS', 'admin', 'acl_a_viewlogs'),
(70, 1, 1, 'logs', 'acp', 25, 223, 224, 'ACP_MOD_LOGS', 'mod', 'acl_a_viewlogs'),
(71, 1, 1, 'logs', 'acp', 25, 225, 226, 'ACP_USERS_LOGS', 'users', 'acl_a_viewlogs'),
(72, 1, 1, 'logs', 'acp', 25, 227, 228, 'ACP_CRITICAL_LOGS', 'critical', 'acl_a_viewlogs'),
(73, 1, 1, 'main', 'acp', 1, 2, 3, 'ACP_INDEX', 'main', ''),
(74, 1, 1, 'modules', 'acp', 30, 257, 258, 'ACP', 'acp', 'acl_a_modules'),
(75, 1, 1, 'modules', 'acp', 30, 259, 260, 'UCP', 'ucp', 'acl_a_modules'),
(76, 1, 1, 'modules', 'acp', 30, 261, 262, 'MCP', 'mcp', 'acl_a_modules'),
(77, 1, 1, 'permission_roles', 'acp', 19, 181, 182, 'ACP_ADMIN_ROLES', 'admin_roles', 'acl_a_roles && acl_a_aauth'),
(78, 1, 1, 'permission_roles', 'acp', 19, 183, 184, 'ACP_USER_ROLES', 'user_roles', 'acl_a_roles && acl_a_uauth'),
(79, 1, 1, 'permission_roles', 'acp', 19, 185, 186, 'ACP_MOD_ROLES', 'mod_roles', 'acl_a_roles && acl_a_mauth'),
(80, 1, 1, 'permission_roles', 'acp', 19, 187, 188, 'ACP_FORUM_ROLES', 'forum_roles', 'acl_a_roles && acl_a_fauth'),
(81, 1, 1, 'permissions', 'acp', 16, 158, 159, 'ACP_PERMISSIONS', 'intro', 'acl_a_authusers || acl_a_authgroups || acl_a_viewauth'),
(82, 1, 0, 'permissions', 'acp', 20, 191, 192, 'ACP_PERMISSION_TRACE', 'trace', 'acl_a_viewauth'),
(83, 1, 1, 'permissions', 'acp', 18, 171, 172, 'ACP_FORUM_PERMISSIONS', 'setting_forum_local', 'acl_a_fauth && (acl_a_authusers || acl_a_authgroups)'),
(84, 1, 1, 'permissions', 'acp', 18, 173, 174, 'ACP_FORUM_MODERATORS', 'setting_mod_local', 'acl_a_mauth && (acl_a_authusers || acl_a_authgroups)'),
(85, 1, 1, 'permissions', 'acp', 17, 161, 162, 'ACP_USERS_PERMISSIONS', 'setting_user_global', 'acl_a_authusers && (acl_a_aauth || acl_a_mauth || acl_a_uauth)'),
(86, 1, 1, 'permissions', 'acp', 13, 109, 110, 'ACP_USERS_PERMISSIONS', 'setting_user_global', 'acl_a_authusers && (acl_a_aauth || acl_a_mauth || acl_a_uauth)'),
(87, 1, 1, 'permissions', 'acp', 18, 175, 176, 'ACP_USERS_FORUM_PERMISSIONS', 'setting_user_local', 'acl_a_authusers && (acl_a_mauth || acl_a_fauth)'),
(88, 1, 1, 'permissions', 'acp', 13, 111, 112, 'ACP_USERS_FORUM_PERMISSIONS', 'setting_user_local', 'acl_a_authusers && (acl_a_mauth || acl_a_fauth)'),
(89, 1, 1, 'permissions', 'acp', 17, 163, 164, 'ACP_GROUPS_PERMISSIONS', 'setting_group_global', 'acl_a_authgroups && (acl_a_aauth || acl_a_mauth || acl_a_uauth)'),
(90, 1, 1, 'permissions', 'acp', 14, 139, 140, 'ACP_GROUPS_PERMISSIONS', 'setting_group_global', 'acl_a_authgroups && (acl_a_aauth || acl_a_mauth || acl_a_uauth)'),
(91, 1, 1, 'permissions', 'acp', 18, 177, 178, 'ACP_GROUPS_FORUM_PERMISSIONS', 'setting_group_local', 'acl_a_authgroups && (acl_a_mauth || acl_a_fauth)'),
(92, 1, 1, 'permissions', 'acp', 14, 141, 142, 'ACP_GROUPS_FORUM_PERMISSIONS', 'setting_group_local', 'acl_a_authgroups && (acl_a_mauth || acl_a_fauth)'),
(93, 1, 1, 'permissions', 'acp', 17, 165, 166, 'ACP_ADMINISTRATORS', 'setting_admin_global', 'acl_a_aauth && (acl_a_authusers || acl_a_authgroups)'),
(94, 1, 1, 'permissions', 'acp', 17, 167, 168, 'ACP_GLOBAL_MODERATORS', 'setting_mod_global', 'acl_a_mauth && (acl_a_authusers || acl_a_authgroups)'),
(95, 1, 1, 'permissions', 'acp', 20, 193, 194, 'ACP_VIEW_ADMIN_PERMISSIONS', 'view_admin_global', 'acl_a_viewauth'),
(96, 1, 1, 'permissions', 'acp', 20, 195, 196, 'ACP_VIEW_USER_PERMISSIONS', 'view_user_global', 'acl_a_viewauth'),
(97, 1, 1, 'permissions', 'acp', 20, 197, 198, 'ACP_VIEW_GLOBAL_MOD_PERMISSIONS', 'view_mod_global', 'acl_a_viewauth'),
(98, 1, 1, 'permissions', 'acp', 20, 199, 200, 'ACP_VIEW_FORUM_MOD_PERMISSIONS', 'view_mod_local', 'acl_a_viewauth'),
(99, 1, 1, 'permissions', 'acp', 20, 201, 202, 'ACP_VIEW_FORUM_PERMISSIONS', 'view_forum_local', 'acl_a_viewauth'),
(100, 1, 1, 'php_info', 'acp', 29, 251, 252, 'ACP_PHP_INFO', 'info', 'acl_a_phpinfo'),
(101, 1, 1, 'profile', 'acp', 13, 113, 114, 'ACP_CUSTOM_PROFILE_FIELDS', 'profile', 'acl_a_profile'),
(102, 1, 1, 'prune', 'acp', 7, 65, 66, 'ACP_PRUNE_FORUMS', 'forums', 'acl_a_prune'),
(103, 1, 1, 'prune', 'acp', 15, 153, 154, 'ACP_PRUNE_USERS', 'users', 'acl_a_userdel'),
(104, 1, 1, 'ranks', 'acp', 13, 115, 116, 'ACP_MANAGE_RANKS', 'ranks', 'acl_a_ranks'),
(105, 1, 1, 'reasons', 'acp', 29, 253, 254, 'ACP_MANAGE_REASONS', 'main', 'acl_a_reasons'),
(106, 1, 1, 'search', 'acp', 5, 57, 58, 'ACP_SEARCH_SETTINGS', 'settings', 'acl_a_search'),
(107, 1, 1, 'search', 'acp', 26, 235, 236, 'ACP_SEARCH_INDEX', 'index', 'acl_a_search'),
(108, 1, 1, 'styles', 'acp', 22, 207, 208, 'ACP_STYLES', 'style', 'acl_a_styles'),
(109, 1, 1, 'styles', 'acp', 23, 211, 212, 'ACP_TEMPLATES', 'template', 'acl_a_styles'),
(110, 1, 1, 'styles', 'acp', 23, 213, 214, 'ACP_THEMES', 'theme', 'acl_a_styles'),
(111, 1, 1, 'styles', 'acp', 23, 215, 216, 'ACP_IMAGESETS', 'imageset', 'acl_a_styles'),
(112, 1, 1, 'update', 'acp', 28, 241, 242, 'ACP_VERSION_CHECK', 'version_check', 'acl_a_board'),
(113, 1, 1, 'users', 'acp', 13, 105, 106, 'ACP_MANAGE_USERS', 'overview', 'acl_a_user'),
(114, 1, 0, 'users', 'acp', 13, 117, 118, 'ACP_USER_FEEDBACK', 'feedback', 'acl_a_user'),
(115, 1, 0, 'users', 'acp', 13, 119, 120, 'ACP_USER_PROFILE', 'profile', 'acl_a_user'),
(116, 1, 0, 'users', 'acp', 13, 121, 122, 'ACP_USER_PREFS', 'prefs', 'acl_a_user'),
(117, 1, 0, 'users', 'acp', 13, 123, 124, 'ACP_USER_AVATAR', 'avatar', 'acl_a_user'),
(118, 1, 0, 'users', 'acp', 13, 125, 126, 'ACP_USER_RANK', 'rank', 'acl_a_user'),
(119, 1, 0, 'users', 'acp', 13, 127, 128, 'ACP_USER_SIG', 'sig', 'acl_a_user'),
(120, 1, 0, 'users', 'acp', 13, 129, 130, 'ACP_USER_GROUPS', 'groups', 'acl_a_user && acl_a_group'),
(121, 1, 0, 'users', 'acp', 13, 131, 132, 'ACP_USER_PERM', 'perm', 'acl_a_user && acl_a_viewauth'),
(122, 1, 0, 'users', 'acp', 13, 133, 134, 'ACP_USER_ATTACH', 'attach', 'acl_a_user'),
(123, 1, 1, 'words', 'acp', 10, 89, 90, 'ACP_WORDS', 'words', 'acl_a_words'),
(124, 1, 1, 'users', 'acp', 2, 5, 6, 'ACP_MANAGE_USERS', 'overview', 'acl_a_user'),
(125, 1, 1, 'groups', 'acp', 2, 7, 8, 'ACP_GROUPS_MANAGE', 'manage', 'acl_a_group'),
(126, 1, 1, 'forums', 'acp', 2, 9, 10, 'ACP_MANAGE_FORUMS', 'manage', 'acl_a_forum'),
(127, 1, 1, 'logs', 'acp', 2, 11, 12, 'ACP_MOD_LOGS', 'mod', 'acl_a_viewlogs'),
(128, 1, 1, 'bots', 'acp', 2, 13, 14, 'ACP_BOTS', 'bots', 'acl_a_bots'),
(129, 1, 1, 'php_info', 'acp', 2, 15, 16, 'ACP_PHP_INFO', 'info', 'acl_a_phpinfo'),
(130, 1, 1, 'permissions', 'acp', 8, 69, 70, 'ACP_FORUM_PERMISSIONS', 'setting_forum_local', 'acl_a_fauth && (acl_a_authusers || acl_a_authgroups)'),
(131, 1, 1, 'permissions', 'acp', 8, 71, 72, 'ACP_FORUM_MODERATORS', 'setting_mod_local', 'acl_a_mauth && (acl_a_authusers || acl_a_authgroups)'),
(132, 1, 1, 'permissions', 'acp', 8, 73, 74, 'ACP_USERS_FORUM_PERMISSIONS', 'setting_user_local', 'acl_a_authusers && (acl_a_mauth || acl_a_fauth)'),
(133, 1, 1, 'permissions', 'acp', 8, 75, 76, 'ACP_GROUPS_FORUM_PERMISSIONS', 'setting_group_local', 'acl_a_authgroups && (acl_a_mauth || acl_a_fauth)'),
(134, 1, 1, '', 'mcp', 0, 1, 10, 'MCP_MAIN', '', ''),
(135, 1, 1, '', 'mcp', 0, 11, 18, 'MCP_QUEUE', '', ''),
(136, 1, 1, '', 'mcp', 0, 19, 26, 'MCP_REPORTS', '', ''),
(137, 1, 1, '', 'mcp', 0, 27, 32, 'MCP_NOTES', '', ''),
(138, 1, 1, '', 'mcp', 0, 33, 42, 'MCP_WARN', '', ''),
(139, 1, 1, '', 'mcp', 0, 43, 50, 'MCP_LOGS', '', ''),
(140, 1, 1, '', 'mcp', 0, 51, 58, 'MCP_BAN', '', ''),
(141, 1, 1, 'ban', 'mcp', 140, 52, 53, 'MCP_BAN_USERNAMES', 'user', 'acl_m_ban'),
(142, 1, 1, 'ban', 'mcp', 140, 54, 55, 'MCP_BAN_IPS', 'ip', 'acl_m_ban'),
(143, 1, 1, 'ban', 'mcp', 140, 56, 57, 'MCP_BAN_EMAILS', 'email', 'acl_m_ban'),
(144, 1, 1, 'logs', 'mcp', 139, 44, 45, 'MCP_LOGS_FRONT', 'front', 'acl_m_ || aclf_m_'),
(145, 1, 1, 'logs', 'mcp', 139, 46, 47, 'MCP_LOGS_FORUM_VIEW', 'forum_logs', 'acl_m_,$id'),
(146, 1, 1, 'logs', 'mcp', 139, 48, 49, 'MCP_LOGS_TOPIC_VIEW', 'topic_logs', 'acl_m_,$id'),
(147, 1, 1, 'main', 'mcp', 134, 2, 3, 'MCP_MAIN_FRONT', 'front', ''),
(148, 1, 1, 'main', 'mcp', 134, 4, 5, 'MCP_MAIN_FORUM_VIEW', 'forum_view', 'acl_m_,$id'),
(149, 1, 1, 'main', 'mcp', 134, 6, 7, 'MCP_MAIN_TOPIC_VIEW', 'topic_view', 'acl_m_,$id'),
(150, 1, 1, 'main', 'mcp', 134, 8, 9, 'MCP_MAIN_POST_DETAILS', 'post_details', 'acl_m_,$id || (!$id && aclf_m_)'),
(151, 1, 1, 'notes', 'mcp', 137, 28, 29, 'MCP_NOTES_FRONT', 'front', ''),
(152, 1, 1, 'notes', 'mcp', 137, 30, 31, 'MCP_NOTES_USER', 'user_notes', ''),
(153, 1, 1, 'queue', 'mcp', 135, 12, 13, 'MCP_QUEUE_UNAPPROVED_TOPICS', 'unapproved_topics', 'aclf_m_approve'),
(154, 1, 1, 'queue', 'mcp', 135, 14, 15, 'MCP_QUEUE_UNAPPROVED_POSTS', 'unapproved_posts', 'aclf_m_approve'),
(155, 1, 1, 'queue', 'mcp', 135, 16, 17, 'MCP_QUEUE_APPROVE_DETAILS', 'approve_details', 'acl_m_approve,$id || (!$id && aclf_m_approve)'),
(156, 1, 1, 'reports', 'mcp', 136, 20, 21, 'MCP_REPORTS_OPEN', 'reports', 'aclf_m_report'),
(157, 1, 1, 'reports', 'mcp', 136, 22, 23, 'MCP_REPORTS_CLOSED', 'reports_closed', 'aclf_m_report'),
(158, 1, 1, 'reports', 'mcp', 136, 24, 25, 'MCP_REPORT_DETAILS', 'report_details', 'acl_m_report,$id || (!$id && aclf_m_report)'),
(159, 1, 1, 'warn', 'mcp', 138, 34, 35, 'MCP_WARN_FRONT', 'front', 'aclf_m_warn'),
(160, 1, 1, 'warn', 'mcp', 138, 36, 37, 'MCP_WARN_LIST', 'list', 'aclf_m_warn'),
(161, 1, 1, 'warn', 'mcp', 138, 38, 39, 'MCP_WARN_USER', 'warn_user', 'aclf_m_warn'),
(162, 1, 1, 'warn', 'mcp', 138, 40, 41, 'MCP_WARN_POST', 'warn_post', 'acl_m_warn && acl_f_read,$id'),
(163, 1, 1, '', 'ucp', 0, 1, 12, 'UCP_MAIN', '', ''),
(164, 1, 1, '', 'ucp', 0, 13, 22, 'UCP_PROFILE', '', ''),
(165, 1, 1, '', 'ucp', 0, 23, 30, 'UCP_PREFS', '', ''),
(166, 1, 1, '', 'ucp', 0, 31, 42, 'UCP_PM', '', ''),
(167, 1, 1, '', 'ucp', 0, 43, 48, 'UCP_USERGROUPS', '', ''),
(168, 1, 1, '', 'ucp', 0, 49, 54, 'UCP_ZEBRA', '', ''),
(169, 1, 1, 'attachments', 'ucp', 163, 10, 11, 'UCP_MAIN_ATTACHMENTS', 'attachments', 'acl_u_attach'),
(170, 1, 1, 'groups', 'ucp', 167, 44, 45, 'UCP_USERGROUPS_MEMBER', 'membership', ''),
(171, 1, 1, 'groups', 'ucp', 167, 46, 47, 'UCP_USERGROUPS_MANAGE', 'manage', ''),
(172, 1, 1, 'main', 'ucp', 163, 2, 3, 'UCP_MAIN_FRONT', 'front', ''),
(173, 1, 1, 'main', 'ucp', 163, 4, 5, 'UCP_MAIN_SUBSCRIBED', 'subscribed', ''),
(174, 1, 1, 'main', 'ucp', 163, 6, 7, 'UCP_MAIN_BOOKMARKS', 'bookmarks', 'cfg_allow_bookmarks'),
(175, 1, 1, 'main', 'ucp', 163, 8, 9, 'UCP_MAIN_DRAFTS', 'drafts', ''),
(176, 1, 0, 'pm', 'ucp', 166, 32, 33, 'UCP_PM_VIEW', 'view', 'cfg_allow_privmsg'),
(177, 1, 1, 'pm', 'ucp', 166, 34, 35, 'UCP_PM_COMPOSE', 'compose', 'cfg_allow_privmsg'),
(178, 1, 1, 'pm', 'ucp', 166, 36, 37, 'UCP_PM_DRAFTS', 'drafts', 'cfg_allow_privmsg'),
(179, 1, 1, 'pm', 'ucp', 166, 38, 39, 'UCP_PM_OPTIONS', 'options', 'cfg_allow_privmsg'),
(180, 1, 0, 'pm', 'ucp', 166, 40, 41, 'UCP_PM_POPUP_TITLE', 'popup', 'cfg_allow_privmsg'),
(181, 1, 1, 'prefs', 'ucp', 165, 24, 25, 'UCP_PREFS_PERSONAL', 'personal', ''),
(182, 1, 1, 'prefs', 'ucp', 165, 26, 27, 'UCP_PREFS_POST', 'post', ''),
(183, 1, 1, 'prefs', 'ucp', 165, 28, 29, 'UCP_PREFS_VIEW', 'view', ''),
(184, 1, 1, 'profile', 'ucp', 164, 14, 15, 'UCP_PROFILE_PROFILE_INFO', 'profile_info', ''),
(185, 1, 1, 'profile', 'ucp', 164, 16, 17, 'UCP_PROFILE_SIGNATURE', 'signature', ''),
(186, 1, 1, 'profile', 'ucp', 164, 18, 19, 'UCP_PROFILE_AVATAR', 'avatar', ''),
(187, 1, 1, 'profile', 'ucp', 164, 20, 21, 'UCP_PROFILE_REG_DETAILS', 'reg_details', ''),
(188, 1, 1, 'zebra', 'ucp', 168, 50, 51, 'UCP_ZEBRA_FRIENDS', 'friends', ''),
(189, 1, 1, 'zebra', 'ucp', 168, 52, 53, 'UCP_ZEBRA_FOES', 'foes', '');
