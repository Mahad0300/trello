<?php

class AdminController extends Controller {
    public function dashboard() {
        $stats = [
            'total_users' => 142,
            'active_users' => 136,
            'inactive_users' => 6,
            'total_boards' => 58,
            'active_boards' => 52,
            'active_workspaces' => 12,
            'completed_tasks' => 1240,
            'completion_rate' => 84,
            'growth_rate' => '+18.5%',
            'total_images' => 48,
            'total_pdfs' => 24,
            'total_attachments' => 72
        ];

        $recentUsers = [
            ['id' => 1, 'name' => 'Sarah Connor', 'email' => 'sarah@richmondtech.com', 'role' => 'Product Designer', 'status' => 'Active', 'joined' => '2026-07-20', 'avatar' => asset('images/avatars/default-image.jpg')],
            ['id' => 2, 'name' => 'Chris Parker', 'email' => 'chris@richmondtech.com', 'role' => 'Senior Frontend Lead', 'status' => 'Active', 'joined' => '2026-07-18', 'avatar' => asset('images/avatars/default-image.jpg')],
            ['id' => 3, 'name' => 'Alex Johnson', 'email' => 'alex@richmondtech.com', 'role' => 'Backend Lead', 'status' => 'Active', 'joined' => '2026-07-15', 'avatar' => asset('images/avatars/default-image.jpg')],
            ['id' => 4, 'name' => 'Elena Rostova', 'email' => 'elena@richmondtech.com', 'role' => 'QA Specialist', 'status' => 'Inactive', 'joined' => '2026-07-10', 'avatar' => asset('images/avatars/default-image.jpg')],
            ['id' => 6, 'name' => 'David Chen', 'email' => 'david@richmondtech.com', 'role' => 'Growth Marketer', 'status' => 'Active', 'joined' => '2026-06-18', 'avatar' => asset('images/avatars/default-image.jpg')],
        ];

        $recentBoards = [
            [
                'id' => 1,
                'title' => 'Create Onboarding Illustrations',
                'category' => 'Design',
                'category_bg' => '#FCE7F3',
                'category_color' => '#BE185D',
                'description' => 'Design a cohesive set of onboarding illustrations that introduce key product features.',
                'progress' => 75,
                'attachments' => 2,
                'comments' => 1,
                'updated' => '2 mins ago'
            ],
            [
                'id' => 2,
                'title' => 'Sprint 24 - Core Architecture',
                'category' => 'Engineering',
                'category_bg' => '#E0F2FE',
                'category_color' => '#0369A1',
                'description' => 'Architecting scalable microservices, queue caching, and query optimization layers.',
                'progress' => 85,
                'attachments' => 4,
                'comments' => 6,
                'updated' => '1 hour ago'
            ],
            [
                'id' => 3,
                'title' => 'Q4 Growth Marketing Campaign',
                'category' => 'Marketing',
                'category_bg' => '#DCFCE7',
                'category_color' => '#15803D',
                'description' => 'Execute multi-channel performance marketing for Q4 SaaS platform growth.',
                'progress' => 60,
                'attachments' => 3,
                'comments' => 8,
                'updated' => '3 hours ago'
            ],
        ];

        $activities = [
            ['user' => 'Sarah Connor', 'avatar' => asset('images/avatars/default-image.jpg'), 'action' => 'moved card', 'target' => 'HTML5 Drag & Drop Card Physics', 'board' => 'Sprint 24 - Core Architecture', 'time' => '15 mins ago'],
            ['user' => 'Chris Parker', 'avatar' => asset('images/avatars/default-image.jpg'), 'action' => 'created board', 'target' => 'Q4 Product Marketing Launch', 'board' => 'Product Design & Marketing', 'time' => '1 hour ago'],
            ['user' => 'Alex Johnson', 'avatar' => asset('images/avatars/default-image.jpg'), 'action' => 'attached file', 'target' => 'architecture_v2_diagram.pdf', 'board' => 'Sprint 24 - Core Architecture', 'time' => '3 hours ago'],
            ['user' => 'Elena Rostova', 'avatar' => asset('images/avatars/default-image.jpg'), 'action' => 'completed checklist in', 'target' => 'Design System Tokens & CSS Variables', 'board' => 'Design System 2.0 Tokens', 'time' => '5 hours ago'],
        ];

        $this->view('admin/dashboard', [
            'pageTitle' => 'Admin Dashboard - Richmondtech',
            'stats' => $stats,
            'recentUsers' => $recentUsers,
            'recentBoards' => $recentBoards,
            'activities' => $activities
        ]);
    }

    private function getSystemUsers() {
        return [
            [
                'id' => 1,
                'name' => 'Admin User',
                'email' => 'admin@richmondtech.com',
                'role' => 'admin',
                'role_label' => 'Platform Administrator',
                'status' => 'Active',
                'status_label' => 'Super Admin',
                'department' => 'Operations',
                'boards' => 14,
                'joined' => '2026-01-01',
                'joined_label' => 'January 2026',
                'avatar' => asset('images/avatars/default-image.jpg'),
            ],
            [
                'id' => 2,
                'name' => 'Chris Parker',
                'email' => 'chris@richmondtech.com',
                'role' => 'user',
                'role_label' => 'Senior Frontend Lead',
                'status' => 'Active',
                'status_label' => 'Active Member',
                'department' => 'Engineering',
                'boards' => 6,
                'joined' => '2026-03-15',
                'joined_label' => 'March 2026',
                'avatar' => asset('images/avatars/default-image.jpg'),
            ],
            [
                'id' => 3,
                'name' => 'Sarah Connor',
                'email' => 'sarah@richmondtech.com',
                'role' => 'user',
                'role_label' => 'Product Designer',
                'status' => 'Active',
                'status_label' => 'Active Member',
                'department' => 'Product Design',
                'boards' => 4,
                'joined' => '2026-04-10',
                'joined_label' => 'April 2026',
                'avatar' => asset('images/avatars/default-image.jpg'),
            ],
            [
                'id' => 4,
                'name' => 'Alex Johnson',
                'email' => 'alex@richmondtech.com',
                'role' => 'user',
                'role_label' => 'Backend Engineer',
                'status' => 'Active',
                'status_label' => 'Active Member',
                'department' => 'Engineering',
                'boards' => 9,
                'joined' => '2026-05-22',
                'joined_label' => 'May 2026',
                'avatar' => asset('images/avatars/default-image.jpg'),
            ],
            [
                'id' => 5,
                'name' => 'Elena Rostova',
                'email' => 'elena@richmondtech.com',
                'role' => 'user',
                'role_label' => 'QA Specialist',
                'status' => 'Inactive',
                'status_label' => 'Inactive',
                'department' => 'Quality Assurance',
                'boards' => 2,
                'joined' => '2026-06-01',
                'joined_label' => 'June 2026',
                'avatar' => asset('images/avatars/default-image.jpg'),
            ],
            [
                'id' => 6,
                'name' => 'David Chen',
                'email' => 'david@richmondtech.com',
                'role' => 'user',
                'role_label' => 'Growth Marketer',
                'status' => 'Active',
                'status_label' => 'Active Member',
                'department' => 'Marketing',
                'boards' => 11,
                'joined' => '2026-06-18',
                'joined_label' => 'June 2026',
                'avatar' => asset('images/avatars/default-image.jpg'),
            ],
        ];
    }

