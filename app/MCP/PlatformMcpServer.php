<?php

namespace App\MCP;

use App\MCP\Tools\Analytics\GetDailyCommitsTool;
use App\MCP\Tools\Analytics\GetPlatformStatsTool;
use App\MCP\Tools\LMS\GetCourseTool;
use App\MCP\Tools\LMS\ListCoursesTool;
use App\MCP\Tools\Quiz\GetQuizTool;
use App\MCP\Tools\Quiz\ListQuizzesTool;
use Laravel\Mcp\Server;

class PlatformMcpServer extends Server
{
    protected string $name = 'Baricode Platform';

    protected string $version = '1.0.0';

    protected string $instructions = 'AI agent integration for Baricode community platform management and automation';

    protected array $tools = [
        GetPlatformStatsTool::class,
        GetDailyCommitsTool::class,
        ListQuizzesTool::class,
        GetQuizTool::class,
        ListCoursesTool::class,
        GetCourseTool::class,
    ];
}
