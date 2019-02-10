jQuery(function ($) {
    'use strict';

    var $wizard1 = $('#wizard-1');
    $wizard1.bootstrapWizard({
        tabClass: 'nav nav-tabs',
        onTabShow: function (tab, navigation, index) {
            var $total = navigation.find('li').length;
            var $current = index + 1;

            if ($current >= $total) {
                // hide pager, finish & next on last step
                $wizard1.find('.pager .next').hide();
                $wizard1.find('.pager .finish').hide();
                $wizard1.find('.pager .finish').addClass('disabled');
            } else if ($current == $total - 1) {
                // Show Finish on penultimate tab
                $wizard1.find('.pager .next').hide();
                $wizard1.find('.pager .finish').show();
                $wizard1.find('.pager .finish').removeClass('disabled');
            }
            else {
                $wizard1.find('.pager .next').show();
                $wizard1.find('.pager .finish').hide();
                $wizard1.find('.pager .finish').addClass('disabled');
            }
        }
    });
    $('.pager.wizard a').click(function(event){
        event.preventDefault();
    });
});

function getSum(event){
    let panel = $('#wizard1-4');
    let amount = 0;

    $.ajax({
        'type': 'POST',
        'url': '/sum',
        'data': $('#form-buy').serialize(),
        'success': function (result) {
            amount = result.attachments.total;
            panel.removeClass('bg-danger');
            panel.addClass('bg-success');
            panel.find('h1').html('К оплате<br><b>' + amount + '</b>');
            panel.find('i').removeClass('fa-exclamation-circle');
            panel.find('i').addClass('fa-rub');
            panel.find('h2').html('Оплатить');
            panel.attr('onclick', "$('#form-buy').submit();");
        },
        'error': function (result) {
            panel.removeClass('bg-success');
            panel.addClass('bg-danger');
            panel.find('h1').html('Упс...');
            panel.find('i').removeClass('fa-rub');
            panel.find('i').addClass('fa-exclamation-circle');
            panel.find('h2').html('Введённые Вами данные некорректны. Вернитесь и исправьте ошибку.');
            panel.attr('onclick', '');
        },
    });

}