    public function users() {
        $this->view('admin/users', [
            'pageTitle' => 'User Management',
            'users' => $this->getSystemUsers()
        ]);
    }

    public function boards() {
        $starredBoards = [
            [
                'id' => 1,
                'title' => 'Sprint 24 - Core Architecture',
                'workspace' => 'Engineering Team',
                'cover_image' => asset('images/covers/board_cover_engineering.png'),
                'cards_count' => 18,
                'members_count' => 6,
                'is_starred' => true
            ],
            [
                'id' => 3,
                'title' => 'API v3 Migration Roadmap',
                'workspace' => 'Engineering Team',
                'cover_image' => asset('images/covers/board_cover_roadmap.png'),
                'cards_count' => 9,
                'members_count' => 5,
                'is_starred' => true
            ],
            [
                'id' => 4,
                'title' => 'Design System 2.0 Tokens',
                'workspace' => 'Product Design & Marketing',
                'cover_image' => asset('images/covers/board_cover_design.png'),
                'cards_count' => 22,
                'members_count' => 8,
                'is_starred' => true
            ]
        ];

        $recentBoards = [
            [
                'id' => 1,
                'title' => 'Sprint 24 - Core Architecture',
                'workspace' => 'Engineering Team',
                'cover_image' => asset('images/covers/board_cover_engineering.png'),
                'cards_count' => 18,
                'members_count' => 6,
                'is_starred' => true
            ],
            [
                'id' => 2,
                'title' => 'Bug Triage & Hotfixes',
                'workspace' => 'Engineering Team',
                'cover_image' => asset('images/covers/board_cover_triage.png'),
                'cards_count' => 12,
                'members_count' => 4,
                'is_starred' => false
            ],
            [
                'id' => 5,
                'title' => 'Q4 Product Marketing Launch',
                'workspace' => 'Product Design & Marketing',
                'cover_image' => asset('images/covers/board_cover_design.png'),
                'cards_count' => 14,
                'members_count' => 3,
                'is_starred' => false
            ]
        ];

        $workspaces = [
            [
                'id' => 1,
                'name' => 'Engineering Team',
                'icon' => 'fa-briefcase',
                'color' => '#0d9488',
                'visibility' => 'Workspace Visible',
                'members_count' => 8,
                'description' => 'Core product architecture, API services, microservices, and database schemas.',
                'boards' => [
                    ['id' => 1, 'title' => 'Sprint 24 - Core Architecture', 'cover_image' => asset('images/covers/board_cover_engineering.png'), 'starred' => true, 'cards_count' => 18, 'members_count' => 6],
                    ['id' => 2, 'title' => 'Bug Triage & Hotfixes', 'cover_image' => asset('images/covers/board_cover_triage.png'), 'starred' => false, 'cards_count' => 12, 'members_count' => 4],
                    ['id' => 3, 'title' => 'API v3 Migration Roadmap', 'cover_image' => asset('images/covers/board_cover_roadmap.png'), 'starred' => true, 'cards_count' => 9, 'members_count' => 5],
                    ['id' => 6, 'title' => 'DevOps & CI/CD Pipelines', 'cover_image' => asset('images/covers/board_cover_engineering.png'), 'starred' => false, 'cards_count' => 7, 'members_count' => 3],
                ]
            ],
            [
                'id' => 2,
                'name' => 'Product Design & Marketing',
                'icon' => 'fa-palette',
                'color' => '#0f766e',
                'visibility' => 'Workspace Visible',
                'members_count' => 12,
                'description' => 'UI/UX design system tokens, brand identity, landing page, and growth campaigns.',
                'boards' => [
                    ['id' => 4, 'title' => 'Design System 2.0 Tokens', 'cover_image' => asset('images/covers/board_cover_design.png'), 'starred' => true, 'cards_count' => 22, 'members_count' => 8],
                    ['id' => 5, 'title' => 'Q4 Product Marketing Launch', 'cover_image' => asset('images/covers/board_cover_design.png'), 'starred' => false, 'cards_count' => 14, 'members_count' => 3],
                    ['id' => 7, 'title' => 'User Feedback & Usability Tests', 'cover_image' => asset('images/covers/card_cover_architecture.png'), 'starred' => false, 'cards_count' => 11, 'members_count' => 5],
                ]
            ]
        ];

        $closedBoards = [
            ['id' => 99, 'title' => 'Q1 Legacy Architecture (Archived)', 'workspace' => 'Engineering Team', 'closed_date' => 'Closed 3 weeks ago']
        ];

        $boards = [
            ['id' => 1, 'title' => 'Sprint 24 - Core Architecture', 'workspace' => 'Engineering', 'color' => '#4f46e5', 'created_by' => 'Admin User', 'members' => 8, 'cards' => 24, 'created_at' => '2026-07-01'],
            ['id' => 2, 'title' => 'Q4 Growth Marketing', 'workspace' => 'Marketing', 'color' => '#059669', 'created_by' => 'Sarah Connor', 'members' => 5, 'cards' => 14, 'created_at' => '2026-07-05'],
            ['id' => 3, 'title' => 'Bug Triage & Polish', 'workspace' => 'Engineering', 'color' => '#0284c7', 'created_by' => 'Chris Parker', 'members' => 12, 'cards' => 31, 'created_at' => '2026-07-10'],
            ['id' => 4, 'title' => 'Design System 2.0', 'workspace' => 'Product Design', 'color' => '#d97706', 'created_by' => 'Alex Johnson', 'members' => 4, 'cards' => 18, 'created_at' => '2026-07-12'],
            ['id' => 5, 'title' => 'Customer Onboarding Flow', 'workspace' => 'Operations', 'color' => '#7c3aed', 'created_by' => 'Admin User', 'members' => 6, 'cards' => 9, 'created_at' => '2026-07-15'],
        ];

        $this->view('admin/boards', [
            'pageTitle' => 'All Boards - Richmondtech',
            'starredBoards' => $starredBoards,
            'recentBoards' => $recentBoards,
            'workspaces' => $workspaces,
            'closedBoards' => $closedBoards,
            'boards' => $boards
        ]);
    }

