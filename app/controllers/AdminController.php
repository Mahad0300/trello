<?php

class AdminController extends Controller {
    public function dashboard() {
        $stats = [
            'total_users' => 142,
            'active_users' => 136,
            'total_boards' => 58,
            'active_workspaces' => 12,
            'completed_tasks' => 1240,
            'productivity_rate' => 84,
            'growth_rate' => '+2.7%'
        ];

        $recentUsers = [
            ['id' => 1, 'name' => 'Sarah Connor', 'email' => 'sarah@richmondtech.com', 'role' => 'user', 'department' => 'Product Design', 'status' => 'Active', 'joined' => '2026-07-20', 'avatar' => asset('images/avatars/default-image.jpg')],
            ['id' => 2, 'name' => 'Chris Parker', 'email' => 'chris@richmondtech.com', 'role' => 'user', 'department' => 'Engineering', 'status' => 'Active', 'joined' => '2026-07-18', 'avatar' => asset('images/avatars/default-image.jpg')],
            ['id' => 3, 'name' => 'Alex Johnson', 'email' => 'alex@richmondtech.com', 'role' => 'admin', 'department' => 'Engineering', 'status' => 'Active', 'joined' => '2026-07-15', 'avatar' => asset('images/avatars/default-image.jpg')],
            ['id' => 4, 'name' => 'Elena Rostova', 'email' => 'elena@richmondtech.com', 'role' => 'user', 'department' => 'Quality Assurance', 'status' => 'Inactive', 'joined' => '2026-07-10', 'avatar' => asset('images/avatars/default-image.jpg')],
            ['id' => 5, 'name' => 'David Chen', 'email' => 'david@richmondtech.com', 'role' => 'user', 'department' => 'Marketing', 'status' => 'Active', 'joined' => '2026-06-18', 'avatar' => asset('images/avatars/default-image.jpg')]
        ];

        $recentBoards = [
            ['id' => 1, 'title' => 'Sprint 24 - Core Architecture', 'workspace' => 'Engineering Team', 'members' => 8, 'cards' => 24, 'progress' => 80, 'updated' => '2 mins ago'],
            ['id' => 2, 'title' => 'Q4 Growth Marketing', 'workspace' => 'Marketing & Ops', 'members' => 5, 'cards' => 14, 'progress' => 55, 'updated' => '1 hour ago'],
            ['id' => 3, 'title' => 'Bug Triage & Polish', 'workspace' => 'Engineering Team', 'members' => 12, 'cards' => 31, 'progress' => 90, 'updated' => '3 hours ago'],
        ];

        $activities = [
            ['user' => 'Sarah Connor', 'avatar' => asset('images/avatars/default-image.jpg'), 'action' => 'moved card', 'target' => 'HTML5 Drag & Drop Physics', 'board' => 'Sprint 24 - Core Architecture', 'time' => '15 mins ago'],
            ['user' => 'Chris Parker', 'avatar' => asset('images/avatars/default-image.jpg'), 'action' => 'created workspace', 'target' => 'Q4 Product Launch', 'board' => 'Marketing & Ops', 'time' => '1 hour ago'],
            ['user' => 'Alex Johnson', 'avatar' => asset('images/avatars/default-image.jpg'), 'action' => 'attached file', 'target' => 'architecture_v2.pdf', 'board' => 'Sprint 24 - Core Architecture', 'time' => '3 hours ago'],
            ['user' => 'Elena Rostova', 'avatar' => asset('images/avatars/default-image.jpg'), 'action' => 'completed checklist', 'target' => 'CSS Tokens & Variables', 'board' => 'Design System 2.0', 'time' => '5 hours ago'],
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
                'cover_image' => asset('images/board_cover_engineering.png'),
                'cards_count' => 18,
                'members_count' => 6,
                'is_starred' => true
            ],
            [
                'id' => 3,
                'title' => 'API v3 Migration Roadmap',
                'workspace' => 'Engineering Team',
                'cover_image' => asset('images/images1.png'),
                'cards_count' => 9,
                'members_count' => 5,
                'is_starred' => true
            ],
            [
                'id' => 4,
                'title' => 'Design System 2.0 Tokens',
                'workspace' => 'Product Design & Marketing',
                'cover_image' => asset('images/board_cover_design.png'),
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
                'cover_image' => asset('images/board_cover_engineering.png'),
                'cards_count' => 18,
                'members_count' => 6,
                'is_starred' => true
            ],
            [
                'id' => 2,
                'title' => 'Bug Triage & Hotfixes',
                'workspace' => 'Engineering Team',
                'cover_image' => asset('images/images.png'),
                'cards_count' => 12,
                'members_count' => 4,
                'is_starred' => false
            ],
            [
                'id' => 5,
                'title' => 'Q4 Product Marketing Launch',
                'workspace' => 'Product Design & Marketing',
                'cover_image' => asset('images/board_cover_design.png'),
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
                    ['id' => 1, 'title' => 'Sprint 24 - Core Architecture', 'cover_image' => asset('images/board_cover_engineering.png'), 'starred' => true, 'cards_count' => 18, 'members_count' => 6],
                    ['id' => 2, 'title' => 'Bug Triage & Hotfixes', 'cover_image' => asset('images/images.png'), 'starred' => false, 'cards_count' => 12, 'members_count' => 4],
                    ['id' => 3, 'title' => 'API v3 Migration Roadmap', 'cover_image' => asset('images/images1.png'), 'starred' => true, 'cards_count' => 9, 'members_count' => 5],
                    ['id' => 6, 'title' => 'DevOps & CI/CD Pipelines', 'cover_image' => asset('images/board_cover_engineering.png'), 'starred' => false, 'cards_count' => 7, 'members_count' => 3],
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
                    ['id' => 4, 'title' => 'Design System 2.0 Tokens', 'cover_image' => asset('images/board_cover_design.png'), 'starred' => true, 'cards_count' => 22, 'members_count' => 8],
                    ['id' => 5, 'title' => 'Q4 Product Marketing Launch', 'cover_image' => asset('images/board_cover_design.png'), 'starred' => false, 'cards_count' => 14, 'members_count' => 3],
                    ['id' => 7, 'title' => 'User Feedback & Usability Tests', 'cover_image' => asset('images/card_cover_architecture.png'), 'starred' => false, 'cards_count' => 11, 'members_count' => 5],
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
            'background_image' => asset('images/board_cover_engineering.png'),
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
                            'cover_image' => asset('images/card_cover_architecture.png'),
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
                            'cover_image' => asset('images/card_cover_architecture.png'),
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
}
