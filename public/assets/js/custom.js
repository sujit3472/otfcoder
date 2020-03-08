/*
Template Name: Admin Press Admin
Author: Themedesigner
Email: niravjoshi87@gmail.com
File: js
*/
jQuery(function ($) {
    "use strict";
    $(function () {
        $(".preloader").fadeOut();
    });
    jQuery(document).on('click', '.mega-dropdown', function (e) {
        e.stopPropagation()
    });
    // ============================================================== 
    // This is for the top header part and sidebar part
    // ==============================================================  
    var set = function () {
            var width = (window.innerWidth > 0) ? window.innerWidth : this.screen.width;
            var topOffset = 70;
            if (width < 1170) {
                $("body").addClass("mini-sidebar");
                $('.navbar-brand span').hide();
                $(".scroll-sidebar, .slimScrollDiv").css("overflow-x", "visible").parent().css("overflow", "visible");
                $(".sidebartoggler i").addClass("ti-menu");
            }
            else {
                $("body").removeClass("mini-sidebar");
                $('.navbar-brand span').show();
                //$(".sidebartoggler i").removeClass("ti-menu");
            }
            
            var height = ((window.innerHeight > 0) ? window.innerHeight : this.screen.height) - 1;
            height = height - topOffset;
            if (height < 1) height = 1;
            if (height > topOffset) {
                $(".page-wrapper").css("min-height", (height) + "px");
            }
       
    };
    $(window).ready(set);
    $(window).on("resize", set);
    // ============================================================== 
    // Theme options
    // ==============================================================     
    $(".sidebartoggler").on('click', function () {
        if ($("body").hasClass("mini-sidebar")) {
            $("body").trigger("resize");
            $(".scroll-sidebar, .slimScrollDiv").css("overflow", "hidden").parent().css("overflow", "visible");
            $("body").removeClass("mini-sidebar");
            $('.navbar-brand span').show();
            //$(".sidebartoggler i").addClass("ti-menu");
        }
        else {
            $("body").trigger("resize");
            $(".scroll-sidebar, .slimScrollDiv").css("overflow-x", "visible").parent().css("overflow", "visible");
            $("body").addClass("mini-sidebar");
            $('.navbar-brand span').hide();
            //$(".sidebartoggler i").removeClass("ti-menu");
        }
    });
    // topbar stickey on scroll
    
    $(".fix-header .topbar").stick_in_parent({});
    
    
    // this is for close icon when navigation open in mobile view
    $(".nav-toggler").click(function () {
        $("body").toggleClass("show-sidebar");
        $(".nav-toggler i").toggleClass("mdi mdi-menu");
        $(".nav-toggler i").addClass("mdi mdi-close");
    });
     
     
     if($('.addTableRecord').length > 0)
    {
        $('body').on('click', '.addTableRecord', function(event) {
            event.preventDefault();            
            $("input[type=text],input[type=date], textarea").val("");            
            $(".add-record").removeClass('hide');
            $(".save-btn").val('Create');
            $(".heading").html('Insert');
            $('.contarct-display').addClass('hide');
            /* Act on the event */
        });
    }

     if($('.cancel-btn').length > 0)
    {
        $('body').on('click', '.cancel-btn', function(event) {
            event.preventDefault();            
            $("input[type=text],input[type=date], textarea").val("");
            $(".add-record").addClass('hide');
            /* Act on the event */
        });
    }    
    // ============================================================== 
    
    // ============================================================== 
    // Auto select left navbar
    // ============================================================== 
    $(function () {
        var url = window.location;
        var element = $('ul#sidebarnav a').filter(function () {
            return this.href == url;
        }).addClass('active').parent().addClass('active');
        while (true) {
            if (element.is('li')) {
                element = element.parent().addClass('in').parent().addClass('active');
            }
            else {
                break;
            }
        }
        
    });
    // ============================================================== 
    //tooltip
    // ============================================================== 
    $(function () {
            $('[data-toggle="tooltip"]').tooltip()
     })
    // ============================================================== 
    //Popover
    // ============================================================== 
    $(function () {
            $('[data-toggle="popover"]').popover()
        })
    // ============================================================== 
    // Sidebarmenu
    // ============================================================== 
    $(function () {
        $('#sidebarnav').metisMenu();
    });

    /*for table responsive*/
    
    
    $(".no-more-tables td.first").click(function(event) {            
        $(this).parent().find("td").each(function(index, el) {
            if(!$(this).hasClass('first'))
                $(this).toggleClass('show');
        });
    });

    $('.page-scroll').on('click', function(event) {
        var anchor = $(this);            
        $('html, body').stop().animate({
        scrollTop: $(anchor.attr('href')).offset().top
        }, 500, 'easeOutCirc');
        event.preventDefault();
    });
});