    public function workspaces() {
        $workspaces = [
            [
                'id' => 1,
                'name' => 'Engineering Team',
                'description' => 'Core SaaS platform architecture, backend API microservices, database migrations, and CI/CD deployment pipelines.',
                'visibility' => 'Workspace',
                'color' => '#0d9488',
                'icon' => 'fa-laptop-code',
                'members_count' => 8,
                'boards_count' => 3
            ],
            [
                'id' => 2,
                'name' => 'Product Design & Marketing',
                'description' => 'UX design system 2.0, brand asset illustrations, user research interviews, and Q4 growth marketing campaigns.',
                'visibility' => 'Public',
                'color' => '#0d9488',
                'icon' => 'fa-palette',
                'members_count' => 6,
                'boards_count' => 2
            ],
            [
                'id' => 3,
                'name' => 'Operations & Customer Success',
                'description' => 'Customer onboarding flows, SLA support desk tracking, SOC2 compliance audits, and HR team recruitment hiring.',
                'visibility' => 'Private',
                'color' => '#0d9488',
                'icon' => 'fa-chart-line',
                'members_count' => 5,
                'boards_count' => 2
            ]
        ];

        $this->view('admin/workspaces', [
            'pageTitle' => 'Workspace Management - Richmondtech',
            'workspaces' => $workspaces
        ]);
    }

    public function notifications() {
        $notifications = [
            [
                'id' => 1,
                'title' => 'New User Provisioned',
                'message' => 'Admin System provisioned a new active user account for David Chen (david@richmondtech.com).',
                'type' => 'user',
                'unread' => true,
                'starred' => false,
                'time' => '10 mins ago'
            ],
            [
                'id' => 2,
                'title' => 'Workspace Board Archived',
                'message' => 'Chris Parker archived board "Q1 Legacy Architecture" in Engineering Team workspace.',
                'type' => 'board',
                'unread' => false,
                'starred' => true,
                'time' => '2 hours ago'
            ],
            [
                'id' => 3,
                'title' => 'Security Policy Updated',
                'message' => 'Super Admin updated global self-registration policy and session timeout settings.',
                'type' => 'security',
                'unread' => true,
                'starred' => false,
                'time' => '1 day ago'
            ],
            [
                'id' => 4,
                'title' => 'System Backup Completed',
                'message' => 'Automated nightly MySQL database backup and file uploads sync executed successfully.',
                'type' => 'system',
                'unread' => false,
                'starred' => true,
                'time' => '2 days ago'
            ]
        ];

        $this->view('admin/notifications', [
            'pageTitle' => 'System Notifications - Admin Panel',
            'notifications' => $notifications
        ]);
    }

    public function profile() {
        $users = $this->getSystemUsers();
        $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
        $selected = null;

        if ($id > 0) {
            foreach ($users as $row) {
                if ((int) $row['id'] === $id) {
                    $selected = $row;
                    break;
                }
            }
        }

        if ($selected) {
            $user = [
                'id' => $selected['id'],
                'name' => $selected['name'],
                'email' => $selected['email'],
                'role' => $selected['role_label'],
                'department' => $selected['department'],
                'avatar' => $selected['avatar'],
                'joined' => $selected['joined_label'],
                'status' => $selected['status'],
                'status_label' => $selected['status_label'],
                'is_own' => false,
            ];
            $pageTitle = $selected['name'] . ' - Profile';
        } else {
            $user = [
                'id' => 0,
                'name' => 'Admin System',
                'email' => 'admin@richmondtech.com',
                'role' => 'Platform Administrator',
                'department' => 'Operations',
                'avatar' => asset('images/avatars/default-image.jpg'),
                'joined' => 'January 2026',
                'status' => 'Active',
                'status_label' => 'Super Admin',
                'is_own' => true,
            ];
            $pageTitle = 'My Profile - Richmondtech';
        }

        $this->view('admin/profile', [
            'pageTitle' => $pageTitle,
            'user' => $user
        ]);
    }

