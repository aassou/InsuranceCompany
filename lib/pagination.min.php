<?php
function paginate($url, $link, $total, $current, $adj=3) {
    $prev = $current - 1;
    $next = $current + 1;
    $penultimate = $total - 1;
    $pagination = '';
    if ($total > 1) {
        $pagination .= " <div class=\"dataTables_paginate paging_bootstrap pagination\"> ";
        $pagination .= "<ul>";
        if ($current == 2) {
            $pagination .= "<li class=\"prev\"><a href=\"{$url}\">← Prev</a></li>";
        } 
        elseif ($current > 2) {
            $pagination .= "<li class=\"prev\"><a href=\"{$url}{$link}{$prev}\">← Prev</a></li>";
        } 
        else {
            $pagination .= "<li class=\"prev disabled\"><a>← Prev</a></li>";
        }
        if ($total < 7 + ($adj * 2)) {
            $pagination .= ($current == 1) ? "<li class=\"active\"><a>1</a></li>":"<li><a href=\"{$url}\">1</a></li>";
            for ($i=2; $i<=$total; $i++) {
                if ($i == $current) {
                    $pagination .= " <li class=\"active\"><a>{$i}</a></li>";
                } 
                else {
                    $pagination .= "<li><a href=\"{$url}{$link}{$i}\">{$i}</a></li>";
                }
            }
        }
        else {
            if ($current < 2 + ($adj * 2)) {
                $pagination .= ($current == 1) ? "<li class=\"active\"><a>1</a></li>":"<li><a href=\"{$url}\">1</a></li>";
                for ($i = 2; $i < 4 + ($adj * 2); $i++) {
                    if ($i == $current) {
                        $pagination .= "<li class=\"active\"><a>{$i}</a></li>";
                    } else {
                        $pagination .= "<li><a href=\"{$url}{$link}{$i}\">{$i}</a></li>";
                    }
                }
                $pagination .= '<li><a>&hellip;</a></li>';
                $pagination .= "<li><a href=\"{$url}{$link}{$penultimate}\">{$penultimate}</a></li>";
                $pagination .= "<li><a href=\"{$url}{$link}{$total}\">{$total}</a></li>";
            }
            elseif ( (($adj * 2) + 1 < $current) && ($current < $total - ($adj * 2)) ) {
                $pagination .= "<li><a href=\"{$url}\">1</a></li>";
                $pagination .= "<li><a href=\"{$url}{$link}2\">2</a></li>";
                $pagination .= '<li><a>&hellip;</a></li>';
                for ($i = $current - $adj; $i <= $current + $adj; $i++) {
                    if ($i == $current) {
                        $pagination .= "<li class=\"active\"><a>{$i}</a></li>";
                    } else {
                        $pagination .= "<li><a href=\"{$url}{$link}{$i}\">{$i}</a></li>";
                    }
                }
                $pagination .= '<li><a>&hellip;</a></li>';
                $pagination .= "<li><a href=\"{$url}{$link}{$penultimate}\">{$penultimate}</a></li>";
                $pagination .= "<li><a href=\"{$url}{$link}{$total}\">{$total}</a></li>";
            }
            else {
                $pagination .= "<li><a href=\"{$url}\">1</a></li>";
                $pagination .= "<li><a href=\"{$url}{$link}2\">2</a></li>";
                $pagination .= '<li><a>&hellip;</a></li>';
                for ($i = $total - (2 + ($adj * 2)); $i <= $total; $i++) {
                    if ($i == $current) {
                        $pagination .= "<li class=\"active\"><a>{$i}</a></li>";
                    } 
                    else {
                        $pagination .= "<li><a href=\"{$url}{$link}{$i}\">{$i}</a></li>";
                    }
                }
            }
        }
        if ($current == $total){
            $pagination .= "<li class=\"next disabled\"><a  >Next →</a></li>";
        }
        else{
            $pagination .= "<li class=\"next\"><a href=\"{$url}{$link}{$next}\">Next →</a></li>";
        }
        $pagination .= "</ul></div>";
    }
    return ($pagination);
}
?>