<?php

return [
    'slug-length'   => 8,
    'secret-length' => 16,
    /*
    |--------------------------------------------------------------------------
    | GitHub
    |--------------------------------------------------------------------------
    |
    | `Event` =>  [`Actions`]
    |
    */
    'github' => [
        'branch_protection_rule' => [
            'created',
            'edited',
            'deleted',
        ],
        'commit_comment' => ['created'],
        'content_reference' => ['created'],
        'create' => [],
        'delete' => [],
        'deploy_key' => [
            'created',
            'deleted',
        ],
        'deployment' => ['created'],
        'deployment_status' => ['created'],
        'discussion' => [
            'created',
            'edited',
            'deleted',
            'pinned',
            'unpinned',
            'locked',
            'unlocked',
            'transferred',
            'category_changed',
            'answered',
            'unanswered',
        ],
        'discussion_comment' => [
            'created',
            'edited',
            'deleted',
        ],
        'fork' => [],
        'github_app_authorization' => ['revoked'],
        'gollum' => [],
        'installation' => [
            'created',
            'deleted',
            'suspend',
            'unsuspend',
            'new_permissions_accepted',
        ],
        'installation_repositories' => [
            'added',
            'removed',
        ],
        'issue_comment' => [
            'created',
            'edited',
            'deleted',
        ],
        'issues' => [
            'opened',
            'edited',
            'deleted',
            'pinned',
            'unpinned',
            'closed',
            'reopened',
            'assigned',
            'unassigned',
            'labeled',
            'unlabeled',
            'locked',
            'unlocked',
            'transferred',
            'milestoned',
            'demilestoned',
        ],
        'label' => [
            'created',
            'edited',
            'deleted',
        ],
        'marketplace_purchase' => [
            'purchased',
            'pending_change',
            'pending_change_cancelled',
            'changed',
            'cancelled',
        ],
        'member' => [
            'added',
            'removed',
            'edited',
        ],
        'membership' => [
            'added',
            'removed',
        ],
        'meta' => [
            'deleted',
        ],
        'milestone' => [
            'created',
            'closed',
            'opened',
            'edited',
            'deleted',
        ],
        'organization' => [
            'deleted',
            'renamed',
            'member_added',
            'member_removed',
            'member_invited',
        ],
        'org_block' => [
            'blocked',
            'unblocked',
        ],
        'package' => [
            'published',
            'updated',
        ],
        'page_build' => [],
        'ping' => [],
        'project_card' => [
            'created',
            'edited',
            'moved',
            'converted',
            'converted',
        ],
        'project_column' => [
            'created',
            'edited',
            'moved',
            'deleted',
        ],
        'project' => [
            'created',
            'edited',
            'closed',
            'reopened',
            'deleted',
        ],
        'pull_request' => [
            'assigned',
            'auto_merge_disabled',
            'auto_merge_enabled',
            'closed',
            'merged',
            'converted_to_draft',
            'edited',
            'labeled',
            'locked',
            'opened',
            'ready_for_review',
            'reopened',
            'review_request_removed',
            'review_requested',
            'synchronize',
            'unassigned',
            'unlabeled',
            'unlocked',
        ],
        'pull_request_review' => [
            'submitted',
            'edited',
            'dismissed',
        ],
        'pull_request_review_comment' => [
            'created',
            'edited',
            'deleted',
        ],
        'push' => [],
        'release' => [
            'published',
            'unpublished',
            'created',
            'edited',
            'deleted',
            'prereleased',
            'released',
        ],
        'repository_dispatch' => [
            'created',
            'deleted',
            'archived',
            'unarchived',
            'edited',
            'renamed',
            'transferred',
            'publicized',
            'privatized',
        ],
        'repository' => [
            'created',
            'deleted',
            'archived',
            'unarchived',
            'edited',
            'renamed',
            'transferred',
            'publicized',
            'privatized',
        ],
        'repository_import' => [
            'success',
            'cancelled',
            'failure',
        ],
        'repository_vulnerability_alert' => [
            'create',
            'dismiss',
            'resolve',
        ],
        'secret_scanning_alert' => [
            'create',
            'resolved',
            'reopened',
        ],
        'security_advisory' => [
            'published',
            'updated',
            'performed',
            'withdrawn',
        ],
        'sponsorship' => [
            'created',
            'cancelled',
            'edited',
            'tier_changed',
            'pending_cancellation',
            'pending_tier_change',
        ],
        'star' => [
            'created',
            'deleted',
        ],
        'status' => [],
        'team' => [
            'created',
            'deleted',
            'edited',
            'added_to_repository',
            'removed_from_repository',
        ],
        'team_add' => [],
        'watch' => ['started'],
        'workflow_dispatch' => [
            'queued',
            'in_progress',
            'completed',
        ],
        'workflow_job' => [
            'queued',
            'in_progress',
            'completed',
        ],
    ],
];