    public function boardDetail() {
        $board = [
            'id' => 1,
            'title' => 'Sprint 24 - Core Architecture',
            'description' => 'Core product architecture, API services, microservices, and database schemas.',
            'workspace' => 'Engineering Team',
            'color' => '#4f46e5',
            'background_image' => asset('images/covers/board_cover_engineering.png'),
            'is_starred' => true,
            'members' => [
                ['id' => 2, 'name' => 'Chris Parker', 'avatar' => asset('images/avatars/default-image.jpg'), 'role' => 'Owner'],
                ['id' => 3, 'name' => 'Sarah Connor', 'avatar' => asset('images/avatars/default-image.jpg'), 'role' => 'Admin'],
                ['id' => 4, 'name' => 'Alex Johnson', 'avatar' => asset('images/avatars/default-image.jpg'), 'role' => 'Member'],
                ['id' => 5, 'name' => 'Elena Rostova', 'avatar' => asset('images/avatars/default-image.jpg'), 'role' => 'Member']
            ],
            'lists' => [
                [
                    'id' => 'list-1',
                    'title' => 'To-Do',
                    'status_color' => '#94A3B8',
                    'cards' => [
                        [
                            'id' => 'card-1',
                            'title' => 'Create RESTful API Interfaces',
                            'description' => 'Create RESTful API Interfaces',
                            'cover_image' => null,
                            'labels' => [
                                ['name' => 'Urgent Tasks', 'bg' => '#FEE2E2', 'color' => '#DC2626'],
                                ['name' => 'In Progress', 'bg' => '#FFEDD5', 'color' => '#EA580C']
                            ],
                            'progress' => 0,
                            'comments_count' => 12,
                            'attachments_count' => 4,
                            'assignees' => [
                                ['name' => 'Sarah Connor', 'avatar' => asset('images/avatars/default-image.jpg')],
                                ['name' => 'Chris Parker', 'avatar' => asset('images/avatars/default-image.jpg')]
                            ]
                        ],
                        [
                            'id' => 'card-2',
                            'title' => 'Develop API for User Profiles',
                            'description' => 'Integrate Third-Party API Services',
                            'cover_image' => asset('images/covers/card_cover_architecture.png'),
                            'labels' => [
                                ['name' => 'Low Priority', 'bg' => '#F3E8FF', 'color' => '#9333EA'],
                                ['name' => 'In Progress', 'bg' => '#FFEDD5', 'color' => '#EA580C']
                            ],
                            'progress' => 0,
                            'comments_count' => 12,
                            'attachments_count' => 4,
                            'assignees' => [
                                ['name' => 'Sarah Connor', 'avatar' => asset('images/avatars/default-image.jpg')],
                                ['name' => 'Chris Parker', 'avatar' => asset('images/avatars/default-image.jpg')]
                            ]
                        ]
                    ]
                ],
                [
                    'id' => 'list-2',
                    'title' => 'In Progress',
                    'status_color' => '#6366F1',
                    'cards' => [
                        [
                            'id' => 'card-4',
                            'title' => 'Design System Tokens & Variables',
                            'description' => 'Build reusable component primitives',
                            'cover_image' => asset('images/covers/card_cover_architecture.png'),
                            'labels' => [
                                ['name' => 'Feature', 'bg' => '#E0F2FE', 'color' => '#0284C7']
                            ],
                            'progress' => 80,
                            'comments_count' => 5,
                            'attachments_count' => 2,
                            'assignees' => [
                                ['name' => 'Chris Parker', 'avatar' => asset('images/avatars/default-image.jpg')]
                            ]
                        ]
                    ]
                ],
                [
                    'id' => 'list-3',
                    'title' => 'Done',
                    'status_color' => '#10B981',
                    'cards' => [
                        [
                            'id' => 'card-5',
                            'title' => 'Database Schema Migration DDL',
                            'description' => 'Exec MySQL schema migrations for Sprint 24',
                            'cover_image' => null,
                            'labels' => [
                                ['name' => 'Complete', 'bg' => '#D1FAE5', 'color' => '#059669']
                            ],
                            'progress' => 100,
                            'comments_count' => 18,
                            'attachments_count' => 1,
                            'assignees' => [
                                ['name' => 'Alex Johnson', 'avatar' => asset('images/avatars/default-image.jpg')]
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $this->view('admin/board_detail', [
            'pageTitle' => 'Sprint 24 Architecture - Admin Panel',
            'board' => $board
        ]);
    }

    public function activityLog() {
        $stats = [
            'total_events' => 1284,
            'admin_actions' => 42,
            'active_users' => 18,
            'critical_alerts' => 3
        ];

        $logs = [
            [
                'id' => 'LOG-8942',
                'user' => [
                    'name' => 'Sarah Connor',
                    'email' => 'sarah@richmondtech.com',
                    'role' => 'Product Designer',
                    'avatar' => asset('images/avatars/default-image.jpg')
                ],
                'action' => [
                    'label' => 'Card Moved',
                    'icon' => 'fa-solid fa-arrows-left-right',
                    'badge_class' => 'badge-action-blue',
                    'category' => 'cards'
                ],
                'target_item' => 'HTML5 Drag & Drop Card Physics',
                'workspace' => 'Engineering Team',
                'board' => 'Sprint 24 Architecture',
                'ip_address' => '192.168.1.45',
                'device' => 'Chrome / Windows 11',
                'location' => 'Lahore, PK',
                'timestamp' => '2026-08-11 17:42:10',
                'time_ago' => '10 mins ago',
                'severity' => [
                    'label' => 'Info',
                    'class' => 'severity-info'
                ],
                'details' => [
                    'from_list' => 'To-Do',
                    'to_list' => 'In Progress',
                    'card_id' => 'card-101',
                    'user_id' => 1
                ]
            ],
            [
                'id' => 'LOG-8941',
                'user' => [
                    'name' => 'Chris Parker',
                    'email' => 'chris@richmondtech.com',
                    'role' => 'Senior Frontend Lead',
                    'avatar' => asset('images/avatars/default-image.jpg')
                ],
                'action' => [
                    'label' => 'Board Created',
                    'icon' => 'fa-solid fa-plus',
                    'badge_class' => 'badge-action-green',
                    'category' => 'boards'
                ],
                'target_item' => 'Q4 Product Marketing Launch',
                'workspace' => 'Product Design & Marketing',
                'board' => 'Q4 Marketing Launch',
                'ip_address' => '192.168.1.18',
                'device' => 'Safari / macOS',
                'location' => 'Karachi, PK',
                'timestamp' => '2026-08-11 16:30:00',
                'time_ago' => '1 hour ago',
                'severity' => [
                    'label' => 'Info',
                    'class' => 'severity-info'
                ],
                'details' => [
                    'board_color' => '#7c3aed',
                    'visibility' => 'Workspace Visible',
                    'user_id' => 2
                ]
            ],
            [
                'id' => 'LOG-8940',
                'user' => [
                    'name' => 'Alex Johnson',
                    'email' => 'alex@richmondtech.com',
                    'role' => 'Backend Lead',
                    'avatar' => asset('images/avatars/default-image.jpg')
                ],
                'action' => [
                    'label' => 'File Attached',
                    'icon' => 'fa-solid fa-paperclip',
                    'badge_class' => 'badge-action-purple',
                    'category' => 'cards'
                ],
                'target_item' => 'architecture_v2_diagram.pdf',
                'workspace' => 'Engineering Team',
                'board' => 'Sprint 24 Architecture',
                'ip_address' => '10.0.0.12',
                'device' => 'Firefox / Linux',
                'location' => 'Islamabad, PK',
                'timestamp' => '2026-08-11 14:15:22',
                'time_ago' => '3 hours ago',
                'severity' => [
                    'label' => 'Info',
                    'class' => 'severity-info'
                ],
                'details' => [
                    'file_size' => '2.4 MB',
                    'mime_type' => 'application/pdf',
                    'card_id' => 'card-104'
                ]
            ],
            [
                'id' => 'LOG-8939',
                'user' => [
                    'name' => 'Admin System',
                    'email' => 'admin@richmondtech.com',
                    'role' => 'Super Admin',
                    'avatar' => asset('images/avatars/default-image.jpg')
                ],
                'action' => [
                    'label' => 'Role Updated',
                    'icon' => 'fa-solid fa-user-shield',
                    'badge_class' => 'badge-action-amber',
                    'category' => 'security'
                ],
                'target_item' => 'Elena Rostova (Member -> QA Lead)',
                'workspace' => 'System Wide',
                'board' => 'Admin Panel',
                'ip_address' => '192.168.1.1',
                'device' => 'Chrome / Windows 11',
                'location' => 'Lahore, PK',
                'timestamp' => '2026-08-11 12:00:00',
                'time_ago' => '5 hours ago',
                'severity' => [
                    'label' => 'Warning',
                    'class' => 'severity-warning'
                ],
                'details' => [
                    'old_role' => 'Member',
                    'new_role' => 'QA Specialist Lead',
                    'affected_user_id' => 4
                ]
            ],
            [
                'id' => 'LOG-8938',
                'user' => [
                    'name' => 'Elena Rostova',
                    'email' => 'elena@richmondtech.com',
                    'role' => 'QA Specialist',
                    'avatar' => asset('images/avatars/default-image.jpg')
                ],
                'action' => [
                    'label' => 'Checklist Done',
                    'icon' => 'fa-solid fa-square-check',
                    'badge_class' => 'badge-action-green',
                    'category' => 'cards'
                ],
                'target_item' => 'Audit CSS Variable Palette for Dark Accents',
                'workspace' => 'Product Design & Marketing',
                'board' => 'Design System 2.0 Tokens',
                'ip_address' => '192.168.1.99',
                'device' => 'Chrome / Windows 10',
                'location' => 'Rawalpindi, PK',
                'timestamp' => '2026-08-11 10:45:12',
                'time_ago' => '7 hours ago',
                'severity' => [
                    'label' => 'Info',
                    'class' => 'severity-info'
                ],
                'details' => [
                    'checklist_items_done' => 5,
                    'total_checklist_items' => 5,
                    'card_id' => 'card-102'
                ]
            ],
            [
                'id' => 'LOG-8937',
                'user' => [
                    'name' => 'David Chen',
                    'email' => 'david@richmondtech.com',
                    'role' => 'Growth Marketer',
                    'avatar' => asset('images/avatars/default-image.jpg')
                ],
                'action' => [
                    'label' => 'Failed Login',
                    'icon' => 'fa-solid fa-triangle-exclamation',
                    'badge_class' => 'badge-action-red',
                    'category' => 'security'
                ],
                'target_item' => 'Invalid Auth Password (3 Failed Attempts)',
                'workspace' => 'Authentication',
                'board' => 'System Auth Gateway',
                'ip_address' => '203.135.42.10',
                'device' => 'Edge / Windows 11',
                'location' => 'Faisalabad, PK',
                'timestamp' => '2026-08-11 08:30:15',
                'time_ago' => '9 hours ago',
                'severity' => [
                    'label' => 'Critical',
                    'class' => 'severity-critical'
                ],
                'details' => [
                    'failed_attempts' => 3,
                    'lockout_status' => 'Temporary 15 min lock',
                    'account_email' => 'david@richmondtech.com'
                ]
            ],
            [
                'id' => 'LOG-8936',
                'user' => [
                    'name' => 'Sarah Connor',
                    'email' => 'sarah@richmondtech.com',
                    'role' => 'Product Designer',
                    'avatar' => asset('images/avatars/default-image.jpg')
                ],
                'action' => [
                    'label' => 'Card Deleted',
                    'icon' => 'fa-solid fa-trash-can',
                    'badge_class' => 'badge-action-rose',
                    'category' => 'cards'
                ],
                'target_item' => 'Deprecated IE11 Polyfills Task',
                'workspace' => 'Engineering Team',
                'board' => 'Bug Triage & Hotfixes',
                'ip_address' => '192.168.1.45',
                'device' => 'Chrome / Windows 11',
                'location' => 'Lahore, PK',
                'timestamp' => '2026-08-10 22:15:00',
                'time_ago' => 'Yesterday',
                'severity' => [
                    'label' => 'Warning',
                    'class' => 'severity-warning'
                ],
                'details' => [
                    'card_title' => 'Deprecated IE11 Polyfills Task',
                    'list_name' => 'Archived Items',
                    'deleted_by' => 'Sarah Connor'
                ]
            ],
            [
                'id' => 'LOG-8935',
                'user' => [
                    'name' => 'Admin System',
                    'email' => 'admin@richmondtech.com',
                    'role' => 'Super Admin',
                    'avatar' => asset('images/avatars/default-image.jpg')
                ],
                'action' => [
                    'label' => 'Workspace Updated',
                    'icon' => 'fa-solid fa-sliders',
                    'badge_class' => 'badge-action-blue',
                    'category' => 'security'
                ],
                'target_item' => 'Engineering Team (Public -> Workspace Visible)',
                'workspace' => 'Engineering Team',
                'board' => 'Workspace Config',
                'ip_address' => '192.168.1.1',
                'device' => 'Chrome / Windows 11',
                'location' => 'Lahore, PK',
                'timestamp' => '2026-08-10 18:00:00',
                'time_ago' => 'Yesterday',
                'severity' => [
                    'label' => 'Info',
                    'class' => 'severity-info'
                ],
                'details' => [
                    'setting_changed' => 'workspace_visibility',
                    'old_val' => 'Public',
                    'new_val' => 'Workspace Visible'
                ]
            ],
            [
                'id' => 'LOG-8934',
                'user' => [
                    'name' => 'Chris Parker',
                    'email' => 'chris@richmondtech.com',
                    'role' => 'Senior Frontend Lead',
                    'avatar' => asset('images/avatars/default-image.jpg')
                ],
                'action' => [
                    'label' => 'Card Moved',
                    'icon' => 'fa-solid fa-arrows-left-right',
                    'badge_class' => 'badge-action-blue',
                    'category' => 'cards'
                ],
                'target_item' => 'Refactor CSS Grid Layout Tokens',
                'workspace' => 'Product Design & Marketing',
                'board' => 'Design System 2.0 Tokens',
                'ip_address' => '192.168.1.18',
                'device' => 'Safari / macOS',
                'location' => 'Karachi, PK',
                'timestamp' => '2026-08-10 16:20:00',
                'time_ago' => 'Yesterday',
                'severity' => ['label' => 'Info', 'class' => 'severity-info'],
                'details' => ['from_list' => 'In Review', 'to_list' => 'Completed']
            ],
            [
                'id' => 'LOG-8933',
                'user' => [
                    'name' => 'Alex Johnson',
                    'email' => 'alex@richmondtech.com',
                    'role' => 'Backend Lead',
                    'avatar' => asset('images/avatars/default-image.jpg')
                ],
                'action' => [
                    'label' => 'Board Created',
                    'icon' => 'fa-solid fa-plus',
                    'badge_class' => 'badge-action-green',
                    'category' => 'boards'
                ],
                'target_item' => 'DevOps & CI/CD Pipelines',
                'workspace' => 'Engineering Team',
                'board' => 'DevOps Pipelines',
                'ip_address' => '10.0.0.12',
                'device' => 'Firefox / Linux',
                'location' => 'Islamabad, PK',
                'timestamp' => '2026-08-10 14:10:00',
                'time_ago' => 'Yesterday',
                'severity' => ['label' => 'Info', 'class' => 'severity-info'],
                'details' => ['board_color' => '#0284c7']
            ],
            [
                'id' => 'LOG-8932',
                'user' => [
                    'name' => 'Elena Rostova',
                    'email' => 'elena@richmondtech.com',
                    'role' => 'QA Specialist',
                    'avatar' => asset('images/avatars/default-image.jpg')
                ],
                'action' => [
                    'label' => 'File Attached',
                    'icon' => 'fa-solid fa-paperclip',
                    'badge_class' => 'badge-action-purple',
                    'category' => 'cards'
                ],
                'target_item' => 'test_coverage_report_q3.pdf',
                'workspace' => 'Engineering Team',
                'board' => 'Bug Triage & Hotfixes',
                'ip_address' => '192.168.1.99',
                'device' => 'Chrome / Windows 10',
                'location' => 'Rawalpindi, PK',
                'timestamp' => '2026-08-10 11:30:00',
                'time_ago' => 'Yesterday',
                'severity' => ['label' => 'Info', 'class' => 'severity-info'],
                'details' => ['file_size' => '1.8 MB']
            ],
            [
                'id' => 'LOG-8931',
                'user' => [
                    'name' => 'Sarah Connor',
                    'email' => 'sarah@richmondtech.com',
                    'role' => 'Product Designer',
                    'avatar' => asset('images/avatars/default-image.jpg')
                ],
                'action' => [
                    'label' => 'Checklist Done',
                    'icon' => 'fa-solid fa-square-check',
                    'badge_class' => 'badge-action-green',
                    'category' => 'cards'
                ],
                'target_item' => 'Verify Figma Export Component Assets',
                'workspace' => 'Product Design & Marketing',
                'board' => 'Q4 Marketing Launch',
                'ip_address' => '192.168.1.45',
                'device' => 'Chrome / Windows 11',
                'location' => 'Lahore, PK',
                'timestamp' => '2026-08-09 19:45:00',
                'time_ago' => '2 days ago',
                'severity' => ['label' => 'Info', 'class' => 'severity-info'],
                'details' => ['checklist_items_done' => 3]
            ],
            [
                'id' => 'LOG-8930',
                'user' => [
                    'name' => 'David Chen',
                    'email' => 'david@richmondtech.com',
                    'role' => 'Growth Marketer',
                    'avatar' => asset('images/avatars/default-image.jpg')
                ],
                'action' => [
                    'label' => 'Card Moved',
                    'icon' => 'fa-solid fa-arrows-left-right',
                    'badge_class' => 'badge-action-blue',
                    'category' => 'cards'
                ],
                'target_item' => 'Prepare Product Hunt Launch Kit',
                'workspace' => 'Product Design & Marketing',
                'board' => 'Q4 Marketing Launch',
                'ip_address' => '203.135.42.10',
                'device' => 'Edge / Windows 11',
                'location' => 'Faisalabad, PK',
                'timestamp' => '2026-08-09 15:10:00',
                'time_ago' => '2 days ago',
                'severity' => ['label' => 'Info', 'class' => 'severity-info'],
                'details' => ['from_list' => 'Backlog', 'to_list' => 'In Progress']
            ],
            [
                'id' => 'LOG-8929',
                'user' => [
                    'name' => 'Admin System',
                    'email' => 'admin@richmondtech.com',
                    'role' => 'Super Admin',
                    'avatar' => asset('images/avatars/default-image.jpg')
                ],
                'action' => [
                    'label' => 'Role Updated',
                    'icon' => 'fa-solid fa-user-shield',
                    'badge_class' => 'badge-action-amber',
                    'category' => 'security'
                ],
                'target_item' => 'David Chen (Guest -> Growth Marketer)',
                'workspace' => 'System Wide',
                'board' => 'Admin Panel',
                'ip_address' => '192.168.1.1',
                'device' => 'Chrome / Windows 11',
                'location' => 'Lahore, PK',
                'timestamp' => '2026-08-09 10:00:00',
                'time_ago' => '2 days ago',
                'severity' => ['label' => 'Warning', 'class' => 'severity-warning'],
                'details' => ['old_role' => 'Guest', 'new_role' => 'Growth Marketer']
            ],
            [
                'id' => 'LOG-8928',
                'user' => ['name' => 'Sarah Connor', 'email' => 'sarah@richmondtech.com', 'role' => 'Product Designer', 'avatar' => asset('images/avatars/default-image.jpg')],
                'action' => ['label' => 'Card Moved', 'icon' => 'fa-solid fa-arrows-left-right', 'badge_class' => 'badge-action-blue', 'category' => 'cards'],
                'target_item' => 'Update Dark Mode Palette Contrast',
                'workspace' => 'Product Design & Marketing', 'board' => 'Design System 2.0 Tokens',
                'ip_address' => '192.168.1.45', 'device' => 'Chrome / Windows 11', 'location' => 'Lahore, PK',
                'timestamp' => '2026-08-08 17:30:00', 'time_ago' => '3 days ago',
                'severity' => ['label' => 'Info', 'class' => 'severity-info'], 'details' => ['card_id' => 'card-201']
            ],
            [
                'id' => 'LOG-8927',
                'user' => ['name' => 'Chris Parker', 'email' => 'chris@richmondtech.com', 'role' => 'Senior Frontend Lead', 'avatar' => asset('images/avatars/default-image.jpg')],
                'action' => ['label' => 'File Attached', 'icon' => 'fa-solid fa-paperclip', 'badge_class' => 'badge-action-purple', 'category' => 'cards'],
                'target_item' => 'landing_page_v3_mockup.png',
                'workspace' => 'Product Design & Marketing', 'board' => 'Q4 Marketing Launch',
                'ip_address' => '192.168.1.18', 'device' => 'Safari / macOS', 'location' => 'Karachi, PK',
                'timestamp' => '2026-08-08 14:15:00', 'time_ago' => '3 days ago',
                'severity' => ['label' => 'Info', 'class' => 'severity-info'], 'details' => ['file_size' => '4.1 MB']
            ],
            [
                'id' => 'LOG-8926',
                'user' => ['name' => 'Alex Johnson', 'email' => 'alex@richmondtech.com', 'role' => 'Backend Lead', 'avatar' => asset('images/avatars/default-image.jpg')],
                'action' => ['label' => 'Card Deleted', 'icon' => 'fa-solid fa-trash-can', 'badge_class' => 'badge-action-rose', 'category' => 'cards'],
                'target_item' => 'Remove Obsolete Redis Lock Task',
                'workspace' => 'Engineering Team', 'board' => 'Sprint 24 Architecture',
                'ip_address' => '10.0.0.12', 'device' => 'Firefox / Linux', 'location' => 'Islamabad, PK',
                'timestamp' => '2026-08-08 11:20:00', 'time_ago' => '3 days ago',
                'severity' => ['label' => 'Warning', 'class' => 'severity-warning'], 'details' => ['deleted_by' => 'Alex Johnson']
            ],
            [
                'id' => 'LOG-8925',
                'user' => ['name' => 'Elena Rostova', 'email' => 'elena@richmondtech.com', 'role' => 'QA Specialist', 'avatar' => asset('images/avatars/default-image.jpg')],
                'action' => ['label' => 'Checklist Done', 'icon' => 'fa-solid fa-square-check', 'badge_class' => 'badge-action-green', 'category' => 'cards'],
                'target_item' => 'Execute E2E Playwright Suite for OAuth',
                'workspace' => 'Engineering Team', 'board' => 'Bug Triage & Hotfixes',
                'ip_address' => '192.168.1.99', 'device' => 'Chrome / Windows 10', 'location' => 'Rawalpindi, PK',
                'timestamp' => '2026-08-07 18:40:00', 'time_ago' => '4 days ago',
                'severity' => ['label' => 'Info', 'class' => 'severity-info'], 'details' => ['checklist_items_done' => 8]
            ],
            [
                'id' => 'LOG-8924',
                'user' => ['name' => 'Admin System', 'email' => 'admin@richmondtech.com', 'role' => 'Super Admin', 'avatar' => asset('images/avatars/default-image.jpg')],
                'action' => ['label' => 'Workspace Updated', 'icon' => 'fa-solid fa-sliders', 'badge_class' => 'badge-action-blue', 'category' => 'security'],
                'target_item' => 'Product Design & Marketing (Member Invites Enabled)',
                'workspace' => 'Product Design & Marketing', 'board' => 'Workspace Config',
                'ip_address' => '192.168.1.1', 'device' => 'Chrome / Windows 11', 'location' => 'Lahore, PK',
                'timestamp' => '2026-08-07 14:00:00', 'time_ago' => '4 days ago',
                'severity' => ['label' => 'Info', 'class' => 'severity-info'], 'details' => ['member_invites' => 'Enabled']
            ],
            [
                'id' => 'LOG-8923',
                'user' => ['name' => 'David Chen', 'email' => 'david@richmondtech.com', 'role' => 'Growth Marketer', 'avatar' => asset('images/avatars/default-image.jpg')],
                'action' => ['label' => 'Card Moved', 'icon' => 'fa-solid fa-arrows-left-right', 'badge_class' => 'badge-action-blue', 'category' => 'cards'],
                'target_item' => 'Publish Q3 Product Roadmap Medium Post',
                'workspace' => 'Product Design & Marketing', 'board' => 'Q4 Marketing Launch',
                'ip_address' => '203.135.42.10', 'device' => 'Edge / Windows 11', 'location' => 'Faisalabad, PK',
                'timestamp' => '2026-08-07 10:15:00', 'time_ago' => '4 days ago',
                'severity' => ['label' => 'Info', 'class' => 'severity-info'], 'details' => ['to_list' => 'Published']
            ],
            [
                'id' => 'LOG-8922',
                'user' => ['name' => 'Sarah Connor', 'email' => 'sarah@richmondtech.com', 'role' => 'Product Designer', 'avatar' => asset('images/avatars/default-image.jpg')],
                'action' => ['label' => 'Board Created', 'icon' => 'fa-solid fa-plus', 'badge_class' => 'badge-action-green', 'category' => 'boards'],
                'target_item' => 'User Feedback & Usability Tests',
                'workspace' => 'Product Design & Marketing', 'board' => 'Usability Tests',
                'ip_address' => '192.168.1.45', 'device' => 'Chrome / Windows 11', 'location' => 'Lahore, PK',
                'timestamp' => '2026-08-06 16:50:00', 'time_ago' => '5 days ago',
                'severity' => ['label' => 'Info', 'class' => 'severity-info'], 'details' => ['board_color' => '#059669']
            ],
            [
                'id' => 'LOG-8921',
                'user' => ['name' => 'Chris Parker', 'email' => 'chris@richmondtech.com', 'role' => 'Senior Frontend Lead', 'avatar' => asset('images/avatars/default-image.jpg')],
                'action' => ['label' => 'File Attached', 'icon' => 'fa-solid fa-paperclip', 'badge_class' => 'badge-action-purple', 'category' => 'cards'],
                'target_item' => 'dragdrop_physics_spec_v1.pdf',
                'workspace' => 'Engineering Team', 'board' => 'Sprint 24 Architecture',
                'ip_address' => '192.168.1.18', 'device' => 'Safari / macOS', 'location' => 'Karachi, PK',
                'timestamp' => '2026-08-06 12:30:00', 'time_ago' => '5 days ago',
                'severity' => ['label' => 'Info', 'class' => 'severity-info'], 'details' => ['file_size' => '3.2 MB']
            ],
            [
                'id' => 'LOG-8920',
                'user' => ['name' => 'Alex Johnson', 'email' => 'alex@richmondtech.com', 'role' => 'Backend Lead', 'avatar' => asset('images/avatars/default-image.jpg')],
                'action' => ['label' => 'Card Moved', 'icon' => 'fa-solid fa-arrows-left-right', 'badge_class' => 'badge-action-blue', 'category' => 'cards'],
                'target_item' => 'Migrate MySQL Schema to MariaDB 10.6',
                'workspace' => 'Engineering Team', 'board' => 'API v3 Migration',
                'ip_address' => '10.0.0.12', 'device' => 'Firefox / Linux', 'location' => 'Islamabad, PK',
                'timestamp' => '2026-08-06 09:10:00', 'time_ago' => '5 days ago',
                'severity' => ['label' => 'Info', 'class' => 'severity-info'], 'details' => ['to_list' => 'In Progress']
            ],
            [
                'id' => 'LOG-8919',
                'user' => ['name' => 'Elena Rostova', 'email' => 'elena@richmondtech.com', 'role' => 'QA Specialist', 'avatar' => asset('images/avatars/default-image.jpg')],
                'action' => ['label' => 'Card Deleted', 'icon' => 'fa-solid fa-trash-can', 'badge_class' => 'badge-action-rose', 'category' => 'cards'],
                'target_item' => 'Duplicate Safari 14 Flexbox Bug Task',
                'workspace' => 'Engineering Team', 'board' => 'Bug Triage & Hotfixes',
                'ip_address' => '192.168.1.99', 'device' => 'Chrome / Windows 10', 'location' => 'Rawalpindi, PK',
                'timestamp' => '2026-08-05 17:00:00', 'time_ago' => '6 days ago',
                'severity' => ['label' => 'Warning', 'class' => 'severity-warning'], 'details' => ['reason' => 'Duplicate item']
            ],
            [
                'id' => 'LOG-8918',
                'user' => ['name' => 'Admin System', 'email' => 'admin@richmondtech.com', 'role' => 'Super Admin', 'avatar' => asset('images/avatars/default-image.jpg')],
                'action' => ['label' => 'Role Updated', 'icon' => 'fa-solid fa-user-shield', 'badge_class' => 'badge-action-amber', 'category' => 'security'],
                'target_item' => 'Chris Parker (Frontend Lead -> Senior Lead)',
                'workspace' => 'System Wide', 'board' => 'Admin Panel',
                'ip_address' => '192.168.1.1', 'device' => 'Chrome / Windows 11', 'location' => 'Lahore, PK',
                'timestamp' => '2026-08-05 11:45:00', 'time_ago' => '6 days ago',
                'severity' => ['label' => 'Warning', 'class' => 'severity-warning'], 'details' => ['role' => 'Senior Frontend Lead']
            ],
            [
                'id' => 'LOG-8917',
                'user' => ['name' => 'David Chen', 'email' => 'david@richmondtech.com', 'role' => 'Growth Marketer', 'avatar' => asset('images/avatars/default-image.jpg')],
                'action' => ['label' => 'Checklist Done', 'icon' => 'fa-solid fa-square-check', 'badge_class' => 'badge-action-green', 'category' => 'cards'],
                'target_item' => 'Set up Google Analytics 4 Event Triggers',
                'workspace' => 'Product Design & Marketing', 'board' => 'Q4 Marketing Launch',
                'ip_address' => '203.135.42.10', 'device' => 'Edge / Windows 11', 'location' => 'Faisalabad, PK',
                'timestamp' => '2026-08-04 15:20:00', 'time_ago' => '1 week ago',
                'severity' => ['label' => 'Info', 'class' => 'severity-info'], 'details' => ['items_completed' => 6]
            ],
            [
                'id' => 'LOG-8916',
                'user' => ['name' => 'Sarah Connor', 'email' => 'sarah@richmondtech.com', 'role' => 'Product Designer', 'avatar' => asset('images/avatars/default-image.jpg')],
                'action' => ['label' => 'File Attached', 'icon' => 'fa-solid fa-paperclip', 'badge_class' => 'badge-action-purple', 'category' => 'cards'],
                'target_item' => 'icon_system_v2_svg_bundle.zip',
                'workspace' => 'Product Design & Marketing', 'board' => 'Design System 2.0 Tokens',
                'ip_address' => '192.168.1.45', 'device' => 'Chrome / Windows 11', 'location' => 'Lahore, PK',
                'timestamp' => '2026-08-04 10:10:00', 'time_ago' => '1 week ago',
                'severity' => ['label' => 'Info', 'class' => 'severity-info'], 'details' => ['file_size' => '8.6 MB']
            ],
            [
                'id' => 'LOG-8915',
                'user' => ['name' => 'Admin System', 'email' => 'admin@richmondtech.com', 'role' => 'Super Admin', 'avatar' => asset('images/avatars/default-image.jpg')],
                'action' => ['label' => 'Workspace Updated', 'icon' => 'fa-solid fa-sliders', 'badge_class' => 'badge-action-blue', 'category' => 'security'],
                'target_item' => 'System Wide Security Audit Enabled',
                'workspace' => 'System Wide', 'board' => 'Admin Panel',
                'ip_address' => '192.168.1.1', 'device' => 'Chrome / Windows 11', 'location' => 'Lahore, PK',
                'timestamp' => '2026-08-03 09:00:00', 'time_ago' => '1 week ago',
                'severity' => ['label' => 'Info', 'class' => 'severity-info'], 'details' => ['audit_mode' => 'Verbose Logging']
            ]
        ];

        $this->view('admin/activity_log', [
            'pageTitle' => 'Audit & Activity Logs - Richmondtech Admin',
            'page_js' => 'admin_activity_log.js',
            'stats' => $stats,
            'logs' => $logs
        ]);
    }
}
