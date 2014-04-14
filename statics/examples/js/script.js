/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// sidebar 收缩展开效果
$(document).ready(function() {
    $(".sidebar-box h1").toggle(function() {
        $(this).next(".sidebar-text").animate({height: 'toggle', opacity: 'toggle'}, "fast");
    }, function() {
        $(this).next(".sidebar-text").animate({height: 'toggle', opacity: 'toggle'}, "fast");
    });
});