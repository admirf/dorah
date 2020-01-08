<?php

if(! function_exists('get_current_sprint')) {
    function get_current_sprint($projectId) {
        return App\Project::find($projectId)->sprints()->latest()->first();
    }
}