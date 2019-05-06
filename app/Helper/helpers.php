<?php


function extract_roles($sel)
{
    if ($sel instanceof \Illuminate\Database\Eloquent\Collection) {
        $sel = $sel->toArray();
    }
    return array_column($sel, 'role_id');
}
