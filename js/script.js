let image_url = "";

function showModal(ele){
    const modal = $('#modal');
    image_url = $(ele).siblings('div.card-image').css('background-image');
    image_url = image_url.replace('url(','').replace(')','').replace(/\"/gi,"");
    modal.find('#modal_img').addClass("bg-[url('"+image_url+"')]");
    let text = $(ele).siblings('div.card-content').children('p').html();
    modal.find('#modal_text').html(text);
    modal.show('fade');

    const id = $(ele).parent().parent().find('input[type=radio]').attr('id');
    $('#modal').find('label').attr('for', id);
    $('#modal_container').show('slide', { direction: "up" }, 'slow');
}

function closeModal(){
    const modal = $('#modal'); 
    $('#modal_container').hide('slide', { direction: "up" }, () => {
        modal.find('#modal_img').removeClass("bg-[url('"+image_url+"')]");
        modal.find('#modal_text').html();
    });
    modal.hide('fade');
    closeConfirm();
}

function showDropDown(ele){
    if($('#dropdown').is(':hidden')){
        const buttonPos = $(ele).position();
        var left = ($(window).width() - $('#dropdown').outerWidth()) / 2;
        $('#dropdown').css({top: buttonPos['top']*2, left: (left > 0 ? left : 0)+'px'});
        $('#dropdown').show('slide', { direction: "up" });
    } else {
        $('#dropdown').hide('slide', { direction: "up" });
    }
}

$('.menuToggle').on('click', () => {
    if ($('#menuBackground').is(":hidden")){
        if($(window).width() < '768'){
            $('#menuBackground').show('fade');
            $('#nav').slideUp('slow')
        } else {
            $('#menuBackground').show("slide", { direction: "right" }, 'slow');
        }
    } else if ($('#menuBackground').is(":visible")){
        if($(window).width() < '768'){
            $('#menuBackground').hide('fade');
            $('#nav').slideDown('slow')
        } else {
            $('#menuBackground').hide("slide", { direction: "right" }, );
        }
    }
});

$(document).mouseup((e) => {
    if($(e.target).closest("#menuBackground").length === 0){
        if($(window).width() < '768'){
            $('#menuBackground').hide('fade');
            $('#nav').slideDown('slow')
        } else {
            $('#menuBackground').hide("slide", { direction: "right" }, );
        } 
    }

    if($(e.target).closest("#dropdown").length === 0){
        $('#dropdown').hide('slide', { direction: "up" });
    }
});

$(document).ready(function(){
    $('.line-clamp-3').each(function(){
        if (this.offsetHeight < this.scrollHeight || this.offsetWidth < this.scrollWidth) {
            $(this).parent().siblings('button').removeClass('hidden');
        }
    });
});

$('input[type=radio]').on('change' , (e) => {
    let id = $(e.target).attr('id');
    let harga = $("#harga_"+id).attr('harga');
    $('#total_harga').html(harga);
    $('#konfirm_container').show('slide', { direction: "down" }, 'fast');
})

$('#button_close_confirm').on('click', () => {
    closeConfirm();
})

function closeConfirm(){
    $('#konfirm_container').hide('slide', { direction: "down" }, 'fast');
    $('input[type="radio"]').prop('checked', false);
}