<?php

class AdminController extends Controller {
    public function dashboard() {
        $stats = [
            'total_users' => 142,
            'total_boards' => 58,
            'active_workspaces' => 12,
            'completed_tasks' => 1240
        ];

        $recentUsers = [
            ['id' => 1, 'name' => 'Sarah Connor', 'email' => 'sarah@trello.com', 'role' => 'user', 'status' => 'Active', 'joined' => '2026-07-20', 'avatar' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=100&q=80'],
            ['id' => 2, 'name' => 'Mahad Bukhari', 'email' => 'mahad@trello.com', 'role' => 'user', 'status' => 'Active', 'joined' => '2026-07-18', 'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&q=80'],
            ['id' => 3, 'name' => 'Alex Johnson', 'email' => 'alex@trello.com', 'role' => 'admin', 'status' => 'Active', 'joined' => '2026-07-15', 'avatar' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=100&q=80'],
            ['id' => 4, 'name' => 'Elena Rostova', 'email' => 'elena@trello.com', 'role' => 'user', 'status' => 'Inactive', 'joined' => '2026-07-10', 'avatar' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&q=80'],
        ];

        $recentBoards = [
            ['id' => 1, 'title' => 'Sprint 24 - Core Architecture', 'workspace' => 'Engineering', 'members' => 8, 'cards' => 24, 'updated' => '2 mins ago'],
            ['id' => 2, 'title' => 'Q4 Growth Marketing', 'workspace' => 'Marketing', 'members' => 5, 'cards' => 14, 'updated' => '1 hour ago'],
            ['id' => 3, 'title' => 'Bug Triage & Polish', 'workspace' => 'Engineering', 'members' => 12, 'cards' => 31, 'updated' => '3 hours ago'],
        ];

        $this->view('admin/dashboard', [
            'pageTitle' => 'Admin Dashboard',
            'stats' => $stats,
            'recentUsers' => $recentUsers,
            'recentBoards' => $recentBoards
        ]);
    }

    public function users() {
        $users = [
            ['id' => 1, 'name' => 'Admin User', 'email' => 'admin@trello.com', 'role' => 'admin', 'status' => 'Active', 'boards' => 14, 'joined' => '2026-01-01', 'avatar' => 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?w=100&q=80'],
            ['id' => 2, 'name' => 'Mahad Bukhari', 'email' => 'mahad@trello.com', 'role' => 'user', 'status' => 'Active', 'boards' => 6, 'joined' => '2026-03-15', 'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&q=80'],
            ['id' => 3, 'name' => 'Sarah Connor', 'email' => 'sarah@trello.com', 'role' => 'user', 'status' => 'Active', 'boards' => 4, 'joined' => '2026-04-10', 'avatar' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=100&q=80'],
            ['id' => 4, 'name' => 'Alex Johnson', 'email' => 'alex@trello.com', 'role' => 'user', 'status' => 'Active', 'boards' => 9, 'joined' => '2026-05-22', 'avatar' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=100&q=80'],
            ['id' => 5, 'name' => 'Elena Rostova', 'email' => 'elena@trello.com', 'role' => 'user', 'status' => 'Inactive', 'boards' => 2, 'joined' => '2026-06-01', 'avatar' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&q=80'],
            ['id' => 6, 'name' => 'David Chen', 'email' => 'david@trello.com', 'role' => 'user', 'status' => 'Active', 'boards' => 11, 'joined' => '2026-06-18', 'avatar' => 'https://images.unsplash.com/photo-1522075469751-3a6694fb2f61?w=100&q=80'],
        ];

        $this->view('admin/users', [
            'pageTitle' => 'User Management',
            'users' => $users
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
                'cover_image' => 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?w=500&q=80',
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
                'cover_image' => 'https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5?w=500&q=80',
                'cards_count' => 12,
                'members_count' => 4,
                'is_starred' => false
            ],
            [
                'id' => 5,
                'title' => 'Q4 Product Marketing Launch',
                'workspace' => 'Product Design & Marketing',
                'cover_image' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=500&q=80',
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
                'color' => '#4f46e5',
                'visibility' => 'Workspace Visible',
                'members_count' => 8,
                'description' => 'Core product architecture, API services, microservices, and database schemas.',
                'boards' => [
                    ['id' => 1, 'title' => 'Sprint 24 - Core Architecture', 'cover_image' => asset('images/board_cover_engineering.png'), 'starred' => true, 'cards_count' => 18, 'members_count' => 6],
                    ['id' => 2, 'title' => 'Bug Triage & Hotfixes', 'cover_image' => 'https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5?w=500&q=80', 'starred' => false, 'cards_count' => 12, 'members_count' => 4],
                    ['id' => 3, 'title' => 'API v3 Migration Roadmap', 'cover_image' => 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?w=500&q=80', 'starred' => true, 'cards_count' => 9, 'members_count' => 5],
                    ['id' => 6, 'title' => 'DevOps & CI/CD Pipelines', 'cover_image' => 'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?w=500&q=80', 'starred' => false, 'cards_count' => 7, 'members_count' => 3],
                ]
            ],
            [
                'id' => 2,
                'name' => 'Product Design & Marketing',
                'icon' => 'fa-palette',
                'color' => '#7c3aed',
                'visibility' => 'Workspace Visible',
                'members_count' => 12,
                'description' => 'UI/UX design system tokens, brand identity, landing page, and growth campaigns.',
                'boards' => [
                    ['id' => 4, 'title' => 'Design System 2.0 Tokens', 'cover_image' => asset('images/board_cover_design.png'), 'starred' => true, 'cards_count' => 22, 'members_count' => 8],
                    ['id' => 5, 'title' => 'Q4 Product Marketing Launch', 'cover_image' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=500&q=80', 'starred' => false, 'cards_count' => 14, 'members_count' => 3],
                    ['id' => 7, 'title' => 'User Feedback & Usability Tests', 'cover_image' => 'https://images.unsplash.com/photo-1531403009284-440f080d1e12?w=500&q=80', 'starred' => false, 'cards_count' => 11, 'members_count' => 5],
                ]
            ]
        ];

        $closedBoards = [
            ['id' => 99, 'title' => 'Q1 Legacy Architecture (Archived)', 'workspace' => 'Engineering Team', 'closed_date' => 'Closed 3 weeks ago']
        ];

        $boards = [
            ['id' => 1, 'title' => 'Sprint 24 - Core Architecture', 'workspace' => 'Engineering', 'color' => '#4f46e5', 'created_by' => 'Admin User', 'members' => 8, 'cards' => 24, 'created_at' => '2026-07-01'],
            ['id' => 2, 'title' => 'Q4 Growth Marketing', 'workspace' => 'Marketing', 'color' => '#059669', 'created_by' => 'Sarah Connor', 'members' => 5, 'cards' => 14, 'created_at' => '2026-07-05'],
            ['id' => 3, 'title' => 'Bug Triage & Polish', 'workspace' => 'Engineering', 'color' => '#0284c7', 'created_by' => 'Mahad Bukhari', 'members' => 12, 'cards' => 31, 'created_at' => '2026-07-10'],
            ['id' => 4, 'title' => 'Design System 2.0', 'workspace' => 'Product Design', 'color' => '#d97706', 'created_by' => 'Alex Johnson', 'members' => 4, 'cards' => 18, 'created_at' => '2026-07-12'],
            ['id' => 5, 'title' => 'Customer Onboarding Flow', 'workspace' => 'Operations', 'color' => '#7c3aed', 'created_by' => 'Admin User', 'members' => 6, 'cards' => 9, 'created_at' => '2026-07-15'],
        ];

        $this->view('admin/boards', [
            'pageTitle' => 'All Boards - Trello Admin',
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
                'color' => '#6366f1',
                'icon' => 'fa-laptop-code',
                'members_count' => 8,
                'boards_count' => 3
            ],
            [
                'id' => 2,
                'name' => 'Product Design & Marketing',
                'description' => 'UX design system 2.0, brand asset illustrations, user research interviews, and Q4 growth marketing campaigns.',
                'visibility' => 'Public',
                'color' => '#ec4899',
                'icon' => 'fa-palette',
                'members_count' => 6,
                'boards_count' => 2
            ],
            [
                'id' => 3,
                'name' => 'Operations & Customer Success',
                'description' => 'Customer onboarding flows, SLA support desk tracking, SOC2 compliance audits, and HR team recruitment hiring.',
                'visibility' => 'Private',
                'color' => '#10b981',
                'icon' => 'fa-chart-line',
                'members_count' => 5,
                'boards_count' => 2
            ]
        ];

        $this->view('admin/workspaces', [
            'pageTitle' => 'Workspace Management - Trello Admin',
            'workspaces' => $workspaces
        ]);
    }

    public function notifications() {
        $notifications = [
            [
                'id' => 1,
                'title' => 'New User Provisioned',
                'message' => 'Admin System provisioned a new active user account for David Chen (david@trello.com).',
                'type' => 'user',
                'unread' => true,
                'starred' => false,
                'time' => '10 mins ago'
            ],
            [
                'id' => 2,
                'title' => 'Workspace Board Archived',
                'message' => 'Mahad Bukhari archived board "Q1 Legacy Architecture" in Engineering Team workspace.',
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

    public function boardDetail() {
        $board = [
            'id' => 1,
            'title' => 'Sprint 24 - Core Architecture',
            'workspace' => 'Engineering Team',
            'color' => '#4f46e5',
            'background_image' => 'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?auto=format&fit=crop&w=1920&q=80',
            'is_starred' => true,
            'members' => [
                ['name' => 'Mahad Bukhari', 'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&q=80', 'role' => 'Owner'],
                ['name' => 'Sarah Connor', 'avatar' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=100&q=80', 'role' => 'Admin'],
                ['name' => 'Alex Johnson', 'avatar' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=100&q=80', 'role' => 'Member'],
                ['name' => 'Elena Rostova', 'avatar' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&q=80', 'role' => 'Member']
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
                                ['name' => 'Sarah Connor', 'avatar' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=100&q=80'],
                                ['name' => 'Mahad Bukhari', 'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&q=80']
                            ]
                        ],
                        [
                            'id' => 'card-2',
                            'title' => 'Develop API for User Profiles',
                            'description' => 'Integrate Third-Party API Services',
                            'cover_image' => 'https://images.unsplash.com/photo-1531403009284-440f080d1e12?w=600&q=80',
                            'labels' => [
                                ['name' => 'Low Priority', 'bg' => '#F3E8FF', 'color' => '#9333EA'],
                                ['name' => 'In Progress', 'bg' => '#FFEDD5', 'color' => '#EA580C']
                            ],
                            'progress' => 0,
                            'comments_count' => 12,
                            'attachments_count' => 4,
                            'assignees' => [
                                ['name' => 'Sarah Connor', 'avatar' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=100&q=80'],
                                ['name' => 'Mahad Bukhari', 'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&q=80']
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
                            'cover_image' => 'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?w=600&q=80',
                            'labels' => [
                                ['name' => 'Feature', 'bg' => '#E0F2FE', 'color' => '#0284C7']
                            ],
                            'progress' => 80,
                            'comments_count' => 5,
                            'attachments_count' => 2,
                            'assignees' => [
                                ['name' => 'Mahad Bukhari', 'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&q=80']
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
                                ['name' => 'Alex Johnson', 'avatar' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=100&q=80']
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
