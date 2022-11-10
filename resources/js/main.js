const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

/* GALLERY PRODUCT */
$('.show-big').zoomImage();

$('.show-small-img:first-of-type').addClass('border p-1')
$('.show-small-img:first-of-type').attr('alt', 'now').siblings().removeAttr('alt')
$('#big-img').attr('src', $('.show-small-img:first-child').attr('src'))

$('.show-small-img').click(function () {
	$('#show-img').attr('src', $(this).attr('src'))
	$('#big-img').attr('src', $(this).attr('src'))
	$(this).attr('alt', 'now').siblings().removeAttr('alt')
	$(this).addClass('border p-1').siblings().removeClass('border p-1')
	if ($('#small-img-roll').children().length > 4) {
		if ($(this).index() >= 3 && $(this).index() < $('#small-img-roll').children().length - 1){
			$('#small-img-roll').css('left', -($(this).index() - 2) * 76 + 'px')
		} else if ($(this).index() == $('#small-img-roll').children().length - 1) {
			$('#small-img-roll').css('left', -($('#small-img-roll').children().length - 4) * 76 + 'px')
		} else {
			$('#small-img-roll').css('left', '0')
		}
	}
})

//Enable the next button

$('#next-img').click(function (){
	$('#show-img').attr('src', $(".show-small-img[alt='now']").next().attr('src'))
	$('#big-img').attr('src', $(".show-small-img[alt='now']").next().attr('src'))
	$(".show-small-img[alt='now']").next().addClass('border p-1').siblings().removeClass('border p-1')
	$(".show-small-img[alt='now']").next().attr('alt', 'now').siblings().removeAttr('alt')
	if ($('#small-img-roll').children().length > 4) {
		if ($(".show-small-img[alt='now']").index() >= 3 && $(".show-small-img[alt='now']").index() < $('#small-img-roll').children().length - 1){
			$('#small-img-roll').css('left', -($(".show-small-img[alt='now']").index() - 2) * 76 + 'px')
		} else if ($(".show-small-img[alt='now']").index() == $('#small-img-roll').children().length - 1) {
			$('#small-img-roll').css('left', -($('#small-img-roll').children().length - 4) * 76 + 'px')
		} else {
			$('#small-img-roll').css('left', '0')
		}
	}
})

//Enable the previous button

$('#prev-img').click(function (){
	$('#show-img').attr('src', $(".show-small-img[alt='now']").prev().attr('src'))
	$('#big-img').attr('src', $(".show-small-img[alt='now']").prev().attr('src'))
	$(".show-small-img[alt='now']").prev().addClass('border p-1').siblings().removeClass('border p-1')
	$(".show-small-img[alt='now']").prev().attr('alt', 'now').siblings().removeAttr('alt')
	if ($('#small-img-roll').children().length > 4) {
		if ($(".show-small-img[alt='now']").index() >= 3 && $(".show-small-img[alt='now']").index() < $('#small-img-roll').children().length - 1){
			$('#small-img-roll').css('left', -($(".show-small-img[alt='now']").index() - 2) * 76 + 'px')
		} else if ($(".show-small-img[alt='now']").index() == $('#small-img-roll').children().length - 1) {
			$('#small-img-roll').css('left', -($('#small-img-roll').children().length - 4) * 76 + 'px')
		} else {
			$('#small-img-roll').css('left', '0')
		}
	}
})
