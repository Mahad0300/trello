<?php

class UserController extends Controller {
    public function dashboard() {
        $workspaces = [
            [
                'name' => 'Engineering Team',
                'description' => 'Core product architecture, API services, and microservices.',
                'boards' => [
                    ['id' => 1, 'title' => 'Sprint 24 - Core Architecture', 'color' => '#4f46e5', 'cover_image' => asset('images/board_cover_engineering.png'), 'starred' => true, 'cards_count' => 18, 'members_count' => 6],
                    ['id' => 2, 'title' => 'Bug Triage & Hotfixes', 'color' => '#0284c7', 'cover_image' => asset('images/images.png'), 'starred' => false, 'cards_count' => 12, 'members_count' => 4],
                    ['id' => 3, 'title' => 'API v3 Migration Roadmap', 'color' => '#d97706', 'cover_image' => asset('images/images1.png'), 'starred' => true, 'cards_count' => 9, 'members_count' => 5],
                ]
            ],
            [
                'name' => 'Product Design & Marketing',
                'description' => 'UI/UX design system, brand assets, and growth experiments.',
                'boards' => [
                    ['id' => 4, 'title' => 'Design System 2.0 Tokens', 'color' => '#059669', 'cover_image' => asset('images/board_cover_design.png'), 'starred' => true, 'cards_count' => 22, 'members_count' => 8],
                    ['id' => 5, 'title' => 'Q4 Product Marketing Launch', 'color' => '#7c3aed', 'cover_image' => asset('images/board_cover_design.png'), 'starred' => false, 'cards_count' => 14, 'members_count' => 3],
                ]
            ]
        ];

        $myTasks = [
            ['id' => 101, 'title' => 'Implement HTML5 Drag & Drop Card Physics', 'board' => 'Sprint 24', 'list' => 'In Progress', 'due' => 'Tomorrow', 'priority' => 'High', 'color' => '#ef4444'],
            ['id' => 102, 'title' => 'Audit CSS Variable Palette for Dark Accents', 'board' => 'Design System 2.0', 'list' => 'To Do', 'due' => 'Jul 28', 'priority' => 'Medium', 'color' => '#f59e0b'],
            ['id' => 103, 'title' => 'Review MySQL DDL Schema References', 'board' => 'Sprint 24', 'list' => 'Review & QA', 'due' => 'Jul 26', 'priority' => 'Low', 'color' => '#10b981'],
        ];

        $stats = [
            'active_boards' => 5,
            'assigned_tasks' => 14,
            'completed_tasks' => 38,
            'due_soon' => 3,
            'productivity_score' => 92,
            'completion_rate' => '86%'
        ];

        $todayAgenda = [
            ['id' => 201, 'title' => 'Implement HTML5 Drag & Drop Card Physics', 'board' => 'Sprint 24 - Core Architecture', 'due' => 'Today, 5:00 PM', 'due_status' => 'due-today', 'priority' => 'High', 'completed' => false],
            ['id' => 202, 'title' => 'Audit CSS Variable Palette for Dark Accents', 'board' => 'Design System 2.0 Tokens', 'due' => 'Overdue', 'due_status' => 'overdue', 'priority' => 'High', 'completed' => false],
            ['id' => 203, 'title' => 'Review MySQL DDL Schema References', 'board' => 'Sprint 24 - Core Architecture', 'due' => 'Tomorrow', 'due_status' => 'upcoming', 'priority' => 'Medium', 'completed' => true],
            ['id' => 204, 'title' => 'Create Onboarding Illustrations SVG Assets', 'board' => 'Product Design & Marketing', 'due' => 'Aug 02', 'due_status' => 'upcoming', 'priority' => 'Low', 'completed' => false],
        ];

        $userBoards = [
            [
                'id' => 1,
                'title' => 'Sprint 24 - Core Architecture',
                'workspace' => 'Engineering Team',
                'category' => 'Engineering',
                'category_bg' => '#E0F2FE',
                'category_color' => '#0369A1',
                'progress' => 85,
                'starred' => true,
                'cards_count' => 18,
                'updated' => '10 mins ago'
            ],
            [
                'id' => 4,
                'title' => 'Design System 2.0 Tokens',
                'workspace' => 'Product Design & Marketing',
                'category' => 'Design',
                'category_bg' => '#FCE7F3',
                'category_color' => '#BE185D',
                'progress' => 92,
                'starred' => true,
                'cards_count' => 22,
                'updated' => '1 hour ago'
            ],
            [
                'id' => 5,
                'title' => 'Q4 Product Marketing Launch',
                'workspace' => 'Product Design & Marketing',
                'category' => 'Marketing',
                'category_bg' => '#DCFCE7',
                'category_color' => '#15803D',
                'progress' => 60,
                'starred' => false,
                'cards_count' => 14,
                'updated' => '3 hours ago'
            ],
        ];

        $userComments = [
            ['user' => 'Sarah Connor', 'avatar' => asset('images/avatars/default-image.jpg'), 'comment' => 'tagged you in HTML5 Drag & Drop Card Physics: "Can you check line 140?"', 'board' => 'Sprint 24', 'time' => '10m ago', 'type' => 'mention'],
            ['user' => 'Alex Johnson', 'avatar' => asset('images/avatars/default-image.jpg'), 'comment' => 'uploaded architecture_v2_diagram.pdf to Sprint 24', 'board' => 'Sprint 24', 'time' => '1h ago', 'type' => 'attachment'],
            ['user' => 'Elena Rostova', 'avatar' => asset('images/avatars/default-image.jpg'), 'comment' => 'left a comment: "Design tokens look great!"', 'board' => 'Design System 2.0', 'time' => '3h ago', 'type' => 'comment'],
        ];

        $this->view('user/dashboard', [
            'pageTitle' => 'User Dashboard - Richmondtech',
            'workspaces' => $workspaces,
            'todayAgenda' => $todayAgenda,
            'stats' => $stats,
            'userBoards' => $userBoards,
            'userComments' => $userComments
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
                ['name' => 'Chris Parker', 'avatar' => asset('images/avatars/default-image.jpg'), 'role' => 'Owner'],
                ['name' => 'Sarah Connor', 'avatar' => asset('images/avatars/default-image.jpg'), 'role' => 'Admin'],
                ['name' => 'Alex Johnson', 'avatar' => asset('images/avatars/default-image.jpg'), 'role' => 'Member'],
                ['name' => 'Elena Rostova', 'avatar' => asset('images/avatars/default-image.jpg'), 'role' => 'Member']
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
                        ],
                        [
                            'id' => 'card-3',
                            'title' => 'Establish API for Payment Processing',
                            'description' => 'Build API for Payment Processing',
                            'cover_image' => null,
                            'labels' => [
                                ['name' => 'Low Priority', 'bg' => '#F3E8FF', 'color' => '#9333EA'],
                                ['name' => 'In Progress', 'bg' => '#E0F2FE', 'color' => '#0284C7']
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
                    'status_color' => '#F59E0B',
                    'cards' => [
                        [
                            'id' => 'card-4',
                            'title' => 'Implement Secure API Connections',
                            'description' => 'Implement Secure API Connections',
                            'cover_image' => null,
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
                        ],
                        [
                            'id' => 'card-5',
                            'title' => 'Integrate Third-Party API Services',
                            'description' => 'Create API Documentation and Guides',
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
                            'id' => 'card-6',
                            'title' => 'Create API Documentation and Guides',
                            'description' => 'Deploy API to Production Environment',
                            'cover_image' => null,
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
                    'id' => 'list-3',
                    'title' => 'Review',
                    'status_color' => '#10B981',
                    'cards' => [
                        [
                            'id' => 'card-7',
                            'title' => 'Deploy API to Production Environment',
                            'description' => 'Build API for Notifications System',
                            'cover_image' => asset('images/card_cover_dragdrop.png'),
                            'labels' => [
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
                            'id' => 'card-8',
                            'title' => 'Build API for Notifications System',
                            'description' => 'Test API Endpoints for Reliability',
                            'cover_image' => null,
                            'labels' => [
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
                    'id' => 'list-4',
                    'title' => 'Done',
                    'status_color' => '#22C55E',
                    'cards' => [
                        [
                            'id' => 'card-9',
                            'title' => 'Design API for User Authentication',
                            'description' => 'Establish API for User Profiles',
                            'cover_image' => null,
                            'labels' => [
                                ['name' => 'Done', 'bg' => '#DCFCE7', 'color' => '#16A34A'],
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
                            'id' => 'card-10',
                            'title' => 'Optimize API for Performance',
                            'description' => 'Optimize API for Performance',
                            'cover_image' => null,
                            'labels' => [
                                ['name' => 'Done', 'bg' => '#DCFCE7', 'color' => '#16A34A'],
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
                ]
            ]
        ];

        $this->view('user/board_detail', [
            'pageTitle' => $board['title'] . ' - Board Detail View',
            'board' => $board
        ]);
    }

    public function profile() {
        $user = [
            'name' => 'Chris Parker',
            'email' => 'chris@richmondtech.com',
            'role' => 'Senior Frontend Lead',
            'department' => 'Engineering',
            'avatar' => asset('images/avatars/default-image.jpg'),
            'joined' => 'March 2026',
            'status_label' => 'Active Member',
            'kicker' => 'My Profile',
            'boards_count' => 12,
            'cards_completed' => 84
        ];

        $this->view('user/profile', [
            'pageTitle' => 'My Profile - Richmondtech',
            'user' => $user
        ]);
    }

    public function notifications() {
        $notifications = [
            [
                'id' => 1,
                'user' => 'Sarah Connor',
                'avatar' => asset('images/avatars/default-image.jpg'),
                'action' => 'mentioned you in a comment on',
                'target' => 'HTML5 Drag & Drop Card Physics',
                'board' => 'Sprint 24 - Core Architecture',
                'comment' => '@Chris Parker please review the updated physics constraints when dragging cards between lists.',
                'type' => 'mention',
                'is_unread' => true,
                'time' => '10 mins ago',
                'date_group' => 'Today'
            ],
            [
                'id' => 2,
                'user' => 'Alex Johnson',
                'avatar' => asset('images/avatars/default-image.jpg'),
                'action' => 'assigned you to the card',
                'target' => 'Define MySQL 16-Table Schema Blueprint',
                'board' => 'Sprint 24 - Core Architecture',
                'comment' => null,
                'type' => 'assigned',
                'is_unread' => true,
                'time' => '45 mins ago',
                'date_group' => 'Today'
            ],
            [
                'id' => 3,
                'user' => 'Elena Rostova',
                'avatar' => asset('images/avatars/default-image.jpg'),
                'action' => 'attached file architecture_v2.pdf to',
                'target' => 'Card Detail Modal & Cover Banners',
                'board' => 'Sprint 24 - Core Architecture',
                'comment' => null,
                'type' => 'attachment',
                'is_unread' => true,
                'time' => '2 hours ago',
                'date_group' => 'Today'
            ],
            [
                'id' => 4,
                'user' => 'System Automation',
                'avatar' => asset('images/avatars/default-image.jpg'),
                'action' => 'Card due date approaching for',
                'target' => 'Custom Router & Controller MVC Skeleton',
                'board' => 'Sprint 24 - Core Architecture',
                'comment' => 'Task is scheduled to complete today at 05:00 PM.',
                'type' => 'due',
                'is_unread' => false,
                'time' => 'Yesterday at 4:30 PM',
                'date_group' => 'Yesterday'
            ],
            [
                'id' => 5,
                'user' => 'Sarah Connor',
                'avatar' => asset('images/avatars/default-image.jpg'),
                'action' => 'moved card from Backlog to In Progress',
                'target' => 'Design System Tokens & CSS Variables',
                'board' => 'Design System 2.0 Tokens',
                'comment' => null,
                'type' => 'activity',
                'is_unread' => false,
                'time' => 'Jul 21 at 2:15 PM',
                'date_group' => 'Earlier this week'
            ],
            [
                'id' => 6,
                'user' => 'Alex Johnson',
                'avatar' => asset('images/avatars/default-image.jpg'),
                'action' => 'mentioned you in a comment on',
                'target' => 'API Endpoint Authentication & JWT Token',
                'board' => 'API v3 Migration Roadmap',
                'comment' => '@Chris Parker JWT secret key rotation schema is ready for review.',
                'type' => 'mention',
                'is_unread' => false,
                'time' => 'Jul 20 at 11:00 AM',
                'date_group' => 'Earlier this week'
            ]
        ];

        $this->view('user/notifications', [
            'pageTitle' => 'Notification Center - Richmondtech',
            'notifications' => $notifications
        ]);
    }

    public function allBoards() {
        $starredBoards = [
            [
                'id' => 1,
                'title' => 'Sprint 24 - Core Architecture',
                'workspace' => 'Engineering Team',
                'cover_image' => asset('images/board_cover_engineering.png'),
                'cards_count' => 18,
                'members_count' => 6,
                'is_starred' => true,
                'last_activity' => '10 mins ago'
            ],
            [
                'id' => 3,
                'title' => 'API v3 Migration Roadmap',
                'workspace' => 'Engineering Team',
                'cover_image' => asset('images/images1.png'),
                'cards_count' => 9,
                'members_count' => 5,
                'is_starred' => true,
                'last_activity' => '2 hours ago'
            ],
            [
                'id' => 4,
                'title' => 'Design System 2.0 Tokens',
                'workspace' => 'Product Design & Marketing',
                'cover_image' => asset('images/board_cover_design.png'),
                'cards_count' => 22,
                'members_count' => 8,
                'is_starred' => true,
                'last_activity' => '5 hours ago'
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

        $this->view('user/all_boards', [
            'pageTitle' => 'All Boards - Richmondtech Workspaces',
            'starredBoards' => $starredBoards,
            'recentBoards' => $recentBoards,
            'workspaces' => $workspaces,
            'closedBoards' => $closedBoards
        ]);
    }
}
